<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class HopitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		
	DB::table('hopitals')->insert(['id' =>'1', 'nom_hopital' =>'HOPITAL CASS NKOLDONGO']);


    }
}
