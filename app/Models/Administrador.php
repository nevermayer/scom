<?php

<<<<<<< HEAD
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;
=======
/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Administrador
 * 
 * @property int $id
 * @property int $id_usuario
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Administrador extends Model
{
	protected $table = 'administrador';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int'
	];

	protected $fillable = [
		'id_usuario'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_usuario');
	}
>>>>>>> vue-vistas
}
