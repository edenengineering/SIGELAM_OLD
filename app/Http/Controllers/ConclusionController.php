<?php

namespace App\Http\Controllers;

use Validator;
use App\Conclusion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ConclusionController extends Controller
{
		public function show( Request $request)
		{
			if(Auth::check())
			{
				$type_conclusions = Conclusion::orderBy('libelle')->get();
           		$this->addEvent('ouverture_conclusion', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Conclusion ");
				
				return view('dashboard_type_conclusion')->withTypeConclusions($type_conclusions);
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
					'nom_type_conclusion' => 'required',
					
				]);
				
				if($validator->fails())
				{
					return response()->json([
							'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Type de Conclusion !'
						], 200);	
				}
				

					if($request['id_type_conclusion'] == null)
					{
						$type_conclusion = new Conclusion();
						$type_conclusion->libelle = $request['nom_type_conclusion'];

					if($type_conclusion->save())
					{
					   $this->addEvent('ajout_conclusion', $request->ip(),$type_conclusion->id, Auth::id(), "Ajout du Tyoe Conclusion =>  ". $type_conclusion->libelle);

						return response()
						->json([
							'success' => 'Le Type de Conclusion a été enregistré avec succès !',
							'nouveau' => json_encode($type_conclusion),
							
								], 200)
						;
					}
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Type de Conclusion !'
						], 200);
					}
					}
					else
					{
						$type_conclusion = Conclusion::find($request['id_type_conclusion']);
						$old = $type_conclusion->libelle;
						$type_conclusion->libelle = $request['nom_type_conclusion'];

						if($type_conclusion->save())
						{
					   $this->addEvent('modifier_conclusion', $request->ip(),$type_conclusion->id, Auth::id(), "Modification du Tyoe Conclusion : ". $old ." =>  ". $type_conclusion->libelle);
							
							return response()
							->json([
								'success' => 'Le Type Conclusion a été Modifié avec succès !',
								'nouveau' => json_encode($type_conclusion),

									], 200)
							;
						}
						else
						{
							return response()->json([
								'erreur' => 'Une erreur est survenue pendant la modification de ce Type de Conclusion !'
							], 200);
						}
					}		
					

				}
			else{
				return redirect()->route('login', 302);
			}

		}
		


}
