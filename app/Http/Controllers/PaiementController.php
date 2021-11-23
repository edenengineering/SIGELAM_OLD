<?php
namespace App\Http\Controllers;
use App\Paiement;
use App\Facture;
use App\Patient;
use App\Dossier;
use App\TypePaiement;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function show( Request $request)
    {
		if(Auth::check())
        {
			if($request['id_facture'] != null)
			{
				$paiements_facture = Paiement::where('id_facture', $request['id_facture'])->get();
				$facture = Facture::find($request['id_facture']);
				if(true){

					return response()->json(['paiements_facture' => json_encode($paiements_facture),
											 'facture' => json_encode($facture),
											 
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
							'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Paiment !'
						], 200);	
				}
				

					if($request['id_paiement'] == null && $request['id_facture'] != null)
					{
						$facture = Facture::find($request['id_facture']);
						if($facture->reste_a_payer == 0)
						{
							return response()->json([
							'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Paiement !'
						], 200);	
						}
						
						$type_paiement = TypePaiement::find($request['type_paiement']);
						if($type_paiement->libelle_paiement == 'COMPTE PREPAYE')
						{
							$paiement = new Paiement();
							$paiement->id_facture = $request['id_facture'];
							$paiement->date_paiement = date('Y-m-d');
							$paiement->heure_paiement = date('H:i:s');
							$paiement->verse = $request['somme_verse'];
							$paiement->percu = $request['somme_verse'] - $request['remboursement'];
							$paiement->rembourse = $request['remboursement'];
							$paiement->type_paiement = $request['type_paiement'];
							$paiement->banque = strtoupper($request['nom_banque']);
							$paiement->numero_cheque = $request['numero_cheque'];
							$paiement->id_agent = Auth::id();
							if($paiement->save())
							{
								
								$facture = Facture::find($paiement->id_facture);
								$dossier = Dossier::find($facture->id_dossier);
								$patient = Patient::find($dossier->id_patient);
								$patient->montant_avoir -= $paiement->percu;
								$patient->save();
								$montant_avoir = $patient->montant_avoir;
								$paiements = Paiement::where('id_facture', $request['id_facture'])->orderBy('date_paiement')->get();
								$factures = array();
								$dossiers = Dossier::where('id_patient', $patient->id)->where('statut', 1)->orderBy('date_dossier', 'desc')->get();
								foreach($dossiers as $doss)
								{
									$facture = Facture::where('id_dossier', $doss->id)->first();
									if(count($facture) != 0)
									{
										array_push($factures, $facture);
									}
								}

								if($dossier->etat = 'En Reception')
								{
									$dossier->etat = '10';
									$dossier->save();
								}

								return response()
								->json([
									'success' => 'Le paiement a été enregistré avec succès !',
									'nouveau' => json_encode($paiement),
									'facture' => json_encode($facture),
									'paiements' => json_encode($paiements),
									'factures' => json_encode($factures),
									'montant_avoir' => json_encode($montant_avoir),
									'dossiers' => json_encode($dossiers),

										], 200)
								;
							}
						}
						
						
						$paiement = new Paiement();
						$paiement->id_facture = $request['id_facture'];
						$paiement->date_paiement = date('Y-m-d');
						$paiement->heure_paiement = date('H:i:s');
						$paiement->verse = $request['somme_verse'];
						$paiement->percu = $request['somme_verse'] - $request['remboursement'];
						$paiement->rembourse = $request['remboursement'];
						$paiement->type_paiement = $request['type_paiement'];
						$paiement->banque = strtoupper($request['nom_banque']);
						$paiement->numero_cheque = $request['numero_cheque'];
						$paiement->id_agent = Auth::id();
					


					if($paiement->save())
					{
						$facture = Facture::find($paiement->id_facture);
						$dossier = Dossier::find($facture->id_dossier);
						$paiements = Paiement::where('id_facture', $request['id_facture'])->orderBy('date_paiement')->get();
						$factures = array();
						$patient = Patient::find($dossier->id_patient);
						$montant_avoir = $patient->montant_avoir;
						$dossiers = Dossier::where('id_patient', $patient->id)->where('statut', 1)->orderBy('date_dossier', 'desc')->get();
						foreach($dossiers as $doss)
						{
							$factu = Facture::where('id_dossier', $doss->id)->first();
							if(count($factu) != 0)
							{
								array_push($factures, $factu);
							}
						}

						if($dossier->etat = 'En Reception')
						{
							$dossier->etat = '10';
							$dossier->save();
						}
						return response()
						->json([
							'success' => 'Le paiement a été enregistré avec succès !',
							'nouveau' => json_encode($paiement),
							'facture' => json_encode($facture),
							'paiements' => json_encode($paiements),
							'factures' => json_encode($factures),
							'montant_avoir' => json_encode($montant_avoir),
							'dossiers' => json_encode($dossiers),

								], 200)
						;
					}
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Paiement !'
						], 200);
					}
					}
					else
					{
						$type_paiement = TypePaiement::find($request['type_paiement']);
						if($type_paiement->libelle_paiement == 'COMPTE PREPAYE')
						{
							$paiement = Paiement::find($request['id_paiement']);
							$paiement->id_facture = $request['id_facture'];
							$paiement->date_paiement = date('Y-m-d');
							$paiement->heure_paiement = date('H:i:s');
							$paiement->verse = $request['somme_verse'];
							$paiement->percu = $request['somme_verse'] - $request['remboursement'];
							$paiement->rembourse = $request['remboursement'];
							$paiement->type_paiement = $request['type_paiement'];
							$paiement->banque = strtoupper($request['nom_banque']);
							$paiement->numero_cheque = $request['numero_cheque'];
							$paiement->id_agent = Auth::id();
							if($paiement->save())
							{
								
								$facture = Facture::find($paiement->id_facture);
								$dossier = Dossier::find($facture->id_dossier);
								$patient = Patient::find($dossier->id_patient);
								$patient->montant_avoir -= $paiement->percu;
								$montant_voir = $patient->montant_avoir;
								$patient->save();
								$paiements = Paiement::where('id_facture', $request['id_facture'])->orderBy('date_paiement')->get();

								if($dossier->etat = 'En Reception')
								{
									$dossier->etat = '10';
									$dossier->save();
								}
								$dossiers = Dossier::where('id_patient', $patient->id)->where('statut', 1)->orderBy('date_dossier', 'desc')->get();
								foreach($dossiers as $doss)
								{
									$factu = Facture::where('id_dossier', $doss->id)->first();
									if(count($factu) != 0)
									{
										array_push($factures, $factu);
									}
								}
								return response()
								->json([
									'success' => 'Le paiement a été enregistré avec succès !',
									'nouveau' => json_encode($paiement),
									'facture' => json_encode($facture),
									'paiements' => json_encode($paiements),
									'montant_avoir' => json_encode($montant_avoir),
									'dossiers' => json_encode($dossiers),

										], 200)
								;
							}
						}
						$paiement = Paiement::find($request['id_paiement']);
                        $paiement->id_facture = $request['id_facture'];
						$paiement->date_paiement = date('Y-m-d');
						$paiement->heure_paiement = date('H:i:s');
						$paiement->verse = $request['somme_verse'];
						$paiement->percu = $request['somme_verse'] - $request['remboursement'];
						$paiement->rembourse = $request['remboursement'];
						$paiement->type_paiement = $request['type_paiement'];
						$paiement->banque = strtoupper($request['nom_banque']);
						$paiement->numero_cheque = $request['numero_cheque'];
						$paiement->id_agent = Auth::id();

						if($paiement->save())
						{
							return response()
							->json([
								'success' => 'Le Paiement a été Modifié avec succès !',
								'nouveau' => json_encode($paiement),
								
									], 200)
							;
						}
						else
						{
							return response()->json([
								'erreur' => 'Une erreur est survenue pendant la modification de ce paiement !'
							], 200);
						}
					}		
					

				}
			else{
				return redirect()->route('login', 302);
			}

	}
}
