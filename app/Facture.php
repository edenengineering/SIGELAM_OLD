<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paiement;


class Facture extends Model
{
  public function getResteAPayerAttribute()
    {
		$paiements = Paiement::where('id_facture', $this->id)->get();
		  foreach($paiements as $paiement)
		  {
			  $type = TypePaiement::find($paiement->type_paiement);
			  if($type->libelle_paiement == 'FORFAIT')
			  {
				  return 0;
			  }
		  }
		$this->reste_a_payer = $this->total - $this->percu;
		$this->save();
      return $this->total - $this->percu;
    }
  public function getPercuAttribute()
  {
	// Paiement::where('id_facture', $this->id)->delete();
	  $total = 0;
	   return $total + Paiement::where('id_facture', $this->id)->sum('percu');

  }
  public function getStatutAttribute()
  {
	  if($this->reste_a_payer == 0)
	  {
		return Facture::getSatutFacture(1);
	  }
	  else
	  {
		  $paiements = Paiement::where('id_facture', $this->id)->get();
		  foreach($paiements as $paiement)
		  {
			  $type = TypePaiement::find($paiement->type_paiement);
			  if($type->libelle_paiement == 'FORFAIT')
			  {
				  return Facture::getSatutFacture(1);
			  }
		  }
		return Facture::getSatutFacture(0);  
	  }
  
  }
  
  public  function getSatutFacture($statut)
	{
		$result = '';
		switch($statut)
		{
			case 0: $result = 'Non Reglée';
					break;
			case 1: $result = 'Reglée';
					break;
		}
		return $result;
	}
}
