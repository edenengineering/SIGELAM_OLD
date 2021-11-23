<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\ExamenDossier;
use App\Partenaire;
use App\Dossier;
use App\GroupeExamen;
use App\Facture;
use App\Examen;
use App\TubeExamen;
use App\Tube;
use Illuminate\Http\Request;

class ExamenDossierController extends Controller
{

 
   public function show( Request $request)
    {
		if(Auth::check())
        {
			if($request['id_dossier'] != null)
			{
				$examens_dossier = ExamenDossier::where('code_dossier', $request['id_dossier'])->get();
				$total = ExamenDossier::where('code_dossier', $request['id_dossier'])->sum('prix_net');
				$tubes_examen = array();
			    $tubes = TubeExamen::where('id_dossier', $request['id_dossier'])->get();
			   	$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

			   foreach($tubes as $tu)
			   {
				   $tube = Tube::find($tu->id_tube);
				   
				   $collection = collect([
											'libelle_tube' => $tube->libelle_tube,
											'couleur' => $tube->couleur,
											'reference_tube' => $tu->id,
											'id_groupe_examen' => $tu->id_groupe_examen,
											'code_barre' => base64_encode($generator->getBarcode($tu->id, $generator::TYPE_CODE_128	)),
										]);
					array_push($tubes_examen, $collection);
				}	
				if($request->ajax()){					
					return response()->json(['examens_dossier' => json_encode($examens_dossier),
											 'tubes_examen' => json_encode($tubes_examen),	
											 'total'=> $total,
					], 200);
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
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce(s) examen(s) de Dossier !'
					], 200);	
			}
			

				if($request['id_examen_dossier'] == null)
				{
					
					$max = count($request['values']);
					$values = $request['values'];

					 if($max == 1)
					 {
						ExamenDossier::where('code_dossier', $values[0])->delete();
						Facture::where('id_dossier', $values[0])->delete();
						return response()
						->json([
							'success' => 'Le(s)  Dossier Vide a été crée avec succès !',
								], 200);
					}
					
					$nbre = 0;	
					$i = 0;
					$dossier = Dossier::find($values[$i+1]);
					$val_total = 0;
					ExamenDossier::where('code_dossier', $values[$i+1])->delete();

					for($i = 0; $i < $max; $i = $i +9)
					{
						
						
						$examen_dossier = new ExamenDossier();
						$examen_dossier->code_dossier = $values[$i+1];
						$examen_dossier->code_examen = $values[$i];
						$examen_dossier->quantite = $values[$i+2];
						$examen_dossier->prix_unitaire = $values[$i+4];
						$examen_dossier->prix_total = $values[$i+5];
					    $examen_dossier->reduction = $values[$i+6];
						
						$examen_dossier->delai = $values[$i+8];
						$examen_dossier->prix_net = $values[$i+7];
						$val_total += $examen_dossier->prix_net;
						
						

						if($examen_dossier->save())
						{
							$nbre++;
							//Creation de la facture du dossier si elle n'existe pas
						/*	if (!count(Facture::where('id_dossier', $dossier->id)->get()) == 0)
							{
								
								Facture::where('id_dossier', $dossier->id)->delete();
								
							}
							$facture = new Facture();
							$facture->id_dossier = $dossier->id;
							$facture->id_agent = Auth::id();
							$facture->total = $val_total;
							$facture->statut = 0;
							$facture->save(); */
						}							
					}
					//Creation des Codes barre des examens du dossier si ils n'existent pas
					
					TubeExamen::where('id_dossier', $dossier->id)->delete();
					$tubes = Tube::where('statut', '1')->get();
					$examens_dossier = ExamenDossier::where('code_dossier', $dossier->id)->get();
					$groupes_examen = GroupeExamen::all();

					foreach($groupes_examen as $group)
					{
						$i = 0;
						foreach($examens_dossier as $examen)
						{
							$exam = Examen::find($examen->code_examen);



							if($exam->id_groupe_examen == $group->id)
							{
								if($exam->id ==  20 || $exam->id == 21 || $exam->id == 22 || $exam->id == 38)
								{
									$tube_examen = new TubeExamen();
									$tube_examen->id_tube = $exam->code_tube;
									$tube_examen->id_dossier = $dossier->id;
									$tube_examen->id_groupe_examen = $exam->id_groupe_examen;
									if($exam->id == 20)
									{
										$tube_examen->libelle_exam = 'PCV';
									}
									else if($exam->id == 21)
									{
										$tube_examen->libelle_exam = 'PU';
									}
									else if($exam->id == 38)
									{
										$tube_examen->libelle_exam = 'PV';
									}
									$tube_examen->save();	

									$tube_examen = new TubeExamen();
									$tube_examen->id_tube = $exam->code_tube;
									$tube_examen->id_dossier = $dossier->id;
									$tube_examen->id_groupe_examen = $exam->id_groupe_examen;
									if($exam->id == 20)
									{
										$tube_examen->libelle_exam = 'PCV';
									}
									else if($exam->id == 21)
									{
										$tube_examen->libelle_exam = 'PU';
									}
									else if($exam->id == 38)
									{
										$tube_examen->libelle_exam = 'PV';
									}
									$tube_examen->save();	
									continue;
									
								}

								if($exam->id ==  18 || $exam->id == 25 || $exam->id == 39)
								{
									$tube_examen = new TubeExamen();
									$tube_examen->id_tube = $exam->code_tube;
									$tube_examen->id_dossier = $dossier->id;
									$tube_examen->id_groupe_examen = $exam->id_groupe_examen;									
									$tube_examen->libelle_exam = $exam->abreviation;									
									$tube_examen->save();	

									continue;
									
								}

								if($exam->id == 23)
								{

									$tube_examen = new TubeExamen();
									$tube_examen->id_tube = $exam->code_tube;
									$tube_examen->id_dossier = $dossier->id;
									$tube_examen->id_groupe_examen = $exam->id_groupe_examen;
									$tube_examen->save();
									continue;
								}

								if($exam->id == 24)
								{
									
									$tube_examen = new TubeExamen();
									$tube_examen->id_tube = $exam->code_tube;
									$tube_examen->id_dossier = $dossier->id;
									$tube_examen->id_groupe_examen = $exam->id_groupe_examen;
									$tube_examen->save();
									continue;
								}	

								$tubes_examens = TubeExamen::where('id_dossier', $dossier->id)->where('id_tube', $exam->code_tube)->where('id_groupe_examen', $group->id)->get();
								$i++;
								$nbre_max = 4;

								
								if(count($tubes_examens) == 0)
								{	
									$tube_examen = new TubeExamen();
									$tube_examen->id_tube = $exam->code_tube;
									$tube_examen->id_dossier = $dossier->id;
									$tube_examen->id_groupe_examen = $exam->id_groupe_examen;
									$tube_examen->save();									
								}
								if($i > 4)
								{
									$tube_examen = new TubeExamen();
									$tube_examen->id_tube = $exam->code_tube;
									$tube_examen->id_dossier = $dossier->id;
									$tube_examen->id_groupe_examen = $exam->id_groupe_examen;
									$tube_examen->save();
									$i = 0; 
								}
								
								
							}
						}
					}
					// On passe en mode prélèvement
					
					$dossier->etat = '10';
					$dossier->save();
			
 						return response()
						->json([
							'success' => 'Le(s) ' . $nbre . ' examen(s) de ce Dossier a (ont) été enregistré avec succès !',
							'nouveau' => json_encode($examen_dossier),
								], 200);
					
				}				
				else
				{
					$examen_dossier = ExamenDossier::find($request['id_examen_dossier']);				
				
					if($examen_dossier->save())
					{ 
					
						return response()
						->json([
							'success' => 'Le(s) ' . $nbre . ' examen(s) de ce Dossier a (ont) été enregistré avec succès !',
							'nouveau' => json_encode($examen_dossier),							
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant la modification de ce(s) examen(s) de dossier !',
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
			if(!$request['id_commande_materiel'] == null)
			{
				$to_suppress = explode(",", $request['id_commande_materiel']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						$commande = Commande::find($element);
						$commande->statut = '0';
						if($commande->save())
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
							'success' => 'La commande a bien été supprimmée avec succès!',
							'supprimes' => json_encode($deleted_elements),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les Commandes ont bien été supprimmées avec succès!',
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

}
