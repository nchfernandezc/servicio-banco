<?php

namespace App\Services;

use App\Interfaces\InterfazServicioBanco;
use Illuminate\Support\Facades\Log;

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


}
