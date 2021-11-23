<?php

namespace App\Http\Controllers;

use App\Paiement;
use App\Facture;
use App\Dossier;
use App\Patient;
use App\TypePaiement;
use Auth;
use App\User;
use App\Partenaire;
use App\CentrePrescripteur;
use Illuminate\Http\Request;

class HistoriqueFactureController extends Controller
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
						$valTotal += $paiement->percu;
						if(++$i === $numItems) 
						{
							$num++;
							$facture = Facture::find($paiement->id_facture);
							$dossier = Dossier::find($facture->id_dossier);
							$patient = Patient::find($dossier->id_patient);
							$reglement = TypePaiement::find($paiement->type_paiement);
							$partenaire = Partenaire::find($dossier->id_assureur);
							$centre_prescripteur = CentrePrescripteur::find($dossier->centre_prescripteur);
							$user = User::find($dossier->id_agent);
							$collection = collect([
										'numero' => $num,
										'agent' => $user->name,
										'date' => $dossier->date_dossier,
										'dossier' => $dossier->id ,
										'patient' => $patient->nom_patient,
										'reduction' => $dossier->pourcentage,
										'total' => $facture->total,
										'percu' => $facture->percu,
										'reste' => $facture->reste_a_payer,
										'prise_en_charge' => $partenaire->libelle_partenaire,
										'prescripteur' => $dossier->nom_prescripteur,
										'centre_prescripteur' => $centre_prescripteur->libelle_centre,
										'urgence' => $dossier->urgence,
										
										
							]);
							$ValTot1 +=  $valTotal;
							$ValTot2 +=   $facture->total;
							array_push($result, $collection);

						}
						
					}
				} 
				
				return response()->json(['dossiers' => json_encode($result), 'total' => $ValTot2], 200);

			}
			else
			{
			}
			
		}
		else{
			return redirect()->route('login', 302);
		}
	}
}
