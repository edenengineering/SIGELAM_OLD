<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Unite;

class UniteController extends Controller
{
      public function show( Request $request)
    {
        if(Auth::check())
        {
            $unites = Unite::orderBy('libelle_unite')->get();
           	$this->addEvent('ouverture_unite', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Gestion des Unités de soins");

            return view('dashboard_unite')->withUnites($unites);
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
				'libelle_unite' => 'required',
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette Unité'
					], 200);	
			}
			

				if($request['id_unite'] == null)
				{
					$unite = new Unite();
					$unite->libelle_unite = strtoupper($request['libelle_unite']);

				if($unite->save())
				{
					 $this->addEvent('ajout_profil', $request->ip(),$unite->id, Auth::id(), "Ajout de l'Unité =>  ". $unite->libelle_unite);

					return response()
					->json([
						'success' => 'L\'Unité de soins a été enregistrée avec succès !',
						'nouveau' => json_encode($unite),
							], 200);
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette Unité !'
					], 200);
				}
				}
				else
				{
					$unite = Unite::find($request['id_unite']);
					$old = $unite->libelle_unite;
					$unite->libelle_unite = strtoupper($request['libelle_unite']);

				if($unite->save())
				{
					 $this->addEvent('modifier_unite', $request->ip(),$unite->id, Auth::id(), "Modification de l'Unite de soins : ". $old ." =>  ". $unite->libelle_unite);

					return response()
					->json([
						'success' => 'L\'Unité de soins a été Modifiée avec succès !',
						'nouveau' => json_encode($unite),

							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de cette Unite !'
					], 200);
				}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }

}
