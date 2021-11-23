<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\NatureEchantillon;

class NatureEchantillonController extends Controller
{
     public function show( Request $request)
    {
        if(Auth::check())
        {
            $natures = NatureEchantillon::orderBy('libelle_nature')->get();

            return view('dashboard_nature_echantillon')->withNatures($natures);
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
				'libelle_nature' => 'required',
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette Nature d\'échantillon'
					], 200);	
			}
			

				if($request['id_nature'] == null)
				{
					$nature = new NatureEchantillon();
					$nature->libelle_nature = strtoupper($request['libelle_nature']);

				if($nature->save())
				{
					 $this->addEvent('ajout_nature', $request->ip(),$nature->id, Auth::id(), "Ajout de Nature d'echantillon =>  ". $nature->libelle_nature);

					return response()
					->json([
						'success' => 'La Nature d\'Echantillon a été enregistrée avec succès !',
						'nouveau' => json_encode($nature),
							], 200);
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette Nature d\'échantillon !'
					], 200);
				}
				}
				else
				{
					$nature = NatureEchantillon::find($request['id_nature']);
					$old = $nature->libelle_nature;
					$nature->libelle_nature = strtoupper($request['libelle_nature']);

				if($nature->save())
				{
					 $this->addEvent('modifier_nature', $request->ip(),$nature->id, Auth::id(), "Modification de la nature d'echantillon : ". $old ." =>  ". $nature->libelle_nature);

					return response()
					->json([
						'success' => 'La Nature d\'échantillon  a été Modifiée avec succès !',
						'nouveau' => json_encode($nature),

							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de cette Nature d\'échantillon !'
					], 200);
				}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }

}
