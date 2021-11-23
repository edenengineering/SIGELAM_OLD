<?php

use Illuminate\Database\Seeder;

class ConclusionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			   
		DB::table('conclusions')->insert([
									'libelle' => 'Pas d\'infection',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'CRP Positive',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'CRP Négative',
									]);

		DB::table('conclusions')->insert([
									'libelle' => 'Serologie Syphilis Positive',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Absence de bassiles Acido-alcoolo-résistant',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Recherche Positive de bassiles Acido-alcoolo-résistant',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Serologie Chlamydia IGG Positive',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Serologie Chlamydia IGM Positive',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Serologie Chlamydia IGG Negative',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Serologie Chlamydia IGM Negative',
									]);

		DB::table('conclusions')->insert([
									'libelle' => 'Serologie Syphilis Négative',
									]);
		DB::table('conclusions')->insert([
									'libelle' => "Présence d'anticorps Anti-HCV",
									]);
		DB::table('conclusions')->insert([
									'libelle' => "Absence d'anticorps Anti-HCV",
									]);

		DB::table('conclusions')->insert([
									'libelle' => "Présence d'antigènes HBs",
									]);
		DB::table('conclusions')->insert([
									'libelle' => "Absence d'antigènes HBs",
									]);

		DB::table('conclusions')->insert([
									'libelle' => 'Infection à candida',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Culot urinaire négatif.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Neisseria gonorrhoea',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'FSH',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Anémie microcytaire normochrome
		- Leucocytose à polynucléaires neutrophiles
		- Lymphopénie
		- Thrombopénie associée à une absence d\'aggrégats plaquettaires.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Anémie microcytaire normochrome
		- Leucocytose à polynucléaires neutrophiles
		- Lymphopénie
		- Thrombopénie associée à une absence d\'aggrégats plaquettaires.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Proteus vulgaris et à Candida albicans',
									]);

		DB::table('conclusions')->insert([
									'libelle' => '** Ag HBs +/ Ag Hbe +/Ac Hbe -/Ac HBc -/Ac HBs - : Début Hépatite B',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '** Ag HBs +/ Ag Hbe +/Ac Hbe -/Ac HBc +/Ac HBs - : Hépatite aigue à partir de la 3e/4e semaine. Après 6 mois , Hépatite chronique active (Forte contagiosité)',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '** Ag HBs +/ Ag Hbe -/Ac Hbe +/Ac HBc +/Ac HBs - : Hépatite aigue (Fin d\'évolution).Après 6 mois ,Hépatite chronique persistante ou porteur asymptomatique',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '** Ag HBs -/ Ag Hbe -/Ac Hbe +/Ac HBc +/Ac HBs - : Convalescence immédiate HB ou porteur chronique (Ag HBs infradétectable) ou sujet immunisé (Ac HBs infradétectable)',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '** Ag HBs -/ Ag Hbe -/Ac Hbe +/Ac HBc +/Ac HBs + : Antécédents récents d\'Hépatite B (Sujet immunisé)',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '** Ag HBs -/ Ag Hbe -/Ac Hbe -/Ac HBc +/Ac HBs + : Antécédents lointains d\'Hépatite B (Sujet immunisé)',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '** Ag HBs -/ Ag Hbe -/Ac Hbe -/Ac HBc -/Ac HBs +  : Antécédents très lointains d\'Hépatite B ou immunisation par vaccination',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Microcytose
		- Lymphopénie',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Microcytose',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Leuconeutrolymphopénie',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Présence d\'éléments levuriformes et de kystes d\'Entamoeba coli',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Anémie microcytaire normochrome',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Lymphopénie',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Aucun anticorps anti HIV n\'a été détecté. Compte tenu de la période de la séroconversion un contrôle est souhaitable dans 1 à 3 mois.',
									]);

		DB::table('conclusions')->insert([
									'libelle' => '- Leucocytose à lymphocytes et à polynucléaires neutrophiles',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Monocytose',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Thrombopénie associée à une absence d\'agrégats plaquettaires',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Présence des kystes d\'Entamoeba histolytica et d\'Entamoeba coli',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Spermogramme normal',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Tératozoospermie modérée',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Staphylococcus aureus.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Absence de germes pathogènes.',
									]);

		DB::table('conclusions')->insert([
									'libelle' => '- Leucolymphopénie',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Leucocytose',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Leucolymphocytose',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Vaginite à Neisseria gonorrhoea',
									]);

		DB::table('conclusions')->insert([
									'libelle' => 'Recherche négative.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Vaginite à Gadnerella vaginalis et à Mobiluncus',
									]);

		DB::table('conclusions')->insert([
									'libelle' => 'Vaginite à Gadnerella vaginalis',
									]);

		DB::table('conclusions')->insert([
									'libelle' => 'Oligoasthénonécrotératozoospermie modérée',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Oligospermie sévère associée à une Asthénonécrozoospermie modérée',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Présence d\'éléments levuriformes.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Anémie normocytaire normochrome',
									]);

		DB::table('conclusions')->insert([
									'libelle' => 'Vaginite à Gadnerella vaginalis et à Candida albicans',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Candida albicans est sensible aux antifongiques usuels',
									]);

		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Escherichia coli',
									]);

		DB::table('conclusions')->insert([
									'libelle' => '- Lymphocytose',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Thrombocytose',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Klebsiella pneumoniae.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Oligoasthénotératozoospermie.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Leuconeutropénie',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Pseudomonas aeruginosa',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Leucocytose à polynucléaires neutrophiles',
									]);


		DB::table('conclusions')->insert([
									'libelle' => 'Vaginite à Candida albicans',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Absence de germes pathogènes après 10 jours d\'incubation',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Présence de Trophozoïtes de Plasmodium falciparum',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Oligoasthénozoospermie.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Vaginite à Mobilincus et à Candida albicans',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Mobiluncus est habituellement sensible aux dérivés imidazolés (Tinidazol, Ornidazol...)',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Azoospermie',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Vaginite à Staphyloccocus aureus.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Gardnerella vaginalis est habituellement sensible aux dérivés imidazolés (Tinidazol, Ornidazol...)',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Vaginite à Gardnerella vaginalis',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Leucopénie',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Les anticorps HIV sérotype 1 ont été détectés dans le sérum',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Oligoasthénonécrozoospermie très sévère associée à une Hypospermie.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Leucocytose à lymphocytes',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Salmonella paratyphi C',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Klebsiella oxytoca',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Vaginite à Escherichia coli',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Vaginite à Gardnerella vaginalis et à Mobiluncus',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Pas d\'arguments cytobactériologiques en faveur d\'une vaginite',
									]);

		DB::table('conclusions')->insert([
									'libelle' => 'Présence d\'éléments levuriformes et de kystes d\'Entamoeba histolytica',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Vaginite à Gardnerella vaginalis et à Candida albicans',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Macrocytose',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Oligospermie associée à une hyperspermie.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Neutropénie',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Macrocytose',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Oligospermie sévère associée à une Asthénotératozoospermie modérée',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Oligospermie associée à une Asthénotératozoospermie modérée',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Acinetobacter baumanii',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Asthénotératozoospermie modérée',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Candida albicans',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Sévère anémie microcytaire normochrome',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Sévère thrombopénie avec présence de caillot',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Gardnerella vaginalis et Trichomonas vaginalis sont habituellements sensibles aux dérivés imidazolés (Tinidazol, Ornidazol...)',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Enterobacter aerogenes',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Recherche négative des Microfilaires',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Sévère anémie normocytaire normochrome',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Thrombopénie sévère associée à une absence d\'agrégats plaquettaires',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Oligoasthénospermie très sévère associée à une nécrozoospermie modérée.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Thrombopénie avec présence de Trophozoïtes de Plasmodium falciparum',
									]);

		DB::table('conclusions')->insert([
									'libelle' => 'Asthénospermie associée à une tératozoospermie modérée',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Vaginite à Gadnerella vaginalis à Mobiluncus et à Escherichia coli',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Oligoasthénospermie très sévère associée à une Nécrozoospermie modérée.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Présence D\'allergie due aux familles des Graminées, d\'Arbres et des Herbacées.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Présence d\'anticorps Ureaplasma urealyticum et de Mycoplasma hominis',
									]);

		DB::table('conclusions')->insert([
									'libelle' => 'Oligotératozoospermie',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Neutrophilie',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Citrobacter freundii',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Proteus mirabilis',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Klebsiella oxytoca  et à Candida albicans',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Escherichia coli et à Candida albicans',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Présence d\'hématurie microscopique',
									]);

		DB::table('conclusions')->insert([
									'libelle' => 'Présence d\'anticorps Ureaplasma urealyticum',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Anémie normocytaire hypochrome',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Oligoasthénonécrotératozoospermie',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Polyzoospermie associée à une Tératozoospermie modérée',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Vaginite à Gardnerella vaginalis à Mobiluncus et à Candida albicans',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Thrombopénie avec présence d\'agrégats plaquettaires',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Asthénozoospermie',
									]);

		DB::table('conclusions')->insert([
									'libelle' => 'Présence de nombreuses cellules bourgeonnantes encapsulées caractéristique du Cryptococcus néoformans.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Polyglobulie',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Oligospermie sévère associée à une tératozoospermie modérée.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Vaginite à Gardnerella vaginalis
		Gardnerella vaginalis est habituellement sensible aux dérivés imidazolés (Tinidazol, Ornidazol...)',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Vaginite à Candida albicans
		Candida albicans est sensible aux antifongiques usuels.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Hypo oligozoospermie moderée',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Infection à Alkalescens dispar.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Vaginite à Gardnerella vaginalis et à Candida albicans
		Gardnerella vaginalis est habituellement sensible aux dérivés imidazolés (Tinidazol, Ornidazol...)
		Candida albicans est sensible aux antifongiques usuels',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Vaginite à Gardnerella vaginalis et à Candida albicans
		Gardnerella vaginalis est habituellement sensible aux dérivés imidazolés (Tinidazol, Ornidazol...)
		Candida albicans est sensible aux antifongiques usuels',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Vaginite à Gardnerella vaginalis et à Candida albicans
		Gardnerella vaginalis est habituellement sensible aux dérivés imidazolés (Tinidazol, Ornidazol...)',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Recherche négative d\'anticorps anti - Mycoplasmes',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Présence d\'anticorps Ureaplasma urealyticum.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Présence de Mycoplasme de type Mycoplasma hominis',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Vaginite à candida albicans  et à Trichomonas vaginalis',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Trichomonas vaginalis est habituellement sensible aux dérivés imidazolés (Tinidazol, Ornidazol...)',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Présence d\'éléments levuriformes et de Trichomonas intestinalis',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Les anticorps HIV sérotype 1 et 2 ont été détectés dans le sérum',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Présence d\'anticorps anti Hélicobacter pylori.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Présence de Mycoplasme de type Ureaplasma urealyticum',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Anémie microcytaire normochrome
		- Leucocytose à polynucléaires neutrophiles',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Vaginite à Gardnerella vaginalis et à Mobiluncus',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Gardnerella vaginalis et Mobiluncus sont habituellements sensibles aux dérivés imidazolés (Tinidazol, Ornidazol...)',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Anémie macrocytaire normochrome',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Vaginite à Escherichia coli  et à Candida albicans.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => '- Anémie sévère normocytaire normochrome',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Présence des Mycoplasmes de type Ureaplasma urealyticum et Mycoplasma hominis',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Oligoasthénozoospermie sévère.',
									]);
		DB::table('conclusions')->insert([
									'libelle' => 'Recherche négative des Mycoplasmes',
									]);


    }
}
