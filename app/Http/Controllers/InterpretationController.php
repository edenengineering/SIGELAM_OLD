<?php

namespace App\Http\Controllers;
use Validator;
use App\Interpretation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InterpretationController extends Controller
{
   
   public function show( Request $request)
    {
       if(Auth::check())
        {
			if($request['id_examen'] != null)
			{
				$interpretations = Interpretation::where('code_examen', $request['id_examen'])->where('statut', 1)->orderBy('libelle_interpretation')->get();
				if($request->ajax()){					
					return response()->json(['interpretations' => json_encode($interpretations)], 200);
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
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette interpretation'
					], 200);	
			}
			

				if($request['id_interpretation'] == null)
				{
					$interpretation = new Interpretation();
					$interpretation->libelle_interpretation = strtoupper($request['libelle_interpretation']);
					$interpretation->code_examen = $request['code_examen'];				
					$interpretation->statut = '1';
					
					

				if($interpretation->save())
				{
					return response()
					->json([
						'success' => 'L\'interpretation a été enregistrée avec success',
						'nouveau' => json_encode($interpretation),
						
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette Interpretation'
					], 200);
				}
				}
				else
				{
					$interpretation = Interpretation::find($request['id_interpretation']);
					$interpretation->libelle_interpretation = strtoupper($request['libelle_interpretation']);
					$interpretation->code_examen = $request['code_examen'];					
					$interpretation->statut = '1';
										

				if($interpretation->save())
				{
					return response()
					->json([
						'success' => 'L\'interpretation a été Modifiée avec success',
						'nouveau' => json_encode($interpretation),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de cette interpretation',
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
			if(!$request['id_interpretation'] == null)
			{
				$to_suppress = explode(",", $request['id_interpretation']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						$interpretation = Interpretation::find($element);
						$interpretation->statut = '0';
						if($interpretation->save())
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
							'success' => 'L\'interpretation a bien été supprimmée avec succès!',
							'supprimes' => json_encode($deleted_elements),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les interpretations ont bien été supprimmées avec succès!',
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
