<?php

namespace App\Http\Controllers;
use Validator;
use App\GroupeExamen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GroupeExamenController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $groupe_examens = GroupeExamen::orderBy('libelle_groupe_examen')->get();
			
			 if($request->ajax()){
           	$this->addEvent('ouverture_groupe_examens', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Groupe Examens ");

               return response()->json($groupe_examens	, 200);
            }
           	$this->addEvent('ouverture_groupe_examens', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Groupe Examens ");

            return view('dashboard_groupe_examen')->withGroupeExamens($groupe_examens);
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
						'erreur' => 'Une erreur est survenue pendant l\'Enregistrement de ce Groupe d\'Examen !'
					], 200);	
			}
			

				if($request['id_groupe_examen'] == null)
				{
					$groupe_examen = new GroupeExamen();
					$groupe_examen->libelle_groupe_examen = strtoupper($request['libelle_groupe_examen']);
					$groupe_examen->ordre_groupe = $request['ordre_groupe'];

					if($groupe_examen->save())
					{
					   $this->addEvent('ajout_groupe_examen', $request->ip(),$groupe_examen->id, Auth::id(), "Ajout du Groupe Examen =>  ". $groupe_examen->libelle_groupe_examen);

						return response()
						->json([
							'success' => 'Le Groupe Examen a été enregistré avec succès !',
							'nouveau' => json_encode($groupe_examen),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Groupe Examen !'
						], 200);
					}
				}
				else
				{
					$groupe_examen = GroupeExamen::find($request['id_groupe_examen']);
					$old = $groupe_examen->libelle_groupe_examen;
					$groupe_examen->libelle_groupe_examen = strtoupper($request['libelle_groupe_examen']);
					$groupe_examen->ordre_groupe = $request['ordre_groupe'];

					if($groupe_examen->save())
					{
					   $this->addEvent('modifier_groupe_examen', $request->ip(),$groupe_examen->id, Auth::id(), "Modification du Groupe Examen : ". $old ." => ". $groupe_examen->libelle_groupe_examen);

						return response()
						->json([
							'success' => 'Le Groupe Examen  a été Modifié avec succès !',
							'nouveau' => json_encode($groupe_examen),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant la modification de ce Groupe Examen !'
						], 200);
					}
				}	
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }
	


}
