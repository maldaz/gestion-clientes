<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos'; // nombre de la tabla

    protected $fillable = [
        'cliente_id', 'descripcion', 'estado', 'fecha'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
