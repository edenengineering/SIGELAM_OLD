<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Facture;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function show( Request $request)
    {
		if(Auth::check())
        {
			if($request['id_dossier'] != null)
			{
				$factures_dossier = Facture::where('id_dossier', $request['id_dossier'])->get();
				
				if($request->ajax()||true){					
					return response()->json(['factures_dossier' => json_encode($factures_dossier)], 200);
				}
			}
				
			 
		}
        else{
            return redirect()->route('login', 302);
        }
       
    }
}
