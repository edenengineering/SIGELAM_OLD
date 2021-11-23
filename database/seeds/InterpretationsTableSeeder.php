<?php

use Illuminate\Database\Seeder;

class InterpretationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		
		DB::table('interpretations')->insert(['code_examen' => 3, 'libelle_interpretation'=>'VDRL+ / TPHA + : Syphilis']);
		DB::table('interpretations')->insert(['code_examen' => 3, 'libelle_interpretation'=>'VDRL+ / TPHA -  : Faux positif']);
		DB::table('interpretations')->insert(['code_examen' => 3, 'libelle_interpretation'=>'VDRL- / TPHA +  : Syphilis très récente ou ancienne. A contrôler dans 15 Jrs']);
		DB::table('interpretations')->insert(['code_examen' => 3, 'libelle_interpretation'=>'VDRL -/ TPHA -  :  Négatif. Refaire si suspicion']);
		DB::table('interpretations')->insert(['code_examen' => 4, 'libelle_interpretation'=>'INTERPRETATION']);
		DB::table('interpretations')->insert(['code_examen' => 4, 'libelle_interpretation'=>'Négatif si absence d\'agglutination. Dans les fièvres typhoïde ou paratyphoïdes, les agglutinines anti O apparaissent vers le 8ème jour de la maladie,']);
		DB::table('interpretations')->insert(['code_examen' => 4, 'libelle_interpretation'=>'atteignent un titre moyen de 1/400 et disparaissent rapidement après la guérison clinique. Les agglutinines anti H apparaissent entre le 10ème']);
		DB::table('interpretations')->insert(['code_examen' => 4, 'libelle_interpretation'=>'et le 12ème jour, atteignent un titre moyen d\'intervalle 1/800 à 1/1600, baissent dans les semaines suivant la guérison clinique et persistent des mois']);
		DB::table('interpretations')->insert(['code_examen' => 4, 'libelle_interpretation'=>'voire des années à un titre moyen de 1/100 à 1/200.']);
				
		DB::table('interpretations')->insert(['code_examen' => 7, 'libelle_interpretation'=>'INTERPRETATION']);
		DB::table('interpretations')->insert(['code_examen' => 7, 'libelle_interpretation'=>'Sérologie négative: Index Ig < 0.9']);
		DB::table('interpretations')->insert(['code_examen' => 7, 'libelle_interpretation'=>'Sérologie indéterminée: 0.9 <= Index Ig < 1.1']);
		DB::table('interpretations')->insert(['code_examen' => 7, 'libelle_interpretation'=>'Sérologie positive: Index Ig >= 1.1']);
		DB::table('interpretations')->insert(['code_examen' => 8, 'libelle_interpretation'=>'INTERPRETATION']);
		DB::table('interpretations')->insert(['code_examen' => 8, 'libelle_interpretation'=>'Sérologie négative: Index Ig <= 0.90']);
		DB::table('interpretations')->insert(['code_examen' => 8, 'libelle_interpretation'=>'Sérologie indéterminée: 0.91<= Index Ig <= 1.1']);
		DB::table('interpretations')->insert(['code_examen' => 8, 'libelle_interpretation'=>'Sérologie positive: Index Ig > 1.1']);
		



    }
}
