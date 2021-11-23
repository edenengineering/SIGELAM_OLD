<?php

namespace App\Http\Controllers;
use App\CentrePartenaire;
use Validator;

use Illuminate\Http\Request;
use App\CentrePrescripteur;
use App\Partenaire;
use App\Hopital;
use Illuminate\Support\Facades\Auth;


class CentrePrescripteurController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $centre_prescripteurs = CentrePrescripteur::where('statut', 1)->orderBy('libelle_centre')->get();
            $partenaires = Partenaire::where('statut', 1)->get();
            $centre_partenaires =  CentrePartenaire::All();
            $hopitals = Hopital::All();
			
            return view('dashboard_centre_prescripteur')
                ->withCentrePrescripteurs($centre_prescripteurs)
                ->withPartenaires($partenaires)
                ->withCentrePartenaires($centre_partenaires)
                ->withHopitals($hopitals);       
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
				'libelle_centre_prescripteur' => 'required',
				'code_assureur' => 'required',
				'taux_redevance' => 'required',
				]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Centre Prescripteur !',
						
					], 200);	
			}
			

				if($request['id_centre_prescripteur'] == null)
				{
					if(count(CentrePrescripteur::where('libelle_centre', $request['libelle_centre_prescripteur'])->get()) != 0)
					{
						return response()->json([
							'erreur' => 'Ce libellé a déjà été utilisé pour un autre Centre Prescripteur !',
						], 200);
					}
					$centre_prescripteur = new CentrePrescripteur();
					$centre_prescripteur->libelle_centre = strtoupper($request['libelle_centre_prescripteur']);
					$centre_prescripteur->taux_redevance = $request['taux_redevance'];
					$centre_prescripteur->statut = '1';
					
					
					if($centre_prescripteur->save())
					{	
						$centre_partenaires = CentrePartenaire::All();

						foreach($request['code_assureur'] as $code)
						{
                            $centre = new CentrePartenaire();
                            $centre->id_centre_prescripteur = $centre_prescripteur->id;
                            $centre->id_partenaire = $code;
							$centre->save();
                        }
						return response()
						->json([
							'success' => 'Le Centre Prescripteur a été enregistré avec succès !',
							'nouveau' => json_encode($centre_prescripteur),
							'centre_partenaires' => json_encode($centre_partenaires),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Centre Prescripteur !'
						], 200);
					}
					}
				else
				{
					$centre_prescripteur = CentrePrescripteur::find($request['id_centre_prescripteur']);
					$centre_prescripteur->libelle_centre = strtoupper($request['libelle_centre_prescripteur']);
					$centre_prescripteur->statut = '1';
					$centre_prescripteur->taux_redevance = $request['taux_redevance'];

					if($centre_prescripteur->save())
					{
						$assureurs = CentrePartenaire::where('id_centre_prescripteur', $request['id_centre_prescripteur'])->delete();
						
						foreach($request['code_assureur'] as $code)
						{
							$centre = new CentrePartenaire();
                            $centre->id_centre_prescripteur = $centre_prescripteur->id;
                            $centre->id_partenaire = $code;
							$centre->save();	
						}
						$centre_partenaires = CentrePartenaire::All();
						return response()
						->json([
							'success' => 'Le Centre Prescripteur a été Modifié avec succès !',
							'nouveau' => json_encode($centre_prescripteur),
							'centre_partenaires' => json_encode($centre_partenaires),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant la modification de ce Centre Prescripteur !'
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
			if(!$request['id_centre_prescripteur'] == null)
			{
				$to_suppress = explode(",", $request['id_centre_prescripteur']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						$centre_prescripteur = CentrePrescripteur::find($element);
						$centre_prescripteur->statut = '0';
						if($centre_prescripteur->save())
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
					$centre_partenaires = CentrePartenaire::All();
					if(count($deleted_elements) == 1)
					{
						return response()->json([
							'success' => 'Le Centre Prescripteur a bien été supprimmé avec succès !',
							'supprimes' => json_encode($deleted_elements),
							'centre_partenaires' => json_encode($centre_partenaires),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les Centres Prescripteurs ont bien été supprimmés avec succès !',
							'supprimes' => json_encode($deleted_elements)	,
							'centre_partenaires' => json_encode($centre_partenaires),
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
