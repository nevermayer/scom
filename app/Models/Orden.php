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
}
