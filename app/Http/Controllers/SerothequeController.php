<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use App\Serotheque;
use App\NatureEchantillon;
use App\PathologieLiee;
use App\Quartier;
use Validator;
use Codedge\Fpdf\Fpdf\Fpdf;



class SerothequeController extends Controller
{
    public function Show(Request $request)
    {
    	if(Auth::check())
    	{
    		$serotheque =  Serotheque::where('statut', '1')->get();
            $natures = NatureEchantillon::orderBy('libelle_nature')->get();
            $pathologies = PathologieLiee::orderBy('libelle_pathologie')->get();
            $quartiers = Quartier::orderBy('libelle_quartier')->get();
            $this->addEvent('ouverture_biotheque', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Biothèque");

    		return view('dashboard_serotheque')->withSerotheques($serotheque)
                                               ->withNatures($natures)
                                               ->withPathologies($pathologies)
                                               ->withQuartiers($quartiers);
            

    	}
    	else
    	{
    		return redirect()->route('login', 302);
    	}
    }

    public function Store(Request $request)
    {
    	if(Auth::check())
    	{
    		$validator = Validator::make($request->all(), [

            ]);

            if($validator->fails())
            {
                return response()->json([
                    'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette Biotheque !',

                ], 200);
            }


            if($request['id_serotheque'] == null)
            {
				
                $serotheque = new Serotheque();
                $serotheque->genre = $request['genre'];
                $serotheque->id_nature = $request['id_nature'];
                $serotheque->id_pathologie = $request['id_pathologie'];
                $serotheque->id_quartier = $request['id_quartier'];
                $serotheque->caractere_id = strtoupper($request['caractere_id']);
                $serotheque->preleve_le = $request['preleve_le'];
                $serotheque->date_naissance = $request['date_naissance'];
                
                if($serotheque->save())
                {
                    $this->addEvent('ajout_biotheque', $request->ip(),$serotheque->id, Auth::id(), "Ajout de la donnée de Biothèque =>  ". $serotheque->caractere_id);
                    return response()
                        ->json([
                            'success' => 'La donnée de Biothèque a été enregistrée avec succès !',
                            'nouveau' => json_encode($serotheque),
                        ], 200)
                        ;
                }
                else
                {
                    return response()->json([
                        'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette biothèque !'
                    ], 200);
                }
            }
            else
            {
				$serotheque = Serotheque::find($request['id_serotheque']);
                 $serotheque->genre = $request['genre'];
                $serotheque->id_nature = $request['id_nature'];
                $serotheque->id_pathologie = $request['id_pathologie'];
                $serotheque->id_quartier = $request['id_quartier'];
                $serotheque->caractere_id = strtoupper($request['caractere_id']);
                $serotheque->preleve_le = $request['preleve_le'];
                $serotheque->date_naissance = $request['date_naissance'];

                if($serotheque->save())
                {
                    $this->addEvent('modifier_biottheque', $request->ip(),$serotheque->id, Auth::id(), "Modification de la donnée de Biothèque =>  ". $serotheque->caractere_id);
                    return response()
                        ->json([
                            'success' => 'La donnée de Biotheque a été modifiée avec succès !',
                            'nouveau' => json_encode($serotheque),
                        ], 200)
                        ;
                }
                else
                {
                    return response()->json([
                        'erreur' => 'Une erreur est survenue pendant la modification de cette donnée de Biotheque !'
                    ], 200);
                }
            }

    	}
    	else
    	{
    		return redirect()->route('login', 302);
    	}
    }


    public function deleteModel(Request $request)
    {
        if(Auth::check())
        {
            if(!$request['id_serotheque'] == null)
            {
                $to_suppress = explode(",", $request['id_serotheque']);
                $deleted_elements = array();
                
                foreach($to_suppress as $element)
                {
                    try{
                        $serotheque = Serotheque::find($element);
                        $serotheque->statut = '0';
                        if($serotheque->save())
                        {
                             $this->addEvent('supprimer_biottheque', $request->ip(),$serotheque->id, Auth::id(), "Suppression de la donnée de Biothèque =>  ". $serotheque->caractere_id);
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
                            'success' => 'La donnée de Biothèque a bien été supprimmée avec succès !',
                            'supprimes' => json_encode($deleted_elements),
                        ], 200);
                    }
                    else
                    {   
                        return response()->json([
                            'success' => 'Les données de Biotheque ont bien été supprimmés avec succès !',
                            'supprimes' => json_encode($deleted_elements)   ,
                        ], 200);
                    }                   
                }
                else
                {
                    return response()->json([
                            'erreur' => 'Une erreur est survenue pendant la Suppression de la donnée de Biothèque !',
                        ], 200);
                }                   
                
            }
        }               
        else
        {
            return redirect()->route('login', 302);
        }   
    }


    public function ImprimerBiotheque(Request $request)
    {

         $this->addEvent('modifier_biottheque', $request->ip(),0, Auth::id(), "Impression de la Biothèque");
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

                  $fpdf->Ln(10); 
                   $fpdf->output(); 



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
     public function  gerer($str)
     {
      return iconv('UTF-8', 'windows-1252', $str);
    } 

}


class PDFBiotheque extends FPDF
  {
    public $date = "";
    function Footer()
    {
            
        // Go to 1.5 cm from bottom
        $this->SetY(-35 );
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
