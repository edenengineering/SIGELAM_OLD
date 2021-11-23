<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paiement;
use App\Facture;
use App\Partenaire;
use App\PaiementPartenaire;
use App\Dossier;
use App\Patient;
use App\TypePaiement;
use App\FacturePartenaire;
use Auth;
use App\User;

class CaisseGeneraleController extends Controller
{
	public function Show(Request $request)
	{
		if(Auth::check())
		{
			if($request['date_debut'] != null && $request['date_fin'] !=  null)
			{
				
				$paiementsfull = Paiement::where('created_at', '>=',$request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->get();
				$grouped = $paiementsfull ->groupBy('id_facture');
				$result = array();
				$ValTot1 = 0;
				$ValTot2 = 0;
				$num = 0; 
				foreach($grouped as $paiements) 
				{
					$numItems = count($paiements);
					$valTotal = 0;
					$i = 0;
					

					foreach($paiements as $paiement)
					{
						$user = User::find($paiement->id_agent);
						$valTotal += $paiement->percu;
						if(++$i === $numItems) 
						{
							$num++;
							$facture = Facture::find($paiement->id_facture);
							$dossier = Dossier::find($facture->id_dossier);
							$patient = Patient::find($dossier->id_patient);
							$reglement = TypePaiement::find($paiement->type_paiement);
							$collection = collect([
										'numero' => $num,	
										'agent' => $user->name,
										'dossier' => $dossier->id,
										'patient' => $patient->nom_patient,
										'total' => $facture->total ,
										'reduction' => $dossier->pourcentage,
										'cash' => $valTotal,
										'reste' => $facture->reste_a_payer,
										'reglement' => $reglement->libelle_paiement,
										'NCheque' => $paiement->numero_cheque,
										'NBanque' => $paiement->banque,
										
										
										
							]);
							$ValTot1 +=  $valTotal;
							$ValTot2 +=   $facture->total;
							array_push($result, $collection);

						}
						
					}
				}

				//$paiementsfull2 = PaiementPaiement::where('created_at', '>=',$request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->get();
				$factures = FacturePartenaire::where('date_debut', '>=',$request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->get();
				$result2 = array();
				$ValTot3 = 0;
				$ValTot4 = 0;
				foreach($factures as $facture)
				{
					$user = User::find($facture->user_id);
					$partenaire = Partenaire::find($facture->id_partenaire);
					$paiement = '';
					$paies = PaiementPartenaire::where('id_facture_partenaire', $facture->id)->first();
					if(count($paies) == 1)
					{
						$type = TypePaiement::find($paies->type_paiement);
						$paiement = $type->libelle_paiement;
					}
					$collection = collect([
						'agent' => $user->name,
						'ref_facture' => $facture->ref_facture,
						'raison_sociale' => $partenaire->libelle_partenaire,
						'montant' => $facture->total,
						'cash' => $facture->percu,
						'estimation' => 0,
						'periode'=> 'Nom',
						'paiement' => $paiement,
					]);
					$ValTot3 += $facture->total;
					$ValTot4 += $facture->total;
					array_push($result2, $collection);

				}
				return response()->json([
										'dossiers1' => json_encode($result),
										'total1' => $ValTot1, 
										'total2' => $ValTot2, 
										'dossiers2' => json_encode($result2),
										'total3' => $ValTot3,
										'total4' => $ValTot4], 200);

			}
			else
			{
			}
			
		}
		else{
			return redirect()->route('login', 302);
		}
	}
	
	public function getPeriodeDate($date)
	{
		
	}
	
}

