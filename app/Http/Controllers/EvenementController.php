<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Activity;
use App\Evenement;
use App\User;
use Codedge\Fpdf\Fpdf\Fpdf;
use Auth;
use Illuminate\Support\Facades\DB;


class EvenementController extends Controller
{
   // Import at the top


		public function Show(Request $request)
		{
				
		}

		public function GetConnectedUsers(Request $request)
		 {
		 	$activities = Activity::users(2)->get();
		 	$result = array();
			foreach ($activities as $activity) 
			{
				$user = User::find($activity->user_id);
				//$events = Evenement::where('event', 'connexion_utilisateur')->where('id_user', $activity->user_id)->get();
				$event = Evenement::where('event', 'connexion_utilisateur')->where('id_user', $activity->user_id)->orderBy('created_at', 'desc')->first();
				$parts = explode(' ', $event->created_at);
				$collection = collect([
					'matricule' => $user->id,
					'ip_address'	=> gethostbyaddr($activity->ip_address),
					'nom_user' => $user->name,
					//'nbre_connexion' => count($events),
					'heure_connexion' => $parts[1],
					]);
				array_push($result, $collection);
			}
           	$this->addEvent('ouverture_utilisateurs_connectes', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Liste Utilisateurs Connectes ");

			return view('dashboard_utilisateurs_connectes')->withConnectes(json_encode($result));


		 }

		

		 public function GetHistoriqueConnection(Request $request)
		 {

		 	/*$collection = collect([
			 			'matricule' => $event->id_user,
			 			'nom' => $user->name,
			 			'topic' => $event->libelle_event,
			 			'address_ip' => $event->address_ip,
			 			'date' => $event->created_at->toDateString(),
			 			'heure' => $event->created_at->toTimeString(),
			 					]);	*/


		 	
           	$this->addEvent('ouverture_historique_connexion', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Historique des Connexions");

			return view('dashboard_historique_connexions');


		 }

		 public function GetListeHistoriqueConnexion(Request $request)
		 {
					 	if(Auth::check())
			        {
			             $columns = array(
			                0 => 'matricule',
			                1 => 'nom',
			                2 => 'topic',
			                3 => 'address_ip',
			                4 => 'date',
			                6 => 'heure',
			            );

			             if($request['date_debut'] == null)
			             {
			             	$request['date_debut'] = date('Y-m-d');
			             }

			             if($request['date_fin'] == null)
			             {
			             	$request['date_fin'] = date('Y-m-d');
			             }

			           
			           $totalData = DB::select('select count(*) from evenements where evenements.created_at <= \''.$request['date_fin'] .' 23:59:59\' and evenements.created_at >= \''. $request['date_debut'] .' 00:00:00\'')[0]->count;

			            $totalFiltered = 0;
			            $limit = $request->input('length');
			            if($limit == -1)
			            {
			                $limit = "ALL";
			            }
			            $start = $request->input('start');          
			            $patients2 = array();

			            if(empty($request->input('search.value')))
			            {
			                $patients2 = DB::select('select evenements.id_user as matricule, users.name as nom, evenements.libelle_event as topic, evenements.address_ip, evenements.created_at as date from evenements, users where evenements.id_user = users.id and evenements.created_at <= \''.$request['date_fin'] .' 23:59:59\' and evenements.created_at >= \''. $request['date_debut'] .' 00:00:00\' order by date desc limit ' . $limit . ' offset ' . $start);
			                $totalFiltered = $totalData;
			            }
			            else
			            {
			                $search = "'%" . strtoupper(str_replace('\'', '\'\'',$request->input('search.value'))) . "%'";

			                $patients2 = DB::select('select evenements.id_user as matricule, users.name as nom, evenements.libelle_event as topic, evenements.address_ip, evenements.created_at as date from evenements, users where evenements.id_user = users.id and evenements.created_at <= \''.$request['date_fin'] .' 23:59:59\' and evenements.created_at >= \''. $request['date_debut'] .' 00:00:00\' and (upper(users.name) like '. $search .' or upper(evenements.libelle_event) like '. $search .') order by date desc limit ' . $limit . ' offset ' . $start);
			                $totalFiltered = count($patients2);

			            } 
			             

			            $data = array();  

			            if($patients2)
			            {
			                foreach ($patients2 as $row)
			                {
			                   $nestedData['matricule'] = sprintf("%06d",$row->matricule);
			                   $nestedData['nom'] = $row->nom;
			                   $nestedData['topic'] = $row->topic;
			                   $nestedData['address_ip'] = $row->address_ip;
			                   $nestedData['date'] = date('d-m-Y', strtotime($row->date));
			                   $nestedData['heure'] = date('H:m:i', strtotime($row->date));

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

		 public function UserExist($groups, $group)
	    {
	      foreach($groups as $gp)
	      {
	          if($gp['nom_user'] == $group['nom_user'])
	        {
	          return true;
	        }
	      }
	      return false;
	    }

	    public function ImprimerHistoriqueConnexion(Request $request)
	    {
	    	$result = array();
		 	$events = Evenement::where('created_at', '>=',$request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->orderBy('created_at', 'desc')->get();
		 	foreach($events as $event)
		 	{
		 		$user = User::find($event->id_user);
		 		$collection = collect([
		 			'matricule' => $event->id_user,
		 			'nom' => $user->name,
		 			'topic' => $event->libelle_event,
		 			'address_ip' => $event->address_ip,
		 			'date' => $event->created_at->toDateString(),
		 			'heure' => $event->created_at->toTimeString(),
		 					]);	
		 		array_push($result, $collection);
		 	}		

			if($request->ajax())
			{
				$result = array();
			 	$events = Evenement::where('created_at', '>=',$request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->orderBy('created_at', 'desc')->get();
			 	foreach($events as $event)
			 	{
			 		$user = User::find($event->id_user);
			 		$collection = collect([
			 			'matricule' => $event->id_user,
			 			'nom' => $user->name,
			 			'topic' => $event->libelle_event,
			 			'address_ip' => $event->address_ip,
			 			'date' => $event->created_at->toDateString(),
			 			'heure' => $event->created_at->toTimeString(),
			 					]);	
			 		array_push($result, $collection);
			 	}	
				return response()->json([
							'historiques' => json_encode($result),
						], 200);
			}
           	$this->addEvent('ouverture_historique_connexion', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Historique des Connexions");

			$this->Generer($request, $result);
	    }

	    public function Generer($request, $result)
	    {
	    	 $bottom_margin = 20;
            $page_height = 279.4;
           
            //Intanciation Du PDF
            $fpdf = new PDFHistoriqueConnexion('P','mm', 'A4');
            $fpdf->SetAuthor('GELAM');
            $fpdf->SetCreator('GELAM');

            $fpdf->SetAutoPageBreak(false);
            //Creation de la Premiere Page
            $fpdf->AddPage();

            //Ajout des Deux Logos (Droite et Gauche)
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
	          $fpdf->Cell(0, 5, $this->gerer('IMMUNOLOGIE - IMMUNO-BACTERIOLOGIE - SEROLOGIE '), 0, 1, 'C');
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
	          $fpdf->Line(20,273, 190, 273);

	          $fpdf->Ln();

              $fpdf->SetFont('Times', 'BU', 14);
              $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
              $fpdf->SetDrawColor(0,0,0); 

	          $fpdf->Ln(2);

	          $fpdf->Cell(0, 7, $this->gerer("HISTORIQUE DES CONNEXIONS DU ". $request['date_debut'] ." AU " . $request['date_fin']), 0, 1, 'C');
	          $fpdf->Ln(3);

	           $fpdf->SetFillColor(200,200,200);
	           $fpdf->SetFont('Times', 'B', 12);

	           	  $fpdf->Cell(5, 7, '', 0,0);	
                  $fpdf->Cell(20, 7,'Matr', 'LBT', 0, 'C', true);

                  $fpdf->Cell(20, 7,$this->gerer("Nom") , 'TB', 0, 'C', true);
                  $fpdf->Cell(60, 7,$this->gerer("Topic") , 'TB', 0, 'C', true);
                  $fpdf->Cell(30, 7,$this->gerer("Hôte") , 'TB', 0, 'C', true);
                  $fpdf->Cell(23, 7,$this->gerer("Le") , 'TB', 0, 'C', true);  
                  $fpdf->Cell(35, 7,$this->gerer("A") , 'TRB', 1, 'C', true);
                  $fpdf->Ln(1);
                  $fpdf->SetFont('Times', '', 12);

                  foreach ($result as $event)
                  {
                  	  $fpdf->Cell(5, 7, '', 0,0);	
                  	  $x = $fpdf->GetX();
                      $y = $fpdf->GetY();
	                  $fpdf->MultiCell(20, 5,$this->gerer(sprintf("%06d",$event['matricule'])), 0,'C');
	                  $fpdf->SetXY($x + 20, $y);
	                  $fpdf->MultiCell(20, 5,$this->gerer($event['nom']) , 0, 'C');
	                   $fpdf->SetXY($x + 40, $y);
	                  $fpdf->MultiCell(60, 5,$this->gerer($event['topic']), 0,'C');
	                   $fpdf->SetXY($x + 100, $y);
	                  $fpdf->MultiCell(30, 5,$this->gerer($event['address_ip']) , 0, 'L');
 					  $fpdf->SetXY($x + 130, $y);
	                  $fpdf->MultiCell(23, 5,$this->gerer($event['date']) , 0, 'C');  
	                   $fpdf->SetXY($x + 153, $y);
	                  $fpdf->MultiCell(35, 5,$this->gerer($event['heure']) , 0,'C');
	                  $fpdf->Ln(15);
	                  $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $request);
                  }
            $fpdf->Output('I', 'Cahier de Paillasse', true);
	    }

	    public function gerer($str)
    {
      return iconv('UTF-8', 'windows-1252', $str);
    } 

     public function CheckPiedsDePage($fpdf, $page_height, $request)
    {

          if(15 >= ($page_height - $fpdf->GetY()))
            {

               $fpdf->AddPage(); // page break.
               $fpdf->Ln(5);    
 				$fpdf->SetFont('Times', 'BU', 14);
               $fpdf->Cell(0, 7, $this->gerer("HISTORIQUE DES CONNEXIONS DU ". $request['date_debut'] ." AU " . $request['date_fin']), 0, 1, 'C');
	          $fpdf->Ln(3);

	           $fpdf->SetFillColor(200,200,200);
	           $fpdf->SetFont('Times', 'B', 12);

	           	  $fpdf->Cell(10, 7, '', 0,0);	
                  $fpdf->Cell(20, 7,'Matr', 'LBT', 0, 'L', true);

                  $fpdf->Cell(20, 7,$this->gerer("Nom") , 'TB', 0, 'L', true);
                  $fpdf->Cell(60, 7,$this->gerer("Topic") , 'TB', 0, 'L', true);
                  $fpdf->Cell(25, 7,$this->gerer("Hôte") , 'TB', 0, 'L', true);

                  $fpdf->Cell(23, 7,$this->gerer("Le") , 'TB', 0, 'L', true);  
                  $fpdf->Cell(23, 7,$this->gerer("A") , 'TRB', 1, 'L', true);
                  $fpdf->Ln(1);
                  $fpdf->SetFont('Times', '', 12);            
            }
            return $fpdf; 
    }

}

class PDFHistoriqueConnexion extends FPDF
  {
    public $date = "";
    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-30 );
        // Select Arial italic 8
        $this->SetFont('Arial','IB',6);
        
                 
        $this->Line(20,273, 190, 273);

        $this->Ln(5); 
        $this->Cell(186,5,'Page '.$this->PageNo(),0,0,'R');
    }

    public function gerer($str)
    {
      return iconv('UTF-8', 'windows-1252', $str);
    } 
  }
