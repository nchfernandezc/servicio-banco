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
 * @property $user_id
 * @property $fecha
 * @property $motivo
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property Banco $bancoEmisor
 * @property Banco $bancoReceptor
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Movimiento extends Model
{
    protected $perPage = 20;
    
    protected $casts = [
        'fecha' => 'datetime',
    ];

    protected $fillable = [
        'tipo_movimiento',
        'monto',
        'banco_emisor_id',
        'banco_receptor_id',
        'fecha',
        'motivo',
        'user_id'
    ];

    /**
     * Get the user that owns the movimiento.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the banco that owns the movimiento (emisor).
     */
    public function bancoEmisor()
    {
        return $this->belongsTo(Banco::class, 'banco_emisor_id');
    }

    /**
     * Get the banco that owns the movimiento (receptor).
     */
    public function bancoReceptor()
    {
        return $this->belongsTo(Banco::class, 'banco_receptor_id');
    }
}
