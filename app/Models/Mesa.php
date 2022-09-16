<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
	protected $table = 'mesa';
	public $timestamps = false;

	protected $casts = [
		'orden_id' => 'int',
		'camarero_id' => 'int',
		'cliente_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'min_capacidad',
		'max_capacidad',
		'status',
		'orden_id',
		'camarero_id',
		'cliente_id'
	];

	public function camarero()
	{
		return $this->belongsTo(Camarero::class);
	}

	public function cliente()
	{
		return $this->belongsTo(Cliente::class);
	}

	public function orden()
	{
		return $this->belongsTo(Orden::class);
	}
}
