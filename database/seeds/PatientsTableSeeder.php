<?php

use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->insert([
						'nom_patient' =>'ATANGANA JEAN BOSCO',
						'date_naissance' => '1999/01/01',
						'adresse' => 'Yaounde',
						'sexe' => 'Masculin'	,		
						'id_agent' => 1,
						'telephone' => '697800980', 
					]);
		DB::table('patients')->insert([
						'nom_patient' =>'NGOUE MARIE JEANNE',
						'date_naissance' => '1999/01/01',
						'adresse' => 'Yaounde',
						'sexe' => 'Feminin'	,		
						'id_agent' => 1,
						'telephone' => '65572635'
					]);			
    }
}
