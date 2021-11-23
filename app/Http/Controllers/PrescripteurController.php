<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Prescripteur;
use Validator;
use App\Hopital;
use App\User;


class PrescripteurController extends Controller
{
     public function show( Request $request)
    {
        if(Auth::check())
        {
            $medecin_prescripteurs = Prescripteur::where('statut', 1)->orderBy('nom_prescripteur')->get();
			$hopitals = Hopital::All();
			$users = User::All();
			
			 if($request->ajax()){
               return response()->json($medecin_prescripteurs	, 200);
            }

           $this->addEvent('ouverture_medecin_prescripteur', $request->ip(),0, Auth::id(), "Ouverture de la Fenêtre Medecin Prescripteur ");

            return view('dashboard_medecin')->withMedecinPrescripteurs($medecin_prescripteurs)->withHopitals($hopitals)->withUsers($users);
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
				'nom_prescripteur' => 'required',
				'titre' => 'required',
				]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Medecin prescripteur'
					], 200);	
			}
			

				if($request['id_medecin_prescripteur'] == null)
				{
				
					$medecin_prescripteur = new Prescripteur();
					$medecin_prescripteur->titre = $request['titre'];
					$medecin_prescripteur->id_hopital = 0;
					$medecin_prescripteur->nom_prescripteur = $request['nom_prescripteur'];
					$medecin_prescripteur->date_debut = date('Y-m-d H:i:s');
					$medecin_prescripteur->date_fin = date('Y-m-d H:i:s');
					$medecin_prescripteur->telephone = $request['telephone'];
					$medecin_prescripteur->fax = $request['fax'];
					$medecin_prescripteur->sexe = $request['sexe'];
					$medecin_prescripteur->statut = '1';
					$medecin_prescripteur->email = $request['email'];
					$medecin_prescripteur->matricule_agent = Auth::id();
					if($medecin_prescripteur->save())
					{
           				$this->addEvent('ajout_medecin_prescripteur', $request->ip(),$medecin_prescripteur->id, Auth::id(), "Ajout du Medecin Prescripteur => " . $medecin_prescripteur->nom_prescripteur);

						return response()
						->json([
							'success' => 'Le Medecin Prescripteur a été enregistré avec success',
							'nouveau' => json_encode($medecin_prescripteur),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Medecin Prescripteur !'
						], 200);
					}
					}
				else
				{
					$medecin_prescripteur = Prescripteur::find($request['id_medecin_prescripteur']);
					$medecin_prescripteur->id_hopital = 0;
					$medecin_prescripteur->titre = $request['titre'];
					$old = $medecin_prescripteur->nom_prescripteur;
					$medecin_prescripteur->nom_prescripteur = $request['nom_prescripteur'];
					$medecin_prescripteur->telephone = $request['telephone'];
					$medecin_prescripteur->fax = $request['fax'];
					$medecin_prescripteur->sexe = $request['sexe'];
					$medecin_prescripteur->statut = '1';
					$medecin_prescripteur->email = $request['email'];

					if($medecin_prescripteur->save())
					{
						
           				$this->addEvent('modifier_medecin_prescripteur', $request->ip(),$medecin_prescripteur->id, Auth::id(), "Modification du Medecin Prescripteur : ". $old ." => " . $medecin_prescripteur->nom_prescripteur);

						return response()
						->json([
							'success' => 'Le Medecin Prescripteur a été Modifié avec succès !',
							'nouveau' => json_encode($medecin_prescripteur),
								], 200)
						;
					}
					else
					{
						return response()->json([
							'erreur' => 'Une erreur est survenue pendant la modification de ce Medecin Prescripteur !'
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
			
			if(!$request['id_medecin_prescripteur'] == null)
			{	
				$to_suppress = explode(",", $request['id_medecin_prescripteur']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						$medecin_prescripteur = Prescripteur::find($element);
						$medecin_prescripteur->statut = '0';
						$medecin_prescripteur->date_fin = date('Y-m-d H:i:s');
						if($medecin_prescripteur->save())
						{
							$this->addEvent('ajout_medecin_prescripteur', $request->ip(),$medecin_prescripteur->id, Auth::id(), "Suppression de Medecin Prescripteur => " . $medecin_prescripteur->nom_prescripteur);
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
							'success' => 'Le Medecin Prescripteur a bien été supprimmé avec succès !',
							'supprimes' => json_encode($deleted_elements),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les Medecins Prescripteurs ont bien été supprimmés avec succès !',
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
