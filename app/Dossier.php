<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ExamenDossier;
use App\Examen;
use App\GroupeExamen;

class Dossier extends Model
{
     public function getEtatAttribute()
	 {
		 return  $this->getStatut($this->attributes['etat']);
	 } 	
	
	 
	 public  function getStatut($statut)
	{
		$result = '';
		switch($statut)
		{
			case 0: $result = 'Clos';
					break;
					
			case 1: $result = 'En Attente';
				    break;		
				   
			case 2: $result = 'Technique/Prelevement';
					break;
					
			case 3: $result = 'En Cours de Traitement';
					break;
					
			case 4: $result = 'En Technique';
					break;
					
			case 5: $result = 'En Reception';
					break;
					
			case 6: $result = 'Supprimé';
					break;
					
			case 7: $result = 'Proforma';
					break;
					
			case 8: $result = 'Archivé';
					break;
					
			case 9: $result = 'A Imprimer';
					break;
					
			case 10: $result = 'En prélèvement';
					 break;
					 
		}	
		
		return $result;
	}

	public function getGroupesExamensAttribute()
	{
		$examens = ExamenDossier::where('preleve', '1')
								->where('code_dosser', $this->attributes['id'])
								->get();

		foreach($examens as $examen)
		{
			$resultats = Resultat::where('id_dossier', $id_dossier)
													->where('id_examen', $examen->code_examen)
													->where('valide', '0')
													->get();
			if(count($resultats) != 0){

			}
		}						
		return;
	}
}
