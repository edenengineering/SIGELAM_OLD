<?php

namespace App\Http\Controllers;
use Validator;

use Illuminate\Http\Request;
use App\Fournisseur;
use App\Materiel;
use App\TypeMateriel;
use App\CommandeMateriel;
use Illuminate\Support\Facades\Auth;

class FournisseurController extends Controller
{

    public function show(Request $request)
    {
        if(Auth::check())
        {
            $fournisseurs = Fournisseur::where('statut', 1)->orderBy('raison_sociale')->get();
			$materiels = Materiel::All();
			$type_materiels = TypeMateriel::All();
			
			
            return view('dashboard_fournisseur')->withFournisseurs($fournisseurs)->withMateriels($materiels)->withTypeMateriels($type_materiels);

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
                'raison_sociale' => 'required',

            ]);

            if($validator->fails())
            {
                return response()->json([
                    'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Fournisseur !',

                ], 200);
            }


            if($request['id_fournisseur'] == null)
            {
				if(count(Fournisseur::where('raison_sociale', strtoupper($request['raison_sociale']))->where('statut', 1)->get()) != 0)
				{
					return response()->json([
							'erreur' => 'Cette raison sociale a déjà été utilisée pour un autre Fournisseur !',
						], 200);
				}
                $fournisseur = new Fournisseur();
                $fournisseur->raison_sociale = strtoupper($request['raison_sociale']);
                $fournisseur->commercial = $request['commercial'];
                $fournisseur->adresse = $request['adresse'];
                $fournisseur->telephone = strtoupper($request['telephone']);
                $fournisseur->site_web = $request['site_web'];
                $fournisseur->fax = $request['fax'];
                $fournisseur->email = $request['email'];
                $fournisseur->statut = '1';

                if($fournisseur->save())
                {
                    return response()
                        ->json([
                            'success' => 'Le Fournisseur a été enregistré avec succès !',
                            'nouveau' => json_encode($fournisseur),
                        ], 200)
                        ;
                }
                else
                {
                    return response()->json([
                        'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Fournisseur !'
                    ], 200);
                }
            }
            else
            {
				if(count(Fournisseur::where('raison_sociale', strtoupper($request['raison_sociale']))->where('statut', 1)->get()) != 0)
				{
					return response()->json([
							'erreur' => 'Cette raison sociale a déjà été utilisée pour un autre Fournisseur !',
						], 200);
				}
                $fournisseur = Fournisseur::find($request['id_fournisseur']);
                $fournisseur->raison_sociale = strtoupper($request['raison_sociale']);
                $fournisseur->commercial = $request['commercial'];
                $fournisseur->adresse = $request['adresse'];
                $fournisseur->telephone = strtoupper($request['telephone']);
                $fournisseur->site_web = $request['site_web'];
                $fournisseur->fax = $request['fax'];
                $fournisseur->email = $request['email'];
                $fournisseur->statut = '1';

                if($fournisseur->save())
                {
                    return response()
                        ->json([
                            'success' => 'Le Fournisseur a été Modifié avec succès !',
                            'nouveau' => json_encode($fournisseur),
                        ], 200)
                        ;
                }
                else
                {
                    return response()->json([
                        'erreur' => 'Une erreur est survenue pendant la modification de ce Fournisseur !'
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
            if(!$request['id_fournisseur'] == null)
            {
                $to_suppress = explode(",", $request['id_fournisseur']);
                $deleted_elements = array();

                foreach($to_suppress as $element)
                {
                    try{
                        $fournisseur = Fournisseur::find($element);
                        $fournisseur->statut = '0';
                        if($fournisseur->save())
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
                            'success' => 'Le Fournisseur a bien été supprimmé avec succès !',
                            'supprimes' => json_encode($deleted_elements),
                        ], 200);
                    }
                    else
                    {
                        return response()->json([
                            'success' => 'Les Fournisseurs ont bien été supprimmées avec succès !',
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
