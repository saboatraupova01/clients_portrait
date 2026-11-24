<?php


use App\Http\Controllers\ClientPortraitController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ClientPortraitController::class, 'index'])->name('client-portrait.index');
Route::get('/api/client-portrait/data', [ClientPortraitController::class, 'data'])
    ->name('client-portrait.data');
