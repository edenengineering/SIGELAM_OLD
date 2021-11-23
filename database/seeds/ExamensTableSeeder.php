<?php

use Illuminate\Database\Seeder;

class ExamensTableSeeder extends Seeder
{
/**
*Run the database seeds.
*
*@returnvoid
*/
public function run()
	{
		DB::table('examens')->insert([
					'id' => 1,
					'id_groupe_examen'=>1,
					'libelle_examen'=>'GROUPE SANGUIN',
					'abreviation'=>'GSRH' , 
					'prix'=>2000,
					'code_tube' => 2,
					'delai' => 5,
				]);
		DB::table('examens')->insert([
					'id' => 2,
					'id_groupe_examen'=>1,
					'libelle_examen'=>'ELECTROPHORESE D\'HEMOGLOBINE',
					'abreviation'=>'EHB' , 
					'prix'=>4000,
					'code_tube' => 2,
					'delai' => 5,	
				]);
		DB::table('examens')->insert([
					'id' => 3,
					'id_groupe_examen'=>1,
					'libelle_examen'=>'BW',
					'abreviation'=>'BW' , 
					'prix'=>3000,
					'code_tube' => 3,
					'delai' => 5,	
				]);
		DB::table('examens')->insert([
					'id' => 4,
					'id_groupe_examen'=>2,
					'libelle_examen'=>'WIDAL',
					'abreviation'=>'WIDAL' , 
					'prix'=>4000,
					'code_tube' => 3,
					'delai' => 2,	
				]);
		DB::table('examens')->insert([
					'id' => 5,
					'id_groupe_examen'=>2,
					'libelle_examen'=>'AGHBS',
					'abreviation'=>'AGHBS' , 
					'prix'=>2000,
					'code_tube' => 3,
					'delai' => 5,	
				]);
		DB::table('examens')->insert([
					'id' => 6,
					'id_groupe_examen'=>2,
					'libelle_examen'=>'AcHCV',
					'abreviation'=>'AcHCV' , 
					'prix'=>2000,
					'code_tube' => 3,
					'delai' => 5,	
				]);
		DB::table('examens')->insert([
					'id' => 7,
					'id_groupe_examen'=>2,
					'libelle_examen'=>'TOXOPLASMOSE',
					'abreviation'=>'TOXO' , 
					'prix'=>8000,
					'code_tube' => 3,
					'delai' => 6,	
				]);
		DB::table('examens')->insert([
					'id' => 8,
					'id_groupe_examen'=>2,
					'libelle_examen'=>'RUBEOLE',
					'abreviation'=>'RUB' , 
					'prix'=>7000,
					'code_tube' => 3,
					'delai' => 6,	
				]);
		DB::table('examens')->insert([
					'id' => 9,
					'id_groupe_examen'=>2,
					'libelle_examen'=>'CRP',
					'abreviation'=>'CRP' , 
					'prix'=>1500,
					'code_tube' => 3,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 10,
					'id_groupe_examen'=>2,
					'libelle_examen'=>'TEST DE GROSSESSE',
					'abreviation'=>'GTEST' , 
					'prix'=>2500,
					'code_tube' => 3,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 11,
					'id_groupe_examen'=>2,
					'libelle_examen'=>'CHLAMYDIA IGG',
					'abreviation'=>'CHLAM' , 
					'prix'=>6000,
					'code_tube' => 3,
					'delai' => 6,	
				]);
		DB::table('examens')->insert([
					'id' => 12,
					'id_groupe_examen'=>2,
					'libelle_examen'=>'VITESSE DE SEDIMENTATION',
					'abreviation'=>'VS' , 
					'prix'=>1000,
					'code_tube' => 2,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 13,
					'id_groupe_examen'=>3,
					'libelle_examen'=>'NFS ADULTE',
					'abreviation'=>'NFS' , 
					'prix'=>3000,
					'code_tube' => 2,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 14,
					'id_groupe_examen'=>3,
					'libelle_examen'=>'NFS BEBE',
					'abreviation'=>'NFS' , 
					'prix'=>2000,
					'code_tube' => 2,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 15,
					'id_groupe_examen'=>3,
					'libelle_examen'=>'CD4',
					'abreviation'=>'CD4' , 
					'prix'=>2500,
					'code_tube' => 2,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 35,
					'id_groupe_examen'=>3,
					'libelle_examen'=>'PCR',
					'abreviation'=>'PCR' , 
					'prix'=>0,
					'code_tube' => 2,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 16,
					'id_groupe_examen'=>3,
					'libelle_examen'=>'TP/TCK',
					'abreviation'=>'' , 
					'prix'=>5000,
					'code_tube' => 1,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 17,
					'id_groupe_examen'=>8,
					'libelle_examen'=>'TDR PALU',
					'abreviation'=>'TDR' , 
					'prix'=>600,
					'code_tube' => 2,
					'delai' => 1
				]);
		DB::table('examens')->insert([
					'id' => 18,
					'id_groupe_examen'=>8,
					'libelle_examen'=>'GOUTTE EPAISSE',
					'abreviation'=>'GE' , 
					'prix'=>500,
					'code_tube' => 5,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 19,
					'id_groupe_examen'=>8,
					'libelle_examen'=>'MICROFILAIRE',
					'abreviation'=>'RMF' , 
					'prix'=>300	,
					'code_tube' => 2,
					'delai' => 1,
				]);
		DB::table('examens')->insert([
					'id' => 20,
					'id_groupe_examen'=>5,
					'libelle_examen'=>'PCV',
					'abreviation'=>'PCV' , 
					'prix'=>3000,
					'code_tube' => 5,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 21,
					'id_groupe_examen'=>5,
					'libelle_examen'=>'PU',
					'abreviation'=>'PU' , 
					'prix'=>2000,
					'code_tube' => 5,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 22,
					'id_groupe_examen'=>5,
					'libelle_examen'=>'CRACHAT DEPISTAGE',
					'abreviation'=>'BAAR DEP' , 
					'prix'=>500,
					'code_tube' => 4,
					'delai' => 3,
				]);
		DB::table('examens')->insert([
					'id' => 23,
					'id_groupe_examen'=>8,
					'libelle_examen'=>'SELLES',
					'abreviation'=>'SELLES' , 
					'prix'=>400,
					'code_tube' => 4,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 24,
					'id_groupe_examen'=>8,
					'libelle_examen'=>'CULOT URINAIRE',
					'abreviation'=>'CUL.UR' , 
					'prix'=>1000,
					'code_tube' => 4,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 25,
					'id_groupe_examen'=>8,
					'libelle_examen'=>'SNIP TEST',
					'abreviation'=>'SNIP.TEST' , 
					'prix'=>500,
					'code_tube' => 5,
					'delai' => 1,
				]);
		DB::table('examens')->insert([
					'id' => 26,
					'id_groupe_examen'=>6,
					'libelle_examen'=>'UREE',
					'abreviation'=>'UREE' , 
					'prix'=>1500,
					'code_tube' => 3,
					'delai' => 2,
				]);
		DB::table('examens')->insert([
					'id' => 27,
					'id_groupe_examen'=>6,
					'libelle_examen'=>'CREATININE',
					'abreviation'=>'CREAT' , 
					'prix'=>1500,
					'code_tube' => 3,
					'delai' => 2,	
				]);
		DB::table('examens')->insert([
					'id' => 28,
					'id_groupe_examen'=>6,
					'libelle_examen'=>'TRANSAMINASE GPT',
					'abreviation'=>'GPT' , 
					'prix'=>2500,
					'code_tube' => 3,
					'delai' => 2,
				]);
		DB::table('examens')->insert([
					'id' => 29,
					'id_groupe_examen'=>6,
					'libelle_examen'=>'GLYCEMIE',
					'abreviation'=>'GLY' , 
					'prix'=>1000,
					'code_tube' => 3,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 30,
					'id_groupe_examen'=>6,
					'libelle_examen'=>'URINE ALB/SUCRE',
					'abreviation'=>'ALB/SU' , 
					'prix'=>300	,
					'code_tube' => 4,
					'delai' => 1,
				]);
		DB::table('examens')->insert([
					'id' => 31,
					'id_groupe_examen'=>6,
					'libelle_examen'=>'COMBI 10',
					'abreviation'=>'COMBI.10' , 
					'prix'=>1000,
					'code_tube' => 4,
					'delai' => 1	
				]);
		DB::table('examens')->insert([
					'id' => 32,
					'id_groupe_examen'=>7,
					'libelle_examen'=>'VIH ADULTES',
					'abreviation'=>'VIH' , 
					'prix'=>500,
					'code_tube' => 3,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 33,
					'id_groupe_examen'=>7,
					'libelle_examen'=>'VIH FEMMES ET ENFANTS',
					'abreviation'=>'VIH' , 
					'prix'=>0,
					'code_tube' => 3,
					'delai' => 1,	
				]);
		DB::table('examens')->insert([
					'id' => 34,
					'id_groupe_examen'=>7,
					'libelle_examen'=>'CHARGE VIRALE',
					'abreviation'=>'CV' , 
					'prix'=>6000,
					'code_tube' => 2,
					'delai' => 60,	
				]);
		DB::table('examens')->insert([
					'id' => 36,
					'id_groupe_examen'=>6,
					'libelle_examen'=>'TRANSAMINASE GOT',
					'abreviation'=>'GOT' , 
					'prix'=>2500,
					'code_tube' => 3,
					'delai' => 2,	
				]);
		DB::table('examens')->insert([
					'id' => 37,
					'id_groupe_examen'=>2,
					'libelle_examen'=>'ASLO',
					'abreviation'=>'ASLO' , 
					'prix'=>3000,
					'code_tube' => 3,
					'delai' => 2,	
				]);	

		DB::table('examens')->insert([
					'id' => 38,
					'id_groupe_examen'=>5,
					'libelle_examen'=>'PV',
					'abreviation'=>'PV' , 
					'prix'=>2300,
					'code_tube' => 5,
					'delai' => 1,	
				]);

		DB::table('examens')->insert([
					'id' => 39,
					'id_groupe_examen'=>5,
					'libelle_examen'=>'CRACHAT CONTROL',
					'abreviation'=>'BAAR CTRL' , 
					'prix'=>500,
					'code_tube' => 4,
					'delai' => 3,
				]);							
	}
}
