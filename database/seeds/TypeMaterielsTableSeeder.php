<?php

use Illuminate\Database\Seeder;

class TypeMaterielsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('type_materiels')->insert([
					'id' =>'1',
					'libelle_type_materiel' =>'RÉACTIFS BIOCHIMIE',
				]);
		DB::table('type_materiels')->insert([
							'id' =>'2',
							'libelle_type_materiel' =>'CONSOMMABLES',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'3',
							'libelle_type_materiel' =>'EQUIPEMENTS',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'4',
							'libelle_type_materiel' =>'RÉACTIFS HEMATOLOGIE',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'5',
							'libelle_type_materiel' =>'RÉACTIFS SEROLOGIE',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'6',
							'libelle_type_materiel' =>'RÉACTIFS ELISA',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'7',
							'libelle_type_materiel' =>'DISQUES ANTIBIOTIQUE',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'8',
							'libelle_type_materiel' =>'DISQUES ANTIFONGIQUE',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'9',
							'libelle_type_materiel' =>'RÉACTIFS HÉMOSTASES',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'10',
							'libelle_type_materiel' =>'MILIEUX DE CULTURE',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'11',
							'libelle_type_materiel' =>'COLORANTS',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'12',
							'libelle_type_materiel' =>'RÉACTIFS BACTERIO',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'13',
							'libelle_type_materiel' =>'EXAMENS CERBA',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'14',
							'libelle_type_materiel' =>'RÉACTIFS RELLIA',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'15',
							'libelle_type_materiel' =>'VERRERIE',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'16',
							'libelle_type_materiel' =>'RÉACTIFS VIROLOGIE',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'17',
							'libelle_type_materiel' =>'RÉACTIFS CYFLOW',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'18',
							'libelle_type_materiel' =>'FACTURE',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'19',
							'libelle_type_materiel' =>'ORDINATEUR',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'25',
							'libelle_type_materiel' =>'FOURNITURES',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'20',
							'libelle_type_materiel' =>'INFORMATIQUE',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'24',
							'libelle_type_materiel' =>'PRESTATIONS SERVICES',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'26',
							'libelle_type_materiel' =>'REACTIFS MINI-VIDAS',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'27',
							'libelle_type_materiel' =>'PARAPHEUR',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'28',
							'libelle_type_materiel' =>'CARTES VISITES',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'30',
							'libelle_type_materiel' =>'ORDINATEUR',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'29',
							'libelle_type_materiel' =>'ORDINATEUR',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'31',
							'libelle_type_materiel' =>'ORDINATEUR',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'33',
							'libelle_type_materiel' =>'LOYER',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'32',
							'libelle_type_materiel' =>'SURLIGNEUR',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'34',
							'libelle_type_materiel' =>'CLAVIER',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'35',
							'libelle_type_materiel' =>'REACTIFS I-CHROMA',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'36',
							'libelle_type_materiel' =>'RECTIFS C 111',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'37',
							'libelle_type_materiel' =>'RÉACTIFS PIMA',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'38',
							'libelle_type_materiel' =>'REACTIFS EASY-READER',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'39',
							'libelle_type_materiel' =>'RÉACTIFS E 411',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'40',
							'libelle_type_materiel' =>'GEL DESINFECTANT',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'43',
							'libelle_type_materiel' =>'REACTIFS AVL',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'41',
							'libelle_type_materiel' =>'CHEMISE A SANGLE',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'42',
							'libelle_type_materiel' =>'LOYER',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'44',
							'libelle_type_materiel' =>'TONER HP 126',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'45',
							'libelle_type_materiel' =>'PSA LIBRE CALSET',
						]);
		DB::table('type_materiels')->insert([
							'id' =>'46',
							'libelle_type_materiel' =>'PSA LIBRE CALSET',
						]);


    }
}
