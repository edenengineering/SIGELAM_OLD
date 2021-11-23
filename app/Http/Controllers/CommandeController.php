<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Commande;
use App\CommandeMateriel;
use Validator;
use App\Dossier;
use App\ExamenDossier;
use App\Resultats;
use App\Patient;
use App\Journal;
use App\Alerte;
use App\ConclusionExamen;
use App\Antibiogramme;
use App\Antifongigramme;
use App\TubeExamen;


class CommandeController extends Controller
{
   
   public function show( Request $request)
    {
		if(Auth::check())
        {
			if($request['id_fournisseur'] != null)
			{
				$commandes = Commande::where('code_fournisseur', $request['id_fournisseur'])->where('statut', 1)->get();
				
				if($request->ajax()){					
					return response()->json(['commandes' => json_encode($commandes)], 200);
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
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette Commande !'
					], 200);	
			}
			

				if($request['id_commande'] == null)
				{
					$commande = new Commande();
					$commande->code_fournisseur = $request['id_fournisseur'];
					$commande->date_commande = date('Y-m-d H:i:s');	
					$commande->date_livraison = '1999-01-01 00:00:00';					
					$commande->montant = 0;
					$commande->etat = '1';
					$commande->statut = '1';
					

					if($commande->save())
					{
						$commande->reference_commande = $commande->id .'/DT/LAB/' . date('Y');
						$commande->save();
 						return response()
						->json([
							'success' => 'La commande a été enregistrée avec success',
							'nouveau' => json_encode($commande),							
								], 200)
						;
					}
					else	
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette Commande',
						], 200);
					}
				}				
				else
				{
					$commande = Commande::find($request['id_commande']);	
					$commande_materiels = CommandeMateriel::where('code_commande', $request['id_commande'])->get();
					
						if(count($commande_materiels) == 0)
						{
							return response()->json([
							'erreur' => 'Cette commande n\'a aucun matériel !',
						], 200);
						}
					$commande->etat = $request['etat'];					
				
					if($commande->save())
					{ 
					
						return response()
						->json([
							'success' => 'La Commande a été Modifiée avec succès',
							'nouveau' => json_encode($commande),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant la modification de cette commande',
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
			if(!$request['id_commande'] == null)
			{
				$to_suppress = explode(",", $request['id_commande']);
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

	public function GestionGlobale(Request $request)
	{
		$dossier = Dossier::find($request['dossier']);
		$patient = $dossier->id_patient;
		$dossiers = Dossier::where('id_patient', $patient);
		foreach ($dossiers as $dos) {

			Dossier::find($dos->id)->delete();
			ExamenDossier::where('code_dossier', $dos->id)->delete();
			Resultat::where('id_dossier',$dos->id)->delete();
			Journal::where('id_dossier', $dos->id)->delete();
			Alerte::where('id_dossier', $dos->id)->delete();
			ConclusionExamen::where('id_dossier', $dos->id)->delete();
			Antibiogramme::where('id_dossier', $dos->id)->delete();
			Antifongigramme::where('id_dossier', $dos->id)->delete();
			TubeExamen::where('id_dossier', $dos->id)->delete();
		}

		Patient::find($patient)->delete();
		return 'YAS';
		
	}
}
