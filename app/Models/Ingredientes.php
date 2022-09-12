<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredientes extends Model
{
    use HasFactory;

    public function chefs(){
        return $this->belongsToMany(Chef::class, 'solicitud_chef');
    }
    public function platillos(){
        return $this->belongsToMany(Platillos::class, 'ingrediente_platillo');
    }

    public function postres(){
        return $this->belongsToMany(Postres::class, 'ingrediente_postre');
    }
}
