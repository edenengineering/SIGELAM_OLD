<?php

use Illuminate\Database\Seeder;

class RendusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		
		DB::table('rendus')->insert([
				 'code_examen' => 1,
						'libelle_rendu'=>'Antigène du système ABO',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 1,
						'libelle_rendu'=>'Antigène D (Rhésus)',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 1,
						'libelle_rendu'=>'Résultat',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		
		DB::table('rendus')->insert([
				 'code_examen' => 2,
						'libelle_rendu'=>"MIGRATION DES HEMOGLOBINES SUR PLAQUE D'ACETATE",
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 2,
						'libelle_rendu'=>"APPAREILLAGE : SITRON MIGRI 101",
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);				
		DB::table('rendus')->insert([
				 'code_examen' => 2,
						'libelle_rendu'=>'Hémoglobine',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);	
		DB::table('rendus')->insert([
				 'code_examen' => 3,
						'libelle_rendu'=>'TPHA ( Microhémagglutination )',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 3,
						'libelle_rendu'=>'VDRL ( Agglutination )',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);		
		DB::table('rendus')->insert([
				 'code_examen' => 4,
						'libelle_rendu'=>'Recherche d\'Anticorps',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 4,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 4,
						'libelle_rendu'=>'TO',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 4,
						'libelle_rendu'=>'TH',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 4,
						'libelle_rendu'=>'AO',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 4,
						'libelle_rendu'=>'AH',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 4,
						'libelle_rendu'=>'BO',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 4,
						'libelle_rendu'=>'BH',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 4,
						'libelle_rendu'=>'CO',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 4,
						'libelle_rendu'=>'CH',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 5,
						'libelle_rendu'=>'Technique  Immunochromatographique',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		

		DB::table('rendus')->insert([
				 'code_examen' => 6,
						'libelle_rendu'=>'Technique  Immunochromatographique',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);

		DB::table('rendus')->insert([
				 'code_examen' => 7,
						'libelle_rendu'=>'Test Immunochromatographique IgG',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);

		DB::table('rendus')->insert([
				 'code_examen' => 7,
						'libelle_rendu'=>'Test Immunochromatographique   IgM',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);	

		DB::table('rendus')->insert([
				 'code_examen' => 8,
						'libelle_rendu'=>'Test Immunochromatographique IgG',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);

		DB::table('rendus')->insert([
				 'code_examen' => 8,
						'libelle_rendu'=>'Test Immunochromatographique   IgM',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		

		
		DB::table('rendus')->insert([
				 'code_examen' => 9,
						'libelle_rendu'=>'CRP(Proteine C-Réactive)',
				'max' => '6',
				'min' => '0',
				'unite' => 'mg/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 10,
						'libelle_rendu'=>'Béta-HCG',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 11,
						'libelle_rendu'=>'Test Immunochromatographique IgG',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);

		DB::table('rendus')->insert([
				 'code_examen' => 11,
						'libelle_rendu'=>'Test Immunochromatographique   IgM',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 12,
						'libelle_rendu'=>'Première heure',
				'max' => '8',
				'min' => '3',
				'unite' => 'mm' ,
					]);	
		DB::table('rendus')->insert([
				 'code_examen' => 12,
						'libelle_rendu'=>'Deuxième heure',
				'max' => '15',
				'min' => '3',
				'unite' => 'mm' ,
					]);	
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Leucocytes',
				'max' => '9.50',
				'min' => '3.50',
				'unite' => '10 exp9/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Hématies',
				'max' => '5.80',
				'min' => '4.30',
				'unite' => '10 exp12/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Hémoglobine',
				'max' => '18',
				'min' => '13',
				'unite' => 'g/dl' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Hématocrite',
				'max' => '50.0',
				'min' => '40.0',
				'unite' => '%' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Volume globulaire moyen (VGM)',
				'max' => '100.0',
				'min' => '82.0',
				'unite' => 'fL' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Charge moyenne en Hb (TCMH)',
				'max' => '34.0',
				'min' => '27.0',
				'unite' => 'Pg' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Concentration corpusculaire moyenne en Hb (CCMH)',
				'max' => '35',
				'min' => '32',
				'unite' => 'g/dl' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Plaquettes',
				'max' => '450',
				'min' => '150',
				'unite' => '10 exp9/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'FORMULE LEUCOCYTAIRE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Neutrophiles',
				'max' => '75.00',
				'min' => '40.00',
				'unite' => '%' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Neutrophiles',
				'max' => '6.300',
				'min' => '1.800',
				'unite' => '10 exp9/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Lymphocytes',
				'max' => '50.00',
				'min' => '20.00',
				'unite' => '%' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Lymphocytes',
				'max' => '3.200',
				'min' => '1.100',
				'unite' => '10 exp9/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Monocytes',
				'max' => '10.00',
				'min' => '3.00',
				'unite' => '%' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Monocytes',
				'max' => '0.600',
				'min' => '0.100',
				'unite' => '10 exp9/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Eosinophiles',
				'max' => '8.00',
				'min' => '0.40',
				'unite' => '%' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Eosinophiles',
				'max' => '0.520',
				'min' => '0.020',
				'unite' => '10 exp9/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Basophiles',
				'max' => '1.00',
				'min' => '0.00',
				'unite' => '%' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 13,
						'libelle_rendu'=>'Basophiles',
				'max' => '0.060',
				'min' => '0.000',
				'unite' => '10 exp9/l' ,
					]);		
		
		
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Leucocytes',
				'max' => '9.50',
				'min' => '3.50',
				'unite' => '10 exp9/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Hématies',
				'max' => '5.80',
				'min' => '4.30',
				'unite' => '10 exp12/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Hémoglobine',
				'max' => '18',
				'min' => '13',
				'unite' => 'g/dl' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Hématocrite',
				'max' => '50.0',
				'min' => '40.0',
				'unite' => '%' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Volume globulaire moyen (VGM)',
				'max' => '100.0',
				'min' => '82.0',
				'unite' => 'fL' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Charge moyenne en Hb (TCMH)',
				'max' => '34.0',
				'min' => '27.0',
				'unite' => 'Pg' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Concentration corpusculaire moyenne en Hb (CCMH)',
				'max' => '35',
				'min' => '32',
				'unite' => 'g/dl' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Plaquettes',
				'max' => '450',
				'min' => '150',
				'unite' => '10 exp9/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'FORMULE LEUCOCYTAIRE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Neutrophiles',
				'max' => '75.00',
				'min' => '40.00',
				'unite' => '%' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Neutrophiles',
				'max' => '6.300',
				'min' => '1.800',
				'unite' => '10 exp9/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Lymphocytes',
				'max' => '50.00',
				'min' => '20.00',
				'unite' => '%' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Lymphocytes',
				'max' => '3.200',
				'min' => '1.100',
				'unite' => '10 exp9/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Monocytes',
				'max' => '10.00',
				'min' => '3.00',
				'unite' => '%' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Monocytes',
				'max' => '0.600',
				'min' => '0.100',
				'unite' => '10 exp9/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Eosinophiles',
				'max' => '8.00',
				'min' => '0.40',
				'unite' => '%' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Eosinophiles',
				'max' => '0.520',
				'min' => '0.020',
				'unite' => '10 exp9/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Basophiles',
				'max' => '1.00',
				'min' => '0.00',
				'unite' => '%' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 14,
						'libelle_rendu'=>'Basophiles',
				'max' => '0.060',
				'min' => '0.000',
				'unite' => '10 exp9/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 15,
						'libelle_rendu'=>'Cytométrie de flux',
				'max' => '1500',
				'min' => '350',
				'unite' => 'Cells/µl' ,
					]);	
		DB::table('rendus')->insert([
				 'code_examen' => 16,
						'libelle_rendu'=>'TEMPS DE QUICK',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 16,
						'libelle_rendu'=>'Temps du témoin',
				'max' => '',
				'min' => '',
				'unite' => 's' ,
					]);

		DB::table('rendus')->insert([
				 'code_examen' => 16,
						'libelle_rendu'=>'Temps du sujet',
				'max' => '',
				'min' => '',
				'unite' => 's' ,
					]);

		DB::table('rendus')->insert([
				 'code_examen' => 16,
						'libelle_rendu'=>'Taux de Prothrombine',
				'max' => '',
				'min' => '',
				'unite' => '%' ,
					]);

		DB::table('rendus')->insert([
				 'code_examen' => 16,
						'libelle_rendu'=>'INR',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);

		DB::table('rendus')->insert([
				 'code_examen' => 16,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 16,
						'libelle_rendu'=>'TEMPS DE CEPHALINE ACTIVEE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);

		DB::table('rendus')->insert([
				 'code_examen' => 16,
						'libelle_rendu'=>'Temps du témoin',
				'max' => '',
				'min' => '',
				'unite' => 's' ,
					]);

		DB::table('rendus')->insert([
				 'code_examen' => 16,
						'libelle_rendu'=>'Temps du sujet',
				'max' => '',
				'min' => '',
				'unite' => 's' ,
					]);



		DB::table('rendus')->insert([
				 'code_examen' => 17,
						'libelle_rendu'=>'Test Immunochromatographique',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);

		DB::table('rendus')->insert([
				 'code_examen' => 17,
						'libelle_rendu'=>'Résultat',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 19,
						'libelle_rendu'=>'ETAT FRAIS',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 19,
						'libelle_rendu'=>'Recherche',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 19,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 19,
						'libelle_rendu'=>'COLORATION (MGG)',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 18,
						'libelle_rendu'=>'Coloration de GIEMSA',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 18,
						'libelle_rendu'=>'Résultat',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'EXAMEN MACROSCOPIQUE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Ecoulement',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Aspect',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'EXAMEN MICROSCOPIQUE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'ETAT FRAIS',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Leucocytes',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Hématies',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Cellules épithélilales',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Levures/Filaments',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Parasites',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'GRAM',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Cellules épithéliales',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Polynucléaires',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Levures',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Bacilles gram -',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Cocci gram +',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Cocci gram -',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'CULTURE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Sur milieux usuels',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'Sur Sabouraud',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 21,
						'libelle_rendu'=>'CONCLUSION',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 22,
						'libelle_rendu'=>'Aspect des crachats',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);

		DB::table('rendus')->insert([
				 'code_examen' => 22,
						'libelle_rendu'=>'ZIELH NEELSEN(Coloration A chaud)',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);

		DB::table('rendus')->insert([
				 'code_examen' => 22,
						'libelle_rendu'=>'TEST N°1',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 22,
						'libelle_rendu'=>'TEST N°2',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 39,
						'libelle_rendu'=>'Aspect des crachats',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 39,
						'libelle_rendu'=>'ZIELH NEELSEN(Coloration A chaud)',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'EXAMEN MACROSCOPIQUE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'Aspect',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'Couleur',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'PH',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'EXAMEN MICROSCOPIQUE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'Leucocytes',
				'max' => '1000',
				'min' => '0',
				'unite' => 'mm3' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'Hématies',
				'max' => '0',
				'min' => '0',
				'unite' => 'mm3' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'Cellules',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'Levures/Filaments',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'Cylindres',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'Cristaux',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'Parasites',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 24,
						'libelle_rendu'=>'CONCLUSION',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);	
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'EXAMEN MACROSCOPIQUE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Etat du col',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Aspect des leucorrhées',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Couleur',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Test à la potasse',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'EXAMEN MICROSCOPIQUE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'ETAT FRAIS',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Leucocytes',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Hématies',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Cellules épithélilales',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Levures/Filaments',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Spermatozoïdes',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Trichomonas vaginalis',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'GRAM',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Cellules épithéliales',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Polynucléaires',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Levures',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Bacilles gram -',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Cocci gram +',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Cocci gram -',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Flore',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'CULTURE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Sur milieux usuels',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'Sur Sabouraud',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 20,
						'libelle_rendu'=>'CONCLUSION',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);	
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'EXAMEN MACROSCOPIQUE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'Consistance',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'Couleur',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'Glaire',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'Sang',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'Mucus',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'EXAMEN MICROSCOPIQUE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'Leucocytes',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'Hématies',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'Cristaux de Charcot-leyden',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'Eléments levuriformes',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'Protozoaires',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'Oeufs',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'Larves',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'Autres',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 23,
						'libelle_rendu'=>'CONCLUSION',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 25,
						'libelle_rendu'=>'Recherche',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 25,
						'libelle_rendu'=>'Type',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);	
		DB::table('rendus')->insert([
				 'code_examen' => 17,
						'libelle_rendu'=>'Type',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);		
		DB::table('rendus')->insert([
				 'code_examen' => 35,
						'libelle_rendu'=>'PCR VIH(Alere Q)',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 26,
						'libelle_rendu'=>'Urée  (Photométrie)',
				'max' => '0.50',
				'min' => '0.15',
				'unite' => 'g/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 27,
						'libelle_rendu'=>'Créatinine',
				'max' => '14',
				'min' => '6',
				'unite' => 'Mg/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 28,
						'libelle_rendu'=>'GPT (Photométrie)',
				'max' => '41',
				'min' => '0',
				'unite' => 'UI/l' ,
					]);	
		DB::table('rendus')->insert([
				 'code_examen' => 36,
						'libelle_rendu'=>'GOT (Photométrie)',
				'max' => '40',
				'min' => '0',
				'unite' => 'UI/l' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 29,
						'libelle_rendu'=>'Glycémie à jeûn (Photométrie)',
				'max' => '1.21',
				'min' => '0.50',
				'unite' => 'g/l' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 30,
						'libelle_rendu'=>'CHIMIE URINAIRE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 30,
						'libelle_rendu'=>'Glucose',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 30,
						'libelle_rendu'=>'Protéines',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 31,
						'libelle_rendu'=>'Urobilinogène',
				'max' => '',
				'min' => '',
				'unite' => 'mg/dl' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 31,
						'libelle_rendu'=>'Glucose',
				'max' => '',
				'min' => '',
				'unite' => 'mg/dL' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 31,
						'libelle_rendu'=>'Bilirubine',
				'max' => '',
				'min' => '',
				'unite' => 'µmol/L' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 31,
						'libelle_rendu'=>'Cétones',
				'max' => '',
				'min' => '',
				'unite' => 'mg/dl' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 31,
						'libelle_rendu'=>'Densité',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 31,
						'libelle_rendu'=>'Sang',
				'max' => '',
				'min' => '',
				'unite' => 'RBC/µl' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 31,
						'libelle_rendu'=>'PH',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 31,
						'libelle_rendu'=>'Protéines',
				'max' => '',
				'min' => '',
				'unite' => 'mg/dl' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 31,
						'libelle_rendu'=>'Nitrites',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 31,
						'libelle_rendu'=>'Leucocytes',
				'max' => '',
				'min' => '',
				'unite' => 'WBC/µl' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 31,
						'libelle_rendu'=>'Acide ascorbique',
				'max' => '',
				'min' => '',
				'unite' => 'mmol/L' ,
					]);

		DB::table('rendus')->insert([
				 'code_examen' => 32,
						'libelle_rendu'=>'Test Immunochromatographique (Determine HIV 1,2,0)',
				'max' => '',
				'min' => '',
				'unite' => '',
					]);
		

		DB::table('rendus')->insert([
				 'code_examen' => 32,
						'libelle_rendu'=>'Test Immunochromatographique (ORAQUICK HIV 1,2)',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 32,
						'libelle_rendu'=>'Test Immunochromatographique + Technique Sandwich (RELIA)',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		
		DB::table('rendus')->insert([
				 'code_examen' => 33,
						'libelle_rendu'=>'Test Immunochromatographique (Determine HIV 1,2,0)',
				'max' => '',
				'min' => '',
				'unite' => '',
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 33,
						'libelle_rendu'=>'Test Immunochromatographique (ORAQUICK HIV 1,2)',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 33,
						'libelle_rendu'=>'Test Immunochromatographique + Technique Sandwich (RELIA)',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 34,
						'libelle_rendu'=>'TECHNIQUE : Abbott RealTime PCR VIH',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 34,
						'libelle_rendu'=>'CHARGE VIRALE VIH',
				'max' => '',
				'min' => '',
				'unite' => 'Copies/mL' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 34,
						'libelle_rendu'=>'Log10',
				'max' => '',
				'min' => '',
				'unite' => 'Log10' ,
					]);
		
		DB::table('rendus')->insert([
				'code_examen' => 37,
				'libelle_rendu'=>'ASLO(Antistreptolysine O)',
				'max' => '200',
				'min' => '0',
				'unite' => 'UI/ml' ,
			]);

		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'EXAMEN MACROSCOPIQUE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Aspect des leucorrhées',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Couleur',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'EXAMEN MICROSCOPIQUE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'ETAT FRAIS',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Leucocytes',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Hématies',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Cellules épithélilales',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Levures/Filaments',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Trichomonas vaginalis',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'GRAM',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Cellules épithéliales',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Polynucléaires',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Levures',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Bacilles gram -',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Cocci gram +',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Cocci gram -',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'CULTURE',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Sur milieux usuels',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'Sur Sabouraud',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);
		DB::table('rendus')->insert([
				 'code_examen' => 38,
						'libelle_rendu'=>'CONCLUSION',
				'max' => '',
				'min' => '',
				'unite' => '' ,
					]);	

    }
}
