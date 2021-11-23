<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commande;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\CommandeMateriel;


class CommandeMaterielController extends Controller
{
     
   public function show( Request $request)
    {
		if(Auth::check())
        {
			if($request['id_commande'] != null)
			{
				$commande_materiels = CommandeMateriel::where('code_commande', $request['id_commande'])->get();
				
				if($request->ajax()){					
					return response()->json(['commande_materiels' => json_encode($commande_materiels)], 200);
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
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce(s) matériel(s) de Commande !'
					], 200);	
			}
			

				if($request['id_commande_materiel'] == null)
				{
					
					$max = count($request['values']);
					$values = $request['values'];
					$nbre = 0;					
					for($i = 0; $i < $max; $i = $i +5)
					{
						
							CommandeMateriel::where('code_materiel', $values[$i])->where('code_commande', $values[$i+1])->delete();
						
						$commande_materiel = new CommandeMateriel();
						$commande_materiel->code_materiel = $values[$i];
						$commande_materiel->code_commande = $values[$i+1];
						$commande_materiel->quantite_commande = $values[$i+2];
						$commande_materiel->quantite_livre = $values[$i+3];
						$commande_materiel->prix = $values[$i+4];
						$commande_materiel->total = $commande_materiel->prix * $commande_materiel->quantite_commande;						
						if($commande_materiel->save())
						{
							$nbre++;
						}
					}					
						
 						return response()
						->json([
							'success' => 'Le(s) ' . $nbre . ' matériel(s) de cette commande a (ont) été enregistré avec succès !',
							'nouveau' => json_encode($commande_materiel),							
								], 200);
					
				}				
				else
				{
					$commande_materiel = CommandeMateriel::find($request['id_commande_materiel']);				
				
					if($commande->save())
					{ 
					
						return response()
						->json([
							'success' => 'Le(s) matériel(s) de cette commande a (ont) été modifié avec succès !',
							'nouveau' => json_encode($commande),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant la modification de ce(s) matériel(s) de commande !',
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
	
	
	public function prix(Request $request)
	{
		if(Auth::check())
        {
			if(!$request['id_materiel'] == null)
			{
				$commande_materiel = CommandeMateriel::where('code_materiel', $request['id_materiel'])->orderBy('prix', 'asc')->first();
				$prix = 0;
				if($commande_materiel != null)
				{
					$prix = $commande_materiel->prix;
				}
				if($request->ajax()){					
					return response()->json(['prix' => json_encode($prix)], 200);
				}
			}			
		}				
		else
		{
            return redirect()->route('login', 302);
        }	
	
	}
}
