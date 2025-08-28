<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Banco;
use App\Models\Balance;
use App\Models\Auditoria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MovimientoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
 use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Facades\Log;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingresos = Movimiento::with('bancoReceptor')
            ->whereNull('banco_emisor_id')
            ->whereNotNull('banco_receptor_id')
            ->paginate(10, ['*'], 'ingresos');

        $egresos = Movimiento::whereNotNull('banco_emisor_id')
                        ->whereNull('banco_receptor_id')
                        ->paginate(10, ['*'], 'egresos');

        $transferencias = Movimiento::whereNotNull('banco_emisor_id')
                        ->whereNotNull('banco_receptor_id')
                        ->whereColumn('banco_emisor_id', '<>', 'banco_receptor_id')
                        ->paginate(10, ['*'], 'transferencias');

        $movimientos = Movimiento::with('bancoReceptor')->get();                

        return view('movimiento.index', compact('ingresos', 'egresos', 'transferencias', 'movimientos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $movimiento = new Movimiento();
        $bancos = Banco::all();

        return view('movimiento.create', compact('movimiento', 'bancos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_movimiento' => ['required', 'in:ingreso,egreso,transferencia'],
            'monto' => ['required', 'numeric', 'min:0.01'],
            'fecha' => ['required', 'date'],
            'motivo' => ['nullable', 'string'],

            // campos banco_emisor y banco_receptor validados según tipo:
            'banco_emisor_id' => [
                function ($attribute, $value, $fail) use ($request) {
                    $tipo = $request->input('tipo_movimiento');
                    if ($tipo === 'egreso' || $tipo === 'transferencia') {
                        if (empty($value)) {
                            $fail('El banco emisor es obligatorio para ' . $tipo);
                        }
                    } elseif ($tipo === 'ingreso' && !empty($value)) {
                        $fail('El banco emisor debe estar vacío para ingreso');
                    }
                }
            ],
            'banco_receptor_id' => [
                function ($attribute, $value, $fail) use ($request) {
                    $tipo = $request->input('tipo_movimiento');
                    if ($tipo === 'ingreso' || $tipo === 'transferencia') {
                        if (empty($value)) {
                            $fail('El banco receptor es obligatorio para ' . $tipo);
                        }
                    } elseif ($tipo === 'egreso' && !empty($value)) {
                        $fail('El banco receptor debe estar vacío para egreso');
                    }
                }
            ],
        ]);

        // Validar que en transferencia, los bancos sean diferentes
        if ($request->tipo_movimiento === 'transferencia' &&
            $request->input('banco_emisor_id') == $request->input('banco_receptor_id')) {
            return back()
                ->withErrors(['banco_receptor_id' => 'Banco receptor debe ser diferente al banco emisor en transferencia'])
                ->withInput();
        }

        DB::transaction(function() use ($request) {
            // Guardar movimiento con el usuario autenticado
            $movimiento = Movimiento::create([
                'tipo_movimiento' => $request->tipo_movimiento,
                'monto' => $request->monto,
                'banco_emisor_id' => $request->banco_emisor_id,
                'banco_receptor_id' => $request->banco_receptor_id,
                'fecha' => $request->fecha,
                'motivo' => $request->motivo,
                'user_id' => auth()->id(),
            ]);

            $movimiento->load(['bancoEmisor.latestBalance', 'bancoReceptor.latestBalance']);

            if ($movimiento->tipo_movimiento === 'ingreso') {
                // Solo banco receptor suma monto
                $balance = $movimiento->bancoReceptor->latestBalance; 
                Log::info("balance: " . $balance);

                $saldoAnterior = $balance ? $balance->monto_actual : 0;
                Log::info("saldo anterior: " . $saldoAnterior);

                if ($balance) {
                    $balance->monto_actual += $movimiento->monto;
                } else {
                    // Si no tiene balance crear uno nuevo
                    $balance = new Balance([
                        'banco_id' => $movimiento->banco_receptor_id,
                        'monto_actual' => $movimiento->monto,
                    ]);
                }
                $balance->ult_modificacion = now();
                $balance->save();

                Auditoria::create([
                    'movimiento_id' => $movimiento->id,
                    'saldo_anterior' => $saldoAnterior,
                    'saldo_nuevo' => $balance->monto_actual,
                    'fecha_registro' => now(),
                ]);

            } elseif ($movimiento->tipo_movimiento === 'egreso') {
                // Solo banco emisor resta monto
                $balance = $movimiento->bancoEmisor->latestBalance;

                $saldoAnterior = $balance ? $balance->monto_actual : 0;

                if (!$balance || $balance->monto_actual < $movimiento->monto) {
                    throw new \Exception('Saldo insuficiente para egreso.');
                }
                $balance->monto_actual -= $movimiento->monto;
                $balance->ult_modificacion = now();
                $balance->save();

                Auditoria::create([
                    'movimiento_id' => $movimiento->id,
                    'saldo_anterior' => $saldoAnterior,
                    'saldo_nuevo' => $balance->monto_actual,
                    'fecha_registro' => now(),
                ]);

            } elseif ($movimiento->tipo_movimiento === 'transferencia') {
                // Banco emisor resta, banco receptor suma
                $balanceEmisor = $movimiento->bancoEmisor->latestBalance;
                $balanceReceptor = $movimiento->bancoReceptor->latestBalance;

                if (!$balanceEmisor || $balanceEmisor->monto_actual < $movimiento->monto) {
                    throw new \Exception('Saldo insuficiente para transferencia.');
                }

                // Guardar saldos anteriores
                $saldoAnteriorEmisor = $balanceEmisor->monto_actual;
                $saldoAnteriorReceptor = $balanceReceptor ? $balanceReceptor->monto_actual : 0;

                // Restar emisor
                $balanceEmisor->monto_actual -= $movimiento->monto;
                $balanceEmisor->ult_modificacion = now();
                $balanceEmisor->save();

                // Sumar receptor
                if (!$balanceReceptor) {
                    $balanceReceptor = new Balance([
                        'banco_id' => $movimiento->banco_receptor_id,
                        'monto_actual' => 0,
                    ]);
                }
                $balanceReceptor->monto_actual += $movimiento->monto;
                $balanceReceptor->ult_modificacion = now();
                $balanceReceptor->save();

                // Crear auditoria para emisor
                Auditoria::create([
                    'movimiento_id' => $movimiento->id,
                    //'banco_id' => $balanceEmisor->banco_id,
                    //'tipo_movimiento' => 'transferencia-emisor',
                    'saldo_anterior' => $saldoAnteriorEmisor,
                    'saldo_nuevo' => $balanceEmisor->monto_actual,
                    'fecha_registro' => now(),
                ]);

                // Crear auditoria para receptor
                Auditoria::create([
                    'movimiento_id' => $movimiento->id,
                    //'banco_id' => $balanceReceptor->banco_id,
                    //'tipo_movimiento' => 'transferencia-receptor',
                    'saldo_anterior' => $saldoAnteriorReceptor,
                    'saldo_nuevo' => $balanceReceptor->monto_actual,
                    'fecha_registro' => now(),
                ]);
            }

        });

        return Redirect::route('movimientos.index')
            ->with('success', 'Movimiento creado Satisfactoriamente');
    }
}
