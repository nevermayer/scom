<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;
    public function camarero(){
        return $this->belongsTo(Camarero::class, 'id');
    }
    
    public function cliente(){
        return $this->belongsTo(Cliente::class, 'id');
    }
    
}
