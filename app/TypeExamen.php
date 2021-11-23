<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeExamen extends Model
{
	protected $fillable = [
		'libelle_type_examen', 'id_groupe_examen',
	];
}
