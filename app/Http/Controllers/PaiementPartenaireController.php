<?php
namespace App\Http\Controllers;
use App\PaiementPartenaire;
use App\FacturePartenaire;
use App\Partenaire;
use App\Paiement;
use App\Facture;
use App\Patient;
use App\Dossier;
use App\TypePaiement;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

class PaiementPartenaireController extends Controller
{
    public function show( Request $request)
    {
		if(Auth::check())
        {
			if($request['id_facture'] != null)
			{
				$paiements_facture = PaiementPartenaire::where('id_facture_partenaire', $request['id_facture_partenaire'])->get();
				$facture = FacturePartenaire::find($request['id_facture_partenaire']);
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
	
	public function Store(Request $request)
	{		
		if(Auth::check())
		{				
			if($request['id_facture'] != null)
			{	
				$facture = FacturePartenaire::find($request['id_facture']);
				$partenaire = Partenaire::find($facture->id_partenaire);
				if($partenaire->id_type_partenaire == 1) //Assureur
				{
					$paiement= new PaiementPartenaire();
					$paiement->id_facture_partenaire = $request['id_facture'];
					$paiement->user_id = Auth::id();
					$paiement->date_paiement_partenaire = date('Y-m-d');
					$paiement->heure_paiement_partenaire = date('H:i:s');
					$paiement->verse = $request['somme_verse'];
					$paiement->percu = $request['somme_verse'];
					$paiement->rembourse = 0;
					$paiement->dossiers = $request['id_dossier'];
					$paiement->type_paiement = $request['type_paiement'];
					$paiement->banque = $request['nom_banque'];
					$paiement->numero_cheque = $request['numero_cheque'];
					if($paiement->save())
					{
						$facture = FacturePartenaire::find($request['id_facture']);
						
						if($partenaire->id_type_partenaire == 1)
						{
							$dossiers = Dossier::where('id_assureur', $facture->id_partenaire)->where('date_dossier', '>=', $facture->date_debut. ' 00:00:00')->where('date_dossier', '<=', $facture->date_fin . ' 23:59:59')->get();
							$result = array();
							$val_total = 0;
							foreach($dossiers as $dossier)
							{
								
								$patient = Patient::find($dossier->id_patient);
								$facture = Facture::where('id_dossier',$dossier->id)->first();
								$percu = 0;
								
								$statut = 'Non Réglée';
								$paiements = PaiementPartenaire::where('id_facture_partenaire', $request['id_facture'])->get();

								if($this->CheckIfDossierPaid($paiements, $dossier->id))
								{
									$percu = round(($facture->total * $dossier->pourcentage / (100 - $dossier->pourcentage)),0, PHP_ROUND_HALF_UP);
								}
								if($percu == round(($facture->total * $dossier->pourcentage / (100 - $dossier->pourcentage)),0, PHP_ROUND_HALF_UP))
								{
									$statut = 'Réglée';
								}
								
								if($facture != null)
								{
									$collection = collect([
										'code' => $dossier->id,
										'date' => $dossier->date_dossier,
										'nom' => $patient->nom_patient,
										'total' => round(($facture->total * $dossier->pourcentage / (100 - $dossier->pourcentage)),0, PHP_ROUND_HALF_UP),
										'percu' => $percu,
										'statut' => $statut,
										'reste' => round(($facture->total * $dossier->pourcentage / (100 - $dossier->pourcentage)),0, PHP_ROUND_HALF_UP),
										
								]);
								$val_total += round(($facture->total * $dossier->pourcentage / (100 - $dossier->pourcentage)),0, PHP_ROUND_HALF_UP);;
								array_push($result, $collection);	
								}
						
							}
					
								$factureP = FacturePartenaire::find($request['id_facture']);
							// Creation de la nouvelle facture pour le partenaire specifie
										
							return response()->json(['dossiers' => json_encode($result), 'facture' => json_encode($factureP), 'paiements' => json_encode($paiements), 'success' => 'Le paiement a été enregistré avec succès !',], 200);

						}
					}
					else
					{
						return response()->json([
								'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Paiement !'
							], 200);
					}
				}
				else // Sous Traitant
				{
					$paiement= new PaiementPartenaire();
					$paiement->id_facture_partenaire = $request['id_facture'];
					$paiement->user_id = Auth::id();
					$paiement->date_paiement_partenaire = date('Y-m-d');
					$paiement->heure_paiement_partenaire = date('H:i:s');
					$paiement->verse = $request['somme_verse'];
					$paiement->percu = $request['somme_verse'];
					$paiement->rembourse = 0;
					$paiement->dossiers = $request['id_dossier'];
					$paiement->type_paiement = $request['type_paiement'];
					$paiement->banque = $request['nom_banque'];
					$paiement->numero_cheque = $request['numero_cheque'];
					if($paiement->save())
					{
						$dos = $paiement->dossiers;
						$val_dos = explode(",", $dos);
						foreach($val_dos as $val)
						{
							$dossier = Dossier::find($val);
							$facture = Facture::where('id_dossier', $dossier->id)->first();
							$new_paiement = new Paiement();
							$new_paiement->id_facture = $facture->id;
							$new_paiement->date_paiement = date('Y-m-d');
							$new_paiement->heure_paiement = date('H:i:s');
							$new_paiement->verse = $facture->total;
							$new_paiement->percu = $facture->total;
							$new_paiement->rembourse = 0;
							$new_paiement->type_paiement = $paiement->type_paiement;
							$new_paiement->banque = $paiement->banque;
							$new_paiement->numero_cheque = $paiement->numero_cheque;
							$new_paiement->id_agent = Auth::id();
							$new_paiement->id_sous_traitant = $request['id_partenaire'];
							$new_paiement->save();
						}
						$factureP = FacturePartenaire::find($request['id_facture']);
						$dossiers = Dossier::where('id_assureur', $factureP->id_partenaire)->where('date_dossier', '>=', $factureP->date_debut. ' 00:00:00')->where('date_dossier', '<=', $factureP->date_fin . ' 23:59:59')->get();
						$result = array();
						$val_total = 0;
						$paiements = PaiementPartenaire::where('id_facture_partenaire', $request['id_facture'])->get();

						foreach($dossiers as $dossier)
						{
							$patient = Patient::find($dossier->id_patient);
							$facture = Facture::where('id_dossier',$dossier->id)->first();
							$percu = 0;
							$statut = 'Non Réglée';
							
							if($this->CheckIfDossierPaid($paiements, $dossier->id))
							{
								$percu = $facture->total;
							}
							if($percu == $facture->total);
							{
								$statut = 'Réglée';
							}
							if($facture != null)
							{
								$collection = collect([
									'code' => $dossier->id,
									'date' => $dossier->date_dossier,
									'nom' => $patient->nom_patient,
									'total' => $facture->total,
									'percu' => $percu,
									'statut' => $statut,
									'reste' => $facture->total - $percu,									
								]);
								$val_total += $facture->total;
								array_push($result, $collection);	
							}
						
						}
					
					
						// Creation de la nouvelle facture pour le partenaire specifie
						$factureP->total = $val_total;
						$factureP->save();	
						$factureP = FacturePartenaire::find($request['id_facture']);
						
						return response()->json(['dossiers' => json_encode($result), 'facture' => json_encode($factureP), 'paiements' => json_encode($paiements), 'success' => 'Le paiement a été enregistré avec succès !',], 200);
					}				
					else
					{
						return response()->json([
								'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Paiement !'
							], 200);
					}
				}
			}
			
		}
		else
		{
			return redirect()->route('login', 302);
		}

	}
	public function CheckIfDossierPaid($list_dossier, $id_dossier)
	{
		foreach($list_dossier as $paiement)
		{
			$dossiers = $paiement->dossiers;
			$val_dossiers = explode(",", $dossiers);
			foreach($val_dossiers as $val)
			{
				if($val ==  $id_dossier)
				{
					return true;
				}
			}
		}
		return false;
	}	
}
