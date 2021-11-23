<?php

namespace App\Http\Controllers;
use Auth;
use App\ExamenDossier;
use App\Examen;
use App\Dossier;
use App\Patient;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon; 
use \Datetime;
use App\Serotheque;
use App\NatureEchantillon;
use App\PathologieLiee;
use App\Quartier;
use App\AgentEditeur;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Unite;


class EtatController extends Controller
{
    public function EtatChiffreAffaireAnnuel(Request $request)
    {
    	if(Auth::check())
		{
			if($request['annee'] != null)
			{
				$examensd = ExamenDossier::whereYear('created_at', $request['annee'])->get();
			//	dd($examensd);
				$examens = Examen::where('statut', '1')->get();
				$result = array();
				$annee = $request['annee'];
				$val_total = 0;
				$nbre_total = 0;

				foreach($examens as $exam)
				{
					
					if(count($examensd->where('code_examen', $exam->id)) != 0)
					{
						$collection = collect([
							'id_examen' => $exam->id,
							'annee' => $annee,
							'analyse' => $exam->libelle_examen,
							'nombre' => $examensd->where('code_examen', $exam->id)->sum('quantite'),
							'montant' => $examensd->where('code_examen', $exam->id)->sum('prix_net'),
						]);
						array_push($result, $collection);
						$nbre_total += $examensd->where('code_examen', $exam->id)->sum('quantite');
						$val_total += $examensd->where('code_examen', $exam->id)->sum('prix_net');
					}
				}

				$this->addEvent('etat_chiffre_annuel', $request->ip(),0, Auth::id(), "Affichage de l'Etat du chiffre d'affaire Annuel ");
				return response()->json([
					'analyses' => json_encode($result),
					'nombre' => $nbre_total,
					'total' => $val_total,
				], 200);
			}
			else
			{
				return redirect()->route('login', 302);
			}
		}
		else
		{
			return redirect()->route('login', 302);
		}
    }

    public function EtatChiffreAffaireHebdomadaire(Request $request)
    {
    	if(Auth::check())
		{
			if($request['annee'] != null && $request['mois'] != null)
			{
				$this->addEvent('etat_chiffre_hebdomadaire', $request->ip(),0, Auth::id(), "Affichage de l'Etat du chiffre d'affaire Hebodomadaire ");
				$max = cal_days_in_month(CAL_GREGORIAN, $request['mois'], $request['annee']);					
				$examens = Examen::where('statut', '1')->get();
				$result = array();
				$val_total = 0;
				$nbre_total = 0;
			//	dd($du . ' au ' . $au);
				foreach($examens as $exam)
				{
					$du = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-01';
					$au = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-07';
					$val = 0;
					$nbre = 0;
					for($i = 1; $i < 8; $i++)
					{
						$examensd = ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->get();
						if(count($examensd) == 0)
						{
							continue;
						}
						else
						{
							$nbre += count($examensd);
							$val += ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->sum('prix_net');
						}	

						
					}
						if($nbre != 0)
						{
							$collection = collect([
							'du' => $du,
							'au' => $au,
							'analyses' => $exam->libelle_examen,
							'nbre' => $nbre,
							'montant' => $val,						
						]);
							
						$val_total += $val;
						$nbre_total += $nbre;
						array_push($result, $collection);
						}
					
						

						$val = 0;
						$nbre = 0;
						$du = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-08';
						$au = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-14';
					for($i = 8; $i < 15; $i++)
					{
						$examensd = ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->get();
						if(count($examensd) == 0)
						{
							continue;
						}
						else
						{
							$nbre += count($examensd);
							$val += ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->sum('prix_net');
						}	

						
					}
						if($nbre != 0)
						{
							$collection = collect([
							'du' => $du,
							'au' => $au,
							'analyses' => $exam->libelle_examen,
							'nbre' => $nbre,
							'montant' => $val,
							]);
							$val_total += $val;
							$nbre_total += $nbre;
							array_push($result, $collection);

						}
					
						
						$val = 0;
						$nbre = 0;
						$du = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-15';
						$au = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-21';
						for($i = 15; $i < 22; $i++)
						{
							$examensd = ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->get();
							if(count($examensd) == 0)
							{
								continue;
							}
							else
							{
								$nbre += count($examensd);
								$val += ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->sum('prix_net');
							}	

							
						}
							if($nbre != 0)
							{
								$collection = collect([
								'du' => $du,
								'au' => $au,
								'analyses' => $exam->libelle_examen,
								'nbre' => $nbre,
								'montant' => $val,
							]);
							$val_total += $val;
							$nbre_total += $nbre;
							array_push($result, $collection);
							}
						
							
							$val = 0;
							$nbre = 0;
							$du = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-22';
							$au = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.$max;
							for($i = 22; $i < $max + 1; $i++)
							{
								$examensd = ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->get();
								if(count($examensd) == 0)
								{

									continue;
								}
								else
								{
									$nbre += count($examensd);
									$val += ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->sum('prix_net');
								}	
								
							}
						if($nbre != 0)
						{
							$collection = collect([
							'du' => $du,
							'au' => $au,
							'analyses' => $exam->libelle_examen,
							'nbre' => $nbre,
							'montant' => $val,
						]);

						$val_total += $val;
						$nbre_total += $nbre;
						array_push($result, $collection);
						}
					
						
						
				}


				
				return response()->json([
					'analyses' => json_encode($result),
					'nombre' => $nbre_total,
					'total' => $val_total,
				], 200);
			}
			else
			{
				return redirect()->route('login', 302);
			}
		}		
		else
		{
			return redirect()->route('login', 302);
		}
    }

    public function EtatChiffreAffaireMensuel(Request $request)
    {
    	if(Auth::check())
		{
			if($request['annee'] != null)
			{
				$this->addEvent('etat_chiffre_mensuel', $request->ip(),0, Auth::id(), "Affichage de l'Etat du chiffre d'affaire Mensuel");
				$examensd = ExamenDossier::whereYear('created_at', $request['annee'])->get();
				$examens = Examen::where('statut', '1')->get();
				$result = array();
				$annee = $request['annee'];
				$val_total = 0;
				$nbre_total = 0;

				foreach($examens as $exam)
				{
					
					if(count($examensd->where('code_examen', $exam->id)) != 0)
					{
						for($i = 1; $i < 13; $i++)
						{
							$tab = ExamenDossier::whereYear('created_at', $request['annee'])->whereMonth('created_at', $i)->where('code_examen', $exam->id)->get();
							if(count($tab) != 0)
							{
								$collection  = collect([
									'mois' => $this->get_month_name($i),
									'analyse' => $exam->libelle_examen,
									'nombre' => $tab->where('code_examen', $exam->id)->sum('quantite'),
									'montant' => $tab->where('code_examen', $exam->id)->sum('prix_net'),
								]);

								array_push($result, $collection);
								$nbre_total += $tab->where('code_examen', $exam->id)->sum('quantite');
								$val_total += $tab->where('code_examen', $exam->id)->sum('prix_net');
							}
						}
					}
				}
				return response()->json([
					'analyses' => json_encode($result),
					'nombre' => $nbre_total,
					'total' => $val_total,
				], 200);

			}
			else
			{
				return redirect()->route('login', 302);
			}
		}
		else
		{
			return redirect()->route('login', 302);
		}
    }

    public function EtatChiffreAffaireQuotidien(Request $request)
    {
    	if(Auth::check())
		{
			if($request['date'] != null)
			{
				$this->addEvent('etat_chiffre_quotidien', $request->ip(),0, Auth::id(), "Affichage de l'Etat du chiffre d'affaire Quotidien ");
				$examensd = ExamenDossier::whereDate('created_at', $request['date'])->get();
				$examens = Examen::where('statut', '1')->get();
				$result = array();
				$date = $request['date'];
				$val_total = 0;
				$nbre_total = 0;

				foreach($examens as $exam)
				{
					
					if(count($examensd->where('code_examen', $exam->id)) != 0)
					{
						$collection = collect([
							'date' => $date,
							'analyse' => $exam->libelle_examen,
							'nombre' => $examensd->where('code_examen', $exam->id)->sum('quantite'),
							'montant' => $examensd->where('code_examen', $exam->id)->sum('prix_net'),

						]);
						array_push($result, $collection);
						$nbre_total += $examensd->where('code_examen', $exam->id)->sum('quantite');
						$val_total += $examensd->where('code_examen', $exam->id)->sum('prix_net');
					}
				}
				return response()->json([
					'analyses' => json_encode($result),
					'nombre' => $nbre_total,
					'total' => $val_total,
				], 200);	
			}
			else
			{
				return redirect()->route('login', 302);
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
          if($gp['libelle_examen'] == $group['libelle_examen'])
        {
          return true;
        }
      }
      return false;
    }

    public function get_month_name($month)
	{
	    $months = array(
	        1   =>  'Janvier',
	        2   =>  'Février',
	        3   =>  'Mars',
	        4   =>  'Avril',
	        5   =>  'Mai',
	        6   =>  'Juin',
	        7   =>  'Juillet',
	        8   =>  'Août',
	        9   =>  'Septembre',
	        10  =>  'Octobre',
	        11  =>  'Novembre',
	        12  =>  'Décembre'
	    );

	    return $months[$month];
	}

	public function getListeImpayes(Request $request)
	{
		if(Auth::check())
		{
			$this->addEvent('etat_impayes', $request->ip(),0, Auth::id(), "Affichage de l'Etat des Dossiers Impayés ");
			$dossiers  = Dossier::where('numero_facture', null)->where('statut', '1')->get();
			$result = array();
			$total = 0;
			$agent_editeurs = AgentEditeur::where('statut', '1')->orderBy('nom_agent')->get();
			$examens = Examen::where('statut', 1)->get();

			foreach($dossiers as $dossier)
			{
				
				$patient = Patient::find($dossier->id_patient);
				$edited = User::find($dossier->id_agent);
				$user = User::find($dossier->id_agent);
				$collection = collect([
					'id_dossier' => $dossier->id,
					'patient' => $patient->nom_patient,
					'date_dossier' => $dossier->created_at->toDateString(),
					'heure_dossier' => $dossier->created_at->toTimeString(),
					'edite_par' => $user->name ,
					'montant' => ExamenDossier::where('code_dossier', $dossier->id)->sum('prix_net'),
					'unite' => Unite::find($dossier->unite)->libelle_unite,
				]);
				array_push($result, $collection);
				$total += ExamenDossier::where('code_dossier', $dossier->id)->sum('prix_net');
			}

			return view('dashboard_impayes')
								->withDossiers(json_encode($result))
								->withTotal($total)
								->withAgentEditeurs($agent_editeurs)
								->withExamens($examens);

		}
		else
		{
			return redirect()->route('login', 302);
		}

	}


	public function ImprimerImpaye(Request $request)
	{
		if(Auth::check())
		{
				$this->addEvent('imprimer_impayes', $request->ip(),0, Auth::id(), "Impression de l'Etat des Dossiers Impayés ");
				$dossiers  = Dossier::where('numero_facture', null)->where('statut', '1')->get();
				$result = array();
				$total = 0;
				$agent_editeurs = AgentEditeur::where('statut', '1')->orderBy('nom_agent')->get();

				foreach($dossiers as $dossier)
				{
					$patient = Patient::find($dossier->id_patient);
					$edited = User::find($dossier->id_agent);
					$user = User::find($dossier->id_agent);
					$collection = collect([
						'id_dossier' => $dossier->id,
						'patient' => $patient->nom_patient,
						'date_dossier' => $dossier->created_at->toDateString(),
						'heure_dossier' => $dossier->created_at->toTimeString(),
						'edite_par' => $user->name ,
						'montant' => ExamenDossier::where('code_dossier', $dossier->id)->sum('prix_net'),
						'unite' => Unite::find($dossier->unite)->libelle_unite,
					]);
					array_push($result, $collection);

					$total += ExamenDossier::where('code_dossier', $dossier->id)->sum('prix_net');
				}	
				$bottom_margin = 20;
                $page_height = 279.4;
                
                $fpdf = new PDFBiotheque('P','mm', 'A4');
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
	              $fpdf->SetFont('Times', 'BU', 14);
	              $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
	              $fpdf->SetDrawColor(0,0,0); 

		          $fpdf->Ln(4);
		          $title = "ETATS DES IMPAYES";
		          $fpdf->Cell(0, 7, $this->gerer($title), 0, 1, 'C');
		          $fpdf->Ln(5);
		          $fpdf->SetFont('Times', 'B', 10);
				  $fpdf->SetFillColor(200,200,200);
				  $fpdf->Cell(7, 7, '', 0, 0);
	              $fpdf->Cell(20, 7,$this->gerer("N° Dossier") , 1, 0, 'C', true);
	              $fpdf->Cell(70, 7,$this->gerer("Noms du Patient") , 1, 0, 'C', true); 
	              $fpdf->Cell(25, 7,$this->gerer("Date Dossier") , 1, 0, 'C', true);  
	              $fpdf->Cell(25, 7,$this->gerer("Heure Dossier") , 1, 0, 'C', true);  
	              $fpdf->Cell(20, 7,$this->gerer("Edité Par") , 1, 0, 'C', true);  
	              $fpdf->Cell(20, 7,$this->gerer("Montant") , 1, 0, 'C', true);  
	              $fpdf->Ln(10);
	              $fpdf->SetFont('Times', '', 10);
	               foreach($result as $res)
	          {
	          	  $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $request, $title);
	          	 
	          	  $fpdf->Cell(7, 7, '', 0, 0);		
	          	  $x = $fpdf->GetX();
                  $y = $fpdf->GetY();
	          	  $fpdf->MultiCell(20, 7,$this->gerer(sprintf("%06d", $res['id_dossier'])) , 0, 'C');
	          	  $fpdf->SetXY($x + 20, $y);
	              $fpdf->MultiCell(70, 7,$this->gerer($res['patient']) , 0, 'C'); 
	              $fpdf->SetXY($x + 90, $y);
	              $fpdf->MultiCell(25, 7,$this->gerer($res['date_dossier']) , 0, 'C');  
	              $fpdf->SetXY($x + 115, $y);
	              $fpdf->MultiCell(25, 7,$this->gerer($res['heure_dossier']) , 0, 'C');  
	              $fpdf->SetXY($x + 140, $y);
	              $fpdf->MultiCell(20, 7,$this->gerer($res['edite_par']) , 0, 'C');  
	              $fpdf->SetXY($x + 160, $y);
	              $fpdf->MultiCell(20, 7,$this->gerer($res['montant']) , 0, 'C'); 
	              
	              $fpdf->Ln(5);

	          }	 


	          $fpdf->SetFont('Times', 'BU', 15);
          			$fpdf->Cell(185, 7, 'TOTAL : ' .  $total, 0, 0, 'R');


		          $fpdf->output();
		        
		}
		else
		{
			return redirect()->route('login', 302);
		}	
	}

	public function PayerFacture(Request $request)
	{
		if(Auth::check())
		{


			$dossier = Dossier::find($request['id_dossier']);
			$this->addEvent('paiement_impaye', $request->ip(),0, Auth::id(), "Paiemement de Dossier Impayé => " . sprintf("%06d", $dossier->id));
			$dossier->numero_facture = $request['numero_facture'];
			$dossier->id_agent_editeur = $request['id_agent_editeur'];
			if($dossier->save())
			{
				$dossiers  = Dossier::where('numero_facture', null)->where('statut', '1')->get();
				$result = array();
				$total = 0;
				$agent_editeurs = AgentEditeur::where('statut', '1')->orderBy('nom_agent')->get();

				foreach($dossiers as $dossier)
				{
					$patient = Patient::find($dossier->id_patient);
					$edited = User::find($dossier->id_agent);
					$user = User::find($dossier->id_agent);
					$collection = collect([
						'id_dossier' => $dossier->id,
						'patient' => $patient->nom_patient,
						'date_dossier' => $dossier->created_at->toDateString(),
						'heure_dossier' => $dossier->created_at->toTimeString(),
						'edite_par' => $user->name ,
						'montant' => ExamenDossier::where('code_dossier', $dossier->id)->sum('prix_net'),
					]);
					array_push($result, $collection);
					$total += ExamenDossier::where('code_dossier', $dossier->id)->sum('prix_net');
				}

				return response()
					->json([
						'success' => 'Le Paiement a été enregistré avec succès !',
						'dossiers' => json_encode($result),	
						'total' => $total,						
							], 200);
			}
			else
			{
				return response()
					->json([
						'erreur' => 'Une erreur est survenue pendant le paiement !',], 200); 					
			}

		}
		else
		{
			return redirect()->route('login', 302);
		}
	}

	
function getDays($year, $dow = 1, $format = "Y-m-d") { 
    static $days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"); 

    $results = array(); 
   
    for ($date = strtotime(date("Y-m-d", mktime(0, 0, 0, 1, 0, $year)) . " next " . $days[$dow] . " 12:00:00"); 
         date("Y", $date) == $year; 
         $date = strtotime(date("r", $date) . " +1 week")) 
        $results[] = date($format, $date); 

    return $results; 
}


     public function  gerer($str)
     {
      return iconv('UTF-8', 'windows-1252', $str);
    } 

     public function ImprimerChiffreQuotidien(Request $request)
    {
       	if(Auth::check())
		{
			if($request['date'] != null)
			{	
				$this->addEvent('impression_chiffre_quotidien', $request->ip(),0, Auth::id(), "Impression Chiffre d'Affaire Quotidien du  " . $request['date'] );			
				$examensd = ExamenDossier::whereDate('created_at', $request['date'])->get();
			//	dd($examensd);
				$examens = Examen::where('statut', '1')->get();
				$result = array();
				$date = $request['date'];
				$val_total = 0;
				$nbre_total = 0;
				foreach($examens as $exam)
				{
					
					if(count($examensd->where('code_examen', $exam->id)) != 0)
					{
						$collection = collect([
							'date' => $date,
							'analyse' => $exam->libelle_examen,
							'nombre' => $examensd->where('code_examen', $exam->id)->sum('quantite'),
							'montant' => $examensd->where('code_examen', $exam->id)->sum('prix_net'),
						]);
						array_push($result, $collection);
						$nbre_total += $examensd->where('code_examen', $exam->id)->sum('quantite');
						$val_total += $examensd->where('code_examen', $exam->id)->sum('prix_net');
					}
				}
				$bottom_margin = 20;
                $page_height = 279.4;
                
                $fpdf = new PDFBiotheque('P','mm', 'A4');
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
	              $fpdf->SetFont('Times', 'BU', 14);
	              $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
	              $fpdf->SetDrawColor(0,0,0); 

		          $fpdf->Ln(4);
		          $title = "ETATS DU CHIFFRE D'AFFAIRE QUOTIDIEN DU " . $request['date'];
		          $fpdf->Cell(0, 7, $this->gerer($title), 0, 1, 'C');
		          $fpdf->Ln(5);
		          $fpdf->SetFont('Times', 'B', 10);
				  $fpdf->SetFillColor(200,200,200);
				  $fpdf->Cell(7, 7, '', 0, 0);
	              $fpdf->Cell(30, 7,$this->gerer("Date") , 1, 0, 'C', true);
	              $fpdf->Cell(108, 7,$this->gerer("Analyses") , 1, 0, 'C', true); 
	              $fpdf->Cell(10, 7,$this->gerer("Nbre") , 1, 0, 'C', true);  
	              $fpdf->Cell(30, 7,$this->gerer("Total CA") , 1, 0, 'C', true);  
	              $fpdf->Ln(10);	
	              $fpdf->SetFont('Times', '', 10);

	              foreach($result as $res)
	              {	 
	              		$this->CheckPiedsDePage($fpdf, $page_height, $request, $title);
	              		 $fpdf->Cell(7, 7, '', 0, 0);
			              $fpdf->Cell(30, 7,$this->gerer($res['date']) , 0, 0, 'C', false);
			              $fpdf->Cell(108, 7,$this->gerer($res['analyse']) , 0, 0, 'C', false); 
			              $fpdf->Cell(10, 7,$this->gerer($res['nombre']) , 0, 0, 'C', false);  
			              $fpdf->Cell(30, 7,$this->gerer($res['montant']) , 0, 1, 'C', false);  
	              }

	               $fpdf->SetFillColor(184,220,220);
	                  $fpdf->Ln(2);
	              $fpdf->SetFont('Times', 'B', 10);

	                  $fpdf->Cell(7, 7, '', 0, 0);
	                  $fpdf->Cell(138, 7,$this->gerer("") , 1, 0, 'C', true);	                   
	                  $fpdf->Cell(10, 7,$this->gerer($nbre_total) , 1, 0, 'C', true);  
	                  $fpdf->Cell(30, 7,$this->gerer(number_format($val_total, 0, '', ' ')) , 1, 1, 'C', true); 
	              $fpdf->output();
			}
			else
			{
				return redirect()->route('login', 302);
			}
		}
		else
		{
			return redirect()->route('login', 302);
		}	
    }

     public function ImprimerChiffreMensuel(Request $request)
    {
       	if(Auth::check())
		{
			if($request['annee'] != null)
			{	
				$this->addEvent('impression_chiffre_mensuel', $request->ip(),0, Auth::id(), "Impression Chiffre d'Affaire Mensuel de  " . $request['annee'] );			
				$examensd = ExamenDossier::whereYear('created_at', $request['annee'])->get();
				$examens = Examen::where('statut', '1')->get();
				$result = array();
				$annee = $request['annee'];
				$val_total = 0;
				$nbre_total = 0;

				foreach($examens as $exam)
				{
					
					if(count($examensd->where('code_examen', $exam->id)) != 0)
					{
						for($i = 1; $i < 13; $i++)
						{
							$tab = ExamenDossier::whereYear('created_at', $request['annee'])->whereMonth('created_at', $i)->where('code_examen', $exam->id)->get();
							if(count($tab) != 0)
							{
								$collection  = collect([
									'mois' => $this->get_month_name($i),
									'analyse' => $exam->libelle_examen,
									'nombre' => $tab->where('code_examen', $exam->id)->sum('quantite'),
									'montant' => $tab->where('code_examen', $exam->id)->sum('prix_net'),
								]);

								array_push($result, $collection);
								$nbre_total += $tab->where('code_examen', $exam->id)->sum('quantite');
								$val_total += $tab->where('code_examen', $exam->id)->sum('prix_net');
							}
						}
					}
				}
				$bottom_margin = 20;
                $page_height = 279.4;
                
                $fpdf = new PDFBiotheque('P','mm', 'A4');
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
	              $fpdf->SetFont('Times', 'BU', 14);
	              $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
	              $fpdf->SetDrawColor(0,0,0); 

		          $fpdf->Ln(4);
		          $title = "ETATS DU CHIFFRE D'AFFAIRE MENSUEL DE " . $request['annee'];
		          $fpdf->Cell(0, 7, $this->gerer($title), 0, 1, 'C');
		          $fpdf->Ln(10);
	              $dates = array();
	              foreach($result as $res)
	              {	 
	              		$collection = collect([
                  			'mois' => $res['mois'],
                  		]);

					$fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $request, $title);

                  		if(!$this->MoisExist($dates, $collection))
                  		{
                  			array_push(	$dates, $collection);
                  			$fpdf->Ln(2);
                  			$fpdf->SetFont('Times', 'B', 15);
                  			$fpdf->Cell(10, 7, '', 0,0);
							$fpdf->Cell(70, 7, 'Mois de ' . $res['mois']. ' ' . $request['annee'], 0, 1);
                  			$fpdf->Ln(5);
                  			$fpdf->SetFont('Times', 'B', 10);
						  $fpdf->SetFillColor(200,200,200);
						  $fpdf->Cell(7, 7, '', 0, 0);
			              $fpdf->Cell(138, 7,$this->gerer("Analyses") , 1, 0, 'C', true); 
			              $fpdf->Cell(10, 7,$this->gerer("Nbre") , 1, 0, 'C', true);  
			              $fpdf->Cell(30, 7,$this->gerer("Total CA") , 1, 0, 'C', true);  
			              $fpdf->Ln(10);	
			              $fpdf->SetFont('Times', '', 10);

                  		}
                  		$fpdf->SetFont('Times', 'B', 10);

	              		$this->CheckPiedsDePage($fpdf, $page_height, $request, $title);
	              		 $fpdf->Cell(7, 7, '', 0, 0);
			              $fpdf->Cell(138, 7,$this->gerer($res['analyse']) , 0, 0, 'L', false); 
			              $fpdf->Cell(10, 7,$this->gerer($res['nombre']) , 0, 0, 'C', false);  
			              $fpdf->Cell(30, 7,$this->gerer($res['montant']) , 0, 1, 'C', false);  
	              }

	               $fpdf->SetFillColor(184,220,220);
	                  $fpdf->Ln(2);
	              $fpdf->SetFont('Times', 'B', 10);

	                  $fpdf->Cell(7, 7, '', 0, 0);
	                  $fpdf->Cell(138, 7,$this->gerer("") , 1, 0, 'C', true);	                   
	                  $fpdf->Cell(10, 7,$this->gerer($nbre_total) , 1, 0, 'C', true);  
	                  $fpdf->Cell(30, 7,$this->gerer($val_total) , 1, 1, 'C', true); 
	              $fpdf->output();
			}
			else
			{
				return redirect()->route('login', 302);
			}
		}
		else
		{
			return redirect()->route('login', 302);
		}	
    }

     public function ImprimerChiffreHebdomadaire(Request $request)
    {
       	if(Auth::check())
		{
			if($request['annee'] != null && $request['mois'] != null)
			{	
			$this->addEvent('impression_chiffre_hebdomadaire', $request->ip(),0, Auth::id(), "Impression Chiffre d'Affaire Hebdomadaire de  " . $request['annee'] . ' '. $request['mois'] );			
				$max = cal_days_in_month(CAL_GREGORIAN, $request['mois'], $request['annee']);	
				$du = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-01';
				$au = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-07';
				$examens = Examen::where('statut', '1')->get();
				$result = array();
				$val_total = 0;
				$nbre_total = 0;
				
				foreach($examens as $exam)
				{
					$du = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-01';
					$au = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-07';
					$val = 0;
					$val = 0;
					$nbre = 0;
					for($i = 1; $i < 8; $i++)
					{
						$examensd = ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->get();
						if(count($examensd) == 0)
						{
							continue;
						}
						else
						{
							$nbre += count($examensd);
							$val += ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->sum('prix_net');
						}	

						
					}
						if($nbre != 0)
						{
							$collection = collect([
							'du' => $du,
							'au' => $au,
							'analyses' => $exam->libelle_examen,
							'nbre' => $nbre,
							'montant' => $val,
						]);

						$val_total += $val;
						$nbre_total += $nbre;
						array_push($result, $collection);
						}
					
						

						$val = 0;
						$nbre = 0;
						$du = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-08';
						$au = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-14';
					for($i = 8; $i < 15; $i++)
					{
						$examensd = ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->get();
						if(count($examensd) == 0)
						{
							continue;
						}
						else
						{
							$nbre += count($examensd);
							$val += ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->sum('prix_net');
						}	

						
					}
						if($nbre != 0)
						{
							$collection = collect([
							'du' => $du,
							'au' => $au,
							'analyses' => $exam->libelle_examen,
							'nbre' => $nbre,
							'montant' => $val,
						]);

						$val_total += $val;
						$nbre_total += $nbre;
						array_push($result, $collection);

						}
					
						
						$val = 0;
						$nbre = 0;
						$du = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-15';
						$au = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-21';
						for($i = 15; $i < 22; $i++)
						{
							$examensd = ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->get();
							if(count($examensd) == 0)
							{
								continue;
							}
							else
							{
								$nbre += count($examensd);
								$val += ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->sum('prix_net');
							}	

							
						}
							if($nbre != 0)
							{
								$collection = collect([
								'du' => $du,
								'au' => $au,
								'analyses' => $exam->libelle_examen,
								'nbre' => $nbre,
								'montant' => $val,
							]);

							$val_total += $val;
							$nbre_total += $nbre;
							array_push($result, $collection);
							}
						
							
							$val = 0;
							$nbre = 0;
							$du = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-22';
							$au = $request['annee']. '-'.sprintf('%02d',$request['mois']).'-28';
							for($i = 22; $i < 29; $i++)
							{
								$examensd = ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->get();
								if(count($examensd) == 0)
								{

									continue;
								}
								else
								{
									$nbre += count($examensd);
									$val += ExamenDossier::whereDate('created_at', $request['annee']. '-'.sprintf('%02d',$request['mois']).'-'.sprintf("%02d", $i))->where('code_examen', $exam->id)->sum('prix_net');
								}	
								
							}
						if($nbre != 0)
						{
							$collection = collect([
							'du' => $du,
							'au' => $au,
							'analyses' => $exam->libelle_examen,
							'nbre' => $nbre,
							'montant' => $val,
						]);

						$val_total += $val;
						$nbre_total += $nbre;
						array_push($result, $collection);
						}					
						
						
				}
				$bottom_margin = 20;
                $page_height = 279.4;
                
                $fpdf = new PDFBiotheque('P','mm', 'A4');
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
	              $fpdf->SetFont('Times', 'BU', 14);
	              $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
	              $fpdf->SetDrawColor(0,0,0); 

		          $fpdf->Ln(4);
		          $title = "ETATS DU CHIFFRE D'AFFAIRE HEBDOMADAIRE DE " . $this->get_month_name	($request['mois']) . ' '. $request['annee'];
		          $fpdf->Cell(0, 7, $this->gerer($title), 0, 1, 'C');
		          $fpdf->Ln(10);
	              $dates = array();
	              foreach($result as $res)
	              {	 
	              		$collection = collect([
                  			'mois' => $res['du'] . ' Au ' . $res['au'],
                  		]);

					$fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $request, $title);

                  		if(!$this->MoisExist($dates, $collection))
                  		{
                  			array_push(	$dates, $collection);
                  			$fpdf->Ln(2);
                  			$fpdf->SetFont('Times', 'B', 15);
                  			$fpdf->Cell(10, 7, '', 0,0);
							$fpdf->Cell(70, 7, 'Semaine  du ' . $res['du']. ' Au ' . $res['au'], 0, 1);
                  			$fpdf->Ln(5);
                  			$fpdf->SetFont('Times', 'B', 10);
						  $fpdf->SetFillColor(200,200,200);
						  $fpdf->Cell(7, 7, '', 0, 0);
			              $fpdf->Cell(138, 7,$this->gerer("Analyses") , 1, 0, 'C', true); 
			              $fpdf->Cell(10, 7,$this->gerer("Nbre") , 1, 0, 'C', true);  
			              $fpdf->Cell(30, 7,$this->gerer("Total CA") , 1, 0, 'C', true);  
			              $fpdf->Ln(10);	
			              $fpdf->SetFont('Times', '', 10);

                  		}
                  		$fpdf->SetFont('Times', 'B', 10);

	              		$this->CheckPiedsDePage($fpdf, $page_height, $request, $title);
	              		 $fpdf->Cell(7, 7, '', 0, 0);
			              $fpdf->Cell(138, 7,$this->gerer($res['analyses']) , 0, 0, 'L', false); 
			              $fpdf->Cell(10, 7,$this->gerer($res['nbre']) , 0, 0, 'C', false);  
			              $fpdf->Cell(30, 7,$this->gerer($res['montant']) , 0, 1, 'C', false);  
	              }

	               $fpdf->SetFillColor(184,220,220);
	                  $fpdf->Ln(2);
	              $fpdf->SetFont('Times', 'B', 10);

	                  $fpdf->Cell(7, 7, '', 0, 0);
	                  $fpdf->Cell(138, 7,$this->gerer("") , 1, 0, 'C', true);	                   
	                  $fpdf->Cell(10, 7,$this->gerer($nbre_total) , 1, 0, 'C', true);  
	                  $fpdf->Cell(30, 7,$this->gerer($val_total) , 1, 1, 'C', true); 
	              $fpdf->output();
			}
			else
			{
				return redirect()->route('login', 302);
			}
		}
		else
		{
			return redirect()->route('login', 302);
		}	
    }

     public function ImprimerEtatBiotheque(Request $request)
    {
       	if(Auth::check())
		{
			$this->addEvent('impression_etat_biotheque', $request->ip(),0, Auth::id(), "Impression de la Biothèque ");
			$serotheque =  Serotheque::where('statut', '1')->get();
    		$result = array();
    		foreach($serotheque as $sero)
    		{
    			if($request['id_pathologie'] != null)
    			{
    				if($sero->id_pathologie != $request['id_pathologie'])
    				{
    					continue;
    				}
    			}

    			if($request['id_nature'] != null)
    			{
    				if($sero->id_nature != $request['id_nature'])
    				{
    					continue;
    				}
    			}

    			if($request['genre'] != 'tous')
				{
					if($request['genre'] == 'hommes')
					{
						if($sero->genre != 'Homme')
						{
							continue;
						}
					}
					else if($request['genre'] == 'femmes')
					{
						if($sero->genre != 'Femme')
						{
							continue;
						}
					}
					else if($request['genre'] == 'enceintes')
					{
						if($sero->genre != 'Femme Enceinte')
						{
							continue;
						}
					}
				}

				if($request['age_min'] != null)
				{
					$bday = new DateTime($sero->date_naissance);
					$today = new DateTime($sero->created_at);			
					$diff = $today->diff($bday);
					$age = $diff->y ;
					if($age <= $request['age_min'])
					{
						continue;
					}
				}

				if($request['age_max'] != null)
				{
					$bday = new DateTime($sero->date_naissance);
					$today = new DateTime($sero->created_at);			
					$diff = $today->diff($bday);
					$age = $diff->y ;
					if($age >= $request['age_max'])
					{
						continue;
					}
				}

				array_push($result, $sero);

    		}
			$bottom_margin = 20;
	        $page_height = 279.4;
	        
	        $fpdf = new PDFBiotheque('P','mm', 'A4');
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
	          $fpdf->SetFont('Times', 'BU', 14);
	          $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
	          $fpdf->SetDrawColor(0,0,0); 

	          $fpdf->Ln(4);
	          $title = "ETATS DE LA BIOTHEQUE";
	          $fpdf->Cell(0, 7, $this->gerer($title), 0, 1, 'C');
	          $fpdf->Ln(5);
	          $fpdf->SetFont('Times', 'B', 10);
			  $fpdf->SetFillColor(200,200,200);
			  $fpdf->Cell(7, 7, '', 0, 0);
              $fpdf->Cell(20, 7,$this->gerer("Carac ID") , 1, 0, 'C', true);
              $fpdf->Cell(20, 7,$this->gerer("Nature") , 1, 0, 'C', true); 
              $fpdf->Cell(30, 7,$this->gerer("Pathologie Liée") , 1, 0, 'C', true);  
              $fpdf->Cell(30, 7,$this->gerer("Genre") , 1, 0, 'C', true);  
              $fpdf->Cell(25, 7,$this->gerer("Date Naissance") , 1, 0, 'C', true);  
              $fpdf->Cell(30, 7,$this->gerer("Prelevé le") , 1, 0, 'C', true);  
              $fpdf->Cell(30, 7,$this->gerer("Quartier") , 1, 1, 'C', true);  
              $fpdf->Ln(2);
               $fpdf->SetFont('Times', '', 8);
              foreach($result as $res)
	          {
	          	  $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $request, $title);
	          	  $nature = NatureEchantillon::find($res->id_nature);
	          	  $pathologie = PathologieLiee::find($res->id_pathologie);
	          	  $quartier = Quartier::find($res->id_quartier);
	          	  $fpdf->Cell(7, 7, '', 0, 0);		
	          	  $x = $fpdf->GetX();
                  $y = $fpdf->GetY();
	          	  $fpdf->MultiCell(20, 7,$this->gerer($res->caractere_id) , 0, 'C');
	          	  $fpdf->SetXY($x + 20, $y);
	              $fpdf->MultiCell(20, 7,$this->gerer($nature->libelle_nature) , 0, 'C'); 
	              $fpdf->SetXY($x + 40, $y);
	              $fpdf->MultiCell(30, 7,$this->gerer($pathologie->libelle_pathologie) , 0, 'C');  
	              $fpdf->SetXY($x + 70, $y);
	              $fpdf->MultiCell(30, 7,$this->gerer($res->genre) , 0, 'C');  
	              $fpdf->SetXY($x + 100, $y);
	              $fpdf->MultiCell(25, 7,$this->gerer($res->date_naissance) , 0, 'C');  
	              $fpdf->SetXY($x + 125, $y);
	              $fpdf->MultiCell(30, 7,$this->gerer($res->preleve_le) , 0, 'C'); 
	              $fpdf->SetXY($x + 155, $y); 
	              $fpdf->MultiCell(30, 7,$this->gerer($quartier->libelle_quartier) , 0, 'C'); 
	              $fpdf->Ln(7);

	          }	 


	              $fpdf->Ln(10);	
	              $fpdf->SetFont('Times', '', 10);
	          $fpdf->output();
			
		}
		else
		{
			return redirect()->route('login', 302);
		}	
    }

    public function MoisExist($groups, $group)
    {
      foreach($groups as $gp)
      {
          if($gp['mois'] == $group['mois'])
        {
          return true;
        }
      }
      return false;
    }

    public function ImprimerChiffreAnnuel(Request $request)
    {
       	if(Auth::check())
		{
			if($request['annee'] != null)
			{			
				$this->addEvent('impression_chiffre_annuel', $request->ip(),0, Auth::id(), "Impression Chiffre d'Affaire Annuel de  " . $request['annee'] );	
				$examensd = ExamenDossier::whereYear('created_at', $request['annee'])->get();
			//	dd($examensd);
				$examens = Examen::where('statut', '1')->get();
				$result = array();
				$annee = $request['annee'];
				$val_total = 0;
				$nbre_total = 0;

				foreach($examens as $exam)
				{
					
					if(count($examensd->where('code_examen', $exam->id)) != 0)
					{
						$collection = collect([
							'id_examen' => $exam->id,
							'annee' => $annee,
							'analyse' => $exam->libelle_examen,
							'nombre' => $examensd->where('code_examen', $exam->id)->sum('quantite'),
							'montant' => $examensd->where('code_examen', $exam->id)->sum('prix_net'),
						]);
						array_push($result, $collection);
						$nbre_total += $examensd->where('code_examen', $exam->id)->sum('quantite');
						$val_total += $examensd->where('code_examen', $exam->id)->sum('prix_net');
					}
				}

				$bottom_margin = 20;
                $page_height = 279.4;
                
                $fpdf = new PDFBiotheque('P','mm', 'A4');
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
	              $fpdf->SetFont('Times', 'BU', 14);
	              $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
	              $fpdf->SetDrawColor(0,0,0); 

		          $fpdf->Ln(4);
		          $title = "ETATS DU CHIFFRE D'AFFAIRE ANNUEL DE " . $request['annee'];
		          $fpdf->Cell(0, 7, $this->gerer($title), 0, 1, 'C');
		          $fpdf->Ln(5);
		          $fpdf->SetFont('Times', 'B', 10);
				  $fpdf->SetFillColor(200,200,200);
				 
	              $fpdf->Ln(10);
	              $dates = array();
	              foreach($result as $res)
	              {	 
	              		$collection = collect([
                  			'mois' => $res['annee'],
                  		]);

					$fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $request, $title);

                  		if(!$this->MoisExist($dates, $collection))
                  		{
                  			array_push(	$dates, $collection);
                  			$fpdf->Ln(2);
                  			$fpdf->SetFont('Times', 'B', 15);
                  			$fpdf->Cell(10, 7, '', 0,0);
							$fpdf->Cell(70, 7, 'ANNEE ' . $res['annee'], 0, 1);
                  			$fpdf->Ln(5);
                  			$fpdf->SetFont('Times', 'B', 10);
						  $fpdf->SetFillColor(200,200,200);
						  $fpdf->Cell(7, 7, '', 0, 0);
			              $fpdf->Cell(138, 7,$this->gerer("Analyses") , 1, 0, 'C', true); 
			              $fpdf->Cell(10, 7,$this->gerer("Nbre") , 1, 0, 'C', true);  
			              $fpdf->Cell(30, 7,$this->gerer("Total CA") , 1, 0, 'C', true);  
			              $fpdf->Ln(10);	
			              $fpdf->SetFont('Times', '', 10);

                  		}
                  		$fpdf->SetFont('Times', 'B', 10);
	              		$this->CheckPiedsDePage($fpdf, $page_height, $request, $title);
	              		 $fpdf->Cell(7, 7, '', 0, 0);
			              $fpdf->Cell(138, 7,$this->gerer($res['analyse']) , 0, 0, 'L', false); 
			              $fpdf->Cell(10, 7,$this->gerer($res['nombre']) , 0, 0, 'C', false);  
			              $fpdf->Cell(30, 7,$this->gerer($res['montant']) , 0, 1, 'C', false);  
	              }

	               $fpdf->SetFillColor(184,220,220);
	                  $fpdf->Ln(2);
	              $fpdf->SetFont('Times', 'B', 10);
	              $this->CheckPiedsDePage($fpdf, $page_height, $request, $title);
	                  $fpdf->Cell(7, 7, '', 0, 0);
	                  $fpdf->Cell(138, 7,$this->gerer("") , 1, 0, 'C', true);	                   
	                  $fpdf->Cell(10, 7,$this->gerer($nbre_total) , 1, 0, 'C', true);  
	                  $fpdf->Cell(30, 7,$this->gerer($val_total) , 1, 1, 'C', true); 
	              $fpdf->output();
			}
			else
			{
				return redirect()->route('login', 302);
			}
		}
		else
		{
			return redirect()->route('login', 302);
		}	
    }

     public function CheckPiedsDePage($fpdf, $page_height, $request, $title)
    {

          if(30 >= ($page_height - $fpdf->GetY()))
            {

               $fpdf->AddPage(); // page break.
               $fpdf->Ln(5);    
 				$fpdf->SetFont('Times', 'BU', 14);
               $fpdf->Cell(0, 7, $this->gerer($title), 0, 1, 'C');
	          $fpdf->Ln(3);

	           $fpdf->SetFillColor(200,200,200);
	                  
            }
            return $fpdf; 
    }

    public function EtatBiotheque(Request $request)
    {
    	if(Auth::check())
		{
			if(!$request->ajax())
			{
				$serotheque =  Serotheque::where('statut', '1')->get();
            $natures = NatureEchantillon::orderBy('libelle_nature')->get();
            $pathologies = PathologieLiee::orderBy('libelle_pathologie')->get();
            $quartiers = Quartier::orderBy('libelle_quartier')->get();
            $this->addEvent('ouverture_biotheque', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Biotheque");

    		
				return view('dashboard_etats_biotheques')->withSerotheques($serotheque)
                                               ->withNatures($natures)
                                               ->withPathologies($pathologies)
                                               ->withQuartiers($quartiers);
			}
		}
		else
		{
			return redirect()->route('login', 302);
		}
    }

    public function RechercherBiotheque(Request $request)
    {
    	if(Auth::check())
    	{
    		$serotheque =  Serotheque::where('statut', '1')->get();
    		$result = array();
    		foreach($serotheque as $sero)
    		{
    			if($request['id_pathologie'] != null)
    			{
    				if($sero->id_pathologie != $request['id_pathologie'])
    				{
    					continue;
    				}
    			}

    			if($request['id_nature'] != null)
    			{
    				if($sero->id_nature != $request['id_nature'])
    				{
    					continue;
    				}
    			}

    			if($request['genre'] != 'tous')
				{
					if($request['genre'] == 'hommes')
					{
						if($sero->genre != 'Homme')
						{
							continue;
						}
					}
					else if($request['genre'] == 'femmes')
					{
						if($sero->genre != 'Femme')
						{
							continue;
						}
					}
					else if($request['genre'] == 'enceintes')
					{
						if($sero->genre != 'Femme Enceinte')
						{
							continue;
						}
					}
				}

				if($request['age_min'] != null)
				{
					$bday = new DateTime($sero->date_naissance);
					$today = new DateTime($sero->created_at);			
					$diff = $today->diff($bday);
					$age = $diff->y ;
					if($age <= $request['age_min'])
					{
						continue;
					}
				}

				if($request['age_max'] != null)
				{
					$bday = new DateTime($sero->date_naissance);
					$today = new DateTime($sero->created_at);			
					$diff = $today->diff($bday);
					$age = $diff->y ;
					if($age >= $request['age_max'])
					{
						continue;
					}
				}

				array_push($result, $sero);

    		}

    		return response()
                        ->json([
                            'serotheque' => json_encode($result),                            
                        ], 200)
                        ;

   		}
   		else
   		{
   			return redirect()->route('login', 302);
   		}	
    }



}

class PDFEtat extends FPDF
  {
    public $date = "";
    function Footer()
    {            
        // Go to 1.5 cm from bottom
        $this->SetY(-20 );
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
