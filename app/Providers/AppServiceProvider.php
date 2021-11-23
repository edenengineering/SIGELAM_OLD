<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Alerte;
use Illuminate\Support\Facades\Schema;
use App\Dossier;
use App\Patient;
use App\ExamenDossier;
use Carbon\Carbon; 
use Illuminate\Support\Facades\DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		//Schema::defaultStringLenght(191);
        $alertes = DB::select('select id_dossier  from alertes');
		    $urgences = DB::select('select patients.id, patients.nom_patient from dossiers, patients where patients.id = dossiers.id_patient and dossiers.urgence = \'1\' and dossiers.statut = \'1\' ');
          //  $urgences = array();
           
    		$urgence = 0;
    		$present = 0;
    		if(count($alertes) != 0)
    		{
    			$present = 1;
    		}

    		if(count($urgences) != 0)
    		{
    			$urgence =1;
    		}
    			
    		view()->share('present', $present);
    		view()->share('alertes', $alertes);
    		view()->share('urgence', $urgence);
    		view()->share('urgences', $urgences); 
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
