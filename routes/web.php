<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BancoController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\AuditoriaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('bancos', BancoController::class);
Route::get('balances/create', [BalanceController::class, 'create'])->name('balances.create');
Route::resource('balances', BalanceController::class)->except(['create']);
Route::resource('movimientos', MovimientoController::class);
Route::resource('auditorias', AuditoriaController::class)
    ->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
