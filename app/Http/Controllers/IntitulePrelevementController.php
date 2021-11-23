<?php

namespace App\Http\Controllers;

use Validator;
use App\IntituleBiopsie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IntitulePrelevementController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $intitule_prelevements = IntituleBiopsie::orderBy('libelle')->get();
           	$this->addEvent('ouverture_renseignement_clinique', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Renseignement Clinique ");
			
            return view('dashboard_intitule_prelevement')->withIntitulePrelevements($intitule_prelevements);
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
				'nom_intitule_prelevement' => 'required',
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Intitulé de prélèvement !'
					], 200);	
			}
			

				if($request['id_intitule_prelevement'] == null)
				{
					$intitule = new IntituleBiopsie();
					$intitule->libelle = $request['nom_intitule_prelevement'];

				if($intitule->save())
				{
					   $this->addEvent('ajout_renseignement_clinique', $request->ip(),$intitule->id, Auth::id(), "Ajout du Renseignement Clinique =>  ". $intitule->libelle);

					return response()
					->json([
						'success' => 'L\'Intitulé de prélèvement a été enregistré avec succès !',
						'nouveau' => json_encode($intitule),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Intitule de Prélèvement !'
					], 200);
				}
				}
				else
				{
					$intitule = IntituleBiopsie::find($request['id_intitule_prelevement']);
					$old = $intitule->libelle;	
					$intitule->libelle = $request['nom_intitule_prelevement'];

				if($intitule->save())
				{
					 $this->addEvent('modifier_renseignement_clinique', $request->ip(),$intitule->id, Auth::id(), "Modification du Renseignement Clinique : ". $old ." =>  ". $intitule->libelle);

					return response()
					->json([
						'success' => 'L\'Intitulé de Prélèvement a été Modifié avec succès !',
						'nouveau' => json_encode($intitule),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de cet Intitulé de Prélèvement !'
					], 200);
				}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }
	


}
