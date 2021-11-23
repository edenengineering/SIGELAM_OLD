<?php

namespace App\Http\Controllers;

use Validator;
use App\Antifongique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AntifongiqueController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $antifongiques = Antifongique::orderBy('libelle_antifongique')->get();
           	$this->addEvent('ouverture_antifongique', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Antifongique ");
			
            return view('dashboard_antifongique')->withAntifongiques($antifongiques);
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
				'nom_antifongique' => 'required',
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Antifongique !',
					], 200);	
			}
			

				if($request['id_antifongique'] == null)
				{
					$antifongique = new Antifongique();
					$antifongique->libelle_antifongique = strtoupper($request['nom_antifongique']);

				if($antifongique->save())
				{
					   $this->addEvent('ajout_antifongique', $request->ip(),$antifongique->id, Auth::id(), "Ajout de l' Antifongique =>  ". $antifongique->libelle_antifongique);

					return response()
					->json([
						'success' => 'L\'antifongique a été enregistré avec succès !',
						'nouveau' => json_encode($antifongique),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Antifongique !'
					], 200);
				}
				}
				else
				{
					$antifongique = Antifongique::find($request['id_antifongique']);
					$old = $antifongique->libelle_antifongique;
					$antifongique->libelle_antifongique = strtoupper($request['nom_antifongique']);

				if($antifongique->save())
				{
					 $this->addEvent('modifier_antifongique', $request->ip(),$antifongique->id, Auth::id(), "Modification de l' Antifongique : ". $old ." =>  ". $antifongique->libelle_antifongique);

					return response()
					->json([
						'success' => 'L\'Antifongique  a été Modifié avec success',
						'nouveau' => json_encode($antifongique),	
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de cet Antifongique !'
					], 200);
				}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }
	


}
