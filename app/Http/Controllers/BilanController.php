<?php

namespace App\Http\Controllers;
use Auth;
use App\Dossier;
use App\ExamenDossier;
use App\Examen;
use App\Resultat;
use App\Patient;
use App\Rendu;
use \Datetime;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\IntituleBiopsie;
use App\Unite;
use Illuminate\Support\Facades\DB;



use Illuminate\Http\Request;

class BilanController extends Controller
{
    public function GetEvolutionPrescriptions(Request $request)
    {
        if(Auth::check())
        {
            $this->addEvent('liste_evolution_prescriptions', $request->ip(),0, Auth::id(), "Affichage de l'évolution des Prescriptions");
            if($request['annee_debut'] == null)
             {
                $request['annee_debut'] = date('Y');
             }

             if($request['annee_fin'] == null)
             {
                $request['annee_fin'] = date('Y');
             }
            if($request['annee_debut'] != null && $request['annee_fin'] !=  null)
            {

             $columns = array(
                0 => 'nom_prenoms',
                1 => 'annee',
                2 => 'quantite',
                3 => 'montant',               
            );

            $data = array(); 
            $limit = $request->input('length');
            $order_column = $columns[$request->input('order.0.column')];
            if($order_column == 1) $order_column = 0;

            $dir = $request->input('order.0.dir');

            if($limit == -1)
            {
                $limit = "ALL";
            }


            $start = $request->input('start');  
            $totalData = 0;        

             for($i = $request['annee_debut']; $i <= $request['annee_fin']; $i++)
             {
                $count = DB::select('select count(innerselect.nom_prescripteur) as outtertotal from (select count(inner1.nom_prescripteur), inner1.nom_prescripteur, sum(inner1.prix_net) as montant from (select nom_prescripteur, examen_dossiers.id, sum(prix_net) as prix_net from dossiers, examen_dossiers where dossiers.date_dossier <= \''. $i .'/12/31 23:59:59\' and dossiers.date_dossier >= \''.$i.'/01/01 00:00:00\' and examen_dossiers.code_dossier = dossiers.id group by nom_prescripteur, examen_dossiers.id) as inner1, (select distinct nom_prescripteur from dossiers) as inner2 where inner1.nom_prescripteur = inner2.nom_prescripteur group by inner1.nom_prescripteur) as innerselect')[0]->outtertotal;

                $totalData  += $count;

                if(empty($request->input('search.value')))
                {

                    $result = DB::select('select count(inner1.nom_prescripteur) as quantite, inner1.nom_prescripteur as nom_prenoms, sum(inner1.prix_net) as montant from (select nom_prescripteur, examen_dossiers.id, sum(prix_net) as prix_net from dossiers, examen_dossiers where dossiers.date_dossier <= \''. $i .'/12/31 23:59:59\' and dossiers.date_dossier >= \''.$i.'/01/01 00:00:00\' and examen_dossiers.code_dossier = dossiers.id group by nom_prescripteur, examen_dossiers.id) as inner1, (select distinct nom_prescripteur from dossiers) as inner2 where inner1.nom_prescripteur = inner2.nom_prescripteur group by inner1.nom_prescripteur order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                    if($result)
                    {
                        foreach ($result as $row)
                        {

                           $nestedData['nom_prenoms'] = $row->nom_prenoms;
                           $nestedData['annee'] = $i;
                           $nestedData['quantite'] = $row->quantite;
                           $nestedData['montant'] = $row->montant;

                           $data[] = $nestedData;    

                        }
                    }
                } 
                else
                {
                    $search = "'%" . strtoupper($request->input('search.value')) . "%'";

                    $result = DB::select('select count(inner1.nom_prescripteur) as quantite, inner1.nom_prescripteur as nom_prenoms, sum(inner1.prix_net) as montant from (select nom_prescripteur, examen_dossiers.id, sum(prix_net) as prix_net from dossiers, examen_dossiers where dossiers.date_dossier <= \''. $i .'/12/31 23:59:59\' and dossiers.date_dossier >= \''.$i.'/01/01 00:00:00\' and examen_dossiers.code_dossier = dossiers.id group by nom_prescripteur, examen_dossiers.id) as inner1, (select distinct nom_prescripteur from dossiers) as inner2 where inner1.nom_prescripteur = inner2.nom_prescripteur group by inner1.nom_prescripteur and inner1.nom_prenoms like '. $search .' order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                    if($result)
                    {
                        foreach ($result as $row)
                        {

                           $nestedData['nom_prenoms'] = $row->nom_prenoms;
                           $nestedData['annee'] = $i;
                           $nestedData['quantite'] = $row->quantite;
                           $nestedData['montant'] = $row->montant;

                           $data[] = $nestedData;    

                        }
                    }
                }               
             }

            if(empty($request->input('search.value')))
            {
                $totalFiltered = $totalData;    
            }   
            else
            {
                $totalFiltered = count($data);
            }
            
            $json_data = array(

                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,
            );

                echo   json_encode($json_data); 
    
            }
            else
            {
                    return redirect()->route('login', 302);
            }
        }
        else
        {
            return redirect()->route('login', 302);

        }   

    }

    public function GetEvolutionUniteSoins(Request $request)
    {
        if(Auth::check())
        {
                
                $this->addEvent('liste_evolution_unite', $request->ip(),0, Auth::id(), "Affichage de l'évolution des Unités de soins");
                if($request['annee_debut'] == null)
             {
                $request['annee_debut'] = date('Y');
             }

             if($request['annee_fin'] == null)
             {
                $request['annee_fin'] = date('Y');
             }
            if($request['annee_debut'] != null && $request['annee_fin'] !=  null)
            {

             $columns = array(
                0 => 'nom_prenoms',
                1 => 'annee',
                2 => 'quantite',
                3 => 'montant',               
            );

            $data = array(); 
            $limit = $request->input('length');
            $order_column = $columns[$request->input('order.0.column')];
            if($order_column == 1) $order_column = 0;

            $dir = $request->input('order.0.dir');

            if($limit == -1)
            {
                $limit = "ALL";
            }


            $start = $request->input('start');  
            $totalData = 0;        

             for($i = $request['annee_debut']; $i <= $request['annee_fin']; $i++)
             {
                $count = DB::select('select count(innerselect.unite) as outtertotal from (select count(inner1.unite), inner1.unite, sum(inner1.prix_net) as montant from (select unite, examen_dossiers.id, sum(prix_net) as prix_net from dossiers, examen_dossiers where dossiers.date_dossier <= \''. $i .'/12/31 23:59:59\' and dossiers.date_dossier >= \''.$i.'/01/01 00:00:00\' and examen_dossiers.code_dossier = dossiers.id group by unite, examen_dossiers.id) as inner1, (select distinct unite from dossiers) as inner2 where inner1.unite = inner2.unite group by inner1.unite) as innerselect')[0]->outtertotal;

                $totalData  += $count;

                if(empty($request->input('search.value')))
                {

                    $result = DB::select('select count(inner1.unite) as quantite, unites.libelle_unite as nom_prenoms, sum(inner1.prix_net) as montant from (select unite, examen_dossiers.id, sum(prix_net) as prix_net from dossiers, examen_dossiers where dossiers.date_dossier <= \''. $i .'/12/31 23:59:59\' and dossiers.date_dossier >= \''.$i.'/01/01 00:00:00\' and examen_dossiers.code_dossier = dossiers.id group by unite, examen_dossiers.id) as inner1, (select distinct unite from dossiers) as inner2, unites where inner1.unite = inner2.unite and unites.id = inner1.unite::int group by inner1.unite, unites.libelle_unite order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                    if($result)
                    {
                        foreach ($result as $row)
                        {

                           $nestedData['nom_prenoms'] = $row->nom_prenoms;
                           $nestedData['annee'] = $i;
                           $nestedData['quantite'] = $row->quantite;
                           $nestedData['montant'] = $row->montant;

                           $data[] = $nestedData;    

                        }
                    }
                } 
                else
                {
                    $search = "'%" . strtoupper($request->input('search.value')) . "%'";

                    
                    $result = DB::select('select count(inner1.unite) as quantite, unites.libelle_unite as nom_prenoms, sum(inner1.prix_net) as montant from (select unite, examen_dossiers.id, sum(prix_net) as prix_net from dossiers, examen_dossiers where dossiers.date_dossier <= \''. $i .'/12/31 23:59:59\' and dossiers.date_dossier >= \''.$i.'/01/01 00:00:00\' and examen_dossiers.code_dossier = dossiers.id group by unite, examen_dossiers.id) as inner1, (select distinct unite from dossiers) as inner2, unites where inner1.unite = inner2.unite and unites.id = inner1.unite::int and unites.libelle_unite like '. $search .' group by inner1.unite, unites.libelle_unite order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                    if($result)
                    {
                        foreach ($result as $row)
                        {

                           $nestedData['nom_prenoms'] = $row->nom_prenoms;
                           $nestedData['annee'] = $i;
                           $nestedData['quantite'] = $row->quantite;
                           $nestedData['montant'] = $row->montant;

                           $data[] = $nestedData;    

                        }
                    }
                }               
             }

            if(empty($request->input('search.value')))
            {
                $totalFiltered = $totalData;    
            }   
            else
            {
                $totalFiltered = count($data);
            }
            
            $json_data = array(

                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,
            );
            echo   json_encode($json_data);
        }
            else
            {
                return redirect()->route('login', 302);
            }
        }
        else
        {
            return redirect()->route('login', 302);

        }   

    }   

    public function GetEvolutionAnalyses(Request $request)
    {
        if(Auth::check())
        {
            if($request['annee_debut'] == null)
             {
                $request['annee_debut'] = date('Y');
             }

             if($request['annee_fin'] == null)
             {
                $request['annee_fin'] = date('Y');
             }
            if($request['annee_debut'] != null && $request['annee_fin'] !=  null)
            {

             $columns = array(
                0 => 'annee',
                1 => 'examen',
                2 => 'quantite',
                3 => 'montant',               
            );

            $data = array(); 
            $limit = $request->input('length');
            $order_column = $columns[$request->input('order.0.column')];
            if($order_column == 0) $order_column = 1;

            $dir = $request->input('order.0.dir');

            if($limit == -1)
            {
                $limit = "ALL";
            }


            $start = $request->input('start');  
            $totalData = 0;        

             for($i = $request['annee_debut']; $i <= $request['annee_fin']; $i++)
             {
                $count = DB::select('select count(innerselect.libelle_examen) as outtertotal from (select inner1.libelle_examen, sum(quantite) as quantite, sum(prix_net) as montant from (select examens.id as code_examen , libelle_examen, quantite, prix_net from dossiers, examen_dossiers, examens where dossiers.date_dossier <= \''. $i .'/12/31 23:59:59\' and dossiers.date_dossier >= \''.$i.'/01/01 00:00:00\' and dossiers.id = examen_dossiers.code_dossier and examen_dossiers.code_examen = examens.id order by libelle_examen) as inner1 , examens where examens.id = inner1.code_examen group by inner1.libelle_examen order by inner1.libelle_examen) as innerselect')[0]->outtertotal;

                $totalData  += $count;

                if(empty($request->input('search.value')))
                {

                    $result = DB::select('select inner1.examen, sum(quantite) as quantite, sum(prix_net) as montant from (select examens.id as code_examen , libelle_examen as examen, quantite, prix_net from dossiers, examen_dossiers, examens where dossiers.date_dossier <= \''. $i .'/12/31 23:59:59\' and dossiers.date_dossier >= \''.$i.'/01/01 00:00:00\' and dossiers.id = examen_dossiers.code_dossier and examen_dossiers.code_examen = examens.id order by examen) as inner1 , examens where examens.id = inner1.code_examen group by inner1.examen order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                    if($result)
                    {
                        foreach ($result as $row)
                        {

                           $nestedData['annee'] = $i;
                           $nestedData['examen'] = $row->examen;
                           $nestedData['quantite'] = $row->quantite;
                           $nestedData['montant'] = $row->montant;

                           $data[] = $nestedData;    

                        }
                    }
                } 
                else
                {
                    $search = "'%" . strtoupper($request->input('search.value')) . "%'";

                    $result = DB::select('select inner1.examen, sum(quantite) as quantite, sum(prix_net) as montant from (select examens.id as code_examen , libelle_examen as examen, quantite, prix_net from dossiers, examen_dossiers, examens where dossiers.date_dossier <= \''. $i .'/12/31 23:59:59\' and dossiers.date_dossier >= \''.$i.'/01/01 00:00:00\' and dossiers.id = examen_dossiers.code_dossier and examen_dossiers.code_examen = examens.id order by examen) as inner1 , examens where examens.id = inner1.code_examen and(inner1.examen    like '. $search  .') group by inner1.examen order by '. $order_column.'  '. $dir .' limit ' . $limit . ' offset ' . $start);
                    if($result)
                    {
                        foreach ($result as $row)
                        {

                           $nestedData['annee'] = $i;
                           $nestedData['examen'] = $row->examen;
                           $nestedData['quantite'] = $row->quantite;
                           $nestedData['montant'] = $row->montant;

                           $data[] = $nestedData;    

                        }
                    }
                }               
             }

            if(empty($request->input('search.value')))
            {
                $totalFiltered = $totalData;    
            }   
            else
            {
                $totalFiltered = count($data);
            }
            
            $json_data = array(

                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,
            );

           $this->addEvent('liste_evolution_analyse', $request->ip(),0, Auth::id(), "Affichage de l'évolution des Analyses");
              echo   json_encode($json_data);
        

                
    
            }
            else
            {
                    return redirect()->route('login', 302);
            }
        }
        else
        {
            return redirect()->route('login', 302);
        }   

    }



    public function GetListeRapportActivite(Request $request)
    {
        if(Auth::check())
        {
            $result = DB::select('select * from get_activite_labo(?,?)', 
                            [$request->get('start_date'),$request->get('end_date')]);
            $final = array();
            $final['examen'] = 'NOMBRE TOTAL D\'EXAMENS';
            $final['quantite'] = 0;

            foreach ($result as $value) {
                $final['quantite'] += $value->quantite;
            }

            $result[] = $final;
            return json_encode($result);
        }
        else
        {
            return redirect()->route('login', 302);
        }   

    }




    public function ExamenExist($groups, $group)
    {
      foreach($groups as $gp)
      {
          if($gp['examen'] == $group['examen'])
        {
          return true;
        }
      }
      return false;
    }

    public function ResultatExist($groups, $group)
    {
      foreach($groups as $gp)
      {
          if($gp['libelle_type_resultat'] == $group['libelle_type_resultat'])
        {
          return true;
        }
      }
      return false;
    }

    public function getAnalyse(Request $request)
    {
        if(Auth::check())
        {
            if($request['date_debut'] != null && $request['date_fin'] != null && $request['genre'] != null)
            {
                $result = array();
                    if($request['genre'] != 'tous')
                    {
                        if($request['genre'] == 'hommes')
                        {
                            $result = DB::select('select distinct libelle_examen as examen, examens.id from resultats, examens, dossiers, patients where resultats.created_at <= \''.$request['date_fin'] .' 23:59:59\' and resultats.created_at >= \''. $request['date_debut'] .' 00:00:00\' and resultats.id_examen = examens.id and dossiers.id = resultats.id_dossier and dossiers.id_patient = patients.id and patients.sexe = \'Masculin\' order by libelle_examen asc');
                        }
                        else if($request['genre'] == 'femmes')
                        {
                            $result = DB::select('select distinct libelle_examen as examen, examens.id from resultats, examens, dossiers, patients where resultats.created_at <= \''.$request['date_fin'] .' 23:59:59\' and resultats.created_at >= \''. $request['date_debut'] .' 00:00:00\' and resultats.id_examen = examens.id and dossiers.id = resultats.id_dossier and dossiers.id_patient = patients.id and patients.sexe = \'Feminin\' and dossiers.enceinte = \'0\' order by libelle_examen asc');
                        }
                        else if($request['genre'] == 'enceintes')
                        {
                            $result = DB::select('select distinct libelle_examen as examen, examens.id from resultats, examens, dossiers, patients where resultats.created_at <= \''.$request['date_fin'] .' 23:59:59\' and resultats.created_at >= \''. $request['date_debut'] .' 00:00:00\' and resultats.id_examen = examens.id and dossiers.id = resultats.id_dossier and dossiers.id_patient = patients.id and patients.sexe = \'Feminin\' and dossiers.enceinte = \'1\' order by libelle_examen asc');
                        }
                    }
                    else
                    {
                        $result = DB::select('select distinct libelle_examen as examen, examens.id from resultats, examens where resultats.created_at <= \''.$request['date_fin'] .' 23:59:59\' and resultats.created_at >= \''. $request['date_debut'] .' 00:00:00\' and resultats.id_examen = examens.id order by libelle_examen asc');
                    }

                    

                return response()->json(['examens' => json_encode($result)], 200);  
            }
        }
        else
        {
            return redirect()->route('login', 302);

        }   
    }

    public function getElements(Request $request)
    {
        if(Auth::check())
        {
            if($request['examen'] != null)
            {
                $rendus = Rendu::where('code_examen', $request['examen'])->get();
                return response()->json(['rendus' => json_encode($rendus)], 200);
            }
        }
        else
        {
            return redirect()->route('login', 302);
        }   
    }

    public function getTypeResultat(Request $request)
    {
        if(Auth::check())
        {
            if($request['date_debut'] != null && $request['date_fin'] != null && $request['genre'] != null)
            {
                $result = array();
                if($request['genre'] != 'tous')
                    {
                        if($request['genre'] == 'hommes')
                        {
                            $result = DB::select('select distinct count(valeur) as id , resultats.valeur as libelle_type_resultat from resultats, examens, dossiers, patients where resultats.created_at <= \''.$request['date_fin'] .' 23:59:59\' and resultats.created_at >= \''. $request['date_debut'] .' 00:00:00\' and resultats.id_examen = examens.id and dossiers.id = resultats.id_dossier and dossiers.id_patient = patients.id and patients.sexe = \'Masculin\' and resultats.id_examen = '. $request['examen'] .' and resultats.id_element = '. $request['rendu'] .' group by resultats.valeur order by resultats.valeur asc');
                        }
                        else if($request['genre'] == 'femmes')
                        {
                            $result = DB::select('select distinct count(valeur) as id , resultats.valeur as libelle_type_resultat from resultats, examens, dossiers, patients where resultats.created_at <= \''.$request['date_fin'] .' 23:59:59\' and resultats.created_at >= \''. $request['date_debut'] .' 00:00:00\' and resultats.id_examen = examens.id and dossiers.id = resultats.id_dossier and dossiers.id_patient = patients.id and patients.sexe = \'Feminin\' and dossiers.enceinte = \'0\' and resultats.id_examen = '. $request['examen'] .' and resultats.id_element = '. $request['rendu'] .' group by resultats.valeur order by resultats.valeur asc');
                        }
                        else if($request['genre'] == 'enceintes')
                        {
                            $result = DB::select('select distinct count(valeur) as id , resultats.valeur as libelle_type_resultat from resultats, examens, dossiers, patients where resultats.created_at <= \''.$request['date_fin'] .' 23:59:59\' and resultats.created_at >= \''. $request['date_debut'] .' 00:00:00\' and resultats.id_examen = examens.id and dossiers.id = resultats.id_dossier and dossiers.id_patient = patients.id and patients.sexe = \'Feminin\' and dossiers.enceinte = \'1\' and resultats.id_examen = '. $request['examen'] .' and resultats.id_element = '. $request['rendu'] .' group by resultats.valeur order by resultats.valeur asc');
                        }
                    }
                    else
                    {
                        $result = DB::select('select distinct count(valeur) as id , resultats.valeur as libelle_type_resultat from resultats, examens where resultats.created_at <= \''.$request['date_fin'] .' 23:59:59\' and resultats.created_at >= \''. $request['date_debut'] .' 00:00:00\' and resultats.id_examen = examens.id and resultats.id_examen = '. $request['examen'] .' and resultats.id_element = '. $request['rendu'] .' and resultats.valeur IS NOT NULL group by resultats.valeur order by resultats.valeur asc');
                    }
                return response()->json(['resultats' => json_encode($result)], 200);    
            }
        }
        else
        {
            return redirect()->route('login', 302);
        }   
    }

    public function ValiderStatistiqueResultat(Request $request)
    {
        if(Auth::check())
        {           
            $resultats = Resultat::where('created_at', '>=', $request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->where('id_examen', $request['examen'])->where('id_element', $request['rendu'])->where('valide', 1)->get();

            $min = 0;
            $max = 0;
            $i = 0;

            $tab = $request['resultats'];


            foreach ($resultats as $resultat) 
            {
                if($this->checkValue($tab, $resultat->valeur))
                {

                    $dossier = Dossier::find($resultat->id_dossier);
                    $patient = Patient::find($dossier->id_patient);
                    $bday = new DateTime($patient->date_naissance);
                    $today = new DateTime($dossier->date_dossier);          
                    $diff = $today->diff($bday);
                    $age = $diff->y;

                    if($i == 0)
                    {
                        $min = $age;
                        $max = $age;
                    }
                    else
                    {
                        if($age > $max)
                        {
                            $max = $age;
                        }

                        if($age < $min)
                        {
                            $min = $age;
                        }
                    }
                }
            }

                

            $result = array();
                $resultats = Resultat::where('created_at', '>=', $request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->where('id_examen', $request['examen'])->where('valide', 1)->get();

                foreach($resultats as $res)
                {
                    $dossier = Dossier::find($res->id_dossier);
                    $patient = Patient::find($dossier->id_patient);
                    if($request['genre'] != 'tous')
                    {
                        if($request['genre'] == 'hommes')
                        {
                            if($patient->sexe != 'Masculin')
                            {
                                continue;
                            }
                        }
                        else if($request['genre'] == 'femmes')
                        {
                            if($patient->sexe != 'Feminin')
                            {
                                continue;
                            }
                        }
                        else if($request['genre'] == 'enceintes')
                        {
                            if($dossier->enceinte != 1)
                            {
                                continue;
                            }
                        }
                    }

                    
                    if($res->id_element == $request['rendu'])
                    {
                        dd($min . ' et ' .  $max);
                    }                   
                }
                return response()->json(['resultats' => json_encode($result)], 200);

        }
        else
        {
            return redirect()->route('login', 302);
        }

    }

    public function checkValue($tab, $valeur)
    {
        $result = false;

        if($valeur == null)
        {
            $valeur = "null";
        }
        foreach($tab as $ta)
        {
            if($ta == $valeur)
            {
                $result = true;
                break;
            }
        }

        return $result;
    }
     public function gerer($str)
    {
      return iconv('UTF-8', 'windows-1252', $str);
    } 

    public function ImprimerEvolutionAnalyses(Request $request)
    {
        if(Auth::check())
        {
            if($request['annee_debut'] != null && $request['annee_fin'] !=  null)
            {
                if($request['annee_debut'] == null)
             {
                $request['annee_debut'] = date('Y');
             }

             if($request['annee_fin'] == null)
             {
                $request['annee_fin'] = date('Y');
             }

                $result = array();
                $qte = 0;
                $total = 0;
                for($i = $request['annee_debut']; $i <= $request['annee_fin']; $i++)
             {
                $data = DB::select('select inner1.examen, sum(quantite) as quantite, sum(prix_net) as montant from (select examens.id as code_examen , libelle_examen as examen, quantite, prix_net from dossiers, examen_dossiers, examens where dossiers.date_dossier <= \''. $i .'/12/31 23:59:59\' and dossiers.date_dossier >= \''.$i.'/01/01 00:00:00\' and dossiers.id = examen_dossiers.code_dossier and examen_dossiers.code_examen = examens.id order by examen) as inner1 , examens where examens.id = inner1.code_examen group by inner1.examen order by examen');
                    if($data)
                    {
                        foreach ($data as $row)
                        {

                           $nestedData['annee'] = $i;
                           $nestedData['examen'] = $row->examen;
                           $nestedData['quantite'] = $row->quantite;
                           $qte += $row->quantite;
                           $nestedData['montant'] = $row->montant;
                           $total += $row->montant;
                           $result[] = $nestedData;    

                        }
                    }
                }   

                //Debut de la création du PDF Proprement dit

                $bottom_margin = 20;
                $page_height = 279.4;
                
                $fpdf = new PDFBilan('P','mm', 'A4');
                $fpdf->SetAuthor('GELAM');
                $fpdf->SetAuthor('GELAM');
                $fpdf->SetCreator('GELAM');

                $fpdf->SetAutoPageBreak(false);
                //Creation de la Premiere Page
                $fpdf->AddPage();
                $fpdf->Image('logo1.jpg', 10,10, 40);
                $fpdf->Image('logo2.jpg', 170,10, 20);
                $fpdf->SetTextColor(0,72,0);   

                $fpdf->SetFont('Times', 'BI', 15);
                  //Ajout d'un espacement au debut
                  $fpdf->Cell(180, 7,'', 0, 1, 'C');  
                  //Creation du titre proprement dit
                  $fpdf->Cell(7, 4,'', 0, 0, 'C'); 

                  $fpdf->Cell(0, 6,'CENTRE D\'ANIMATION SOCIALE ET SANITAIRE', 0, 1, 'C');
                  $fpdf->SetFont('Times', 'B', 18);
                  $fpdf->Cell(0, 5, $this->gerer('LABORATOIRE'), 0, 1, 'C');
                  $fpdf->SetTextColor(0,0,0); 

                  $fpdf->SetFont('Courier', 'B', 12);
                  $fpdf->Cell(0, 5, $this->gerer('HEMATOLOGIE - BIOCHIMIE - BACTERIOLOGIE'), 0, 1, 'C');
                  $fpdf->Cell(0, 5, $this->gerer('IMMUNOLOGIE - PARASITOLOGIE - SEROLOGIE '), 0, 1, 'C');
                  $fpdf->SetFont('Times', '', 10);
                  $fpdf->Cell(0, 5, $this->gerer('BP : 185 Yaoundé-Cameroun - Téléphone : (+237) 222 220 403'), 0, 1, 'C');
                  $fpdf->Cell(0, 5, $this->gerer('Email : cassnkolndongo@yahoo.fr'), 0, 1, 'C');
                  $fpdf->SetFont('Times', 'B', 10);
                  $fpdf->SetTextColor(255,0,0);   
                  $fpdf->Cell(0, 5, $this->gerer('Situé à Nkolndongo'), 0, 1, 'C');
                  $fpdf->SetTextColor(0,0,0);   

                  $fpdf->SetDrawColor(0,72,0);   
                  $fpdf->SetLineWidth(0.5);
                  $fpdf->Line(20,55, 190, 55);
                  $fpdf->Line(20,268, 190, 268);
                  $fpdf->SetFont('Times', 'BU', 14);
                  $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
                  $fpdf->SetDrawColor(0,0,0); 

                  $fpdf->Ln(4);
                  $title = "EVOLUTION QUANTITATIVE DES ANALYSES EFFECTUÉES";
                  $fpdf->MultiCell(0, 7, $this->gerer($title), 0, 'C');
                  $fpdf->Ln(5);
                  $dates = array();
                  $fpdf->SetFont('Times', 'B', 10);

                  foreach($result as $res)
                  {
                    $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $request, $title);
                    $collection = collect([
                            'mois' => $res['annee'],
                        ]);
                    if(!$this->MoisExist($dates, $collection))
                    {
                        array_push( $dates, $collection);
                        $fpdf->Ln(2);
                        $fpdf->SetFont('Times', 'B', 15);
                        $fpdf->Cell(10, 7, '', 0,0);
                        $fpdf->Cell(70, 7, $this->gerer('Année de Référence ' . $res['annee']), 0, 1);
                        $fpdf->Ln(5);
                        $fpdf->SetFont('Times', 'B', 10);
                        $fpdf->SetFillColor(200,200,200);
                        $fpdf->Cell(7, 7, '', 0, 0);
                        $fpdf->Cell(138, 7,$this->gerer("Analyses") , 1, 0, 'C', true); 
                        $fpdf->Cell(10, 7,$this->gerer("Qté") , 1, 0, 'C', true);  
                        $fpdf->Cell(30, 7,$this->gerer("Montant") , 1, 0, 'C', true);  
                        $fpdf->Ln(10);  
                        $fpdf->SetFont('Times', '', 10);

                    }
                    $fpdf->Cell(7, 7, '', 0, 0);
                        $fpdf->Cell(138, 7,$this->gerer($res['examen']) , 0, 0, 'L'); 
                        $fpdf->Cell(10, 7,$this->gerer($res['quantite']) , 0, 0, 'C');  
                        $fpdf->Cell(30, 7,$this->gerer($res['montant']) , 0, 1, 'C');  

                  }

                     $fpdf->SetFillColor(184,220,220);
                      $fpdf->Ln(2);
                  $fpdf->SetFont('Times', 'B', 10);

                      $fpdf->Cell(7, 7, '', 0, 0);
                      $fpdf->Cell(138, 7,$this->gerer("") , 1, 0, 'C', true);                      
                      $fpdf->Cell(10, 7,$this->gerer($qte) , 1, 0, 'C', true);  
                      $fpdf->Cell(30, 7,$this->gerer($total) , 1, 1, 'C', true);          
                   $fpdf->Output(); 
            }
            else
            {

                return redirect()->route('login', 302);
            }
        }
        else
        {
            return redirect()->route('login', 302);
        }
    }

    public function StatistiquesPathologiesGeneral(Request $request)
    {
        if(Auth::check())
        {
            $this->addEvent('liste_statistique_pathologie_generale', $request->ip(),0, Auth::id(), "Affichage des Statistiques Générales sur les Pathologies");
            $resultats = Resultat::where('created_at', '>=', $request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->where('id_examen', $request['examen'])->where('id_element', $request['rendu'])->where('valide', 1)->get();


            $i = 0;

            $tab = $request['resultats'];
            $result =  DB::select('select min(innerselect.id), max(innerselect.id) from (select age(dossiers.date_dossier, patients.date_naissance) as id from resultats, dossiers, patients where resultats.id_dossier = dossiers.id and dossiers.id_patient = patients.id and resultats.created_at <= \''. $request['date_fin']  .' 23:59:59\' and resultats.created_at >= \' '. $request['date_debut'] .' 00:00:00 \' and resultats.id_examen = '. $request['examen'] .' and resultats.id_element = '. $request['rendu'] .' and resultats.valide = 1) as innerselect ');

            $min = (int) explode(" ", $result[0]->min)[0];
            $max = (int) explode(" ", $result[0]->max)[0];
            $final = array();

            $borne_min = $min;
            $borne_max = $min + 5;

            do {

                $result = array();
                $resultats = Resultat::where('created_at', '>=', $request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->where('valide', 1)->where('id_examen', $request['examen'])->where('id_element', $request['rendu'])->get();

                foreach($resultats as $res)
                {
                    $dossier = Dossier::find($res->id_dossier);
                    $patient = Patient::find($dossier->id_patient);

                    if($request['genre'] != 'tous')
                    {                   
                        if($request['genre'] == 'hommes')
                        {
                            if($patient->sexe != 'Masculin')
                            {
                                continue;
                            }
                        }
                        else if($request['genre'] == 'femmes')
                        {
                            if($patient->sexe != 'Feminin')
                            {
                                continue;
                            }
                        }
                        else if($request['genre'] == 'enceintes')
                        {
                            if($dossier->enceinte == 0)
                            {
                                continue;
                            }
                        }
                    }
                    $bday = new DateTime($patient->date_naissance);
                    $today = new DateTime($dossier->date_dossier);          
                    $diff = $today->diff($bday);
                    $age = $diff->y;

                    if($age < $borne_min || $age > $borne_max)
                    {
                        continue;
                    }
                    $collection = collect([
                        'id' => $res->id,
                        'valeur' => $res->valeur,
                    ]);
                    array_push( $result, $collection);  
                }

                $collection = collect([

                    'tranche_age' => $borne_min . '-' . $borne_max,
                ]); 

                $collection->put('total', count($result));
                $tab = $request['resultats'];
                $jjk = 1;   
                foreach ($tab as $val)
                {
                    $nbre_total = 0;
                    foreach($result as $res)
                    {
                        if($res['valeur'] == $val)
                        {
                            $nbre_total++;
                        }
                    }
                    
                    $collection->put('colonne'. $jjk, $nbre_total);
                    $jjk++;
                }
                array_push($final, $collection);

            $borne_min = $borne_max + 1;
            $borne_max = $borne_min + 5;        
            } while ($borne_min < $max);        

            return response()->json(['statistiques' => json_encode($final)], 200);
            
        }   
        else
        {
            return redirect()->route('login', 302);
        }
    }

    public function StatistiquesPathologiesTrancheAge(Request $request)
    {
        if(Auth::check())
        {
            $this->addEvent('liste_statistique_pathologie_tranche_age', $request->ip(),0, Auth::id(), "Affichage des Statistiques Par Tranche d'age sur les Pathologies");

            $statistiques = array();
            $result = array();

            $statistiques[] = collect([
                'colonne' => '1',
                'valeur' => $request['age_min'].' - '.$request['age_max'],
            ]);

            $tab = $request['resultats'];
            $chaine_or = '';
            // dd($tab);  

             for($j = 0; $j < count($tab); $j++) 
             {
                if($chaine_or != '')
                {
                    $chaine_or .= ' or ';
                }
                $chaine_or .= 'resultats.valeur = \''. $tab[$j] . '\'';
             }
            
            if($request['genre'] != 'tous')
            {
                if($request['genre'] == 'hommes')
                {
                    $statistiques[] = collect([
                'colonne' => '2',
                    'valeur' => DB::select('select count(innerselect.id) as outtertotal from (select dossiers.id, patients.nom_patient, age(dossiers.date_dossier, patients.date_naissance)  from resultats, dossiers, patients where ('. $chaine_or .') and id_examen = '. $request['examen'] .' and dossiers.id = resultats.id_dossier and patients.id = dossiers.id_patient and age(dossiers.date_dossier, patients.date_naissance) < \''. ($request['age_max'] + 1) .' years\' and age(dossiers.date_dossier, patients.date_naissance) >= \''. ($request['age_min']) .' years\' and libelle_rendu = \''. $request['rendu'] .'\' and dossiers.date_dossier <= \''.$request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and patients.sexe = \'Masculin\' and resultats.valide = 1 order by nom_patient) as innerselect ')[0]->outtertotal,
                ]);
                    for($j = 0; $j < count($tab); $j++) 
                    {
                    $statistiques[] = collect([
                    'colonne' => $j+3,
                    'valeur' => DB::select('select count(innerselect.id) as outtertotal from (select dossiers.id, patients.nom_patient, age(dossiers.date_dossier, patients.date_naissance)  from resultats, dossiers, patients where valeur = \''. $tab[$j] .'\' and id_examen = '. $request['examen'] .' and dossiers.id = resultats.id_dossier and patients.id = dossiers.id_patient and age(dossiers.date_dossier, patients.date_naissance) < \''. ($request['age_max'] + 1) .' years\' and age(dossiers.date_dossier, patients.date_naissance) >= \''. ($request['age_min']) .' years\' and libelle_rendu = \''. $request['rendu'] .'\' and dossiers.date_dossier <= \''.$request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and patients.sexe = \'Masculin\' and resultats.valide = 1 order by nom_patient) as innerselect ')[0]->outtertotal,
                    ]);
                    }    
                }
            
                else if($request['genre'] == 'femmes')
                {
                    $statistiques[] = collect([
                'colonne' => '2',
                'valeur' => DB::select('select count(innerselect.id) as outtertotal from (select dossiers.id, patients.nom_patient, age(dossiers.date_dossier, patients.date_naissance)  from resultats, dossiers, patients where ('. $chaine_or .') and id_examen = '. $request['examen'] .' and dossiers.id = resultats.id_dossier and patients.id = dossiers.id_patient and age(dossiers.date_dossier, patients.date_naissance) < \''. ($request['age_max'] + 1) .' years\' and age(dossiers.date_dossier, patients.date_naissance) >= \''. ($request['age_min']) .' years\' and libelle_rendu = \''. $request['rendu'] .'\' and dossiers.date_dossier <= \''.$request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and patients.sexe = \'Feminin\' and dossiers.enceinte::int = 0 and resultats.valide = 1 order by nom_patient) as innerselect ')[0]->outtertotal,
                ]);
                    for($j = 0; $j < count($tab); $j++) 
                    {
                    $statistiques[] = collect([
                    'colonne' => $j+3,
                    'valeur' => DB::select('select count(innerselect.id) as outtertotal from (select dossiers.id, patients.nom_patient, age(dossiers.date_dossier, patients.date_naissance)  from resultats, dossiers, patients where valeur = \''. $tab[$j] .'\' and id_examen = '. $request['examen'] .' and dossiers.id = resultats.id_dossier and patients.id = dossiers.id_patient and age(dossiers.date_dossier, patients.date_naissance) < \''. ($request['age_max'] + 1) .' years\' and age(dossiers.date_dossier, patients.date_naissance) >= \''. ($request['age_min']) .' years\' and libelle_rendu = \''. $request['rendu'] .'\' and dossiers.date_dossier <= \''.$request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and patients.sexe = \'Feminin\' and dossiers.enceinte::int = 0 and resultats.valide = 1 order by nom_patient) as innerselect ')[0]->outtertotal,
                    ]);
                    } 
                }


                else if($request['genre'] == 'enceintes')
                {
                    $statistiques[] = collect([
                'colonne' => '2',
                'valeur' => DB::select('select count(innerselect.id) as outtertotal from (select dossiers.id, patients.nom_patient, age(dossiers.date_dossier, patients.date_naissance)  from resultats, dossiers, patients where ('. $chaine_or .') and id_examen = '. $request['examen'] .' and dossiers.id = resultats.id_dossier and patients.id = dossiers.id_patient and age(dossiers.date_dossier, patients.date_naissance) < \''. ($request['age_max'] + 1) .' years\' and age(dossiers.date_dossier, patients.date_naissance) >= \''. ($request['age_min']) .' years\' and libelle_rendu = \''. $request['rendu'] .'\' and dossiers.date_dossier <= \''.$request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and patients.sexe = \'Feminin\' and dossiers.enceinte::int = 1 and resultats.valide = 1 order by nom_patient) as innerselect ')[0]->outtertotal,
                ]);
                    for($j = 0; $j < count($tab); $j++) 
                    {
                    $statistiques[] = collect([
                    'colonne' => $j+3,
                    'valeur' => DB::select('select count(innerselect.id) as outtertotal from (select dossiers.id, patients.nom_patient, age(dossiers.date_dossier, patients.date_naissance)  from resultats, dossiers, patients where valeur = \''. $tab[$j] .'\' and id_examen = '. $request['examen'] .' and dossiers.id = resultats.id_dossier and patients.id = dossiers.id_patient and age(dossiers.date_dossier, patients.date_naissance) < \''. ($request['age_max'] + 1 ).' years\' and age(dossiers.date_dossier, patients.date_naissance) >= \''. ($request['age_min']) .' years\' and libelle_rendu = \''. $request['rendu'] .'\' and dossiers.date_dossier <= \''.$request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' and patients.sexe = \'Feminin\' and dossiers.enceinte::int = 1 order by nom_patient) as innerselect ')[0]->outtertotal,
                    ]);
                    } 
                }
            }
            else
            {
                
                $statistiques[] = collect([
                'colonne' => '2',
                'valeur' => DB::select('select count(innerselect.id) as outtertotal from (select dossiers.id, patients.nom_patient, age(dossiers.date_dossier, patients.date_naissance)  from resultats, dossiers, patients where ('. $chaine_or .') and id_examen = '. $request['examen'] .' and dossiers.id = resultats.id_dossier and patients.id = dossiers.id_patient and age(dossiers.date_dossier, patients.date_naissance) < \''. ( $request['age_max'] + 1) .' years\' and age(dossiers.date_dossier, patients.date_naissance) >= \''. $request['age_min'] .' years\' and libelle_rendu = \''. $request['rendu'] .'\' and dossiers.date_dossier <= \''.$request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' order by nom_patient) as innerselect ')[0]->outtertotal,
                ]);
                for($j = 0; $j < count($tab); $j++) 
                {
                    $statistiques[] = collect([
                    'colonne' => $j+3,
                    'valeur' => $result = DB::select('select count(innerselect.id) as outtertotal from (select dossiers.id, patients.nom_patient, age(dossiers.date_dossier, patients.date_naissance)  from resultats, dossiers, patients where valeur = \''. $tab[$j] .'\' and id_examen = '. $request['examen'] .' and dossiers.id = resultats.id_dossier and patients.id = dossiers.id_patient and age(dossiers.date_dossier, patients.date_naissance) < \''. ($request['age_max'] + 1) .' years\' and age(dossiers.date_dossier, patients.date_naissance) >= \''. $request['age_min'] .' years\' and libelle_rendu = \''. $request['rendu'] .'\' and dossiers.date_dossier <= \''.$request['date_fin'] .' 23:59:59\' and dossiers.date_dossier >= \''. $request['date_debut'] .' 00:00:00\' order by nom_patient) as innerselect ')[0]->outtertotal,
                    ]);
                }
                    
                    
            }
            
            
            

            

            return response()->json(['statistiques' => json_encode($statistiques)], 200);
        }   
        else
        {
            return redirect()->route('login', 302);
        }
    }

    public function StatistiquePathologiesRenseignementClinique(Request $request)
    {
        if(Auth::check())
        {
            if(!$request->ajax())
            {
                $renseignements = IntituleBiopsie::orderBy('libelle')->get();
                return view('dashboard_statistique_pathologique_renseignement')->withRenseignement($renseignements);
            }
            else
            {
                $this->addEvent('liste_statistique_pathologie_renseigneent_clinique', $request->ip(),0, Auth::id(), "Affichage des Statistiques Par Renseignement Clinique sur les Pathologies");
                $result = array();
                $resultats = Resultat::where('created_at', '>=', $request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->where('valide', 1)->where('id_examen', $request['examen'])->where('id_element', $request['rendu'])->get();
            
                    foreach($resultats as $res)
                    {
                        $dossier = Dossier::find($res->id_dossier);
                        $patient = Patient::find($dossier->id_patient);

                        if($dossier->renseignement != $request['renseignement'])
                        {
                            continue;
                        }

                        if($request['genre'] != 'tous')
                        {                   
                            if($request['genre'] == 'hommes')
                            {
                                if($patient->sexe != 'Masculin')
                                {
                                    continue;
                                }
                            }
                            else if($request['genre'] == 'femmes')
                            {
                                if($patient->sexe != 'Feminin')
                                {
                                    continue;
                                }
                            }
                            else if($request['genre'] == 'enceintes')
                            {
                                if($dossier->enceinte == 0)
                                {
                                    continue;
                                }
                            }
                        }
                        $bday = new DateTime($patient->date_naissance);
                        $today = new DateTime($dossier->date_dossier);          
                        $diff = $today->diff($bday);
                        $age = $diff->y;

                    if($age < $request['age_min'] || $age > $request['age_max'])
                    {
                        continue;
                    }

                    $collection = collect([
                        'id' => $res->id,
                        'valeur' => $res->valeur,
                    ]);
                    array_push( $result, $collection);  


                }

                $tab = $request['resultats'];
                $final = array();

                $collection = collect([
                    'colonne' => 1,
                    'valeur' => $request['age_min'] .'-'. $request['age_max'],
                ]);
                array_push( $final, $collection);   
                $collection = collect([
                    'colonne' => 2,
                    'valeur' => count($result),
                ]);
                array_push( $final, $collection);
                $j = 3;
                foreach ($tab as $val)
                {
                    $nbre_total = 0;
                    foreach($result as $res)
                    {
                        if($res['valeur'] == $val)
                        {
                            $nbre_total++;
                        }
                    }

                    $collection = collect([
                        'colonne' => $j,
                        'valeur' => $nbre_total ,
                    ]);
                    array_push( $final, $collection);
                    $j++;

                }

                return response()->json(['statistiques' => json_encode($final)], 200);
                }
            
        }   
        else
        {
            return redirect()->route('login', 302);
        }
    }

    public function CheckPiedsDePage($fpdf, $page_height, $request, $title)
    {

          if(30 >= ($page_height - $fpdf->GetY()))
            {

               $fpdf->AddPage(); // page break.
               $fpdf->Ln(5);    
                $fpdf->SetFont('Times', 'BU', 14);
               $fpdf->Cell(0, 7, $this->gerer($title), 0, 1, 'C');
              $fpdf->Ln(3);
                $fpdf->SetFont('Times', '', 10);
               $fpdf->SetFillColor(200,200,200);
                      
            }
            return $fpdf; 
    }

    public function ImprimerEvolutionPrescripteurs(Request $request)
    {
        if(Auth::check())
        {
            if($request['annee_debut'] == null)
             {
                $request['annee_debut'] = date('Y');
             }

             if($request['annee_fin'] == null)
             {
                $request['annee_fin'] = date('Y');
             }

            if($request['annee_debut'] != null && $request['annee_fin'] !=  null)
            {
                
                
                

                $result = array();
                $qte = 0;
                $total = 0;
                for($i = $request['annee_debut']; $i <= $request['annee_fin']; $i++)
                {
                $data = DB::select('select count(inner1.nom_prescripteur) as quantite, inner1.nom_prescripteur as nom_prenoms, sum(inner1.prix_net) as montant from (select nom_prescripteur, examen_dossiers.id, sum(prix_net) as prix_net from dossiers, examen_dossiers where dossiers.date_dossier <= \''. $i .'/12/31 23:59:59\' and dossiers.date_dossier >= \''.$i.'/01/01 00:00:00\' and examen_dossiers.code_dossier = dossiers.id group by nom_prescripteur, examen_dossiers.id) as inner1, (select distinct nom_prescripteur from dossiers) as inner2 where inner1.nom_prescripteur = inner2.nom_prescripteur group by inner1.nom_prescripteur order by nom_prenoms');
                    if($data)
                    {
                        foreach ($data as $row)
                        {

                           $nestedData['nom_prenoms'] = $row->nom_prenoms;
                           $nestedData['annee'] = $i;
                           $nestedData['quantite'] = $row->quantite;
                           $nestedData['montant'] = $row->montant;
                           $qte += $row->quantite;
                           $total += $row->montant;
                           $result[] = $nestedData;    

                        }
                    }
                }

                //Debut de la création du PDF Proprement dit

                $bottom_margin = 20;
                $page_height = 279.4;
                
                $fpdf = new PDFBilan('P','mm', 'A4');
                $fpdf->SetAuthor('GELAM');
                $fpdf->SetAuthor('GELAM');
                $fpdf->SetCreator('GELAM');

                $fpdf->SetAutoPageBreak(false);
                //Creation de la Premiere Page
                $fpdf->AddPage();
                $fpdf->Image('logo1.jpg', 10,10, 40);
                $fpdf->Image('logo2.jpg', 170,10, 20);
                $fpdf->SetTextColor(0,72,0);   

                $fpdf->SetFont('Times', 'BI', 15);
                  //Ajout d'un espacement au debut
                  $fpdf->Cell(180, 7,'', 0, 1, 'C');  
                  //Creation du titre proprement dit
                  $fpdf->Cell(7, 4,'', 0, 0, 'C'); 

                  $fpdf->Cell(0, 6,'CENTRE D\'ANIMATION SOCIALE ET SANITAIRE', 0, 1, 'C');
                  $fpdf->SetFont('Times', 'B', 18);
                  $fpdf->Cell(0, 5, $this->gerer('LABORATOIRE'), 0, 1, 'C');
                  $fpdf->SetTextColor(0,0,0); 

                  $fpdf->SetFont('Courier', 'B', 12);
                  $fpdf->Cell(0, 5, $this->gerer('HEMATOLOGIE - BIOCHIMIE - BACTERIOLOGIE'), 0, 1, 'C');
                  $fpdf->Cell(0, 5, $this->gerer('IMMUNOLOGIE - PARASITOLOGIE - SEROLOGIE '), 0, 1, 'C');
                  $fpdf->SetFont('Times', '', 10);
                  $fpdf->Cell(0, 5, $this->gerer('BP : 185 Yaoundé-Cameroun - Téléphone : (+237) 222 220 403'), 0, 1, 'C');
                  $fpdf->Cell(0, 5, $this->gerer('Email : cassnkolndongo@yahoo.fr'), 0, 1, 'C');
                  $fpdf->SetFont('Times', 'B', 10);
                  $fpdf->SetTextColor(255,0,0);   
                  $fpdf->Cell(0, 5, $this->gerer('Situé à Nkolndongo'), 0, 1, 'C');
                  $fpdf->SetTextColor(0,0,0);   

                  $fpdf->SetDrawColor(0,72,0);   
                  $fpdf->SetLineWidth(0.5);
                  $fpdf->Line(20,55, 190, 55);
                  $fpdf->Line(20,268, 190, 268);
                  $fpdf->SetFont('Times', 'BU', 14);
                  $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
                  $fpdf->SetDrawColor(0,0,0); 

                  $fpdf->Ln(4);
                  $title = "EVOLUTION QUANTITATIVE DES PRESCRIPTIONS EFFECTUÉES";
                  $fpdf->MultiCell(0, 7, $this->gerer($title), 0, 'C');
                  $fpdf->Ln(5);
                  $dates = array();
                  $fpdf->SetFont('Times', 'B', 10);

                  foreach($result as $res)
                  {
                    $collection = collect([
                            'mois' => $res['annee'],
                        ]);
                    $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $request, $title);
                    if(!$this->MoisExist($dates, $collection))
                    {
                        array_push( $dates, $collection);
                        $fpdf->Ln(2);
                        $fpdf->SetFont('Times', 'B', 15);
                        $fpdf->Cell(10, 7, '', 0,0);
                        $fpdf->Cell(70, 7, $this->gerer('Année de Référence ' . $res['annee']), 0, 1);
                        $fpdf->Ln(5);
                        $fpdf->SetFont('Times', 'B', 10);
                        $fpdf->SetFillColor(200,200,200);
                        $fpdf->Cell(7, 7, '', 0, 0);
                        $fpdf->Cell(138, 7,$this->gerer("Analyses") , 1, 0, 'C', true); 
                        $fpdf->Cell(10, 7,$this->gerer("Qté") , 1, 0, 'C', true);  
                        $fpdf->Cell(30, 7,$this->gerer("Montant") , 1, 0, 'C', true);  
                        $fpdf->Ln(10);  
                        $fpdf->SetFont('Times', '', 10);

                    }
                    $fpdf->Cell(7, 7, '', 0, 0);
                        $fpdf->Cell(138, 7,$this->gerer($res['nom_prenoms']) , 0, 0, 'L'); 
                        $fpdf->Cell(10, 7,$this->gerer($res['quantite']) , 0, 0, 'C');  
                        $fpdf->Cell(30, 7,$this->gerer($res['montant']) , 0, 1, 'C');  

                  }

                     $fpdf->SetFillColor(184,220,220);
                      $fpdf->Ln(2);
                  $fpdf->SetFont('Times', 'B', 10);

                      $fpdf->Cell(7, 7, '', 0, 0);
                      $fpdf->Cell(138, 7,$this->gerer("") , 1, 0, 'C', true);                      
                      $fpdf->Cell(10, 7,$this->gerer($qte) , 1, 0, 'C', true);  
                      $fpdf->Cell(30, 7,$this->gerer($total) , 1, 1, 'C', true);          
                   $fpdf->Output(); 
            }
            else
            {
                return redirect()->route('login', 302);
            }
        }
        else
        {
            return redirect()->route('login', 302);
        }
    }

    public function ImprimerEvolutionUniteSoins(Request $request)
    {
        if(Auth::check())
        {
            if($request['annee_debut'] == null)
             {
                $request['annee_debut'] = date('Y');
             }

             if($request['annee_fin'] == null)
             {
                $request['annee_fin'] = date('Y');
             }

            if($request['annee_debut'] != null && $request['annee_fin'] !=  null)
            {
                
                
                

                $result = array();
                $qte = 0;
                $total = 0;
                for($i = $request['annee_debut']; $i <= $request['annee_fin']; $i++)
                {
                $data = DB::select('select count(inner1.unite) as quantite, unites.libelle_unite as nom_prenoms, sum(inner1.prix_net) as montant from (select unite, examen_dossiers.id, sum(prix_net) as prix_net from dossiers, examen_dossiers where dossiers.date_dossier <= \''. $i .'/12/31 23:59:59\' and dossiers.date_dossier >= \''.$i.'/01/01 00:00:00\' and examen_dossiers.code_dossier = dossiers.id group by unite, examen_dossiers.id) as inner1, (select distinct unite from dossiers) as inner2, unites where inner1.unite = inner2.unite and unites.id = inner1.unite::int group by inner1.unite, unites.libelle_unite order by nom_prenoms');
                    if($data)
                    {
                        foreach ($data as $row)
                        {

                           $nestedData['nom_prenoms'] = $row->nom_prenoms;
                           $nestedData['annee'] = $i;
                           $nestedData['quantite'] = $row->quantite;
                           $nestedData['montant'] = $row->montant;
                           $qte += $row->quantite;
                           $total += $row->montant;
                           $result[] = $nestedData;    

                        }
                    }
                }

                //Debut de la création du PDF Proprement dit

                $bottom_margin = 20;
                $page_height = 279.4;
                
                $fpdf = new PDFBilan('P','mm', 'A4');
                $fpdf->SetAuthor('GELAM');
                $fpdf->SetAuthor('GELAM');
                $fpdf->SetCreator('GELAM');

                $fpdf->SetAutoPageBreak(false);
                //Creation de la Premiere Page
                $fpdf->AddPage();
                $fpdf->Image('logo1.jpg', 10,10, 40);
                $fpdf->Image('logo2.jpg', 170,10, 20);
                $fpdf->SetTextColor(0,72,0);   

                $fpdf->SetFont('Times', 'BI', 15);
                  //Ajout d'un espacement au debut
                  $fpdf->Cell(180, 7,'', 0, 1, 'C');  
                  //Creation du titre proprement dit
                  $fpdf->Cell(7, 4,'', 0, 0, 'C'); 

                  $fpdf->Cell(0, 6,'CENTRE D\'ANIMATION SOCIALE ET SANITAIRE', 0, 1, 'C');
                  $fpdf->SetFont('Times', 'B', 18);
                  $fpdf->Cell(0, 5, $this->gerer('LABORATOIRE'), 0, 1, 'C');
                  $fpdf->SetTextColor(0,0,0); 

                  $fpdf->SetFont('Courier', 'B', 12);
                  $fpdf->Cell(0, 5, $this->gerer('HEMATOLOGIE - BIOCHIMIE - BACTERIOLOGIE'), 0, 1, 'C');
                  $fpdf->Cell(0, 5, $this->gerer('IMMUNOLOGIE - PARASITOLOGIE - SEROLOGIE '), 0, 1, 'C');
                  $fpdf->SetFont('Times', '', 10);
                  $fpdf->Cell(0, 5, $this->gerer('BP : 185 Yaoundé-Cameroun - Téléphone : (+237) 222 220 403'), 0, 1, 'C');
                  $fpdf->Cell(0, 5, $this->gerer('Email : cassnkolndongo@yahoo.fr'), 0, 1, 'C');
                  $fpdf->SetFont('Times', 'B', 10);
                  $fpdf->SetTextColor(255,0,0);   
                  $fpdf->Cell(0, 5, $this->gerer('Situé à Nkolndongo'), 0, 1, 'C');
                  $fpdf->SetTextColor(0,0,0);   

                  $fpdf->SetDrawColor(0,72,0);   
                  $fpdf->SetLineWidth(0.5);
                  $fpdf->Line(20,55, 190, 55);
                  $fpdf->Line(20,268, 190, 268);
                  $fpdf->SetFont('Times', 'BU', 14);
                  $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
                  $fpdf->SetDrawColor(0,0,0); 

                  $fpdf->Ln(4);
                  $title = "EVOLUTION QUANTITATIVE DES PRESCRIPTIONS EFFECTUÉES";
                  $fpdf->MultiCell(0, 7, $this->gerer($title), 0, 'C');
                  $fpdf->Ln(5);
                  $dates = array();
                  $fpdf->SetFont('Times', 'B', 10);

                  foreach($result as $res)
                  {
                    $collection = collect([
                            'mois' => $res['annee'],
                        ]);
                    $fpdf = $this->CheckPiedsDePage($fpdf, $page_height, $request, $title);
                    if(!$this->MoisExist($dates, $collection))
                    {
                        array_push( $dates, $collection);
                        $fpdf->Ln(2);
                        $fpdf->SetFont('Times', 'B', 15);
                        $fpdf->Cell(10, 7, '', 0,0);
                        $fpdf->Cell(70, 7, $this->gerer('Année de Référence ' . $res['annee']), 0, 1);
                        $fpdf->Ln(5);
                        $fpdf->SetFont('Times', 'B', 10);
                        $fpdf->SetFillColor(200,200,200);
                        $fpdf->Cell(7, 7, '', 0, 0);
                        $fpdf->Cell(138, 7,$this->gerer("Analyses") , 1, 0, 'C', true); 
                        $fpdf->Cell(10, 7,$this->gerer("Qté") , 1, 0, 'C', true);  
                        $fpdf->Cell(30, 7,$this->gerer("Montant") , 1, 0, 'C', true);  
                        $fpdf->Ln(10);  
                        $fpdf->SetFont('Times', '', 10);

                    }
                    $fpdf->Cell(7, 7, '', 0, 0);
                        $fpdf->Cell(138, 7,$this->gerer($res['nom_prenoms']) , 0, 0, 'L'); 
                        $fpdf->Cell(10, 7,$this->gerer($res['quantite']) , 0, 0, 'C');  
                        $fpdf->Cell(30, 7,$this->gerer($res['montant']) , 0, 1, 'C');  

                  }

                     $fpdf->SetFillColor(184,220,220);
                      $fpdf->Ln(2);
                  $fpdf->SetFont('Times', 'B', 10);

                      $fpdf->Cell(7, 7, '', 0, 0);
                      $fpdf->Cell(138, 7,$this->gerer("") , 1, 0, 'C', true);                      
                      $fpdf->Cell(10, 7,$this->gerer($qte) , 1, 0, 'C', true);  
                      $fpdf->Cell(30, 7,$this->gerer($total) , 1, 1, 'C', true);          
                   $fpdf->Output(); 
            }
            else
            {
                return redirect()->route('login', 302);
            }
        }
        else
        {
            return redirect()->route('login', 302);
        }
    }


    public function MoisExist($groups, $group)
    {
      foreach($groups as $gp)
      {
          if($gp['mois'] == $group['mois'])
        {
          return true;
        }
      }
      return false;
    }

    public function PrescripteurExist($groups, $group)
    {
      foreach($groups as $gp)
      {
          if($gp['nom_prenoms'] == $group['nom_prenoms'])
        {
          return true;
        }
      }
      return false;
    }


    public function ImprimerStatistiquePathologieGenerale(Request $request)
    {
        if(Auth::check())
        {

            $this->addEvent('liste_statistique_pathologie_generale', $request->ip(),0, Auth::id(), "Affichage des Statistiques Générales sur les Pathologies");
            $resultats = Resultat::where('created_at', '>=', $request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->where('id_examen', $request['examen'])->where('id_element', $request['rendu'])->where('valide', 1)->get();

            $min = 0;
            $max = 0;
            $i = 0;

            $tab = $request['resultats'];


            foreach ($resultats as $resultat) 
            {
                if($this->checkValue($tab, $resultat->valeur))
                {

                    $dossier = Dossier::find($resultat->id_dossier);
                    $patient = Patient::find($dossier->id_patient);
                    $bday = new DateTime($patient->date_naissance);
                    $today = new DateTime($dossier->date_dossier);          
                    $diff = $today->diff($bday);
                    $age = $diff->y;

                    if($i == 0)
                    {
                        $min = $age;
                        $max = $age;
                    }
                    else
                    {
                        if($age > $max)
                        {
                            $max = $age;
                        }

                        if($age < $min)
                        {
                            $min = $age;
                        }
                    }

                    $i++;
                }
            }

            $final = array();

            $borne_min = $min;
            $borne_max = $min + 5;

            do {

                $result = array();
                $resultats = Resultat::where('created_at', '>=', $request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->where('valide', 1)->where('id_examen', $request['examen'])->where('id_element', $request['rendu'])->get();

                foreach($resultats as $res)
                {
                    $dossier = Dossier::find($res->id_dossier);
                    $patient = Patient::find($dossier->id_patient);

                    if($request['genre'] != 'tous')
                    {                   
                        if($request['genre'] == 'hommes')
                        {
                            if($patient->sexe != 'Masculin')
                            {
                                continue;
                            }
                        }
                        else if($request['genre'] == 'femmes')
                        {
                            if($patient->sexe != 'Feminin')
                            {
                                continue;
                            }
                        }
                        else if($request['genre'] == 'enceintes')
                        {
                            if($dossier->enceinte == 0)
                            {
                                continue;
                            }
                        }
                    }
                    $bday = new DateTime($patient->date_naissance);
                    $today = new DateTime($dossier->date_dossier);          
                    $diff = $today->diff($bday);
                    $age = $diff->y;

                    if($age < $borne_min || $age > $borne_max)
                    {
                        continue;
                    }
                    $collection = collect([
                        'id' => $res->id,
                        'valeur' => $res->valeur,
                    ]);
                    array_push( $result, $collection);  
                }

                $collection = collect([

                    'tranche_age' => $borne_min . '-' . $borne_max,
                ]); 

                $collection->put('total', count($result));
                $tab = $request['resultats'];
                $jjk = 1;   
                foreach ($tab as $val)
                {
                    $nbre_total = 0;
                    foreach($result as $res)
                    {
                        if($res['valeur'] == $val)
                        {
                            $nbre_total++;
                        }
                    }
                    
                    $collection->put('colonne'. $jjk, $nbre_total);
                    $jjk++;
                }
                array_push($final, $collection);

            $borne_min = $borne_max + 1;
            $borne_max = $borne_min + 5;        
            } while ($borne_min < $max);        

            //Debut de la création du PDF Proprement dit

                $bottom_margin = 20;
                $page_height = 279.4;
                
                $fpdf = new PDFBilan('P','mm', 'A4');
                $fpdf->SetAuthor('GELAM');
                $fpdf->SetAuthor('GELAM');
                $fpdf->SetCreator('GELAM');

                $fpdf->SetAutoPageBreak(false);
                //Creation de la Premiere Page
                $fpdf->AddPage();
                $fpdf->Image('logo1.jpg', 10,10, 40);
                $fpdf->Image('logo2.jpg', 170,10, 20);
                $fpdf->SetTextColor(0,72,0);   

                $fpdf->SetFont('Times', 'BI', 15);
                  //Ajout d'un espacement au debut
                  $fpdf->Cell(180, 7,'', 0, 1, 'C');  
                  //Creation du titre proprement dit
                  $fpdf->Cell(7, 4,'', 0, 0, 'C'); 

                  $fpdf->Cell(0, 6,'CENTRE D\'ANIMATION SOCIALE ET SANITAIRE', 0, 1, 'C');
                  $fpdf->SetFont('Times', 'B', 18);
                  $fpdf->Cell(0, 5, $this->gerer('LABORATOIRE'), 0, 1, 'C');
                  $fpdf->SetTextColor(0,0,0); 

                  $fpdf->SetFont('Courier', 'B', 12);
                  $fpdf->Cell(0, 5, $this->gerer('HEMATOLOGIE - BIOCHIMIE - BACTERIOLOGIE'), 0, 1, 'C');
                  $fpdf->Cell(0, 5, $this->gerer('IMMUNOLOGIE - PARASITOLOGIE - SEROLOGIE '), 0, 1, 'C');
                  $fpdf->SetFont('Times', '', 10);
                  $fpdf->Cell(0, 5, $this->gerer('BP : 185 Yaoundé-Cameroun - Téléphone : (+237) 222 220 403'), 0, 1, 'C');
                  $fpdf->Cell(0, 5, $this->gerer('Email : cassnkolndongo@yahoo.fr'), 0, 1, 'C');
                  $fpdf->SetFont('Times', 'B', 10);
                  $fpdf->SetTextColor(255,0,0);   
                  $fpdf->Cell(0, 5, $this->gerer('Situé à Nkolndongo'), 0, 1, 'C');
                  $fpdf->SetTextColor(0,0,0);   

                  $fpdf->SetDrawColor(0,72,0);   
                  $fpdf->SetLineWidth(0.5);
                  $fpdf->Line(20,55, 190, 55);
                  $fpdf->Line(20,268, 190, 268);
                  $fpdf->SetFont('Times', 'BU', 14);
                  $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
                  $fpdf->SetDrawColor(0,0,0); 

                  $fpdf->Ln(4);
                  $title = "STATISTIQUES GENERALE DES PATHOLOGIES";
                  $fpdf->MultiCell(0, 7, $this->gerer($title), 0, 'C');
                  $fpdf->Ln(5);
                  

                  $fpdf->SetFont('Times', 'B', 10);
                        $fpdf->SetFillColor(200,200,200);
                        $fpdf->Cell(7, 7, '', 0, 0);
                        $fpdf->Cell(30, 7,$this->gerer("Tranche d'age") , 1, 0, 'C', true); 
                        $fpdf->Cell(30, 7,$this->gerer("Total") , 1, 0, 'C', true);  
                        $tuf = $request['resultats'];   
                        foreach($tuf as $tut)
                        {
                            $fpdf->Cell(118/count($tuf), 7,$this->gerer($tut) , 1, 0, 'C', true);  
                        }
                  
                        $fpdf->Ln(10);

                 foreach($final as $fin)      
                 {
                    $fpdf->SetFillColor(255,255,255);
                        $fpdf->Cell(7, 7, '', 0, 0);
                        $fpdf->Cell(30, 7,$this->gerer($fin['tranche_age']) , 0, 0, 'C', true); 
                        $fpdf->Cell(30, 7,$this->gerer($fin['total']) , 0, 0, 'C', true);  
                        $tuf = $request['resultats'];
                        $jjk = 1;   
                        foreach($tuf as $tut)
                        {
                            $fpdf->Cell(118/count($tuf), 7,$this->gerer($fin['colonne'.$jjk]) , 0, 0, 'C', true); 
                            $jjk++; 
                        }
                 }          
                  $fpdf->Output();
        }
        else
        {
            return redirect()->route('login', 302);
        }   
    }

    public function ImprimerStatistiquePathologieTrancheAge(Request $request)
    {
        if(Auth::check())
        {
            $this->addEvent('liste_statistique_pathologie_tranche_age', $request->ip(),0, Auth::id(), "Affichage des Statistiques Par Tranche d'age sur les Pathologies");
            $result = array();
            $resultats = Resultat::where('created_at', '>=', $request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->where('valide', 1)->where('id_examen', $request['examen'])->where('id_element', $request['rendu'])->get();
            
            foreach($resultats as $res)
            {
                $dossier = Dossier::find($res->id_dossier);
                $patient = Patient::find($dossier->id_patient);

                if($request['genre'] != 'tous')
                {                   
                    if($request['genre'] == 'hommes')
                    {
                        if($patient->sexe != 'Masculin')
                        {
                            continue;
                        }
                    }
                    else if($request['genre'] == 'femmes')
                    {
                        if($patient->sexe != 'Feminin')
                        {
                            continue;
                        }
                    }
                    else if($request['genre'] == 'enceintes')
                    {
                        if($dossier->enceinte == 0)
                        {
                            continue;
                        }
                    }
                }
                $bday = new DateTime($patient->date_naissance);
                $today = new DateTime($dossier->date_dossier);          
                $diff = $today->diff($bday);
                $age = $diff->y;

                if($age < $request['age_min'] || $age > $request['age_max'])
                {
                    continue;
                }

                $collection = collect([
                    'id' => $res->id,
                    'valeur' => $res->valeur,
                ]);
                array_push( $result, $collection);  


            }

            $tab = $request['resultats'];
            $final = array();

            $collection = collect([
                'colonne' => 1,
                'valeur' => $request['age_min'] .'-'. $request['age_max'],
            ]);
            array_push( $final, $collection);   
            $collection = collect([
                'colonne' => 2,
                'valeur' => count($result),
            ]);
            array_push( $final, $collection);
            $j = 3;
            foreach ($tab as $val)
            {
                $nbre_total = 0;
                foreach($result as $res)
                {
                    if($res['valeur'] == $val)
                    {
                        $nbre_total++;
                    }
                }

                $collection = collect([
                    'colonne' => $j,
                    'valeur' => $nbre_total ,
                ]);
                array_push( $final, $collection);
                $j++;

            }

            //Debut de la création du PDF Proprement dit

                $bottom_margin = 20;
                $page_height = 279.4;
                
                $fpdf = new PDFBilan('P','mm', 'A4');
                $fpdf->SetAuthor('GELAM');
                $fpdf->SetAuthor('GELAM');
                $fpdf->SetCreator('GELAM');

                $fpdf->SetAutoPageBreak(false);
                //Creation de la Premiere Page
                $fpdf->AddPage();
                $fpdf->Image('logo1.jpg', 10,10, 40);
                $fpdf->Image('logo2.jpg', 170,10, 20);
                $fpdf->SetTextColor(0,72,0);   

                $fpdf->SetFont('Times', 'BI', 15);
                  //Ajout d'un espacement au debut
                  $fpdf->Cell(180, 7,'', 0, 1, 'C');  
                  //Creation du titre proprement dit
                  $fpdf->Cell(7, 4,'', 0, 0, 'C'); 

                  $fpdf->Cell(0, 6,'CENTRE D\'ANIMATION SOCIALE ET SANITAIRE', 0, 1, 'C');
                  $fpdf->SetFont('Times', 'B', 18);
                  $fpdf->Cell(0, 5, $this->gerer('LABORATOIRE'), 0, 1, 'C');
                  $fpdf->SetTextColor(0,0,0); 

                  $fpdf->SetFont('Courier', 'B', 12);
                  $fpdf->Cell(0, 5, $this->gerer('HEMATOLOGIE - BIOCHIMIE - BACTERIOLOGIE'), 0, 1, 'C');
                  $fpdf->Cell(0, 5, $this->gerer('IMMUNOLOGIE - PARASITOLOGIE - SEROLOGIE '), 0, 1, 'C');
                  $fpdf->SetFont('Times', '', 10);
                  $fpdf->Cell(0, 5, $this->gerer('BP : 185 Yaoundé-Cameroun - Téléphone : (+237) 222 220 403'), 0, 1, 'C');
                  $fpdf->Cell(0, 5, $this->gerer('Email : cassnkolndongo@yahoo.fr'), 0, 1, 'C');
                  $fpdf->SetFont('Times', 'B', 10);
                  $fpdf->SetTextColor(255,0,0);   
                  $fpdf->Cell(0, 5, $this->gerer('Situé à Nkolndongo'), 0, 1, 'C');
                  $fpdf->SetTextColor(0,0,0);   

                  $fpdf->SetDrawColor(0,72,0);   
                  $fpdf->SetLineWidth(0.5);
                  $fpdf->Line(20,55, 190, 55);
                  $fpdf->Line(20,268, 190, 268);
                  $fpdf->SetFont('Times', 'BU', 14);
                  $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
                  $fpdf->SetDrawColor(0,0,0); 

                  $fpdf->Ln(4);
                  $title = "STATISTIQUES DES PATHOLOGIES PAR TRANCHE D'AGE";
                  $fpdf->MultiCell(0, 7, $this->gerer($title), 0, 'C');
                  $fpdf->Ln(5);
                  $dates = array();
                  $fpdf->SetFont('Times', 'B', 10);

                        $fpdf->SetFillColor(200,200,200);
                        $fpdf->Cell(7, 7, '', 0, 0);
                        $fpdf->Cell(30, 7,$this->gerer("Tranche d'age") , 1, 0, 'C', true); 
                        $fpdf->Cell(30, 7,$this->gerer("Total") , 1, 0, 'C', true);  
                        $tuf = $request['resultats'];   
                        $taille_col = 118/count($tuf);
                        foreach($tuf as $tut)
                        {
                            $fpdf->Cell($taille_col, 7,$this->gerer($tut) , 1, 0, 'C', true);  
                        }
                         $fpdf->Ln(10);
                        $fpdf->SetFillColor(255,255,255);
                        $fpdf->Cell(7, 7, '', 0, 0);
                        $fpdf->Cell(30, 7,$this->gerer($final[0]['valeur']) , 0, 0, 'C'); 
                        $fpdf->Cell(30, 7,$this->gerer($final[1]['valeur']) , 0, 0, 'C');  
                        $tuf = $request['resultats'];   
                        for($i = 2; $i < count($final); $i++)
                        {
                            $fpdf->Cell($taille_col, 7,$this->gerer($final[$i]['valeur']) , 0, 0, 'C');
                        }
                       

                        

                  $fpdf->Output();
        }
        else
        {
            return redirect()->route('login', 302);
        }   
    }


    public function ImprimerStatistiquePathologieRenseignementClinique(Request $request)
    {
        if(Auth::check())
        {
            $this->addEvent('liste_statistique_pathologie_renseigneent_clinique', $request->ip(),0, Auth::id(), "Affichage des Statistiques Par Renseignement Clinique sur les Pathologies");
                $result = array();
                $resultats = Resultat::where('created_at', '>=', $request['date_debut']. ' 00:00:00')->where('created_at', '<=', $request['date_fin'] . ' 23:59:59')->where('valide', 1)->where('id_examen', $request['examen'])->where('id_element', $request['rendu'])->get();
            
                    foreach($resultats as $res)
                    {
                        $dossier = Dossier::find($res->id_dossier);
                        $patient = Patient::find($dossier->id_patient);

                        if($dossier->renseignement != $request['renseignement'])
                        {
                            continue;
                        }

                        if($request['genre'] != 'tous')
                        {                   
                            if($request['genre'] == 'hommes')
                            {
                                if($patient->sexe != 'Masculin')
                                {
                                    continue;
                                }
                            }
                            else if($request['genre'] == 'femmes')
                            {
                                if($patient->sexe != 'Feminin')
                                {
                                    continue;
                                }
                            }
                            else if($request['genre'] == 'enceintes')
                            {
                                if($dossier->enceinte == 0)
                                {
                                    continue;
                                }
                            }
                        }
                        $bday = new DateTime($patient->date_naissance);
                        $today = new DateTime($dossier->date_dossier);          
                        $diff = $today->diff($bday);
                        $age = $diff->y;

                    if($age < $request['age_min'] || $age > $request['age_max'])
                    {
                        continue;
                    }

                    $collection = collect([
                        'id' => $res->id,
                        'valeur' => $res->valeur,
                    ]);
                    array_push( $result, $collection);  


                }

                $tab = $request['resultats'];
                $final = array();

                $collection = collect([
                    'colonne' => 1,
                    'valeur' => $request['age_min'] .'-'. $request['age_max'],
                ]);
                array_push( $final, $collection);   
                $collection = collect([
                    'colonne' => 2,
                    'valeur' => count($result),
                ]);
                array_push( $final, $collection);
                $j = 3;
                foreach ($tab as $val)
                {
                    $nbre_total = 0;
                    foreach($result as $res)
                    {
                        if($res['valeur'] == $val)
                        {
                            $nbre_total++;
                        }
                    }

                    $collection = collect([
                        'colonne' => $j,
                        'valeur' => $nbre_total ,
                    ]);
                    array_push( $final, $collection);
                    $j++;

                }

                $bottom_margin = 20;
                $page_height = 279.4;
                
                $fpdf = new PDFBilan('P','mm', 'A4');
                $fpdf->SetAuthor('GELAM');
                $fpdf->SetAuthor('GELAM');
                $fpdf->SetCreator('GELAM');

                $fpdf->SetAutoPageBreak(false);
                //Creation de la Premiere Page
                $fpdf->AddPage();
                $fpdf->Image('logo1.jpg', 10,10, 40);
                $fpdf->Image('logo2.jpg', 170,10, 20);
                $fpdf->SetTextColor(0,72,0);   

                $fpdf->SetFont('Times', 'BI', 15);
                  //Ajout d'un espacement au debut
                  $fpdf->Cell(180, 7,'', 0, 1, 'C');  
                  //Creation du titre proprement dit
                  $fpdf->Cell(7, 4,'', 0, 0, 'C'); 

                  $fpdf->Cell(0, 6,'CENTRE D\'ANIMATION SOCIALE ET SANITAIRE', 0, 1, 'C');
                  $fpdf->SetFont('Times', 'B', 18);
                  $fpdf->Cell(0, 5, $this->gerer('LABORATOIRE'), 0, 1, 'C');
                  $fpdf->SetTextColor(0,0,0); 

                  $fpdf->SetFont('Courier', 'B', 12);
                  $fpdf->Cell(0, 5, $this->gerer('HEMATOLOGIE - BIOCHIMIE - BACTERIOLOGIE'), 0, 1, 'C');
                  $fpdf->Cell(0, 5, $this->gerer('IMMUNOLOGIE - PARASITOLOGIE - SEROLOGIE '), 0, 1, 'C');
                  $fpdf->SetFont('Times', '', 10);
                  $fpdf->Cell(0, 5, $this->gerer('BP : 185 Yaoundé-Cameroun - Téléphone : (+237) 222 220 403'), 0, 1, 'C');
                  $fpdf->Cell(0, 5, $this->gerer('Email : cassnkolndongo@yahoo.fr'), 0, 1, 'C');
                  $fpdf->SetFont('Times', 'B', 10);
                  $fpdf->SetTextColor(255,0,0);   
                  $fpdf->Cell(0, 5, $this->gerer('Situé à Nkolndongo'), 0, 1, 'C');
                  $fpdf->SetTextColor(0,0,0);   

                  $fpdf->SetDrawColor(0,72,0);   
                  $fpdf->SetLineWidth(0.5);
                  $fpdf->Line(20,55, 190, 55);
                  $fpdf->Line(20,268, 190, 268);
                  $fpdf->SetFont('Times', 'BU', 14);
                  $fpdf->Cell(9, 4,'', 0, 0, 'C'); 
                  $fpdf->SetDrawColor(0,0,0); 

                  $fpdf->Ln(4);
                  $title = "STATISTIQUES DES PATHOLOGIES PAR REFERENCEMENT CLINIQUE";
                  $fpdf->MultiCell(0, 7, $this->gerer($title), 0, 'C');
                  $fpdf->Ln(5);
                  $dates = array();
                  $fpdf->SetFont('Times', 'B', 10);
                  $fpdf->SetFillColor(200,200,200);
                        $fpdf->Cell(7, 7, '', 0, 0);
                        $fpdf->Cell(30, 7,$this->gerer("Tranche d'age") , 1, 0, 'C', true); 
                        $fpdf->Cell(30, 7,$this->gerer("Total") , 1, 0, 'C', true);  
                        $tuf = $request['resultats'];   
                        $taille_col = 118/count($tuf);
                        foreach($tuf as $tut)
                        {
                            $fpdf->Cell($taille_col, 7,$this->gerer($tut) , 1, 0, 'C', true);  
                        }
                         $fpdf->Ln(10);
                        $fpdf->SetFillColor(255,255,255);
                        $fpdf->Cell(7, 7, '', 0, 0);
                        $fpdf->Cell(30, 7,$this->gerer($final[0]['valeur']) , 0, 0, 'C'); 
                        $fpdf->Cell(30, 7,$this->gerer($final[1]['valeur']) , 0, 0, 'C');  
                        $tuf = $request['resultats'];   
                        for($i = 2; $i < count($final); $i++)
                        {
                            $fpdf->Cell($taille_col, 7,$this->gerer($final[$i]['valeur']) , 0, 0, 'C');
                        }
                  $fpdf->Output();

        }
        else
        {
            return redirect()->route('login', 302);
        }   
    }

    public function getStatistiquesPostifs(Request $request){
        $categories = array(
                "0-11 ms" => [0, 0],
                "12-23 ms" => [1, 1],
                "2-4 ans" => [2, 4],
                "5-9 ans" => [5, 9],
                "10-14 ans" => [10, 14],
                "15-19 ans" => [15, 19],
                "20-24 ans" => [20, 24],
                "25-29 ans" => [25, 29],
                "30-34 ans" => [30, 34],
                "35-39 ans" => [35, 39],
                "40-44 ans" => [40, 44],
                "45-49 ans" => [45, 49],
                "50-54 ans" => [50, 54], 
                "55-59 ans" => [55, 59],
                "60-64 ans" => [60, 64],
                "65 ans et plus" => [65, 200],
            );

            $result = array();
            $start = $request->get('start');
            $end = $request->get('end');
            $examen = $request->get('examen');
            $nom_examen = Examen::find($examen)->libelle_examen;

            $enceinte = 0;
            $masculin = 0;
            $autre = 0;

            if (strpos($nom_examen,'VIH')>-1) {
                foreach ($categories as $key => $value) {
                    $item = array();
                    $item['categorie'] = $key;

                    $item['enceinte'] = DB::select('select stat_vih_positif(?,?,?,?,?,?,?)', [
                                                $start, $end, '1', 'Feminin', $examen, $value[0], $value[1]])[0]->stat_vih_positif;
                    $enceinte +=$item['enceinte'];

                    $item['masculin'] = DB::select('select stat_vih_positif(?,?,?,?,?,?,?)', [
                                                $start, $end, '0', 'Masculin', $examen, $value[0], $value[1]])[0]->stat_vih_positif;
                    $masculin += $item['masculin'];

                    $item['autre'] = DB::select('select stat_vih_positif(?,?,?,?,?,?,?)', [
                                                $start, $end, '0', 'Feminin', $examen, $value[0], $value[1]])[0]->stat_vih_positif;
                    $autre += $item['autre'];

                    $item['total'] = $item['enceinte'] + $item['masculin'] + $item['autre'];
                    $result[] = $item;
                }
            }else{
                #Autres Examens
                foreach ($categories as $key => $value) {
                    $item = array();
                    $item['categorie'] = $key;

                    $item['enceinte'] = DB::select('select stat_positifs(?,?,?,?,?,?,?)', [
                                                $start, $end, '1', 'Feminin', $examen, $value[0], $value[1]])[0]->stat_positifs;
                    $enceinte +=$item['enceinte'];

                    $item['masculin'] = DB::select('select stat_positifs(?,?,?,?,?,?,?)', [
                                                $start, $end, '0', 'Masculin', $examen, $value[0], $value[1]])[0]->stat_positifs;
                    $masculin += $item['masculin'];

                    $item['autre'] = DB::select('select stat_positifs(?,?,?,?,?,?,?)', [
                                                $start, $end, '0', 'Feminin', $examen, $value[0], $value[1]])[0]->stat_positifs;
                    $autre += $item['autre'];

                    $item['total'] = $item['enceinte'] + $item['masculin'] + $item['autre'];
                    $result[] = $item;
                }
            }
            
            $item =array();
            $item['categorie'] = 'Totales';
            $item['enceinte'] = $enceinte;
            $item['masculin'] = $masculin;
            $item['autre'] = $autre;
            $item['total'] = $enceinte+$masculin+$autre;
            $item['total'] = $item['enceinte'] + $item['masculin'] + $item['autre'];
            $result[] = $item;
            
            return json_encode($result);
    }

    public function GetListeGeneraleExamens(Request $request)
    {
        if(Auth::check())
        {
            $categories = array(
                "0-11 ms" => [0, 0],
                "12-23 ms" => [1, 1],
                "2-4 ans" => [2, 4],
                "5-9 ans" => [5, 9],
                "10-14 ans" => [10, 14],
                "15-19 ans" => [15, 19],
                "20-24 ans" => [20, 24],
                "25-29 ans" => [25, 29],
                "30-34 ans" => [30, 34],
                "35-39 ans" => [35, 39],
                "40-44 ans" => [40, 44],
                "45-49 ans" => [45, 49],
                "50-54 ans" => [50, 54], 
                "55-59 ans" => [55, 59],
                "60-64 ans" => [60, 64],
                "65 ans et plus" => [65, 200],
            );

            $result = array();
            $start = $request->get('start');
            $end = $request->get('end');
            $examen = $request->get('examen');
            $nom_examen = Examen::find($examen)->libelle_examen;

            $enc_pos = 0;
            $enc_neg = 0;
            $enc_ind = 0;
            $mas_pos = 0;
            $mas_neg = 0;
            $mas_ind = 0;
            $aut_pos = 0;
            $aut_neg = 0;
            $aut_ind = 0;

            if (strpos($nom_examen,'VIH')>-1) {
                #Statistiques de VIH
                foreach ($categories as $key => $value) {
                    $item = array();
                    $item['categorie'] = $key;
                    #Statistiques de examens positifs par categorie des personnes
                    $item['fep'] = DB::select('select stat_vih_positif(?,?,?,?,?,?,?)', [
                                                $start, $end, '1', 'Feminin', $examen, $value[0], $value[1]])[0]->stat_vih_positif;
                    $enc_pos +=$item['fep'];

                    $item['masp'] = DB::select('select stat_vih_positif(?,?,?,?,?,?,?)', [
                                                $start, $end, '0', 'Masculin', $examen, $value[0], $value[1]])[0]->stat_vih_positif;
                    $mas_pos += $item['masp'];

                    $item['afp'] = DB::select('select stat_vih_positif(?,?,?,?,?,?,?)', [
                                                $start, $end, '0', 'Feminin', $examen, $value[0], $value[1]])[0]->stat_vih_positif;
                    $aut_pos += $item['afp'];

                    $item['totp'] = $item['fep'] + $item['masp'] + $item['afp'];

                    #Statistiques de examens negatifs par categorie des personnes
                    $item['fen'] = DB::select('select stat_vih_negatif(?,?,?,?,?,?,?)', [
                                                $start, $end, '1', 'Feminin', $examen, $value[0], $value[1]])[0]->stat_vih_negatif;
                    $enc_neg +=$item['fen'];

                    $item['masn'] = DB::select('select stat_vih_negatif(?,?,?,?,?,?,?)', [
                                                $start, $end, '0', 'Masculin', $examen, $value[0], $value[1]])[0]->stat_vih_negatif;
                    $mas_neg += $item['masn'];

                    $item['afn'] = DB::select('select stat_vih_negatif(?,?,?,?,?,?,?)', [
                                                $start, $end, '0', 'Feminin', $examen, $value[0], $value[1]])[0]->stat_vih_negatif;
                    $aut_neg += $item['afn'];

                    $item['totn'] = $item['fen'] + $item['masn'] + $item['afn'];

                    #Statistiques de resultats indetermine
                    $item['fei'] = DB::select('select stat_vih_indet(?,?,?,?,?,?,?)', [
                                                $start, $end, '1', 'Feminin', $examen, $value[0], $value[1]])[0]->stat_vih_indet;
                    $enc_ind +=$item['fei'];

                    $item['masi'] = DB::select('select stat_vih_indet(?,?,?,?,?,?,?)', [
                                                $start, $end, '0', 'Masculin', $examen, $value[0], $value[1]])[0]->stat_vih_indet;
                    $mas_ind += $item['masi'];

                    $item['afi'] = DB::select('select stat_vih_indet(?,?,?,?,?,?,?)', [
                                                $start, $end, '0', 'Feminin', $examen, $value[0], $value[1]])[0]->stat_vih_indet;
                    $aut_ind += $item['afi'];

                    $item['toti'] = $item['fei'] + $item['masi'] + $item['afi'];

                    $result[] = $item;
                }
            }else{
                #Autres examens
                foreach ($categories as $key => $value) {
                    $item = array();
                    $item['categorie'] = $key;
                    #Statistiques de examens positifs par categorie des personnes
                    $item['fep'] = DB::select('select stat_positifs(?,?,?,?,?,?,?)', [
                                                $start, $end, '1', 'Feminin', $examen, $value[0], $value[1]])[0]->stat_positifs;
                    $enc_pos +=$item['fep'];

                    $item['masp'] = DB::select('select stat_positifs(?,?,?,?,?,?,?)', [
                                                $start, $end, '0', 'Masculin', $examen, $value[0], $value[1]])[0]->stat_positifs;
                    $mas_pos += $item['masp'];

                    $item['afp'] = DB::select('select stat_positifs(?,?,?,?,?,?,?)', [
                                                $start, $end, '0', 'Feminin', $examen, $value[0], $value[1]])[0]->stat_positifs;
                    $aut_pos += $item['afp'];

                    $item['totp'] = $item['fep'] + $item['masp'] + $item['afp'];

                    #Statistiques de examens negatifs par categorie des personnes
                    $item['fen'] = DB::select('select stat_examens_negatifs(?,?,?,?,?,?,?)', [
                                                $start, $end, '1', 'Feminin', $examen, $value[0], $value[1]])[0]->stat_examens_negatifs;
                    $enc_neg +=$item['fen'];

                    $item['masn'] = DB::select('select stat_examens_negatifs(?,?,?,?,?,?,?)', [
                                                $start, $end, '0', 'Masculin', $examen, $value[0], $value[1]])[0]->stat_examens_negatifs;
                    $mas_neg += $item['masn'];

                    $item['afn'] = DB::select('select stat_examens_negatifs(?,?,?,?,?,?,?)', [
                                                $start, $end, '0', 'Feminin', $examen, $value[0], $value[1]])[0]->stat_examens_negatifs;
                    $aut_neg += $item['afn'];

                    $item['totn'] = $item['fen'] + $item['masn'] + $item['afn'];

                    $result[] = $item;
                }
            }

            $item = array();
            $item['categorie'] = 'TOTAL';
            $item['fep'] = $enc_pos;
            $item['fen'] = $enc_neg;
            $item['fei'] = $enc_ind;
            $item['masp'] = $mas_pos;
            $item['masn'] = $mas_neg;
            $item['masi'] = $mas_ind;
            $item['afp'] = $aut_pos;
            $item['afn'] = $aut_neg;
            $item['afi'] = $aut_ind;
            $item['totn'] = $enc_neg + $mas_neg + $aut_neg;
            $item['totp'] = $enc_pos + $mas_pos + $aut_pos;
            $item['toti'] = $enc_ind + $mas_ind + $aut_ind;

            $result[] = $item;

            return json_encode($result);
        }
        else
        {
            return redirect()->route('login', 302);
        }
    }

}


class PDFBilan extends FPDF
  {
    public $date = "";
    function Footer()
    {
            
        // Go to 1.5 cm from bottom
        $this->SetY(-35 );
        // Select Arial italic 8
        $this->SetFont('Arial','IB',6);
        
        // Print centered page number
        
        $this->Cell(186,5,'Page '.$this->PageNo(),0,0,'R');
    }

    public function gerer($str)
    {
      return iconv('UTF-8', 'windows-1252', $str);
    } 
  }
