<?php

namespace App\Http\Controllers;

use Validator;
use App\Tube;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TubeController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $tubes = Tube::where('statut', '1')->orderBy('libelle_tube')->get();
			
           	$this->addEvent('ouverture_tube_examen', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Tube Examen ");

            return view('dashboard_tube')->withTubes($tubes);
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
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Tube d\'Examen !'
					], 200);	
			}
			

				if($request['id_tube'] == null)
				{
					$tube = new Tube();
					$tube->libelle_tube = strtoupper($request['nom_tube']);
					$tube->nombre_max = $request['nombre_max'];
					$tube->couleur = $request['couleur'];
					
					
					$tube->statut = '1';

				if($tube->save())
				{
					   $this->addEvent('ajout_tube_examen', $request->ip(),$tube->id, Auth::id(), "Ajout du Tube  d'Examen =>  ". $tube->libelle_tube);

					return response()
					->json([
						'success' => 'Le Tube a été enregistré avec succès !',
						'nouveau' => json_encode($tube),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Tube !'
					], 200);
				}
				}
				else
				{
					$tube = Tube::find($request['id_tube']);
					$old = $tube->libelle_tube;
					$tube->libelle_tube = strtoupper($request['nom_tube']);
					$tube->nombre_max = $request['nombre_max'];
					$tube->couleur = $request['couleur'];

					if($tube->save())
					{
					 $this->addEvent('modifier_tube_examen', $request->ip(),$tube->id, Auth::id(), "Modification du Tube d'Examen : ". $old ." =>  ". $tube->libelle_tube);

						return response()
						->json([
							'success' => 'Le Tube a été Modifié avec succès !',
							'nouveau' => json_encode($tube),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant la modification de ce Tube !'
						], 200);
					}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }
	
	public function deleteModel(Request $request)
	{
		if(Auth::check())
        {
			if(!$request['id_tube'] == null)
			{
				$to_suppress = explode(",", $request['id_tube']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						$tube = Tube::find($element);
						$tube->statut = '0';
						if($tube->save())
						{
							array_push($deleted_elements, $element);
						}						
						
					}
					catch(Exception $e)
					{
						
					}
				}
				
				if(count($deleted_elements) !=  0)
				{
					if(count($deleted_elements) == 1)
					{
						return response()->json([
							'success' => 'Le Tube a bien été supprimmé avec succès !',
							'supprimes' => json_encode($deleted_elements),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les Tubes ont bien été supprimmé avec succès!',
							'supprimes' => json_encode($deleted_elements)	,
						], 200);
					}					
				}
				else
				{
					return response()->json([
							'erreur' => 'Une erreur est survenue pendant la supression !',
						], 200);
				}					
				
			}
		}				
		else
		{
            return redirect()->route('login', 302);
        }	
	}
	


}
