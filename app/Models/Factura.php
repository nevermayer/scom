<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    public function cajeros(){
        return $this->belongsTo(Cajero::class,'id_cajero');
    }

    public function clientes(){
        return $this->belongsTo(Cliente::class,'id_cliente');
    }
}
