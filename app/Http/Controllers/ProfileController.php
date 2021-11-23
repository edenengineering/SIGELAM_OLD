<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Profile;
use Auth;

class ProfileController extends Controller
{
       public function show( Request $request)
    {
        if(Auth::check())
        {
            $profiles = Profile::orderBy('libelle_profile')->where('statut', '1')->get();
           	$this->addEvent('ouverture_profil', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Gestion des Profils d'Utilisateurs ");

            return view('dashboard_profile')->withProfiles($profiles);
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
				'libelle_profile' => 'required',
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Profile'
					], 200);	
			}
			

				if($request['id_profile'] == null)
				{
					$profile = new Profile();
					$profile->libelle_profile = strtoupper($request['libelle_profile']);

				if($profile->save())
				{
					 $this->addEvent('ajout_profil', $request->ip(),$profile->id, Auth::id(), "Ajout du Profil =>  ". $profile->libelle_profile);

					return response()
					->json([
						'success' => 'Le Profile a été enregistré avec succès !',
						'nouveau' => json_encode($profile),
							], 200);
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Profil !'
					], 200);
				}
				}
				else
				{
					$profile = Profile::find($request['id_profile']);
					$old = $profile->libelle_profile;
					$profile->libelle_profile = strtoupper($request['libelle_profile']);

				if($profile->save())
				{
					 $this->addEvent('modifier_profil', $request->ip(),$profile->id, Auth::id(), "Modification du Profil d'Utilisateur : ". $old ." =>  ". $profile->libelle_profile);

					return response()
					->json([
						'success' => 'Le Profil  a été Modifié avec succès !',
						'nouveau' => json_encode($profile),

							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de ce Profil !'
					], 200);
				}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }

}
