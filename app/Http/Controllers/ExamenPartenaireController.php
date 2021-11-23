<?php

namespace App\Http\Controllers;

use App\ExamenPartenaire;
use App\FacturePartenaire;
use App\Partenaire;
use App\Dossier;
use App\Examen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ExamenPartenaireController extends Controller
{

    public function edit(Request $request)
    {
        if(Auth::check())
        {


            if($request['id_examen_partenaire'] != null)
            {
                $examen_partenaire = ExamenPartenaire::find($request['id_examen_partenaire']);
                $examen_partenaire->prise_en_charge = $request['prise_en_charge'];

                if($examen_partenaire->save())
                {
                    return response()
                        ->json([
                            'success' => 'L\'Examen de ce Partenaire a été Modifié avec succès !',
                            'nouveau' => json_encode($examen_partenaire),
                        ], 200)
                        ;
                }
                else
                {
                    return response()->json([
                        'erreur' => 'Une erreur est survenue pendant la modification  de cet Examen de Partenaire !'
                    ], 200);
                }
            }

        }
        else{
            return redirect()->route('login', 302);
        }
    }
	
	
	public function show(Request $request)
	{
		if(Auth::check())
        {
			if($request['id_partenaire'] != null)
			{
				$result = array();
				$result2 = array();
				if($request->ajax()){
					
					$examen_partenaires = ExamenPartenaire::where('id_partenaire', $request['id_partenaire'])->get();
					foreach($examen_partenaires as $exam)
					{
						$examen = Examen::where('statut', '1')->where('id', $exam->id_examen)->first();
						$collection = collect(['id_examen_partenaire' => $exam->id,
						'id_partenaire' => $exam->id_partenaire,'id_examen' => $examen->id,
						'libelle_examen' => $examen->libelle_examen, 'quantite' => $examen->quantite,
						'nombre_indexe' => $examen->nombre_indexe, 'delai' => $examen->delai, 
						'prise_en_charge' => $exam->prise_en_charge]);
						
						array_push($result, $collection);						
					}
					$factures = FacturePartenaire::where('id_partenaire', $request['id_partenaire'])->get();
					
					return response()->json(['examen_partenaire' => json_encode($result),
											 'factures' => json_encode($factures)], 200);
				}
			}
				
			 
		}
        else{
            return redirect()->route('login', 302);
        }
	}
	
	public function showExam(Request $request)
	{
		if(Auth::check())
        {
			if($request['id_examen'] != null)
			{
				$result = array();
				$examen = Examen::find($request['id_examen']);
				$dossier = Dossier::find($request['id_dossier']);
				$collection = collect(['code' => $examen->id,
								'libelle_examen' => $examen->libelle_examen, 
								'prix_unitaire' => $examen->prix,
								'reduction' => $dossier->reduction, 
								'quantite' => $request['quantite'],
								'prix_total' =>  $examen->prix * $request['quantite'],
								'prix_net' => ($examen->prix * $request['quantite']) - ($examen->prix * $request['quantite'] * $request['reduction'] / 100),								
								'delai' => $examen->delai,]);
								
								array_push($result, $collection);
								
								
				
			return response()->json(['examen_partenaire' => json_encode($result)], 200);

			}
		}
        else{
            return redirect()->route('login', 302);
        }
	}
		
	public function getBPersonnel()	
	{
		$partenaire = Partenaire::find(3);
		return $partenaire->b_public;
	}
	
	public function getfacturePartenaire(Request $request)
	{
		if(Auth::check())
        {
			if($request['id_partenaire'] != null)
			{
				
				$factures = FacturePartenaire::where('id_partenaire', $request['id_partenaire'])->get();
				return response()->json(['factures' => json_encode($factures)], 200);
			}
		}
		else
		{			
            return redirect()->route('login', 302);
		}
	}
}
