<?php

namespace App\Http\Controllers;

use Validator;
use App\TypeResultat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TypeResultatController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $type_resultats = TypeResultat::orderBy('libelle_type_resultat')->get();
			
			 if($request->ajax()){
               return response()->json($type_resultats	, 200);
            }
           	$this->addEvent('ouverture_type_resultats', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Type de Résultats ");

            return view('dashboard_type_resultat')->withTypeResultats($type_resultats);
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
				'nom_type_resultat' => 'required',
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Type de Resultat !'
					], 200);	
			}
			

				if($request['id_type_resultat'] == null)
				{
					$type_resultat = new TypeResultat();
					$type_resultat->libelle_type_resultat = $request['nom_type_resultat'];

				if($type_resultat->save())
				{
					   $this->addEvent('ajout_type_resultat', $request->ip(),$type_resultat->id, Auth::id(), "Ajout du Type de Résultat =>  ". $type_resultat->libelle_type_resultat);

					return response()
					->json([
						'success' => 'Le Type de Résultat a été enregistré avec succès !',
						'nouveau' => json_encode($type_resultat),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Type de Résultat !'
					], 200);
				}
				}
				else
				{
					$type_resultat = TypeResultat::find($request['id_type_resultat']);
					$old = $type_resultat->libelle_type_resultat;
					$type_resultat->libelle_type_resultat = $request['nom_type_resultat'];

				if($type_resultat->save())
				{
					   $this->addEvent('modifier_type_resultat', $request->ip(),$type_resultat->id, Auth::id(), "Modification du Type Résultat : ". $old ." => ". $type_resultat->libelle_type_resultat);

					return response()
					->json([
						'success' => 'Le Type de Résultat a été Modifié avec succès !',
						'nouveau' => json_encode($type_resultat),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de ce Type de Résultat !'
					], 200);
				}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }
	


}
