<?php

namespace App\Http\Controllers;
use Auth;
use App\Partenaire;
use App\Patient;
use App\Paiement;
use App\Dossier;
use App\Examen;
use App\ExamenDossier;
use App\Facture;
use App\User;
use App\PaiementPartenaire;
use App\FacturePartenaire;
use Illuminate\Http\Request;

class FacturePartenaireController extends Controller
{
	public function show(Request $request)
	{
		if(Auth::check())
		{
			if($request['id_facture_partenaire'] != null)
			{
				
				$factureP = FacturePartenaire::find($request['id_facture_partenaire']);
				$partenaire = Partenaire::find($factureP->id_partenaire);
				$paiements = PaiementPartenaire::where('id_facture_partenaire', $request['id_facture_partenaire'])->get();
				if($partenaire->id_type_partenaire == 1)
				{
					$dossiers = Dossier::where('id_assureur', $factureP->id_partenaire)->where('date_dossier', '>=', $factureP->date_debut. ' 00:00:00')->where('date_dossier', '<=', $factureP->date_fin . ' 23:59:59')->get();
					$result = array();
					$val_total = 0;
					foreach($dossiers as $dossier)
					{
						
						$patient = Patient::find($dossier->id_patient);
						$facture = Facture::where('id_dossier',$dossier->id)->first();
						$percu = 0;
						$statut = 'Non Réglée';
						
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
					
					
					// Creation de la nouvelle facture pour le partenaire specifie
					$factureP->total = $val_total;
					$factureP->save();	
					$factureP = FacturePartenaire::find($request['id_facture_partenaire']);
					
					return response()->json(['dossiers' => json_encode($result), 'facture' => json_encode($factureP), 'paiements' => json_encode($paiements)], 200);

				}
				else // On parle ici de sous-traitant
				{
					$dossiers = Dossier::where('id_assureur', $factureP->id_partenaire)->where('date_dossier', '>=', $factureP->date_debut. ' 00:00:00')->where('date_dossier', '<=', $factureP->date_fin . ' 23:59:59')->get();
					$result = array();
					$val_total = 0;
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
					$factureP = FacturePartenaire::find($request['id_facture_partenaire']);
					
					return response()->json(['dossiers' => json_encode($result), 'facture' => json_encode($factureP), 'paiements' => json_encode($paiements)], 200);
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
			if($request['id_partenaire'] != null)
			{
				
				$partenaire = Partenaire::find($request['id_partenaire']);
				if($partenaire->id_type_partenaire == 1)
				{
					$dossiers = Dossier::where('id_assureur', $request['id_partenaire'])->where('date_dossier', '>=',$request['date_debut']. ' 00:00:00')->where('date_dossier', '<=', $request['date_fin'] . ' 23:59:59')->get();
					$result = array();
					$val_total = 0;
					foreach($dossiers as $dossier)
					{
						
						$patient = Patient::find($dossier->id_patient);
						$facture = Facture::where('id_dossier',$dossier->id)->first();
						$statut = 'Non Réglée';
						$percu = 0;
						
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
								'percu' => 0,
								'statut' => $statut,
								'reste' => ($facture->total * $dossier->pourcentage / (100 - $dossier->pourcentage)),
								
						]);
						$val_total += round(($facture->total * $dossier->pourcentage / (100 - $dossier->pourcentage)),0, PHP_ROUND_HALF_UP);
						array_push($result, $collection);	
						}
						
					}
					
					
					// Creation de la nouvelle facture pour le partenaire specifie
					
					$facture_partenaire = new FacturePartenaire();
					$facture_partenaire->id_partenaire = $request['id_partenaire'];
					$facture_partenaire->user_id = Auth::id();
					$facture_partenaire->date_debut = $request['date_debut'];
					$facture_partenaire->date_fin = $request['date_fin'];
					$facture_partenaire->total = $val_total;
					$facture_partenaire->ref_facture = '0';
					$facture_partenaire->save();
					$facture = FacturePartenaire::find($facture_partenaire->id);
					
					return response()->json(['dossiers' => json_encode($result), 'facture' => json_encode($facture)], 200);

				}
				else // On parle ici de sous-traitant
				{
					$dossiers = Dossier::where('id_assureur', $request['id_partenaire'])->where('date_dossier', '>=',$request['date_debut']. ' 00:00:00')->where('date_dossier', '<=', $request['date_fin'] . ' 23:59:59')->get();
					$result = array();
					$val_total = 0;
					foreach($dossiers as $dossier)
					{
						
						$patient = Patient::find($dossier->id_patient);
						$facture = Facture::where('id_dossier',$dossier->id)->first();
						$statut = 'Non Réglée';
						$percu = 0;
						
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
								'total' => $facture->total,
								'percu' => 0,
								'statut' => $statut,
								'reste' => $facture->total,
								
						]);
						$val_total += $facture->total;
						array_push($result, $collection);	
						}
						
					}
					
					
					// Creation de la nouvelle facture pour le partenaire specifie
					
					$facture_partenaire = new FacturePartenaire();
					$facture_partenaire->id_partenaire = $request['id_partenaire'];
					$facture_partenaire->user_id = Auth::id();
					$facture_partenaire->date_debut = $request['date_debut'];
					$facture_partenaire->date_fin = $request['date_fin'];
					$facture_partenaire->total = $val_total;
					$facture_partenaire->ref_facture = '0';
					$facture_partenaire->save();
					$facture = FacturePartenaire::find($facture_partenaire->id);
					
					return response()->json(['dossiers' => json_encode($result), 'facture' => json_encode($facture)], 200);
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
			if(!$request['id_facture_partenaire'] == null)
			{
				$to_suppress = explode(",", $request['id_facture_partenaire']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						$facture = FacturePartenaire::find($element);
						$paiements = PaiementPartenaire::where('id_facture_partenaire', $facture->id)->get();
						if(count($paiements) == 0)
						{
							$facture->delete();						
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
							'success' => 'La facture a bien été supprimmé avec succès !',
							'supprimes' => json_encode($deleted_elements),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les Factures ont bien été supprimmées avec succès !',
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
	
	public function GetFactureDetaillee(Request $request)
	{
		if(Auth::check())
		{
			if($request['id_partenaire'] != null)
			{
				
				$partenaire = Partenaire::find($request['id_partenaire']);
				if($partenaire->id_type_partenaire == 1)
				{
					$dossiers = Dossier::where('id_assureur', $request['id_partenaire'])->where('date_dossier', '>=', $request['date_debut']. ' 00:00:00')->where('date_dossier', '<=', $request['date_fin'] . ' 23:59:59')->get();
					$result = array();
					$val_total = 0;
					foreach($dossiers as $dossier)
					{
						$examens_dossier = ExamenDossier::where('code_dossier', $dossier->id)->get();
						$patient = Patient::find($dossier->id_patient);
						foreach($examens_dossier as $examen)
						{
							$exam = Examen::find($examen->code_examen);
							$collection = collect([
								'code' => $dossier->id,
								'date' => $dossier->date_dossier,
								'nom' => $patient->nom_patient,
								'code_examen' => $examen->code_examen,
								'libelle'=> $exam->libelle_examen,
								'quantite' => $examen->quantite,
								'total' => $examen->prix_total,
								'reduction' => $dossier->pourcentage,
								'N' => $examen->indice,
								'ticket_m' => $examen->prix_net,
								'montant_r'=> $examen->prix_total - $examen->prix_net,
							]);
							
							array_push($result, $collection);	

						}
						
					}
					
					
					// Creation de la nouvelle facture pour le partenaire specifie
					
					return response()->json(['dossiers' => json_encode($result), ], 200);

				}
				else // On parle ici de sous-traitant
				{
					$dossiers = Dossier::where('id_assureur', $request['id_partenaire'])->where('date_dossier', '>=', $request['date_debut']. ' 00:00:00')->where('date_dossier', '<=', $request['date_fin'] . ' 23:59:59')->get();
					$result = array();
					$val_total = 0;
					foreach($dossiers as $dossier)
					{
						$examens_dossier = ExamenDossier::where('code_dossier', $dossier->id)->get();
						$patient = Patient::find($dossier->id_patient);
						foreach($examens_dossier as $examen)
						{
							$exam = Examen::find($examen->code_examen);
							$collection = collect([
								'code' => $dossier->id,
								'date' => $dossier->date_dossier,
								'nom' => $patient->nom_patient,
								'code_examen' => $examen->code_examen,
								'libelle'=> $exam->libelle_examen,
								'quantite' => $examen->quantite,
								'total' => $examen->prix_total,
								'reduction' => $dossier->pourcentage,
								'N' => $examen->indice,
								'ticket_m' => $examen->prix_net,
								'montant_r'=> $examen->prix_total - $examen->prix_net,
							]);
							
							array_push($result, $collection);	

						}
						
					}
					
					
					// Creation de la nouvelle facture pour le partenaire specifie
					
					return response()->json(['dossiers' => json_encode($result), ], 200);	}
				
			}		
			 
		}
		else{
			return redirect()->route('login', 302);
		}
	}
}
