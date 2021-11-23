<?php

use Illuminate\Database\Seeder;

class TypePartenairesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_partenaires')->insert([
					'libelle_type_partenaire' =>'ASSUREUR',
				]);
		DB::table('type_partenaires')->insert([
					'libelle_type_partenaire' =>'SOUS-TRAITANT',
				]);	
    }
}
