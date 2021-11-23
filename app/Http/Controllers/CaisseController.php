<?php

namespace App\Http\Controllers;

use App\Paiement;
use App\Facture;
use App\Dossier;
use App\Patient;
use App\TypePaiement;
use Auth;
use App\User;
use Illuminate\Http\Request;

class CaisseController extends Controller
{
    public function Show(Request $request)
	{
		if(Auth::check())
		{
			if($request['date_debut'] != null && $request['date_fin'] !=  null)
			{
				
				$paiementsfull = Paiement::where('created_at', '>=',$request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->where('id_agent', Auth::id())->get();
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
					$user = User::find(Auth::id());

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
				
				return response()->json(['result' => json_encode($result), 'total1' => $ValTot1, 'total2' => $ValTot2], 200);

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
