<?php

use Illuminate\Database\Seeder;

class MaterielsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		  DB::table('materiels')->insert([
						'id' =>'1',
						'id_type_materiel' =>'2',
						'libelle_materiel' =>'EMBOUTS BLEUS',
					]);
		DB::table('materiels')->insert([
							'id' =>'2',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'EMBOUTS JAUNES',
						]);
		DB::table('materiels')->insert([
							'id' =>'3',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'EMBOUTS BLANCS',
						]);
		DB::table('materiels')->insert([
							'id' =>'4',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'GANT EN LATEX',
						]);
		DB::table('materiels')->insert([
							'id' =>'5',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'AIGUILLES VACUTAINER',
						]);
		DB::table('materiels')->insert([
							'id' =>'6',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'CUPULES + BILLES',
						]);
		DB::table('materiels')->insert([
							'id' =>'7',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'CHOLESTEROL- BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'8',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'BANDES COLLANTES',
						]);
		DB::table('materiels')->insert([
							'id' =>'9',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'DILUENT - URIT 3300',
						]);
		DB::table('materiels')->insert([
							'id' =>'10',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'TRIGLYCERIDE-BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'11',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'ONPG',
						]);
		DB::table('materiels')->insert([
							'id' =>'12',
							'id_type_materiel' =>'10',
							'libelle_materiel' =>'HÉMOC DIPHASIQUES',
						]);
		DB::table('materiels')->insert([
							'id' =>'13',
							'id_type_materiel' =>'10',
							'libelle_materiel' =>'HÉMOC MONOPHASIQUES',
						]);
		DB::table('materiels')->insert([
							'id' =>'14',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'ASLO RAL',
						]);
		DB::table('materiels')->insert([
							'id' =>'15',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'TPHA BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'16',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'POTS A SELLES',
						]);
		DB::table('materiels')->insert([
							'id' =>'17',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'LAMES MICROSCOPIQUES',
						]);
		DB::table('materiels')->insert([
							'id' =>'18',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'LAMELLES',
						]);
		DB::table('materiels')->insert([
							'id' =>'19',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'AG HBS HEPAVIEW',
						]);
		DB::table('materiels')->insert([
							'id' =>'20',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'CRP - AGAPPE',
						]);
		DB::table('materiels')->insert([
							'id' =>'21',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'BETA HCG - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'22',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'URÉE UV - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'67',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'ALÈSE GYNÉCOLOGIQUE',
						]);
		DB::table('materiels')->insert([
							'id' =>'23',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'CREATININE - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'24',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'GPT - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'25',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'PAPIERS AUTOMATES',
						]);
		DB::table('materiels')->insert([
							'id' =>'26',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'CMV (IGG) DIAG-AUTO',
						]);
		DB::table('materiels')->insert([
							'id' =>'27',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'CMV (IGM) DIAG-AUTO',
						]);
		DB::table('materiels')->insert([
							'id' =>'28',
							'id_type_materiel' =>'11',
							'libelle_materiel' =>'LUGOL  1 L',
						]);
		DB::table('materiels')->insert([
							'id' =>'29',
							'id_type_materiel' =>'11',
							'libelle_materiel' =>'VIOLET DE GENTIAN 1L',
						]);
		DB::table('materiels')->insert([
							'id' =>'30',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'PAPIER PH',
						]);
		DB::table('materiels')->insert([
							'id' =>'31',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'CRP - RAL',
						]);
		DB::table('materiels')->insert([
							'id' =>'32',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'GENTAMYCINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'33',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'KANAMYCINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'34',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'CEFIXIME',
						]);
		DB::table('materiels')->insert([
							'id' =>'35',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'DETERMINE HIV 1/2',
						]);
		DB::table('materiels')->insert([
							'id' =>'36',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'TAILLE CRAYONS',
						]);
		DB::table('materiels')->insert([
							'id' =>'37',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'PARAPHEUR',
						]);
		DB::table('materiels')->insert([
							'id' =>'38',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'AG HBE - TULIP',
						]);
		DB::table('materiels')->insert([
							'id' =>'39',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'AGRAFFES',
						]);
		DB::table('materiels')->insert([
							'id' =>'40',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'GPT - CORAL',
						]);
		DB::table('materiels')->insert([
							'id' =>'41',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'CABLE RESEAU',
						]);
		DB::table('materiels')->insert([
							'id' =>'42',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'GOT - CORAL',
						]);
		DB::table('materiels')->insert([
							'id' =>'43',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'HBA1C - CORAL',
						]);
		DB::table('materiels')->insert([
							'id' =>'44',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'TROPININE - AMICHECK',
						]);
		DB::table('materiels')->insert([
							'id' =>'45',
							'id_type_materiel' =>'9',
							'libelle_materiel' =>'BIO-TCK - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'46',
							'id_type_materiel' =>'9',
							'libelle_materiel' =>'CACL2 - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'47',
							'id_type_materiel' =>'9',
							'libelle_materiel' =>'BIO-TP - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'48',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'LDH - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'49',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'AUGMENTIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'50',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'NETILMICIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'51',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'CHLORAMPHENICOL',
						]);
		DB::table('materiels')->insert([
							'id' =>'52',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'ANSE DE PLATINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'53',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'MANCHE DE L\'ANSE',
						]);
		DB::table('materiels')->insert([
							'id' =>'54',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'GLUCOSE - INMESCO',
						]);
		DB::table('materiels')->insert([
							'id' =>'55',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'BOITES PETRI 1 COMP',
						]);
		DB::table('materiels')->insert([
							'id' =>'56',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'BOITES PETRI 2 COMP',
						]);
		DB::table('materiels')->insert([
							'id' =>'57',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'BOITES PETRI 3 COMP',
						]);
		DB::table('materiels')->insert([
							'id' =>'58',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'BOITES PETRI 4 COMP',
						]);
		DB::table('materiels')->insert([
							'id' =>'59',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'SPARADRAP',
						]);
		DB::table('materiels')->insert([
							'id' =>'60',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'WIDAL - AGAPPE',
						]);
		DB::table('materiels')->insert([
							'id' =>'61',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'TUBES HEMOLYSE VERRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'62',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'TUBES PLASTIQUES',
						]);
		DB::table('materiels')->insert([
							'id' =>'63',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'TUBES À VS',
						]);
		DB::table('materiels')->insert([
							'id' =>'64',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'GLUCOSE - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'65',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'EAU DISTILLÉE 1 L',
						]);
		DB::table('materiels')->insert([
							'id' =>'66',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'ALCOOL 95°C 1 L',
						]);
		DB::table('materiels')->insert([
							'id' =>'68',
							'id_type_materiel' =>'14',
							'libelle_materiel' =>'AG HBS - RELLIA',
						]);
		DB::table('materiels')->insert([
							'id' =>'69',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'MYCOFAST',
						]);
		DB::table('materiels')->insert([
							'id' =>'70',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'SURLIGNEURS',
						]);
		DB::table('materiels')->insert([
							'id' =>'71',
							'id_type_materiel' =>'11',
							'libelle_materiel' =>'FUSCHINE - ZIELH',
						]);
		DB::table('materiels')->insert([
							'id' =>'72',
							'id_type_materiel' =>'11',
							'libelle_materiel' =>'FUSCHINE - GRAM',
						]);
		DB::table('materiels')->insert([
							'id' =>'73',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'PROLACTINE - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'74',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'CHLAM (IGG)- SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'75',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'CHLAM (IGM)- SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'76',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'SERINGUES 5 ML',
						]);
		DB::table('materiels')->insert([
							'id' =>'77',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'SERINGUES 10 ML',
						]);
		DB::table('materiels')->insert([
							'id' =>'78',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'SPECULUM',
						]);
		DB::table('materiels')->insert([
							'id' =>'79',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'SEROPALUDISME SD-BIO',
						]);
		DB::table('materiels')->insert([
							'id' =>'80',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'ACIDE URIQUE BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'81',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PHOSPHORE - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'82',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'URÉE COLORIMETRIQUE',
						]);
		DB::table('materiels')->insert([
							'id' =>'83',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'HIV 1/2  CASSETTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'84',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'T3 - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'85',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'T4 - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'86',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'TSH - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'87',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'TUBES PEDIATRIQUES',
						]);
		DB::table('materiels')->insert([
							'id' =>'88',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'COTON HYDROPHIL 500G',
						]);
		DB::table('materiels')->insert([
							'id' =>'89',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'CHLAM DIRECT - TULIP',
						]);
		DB::table('materiels')->insert([
							'id' =>'90',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'TUBES CITRATÉS',
						]);
		DB::table('materiels')->insert([
							'id' =>'91',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'PANEL HBV - 5',
						]);
		DB::table('materiels')->insert([
							'id' =>'92',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'CUPULES HEMOSTASES',
						]);
		DB::table('materiels')->insert([
							'id' =>'93',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'PSA T - DIAG AUTO',
						]);
		DB::table('materiels')->insert([
							'id' =>'94',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'ELECTRO HB-SICKELVUE',
						]);
		DB::table('materiels')->insert([
							'id' =>'95',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'MICROPIPETTES 10-100',
						]);
		DB::table('materiels')->insert([
							'id' =>'96',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'HUB/SWITCH',
						]);
		DB::table('materiels')->insert([
							'id' =>'97',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'MICROPIPETTES 0-10',
						]);
		DB::table('materiels')->insert([
							'id' =>'98',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'MICROPIPET 100-1000',
						]);
		DB::table('materiels')->insert([
							'id' =>'99',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'MICROPIPET 1000-5000',
						]);
		DB::table('materiels')->insert([
							'id' =>'100',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'BILI TOT - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'101',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'BILI DIRECT- BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'102',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'CALCIUM - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'103',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'GOT - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'104',
							'id_type_materiel' =>'14',
							'libelle_materiel' =>'CRP - RELLIA',
						]);
		DB::table('materiels')->insert([
							'id' =>'105',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'TUBES SECS',
						]);
		DB::table('materiels')->insert([
							'id' =>'106',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'TUBES EDTA',
						]);
		DB::table('materiels')->insert([
							'id' =>'107',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'TUBES FLUORÉS',
						]);
		DB::table('materiels')->insert([
							'id' =>'108',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'TUBES HÉPARINÉS',
						]);
		DB::table('materiels')->insert([
							'id' =>'109',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'PSA - CASSETTES',
						]);
		DB::table('materiels')->insert([
							'id' =>'110',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'GROUPAGE SANGUIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'111',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'ANTI D',
						]);
		DB::table('materiels')->insert([
							'id' =>'112',
							'id_type_materiel' =>'10',
							'libelle_materiel' =>'MULLER HINTON',
						]);
		DB::table('materiels')->insert([
							'id' =>'113',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'EPICRANIENNES',
						]);
		DB::table('materiels')->insert([
							'id' =>'114',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'LYSE 1 L',
						]);
		DB::table('materiels')->insert([
							'id' =>'115',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'DETERGEANT 20 L',
						]);
		DB::table('materiels')->insert([
							'id' =>'342',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'WEBCAM',
						]);
		DB::table('materiels')->insert([
							'id' =>'116',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'ECOURVILLONS PCV',
						]);
		DB::table('materiels')->insert([
							'id' =>'117',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'ECOURVILLONS PU',
						]);
		DB::table('materiels')->insert([
							'id' =>'118',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'DECOLO/TRANSPARISANT',
						]);
		DB::table('materiels')->insert([
							'id' =>'119',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'GARROTS AUTO',
						]);
		DB::table('materiels')->insert([
							'id' =>'120',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'GARROTS FRONDE',
						]);
		DB::table('materiels')->insert([
							'id' =>'121',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'MAGNESIUM - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'122',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'CITOBROSSE',
						]);
		DB::table('materiels')->insert([
							'id' =>'123',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'REAGENT PACK-BIOLYTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'124',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'SEPTUM - BIOLYTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'125',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'AIR DETECTOR-BIOLYTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'126',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'NA ELECTRODE-BIOLYTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'127',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'K ELECTRODE-BIOLYTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'128',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'CL ELECTRODE-BIOLYTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'129',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'REF ELECTROD-BIOLYTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'130',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'PROBE - BIOLYTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'131',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'TURBING - BIOLYTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'132',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'NA - CONDITIONING',
						]);
		DB::table('materiels')->insert([
							'id' =>'133',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'CLEANING - BIOLYTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'134',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'CLEANING - URIT 3300',
						]);
		DB::table('materiels')->insert([
							'id' =>'135',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'TOBRAMYCINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'136',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'ERYTHROMYCINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'137',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'TETRACYCLINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'138',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'IMIPENEM',
						]);
		DB::table('materiels')->insert([
							'id' =>'191',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'FACTEURS RHUMATOÏDES',
						]);
		DB::table('materiels')->insert([
							'id' =>'140',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'SERO - MYCOPLASMES',
						]);
		DB::table('materiels')->insert([
							'id' =>'141',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PAC - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'142',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'MINUTEURS',
						]);
		DB::table('materiels')->insert([
							'id' =>'143',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'CHRONOMETRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'144',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PROT TOTAL - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'145',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'TOXO (IGG) - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'146',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'TOXO (IGM) - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'148',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'CARTOUCHE ENCRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'147',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'CEFUROXIME',
						]);
		DB::table('materiels')->insert([
							'id' =>'149',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'GGT - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'150',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'BOUCHONS TUBES',
						]);
		DB::table('materiels')->insert([
							'id' =>'151',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'HDL CHOLT - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'152',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'LDL CHOLT - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'153',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'POTS À URINES',
						]);
		DB::table('materiels')->insert([
							'id' =>'154',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'AZTREONAM',
						]);
		DB::table('materiels')->insert([
							'id' =>'155',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'CIPROFLOXACINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'156',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'ACIDE NALIDIXIQUE',
						]);
		DB::table('materiels')->insert([
							'id' =>'157',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'RUBEOLE (IGG)-SYNTRO',
						]);
		DB::table('materiels')->insert([
							'id' =>'158',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'RUBEOLE (IGM)-SYNTRO',
						]);
		DB::table('materiels')->insert([
							'id' =>'159',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'CK-MB - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'160',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'G-TEST CASSETTES',
						]);
		DB::table('materiels')->insert([
							'id' =>'161',
							'id_type_materiel' =>'11',
							'libelle_materiel' =>'ENCRE DE CHINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'162',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'AMPICILLINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'163',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'PENICILLINE G',
						]);
		DB::table('materiels')->insert([
							'id' =>'164',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'BISTOURIES',
						]);
		DB::table('materiels')->insert([
							'id' =>'301',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PAPIERS ECHO',
						]);
		DB::table('materiels')->insert([
							'id' =>'166',
							'id_type_materiel' =>'10',
							'libelle_materiel' =>'SABOURAUD DEXTROSE',
						]);
		DB::table('materiels')->insert([
							'id' =>'167',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'VDRL LATEX',
						]);
		DB::table('materiels')->insert([
							'id' =>'168',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'FER SERIQUE- BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'169',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'EAU OXYGENE',
						]);
		DB::table('materiels')->insert([
							'id' =>'170',
							'id_type_materiel' =>'10',
							'libelle_materiel' =>'CITRATE AGAR',
						]);
		DB::table('materiels')->insert([
							'id' =>'171',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'CEFOTAXIME',
						]);
		DB::table('materiels')->insert([
							'id' =>'172',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'CEFTAZIDIME',
						]);
		DB::table('materiels')->insert([
							'id' =>'173',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'HUILE DE PARAFFINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'174',
							'id_type_materiel' =>'10',
							'libelle_materiel' =>'GELOSE NUTRITIVE',
						]);
		DB::table('materiels')->insert([
							'id' =>'175',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PAL - BIOLYTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'176',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'HELICO-PYLORI -TULIP',
						]);
		DB::table('materiels')->insert([
							'id' =>'177',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'IGE - OMEGA',
						]);
		DB::table('materiels')->insert([
							'id' =>'178',
							'id_type_materiel' =>'10',
							'libelle_materiel' =>'SS AGAR',
						]);
		DB::table('materiels')->insert([
							'id' =>'179',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'COMBI 2',
						]);
		DB::table('materiels')->insert([
							'id' =>'180',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'COMBI 11',
						]);
		DB::table('materiels')->insert([
							'id' =>'624',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'ACHAT SMS',
						]);
		DB::table('materiels')->insert([
							'id' =>'182',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'SUPPLEMENT VITOX',
						]);
		DB::table('materiels')->insert([
							'id' =>'183',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'SUPPLEMENT VCN',
						]);
		DB::table('materiels')->insert([
							'id' =>'184',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'WIDAL - BIORAD 8 FLA',
						]);
		DB::table('materiels')->insert([
							'id' =>'185',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'CK - NAC - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'186',
							'id_type_materiel' =>'11',
							'libelle_materiel' =>'MAY GRUNWALD GIEMSA',
						]);
		DB::table('materiels')->insert([
							'id' =>'187',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'SPATULES',
						]);
		DB::table('materiels')->insert([
							'id' =>'188',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'AMPOULES MICROSCOPE',
						]);
		DB::table('materiels')->insert([
							'id' =>'189',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'SERUM CONTROL',
						]);
		DB::table('materiels')->insert([
							'id' =>'190',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'PAPIERS FILTRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'192',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'ALPHA FP - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'193',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'OESTRADIOL - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'194',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'WAARLER ROSE',
						]);
		DB::table('materiels')->insert([
							'id' =>'195',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'CA 19-9 - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'196',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'CA 125 - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'197',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'CA 15-3 - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'198',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'TESTOSTERONE-SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'199',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'PROGESTERONE-SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'200',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'HSV 1 IGG - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'201',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'HSV 1 IGM - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'202',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'HSV 2 IGG - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'204',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'SOURIS ORDINATEUR',
						]);
		DB::table('materiels')->insert([
							'id' =>'205',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'REGISTRE LABO 400 P',
						]);
		DB::table('materiels')->insert([
							'id' =>'208',
							'id_type_materiel' =>'10',
							'libelle_materiel' =>'EMB AGAR',
						]);
		DB::table('materiels')->insert([
							'id' =>'206',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'CARTOUCHE ENCRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'207',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'CAHIERS LABO 300 P',
						]);
		DB::table('materiels')->insert([
							'id' =>'209',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'BANDELETTES ALB/SUC',
						]);
		DB::table('materiels')->insert([
							'id' =>'203',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'HSV 2 IGM - SYNTRON',
						]);
		DB::table('materiels')->insert([
							'id' =>'210',
							'id_type_materiel' =>'13',
							'libelle_materiel' =>'PARVOVIRUS B19',
						]);
		DB::table('materiels')->insert([
							'id' =>'217',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'OESTRADIOL-DIAG-AUTO',
						]);
		DB::table('materiels')->insert([
							'id' =>'211',
							'id_type_materiel' =>'13',
							'libelle_materiel' =>'CV HBV',
						]);
		DB::table('materiels')->insert([
							'id' =>'212',
							'id_type_materiel' =>'13',
							'libelle_materiel' =>'CV HCV',
						]);
		DB::table('materiels')->insert([
							'id' =>'213',
							'id_type_materiel' =>'13',
							'libelle_materiel' =>'FIBROTEST-ACTITEST',
						]);
		DB::table('materiels')->insert([
							'id' =>'214',
							'id_type_materiel' =>'13',
							'libelle_materiel' =>'MICROALBUMINURIE',
						]);
		DB::table('materiels')->insert([
							'id' =>'302',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'PAPIERS ECHO',
						]);
		DB::table('materiels')->insert([
							'id' =>'216',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'SICKELVUE',
						]);
		DB::table('materiels')->insert([
							'id' =>'218',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'RETROSCREEN HIV 1/2',
						]);
		DB::table('materiels')->insert([
							'id' =>'219',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'IGE  -   AUTO-DIAG',
						]);
		DB::table('materiels')->insert([
							'id' =>'220',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'MYCOPLASMA SYSTEM',
						]);
		DB::table('materiels')->insert([
							'id' =>'221',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'VACCINOSTYL (LANCET)',
						]);
		DB::table('materiels')->insert([
							'id' =>'222',
							'id_type_materiel' =>'9',
							'libelle_materiel' =>'TP  -  CYPRESS',
						]);
		DB::table('materiels')->insert([
							'id' =>'223',
							'id_type_materiel' =>'9',
							'libelle_materiel' =>'TCK  -  CYPRESS',
						]);
		DB::table('materiels')->insert([
							'id' =>'224',
							'id_type_materiel' =>'14',
							'libelle_materiel' =>'HIV/HCV RELLIA',
						]);
		DB::table('materiels')->insert([
							'id' =>'225',
							'id_type_materiel' =>'13',
							'libelle_materiel' =>'ADN HBV',
						]);
		DB::table('materiels')->insert([
							'id' =>'226',
							'id_type_materiel' =>'13',
							'libelle_materiel' =>'AG HEPATITE DELTA',
						]);
		DB::table('materiels')->insert([
							'id' =>'227',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'LECTEUR PORTS USB',
						]);
		DB::table('materiels')->insert([
							'id' =>'228',
							'id_type_materiel' =>'15',
							'libelle_materiel' =>'EPROUVETTE 100 ML',
						]);
		DB::table('materiels')->insert([
							'id' =>'229',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PHOSPHORE',
						]);
		DB::table('materiels')->insert([
							'id' =>'230',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'ALBUMINE - BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'231',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'AMIKACINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'232',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'CEFTRIAXONE',
						]);
		DB::table('materiels')->insert([
							'id' =>'233',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'PSA LIBRE- DIAG AUTO',
						]);
		DB::table('materiels')->insert([
							'id' =>'234',
							'id_type_materiel' =>'13',
							'libelle_materiel' =>'BETA 2 MICROGLOBULIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'235',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'TUBES A VIS',
						]);
		DB::table('materiels')->insert([
							'id' =>'236',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'CRP BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'237',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'ALPHA AMYLASE BIOLAB',
						]);
		DB::table('materiels')->insert([
							'id' =>'238',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'HSV 1/2 IGM AUTO DIA',
						]);
		DB::table('materiels')->insert([
							'id' =>'239',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'HSV 1/2 IGG AUTO DIA',
						]);
		DB::table('materiels')->insert([
							'id' =>'240',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'RUBAN EPSON',
						]);
		DB::table('materiels')->insert([
							'id' =>'242',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'CLOTRIMAZOLE',
						]);
		DB::table('materiels')->insert([
							'id' =>'181',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'HIV - DIAG-AUTO',
						]);
		DB::table('materiels')->insert([
							'id' =>'243',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'AMPHOTHERICIN B',
						]);
		DB::table('materiels')->insert([
							'id' =>'244',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'METRONIDAZOLE',
						]);
		DB::table('materiels')->insert([
							'id' =>'245',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'KETOCONAZOLE',
						]);
		DB::table('materiels')->insert([
							'id' =>'246',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'FLUCYTOSINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'247',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'NYSTATINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'248',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'MICONAZOLE',
						]);
		DB::table('materiels')->insert([
							'id' =>'249',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'FLUCONAZOLE',
						]);
		DB::table('materiels')->insert([
							'id' =>'250',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'ITRACONAZOLE',
						]);
		DB::table('materiels')->insert([
							'id' =>'251',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'GRISEOFULVINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'252',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'ECONAZOLE',
						]);
		DB::table('materiels')->insert([
							'id' =>'253',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'COMBI 10',
						]);
		DB::table('materiels')->insert([
							'id' =>'254',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'DISQUES',
						]);
		DB::table('materiels')->insert([
							'id' =>'255',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'COMBI 3',
						]);
		DB::table('materiels')->insert([
							'id' =>'256',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'AG HBS ELISA',
						]);
		DB::table('materiels')->insert([
							'id' =>'241',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PROT LCR CYPRESS',
						]);
		DB::table('materiels')->insert([
							'id' =>'258',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'ANTI GLOBULIN HUMAIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'259',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'L.I.S.S.',
						]);
		DB::table('materiels')->insert([
							'id' =>'260',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'TESTOSTERONE',
						]);
		DB::table('materiels')->insert([
							'id' =>'261',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'MICROALBUMIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'262',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'LEVOFLOXACINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'257',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'MYCOPLASME',
						]);
		DB::table('materiels')->insert([
							'id' =>'264',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'NOXIFLOXACINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'265',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'GATIFLOXACINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'266',
							'id_type_materiel' =>'10',
							'libelle_materiel' =>'LDC AGAR',
						]);
		DB::table('materiels')->insert([
							'id' =>'267',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'NOVOBIOCINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'268',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'ACIDE FUSIDIQUE',
						]);
		DB::table('materiels')->insert([
							'id' =>'269',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'TAMPON ELECTRO HB',
						]);
		DB::table('materiels')->insert([
							'id' =>'270',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'TAMPON ELECTRO PROT',
						]);
		DB::table('materiels')->insert([
							'id' =>'271',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'CONTROLE N BIOCHIMIE',
						]);
		DB::table('materiels')->insert([
							'id' =>'272',
							'id_type_materiel' =>'15',
							'libelle_materiel' =>'EPROUVETTE 500 ML',
						]);
		DB::table('materiels')->insert([
							'id' =>'273',
							'id_type_materiel' =>'15',
							'libelle_materiel' =>'EPROUVETTE 1000 ML',
						]);
		DB::table('materiels')->insert([
							'id' =>'274',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PH - METRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'275',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'FSH  ELISA',
						]);
		DB::table('materiels')->insert([
							'id' =>'276',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'LH  ELISA',
						]);
		DB::table('materiels')->insert([
							'id' =>'277',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'MASQUES FACIAL',
						]);
		DB::table('materiels')->insert([
							'id' =>'278',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'PISSETTES 250 ML',
						]);
		DB::table('materiels')->insert([
							'id' =>'279',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'PISSETTES 500 ML',
						]);
		DB::table('materiels')->insert([
							'id' =>'280',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'CORPS VACUTAINER',
						]);
		DB::table('materiels')->insert([
							'id' =>'281',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'CYTOBROSSE',
						]);
		DB::table('materiels')->insert([
							'id' =>'282',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'BILIRUBINE T/D',
						]);
		DB::table('materiels')->insert([
							'id' =>'283',
							'id_type_materiel' =>'11',
							'libelle_materiel' =>'ACIDE HCL 1 L',
						]);
		DB::table('materiels')->insert([
							'id' =>'284',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'MOXIFLOXACIN 5 µG',
						]);
		DB::table('materiels')->insert([
							'id' =>'285',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'LOMEFLOXACIN 10 µG',
						]);
		DB::table('materiels')->insert([
							'id' =>'286',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'COMPTES GOUTTES',
						]);
		DB::table('materiels')->insert([
							'id' =>'287',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'PIPETTES PLASTIQUES',
						]);
		DB::table('materiels')->insert([
							'id' =>'288',
							'id_type_materiel' =>'10',
							'libelle_materiel' =>'MANNITOL SALT AGAR',
						]);
		DB::table('materiels')->insert([
							'id' =>'289',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'BEC BENSEN',
						]);
		DB::table('materiels')->insert([
							'id' =>'290',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'OEUSE',
						]);
		DB::table('materiels')->insert([
							'id' =>'291',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'API 20 E',
						]);
		DB::table('materiels')->insert([
							'id' =>'292',
							'id_type_materiel' =>'15',
							'libelle_materiel' =>'BALON FOND PLAT 500',
						]);
		DB::table('materiels')->insert([
							'id' =>'293',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'BALANCE DE PRECISION',
						]);
		DB::table('materiels')->insert([
							'id' =>'294',
							'id_type_materiel' =>'15',
							'libelle_materiel' =>'BECHER 1000 ML',
						]);
		DB::table('materiels')->insert([
							'id' =>'295',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'SUPLEMENT CHLORAMP',
						]);
		DB::table('materiels')->insert([
							'id' =>'296',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'EAU PHYSIOLOGIQUE',
						]);
		DB::table('materiels')->insert([
							'id' =>'297',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'ANSE DE PLATINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'298',
							'id_type_materiel' =>'15',
							'libelle_materiel' =>'TUBES CONIQUES',
						]);
		DB::table('materiels')->insert([
							'id' =>'299',
							'id_type_materiel' =>'11',
							'libelle_materiel' =>'BLEU DE METHYLENE',
						]);
		DB::table('materiels')->insert([
							'id' =>'300',
							'id_type_materiel' =>'11',
							'libelle_materiel' =>'SU',
						]);
		DB::table('materiels')->insert([
							'id' =>'303',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'CRYOTUBES',
						]);
		DB::table('materiels')->insert([
							'id' =>'304',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'G-6-PDH',
						]);
		DB::table('materiels')->insert([
							'id' =>'305',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'AMOXICILIN+ACIDE CL',
						]);
		DB::table('materiels')->insert([
							'id' =>'306',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'RELICATS',
						]);
		DB::table('materiels')->insert([
							'id' =>'307',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'SERO-SCHISTO',
						]);
		DB::table('materiels')->insert([
							'id' =>'308',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'SERO-AMI',
						]);
		DB::table('materiels')->insert([
							'id' =>'309',
							'id_type_materiel' =>'17',
							'libelle_materiel' =>'CD4 KIT PARTEC',
						]);
		DB::table('materiels')->insert([
							'id' =>'310',
							'id_type_materiel' =>'17',
							'libelle_materiel' =>'CD8 KIT PARTEC',
						]);
		DB::table('materiels')->insert([
							'id' =>'311',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'SANG OCCULT KIT',
						]);
		DB::table('materiels')->insert([
							'id' =>'312',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'EAU DISTILLÉE 20 L',
						]);
		DB::table('materiels')->insert([
							'id' =>'313',
							'id_type_materiel' =>'17',
							'libelle_materiel' =>'SOLUTION DE FLUX 5 L',
						]);
		DB::table('materiels')->insert([
							'id' =>'314',
							'id_type_materiel' =>'18',
							'libelle_materiel' =>'CONSOMMATION ELECTRI',
						]);
		DB::table('materiels')->insert([
							'id' =>'315',
							'id_type_materiel' =>'18',
							'libelle_materiel' =>'CONSOMMATION EAU',
						]);
		DB::table('materiels')->insert([
							'id' =>'316',
							'id_type_materiel' =>'18',
							'libelle_materiel' =>'CONSOMMATION TELEPHO',
						]);
		DB::table('materiels')->insert([
							'id' =>'335',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'RAME DE PAPIER A4',
						]);
		DB::table('materiels')->insert([
							'id' =>'336',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'CRYOMARQUEURS CD/DVD',
						]);
		DB::table('materiels')->insert([
							'id' =>'317',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'ENCRE IMPRIMANTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'318',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'POCHES À URINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'337',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'PIPERACILLIN+TAZOBAC',
						]);
		DB::table('materiels')->insert([
							'id' =>'338',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'TICARCILLIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'319',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'STYLO',
						]);
		DB::table('materiels')->insert([
							'id' =>'320',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'CRAYON',
						]);
		DB::table('materiels')->insert([
							'id' =>'321',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'CHEMISE CARTONNEE',
						]);
		DB::table('materiels')->insert([
							'id' =>'322',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'SOUS-CHEMISE',
						]);
		DB::table('materiels')->insert([
							'id' =>'323',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'PAPIER LISTING',
						]);
		DB::table('materiels')->insert([
							'id' =>'324',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'ENVELOPPE',
						]);
		DB::table('materiels')->insert([
							'id' =>'325',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'POS-IT',
						]);
		DB::table('materiels')->insert([
							'id' =>'326',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'PAPIER ENTETE',
						]);
		DB::table('materiels')->insert([
							'id' =>'327',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'BULLETIN EXAMEN',
						]);
		DB::table('materiels')->insert([
							'id' =>'328',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'DEMANDE EXMEN',
						]);
		DB::table('materiels')->insert([
							'id' =>'329',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'TROMBONNE',
						]);
		DB::table('materiels')->insert([
							'id' =>'330',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'GOMME',
						]);
		DB::table('materiels')->insert([
							'id' =>'331',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'SCOTCH',
						]);
		DB::table('materiels')->insert([
							'id' =>'332',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'CHRONO',
						]);
		DB::table('materiels')->insert([
							'id' =>'333',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'REGISTRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'334',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'CLE USB',
						]);
		DB::table('materiels')->insert([
							'id' =>'339',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'HSV G 1&amp;2 ELIFA',
						]);
		DB::table('materiels')->insert([
							'id' =>'340',
							'id_type_materiel' =>'14',
							'libelle_materiel' =>'D-DIMER RELLIA',
						]);
		DB::table('materiels')->insert([
							'id' =>'341',
							'id_type_materiel' =>'14',
							'libelle_materiel' =>'TROPONINE I RELLIA',
						]);
		DB::table('materiels')->insert([
							'id' =>'343',
							'id_type_materiel' =>'24',
							'libelle_materiel' =>'FRAIS GARDIENNAGE',
						]);
		DB::table('materiels')->insert([
							'id' =>'344',
							'id_type_materiel' =>'24',
							'libelle_materiel' =>'FRAIS EXPERTISE',
						]);
		DB::table('materiels')->insert([
							'id' =>'345',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'CARNET ORDRE PAIEMEN',
						]);
		DB::table('materiels')->insert([
							'id' =>'346',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'RUBEOLE CASSETTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'347',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'TOXO CASSETTES',
						]);
		DB::table('materiels')->insert([
							'id' =>'348',
							'id_type_materiel' =>'18',
							'libelle_materiel' =>'FACTURE CERBA',
						]);
		DB::table('materiels')->insert([
							'id' =>'349',
							'id_type_materiel' =>'24',
							'libelle_materiel' =>'PRESTATIONS',
						]);
		DB::table('materiels')->insert([
							'id' =>'350',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'CERDOS',
						]);
		DB::table('materiels')->insert([
							'id' =>'351',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'PAPIERS COUVERTURES',
						]);
		DB::table('materiels')->insert([
							'id' =>'352',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'TRANSPARENTS',
						]);
		DB::table('materiels')->insert([
							'id' =>'353',
							'id_type_materiel' =>'24',
							'libelle_materiel' =>'FLYERS',
						]);
		DB::table('materiels')->insert([
							'id' =>'354',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'PAPIERS TOILES',
						]);
		DB::table('materiels')->insert([
							'id' =>'355',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'OTE AGRAFES',
						]);
		DB::table('materiels')->insert([
							'id' =>'358',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'TENSIOMETRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'356',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'BLOCS NOTES EPHEMERI',
						]);
		DB::table('materiels')->insert([
							'id' =>'357',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'BATTERIE HP 620',
						]);
		DB::table('materiels')->insert([
							'id' =>'359',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'PESE PERSONNE 130 KG',
						]);
		DB::table('materiels')->insert([
							'id' =>'360',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'AGRAPHEUSE',
						]);
		DB::table('materiels')->insert([
							'id' =>'361',
							'id_type_materiel' =>'24',
							'libelle_materiel' =>'CALENDRIERS DE POCHE',
						]);
		DB::table('materiels')->insert([
							'id' =>'362',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'BADGES',
						]);
		DB::table('materiels')->insert([
							'id' =>'363',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'STREPTOMYCINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'364',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'AMOXICILLINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'365',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'OLEANDOMYCINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'366',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'IGE SPECIFIQUES',
						]);
		DB::table('materiels')->insert([
							'id' =>'367',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'BANDES ACETATE CELLU',
						]);
		DB::table('materiels')->insert([
							'id' =>'368',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'MICROPIPET 20-200 µL',
						]);
		DB::table('materiels')->insert([
							'id' =>'369',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'ANTIBIOTIQUES',
						]);
		DB::table('materiels')->insert([
							'id' =>'370',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'ANTIFONGIQUES',
						]);
		DB::table('materiels')->insert([
							'id' =>'371',
							'id_type_materiel' =>'11',
							'libelle_materiel' =>'GIEMSA RAPIDE',
						]);
		DB::table('materiels')->insert([
							'id' =>'372',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'BADGES + CORDES',
						]);
		DB::table('materiels')->insert([
							'id' =>'373',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'ONDULEURS',
						]);
		DB::table('materiels')->insert([
							'id' =>'374',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'BATTERIE ONDULEUR',
						]);
		DB::table('materiels')->insert([
							'id' =>'375',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'ACITAR 500 ML',
						]);
		DB::table('materiels')->insert([
							'id' =>'376',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'STERIMAX 500 ML',
						]);
		DB::table('materiels')->insert([
							'id' =>'377',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'CORRECTEURS',
						]);
		DB::table('materiels')->insert([
							'id' =>'378',
							'id_type_materiel' =>'19',
							'libelle_materiel' =>'BICS',
						]);
		DB::table('materiels')->insert([
							'id' =>'379',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'BOITES ALIMENTATION',
						]);
		DB::table('materiels')->insert([
							'id' =>'380',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'CARTES GSRH',
						]);
		DB::table('materiels')->insert([
							'id' =>'381',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'FREE PSA VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'382',
							'id_type_materiel' =>'31',
							'libelle_materiel' =>'NYCOCARD',
						]);
		DB::table('materiels')->insert([
							'id' =>'383',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'PORTE CACHETS',
						]);
		DB::table('materiels')->insert([
							'id' =>'386',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'TSH3  VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'384',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'OESTRADIOL VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'385',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'PROGESTÉRONE VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'387',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'LH VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'388',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'FSH VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'389',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'PROLACTINE VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'390',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'TSH VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'391',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'T3 VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'392',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'T4 VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'393',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'PSA TOTAL VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'394',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'HSV 1 G-M CASSETTES',
						]);
		DB::table('materiels')->insert([
							'id' =>'395',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'HSV 2 G-M CASSETTES',
						]);
		DB::table('materiels')->insert([
							'id' =>'396',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'CMV G-M CASSETTES',
						]);
		DB::table('materiels')->insert([
							'id' =>'397',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'BETA - HCG VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'398',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'CABLE USB',
						]);
		DB::table('materiels')->insert([
							'id' =>'399',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'TUBES EPPENDORF',
						]);
		DB::table('materiels')->insert([
							'id' =>'400',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'CARTES DE VISITE',
						]);
		DB::table('materiels')->insert([
							'id' =>'401',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'POTASSIUM',
						]);
		DB::table('materiels')->insert([
							'id' =>'402',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'CHLORE',
						]);
		DB::table('materiels')->insert([
							'id' =>'403',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'SODIUM',
						]);
		DB::table('materiels')->insert([
							'id' =>'404',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'COLLE',
						]);
		DB::table('materiels')->insert([
							'id' =>'405',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'CK - MB RAPID',
						]);
		DB::table('materiels')->insert([
							'id' =>'406',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PANEL CARDIAQUE',
						]);
		DB::table('materiels')->insert([
							'id' =>'407',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'TSH - RAPID',
						]);
		DB::table('materiels')->insert([
							'id' =>'409',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'SMS AUX PATIENTS',
						]);
		DB::table('materiels')->insert([
							'id' =>'408',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'CALCULATRICE',
						]);
		DB::table('materiels')->insert([
							'id' =>'410',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'CONTROLE P BIOCHIMIE',
						]);
		DB::table('materiels')->insert([
							'id' =>'411',
							'id_type_materiel' =>'15',
							'libelle_materiel' =>'CELLULE DE MALLASSEZ',
						]);
		DB::table('materiels')->insert([
							'id' =>'412',
							'id_type_materiel' =>'15',
							'libelle_materiel' =>'CELLULE DE NEUBAUER',
						]);
		DB::table('materiels')->insert([
							'id' =>'413',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'PUBLICITE SMS',
						]);
		DB::table('materiels')->insert([
							'id' =>'414',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'SUPPORT',
						]);
		DB::table('materiels')->insert([
							'id' =>'415',
							'id_type_materiel' =>'15',
							'libelle_materiel' =>'BALON FOND ROND 500',
						]);
		DB::table('materiels')->insert([
							'id' =>'417',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'VANCOMYCIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'416',
							'id_type_materiel' =>'15',
							'libelle_materiel' =>'BECHER 500 ML',
						]);
		DB::table('materiels')->insert([
							'id' =>'418',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'IMPRIMANTES',
						]);
		DB::table('materiels')->insert([
							'id' =>'419',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'PORTES DOCUMENTS',
						]);
		DB::table('materiels')->insert([
							'id' =>'420',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'ANTI - E',
						]);
		DB::table('materiels')->insert([
							'id' =>'421',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'ANTI - PETIT E',
						]);
		DB::table('materiels')->insert([
							'id' =>'422',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'ANTI - C',
						]);
		DB::table('materiels')->insert([
							'id' =>'423',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'ANTI - PETIT C',
						]);
		DB::table('materiels')->insert([
							'id' =>'424',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'ANTI - K',
						]);
		DB::table('materiels')->insert([
							'id' =>'425',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'SUPPORT MICROPIPETTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'426',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'CHLAMY G CASSETTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'427',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'CHLAMY M CASSETTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'428',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'SEROTUBERCULOSE SD',
						]);
		DB::table('materiels')->insert([
							'id' =>'429',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'ORDINATEUR DE BUREAU',
						]);
		DB::table('materiels')->insert([
							'id' =>'430',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'AG SOLUBLES',
						]);
		DB::table('materiels')->insert([
							'id' =>'431',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'SUPPLEMENT ANC',
						]);
		DB::table('materiels')->insert([
							'id' =>'432',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'CONNECEUR RESEAU',
						]);
		DB::table('materiels')->insert([
							'id' =>'434',
							'id_type_materiel' =>'9',
							'libelle_materiel' =>'FIBRINOGENE',
						]);
		DB::table('materiels')->insert([
							'id' =>'433',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'TESTOSTERONE VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'435',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'CHLAMY (IGA)',
						]);
		DB::table('materiels')->insert([
							'id' =>'436',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'PAPIER THERMIQUE 110',
						]);
		DB::table('materiels')->insert([
							'id' =>'437',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'CA 15 - 3  VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'438',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'CA 125  VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'439',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'CA 19 - 9  VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'440',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'REACTIFS API 20 E',
						]);
		DB::table('materiels')->insert([
							'id' =>'441',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'PLATEAU RECTANG',
						]);
		DB::table('materiels')->insert([
							'id' =>'442',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'HARICOTS',
						]);
		DB::table('materiels')->insert([
							'id' =>'443',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'DRAP USAGE UNIQUE',
						]);
		DB::table('materiels')->insert([
							'id' =>'444',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'EAU STÉRILE',
						]);
		DB::table('materiels')->insert([
							'id' =>'445',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'TUYAUTERIE BIOCHIMIE',
						]);
		DB::table('materiels')->insert([
							'id' =>'446',
							'id_type_materiel' =>'33',
							'libelle_materiel' =>'COMPTEUR CD4 PIMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'455',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'DOXYCYCLINE B/50',
						]);
		DB::table('materiels')->insert([
							'id' =>'447',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'CENTRIFUGEUSE HV TGL',
						]);
		DB::table('materiels')->insert([
							'id' =>'448',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'INCUBATEUR DNP 9052',
						]);
		DB::table('materiels')->insert([
							'id' =>'449',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'MICROSCOPE HNB',
						]);
		DB::table('materiels')->insert([
							'id' =>'450',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'STERILISATEUR SECHE',
						]);
		DB::table('materiels')->insert([
							'id' =>'451',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'BAIN MARIE DK 420',
						]);
		DB::table('materiels')->insert([
							'id' =>'452',
							'id_type_materiel' =>'33',
							'libelle_materiel' =>'LECTEUR ELISA MINDRA',
						]);
		DB::table('materiels')->insert([
							'id' =>'453',
							'id_type_materiel' =>'33',
							'libelle_materiel' =>'LAVEUR ELISA MINDRAY',
						]);
		DB::table('materiels')->insert([
							'id' =>'454',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'TABLE GYNECOLOGIQUE',
						]);
		DB::table('materiels')->insert([
							'id' =>'456',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'AZYTHROMICINE B/50',
						]);
		DB::table('materiels')->insert([
							'id' =>'457',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'ROUTEUR ADSL',
						]);
		DB::table('materiels')->insert([
							'id' =>'458',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'CONNECTEURS',
						]);
		DB::table('materiels')->insert([
							'id' =>'459',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'MANCHON',
						]);
		DB::table('materiels')->insert([
							'id' =>'460',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'SURGE PROTECTOR',
						]);
		DB::table('materiels')->insert([
							'id' =>'461',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'ENTETE LETTRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'462',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'CLAVIER',
						]);
		DB::table('materiels')->insert([
							'id' =>'463',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'HCG I-CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'464',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'CRP I-CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'465',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'HBA1C I-CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'466',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'CTRL CRP I-CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'467',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'CTRL HBA1C I-CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'468',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'CTRL MULTIP I-CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'470',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'CHOLT - C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'469',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'ENTETE LETTRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'471',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'HBA1C2 - C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'472',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'HBA1CD2 - C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'473',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'PRÉCI.PATHPROT C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'474',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'PRÉCI.CTRLPATH HBA1C',
						]);
		DB::table('materiels')->insert([
							'id' =>'475',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'CRPLX  - C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'476',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'HDL  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'477',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'ISE REF SOL - C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'478',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'ISE CAL IND/URI C111',
						]);
		DB::table('materiels')->insert([
							'id' =>'479',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'GOT  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'480',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'GPT  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'481',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'GLUC  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'482',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'LDL-C  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'483',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'UREE  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'484',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'CREAT 2  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'485',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'CFAS LIPID - C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'486',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'PRÉCI.PATHLIPID C111',
						]);
		DB::table('materiels')->insert([
							'id' =>'487',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'PRÉCI.NORMPROT C111',
						]);
		DB::table('materiels')->insert([
							'id' =>'488',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'MG  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'489',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'PHOSP  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'490',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'ACID URIC  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'491',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'BIL T  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'492',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'BIL  D  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'493',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'GGT2  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'494',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'PRÉCI.CTRLNORM HBA1C',
						]);
		DB::table('materiels')->insert([
							'id' =>'495',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'CFAS HBA1C  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'496',
							'id_type_materiel' =>'10',
							'libelle_materiel' =>'SABOURAUD + CHLORAMP',
						]);
		DB::table('materiels')->insert([
							'id' =>'497',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'AGENDA',
						]);
		DB::table('materiels')->insert([
							'id' =>'498',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'PAL  -  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'499',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'ACHAT GROUPE ELECTRO',
						]);
		DB::table('materiels')->insert([
							'id' =>'500',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'MICROCUVETTES',
						]);
		DB::table('materiels')->insert([
							'id' =>'501',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'CFAS PROTEINS C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'502',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'CALENDRIERS MURAUX',
						]);
		DB::table('materiels')->insert([
							'id' =>'503',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'CK MB - C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'504',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'AIGUIL + ADAP + PROT',
						]);
		DB::table('materiels')->insert([
							'id' =>'507',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'PROT-TOTAL C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'506',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'ALB2 - C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'505',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'TUBES BSG (VS)',
						]);
		DB::table('materiels')->insert([
							'id' =>'508',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'HCG PRO  I-CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'509',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'CLEANER COBAS C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'510',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'ECRAN ORDINATEUR',
						]);
		DB::table('materiels')->insert([
							'id' =>'515',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'DISQUES  ATB',
						]);
		DB::table('materiels')->insert([
							'id' =>'521',
							'id_type_materiel' =>'33',
							'libelle_materiel' =>'SPECTROPHOTOMÈTRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'511',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'ISE DEPROTEINIZER',
						]);
		DB::table('materiels')->insert([
							'id' =>'512',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'ISE ETCHER',
						]);
		DB::table('materiels')->insert([
							'id' =>'513',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'ACTIVATOR',
						]);
		DB::table('materiels')->insert([
							'id' =>'514',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'ISE CALIBRATION KIT',
						]);
		DB::table('materiels')->insert([
							'id' =>'516',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'DISQUES  ATF',
						]);
		DB::table('materiels')->insert([
							'id' =>'517',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'CTRL CRP  I-CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'518',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'REGLES',
						]);
		DB::table('materiels')->insert([
							'id' =>'519',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'CFAS CK - MB C111',
						]);
		DB::table('materiels')->insert([
							'id' =>'520',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'REPARATION ORDINATEU',
						]);
		DB::table('materiels')->insert([
							'id' =>'522',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'BOCAL POUR URINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'523',
							'id_type_materiel' =>'33',
							'libelle_materiel' =>'IONOMÈTRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'524',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'GAZ + DETENDEUR',
						]);
		DB::table('materiels')->insert([
							'id' =>'525',
							'id_type_materiel' =>'33',
							'libelle_materiel' =>'COAGULOMÈTRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'526',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'AGITATEUR',
						]);
		DB::table('materiels')->insert([
							'id' =>'527',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'VORTEX',
						]);
		DB::table('materiels')->insert([
							'id' =>'528',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'HOMOGÉNÉISATEUR',
						]);
		DB::table('materiels')->insert([
							'id' =>'529',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'AUTOCLAVE',
						]);
		DB::table('materiels')->insert([
							'id' =>'530',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'REFRIGERATEUR',
						]);
		DB::table('materiels')->insert([
							'id' =>'531',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'CONGELATEUR',
						]);
		DB::table('materiels')->insert([
							'id' =>'532',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'TRIGY - C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'533',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'CALENDRIERS CHEVALET',
						]);
		DB::table('materiels')->insert([
							'id' =>'535',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'ACE I-CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'536',
							'id_type_materiel' =>'44',
							'libelle_materiel' =>'DILUANT URIT 5250',
						]);
		DB::table('materiels')->insert([
							'id' =>'534',
							'id_type_materiel' =>'33',
							'libelle_materiel' =>'COMPTEUR HEMATO',
						]);
		DB::table('materiels')->insert([
							'id' =>'537',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'TYPHOID CASSETTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'538',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'HOMOGENEISATEUR',
						]);
		DB::table('materiels')->insert([
							'id' =>'539',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'HS CRP I - CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'540',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'FSH I - CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'541',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'CARTE RESEAU',
						]);
		DB::table('materiels')->insert([
							'id' =>'542',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'ACHBC',
						]);
		DB::table('materiels')->insert([
							'id' =>'543',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'CA  C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'263',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'SPARFLOXACINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'544',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'D-DIMERES I-CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'545',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'TESTO I-CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'546',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'CRTL UNIVERSELLE',
						]);
		DB::table('materiels')->insert([
							'id' =>'547',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'TSH I - CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'548',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'T4 I - CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'549',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'LH I - CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'550',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'AFP I - CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'551',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'CKL - C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'552',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'BOITE ARCHIVES',
						]);
		DB::table('materiels')->insert([
							'id' =>'553',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'PCCC 1 - C111',
						]);
		DB::table('materiels')->insert([
							'id' =>'554',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'CFAS C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'555',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'PAPIER CARTON',
						]);
		DB::table('materiels')->insert([
							'id' =>'556',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'PCCC 2 - C111',
						]);
		DB::table('materiels')->insert([
							'id' =>'557',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'CARBONNES',
						]);
		DB::table('materiels')->insert([
							'id' =>'558',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'PROLACTINE I-CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'559',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'NORFLOXACINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'560',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'EAU DISTILLÉ 30 L',
						]);
		DB::table('materiels')->insert([
							'id' =>'561',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'RUBAN EPSON',
						]);
		DB::table('materiels')->insert([
							'id' =>'562',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'BETADINE 200 ML',
						]);
		DB::table('materiels')->insert([
							'id' =>'563',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'PARACETAMOL',
						]);
		DB::table('materiels')->insert([
							'id' =>'564',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'DILUANT BIOLYTE 2000',
						]);
		DB::table('materiels')->insert([
							'id' =>'565',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'ROUGE PONCEAU',
						]);
		DB::table('materiels')->insert([
							'id' =>'576',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'AC HCV ELISA',
						]);
		DB::table('materiels')->insert([
							'id' =>'567',
							'id_type_materiel' =>'33',
							'libelle_materiel' =>'MAINTENANCE',
						]);
		DB::table('materiels')->insert([
							'id' =>'568',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'TPHA CYPRESS',
						]);
		DB::table('materiels')->insert([
							'id' =>'569',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'ENCREUR',
						]);
		DB::table('materiels')->insert([
							'id' =>'570',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'ENCRE RECHARGE',
						]);
		DB::table('materiels')->insert([
							'id' =>'571',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'MULTIDISK',
						]);
		DB::table('materiels')->insert([
							'id' =>'572',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'FER SERIQUE - C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'573',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'PSA T  I - CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'574',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'LAMPE ALLOGENE',
						]);
		DB::table('materiels')->insert([
							'id' =>'575',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'APPAREIL PHOTO',
						]);
		DB::table('materiels')->insert([
							'id' =>'577',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'MINICOLLECT 1ML EDTA',
						]);
		DB::table('materiels')->insert([
							'id' =>'578',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'AGHBS RAPIDE',
						]);
		DB::table('materiels')->insert([
							'id' =>'579',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'LDH - C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'580',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'SPIRAMYCINE 100 µG',
						]);
		DB::table('materiels')->insert([
							'id' =>'581',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PROBE CLEANER URIT',
						]);
		DB::table('materiels')->insert([
							'id' =>'582',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'SERINGUE A INSULINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'583',
							'id_type_materiel' =>'26',
							'libelle_materiel' =>'IGE TOTAL VIDAS',
						]);
		DB::table('materiels')->insert([
							'id' =>'584',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'MINICOLLECT 1ML COAG',
						]);
		DB::table('materiels')->insert([
							'id' =>'585',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'VACUETTE 1ML 3.8% CO',
						]);
		DB::table('materiels')->insert([
							'id' =>'586',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'REGISTRE 900 P',
						]);
		DB::table('materiels')->insert([
							'id' =>'587',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'LINCOMYCINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'588',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'TRANSPARISANT',
						]);
		DB::table('materiels')->insert([
							'id' =>'589',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'DECOLO ROUGE PONCEAU',
						]);
		DB::table('materiels')->insert([
							'id' =>'590',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'OXACILLINE 5 µG',
						]);
		DB::table('materiels')->insert([
							'id' =>'591',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'TRIMETHO/SULPHA',
						]);
		DB::table('materiels')->insert([
							'id' =>'592',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'CEFOXITINE 30 µG',
						]);
		DB::table('materiels')->insert([
							'id' =>'593',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'COLISTINE 10 µG',
						]);
		DB::table('materiels')->insert([
							'id' =>'594',
							'id_type_materiel' =>'33',
							'libelle_materiel' =>'ANALYSEUR PIMA CD4+',
						]);
		DB::table('materiels')->insert([
							'id' =>'595',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'TAPIS SOURIS',
						]);
		DB::table('materiels')->insert([
							'id' =>'596',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'STAPHYPENE',
						]);
		DB::table('materiels')->insert([
							'id' =>'597',
							'id_type_materiel' =>'38',
							'libelle_materiel' =>'AFP - EASY READER',
						]);
		DB::table('materiels')->insert([
							'id' =>'598',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'BOITE MEDICALE',
						]);
		DB::table('materiels')->insert([
							'id' =>'599',
							'id_type_materiel' =>'38',
							'libelle_materiel' =>'FSH EASY READER',
						]);
		DB::table('materiels')->insert([
							'id' =>'600',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'ENVELOPPE A4',
						]);
		DB::table('materiels')->insert([
							'id' =>'601',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'MICROPLAQUE TITRATIO',
						]);
		DB::table('materiels')->insert([
							'id' =>'602',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'SOL HÉMOLYSANTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'628',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'POUBELLES A 1.5 L',
						]);
		DB::table('materiels')->insert([
							'id' =>'603',
							'id_type_materiel' =>'37',
							'libelle_materiel' =>'CD4 + PIMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'604',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'MYOGLOBINE CASSETTES',
						]);
		DB::table('materiels')->insert([
							'id' =>'605',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'TROPONINE I-CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'606',
							'id_type_materiel' =>'38',
							'libelle_materiel' =>'PSA T - EASY READER',
						]);
		DB::table('materiels')->insert([
							'id' =>'607',
							'id_type_materiel' =>'38',
							'libelle_materiel' =>'LH EASY READER',
						]);
		DB::table('materiels')->insert([
							'id' =>'608',
							'id_type_materiel' =>'38',
							'libelle_materiel' =>'PRL  EASY READER',
						]);
		DB::table('materiels')->insert([
							'id' =>'609',
							'id_type_materiel' =>'38',
							'libelle_materiel' =>'CRP  EASY READER',
						]);
		DB::table('materiels')->insert([
							'id' =>'610',
							'id_type_materiel' =>'38',
							'libelle_materiel' =>'IGE - EASY READER',
						]);
		DB::table('materiels')->insert([
							'id' =>'611',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'CAHIERS 400 P',
						]);
		DB::table('materiels')->insert([
							'id' =>'612',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'REGISTRE 200 P',
						]);
		DB::table('materiels')->insert([
							'id' =>'613',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'ACHBE CASSETTES',
						]);
		DB::table('materiels')->insert([
							'id' =>'614',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'SAMPLE CUP',
						]);
		DB::table('materiels')->insert([
							'id' =>'615',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'ALPHA AMYLASE C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'616',
							'id_type_materiel' =>'10',
							'libelle_materiel' =>'CHAPMANN AGAR',
						]);
		DB::table('materiels')->insert([
							'id' =>'617',
							'id_type_materiel' =>'37',
							'libelle_materiel' =>'PAPIERS PIMA CD4',
						]);
		DB::table('materiels')->insert([
							'id' =>'618',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'DISQUES REACTIFS',
						]);
		DB::table('materiels')->insert([
							'id' =>'619',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'FORMOL 1L',
						]);
		DB::table('materiels')->insert([
							'id' =>'620',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'HIV  ELISA',
						]);
		DB::table('materiels')->insert([
							'id' =>'621',
							'id_type_materiel' =>'38',
							'libelle_materiel' =>'HCG - EASY READER',
						]);
		DB::table('materiels')->insert([
							'id' =>'622',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'POUBELLES A 3 L',
						]);
		DB::table('materiels')->insert([
							'id' =>'623',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'SPATULES/CYTOBROSSE',
						]);
		DB::table('materiels')->insert([
							'id' =>'566',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'CEFEPIME',
						]);
		DB::table('materiels')->insert([
							'id' =>'625',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'ELECTRODE K C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'626',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PSA T E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'627',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'LH E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'629',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PROGEST CAL SET E411',
						]);
		DB::table('materiels')->insert([
							'id' =>'630',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PROCELL E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'631',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'AIGUILLE ASPIRATION',
						]);
		DB::table('materiels')->insert([
							'id' =>'632',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'AC HCV E 441',
						]);
		DB::table('materiels')->insert([
							'id' =>'633',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'CA 15-3 CALSET E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'634',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'ELECTRODE NA C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'635',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'ELECTRODE CL C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'636',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PRECICTRL ACHCV E411',
						]);
		DB::table('materiels')->insert([
							'id' =>'637',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'FILS DE PLATINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'638',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'ACE E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'639',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'DILUANT MULTI',
						]);
		DB::table('materiels')->insert([
							'id' =>'640',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'DILUENT UNIVER E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'641',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'FSH E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'642',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PROGESTERONE E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'643',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'TOXO IGG E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'644',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'TOXO IGM E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'645',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'RUBEOLE IGG E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'646',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'FT4 E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'647',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'FT3 E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'648',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'HCG+B E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'649',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'OESTRADIOL E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'650',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'CA 125 E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'651',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'CA 19 - 9 E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'652',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'CA 15 - 3 E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'653',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PROLACTINE E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'654',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PRECICONTROL HIV 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'655',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PRECICONTROL HBS 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'656',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PRECICTRL TOXO G 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'657',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PRECICTRL RUB G 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'658',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PRECICTRL TOXO M 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'659',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PRL CAL SET E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'660',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'OESTRA CAL SET E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'661',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'LH CAL SET E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'662',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'CA 19-9 CAL SET E411',
						]);
		DB::table('materiels')->insert([
							'id' =>'663',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'CA 125 CAL SET E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'664',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'HCG+B CAL SET E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'665',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'FT3 CAL SET E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'666',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'FT4 CAL SET E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'667',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PSA T CAL SET E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'668',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'CLEAN CELL E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'669',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'SD MALARIA',
						]);
		DB::table('materiels')->insert([
							'id' =>'670',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'FREE PSA E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'671',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'FREE PSA CAL SET',
						]);
		DB::table('materiels')->insert([
							'id' =>'672',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'ASSAY TIP E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'673',
							'id_type_materiel' =>'40',
							'libelle_materiel' =>'GEL DESINFECTANT',
						]);
		DB::table('materiels')->insert([
							'id' =>'674',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'AGHBS E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'675',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'ACHBS E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'676',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'ACHBS PRÉCICTRL E411',
						]);
		DB::table('materiels')->insert([
							'id' =>'677',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'SYSWASH',
						]);
		DB::table('materiels')->insert([
							'id' =>'678',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'TESTO E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'679',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'IGE E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'680',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'TESTO CAL E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'681',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'IGE CAL E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'682',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'HSV IGG2 E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'683',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'ACE CAL SET E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'684',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'AFP E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'685',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'AFP CAL SET E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'686',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'CMV IGG E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'691',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'FOSFOMYCIN 200 µG',
						]);
		DB::table('materiels')->insert([
							'id' =>'687',
							'id_type_materiel' =>'11',
							'libelle_materiel' =>'ACIDE ACETIQUE',
						]);
		DB::table('materiels')->insert([
							'id' =>'688',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'HCG CASSETTE',
						]);
		DB::table('materiels')->insert([
							'id' =>'689',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'T3 E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'690',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PRECICTRL TUMOR E411',
						]);
		DB::table('materiels')->insert([
							'id' =>'692',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'HIV  E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'693',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'ENTRETIEN MATERIEL',
						]);
		DB::table('materiels')->insert([
							'id' =>'694',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'SNAPPACK AVL',
						]);
		DB::table('materiels')->insert([
							'id' =>'699',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'LAMES FIXATION BANDE',
						]);
		DB::table('materiels')->insert([
							'id' =>'695',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'FICHE ALIMENATION',
						]);
		DB::table('materiels')->insert([
							'id' =>'696',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'CHEMISE A SANGLE',
						]);
		DB::table('materiels')->insert([
							'id' =>'700',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'T3 CAL SET E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'697',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'AGHBE E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'698',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'POCHES À SANG 450 ML',
						]);
		DB::table('materiels')->insert([
							'id' =>'701',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'T4 E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'702',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'T4 CAL SET E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'703',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'ASSAY CUP E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'704',
							'id_type_materiel' =>'37',
							'libelle_materiel' =>'CTRL PIMA BEAD',
						]);
		DB::table('materiels')->insert([
							'id' =>'705',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'TSH E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'706',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'CEFPODOXIME',
						]);
		DB::table('materiels')->insert([
							'id' =>'707',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PRECICTRL AGHBE E411',
						]);
		DB::table('materiels')->insert([
							'id' =>'708',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PRECICTRL ACHBE E411',
						]);
		DB::table('materiels')->insert([
							'id' =>'709',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PRECICTRL ACHBC E411',
						]);
		DB::table('materiels')->insert([
							'id' =>'710',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PRECICTRL HBC IGM E',
						]);
		DB::table('materiels')->insert([
							'id' =>'711',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'COMMANDE SPECIALE',
						]);
		DB::table('materiels')->insert([
							'id' =>'712',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'ACHBE E411',
						]);
		DB::table('materiels')->insert([
							'id' =>'713',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'ACHBC E411',
						]);
		DB::table('materiels')->insert([
							'id' =>'714',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'ACHBC IGM E411',
						]);
		DB::table('materiels')->insert([
							'id' =>'715',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'ANTIVIRUS INTERNET',
						]);
		DB::table('materiels')->insert([
							'id' =>'716',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'INSTALLATION LOG',
						]);
		DB::table('materiels')->insert([
							'id' =>'717',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'ACHAV CASSETTES',
						]);
		DB::table('materiels')->insert([
							'id' =>'718',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'TSH CALSET E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'719',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'ISE CLEANING E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'720',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'CEFOTAXIM+ACID CLAVU',
						]);
		DB::table('materiels')->insert([
							'id' =>'721',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'ANTI HAV PRECICTRL',
						]);
		DB::table('materiels')->insert([
							'id' =>'734',
							'id_type_materiel' =>'5',
							'libelle_materiel' =>'SYPHILIS CASETTES',
						]);
		DB::table('materiels')->insert([
							'id' =>'722',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'LIPASE C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'723',
							'id_type_materiel' =>'11',
							'libelle_materiel' =>'ACIDE SULFURIQUE 1L',
						]);
		DB::table('materiels')->insert([
							'id' =>'724',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'TUBING SET C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'725',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'TEE SHIRT 1ER MAI',
						]);
		DB::table('materiels')->insert([
							'id' =>'726',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'GALERIE ANTIFONGIQUE',
						]);
		DB::table('materiels')->insert([
							'id' =>'727',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'ANTIGENES SOLUBLES',
						]);
		DB::table('materiels')->insert([
							'id' =>'728',
							'id_type_materiel' =>'40',
							'libelle_materiel' =>'DESINFECTANT SURFACE',
						]);
		DB::table('materiels')->insert([
							'id' =>'729',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'ANTI HAV E 411',
						]);
		DB::table('materiels')->insert([
							'id' =>'730',
							'id_type_materiel' =>'11',
							'libelle_materiel' =>'EAU DEMINERALISEE',
						]);
		DB::table('materiels')->insert([
							'id' =>'731',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'TONER HP 126',
						]);
		DB::table('materiels')->insert([
							'id' =>'733',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'PUMP TUBES C 111',
						]);
		DB::table('materiels')->insert([
							'id' =>'732',
							'id_type_materiel' =>'33',
							'libelle_materiel' =>'VEINSPY TULIP',
						]);
		DB::table('materiels')->insert([
							'id' =>'735',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'DRUG SCEENCARD',
						]);
		DB::table('materiels')->insert([
							'id' =>'742',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'CONFIGURATION ARRET',
						]);
		DB::table('materiels')->insert([
							'id' =>'738',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'ANTI  A',
						]);
		DB::table('materiels')->insert([
							'id' =>'736',
							'id_type_materiel' =>'33',
							'libelle_materiel' =>'LOYER TRIMESTRIEL',
						]);
		DB::table('materiels')->insert([
							'id' =>'737',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'AUTOMATE URIT 5250',
						]);
		DB::table('materiels')->insert([
							'id' =>'739',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'REPARATION IMPRIMANT',
						]);
		DB::table('materiels')->insert([
							'id' =>'743',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'CARTE RESEAU WIFI',
						]);
		DB::table('materiels')->insert([
							'id' =>'740',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'REGULATEUR DE TENSIO',
						]);
		DB::table('materiels')->insert([
							'id' =>'751',
							'id_type_materiel' =>'25',
							'libelle_materiel' =>'MARKER',
						]);
		DB::table('materiels')->insert([
							'id' =>'741',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'CARTE RESEAU  USB',
						]);
		DB::table('materiels')->insert([
							'id' =>'744',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'ANTIVIRUS KASPERSKY',
						]);
		DB::table('materiels')->insert([
							'id' =>'745',
							'id_type_materiel' =>'3',
							'libelle_materiel' =>'ELECTROPHORESE SEBI',
						]);
		DB::table('materiels')->insert([
							'id' =>'746',
							'id_type_materiel' =>'43',
							'libelle_materiel' =>'CLEANING AVL',
						]);
		DB::table('materiels')->insert([
							'id' =>'747',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'FAN 24 VDC ASSY MAIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'748',
							'id_type_materiel' =>'20',
							'libelle_materiel' =>'INTERVENTION MACHINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'749',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'ANTI  B',
						]);
		DB::table('materiels')->insert([
							'id' =>'750',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'ANTI  AB',
						]);
		DB::table('materiels')->insert([
							'id' =>'752',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'CEFALOTHIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'753',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'XYLENE',
						]);
		DB::table('materiels')->insert([
							'id' =>'755',
							'id_type_materiel' =>'44',
							'libelle_materiel' =>'DETERGENT URIT 5250',
						]);
		DB::table('materiels')->insert([
							'id' =>'754',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'XYLENE',
						]);
		DB::table('materiels')->insert([
							'id' =>'756',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'PLAQUE DE GROUPAGE',
						]);
		DB::table('materiels')->insert([
							'id' =>'757',
							'id_type_materiel' =>'35',
							'libelle_materiel' =>'T3 I CHROMA',
						]);
		DB::table('materiels')->insert([
							'id' =>'758',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'AMYLASE C111',
						]);
		DB::table('materiels')->insert([
							'id' =>'759',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PRECICONTROL CRP',
						]);
		DB::table('materiels')->insert([
							'id' =>'760',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PRECIPATH',
						]);
		DB::table('materiels')->insert([
							'id' =>'761',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PRECINORM PROTEIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'762',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PRECIPATH PROTEIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'763',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'T3 LIBRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'764',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'T4 LIBRE E411',
						]);
		DB::table('materiels')->insert([
							'id' =>'765',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'HIV COMBI PT',
						]);
		DB::table('materiels')->insert([
							'id' =>'766',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'CONTROLE AVL',
						]);
		DB::table('materiels')->insert([
							'id' =>'771',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'BOUILLON COEUR CER',
						]);
		DB::table('materiels')->insert([
							'id' =>'767',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'PAPIER IMP AVL',
						]);
		DB::table('materiels')->insert([
							'id' =>'768',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'NA ELECTRO CONDITIO',
						]);
		DB::table('materiels')->insert([
							'id' =>'769',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'DEPROTEINIZER',
						]);
		DB::table('materiels')->insert([
							'id' =>'770',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PC CONTROL UNIVERSEL',
						]);
		DB::table('materiels')->insert([
							'id' =>'772',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'ROXITHROMYCIN 30 UG',
						]);
		DB::table('materiels')->insert([
							'id' =>'773',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'CLINDAMYCIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'774',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'MINOCYCLINE',
						]);
		DB::table('materiels')->insert([
							'id' =>'775',
							'id_type_materiel' =>'44',
							'libelle_materiel' =>'LYSE URIT 5250',
						]);
		DB::table('materiels')->insert([
							'id' =>'776',
							'id_type_materiel' =>'44',
							'libelle_materiel' =>'SHEATER',
						]);
		DB::table('materiels')->insert([
							'id' =>'777',
							'id_type_materiel' =>'8',
							'libelle_materiel' =>'PRISTINAMICYCIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'778',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'FSH E411 CALSET',
						]);
		DB::table('materiels')->insert([
							'id' =>'779',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'T4 LIBRE CALSET',
						]);
		DB::table('materiels')->insert([
							'id' =>'780',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'T3 LIBRE CALSET',
						]);
		DB::table('materiels')->insert([
							'id' =>'781',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PRECICTRL UNIVERSEL',
						]);
		DB::table('materiels')->insert([
							'id' =>'785',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'NACL DILUANT',
						]);
		DB::table('materiels')->insert([
							'id' =>'782',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PRECICTRL UNIVERSEL',
						]);
		DB::table('materiels')->insert([
							'id' =>'786',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'CELLULES DE KOVACS',
						]);
		DB::table('materiels')->insert([
							'id' =>'783',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PRECI',
						]);
		DB::table('materiels')->insert([
							'id' =>'784',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PRECICTRL AGHBS',
						]);
		DB::table('materiels')->insert([
							'id' =>'787',
							'id_type_materiel' =>'39',
							'libelle_materiel' =>'PSA LIBRE CALSET',
						]);
		DB::table('materiels')->insert([
							'id' =>'788',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'PROTEINE US',
						]);
		DB::table('materiels')->insert([
							'id' =>'789',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'URINE 2 AC',
						]);
		DB::table('materiels')->insert([
							'id' =>'790',
							'id_type_materiel' =>'13',
							'libelle_materiel' =>'ANALYSES EXTERNES CE',
						]);
		DB::table('materiels')->insert([
							'id' =>'791',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'LIPASE BIOLABO',
						]);
		DB::table('materiels')->insert([
							'id' =>'792',
							'id_type_materiel' =>'1',
							'libelle_materiel' =>'CONTROL HEMATOLOGIQ',
						]);
		DB::table('materiels')->insert([
							'id' =>'793',
							'id_type_materiel' =>'4',
							'libelle_materiel' =>'CONTROL HEMATO',
						]);
		DB::table('materiels')->insert([
							'id' =>'794',
							'id_type_materiel' =>'11',
							'libelle_materiel' =>'BLEU DE CRESYL VIOL',
						]);
		DB::table('materiels')->insert([
							'id' =>'795',
							'id_type_materiel' =>'38',
							'libelle_materiel' =>'TSH EASY READER',
						]);
		DB::table('materiels')->insert([
							'id' =>'796',
							'id_type_materiel' =>'38',
							'libelle_materiel' =>'IGE T EASY READER',
						]);
		DB::table('materiels')->insert([
							'id' =>'797',
							'id_type_materiel' =>'38',
							'libelle_materiel' =>'PSA T EASY READER',
						]);
		DB::table('materiels')->insert([
							'id' =>'798',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'ACHBS ELISA',
						]);
		DB::table('materiels')->insert([
							'id' =>'799',
							'id_type_materiel' =>'6',
							'libelle_materiel' =>'AGHBE',
						]);
		DB::table('materiels')->insert([
							'id' =>'800',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'THERMOMETRE',
						]);
		DB::table('materiels')->insert([
							'id' =>'801',
							'id_type_materiel' =>'2',
							'libelle_materiel' =>'TUBERTEST',
						]);
		DB::table('materiels')->insert([
							'id' =>'802',
							'id_type_materiel' =>'12',
							'libelle_materiel' =>'DAKIN',
						]);
		DB::table('materiels')->insert([
							'id' =>'803',
							'id_type_materiel' =>'43',
							'libelle_materiel' =>'ISETROL',
						]);
		DB::table('materiels')->insert([
							'id' =>'804',
							'id_type_materiel' =>'43',
							'libelle_materiel' =>'CLEANING SOLUTION',
						]);
		DB::table('materiels')->insert([
							'id' =>'805',
							'id_type_materiel' =>'36',
							'libelle_materiel' =>'SODIUM ELECTRODE CON',
						]);
		DB::table('materiels')->insert([
							'id' =>'806',
							'id_type_materiel' =>'7',
							'libelle_materiel' =>'OFLOXACINE',
						]);


    }
}
