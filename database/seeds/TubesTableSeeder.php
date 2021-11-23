<?php

use Illuminate\Database\Seeder;

class TubesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tubes')->insert([
						'libelle_tube' => 'TUBE BLEU',
						'couleur' => '#0000ff',
						'nombre_max' => 10,									
					]);	
					
		DB::table('tubes')->insert([
						'libelle_tube' => 'TUBE VIOLET',
						'couleur' => '#4b0082',
						'nombre_max' => 10,									
					]);	
					
		DB::table('tubes')->insert([
						'libelle_tube' => 'TUBE ROUGE',
						'couleur' => '#ff0000',
						'nombre_max' => 10,									
					]);	
						
		DB::table('tubes')->insert([
						'libelle_tube' => 'POT STERILE',
						'couleur' => '#ffffff',
						'nombre_max' => 10,									
					]);	
		DB::table('tubes')->insert([
						'libelle_tube' => 'LAME',
						'couleur' => '#ffffff',
						'nombre_max' => 10,									
					]);				
					
    }
	
}
