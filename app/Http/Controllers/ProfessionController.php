<?php

namespace App\Http\Controllers;

use App\Profession;
use Illuminate\Http\Request;
use Auth;
use Validator;

class ProfessionController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $professions = Profession::orderBy('libelle_profession')->get();
            $this->addEvent('ouverture_profession', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Profession ");

            return view('dashboard_profession')->withProfessions($professions);
        }
        else
        {
            return redirect()->route('login', 302);
        }
    }


    public function store(Request $request)
    {

        if (Auth::check()) {

            $validator = Validator::make($request->all(), [

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette Profession'
                ], 200);
            }


            if ($request['id_profession'] == null) {
                $profession = new Profession();
                $profession->libelle_profession = strtoupper($request['libelle_profession']);

                if ($profession->save()) {
                    $this->addEvent('ajout_profession', $request->ip(), $profession->id, Auth::id(), "Ajout de la Profession =>  " . $profession->libelle_profession);

                    return response()
                        ->json([
                            'success' => 'La Profession a été enregistré avec succès !',
                            'nouveau' => json_encode($profession),
                        ], 200);
                }
                {
                    return response()->json([
                        'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cette Profession !'
                    ], 200);
                }
            } else {

                $profession = Profession::find($request['id_profession']);
                $old = $profession->libelle_profession;
                $profession->libelle_profession = strtoupper($request['libelle_profession']);

                if ($profession->save()) {
                    $this->addEvent('modifier', $request->ip(), $profession->id, Auth::id(), "Modification de la Profession : " . $old . " =>  " . $profession->libelle_profession);

                    return response()
                        ->json([
                            'success' => 'La Profession  a été Modifiée avec succès !',
                            'nouveau' => json_encode($profession),

                        ], 200);
                }
                {
                    return response()->json([
                        'erreur' => 'Une erreur est survenue pendant la modification de cette Profession !'
                    ], 200);
                }
            }


        } else {
            return redirect()->route('login', 302);
        }
    }
}
