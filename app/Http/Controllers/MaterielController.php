<?php

namespace App\Http\Controllers;

use Validator;
use App\Materiel;
use App\TypeMateriel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MaterielController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $materiels = Materiel::orderBy('libelle_materiel')->get();
			$type_materiels = TypeMateriel::orderBy('id')->get();
						
			 if($request->ajax()){
               return response()->json($materiels	, 200);
            }

            return view('dashboard_materiel')->withMateriels($materiels)->withTypeMateriels($type_materiels);
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
						'erreur' => 'Une erreur est survenue pendant l\'Enregistrement de ce Matériel !'
					], 200);	
			}
			

				if($request['id_materiel'] == null)
				{
					$materiel = new Materiel();
					$materiel->libelle_materiel = strtoupper($request['libelle_materiel']);
					$materiel->id_type_materiel = $request['id_type_materiel'];
					$materiel->stock = $request['stock'];

				if($materiel->save())
				{
					return response()
					->json([
						'success' => 'Le Matériel a été enregistré avec succès !',
						'nouveau' => json_encode($materiel),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Matériel !'
					], 200);
				}
				}
				else
				{
					$materiel = Materiel::find($request['id_materiel']);
					$materiel->libelle_materiel = strtoupper($request['libelle_materiel']);
					$materiel->id_type_materiel = $request['id_type_materiel'];
					$materiel->stock = $request['stock'];


				if($materiel->save())
				{
					return response()
					->json([
						'success' => 'Le Matériel a été Modifié avec success',
						'nouveau' => json_encode($materiel),
						
							], 200)	;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de ce Matériel'
					], 200);
				}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }
	


}
