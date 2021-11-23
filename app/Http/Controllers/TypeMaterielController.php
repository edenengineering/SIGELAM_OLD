<?php

namespace App\Http\Controllers;

use Validator;
use App\TypeMateriel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TypeMaterielController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $type_materiels = TypeMateriel::orderBy('libelle_type_materiel')->get();
			
			 

            return view('dashboard_type_materiel')->withTypeMateriels($type_materiels);
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
				'nom_type_materiel' => 'required',
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Type Matériel !'
					], 200);	
			}
			

				if($request['id_type_materiel'] == null)
				{
					$type_materiel = new TypeMateriel();
					$type_materiel->libelle_type_materiel = strtoupper($request['nom_type_materiel']);

				if($type_materiel->save())
				{
					return response()
					->json([
						'success' => 'Le Type de Matériel a été enregistré avec succès !',
						'nouveau' => json_encode($type_materiel),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Type de Matériel !'
					], 200);
				}
				}
				else
				{
					$type_materiel = TypeMateriel::find($request['id_type_materiel']);
					$type_materiel->libelle_type_materiel = strtoupper($request['nom_type_materiel']);

					if($type_materiel->save())
					{
						return response()
						->json([
							'success' => 'Le Type de matériel a été Modifié avec succès !',
							'nouveau' => json_encode($type_materiel),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant la modification de ce Type de Matériel !'
						], 200);
					}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }
	


}
