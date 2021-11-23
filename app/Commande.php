<?php

namespace App;
use Carbon;
use Illuminate\Database\Eloquent\Model;
use App\CommandeMateriel;

class Commande extends Model
{
    public function getDateLivraisonAttribute($date)
	{
		return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
	}
	
	public function getDateCommandeAttribute($date)
	{
		return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
	}
	 public function getMontantAttribute()
    {
		$montant = 0;
		
		$materiels = CommandeMateriel::where('code_commande', $this->attributes['id'])->get();
		foreach($materiels as $materiel)
		{
			$montant = $montant + $materiel->total;
		}
		
		return $montant;
    }
}
