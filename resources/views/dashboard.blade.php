@extends("default")

@section('style_sidebar')
<style type="text/css">
    @font-face {
font-family: BrushScriptStd;
src: url('{{ URL::asset('fonts/BrushScriptStd.otf') }}');
}
.nav-sidebar { 
    background-color: LightSlateGray ;
    width: 100%;
    padding: 30px 0; 
    border-right: 1px solid rgb(103,184,120); 
}
#en1{
  background-image: url("{{ URL::asset('Slider/back2.jpg') }}");
  background-repeat: no-repeat;
  background-size: cover;
}
#en{
  background-image: url("{{ URL::asset('Slider/back2.jpg') }}");
  background-repeat: repeat;
}
.dataTables_wrapper .dataTables_processing {

  /*padding-top: 70px;
  background-color: black!important;
  height: 180px!important;
  font-weight: bold!important;
  font-size: 1.5em!important;
  font-style: italic;*/
}
#tableId tr {
    cursor: pointer;
}
.nav-sidebar a {
    color: white ;
    -webkit-transition: all 0.08s linear;
    -moz-transition: all 0.08s linear;
    -o-transition: all 0.08s linear;
    transition: all 0.08s linear;
}
.modal{
  overflow-y: scroll!important;
}
.logoc{
    font-family: "BrushScriptStd";
    text-align:center;
    line-height: 0;

}
.nav-sidebar .active a { 
    
    background-color: rgb(103,184,120);
    color: white;
}
.nav-sidebar .active a:hover {
    background-color: rgb(57,121,70);
}
.nav-sidebar .text-overflow a,
.nav-sidebar .text-overflow .media-body {
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis; 
}  
#newS{
  height: 20px;
}
#newS li{
    margin-right: 10px;
}
#newS li i{
    margin-right: 5px;
}

 .align-right{text-align:right;max-width:80px} 
 .align-left{text-align:left;max-width:80px} 
 .align-center{text-align:center;max-width:80px} 
 .btnExcel{
  color: #ffffff!important; 
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25)!important; 
  background-color: #006dcc!important; 
  height:50px!important;
  width: 160px!important; 
  font-size: 1.2em!important;  
  background-color: #0044cc!important; 
  background-image: -moz-linear-gradient(top, #0088cc, #0044cc)!important; 
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0044cc))!important; 
  background-image: -webkit-linear-gradient(top, #0088cc, #0044cc)!important; 
  background-image: -o-linear-gradient(top, #0088cc, #0044cc)!important; 
  background-image: linear-gradient(to bottom, #0088cc, #0044cc)!important; 
  background-repeat: repeat-x!important; 
  border-color: #0044cc #0044cc #002a80!important; 
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25)!important; 
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0088cc', endColorstr='#ff0044cc', GradientType=0)!important; 
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)!important; 
}
@yield('add_style')  
</style>
<script type="text/javascript">
</script>
@endsection
@section('en-tete')
    
     <div id="en1" class="container"  style="position: relative;min-height: 66px; width:100%;">
          <div class="row">
            

              
              <div class="col-sm-8" style="width:950px;">
                  <div class="row">
                      <div class="col-sm-3 logoc">
                        <h6>
                          <p> <span style="font-size:60px">CASS</span><br>Reussir Ensemble</p>
                           <p style="text-align:center"><span style="font-size:15px;font-family:calibri;color:rgb(0,109,0); font-weight:bold">Centre Médical <br/> Mgr Jean Zoa </span></p>
                        </h6>
                      </div>
                      <div class="col-sm-9 col-sm-offset-" style="padding-top:15px">
                          <!-- <h4 style="font-size:28px; ">LABORATOIRE DU CASS</h4>BrushScriptStd -->
                          <p><span style="font-family:calibri;color:rgb(0,109,0);font-size:40px">Centre d’Animation Sociale et Sanitaire</span></p>
                        <h4 class="text-center" style="font-family:calibri;font-weight:bold">HEMATOLOGIE - BIOCHIMIE - BACTERIOLOGIE - IMMUNOLOGIE - IMMUNO-BACTERIOLOGIE - SEROLOGIE - PARASITOLOGIE</h4>
                      </div>
                  </div>
              </div>
               
              <div class="col-sm-4" id="en3" style="width:35%">
                 <div class="row" >
                     <div class="col-sm-1 text-left" style="width:100px">
                
                         <img src="{{ URL::asset('Slider/LOGO_GELAM_3.png') }}" style="height:68px;" class="img-responsive" alt="Logo Gelam">
                         

                         
                    </div>
                    <div class="col-sm-8 col-sm-offset-1 text-left">
                        <div >
                             <h5 style="font-weight:bold;">SYSTEME INFORMATISÉ<br/>DE GESTION DES LABORATOIRES<br/>D'ANALYSES MEDICALES</h5>
                         </div>
                    </div>
                 </div>
                <div class="row text-center" style="background-color:white; border-radius:10px;width: height:50px; -webkit-box-shadow: 0 8px 6px -6px #999;-moz-box-shadow: 0 8px 6px -6px #999;box-shadow: 0 8px 6px -6px #999;">  
                    <div>  
                    <div class="col-sm-2" style="top:5px; padding-top:10px;">
                        <a href="{{URL::asset('/dashboard')}}" ><i class="glyphicon glyphicon-home" onfocus="this.style.color='rgb(57,121,70)';" onmouseover="this.style.color='rgb(57,121,70)';" onmouseout="this.style.color='rgb(103,184,120)';" style=" height:50px; color:rgb(103,184,120); "> HOME</i></a>
                    </div>
                    <div class="col-sm-2" style=" padding-top:16px;">
                        <a href="{{ URL::asset('monguidegelam.pdf') }}" target="_blank"  ><i class="glyphicon glyphicon-question-sign" onfocus="this.style.color='rgb(57,121,70)';" onmouseover="this.style.color='rgb(57,121,70)';" onmouseout="this.style.color='rgb(103,184,120)';" style=" height:50px; color:rgb(103,184,120); "> AIDE</i></a>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" onclick="window.location.href='{{URL::asset('/logout')}}'"  class="btn btn-success" style="margin-top:8px;">DECONNEXION</button>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" id="fulld" class="btn btn-success" style="margin-top:8px; margin-left :2px; width:130px"><i class="glyphicon glyphicon-fullscreen"></i> FULLSCREEN</button>
                    </div>
                    </div>
                   
                      
                </div>
                
              </div>

            
          </div>
        </div>
@endsection
@section('menu')

<div id="navbar">    
  
            <nav class="navbar navbar-default navbar-static-top" id="stick" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="bar">MENU</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
             
                </div>
                

                <div class="navbar-brand pull-right" style="width:40%;">
                    <div class="row" style="color:gold">
                        <div class="col-sm-7" style="margin-bottom:10px;">
                          <i class="glyphicon glyphicon-user" style=" height:36px; width:36px; text-align:center; " ></i> 
                           <span class="nom_user hidden">@if(Auth::check()){{Auth::user()->name}}   @endif </span> <span class="nom_userF"></span>

         
                        </div>
                        <div class="col-sm-5">
                             @if(Auth::check())   
                                    {{Auth::user()->lprofile}}
                             @endif  
                        </div>
                    </div>
                </div>

                <div class="collapse navbar-collapse " id="navbar-collapse-2" style="width: 70%; ">
                    <ul class="nav navbar-nav " >
                        
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">FICHIER<b class="caret"></b></a> 
                          
                            <ul class="dropdown-menu">

                                <li><a href="{{  URL::asset('/logout')  }}">DECONNEXION</a></li>
                                @if( Auth::user()->profile == 1)
                               
                                <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">OUTILS D'ADMINISTRATION</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('dashboard_utilisateurs_connectes') }}">Utilisateurs Connectés</a></li>
                                        <li><a href="{{ route('dashboard_historique_connexions') }}">Historique des Connexions</a></li>                                  
                                    </ul>
                                </li>                           
                                <li><a href="{{ route('dashboard_profile') }}">PROFILE</a></li>
                                <li><a href="{{ route('dashboard_utilisateurs') }}">UTILISATEUR</a></li>
                                 @endif
                                <li><a href="{{ route('dashboard_mot_passe') }}">MODIFIER MOT DE PASSE</a></li>
                            </ul>
                        </li>
                        @if( Auth::user()->profile != 5 && (Auth::user()->profile != 7) )
                        <li class="dropdown">

                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">PARAMETRES <b class="caret"></b></a> 
                          
                            <ul class="dropdown-menu">
                                @if( Auth::user()->profile != 3 )
                                <li><a href="{{ route('dashboard_agent_editeur') }}">AGENT EDITEUR</a></li>
                                @endif
                                @if( Auth::user()->profile != 2)
                                <li ><a href="{{ route('dashboard_antibiotique') }}">ANTIBIOTIQUE</a></li>
                                <li><a href="{{ route('dashboard_antifongique') }}">ANTIFONGIQUE</a></li>                           
                                <li><a href="{{ route('dashboard_groupe_examen') }}">GROUPE EXAMEN</a></li>
                                <li ><a href="{{ route('dashboard_type_conclusion') }}">TYPE CONCLUSION</a></li>
                                <!--<li><a href="{{ route('dashboard_type_materiel') }}">TYPE MATERIEL</a></li>
                                <li><a href="{{ route('dashboard_materiel') }}">MATERIEL</a></li>-->
                                <li><a href="{{ route('dashboard_type_resultat') }}">TYPE RESULTAT</a></li>
                                <li><a href="{{ route('dashboard_intitule_prelevement') }}">RENSEIGNEMENT CLINIQUE</a></li>
                                <li><a href="{{ route('dashboard_tube') }}">TUBE EXAMEN</a></li>
                                 <li><a href="{{ route('dashboard_nature_echantillon') }}">NATURE ECHANTILLON</a></li>
                                  <li><a href="{{ route('dashboard_pathologies_liees') }}">PATHOLOGIE LIEE</a></li>
                                   <li><a href="{{ route('dashboard_unite') }}">UNITE DE SOINS</a></li>
                                   <li><a href="{{ route('dashboard_quartier') }}">QUARTIER</a></li>
                                @endif
                                @if( Auth::user()->profile != 3 )
                                   <li><a href="{{ route('dashboard_profession') }}">PROFESSION</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif
                         @if( Auth::user()->profile != 7 )
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">TRAITEMENT<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                
                                <li><a href="{{ route('dashboard_patient') }}">PATIENTS</a></li>
                                @if( Auth::user()->profile != 2 )
                                <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">TECHNIQUE</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('dashboard_prelevement') }}">Prélèvement</a></li>
                                        <li><a href="{{ route('dashboard_cahier_paillasse') }}">Cahier de Paillasse</a></li>
                                      @if( Auth::user()->profile != 3 )
                                        <li><a href="{{ route('dashboard_valider_resultat') }}">Validation des résultats</a></li>
                                      @endif
                                        <li><a href="{{ route('dashboard_imprimer_resultat') }}">Impression des résultats</a></li>  

                                    </ul>
                                </li> 
                                <li><a href="{{ route('dashboard_examen') }}">EXAMEN</a></li>
                                <li><a href="{{ route('dashboard_medecin') }}">MEDECIN PRESCRIPTEUR</a></li>
                                @endif
                                <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">HISTORIQUES</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('dashboard_historique_facture') }}">Factures</a></li>
                                        <li><a href="{{ route('dashboard_historique_resultat') }}">Résultats</a></li>
                                    </ul>
                                </li>
                                @if( Auth::user()->profile != 2 )
                                <li><a href="{{ route('dashboard_serotheque') }}">BIOTHEQUE</a></li> 
                                @endif
                            </ul>
                        </li>
                        @endif
                       @if( Auth::user()->profile == 1 || Auth::user()->profile == 4 || Auth::user()->profile == 6 || Auth::user()->profile == 7)
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">BILAN <b class="caret"></b></a> 
                          
                            <ul class="dropdown-menu">
                                 <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">STATISTIQUES DES PATHOLOGIES</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('dashboard_statistique_pathologique_general') }}">GENERAL</a></li>
                                        <li><a href="{{ route('dashboard_statistique_pathologique_tranche') }}">PAR TRANCHE D'AGE</a></li>
                                        <li><a href="{{ route('dashboard_statistique_pathologique_renseignement') }}">PAR RENSEIGNEMENT CLINIQUE </a></li>  

                                    </ul>
                                </li> 
                                <li><a href="{{ route('dashboard_statistique_positifs') }}">STATISTIQUES DES POSITIFS</a></li>
                                <li><a href="{{ route('dashboard_statistique_examens') }}">STATISTIQUES DES EXAMENS</a></li>
                                 <li><a href="{{ route('dashboard_statistique_profession') }}">STATISTIQUES DES PROFESSIONS</a></li>
                                <li><a href="{{ route('dashboard_rapport_activite') }}">RAPPORT ACTIVITE</a></li>
                                <li><a href="{{ route('dashboard_evolution_analyse') }}">EVOLUTIONS ANALYSES</a></li>
                                <li><a href="{{ route('dashboard_evolution_prescriptions_medecin') }}">EVOLUTIONS PRESCRIPTIONS</a></li>
                                <li><a href="{{ route('dashboard_evolution_unite_soin') }}">EVOLUTIONS UNITE DE SOINS</a></li>    
                            </ul>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">ETATS <b class="caret"></b></a> 
                          
                            <ul class="dropdown-menu">
                                  <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">ETATS CHIFFRE AFFAIRE</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('dashboard_evolution_ca_quotidien') }}">QUOTIDIEN</a></li>
                                         <li><a href="{{ route('dashboard_evolution_ca_hebdomadaire') }}">HEBDOMADAIRE</a></li>
                                        <li><a href="{{ route('dashboard_evolution_ca_mensuel') }}">MENSUEL</a></li>
                                        <li><a href="{{ route('dashboard_evolution_ca_annuel') }}">ANNUEL</a></li>  

                                    </ul>
                                </li>
                               <li><a href="{{ route('dashboard_etats_biotheques') }}">ETATS BIOTHEQUES</a></li>
                                <li><a href="{{ route('dashboard_impayes') }}">IMPAYES</a></li>    
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
          <!--   <nav class="navbar navbar-default" id="newS"  style="min-height:30px; background-color:LightSlateGray; color:white;">
                <ul class="list-inline" style="padding:5px">
                   <li><a  href="{{ route('dashboard_patient') }}" style="color:white;"><i class="glyphicon glyphicon-list"></i>Patients</a></li>
                    @if((Auth::user()->profile != 2))
                   <li><a  href="{{ route('dashboard_prelevement') }}" style="color:white;"><i class="fa fa-flask"></i>Prelevements</a></li>
                   <li><a  href="{{ route('dashboard_technique') }}" style="color:white;"><i class="glyphicon glyphicon-wrench"></i>Technique</a></li>
                   <li><a  href="{{ route('dashboard_cahier_paillasse') }}" style="color:white;"><i class="glyphicon glyphicon-book"></i>Paillasse</a></li>
                     @endif
                      @if( Auth::user()->profile == 1 || Auth::user()->profile == 4 || Auth::user()->profile == 6 )
                    <li><a  href="{{ route('dashboard_valider_resultat') }}" style="color:white;"><i class="glyphicon glyphicon-ok-circle"></i>Valider Résultats</a></li>
                      @endif
                   <li><a  href="{{ route('dashboard_imprimer_resultat') }}" style="color:white;"><i class="glyphicon glyphicon-print"></i>Imprimer Résultats</a></li>
                   <li><a  href="{{ route('dashboard_historique_facture') }}" style="color:white;"><i class="fa fa-history"></i>Historique Facture</a></li>
                   <li><a  href="{{ route('dashboard_historique_resultat') }}" style="color:white;"><i class="fa fa-history"></i>Historique Résultat</a></li>
                   <li><a  href="{{ route('dashboard_alertes') }}" style="color:white;"><i class="fa fa-exclamation-triangle"></i>Alertes</a></li>
                   @if((Auth::user()->profile != 2))
                    <li><a  href="{{ route('dashboard_urgences') }}" style="color:white;"><i class="fa fa-exclamation-triangle"></i>Urgences</a></li>
                   @endif
                </ul>
            </nav> -->
           @if( Auth::user()->profile != 7 ) 
            @if( $present == 1 )
            <div class="row" style="background-color:gold">
                <div class="col-sm-2" style="font-size:16px;font-weight: bold;color:red; padding-top:5px; text-align:center;">
                   <span style="text-decoration:blink">Alertes :</span>
                </div>
                <div class="col-sm-10">
                    <marquee id="alert" behavior="SCROLL">Dossier(s) : &nbsp;&nbsp;&nbsp;&nbsp;N°    
                <?php 
                    $deja =array();
                    $i = 0;
                    $len = count($alertes);
                    foreach ($alertes as $item) {
                      if(!in_array($item->id_dossier, $deja))
                        if(($i == 0)){
                            $v = sprintf("%06d", $item->id_dossier);
                            $deja = array($item->id_dossier);
                            echo  $v;
                        }else{
                          $v = sprintf("%06d", $item->id_dossier);
                          $deja = array($item->id_dossier);
                          echo  ", ". $v ;  
                        }
                      $i++; 
                }?>
                </marquee>
                </div>
                
            </div>
            @endif
           
            @if( $urgence == 1 && (Auth::user()->profile != 2))
            <div class="row" id="barreUrgence" style="background-color:red">
                <div class="col-sm-2" style="font-size:16px;font-weight: bold;color:black; padding-top:5px; text-align:center;">
                   <span style="text-decoration:blink">Urgence(s) :</span>
                </div>
                <div class="col-sm-10" style="font-weight: bold">
                    <marquee id="alert" behavior="SCROLL">Dossier(s) &nbsp;&nbsp;&nbsp;&nbsp;
                     <?php 
                     $i = 0;
                     $len = count($urgences);
                      foreach ($urgences as $ur) {
                        $v = sprintf("%06d", $ur->id);
                              if( ($i == 0) ){
                                echo "N° ". $v . "  ". $ur->nom_patient ;
                              }else{
                                echo ", N° ". $v . "  ". $ur->nom_patient ;
                              }
                              
                         
                        
                        $i++;
                      } 
                    ?>
                </marquee>
                </div>
                
            </div>
             @endif
             @endif
        </div>
@endsection
@section("scroll")
  overflow-y:hidden;
@endsection
@section('Slider')
    <div class="container" style=" width:100%; margin-top:0;height:100%; padding-bottom:0; @yield('bgd')">
    <div  id="side" style="height:" class="col-sm-2" style="float:left; position: relative;padding:0; ">
         <nav class="nav-sidebar" style="height:503px;width:100%; padding:0;padding-top:20px;padding-bottom:"> 
            <ul id="ul_side" class="nav tabs">
              @if((Auth::user()->profile != 7))
              <li class="@yield('active') hoverme"><a style="margin:0"  href="{{ route('dashboard_patient') }}"><div class="row" style=""> <div class="col-sm-10 text-left">  Liste Patient </div><div class="col-sm-2"><i class="glyphicon glyphicon-list"></i></div></div></a></li>
              @endif
              @if((Auth::user()->profile != 2) &&  (Auth::user()->profile != 7))
              <li class="@yield('activePre') hoverme"><a href="{{ route('dashboard_prelevement') }}" ><div class="row"><div class="col-sm-10">Prelevements </div><div class="col-sm-2"><i class="fa fa-flask"></i></div></div></a></li>   
              <li class="@yield('activeTech') hoverme"><a href="{{ route('dashboard_technique') }}" ><div class="row"><div class="col-sm-10">Technique </div><div class="col-sm-2"><i class="glyphicon glyphicon-wrench"></i></div></div></a></li> 
              <li class="@yield('activeCP') hoverme"><a href="{{ route('dashboard_cahier_paillasse') }}" ><div class="row"><div class="col-sm-10">Cahier de Paillasse </div><div class="col-sm-2"><i class="glyphicon glyphicon-book"></i></div></div></a></li>
              @endif
              @if( Auth::user()->profile == 1 || Auth::user()->profile == 4 || Auth::user()->profile == 6 )
              <li class="@yield('activeVR') hoverme"><a href="{{ route('dashboard_valider_resultat') }}" ><div class="row"><div class="col-sm-10">Valider les résultats</div><div class="col-sm-2"><i class="glyphicon glyphicon-ok-circle"></i></div></div></a></li>
              @endif
              @if(Auth::user()->profile != 7)
              <li class="@yield('activeIR') hoverme"><a href="{{ route('dashboard_imprimer_resultat') }}" ><div class="row"><div class="col-sm-10">Imprimer Résultats</div><div class="col-sm-1"><i class=" glyphicon glyphicon-print"></i></div></div></a></li>  
              @endif
              <li class="@yield('activeHF') hoverme"><a href="{{ route('dashboard_historique_facture') }}" ><div class="row"><div class="col-sm-10">Historique Facture</div><div class="col-sm-2"><i class="fa fa-history"></i></div></div></a></li> 
              <li class="@yield('activeHR') hoverme"><a href="{{ route('dashboard_historique_resultat') }}" ><div class="row"><div class="col-sm-10">Historique Résultat</div><div class="col-sm-2"><i class="fa fa-history"></i></div></div></a></li> 
              @if(Auth::user()->profile != 7)
              <li class="@yield('activeHA') hoverme"><a href="{{ route('dashboard_alertes') }}" ><div class="row"><div class="col-sm-10">Alertes</div><div class="col-sm-2"><i class="fa fa-exclamation-triangle"></i></div></div></a></li>  
              @endif
              @if((Auth::user()->profile != 2) && (Auth::user()->profile != 7))
              <li class="@yield('activeHU') hoverme"><a href="{{ route('dashboard_urgences') }}" ><div class="row"><div class="col-sm-10">Urgences</div><div class="col-sm-2"><i class="fa fa-exclamation-triangle"></i></div></div></a></li>                             
              @endif
            </ul>
             <div class="row" id="soc" style="margin-top:17px; margin-bottom:15px; margin-left:20px">
                <p class="social"><a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-google-plus"></i></a></p>
            </div>
        </nav> 
        
    </div>
    <div class="col-sm-10" style="margin-top: 20px; padding-left:20px;">
   
    @yield('d_content')   
    </div>
   <!--  <div  id="side1" class="col-sm-1" style="float:; position: relative;padding:0; ">
      <nav class="nav-sidebar" style="height:100%;width:25%; ">
      </nav>
    </div> -->
</div>
@endsection

@section('style_footer')
 style="margin-top:0;bottom: 0;width: 100%;" 
@endsection

@section('sc')
    <script type="text/javascript">

        document.addEventListener("DOMContentLoaded", function() {
                    
                    var windowHeight = window.innerHeight;

                    var totHeight = $("#en1").height() + $("#navbar").height() ; 
                  //  var social = ((windowHeight - totHeight)+ 30) - $("#ul_side").height();
                   // document.getElementById("side").style.height = ((windowHeight - totHeight)) + "px";

                   // document.getElementById("side1").style.height = ((windowHeight - totHeight)+ 30 + $("#newS").height()) + "px";
                   // document.getElementById("soc").style.marginTop = (social)/3 + "px";
                    @yield('anotherLoad')
                    $("#barreUrgence").show();
                    var str = $(".nom_user").text().split(" ");
                   
                    if(str.length > 1){
                        $(".nom_userF").text( str[0] + " " + str[1] );    
                    }

                    function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 

                   /* for(var i=0; i < tabA.length; i++ ){
                        if(i != 0){
                           $(".dossier").text( $("dossier").text() + "," + pad(tabA[i].id) ); 
                        }else{
                            $(".dossier").text( $("dossier").text() + tabA[i].id );
                        }

                        $(".dossier").text( $("dossier").text() + pad(tabA[i].id_dossier,6));
                    }*/
                    
        });
function fireKeyboardEvent(event, keycode) {
                var keyboardEvent = document.createEventObject ?
                    document.createEventObject() : document.createEvent("Events");

                if(keyboardEvent.initEvent) {
                    keyboardEvent.initEvent(event, true, true);
                }

                keyboardEvent.keyCode = keycode;
                keyboardEvent.which = keycode;

                document.dispatchEvent ? document.dispatchEvent(keyboardEvent) 
                                       : document.fireEvent(event, keyboardEvent);
              }
        $(document).ready(function(){
            $('li').mouseover(function(){
                   if($(this).hasClass('hoverme')){

                        $(this).css("background-color", "rgb(103,184,120)");
                        $(this).css("color", "white");
                        
                    }else if($(this).hasClass('nonhove')){

                        $(this).css("background-color", "white");
                    }
            });
            $("#ho").mouseover(function(){
                    $(this).css("color","rgb(57,121,70)");
            });
            $("#ho").focus(function(){
                    $(this).css("color","rgb(57,121,70)");
            });
            $('li').focus(function(){
                   if($(this).hasClass('hoverme')){

                        $(this).css("background-color", "rgb(57,121,70)");
                        $(this).css("color", "white");
                    }else if($(this).hasClass('nonhove')){

                        $(this).css("background-color", "white");
                    }
            });
            $('li').mouseout(function(){
               if($(this).hasClass('hoverme')){   
                        $(this).css("background-color", "LightSlateGray");
                        $(this).css("color", "white");        
                }

            });
            
       
            
        $("#tableId").on('click', '.clickable', function(event) {
              
              if($(this).hasClass('success')){

                $(this).removeClass('success'); 
              } else {
                $(this).addClass('success').siblings().removeClass('success');
              }
            });
        
        $("#fulld").click(function(){
            
               if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
                   (!document.mozFullScreen && !document.webkitIsFullScreen)) {
                    if (document.documentElement.requestFullScreen) {  
                      document.documentElement.requestFullScreen();  
                    } else if (document.documentElement.mozRequestFullScreen) {  
                      document.documentElement.mozRequestFullScreen();  
                    } else if (document.documentElement.webkitRequestFullScreen) {  
                      document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
                    }  
                  } else {  
                    if (document.cancelFullScreen) {  
                      document.cancelFullScreen();  
                    } else if (document.mozCancelFullScreen) {  
                      document.mozCancelFullScreen();  
                    } else if (document.webkitCancelFullScreen) {  
                      document.webkitCancelFullScreen();  
                    }  
                  } 
                    
             })
             function formatMoney(num , localize,fixedDecimalLength){
                            num=num+"";
                     var str=num;
                            var reg=new RegExp(/(\D*)(\d*(?:[\.|,]\d*)*)(\D*)/g)
                            if(reg.test(num)){ 
                         var pref=RegExp.$1;
                         var suf=RegExp.$3;
                         var part=RegExp.$2;
                               if(fixedDecimalLength/1)part=(part/1).toFixed(fixedDecimalLength/1);
                        if(localize)part=(part/1).toLocaleString();
                  str= pref +part.match(/(\d{1,3}(?:[\.|,]\d*)?)(?=(\d{3}(?:[\.|,]\d*)?)*$)/g ).join(' ')+suf ;
                       };
                    return str;
                  }
             @yield('another')
        });
        
    </script>
@endsection
