<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Dossier;
use App\Examen;
use App\ExamenDossier;
use App\Patient;
use App\TubeExamen;
use Carbon\Carbon; 
use App\Resultat;
use \Datetime;
use App\Conclusion;
use App\Antibiotique;
use App\Antifongique;
use App\TypeExamen;
use App\TypeResultat;
use App\GroupeExamen;
use App\IntituleBiopsie;
use App\User;
use Illuminate\Support\Facades\DB;


class TechniqueController extends Controller
{
    public function ShowDossiersEnAttente(Request $request)
	{
		if(Auth::check())
        {
			$dossiers = Dossier::where('etat', '4')->orderBy('date_dossier', 'desc')->get();
			$result = array();
			$groupe_examens = GroupeExamen::all();
			foreach($dossiers as $dossier)
			{
				
				if($dossier->etat != 'En Technique')
				{
					continue;
				}
				if(!$this->DossierIsEnTechnique($dossier->id))
				{

					continue;
				}
				$max = ExamenDossier::where('code_dossier', $dossier->id)->max('delai');
				$date = Carbon::parse($dossier->date_dossier);
				
				$date = $date->addDays($max);
				$patient = Patient::find($dossier->id_patient);
				$collection = Collect([
						'id_dossier' => $dossier->id,
						'nom_patient' => $patient->nom_patient,
						'date_dossier' => $dossier->date_dossier,
						'date_retrait' => $date->toDateString(),
						'urgence' => $dossier->urgence,
				]);
               array_push($result, $collection);
				
			}
			 $this->addEvent('ouverture_liste_attente', $request->ip(),0, Auth::id(), "Ouverture de la liste des dossiers en attente de traitement");
			return response()
						->json([
							'dossiers' => json_encode($result),
								], 200);
        }
        else
        {
            return redirect()->route('login', 302);
        }
		
	}
	
	public function ShowDossiersEnUrgence(Request $request)
	{
		if(Auth::check())
        {
        	$result = DB::select('select distinct groupe_examens.libelle_groupe_examen, groupe_examens.id as id_groupe_examen from examen_dossiers, examens, groupe_examens, dossiers where examen_dossiers.preleve = 1 and examen_dossiers.technique = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and dossiers.statut = \'1\' and dossiers.id = examen_dossiers.code_dossier UNION select distinct groupe_examens.libelle_groupe_examen, groupe_examens.id as id_groupe_examen from examen_dossiers, resultats, examens, groupe_examens, dossiers where examen_dossiers.preleve = 1 and resultats.id_dossier_examen = examen_dossiers.id and resultats.valide = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and dossiers.statut = \'1\' and dossiers.id = examen_dossiers.code_dossier');


						             
            if($request->ajax()){

               
                return response()
						->json([
							'dossiers' => json_encode($result),
								], 200);
            }
            else
            {
            	$groupe_examens = GroupeExamen::all();			
				$conclusions = Conclusion::all();
				$antibiotiques = Antibiotique::all();
				$antifongiques = Antifongique::all();
				$examensx = Examen::all();
				$type_resultats = TypeResultat::all();
	            $intitules = IntituleBiopsie::orderBy('libelle')->get();
	            $users = User::all();
				$groupe_examens = GroupeExamen::all();
	             $this->addEvent('ouverture_technique', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Technique");
	            // dd($result);
	             return view('dashboard_technique')->withDossiers(json_encode($result))
												->withConclusions($conclusions)
												->withAntibiotiques($antibiotiques)
												->withAntifongiques($antifongiques)
												->withExamens($examensx)
												->withTypeResultats($type_resultats)
												->withGroupeExamens($groupe_examens)
												->withIntitules($intitules)
												->withUsers($users);
	            }

			
        }
        else
        {
            return redirect()->route('login', 302);
        }
	}
	
	public function ShowFicheDossier(Request $request)
	{
		if(Auth::check())
        {
			if($request['id_dossier'] != null)
			{
				$dossier = Dossier::find($request['id_dossier']);
				$pat = Patient::find($dossier->id_patient);
				$bday = new DateTime($pat->date_naissance);
				$today = new DateTime($dossier->date_dossier);			
				$diff = $today->diff($bday);
				$age = $diff->y . ' an(s) ' . $diff->m . ' mois ' . $diff->d . ' jour(s)';
				$preleve = TubeExamen::where('id_dossier', $dossier->id)->max('updated_at');
				$max = ExamenDossier::where('code_dossier', $dossier->id)->max('delai');
				$date_retrait = Carbon::parse($dossier->date_dossier);
				
				$date_retrait = $date_retrait->addDays($max);				
				$examens_dossier1 = ExamenDossier::where('code_dossier', $dossier->id)->where('preleve', '1')->get();
				
				$result5 = array();
				
				foreach($examens_dossier1 as $examination)
				{
					$resultats = Resultat::where('id_dossier', $request['id_dossier'])
											->where('id_examen', $examination->code_examen)
											->where('valide', '1')
											->get();
					if(count($resultats) == 0){
							
						array_push($result5, $examination);
					}
					
				}
				
				
				
				$patient = Collect([
						'numero_dossier' => $dossier->id,
						'nom_patient' => $pat->nom_patient,
						'age' => $age,
						'telephone' => $pat->telephone,
						'id_assureur' => $dossier->id_assureur,
						'date_prelevement' => $preleve,
						'date_dossier' => $dossier->date_dossier,
						'prescripteur' => $dossier->nom_prescripteur,
						'date_retrait' => $date_retrait->toDateString(),
						'sexe' => $pat->sexe,
						'urgence' => $dossier->urgence,
						'renseignement' => $dossier->renseignement,
						'id_agent' => $dossier->id_agent,
						
				]);
				
				
				$toto = Examen::all();
				$toto2 = GroupeExamen::all();

				$this->addEvent('ouverture_fiche_dossier', $request->ip(),0, Auth::id(), "Ouverture Fiche Traitement Dossier =>" . sprintf("%06d",$patient['numero_dossier']) . ', du Patient => ' . $patient['nom_patient']);
				return response()
                        ->json([
                            'patient' => json_encode($patient),
                            'examens_dossier' => json_encode($result5),
                            'examens' => json_encode($toto),
                            'groupe_examens' => json_encode($toto2),
                        	], 200)
                        ;
				
			}
			else
			{
				
			}
        }
        else
        {
            return redirect()->route('login', 302);
        }
		
	}
		
	public function Invalider(Request $request)
	{
		if(Auth::check())
        {
			if($request['id_dossier'] != null)
			{
				$to_suppress = explode(",", $request['id_dossier']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						$dossier = Dossier::find($element);
						$dossier->etat = '10';
						if($dossier->save())
						{
							$tubes = TubeExamen::where('id_dossier', $dossier->id)->get();
							foreach($tubes as $tube)
							{
								$tube->preleve = '0';
								$tube->save();
							}
							array_push($deleted_elements, $element);
						}						
						
					}
					catch(Exception $e)
					{
						
					}
				}
				
				if(count($deleted_elements) !=  0)
				{
					if(count($deleted_elements) == 1)
					{
						return response()->json([
							'success' => 'Le Dossier a bien été invalide avec succès!',
							'supprimes' => json_encode($deleted_elements),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les Dossiers ont bien été invalidés avec succès!',
							'supprimes' => json_encode($deleted_elements)	,
						], 200);
						
					}					
				}
				else
				{
					return response()->json([
							'erreur' => 'Une erreur est survenue pendant la supression !',
						], 200);
				}	
				
			}
		}
		 else
		{
			return redirect()->route('login', 302);
		}
	}
	
	public function getDateHistorique(Request $request)
	{
		if(Auth::check())
        {
			if($request['id_examen_dossier'] != null)
			{
				$examen_dossier = ExamenDossier::find($request['id_examen_dossier']);
				$dossiers = Dossier::find($examen_dossier->code_dossier);
				$examen = Examen::find($examen_dossier->code_examen);
				$resultats = Resultat::where('id_dossier_examen', '<>', $request['id_examen_dossier'])->where('id_examen', $examen->id)->distinct()->get(['created_at']);
				
				return response()
                        ->json([
                            'resultats' => json_encode($resultats),
                        ], 200)
                        ;
				
			}
		}
		 else
		{
			return redirect()->route('login', 302);
		}
	}	

	public function getDateHistoriqueDate(Request $request)
	{
		if(Auth::check())
        {
			if($request['id_examen_dossier'] != null)
			{
				$examen_dossier = ExamenDossier::find($request['id_examen_dossier']);
				$dossier = Dossier::find($examen_dossier->code_dossier);
				$examen = Examen::find($examen_dossier->code_examen);
				$resultats = DB::select('select resultats.id, resultats.id_dossier_examen, resultats.id_dossier, resultats.id_examen, resultats.id_element, resultats.user_id, resultats.valeur from resultats, dossiers where resultats.id_dossier_examen != '. $request['id_examen_dossier'] .' and resultats.id_examen = '. $examen->id .' and dossiers.id = resultats.id_dossier and dossiers.id_patient = '. $dossier->id_patient );
				
				return response()
                        ->json([
                            'resultats' => json_encode($resultats),
                        ], 200)
                        ;
				
			}
		}
		 else
		{
			return redirect()->route('login', 302);
		}
	}		
	
	public function DossierIsEnTechnique($id_dossier)
	{
		$result = false;
		$examens_dossier = ExamenDossier::where('code_dossier', $id_dossier)->where('preleve', '1')->get();

		foreach($examens_dossier as $examen)
		{
			$resultats = Resultat::where('id_dossier', $id_dossier)
											->where('id_examen', $examen->code_examen)
											->where('valide', '0')
											->get();
					if(count($resultats) != 0){
						
						$result = true;
					}
			$resultats2 = Resultat::where('id_dossier', $id_dossier)
											->where('id_examen', $examen->code_examen)->get();
					if(count($resultats2) == 0)
					{
						$result = true;
					}		

		}
		return $result;
	}


	public function ShowGroupeExamenTechnique(Request $request)
	{
		if(Auth::check())
        {

        	$dossiers = Dossier::where('etat', '4')->orderBy('date_dossier', 'desc')->get();
			$result = array();
			$groupe_examens = GroupeExamen::all();
			$collection = collect([
									'id_groupe_examen' => $group->id,
									'libelle_groupe_examen' => $group->libelle_groupe_examen,
									]);

			foreach($groupe_examens as $group)
			{
				$trouve = false;
				foreach($dossiers as $dossier)
				{
					if($trouve)
					{
						break;
					}
					$examens = ExamenDossier::where('preleve', 1)->get();
					foreach($examens as $examen)
					{
						if((Resultat::where('id_dossier_examen', $examen->id)->count() == 0 || Resultat::where('id_dossier_examen', $examen->id)->where('valide', 1)->count() == 0) && Examen::find($examen->code_examen)->id_groupe_examen == $group->id)
							{
								$trouve = true;
								$collection = collect([
									'id_groupe_examen' => $group->id,
									'libelle_groupe_examen' => $group->libelle_groupe_examen,
									]);
								array_push($result, $collection);
								break;
							}
					}	
					
	            }
			}
			


            return response()
				->json([
					'dossiers' => json_encode($result),
						], 200);
        }
        else
        {
            return redirect()->route('login', 302);

        }
	}

	public function GroupeExamenExist($groups, $group)
	{
		foreach($groups as $gp)
		{
				if($gp['id_groupe_examen'] == $group['id_groupe_examen'])
			{
				return true;
			}
		}
		return false;
	}

	public function DossierExist($groups, $group)
		{
			foreach($groups as $gp)
			{
					if($gp['id_dossier'] == $group['id_dossier'])
					{
					return true;
					}
			}
			return false;
		}



	public function ShowDossiersGroupeExamenUrgence(Request $request)
	{
		if(Auth::check())
        {
        	
			$result = DB::select("select distinct dossiers.id as id_dossier, patients.nom_patient, dossiers.date_dossier  from examen_dossiers, examens, groupe_examens, dossiers, patients where examen_dossiers.preleve = 1 and examen_dossiers.technique = 0 and examen_dossiers.code_examen = examens.id 
and examens.id_groupe_examen = groupe_examens.id and examen_dossiers.code_dossier = dossiers.id and dossiers.urgence = '1' and groupe_examens.id = ? and dossiers.id_patient = patients.id and dossiers.statut = '1' UNION select distinct dossiers.id, patients.nom_patient, dossiers.date_dossier from examen_dossiers, resultats, examens, groupe_examens, dossiers, patients where examen_dossiers.preleve = 1 and resultats.id_dossier_examen = examen_dossiers.id and resultats.valide = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and examen_dossiers.code_dossier = dossiers.id and dossiers.urgence = '1' and groupe_examens.id = ? and dossiers.id_patient = patients.id and dossiers.statut = '1' order by date_dossier desc", [$request['id_groupe_examen'], $request['id_groupe_examen']]);

			for($i = 0; $i < count($result); $i++)
			{
				$delai = DB::select("select max(examens.delai) from dossiers, examen_dossiers, examens where dossiers.id = ? and examen_dossiers.code_dossier = dossiers.id and examens.id = examen_dossiers.code_examen", [$result[$i]->id_dossier]);
				$date = Carbon::parse($result[$i]->date_dossier);				
				$date = $date->addDays($delai);
				$result[$i]->date_retrait = $date->toDateString();
			}

			return response()
						->json([
							'dossiers' => json_encode($result),
								], 200);
		}				
        else
        {
            return redirect()->route('login', 302);
        }
		
	
}
	public function ShowDossiersGroupeExamenAttente(Request $request)
	{
		if(Auth::check())
        {
        	
			$result = DB::select("select distinct dossiers.id as id_dossier, patients.nom_patient, dossiers.date_dossier, dossiers.urgence from examen_dossiers, examens, groupe_examens, dossiers, patients where examen_dossiers.preleve = 1 and examen_dossiers.technique = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and examen_dossiers.code_dossier = dossiers.id  and groupe_examens.id = ? and dossiers.id_patient = patients.id and dossiers.statut = '1' UNION select distinct dossiers.id, patients.nom_patient, dossiers.date_dossier, dossiers.urgence from examen_dossiers, resultats, examens, groupe_examens, dossiers, patients where examen_dossiers.preleve = 1 and resultats.id_dossier_examen = examen_dossiers.id and resultats.valide = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and examen_dossiers.code_dossier = dossiers.id  and groupe_examens.id = ? and dossiers.id_patient = patients.id and dossiers.statut = '1' order by date_dossier desc", [$request['id_groupe_examen'], $request['id_groupe_examen']]);

			for($i = 0; $i < count($result); $i++)
			{
				$delai = DB::select("select max(examens.delai) from dossiers, examen_dossiers, examens where dossiers.id = ? and examen_dossiers.code_dossier = dossiers.id and examens.id = examen_dossiers.code_examen", [$result[$i]->id_dossier]);
				$date = Carbon::parse($result[$i]->date_dossier);				
				$date = $date->addDays($delai);
				$result[$i]->date_retrait = $date->toDateString();
			}

			return response()
						->json([
							'dossiers' => json_encode($result),
								], 200);
		}				
        else
        {
            return redirect()->route('login', 302);
        }
		
	}

	public function GetListeResultatsRendus(Request $request)
	{

		$result = DB::select('select rendu_resultats.id, libelle_type_resultat from rendu_resultats, type_resultats where id_rendu = '. $request['id_rendu'] .' and rendu_resultats.id_type_resultat = type_resultats.id order by libelle_type_resultat');

		return response()
						->json([
							'type_resultats' => json_encode($result),
								], 200);
	}


	public function ShowDossiersGroupeExamenAttente2(Request $request)
    {

        if(Auth::check())
        {

        	if($request['id_groupe_examen'] == null or $request['urgence'] == null)
        	{
        		$request['id_groupe_examen'] = 1;
        		$request['urgence'] = 0;
        	}
             $columns = array(
                0 => 'id_dossier',
                1 => 'nom_patient',
                2 => 'date_dossier',
                3 => 'date_retrait',
                
            );
           	$totalData = DB::select("select count(innerselect.nom_patient) as outtertotal from (select distinct dossiers.id as id_dossier, patients.nom_patient, dossiers.date_dossier, dossiers.urgence from examen_dossiers, resultats, examens, groupe_examens, dossiers, patients where examen_dossiers.preleve = 1 and examen_dossiers.technique = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and examen_dossiers.code_dossier = dossiers.id  and groupe_examens.id = ? and dossiers.id_patient = patients.id and dossiers.statut = '1' and dossiers.urgence = ? UNION select distinct dossiers.id, patients.nom_patient, dossiers.date_dossier, dossiers.urgence from examen_dossiers, resultats, examens, groupe_examens, dossiers, patients where examen_dossiers.preleve = 1 and resultats.id_dossier_examen = examen_dossiers.id and resultats.valide = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and examen_dossiers.code_dossier = dossiers.id  and groupe_examens.id = ? and dossiers.id_patient = patients.id and dossiers.statut = '1' order by date_dossier desc) as innerselect", [$request['id_groupe_examen'], $request['urgence'] ,  $request['id_groupe_examen']])[0]->outtertotal;
           	
            $totalFiltered = 0;
            $limit = $request->input('length');
            $order_column = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            if($limit == -1)
            {
                $limit = "ALL";
            }
            $start = $request->input('start');          
            $patients2 = array();

            if(empty($request->input('search.value')))
            {
                $patients2 = DB::select("select distinct dossiers.id as id_dossier, patients.nom_patient, dossiers.date_dossier, dossiers.urgence from examen_dossiers, resultats, examens, groupe_examens, dossiers, patients where examen_dossiers.preleve = 1 and examen_dossiers.technique = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and examen_dossiers.code_dossier = dossiers.id  and groupe_examens.id = ? and dossiers.id_patient = patients.id and dossiers.statut = '1' and dossiers.urgence = ? UNION select distinct dossiers.id, patients.nom_patient, dossiers.date_dossier, dossiers.urgence from examen_dossiers, resultats, examens, groupe_examens, dossiers, patients where examen_dossiers.preleve = 1 and resultats.id_dossier_examen = examen_dossiers.id and resultats.valide = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and examen_dossiers.code_dossier = dossiers.id  and groupe_examens.id = ? and dossiers.id_patient = patients.id and dossiers.statut = '1' order by date_dossier desc  limit " . $limit . " offset " . $start, [$request['id_groupe_examen'], $request['urgence'] ,  $request['id_groupe_examen']]);
                $totalFiltered = $totalData;
            }
            else
            {
                $search = "'%" . strtoupper(str_replace('\'', '\'\'',$request->input('search.value'))) . "%'";

                $patients2 = DB::select("select distinct dossiers.id as id_dossier, patients.nom_patient, dossiers.date_dossier, dossiers.urgence from examen_dossiers, resultats, examens, groupe_examens, dossiers, patients where examen_dossiers.preleve = 1 and examen_dossiers.technique = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and examen_dossiers.code_dossier = dossiers.id  and groupe_examens.id = ? and dossiers.id_patient = patients.id and dossiers.statut = '1' and dossiers.urgence = ? and patients.nom_patient like ". $search ."UNION select distinct dossiers.id, patients.nom_patient, dossiers.date_dossier, dossiers.urgence from examen_dossiers, resultats, examens, groupe_examens, dossiers, patients where examen_dossiers.preleve = 1 and resultats.id_dossier_examen = examen_dossiers.id and resultats.valide = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and examen_dossiers.code_dossier = dossiers.id  and groupe_examens.id = ? and dossiers.id_patient = patients.id and dossiers.statut = '1' and patients.nom_patient like ". $search ." order by date_dossier desc limit " . $limit . " offset " . $start, [$request['id_groupe_examen'], $request['urgence'] ,  $request['id_groupe_examen']]);

                $totalFiltered = DB::select("select count(innerselect.nom_patient) as outtertotal from (select distinct dossiers.id as id_dossier, patients.nom_patient, dossiers.date_dossier, dossiers.urgence from examen_dossiers, resultats, examens, groupe_examens, dossiers, patients where examen_dossiers.preleve = 1 and examen_dossiers.technique = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and examen_dossiers.code_dossier = dossiers.id  and groupe_examens.id = ? and dossiers.id_patient = patients.id and dossiers.statut = '1' and dossiers.urgence = ? and patients.nom_patient like ". $search ."UNION select distinct dossiers.id, patients.nom_patient, dossiers.date_dossier, dossiers.urgence from examen_dossiers, resultats, examens, groupe_examens, dossiers, patients where examen_dossiers.preleve = 1 and resultats.id_dossier_examen = examen_dossiers.id and resultats.valide = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and examen_dossiers.code_dossier = dossiers.id  and groupe_examens.id = ? and dossiers.id_patient = patients.id and dossiers.statut = '1' and patients.nom_patient like ". $search ." order by date_dossier desc limit " . $limit . " offset " . $start . ") as innerselect", [$request['id_groupe_examen'], $request['urgence'] ,  $request['id_groupe_examen']])[0]->outtertotal;

            } 
             

            $data = array();  

            if($patients2)
            {
                foreach ($patients2 as $row)
                {
                   $nestedData['id_dossier'] = "<a data-info='" . $row->id_dossier ."'> ". sprintf("%06d",$row->id_dossier) . "</a>";

                  // dd($nestedData['nom_patient']);
                   $nestedData['nom_patient'] = $row->nom_patient;
                   $nestedData['date_dossier'] = date('d-m-Y', strtotime($row->date_dossier));
                   $delai = DB::select("select max(examens.delai) from dossiers, examen_dossiers, examens where dossiers.id = ? and examen_dossiers.code_dossier = dossiers.id and examens.id = examen_dossiers.code_examen", [$row->id_dossier]);
					$date = Carbon::parse($row->date_dossier);				
					$date = $date->addDays($delai);
                   $nestedData['date_retrait'] = $date->toDateString();
                   $data[] = $nestedData;    

                }
            }

            $json_data = array(

                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,
            );

           
              echo   json_encode($json_data);
                    

        }   
        else
        {
            return redirect()->route('login', 302);
        }
    }

}
