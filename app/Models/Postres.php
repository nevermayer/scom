<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postres extends Model
{
    use HasFactory;

    public function ingredientes(){
        return $this->belongsToMany(Ingredientes::class, 'ingrediente_postre');
    }
}
