<?php

use Illuminate\Database\Seeder;

class QuartiersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('quartiers')->insert([
					'libelle_quartier' => 'BIYEM-ASSI' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'NKOLDONGO' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'BRIQUETTERIE' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'BASTOS' ,
				]);
		
		DB::table('quartiers')->insert([
					'libelle_quartier' => 'MENDONG' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'EFOULAN' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'NSIMEYONG' ,
				]);
		
		DB::table('quartiers')->insert([
					'libelle_quartier' => 'MIMBOMAN' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'MVOLYE' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'TSINGA' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'AWAE' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'ETOUDI' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'ELIG EFFA' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'ELIG ESSONO' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'ELIG EDZOA' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'MVOG-ADA' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'MVOG ATANGANA MBALLA' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'MELEN' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'KONDENGUI' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'JOUVENCE' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'OMNISPORT' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'GOLFE' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'ODZA' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'MESSASSI' ,
				]);

		DB::table('quartiers')->insert([
					'libelle_quartier' => 'NGOA-EKELLE' ,
				]);
    }
}
