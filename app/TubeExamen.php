<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TubeExamen extends Model
{
    public function getIdAttribute()
	{
		return sprintf("%06d",  $this->attributes['id']);
	}
}
