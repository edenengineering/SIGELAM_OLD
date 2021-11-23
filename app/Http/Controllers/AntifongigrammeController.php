<?php

namespace App\Http\Controllers;
use Validator;
use App\Antifongique;
use App\Antifongigramme;
use App\Dossier;
use App\Examen;
use App\ExamenDossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AntifongigrammeController extends Controller
{
   
   public function show( Request $request)
    {
        if(Auth::check())
        {
			
			if($request['id_examen_dossier'] != null)
			{
				$antifongigrammes = Antifongigramme::where('id_examen_dossier', $request['id_examen_dossier'])->get();
				if($request->ajax()){					
					return response()->json(['antifongigrammes' => json_encode($antifongigrammes)], 200);
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
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Antibiogramme'
					], 200);	
			}
			

				if($request['id_examen_dossier'] != null)
				{
					$values = $request['values'];
					$max = count($values);
					Antifongigramme::where('id_examen_dossier', $request['id_examen_dossier'])->delete();
					$examen_dossier = ExamenDossier::find($request['id_examen_dossier']);
					$examen = Examen::find($examen_dossier->code_examen);
					$dossier = Dossier::find($examen_dossier->code_dossier);
					for($i = 0; $i < $max; $i = $i +3)
					{
						$antifongigrammes = new Antifongigramme();
						$antifongigrammes->id_examen_dossier = $request['id_examen_dossier'];
						$antifongigrammes->id_dossier = $dossier->id;
						$antifongigrammes->id_examen = $examen->id;
						$antifongigrammes->id_antifongique = $values[$i];
						$antifongigrammes->etat = $values[$i+2];
						$antifongigrammes->save();

					}
									
					

				
					return response()
					->json([
						'success' => 'L\'antibiorgramme a été enregistré avec success',
						
							], 200)
					;
				
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Antifongigramme'
					], 200);
				}
				}
				else
				{
					
										

				
					
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de cet Antifongigramme'
					], 200);
				}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }
	
	
}
