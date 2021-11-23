<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        DB::table('users')->insert([
            'name' => 'Martial TSAGUE KENFACK',
            'email' => str_random(10).'@gmail.com',
			'pseudo' => 'martial',
            'password' => bcrypt('martial'),
			'date_naissance' => '01/01/1990',
			'adresse' => 'Yaounde',
			'id_agent' => 1,
			'sexe' => 'Masculin',
			'profile' => 1,
            'created_at' => '2018-03-15 13:22:23',

        ]);

        DB::table('users')->insert([
            'name' => 'Madeleine KWAMOU',
            'email' => str_random(10).'@gmail.com',
            'pseudo' => 'kwamou',
            'password' => bcrypt('kwamou'),
            'date_naissance' => '01/01/1990',
            'adresse' => 'Yaounde',
            'id_agent' => 1,
            'sexe' => 'Feminin',
            'profile' => 4,
            'created_at' => '2018-03-15 13:22:23',

        ]);

         DB::table('users')->insert([
            'name' => 'Anais Siewe',
            'email' => str_random(10).'@gmail.com',
            'pseudo' => 'anais',
            'password' => bcrypt('anais'),
            'date_naissance' => '01/01/1990',
            'adresse' => 'Yaounde',
            'id_agent' => 1,
            'sexe' => 'Masculin',
            'profile' => 1,
            'created_at' => '2018-03-15 13:22:23',

        ]);
		
		DB::table('users')->insert([
            'name' => 'Kevin Doumbe',
            'email' => str_random(10).'@gmail.com',
			'pseudo' => 'miloy',
            'password' => bcrypt('miloy'),
			'date_naissance' => '01/01/1990',
			'adresse' => 'Yaounde',
			'sexe' => 'Masculin',
			'id_agent' => 1,
			'profile' => 1,
            'created_at' => '2018-03-15 13:22:23',
        ]);
    
    }
}
