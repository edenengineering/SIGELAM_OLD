<?php

namespace App\Http\Controllers;

use Validator;
use App\TypePartenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TypePartenaireController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $type_partenaires = TypePartenaire::orderBy('libelle_type_partenaire')->get();			 

            return view('dashboard_type_partenaire')->withTypePartenaires($type_partenaires);
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
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Type Partenaire !'
					], 200);	
			}
			

				if($request['id_type_partenaire'] == null)
				{
					$type_partenaire = new TypePartenaire();
					$type_partenaire->libelle_type_partenaire = strtoupper($request['nom_type_partenaire']);

				if($type_partenaire->save())
				{
					return response()
					->json([
						'success' => 'Le Type de Matériel a été enregistré avec succès !',
						'nouveau' => json_encode($type_partenaire),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Type de Partenaire !'
					], 200);
				}
				}
				else
				{
					$type_partenaire = TypePartenaire::find($request['id_type_partenaire']);
					$type_partenaire->libelle_type_partenaire = strtoupper($request['nom_type_partenaire']);

					if($type_partenaire->save())
					{
						return response()
						->json([
							'success' => 'Le Type de Partenaire a été Modifié avec succès !',
							'nouveau' => json_encode($type_partenaire),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant la modification de ce Type de Partenaire !'
						], 200);
					}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }
	


}
