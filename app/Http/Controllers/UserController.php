<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Profile;
use Validator;
use App\Evenement;
use App\Alerte;
use App\Patient;
use App\Dossier;
use App\Examen;
use App\ExamenDossier;
use Carbon\Carbon; 
use App\Resultat;
use App\Journal;

use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    //
    
    public function getDashboard()
    {
        if(Auth::check())
        {
            return view('dashboard_home');
        }
        else
        {
            return redirect()->route('login');
        }
    }
    public function postSignIn(Request $request)
    {
    		if($request['pseudo'] == null)
    		{
    			        return view('/login');
    		}
    		$user = User::where('pseudo', $request['pseudo'])->get()->first();
		    if($user != null)
		    {
		    	if($user->statut == 0)
		    	{
		    		$erreur = 'Compte Inactif !! Veuillez contacter l\'administrateur !';

		    		return view('/login', compact('erreur'));
		    	}
		    }   
	        if(Auth::attempt([
	            'pseudo' => $request['pseudo'],
	            'password' => $request['password'],
	        ], true))
	        {
	        	

	        	$this->addEvent('connexion_utilisateur', $request->ip(),Auth::id(), Auth::id(), "Connexion de l'Utilisateur ". $user->name);
	        	//$this->CheckListeAlertes();
	         return redirect('dashboard');
	        }
	        $erreur = 'Nom d\'utilisateur ou Mot de Passe incrorrect !';
        return view('/login', compact('erreur'));

    }

    public function LogOut(Request $request)
    {
    	if(Auth::check())
		{
			$user = User::find(Auth::id());
	    	$id = Auth::id();

	    	$this->addEvent('deconnexion_utilisateur', $request->ip(),$id, $id, "Deconnexion de l'Utilisateur ". $user->name);

	        Auth::logout();
		}    	
     	   
        return redirect()->route('home');

    }
	
	 public function show( Request $request)
    {
        if(Auth::check())
        {
            $users = User::orderBy('name')->get();
			$profiles = Profile::where('statut', '1')->get();

            return view('dashboard_utilisateurs')->withUsers($users)->withProfiles($profiles);
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
				'name' => 'required',
				
			]);
			
			if($validator->fails())
			{
				return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Agent Editeur'
					], 200);	
			}
			

				if($request['id_user'] == null)
				{
					$ussss = User::where('pseudo', $request['pseudo'])->get();
					if(count($ussss) != 0)
					{
						return response()->json([
						'erreur' => 'Ce Pseudo a déjà été utilisé par un autre Utilisateur !'
						], 200);
					}

					$user = new User();
					$user->name = $request['name'];
					$user->email = $request['email'];
					$user->password = bcrypt($request['pass']);
					$user->date_naissance = $request['date_naissance'];
					$user->profile = $request['profile'];
					$user->adresse = strtoupper($request['adresse']);
					$user->telephone = $request['telephone'];
					$user->fax = $request['fax'];
					$user->email = $request['email'];
					$user->cni = $request['cni'];				
					$user->sexe = $request['sexe'];
					$user->id_agent= Auth::id();
					$user->societe = $request['societe'];
					$user->pseudo = $request['pseudo'];
					$user->statut = '1';

				if($user->save())
				{
					   $this->addEvent('ajout_utilisateur', $request->ip(),$user->id, Auth::id(), "Ajout de l'Utilisateur =>  ". $user->name);

					return response()
					->json([
						'success' => 'L\'Utilisateur a été enregistré avec succès !',
						'nouveau' => json_encode($user),
							], 200);
				}
				{
					return response()->json([
						'erreur' => 'Une erreur est survenue pendant l\'enregistrement de cet Utilisateur !'
					], 200);
				}
				}
				else
				{
					$user = User::find($request['id_user']);
					$old = $user->name;
					$user->name = $request['name'];
					$user->email = $request['email'];
					$user->date_naissance = $request['date_naissance'];
					$user->profile = $request['profile'];
					$user->adresse = strtoupper($request['adresse']);
					$user->telephone = $request['telephone'];
					$user->fax = $request['fax'];
					$user->email = $request['email'];
					$user->cni = $request['cni'];				
					$user->sexe = $request['sexe'];
					$user->societe = $request['societe'];
					$user->pseudo = $request['pseudo'];
					$user->statut = '1';	

				if($user->save())
				{
						 $this->addEvent('modifier_utilisateur', $request->ip(),$user->id, Auth::id(), "Modification du Tube d'Examen : ". $old ." =>  ". $user->name);
				
					return response()
					->json([
						'success' => 'L\'Agent Editeur  a été Modifié avec succès !',
						'nouveau' => json_encode($user),

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
			if(!$request['id_user'] == null)
			{
				$i = 0;
				$to_suppress = explode(",", $request['id_user']);
				$deleted_elements = array();
				
				foreach($to_suppress as $element)
				{
					try{
						if(Auth::id() == $element)
						{
							return response()->json([
							'erreur' => 'Impossible de se desactiver/activer soi même !',
						], 200);
						}
						$user = User::find($element);
						if($user->statut == 1){
							$i = 0;
							$user->statut = '0';
							$user->logout = true;
						}
						else 
						{
							$i = 1;
							$user->statut = '1';
							$user->logout = false;

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
							$user = User::find($request['id_user']);

							$journal = new Journal();
							$journal->evenement = 'DESACTIVATION';
							$journal->id_agent = Auth::id();
							$journal->id_user = $user->id;
							$journal->save();

									return response()->json([
									'success' => 'L\'utilisateur a bien été desactivé avec succès !',
									'user' => json_encode($user),
								], 200);
						}
						else
						{
								$user = User::find($request['id_user']);

								$journal = new Journal();
								$journal->evenement = 'ACTIVATION';
								$journal->id_agent = Auth::id();
								$journal->id_user = $user->id;
								$journal->save();

								return response()->json([
									'success' => 'L\'utilisateur a bien été activé avec succès !',
									'user' => json_encode($user),
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


	public function ModifierMotDePasse(Request $request)
	{
		if(Auth::check())
        {
        	$user = User::find($request['id_user']);
        	if(Hash::check($request['old_pass'], $user->password))
        	{
        		$user->password = bcrypt($request['nouveau_pass']);
        		if($user->save())
        		{
 					 $this->addEvent('modifier_mot_de_passe', $request->ip(),$user->id, Auth::id(), "Modification du Mot de Passe => ". $user->name);
       			
        			return response()->json([
							'success' => 'Le mot de Passe de l\'utilisateur a bien été mis à jour !',
							'nouveau' => json_encode($user),
						], 200);
        		}
        	}
        	else
        	{
        		return response()->json([
							'erreur' => 'L\'ancien mot de passe ne correspond pas !',
						], 200);
        	}
        }
        else
        {
        	return redirect()->route('login', 302);
        }
	}


	public function ActiverUser(Request $request)
	{
		if(Auth::check())
        {
        	$user = User::find($request['id_user']);
        	$user->statut = '1';
        	$user->logout = false;
        	if($user->save())
        	{
        			return response()->json([
							'success' => 'L\'utilisateur a bien été Activé !',
							'nouveau' => json_encode($user),
						], 200);
        	}
        	else
        	{
        			return response()->json([
							'erreur' => 'Une erreur est survenue !',
						], 200);
        	}
        }
        else
        {
        	return redirect()->route('login', 302);
        }

	}


	public function CheckListeAlertes()
    {
    	if(Auth::check())
    	{

    			$alerte = Alerte::all()->first();
    			if(count($alerte) != 0)
    			{
    				$date_check = Carbon::parse($alerte->date_check);
    				$date_du_jour = Carbon::parse(date('Y-m-d'));
    				if($date_du_jour->eq($date_check))
    				{
    					return;
    				}

    			}
    				Alerte::truncate();
    				$dossiers = Dossier::where('etat', 4)->get();
    				foreach ($dossiers as $dossier) {
    					$examens = ExamenDossier::where('code_dossier', $dossier->id)->where('preleve', '1')->get();
    					foreach ($examens as $examen) {
    						$exam = Examen::find($examen->code_examen);
    						$resultats = Resultat::where('id_dossier', $dossier->id)->where('id_examen', $exam->id)->get();
	   						if(count($resultats) != 0)
	   						{
	   							continue;
	   						}
    						$delai = $exam->delai;
    						$date_dossier = Carbon::parse($dossier->date_dossier);
    						$date_retrait = $date_dossier->addDays($delai);
    						$date_du_jour = Carbon::parse(date('Y-m-d'));
    						if($date_du_jour->gt($date_retrait))
    						{
    							$patient = Patient::find($dossier->id_patient);
	    						$alerte = new Alerte();
	    						$alerte->id_dossier = $dossier->id;
	    						$alerte->nom_patient = $patient->nom_patient;
	    						$alerte->examen = $exam->libelle_examen;
	    						$alerte->date_dossier = $dossier->date_dossier;
	    						$alerte->date_retrait = $date_retrait->toDateString();
	    						$alerte->date_check = $date_du_jour->toDateString();
	    						$alerte->save();
	    					}
    						
    					}
    				}

    			
    	}
    	else 
    	{
    		return redirect()->route('login', 302);
    	}	
    }

    public function getHistoriqueCompte(Request $request)
    {
    	if(Auth::check())
		{
			$journal = Journal::where('id_user', $request['id_user'])->get();			
			
			$result = array();
			foreach($journal as $jour)
			{
				$user = User::find($jour->id_agent);
				$collection = collect([
					'nom_agent' => $user->name,
					'date' => $jour->created_at->toDateTimeString(),
					'evenement' => $jour->evenement,
				]);

				array_push($result, $collection);
			}
			return response()->json([
							'historique' => json_encode($result),
						], 200);
		}
		else
		{
			return redirect()->route('login', 302);
		}

	}

	public function GenerationPseudo(Request $request)
	{
		if(Auth::check())
		{
			$valide = false;
			$i = rand(10, 99);
			$generer = "pseudo";
			$generer = strtolower(explode(" ", $request['nom'])[0]);

			while(!$valide)
			{
				if(User::where('pseudo', $generer)->count() == 0)
				{
					$valide = true;
				}
				else
				{
					$generer = $generer . $i;
				}
				$i = rand(10, 99);
			}

			return response()->json([
							'nouveau' => $generer,
						], 200);

		}
		else
		{
			return redirect()->route('login', 302);
		}	
	}

}
