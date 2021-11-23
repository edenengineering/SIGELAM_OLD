<?php

namespace App\Http\Controllers;

use App\Conclusion;
use App\ConclusionAutomatique;
use Validator;
use App\Examen;
use App\GroupeExamen;
use App\Tube;
use App\Rendu;
use App\Interpretation;
use App\TypeResultat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class ExamenController extends Controller
{
public function show( Request $request)
    {
        if(Auth::check())
        {
            $examens = Examen::where('statut', 1)->orderBy('libelle_examen')->get();
			$rendus = Rendu::where('statut', 1)->orderBy('id')->get();
			$conclusions = Conclusion::orderBy('libelle')->get();

			$interpretations = Interpretation::where('statut', 1)->orderBy('libelle_interpretation')->get();
			
			$groupe_examens = GroupeExamen::All();
			$tubes = Tube::All();
			$type_resultats = TypeResultat::orderBy('libelle_type_resultat')->get();

            $this->addEvent('ouverture_examen', $request->ip(),0, Auth::id(), "Ouverture de la Fenêtre Examen ");
			
            return view('dashboard_examen')
                            ->withExamens($examens)
                            ->withGroupeExamens($groupe_examens)
                            ->withTubes($tubes)
                            ->withRendus($rendus)
                            ->withInterpretations($interpretations)
                            ->withTypeResultats($type_resultats)
                            ->withConclusions($conclusions);
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
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Examen !'
					], 200);	
			}
			

				if($request['id_examen'] == null)
				{
					$examen = new Examen();
					$examen->libelle_examen = strtoupper($request['libelle_examen']);
					$examen->id_groupe_examen = $request['id_groupe_examen'];
					$examen->abreviation = strtoupper($request['abreviation']);
					$examen->code_tube = $request['code'];
					$examen->delai = $request['delai'];
					$examen->statut = '1';
					$examen->prix = $request['prix'];
					

				if($examen->save())
				{
           			 $this->addEvent('ajout_examen', $request->ip(),$examen->id, Auth::id(), "Ajout de l'Examen => ". $examen->libelle_examen);

					return response()
					->json([
						'success' => 'L\'Examen a été enregistré avec succès !',
						'nouveau' => json_encode($examen),

							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'Enregistrement de cet Examen !'
					], 200);
				}
				}
				else
				{
					$examen = Examen::find($request['id_examen']);
					$old = $examen->libelle_examen;
					$examen->libelle_examen = strtoupper($request['libelle_examen']);
					$examen->id_groupe_examen = $request['id_groupe_examen'];
					$examen->abreviation = strtoupper($request['abreviation']);
					$examen->code_tube = $request['code'];
					$examen->delai = $request['delai'];
					$examen->statut = '1';
					$examen->prix = $request['prix'];
					

				if($examen->save())
				{
           			 $this->addEvent('modifier_examen', $request->ip(),$examen->id, Auth::id(), "Modification de l'Examen : ". $old." => ". $examen->libelle_examen);

					return response()
					->json([
						'success' => 'L\'Examen a été Modifié avec succès !',
						'nouveau' => json_encode($examen),
							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de cet Examen !'
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
			if(!$request['id_examen'] == null)
			{
				$to_suppress = explode(",", $request['id_examen']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						$examen = Examen::find($element);
						$examen->statut = '0';
						if($examen->save())
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
							'success' => 'L\'Examen a bien été supprimmé avec succès !',
							'supprimes' => json_encode($deleted_elements),
						], 200);
					}
					else
					{	
						return response()->json([
							'success' => 'Les Examens ont bien été supprimmés avec succès !',
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

    public function StoreConclusionAutomatique(Request $request)
    {
        if (Auth::check()) {
            $conclusion_auto = new ConclusionAutomatique();
            $conclusion_auto->id_examen = $request['id_examen'];
            $conclusion_auto->id_rendu = $request['id_rendu'];
            $conclusion_auto->id_type_resultat = $request['id_type_resultat'];
            $conclusion_auto->id_conclusion = $request['id_conclusion'];

            if ($conclusion_auto->save()) {
                return response()
                    ->json([
                        'success' => 'La Conclusion Automatique a été enregistrée avec success',
                        'nouveau' => json_encode($conclusion_auto),
                        'libelle_resultat' => json_encode(DB::select('select type_resultats.libelle_type_resultat from conclusion_automatiques, rendu_resultats, type_resultats where id_examen = '. $conclusion_auto->id_examen .' and conclusion_automatiques.id_type_resultat = rendu_resultats.id and type_resultats.id = rendu_resultats.id_type_resultat')[0]->libelle_type_resultat),

                        'libelle_rendu' => json_encode(Rendu::find($conclusion_auto->id_rendu)->libelle_rendu),

                        'libelle_conclusion' => json_encode(Conclusion::find($conclusion_auto->id_conclusion)->libelle)

                    ], 200);
            }
            {
                return response()->json([
                    'erreur' => 'Une erreur est survenue pendant l\'enregistrement de ce Résultat de cette Conclusion Automatique'
                ], 200);
            }
        } else {
            return redirect()->route('login', 302);
        }
    }

        public function DeleteModel2(Request $request)
        {
            if(Auth::check())
            {
                if(!$request['id_conclusion_auto'] == null)
                {
                    $to_suppress = explode(",", $request['id_conclusion_auto']);
                    $deleted_elements = array();

                    foreach($to_suppress as $element)
                    {
                        try{
                            ConclusionAutomatique::where('id', $element)->delete();

                            array_push($deleted_elements, $element);

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
                                'success' => 'La Conclusion Automatique a bien été supprimée avec succès!',
                                'supprimes' => json_encode($deleted_elements),
                            ], 200);
                        }
                        else
                        {
                            return response()->json([
                                'success' => 'Les Conclusions Automatique ont bien été supprimée avec succès!',
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

        public function ShowConclusionAutomatique(Request $request)
        {
            if(Auth::check())
            {
                $conclusions_automatiques = DB::select('select type_resultats.id as id_type_resultat, type_resultats.libelle_type_resultat, conclusion_automatiques.id, conclusion_automatiques.id_rendu, conclusion_automatiques.id_conclusion from conclusion_automatiques, rendu_resultats, type_resultats where id_examen = '. $request['id_examen'] .' and conclusion_automatiques.id_type_resultat = rendu_resultats.id and type_resultats.id = rendu_resultats.id_type_resultat');

                if($request->ajax()){
                    return response()->json(['conclusions_automatiques' => json_encode($conclusions_automatiques)], 200);
                }
            }
            else
            {
                return redirect()->route('login', 302);
            }
        }
	
}
