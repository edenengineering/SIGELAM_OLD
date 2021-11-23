<?php

use Illuminate\Database\Seeder;

class AgentEditeursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agent_editeurs')->insert([
							'nom_agent' => 'MENGUE GISELE' ,
				]); 
		DB::table('agent_editeurs')->insert([
							'nom_agent' => 'ETOUNOU DORIS' ,
				]); 
		DB::table('agent_editeurs')->insert([
							'nom_agent' => 'ALOGO FLORENCE' ,
				]); 
        DB::table('agent_editeurs')->insert([
                            'nom_agent' => 'BANE SABINE' ,
                ]); 
    }
}
