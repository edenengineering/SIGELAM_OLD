<?php 
 
/* 
|-------------------------------------------------------------------------- 
| Web Routes 
|-------------------------------------------------------------------------- 
| 
| Here is where you can register web routes for your application. These 
| routes are loaded by the RouteServiceProvider within a group which 
| contains the "web" middleware group. Now create something great! 
| 
*/ 
 
use App\Examen;

Route::group(['middleware' => ['web']], function ()
{
	//Acceuil
			
			Route::get('/', 'UserController@postSignIn')->name('home');
			
	//Connexion
			
			Route::post('/login', [
				'uses' => 'UserController@postSignIn'
			]);

			Route::get('/test', [
				'uses' => 'ValidationResultatsController@CheckListeAlertes'
			]);

			Route::post('/dasboard/evolution/analyse', [
				'uses' => 'BilanController@GetEvolutionAnalyses', 
				'middleware' => 'auth'
			])->name('dashboard_get_evolution_analyses');

			Route::post('/dasboard/evolution/unitesoins', [
				'uses' => 'BilanController@GetEvolutionUniteSoins', 
				'middleware' => 'auth'
			])->name('dashboard_get_evolution_unite_soins');

			Route::post('/dasboard/evolution/prescripteurs', [
				'uses' => 'BilanController@GetEvolutionPrescriptions', 
				'middleware' => 'auth'
			])->name('dashboard_get_evolution_prescriptions');

			Route::post('/dashboard_utilisateurs/editpass',[
				'uses' => 'UserController@ModifierMotDePasse',
				'middleware' => 'auth'
				])->name('dashboard_edit_pass');


			Route::get('/login', function () {
				return view('login');
			})->name('login');
			
			Route::get('/dasboard/date', function () {
				return  response()->json([
							'date' => json_encode(date('Y-m-d')),
						], 200);
			})->name('dashboard_date');
		
		//Gestion des Factures de Partenaire
		
			Route::post('/dashboard/assureur/facture', [
                 'uses' => 'FacturePartenaireController@store',
                 'middleware' => 'auth',
             ])->name('dashboard_assureur_facture');
			 
			 Route::get('/dashboard/assureur/facture', [
                 'uses' => 'FacturePartenaireController@show',
                 'middleware' => 'auth',
             ])->name('dashboard_assureur_facture');
		
		//Gestion de la Technique
			
			
			Route::get('/dashboard/technique',[
				'uses' =>'TechniqueController@ShowDossiersEnUrgence',
				'middleware' => 'auth',
			])->name('dashboard_technique');
			
			Route::get('/dashboard/technique/attente/group',[
				'uses' =>'TechniqueController@ShowGroupeExamenTechnique',
				'middleware' => 'auth',
			])->name('dashboard_technique_attente');

			Route::get('/dashboard/technique/urgence/',[
				'uses' =>'TechniqueController@ShowDossiersGroupeExamenUrgence',
				'middleware' => 'auth',
			])->name('dashboard_technique_urgence');

			Route::get('/dashboard/technique/attente/',[
				'uses' =>'TechniqueController@ShowDossiersGroupeExamenAttente',
				'middleware' => 'auth',
			])->name('dashboard_technique_attente');
			
			Route::get('/dashboard/technique/dossier',[
				'uses' =>'TechniqueController@ShowFicheDossier',
				'middleware' => 'auth',
			])->name('dashboard_technique_dossier');
			
			Route::post('/dashboard/technique/invalider',[
				'uses' =>'TechniqueController@Invalider',
				'middleware' => 'auth',
			])->name('dashboard_technique_invalider');
			
			
			Route::get('/dashboard/technique/valider',[
				'uses' =>'ResultatController@Show',
				'middleware' => 'auth',
			])->name('dashboard_technique_valider');
			
			
			Route::post('/dashboard/technique/valider',[
				'uses' =>'ResultatController@Store',
				'middleware' => 'auth',
			])->name('dashboard_technique_valider');
			
			Route::post('/dashboard/resultats/valider/examen',[
				'uses' =>'ValidationResultatsController@StoreExamen',
				'middleware' => 'auth',
			])->name('dashboard_resultats_valider_examen');
			
			Route::post('/dashboard/resultats/valider/all',[
				'uses' =>'ValidationResultatsController@StoreExamenAll',
				'middleware' => 'auth',
			])->name('dashboard_resultats_valider_all');
			
			
		//Gestion des Antibiogrammes
		
			Route::get('/dashboard/technique/antibiogramme',[
				'uses' =>'AntibiogrammeController@Show',
				'middleware' => 'auth',
			])->name('dashboard_technique_antibiogramme');
			
			Route::post('/dashboard/technique/antibiogramme',[
				'uses' =>'AntibiogrammeController@Store',
				'middleware' => 'auth',
			])->name('dashboard_technique_antibiogramme');
			
			
		//Gestion des Antifongigrammes
		
			Route::get('/dashboard/technique/antifongigramme',[
				'uses' =>'AntifongigrammeController@Show',
				'middleware' => 'auth',
			])->name('dashboard_technique_antifongigramme');
			
			Route::post('/dashboard/technique/antifongigramme',[
				'uses' =>'AntifongigrammeController@Store',
				'middleware' => 'auth',
			])->name('dashboard_technique_antifongigramme');	
			
		//Gestion des Conlclusions d'examens

			Route::get('/dashboard/technique/conclusion_examen',[
				'uses' =>'ConclusionExamenController@Show',
				'middleware' => 'auth',
			])->name('dashboard_technique_conclusion_examen');
			
			Route::post('/dashboard/technique/conclusion_examen',[
				'uses' =>'ConclusionExamenController@Store',
				'middleware' => 'auth',
			])->name('dashboard_technique_conclusion_examen');	
			
			
		//Gestion des Prélèvements
			
			Route::get('/dashboard/prelevement', [
				'uses' =>'TubeExamenController@show2',
				'middleware' => 'auth',
			])->name('dashboard_prelevement');

			Route::get('/dashboard/prelevement/barre', [
				'uses' =>'TubeExamenController@LecteurCodeBarre',
				'middleware' => 'auth',
			])->name('dashboard_prelevement_barre');

			Route::post('/dashboard/prelevement/valider', [
				'uses' =>'TubeExamenController@valider',
				'middleware' => 'auth',
			])->name('dashboard_prelevement_valider');
		
			Route::get('/dashboard/prelevement/dossier', [
				'uses' =>'TubeExamenController@GetTubeExamen',
				'middleware' => 'auth',
			])->name('dashboard_prelevement_dossier');
			
		//Gestion des Historiques

			Route::get('/dashboard/technique/historique', [
				'uses' =>'TechniqueController@getDateHistorique',
				'middleware' => 'auth',
			])->name('dashboard_technique_historique');
			
			Route::get('/dashboard/technique/historique/date', [
				'uses' =>'TechniqueController@getDateHistoriqueDate',
				'middleware' => 'auth',
			])->name('dashboard_technique_historique_date');
			
			Route::get('/dashboard/mot_passe', function () {
				return view('dashboard_mot_passe');
			})->name('dashboard_mot_passe');

			Route::get('/dashboard/cahier_paillasse', function () {
				return view('dashboard_cahier_paillasse');
			})->name('dashboard_cahier_paillasse');

			Route::get('/dashboard/cahier_paillasse_impression', [

				'uses' => 'CahierPaillasseController@getDossiersGroupeExamen',
				'middleware' => 'auth',	
				])->name('dashboard_cahier_paillasse_impression');

			Route::get('/dashboard/cahier_paillasse_impression_all', [

				'uses' => 'CahierPaillasseController@GenererCahierPaillasseAll',
				'middleware' => 'auth',	
			])->name('dashboard_cahier_paillasse_impression_all');


			Route::get('/dashboard/valider_resultat', [
				'uses' => 'ValidationResultatsController@Show',
				'middleware' => 'auth',
			])->name('dashboard_valider_resultat');

			Route::get('/dashboard/historique_valider_resultat', [
				'uses' => 'ValidationResultatsController@GetTechnicienDossier',
				'middleware' => 'auth',
			])->name('dashboard_historique_valider_resultat');
			
			Route::get('/dashboard/valider_resultat/show', [
				'uses' => 'ValidationResultatsController@ShowExamenDossier',
				'middleware' => 'auth',
			])->name('dashboard_valider_resultat_show');

			Route::get('/dashboard/imprimer_resultat', [
				'uses' => 'ImprimerResultatsController@Show',
				'middleware' => 'auth',
				])->name('dashboard_imprimer_resultat');

			Route::get('/dashboard/imprimer_impayes', [
				'uses' => 'EtatController@ImprimerImpaye',
				'middleware' => 'auth',
				])->name('dashboard_imprimer_impayes');

			Route::get('/dashboard/imprimer_etat_biotheque', [
				'uses' => 'EtatController@ImprimerEtatBiotheque',
				'middleware' => 'auth',
				])->name('dashboard_imprimer_etat_biotheque');


			Route::get('/dashboard/imprimer_resultat_dossier', [
				'uses' => 'ImprimerResultatsController@ImprimerResultatDossier',
				'middleware' => 'auth',
				])->name('dashboard_imprimer_resultat_dossier');

			Route::post('/dashboard/archiver_resultat_dossier', [
				'uses' => 'ImprimerResultatsController@AddDossierEnArchivage',
				'middleware' => 'auth',
				])->name('dashboard_archiver_resultat_dossier');

			Route::post('/dashboard/imprimer_resultat_dossier/modifier', [
				'uses' => 'ImprimerResultatsController@ModifierResultatEnImpression',
				'middleware' => 'auth',
				])->name('dashboard_imprimer_resultat_dossier_modifier');

			Route::get('/dashboard/imprimer_resultat_dossier_a_archiver', [
				'uses' => 'ImprimerResultatsController@ShowDossierAArchiver',
				'middleware' => 'auth',
				])->name('dashboard_imprimer_resultat_dossier_a_archiver');

			Route::get('/dashboard/patient_frottis_impression', function () {
				return view('dashboard_patient_frottis_impression');
			})->name('dashboard_patient_frottis_impression');

			Route::get('/dashboard/patient_biopsie_impression', function () {
				return view('dashboard_patient_biopsie_impression');
			})->name('dashboard_patient_biopsie_impression');


			Route::get('/dashboard/statistique_pathologique_general', function () {
				return view('dashboard_statistique_pathologique_general');
			})->name('dashboard_statistique_pathologique_general');

			Route::get('/dashboard/statistique_pathologique_tranche', function () {
				return view('dashboard_statistique_pathologique_tranche');
			})->name('dashboard_statistique_pathologique_tranche');

			Route::get('/dashboard/statistique_pathologique_renseignement', [
				'uses' => 'BilanController@StatistiquePathologiesRenseignementClinique',
				'middleware' => 'auth',
			])->name('dashboard_statistique_pathologique_renseignement');

			Route::get('/dashboard/historique_resultat', [
					'uses' => 'HistoriqueResultatsController@ShowDossiersArchives',
					'middleware' => 'auth',
				])->name('dashboard_historique_resultat');


			Route::get('/dashboard/historique_resultat_examens', [
					'uses' => 'HistoriqueResultatsController@ListeExamensDossier',
					'middleware' => 'auth',
				])->name('dashboard_historique_resultat_examens');


			Route::get('/dashboard/historique_resultat_impression', function () {
				return view('dashboard_historique_resultat_impression');
			})->name('dashboard_historique_resultat_impression');

			Route::get('/dashboard/etat_reste_a_payer', function () {
				return view('dashboard_etat_reste_a_payer');
			})->name('dashboard_etat_reste_a_payer');
			Route::get('/dashboard/evolution_ca_quotidien', function () {
				return view('dashboard_evolution_ca_quotidien');
			})->name('dashboard_evolution_ca_quotidien');

			Route::get('/dashboard/evolution_ca_quotidien_get',[
					'uses' => 'EtatController@EtatChiffreAffaireQuotidien',

			])->name('dashboard_evolution_ca_quotidien_get');

			Route::get('/dashboard/evolution_ca_hebdomadaire', function () {
				return view('dashboard_evolution_ca_hebdomadaire');
			})->name('dashboard_evolution_ca_hebdomadaire');

			Route::get('/dashboard/statistique_examens', function () {
				$examens = DB::select("select * from examens where id not in (select examen from examen_statistiques where element=0) order by libelle_examen");
				return view('dashboard_statistique_examens_generale_new')->withExamens($examens);
			})->name('dashboard_statistique_examens');

			Route::get('/dashboard/statistique_positifs', function () {
				$examens = DB::select("select * from examens where id not in (select examen from examen_statistiques where element=0) order by libelle_examen");
				return view('dashboard_statistiques_positifs_new')->withExamens($examens);
			})->name('dashboard_statistique_positifs');

			Route::get('/dashboard/evolution_ca_hebdomadaire_get',[
					'uses' => 'EtatController@EtatChiffreAffaireHebdomadaire',
					'middleware' => 'auth',

			])->name('dashboard_evolution_ca_hebdomadaire_get');

			Route::get('/dashboard/alertes', [
				'uses' => 'AlerteController@Show',
				'middleware' => 'auth',
				])->name('dashboard_alertes');

			Route::get('/dashboard/urgences', [
				'uses' => 'UrgenceController@Show',
				'middleware' => 'auth',

			])->name('dashboard_urgences');

			Route::post('/dashboard/urgences/delete', [
				'uses' => 'UrgenceController@DisableUrgence',
				'middleware' => 'auth',
			])->name('dashboard_urgences_delete');

			Route::get('/dashboard/historique_facture', [
					'uses' => 'HistoriqueFacturesController@Show',
					'middleware' => 'auth',
				])->name('dashboard_historique_facture');

			Route::get('/dashboard/historique_facture/print', [
					'uses' => 'HistoriqueFacturesController@ImprimerHistoriqueResultat',
					'middleware' => 'auth',
				])->name('dashboard_historique_facture_print');


			Route::get('/dashboard/imprimer_resultat_impression', function () {
				return view('dashboard_imprimer_resultat_impression');
			})->name('dashboard_imprimer_resultat_impression');

			

			Route::get('/dashboard/nature_echantillon', [
				'uses' =>'NatureEchantillonController@show',
				'middleware' => 'auth',
			])->name('dashboard_nature_echantillon');

			

			Route::post('/dashboard/nature_echantillon',[
				'uses' =>'NatureEchantillonController@store',
				'middleware' => 'auth',
			])->name('dashboard_nature_echantillon');

			Route::get('/dashboard/Quartier', [
				'uses' =>'QuartierController@show',
				'middleware' => 'auth',
			])->name('dashboard_quartier');

			Route::post('/dashboard/Quartier',[
				'uses' =>'QuartierController@store',
				'middleware' => 'auth',
			])->name('dashboard_quartier');


			Route::get('/dashboard/Pathologie_liee', [
				'uses' =>'PathologieLieeController@show',
				'middleware' => 'auth',
			])->name('dashboard_pathologies_liees');

			Route::post('/dashboard/Pathologie_liee',[
				'uses' =>'PathologieLieeController@store',
				'middleware' => 'auth',
			])->name('dashboard_pathologies_liees');

			Route::get('/dashboard/Unite', [
				'uses' =>'UniteController@show',
				'middleware' => 'auth',
			])->name('dashboard_unite');

			
			Route::post('/dashboard/Unite',[
				'uses' =>'UniteController@store',
				'middleware' => 'auth',
			])->name('dashboard_unite');
			
			
			Route::get('/dashboard/impayes', [
				'uses' => 'EtatController@getListeImpayes',
				'middleware' => 'auth',
			])->name('dashboard_impayes');

			Route::post('/dashboard/regler_impayer', [
				'uses' => 'EtatController@PayerFacture',
				'middleware' => 'auth',
			])->name('dashboard_regler_impaye');

			Route::get('/dashboard/etats_biotheque', [
				'uses' =>'EtatController@EtatBiotheque',
				'middleware' => 'auth',
			])->name('dashboard_etats_biotheques');

			Route::get('/dashboard/rechercher_biotheque', [
				'uses' =>'EtatController@RechercherBiotheque',
				'middleware' => 'auth',
			])->name('dashboard_rechercher_biotheque');

			Route::get('/dashboard/generer_pseudo', [
				'uses' => 'UserController@GenerationPseudo',
				'middleware' => 'auth',
			])->name('dashboard_generer_pseudo');

			Route::get('/dashboard/profession', function () {
				return view('dashboard_profession');
			})->name('dashboard_profession');

				Route::get('/dashboard/statistique_profession', function () {
				return view('dashboard_statistique_profession');
			})->name('dashboard_statistique_profession');

			Route::get('/dashboard/statistique_pathologique', function () {
				return view('dashboard_statistique_pathologique');
			})->name('dashboard_statistique_pathologique');
			Route::get('/dashboard/etat_reste_a_payer', function () {
				return view('dashboard_etat_reste_a_payer');
			})->name('dashboard_etat_reste_a_payer');
			Route::get('/dashboard/evolution_ca_quotidien', function () {
				return view('dashboard_evolution_ca_quotidien');
			})->name('dashboard_evolution_ca_quotidien');
			Route::get('/dashboard/evolution_ca_hebdomadaire', function () {
				return view('dashboard_evolution_ca_hebdomadaire');
			})->name('dashboard_evolution_ca_hebdomadaire');

			Route::get('/dashboard/evolution_ca_mensuel', function () {
				return view('dashboard_evolution_ca_mensuel');
			})->name('dashboard_evolution_ca_mensuel');

			Route::get('/dashboard/evolution_ca_mensuel_get', [
				'uses' => 'EtatController@EtatChiffreAffaireMensuel',
				'middleware' => 'auth',
			])->name('dashboard_evolution_ca_mensuel_get');

			Route::get('/dashboard/evolution_ca_annuel', function () {
				return view('dashboard_evolution_ca_annuel');
			})->name('dashboard_evolution_ca_annuel');

			Route::get('/dashboard/evolution_ca_annuel_get', [
					'uses' => 'EtatController@EtatChiffreAffaireAnnuel',
					'middleware' => 'auth',
			])->name('dashboard_evolution_ca_annuel_get');

			Route::get('/dashboard/evolution_ca_quotidien_impression', [
					'uses' =>'EtatController@ImprimerChiffreQuotidien',
					'middleware' => 'auth',
			])->name('dashboard_evolution_ca_quotidien_impression');

			Route::get('/dashboard/evolution_ca_hebdomadaire_impression', [
				'uses' => 'EtatController@ImprimerChiffreHebdomadaire',
				'middleware' => 'auth'

			])->name('dashboard_evolution_ca_hebdomadaire_impression');





			Route::get('/dashboard/evolution_ca_mensuel_impression', [
					'uses' =>'EtatController@ImprimerChiffreMensuel',
					'middleware' => 'auth',
			])->name('dashboard_evolution_ca_mensuel_impression');

			Route::get('/dashboard/evolution_ca_annuel_impression', [
					'uses' =>'EtatController@ImprimerChiffreAnnuel',
					'middleware' => 'auth',
			])->name('dashboard_evolution_ca_annuel_impression');

			Route::get('/dashboard/evolution_commande', function () {
				return view('dashboard_evolution_commande');
			})->name('dashboard_evolution_commande');

			Route::get('/dashboard/evolution_commande_impression', function () {
				return view('dashboard_evolution_commande_impression');
			})->name('dashboard_evolution_commande_impression');

			Route::get('/dashboard/evolution_analyse', function () {
				return view('dashboard_evolution_analyse');
			})->name('dashboard_evolution_analyse');

			Route::get('/dashboard/evolution_prescriptions_medecin', function () {
				return view('dashboard_evolution_prescriptions_medecin');
			})->name('dashboard_evolution_prescriptions_medecin');

			Route::get('/dashboard/evolution_unite_soin', function () {
				return view('dashboard_evolution_unite_soin');
			})->name('dashboard_evolution_unite_soin');

			Route::get('/dashboard/rapport_activite', function () {
				return view('dashboard_rapport_activite');
			})->name('dashboard_rapport_activite');

			Route::get('/dashboard/evolution_prescriptions_medecin_impression', [
				'uses' => 'BilanController@ImprimerEvolutionPrescripteurs',
				'middleware' => 'auth',
			])->name('dashboard_evolution_prescriptions_medecin_impression');

			Route::get('/dashboard/evolution_unite_soins_impression', [
				'uses' => 'BilanController@ImprimerEvolutionUniteSoins',
				'middleware' => 'auth',
			])->name('dashboard_evolution_unite_soins_impression');

			Route::get('/dashboard/evolution_prescriptions_medecin_assurance', function () {
				return view('dashboard_evolution_prescriptions_medecin_assurance');
			})->name('dashboard_evolution_prescriptions_medecin_assurance');

			Route::get('/dashboard/evolution_prescriptions_medecin_assurance_impression', function () {
				return view('dashboard_evolution_prescriptions_medecin_assurance_impression');
			})->name('dashboard_evolution_prescriptions_medecin_assurance_impression');

			Route::get('/dashboard/evolution_prescriptions_medecin_centres_prescripteurs', function () {
				return view('dashboard_evolution_prescriptions_medecin_centres_prescripteurs');
			})->name('dashboard_evolution_prescriptions_medecin_centres_prescripteurs');

			Route::get('/dashboard/evolution_prescriptions_centres_prescripteurs_impression', function () {
				return view('dashboard_evolution_prescriptions_centres_prescripteurs_impression');
			})->name('dashboard_evolution_prescriptions_centres_prescripteurs_impression');

			Route::get('/dashboard/caisse_personnelle', function () {
				return view('dashboard_caisse_personnelle');
			})->name('dashboard_caisse_personnelle');
			
			Route::get('/dashboard/get_caisse_personnelle', [
				'uses' => 'CaisseController@Show',
				'middleware' => 'auth',
			])->name('dashboard_get_caisse_personnelle');
			
			Route::get('/dashboard/get_facture_partenaire2', [
				'uses' => 'ExamenPartenaireController@getfacturePartenaire',
				'middleware' => 'auth',
			])->name('dashboard_get_facture_partenaire2');
			
			Route::get('/dashboard/get_facture_detaillee_partenaire', [
				'uses' => 'FacturePartenaireController@GetFactureDetaillee',
				'middleware' => 'auth',
			])->name('dashboard_get_facture_detaillee_partenaire');
			
			Route::post('/dashboard/paiement/facture/partenaire', [
				'uses' => 'PaiementPartenaireController@Store',
				'middleware' => 'auth',
			])->name('dashboard_paiement_facture_partenaire');
			
			
			Route::get('/dashboard/get_facture_partenaire', [
				'uses' => 'FacturePartenaireController@show',
				'middleware' => 'auth',
			])->name('dashboard_get_facture_partenaire');

			Route::get('/dashboard/Bilan/getAnalyse', [
				'uses' => 'BilanController@getAnalyse',
				'middleware' => 'auth',
			])->name('dashboard_bilan_get_analyse');

			Route::get('/dashboard/Bilan/getRendus', [
				'uses' => 'BilanController@getElements',
				'middleware' => 'auth',
			])->name('dashboard_bilan_get_rendus');
			
			Route::get('/dashboard/Bilan/getTypeResultats', [
				'uses' => 'BilanController@getTypeResultat',
				'middleware' => 'auth',
			])->name('dashboard_bilan_get_type_resultats');

			Route::get('/dashboard/Bilan/ValiderTypeResultats', [
				'uses' => 'BilanController@ValiderStatistiqueResultat',
				'middleware' => 'auth',
			])->name('dashboard_bilan_valider_type_resultats');
			
			

			Route::post('/dashboard/delete_facture_partenaire', [
				'uses' => 'FacturePartenaireController@deleteModel',
				'middleware' => 'auth',
			])->name('dashboard_delete_facture_partenaire');
			
			Route::get('/dashboard/get_historique_facture', [
				'uses' => 'HistoriqueFactureController@Show',
				'middleware' => 'auth',
			])->name('dashboard_get_historique_facture');

			Route::get('/dashboard/redevances_prescriptions_medecins', function () {
				return view('dashboard_redevances_prescriptions_medecins');
			})->name('dashboard_redevances_prescriptions_medecins');

			Route::get('/dashboard/redevances_centre_prescripteur', function () {
				return view('dashboard_redevances_centre_prescripteur');
			})->name('dashboard_redevances_centre_prescripteur');

			Route::get('/dashboard/redevances_centre_prescripteur_impression', function () {
				return view('dashboard_redevances_centre_prescripteur_impression');
			})->name('dashboard_redevances_centre_prescripteur_impression');

			Route::get('/dashboard/redevances_prescriptions_assures', function () {
				return view('dashboard_redevances_prescriptions_assures');
			})->name('dashboard_redevances_prescriptions_assures');

			Route::get('/dashboard/redevances_prescriptions_assures_impression', function () {
				return view('dashboard_redevances_prescriptions_assures_impression');
			})->name('dashboard_redevances_prescriptions_assures_impression');

			Route::get('/dashboard/redevances_biopsies', function () {
				return view('dashboard_redevances_biopsies');
			})->name('dashboard_redevances_biopsies');

			Route::get('/dashboard/redevances_biopsies_impression', function () {
				return view('dashboard_redevances_biopsies_impression');
			})->name('dashboard_redevances_biopsies_impression');

			Route::get('/dashboard/redevances_cesaresoma', function () {
				return view('dashboard_redevances_cesaresoma');
			})->name('dashboard_redevances_cesaresoma');

			Route::get('/dashboard/redevances_cesaresoma_impression', function () {
				return view('dashboard_redevances_cesaresoma_impression');
			})->name('dashboard_redevances_cesaresoma_impression');			

			Route::get('/dashboard/caisse_generale', function () {
				return view('dashboard_caisse_generale');
			})->name('dashboard_caisse_generale');

			Route::get('/dashboard/facture_assureur', function () {
				return view('dashboard_facture_assureur');
			})->name('dashboard_facture_assureur');

			Route::get('/dashboard/facture_assureur_impression', function () {
				return view('dashboard_facture_assureur_impression');
			})->name('dashboard_facture_assureur_impression');
			
		    Route::get('/dashboard/facture_sous_traitant', function () {
				return view('dashboard_facture_sous_traitant');
			})->name('dashboard_facture_sous_traitant');

			Route::get('/dashboard/facture_sous_traitant_impression', function () {
				return view('dashboard_facture_sous_traitant_impression');
			})->name('dashboard_facture_sous_traitant_impression');

			Route::get('/dashboard/caisse_generale_impression', function () {
				return view('dashboard_caisse_generale_impression');
			})->name('dashboard_caisse_generale_impression');
			
			 Route::get('/dashboard/impayes_partenaires', function () {
				return view('dashboard_impayes_partenaires');
			})->name('dashboard_impayes_partenaires');

			Route::get('/dashboard/impayes_partenaires_impression', function () {
				return view('dashboard_impayes_partenaires_impression');
			})->name('dashboard_impayes_partenaires_impression');

			Route::get('/dashboard/commandes_fournisseurs', function () {
				return view('dashboard_commandes_fournisseurs');
			})->name('dashboard_commandes_fournisseurs');


			Route::get('/dashboard/autorisation_access', function () {
				return view('dashboard_autorisation_access');
			})->name('dashboard_autorisation_access');

			Route::get('/dashboard/historique_connexions', [
					'uses' => 'EvenementController@GetHistoriqueConnection',
					'middleware' => 'auth',
				])->name('dashboard_historique_connexions');

			Route::get('/dashboard/print_historique_connexions', [
					'uses' => 'EvenementController@ImprimerHistoriqueConnexion',
					'middleware' => 'auth',
				])->name('dashboard_print_historique_connexion');

			Route::get('/dashboard/print_stat_generale', [
					'uses' => 'BilanController@ImprimerStatistiquePathologieGenerale',
					'middleware' => 'auth',
				])->name('dashboard_print_stat_generale');

			Route::get('/dashboard/print_stat_tranche_age', [
					'uses' => 'BilanController@ImprimerStatistiquePathologieTrancheAge',
					'middleware' => 'auth',
				])->name('dashboard_print_stat_tranche_age');

			Route::get('/dashboard/print_stat_renseignement_clinique', [
					'uses' => 'BilanController@ImprimerStatistiquePathologieRenseignementClinique',
					'middleware' => 'auth',
				])->name('dashboard_print_stat_renseignement_clinique');

			Route::get('/dashboard/print_chiffre_quotidien', [
					'uses' => 'EtatController@ImprimerChiffreQuotidien',
					'middleware' => 'auth',
				])->name('dashboard_print_chiffre_quotidien');

			Route::get('/dashboard/utilisateurs_connectes', [
					'uses' => 'EvenementController@GetConnectedUsers',
					'middleware' => 'auth',
				])->name('dashboard_utilisateurs_connectes');

			Route::get('/dashboard/serotheque', [
				'uses'=> 'SerothequeController@Show',
				'middleware' => 'auth',
				])->name('dashboard_serotheque');

			Route::get('/dashboard/print_serotheque', [
				'uses'=> 'SerothequeController@ImprimerBiotheque',
				'middleware' => 'auth',
				])->name('dashboard_print_serotheque');

			Route::post('/dashboard/serotheque', [
				'uses'=> 'SerothequeController@Store',
				'middleware' => 'auth',
				])->name('dashboard_serotheque');

			Route::post('/dashboard/serotheque/delete', [
				'uses'=> 'SerothequeController@deleteModel',
				'middleware' => 'auth',
				])->name('dashboard_serotheque_delete');
			


			Route::get('/dashboard/commandes_fournisseurs_impression', function () {
				return view('dashboard_commandes_fournisseurs_impression');
			})->name('dashboard_commandes_fournisseurs_impression');

			Route::get('/dashboard/evolution_analyse_impression', [
				'uses' => 'BilanController@ImprimerEvolutionAnalyses',
				'middleware' => 'auth'

			])->name('dashboard_evolution_analyse_impression');
	//Panneau d'administration
	   
			Route::get('/dashboard',[
				'uses' => 'UserController@getDashboard',
				'as' => 'dashboard',
				'middleware' => 'auth',

			])->name('dashboard');
			
	//Gestion Profil
	
			Route::get('/dashboard/profil', [
				'uses' =>'ProfileController@show',
				'middleware' => 'auth',
			])->name('dashboard_profile');

			Route::post('/dashboard/profil',[
				'uses' =>'ProfileController@store',
				'middleware' => 'auth',
			])->name('dashboard_profile');	
	//Gestion Utilisateurs
	
			Route::get('/dashboard/utilisateurs', [
				'uses' =>'UserController@show',
				'middleware' => 'auth',
			])->name('dashboard_utilisateurs');

			Route::get('/dashboard/historique_utilisateur', [
				'uses' =>'UserController@getHistoriqueCompte',
				'middleware' => 'auth',
			])->name('dashboard_historique_utilisateur');

			Route::post('/dashboard/utilisateurs',[
				'uses' =>'UserController@store',
				'middleware' => 'auth',
			])->name('dashboard_utilisateurs');		

			Route::post('/dashboard/utilisateurs/delete',[
				'uses' =>'UserController@deleteModel',
				'middleware' => 'auth',
			])->name('dashboard_utilisateurs_delete');
	//Gestion Hopital
	
			Route::get('/dashboard/hopital', [
				'uses' =>'HopitalController@show',
				'middleware' => 'auth',
			])->name('dashboard_hopital');

			Route::post('/dashboard/hopital',[
				'uses' =>'HopitalController@store',
				'middleware' => 'auth',
			])->name('dashboard_hopital');
	//Gestion des Patients		

			Route::get('/dashboard/patient',[
				'uses' =>'PatientController@show',
				'middleware' => 'auth',
			])->name('dashboard_patient');

			Route::post('/dashboard/patient',[
				'uses' =>'PatientController@store',
				'middleware' => 'auth',
			])->name('dashboard_patient');
			
			Route::post('/dashboard/patient/delete',[
				'uses' =>'PatientController@delete',
				'middleware' => 'auth',
			])->name('dashboard_patient_delete');
			
	//Gestion des Dossiers	
	
			Route::get('/dashboard/dossier',[
				'uses' =>'DossierController@show',
				'middleware' => 'auth',
			])->name('dashboard_dossier');
			
			Route::get('/dashboard/dossier/show',[
				'uses' =>'DossierController@showDossier',
				'middleware' => 'auth',
			])->name('dashboard_dossier_show');

			Route::get('/dashboard/dossier/etiquette_print',[
				'uses' =>'DossierController@ImprimerEtiquette',
				'middleware' => 'auth',
			])->name('dashboard_dossier_etiquette_print');
			

			Route::post('/dashboard/dossier',[
				'uses' =>'DossierController@store',
				'middleware' => 'auth',
			])->name('dashboard_dossier');
			
			Route::post('/dashboard/dossier/delete',[
				'uses' =>'DossierController@deleteModel',
				'middleware' => 'auth',
			])->name('dashboard_dossier_delete');	
			
			Route::post('/dashboard/dossier/invalidate',[
				'uses' =>'DossierController@invalidateModel',
				'middleware' => 'auth',
			])->name('dashboard_dossier_invalidate');
   
	//Gestion Agent Editeur
	
			Route::get('/dashboard/Agent_editeur', [
				'uses' =>'AgentEditeurController@show',
				'middleware' => 'auth',
			])->name('dashboard_agent_editeur');

			Route::post('/dashboard/Agent_editeur',[
				'uses' =>'AgentEditeurController@store',
				'middleware' => 'auth',
			])->name('dashboard_agent_editeur');
			Route::post('/dashboard/Agent_editeur/delete',[
				'uses' => 'AgentEditeurController@deleteModel',
				'middleware' => 'auth',
			])->name('dashboard_agent_editeur_delete');
	

	//Gestion Antibiotique

			 Route::get('/dashboard/antibiotique',  [
				 'uses' =>'AntibiotiqueController@show',
				'middleware' => 'auth',
			])->name('dashboard_antibiotique');


			Route::post('/dashboard/antibiotique',[
				'uses' =>'AntibiotiqueController@store',
				'middleware' => 'auth',
			])->name('dashboard_antibiotique');


    //Gestion Profession

            Route::get('/dashboard/profession',  [
                'uses' =>'ProfessionController@show',
                'middleware' => 'auth',
            ])->name('dashboard_profession');


            Route::post('/dashboard/profession',[
                'uses' =>'ProfessionController@store',
                'middleware' => 'auth',
            ])->name('dashboard_profession');

	//Gestion Antifongique		

			 Route::get('/dashboard/antifongique', [
				'uses' =>'AntifongiqueController@show',
				'middleware' => 'auth',
			 ])->name('dashboard_antifongique');

			Route::post('/dashboard/antifongique',[
				'uses' =>'AntifongiqueController@store',
				'middleware' => 'auth',
			])->name('dashboard_antifongique');	
			
	//Gestion Type Examen
	
			Route::get('/dashboard/type_examen', [
				'uses' =>'TypeExamenController@show',
				'middleware' => 'auth',			 
			])->name('dashboard_type_examen');
	
			Route::post('/dashboard/type_examen', [
				'uses' =>'TypeExamenController@store',
				'middleware' => 'auth',
			])->name('dashboard_type_examen');
			
	//Gestion Groupe Examen
	
			Route::get('/dashboard/groupe_examen', [
				'uses' =>'GroupeExamenController@show',
				'middleware' => 'auth',	 
			])->name('dashboard_groupe_examen');
	 
			Route::post('/dashboard/groupe_examen', [
				'uses' =>'GroupeExamenController@store',
				'middleware' => 'auth',	 
			])->name('dashboard_groupe_examen');
			
	//Gestion Type Materiel

			Route::get('/dashboard/type_materiel', [
				'uses' =>'TypeMaterielController@show',
				'middleware' => 'auth',
			])->name('dashboard_type_materiel');
			 
			Route::post('/dashboard/type_materiel', [
				'uses' =>'TypeMaterielController@store',
				'middleware' => 'auth',
			])->name('dashboard_type_materiel');
	
	//Gestion Materiel		
	 
			Route::get('/dashboard/materiel', [
				'uses' =>'MaterielController@show',
				'middleware' => 'auth',	 
			])->name('dashboard_materiel');
	 
			Route::post('/dashboard/materiel', [
				'uses' =>'MaterielController@store',
				'middleware' => 'auth',	 
			])->name('dashboard_materiel');
			
	//Gestion Conclusion
	
			Route::get('/dashboard/type_conclusion',[
				'uses' =>'ConclusionController@show',
				'middleware' => 'auth',
			])->name('dashboard_type_conclusion');
	 
			Route::post('/dashboard/type_conclusion',[
				'uses' =>'ConclusionController@store',
				'middleware' => 'auth',
			])->name('dashboard_type_conclusion');
			
	//Gestion Type Resultat			
	
			Route::get('/dashboard/type_resultat',[
				'uses' =>'TypeResultatController@show',
				'middleware' => 'auth',
			])->name('dashboard_type_resultat');
			
			Route::post('/dashboard/type_resultat',[
				'uses' =>'TypeResultatController@store',
				'middleware' => 'auth',
			])->name('dashboard_type_resultat');
			
	//Gestion Intitule Prelevement
	
			 Route::get('/dashboard/intitule_prelevement',[
				'uses' => 'IntitulePrelevementController@show',
				'middleware' => 'auth',
				])->name('dashboard_intitule_prelevement');
				
			Route::post('/dashboard/intitule_prelevement',[
				'uses' => 'IntitulePrelevementController@store',
				'middleware' => 'auth',
				])->name('dashboard_intitule_prelevement');
		
	//Gestion Tube
	
			Route::get('/dashboard/tube', [
				'uses' =>'TubeController@show',
				'middleware' => 'auth',
			])->name('dashboard_tube');
			 
			Route::post('/dashboard/tube', [
				'uses' =>'TubeController@store',
				'middleware' => 'auth',
			 ])->name('dashboard_tube');
			 
	//Gestion Examen
	
	 
			Route::get('/dashboard/examen', [
				'uses' => 'ExamenController@show',
				'middleware' => 'auth',
			])->name('dashboard_examen');
			
			Route::get('/dashboard/examen/historique', [
				'uses' => 'DossierController@AfficherHistoriqueResultat',
				'middleware' => 'auth',
			])->name('dashboard_examen_historique');
			
			Route::post('/dashboard/examen', [
				'uses' => 'ExamenController@store',
				'middleware' => 'auth',
			])->name('dashboard_examen');
	
			Route::post('/dashboard/examen/delete',[
				'uses' => 'ExamenController@deleteModel',
				'middleware' => 'auth',
			])->name('dashboard_examen_delete');
	
	//Gestion Medecin
	
			Route::get('/dashboard/medecin', [
				'uses' => 'PrescripteurController@show',
				'middleware' => 'auth',
			])->name('dashboard_medecin');
			Route::post('/dashboard/medecin', [
				'uses' => 'PrescripteurController@store',
				'middleware' => 'auth',				
			])->name('dashboard_medecin');	
			
			Route::post('/dashboard/medecin/delete', [
				'uses' => 'PrescripteurController@deleteModel',
				'middleware' => 'auth',		
			])->name('dashboard_medecin_delete');
	
	//Gestion Interpretation
	
			Route::post('/dashboard/interpretation/delete', [
				'uses' => 'InterpretationController@deleteModel',
				'middleware' => 'auth',		
			])->name('dashboard_interpretation_delete');
			
			Route::post('/dashboard/interpretation', [
				'uses' => 'InterpretationController@store',
				'middleware' => 'auth',		
			])->name('dashboard_interpretation');
			
			Route::get('/dashboard/interpretation', [
				'uses' => 'InterpretationController@show',
				'middleware' => 'auth',		
			])->name('dashboard_interpretation');
	
	//Gestion Rendu
	
			Route::post('/dashboard/rendu/delete', [
				'uses' => 'RenduController@deleteModel',
				'middleware' => 'auth',		
			])->name('dashboard_rendu_delete');
			
			Route::post('/dashboard/rendu', [
				'uses' => 'RenduController@store',
				'middleware' => 'auth',		
			])->name('dashboard_rendu');
			
			Route::get('/dashboard/rendu', [
				'uses' => 'RenduController@show',
				'middleware' => 'auth',		
			])->name('dashboard_rendu');
			
	//Gestion Centre Prescripteur 

			Route::get('/dashboard/centre_prescripteur', [
				'uses' => 'CentrePrescripteurController@show',
				'middleware' => 'auth',		
			])->name('dashboard_centre_prescripteur');
	 
			Route::post('/dashboard/centre_prescripteur', [
				'uses' => 'CentrePrescripteurController@store',
				'middleware' => 'auth',		
			])->name('dashboard_centre_prescripteur');
	 
			Route::post('/dashboard/centre_prescripteur/delete', [	 
				'uses' => 'CentrePrescripteurController@deleteModel',
				'middleware' => 'auth',		
			])->name('dashboard_centre_prescripteur_delete'); 
			

	//Gestion Type Partenaire
			
			Route::get('/dashboard/type_partenaire', [
				'uses' => 'TypePartenaireController@show',
				'middleware' => 'auth',
			])->name('dashboard_type_partenaire'); 
			
			Route::post('/dashboard/type_partenaire', [
				'uses' => 'TypePartenaireController@store',
				'middleware' => 'auth',
			])->name('dashboard_type_partenaire'); 
			
			
	//Gestion Partenaire
	
	
             Route::get('/dashboard/assureur', [
                 'uses' => 'PartenaireController@show',
                 'middleware' => 'auth',
             ])->name('dashboard_assureur');

            Route::post('/dashboard/assureur', [
                'uses' => 'PartenaireController@store',
                'middleware' => 'auth',
            ])->name('dashboard_assureur');

            Route::post('/dashboard/assureur/delete', [
                'uses' => 'PartenaireController@deleteModel',
                'middleware' => 'auth',
            ])->name('dashboard_assureur_delete');


     //Gestion Examen de Partenaire

            Route::post('/dashboard/partenaire/examen',[
				'uses' => 'ExamenPartenaireController@edit',
                'middleware' => 'auth',
            ])->name('dashboard_examen_partenaire');
			
			Route::get('/dashboard/partenaire/examen',[
				'uses' => 'ExamenPartenaireController@show',
                'middleware' => 'auth',
            ])->name('dashboard_examen_partenaire');
			
			Route::get('/dashboard/partenaire/examen2',[
				'uses' => 'ExamenPartenaireController@showExam',
                'middleware' => 'auth',
            ])->name('dashboard_examen_partenaire_show');
			
	//Gestion des types de paiements

		Route::get('/dashboard/type_paiement',[
				'uses' => 'TypePaiementController@show',
                'middleware' => 'auth',
            ])->name('dashboard_type_paiement');
			
		Route::post('/dashboard/type_paiement',[
				'uses' => 'TypePaiementController@store',
                'middleware' => 'auth',
            ])->name('dashboard_type_paiement');
			
		Route::post('/dashboard/type_paiement/delete',[
				'uses' => 'TypePaiementController@deleteModel',
                'middleware' => 'auth',
            ])->name('dashboard_type_paiement_delete');		
			
			
			

    //Gestion Fourniseur


            Route::get('/dashboard/fournisseur', [
                'uses' => 'FournisseurController@show',
                'middleware' => 'auth',
            ])->name('dashboard_fournisseur');

            Route::post('/dashboard/fournisseur', [
                'uses' => 'FournisseurController@store',
                'middleware' => 'auth',
            ])->name('dashboard_fournisseur');

            Route::post('/dashboard/fournisseur/delete', [
                'uses' => 'FournisseurController@deleteModel',
                'middleware' => 'auth',
            ])->name('dashboard_fournisseur_delete');
			
			
	//Gestion Commande
	
			 Route::get('/dashboard/commande', [
                'uses' => 'CommandeController@show',
                'middleware' => 'auth',
            ])->name('dashboard_commande');

            Route::post('/dashboard/commande', [
                'uses' => 'CommandeController@store',
                'middleware' => 'auth',
            ])->name('dashboard_commande');

            Route::post('/dashboard/commande/delete', [
                'uses' => 'CommandeController@deleteModel',
                'middleware' => 'auth',
            ])->name('dashboard_commande_delete');
		
	//Gestion Commande Matériel

			Route::get('/dashboard/commande/materiel', [
                'uses' => 'CommandeMaterielController@show',
                'middleware' => 'auth',
            ])->name('dashboard_commande_materiel');

            Route::post('/dashboard/commande/materiel', [
                'uses' => 'CommandeMaterielController@store',
                'middleware' => 'auth',
            ])->name('dashboard_commande_materiel');

            Route::post('/dashboard/commande/materiel/delete', [
                'uses' => 'CommandeMaterielController@deleteModel',
                'middleware' => 'auth',
            ])->name('dashboard_commande_materiel_delete');	
			
			Route::get('/dashboard/commande/materiel/prix',[
				'uses' => 'CommandeMaterielController@prix',
                'middleware' => 'auth',
			])->name('dashboard_commande_materiel_prix');
			
	//Gestion Examens Dossier
	
			Route::get('/dashboard/examen/dossier', [
                'uses' => 'ExamenDossierController@show',
                'middleware' => 'auth',
            ])->name('dashboard_examen_dossier');

            Route::post('/dashboard/examen/dossier', [
                'uses' => 'ExamenDossierController@store',
                'middleware' => 'auth',
            ])->name('dashboard_examen_dossier');
			
	//Gestion Factures Dossier
			
			Route::get('/dashboard/facture/dossier', [
                'uses' => 'FactureController@show',
                'middleware' => 'auth',
            ])->name('dashboard_facture_dossier');

	//Gestion Paiement Factures Dossier

			Route::get('/dashboard/paiement/facture/dossier', [
                'uses' => 'PaiementController@show',
                'middleware' => 'auth',
            ])->name('dashboard_paiement_facture_dossier');
			
			 Route::post('/dashboard/paiement/facture/dossier', [
                'uses' => 'PaiementController@store',
                'middleware' => 'auth',
            ])->name('dashboard_paiement_facture_dossier');
			
	//Gestion des Dossiers en prélèvement

			Route::get('/dashboard/dossier/prelevement', [
                'uses' => 'DossierController@showEnPrelevement',
                'middleware' => 'auth',
            ])->name('dashboard_dossier_prelevement');
			
    //Gestion des Avoirs
			Route::get('/dashboard/patient/avoir', [
                'uses' => 'AvoirController@show',
                'middleware' => 'auth',
            ])->name('dashboard_patient_avoir');
			
			Route::post('/dashboard/patient/avoir', [
                'uses' => 'AvoirController@store',
                'middleware' => 'auth',
            ])->name('dashboard_patient_avoir');
			
			Route::post('/dashboard/patient/avoir/valider', [
                'uses' => 'AvoirController@ValiderAvoir',
                'middleware' => 'auth',
            ])->name('dashboard_patient_avoir_valider');
			
	// Gestion des Tubes D'examens

			Route::get('/dashboard/tube/examen', [
                'uses' => 'TubeExamenController@show',
                'middleware' => 'auth',
            ])->name('dashboard_tube_examen');
	
		Route::get('/dashboard/dashboard/cahier_paillasse/get', [
                'uses' => 'CahierPaillasseController@Show',
                'middleware' => 'auth',
            ])->name('dashboard_get_cahier_paillasse');	
		
		Route::get('/dashboard/Bilan/getStatistiquesPathologieAge', [
				'uses' => 'BilanController@StatistiquesPathologiesTrancheAge',
				'middleware' => 'auth',
			])->name('dashboard_get_statistique_pathologie_age');	
		
		Route::get('/dashboard/Bilan/getStatistiquesPathologieRenseignementClinique', [
				'uses' => 'BilanController@StatistiquePathologiesRenseignementClinique',
				'middleware' => 'auth',
			])->name('dashboard_get_statistique_pathologie_renseignement_clinique');

		Route::get('/dashboard/Bilan/getStatistiquesPathologieGeneral', [
				'uses' => 'BilanController@StatistiquesPathologiesGeneral',
				'middleware' => 'auth',
			])->name('dashboard_get_statistique_pathologie_general');	

		Route::post('/dashboard/get_liste_patient', [
				'uses' => 'PatientController@getListePatient',
				'middleware' => 'auth',
			])->name('dashboard_get_liste_patient');

		Route::post('/dashboard/get_liste_dossier_a_imprimer', [
				'uses' => 'ImprimerResultatsController@getListeDossierAImprimer',
				'middleware' => 'auth',
			])->name('dashboard_get_liste_dossier_a_imprimer');

		Route::post('/dashboard/get_liste_historique_facture', [
				'uses' => 'HistoriqueFacturesController@getHistoriqueFacture',
				'middleware' => 'auth',
			])->name('dashboard_get_liste_historique_facture');

		Route::post('/dashboard/get_liste_prelevement', [
				'uses' => 'TubeExamenController@getListePrelevement',
				'middleware' => 'auth',
			])->name('dashboard_get_liste_prelevement');

		Route::post('/dashboard/get_liste_prelevement_manuel', [
				'uses' => 'TubeExamenController@getListePrelevementManuel',
				'middleware' => 'auth',
			])->name('dashboard_get_liste_prelevement_manuel');

		Route::post('/dashboard/get_liste_validation', [
				'uses' => 'ValidationResultatsController@getListeValidation',
				'middleware' => 'auth',
			])->name('dashboard_get_liste_validation');

		Route::post('/dashboard/get_liste_dossiers_archives', [
				'uses' => 'HistoriqueResultatsController@GetListeDossiersArchives',
				'middleware' => 'auth',
			])->name('dashboard_get_liste_dossiers_archives');

		Route::post('/dashboard/get_liste_alertes', [
				'uses' => 'AlerteController@GetListeAlertes',
				'middleware' => 'auth',
			])->name('dashboard_get_liste_alertes');

		Route::post('/dashboard/get_liste_rapport_activite', [
				'uses' => 'BilanController@GetListeRapportActivite',
				'middleware' => 'auth',
			])->name('dashboard_get_liste_rapport_activite');

		Route::post('/dashboard/get_liste_historique_connexion', [
				'uses' => 'EvenementController@GetListeHistoriqueConnexion',
				'middleware' => 'auth',
			])->name('dashboard_get_liste_historique_connexion');



		Route::post('/dashboard/get_liste_generale_examens', [
				'uses' => 'BilanController@GetListeGeneraleExamens',
				'middleware' => 'auth',
			])->name('dashboard_get_liste_generale_examens');

		Route::get('/dashboard/get_liste_examens_positifs', [
				'uses' => 'BilanController@getStatistiquesPostifs',
				'middleware' => 'auth',
			])->name('dashboard_get_liste_examens_positifs');

		Route::get('/dashboard/get_liste_resultats_rendus', [
				'uses' => 'TechniqueController@GetListeResultatsRendus',
				'middleware' => 'auth',
			])->name('dashboard_get_liste_resultats_rendus');
 		
		Route::post('/dashboard/rendu/resultat_delete', [
				'uses' => 'RenduController@DeleteModel2',
				'middleware' => 'auth',		
			])->name('dashboard_rendu_resultat_delete');
			
			Route::post('/dashboard/rendu_resultat', [
				'uses' => 'RenduController@StoreRenduResultat',
				'middleware' => 'auth',		
			])->name('dashboard_rendu_resultat');

			// Conclusion Automatiques

        Route::get('/dashboard/get_conclusion_auto_examens', [
            'uses' => 'ExamenController@ShowConclusionAutomatique',
            'middleware' => 'auth',
        ])->name('dashboard_conclusion_auto');

        Route::post('/dashboard/get_conclusion_auto_examens', [
            'uses' => 'ExamenController@StoreConclusionAutomatique',
            'middleware' => 'auth',
        ])->name('dashboard_conclusion_auto');

        Route::post('dashboard/get_conclusion_auto_examens_delete', [
            'uses' => 'ExamenController@DeleteModel2',
            'middleware' => 'auth',
        ])->name('dashboard_conclusion_auto_delete');

        Route::get('/comocomo', [
            'uses' => 'CommandeController@GestionGlobale',
            'middleware' => 'auth',
        ])->name('comocomo');
			
    Route::get('/logout', [
        'uses' => 'UserController@LogOut',
	]);
});

