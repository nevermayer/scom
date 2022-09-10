<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredientes extends Model
{
    use HasFactory;
   
    public function platillos(){
        return $this->belongsToMany(Platillo::class, 'IngredientePlatillo');
    }
    
    public function postres(){
        return $this->belongsToMany(Postres::class, 'IngredientePostre');
    }

    public function chef(){
        return $this->belongsToMany(Chef::class, 'SolicitudChef');
    }
}
