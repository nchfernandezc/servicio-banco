<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
Route::get('/banco/{banco_id}/balance', function ($banco_id) {
    $saldos = [
        '12345' => 1500.75,
        '6789' => 985.50,
        '1111' => 300.00
    ];
    $saldo = $saldos[$banco_id] ?? rand(100,5000) + (rand(0,99)/100);
    sleep(1);
    return response()->json([
        'banco_id' => $banco_id,
        'saldo' => $saldo,
        'moneda' => 'bolivares'
    ]);
});
*/


