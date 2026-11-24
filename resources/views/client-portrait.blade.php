<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Портрет клиента — Банк Арванд</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f1f5f9;
            --bg-accent: radial-gradient(circle at 0% 0%, rgba(16, 185, 129, 0.06) 0%, transparent 42%),
            radial-gradient(circle at 100% 0%, rgba(37, 137, 245, 0.06) 0%, transparent 45%);
            --card: #ffffff;
            --border: #e2e8f0;
            --border-hover: #cbd5e1;
            --text: #0f172a;
            --text-secondary: #334155;
            --muted: #64748b;
            --primary: #0d9488;
            --primary-dark: #0f766e;
            --primary-light: #f0fdfa;
            --blue: #2563eb;
            --blue-soft: #eff6ff;
            --orange: #f97316;
            --orange-soft: #fff7ed;
            --emerald: #10b981;
            --violet: #7c3aed;
            --violet-soft: #f5f3ff;
            --radius: 16px;
            --radius-sm: 10px;
            --shadow-sm: 0 1px 2px rgba(15, 23, 42, 0.04);
            --shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.05), 0 1px 3px rgba(15, 23, 42, 0.03);
            --shadow-hover: 0 10px 25px -5px rgba(15, 23, 42, 0.08), 0 4px 10px -4px rgba(15, 23, 42, 0.04);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 0 0 48px;
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg);
            background-image: var(--bg-accent);
            color: var(--text);
            font-size: 13.5px;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        .topbar {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 40;
            padding: 14px 24px;
            margin-bottom: 22px;
        }

        .topbar-inner {
            max-width: 1340px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .brand-block {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .brand-logo {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            background: linear-gradient(135deg, #0d8494 0%, #059691 100%);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 17px;
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.28);
            flex-shrink: 0;
        }

        .title-group h1 {
            margin: 0;
            font-size: 19px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--text);
            line-height: 1.2;
        }

        .title-group .subtitle {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px;
        }

        .badges-row {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f8fafc;
            color: var(--text-secondary);
            font-size: 12px;
            padding: 5px 11px;
            border-radius: 999px;
            font-weight: 500;
            border: 1px solid var(--border);
        }

        .badge-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #94a3b8;
        }

        .badge.live {
            background: #ecfdf5;
            color: #065f46;
            border-color: #a7f3d0;
        }
        .badge.live .badge-dot {
            background: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }

        .badge.error {
            background: #fef2f2;
            color: #991b1b;
            border-color: #fecaca;
        }
        .badge.error .badge-dot {
            background: #ef4444;
        }

        .container {
            max-width: 1340px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .filters-panel {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 16px 20px;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .filters-controls {
            display: flex;
            align-items: flex-end;
            gap: 14px;
            flex-wrap: wrap;
            flex: 1;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            min-width: 185px;
        }

        .filter-group label {
            font-size: 11.5px;
            color: var(--muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        select, input[type="text"] {
            height: 38px;
            padding: 0 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            background: #f8fafc;
            color: var(--text);
            font-family: inherit;
            font-size: 13px;
            font-weight: 500;
            outline: none;
            transition: all 0.18s ease;
        }

        select:hover, input[type="text"]:hover {
            border-color: var(--border-hover);
            background: #fff;
        }

        select:focus, input[type="text"]:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.12);
        }

        .filter-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn {
            height: 38px;
            padding: 0 18px;
            border-radius: var(--radius-sm);
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.18s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
            color: #fff;
            box-shadow: 0 2px 6px rgba(13, 148, 136, 0.25);
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.32);
        }
        .btn-primary:active { transform: translateY(0); }

        .btn-secondary {
            background: #fff;
            color: var(--text-secondary);
            border-color: var(--border);
        }
        .btn-secondary:hover {
            background: #f8fafc;
            border-color: var(--border-hover);
            color: var(--text);
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 18px;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow);
            transition: box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .card:hover {
            border-color: #d5dee8;
            box-shadow: var(--shadow-hover);
        }

        .kpi-card {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .kpi-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .kpi-title {
            font-size: 12.5px;
            color: var(--muted);
            font-weight: 600;
        }

        .kpi-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .kpi-icon.teal { background: #f0fdfa; color: #0d9488; }
        .kpi-icon.blue { background: #eff6ff; color: #2563eb; }
        .kpi-icon.orange { background: #fff7ed; color: #ea580c; }
        .kpi-icon.violet { background: #f5f3ff; color: #7c3aed; }

        .kpi-value {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.025em;
            line-height: 1.1;
            color: var(--text);
            margin-bottom: 6px;
        }

        .kpi-sub {
            font-size: 12px;
            color: var(--muted);
            font-weight: 500;
        }

        .gender-card { margin-bottom: 18px; }
        .gender-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .card-title {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: -0.01em;
            margin: 0;
            color: var(--text);
        }

        .stacked-bar {
            display: flex;
            height: 14px;
            border-radius: 999px;
            overflow: hidden;
            background: #e2e8f0;
            margin-bottom: 14px;
            gap: 2px;
        }
        .stacked-male {
            background: linear-gradient(90deg, #2563eb 0%, #3b82f6 100%);
            transition: width 0.45s cubic-bezier(0.22, 1, 0.36, 1);
            border-radius: 999px 0 0 999px;
        }
        .stacked-female {
            background: linear-gradient(90deg, #f97316 0%, #fb923c 100%);
            transition: width 0.45s cubic-bezier(0.22, 1, 0.36, 1);
            border-radius: 0 999px 999px 0;
        }

        .gender-legend {
            display: flex;
            gap: 24px;
            font-size: 13px;
            color: var(--text-secondary);
            flex-wrap: wrap;
        }
        .legend-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f8fafc;
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
        }
        .dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 3px;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .chart-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .chart-card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .chart-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .chart-bar {
            transition: opacity 0.18s ease, filter 0.18s ease;
            cursor: pointer;
        }
        .chart-bar:hover {
            opacity: 0.85;
            filter: brightness(1.06);
        }

        .toggle-table {
            margin-top: 12px;
            padding: 6px 10px;
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-secondary);
            font-family: inherit;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            align-self: flex-start;
            transition: all 0.15s ease;
        }
        .toggle-table:hover {
            color: var(--primary-dark);
            border-color: #99f6e4;
            background: var(--primary-light);
        }

        .mini-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            font-size: 12px;
            display: none;
            background: #f8fafc;
            border-radius: 8px;
            overflow: hidden;
        }
        .mini-table.open { display: table; }
        .mini-table th, .mini-table td {
            padding: 7px 10px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }
        .mini-table th {
            color: var(--muted);
            font-weight: 600;
            background: #f1f5f9;
        }
        .mini-table td:last-child, .mini-table th:last-child { text-align: right; }

        .clients-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .clients-header {
            display: flex;
            align-items: baseline;
            gap: 10px;
            flex-wrap: wrap;
        }
        .clients-header h2 {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
        }
        .clients-header span {
            font-size: 12.5px;
            color: var(--muted);
        }

        .search-row {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .search-row input {
            width: 260px;
        }

        .table-scroll {
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        table.clients-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12.5px;
        }
        table.clients-table th {
            text-align: left;
            padding: 11px 14px;
            background: #f8fafc;
            color: var(--muted);
            font-weight: 600;
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        table.clients-table td {
            padding: 10px 14px;
            border-bottom: 1px solid #f1f5f9;
            white-space: nowrap;
            color: var(--text-secondary);
        }
        table.clients-table tbody tr:last-child td { border-bottom: none; }
        table.clients-table tbody tr:hover td { background: #f8fafc; }

        .client-id {
            font-variant-numeric: tabular-nums;
            font-weight: 600;
            color: var(--muted);
        }
        .client-fio {
            font-weight: 600;
            color: var(--text);
        }

        .sex-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 700;
        }
        .sex-pill.male { background: var(--blue-soft); color: var(--blue); }
        .sex-pill.female { background: var(--orange-soft); color: var(--orange); }

        .prod-tags {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }
        .prod-tag {
            display: inline-flex;
            align-items: center;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 600;
        }
        .prod-tag.credit {
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #dbeafe;
        }
        .prod-tag.deposit {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #d1fae5;
        }
        .prod-tag.transfer {
            background: #f5f3ff;
            color: #6d28d9;
            border: 1px solid #ede9fe;
        }

        .footer-note {
            margin-top: 18px;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 12px;
            color: var(--muted);
            line-height: 1.5;
        }

        .chart-tooltip {
            position: fixed;
            pointer-events: none;
            background: #0f172a;
            color: #fff;
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.25);
            opacity: 0;
            transform: translateY(4px);
            transition: opacity 0.12s ease, transform 0.12s ease;
            z-index: 100;
            white-space: nowrap;
        }
        .chart-tooltip.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 1100px) {
            .kpi-grid { grid-template-columns: repeat(2, 1fr); }
            .charts-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 680px) {
            .kpi-grid { grid-template-columns: 1fr; }
            .charts-grid { grid-template-columns: 1fr; }
            .container { padding: 0 14px; }
            .topbar { padding: 12px 14px; }
            .search-row { width: 100%; }
            .search-row input { flex: 1; width: auto; }
        }
    </style>
</head>
<body>

<div id="chartTooltip" class="chart-tooltip"></div>

<header class="topbar">
    <div class="topbar-inner">
        <div class="brand-block">
            <div class="brand-logo">А</div>
            <div class="title-group">
                <h1>Портрет клиента</h1>
                <div class="subtitle">Аналитический срез клиентской базы и продуктового портфеля</div>
            </div>
        </div>
        <div class="badges-row">
            <span class="badge">Физические лица</span>
            <span id="dbStatusBadge" class="badge">
        <span class="badge-dot"></span>
        <span id="dbStatusText">подключение к БД...</span>
      </span>
        </div>
    </div>
</header>

<div class="container">
    <div class="filters-panel">
        <div class="filters-controls">
            <div class="filter-group">
                <label for="branchSelect">Филиал</label>
                <select id="branchSelect"><option value="Все филиалы">Все филиалы</option></select>
            </div>
            <div class="filter-group">
                <label for="citySelect">Город</label>
                <select id="citySelect"><option value="Все города">Все города</option></select>
            </div>
            <div class="filter-group">
                <label for="sexSelect">Пол</label>
                <select id="sexSelect">
                    <option value="all">Все клиенты</option>
                    <option value="1">Мужчины</option>
                    <option value="0">Женщины</option>
                </select>
            </div>
        </div>
        <div class="filter-actions">
            <button class="btn btn-primary" id="applyBtn">Применить</button>
            <button class="btn btn-secondary" id="resetBtn">Сбросить</button>
        </div>
    </div>

    <div class="kpi-grid">
        <div class="card kpi-card">
            <div class="kpi-top">
                <div class="kpi-title">Всего клиентов</div>
                <div class="kpi-icon teal">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>
            <div>
                <div class="kpi-value" id="kpiTotal">—</div>
                <div class="kpi-sub">физ. лица по выбранному фильтру</div>
            </div>
        </div>

        <div class="card kpi-card">
            <div class="kpi-top">
                <div class="kpi-title">Средний возраст</div>
                <div class="kpi-icon violet">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
            </div>
            <div>
                <div class="kpi-value" id="kpiAvgAge">—</div>
                <div class="kpi-sub">полных лет по выборке</div>
            </div>
        </div>

        <div class="card kpi-card">
            <div class="kpi-top">
                <div class="kpi-title">С активным кредитом</div>
                <div class="kpi-icon blue">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                </div>
            </div>
            <div>
                <div class="kpi-value" id="kpiCreditCount">—</div>
                <div class="kpi-sub" id="kpiCreditPct">0% клиентов</div>
            </div>
        </div>

        <div class="card kpi-card">
            <div class="kpi-top">
                <div class="kpi-title">С активным депозитом</div>
                <div class="kpi-icon orange">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 5c-1.5 0-2.8 1.4-3 2-3.5-1.5-11-.3-11 5 0 1.8 0 3 2 4.5V20h4v-2h3v2h4v-4c1-.5 1.7-1 2-2h2v-4h-2c0-1-.5-1.5-1-2V5z"/></svg>
                </div>
            </div>
            <div>
                <div class="kpi-value" id="kpiDepositCount">—</div>
                <div class="kpi-sub" id="kpiDepositPct">0% клиентов</div>
            </div>
        </div>
    </div>

    <div class="card gender-card">
        <div class="gender-header">
            <h2 class="card-title">Гендерная структура</h2>
            <div class="gender-legend">
                <div class="legend-item">
                    <span class="dot" style="background: #2563eb"></span>
                    <span>Мужчины: <strong id="maleStat">0</strong> (<span id="malePct">0%</span>)</span>
                </div>
                <div class="legend-item">
                    <span class="dot" style="background: #f97316"></span>
                    <span>Женщины: <strong id="femaleStat">0</strong> (<span id="femalePct">0%</span>)</span>
                </div>
            </div>
        </div>
        <div class="stacked-bar">
            <div class="stacked-male" id="maleBar" style="width: 50%"></div>
            <div class="stacked-female" id="femaleBar" style="width: 50%"></div>
        </div>
    </div>

    <div class="charts-grid">
        <div class="card chart-card">
            <div>
                <div class="chart-card-head">
                    <h2 class="card-title">Возраст</h2>
                </div>
                <div class="chart-wrap" id="chartAge"></div>
                <table class="mini-table" id="tableAge"></table>
            </div>
            <button class="toggle-table" data-target="tableAge">▸ Показать таблицей</button>
        </div>

        <div class="card chart-card">
            <div>
                <div class="chart-card-head">
                    <h2 class="card-title">Семейное положение</h2>
                </div>
                <div class="chart-wrap" id="chartFamily"></div>
                <table class="mini-table" id="tableFamily"></table>
            </div>
            <button class="toggle-table" data-target="tableFamily">▸ Показать таблицей</button>
        </div>

        <div class="card chart-card">
            <div>
                <div class="chart-card-head">
                    <h2 class="card-title">Образование</h2>
                </div>
                <div class="chart-wrap" id="chartEducation"></div>
                <table class="mini-table" id="tableEducation"></table>
            </div>
            <button class="toggle-table" data-target="tableEducation">▸ Показать таблицей</button>
        </div>

        <div class="card chart-card">
            <div>
                <div class="chart-card-head">
                    <h2 class="card-title">Город</h2>
                </div>
                <div class="chart-wrap" id="chartCity"></div>
                <table class="mini-table" id="tableCity"></table>
            </div>
            <button class="toggle-table" data-target="tableCity">▸ Показать таблицей</button>
        </div>

        <div class="card chart-card">
            <div>
                <div class="chart-card-head">
                    <h2 class="card-title">Улица</h2>
                </div>
                <div class="chart-wrap" id="chartDistrict"></div>
                <table class="mini-table" id="tableDistrict"></table>
            </div>
            <button class="toggle-table" data-target="tableDistrict">▸ Показать таблицей</button>
        </div>

        <div class="card chart-card">
            <div>
                <div class="chart-card-head">
                    <h2 class="card-title">Кредиты по типам</h2>
                </div>
                <div class="chart-wrap" id="chartCredits"></div>
                <table class="mini-table" id="tableCredits"></table>
            </div>
            <button class="toggle-table" data-target="tableCredits">▸ Показать таблицей</button>
        </div>

        <div class="card chart-card">
            <div>
                <div class="chart-card-head">
                    <h2 class="card-title">Депозиты по типам</h2>
                </div>
                <div class="chart-wrap" id="chartDeposits"></div>
                <table class="mini-table" id="tableDeposits"></table>
            </div>
            <button class="toggle-table" data-target="tableDeposits">▸ Показать таблицей</button>
        </div>

        <div class="card chart-card">
            <div>
                <div class="chart-card-head">
                    <h2 class="card-title">Денежные переводы</h2>
                </div>
                <div class="chart-wrap" id="chartTransfers"></div>
                <table class="mini-table" id="tableTransfers"></table>
            </div>
            <button class="toggle-table" data-target="tableTransfers">▸ Показать таблицей</button>
        </div>
    </div>

    <div class="card">
        <div class="clients-toolbar">
            <div class="clients-header">
                <h2>Реестр клиентов</h2>
                <span>(до 200 последних записей по фильтру)</span>
            </div>
            <div class="search-row">
                <input type="text" id="searchInput" placeholder="Поиск по ID клиента или ФИО..." />
                <button class="btn btn-secondary" id="searchBtn">Найти</button>
            </div>
        </div>

        <div class="table-scroll">
            <table class="clients-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>Пол</th>
                    <th>Возраст</th>
                    <th>Семейное положение</th>
                    <th>Образование</th>
                    <th>Город</th>
                    <th>Улица</th>
                    <th>Продукты и переводы</th>
                </tr>
                </thead>
                <tbody id="clientsBody"></tbody>
            </table>
        </div>
    </div>

    <div class="footer-note">
        <strong>Примечание:</strong> Возрастные группы считаются по нижней границе включительно (25–35 = от 25 до 34 полных лет). Пол: <code>Sex = 1</code> — мужской, <code>0</code> — женский. Город определяется по адресу проживания, если не указан — по адресу регистрации.
    </div>
</div>

<script>
    const API_URL = "{{ route('client-portrait.data') }}";
    let currentClients = [];
    let filtersInitialized = false;

    const fmtInt = (n) => Math.round(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    const fmtDec = (n) => n.toFixed(1).replace(".", ",");

    const tooltipEl = document.getElementById("chartTooltip");
    document.addEventListener("mousemove", (e) => {
        const bar = e.target.closest(".chart-bar");
        if (bar) {
            tooltipEl.textContent = bar.getAttribute("data-tip");
            tooltipEl.style.left = `${e.clientX + 12}px`;
            tooltipEl.style.top = `${e.clientY - 28}px`;
            tooltipEl.classList.add("visible");
        } else {
            tooltipEl.classList.remove("visible");
        }
    });

    function countBy(items, labels, getter) {
        const map = new Map(labels.map(l => [l, 0]));
        items.forEach(item => {
            const val = getter(item);
            if (Array.isArray(val)) {
                val.forEach(v => map.set(v, (map.get(v) || 0) + 1));
            } else {
                map.set(val, (map.get(val) || 0) + 1);
            }
        });
        return Array.from(map.entries()).map(([label, value]) => ({ label, value }));
    }

    function renderVerticalChart(containerId, tableId, data, colorStart = "#0d9488", colorEnd = "#14b8a6") {
        const container = document.getElementById(containerId);
        const total = data.reduce((s, d) => s + d.value, 0) || 1;
        const maxVal = Math.max(...data.map(d => d.value), 1);
        const step = Math.max(1, Math.ceil(maxVal / 5));
        const topTick = step * 5;
        const ticks = [0, step, step * 2, step * 3, step * 4, topTick];

        const gradId = `grad_${containerId}`;
        const w = 360, h = 220, padL = 34, padR = 10, padT = 14, padB = 48;
        const plotW = w - padL - padR, plotH = h - padT - padB;
        const colW = plotW / data.length;
        const barW = Math.min(24, colW * 0.56);

        let svg = `<svg viewBox="0 0 ${w} ${h}" width="100%" height="${h}">
      <defs>
        <linearGradient id="${gradId}" x1="0" y1="0" x2="0" y2="1">
          <stop offset="0%" stop-color="${colorStart}"/>
          <stop offset="100%" stop-color="${colorEnd}"/>
        </linearGradient>
      </defs>`;

        ticks.forEach(t => {
            const y = padT + plotH - (t / topTick) * plotH;
            svg += `<line x1="${padL}" y1="${y}" x2="${w - padR}" y2="${y}" stroke="#e2e8f0" stroke-dasharray="3 3" stroke-width="1"/>`;
            svg += `<text x="${padL - 6}" y="${y + 3}" text-anchor="end" font-size="9.5" fill="#94a3b8">${t}</text>`;
        });

        data.forEach((d, i) => {
            const barH = (d.value / topTick) * plotH;
            const x = padL + i * colW + (colW - barW) / 2;
            const y = padT + plotH - barH;
            const pct = ((d.value / total) * 100).toFixed(1);
            svg += `<rect class="chart-bar" data-tip="${d.label}: ${fmtInt(d.value)} (${pct}%)" x="${x}" y="${y}" width="${barW}" height="${barH}" rx="4" fill="url(#${gradId})"/>`;
            const lx = padL + i * colW + colW / 2;
            const ly = padT + plotH + 13;
            svg += `<text x="${lx}" y="${ly}" text-anchor="end" font-size="9.5" fill="#475569" transform="rotate(-30 ${lx} ${ly})">${d.label}</text>`;
        });
        svg += `</svg>`;
        container.innerHTML = svg;
        fillMiniTable(tableId, data);
    }

    function renderHorizontalChart(containerId, tableId, data, labelWidth = 115, colorStart = "#2563eb", colorEnd = "#0d9488") {
        const container = document.getElementById(containerId);
        if (!data.length) data = [{ label: "Нет данных", value: 0 }];
        const total = data.reduce((s, d) => s + d.value, 0) || 1;
        const maxVal = Math.max(...data.map(d => d.value), 1);
        const step = Math.max(1, Math.ceil(maxVal / 5));
        const topTick = step * 5;
        const ticks = [0, step, step * 2, step * 3, step * 4, topTick];

        const gradId = `grad_${containerId}`;
        const rowH = data.length > 7 ? 21 : 30;
        const padT = 8, padB = 24, padL = labelWidth, padR = 28;
        const w = 360;
        const plotH = Math.max(data.length * rowH, 84);
        const h = padT + plotH + padB;
        const plotW = w - padL - padR;

        let svg = `<svg viewBox="0 0 ${w} ${h}" width="100%" height="${h}">
      <defs>
        <linearGradient id="${gradId}" x1="0" y1="0" x2="1" y2="0">
          <stop offset="0%" stop-color="${colorStart}"/>
          <stop offset="100%" stop-color="${colorEnd}"/>
        </linearGradient>
      </defs>`;

        ticks.forEach(t => {
            const x = padL + (t / topTick) * plotW;
            svg += `<line x1="${x}" y1="${padT}" x2="${x}" y2="${padT + plotH}" stroke="#e2e8f0" stroke-dasharray="3 3" stroke-width="1"/>`;
            svg += `<text x="${x}" y="${padT + plotH + 15}" text-anchor="middle" font-size="9.5" fill="#94a3b8">${t}</text>`;
        });

        data.forEach((d, i) => {
            const y = padT + i * rowH + (rowH - 13) / 2;
            const barW = (d.value / topTick) * plotW;
            const shortLabel = d.label.length > 22 ? d.label.slice(0, 21) + "…" : d.label;
            const pct = ((d.value / total) * 100).toFixed(1);
            svg += `<text x="${padL - 8}" y="${y + 10}" text-anchor="end" font-size="10" fill="#475569">${shortLabel}</text>`;
            svg += `<rect class="chart-bar" data-tip="${d.label}: ${fmtInt(d.value)} (${pct}%)" x="${padL}" y="${y}" width="${barW}" height="13" rx="4" fill="url(#${gradId})"/>`;
            if (d.value > 0) {
                svg += `<text x="${padL + barW + 5}" y="${y + 10}" font-size="9" font-weight="600" fill="#64748b">${d.value}</text>`;
            }
        });
        svg += `</svg>`;
        container.innerHTML = svg;
        fillMiniTable(tableId, data);
    }

    function fillMiniTable(tableId, data) {
        const total = data.reduce((s, d) => s + d.value, 0) || 1;
        const tbl = document.getElementById(tableId);
        tbl.innerHTML = `
      <thead><tr><th>Категория</th><th>Кол-во</th><th>Доля</th></tr></thead>
      <tbody>
        ${data.map(d => `<tr><td>${d.label}</td><td>${fmtInt(d.value)}</td><td>${((d.value / total) * 100).toFixed(1)}%</td></tr>`).join("")}
      </tbody>
    `;
    }

    function renderDashboard(clients) {
        const total = clients.length;
        const validAges = clients.filter(c => c.age !== null && c.age !== undefined);
        const avgAge = validAges.length ? validAges.reduce((s, c) => s + c.age, 0) / validAges.length : 0;
        const withCredit = clients.filter(c => c.credits && c.credits.length > 0).length;
        const withDeposit = clients.filter(c => c.deposits && c.deposits.length > 0).length;

        document.getElementById("kpiTotal").textContent = fmtInt(total);
        document.getElementById("kpiAvgAge").textContent = fmtDec(avgAge);
        document.getElementById("kpiCreditCount").textContent = fmtInt(withCredit);
        document.getElementById("kpiCreditPct").textContent = `${total ? ((withCredit / total) * 100).toFixed(1) : "0.0"}% от выборки`;
        document.getElementById("kpiDepositCount").textContent = fmtInt(withDeposit);
        document.getElementById("kpiDepositPct").textContent = `${total ? ((withDeposit / total) * 100).toFixed(1) : "0.0"}% от выборки`;

        const males = clients.filter(c => c.sex === 1).length;
        const females = total - males;
        const malePct = total ? ((males / total) * 100).toFixed(1) : "0.0";
        const femalePct = total ? ((females / total) * 100).toFixed(1) : "0.0";
        document.getElementById("maleBar").style.width = `${malePct}%`;
        document.getElementById("femaleBar").style.width = `${femalePct}%`;
        document.getElementById("maleStat").textContent = fmtInt(males);
        document.getElementById("malePct").textContent = `${malePct}%`;
        document.getElementById("femaleStat").textContent = fmtInt(females);
        document.getElementById("femalePct").textContent = `${femalePct}%`;

        const ageLabels = ["до 20", "20-25", "25-35", "35-45", "45-55", "55 и старше", "Не указан"];
        renderVerticalChart("chartAge", "tableAge", countBy(clients, ageLabels, c => c.ageGroup), "#0d9488", "#2dd4bf");

        const familyLabels = ["Женат / замужем", "Холост / не замужем", "Разведен(а)", "Вдовец / вдова", "Не указано"];
        renderHorizontalChart("chartFamily", "tableFamily", countBy(clients, familyLabels, c => c.family), 115, "#0d9488", "#10b981");

        const eduLabels = ["Высшее", "Среднее", "Среднее специальное", "Неполное высшее", "Не указано"];
        renderHorizontalChart("chartEducation", "tableEducation", countBy(clients, eduLabels, c => c.education), 115, "#6366f1", "#8b5cf6");

        const cityCounts = new Map();
        clients.forEach(c => cityCounts.set(c.city, (cityCounts.get(c.city) || 0) + 1));
        const cityData = Array.from(cityCounts.entries())
            .map(([label, value]) => ({ label, value }))
            .sort((a, b) => b.value - a.value);
        renderHorizontalChart("chartCity", "tableCity", cityData.length ? cityData : [{ label: "Нет данных", value: 0 }], 95, "#0284c7", "#38bdf8");

        const districtCounts = new Map();
        clients.forEach(c => districtCounts.set(c.district, (districtCounts.get(c.district) || 0) + 1));
        const sortedDistricts = Array.from(districtCounts.entries()).sort((a, b) => b[1] - a[1]);
        const top10 = sortedDistricts.slice(0, 10).map(([label, value]) => ({ label, value }));
        const restSum = sortedDistricts.slice(10).reduce((s, [, v]) => s + v, 0);
        if (restSum > 0) top10.push({ label: "Остальные", value: restSum });
        renderHorizontalChart("chartDistrict", "tableDistrict", top10.length ? top10 : [{ label: "Нет данных", value: 0 }], 128, "#0f766e", "#14b8a6");

        const creditLabels = ["Потребительский", "Агро", "Бизнес", "Ипотека"];
        renderHorizontalChart("chartCredits", "tableCredits", countBy(clients, creditLabels, c => c.credits || []), 105, "#2563eb", "#60a5fa");

        const depositLabels = ["Срочный", "Сберегательный", "До востребования"];
        renderHorizontalChart("chartDeposits", "tableDeposits", countBy(clients, depositLabels, c => c.deposits || []), 105, "#ea580c", "#fb923c");

        let totalIn = 0;
        let totalOut = 0;
        let totalLoc = 0;
        const sysTotals = new Map();

        clients.forEach(c => {
            totalIn += (c.transfersIn || 0);
            totalOut += (c.transfersOut || 0);
            totalLoc += (c.transfersLoc || 0);
            if (c.transferSystems) {
                Object.entries(c.transferSystems).forEach(([sys, cnt]) => {
                    sysTotals.set(sys, (sysTotals.get(sys) || 0) + cnt);
                });
            }
        });

        const transfersChartData = [
            { label: "Входящие (MT-IN)", value: totalIn },
            { label: "Исходящие (MT-OUT)", value: totalOut },
            { label: "Локальные (MT-LOC)", value: totalLoc },
            ...Array.from(sysTotals.entries())
                .sort((a, b) => b[1] - a[1])
                .map(([label, value]) => ({ label, value }))
        ];
        renderHorizontalChart("chartTransfers", "tableTransfers", transfersChartData, 125, "#7c3aed", "#0d9488");
        renderClientsTable(clients);
    }

    function renderClientsTable(clients) {
        const q = document.getElementById("searchInput").value.trim().toLowerCase();
        const list = q
            ? clients.filter(c => String(c.id).includes(q) || c.fio.toLowerCase().includes(q))
            : clients;

        const slice = list.slice(0, 200);
        const tbody = document.getElementById("clientsBody");
        if (!slice.length) {
            tbody.innerHTML = `<tr><td colspan="9" style="text-align:center;color:#94a3b8;padding:24px;">Нет записей по выбранным фильтрам</td></tr>`;
            return;
        }

        tbody.innerHTML = slice.map(c => {
            const creditTags = (c.credits || []).map(x => `<span class="prod-tag credit">Кредит: ${x}</span>`);
            const depositTags = (c.deposits || []).map(x => `<span class="prod-tag deposit">Депозит: ${x}</span>`);
            const totalTr = (c.transfersIn || 0) + (c.transfersOut || 0) + (c.transfersLoc || 0);
            const transferTags = totalTr > 0
                ? [`<span class="prod-tag transfer">Переводы: ${totalTr}</span>`]
                : [];

            const allTags = [...creditTags, ...depositTags, ...transferTags];

            return `
        <tr>
          <td class="client-id">#${c.id}</td>
          <td class="client-fio">${c.fio}</td>
          <td><span class="sex-pill ${c.sex === 1 ? "male" : "female"}">${c.sex === 1 ? "М" : "Ж"}</span></td>
          <td>${c.age ?? "—"}</td>
          <td>${c.family}</td>
          <td>${c.education}</td>
          <td>${c.city}</td>
          <td>${c.rawDistrict}</td>
          <td>${allTags.length ? `<div class="prod-tags">${allTags.join("")}</div>` : `<span style="color:#94a3b8">—</span>`}</td>
        </tr>
      `;
        }).join("");
    }

    async function loadFromDatabase() {
        const badge = document.getElementById("dbStatusBadge");
        const statusText = document.getElementById("dbStatusText");
        const branch = document.getElementById("branchSelect").value;
        const city = document.getElementById("citySelect").value;
        const sex = document.getElementById("sexSelect").value;

        const params = new URLSearchParams();
        if (branch && branch !== "Все филиалы") params.set("branch", branch);
        if (city && city !== "Все города") params.set("city", city);
        if (sex && sex !== "all") params.set("sex", sex);

        try {
            badge.className = "badge";
            statusText.textContent = "загрузка из БД...";
            const res = await fetch(`${API_URL}?${params.toString()}`, {
                headers: { "Accept": "application/json" }
            });
            if (!res.ok) throw new Error(`HTTP ${res.status}`);
            const payload = await res.json();

            if (!filtersInitialized && payload.filters) {
                const bSel = document.getElementById("branchSelect");
                payload.filters.branches.forEach(b => {
                    const opt = document.createElement("option");
                    opt.value = b;
                    opt.textContent = b;
                    bSel.appendChild(opt);
                });

                const cSel = document.getElementById("citySelect");
                payload.filters.cities.forEach(c => {
                    const opt = document.createElement("option");
                    opt.value = c;
                    opt.textContent = c;
                    cSel.appendChild(opt);
                });
                filtersInitialized = true;
            }

            currentClients = payload.clients || [];
            badge.className = "badge live";
            statusText.textContent = `БД подключена · ${payload.source}`;
            renderDashboard(currentClients);
        } catch (err) {
            badge.className = "badge error";
            statusText.textContent = "ошибка загрузки данных из БД";
            console.error(err);
            renderDashboard([]);
        }
    }

    document.getElementById("applyBtn").addEventListener("click", loadFromDatabase);

    document.getElementById("resetBtn").addEventListener("click", () => {
        document.getElementById("branchSelect").value = "Все филиалы";
        document.getElementById("citySelect").value = "Все города";
        document.getElementById("sexSelect").value = "all";
        document.getElementById("searchInput").value = "";
        loadFromDatabase();
    });

    document.getElementById("searchBtn").addEventListener("click", () => renderClientsTable(currentClients));
    document.getElementById("searchInput").addEventListener("input", () => renderClientsTable(currentClients));

    document.querySelectorAll(".toggle-table").forEach(btn => {
        btn.addEventListener("click", () => {
            const tbl = document.getElementById(btn.dataset.target);
            const isOpen = tbl.classList.toggle("open");
            btn.textContent = isOpen ? "▾ Скрыть таблицу" : "▸ Показать таблицей";
        });
    });

    loadFromDatabase();
</script>
</body>
</html>
