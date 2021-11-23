<?php

use Illuminate\Database\Seeder;

class UnitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('unites')->insert([
					'libelle_unite' => 'MATERNITE' ,
				]);	

		DB::table('unites')->insert([
					'libelle_unite' => 'BLOC OPERATOIRE' ,
				]);	
        DB::table('unites')->insert([
                    'libelle_unite' => 'DISPENSAIRE' ,
                ]); 
        DB::table('unites')->insert([
                    'libelle_unite' => 'OPHTAMOLOGIE' ,
                ]); 
        DB::table('unites')->insert([
                    'libelle_unite' => 'STOMATOLOGIE' ,
                ]); 
        DB::table('unites')->insert([
                    'libelle_unite' => 'GYNECOLOGIE' ,
                ]); 
        DB::table('unites')->insert([
                    'libelle_unite' => 'VACCINATION' ,
                ]);

        DB::table('unites')->insert([
                    'libelle_unite' => 'PERSONNEL' ,
                ]);         
						 				
    }
}
