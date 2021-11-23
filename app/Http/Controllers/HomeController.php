<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function __invoke()
    {
      /*   dd( User::create([
            'name' => 'anais',
            'matricule' => 'anais',
            'email' => 'anais@gmail.com',
            'password' => bcrypt('anais'),
        ])); */
        return view('accueil');
    }
}
