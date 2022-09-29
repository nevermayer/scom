<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'orden';
	public $timestamps = false;

	protected $casts = [
		'total' => 'float',
		'telefono' => 'int',
		'chef_id' => 'int',
		'camarero_id' => 'int'
	];

	protected $dates = [
		'fecha',
		'hora'
	];

	protected $fillable = [
		'nombre',
		'apellido_pat',
		'total',
		'estado',
		'fecha',
		'hora',
		'telefono',
		'chef_id',
		'camarero_id'
	];

	public function camarero()
	{
		return $this->belongsTo(Camarero::class);
	}

	public function chef()
	{
		return $this->belongsTo(Chef::class);
	}

	public function facturas()
	{
		return $this->hasMany(Factura::class);
	}

	public function mesas()
	{
		return $this->hasMany(Mesa::class);
	}
    public function productos(){
        return $this->belongsToMany(Producto::class,'consume')->withPivot('cantidad');
    }
}
