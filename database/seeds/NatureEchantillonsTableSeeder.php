<?php

use Illuminate\Database\Seeder;

class NatureEchantillonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('nature_echantillons')->insert([
							'libelle_nature' => 'SERUM' ,
				]);

		DB::table('nature_echantillons')->insert([
							'libelle_nature' => 'PLASMA' ,
				]); 

		DB::table('nature_echantillons')->insert([
							'libelle_nature' => 'SANG TOTAL' ,
				]);

		DB::table('nature_echantillons')->insert([
							'libelle_nature' => 'SELLES' ,
				]); 		 			

		DB::table('nature_echantillons')->insert([
							'libelle_nature' => 'BIOPSIE' ,
				]); 

		DB::table('nature_echantillons')->insert([
							'libelle_nature' => 'CRACHAT' ,
				]); 

		DB::table('nature_echantillons')->insert([
							'libelle_nature' => 'URINE' ,
				]); 

		DB::table('nature_echantillons')->insert([
							'libelle_nature' => 'FROTTIS SANGUIN' ,
				]); 
    }
}
