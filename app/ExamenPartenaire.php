<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamenPartenaire extends Model
{
    protected $fillable = ['id_partenaire','id_examen','prise_en_charge'];
}
