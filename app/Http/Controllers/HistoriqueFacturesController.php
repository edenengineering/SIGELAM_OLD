<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier;
use App\Patient;
use App\ExamenDossier;
use App\AgentEditeur;
use App\User;
use Auth;
use App\Examen;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;




class HistoriqueFacturesController extends Controller
{
    public function Show(Request $request)
    {
    	if(Auth::check())
		{
			if($request['date_debut'] != null && $request['date_fin'] !=  null)
			{					

				$this->addEvent('ouverture_histrorique_factures', $request->ip(),$medecin_prescripteur->id, Auth::id(), "Ouverture Fenetre Historique Factures");
					return view('dashboard_historique_facture');
					

			}			
			else
			{
							//	dd("3");
                $this->addEvent('ouverture_histrorique_factures', $request->ip(),0, Auth::id(), "Ouverture Fenetre Historique Factures");

				return view('dashboard_historique_facture');

			}
			
		}
		else{
			return redirect()->route('login', 302);
		}
    }


    public function getHistoriqueFacture(Request $request)
    {

        if(Auth::check())
        {
             $columns = array(
                0 => 'date_dossier',
                1 => 'nom_patient',
                2 => 'id',
                3 => 'total',
                4 => 'reduction',
                5 => 'numero_facture',
                6 => 'facture_par',
                7 => 'prescripteur',
                8 => 'edite_par',
                9 => 'etat'
            );

             $tabEtat = array(

                0 => 'Clos',
                1 => 'En Attente',
                2 => 'Technique/Prelevement',
                3 => 'En Cours de Traitement',
                4 => 'En Technique',
                5 => 'En Reception',
                6 => 'Supprimé',
                7 => 'Proforma',
                8 => 'Archivé',
                9 => 'A Imprimer',
                10 => 'En prélèvement',
                
             );

             if($request['date_debut'] == null)
             {
             	$request['date_debut'] = date('Y-m-d');
             }

             if($request['date_fin'] == null)
             {
             	$request['date_fin'] = date('Y-m-d');
             }

           $totalData = count(DB::select('select dossiers.id, dossiers.date_dossier, patients.nom_patient,  sum(examen_dossiers.prix_net) as total, dossiers.reduction , dossiers.etat, dossiers.numero_facture, dossiers.nom_prescripteur as prescripteur, users.name as edite_par, agent_editeurs.nom_agent as facture_par from agent_editeurs, users, dossiers, patients, examen_dossiers where
 patients.id = dossiers.id_patient  and dossiers.date_dossier <= \''.$request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and dossiers.id_agent::int = users.id and  dossiers.id = examen_dossiers.code_dossier and dossiers.id_agent_editeur = agent_editeurs.id group by dossiers.id, patients.nom_patient, users.name, agent_editeurs.nom_agent UNION select dossiers.id, dossiers.date_dossier, patients.nom_patient,  sum(examen_dossiers.prix_net) as total, dossiers.reduction , dossiers.etat, dossiers.numero_facture, dossiers.nom_prescripteur as prescripteur, users.name as edite_par  , dossiers.numero_facture as fracture_par from agent_editeurs, users, dossiers, patients, examen_dossiers where patients.id = dossiers.id_patient  and dossiers.date_dossier <= \''. $request['date_fin'].' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and dossiers.id_agent::int = users.id and  dossiers.id = examen_dossiers.code_dossier and dossiers.id_agent_editeur IS NULL group by dossiers.id, patients.nom_patient, users.name, agent_editeurs.nom_agent '));
            $totalFiltered = 0;
            $limit = $request->input('length');
            $order_column = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            $valTotal = 0;

            if($limit == -1)
            {
                $limit = "ALL";
            }
            $start = $request->input('start');          
            $patients2 = array();

            if(empty($request->input('search.value')))
            {
                $patients2 = DB::select('select dossiers.id, dossiers.date_dossier, patients.nom_patient,  sum(examen_dossiers.prix_net) as total, dossiers.reduction , dossiers.etat, dossiers.numero_facture, dossiers.nom_prescripteur as prescripteur, users.name as edite_par, agent_editeurs.nom_agent as facture_par from agent_editeurs, users, dossiers, patients, examen_dossiers where
 patients.id = dossiers.id_patient  and dossiers.date_dossier <= \''.$request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and dossiers.id_agent::int = users.id and  dossiers.id = examen_dossiers.code_dossier and dossiers.id_agent_editeur = agent_editeurs.id group by dossiers.id, patients.nom_patient, users.name, agent_editeurs.nom_agent UNION select dossiers.id, dossiers.date_dossier, patients.nom_patient,  sum(examen_dossiers.prix_net) as total, dossiers.reduction , dossiers.etat, dossiers.numero_facture, dossiers.nom_prescripteur as prescripteur, users.name as edite_par  , dossiers.numero_facture as fracture_par from agent_editeurs, users, dossiers, patients, examen_dossiers where patients.id = dossiers.id_patient  and dossiers.date_dossier <= \''. $request['date_fin'].' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and dossiers.id_agent::int = users.id and  dossiers.id = examen_dossiers.code_dossier and dossiers.id_agent_editeur IS NULL group by dossiers.id, patients.nom_patient, users.name, agent_editeurs.nom_agent order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                
                $totalFiltered = $totalData;

                $valTotal = DB::select('select sum(innerselect.total) as outtertotal from (select dossiers.id, dossiers.date_dossier, patients.nom_patient,  sum(examen_dossiers.prix_net) as total, dossiers.reduction , dossiers.etat, dossiers.numero_facture, dossiers.nom_prescripteur as prescripteur, users.name as edite_par, agent_editeurs.nom_agent as facture_par from agent_editeurs, users, dossiers, patients, examen_dossiers where
 patients.id = dossiers.id_patient  and dossiers.date_dossier <= \''.$request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and dossiers.id_agent::int = users.id and  dossiers.id = examen_dossiers.code_dossier and dossiers.id_agent_editeur = agent_editeurs.id group by dossiers.id, patients.nom_patient, users.name, agent_editeurs.nom_agent  UNION select dossiers.id, dossiers.date_dossier, patients.nom_patient,  sum(examen_dossiers.prix_net) as total, dossiers.reduction , dossiers.etat, dossiers.numero_facture, dossiers.nom_prescripteur as prescripteur, users.name as edite_par  , dossiers.numero_facture as fracture_par from agent_editeurs, users, dossiers, patients, examen_dossiers where patients.id = dossiers.id_patient  and dossiers.date_dossier <= \''. $request['date_fin'].' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and dossiers.id_agent::int = users.id and  dossiers.id = examen_dossiers.code_dossier and dossiers.id_agent_editeur IS NULL group by dossiers.id, patients.nom_patient, users.name, agent_editeurs.nom_agent order by '. $order_column.') as innerselect')[0]->outtertotal;
                
            }   
            else
            {
                $search = "'%" . strtoupper(str_replace('\'', '\'\'',$request->input('search.value'))) . "%'";

                $patients2 = DB::select('select dossiers.id, dossiers.date_dossier, patients.nom_patient,  sum(examen_dossiers.prix_net) as total, dossiers.reduction , dossiers.etat, dossiers.numero_facture, dossiers.nom_prescripteur as prescripteur, users.name as edite_par, agent_editeurs.nom_agent as facture_par from agent_editeurs, users, dossiers, patients, examen_dossiers where ( patients.nom_patient like '. $search .' or dossiers.id::text like '. $search .' or dossiers.date_dossier::text like '. $search .' or  dossiers.reduction::text like '. $search .' or dossiers.nom_prescripteur like '. $search .' or users.name like '. $search .' or agent_editeurs.nom_agent like '. $search .') and
 patients.id = dossiers.id_patient  and dossiers.date_dossier <= \''.$request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and dossiers.id_agent::int = users.id and  dossiers.id = examen_dossiers.code_dossier and dossiers.id_agent_editeur = agent_editeurs.id group by dossiers.id, patients.nom_patient, users.name, agent_editeurs.nom_agent UNION select dossiers.id, dossiers.date_dossier, patients.nom_patient,  sum(examen_dossiers.prix_net) as total, dossiers.reduction , dossiers.etat, dossiers.numero_facture, dossiers.nom_prescripteur as prescripteur, users.name as edite_par  , dossiers.numero_facture as fracture_par from agent_editeurs, users, dossiers, patients, examen_dossiers where ( patients.nom_patient like '. $search .' or dossiers.id::text like '. $search .' or dossiers.date_dossier::text like '. $search .' or  dossiers.reduction::text like '. $search .' or dossiers.nom_prescripteur like '. $search .' or users.name like '. $search .' or agent_editeurs.nom_agent like '. $search .') and patients.id = dossiers.id_patient  and dossiers.date_dossier <= \''. $request['date_fin'].' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and dossiers.id_agent::int = users.id and  dossiers.id = examen_dossiers.code_dossier and dossiers.id_agent_editeur IS NULL group by dossiers.id, patients.nom_patient, users.name, agent_editeurs.nom_agent order by '. $order_column .' '. $dir.' limit ' . $limit . ' offset ' . $start);
                $totalFiltered = count($patients2);
                $valTotal = DB::select('select sum(innerselect.total) as outtertotal from (select dossiers.id, dossiers.date_dossier, patients.nom_patient,  sum(examen_dossiers.prix_net) as total, dossiers.reduction , dossiers.etat, dossiers.numero_facture, dossiers.nom_prescripteur as prescripteur, users.name as edite_par, agent_editeurs.nom_agent as facture_par from agent_editeurs, users, dossiers, patients, examen_dossiers where ( patients.nom_patient like '. $search .' or dossiers.id::text like '. $search .' or dossiers.date_dossier::text like '. $search .' or  dossiers.reduction::text like '. $search .' or dossiers.nom_prescripteur like '. $search .' or users.name like '. $search .' or agent_editeurs.nom_agent like '. $search .') and
 patients.id = dossiers.id_patient  and dossiers.date_dossier <= \''.$request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and dossiers.id_agent::int = users.id and  dossiers.id = examen_dossiers.code_dossier and dossiers.id_agent_editeur = agent_editeurs.id group by dossiers.id, patients.nom_patient, users.name, agent_editeurs.nom_agent UNION select dossiers.id, dossiers.date_dossier, patients.nom_patient,  sum(examen_dossiers.prix_net) as total, dossiers.reduction , dossiers.etat, dossiers.numero_facture, dossiers.nom_prescripteur as prescripteur, users.name as edite_par  , dossiers.numero_facture as fracture_par from agent_editeurs, users, dossiers, patients, examen_dossiers where ( patients.nom_patient like '. $search .' or dossiers.id::text like '. $search .' or dossiers.date_dossier::text like '. $search .' or  dossiers.reduction::text like '. $search .' or dossiers.nom_prescripteur like '. $search .' or users.name like '. $search .' or agent_editeurs.nom_agent like '. $search .') and patients.id = dossiers.id_patient  and dossiers.date_dossier <= \''. $request['date_fin'].' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and dossiers.id_agent::int = users.id and  dossiers.id = examen_dossiers.code_dossier and dossiers.id_agent_editeur IS NULL group by dossiers.id, patients.nom_patient, users.name, agent_editeurs.nom_agent order by '. $order_column .') as innerselect ')[0]->outtertotal;
                


            } 
             

            $data = array();  
            
            if($patients2)
            {
                foreach ($patients2 as $row)
                {

                   $nestedData['date_dossier'] = date('d-m-Y H:i:s', strtotime($row->date_dossier));
                   $nestedData['id'] = "<a data-info='" . $valTotal . "'> ". sprintf("%06d",$row->id) . "</a>";
                   $nestedData['nom_patient'] = $row->nom_patient;
                   $nestedData['total'] = $row->total;
                   $nestedData['reduction'] = $row->reduction;
                   $nestedData['numero_facture'] = $row->numero_facture;
                   $nestedData['facture_par'] = $row->facture_par;
                   $nestedData['prescripteur'] = $row->prescripteur;
                   $nestedData['edite_par'] = $row->edite_par;
                   $nestedData['etat'] = $tabEtat[$row->etat];

                   $data[] = $nestedData;    
                   

                }
            }

            $json_data = array(

                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,
                "total" => $valTotal,
            );

           
              echo   json_encode($json_data);
                    

        }   
        else
        {
            return redirect()->route('login', 302);
        }
    }

	

    public function ImprimerHistoriqueResultat(Request $request)
    {


    		if($request['date_debut'] != null && $request['date_fin'] !=  null)
			{					
				$dossiers = Dossier::where('created_at', '>=',$request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->orderBy('created_at', 'desc')->where('statut', '1')->get();
				$valTotal = 0;
				$result = array();	
				$this->addEvent('impression_histrorique_factures', $request->ip(),0, Auth::id(), "Impression Historique Factures Du " .  $request['date_debut'] . ' Au ' . $request['date_fin']);
				foreach($dossiers as $dossier)
				{
					$patient = Patient::find($dossier->id_patient);
					$total = ExamenDossier::where('code_dossier', $dossier->id)->sum('prix_net');
					$user = User::find($dossier->id_agent);
					$agent_editeur = AgentEditeur::find($dossier->id_agent_editeur);
					if($total == 0)
					{
						continue;
					}
					if($agent_editeur != null)
					{
						$collection = collect([
						'id' => $dossier->id,						
						'date_dossier' => $dossier->created_at->toDateString(),
						'prescripteur' => $dossier->nom_prescripteur,
						'edite_par' => $user->name,
						'numero_facture' => $dossier->numero_facture,

						'facture_par' => $agent_editeur->nom_agent,
						'etat' => $dossier->etat,
						'reduction' => $dossier->reduction,
						'total' => $total,
						'nom_patient' => $patient->nom_patient,
						]);

					array_push($result, $collection);
					$valTotal += $total;
					}
					else
					{
						$collection = collect([
						'id' => $dossier->id,						
						'date_dossier' => $dossier->created_at->toDateString(),
						'prescripteur' => $dossier->nom_prescripteur,
						'edite_par' => $user->name,
						'numero_facture' => $dossier->numero_facture,

						'facture_par' => '',
						'etat' => $dossier->etat,
						'reduction' => $dossier->reduction,
						'total' => $total,
						'nom_patient' => $patient->nom_patient,
						]);

					array_push($result, $collection);
					$valTotal += $total;
					}

				}
					
				$bottom_margin = 20;
	            $page_height = 279.4;
	            
	            $fpdf = new PDFHistoriqueResultat('P','mm', 'A4');
	            $fpdf->SetAuthor('GELAM');
	            $fpdf->SetAuthor('GELAM');
	            $fpdf->SetCreator('GELAM');

	            $fpdf->SetAutoPageBreak(false);
	            //Creation de la Premiere Page
	            $fpdf->AddPage();
	             $fpdf->Image('logo1.jpg', 10,10, 40);
	            $fpdf->Image('logo2.jpg', 170,10, 20);
	            $fpdf->SetTextColor(0,72,0);   

                  $fpdf->SetFont('Times', 'BI', 15);
                  //Ajout d'un espacement au debut
                  $fpdf->Cell(180, 7,'', 0, 1, 'C');  
                  //Creation du titre proprement dit
                  $fpdf->Cell(7, 4,'', 0, 0, 'C'); 

                  $fpdf->Cell(0, 6,'CENTRE D\'ANIMATION SOCIALE ET SANITAIRE', 0, 1, 'C');
                  $fpdf->SetFont('Times', 'B', 18);
                  $fpdf->Cell(0, 5, $this->gerer('LABORATOIRE'), 0, 1, 'C');
                  $fpdf->SetTextColor(0,0,0); 

                  $fpdf->SetFont('Courier', 'B', 12);
                  $fpdf->Cell(0, 5, $this->gerer('HEMATOLOGIE - BIOCHIMIE - BACTERIOLOGIE'), 0, 1, 'C');
                  $fpdf->Cell(0, 5, $this->gerer('IMMUNOLOGIE - PARASITOLOGIE - SEROLOGIE '), 0, 1, 'C');
                  $fpdf->SetFont('Times', '', 10);
                  $fpdf->Cell(0, 5, $this->gerer('BP : 185 Yaoundé-Cameroun - Téléphone : (+237) 222 220 403'), 0, 1, 'C');
                  $fpdf->Cell(0, 5, $this->gerer('Email : cassnkolndongo@yahoo.fr'), 0, 1, 'C');
                  $fpdf->SetFont('Times', 'B', 10);
                  $fpdf->SetTextColor(255,0,0);   
                  $fpdf->Cell(0, 5, $this->gerer('Situé à Nkolndongo'), 0, 1, 'C');
                  $fpdf->SetTextColor(0,0,0);   

                  $fpdf->SetDrawColor(0,72,0);   
                  $fpdf->SetLineWidth(0.5);
                  $fpdf->Line(20,55, 190, 55);
                  $fpdf->Line(20,268, 190, 268);

                  $fpdf->Ln(10);  


                  //Fin de l'en tete


                  $fpdf->SetFont('Times', 'BU', 15);

			$fpdf->Cell(0, 5, 'Historique des Factures du ' . $request['date_debut'] . ' Au ' . $request['date_fin'], 0, 1, 'C');
			$fpdf->Ln();

			//Debut de la boucle

				$date = '';
				$dates = array();
				$totalx = 0;

				foreach ($result as $res)
				{
					$collection = collect([
                  			'date' => $res['date_dossier'],
                  		]);

					$fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $request);

                  		if(!$this->DateExist($dates, $collection))
                  		{
                  			array_push(	$dates, $collection);
                  			$fpdf->Ln(2);
                  			$fpdf->SetFont('Times', 'B', 15);
                  			$fpdf->Cell(10, 7, '', 0,0);
							$fpdf->Cell(70, 7, 'Date du ' . $res['date_dossier'], 0, 1);
                  			$fpdf->Ln(5);

                  		}
                  			$fpdf->SetFont('Times', 'B', 8);
                  			$fpdf->Cell(10, 7, '', 0,0);

                  		$fpdf->Cell(70, 7, $this->gerer('Dossier N°' . sprintf('%06d',$res['id']) . ', Prescrit Par : '. $res['prescripteur'] . ', Edité Par : '. $res['edite_par'] . ', Facturé Par : '. $res['facture_par']), 0, 1);
                  		$fpdf->Ln(2);	
                  		$fpdf->SetFont('Times', 'B', 10);
						$fpdf->SetFillColor(200,200,200);
						$fpdf->Cell(10, 7, '', 0, 0);
						$fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $request);
	                  $fpdf->Cell(10, 7,$this->gerer("Code") , 'LTB', 0, 'C', true);
	                  $fpdf->Cell(15, 7,$this->gerer("Quantité") , 1, 0, 'C', true);
	                  $fpdf->Cell(60, 7,$this->gerer("Libellé") , 1, 0, 'C', true); 
	                  $fpdf->Cell(23, 7,$this->gerer("P.U") , 1, 0, 'C', true);  
	                  $fpdf->Cell(23, 7,$this->gerer("P.T") , 1, 0, 'C', true);  
	                  $fpdf->Cell(14, 7,$this->gerer("Red(%)") , 1, 0, 'C', true);  
	                  $fpdf->Cell(25, 7,$this->gerer("Net") , 1, 1, 'C', true); 

	                  $examens_dossiers = ExamenDossier::where('code_dossier', $res['id'])->get();
	                  $prix_total = 0;
	                  $prix_net = 0;
	                  $fpdf->Ln(2);	
	                  foreach($examens_dossiers	as $examen)
	                  {
	                  	  $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $request);
	                  	  $fpdf->SetFont('Times', 'B', 10);
	                  	  $fpdf->Cell(10, 7, '', 0, 0);
	                  	  $exam = Examen::find($examen->code_examen);
		                  $fpdf->Cell(10, 7,$this->gerer($examen->code_examen) , 0, 0, 'C');
		                  $fpdf->Cell(15, 7,$this->gerer($examen->quantite) , 0, 0, 'C');
		                  $fpdf->Cell(60, 7,$this->gerer($exam->libelle_examen) , 0, 0, 'C'); 
		                  $fpdf->Cell(23, 7,$this->gerer($examen->prix_unitaire) , 0, 0, 'C');  
		                  $fpdf->Cell(23, 7,$this->gerer($examen->prix_total) , 0, 0, 'C');  
		                  $fpdf->Cell(14, 7,$this->gerer($res['reduction']) , 0, 0, 'C');  
		                  $fpdf->Cell(25, 7,$this->gerer($examen->prix_net) , 0, 1, 'C'); 
		                  $prix_total += $examen->prix_total;
		                  $prix_net += $examen->prix_net;
	                  } 
	                  $fpdf->SetFillColor(184,220,220);
	                  $fpdf->Ln(2);

	                  $fpdf->Cell(10, 7, '', 0, 0);
	                  $fpdf->Cell(108, 7,$this->gerer("") , 1, 0, 'C', true);	                   
	                  $fpdf->Cell(23, 7,$this->gerer($prix_total) , 'BT', 0, 'C', true);  
	                  $fpdf->Cell(14, 7,$this->gerer($res['reduction']) , 1, 0, 'C', true);  
	                  $fpdf->Cell(25, 7,$this->gerer($prix_net) , 1, 1, 'C', true); 
	                  $totalx += $prix_net;

	                  $fpdf->Ln(5);
				}	
					$fpdf->SetFont('Times', 'BU', 15);

          			$fpdf->Cell(180, 7, 'TOTAL : ' .  number_format($totalx, 0, '', ' '), 0, 0, 'R');

	            $fpdf->output();
			}			
			else
			{							
				return view('dashboard_historique_facture');
			}	

    }

    public function gerer($str)
    {
      return iconv('UTF-8', 'windows-1252', $str);
    } 

     public function DateExist($groups, $group)
    {
      foreach($groups as $gp)
      {
          if($gp['date'] == $group['date'])
        {
          return true;
        }
      }
      return false;
    }

     public function CheckPiedsDePage($fpdf, $page_height, $request)
    {

          if(30 >= ($page_height - $fpdf->GetY()))
            {

               $fpdf->AddPage(); // page break.
               $fpdf->Ln(5);    
 				$fpdf->SetFont('Times', 'BU', 14);
               $fpdf->Cell(0, 7, $this->gerer("HISTORIQUE DES FACTURES DU ". $request['date_debut'] ." AU " . $request['date_fin']), 0, 1, 'C');
	          $fpdf->Ln(3);

	           $fpdf->SetFillColor(200,200,200);
	                  
            }
            return $fpdf; 
    }	
}

class PDFHistoriqueResultat extends FPDF
  {
    public $date = "";
    function Footer()
    {
    		
        // Go to 1.5 cm from bottom
        $this->SetY(-30 );
        // Select Arial italic 8
        $this->SetFont('Arial','IB',6);
        
        // Print centered page number
        
        $this->Cell(186,5,'Page '.$this->PageNo(),0,0,'R');
    }

    public function gerer($str)
    {
      return iconv('UTF-8', 'windows-1252', $str);
    } 
  }
