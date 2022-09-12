<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    public function camareros(){
        return $this->belongsTo(Camarero::class,'id_camarero');
    }

    public function chefs(){
        return $this->belongsTo(Chef::class,'id_chef');
    }
    public function productos(){
        return $this->belongsToMany(Productos::class,'consume');
    }

    public function facturas(){
        return $this->belongsTo(Factura::class,'id_factura');
    }

    public function mesas(){
        return $this->belongsTo(Mesa::class,'id_mesa');
    }
}
