<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    use HasFactory;

    public function ordenes(){
        return $this->hasMany(Orden::class,'id');
    }

    public function ingredientes(){
        return $this->belongsToMany(Ingredientes::class, 'solicitud_chef');
    }
}
