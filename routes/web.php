<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BancoController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('bancos', BancoController::class);
Route::get('balances/create', [BalanceController::class, 'create'])->name('balances.create');
Route::resource('balances', BalanceController::class)->except(['create']);
Route::resource('movimientos', MovimientoController::class);
// Rutas de reportes de auditoría (definir antes del resource para evitar conflictos)
Route::prefix('auditorias')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/reportes', [AuditoriaController::class, 'reportes'])->name('auditorias.reportes');
    Route::get('/generar-reporte', [AuditoriaController::class, 'generarReportePdf'])->name('auditorias.generar-reporte-pdf');
});

// Ruta resource para auditorías
Route::resource('auditorias', AuditoriaController::class)
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/data', [DashboardController::class, 'getChartData'])->name('dashboard.data');

/* Rutas protegidas con auth:sanctum (solo para usuarios autenticados)
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('bancos', BancoController::class);
    Route::resource('balances', BalanceController::class)->except(['create']);
    Route::get('balances/create', [BalanceController::class, 'create'])->name('balances.create');
});
*/

require __DIR__.'/auth.php';
