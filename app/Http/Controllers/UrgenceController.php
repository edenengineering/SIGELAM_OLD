<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Dossier;
use App\ExamenDossier;
use Carbon\Carbon; 
use App\Patient;


class UrgenceController extends Controller
{
    public function Show(Request $request)
    {
    	if(Auth::check())
		{
			$tab_urgences = Dossier::where('urgence', '1')->where('statut', '1')->get();
			$result = array();
			foreach($tab_urgences as $tab)
			{
				$max = ExamenDossier::where('code_dossier', $tab->id)->max('delai');
				$date = Carbon::parse($tab->date_dossier);
				$date = $date->addDays($max);
				if(Patient::find($tab->id_patient) == null)
				{
					continue;
				}
				$collection = collect([
							'id' => $tab->id,
							'patient' => Patient::find($tab->id_patient)->nom_patient,
							'date_dossier' => $tab->date_dossier,
							'date_retrait' => $date->toDateString(),
						]);
				array_push($result, $collection);
			}


			return view('dashboard_urgences')->withTabUrgences(json_encode($result));	
		}
		else
		{
            return redirect()->route('login', 302);

		}
    }

    public function DisableUrgence(Request $request)
    {
    	if(Auth::check())
		{
			$dossier = Dossier::find($request['id_dossier']);
			$dossier->urgence = '0';
			if($dossier->save())
			{
				$tab_urgences = Dossier::where('urgence', '1')->where('statut', '1')->get();
				$result = array();
				foreach($tab_urgences as $tab)
				{
					$max = ExamenDossier::where('code_dossier', $tab->id)->max('delai');
					$date = Carbon::parse($tab->date_dossier);
					$date = $date->addDays($max);
					$collection = collect([
								'id' => $tab->id,
								'patient' => Patient::find($tab->id_patient)->nom_patient,
								'date_dossier' => $tab->date_dossier,
								'date_retrait' => $date->toDateString(),
							]);
					array_push($result, $collection);
				}
				return response()
						->json([
							'dossier' => $dossier->id,
							'success' => 'Le dossier a bien été retiré des urgences',
							'urgences' => json_encode($result),
								], 200);
			}
			else
			{
				return response()->json([
							'erreur' => 'Une erreur est survenue pendant la supression !',
						], 200);
			}
		}
		else
		{
            return redirect()->route('login', 302);

		}
    }
}
