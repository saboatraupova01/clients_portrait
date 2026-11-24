<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class ClientPortraitController extends Controller
{
    private const DEFAULT_BRANCH = 'Головной офис (Худжанд)';

    public function index(): View
    {
        return view('client-portrait');
    }

    public function data(Request $request): JsonResponse
    {
        $branch = $request->query('branch');
        $city   = $request->query('city');
        $sex    = $request->query('sex');

        // 1. Список филиалов для фильтра
        $branches = DB::table('Branches')
            ->orderBy('Name')
            ->pluck('Name')
            ->values();

        // 2. Список городов по физическим лицам (CustomerTypeID = 1)
        $cityExpr = "COALESCE(NULLIF(c.ResidenceCityName, ''), NULLIF(c.RegistrationCityName, ''), ci.CityNameRu, ci.CityName)";

        $cities = DB::table('Customers as c')
            ->leftJoin('Cities as ci', function ($join) {
                $join->on('ci.CityID', '=', DB::raw('COALESCE(c.ResidenceCityID, c.RegistrationCityID)'));
            })
            ->where('c.CustomerTypeID', 1)
            ->whereRaw("{$cityExpr} IS NOT NULL")
            ->selectRaw("DISTINCT {$cityExpr} AS City")
            ->orderBy('City')
            ->pluck('City')
            ->values();

        // 3. Определение филиала клиента через его счета и офисы
        $customerBranchSub = DB::table('Accounts as a')
            ->join('Offices as o', 'o.ID', '=', 'a.OfficeID')
            ->select('a.CustomerID', DB::raw('MIN(o.BranchID) as BranchID'))
            ->groupBy('a.CustomerID');

        // 4. Основной запрос по физическим лицам
        $branchExpr   = "COALESCE(b.Name, '" . self::DEFAULT_BRANCH . "')";
        $fullCityExpr = "COALESCE(NULLIF(c.ResidenceCityName, ''), NULLIF(c.RegistrationCityName, ''), ci.CityNameRu, ci.CityName, 'Не указан')";

        $query = DB::table('Customers as c')
            ->leftJoin('FamilyStatusTypes as fs', 'fs.ID', '=', 'c.FamilyStatusID')
            ->leftJoin('EducationTypes as ed', 'ed.ID', '=', 'c.EducationTypeID')
            ->leftJoin('Cities as ci', function ($join) {
                $join->on('ci.CityID', '=', DB::raw('COALESCE(c.ResidenceCityID, c.RegistrationCityID)'));
            })
            ->leftJoinSub($customerBranchSub, 'acc_br', function ($join) {
                $join->on('acc_br.CustomerID', '=', 'c.CustomerID');
            })
            ->leftJoin('Branches as b', 'b.ID', '=', 'acc_br.BranchID')
            ->where('c.CustomerTypeID', 1)
            ->select([
                'c.CustomerID as id',
                DB::raw("TRIM(CONCAT_WS(' ', c.Surname, c.CustomerName, c.Otchestvo)) as fio"),
                'c.Sex as sex',
                'c.DateOfBirth as dob',
                DB::raw("COALESCE(fs.Name, 'Не указано') as family"),
                DB::raw("COALESCE(ed.Name, 'Не указано') as education"),
                DB::raw("{$fullCityExpr} as city"),
                DB::raw("COALESCE(NULLIF(SUBSTRING_INDEX(c.ResidenceStreet, ',', 1), ''), NULLIF(SUBSTRING_INDEX(c.RegistrationStreet, ',', 1), ''), 'Центр') as district"),
                DB::raw("{$branchExpr} as branch"),
            ]);

        if ($branch && $branch !== 'Все филиалы') {
            $query->whereRaw("{$branchExpr} = ?", [$branch]);
        }

        if ($city && $city !== 'Все города') {
            $query->whereRaw("{$fullCityExpr} = ?", [$city]);
        }

        if ($sex === '0' || $sex === '1') {
            $query->where('c.Sex', (int) $sex);
        }

        $customers = $query->orderByDesc('c.CustomerID')->get();

        if ($customers->isEmpty()) {
            return response()->json([
                'source'  => 'MySQL · ClientsDB',
                'filters' => [
                    'branches' => $branches,
                    'cities'   => $cities,
                ],
                'clients' => [],
            ]);
        }

        $customerIds = $customers->pluck('id')->map(fn ($id) => (int) $id)->all();

        // 5. Активные депозиты только по отфильтрованным клиентам
        $depositRows = DB::table('DepositAccounts as d')
            ->join('Accounts as a', function ($join) {
                $join->on('a.AccountNo', '=', 'd.MainAccountNo')
                    ->on('a.CurrencyID', '=', 'd.CurrencyID');
            })
            ->whereIn('a.CustomerID', $customerIds)
            ->whereNull('a.CloseDate')
            ->select('a.CustomerID', 'd.MainAccountNo', 'a.AccountName', 'd.Period')
            ->get();

        $depositsByCustomer = [];
        foreach ($depositRows as $row) {
            $type = $this->classifyDepositType(
                $row->MainAccountNo,
                $row->AccountName,
                $row->Period !== null ? (int) $row->Period : null
            );
            $depositsByCustomer[(int) $row->CustomerID][$type] = true;
        }

        // 6. Активные кредиты только по отфильтрованным клиентам
        $creditRows = DB::table('Accounts as a')
            ->leftJoin('History as h', 'h.AgreementNo', '=', 'a.Codename')
            ->leftJoin('Products as p', 'p.ProductID', '=', 'h.ProductID')
            ->whereIn('a.CustomerID', $customerIds)
            ->whereNull('a.CloseDate')
            ->where(function ($q) {
                $q->where('a.BalanceGroup', 'like', '105%')
                    ->orWhere('a.BalanceGroup', 'like', '107%')
                    ->orWhere('a.BalanceGroup', 'like', '109%')
                    ->orWhere('a.AccountGroup', 'like', 'Cred%')
                    ->orWhere('a.AccountName', 'like', '%кредит%')
                    ->orWhere('a.AccountName', 'like', '%ссуд%');
            })
            ->select([
                'a.CustomerID',
                DB::raw('COALESCE(p.Name, a.AccountName) as ProductName'),
                DB::raw('COALESCE(p.IsMortgageProduct, 0) as IsMortgage'),
                DB::raw('COALESCE(p.IsConsumerLoan, 0) as IsConsumer'),
            ])
            ->distinct()
            ->get();

        $creditsByCustomer = [];
        foreach ($creditRows as $row) {
            $type = $this->classifyCreditProduct(
                $row->ProductName,
                (int) $row->IsMortgage,
                (int) $row->IsConsumer
            );
            $creditsByCustomer[(int) $row->CustomerID][$type] = true;
        }

        // 7. Денежные переводы клиентов (MoneyTransfers)
        $transfersByCustomer = [];
        if (Schema::hasTable('MoneyTransfers')) {
            $transferRows = DB::table('MoneyTransfers as mt')
                ->where(function ($q) use ($customerIds) {
                    $q->whereIn('mt.SenderCustomerID', $customerIds)
                        ->orWhereIn('mt.ReceiverCustomerID', $customerIds);
                })
                ->select([
                    'mt.SenderCustomerID',
                    'mt.ReceiverCustomerID',
                    'mt.DirectionTypeID',
                    'mt.MoneySystemID',
                    'mt.PaymentCode',
                ])
                ->get();

            $systemNames = [
                1 => 'Золотая Корона',
                2 => 'Юнистрим',
                3 => 'Contact / Ria',
                4 => 'Western Union',
                5 => 'Внутрибанковский',
            ];

            $customerIdSet = array_flip($customerIds);

            foreach ($transferRows as $row) {
                $sysId   = (int) $row->MoneySystemID;
                $sysName = $systemNames[$sysId] ?? "Система #{$sysId}";
                $code    = (string) ($row->PaymentCode ?? '');

                $receiverId = $row->ReceiverCustomerID !== null ? (int) $row->ReceiverCustomerID : null;
                $senderId   = $row->SenderCustomerID !== null ? (int) $row->SenderCustomerID : null;

                if ($receiverId !== null && isset($customerIdSet[$receiverId])) {
                    $transfersByCustomer[$receiverId]['in'] = ($transfersByCustomer[$receiverId]['in'] ?? 0) + 1;
                    $transfersByCustomer[$receiverId]['systems'][$sysName] = ($transfersByCustomer[$receiverId]['systems'][$sysName] ?? 0) + 1;
                }

                if ($senderId !== null && isset($customerIdSet[$senderId])) {
                    if (str_starts_with($code, 'MT-LOC') || (int) $row->DirectionTypeID === 3) {
                        $transfersByCustomer[$senderId]['loc'] = ($transfersByCustomer[$senderId]['loc'] ?? 0) + 1;
                    } else {
                        $transfersByCustomer[$senderId]['out'] = ($transfersByCustomer[$senderId]['out'] ?? 0) + 1;
                    }
                    $transfersByCustomer[$senderId]['systems'][$sysName] = ($transfersByCustomer[$senderId]['systems'][$sysName] ?? 0) + 1;
                }
            }
        }

        // 8. Формирование итогового массива для дашборда
        $clients = $customers->map(function ($c) use ($creditsByCustomer, $depositsByCustomer, $transfersByCustomer) {
            $age = $c->dob ? Carbon::parse($c->dob)->age : null;
            $cid = (int) $c->id;
            $tr  = $transfersByCustomer[$cid] ?? ['in' => 0, 'out' => 0, 'loc' => 0, 'systems' => []];

            return [
                'id'              => $cid,
                'fio'             => $c->fio !== '' ? $c->fio : "Клиент #{$cid}",
                'sex'             => $c->sex !== null ? (int) $c->sex : 0,
                'age'             => $age,
                'ageGroup'        => $this->ageBucket($age),
                'family'          => $c->family,
                'education'       => $c->education,
                'city'            => $c->city,
                'district'        => $c->city !== 'Не указан' ? "{$c->city}, {$c->district}" : $c->district,
                'rawDistrict'     => $c->district,
                'branch'          => $c->branch,
                'credits'         => isset($creditsByCustomer[$cid]) ? array_keys($creditsByCustomer[$cid]) : [],
                'deposits'        => isset($depositsByCustomer[$cid]) ? array_keys($depositsByCustomer[$cid]) : [],
                'transfersIn'     => $tr['in'] ?? 0,
                'transfersOut'    => $tr['out'] ?? 0,
                'transfersLoc'    => $tr['loc'] ?? 0,
                'transferSystems' => $tr['systems'] ?? [],
            ];
        })->values();

        return response()->json([
            'source'  => 'MySQL · ClientsDB',
            'filters' => [
                'branches' => $branches,
                'cities'   => $cities,
            ],
            'clients' => $clients,
        ]);
    }

    private function ageBucket(?int $age): string
    {
        if ($age === null) return 'Не указан';
        if ($age < 20) return 'до 20';
        if ($age < 25) return '20-25';
        if ($age < 35) return '25-35';
        if ($age < 45) return '35-45';
        if ($age < 55) return '45-55';
        return '55 и старше';
    }

    private function classifyCreditProduct(?string $name, int $isMortgage, int $isConsumer): string
    {
        $n = mb_strtolower($name ?? '');

        if ($isMortgage === 1 || str_contains($n, 'ипотек')) {
            return 'Ипотека';
        }
        if (str_contains($n, 'агро') || str_contains($n, 'фермер') || str_contains($n, 'сельхоз')) {
            return 'Агро';
        }
        if (str_contains($n, 'бизнес') || str_contains($n, 'предприним') || str_contains($n, 'торгов')) {
            return 'Бизнес';
        }
        if ($isConsumer === 1 || str_contains($n, 'потреб')) {
            return 'Потребительский';
        }

        return 'Потребительский';
    }

    private function classifyDepositType(?string $accountNo, ?string $accName, ?int $period): string
    {
        $cleanNo = preg_replace('/\D+/', '', (string) $accountNo);

        if (strlen($cleanNo) >= 5) {
            $code = (int) substr($cleanNo, 0, 5);

            if ($code >= 20202 && $code <= 20214) {
                return 'До востребования';
            }
            if (in_array($code, [20216, 20218, 20226, 20228], true)) {
                return 'Сберегательный';
            }
            if (in_array($code, [20220, 20222, 20230, 20232], true)) {
                return 'Срочный';
            }
        }

        $n = mb_strtolower($accName ?? '');
        if (str_contains($n, 'востреб') || $period === 0) {
            return 'До востребования';
        }
        if (str_contains($n, 'сберег') || str_contains($n, 'накоп')) {
            return 'Сберегательный';
        }

        return 'Срочный';
    }
}
