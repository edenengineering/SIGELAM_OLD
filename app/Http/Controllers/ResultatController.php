<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Resultat;
use App\ExamenDossier;
use App\Examen;
use App\Dossier;
use App\Rendu;
use App\Patient;
use App\Alerte;
use Carbon\Carbon; 
use App\ConclusionExamen;
use App\Journal;
use Illuminate\Support\Facades\DB;


class ResultatController extends Controller
{
	public function show( Request $request)
    {
       if(Auth::check())
        {
			if($request['id_examen_dossier'] != null)
			{
				$rendus = DB::select('select rendus.id, resultats.id_dossier_examen, resultats.id_dossier, resultats.id_element, resultats.user_id, resultats.valeur, resultats.max, resultats.min, resultats.unite, resultats.libelle_rendu, resultats.valide, resultats.imprime, resultats.archive, resultats.historique, resultats.created_at, resultats.updated_at, rendus.type from resultats, rendus where id_dossier_examen = '. $request['id_examen_dossier'] .' and rendus.id = resultats.id_element order by rendus.ordre');
				
				if(count($rendus) == 0)
				{				
					$rends = Rendu::where('code_examen', $request['id_examen'])->where('statut', 1)->orderBy('ordre')->get();
					$rendus = array();
					foreach($rends as $rendu)
					{
						$collection = collect([
								'id' => $rendu->id,
								'id_dossier_examen' => $request['id_examen_dossier'],
								'id_element' => $rendu->id,
								'libelle_rendu' => $rendu->libelle_rendu,
								'user_id' => Auth::id(),
								'valeur' => '',
								'max' => $rendu->max,
								'min' => $rendu->min,
								'unite' => $rendu->unite,
								'historique' => $rendu->historique,
								'type' => $rendu->type
								
							]);
						array_push($rendus, $collection);	
					}
 
				}
				if($request->ajax()){
					 
					return response()->json(['rendus' => json_encode($rendus),
					], 200);
				}
				
			}
				
			 
		}
        else{
            return redirect()->route('login', 302);
        }
    }
	
   public function Store(Request $request)
   {
	 if(Auth::check())
     {

		if($request['id_examen_dossier'] != null)
		{
			$resultat = Resultat::where('id_dossier_examen', $request['id_examen_dossier'])->get();
			if(count($resultat) != 0)
			{
				Resultat::where('id_dossier_examen', $request['id_examen_dossier'])->delete();
			}
			$max = count($request['values']);
			$values = $request['values'];
			
			$examen_dossier = ExamenDossier::find($request['id_examen_dossier']);

			$examen = Examen::find($examen_dossier->code_examen);
			$dossier = Dossier::find($examen_dossier->code_dossier);
			$patient = Patient::find($dossier->id_patient);
			for($i = 0; $i < $max; $i = $i + 7)
			{
				$resultat = new Resultat();
				$resultat->id_dossier_examen = $request['id_examen_dossier'];
				$resultat->id_dossier =	$dossier->id;
				$resultat->id_examen = $examen->id;
				$resultat->id_element = $values[$i];
				$resultat->libelle_rendu = $values[$i+1];
				$resultat->user_id = Auth::id();
				$resultat->valeur = strtoupper($values[$i+2]);
				$resultat->max = $values[$i+3];
				$resultat->min = $values[$i+4];
				$resultat->unite = $values[$i+5];
				$resultat->historique = $values[$i+6];
			
				$resultat->save();

				//Verification des Conclusions Automatiques
				$auto = DB::select('select type_resultats.id as id_type_resultat, type_resultats.libelle_type_resultat, conclusion_automatiques.id, conclusion_automatiques.id_rendu, conclusion_automatiques.id_conclusion, conclusions.libelle from conclusion_automatiques, rendu_resultats, type_resultats, conclusions where id_examen = '. $resultat->id_examen .' and conclusion_automatiques.id_type_resultat = rendu_resultats.id and type_resultats.id = rendu_resultats.id_type_resultat and conclusion_automatiques.id_rendu = ' . $resultat->id_element . ' and type_resultats.libelle_type_resultat = \''. $resultat->valeur .'\' and conclusions.id = conclusion_automatiques.id_conclusion');

				if(count($auto) != 0)
				{
					ConclusionExamen::where('id_examen_dossier', $request['id_examen_dossier'])->delete();
					$conclusion_examen = new ConclusionExamen();					
					$conclusion_examen->id_examen_dossier = $request['id_examen_dossier'];
					$conclusion_examen->id_dossier = $resultat->id_dossier;
					$conclusion_examen->id_examen = $resultat->id_examen;
					$conclusion_examen->conclusion = $auto[0]->libelle;
					$conclusion_examen->save();

				}
			}

			$examen_dossier->technique = 1;
			$examen_dossier->save();

			$journal = new Journal();
			$journal->evenement = 'MODIFICATION';
			$journal->id_agent = Auth::id();
			$journal->id_dossier = $dossier->id;
			$journal->id_examen = $examen->id;
			$journal->save();

			

			$this->addEvent('ajout_resultats', $request->ip(),0, Auth::id(), "Ajout des Résultats pour l'examen =>". $examen->libelle_examen.", le  Dossier =>" . sprintf("%06d",$dossier->id) . ', du Patient => ' . $patient['nom_patient']);

			//Verification des Conclusions Automatiques

			//$this->CheckListeAlertes();					
				return response()
					->json([
						'success' => 'Les Resultats de l\'examen ont été enregistrés avec succès',
							], 200)
					;
			
		}
		
	 }
	 else
	 {
		return redirect()->route('login', 302);
	 }
   }
   
   public function Store2(Request $request)
   {
	 if(Auth::check())
     {

		if($request['id_examen_dossier'] != null)
		{
			$resultat = Resultat::where('id_dossier_examen', $request['id_examen_dossier'])->where('id_element', $request['id_rendu'])->get();
			if(count($resultat) != 0)
			{
				Resultat::where('id_dossier_examen', $request['id_examen_dossier'])->delete();
			}
			$max = count($request['values']);
			$values = $request['values'];
			
			$examen_dossier = ExamenDossier::find($request['id_examen_dossier']);
			$examen = Examen::find($examen_dossier->code_examen);
			$dossier = Dossier::find($examen_dossier->code_dossier);
			
			for($i = 0; $i < $max; $i = $i + 7)
			{
				$resultat = new Resultat();
				$resultat->id_dossier_examen = $request['id_examen_dossier'];
				$resultat->id_dossier =	$dossier->id;
				$resultat->id_examen = $examen->id;
				$resultat->id_element = $values[$i];
				$resultat->libelle_rendu = $values[$i+1];
				$resultat->user_id = Auth::id();
				$resultat->valeur = strtoupper($values[$i+2]);
				$resultat->max = $values[$i+3];
				$resultat->min = $values[$i+4];
				$resultat->unite = $values[$i+5];
				$resultat->historique = $values[$i+6];
				$resultat->valide = 1;
			
				$resultat->save();				
			}
				

				$journal = new Journal();
				$journal->evenement = 'MODIFICATION';
				$journal->id_agent = Auth::id();
				$journal->id_dossier = $dossier->id;
				$journal->id_examen = $examen->id;
				$journal->save();
				//$this->CheckListeAlertes();	
				$this->addEvent('ajout_resultats', $request->ip(),0, Auth::id(), "Ajout des Résultats pour l'examen =>". $examen->libelle_examen.", le  Dossier =>" . sprintf("%06d",$dossier->id) . ', du Patient => ' . $patient['nom_patient']);


				return response()
					->json([
						'success' => 'Les Resultats de l\'examen ont été enregistrés avec succès',
							], 200)
					;
			
		}
		
	 }
	 else
	 {
		return redirect()->route('login', 302);
	 }
   }



   public function CheckListeAlertes()
    {
    	if(Auth::check())
    	{

    			
    				Alerte::truncate();
    				$dossiers = Dossier::where('etat', 4)->get();
    				foreach ($dossiers as $dossier) {
    					$examens = ExamenDossier::where('code_dossier', $dossier->id)->where('preleve', '1')->get();
    					foreach ($examens as $examen) {
    						$exam = Examen::find($examen->code_examen);
    						$resultats = Resultat::where('id_dossier', $dossier->id)->where('id_examen', $exam->id)->get();
	   						if(count($resultats) != 0)
	   						{
	   							continue;
	   						}
    						$delai = $exam->delai;
    						$date_dossier = Carbon::parse($dossier->date_dossier);
    						$date_retrait = $date_dossier->addDays($delai);
    						$date_du_jour = Carbon::parse(date('Y-m-d'));
    						if($date_du_jour->gt($date_retrait))
    						{
    							$patient = Patient::find($dossier->id_patient);
	    						$alerte = new Alerte();
	    						$alerte->id_dossier = $dossier->id;
	    						$alerte->nom_patient = $patient->nom_patient;
	    						$alerte->examen = $exam->libelle_examen;
	    						$alerte->date_dossier = $dossier->date_dossier;
	    						$alerte->date_retrait = $date_retrait->toDateString();
	    						$alerte->date_check = $date_du_jour->toDateString();
	    						$alerte->save();
	    					}
    						
    					}
    				}

    			
    	}
    	else 
    	{
    		return redirect()->route('login', 302);
    	}	
    }
   
    public function CompletementTechnique($id_dossier)
    {
    	$technique = true;
    	$examens = ExamenDossier::where('code_dossier', $id_dossier)->get();
    	foreach ($examens as $examen) {
    		if(count(Resultat::where('id_dossier', $id_dossier)->where('id_dossier_examen', $examen->id)->get()) == 0)
			{
				$technique = false;
				break;
			}
    	}

    	return $technique;
    }

}
