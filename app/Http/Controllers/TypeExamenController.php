<?php

namespace App\Http\Controllers;

use Validator;
use App\TypeExamen;
use App\GroupeExamen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TypeExamenController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $type_examens = TypeExamen::orderBy('libelle_type_examen')->get();
			$groupe_examens = GroupeExamen::orderBy('libelle_groupe_examen')->get();
			
            return view('dashboard_type_examen')->withTypeExamens($type_examens)->withGroupeExamens($groupe_examens);
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
				'libelle_type_examen' => 'required',
				'id_groupe_examen' => 'required',
				'ordre_type_examen' => 'required',
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Type D\'Examen !',
					], 200);	
			}
			

				if($request['id_type_examen'] == null)
				{
					$type_examen = new TypeExamen();
					//dd($type_examen);
					$type_examen->libelle_type_examen = strtoupper($request['libelle_type_examen']);
					$type_examen->id_groupe_examen = $request['id_groupe_examen'];
					$type_examen->ordre_type_examen = $request['ordre_type_examen'];

					if($type_examen->save())
					{
						return response()
						->json([
							'success' => 'Le Type d\'Examen a   enregistré avec succès !',
							'nouveau' => json_encode($type_examen),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce type d\'Examen !'
						], 200);
					}
				}
				else
				{
					$type_examen = TypeExamen::find($request['id_type_examen']);
					$type_examen->libelle_type_examen = strtoupper($request['libelle_type_examen']);
					$type_examen->id_groupe_examen = $request['id_groupe_examen'];
					$type_examen->ordre_type_examen = $request['ordre_type_examen'];



					if($type_examen->save())
					{
						return response()
						->json([
							'success' => 'Le Type d\'Examen  a été Modifié avec succès !',
							'nouveau' => json_encode($type_examen),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant la modification de ce type d\'Examen !'
						], 200);
					}
				}
				
				

		}
        else{
            return redirect()->route('login', 302);
        }

    }
	


}
