<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Movimiento
 *
 * @property $id
 * @property $tipo_movimiento
 * @property $monto
 * @property $banco_emisor_id
 * @property $banco_receptor_id
 * @property $fecha
 * @property $motivo
 * @property $created_at
 * @property $updated_at
 *
 * @property Banco $banco
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Movimiento extends Model
{
    
    protected $perPage = 20;
    protected $casts = [
        'fecha' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['tipo_movimiento', 'monto', 'banco_emisor_id', 'banco_receptor_id', 'fecha', 'motivo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /* X
    public function banco()
    {
        return $this->belongsTo(\App\Models\Banco::class, 'banco_receptor_id', 'id');
    }
    */

    public function bancoEmisor()
    {
        return $this->belongsTo(Banco::class, 'banco_emisor_id', 'id');
    }

    public function bancoReceptor()
    {
        return $this->belongsTo(Banco::class, 'banco_receptor_id', 'id');
    }

    
}
