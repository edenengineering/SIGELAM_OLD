<?php

namespace App\Http\Controllers;
use Validator;
use App\ConclusionExamen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ExamenDossier;
use App\Examen;
use App\Dossier;

class ConclusionExamenController extends Controller
{
   
   public function show( Request $request)
    {
       if(Auth::check())
        {
			if($request['id_examen_dossier'] != null)
			{
				$examen_conclusion = ConclusionExamen::where('id_examen_dossier', $request['id_examen_dossier'])->get();
				
				if($request->ajax()){					
					return response()->json(['conclusion' => json_encode($examen_conclusion)], 200);
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
			

				if($request['id_examen_dossier'] != null)
				{
					ConclusionExamen::where('id_examen_dossier', $request['id_examen_dossier'])->delete();
					$examen_dossier = ExamenDossier::find($request['id_examen_dossier']);
					$examen = Examen::find($examen_dossier->code_examen);
					$dossier = Dossier::find($examen_dossier->code_dossier);
					$conclusion_examen = new ConclusionExamen();
					$conclusion_examen->id_examen_dossier = $request['id_examen_dossier'];
					$conclusion_examen->id_dossier = $dossier->id;
					$conclusion_examen->id_examen = $examen->id;
					$conclusion_examen->conclusion = $request['conclusion'];
					
					
					

				if($conclusion_examen->save())
				{
					return response()
					->json([
						'success' => 'La Conclusion de cet examen a été enregistrée avec success',
						'nouveau' => json_encode($conclusion_examen),
						
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette Conclusion'
					], 200);
				}
				}
				else
				{
					$conclusion_examen =  ConclusionExamen::find($request['id_examen_conclusion']);
					$conclusion_examen->id_examen_dossier = strtoupper($request['id_examen_dossier']);
					$conclusion_examen->conclusion = $request['conclusion'];
										

				if($conclusion_examen->save())
				{
					return response()
					->json([
						'success' => 'La Conclusion de cet Examen a été modifiée avec success',
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de cette Conclusion'
					], 200);
				}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }
	
	
}
