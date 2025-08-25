<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Balance
 *
 * @property $id
 * @property $banco_id
 * @property $monto_actual
 * @property $ult_modificacion
 * @property $created_at
 * @property $updated_at
 *
 * @property Banco $banco
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Balance extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['banco_id', 'monto_actual', 'ult_modificacion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    
    public function banco()
    {
        return $this->belongsTo(\App\Models\Banco::class, 'banco_id', 'id');
    }   
    
}
