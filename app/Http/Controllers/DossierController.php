<?php

namespace App\Http\Controllers;
use Validator;
use App\Dossier;
use App\Facture;
use App\Resultat;
use App\Examen;
use App\GroupeExamen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\TubeExamen;
use App\Avoir;
use DateTime;
use App\Patient;
use App\Tube;
use App\Interpretation;
use App\ExamenDossier;
use Illuminate\Support\Facades\DB;


class DossierController extends Controller
{
   public function show(Request $request)
    {
       if(Auth::check())
        {
			if($request['id_patient'] != null)
			{

				$dossiers = Dossier::where('id_patient', $request['id_patient'])->where('statut', 1)->orderBy('date_dossier', 'desc')->get();
				$factures = array();
				$avoirs = array();
				

				$result = DB::select('select distinct examens.id as id_examen, examens.libelle_examen, groupe_examens.libelle_groupe_examen from patients, dossiers, resultats, examen_dossiers, examens, groupe_examens where dossiers.id = resultats.id_dossier and resultats.valide = 1 and dossiers.id_patient = patients.id and patients.id = '.$request['id_patient'].' and examen_dossiers.code_dossier = dossiers.id and examens.id = examen_dossiers.code_examen and groupe_examens.id = examens.id_groupe_examen order by examens.libelle_examen');

				if($request->ajax() || true){					
					return response()->json(['dossiers' => json_encode($dossiers),
											'factures' => json_encode($factures),
											'avoirs' => json_encode($avoirs),
											'historiques' => json_encode($result),
					], 200);
					
				}
			}		 
		}
        else{
            return redirect()->route('login', 302);
        }
    }
	
	public function showEnPrelevement(Request $request)
    {
       if(Auth::check())
        {
			
					 
		}
        else{
            return redirect()->route('login', 302);
        }
    }
	
	public function SetPrelevementDossier(Request $request)
	{
		if(Auth::check())
        {
			if($request['id_dossier'] != null)
			{
				if($request['value'] == 1)
				{
					$dossier = Dossier::find($request['id_dossier']);
					$dossier->etat = '10';
					$dossier->save();
				}
				else
				{
					$dossier = Dossier::find($request['id_dossier']);
					$dossier->etat = '4';
					$dossier->save();
				}				
			}
		}
	}

	
	
	
	public function showDossier(Request $request)
    {
       if(Auth::check())
        {
			if($request['id_dossier'] != null)
			{
				$dossier = Dossier::find($request['id_dossier']);
				
				if($request->ajax()){					
					return response()->	json(['dossier' => json_encode($dossier)], 200);
				}
			}		 
		}
        else{
            return redirect()->route('login', 302);
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
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce dossier'
					], 200);	
			}
			

			if($request['id_dossier'] == null)
			{
				if(count(Dossier::where('numero_facture', $request['numero_facture'])->get()) != 0 && $request['numero_facture'] != null)
					{
						return response()->json([
							'erreur' => 'Erreur!!! Cette Facture a déjà été enregistrée pour un autre Dossier !',
						], 200);
					}
				$dossier = new Dossier();
				$dossier->id_patient = $request['id_patient'];
				$dossier->id_agent = Auth::id();
				$dossier->nom_prescripteur = strtoupper($request['nom_prescripteur']);
				$dossier->numero_facture = strtoupper($request['numero_facture']);
				$dossier->id_agent_editeur = $request['id_agent_editeur'];
				$dossier->renseignement = $request['renseignement_clinique'];
				$dossier->date_dossier = date('Y-m-d H:i:s');
				$dossier->reduction = $request['reduction'];
				$dossier->etat = '5';
				$dossier->urgence = $request['urgence'];
				if($request['enceinte'] != null){
					$dossier->enceinte = $request['enceinte'];
				}
				$dossier->unite = $request['unite'];

				
				if($dossier->save())
				{
						$patient = Patient::find($dossier->id_patient);
					   $this->addEvent('ajout_dossier', $request->ip(),$dossier->id, Auth::id(), "Ajout du Dossier =>  ". sprintf("%06d",$dossier->id) . ', ' . $patient->nom_patient);
					
					return response()
					->json([
						'success' => 'Le dossier a été enregistré avec succès !',
						'nouveau' => json_encode($dossier),							
							], 200)
					;
				}
				else	
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce dossier',
					], 200);
				}

			}
			else
			{
				$dossier =  Dossier::find($request['id_dossier']);
				$dossier->id_patient = $request['id_patient'];
				$dossier->id_agent = Auth::id();
				$dossier->nom_prescripteur = strtoupper($request['nom_prescripteur']);
				$dossier->numero_facture = strtoupper($request['numero_facture']);
				$dossier->id_agent_editeur = $request['id_agent_editeur'];
				$dossier->renseignement = $request['renseignement_clinique'];	
				$dossier->date_dossier = date('Y-m-d H:i:s');
				$dossier->reduction = $request['reduction'];
				//$dossier->etat = '5';
				$dossier->urgence = $request['urgence'];
				if($request['enceinte'] != null){
					$dossier->enceinte = $request['enceinte'];
				}
				$dossier->unite = $request['unite'];
				if($dossier->save())
				{
					$patient = Patient::find($dossier->id_patient);
					$this->addEvent('modifier_dossier', $request->ip(),$dossier->id, Auth::id(), "Modification du Dossier =>  ". sprintf("%06d",$dossier->id) . ', ' . $patient->nom_patient);
					
					return response()
					->json([
						'success' => 'Le dossier a été modifié avec succès !',
						'nouveau' => json_encode($dossier),							
							], 200)
					;
				}
				else	
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce dossier',
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
			if(!$request['id_dossier'] == null)
			{
				$to_suppress = explode(",", $request['id_dossier']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						$dossier = Dossier::find($element);
						if($dossier->etat != 'En Reception')
						{
							return response()->json([
							'erreur' => 'Impossible de supprimer un dossier qui est à l\'état => ' . $dossier->etat,
							], 200);
						}
						$dossier->statut = '0';
						if($dossier->save())
						{
							$patient = Patient::find($dossier->id_patient);
						$this->addEvent('suppression_dossier', $request->ip(),$dossier->id, Auth::id(), "Supression du Dossier =>  ". sprintf("%06d",$dossier->id) . ', ' . $patient->nom_patient);
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
							'success' => 'Le Dossier a bien été supprimmé avec succès !',
							'supprimes' => json_encode($deleted_elements),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les Dossiers ont bien été supprimmés avec succès !',
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
	
	public function invalidateModel(Request $request)
	{
		if(Auth::check())
        {
			if(!$request['id_dossier'] == null)
			{
				$to_suppress = explode(",", $request['id_dossier']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						$dossier = Dossier::find($element);
						$dossier->etat = '8';
						if($dossier->save())
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
							'success' => 'Le dossier a bien été invalidé avec succès !',
							'invalides' => json_encode($deleted_elements),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les Dossiers ont bien été invalidés avec succès !',
							'invalides' => json_encode($deleted_elements)	,
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
          if($gp['id_examen'] == $group['id_examen'])
        {
          return true;
        }
      }
      return false;
    }

    public function AfficherHistoriqueResultat(Request $request)
    {
    	$bottom_margin = 20;
            $page_height = 279.4;
            $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
             $barre_dossier =  'data://text/plain;base64,' .base64_encode($generator->getBarcode(sprintf("%06d", $request['id_patient']), $generator::TYPE_CODE_128 ));
             $info = getimagesize($barre_dossier);
             $examen = Examen::find($request['id_examen']);
            //Intanciation Du PDF
            $fpdf = new PDFHistoriqueResultatsDossier('P','mm', 'A4');
            $fpdf->SetAuthor('GELAM');
            $fpdf->SetCreator('GELAM');

            $fpdf->SetAutoPageBreak(false);
            //Creation de la Premiere Page
            $fpdf->AddPage();

            //Ajout des Deux Logos (Droite et Gauche)
            $fpdf->Image('logo1.jpg', 10,10, 40);
            $fpdf->Image('logo2.jpg', 170,10, 20);
            $fpdf->Image('signature.jpg', 80,270, 60, 20);
            $patient = Patient::find($request['id_patient']);
            $bday = new DateTime($patient->date_naissance);
            $today = new DateTime(date('Y-m-d H:i:s'));     
            $diff = $today->diff($bday);
            $age = $diff->y . ' an(s) ' . $diff->m . ' mois ';

            if(strlen($patient->nom_patient > 22))
            {
                $fpdf->Image($barre_dossier, 135, 86, 30, 6, 'png');
            }
            else
            {
                $fpdf->Image($barre_dossier, 135, 73, 30, 6, 'png');              
            }
  
            $fpdf->Image($barre_dossier, 165, 277, 30, 6, 'png');
            //Creation de l'entête / Header 
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
                  $fpdf->Line(20,268, 190, 268);

                  $fpdf->Ln(2);
 
                  //FIN de l'en tête

                  //Ajout du Prescripteur du Dossier
                  $fpdf->Ln();

                  $fpdf->SetFont('Times', 'B', 9);
                  $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
                  $fpdf->SetDrawColor(0,0,0);   

                  $fpdf->Cell(100, 5, $this->gerer(''), 0, 0, 'L');
                  $x = $fpdf->GetX();
                  $y = $fpdf->GetY();
                  $fpdf->SetFont('Times', 'B', 14);
                  $fpdf->SetTextColor(17,70,134);   

                  $fpdf->MultiCell(72, 5,$this->gerer($patient->nom_patient) , 'LTR', 'C');
                  $fpdf->SetFont('Times', 'B', 9);
                  $fpdf->SetTextColor(0,0,0);   
                  $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
  
                   $fpdf->Cell(100, 5, $this->gerer(''), 0, 0, 'L');

                  $fpdf->Cell(10, 4,$this->gerer('Âge : ') , 'L', 0);
                  $fpdf->SetFont('Times', '', 9);
                  $fpdf->Cell(31, 4,$age , 0, 0, 'L');
                                    $fpdf->SetFont('Times', 'B', 9);

                    $fpdf->Cell(10, 4,$this->gerer('Sexe : ') , '', 0);
                  $fpdf->SetFont('Times', '', 9);

                  $fpdf->Cell(21, 4,$this->gerer($patient['sexe']) , 'R', 1, 'L');

                  $fpdf->SetFont('Times', 'B', 9);

                 
                   
                                    $fpdf->Cell(109, 5, $this->gerer(''), 0, 0, 'L');

                  $fpdf->SetFont('Times', 'B', 9);
                  $fpdf->Cell(14, 4,$this->gerer('Edité le :   ') , 'L', 0);
                  $fpdf->SetFont('Times', '', 9);
                  $fpdf->Cell(20, 4,$this->gerer(date('d/m/Y')) , 0, 0, 'L');
                  $fpdf->SetFont('Times', 'B', 9);

                  $fpdf->Cell(18, 4,$this->gerer('Téléphone : ') , '', 0);
                  $fpdf->SetFont('Times', '', 9);

                  $fpdf->Cell(20, 4,$this->gerer($patient['telephone']) , 'R', 1, 'L');
                                     $fpdf->Cell(109, 5, $this->gerer(''), '', 0, 'L');
                  $fpdf->SetFont('Times', 'B', 12);

                  $fpdf->Cell(72, 7,$this->gerer("") , 'LBR', 1, 'C');
                  $fpdf->SetFont('Times', 'B', 16);
                  $fpdf->Ln(5);
                  $fpdf->Cell(11, 4,'', '', 0);

                  $fpdf->SetFillColor(200,200,200);
                  $fpdf->Cell(0, 7, $this->gerer('Historique des Résultats de ' . $examen->libelle_examen),0, 1,'C');
                  $fpdf->Ln(5);
                  $fpdf->SetFont('Times', 'B', 10);

                  $fpdf->Cell(70, 7,'', 'LBT', 0, 'C', true);
                  $fpdf->Cell(45, 7,$this->gerer("Résultats") , 'TB', 0, 'C', true);
                  $fpdf->Cell(22, 7,$this->gerer("Normes") , 'TB', 0, 'C', true);
                  $fpdf->Cell(15, 7,$this->gerer("Unités") , 'TB', 0, 'C', true);  
                  $fpdf->Cell(18, 7,$this->gerer("Historique*") , 'TRB', 1, 'C', true);
                  $fpdf->Ln(1);
                  $resultats = Resultat::where('id_examen', $request['id_examen'])->orderBy('created_at', 'desc')->get();
                  $dates = array();

                  foreach ($resultats as $resultat) {
                  		$dossier = Dossier::find($resultat->id_dossier);
                  		if($dossier->id_patient != $request['id_patient'])
                  		{
                  			continue;
                  		}
                  		$collection = collect([
                  			'date' => $dossier->created_at->toDateString(),
                  		]);
                  		if(!$this->DateExist($dates, $collection))
                  		{
                  			array_push(	$dates, $collection);
                  			$fpdf->Ln(2);
                  			$fpdf->SetFont('Times', 'B', 15);
                  			$fpdf->cell(0, 7, 'Date du '. $dossier->created_at->toDateString(), 0, 1);
                  			$fpdf->Ln(5);

                  		}
                  		//$fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $dossier);

                          $fpdf->SetFont('Times', '', 10);
                          $x = $fpdf->GetX();
                          $y = $fpdf->GetY();
                          $fpdf->MultiCell(70, 4,$this->gerer($resultat['libelle_rendu']), 0,'L');
                          $fpdf->SetXY($x + 70, $y);
                          if($resultat['min'] == '' || $resultat['max'] == '')
                          {
                            $fpdf->MultiCell(40, 4,$this->gerer($resultat['valeur']) , 0,'C');
                          }  
                          else if( $resultat['valeur'] <= $resultat['max'] && $resultat['valeur'] >= $resultat['min'])
                          {
                            $fpdf->MultiCell(40, 4,$this->gerer($resultat['valeur']) , 0,'C');
                          }
                          else
                          {
                            $fpdf->SetFont('Times', 'B', 10);
                            $fpdf->MultiCell(40, 4,$this->gerer($resultat['valeur'] . "*") , 0,'C');
                            $fpdf->SetFont('Times', '', 10);
                          }
                          $fpdf->SetXY($x + 110, $y);
                          $fpdf->MultiCell(27, 4,$this->gerer($resultat['min'] . " - " . $resultat['max']) , 0,'C');
                          $fpdf->SetXY($x + 137, $y);
                          $fpdf->MultiCell(15, 4,$this->gerer($resultat['unite']) , 0,'C');
                          $fpdf->SetXY($x + 152, $y);
                          $fpdf->MultiCell(15, 4,$this->gerer($resultat['historique']) , 0,'C');
                          $fpdf->Ln(2);

                          $fpdf->Ln(2);
                        $interpretations = Interpretation::where('code_examen', $examen['id_examen'])->get();
                        if(count($interpretations) != 0)
                        {
                                $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $dossier);
                                $fpdf->SetFont('Times', 'B', 10);
  
                                $fpdf->Cell(11, 4,'', '', 0);
                                $fpdf->MultiCell(70, 4,$this->gerer("INTERPRETATION : "), 0,'L');
                                                          $fpdf->SetFont('Times', 'I', 10);

                            
                             foreach($interpretations as $interpretation)
                             {
                               // $fpdf = $this->CheckPiedsDePage($fpdf, $page_height);

                                $fpdf->Cell(20, 4,'', '', 0);
                                $fpdf->MultiCell(180, 4,$this->gerer("-" . $interpretation->libelle_interpretation), 0,'L');
                             }
                                  $fpdf->Ln(3);

                        } 			
                  		
                  }

            
           $fpdf->Output('I', 'Cahier de Paillasse', true);
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

    public function CheckPiedsDePage($fpdf, $page_height, $dossier)
    {

          if(35 >= ($page_height - $fpdf->GetY()))
            {

               $fpdf->AddPage(); // page break.
               $fpdf->Ln(5);
                $fpdf->SetFont('Times', 'B', 10);
                  $fpdf->Ln(5);
                  $fpdf->Cell(11, 4,'', '', 0);
                  $fpdf->Image('signature.jpg', 80,270, 60, 20);
                 
  
                  $fpdf->SetFillColor(200,200,200);

                  $fpdf->Cell(70, 7,'', 'LBT', 0, 'C', true);
                  $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
                  $barre_dossier =  'data://text/plain;base64,' .base64_encode($generator->getBarcode(sprintf("%06d", $dossier['id']), $generator::TYPE_CODE_128 ));
                  $fpdf->Image($barre_dossier, 165, 277, 30, 6, 'png');                  
                  $fpdf->Cell(40, 7,$this->gerer("Résultats") , 'TB', 0, 'C', true);
                  $fpdf->Cell(27, 7,$this->gerer("Normes") , 'TB', 0, 'C', true);
                  $fpdf->Cell(15, 7,$this->gerer("Unités") , 'TB', 0, 'C', true);  
                  $fpdf->Cell(18, 7,$this->gerer("Historique*") , 'TRB', 1, 'C', true);
                  $fpdf->Ln(1);
            }
            return $fpdf; 
    }

    public function ImprimerEtiquette(Request $request)
    {
    	if(Auth::check())
		{

			$bottom_margin = 20;
                $page_height = 279.4;
                
                $fpdf = new FPDF('L','mm', array(20,62));
                $fpdf->SetAuthor('GELAM');
                $fpdf->SetAuthor('GELAM');
                $fpdf->SetCreator('GELAM');

                $fpdf->SetAutoPageBreak(false);
                //Creation de la Premiere Page
                $dossier = Dossier::find($request['id_dossier']);
                $patient = Patient::find($dossier->id_patient);
					$this->addEvent('modifier_dossier', $request->ip(),$dossier->id, Auth::id(), "Impression Etiquettes du Dossier =>  ". sprintf("%06d",$dossier->id) . ', ' . $patient->nom_patient);
                $tubes = TubeExamen::where('id_dossier', $dossier->id)->get();
                foreach($tubes as $tube)
                {
                	if($tube->id_tube == 5)
                	{
                		$fpdf->SetFont('Times', 'B', 8);
	                	$fpdf->AddPage();
	                	$group = GroupeExamen::find($tube->id_groupe_examen);
	                	$tu = Tube::find($tube->id_tube);
	                	$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
	            		$barre_dossier =  'data://text/plain;base64,' .base64_encode($generator->getBarcode(sprintf("%06d", $tube->id), $generator::TYPE_CODE_128 ));
	             		$info = getimagesize($barre_dossier);
	               		 $fpdf->Image($barre_dossier, 10, 3, 25, 5, 'png');
	               		 $fpdf->Image('logo2.jpg', 170,10, 20);
	               		 $fpdf->SetXY(8,0);
	               		 $fpdf->Cell(34, 2, $this->gerer($patient->nom_patient), 0, 1);
	               		  $fpdf->SetXY(8,8);
	               		
	               		  $bday = new DateTime($patient->date_naissance);
						 $today = new DateTime($dossier->date_dossier);	
						 $diff = $today->diff($bday);
						 $age = $diff->y . ' an(s) ' . $diff->m . ' mois';		

						  $fpdf->Cell(38, 3, $this->gerer($patient->sexe . ' - ' . $age ), 0, 1);
						  $fpdf->Cell(25, 3, $this->gerer('Dossier N°' . sprintf("%06d",$dossier->id)), 0, 0);
						  $fpdf->Cell(18, 3, $this->gerer($tube->libelle_exam), 0, 1);

						//  $fpdf->Cell(34, 3, $this->gerer('LAME ' . '- ' . $group->libelle_groupe_examen), 0, 1);
						   $fpdf->Cell(34, 3, $this->gerer('Preleve le : ' . $dossier->date_dossier), 0, 1);

	               		
	               		 
                	}
                	else
                	{
                		$fpdf->SetFont('Times', 'B', 7);
	                	$fpdf->AddPage();
	                	$group = GroupeExamen::find($tube->id_groupe_examen);
	                	$tu = Tube::find($tube->id_tube);
	                	$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
	            		$barre_dossier =  'data://text/plain;base64,' .base64_encode($generator->getBarcode(sprintf("%06d", $tube->id), $generator::TYPE_CODE_128 ));
	             		$info = getimagesize($barre_dossier);
	               		 $fpdf->Image($barre_dossier, 1, 6, 35, 6, 'png');
	               		 $fpdf->Image('logo2.jpg', 170,10, 20);
	               		 $fpdf->SetXY(0,0);
	               		 $fpdf->MultiCell(34, 3, $this->gerer($patient->nom_patient ), 0, 'L');
	               		 $fpdf->SetXY(25, 0);
	               		 $fpdf->SetFont('Times', 'BI', 7);
	               		 $bday = new DateTime($patient->date_naissance);
						 $today = new DateTime($dossier->date_dossier);	
						 $diff = $today->diff($bday);

						 $age = $diff->y . ' an(s) ' . $diff->m . ' mois';		
						  if($patient->sexe == 'Masculin')
						  {
						  		$fpdf->Cell(30, 3, $age . ' (M)', 0, 1, 'R');
						  }
						  else
						  {
						  		$fpdf->Cell(30, 3, $age . ' (F)', 0, 1, 'R');
						  }
						  $list_exams = $this->GetListeExamensEtiquette($dossier->id, $group->id, $tube->id);
						  $fpdf->setXY(38, 6);
						  $fpdf->MultiCell(23, 3, $this->gerer($list_exams), 0, 'L');
						  $fpdf->SetXY(33, 2);

						  $fpdf->Cell(10, 3, 'P : ' . $dossier->created_at->toDateString(), 0, 0);
	               
	               		  $fpdf->SetXY(47, 6);
	               		 
	               		
	               		 $fpdf->SetXY(0, 12);
	               		 $fpdf->Cell(15, 3, $this->gerer('  Dossier N°' . sprintf("%06d",$dossier->id)), 0, 1, 'L');
	               		 $fpdf->SetXY(0, 15);
	               		 $fpdf->SetFont('Times', 'B', 7);
	               		 $fpdf->MultiCell(22, 3, $group->libelle_groupe_examen, 0,'C');
	               		 $fpdf->SetXY(13, 14);
	               		 $fpdf->SetFont('Times', 'BI', 7);
	               		 $fpdf->Cell(25, 3, $this->gerer($tu->libelle_tube), 0, 1, 'R');
                	}

                }
                                  

                  $fpdf->Ln(10); 
                   $fpdf->output(); 

		}
		else
		{
			return redirect()->route('login', 302);
		}	

    }


    public function GetListeExamensEtiquette($id_dossier, $group_id, $tube_id)
    {

    	$tube_examens = TubeExamen::where('id_dossier', $id_dossier)->where('id_groupe_examen', $group_id)->get();
    	$examss = ExamenDossier::where('code_dossier', $id_dossier)->get();
    	$list_exams = "";

    	$tubexxx = TubeExamen::find($tube_id);	

    	if($group_id == 5 && $tubexxx->id_tube == 4)
    	{
    		$list_exams = 'BAAR';
    		
    		return $list_exams;	
    	}

    	if($group_id == 8)
    	{

    			$j = 0;

	    	foreach($tube_examens as $tube_e)
	    	{	
	    		if($tube_e->id == $tube_id)
	    		{
	    			$i = 0;    			
	    			  foreach($examss as $exam)
					  {
					  	$ex = Examen::find($exam->code_examen);
					  	if($ex->id_groupe_examen == $group_id)
					  	{	
					  		$i++;
					  		if($i < $j*1 +2 && $i >= $j*2)
					  		$list_exams = $list_exams . $ex->abreviation. ', ';
					  	}
					  }
	    		}
	    		$j++;
	    	}

	    	return $list_exams; 

    	}	
    	
    	$j = 0;

    	
    	foreach($tube_examens as $tube_e)
    	{	
    		$tubo = TubeExamen::find($tube_e->id);
    		$tubo2 = TubeExamen::find($tube_id);  

    		if($tubo->id_tube == $tubo2->id_tube)
    		{
    			$i = 0;    			
    			  foreach($examss as $exam)
				  {
				  	$ex = Examen::find($exam->code_examen);
				  	if($ex->id_groupe_examen == $group_id && $ex->code_tube == $tubo->id_tube)
				  	{	
				  		
				  		$i++;			  		

				  		if($i < $j*5 +5 && $i >= $j*5)
				  		{
				  			$list_exams = $list_exams . $ex->abreviation. ', ';
				  		}

				  	}
				  }
    		}
    		else
    		{
    			continue;
    		}
    		$j++;
    	}
    	
    		
			 
		/*if($group_id == 1)
		{
			dd($id_dossier . ' ' . $group_id . ' '. $tube_id);
		}*/
    	
		return $list_exams; 
	}
}


class PDFHistoriqueResultatsDossier extends FPDF
  {
    public $date = "";
    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-35 );
        // Select Arial italic 8
        $this->SetFont('Arial','IB',6);
        
        // Print centered page number
        $this->Cell(10,3,'',0,0,'C');
        $this->Cell(0,3,$this->gerer("Conformément aux texte en vigueur, votre echantillons pourra être éliminé et/ou transféré à des fins scientifiques ou des contrôles de qualité, hors génétique humaine, "),0,1,'C');
        $this->Cell(10,3,'',0,0,'C');
        $this->Cell(0,3,$this->gerer(" de manière anonyme et respectant le secret medical, sauf opposition formulée auprès de notre secretariat médical"),0,1,'C');
        $this->SetDrawColor(0,72,0);   
        $this->SetLineWidth(0.5);             
        $this->Line(20,268, 190, 268);

        $this->Ln(5); 
        $this->Cell(186,5,'Page '.$this->PageNo(),0,0,'R');
    }

    public function gerer($str)
    {
      return iconv('UTF-8', 'windows-1252', $str);
    } 
  }


