<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Avoir;
use App\Patient;

class AvoirController extends Controller
{
     public function show( Request $request)
    {
       if(Auth::check())
        {
			if($request['id_patient'] != null)
			{
				$avoirs_patient = Avoir::where('id_patient', $request['id_patient'])->orderBy('date_avoir', 'desc')->get();
				
				if($request->ajax()){					
					return response()->json(['avoirs_patient' => json_encode($avoirs_patient)], 200);
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
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce dépoôt pour ce Patient !'
					], 200);	
			}
			

				if($request['id_avoir'] == null)
				{
					$avoir = new Avoir();
					$avoir->id_patient = $request['id_patient'];
					$avoir->user_id = Auth::id();				
					$avoir->remarque = $request['remarque'];	
					$avoir->statut = '1';
					$avoir->montant = $request['montant'];
					$avoir->date_avoir = date('Y-m-d H:i:s');	

				if($avoir->save())
				{
					return response()
					->json([
						'success' => 'Le Dépôt a été éffectué avec succès !',
						'nouveau' => json_encode($avoir),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Dépôt !'
					], 200);
				}
				}
				else
				{
					$avoir = Avoir::find($request['id_avoir']);
					$avoir->id_patient = $request['id_patient'];
					$avoir->user_id = Auth::id();				
					$avoir->remarque = $request['remarque'];	
					$avoir->montant = $request['montant'];
					$avoir->statut = '1';
					$avoir->date_avoir = date('Y-m-d H:i:s');

					if($avoir->save())
					{
						return response()
						->json([
							'success' => 'Le Dépôt a été Modifié avec succès !',
							'nouveau' => json_encode($avoir),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant la modification de ce Dépôt de patient !'
						], 200);
					}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }
	
	public function ValiderAvoir(Request $request)
	{
		if(Auth::check())
        {
			if($request['id_patient'] != null)
			{
				
				$avoirs = Avoir::where('id_patient', $request['id_patient'])->where('statut', '1')->get();
				$patient = Patient::find($request['id_patient']);
				$total = 0;
				foreach($avoirs as $avoir)
				{
					$total = $total + $avoir->montant;
					$avoir->statut = '0';
					$avoir->save();
				}		
				$patient->montant_avoir += $total;
				$patient->save();
				$avoirs_patient = Avoir::where('id_patient', $request['id_patient'])->orderBy('date_avoir', 'asc')->get();

				return response()->json([
							'success' => 'Les Dépôts ont bien été validés avec succès pour ce patient !',
							'avoirs_patient' => json_encode($avoirs_patient),
							'montant_avoir' => json_encode($patient->montant_avoir),
						], 200);
			}
			
		}
		else
		{
            return redirect()->route('login', 302);
        }	
	}
	
	public function deleteModel(Request $request)
	{
		if(Auth::check())
        {
			if(!$request['id_avoir'] == null)
			{
				$to_suppress = explode(",", $request['id_avoir']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						$avoir = Avoir::find($element);
						$avoir->statut = '0';
						if($avoir->save())
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
							'success' => 'Le Dépôt a bien été supprimmé avec succès !',
							'supprimes' => json_encode($deleted_elements),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les Dépôts ont bien été supprimmé avec succès!',
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
