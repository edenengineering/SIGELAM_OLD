<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Journal;
use Validator;
use Auth;


class JournalController extends Controller
{
	  public function show( Request $request)
    {
        if(Auth::check())
        {
            $profiles = Profile::orderBy('created_at')->get();

            return view('dashboard_prof')->withProfiles($profiles);
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
					$profile->libelle_profile = strtoupper($request['libelle_profile']);

				if($profile->save())
				{
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
