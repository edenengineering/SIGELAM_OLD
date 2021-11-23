<?php

use Illuminate\Database\Seeder;

class IntituleBiopsiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
		DB::table('intitule_biopsies')->insert([
					'libelle' =>'BILAN PRENATAL' ,
					]);

		DB::table('intitule_biopsies')->insert([
					'libelle' =>'BILAN PRENUPTIAL' ,
					]);

		DB::table('intitule_biopsies')->insert([
					'libelle' =>'CPN' ,
					]);
		

    }
}
