<?php

namespace App\Http\Controllers;

use App\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Patient;
use App\Examen;
use App\GroupeExamen;
use App\Partenaire;
use App\Prescripteur;
Use App\CentrePrescripteur;
use App\User; 
use App\Conclusion;
use App\TypeResultat;
use App\AgentEditeur;
use App\TypePaiement;
use App\IntituleBiopsie;
use App\Unite;
use Illuminate\Support\Facades\DB;


class PatientController extends Controller
{
    public function show(Request $request)
    {

        if(Auth::check())
        {


         // $patients = Patient::where('statut', 1)->orderBy('created_at', 'desc')->get();

                                //           dd("non");

			$examens = Examen::where('statut', 1)->get();
			$groupe_examens = GroupeExamen::All();
			$prescripteurs = Prescripteur::where('statut', 1)->orderBy('nom_prescripteur')->get();
			$centre_prescripteurs = CentrePrescripteur::where('statut', 1)->get();
			$type_resultats = TypeResultat::all();
			$conclusions = Conclusion::all();
            $intitules = IntituleBiopsie::orderBy('libelle')->get();
			$users = User::All();
            $unites = Unite::All();
            $professions = Profession::all();

			$agent_editeurs = AgentEditeur::where('statut', '1')->orderBy('nom_agent')->get();
            $this->addEvent('ouverture_patient', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Patient ");
            return view('dashboard_patient')->withExamens($examens)
											->withGroupeExamens($groupe_examens)
											->withPrescripteurs($prescripteurs)
                                            ->withCentrePrescripteurs($centre_prescripteurs)
											->withUsers($users)
											->withConclusions($conclusions)
											->withTypeResultats($type_resultats)
											->withAgentEditeurs($agent_editeurs)
                                            ->withIntitules($intitules)
                                            ->withProfessions($professions)
                                            ->withUnites($unites);
        }   
        else
        {
            return redirect()->route('login');
        }
    }

    public function store(Request $request)
    {
		
        if(Auth::check())
        {

            $validator = Validator::make($request->all(), [

            ]);

            if($validator->fails())
            {
                return response()->json([
                    'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Patient !',

                ], 200);
            }


            if($request['id_patient'] == null)
            {
				
                $patient = new Patient();
                $patient->matricule = strtoupper($request['matricule']);
                $patient->nom_patient = strtoupper($request['nom_patient']);
                $patient->date_naissance = $request['date_naissance'];
                $patient->adresse = strtoupper($request['adresse']);
                $patient->telephone = $request['telephone'];
                $patient->fax = $request['fax'];
                $patient->email = $request['email'];
                $patient->cni = $request['cni'];				
                $patient->sexe = $request['sexe'];
				$patient->id_agent= Auth::id();
                $patient->id_profession = $request['id_profession'];
				$patient->statut = '1';			

                if($patient->save())
                {
                    $this->addEvent('ajout_patient', $request->ip(),$patient->id, Auth::id(), "Ajout du Patient =>  ". $patient->nom_patient);

                    
                    return response()
                        ->json([
                            'success' => 'Le Patient '. $patient->nom_patient .' a été enregistré avec succès !',                           
                            'nouveau' => json_encode($patient),
                        ], 200)
                        ;
                }
                else
                {
                    return response()->json([
                        'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Patient !'
                    ], 200);
                }
            }
            else
            {
				$patient = Patient::find($request['id_patient']);
                $old = $patient->nom_patient;
                $patient->matricule = strtoupper($request['matricule']);
                $patient->nom_patient = strtoupper($request['nom_patient']);
                $patient->date_naissance = $request['date_naissance'];
                $patient->adresse = strtoupper($request['adresse']);
                $patient->telephone = $request['telephone'];
                $patient->fax = $request['fax'];
                $patient->email = $request['email'];
                $patient->cni = $request['cni'];				
                $patient->sexe = $request['sexe'];
                $patient->id_profession = $request['id_profession'];
				$patient->statut = '1';	
				$patient->id_agent= Auth::id();

                if($patient->save())
                {
                     $this->addEvent('modifier_patient', $request->ip(),$patient->id, Auth::id(), "Modification du Patient : ". $old ." =>  ". $patient->nom_patient);

                    return response()
                        ->json([
                            'success' => 'Le Patient '. $patient->nom_patient .' a été Modifié avec succès !',
                            'nouveau' => json_encode($patient),
                        ], 200)
                        ;
                }
                else
                {
                    return response()->json([
                        'erreur' => 'Une erreur est survenue pendant la modification de ce Patient !'
                    ], 200);
                }
            }
        }
        else{
            return redirect()->route('login', 302);
        }
	
    }
	
	public function deleteModel(Request $request)
    {
        if(Auth::check())
        {
            if(!$request['id_patient'] == null)
            {
                $to_suppress = explode(",", $request['id_patient']);
                $deleted_elements = array();

                foreach($to_suppress as $element)
                {
                    try
					{
                        $patient = Patient::find($element);
                        $patient->statut = '0';
                        if($patient->save())
                        {
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
                            'success' => 'Le Patient a bien été supprimmé avec succès !',
                            'supprimes' => json_encode($deleted_elements),
                        ], 200);
                    }
                    else
                    {
                        return response()->json([
                            'success' => 'Les Patients ont bien été supprimmé avec succès !',
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

    public function getListePatient(Request $request)
    {

        if(Auth::check())
        {
             $columns = array(
                0 => 'nom_patient',
                1 => 'matricule',
                2 => 'date_naissance',
                3 => 'sexe',
                4 => 'telephone',
                5 => 'created_at',
                6 => 'name',
            );
           $totalData = DB::select('select count(patients.nom_patient) from patients')[0]->count;
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
                $patients2 = DB::select('select patients.nom_patient, patients.id, patients.matricule, patients.date_naissance, patients.adresse, patients.telephone, patients.fax, patients.cni, patients.email, patients.sexe, patients.id_profession, users.name, patients.created_at from patients, users where patients.statut = \'1\' and patients.id_agent = users.id  order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                $totalFiltered = $totalData;
            }
            else
            {
                $search = "'%" . strtoupper(str_replace('\'', '\'\'',$request->input('search.value'))) . "%'";

                $patients2 = DB::select('select patients.nom_patient, patients.id, patients.matricule, patients.date_naissance, patients.adresse, patients.telephone, patients.fax, patients.cni, patients.email, patients.sexe,  patients.id_profession, users.name, patients.created_at from patients, users where patients.statut = \'1\' and patients.id_agent = users.id and (patients.nom_patient like '. $search .' or patients.id::text like '. $search .' or patients.date_naissance::text like '. $search .' or patients.adresse like '. $search .' or patients.telephone like '. $search .' or patients.fax like '. $search .' or patients.cni like '. $search .' or patients.email like '. $search .' or patients.sexe like '. $search .' or patients.created_at::text  like '. $search .' or users.name like '. $search .') order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                $totalFiltered = count($patients2);

            } 
             

            $data = array();  

            if($patients2)
            {
                foreach ($patients2 as $row)
                {
                   $nestedData['nom_patient'] = "<a class='edit-modalP' style='cursor:pointer' data-info='" . $row->id . "," . $row->matricule . "," . $row->nom_patient . "," . $row->date_naissance . "," . $row->adresse . "," . $row->telephone . "," . $row->fax . "," . $row->cni . "," . $row->email . "," . $row->sexe . "," . $row->id_profession . "'><span class='glyphicon glyphicon-edit'></span> ". $row->nom_patient . "</a>";

                  // dd($nestedData['nom_patient']);
                   $nestedData['matricule'] = $row->matricule;
                   $nestedData['date_naissance'] = date('d-m-Y', strtotime($row->date_naissance));
                   $nestedData['sexe'] = $row->sexe;
                   $nestedData['telephone'] = $row->telephone;
                   $nestedData['created_at'] = date('d-m-Y H:i:s', strtotime($row->created_at));
                   $nestedData['name'] = $row->name;

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
