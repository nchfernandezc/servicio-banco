<?php

namespace App\Services;

use App\Interfaces\InterfazServicioBanco;
use App\Models\Movimiento;
use Illuminate\Support\Facades\Log;
use Livewire\Features\SupportComputed\IssetComputedPropertyStub;

/**
 * Class ServicioBanco.
 */
class ServicioBanco implements InterfazServicioBanco
{
    protected $dataPath;

    public function __construct()
    {
        $this->dataPath = storage_path('app/bancos/');
    }

    public function obtenerBalance($codigo_banco, $numero_cuenta)
    {
        Log::info("obtenerBalance llamado con codigo_banco: {$codigo_banco}, numero_cuenta: {$numero_cuenta}");

        $data = $this->cargarDatosBanco($codigo_banco);

        if (!isset($data['cuentas'][$numero_cuenta])) {
            Log::error("Cuenta no encontrada: {$numero_cuenta} en banco: {$codigo_banco}");
            throw new \Exception("Cuenta no encontrada: {$numero_cuenta}");
        }

        Log::info("Balance encontrado para cuenta {$numero_cuenta}: " . $data['cuentas'][$numero_cuenta]['monto_actual']);

        return $data['cuentas'][$numero_cuenta]['monto_actual'];
    }

    public function cargarDatosBanco($codigo_banco)
    {
        $filePath = $this->dataPath . $codigo_banco . '.json';
        Log::info("cargarDatosBanco intentando cargar archivo: {$filePath}");

        if (!file_exists($filePath)) {
            Log::error("Archivo no encontrado para banco {$codigo_banco}: {$filePath}");
            throw new \Exception("Datos de cuenta no encontrada para banco: {$codigo_banco}");
        }

        $content = file_get_contents($filePath);
        $json = json_decode($content, true);

        if ($json === null) {
            Log::error("Error decodificando JSON desde archivo: {$filePath}");
            throw new \Exception("Datos JSON inválidos para banco: {$codigo_banco}");
        }

        Log::info("Datos JSON cargados correctamente para banco: {$codigo_banco}");

        return $json;
    }

    public function procesarMovimientos($codigo_banco){
        Log::info("procesarMovimientos INICIO para banco: {$codigo_banco}");
        $data = $this->cargarDatosBanco($codigo_banco);
        $creados = 0;
        if (isset($data['cuentas'])) {
            foreach ($data['cuentas'] as $numCuenta => $cuenta) {
                $lista = [];
                if (!empty($cuenta['movimiento']) && is_array($cuenta['movimiento'])) {
                    $lista = $cuenta['movimiento'];
                } elseif (!empty($cuenta['movimientos']) && is_array($cuenta['movimientos'])) {
                    $lista = $cuenta['movimientos'];
                }

                if (!empty($lista)) {
                    foreach ($lista as $mov) {
                        // Resolver banco por numero de cuenta
                        $banco = \App\Models\Banco::where('numero_cuenta', $numCuenta)->first();
                        $bancoId = $banco?->id;
                        if (!$bancoId) {
                            Log::warning("No se encontró Banco con numero_cuenta {$numCuenta} para asociar movimiento.");
                        }

                        // Preparar datos y normalizar tipo movimiento
                        $tipoRaw = $mov['tipo'] ?? null;
                        $tipo = $tipoRaw ? strtolower(trim($tipoRaw)) : null;

                        // Mapa para aceptar variantes comunes
                        $mapaTipos = [
                            'ingreso' => 'ingreso',
                            'entrada' => 'ingreso',
                            'deposito' => 'ingreso',
                            'egreso' => 'egreso',
                            'salida' => 'egreso',
                            'retiro' => 'egreso',
                            'transferencia' => 'transferencia',
                            'transfer' => 'transferencia',
                            'traspaso' => 'transferencia'
                        ];

                        if ($tipo && isset($mapaTipos[$tipo])) {
                            $tipo = $mapaTipos[$tipo];
                        } else {
                            Log::error("Tipo de movimiento inválido '{$tipoRaw}' para cuenta {$numCuenta}. Debe ser ingreso, egreso o transferencia.");
                            continue;
                        }

                        $monto = $mov['monto'] ?? null;
                        $fecha = $mov['fecha'] ?? null;
                        $motivo = $mov['motivo'] ?? 'Importado desde JSON';

                        if ($monto === null || !$fecha) {
                            Log::error("Movimiento inválido (monto o fecha faltante) para cuenta {$numCuenta}: " . json_encode($mov));
                            continue;
                        }

                        // Determinar emisor/receptor según el tipo
                        $emisorId = null;
                        $receptorId = null;

                        if ($tipo === 'ingreso') {
                            $receptorId = $bancoId;
                        } elseif ($tipo === 'egreso') {
                            $emisorId = $bancoId;
                        } elseif ($tipo === 'transferencia') {
                            $emisorId = $bancoId;
                            // intentar resolver banco receptor por cuenta destino si existe
                            $destino = $mov['cuenta_destino'] ?? $mov['numero_cuenta_destino'] ?? null;
                            if ($destino) {
                                $bancoReceptor = \App\Models\Banco::where('numero_cuenta', $destino)->first();
                                $receptorId = $bancoReceptor?->id;
                            }
                        } else {
                            Log::error("Tipo de movimiento desconocido para asignación emisor/receptor: {$tipo}");
                            continue;
                        }

                        // Validar que no exista ya este movimiento para no duplicar
                        $existeMovimiento = Movimiento::when($emisorId, function ($q) use ($emisorId) {
                                $q->where('banco_emisor_id', $emisorId);
                            })
                            ->when($receptorId, function ($q) use ($receptorId) {
                                $q->where('banco_receptor_id', $receptorId);
                            })
                            ->where('tipo_movimiento', $tipo)
                            ->where('monto', $monto)
                            ->where('fecha', $fecha)
                            ->exists();

                        if (!$existeMovimiento) {
                            Movimiento::create([
                                'tipo_movimiento' => $tipo,
                                'monto' => $monto,
                                'banco_emisor_id' => $emisorId,
                                'banco_receptor_id' => $receptorId,
                                'fecha' => $fecha,
                                'motivo' => $motivo,
                            ]);
                            $creados++;
                        }
                    }
                }
            }
        }
        Log::info("procesarMovimientos({$codigo_banco}) - movimientos creados: {$creados}");
        return true;
    }

}
