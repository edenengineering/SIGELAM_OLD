<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('profiles')->insert([
							'libelle_profile' => 'Administrateur' ,
				]); 				
		DB::table('profiles')->insert([
							'libelle_profile' => 'Secretaire' ,
				]); 
		DB::table('profiles')->insert([
							'libelle_profile' => 'Technicien(e)' ,
				]); 
		DB::table('profiles')->insert([
							'libelle_profile' => 'Directeur Technique' ,
				]);
		DB::table('profiles')->insert([
							'libelle_profile' => 'Stagaire ' ,
				]);	
		DB::table('profiles')->insert([
							'libelle_profile' => 'Surveillant Général(e)' ,
				]);	
		DB::table('profiles')->insert([
							'libelle_profile' => 'DAF' ,
				]);			 				
    }
}
