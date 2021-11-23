<?php

use Illuminate\Database\Seeder;

class PathologieLieesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('pathologie_liees')->insert([
					'libelle_pathologie' => 'HIV' ,
				]);

		DB::table('pathologie_liees')->insert([
					'libelle_pathologie' => 'HEPATITE B' ,
				]);

		DB::table('pathologie_liees')->insert([
					'libelle_pathologie' => 'HEPATITE C' ,
				]);

		DB::table('pathologie_liees')->insert([
					'libelle_pathologie' => 'PALUDISME' ,
				]);

		DB::table('pathologie_liees')->insert([
					'libelle_pathologie' => 'TOXOPLASMOSE' ,
				]);

		DB::table('pathologie_liees')->insert([
					'libelle_pathologie' => 'RUBEOLE' ,
				]);

		DB::table('pathologie_liees')->insert([
					'libelle_pathologie' => 'TUBERCULOSE' ,
				]);

		DB::table('pathologie_liees')->insert([
					'libelle_pathologie' => 'ASCARIDIOSE' ,
				]);

		DB::table('pathologie_liees')->insert([
					'libelle_pathologie' => 'FILARIOSE' ,
				]);
		
    }
}
