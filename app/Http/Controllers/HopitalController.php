<?php

namespace App\Http\Controllers;

use Validator;
use App\Hopital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HopitalController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $hopitals = Hopital::orderBy('nom_hopital')->get();
			
            return view('dashboard_hopital')->withHopitals($hopitals);
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
				'nom_hopital' => 'required',
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Hôpital !'
					], 200);	
			}
			

				if($request['id_hopital'] == null)
				{
					$hopital = new Hopital();
					$hopital->nom_hopital = strtoupper($request['nom_hopital']);


                    if($hopital->save())
                    {
                         $hopitals = Hopital::All();
                        return response()
                        ->json([
                            'success' => 'L\'Hôpital a été enregistré avec succès !',
                            'nouveau' => json_encode($hopital),
                                ], 200)
                        ;
                    }
                    else
                    {
                        return response()->json([
                            'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Hôpital !',
                        ], 200);
                    }

				}
				else
				{
					$hopital = Hopital::find($request['id_hopital']);
					$hopital->nom_hopital = strtoupper($request['nom_hopital']);

				if($hopital->save())
				{
					 $hopitals = Hopital::All();
					return response()
					->json([
						'success' => 'L\'hôpital  a été Modifié avec success',
						'nouveau' => json_encode($hopital),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de cet Hôpital'
					], 200);
				}
				}
				
				

			}
        else{
            return redirect()->route('login', 302);
        }

    }
	


}
