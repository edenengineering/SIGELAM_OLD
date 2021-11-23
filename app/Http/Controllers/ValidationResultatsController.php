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
use App\TypeResultat;
use App\GroupeExamen;
use App\User;
use App\IntituleBiopsie;
use App\Journal;
use App\Alerte;
use Illuminate\Support\Facades\DB;


class ValidationResultatsController extends Controller
{
	public function Show(Request $request)
	{
		if(Auth::check())
        {
        	 

			$groupe_examens = GroupeExamen::all();
			
			$conclusions = Conclusion::all();
			$antibiotiques = Antibiotique::all();
			$antifongiques = Antifongique::all();
			$examens = Examen::where('statut', '1')->get();
			$type_resultats = TypeResultat::all();
			$intitules = IntituleBiopsie::orderBy('libelle')->get();
			$users = User::all();
			
			
			
    		$this->addEvent('ouverture_validation_resultats', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre de Validation des Résultats");

			return view('dashboard_valider_resultat')->withConclusions($conclusions)
												->withAntibiotiques($antibiotiques)
												->withAntifongiques($antifongiques)
												->withExamens($examens)
												->withTypeResultats($type_resultats)
												->withGroupeExamens($groupe_examens)
												->withIntitules($intitules)
												->withUsers($users);
													
		}
		else
		{
			return redirect()->route('login', 302);

		}			
	}

	public function getListeValidation(Request $request)
	{
		if(Auth::check())
        {
             $columns = array(
                0 => 'nom_patient',
                1 => 'id_dossier',
                2 => 'date_dossier',
                3 => 'nom_user',
                
            );
           $totalData = DB::select('select count(innerselect.nom_patient) as outtertotal from (select distinct patients.nom_patient, dossiers.id as id_dossier, dossiers.date_dossier, users.name as nom_user from patients, resultats, dossiers, users where resultats.valide = 0 and resultats.id_dossier = dossiers.id and dossiers.id_patient = patients.id and dossiers.statut = \'1\' and dossiers.id_agent::int = users.id) as innerselect')[0]->outtertotal;
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
                $patients2 = DB::select('select distinct patients.nom_patient, dossiers.id as id_dossier, dossiers.date_dossier, users.name as nom_user from patients, resultats, dossiers, users where resultats.valide = 0 and resultats.id_dossier = dossiers.id and dossiers.id_patient = patients.id and dossiers.statut = \'1\' and dossiers.id_agent::int = users.id order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                
                $totalFiltered = $totalData;
                
            }   
            else
            {
                $search = "'%" . strtoupper(str_replace('\'', '\'\'',$request->input('search.value'))) . "%'";

                $patients2 = DB::select('select distinct patients.nom_patient, dossiers.id as id_dossier, dossiers.date_dossier, users.name as nom_user from patients, resultats, dossiers, users where resultats.valide = 0 and resultats.id_dossier = dossiers.id and dossiers.id_patient = patients.id and dossiers.statut = \'1\' and dossiers.id_agent::int = users.id and (patients.nom_patient like '. $search .' or dossiers.id::text like '. $search .' or dossiers.date_dossier::text like '. $search .' or users.name like '. $search .') order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                $totalFiltered = count($patients2);
                


            } 
             

            $data = array();  

            if($patients2)
            {
                foreach ($patients2 as $row)
                {
                  

                   $nestedData['nom_patient'] = $row->nom_patient;                  
                   $nestedData['id_dossier'] = sprintf("%06d", $row->id_dossier);
                   $nestedData['date_dossier'] = date('d-m-Y', strtotime($row->date_dossier));
                   $nestedData['nom_user'] = $row->nom_user;
                   
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
	
	public function ShowExamenDossier(Request $request)
	{
		if(Auth::check())
		{
			if($request['id_dossier'] != null)
			{
				$resultats = Resultat::where('id_dossier', $request['id_dossier'])->where('valide', 0)->get();
				$result = array();
				$old_exam = 0;
				foreach($resultats as $resultat)
				{
					$examen = Examen::find($resultat->id_examen);
					$groupe_examen = GroupeExamen::find($examen->id_groupe_examen);					
					$date = Carbon::parse($resultat->created_at);
					$collection = collect([
										'id' => $examen->id,
										'id_groupe_examen' => $groupe_examen->id,
										'libelle_examen' => $examen->libelle_examen,
										'id_technicien' => $resultat->user_id,
										'date_technique' => $date->toDateTimeString(),
										]);	


					if(!$this->ExamenExist($result, $collection))
					{
						array_push($result, $collection);
					}
										
					
										
				}
						return response()
										->json([
											'examens' => json_encode($result),
												], 200);				
			}

		}
		else
		{
			return redirect()->route('login', 302);
			
		}
	}
	
	public function StoreExamen(Request $request)
	{
		if(Auth::check())
		{
			if($request['id_dossier'] != null && $request['id_examen'] != null)
			{
				$resultats =  Resultat::where('id_dossier', $request['id_dossier'])->where('id_examen', $request['id_examen'])->update(['valide' => 1]);
				
				
	           
			//$this->CheckListeAlertes();
					$journal = new Journal();
				$journal->evenement = 'VALIDATION';
				$journal->id_agent = Auth::id();
				$journal->id_dossier = $request['id_dossier'];
				$journal->id_examen = $request['id_examen'];
				$journal->save();

				$examens_dossiers = ExamenDossier::where('code_dossier', $request['id_dossier'])->get();
				$technique = true;
				foreach($examens_dossiers as $examen)
				{
					if(!(Resultat::where('id_dossier_examen', $examen->id)->count() != 0 && Resultat::where('id_dossier_examen', $examen->id)->where('valide', 0)->count() == 0))
						{
							$technique = false;
							break;
						}
				}

				if($technique)
				{
					Dossier::where('id', $request['id_dossier'])->update(['etat' => 9, 'urgence' => 0]);
					Alerte::where('id_dossier', $request['id_dosier'])->delete();	
				}

				$this->addEvent('ajout_validation_resultats', $request->ip(),0, Auth::id(), "Validation de noveaux résultats pour le Dossier => " . sprintf("%06d",$request['id_dossier']) );
				return response()->json([
									'success' => 'L\'examen a été validé avec succès !',
												], 200);	
			}
		}
		else
		{
			return redirect()->route('login', 302);
		}
	}
	
	public function StoreExamenAll(Request $request)
	{
		if(Auth::check())
        {
			if(!$request['id_examen'] == null)
			{
				$to_suppress = explode(",", $request['id_examen']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						$resultats =  Resultat::where('id_dossier', $request['id_dossier'])->where('id_examen', $element)->update(['valide' => 1]);
						
						
						array_push($deleted_elements, $element);
						
						$journal = new Journal();
						$journal->evenement = 'VALIDATION';
						$journal->id_agent = Auth::id();
						$journal->id_dossier = $request['id_dossier'];
						$journal->id_examen = $element;
						$journal->save();
						
					}
					catch(Exception $e)
					{
						
					}
				}
				
				if(count($deleted_elements) !=  0)
				{
					$this->addEvent('ajout_validation_resultats_all', $request->ip(),0, Auth::id(), "Validation de tous les résultats pour le Dossier => " . sprintf("%06d",$request['id_dossier']));

					$examens_dossiers = ExamenDossier::where('code_dossier', $request['id_dossier'])->get();
					$technique = true;
					foreach($examens_dossiers as $examen)
					{
						if(!(Resultat::where('id_dossier_examen', $examen->id)->count() != 0 && Resultat::where('id_dossier_examen', $examen->id)->where('valide', 0)->count() == 0))
							{
								$technique = false;
								break;
							}
					}

					if($technique)
					{
						Dossier::where('id', $request['id_dossier'])->update(['etat' => 9, 'urgence' => 0]);
						Alerte::where('id_dossier', $request['id_dosier'])->delete();
					}

					if(count($deleted_elements) == 1)
					{
						return response()->json([
							'success' => 'L\'examen a bien été validé avec succès!',
							'supprimes' => json_encode($deleted_elements),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les examens ont bien été validés avec succès!',
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
	
	

	public function ExamenExist($groups, $group)
    {
      foreach($groups as $gp)
      {
          if($gp['id'] == $group['id'])
        {
          return true;
        }
      }
      return false;
    }

    public function GetTechnicienDossier(Request $request)
    {
    	if(Auth::check())
        {
        	$techniciens = Journal::where('id_dossier', $request['id_dossier'])->where('id_examen', $request['id_examen'])->get();

        	$result = array();

        	foreach($techniciens as $tech)
        	{
        		$user = User::find($tech->id_agent);
        		$collection = collect([
        			'agent' => $user->name,
        			'date' => $tech->created_at->toDateTimeString(),
        			'action' => $tech->evenement,
        		]);
        		array_push($result, $collection);
        	}
        	return response()->json([
							'infos' => json_encode($result),
						], 200);
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
    						$resultats = Resultat::where('id_dossier', $dossier->id)->where('id_examen', $exam->id)->where('valide', 1)->get();
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

    public function CheckListeAlertes2()
    {
    	if(Auth::check())
    	{

    			
			Alerte::truncate();
			$dossiers = Dossier::where('etat', 4)->get();
			foreach ($dossiers as $dossier)
			 {
    			$examens_dossiers = ExamenDossier::where('code_dossier', $dossier->id)->get();
				$technique = true;
				foreach($examens_dossiers as $examen)
				{
					if(!(Resultat::where('id_dossier_examen', $examen->id)->count() != 0 && Resultat::where('id_dossier_examen', $examen->id)->where('valide', 0)->count() == 0))
						{
							$technique = false;
							break;
						}
				}

				if($technique)
				{
					Dossier::where('id', $dossier->id)->update(['etat' => 9, 'urgence' => 0]);
				}
			
			}
    			
    	}
    	else 
    	{
    		return redirect()->route('login', 302);
    	}	
    }
}
