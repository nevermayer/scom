<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;

    public function camareros(){
        return $this->belongsTo(Camarero::class,'id_camarero');
    }

    public function ordens(){
        return $this->hasMany(Orden::class,'id');
    }

    public function clientes(){
        return $this->belongsTo(Cliente::class,'id_cliente');
    }
}
