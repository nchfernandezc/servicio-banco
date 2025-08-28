<?php

namespace App\Models;

use App\Interfaces\InterfazServicioBanco;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * Class Banco
 *
 * @property $id
 * @property $nombre
 * @property $tipo_cuenta
 * @property $numero_cuenta
 * @property $moneda
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Banco extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'tipo_cuenta', 'numero_cuenta', 'moneda', 'cuenta_banco'];

    public function balances()
    {
        return $this->hasMany(Balance::class);
    }

    /*
    public function balance()
    {
        return $this->hasOne(Balance::class, 'banco_id');
    }
    */

    public function latestBalance()
    {
        return $this->hasOne(Balance::class, 'banco_id')->latestOfMany('ult_modificacion');
    }

    public function movimientos()
    {
        return Movimiento::where(function($query) {
            $query->where('banco_emisor_id', $this->id)
                  ->orWhere('banco_receptor_id', $this->id);
        });
    }

    public function obtenerBalanceBanco()
    {
        try {
            Log::info('Cuenta: ' . $this->numero_cuenta);

            if (empty($this->numero_cuenta) || strlen($this->numero_cuenta) < 4) {
                Log::error("Cuenta inválida o muy corta: " . $this->numero_cuenta);
                return null;
            }

            $servicioBanco = app(InterfazServicioBanco::class);

            $codigo_banco = substr($this->numero_cuenta, 0, 4);
            Log::info('Codigo banco: ' . $codigo_banco);

            $balance = $servicioBanco->obtenerBalance($codigo_banco, $this->numero_cuenta);
            Log::info('Balance obtenido: ' . $balance);

            return $balance;

        } catch (\Exception $e) {
            Log::error('Error en obtenerBalanceBanco: ' . $e->getMessage());
            return null;
        }
    }

    public function actualizarBalanceBanco()
    {
        Log::info('Iniciando actualizarBalanceBanco');

        $balance = $this->obtenerBalanceBanco();

        Log::info('Balance recibido en actualizarBalanceBanco: ' . $balance);

        if ($balance !== null) {
            if ($this->monto_actual) {
                $this->monto_actual->update(['monto_actual' => $balance]);
                Log::info('Monto actual actualizado');
            } else {
                Balance::create([
                    'banco_id' => $this->id,
                    'monto_actual' => $balance,
                    'ult_modificacion' => now()
                ]);
                Log::info('Nuevo balance creado');
            }
        } else {
            Log::warning('Balance nulo en actualizarBalanceBanco');
        }

        return $balance;
    }
}
