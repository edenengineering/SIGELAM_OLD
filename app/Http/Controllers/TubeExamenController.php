<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;
use Validator;
use App\TubeExamen;
use App\Tube;
use App\Dossier;
use App\Patient;
use Illuminate\Http\Request;
use App\GroupeExamen;
use App\ExamenDossier;
use App\Examen;
use Illuminate\Support\Facades\DB;

class TubeExamenController extends Controller
{
   public function show(Request $request)
   {
	   if(Auth::check())
       {
		   if($request['id_dossier'] != null)
		   {				
			   $tubes_examen = array();
			   $tubes = TubeExamen::where('id_dossier', $request['id_dossier'])->orderBy('created_at', 'asc')->get();
			   	$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

			   foreach($tubes as $tu)
			   {
				   $tube = Tube::find($tu->id_tube);
				   
				   $collection = collect([
											'libelle_tube' => $tube->libelle_tube,
											'couleur' => $tube->couleur,
											'reference_tube' => $tu->id,
											'id_groupe_examen' => $tube->id_groupe_examen,
											'code_barre' => base64_encode($generator->getBarcode($tu->id, $generator::TYPE_CODE_128	)),
										]);
					array_push($tubes_examen, $collection);	
					
			   }
			   
			   return response()->json(['tubes_examen' => json_encode($tubes_examen)], 200);
		   }
	   }
	   else
	   {
            return redirect()->route('login', 302);
	   }
			
   }
   
   public function AllTubesExamens(Request $request)
   {
	   if(Auth::check())
       {
            $tubes_examens = TubeExamen::all();
            $result = array();
            foreach($tubes_examens as $tube)
           {
               $dossier = Dossier::find($tube->id->dossier);
               $model_tube = Tube::find($tube->id_tube);
               $collection = Collect(['id' => $tube->id,
                                      'preleve' => $tube->preleve,
                                      'id_dossier' =>  $tube->id_dossier,
                                      'id_tube' => $model_tube->id,
                                      'couleur' => $model_tube->couleur,

               ]);

               array_push($result, $collection);
           }

           return response()->json(['tubes' => json_encode($result)], 200);

       }
       else
       {
            return redirect()->route('login', 302);
       }
	   
	   
   }
   public function GetTubeExamen(Request $request)
   {       if(Auth::check())
       {
		   		   			   	$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

           $tubes_examens = TubeExamen::where('id_dossier', $request['id_dossier'])->where('preleve', 0)->get();
           $result = array();
           foreach($tubes_examens as $tube)
           {
               $model_tube = Tube::find($tube->id_tube);
               $collection = Collect([
					'id' => $tube->id,
					'libelle_tube' => $model_tube->libelle_tube,                   
                   'couleur' => $model_tube->couleur,
					'id_groupe_examen' => $tube->id_groupe_examen,
				   'code_barre' => base64_encode($generator->getBarcode($tube->id, $generator::TYPE_CODE_128	)),

               ]);

               array_push($result, $collection);
           }
		//return view('dashboard_prelevement')->withPrelevements(json_encode($result));
         return response()->json(['tubes' => json_encode($result)], 200);

       }
       else
       {
           return redirect()->route('login', 302);
       }
   
   }
   
   public function show2(Request $request)
   {
       if(Auth::check())
       {
       		$groupe_examens = GroupeExamen::all();
		 /*	$result = DB::select('select distinct patients.nom_patient as nom, dossiers.id as id, dossiers.date_dossier as date  from tube_examens, dossiers, patients where preleve = 0 and dossiers.id = tube_examens.id_dossier and dossiers.id_patient = patients.id  order by patients.nom_patient');

			$result2 = DB::select('select patients.nom_patient, dossiers.id as numero_dossier, dossiers.date_dossier, tube_examens.id as id_tube, tubes.couleur, tubes.libelle_tube  from tube_examens, dossiers, patients, tubes where preleve = 0 and dossiers.id = tube_examens.id_dossier and dossiers.id_patient = patients.id and tube_examens.id_tube = tubes.id order by patients.nom_patient');*/
              
            $this->addEvent('ouverture_prelevement', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Prélèvements ");
               
         //  dd($result);
            if(!$request->ajax())
            {
            	//return view('dashboard_prelevement')->withPrelevements(json_encode($result))->withGroupeExamens($groupe_examens)->withTubes(json_encode($result2));
            	return view('dashboard_prelevement')->withGroupeExamens($groupe_examens);

            }
			
        //  return response()->json(['prelevements' => $result], 200);

       }
       else
       {
           return redirect()->route('login', 302);
       }
   }


   public function getListePrelevement(Request $request)
   {
   		if(Auth::check())
        {
             $columns = array(
                0 => 'nom_patient',
                1 => 'numero_dossier',
                2 => 'date_dossier',
                3 => 'id_tube',
                4 => 'libelle_tube',
                5 => 'couleur',
            );
           $totalData = DB::select('select count(innerselect.nom_patient) as outtertotal from (select patients.nom_patient, dossiers.id as numero_dossier, dossiers.date_dossier, tube_examens.id as id_tube, tubes.couleur, tubes.libelle_tube  from tube_examens, dossiers, patients, tubes where preleve = 0 and dossiers.id = tube_examens.id_dossier and dossiers.id_patient = patients.id and tube_examens.id_tube = tubes.id order by patients.nom_patient) as innerselect')[0]->outtertotal;
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
                $patients2 = DB::select('select patients.nom_patient, dossiers.id as numero_dossier, dossiers.date_dossier, tube_examens.id as id_tube, tubes.couleur, tubes.libelle_tube  from tube_examens, dossiers, patients, tubes where preleve = 0 and dossiers.id = tube_examens.id_dossier and dossiers.id_patient = patients.id and tube_examens.id_tube = tubes.id order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                
                $totalFiltered = $totalData;
                
            }   
            else
            {
                $search = "'%" . strtoupper(str_replace('\'', '\'\'',$request->input('search.value'))) . "%'";

               $patients2 = DB::select('select patients.nom_patient, dossiers.id as numero_dossier, dossiers.date_dossier, tube_examens.id as id_tube, tubes.couleur, tubes.libelle_tube  from tube_examens, dossiers, patients, tubes where preleve = 0 and dossiers.id = tube_examens.id_dossier and dossiers.id_patient = patients.id and tube_examens.id_tube = tubes.id order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                
                $totalFiltered = $totalData;
                


            } 
             

            $data = array();  

            if($patients2)
            {
                foreach ($patients2 as $row)
                {
                   $nestedData['nom_patient'] = $row->nom_patient;
                   $nestedData['numero_dossier'] = sprintf("%06d",$row->numero_dossier);
                   $nestedData['date_dossier'] =  date('d-m-Y', strtotime($row->date_dossier));
                   $nestedData['id_tube'] = sprintf("%06d",$row->id_tube);
                   $nestedData['libelle_tube'] = $row->libelle_tube;
                   $nestedData['couleur'] = "<input style='width:50px' type='color' value='" . $row->couleur . "'/>";

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


   public function getListePrelevementManuel(Request $request)
   {
   		if(Auth::check())
        {
             $columns = array(
                0 => 'nom',
                1 => 'id',
                2 => 'date',               
            );
           $totalData = DB::select('select count(innerselect.nom) as outtertotal from (select distinct patients.nom_patient as nom, dossiers.id as id, dossiers.date_dossier as date  from tube_examens, dossiers, patients where preleve = 0 and dossiers.id = tube_examens.id_dossier and dossiers.id_patient = patients.id  order by patients.nom_patient) as innerselect')[0]->outtertotal;
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
                $patients2 = DB::select('select distinct patients.nom_patient as nom, dossiers.id as id, dossiers.date_dossier as date  from tube_examens, dossiers, patients where preleve = 0 and dossiers.id = tube_examens.id_dossier and dossiers.id_patient = patients.id  order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                
                $totalFiltered = $totalData;
                
            }   
            else
            {
                $search = "'%" . strtoupper(str_replace('\'', '\'\'',$request->input('search.value'))) . "%'";

                $patients2 = DB::select('select distinct patients.nom_patient as nom, dossiers.id as id, dossiers.date_dossier as date  from tube_examens, dossiers, patients where preleve = 0 and dossiers.id = tube_examens.id_dossier and dossiers.id_patient = patients.id and (patients.nom_patient like '. $search .' or dossiers.id::text like '. $search .' or dossiers.date_dossier::text like '. $search .') order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                $totalFiltered = count($patients2);
                


            } 
             

            $data = array();  

            if($patients2)
            {
                foreach ($patients2 as $row)
                {
                   

                  $nestedData['nom'] = $row->nom;
                   $nestedData['id'] = sprintf("%06d",$row->id);
                   $nestedData['date'] = date('d-m-Y', strtotime($row->date));                 

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
   
   public function valider(Request $request)
	{
		if(Auth::check())
        {
			if(!$request['id_tube'] == null)
			{
				$to_suppress = explode(",", $request['id_tube']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						//dd($element);

						if((int)$element > 2147483646)
						{
							return response()->json([
							'erreur' => 'Le code Barre est inexistant !',]);
						}


						$tube_examen = TubeExamen::find((int)$element);


						

						if(count($tube_examen) == 0)
						{
							return response()->json([
							'erreur' => 'Le code Barre est inexistant !',]);
						}
						if($tube_examen->preleve == 1)
						{
							return response()->json([
							'erreur' => 'Ce tube a déjà été prélevé !',
								], 200);
						}
						$tube_examen->preleve = '1';
						if($tube_examen->save())
						{
 						  Dossier::where('id', $tube_examen->id_dossier)->update(['etat' => '4']);

 						  DB::update('update examen_dossiers set preleve = 1 from examens where examen_dossiers.code_examen = examens.id and examen_dossiers.code_dossier = ? and examens.id_groupe_examen = ?', [$tube_examen->id_dossier, $tube_examen->id_groupe_examen]);
						  array_push($deleted_elements, $element);
						}						
						
					}
					catch(Exception $e)
					{
						
					}
				}
				
				if(count($deleted_elements) !=  0)
				{
					
			
            $this->addEvent('ajout_prelevement', $request->ip(),0, Auth::id(), "Ajout du Prelevement => ". $deleted_elements[0]);
                    
					if(count($deleted_elements) == 1)
					{
						
						   
						   
						return response()->json([
							'success' => 'L\'examen a bien été prélevé avec succès!',
							'supprimes' => json_encode($deleted_elements),
							
						], 200);
					}
					else
					{	

						return response()->json([
							'success' => 'Les examens ont bien été prelevé avec succès!',
							'supprimes' => json_encode($deleted_elements)	,
							

						], 200);
					}

						
				}
				else
				{
					return response()->json([
							'erreur' => 'Une erreur est survenue pendant la validation du prélèvement !',
						], 200);
				}					
				
			
		}				
		else
		{
            return redirect()->route('login', 302);
        }	
	
		}
	}
	   
	   
   
   public function DossierExist($dossier, $dossiers)
	{
		foreach($dossiers as $dos)
		{
				if($dos['id'] == $dossier['id'])
			{
				return true;
			}
		}
		return false;
	}
   
   


   public function LecteurCodeBarre(Request $request)
   {
   		if(Auth::check())
        {

        	$tubes = TubeExamen::where('preleve', 0)->get();
        	$result = array();
        	foreach($tubes as $tube)
        	{
        		$dossier = Dossier::find($tube->id_dossier);
        		$patient = Patient::find($dossier->id_patient);
        		$tub = Tube::find($tube->id_tube);
        		$collection = ([
        			'nom_patient' => $patient->nom_patient,
        			'numero_dossier' => $dossier->id,
        			'date_dossier' => $dossier->date_dossier,
        			'id_tube' => $tube->id,
        			'couleur' => $tub->couleur,
        			'libelle_tube' => $tub->libelle_tube,
        			]);
        		array_push($result, $collection);	 
        	}

        	return response()->json(['tubes' => json_encode($result)]);	

        }
        else
        {
            return redirect()->route('login', 302);

        }
   }

  
  
}
