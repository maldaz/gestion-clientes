<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'direccion'
    ];

    public $timestamps = false;

    // Relación con pedidos
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
