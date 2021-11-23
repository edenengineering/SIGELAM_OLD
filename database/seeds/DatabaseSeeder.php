<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		//Utilisateurs
		
        $this->call(UsersTableSeeder::class);
	   
	   //Paramètres
	   
		$this->call(HopitalsTableSeeder::class);
		$this->call(AntibiotiquesTableSeeder::class);
		$this->call(AntifongiquesTableSeeder::class);
		$this->call(IntituleBiopsiesTableSeeder::class);
		$this->call(TypeResultatsTableSeeder::class);	
		$this->call(ConclusionsTableSeeder::class);		
	//	$this->call(TypeMaterielsTableSeeder::class);		
		$this->call(GroupeExamensTableSeeder::class);
	//	$this->call(TypeExamensTableSeeder::class);	
	//	$this->call(MaterielsTableSeeder::class);
	//	$this->call(TypePartenairesTableSeeder::class);
		$this->call(PrescripteursTableSeeder::class);
	//	$this->call(PatientsTableSeeder::class);
	//	$this->call(TypePaiementsTableSeeder::class);
		$this->call(TubesTableSeeder::class);
	//	$this->call(FournisseursTableSeeder::class);
	//	$this->call(PartenairesTableSeeder::class);
		$this->call(AgentEditeursTableSeeder::class);
		$this->call(ProfilesTableSeeder::class);

		$this->call(NatureEchantillonsTableSeeder::class);
		$this->call(PathologieLieesTableSeeder::class);
		$this->call(QuartiersTableSeeder::class);
		$this->call(UnitesTableSeeder::class);	

		//$this->call(ExamenPartenairesTableSeeder::class);
		
		
		

		//Traitements

        $this->call(ExamensTableSeeder::class);
		$this->call(RendusTableSeeder::class);
        $this->call(InterpretationsTableSeeder::class);

		if(DB::connection()->getName() == 'pgsql')
		{
			$tablesToCheck = array('prescripteurs', 'examens', 'antibiotiques', 'antifongiques', 'intitule_biopsies', 'conclusions', 'groupe_examens', 'tubes', 'agent_editeurs', 'profiles', 'nature_echantillons', 'pathologie_liees', 'quartiers', 'unites');
			foreach($tablesToCheck as $tableToCheck)
			{
				$this->command->info('Checking the next id sequence for '.$tableToCheck);
				$highestId = DB::table($tableToCheck)->select(DB::raw('MAX(id)'))->first();
				$nextId = DB::table($tableToCheck)->select(DB::raw('nextval(\''.$tableToCheck.'_id_seq\')'))->first();
				if($nextId->nextval < $highestId->max)
				{
					DB::select('SELECT setval(\''.$tableToCheck.'_id_seq\', '.$highestId->max.')');
					$highestId = DB::table($tableToCheck)->select(DB::raw('MAX(id)'))->first();
					$nextId = DB::table($tableToCheck)->select(DB::raw('nextval(\''.$tableToCheck.'_id_seq\')'))->first();
					if($nextId->nextval > $highestId->max)
					{
						$this->command->info($tableToCheck.' autoincrement corrected');
					}
					else
					{
						$this->command->info('Arff! The nextval sequence is still all screwed up on '.$tableToCheck);
					}
				}
			}
		}





    }
}
