<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Evenement;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	
	public static function getStatut($statut)
	{
		$result = '';
		switch($statut)
		{
			case 0: $result = 'Clos';
					break;
					
			case 1: $result = 'En Attente';
				    break;		
				   
			case 2: $result = 'Spécial';
					break;
					
			case 3: $result = 'En Cours de Traitement ';
					break;
					
			case 4: $result = 'En Technique';
					break;
					
			case 5: $result = 'En Reception';
					break;
					
			case 6: $result = 'Supprimé';
					break;
					
			case 7: $result = 'Proforma';
					break;
					
			case 8: $result = 'Expiré';
					break;
					
			case 9: $result = 'Archive';
					break;
					
			case 10: $result = 'En prélèvement';
					 break;
					 
		}	
		
		return $result;
	}

	public function addEvent($event2, $adresse_ip, $value, $id_user, $libelle_event)
	{
		$event = new Evenement();
    	$event->event = $event2;
    	$event->address_ip = $this->getHote($adresse_ip);
    	$event->value = $value;
    	$event->id_user = $id_user;
    	$event->libelle_event = $libelle_event; 
    	$event->save();
	}

	public function getHote($ip)
	{
		
		if($ip == '192.168.1.2')
		{
			return 'PRELEVEMENT';
		}
		else if($ip == '192.168.1.4')
		{
			return 'TECHNIQUE1';
		}
		else if($ip == '192.168.1.5')
		{
			return 'TECHNIQUE2';
		}
		else if($ip == '192.168.1.6')
		{
			return 'SECRETARIAT';
		}
		else if($ip == '192.168.1.7')
		{
			return 'VALIDATION';
		}
		else
		{
			return $ip;
		}
	}
}
