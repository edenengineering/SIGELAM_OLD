<?php

use Illuminate\Database\Seeder;

class AntifongiquesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
		DB::table('antifongiques')->insert([
									'libelle_antifongique' => 'AMPHOTHERECINE B',
				]);
		DB::table('antifongiques')->insert([
									'libelle_antifongique' => 'FLUCONAZOLE',
				]);
		DB::table('antifongiques')->insert([
									'libelle_antifongique' => 'ITRACONAZOLE',
				]);
		DB::table('antifongiques')->insert([
									'libelle_antifongique' => 'KETOCONAZOLE',
				]);
		DB::table('antifongiques')->insert([
									'libelle_antifongique' => 'MICONAZOLE',
				]);
		DB::table('antifongiques')->insert([
									'libelle_antifongique' => 'ECONAZOLE',
				]);
		DB::table('antifongiques')->insert([
									'libelle_antifongique' => 'FLUCYTOSINE',
				]);
		DB::table('antifongiques')->insert([
									'libelle_antifongique' => 'NYSTATIN',
				]);
		DB::table('antifongiques')->insert([
									'libelle_antifongique' => 'GRISEOFULVIN',
				]);
		DB::table('antifongiques')->insert([
									'libelle_antifongique' => 'CLOTRIMAZOLE',
				]);
		DB::table('antifongiques')->insert([
									'libelle_antifongique' => 'METRONIDAZOLE',
				]);

    }
}
