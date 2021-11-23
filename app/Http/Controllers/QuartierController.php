<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Quartier;

class QuartierController extends Controller
{
     public function show( Request $request)
    {
        if(Auth::check())
        {
            $quartiers = Quartier::orderBy('libelle_quartier')->get();

            return view('dashboard_quartier')->withQuartiers($quartiers);
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
				'libelle_quartier' => 'required',
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de quartier'
					], 200);	
			}
			

				if($request['id_quartier'] == null)
				{
					$quartier = new Quartier();
					$quartier->libelle_quartier = strtoupper($request['libelle_quartier']);

				if($quartier->save())
				{
					 $this->addEvent('ajout_quartier', $request->ip(),$quartier->id, Auth::id(), "Ajout du quartier =>  ". $quartier->libelle_quartier);

					return response()
					->json([
						'success' => 'Le quartier a été enregistrée avec succès !',
						'nouveau' => json_encode($quartier),
							], 200);
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce quartier !'
					], 200);
				}
				}
				else
				{
					$quartier = Quartier::find($request['id_quartier']);
					$old = $quartier->libelle_quartier;
					$quartier->libelle_quartier = strtoupper($request['libelle_quartier']);

				if($quartier->save())
				{
					 $this->addEvent('modifier_quartier', $request->ip(),$quartier->id, Auth::id(), "Modification du quartier : ". $old ." =>  ". $quartier->libelle_quartier);

					return response()
					->json([
						'success' => 'Le Quartier  a été Modifiée avec succès !',
						'nouveau' => json_encode($quartier),

							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de ce Quartier !'
					], 200);
				}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }

}
