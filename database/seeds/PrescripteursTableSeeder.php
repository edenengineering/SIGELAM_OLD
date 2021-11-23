<?php

use Illuminate\Database\Seeder;

class PrescripteursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
		DB::table('prescripteurs')->insert(['id_hopital' =>'1', 'titre' =>'Mme', 'nom_prescripteur' =>'EKOTTO BINGONO ERNESTINE', 'date_debut' =>date('Y-m-d', strtotime('09/27/2011')),  'telephone' =>'679185089', 'fax' =>'', 'sexe' =>'F', 'statut' =>'1', 'email' =>'', 'matricule_agent' =>'1', 'diligence' =>'0']);

		DB::table('prescripteurs')->insert(['id_hopital' =>'1', 'titre' =>'Mme', 'nom_prescripteur' =>'NGO SOCK PAULETTE', 'date_debut' =>date('Y-m-d', strtotime('09/27/2011')),  'telephone' =>'677455610', 'fax' =>'', 'sexe' =>'F', 'statut' =>'1', 'email' =>'', 'matricule_agent' =>'1', 'diligence' =>'0']);

		DB::table('prescripteurs')->insert(['id_hopital' =>'1', 'titre' =>'Mr', 'nom_prescripteur' =>'MAFOR BORIS', 'date_debut' =>date('Y-m-d', strtotime('09/27/2011')),  'telephone' =>'674283638', 'fax' =>'', 'sexe' =>'F', 'statut' =>'1', 'email' =>'', 'matricule_agent' =>'1', 'diligence' =>'0']);

		DB::table('prescripteurs')->insert(['id_hopital' =>'1', 'titre' =>'Mme', 'nom_prescripteur' =>'TCHEIDEM SUZANNE', 'date_debut' =>date('Y-m-d', strtotime('09/27/2011')),  'telephone' =>'699621356', 'fax' =>'', 'sexe' =>'F', 'statut' =>'1', 'email' =>'', 'matricule_agent' =>'1', 'diligence' =>'0']);

		DB::table('prescripteurs')->insert(['id_hopital' =>'1', 'titre' =>'Mme', 'nom_prescripteur' =>'MAMBO ESTELLE', 'date_debut' =>date('Y-m-d', strtotime('09/27/2011')),  'telephone' =>'694526863', 'fax' =>'', 'sexe' =>'F', 'statut' =>'1', 'email' =>'', 'matricule_agent' =>'1', 'diligence' =>'0']);

		DB::table('prescripteurs')->insert(['id_hopital' =>'1', 'titre' =>'Mme', 'nom_prescripteur' =>'TCHONANG BERTINE', 'date_debut' =>date('Y-m-d', strtotime('09/27/2011')),  'telephone' =>'699359721', 'fax' =>'', 'sexe' =>'F', 'statut' =>'1', 'email' =>'', 'matricule_agent' =>'1', 'diligence' =>'0']);



    }
}
