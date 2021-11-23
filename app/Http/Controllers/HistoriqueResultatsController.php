<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Dossier;
use App\Patient;
use App\Resultat;
use App\Examen;
use App\ExamenDossier;
use App\GroupeExamen;
use App;
use Illuminate\Support\Facades\DB;


class HistoriqueResultatsController extends Controller
{
	public function Show(Request $request)
    {
    	
        if(Auth::check())
                {
                    $result = array();

                        $resultats = Resultat::where('valide', 1)->where('imprime', 0)->orderBy('id_dossier')->get();
                        $id_dossier = 0;
                        foreach($resultats as $resultat)
                        {
                                $dossier = Dossier::find($resultat->id_dossier);
                                $patient = Patient::find($dossier->id_patient);
                                if($id_dossier == $dossier->id)
                                {
                                        continue;
                                }
                                $collection = Collect([
                                        'date' => $dossier->date_dossier,
                                        'id_dossier' => $dossier->id,
                                        'nom_patient' => $patient->nom_patient,
                                        'sexe' => $patient->sexe,
                                        'contact' => $patient->telephone,
                                        'prescripteur' => $dossier->nom_prescripteur,
                                        ]);
 
                                array_push($result, $collection);
                                $id_dossier = $dossier->id;

                               

                        }

                    return view('dashboard_imprimer_resultat')->withDossiers(json_encode($result));                 
                }
                else
                {
                    return redirect()->route('login', 302);
                }

    }    


    public function ShowDossiersArchives(Request $request)
    {
        if(Auth::check())
        {
                   
             $this->addEvent('ouverture_historique_resultat', $request->ip(),0, Auth::id(), "Ouverture de la Fenêtre d'Historque des Résultats ");            
                return view('dashboard_historique_resultat');
        }
        else
        {
            return redirect()->route('login', 302);
        }
    }	


    public function GetListeDossiersArchives(Request $request)
    {
        if(Auth::check())
        {
                      
                $columns = array(
                0 => 'date',
                1 => 'id_dossier',
                2 => 'nom_patient',
                3 => 'sexe',
                4 => 'contact',
                5 => 'prescripteur',
            );
           $totalData = DB::select('select COUNT(id) from dossiers where etat = \'8\'')[0]->count;
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
                $patients2 = DB::select('select dossiers.date_dossier as date, dossiers.id as id_dossier, patients.nom_patient, patients.sexe, patients.telephone, dossiers.nom_prescripteur
from dossiers, patients where etat = \'8\' and dossiers.id_patient = patients.id order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                
                $totalFiltered = $totalData;
                
            }   
            else
            {
                $search = "'%" . strtoupper(str_replace('\'', '\'\'',$request->input('search.value'))) . "%'";

                $patients2 = DB::select('select dossiers.date_dossier as date, dossiers.id as id_dossier, patients.nom_patient, patients.sexe,patients.telephone, dossiers.nom_prescripteur
from dossiers, patients where etat = \'8\' and dossiers.id_patient = patients.id  and (patients.nom_patient like '. $search .' or  dossiers.id::text like '. $search .' or patients.sexe like '. $search .' or patients.telephone like '. $search .' or dossiers.nom_prescripteur like '. $search .') order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                $totalFiltered = count($patients2);
                


            } 
             

            $data = array();  

            if($patients2)
            {
                foreach ($patients2 as $row)
                {
                   
                   $nestedData['date'] = date('d-m-Y', strtotime($row->date));
                   $nestedData['id_dossier'] = $row->id_dossier;
                   $nestedData['nom_patient'] = $row->nom_patient;
                   $nestedData['sexe'] = $row->sexe;
                   $nestedData['contact'] = $row->telephone;
                   $nestedData['prescripteur'] = $row->nom_prescripteur;

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

    public function ListeExamensDossier(Request $request)
    {
        if(Auth::check())
        {
            if($request['id_examen'] == null)
            {
                $examens = ExamenDossier::where('code_dossier', $request['id_dossier'])->get();
                $result = array();

                foreach ($examens as $examen) {
                    
                    $exam = Examen::find($examen->code_examen);
                    $group_exam = GroupeExamen::find($exam->id_groupe_examen);
                    $collection = collect([
                        'id_examen' => $exam->id,
                        'libelle_examen' => $exam->libelle_examen,
                        'groupe_examen' => $group_exam->libelle_groupe_examen,                    
                    ]);

                    array_push($result, $collection);
                }

                return response()->json([
                                'examens' => json_encode($result),
                            ], 200);
            }

            else
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

            
        }
        else
        {
            return redirect()->route('login', 302);
        }    

    }
    
    
}
