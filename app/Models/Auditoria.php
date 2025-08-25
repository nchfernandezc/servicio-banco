<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Auditoria
 *
 * @property $id
 * @property $movimiento_id
 * @property $saldo_anterior
 * @property $saldo_nuevo
 * @property $fecha_registro
 * @property $created_at
 * @property $updated_at
 *
 * @property Movimiento $movimiento
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Auditoria extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['movimiento_id', 'saldo_anterior', 'saldo_nuevo', 'fecha_registro'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movimiento()
    {
        return $this->belongsTo(\App\Models\Movimiento::class, 'movimiento_id', 'id');
    }
    
}
