<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Dossier;
use App\ExamenDossier;
use App\Examen;
use App\Alerte;
use Carbon\Carbon; 
use App\Patient;
use Illuminate\Support\Facades\DB;



class AlerteController extends Controller
{
    public function Show(Request $request)
    {
    	if(Auth::check())
    	{
            $this->addEvent('ouverture_alertes', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre des Alertes ");

    		return view('dashboard_alertes');
    	}
    	else
        {
        	return redirect()->route('login', 302);
        }
    }

    public function GetListeAlertes(Request $request)
    {
        if(Auth::check())
        {
            $columns = array(
                0 => 'id_dossier',
                1 => 'nom_patient',
                2 => 'examen',
                3 => 'date_dossier',
                4 => 'date_retrait',
                
            );
           $totalData = DB::select('select count(*) from alertes')[0]->count;
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
                $patients2 = DB::select('select * from alertes order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                
                $totalFiltered = $totalData;
                
            }   
            else
            {
                $search = "'%" . strtoupper(str_replace('\'', '\'\'',$request->input('search.value'))) . "%'";

                $patients2 = DB::select('select * from alertes where (id_dossier::text like '. $search .' or nom_patient like '. $search .' or examen like '. $search .' or date_dossier::text like '. $search .' or date_retrait::text like '. $search .')order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                $totalFiltered = count($patients2);
                


            } 
             

            $data = array();  

            if($patients2)
            {
                foreach ($patients2 as $row)
                {
                   
                   $nestedData['id_dossier'] = $row->id_dossier;
                   $nestedData['nom_patient'] = $row->nom_patient;
                   $nestedData['examen'] = $row->examen;
                   $nestedData['date_dossier'] = date('d-m-Y', strtotime($row->date_dossier));
                   $nestedData['date_retrait'] = date('d-m-Y', strtotime($row->date_retrait));

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

    public function CheckListeAlertes(Request $request)
    {
    	if(Auth::check())
    	{
            dd($request->ip());
    			$alerte = Alerte::all()->first();
    			if(count($alerte) != 0)
    			{
    				$date_check = Carbon::parse($alerte->date_check);
    				$date_du_jour = Carbon::parse(date('Y-m-d'));
    				if($date_du_jour->eq($date_check))
    				{
    					return;
    				}

    			}
    				$dossiers = Dossier::where('etat', 4)->where('statut', '1')->get();
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
    						//dd($date_du_jour);
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
}
