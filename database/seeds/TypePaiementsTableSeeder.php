<?php

use Illuminate\Database\Seeder;

class TypePaiementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_paiements')->insert([
						'libelle_paiement' => 'ESPECES',						
					]);					
		DB::table('type_paiements')->insert([
						'libelle_paiement' => 'CHEQUE',						
					]);
		DB::table('type_paiements')->insert([
						'libelle_paiement' => 'VIREMENT',						
					]);
		DB::table('type_paiements')->insert([
						'libelle_paiement' => 'CARTE BANCAIRE',						
					]);
		DB::table('type_paiements')->insert([
						'libelle_paiement' => 'COMPTE PREPAYE',						
					]);
		DB::table('type_paiements')->insert([
						'libelle_paiement' => 'FORFAIT',						
					]);	
    }
}
