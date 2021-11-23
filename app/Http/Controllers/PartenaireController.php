<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partenaire;
use App\ExamenPartenaire;
use App\TypePartenaire;
use App\Examen;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;

	class PartenaireController extends Controller
	{
    
		public function show( Request $request)
		{
			if(Auth::check())
			{
				$partenaires =Partenaire::where('statut', 1)->orderBy('libelle_partenaire')->get();
				$type_partenaires = TypePartenaire::all();
				$examen_partenaires = $type_partenaires;
				$users = User::all();
				$examens = Examen::all();
				 if($request->ajax()){
				   return response()->json($partenaires	, 200);
				}

				return view('dashboard_assureur')->withPartenaires($partenaires)->withTypePartenaires($type_partenaires)->withExamenPartenaires($examen_partenaires)->withExamens($examens)->withUsers($users);
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
					'libelle_partenaire' => 'required',
                    'adresse' => 'required',
                    'b_public' => 'required',
                    'b_proforma' => 'required',
					
				]);
				
				if($validator->fails())
				{
					return response()->json([
							'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Partenaire !'
						], 200);	
				}
				

					if($request['id_partenaire'] == null)
					{
						$partenaire = new Partenaire();
                        $partenaire->libelle_partenaire = strtoupper($request['libelle_partenaire']);
						$partenaire->id_type_partenaire = $request['id_type_partenaire'];
                        $partenaire->adresse = $request['adresse'];
                        $partenaire->telephone = $request['telephone'];
                        $partenaire->fax = $request['fax'];
                        $partenaire->email = $request['email'];
                        $partenaire->reduction = $request['reduction'];
                        $partenaire->site_web = $request['site_web'];
                        $partenaire->b_public = $request['b_public'];
                        $partenaire->b_prive = $request['b_prive'];
                        $partenaire->b_proforma = $request['b_proforma'];
                        $partenaire->statut = '1';


					if($partenaire->save())
					{

					    $exams = Examen::All();

					    foreach ($exams as $exam)
                        {
                            ExamenPartenaire::Create(['id_partenaire' => $partenaire->id, 'id_examen' => $exam->id, 'prise_en_charge' => 'PEC']);
                        }

						return response()
						->json([
							'success' => 'Le Partenaire a été enregistré avec succès !',
							'nouveau' => json_encode($partenaire),

								], 200)
						;
					}
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Partenaire !'
						], 200);
					}
					}
					else
					{
						$partenaire = Partenaire::find($request['id_partenaire']);
                        $partenaire->libelle_partenaire = strtoupper($request['libelle_partenaire']);
                        $partenaire->id_type_partenaire = $request['id_partenaire'];
                        $partenaire->adresse = $request['adresse'];
                        $partenaire->telephone = $request['telephone'];
                        $partenaire->fax = $request['fax'];
                        $partenaire->email = $request['email'];
                        $partenaire->reduction = $request['reduction'];
                        $partenaire->site_web = $request['site_web'];
                        $partenaire->b_public = $request['b_public'];
                        $partenaire->b_prive = $request['b_prive'];
                        $partenaire->b_proforma = $request['b_proforma'];
                        $partenaire->statut = '1';

						if($partenaire->save())
						{
							return response()
							->json([
								'success' => 'Le Partenaire a été Modifié avec succès !',
								'nouveau' => json_encode($partenaire),
								
									], 200)
							;
						}
						else
						{
							return response()->json([
								'erreur' => 'Une erreur est survenue pendant la modification de ce Partenaire !'
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
                if(!$request['id_partenaire'] == null)
                {
                    $to_suppress = explode(",", $request['id_partenaire']);
                    $deleted_elements = array();

                    foreach($to_suppress as $element)
                    {
                        try{
                            $partenaire = Partenaire::find($element);
                            $partenaire->statut = '0';
                            if($partenaire->save())
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
                                'success' => 'Le Partenaire a bien été supprimmé avec succès !',
                                'supprimes' => json_encode($deleted_elements),
                            ], 200);
                        }
                        else
                        {
                            return response()->json([
                                'success' => 'Les Partenaires ont bien été supprimmés avec succès !',
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
