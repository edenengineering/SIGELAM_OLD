<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Dossier;
use App\Patient;
use App\Resultat;
use App\Prescripteur;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\URL;
use App;
use Response;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\TubeExamen;
use App\ExamenDossier;
use App\GroupeExamen;
use App\Examen;
use App\Interpretation;
use App\ConclusionExamen;
use App\Antibiogramme;
use App\Antibiotique;
use App\Antifongique;
use App\Antifongigramme;
use App\IntituleBiopsie;
use App\Journal;
use DateTime;
use Illuminate\Support\Facades\DB;





class ImprimerResultatsController extends Controller
{
    
	public function Show(Request $request)
	{
		if(Auth::check())
    {
            

       $this->addEvent('ouverture_impression_resultat', $request->ip(),0, Auth::id(), "Ouverture de la Fenêtre d'impression des Résultats ");
     //  dd($result);
    	return view('dashboard_imprimer_resultat');                	
    }
    else
    {
    	return redirect()->route('login', 302);
    }
	}

  public function getListeDossierAImprimer(Request $request)
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

             
           $totalData = count(DB::select('select distinct dossiers.date_dossier as date, dossiers.id as id_dossier, patients.nom_patient, patients.sexe, patients.telephone as contact, dossiers.nom_prescripteur as prescripteur  from resultats, dossiers, patients where valide = 1 and dossiers.id = resultats.id_dossier and (dossiers.etat = \'4\' or dossiers.etat = \'9\') and dossiers.id_patient = patients.id'));
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
                $patients2 = DB::select('select distinct dossiers.date_dossier as date, dossiers.id as id_dossier, patients.nom_patient, patients.sexe, patients.telephone as contact, dossiers.nom_prescripteur as prescripteur  from resultats, dossiers, patients where valide = 1 and dossiers.id = resultats.id_dossier and (dossiers.etat = \'4\' or dossiers.etat = \'9\') and dossiers.id_patient = patients.id order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                
                $totalFiltered = $totalData;
                
            }   
            else
            {
                $search = "'%" . strtoupper(str_replace('\'', '\'\'',$request->input('search.value'))) . "%'";

                $patients2 = DB::select('select distinct dossiers.date_dossier as date, dossiers.id as id_dossier, patients.nom_patient, patients.sexe, patients.telephone as contact, dossiers.nom_prescripteur as prescripteur  from resultats, dossiers, patients where valide = 1 and dossiers.id = resultats.id_dossier and (dossiers.etat = \'4\' or dossiers.etat = \'9\') and dossiers.id_patient = patients.id and (patients.nom_patient like '. $search .' or dossiers.date_dossier::text like '. $search .' or dossiers.id::text like '. $search .' or patients.sexe like '. $search .' or patients.telephone like '. $search .' or dossiers.nom_prescripteur like '. $search .') order by '. $order_column .' '. $dir.' limit ' . $limit . ' offset ' . $start);
                $totalFiltered = count($patients2);
                


            } 
             

            $data = array();  

            if($patients2)
            {
                foreach ($patients2 as $row)
                {
                   

                   $nestedData['date'] = date('d-m-Y H:i:s', strtotime($row->date));
                   $nestedData['id_dossier'] = sprintf("%06d",$row->id_dossier);
                   $nestedData['nom_patient'] = $row->nom_patient;
                   $nestedData['sexe'] = $row->sexe;
                   $nestedData['contact'] = $row->contact;
                   $nestedData['prescripteur'] = $row->prescripteur;

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

	public function ImprimerResultatDossier(Request $request)
	{
		if(Auth::check())
    {
        if($request['id_dossier'] != null)
        {
            //return view('dashboard_imprimer_resultat_impression');
          $dossier = Dossier::find($request['id_dossier']);
          $patient = Patient::find($dossier->id_patient);

            $this->addEvent('impression_resultat_dossier', $request->ip(),0, Auth::id(), "Impression des Résultats du Dossier => " . sprintf("%06d", $request['id_dossier']) . ', Patient => ' . $patient->nom_patient);

            $dossier = Dossier::find($request['id_dossier']);
            $pat = Patient::find($dossier->id_patient);
            $bday = new DateTime($pat->date_naissance);
            $today = new DateTime($dossier->date_dossier);     
            $diff = $today->diff($bday);
            $age = $diff->y . ' an(s) ' . $diff->m . ' mois ';
            $tube = TubeExamen::where('id_dossier', $dossier->id)->where('preleve', 1)->first();
            $preleve = $tube->updated_at;
            $examens = ExamenDossier::where('code_dossier', $dossier->id)->where('preleve', 1)->get();

            $liste_groupe = array();
            $liste_examens = array();
            $liste_resultats = array();
            foreach($examens as $examen)
            {
              $resultats = Resultat::where('id_dossier_examen', $examen->id)->where('valide', 1)->orderBy('id')->get();
              if(count($resultats) != 0)
              {
                $exam = Examen::find($examen->code_examen);
                $group = GroupeExamen::find($exam->id_groupe_examen);
                $collection1 = collect([
                  'id_groupe_examen' => $group->id,
                  'libelle_groupe_examen' => $group->libelle_groupe_examen,
                  ]);
                

                if(!$this->GroupeExamenExist($liste_groupe, $collection1))
                {                  
                  array_push($liste_groupe, $collection1);
                }
                $collection2 = collect([
                  'id_examen' => $exam->id,
                  'libelle_examen' => $exam->libelle_examen,
                  'id_groupe' => $group->id,
                  ]);
                if(!$this->ExamenExist($liste_examens, $collection2))
                {                  
                  array_push($liste_examens, $collection2);
                }
                foreach($resultats as $resultat)
                   {
                      $collection3 = collect([
                        'id_examen' => $exam->id,
                        'libelle_rendu' => $resultat->libelle_rendu,
                        'valeur' => $resultat->valeur,
                        'min' => $resultat->min,
                        'max' => $resultat->max,
                        'unite' => $resultat->unite,
                        'historique' => $resultat->Historique,
                        ]);
                      array_push($liste_resultats, $collection3);

                   } 

              }

            }
              $examen_non = array();
            $examens_non_preleves = ExamenDossier::where('code_dossier', $dossier->id)->where('preleve', 0)->get();
            foreach($examens_non_preleves as $examen)
            {
                $exam = Examen::find($examen->code_examen);
                $collection4 = collect([
                  'libelle_examen' => $exam->libelle_examen,
                  'id_examen' => $exam->id,
                  ]);
                array_push(($examen_non), $collection4);
            }

            $examen_trait = array();
            $examens_non_preleves = ExamenDossier::where('code_dossier', $dossier->id)->where('preleve', 1)->get();

            foreach($examens_non_preleves as $examen)
            {
                $exam = Examen::find($examen->code_examen);
                $resultats = Resultat::where('id_examen', $exam->id)->where('id_dossier', $dossier->id)->get();
                $resultats_n = Resultat::where('id_examen', $exam->id)->where('id_dossier', $dossier->id)->where('valide', 0)->get();
                if(count($resultats) == 0)
                {
                  $collection5 = collect([
                  'libelle_examen' => $exam->libelle_examen,
                  'id_examen' => $exam->id,
                  ]);
                  array_push(($examen_trait), $collection5);
                }
                else if(count($resultats_n) != 0)
                {
                  $collection5 = collect([
                  'libelle_examen' => $exam->libelle_examen,
                  'id_examen' => $exam->id,
                  ]);
                  array_push(($examen_trait), $collection5);
                }
            }  

              $id_examen = $request['id_examen'];
             $this->GenererResultatsDossier($dossier->nom_prescripteur, $pat, $age, $dossier, $preleve, $liste_groupe, $liste_examens, $liste_resultats, $examen_non, $examen_trait, $id_examen);    
        }
    else
    {
    	return redirect()->route('login', 302);
    }	
	}

}
    public function GenererResultatsDossier($prescripteur, $patient, $age, $dossier, $preleve , $liste_groupe, $liste_examens, $liste_resultats, $examen_non, $examen_trait, $id_examen)
    {
            //Paramètres de Fonctionnement

       // dd($liste_examens);
            $bottom_margin = 20;
            $page_height = 279.4;
            $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
             $barre_dossier =  'data://text/plain;base64,' .base64_encode($generator->getBarcode(sprintf("%06d", $dossier['id']), $generator::TYPE_CODE_128 ));
             $info = getimagesize($barre_dossier);
            //Intanciation Du PDF
            $fpdf = new PDFResultatsDossier('P','mm', 'A4');
            $fpdf->SetAuthor('GELAM');
            $fpdf->SetCreator('GELAM');

            $fpdf->SetAutoPageBreak(false);
            //Creation de la Premiere Page
            $fpdf->AddPage();

            //Ajout des Deux Logos (Droite et Gauche)
            $fpdf->Image('logo1.jpg', 10,10, 40);
            $fpdf->Image('logo2.jpg', 170,16, 20);

            $technicien = Journal::where('id_dossier', $dossier['id'])->where('evenement', 'VALIDATION')->orderBy('created_at', 'desc')->first();

           // dd($technicien);

            if($technicien->id_agent == 2)
            {
                 $fpdf->Image('signature2.jpg', 80,270, 60, 20);
            }
            else
            {
               $fpdf->Image('signature.jpg', 80,270, 60, 20);
            }
            
           // dd($technicien);
           


            $patient = Patient::find($dossier['id_patient']);

            

            if($dossier['etat'] == 'Archivé')
            {
               $fpdf->Image('duplicata.jpg', 50,60, 30, 30);

               $fpdf->Image('duplicata.jpg', 50,150, 100, 100);
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

                  $fpdf->Ln(2);
 
                  //FIN de l'en tête

                  //Ajout du Prescripteur du Dossier
                  $fpdf->Ln();

                  $fpdf->SetFont('Times', 'B', 9);
                  $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
                  $fpdf->SetDrawColor(0,0,0);   

                  $fpdf->Cell(100, 5, $this->gerer('Examen(s) demandé(s) par : ' . $prescripteur), 0, 0, 'L');
                  $x = $fpdf->GetX();
                  $y = $fpdf->GetY();
                  $fpdf->SetFont('Times', 'B', 14);
                  $fpdf->SetTextColor(17,70,134);   

                  $fpdf->MultiCell(72, 5,$this->gerer($patient['nom_patient']) , 'LTR', 'C');
                  $y = $fpdf->GetY();
                  if(strlen($y >= 70))
                  {
                      $fpdf->Image($barre_dossier, 135, 86, 30, 6, 'png');
                  }
                  else
                  {
                      $fpdf->Image($barre_dossier, 135, 81, 30, 6, 'png');              
                  }

                 // dd($y);

                  $fpdf->SetFont('Times', 'B', 9);
                  $fpdf->SetTextColor(0,0,0);   
                  $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
                  $r_clinique = IntituleBiopsie::find($dossier['renseignement']);
                  if($r_clinique != null)
                  {
                   $fpdf->Cell(100, 5, $this->gerer('Clinique : ' . $r_clinique->libelle), 0, 0, 'L');
                  }
                  else
                  {
                    $fpdf->Cell(100, 5, $this->gerer(''), 0, 0, 'L');
                  }

                  $fpdf->Cell(10, 4,$this->gerer('Âge : ') , 'L', 0);
                  $fpdf->SetFont('Times', '', 9);
                  $fpdf->Cell(31, 4,$age , 0, 0, 'L');
                                    $fpdf->SetFont('Times', 'B', 9);

                    $fpdf->Cell(10, 4,$this->gerer('Sexe : ') , '', 0);
                  $fpdf->SetFont('Times', '', 9);

                  $fpdf->Cell(21, 4,$this->gerer($patient['sexe']) , 'R', 1, 'L');

                  $fpdf->SetFont('Times', 'B', 9);

                  $fpdf->Cell(109, 5, $this->gerer(''), 0, 0, 'L');

                  $fpdf->Cell(25, 4,$this->gerer('Enregistré(e) le : ') , 'L', 0);
                  $fpdf->SetFont('Times', '', 9);
                  $fpdf->Cell(47, 4,$dossier['date_dossier'] , 'R', 1);
                  $fpdf->SetFont('Times', 'B', 9);
                   $fpdf->Cell(109, 5, $this->gerer(''), 0, 0, 'L');

                  $fpdf->Cell(25, 4,$this->gerer('Prelevé(e) le : ') , 'L', 0);
                  $fpdf->SetFont('Times', '', 9);
                  $fpdf->Cell(47, 4,$preleve , 'R', 1);
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
                  $fpdf->SetFont('Times', 'B', 10);
                  $fpdf->Ln(5);
                  $fpdf->Cell(11, 4,'', '', 0);

                  $fpdf->SetFillColor(200,200,200);

                  $fpdf->Cell(90, 7,'', 'LBT', 0, 'C', true);

                  $fpdf->Cell(25, 7,$this->gerer("Résultats") , 'TB', 0, 'C', true);
                  $fpdf->Cell(22, 7,$this->gerer("Normes") , 'TB', 0, 'C', true);
                  $fpdf->Cell(20, 7,$this->gerer("Unités") , 'TB', 0, 'C', true);  
                  $fpdf->Cell(20, 7,$this->gerer("Historique*") , 'TRB', 1, 'C', true);
                  $fpdf->Ln(5);


                  foreach($liste_groupe as $group)
                  {
                      

                      $continue = true; 

                        if(!$id_examen == null)
                        {
                          $to_suppress = explode(",", $id_examen);
                          
                          foreach($to_suppress as $element)
                            {
                              $examm = Examen::find($element);
                              if($group['id_groupe_examen'] == $examm->id_groupe_examen)
                              {
                                $continue = false;
                              }
                             
                            }
                          }
                          else
                          {
                            $continue = false;
                          }

                          if($continue)
                          {
                            continue;
                          }
                        
                      $fpdf = $this->CheckPiedsDePage2($fpdf, $page_height, $dossier);
                      $fpdf->SetFillColor(206,223,232);
                      $fpdf->Cell(11, 4,'', '', 0);
                      $fpdf->SetFont('Times', 'B', 14);    
                      $fpdf->Cell(177, 7,$this->gerer($group['libelle_groupe_examen']), 1, 1, 'C', true);
                      $fpdf->Ln(1);    
                      foreach($liste_examens as $examen)
                      {
                        if($examen['id_groupe'] != $group['id_groupe_examen'])
                        {
                          continue;
                        }
                         $continue = true; 

                        if(!$id_examen == null)
                        {
                          $to_suppress = explode(",", $id_examen);
                          
                          foreach($to_suppress as $element)
                          {
                            if($examen['id_examen'] == $element)
                            {
                              $continue = false;
                            }
                          }
                        }
                        else
                        {
                          $continue = false;
                        }

                          if($continue)
                          {
                            continue;
                          }
                          $fpdf->Ln(2); 
                          $fpdf = $this->CheckPiedsDePage2($fpdf, $page_height, $dossier);

                         $fpdf->SetFillColor(255,255,255);
                        $fpdf->SetFont('Times', 'BI', 13);

                         $fpdf->Cell(11, 4,'', '', 0);
                         $fpdf->Cell(70, 7,$this->gerer($examen['libelle_examen']), 0, 1, 'L', true);
                         $fpdf->Ln(2); 
                         
                        foreach ($liste_resultats as $resultat) 
                        {
                          $max_y = 0;
                          if($resultat['id_examen'] != $examen['id_examen'])
                          {
                            continue;
                          }
                          $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $dossier);

                          $fpdf->SetFont('Times', '', 10);
                          $fpdf->Cell(11, 4,'', '', 0);
                          $x = $fpdf->GetX();
                          $y = $fpdf->GetY();
                          if($fpdf->GetY() > $max_y)
                          {
                            $max_y = $fpdf->GetY();
                          }
                          $fpdf->MultiCell(90, 4,$this->gerer($resultat['libelle_rendu']), 0,'L');
                          $fpdf->SetXY($x + 90, $y);

                          if($fpdf->GetY() > $max_y)
                          {
                            $max_y = $fpdf->GetY();
                          }

                          if($resultat['min'] == '' || $resultat['max'] == '')
                          {
                            $fpdf->MultiCell(47, 4,$this->gerer($resultat['valeur']) , 0,'L');
                          }  
                          else if( $resultat['valeur'] <= $resultat['max'] && $resultat['valeur'] >= $resultat['min'])
                          {
                            $fpdf->MultiCell(25, 4,$this->gerer($resultat['valeur']) , 0,'C');
                          }
                          else
                          {
                            $fpdf->SetFont('Times', 'B', 10);
                            $fpdf->MultiCell(25, 4,$this->gerer($resultat['valeur'] . "*") , 0,'C');
                            $fpdf->SetFont('Times', '', 10);
                          }




                          $fpdf->SetXY($x + 115, $y);
                          
                          $fpdf->MultiCell(22, 4,$this->gerer($resultat['min'] . " - " . $resultat['max']) , 0,'C');

                                                
                          $fpdf->SetXY($x + 137, $y);
                          $fpdf->MultiCell(20, 4,$this->gerer($resultat['unite']) , 0,'C');
                          $fpdf->SetXY($x + 157, $y);
                          $fpdf->MultiCell(20, 4,$this->gerer($resultat['historique']) , 0,'C');
                          $fpdf->setY($max_y + 4);
                          $fpdf->Ln(3);

                        }

                        //Interpretation
                        $fpdf->Ln(2);
                        $interpretations = Interpretation::where('code_examen', $examen['id_examen'])->where('statut', 1)->get();
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
                        //Conclusion
                        $conclusions = ConclusionExamen::where('id_dossier', $dossier['id'])->where('id_examen', $examen['id_examen'])->get();
                        if(count($conclusions) != 0)
                        {
                           $fpdf->Ln(1);
                            $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $dossier);

                                $fpdf->Cell(11, 4,'', '', 0);
                                $fpdf->SetFont('Times', 'B', 10);

                                $fpdf->MultiCell(70, 4,$this->gerer("CONCLUSION : "), 0,'L');
                                                          $fpdf->SetFont('Times', 'I', 10);

                            
                             foreach($conclusions as $conclusion)
                             {
                               // $fpdf = $this->CheckPiedsDePage($fpdf, $page_height);

                                $fpdf->Cell(20, 4,'', '', 0);
                                $fpdf->MultiCell(180, 4,$this->gerer("-" . $conclusion->conclusion), 0,'L');
                             }
                                                 $fpdf->Ln(3);
     
                        }
                        //Antibiotique 
                        $antibiotiques = Antibiogramme::where('id_dossier', $dossier['id'])->where('id_examen', $examen['id_examen'])->get();
                      //  dd($antibiotiques);
                        if(count($antibiotiques) != 0)                        
                        {
                             $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $dossier);

                                $fpdf->Cell(11, 4,'', '', 0);
                                $fpdf->SetFont('Times', 'B', 10);
                                $fpdf->MultiCell(40, 4,$this->gerer("ANTIBIOTIQUES : "), 0,'L');
                                                          $fpdf->SetFont('Times', 'I', 8);

                                 $txt_anti = "";                         
                                $sensibles = Antibiogramme::where('id_dossier', $dossier['id'])->where('id_examen', $examen['id_examen'])->where('etat', 'SENSIBLE')->get();                          
                                if(count($sensibles) != 0)
                                {
                                      $fpdf->Cell(15, 4,'', '', 0);
                                      $fpdf->SetFont('Times', 'B', 8);
                                      $fpdf->Cell(30, 4,$this->gerer("SENSIBLE : "),0);
                                      $fpdf->SetFont('Times', 'I', 8);
                                      foreach($sensibles as $sensible)
                                      {
                                        $anti = Antibiotique::find($sensible->id_antibiotique);
                                        $txt_anti = $txt_anti . $anti->libelle_antibiotique . ", " ;
                             
                                      }
                                      $fpdf->MultiCell(100, 4,$this->gerer($txt_anti), 0);

                                }
                                  $txt_anti = "";       
                                $sensibles = Antibiogramme::where('id_dossier', $dossier['id'])->where('id_examen', $examen['id_examen'])->where('etat', 'INTERMEDIAIRE')->get();                          
                                if(count($sensibles) != 0)
                                {
                                      $fpdf->Cell(15, 4,'', '', 0);
                                      $fpdf->SetFont('Times', 'B', 8);
                                      $fpdf->Cell(30, 4,$this->gerer("INTERMEDIAIRE : "), 0,'L');
                                      $fpdf->SetFont('Times', 'I', 8);
                                      foreach($sensibles as $sensible)
                                      {
                                        $anti = Antibiotique::find($sensible->id_antibiotique);
                                        $txt_anti = $txt_anti . $anti->libelle_antibiotique . ", " ;
                             
                                      }
                                      $fpdf->MultiCell(100, 4,$this->gerer($txt_anti), 0);


                                }
                                  $txt_anti = "";     
                                $sensibles = Antibiogramme::where('id_dossier', $dossier['id'])->where('id_examen', $examen['id_examen'])->where('etat', 'RESISTANT')->get();                          
                                if(count($sensibles) != 0)
                                {
                                      $fpdf->Cell(15, 4,'', '', 0);
                                      $fpdf->SetFont('Times', 'B', 8);
                                      $fpdf->Cell(30, 4,$this->gerer("RESISTANT : "), 0,'L');
                                      $fpdf->SetFont('Times', 'I', 8);
                                      foreach($sensibles as $sensible)
                                      {
                                        $anti = Antibiotique::find($sensible->id_antibiotique);
                                        $txt_anti = $txt_anti . $anti->libelle_antibiotique . ", " ;                             
                                      }
                                      $fpdf->MultiCell(100, 4,$this->gerer($txt_anti), 0);

                                      $fpdf->Cell(10, 4,"", 0, 1);

                                }

                        }
                        //Antifongique 
                        $antifongiques = Antifongigramme::where('id_dossier', $dossier['id'])->where('id_examen', $examen['id_examen'])->get();
                       // dd($antifongiques);
                        if(count($antifongiques) != 0)
                        {
                            $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $dossier);
                                $fpdf->Cell(11, 4,'', '', 0);
                                $fpdf->SetFont('Times', 'B', 10);
                                $fpdf->MultiCell(70, 4,$this->gerer("ANTIFONGIQUE : "), 0,'L');
                                                          $fpdf->SetFont('Times', 'I', 8);
                                $sensibles = Antifongigramme::where('id_dossier', $dossier['id'])->where('id_examen', $examen['id_examen'])->where('etat', 'SENSIBLE')->get();                          
                               $txt_anti = "";     
                                if(count($sensibles) != 0)
                                {
                                      $fpdf->Cell(15, 4,'', '', 0);
                                      $fpdf->SetFont('Times', 'B', 8);
                                      $fpdf->Cell(30, 4,$this->gerer("SENSIBLE : "),0);
                                      $fpdf->SetFont('Times', 'I', 8);
                                      $txt_anti = "";
                                      foreach($sensibles as $sensible)
                                      {
                                        $anti = Antifongique::find($sensible->id_antifongique);
                                        $txt_anti = $txt_anti . $anti->libelle_antifongique . ", " ;
                             
                                      }
                                      $fpdf->MultiCell(100, 4,$this->gerer($txt_anti), 0);

                                      $fpdf->Cell(10, 4,"", 0, 1);
                                }
                                  $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $dossier);
                                   $txt_anti = "";        
                                $sensibles = Antifongigramme::where('id_dossier', $dossier['id'])->where('id_examen', $examen['id_examen'])->where('etat', 'INTERMEDIAIRE')->get();                          
                                if(count($sensibles) != 0)
                                {
                                      $fpdf->Cell(15, 4,'', '', 0);
                                      $fpdf->SetFont('Times', 'B', 8);
                                      $fpdf->Cell(30, 4,$this->gerer("INTERMEDIAIRE : "), 0,'L');
                                      $fpdf->SetFont('Times', 'I', 8);
                                      foreach($sensibles as $sensible)
                                      {
                                        $anti = Antifongique::find($sensible->id_antifongique);
                                        $txt_anti = $txt_anti . $anti->libelle_antifongique . ", " ;
                             
                                      }
                                      $fpdf->MultiCell(100, 4,$this->gerer($txt_anti), 0);

                                      $fpdf->Cell(10, 4,"", 0, 1);
                                }
                                  $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $dossier);
 
                                $sensibles = Antifongigramme::where('id_dossier', $dossier['id'])->where('id_examen', $examen['id_examen'])->where('etat', 'RESISTANT')->get();                          
                               $txt_anti = "";     
                                if(count($sensibles) != 0)
                                {
                                  $fpdf->Cell(15, 4,'', '', 0);
                                  $fpdf->SetFont('Times', 'B', 8);
                                  $fpdf->Cell(30, 4,$this->gerer("RESISTANT : "), 0);
                                  $fpdf->SetFont('Times', 'I', 8);
                                  foreach($sensibles as $sensible)
                                  {
                                    $anti = Antifongique::find($sensible->id_antifongique);
                                    $txt_anti = $txt_anti . $anti->libelle_antifongique . ", " ;
                         
                                  }
                                  $fpdf->MultiCell(100, 4,$this->gerer($txt_anti), 0);

                                  $fpdf->Cell(10, 4,"", 0, 1);
                                }
                                $fpdf->Ln(3);


                        }                        

 
                      }

                      $fpdf->Ln(3);

                  }  
                   $txt_exam = ""; 
                  if(count($examen_trait) != 0)
                  {
                                $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $dossier);
                                $fpdf->Cell(11, 4,'', '', 0);
                                $fpdf->SetFont('Times', 'B', 10);
                                $fpdf->Cell(70, 4,$this->gerer("Examens En cours de Traitement : "), 0,1);
                                $fpdf->SetFont('Times', 'I', 8);
                                foreach ($examen_trait  as $examen)
                                {                                       
                                    $txt_exam = $txt_exam . $examen['libelle_examen'] . ", ";
                                }
                                $fpdf->Cell(20, 4,'', '', 0);
                                $fpdf->MultiCell(180, 4,$this->gerer($txt_exam), 0);
                                $fpdf->Ln(5);

                  }  
                  $txt_exam = ""; 
 
                  if(count($examen_non) != 0)
                  {
                                $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $dossier);
                                $fpdf->Cell(11, 4,'', '', 0);
                                $fpdf->SetFont('Times', 'B', 10);
                                $fpdf->Cell(70, 4,$this->gerer("Examens En cours de Prélèvement : "), 0,1);
                                $fpdf->SetFont('Times', 'I', 8);
                                foreach ($examen_non  as $examen)
                                {                                       
                                    $txt_exam = $txt_exam . $examen['libelle_examen'] . ", ";
                                }
                                $fpdf->Cell(20, 4,'', '', 0);
                                $fpdf->MultiCell(180, 4,$this->gerer($txt_exam), 0);
                                $fpdf->Ln(5);
                  }  
 
           $fpdf->Output('I', 'Cahier de Paillasse', true);


    }
    public function gerer($str)
    {
      return iconv('UTF-8', 'windows-1252', $str);
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


    public function ModifierResultatEnImpression(Request $request)
    {
        if(Auth::check())
         {
              if($request['id_dossier'] != null)
              {
                $dossier = Dossier::find($request['id_dossier']);
                if($dossier->etat != 'Archivé')
                {
                    $date_dossier = new DateTime($dossier->date_dossier);      
                    $today = new DateTime(date('Y-m-d H:i:s'));
                    $diff = $today->diff($date_dossier); 
                    if($diff->m >= 3)
                    {
                        return response()->json([
                      'error' => 'Le dossier ne peut pas etre renvoyé en technique !',
                      ], 200);
                    }
                  $resultats = Resultat::where('id_dossier', $request['id_dossier'])->get();
                  foreach ($resultats as $result) 
                  {
                    $res = Resultat::find($result->id);
                    $res->valide = 0;
                    $res->save();
                  }


                  if($dossier->etat != 'En Technique')
                  {
                     $dossier->etat = '4';
                     $dossier->save(); 
                  }
                $patient = Patient::find($dossier->id_patient);

                $this->addEvent('modifier_impression_resultat', $request->ip(),0, Auth::id(), "Renvoi en Technique du Dossier => " . sprintf("%06d", $dossier->id) . ', Du Patient => ' . $patient->nom_patient);

                return response()->json([
                      'success' => 'L\'examen a bien été renvoyé en Technique!',
                    ], 200);
                }
                else
                {
                      $resultats = Resultat::where('id_dossier', $request['id_dossier'])->get();
                      foreach ($resultats as $result) 
                      {
                        $res = Resultat::find($result->id);
                        $res->valide = 0;
                        $res->save();
                      }


                      if($dossier->etat != 'En Technique')
                      {
                         $dossier->etat = '4';
                         $dossier->save(); 
                      }
                      

                      return response()->json([
                            'success' => 'L\'examen a bien été renvoyé en Technique!',
                          ], 200);
                  }
                
              }
         }
         else
         {
              return redirect()->route('login', 302);
         }
    }


    public function ShowDossierAArchiver(Request $request)
    {
      if(Auth::check())
      {
        
                
         $result = DB::select('select dossiers.id, dossiers.nom_prescripteur, patients.nom_patient, patients.telephone from dossiers, patients where dossiers.etat = \'9\' and dossiers.id_patient = patients.id ');

          $this->addEvent('liste_dossier_archiver', $request->ip(),0, Auth::id(), "Ouverture de la liste des Dossiers A Archiver");
          return response()->json(['dossiers' => json_encode($result)], 200);

      }
      else
      {
        return redirect()->route('login', 200);
      }
    }

    public function AddDossierEnArchivage(Request $request)
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
                $dossier->etat = 8;
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

                        $result = array();
                        $resultats = Resultat::where('valide', 1)->where('imprime', 0)->orderBy('id_dossier')->get();
                        $id_dossier = 0;
                        foreach($resultats as $resultat)
                        {
                                $dossier = Dossier::find($resultat->id_dossier);
                                if($dossier->etat == 'Archivé')
                                {
                                  continue;
                                }
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

              $this->addEvent('archivage_dossiers_resultats', $request->ip(),0, Auth::id(), "Archivage des Dossiers");
              if(count($deleted_elements) == 1)
              {
                return response()->json([
                  'success' => 'Le Dossier a bien été archivé avec succès !',
                  'supprimes' => json_encode($deleted_elements),
                  'dossiers' => json_encode($result),
                ], 200);
              }
              else
              { 
                return response()->json([
                  'success' => 'Les Dossiers ont bien été archivés avec succès !',
                  'supprimes' => json_encode($deleted_elements) ,
                  'dossiers' => json_encode($result),

                ], 200);
              } 



                        
            }
            else
            {
              return response()->json([
                  'erreur' => 'Une erreur est survenue pendant l\'archivage !',
                ], 200);
            }         
            
          }
          
        }       
        else
        {
                return redirect()->route('login', 302);
        }
    }

    public function CheckPiedsDePage($fpdf, $page_height, $dossier)
    {

          if(30 >= ($page_height - $fpdf->GetY()))
            {

               $fpdf->AddPage(); // page break.
               $fpdf->Ln(5);
                $fpdf->SetFont('Times', 'B', 10);
                  $fpdf->Ln(5);
                  $fpdf->Cell(11, 4,'', '', 0);
                  $technicien = Journal::where('id_dossier', $dossier['id'])->where('evenement', 'VALIDATION')->orderBy('created_at', 'desc')->first();

           // dd($technicien);

                if($technicien->id_agent == 2)
                {
                     $fpdf->Image('signature2.jpg', 80,270, 60, 20);
                }
                else
                {
                   $fpdf->Image('signature.jpg', 80,270, 60, 20);
                }
                  if($dossier['etat'] == 'Archivé')
                    {
                       $fpdf->Image('duplicata.jpg', 50,150, 100, 100);
                    }
  
                  $fpdf->SetFillColor(200,200,200);

                  $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
                  $barre_dossier =  'data://text/plain;base64,' .base64_encode($generator->getBarcode(sprintf("%06d", $dossier['id']), $generator::TYPE_CODE_128 ));
                  $fpdf->Image($barre_dossier, 165, 277, 30, 6, 'png');                  
                  $fpdf->Cell(90, 7,'', 'LBT', 0, 'C', true);
                  $fpdf->Cell(25, 7,$this->gerer("Résultats") , 'TB', 0, 'C', true);
                  $fpdf->Cell(22, 7,$this->gerer("Normes") , 'TB', 0, 'C', true);
                  $fpdf->Cell(20, 7,$this->gerer("Unités") , 'TB', 0, 'C', true);  
                  $fpdf->Cell(20, 7,$this->gerer("Historique*") , 'TRB', 1, 'C', true);
                  $fpdf->Ln(5);
            }
            return $fpdf; 
    }

    public function CheckPiedsDePage2($fpdf, $page_height, $dossier)
    {

          if(90 >= ($page_height - $fpdf->GetY()))
            {

               $fpdf->AddPage(); // page break.
               $fpdf->Ln(5);
                $fpdf->SetFont('Times', 'B', 10);
                  $fpdf->Ln(5);
                  $fpdf->Cell(11, 4,'', '', 0);
                  $technicien = Journal::where('id_dossier', $dossier['id'])->where('evenement', 'VALIDATION')->orderBy('created_at', 'desc')->first();

           // dd($technicien);

            if($technicien->id_agent == 2)
            {
                 $fpdf->Image('signature2.jpg', 80,270, 60, 20);
            }
            else
            {
               $fpdf->Image('signature.jpg', 80,270, 60, 20);
            }
                  if($dossier['etat'] == 'Archivé')
                    {
                       $fpdf->Image('duplicata.jpg', 50,150, 100, 100);
                    }
  
                  $fpdf->SetFillColor(200,200,200);
                  $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
                  $barre_dossier =  'data://text/plain;base64,' .base64_encode($generator->getBarcode(sprintf("%06d", $dossier['id']), $generator::TYPE_CODE_128 ));
                  $fpdf->Image($barre_dossier, 165, 277, 30, 6, 'png');
                  $fpdf->Cell(90, 7,'', 'LBT', 0, 'C', true);
                  $fpdf->Cell(25, 7,$this->gerer("Résultats") , 'TB', 0, 'C', true);
                  $fpdf->Cell(22, 7,$this->gerer("Normes") , 'TB', 0, 'C', true);
                  $fpdf->Cell(20, 7,$this->gerer("Unités") , 'TB', 0, 'C', true);  
                  $fpdf->Cell(20, 7,$this->gerer("Historique*") , 'TRB', 1, 'C', true);
                  $fpdf->Ln(5);
            }
            return $fpdf; 
    }
   

   
}


class PDFResultatsDossier extends FPDF
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