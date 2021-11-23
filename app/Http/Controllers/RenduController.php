<?php

namespace App\Http\Controllers;
use Validator;
use App\Rendu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\RenduResultat;
use App\TypeResultat;


class RenduController extends Controller
{
   
   public function show( Request $request)
    {
       if(Auth::check())
        {
			if($request['id_examen'] != null)
			{
				$rendus = Rendu::where('code_examen', $request['id_examen'])->where('statut', 1)->orderBy('ordre')->get();
				
				if($request->ajax()){					
					return response()->json(['rendus' => json_encode($rendus)], 200);
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
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Rendu'
					], 200);	
			}
			

				if($request['id_rendu'] == null)
				{
					$rendu = new Rendu();
					$rendu->libelle_rendu = $request['libelle_rendu'];
					$rendu->code_examen = $request['code_examen'];
					$rendu->min = $request['min'];
					$rendu->max = $request['max'];

					if($request['ordre'] == null)
					{
						$rendu->ordre = 30;
					}
					else
					{
						$rendu->ordre = $request['ordre'];
					}

					$rendu->unite = $request['unite'];
					$rendu->type = $request['type'];
					$rendu->statut = '1';
					
					

				if($rendu->save())
				{
					return response()
					->json([
						'success' => 'Le Rendu a été enregistré avec success',
						'nouveau' => json_encode($rendu),
						
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Rendu'
					], 200);
				}
				}
				else
				{
					$rendu = Rendu::find($request['id_rendu']);
					$rendu->libelle_rendu = $request['libelle_rendu'];
					$rendu->code_examen = $request['code_examen'];
					$rendu->min = $request['min'];
					$rendu->max = $request['max'];
					$rendu->ordre = $request['ordre'];
					$rendu->unite = $request['unite'];
					$rendu->type = $request['type'];
					$rendu->statut = '1';
										

				if($rendu->save())
				{
					return response()
					->json([
						'success' => 'Le Rendu a été Modifié avec success',
						'nouveau' => json_encode($rendu),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de ce Rendu'
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
			if(!$request['id_rendu'] == null)
			{
				$to_suppress = explode(",", $request['id_rendu']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						$rendu = Rendu::find($element);
						$rendu->statut = '0';
						if($rendu->save())
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
							'success' => 'Le rendu a bien été supprimmé avec succès!',
							'supprimes' => json_encode($deleted_elements),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les rendus ont bien été supprimmé avec succès!',
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

	public function StoreRenduResultat(Request $request)
	{
		if(Auth::check())
		{
			$rendu = new RenduResultat();
			$rendu->id_rendu = $request['id_rendu'];
			$rendu->id_type_resultat = $request['id_type_resultat'];					

				if($rendu->save())
				{
					return response()
					->json([
						'success' => 'Le Resultat de Rendu a été enregistré avec success',
						'nouveau' => json_encode($rendu),
						'libelle' => json_encode(TypeResultat::find($rendu->id_type_resultat)->libelle_type_resultat),
						
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Résultat de Rendu'
					], 200);
				}
		}
		else
		{
			return redirect()->route('login', 302);
		}
	}

	public function DeleteModel2(Request $request)
	{
		if(Auth::check())
        {
			if(!$request['id_type_resultat'] == null)
			{
				$to_suppress = explode(",", $request['id_type_resultat']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						 RenduResultat::where('id', $element)->delete();
						
							array_push($deleted_elements, $element);				
						
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
							'success' => 'Le Réultat de rendu a bien été supprimmé avec succès!',
							'supprimes' => json_encode($deleted_elements),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les Résultats de rendus ont bien été supprimmé avec succès!',
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
