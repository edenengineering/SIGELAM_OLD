<?php

namespace App\Http\Controllers;

use App\AgentEditeur;
use Illuminate\Http\Request;
use Auth;
use Validator;

class AgentEditeurController extends Controller
{
    public function show( Request $request)
    {
        if(Auth::check())
        {
            $agent_editeurs = AgentEditeur::orderBy('nom_agent')->get();
           	$this->addEvent('ouverture_agent_editeur', $request->ip(),0, Auth::id(), "Ouverture de la fenêtre Agent Editeurs ");

            return view('dashboard_agent_editeur')->withAgentEditeurs($agent_editeurs);
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
				'nom_agent' => 'required',
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Agent Editeur'
					], 200);	
			}
			

				if($request['id_agent_editeur'] == null)
				{
					$agent_editeur = new AgentEditeur();
					$agent_editeur->nom_agent = strtoupper($request['nom_agent']);
					$agent_editeur->statut = 1;

				if($agent_editeur->save())
				{
					   $this->addEvent('ajout_agent_editeur', $request->ip(),$agent_editeur->id, Auth::id(), "Ajout de l'Agent Editeur =>  ". $agent_editeur->nom_agent);

					return response()
					->json([
						'success' => 'L\'Agent Editeur a été enregistré avec succès !',
						'nouveau' => json_encode($agent_editeur),
							], 200);
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Agent Editeur !'
					], 200);
				}
				}
				else
				{
					$agent_editeur = AgentEditeur::find($request['id_agent_editeur']);
					$agent_editeur->nom_agent = strtoupper($request['nom_agent']);

				if($agent_editeur->save())
				{
					$this->addEvent('modifier_agent_editeur', $request->ip(),$agent_editeur->id, Auth::id(), "Modification de l'Agent Editeur =>  ". $agent_editeur->nom_agent);

					return response()
					->json([
						'success' => 'L\'Agent Editeur  a été Modifié avec succès !',
						'nouveau' => json_encode($agent_editeur),

							], 200)
					;
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant la modification de cet Agent Editeur !'
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
			if(!$request['id_agent_editeur'] == null)
			{
				$i = 0;
				$to_suppress = explode(",", $request['id_agent_editeur']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						
						$user = AgentEditeur::find($element);
						if($user->statut == 1){
							$i = 0;
							$user->statut = '0';
						}
						else 
						{
							$i = 1;
							$user->statut = '1';

						}
						if($user->save())
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
						if($i == 0)
						{

								$agent = AgentEditeur::find($request['id_agent_editeur']);
								$this->addEvent('desactiver_agent_editeur', $request->ip(),$agent->id, Auth::id(), "Désactivation de l'Agent Editeur =>  ". $agent->nom_agent);

									return response()->json([
									'success' => 'L\'agent editeur a bien été desactivé avec succès !',
									'agent' => json_encode($agent),
								], 200);
						}
						else
						{
								$agent = AgentEditeur::find($request['id_agent_editeur']);
								$this->addEvent('activer_agent_editeur', $request->ip(),$agent->id, Auth::id(), "Activation de l'Agent Editeur =>  ". $agent->nom_agent);

								return response()->json([
									'success' => 'L\'agent editeur a bien été activé avec succès !',
									'agent' => json_encode($agent),
								], 200);	
						}
						
					}
					else
					{	
						return response()->json([
							'success' => 'Les Utilisateurs ont bien été supprimmés avec succès !',
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
