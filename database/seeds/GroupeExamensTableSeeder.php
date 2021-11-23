<?php

use Illuminate\Database\Seeder;

class GroupeExamensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
			DB::table('groupe_examens')->insert([
								'id' =>'1' ,
								'ordre_groupe' => '0' ,
								'libelle_groupe_examen' =>'SEROLOGIE A',
						]);
			DB::table('groupe_examens')->insert([
								'id' =>'2' ,
								'ordre_groupe' => '1' ,
								'libelle_groupe_examen' =>'SEROLOGIE B',
						]);
			DB::table('groupe_examens')->insert([
								'id' =>'3' ,
								'ordre_groupe' => '2' ,
								'libelle_groupe_examen' =>'HEMATOLOGIE A',
						]);
			DB::table('groupe_examens')->insert([
								'id' =>'4' ,
								'ordre_groupe' => '3' ,
								'libelle_groupe_examen' =>'HEMATOLOGIE B',
						]);			
			DB::table('groupe_examens')->insert([
								'id' =>'5' ,
								'ordre_groupe' => '4' ,
								'libelle_groupe_examen' =>'BACTERIOLOGIE',
						]);
			DB::table('groupe_examens')->insert([
								'id' =>'6' ,
								'ordre_groupe' => '5' ,
								'libelle_groupe_examen' =>'BIOCHIMIE',
						]);			

			DB::table('groupe_examens')->insert([
								'id' =>'7' ,
								'ordre_groupe' => '6' ,
								'libelle_groupe_examen' =>'SEROLOGIE HIV',
						]);
			DB::table('groupe_examens')->insert([
								'id' =>'8' ,
								'ordre_groupe' => '7' ,
								'libelle_groupe_examen' =>'PARASITOLOGIE',
						]);									
    }
}
