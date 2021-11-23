<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Dossier;
use App\Examen;
use App\TypeExamen;
use App\GroupeExamen;
use App\ExamenDossier;
use App\Resultat;
use App\Patient;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\URL;
use DateTime;
use Illuminate\Support\Facades\DB;

class CahierPaillasseController extends Controller
{
    public function Show(Request $request)
	{
		if(Auth::check())
		{
			if($request['date_debut'] != null && $request['date_fin'] !=  null)
			{
									
				//$result = DB::select('select distinct groupe_examens.libelle_groupe_examen, groupe_examens.id as id_groupe_examen from examen_dossiers, resultats, examens, groupe_examens, dossiers where examen_dossiers.preleve = 1 and not examen_dossiers.id in (select id_dossier_examen as id from resultats) and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and dossiers.statut = \'1\' and dossiers.id = examen_dossiers.code_dossier and dossiers.date_dossier <= \''. $request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] . ' 00:00:00\' UNION select distinct groupe_examens.libelle_groupe_examen, groupe_examens.id as id_groupe_examen from examen_dossiers, resultats, examens, groupe_examens, dossiers where examen_dossiers.preleve = 1 and resultats.id_dossier_examen = examen_dossiers.id and resultats.valide = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and dossiers.statut = \'1\' and dossiers.id = examen_dossiers.code_dossier and dossiers.date_dossier <= \''. $request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] . ' 00:00:00\'');
            	$result = DB::select('select distinct groupe_examens.libelle_groupe_examen, groupe_examens.id as id_groupe_examen from examen_dossiers, examens, groupe_examens, dossiers where examen_dossiers.preleve = 1 and examen_dossiers.technique = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and dossiers.statut = \'1\' and dossiers.id = examen_dossiers.code_dossier UNION select distinct groupe_examens.libelle_groupe_examen, groupe_examens.id as id_groupe_examen from examen_dossiers, resultats, examens, groupe_examens, dossiers where examen_dossiers.preleve = 1 and resultats.id_dossier_examen = examen_dossiers.id and resultats.valide = 0 and examen_dossiers.code_examen = examens.id and examens.id_groupe_examen = groupe_examens.id and dossiers.statut = \'1\' and dossiers.id = examen_dossiers.code_dossier and dossiers.date_dossier <= \''. $request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] . ' 00:00:00\'');

            	$this->addEvent('ouverture_cahier_paillasse', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Cahier de Paillasse ");

				return response()->json([
										'dossiers1' => json_encode($result),
										 ], 200);
			}
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
	
	public function getDossiersGroupeExamen(Request $request)
	{
		
		if(Auth::check() || true)
		{
			if($request['date_debut'] != null && $request['date_fin'] !=  null)
			{
				$groups  = GroupeExamen::all();
				$dossiers = Dossier::where('date_dossier', '>=',$request['date_debut']. ' 00:00:00')->where('date_dossier', '<=', $request['date_fin'] . ' 23:59:59')->where('statut', '1')->get();
				$result = array();
				$i = 0;
				$group = GroupeExamen::find($request['id']);
					foreach($dossiers as $dossier)
					{
						$examens = ExamenDossier::where('code_dossier', $dossier->id)->where('preleve', 1)->get();

							foreach ($examens as $examen)
							 {
							 	$exam = Examen::find($examen->code_examen);
							 	if($exam->id_groupe_examen != $group->id)
							 	{
							 		continue;
							 	}
							 	$resultats = Resultat::where('id_dossier_examen', $examen->id)->get();
							 	if(count($resultats) != 0)
							 	{
							 		continue;
							 	}

							 	$patient = Patient::find($dossier->id_patient);
							 	if( $dossier->id_patient == 31)
							 	{
							 		continue;
							 	}
							 	try
							 	{
							 		if($patient == null)
							 			continue;
							 		$date_dossier = new DateTime($dossier->date_dossier);
								 	$bday = new DateTime($patient->date_naissance);
									$today = new DateTime($dossier->date_dossier);			
									$diff = $today->diff($bday);
									$age = $diff->y . ' an(s) ' . $diff->m . ' mois ';
								 	$collection = collect([
								 		'id' => $i,
										'libelle_examen' => $exam->libelle_examen,
										'id_examen' => $exam->id,
										'nom' => $patient->nom_patient,
										'sexe' => $patient->sexe,
										'age' => $age,
										'id_dossier' => sprintf("%06d", $dossier->id),
										'date_dossier' => $date_dossier->format('d/m/Y h:i:s'), 
										]);							 	
										
										array_push($result, $collection);
										$i = $i+1;		
							 	}
							 	catch(exception $e)
							 	{
							 		continue;
							 	}
							 								
							 }								
							
					}			


					
				

				$result2 = array();
					
				foreach($result as $res)
				{
					$collection = collect([
							 		'id_examen' => $res['id_examen'],
									'libelle_examen' => $res['libelle_examen'],]);
					if(!$this->ExamenExist($result2, $collection))
								{
									
									array_push($result2, $collection);

								}	
									
					
				}

				$date_debut = new DateTime($request['date_debut']);
				$date_fin = new DateTime($request['date_fin']);
				$date = "Du " . $date_debut->format('d/m/Y') . " Au ". $date_fin->format('d/m/Y');

				 usort($result2, array($this, "cmp1"));
				 usort($result, array($this, "cmp2"));
            	$this->addEvent('impression_cahier_paillasse', $request->ip(),0, Auth::id(), "Impression du  Cahier de Paillasse Pour le groupe d'examen => " . $group->libelle_groupe_examen);

				$this->GenererCahierPaillasseGroupeExamen($result2, $result, $date, $group->libelle_groupe_examen);

				 return response()->json([
										'date' => "Du " . $request['date_debut'] . " Au ". $request['date_fin'],
										'libelle_groupe' => 'toto',
										'liste_dossier' => json_encode($result),
										'liste_examens' => json_encode($result2),

										 ], 200);
				}
			
		}
		else
		{
			return redirect()->route('login', 302);
		}
		
	}

	function cmp1($a, $b)
	{
	    return strcmp($a['libelle_examen'], $b['libelle_examen']);
	}
	function cmp2($a, $b)
	{
	    return strcmp($a['nom'], $b['nom']);
	}



	public function getListeExamensresults($values)
	{
		$listeExamens = array();

		foreach($values as $value)
		{

		}
	}
	
	public function ExamenExist($groups, $group)
	{
		foreach($groups as $gp)
		{
				if($gp['id_examen'] == $group['id_examen'])
			{
				return true;
			}
		}
		return false;
	}


	public function GenererCahierPaillasseGroupeExamen($liste_examens, $liste_dossiers, $date, $group)
	{
				//Paramètres de Fonctionnement
				$bottom_margin = 20;
				$page_height = 279.4;
				

				//Intanciation Du PDF
				$fpdf = new PDFPaillasse('P','mm', 'A4');
				$fpdf->SetAuthor('GELAM');
				$fpdf->SetCreator('GELAM');

				$fpdf->SetAutoPageBreak(false);
				$fpdf->date = $date;	
				//Creation de la Premiere Page
				$fpdf->AddPage();

				//Ajout des Deux Logos (Droite et Gauche)
				$fpdf->Image('logo1.jpg', 10,10, 40);
			    $fpdf->Image('logo2.jpg', 170,10, 20);



				//Creation de l'entête / Header	

					    $fpdf->SetFont('Courier', 'BU', 25);
					    $fpdf->SetTextColor(0,107,215);

			    		//Ajout d'un espacement au debut
					    $fpdf->Cell(180, 10,'', 0, 1, 'C');

					    //Creation du titre proprement dit
					    $fpdf->Cell(180, 10,'CAHIER DE PAILLASSE', 0, 1, 'C');
			    
			   			// Insertion de la Date
			   			$date = str_replace('-', '\\', $date);
			   			$fpdf->SetFont('Times', '', 12);
					    $fpdf->SetTextColor(0,0,0);
					    $fpdf->Cell(180, 5,$date, 0, 1, 'C');
					  	$fpdf->Ln();
					  	$fpdf->SetLineWidth(0.5);
					    $fpdf->Line(20,39, 190, 39);

					    $fpdf->Cell(165, 5,'Le, ' . date('d/m/Y'), 0, 1, 'R');

					    //insertion du titre $groupe $examen
					    $fpdf->SetFont('Courier', 'BU', 20);

					    $fpdf->Cell(60, 5, $group, 0, 1, 'R');
					  	$fpdf->Ln();



				//insertion des examens

					    foreach($liste_examens as $examen)
					    {
					    	if(15 >= ($page_height - $fpdf->GetY()))
					   		 		{

									     $fpdf->AddPage(); // page break.
									     $fpdf->Ln(10);
					   		 		} 
					    	$fpdf->SetTextColor(0,107,215);
					    	$fpdf->SetFont('Courier', 'BU', 16);
					    	$fpdf->Cell(10, 5,'', 0, 0, 'L');
					   		$fpdf->Cell(165, 5,$examen['libelle_examen'], 0, 1, 'L');
					   		$i = 1;
					   		$fpdf->Ln();
					   		$fpdf->SetFillColor(200,200,200);
			   		 		$fpdf->SetFont('Times', 'B', 12);
			   				$fpdf->SetTextColor(0,0,0);	
				   		 	$fpdf->Cell(10, 5,'', 0, 0, 'L');
				   		 	$fpdf->Cell(10, 5,$this->gerer('N°'), 1, 0, 'C', true);
				   		 	$fpdf->Cell(2, 5,'', 0, 0, 'L');
			   		 		$fpdf->Cell(70, 5, $this->gerer('Nom(s) et Prénom(s)'), 1, 0, 'L', true);
			   		 		$fpdf->Cell(2, 5,'', 0, 0, 'L');
			   		 		$fpdf->Cell(85, 5,$this->gerer('Résultat(s)'), 1, 1, 'C', true);

					   		 foreach($liste_dossiers as $dossier)
					   		 {


					   		 	if($dossier['id_examen'] == $examen['id_examen'])
					   		 	{
					   		 		if($examen['id_examen'] == 20 || $examen['id_examen'] == 21 || $examen['id_examen'] == 38)  //PV PCV PU
					   		 		{
					   		 				if(15 >= ($page_height - $fpdf->GetY()))
						   		 		{

										     $fpdf->AddPage(); // page break.
										     $fpdf->Ln(10);
						   		 		} 
					   		 		
					   		 		
						   		 		$fpdf->Ln(1);

						   		 		$fpdf->SetFillColor(255,255,255);	
						   		 		$fpdf->SetFont('Times', '', 8);
						   		 		$fpdf->Cell(10, 5,'', 0);
						   		 		$x = $fpdf->GetX();
										$y = $fpdf->GetY();
							   		 	$fpdf->MultiCell(10, 4,  " \n \n \n". $this->gerer($i) . "\n \n \n \n" , 1, 'C');
							   		 	$fpdf->Cell(2, 5,'', 0, 0, 'L');
							   		 	$fpdf->SetXY($x + 12, $y);
						   		 		$fpdf->MultiCell(70, 4, $this->gerer("\n".$dossier['nom']) . "\n" . 
						   		 								 $dossier['sexe']. ", " . $dossier['age'] ."\n" .
						   		 								$this->gerer("Dossier N°  " . $dossier['id_dossier']) . "\nDu " . 
						   		 								$this->gerer($dossier['date_dossier'] . "\n \n \n"), 1,'L');
						   		 		$fpdf->Cell(2, 5,'', 0, 0, 'L');
						   		 		$fpdf->SetXY($x + 14 + 70, $y);
						   		 		$fpdf->MultiCell(85, 4,  "TRICHO______________________LEUCO_____________________\n" . "CEL EPHITH__________________HEMATIES__________________\n" . "PN___________________________ COCCI_____________________ \n" . "BACCILES______________________DN_______________________ \nELTS LEVU_______________________________________________\nTYPE FLORE_________CONCLUSION________________________ __________________________________________________________", 1,'L');
		

						   		 		$i = $i + 1;
					   		 		}
					   		 		else if($examen['id_examen'] == 31 ) // COMBI 10
					   		 		{
					   		 				if(15 >= ($page_height - $fpdf->GetY()))
						   		 		{

										     $fpdf->AddPage(); // page break.
										     $fpdf->Ln(10);
						   		 		} 
					   		 		
					   		 		
						   		 		$fpdf->Ln(1);

						   		 		$fpdf->SetFillColor(255,255,255);	
						   		 		$fpdf->SetFont('Times', '', 8);
						   		 		$fpdf->Cell(10, 5,'', 0);
						   		 		$x = $fpdf->GetX();
										$y = $fpdf->GetY();
							   		 	$fpdf->MultiCell(10, 4,  " \n \n \n". $this->gerer($i) . "\n \n \n" , 1, 'C');
							   		 	$fpdf->Cell(2, 5,'', 0, 0, 'L');
							   		 	$fpdf->SetXY($x + 12, $y);
						   		 		$fpdf->MultiCell(70, 4, $this->gerer("\n".$dossier['nom']) . "\n" . 
						   		 								 $dossier['sexe']. ", " . $dossier['age'] ."\n" .
						   		 								$this->gerer("Dossier N°  " . $dossier['id_dossier']) . "\nDu " . 
						   		 								$this->gerer($dossier['date_dossier'] . "\n \n"), 1,'L');
						   		 		$fpdf->Cell(2, 5,'', 0, 0, 'L');
						   		 		$fpdf->SetXY($x + 14 + 70, $y);
						   		 		$fpdf->MultiCell(85, 4,  "SANG______________________URO__________________________\n" . "BILI_______________________PROTEINE_____________________\n" . "NITRITE__________________________PH_____________________ \n" . "CORPS CETONIQUES______________________________________\nACIDE ASCORBIQUE______________________________________\nGLUCOSE_________________LEUCOCYTES__________________", 1,'L');
		

						   		 		$i = $i + 1;
					   		 		}

					   		 		else if($examen['id_examen'] == 4 ) // WIDAL
					   		 		{
					   		 				if(15 >= ($page_height - $fpdf->GetY()))
						   		 		{

										     $fpdf->AddPage(); // page break.
										     $fpdf->Ln(10);
						   		 		} 
					   		 		
					   		 		
						   		 		$fpdf->Ln(1);

						   		 		$fpdf->SetFillColor(255,255,255);	
						   		 		$fpdf->SetFont('Times', '', 8);
						   		 		$fpdf->Cell(10, 5,'', 0);
						   		 		$x = $fpdf->GetX();
										$y = $fpdf->GetY();
							   		 	$fpdf->MultiCell(10, 4,  " \n \n". $this->gerer($i) . "\n \n" , 1, 'C');
							   		 	$fpdf->Cell(2, 5,'', 0, 0, 'L');
							   		 	$fpdf->SetXY($x + 12, $y);
						   		 		$fpdf->MultiCell(70, 4, $this->gerer($dossier['nom']) . "\n" . 
						   		 								 $dossier['sexe']. ", " . $dossier['age'] ."\n" .
						   		 								$this->gerer("Dossier N°  " . $dossier['id_dossier']) . "\nDu " . 
						   		 								$this->gerer($dossier['date_dossier']), 1,'L');
						   		 		$fpdf->Cell(2, 5,'', 0, 0, 'L');
						   		 		$fpdf->SetXY($x + 14 + 70, $y);
						   		 		$fpdf->MultiCell(85, 4,  "TO____________AO____________BO___________CO___________\n" . "\n" . "TH____________AH____________BH___________CH___________\n \n" , 1,'L');
		

						   		 		$i = $i + 1;
					   		 		}
					   		 		else
					   		 		{
					   		 				if(15 >= ($page_height - $fpdf->GetY()))
						   		 		{

										     $fpdf->AddPage(); // page break.
										     $fpdf->Ln(10);
						   		 		} 
					   		 		
					   		 		
						   		 		$fpdf->Ln(1);

						   		 		$fpdf->SetFillColor(255,255,255);	
						   		 		$fpdf->SetFont('Times', '', 8);
						   		 		$fpdf->Cell(10, 5,'', 0);
						   		 		$x = $fpdf->GetX();
										$y = $fpdf->GetY();
							   		 	$fpdf->MultiCell(10, 4, "\n ". $this->gerer($i) . "\n \n \n" , 1, 'C');
							   		 	$fpdf->Cell(2, 5,'', 0, 0, 'L');
							   		 	$fpdf->SetXY($x + 12, $y);
						   		 		$fpdf->MultiCell(70, 4, $this->gerer($dossier['nom']) . "\n" . 
						   		 								 $dossier['sexe']. ", " . $dossier['age'] ."\n" .
						   		 								$this->gerer("Dossier N°  " . $dossier['id_dossier']) . "\nDu " . 
						   		 								$this->gerer($dossier['date_dossier']), 1,'L');
						   		 		$fpdf->Cell(2, 5,'', 0, 0, 'L');
						   		 		$fpdf->SetXY($x + 14 + 70, $y);
						   		 		$fpdf->MultiCell(85, 4,  "\n" . "\n" . "\n" . "\n", 1,'L');
		

						   		 		$i = $i + 1;

					   		 		}	
					   		 				

					   		 	}
					   		 }

					   		 $fpdf->Ln();					   

					    }



		
			    $fpdf->Output('I', 'Cahier de Paillasse', true);
	}

	public function gerer($str)
	{
		return iconv('UTF-8', 'windows-1252', $str);
	}	

	public function GenererCahierPaillasseAll(Request $request)
	{
            	$this->addEvent('impression_cahier_paillasse_all', $request->ip(),0, Auth::id(), "Impression du  Cahier de Paillasse Pour tous les groupes d'examens");

				//Paramètres de Fonctionnement
				$bottom_margin = 20;
				$page_height = 279.4;
				

				//Intanciation Du PDF
				$fpdf = new PDFPaillasse('P','mm', 'A4');
				$fpdf->SetAuthor('GELAM');
				$fpdf->SetCreator('GELAM');

				$fpdf->SetAutoPageBreak(false);	
				$date_debut = new DateTime($request['date_debut']);
				$date_fin = new DateTime($request['date_fin']);
				$date = "Du " . $date_debut->format('d/m/Y') . " Au ". $date_fin->format('d/m/Y');
				$fpdf->date = $date;
				$groups  = GroupeExamen::all();
				$dossiers = Dossier::where('date_dossier', '>=',$request['date_debut']. ' 00:00:00')->where('date_dossier', '<=', $request['date_fin'] . ' 23:59:59')->where('statut', '1')->get();
				$result0 = array();
				foreach($groups as $group)
				{
					foreach($dossiers as $dossier)
					{
						$examens = ExamenDossier::where('code_dossier', $dossier->id)->where('preleve', 1)->get();

							foreach ($examens as $examen)
							 {
							 	$exam = Examen::find($examen->code_examen);
							 	if($exam->id_groupe_examen != $group->id)
							 	{
							 		continue;
							 	}
							 	$resultats = Resultat::where('id_dossier_examen', $examen->id)->get();
							 	if(count($resultats) != 0)
							 	{
							 		continue;
							 	}
							 	$collection = collect([
									'id_groupe_examen' => $group->id,
									'libelle_groupe_examen' => $group->libelle_groupe_examen,
									]);
							 	if(!$this->GroupeExamenExist($result0, $collection))
								{
									
									array_push($result0, $collection);

								}	
							 }			

								
							
					}					
				}
				foreach ($result0 as $group) 
				{
					$result = array();
					$i = 0;
					foreach($dossiers as $dossier)
					{
						$examens = ExamenDossier::where('code_dossier', $dossier->id)->where('preleve', 1)->get();
							foreach ($examens as $examen)
							 {
							 	$exam = Examen::find($examen->code_examen);
							 	if($exam->id_groupe_examen != $group['id_groupe_examen'])
							 	{
							 		continue;
							 	}
							 	$resultats = Resultat::where('id_dossier_examen', $examen->id)->get();
							 	if(count($resultats) != 0)
							 	{
							 		continue;
							 	}
							 	$patient = Patient::find($dossier->id_patient);
							 	$date_dossier = new DateTime($dossier->date_dossier);
							 	$collection = collect([
							 		'id' => $i,
									'libelle_examen' => $exam->libelle_examen,
									'id_examen' => $exam->id,
									'nom' => $patient->nom_patient,
									'id_dossier' => sprintf("%06d", $dossier->id),
									'date_dossier' => $date_dossier->format('d/m/Y h:i:s'), 
									]);							 	
									
									array_push($result, $collection);
									$i = $i+1;									
							 }								
							
					}			


					

				$result2 = array();
					
				foreach($result as $res)
				{
					$collection = collect([
							 		'id_examen' => $res['id_examen'],
									'libelle_examen' => $res['libelle_examen'],]);
					if(!$this->ExamenExist($result2, $collection))
								{
									
									array_push($result2, $collection);

								}	
									
					
				}

				$date_debut = new DateTime($request['date_debut']);
				$date_fin = new DateTime($request['date_fin']);
				$date = "Du " . $date_debut->format('d/m/Y') . " Au ". $date_fin->format('d/m/Y');

				 usort($result2, array($this, "cmp1"));
				 usort($result, array($this, "cmp2"));
					$fpdf = $this->AjouterUnGroupe($fpdf, $result2, $result, $date, $group['libelle_groupe_examen']);
				}	
				
				$fpdf->Output('I', 'Cahier de Paillasse - Toutes les Paillasses', true);

				
	}

	public function AjouterUnGroupe($fpdf, $liste_examens, $liste_dossiers, $date, $group)
	{
				$bottom_margin = 20;
				$page_height = 279.4;
				$fpdf->AddPage();

				//Ajout des Deux Logos (Droite et Gauche)
				$fpdf->Image('logo1.jpg', 10,10, 40);
			    $fpdf->Image('logo2.jpg', 170,10, 20);



				//Creation de l'entête / Header	

					    $fpdf->SetFont('Courier', 'BU', 25);
					    $fpdf->SetTextColor(0,107,215);

			    		//Ajout d'un espacement au debut
					    $fpdf->Cell(180, 10,'', 0, 1, 'C');

					    //Creation du titre proprement dit
					    $fpdf->Cell(180, 10,'CAHIER DE PAILLASSE', 0, 1, 'C');
			    
			   			// Insertion de la Date
			   			$date = str_replace('-', '\\', $date);
			   			$fpdf->SetFont('Times', '', 12);
					    $fpdf->SetTextColor(0,0,0);
					    $fpdf->Cell(180, 5,$date, 0, 1, 'C');
					  	$fpdf->Ln();
					  	$fpdf->SetLineWidth(0.5);
					    $fpdf->Line(20,39, 190, 39);

					    $fpdf->Cell(165, 5,'Le, ' . date('d/m/Y'), 0, 1, 'R');

					    //insertion du titre $groupe $examen
					    $fpdf->SetFont('Courier', 'BU', 20);

					    $fpdf->Cell(60, 5, $group, 0, 1, 'R');
					  	$fpdf->Ln();
					  	$fpdf->Ln();



				//insertion des examens

					    foreach($liste_examens as $examen)
					    {
					    	if(15 >= ($page_height - $fpdf->GetY()))
					   		 		{

									     $fpdf->AddPage(); // page break.
									     $fpdf->Ln(10);
					   		 		} 
					    	$fpdf->SetTextColor(0,107,215);
					    	$fpdf->SetFont('Courier', 'BU', 16);
					    	$fpdf->Cell(10, 5,'', 0, 0, 'L');
					   		$fpdf->Cell(165, 5,$examen['libelle_examen'], 0, 1, 'L');
					   		$i = 1;
					   		$fpdf->Ln();
					   		$fpdf->SetFillColor(200,200,200);
			   		 		$fpdf->SetFont('Times', 'B', 12);
			   				$fpdf->SetTextColor(0,0,0);	
				   		 	$fpdf->Cell(10, 5,'', 0, 0, 'L');
				   		 	$fpdf->Cell(10, 5,$this->gerer('N°'), 1, 0, 'C', true);
				   		 	$fpdf->Cell(2, 5,'', 0, 0, 'L');
			   		 		$fpdf->Cell(60, 5, $this->gerer('Nom(s) et Prénom(s)'), 1, 0, 'L', true);
			   		 		$fpdf->Cell(2, 5,'', 0, 0, 'L');
			   		 		$fpdf->Cell(95, 5,$this->gerer('Résultat(s)'), 1, 1, 'C', true);

					   		 foreach($liste_dossiers as $dossier)
					   		 {
					   		 	
					   		 	if($dossier['id_examen'] == $examen['id_examen'])
					   		 	{
					   		 		if(15 >= ($page_height - $fpdf->GetY()))
					   		 		{

									     $fpdf->AddPage(); // page break.
									     $fpdf->Ln(10);
					   		 		} 
					   		 		
					   		 		
					   		 		$fpdf->Ln(1);

					   		 		$fpdf->SetFillColor(255,255,255);	
					   		 		$fpdf->SetFont('Times', '', 8);
					   		 		$fpdf->Cell(10, 5,'', 0);
					   		 		$x = $fpdf->GetX();
									$y = $fpdf->GetY();
						   		 	$fpdf->MultiCell(10, 4, "\n". $this->gerer($i) . "\n \n" , 1, 'C');
						   		 	$fpdf->Cell(2, 5,'', 0, 0, 'L');
						   		 	$fpdf->SetXY($x + 12, $y);
					   		 		$fpdf->MultiCell(60, 4, $this->gerer($dossier['nom']) . "\n" . 
					   		 								$this->gerer("Dossier N°  " . $dossier['id_dossier']) . "\nDu " . 
					   		 								$this->gerer($dossier['date_dossier']), 1,'L');
					   		 		$fpdf->Cell(2, 5,'', 0, 0, 'L');
					   		 		$fpdf->SetXY($x + 14 + 60, $y);
					   		 		$fpdf->MultiCell(95, 4,  "\n" . "\n" . "\n" , 1,'L');
	

					   		 		$i = $i + 1;		

					   		 	}
					   		 }

					   		 $fpdf->Ln();
					   		 $fpdf->Ln();

					    }

					    return $fpdf;

	}

	
}


class PDFPaillasse extends FPDF
	{
		public $date = "";
		function Footer()
		{
		    // Go to 1.5 cm from bottom
		    $this->SetY(-15);
		    // Select Arial italic 8
		    $this->SetFont('Arial','I',8);
		    // Print centered page number
		    $this->Cell(10,5,'',0,0,'C');
		    $this->Cell(70,5,'Cahier de Paillasse '. $this->date,0,0,'L');

		    $this->Cell(0,5,'Page '.$this->PageNo(),0,0,'R');
		}

	}
