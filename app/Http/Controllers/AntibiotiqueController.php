<?php

namespace App\Http\Controllers;

use Validator;
use App\Antibiotique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AntibiotiqueController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $antibiotiques = Antibiotique::orderBy('libelle_antibiotique')->get();
           	$this->addEvent('ouverture_antibiotique', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Antibiotique ");

            return view('dashboard_antibiotique')->withAntibiotiques($antibiotiques);
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
				'nom_antibiotique' => 'required',
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Antibiotique'
					], 200);	
			}
			

				if($request['id_antibiotique'] == null)
				{
					$antibiotique = new Antibiotique();
					$antibiotique->libelle_antibiotique = strtoupper($request['nom_antibiotique']);

				if($antibiotique->save())
				{
					   $this->addEvent('ajout_antibiotique', $request->ip(),$antibiotique->id, Auth::id(), "Ajout de l' Antibiotique =>  ". $antibiotique->libelle_antibiotique);

					return response()
					->json([
						'success' => 'L\'Antibiotique a été enregistré avec succès !',
						'nouveau' => json_encode($antibiotique),
							], 200);
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Antibiotique !'
					], 200);
				}
				}
				else
				{

					$antibiotique = Antibiotique::find($request['id_antibiotique']);
					$old = $antibiotique->libelle_antibiotique;
					$antibiotique->libelle_antibiotique = strtoupper($request['nom_antibiotique']);

				if($antibiotique->save())
				{
					 $this->addEvent('modifier_antibiotique', $request->ip(),$antibiotique->id, Auth::id(), "Modification de l' Antibiotique : ". $old . " =>  ". $antibiotique->libelle_antibiotique);

					return response()
					->json([
						'success' => 'L\'Antibiotique  a été Modifié avec succès !',
						'nouveau' => json_encode($antibiotique),

							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de cet Antibiotique !'
					], 200);
				}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }
	


}
