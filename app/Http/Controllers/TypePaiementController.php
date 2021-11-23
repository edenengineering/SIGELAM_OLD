<?php

namespace App\Http\Controllers;

use Validator;
use App\TypePaiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypePaiementController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $type_paiements = TypePaiement::where('statut', '1')->orderBy('libelle_paiement', 'asc')->get();
			
            return view('dashboard_type_paiement')->withTypePaiements($type_paiements);
        }
        else
        {
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
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Type de Paiement !'
					], 200);	
			}
			

				if($request['id_type_paiement'] == null)
				{
					$type_paiement = new TypePaiement();
					$type_paiement->libelle_paiement = strtoupper($request['libelle_paiement']);
					$type_paiement->statut = '1';

				if($type_paiement->save())
				{
					return response()
					->json([
						'success' => 'Le Type de Paiement a été enregistré avec succès !',
						'nouveau' => json_encode($type_paiement),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Type de Paiement !'
					], 200);
				}
				}
				else
				{
					$type_paiement = TypePaiement::find($request['id_type_paiement']);
					$type_paiement->libelle_paiement = strtoupper($request['libelle_paiement']);

					if($type_paiement->save())
					{
						return response()
						->json([
							'success' => 'Le Type de Paiement  a été Modifié avec succès !',
							'nouveau' => json_encode($type_paiement),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant la modification de ce Type de Paiement !'
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
			if(!$request['id_type_paiement'] == null)
			{
				$to_suppress = explode(",", $request['id_type_paiement']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						$type_paiement = TypePaiement::find($element);
						$type_paiement->statut = '0';
						if($type_paiement->save())
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
							'success' => 'Le Type de Paiement a bien été supprimmé avec succès !',
							'supprimes' => json_encode($deleted_elements),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les Types de Paiement ont bien été supprimmé avec succès!',
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
