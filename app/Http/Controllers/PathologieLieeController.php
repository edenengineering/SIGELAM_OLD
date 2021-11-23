<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PathologieLiee;

class PathologieLieeController extends Controller
{
      public function show( Request $request)
    {
        if(Auth::check())
        {
            $pathologies = PathologieLiee::orderBy('libelle_pathologie')->get();
           	$this->addEvent('ouverture_pathologie', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Gestion des Pathologies Liées ");

            return view('dashboard_pathologies_liees')->withPathologies($pathologies);
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
				'libelle_pathologie' => 'required',
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette Pathologie Liee'
					], 200);	
			}
			

				if($request['id_pathologie'] == null)
				{
					$pathologie = new PathologieLiee();
					$pathologie->libelle_pathologie = strtoupper($request['libelle_pathologie']);

				if($pathologie->save())
				{
					 $this->addEvent('ajout_pathologie', $request->ip(),$pathologie->id, Auth::id(), "Ajout de la Pathologie Liée =>  ". $pathologie->libelle_pathologie);

					return response()
					->json([
						'success' => 'La Pathologie liée a été enregistrée avec succès !',
						'nouveau' => json_encode($pathologie),
							], 200);
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette pathologie liée !'
					], 200);
				}
				}
				else
				{
					$pathologie = PathologieLiee::find($request['id_pathologie']);
					$old = $pathologie->libelle_pathologie;
					$pathologie->libelle_pathologie = strtoupper($request['libelle_pathologie']);

				if($pathologie->save())
				{
					 $this->addEvent('modifier_pathologie', $request->ip(),$pathologie->id, Auth::id(), "Modification de la Pathologie Liée : ". $old ." =>  ". $pathologie->libelle_pathologie);

					return response()
					->json([
						'success' => 'La Pathologie  a été Modifié avec succès !',
						'nouveau' => json_encode($pathologie),

							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de cette pathologie liée !'
					], 200);
				}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }
}
