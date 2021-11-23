<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>  
 <script src="{{ URL::asset('js/dataTables.min.js') }}" ></script>
 <script src="{{ URL::asset('js/blockUI.js') }}" ></script>  
 <script type="text/javascript">     
  var tab_dossier;
  var tab_facture;  
  var tab_echo;
  var tab_frottis;
  var tab_biopsie;
  var tab_H;
  var tabRC = {!! $intitules->toJson()  !!};
  var tab_medecin = {!! $prescripteurs->toJson()  !!}; 
   var tab_agent = {!! $agent_editeurs->toJson()  !!}; 
  var tab_centre = [];
  var tab_part = [];
  var tab_exam = {!! $examens->toJson()  !!};
  var tab_users = {!! $users->toJson()  !!};
   var tab_GE = {!! $groupe_examens->toJson()  !!};
   var tab_unite = {!! $unites->toJson()  !!};
</script>
<div id="infosPatient" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg" style="width:90%">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
        <button type="button" id="clear2" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title" >Informations sur le patient : <span class="did_sexe hidden"></span><span class="did_nomP"></span> <span class="hidden did_patient"></span></h2>
      </div>
      <div class="modal-body">
          <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#dossier"><span class="hidden nomP">{{Auth::user()->name}}</span> <span class="hidden TU">{{Auth::user()->name}}</span> Dossier</a></li>
        
        <li><a data-toggle="tab"  href="#histo">Historique</a></li>
      </ul>

      <div class="tab-content">
        <div id="dossier" class="tab-pane fade in active ">
          <div class="container-fluid">
            
            <legend style="padding-left:10px;">Dossier</legend>
             <table id="tab_dossier" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMe">
                    
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr  style ="heigth:10px;">
                        <th style="text-align:center;width:45px"><input type="checkbox" id="checkallD" /></th>
                        
                        <th>N° Dossier</th>
                        <th>Date dossier</th>
                        <th>Heure dossier</th>
                        <th>Prescripteur</th>
                        <th>Edité Par</th>
                        <th>N° Facture</th>
                        <th>Facturé Par</th>
                        <th>Etat</th>
                        
                       <!--  <th>Prélévé</th> -->
                        
                      </tr>
                    </thead>
                  
                  </table>
                  <div class="row">
                      <button type="button" id="addD" class="btn btn-primary col-sm-2 col-sm-offset-1" style="width:100px; margin-right:15px;"><i class="glyphicon glyphicon-plus"></i> Ajouter</button>
                      <button type="button" id="InvD" class="invalide-modalD btn btn-success  col-sm-2 col-sm-offset-6" style="width:100px;margin-right:5px;"><i class="fa fa-ticket"></i> Etiquette</button>
                      
                      <button type="button" id="delD" class="delete-modalD btn btn-danger col-sm-2" style="width:100px;margin-right:5px;" ><i class="glyphicon glyphicon-trash"></i>Supprimer</button>
                  </div>
                 

            </div>
        </div>
        <div id="histo" class="tab-pane fade">
            <div class="container-fluid" >
            <legend style="padding-left:10px;">Historique d'examens <button class="btn btn-success text-right glyphicon glyphicon-refresh" style="margin-left:40px; font-size:15px; margin-bottom:5px" id="btnC"> Charger</button> </legend>

            <table id="tab_HR" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMe">
                    
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr  style ="heigth:10px;">
                        <th>Code</th>
                        <th>Libellé</th>
                        <th>Groupe</th>
                        
                      </tr>
                    </thead>
                  </table>
          </div>
        </div>  
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div>

  </div>
</div>
</div>
 <div id="editDossier" class="modal fade" role="dialog" >
  <div class="modal-dialog modal-lg" >

    <!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
            <button type="button" class="close mdCD" >&times;</button>
            <h2 id="titre" class="modal-titleD" >Ajouter un dossier</h2>
        </div>
        
      
      <div class="modal-body">
        <form class="form-horizontal" id="form_dossier" role="form">
            <!-- <div class="form-group" style="margin-bottom:10px;">

            <label for="date"  class="control-label col-sm-3 text-left">Date Dossier : </label>
            <div class="col-sm-7" >
            <input type="date"  class="form-control" id="date" name="date_dossier">
          </div>
                      
                      
            </div> -->
            <div class="form-group">
                <label for="" class="control-label col-sm-3">En Urgence ? : </label>
                <div class="col-sm-4 ">
                  <div class="col-sm-6">
                       <label class="control-label" ><input type="radio" id="EU" value="1"  name="urgence"> Oui</label>       
                  </div>
                  <div class="col-sm-6">
                    <label  class="control-label" ><input type="radio"  id="NU" value="0" checked="checked" name="urgence"> Non</label>
                  </div>
                </div>
                <div class="col-sm-5 " id="CU">
                    <label>Unité de soins :</label><span class="unite-validation validation-error"></span><br>
                    <select class="form-control" id="unite" name="unite">
                          
                   </select>
                </div>
            </div>
            <div class="form-group">
                <!-- <label for="" class="control-label col-sm-3">Préleve ? : </label>
                <div class="col-sm-2">
                  <label class="control-label" ><input type="radio" value="O" id="PO" checked="checked" name="pre">Oui</label>
                </div>
                <div> 
                  <label  class="control-label" ><input type="radio"  value="N" id="PN" name="pre">Non</label>
                </div> -->
                <label for="" class="control-label col-sm-3">N° Facture (*) : <br /><span class="numero_facture-validation validation-error"></span><span class="id_agent_editeur-validation validation-error"></span></label>
               
                  
                <div class="col-sm-4">
                  <input type="text"   name="numero_facture" class="form-control" id="numero_facture">
                </div>
                <div class="col-sm-5">
                  <select class="form-control" name="id_agent_editeur" id="agent_choix" >
                    
                  </select>
                </div>
                
            </div>
            <div class="form-group" style="margin-bottom:10px;">
                <label for="prescripteur" class="control-label col-sm-3 text-left">Prescripteur (*): <br /><span class="nom_prescripteur-validation validation-error"></span></label>
                <div class="col-sm-4">
                   <input  id="prescripteur" class="form-control" name="nom_prescripteur">
                </div>
                <div class="col-sm-5">
                  <select class="form-control" id="prescripteur_choix" >
                    
                  </select>
                </div>
                  
                
            </div>
            <div class="form-group">
                <label for="" class="control-label col-sm-3">Femme enceinte ? : </label>
                <div class="col-sm-4">
                  <div class="col-sm-6">
                       <label class="control-label" ><input type="radio" id="EO" value="1"  name="enceinte"> Oui</label>       
                  </div>
                  <div class="col-sm-6">
                    <label  class="control-label" ><input type="radio"  id="EN" value="0"  name="enceinte"> Non</label>
                  </div>
                </div>
                <label for="reduction" class="control-label col-sm-2 text-left">Reduction (%) : <br /><span class="reduction-validation validation-error"></span></label>
                <div class="col-sm-3">
                  <input type="number"  min="0" max="100"  value="0" name="reduction" class="form-control" id="reduction">
                </div>
            </div>
            
            <input  type="hidden" name="id_dossier" id="id_dossier">
            <input  type="hidden" name="id_patient" id="id_pat">
            <input  type="hidden" name="renseignement_clinique" id="RC">
            <input type="hidden" name="matricule_agent" id="matricule_agent" value="{{Auth::user()->id}}">
            <div class="form-group" style="margin-bottom:10px;">
              
            </div>
            <div class="form-group" style="margin-bottom:10px;">
               <label for="renseignement" class="control-label col-sm-3 text-left">Renseignement Clinique (*) : <br /></label>
                <div class="col-sm-4">
                   <input  id="renseignement" class="form-control" name="renseignement">
                </div>
                <div class="col-sm-5">
                  <select class="form-control" id="renseignement_choix" >
                    
                  </select>
                </div>
            </div>
            
            <div class="row">
              <p class="hidden text-center errorP" style="color:red;font-size:1.3em;font-weight:bold">Veuillez spécifier si le patient est une femme enceinte ou pas !!</p> 
            </div>
            
        </form>
          <div class="deleteContentD">
            <h3 class="text-center">Voulez-vous vraiment supprimer les dossiers sélectionnés ? <span
              class="hidden didD"></span></h3>
      </div>
      </div>
       <div class="modal-footer" id="footerD">
        <button type="button" class="btn actionBtnD" >
        <span id="footer_action_buttonD" class='glyphicon'> </span>
      </button>
      <button type="button" class="btn btn-warning mdCD">
        <span class='glyphicon glyphicon-remove'></span> Close
      </button> 
      </div>
    </div>
  </div>
</div>
<div id="LED" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog  modal-lg" style="width:100%">

    <!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
            <button type="button" class="close mdCLED" >&times;</button>
            <h2 id="titre" class="modal-title" >Liste Examen Dossier <span class="hidden did_dossier"></span></h2>
        </div>
        
      
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-7" style="background-color:rgb(238, 247, 240)">
            
            
           <legend>Examens du dossier <span class="text-right"></span></legend>
           <div class="row" style="margin-bottom:20px;">
              <div class="form-group" >

               <div class="form-group">
                <label for="" class="control-label col-sm-2">En Urgence ? : </label>
                <div class="col-sm-10">
                  <div class="col-sm-2">
                       <label class="control-label" ><input type="radio" id="EU" value="1" disabled="disabled"  name="urgence"> Oui</label>       
                  </div>
                  <div class="col-sm-2">
                    <label  class="control-label" ><input type="radio"  id="NU" value="0" disabled="disabled" checked="checked" name="urgence"> Non</label>
                  </div>
                  <label class="control-label col-sm-2" style="color:red;font-size:2em">Total </label>
                  <div class="col-sm-6">
                    <input type="text" disabled="disabled" class="form-control" style="color:red;font-size:2em" id="montant_total">  
                  </div>
                  
                </div>
              </div>
                        
             </div> 
            </div>
            <div class="table-responsive">
           <table id="tab_LED"  class="table table-striped  table-borderless blockMe">       
                  <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                    <tr  style ="heigth:10px;">
                      <th class="text-left">Code</th>
                      <th class="text-left">Qté</th>
                      <th class="text-left">Libellé</th>
                      <th class="text-left">P.U</th>
                      <th class="text-left">P.T</th>
                      <th class="text-left">Red(%)</th>
                      <th class="text-left">Net</th>
                      <th class="text-left">Delai</th>     
                    </tr>
                  </thead>
          </table>
          </div>
          </div>
        <div class="col-sm-5">
               <legend>Tubes du dossier <span class="text-right"></span></legend>
            <div class="table-responsive">
            <table id="tab_tubeDo"  class="table table-striped  table-borderless blockMe">       
                  <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                    <tr  style ="heigth:10px;">
                      <th class="text-left">Libelle</th>
                      <th class="text-left">Couleur</th>
                      <th class="text-left">Groupe Examen</th>
                      <th class="text-left">Code Barre</th>
                      
                    </tr>
                  </thead>
          </table>
          </div>
          </div>

        </div>
      </div>
       <div class="modal-footer">
      <button type="button" class="btn btn-success text-center mdCLED">
        <span class='glyphicon glyphicon-'></span> OK
      </button> 
      </div>
    </div>
  </div>
</div>
<div id="EDD" class="modal fade" role="dialog" style="overflow-y: scroll;">
   <div class="modal-dialog modal-lg" style="width:100%;">
    <div class="modal-content">
      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
      <button type="button" class="close mdcMC" >&times;</button>
      <h3 class="modal-titleMC"><span class="hidden did_dossier1"></span><span class="hidden did_part"></span> Examen(s) du dossier</h3>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-sm-4"  style="background-color:rgb(238, 247, 240)">
          <legend><span class="hidden did_nbre_total"></span>Liste des Examens</legend>
           <div class="table-responsive">
          <table id="tabMC"  class="table table-striped  table-borderless blockMeMC"> 
          <!-- <table id="tabMC"  class="table table-striped responsive no-wrap table-borderless"> -->
                    
                         
                        <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                          <tr  style ="heigth:10px;">
                            <th class="text-left">Libellé </th>
                            <th class="text-left">Groupe Examen</th>
                           <!--  <th class="text-left">PEC</th> -->
                          </tr>
                          
                        </thead>
                       
           </table>
           </div>
        </div>
        <div class="col-sm-8"  style="background-color:#ffffb3">
          <legend>Examens du dossier</legend>
       
          
        
        <div class="table-responsive" style="margin-top:30px">
          <table id="tabMAC"  class="table table-striped  table-borderless blockMeT">       
                  <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                    <tr  style ="heigth:10px;">
                      <th class="text-left">Code</th>
                      <th class="text-left">Qté</th>
                      <th class="text-left">Libellé</th>
                      <th class="text-left">P.U</th>
                      <th class="text-left">P.T</th>
                      <th class="text-left">Red(%)</th>
                      <th class="text-left">Net</th>
                      <th class="text-left">Delai</th>     
                    </tr>
                  </thead>
          </table>
        </div>
      </div>
      
    </div>
    </div>
    <div class="modal-footer" id="footerI">
      <button type="button" id="valMMC" class="btn btn-success">
        <span class='glyphicon glyphicon-ok-sign'></span> Valider
      </button>
      <button type="button" class="btn btn-warning mdcMC">
        <span class='glyphicon glyphicon-remove'></span> Annuler
      </button>
    </div>
    
   </div>
  </div>
</div>
<div id="MatDel" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcMD">&times;</button>
    <h3 class="modal-title">Confirmation</h3>
  </div>
  <div class="modal-body">
    
      
      <h4>Voulez-vous supprimer cet examen de la liste ? <span class="hidden did_exam_del"></span></h4>
       
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-success" id="ValDel">
      <span class='glyphicon glyphicon-ok-sign'></span> Valider
    </button>
    <button type="button" class="btn btn-warning mdcMD">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
<div id="AddQ" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcAQ">&times;</button>
    <h3 class="modal-title">Quantité de l'examen selectionné <span class="hidden did_row"></span> </h3>
  </div>
  <div class="modal-body">
    
                  <div class="row">
                     <div class="form-group ">
                      <label for="ordre_groupe" class="control-label text-left col-sm-3">Quantité  : <br /> <span class="quantite_examen-validation validation-error"></span></label>
                      <div class="col-sm-8">
                        <input  class="form-control" name="quantite_examen" id="quantite_examen" min="0" value="1" type="number" />   
                      </div>
                      
                    </div>   
                  </div>
                  <input type="hidden" id="id_examenQ">
   
       
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-success" id="valQ">
      <span class='glyphicon glyphicon-ok-sign'></span> Valider
    </button>
    <button type="button" class="btn btn-warning mdcAQ">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
<div id="invaMod" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcIM">&times;</button>
    <h3 class="modal-title">Confirmation</h3>
  </div>
  <div class="modal-body">
      <h4>Voulez-vous invalider les items selectionnés ? <span class="hidden didI"></span></h4>
       
  </div>
  <div class="modal-footer">
    <button type="button" class="invalidate btn btn-success">
      <span class='glyphicon glyphicon-ok-sign'></span> Valider
    </button>
    <button type="button" class="btn btn-warning mdcMD">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
<div id="AlerPre" class="modal fade" role="dialog">
 <div class="modal-dialog" >
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcA">&times;</button>
    <h3 class="modal-titleT"><i class="glyphicon glyphicon-info-sign"></i> Information</h3>
  </div>
  <div class="modal-body">
    <h3 class="infos">Vous devez cocher au moins un dossier !!</h3>
  </div>
  <div class="modal-footer" >
    <button type="button" class="btn btn-warning mdcA">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>

<script type="text/javascript">
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
function validate() {
    
    var valid = true;
    valid = checkEmpty($("#quantite_examen"));
    valid = valid && checkZero($("#quantite_examen"));
    return valid; 
  }
  function validate2() {
    
    var valid = true;
     valid = checkEmpty($("#unite"));
    valid = checkEmpty($("#prescripteur"));
    valid = valid && checkEmpty($("#reduction"));
    return valid; 
  }
  function checkEmpty(obj) {
    var name = $(obj).attr("name");
    $("."+name+"-validation").html(""); 
    $(obj).css("border","");
    if($(obj).val() == "") {
      $(obj).css("border","#FF0000 1px solid");
      $("."+name+"-validation").css("color","#FF0000");
      $("."+name+"-validation").html("Obligatoire");
      return false;
    }
    
    return true;  
  }
  function checkZero(obj) {
    var name = $(obj).attr("name");
    $("."+name+"-validation").html(""); 
    $(obj).css("border","");
    if($(obj).val() == 0) {
      $(obj).css("border","#FF0000 1px solid");
      $("."+name+"-validation").css("color","#FF0000");
      $("."+name+"-validation").html("Qté > 0");
      return false;
    }
    
    return true;  
  }
$(document).ready(function(){
    function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    }
   
  $("#close_Edo").click(function(){

          $("#editDossier").modal('hide');
    });
    $('#tab_dossier').DataTable({
          "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
          "iDisplayLength": 5,
           "bSort" : false
      });
    $('#tab_HR').DataTable({
          "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
          "iDisplayLength": 5,
           "bSort" : false
      });
     $('#tabMC').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
            });
       $('#tabMAC').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": -1,
                "searching": false,
                 "lengthChange": false 
            });
         $('#tab_LED').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 10,
                "searching": false,
                 "lengthChange": false 
            });
   
   
    $('#tab_tubeDo').DataTable({
        "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
        "iDisplayLength": 5,
        "searching": false,
        "lengthChange": false,
        "aaSorting": []
      });
    
      
     
     $('.mdCCR').click(function(){
   
      $("#modalCR").modal("hide");
     });
     $('.mdcT').click(function(){
   
      $("#modRFM").modal("hide");
     
     });
     $('.mdcRFro').click(function(){
   
      $("#modRF").modal("hide");
     });

     $('.mdcRBio').click(function(){
   
      $("#modRBiopsie").modal("hide");
     });

     $('.mdcBCon').click(function(){
   
      $("#ModBCon").modal("hide");
     });

     $('.mdcBMicro').click(function(){
   
      $("#ModBMicro").modal("hide");
     });

     $('.mdcBMacro').click(function(){
   
      $("#ModBMacro").modal("hide");
     });
     $("#btnValT").click(function(){

        if( $("#resultT").val() != "" ){
            $(".erreur").addClass("hidden");
            
            var tr = $("#tabRF tr#item"+ $(".did_renduC").text());
                  tr.find('td:eq(2)').html("" + $("#resultT").val());
                  tr.find('td:eq(3)').html("" + $("#maximumT").val());
                  tr.find('td:eq(4)').html("" + $("#minimumT").val());
                   $('#tabRF').DataTable().rows( tr ).invalidate().draw();
                  $("#modRFM").modal('hide');
        }else{
          $(".erreur").removeClass("hidden");
          $(".erreur").text("Vous devez entrer un resultat !!!");
        }
    });

     $('#tab_HR').on('dblclick', 'tr', function(event) {
         if(this.cells[1].innerHTML != "Code"){

            var str = $(this).attr('id');
            
            var res = str.substring(4);
          
            window.open("{{ route('dashboard_examen_historique') }}?id_examen="+res+"&id_patient="+$(".did_patient").text());

          }
    });
    $('#tab_dossier').on('dblclick', 'tr', function(event) {
         if(this.cells[1].innerHTML != "N° Dossier"){
            var str = $(this).attr('id');
            var res = str.substring(4);
            
          if(this.cells[8].innerHTML != "En Reception" && this.cells[8].innerHTML != "En prélèvement"){         
            $('.did_dossier').text(res);
 
            $("#LED").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
            });
          }else{

             $('.did_dossier1').text(res);
              $.ajax({
                            
                            url: "{{route('dashboard_dossier_show')}}",
                            data: {
                                'id_dossier': res
                            },
                            dataType: "json"
                        })
                        .done(function(msg){
                             nv =  JSON.parse(msg['dossier']); 
                            

                      });
              $("#quantite_examen").val(1);
            $("#EDD").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
            });

          }
        }
    });
    $("#btnC").click(function(){
         $('#tab_HR').dataTable().fnClearTable();
        for(var i=0;i< tab_H.length; i++){

               var data = [
                      pad(tab_H[i].id_examen,6),
                      tab_H[i].libelle_examen,         
                      tab_H[i].libelle_groupe_examen
                             ];
                var rowIndex = $('#tab_HR').dataTable().fnAddData(data);
                var row = $('#tab_HR').dataTable().fnGetNodes(rowIndex);
                $(row).attr( 'id','item' + tab_H[i].id_examen);
                var tr = $("#tab_HR tr#item"+ tab_H[i].id_examen);
                tr.css("cursor","pointer");
                tr.find('td:eq(0)').addClass('text-left');
                tr.find('td:eq(1)').addClass('text-left');
                tr.find('td:eq(2)').addClass('text-left');

        }

    })
    $('#tabMC').on('dblclick', 'tr', function(event) {
                if(this.cells[0].innerHTML != "Libellé"){
                
             var str = $(this).attr('id');
                var res = str.substring(5);
                var qt = 1;
                $.ajax({
                            
                            url: "{{route('dashboard_examen_partenaire_show')}}",
                            data: {
                               
                                'id_examen': res,
                                'quantite': qt,
                                'id_dossier' : $('.did_dossier1').text()
                            },
                            dataType: "json",
                            beforeSend: function(){
                                 $('.blockMe').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                            },
                            complete: function(){
                                $('.blockMe').unblock();
                            }
                        })
                        .done(function(msg){
                             nv =  JSON.parse(msg['examen_partenaire'])[0];

                             
                             lexam = " ";
                              var data = [
                             "<a class='edit-modalMAC' style='cursor:pointer' data-info='" + nv.code + "," + $(".did_dossier1").text() + "," + nv.quantite + "," + lexam + "," + nv.prix_unitaire + "," + nv.prix_total + "," + nv.reduction + "," + nv.prix_net + "," + nv.delai + "'>"+ pad(nv.code,6) + "</a>",
                             nv.quantite,
                             nv.libelle_examen,
                             nv.prix_unitaire,
                             nv.prix_total,
                             nv.reduction,
                             nv.prix_net,
                             nv.delai
                              ];

                              var table = document.getElementById('tabMAC');

                              var rowLength = table.rows.length;
                              var trouve=true;
                              for(var i=0; i<rowLength; i+=1){
                                var row = table.rows[i];

                                if (row.cells[2] == nv.libelle_examen){
                                  var trouve=false;
                                }
                              }
                              if(trouve){
                              var rowIndex = $('#tabMAC').dataTable().fnAddData(data);
                              var row = $('#tabMAC').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','MACrow' + nv.code);
                              var tr = $("#tabMAC tr#MACrow"+ nv.code);
                              tr.css("cursor","pointer");
                              tr.find('td:eq(0)').addClass('text-left');
                              tr.find('td:eq(1)').addClass('text-left');
                              tr.find('td:eq(2)').addClass('text-left');
                              tr.find('td:eq(3)').addClass('text-left');
                              tr.find('td:eq(4)').addClass('text-left');
                              tr.find('td:eq(5)').addClass('text-left');
                              tr.find('td:eq(6)').addClass('text-left');
                              tr.find('td:eq(7)').addClass('text-left');
                              tr.find('td:eq(8)').addClass('text-left');
                              tr.find('td:eq(9)').addClass('text-left');
                              $('#tabMC').DataTable().row($("#MCrow"+ nv.code)).remove().draw();
                              // $("#tabMC").DataTable().search( '' ).columns().search( '' ).draw();  
                               $("#tabMC").DataTable().search( '' ).columns().search( '' ).draw();  
                            }
                       });
                
                       
                    }

        });
   $('#AddQ').on('shown.bs.modal', function () {
      $('#quantite_examen').focus(); 
   });

   $('#editDossier').on('shown.bs.modal', function () {
      if( $(".did_sexe").text() == "Masculin" ){
           $('#form_dossier #EN').prop("checked",true);
          $('#EO').attr("disabled","disabled");
          $('#EN').attr("disabled","disabled"); 
      }else{
          $('#EO').removeAttr("disabled");
         $('#EN').removeAttr("disabled"); 
      }
      
     
   });
     $('#quantite_examen').keypress(function (e) {
          if (e.which == 13) {
            if(validate()){
                var ble = document.getElementById("" + $(".did_row").text());
                ble.cells[1].innerHTML = "" + $("#quantite_examen").val();
                $("#quantite_examen").val(1);
                $("#AddQ").modal("hide");
            }
            return false;    
          }
        });
    $("#valQ").click(function(){
     
      if(validate()){
                var ble = document.getElementById(""+ $(".did_row").text());
                
                ble.cells[1].innerHTML = "" + $("#quantite_examen").val();
                $("#quantite_examen").val(1);
                $("#AddQ").modal("hide");
          }
    });
          
          $('input[name="urgence"]').bind('click', function(){
          if(  $('input[name=urgence]:checked').attr('id') == 'EU' ){
            $("#numero_facture").val("");
           
          }else{
            
          }

       });
         $('.mdcMC').click(function(){
             
              $("#EDD").modal("hide");
              $("#tabMC").DataTable().search( '' ).columns().search( '' ).draw();
            });
         $('.mdCM').click(function(){
            // $("#form-depot :input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
              $("#add_depot").modal("hide");
            });
          $('.mdcMD').click(function(){
              $("#MatDel").modal("hide");
            });
          $('.mdcA').click(function(){
              $("#AlerPre").modal("hide");
            });
          $('.mdcAQ').click(function(){
              $("#quantite_examen").val(1);
              $("#AddQ").modal("hide");

            });
          $('.mdCPA').click(function(){
              $("#modConPaye").modal("hide");
            });
          $('.mdcIM').click(function(){
              $("#invaMod").modal("hide");
            });
        $('.mdcRF').click(function(){
             $("#modRF :input:not('select')").val('');
              $("#modRF").modal("hide");
            });
        $('#tabMAC').on('dblclick', 'tr', function(event) {
               if(this.cells[0].innerHTML != "Code"){
                    var str = $(this).attr('id');
                  var res = str.substring(6);
                
                  $('.did_exam_del').text(res);
                   $("#MatDel").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                    });

               }

        });

       

        
          $('#LED').on('shown.bs.modal', function () {
               
                $.ajax({
                            
                            url: "{{route('dashboard_examen_dossier')}}",
                            data: {
                               
                                'id_dossier': $('.did_dossier').text()
                            },
                            dataType: "json",
                             beforeSend: function(){
                                 $('.blockMe').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                            },
                            complete: function(){
                                $('.blockMe').unblock();
                            }
                        })
                        .done(function(msg){

                       tab_liste =  JSON.parse(msg['examens_dossier']);
                       $("#montant_total").val(formatMoney(JSON.parse(msg['total'])));
           if (tab_liste[0] != null) {
                for(i=0;i < tab_liste.length;i++){
                     
                   for (var j=0;j<tab_exam.length;j++){
                    if(tab_liste[i].code_examen == tab_exam[j].id){
                      var lMat = tab_exam[j].libelle_examen;
                    }
                   }

                    var data = [
                           tab_liste[i].code_examen,
                            tab_liste[i].quantite,
                           lMat,
                           tab_liste[i].prix_unitaire,
                           tab_liste[i].prix_total,
                           tab_liste[i].reduction,
                           tab_liste[i].prix_net,
                           tab_liste[i].delai
                                      ];
                                      var rowIndex = $('#tab_LED').dataTable().fnAddData(data);
                                      var row = $('#tab_LED').dataTable().fnGetNodes(rowIndex);
                                      $(row).attr( 'id','item' + tab_liste[i].code_examen);
                                      var tr = $("#tab_LED tr#item"+ tab_liste[i].code_examen);
                                      tr.find('td:eq(0)').addClass('text-left');
                                      tr.find('td:eq(1)').addClass('text-left');
                                      tr.find('td:eq(2)').addClass('text-left');
                                      tr.find('td:eq(3)').addClass('text-left');
                                      tr.find('td:eq(4)').addClass('text-left');
                                      tr.find('td:eq(5)').addClass('text-left');
                                      tr.find('td:eq(6)').addClass('text-left');
                                      tr.find('td:eq(7)').addClass('text-left');
                }
                 var somme = $('#tab_LED tr').not(':first').map(function(){
                    
                    return parseInt($(this).find('td:eq(7)').text());
                }).get();
                var resul =0;
                for(var i=0; i< somme.length;i++){
                  resul = resul + somme[i]; 
                }
                $('#total_examen').val(resul);
               
              }
              tab_tu =  JSON.parse(msg['tubes_examen']);
              if (tab_tu[0] != null) {
                for(i=0;i < tab_tu.length;i++){
                     
                  
                     for(j=0; j< tab_GE.length;j++){
                              if(tab_tu[i].id_groupe_examen == tab_GE[j].id){
                                var libelT = tab_GE[j].libelle_groupe_examen;
                                break;
                              }
                            }
                    var data = [
                           tab_tu[i].libelle_tube,
                          "<input style=\'width:50px\' type=\'color\' value=\'" + tab_tu[i].couleur + "\'>",
                           libelT,
                          "<img src=\'data:image/png;base64," + tab_tu[i].code_barre + "\'>"
                                      ];
                                      var rowIndex = $('#tab_tubeDo').dataTable().fnAddData(data);
                                      var row = $('#tab_tubeDo').dataTable().fnGetNodes(rowIndex);
                                      $(row).attr( 'id','item' + tab_tu[i].reference_tube);
                                      var tr = $("#tab_tubeDo tr#item"+ tab_tu[i].reference_tube);
                                      tr.find('td:eq(0)').addClass('text-left');
                                      tr.find('td:eq(1)').addClass('text-left');
                                      tr.find('td:eq(2)').addClass('text-left');
                                      tr.find('td:eq(3)').addClass('text-left');
                                    
                                 
                }
              }

             });  
        });
        $('#EDD').on('shown.bs.modal', function () {
            
             $('#EDD div.dataTables_filter input').focus();
             for( var i = 0; i<tab_exam.length; i++){
              for(var j=0; j< tab_GE.length;j++){
                if(tab_GE[j].id == tab_exam[i].id_groupe_examen ){
                   var lg = tab_GE[j].libelle_groupe_examen;
                   break;
                }
              }
              var data = [
                   tab_exam[i].libelle_examen,
                   lg
                         ];
                  var rowIndex = $('#tabMC').dataTable().fnAddData(data);
                  var row = $('#tabMC').dataTable().fnGetNodes(rowIndex);
                  $(row).attr( 'id','MCrow' + tab_exam[i].id);
                  var tr = $("#tabMC tr#MCrow"+ tab_exam[i].id);
                  tr.css("cursor","pointer");
                  tr.find('td:eq(0)').addClass('text-left');
                  tr.find('td:eq(1)').addClass('text-left');
            }
            
                $.ajax({
                            
                            url: "{{route('dashboard_examen_dossier')}}",
                            data: {
                               
                                'id_dossier': $('.did_dossier1').text()
                            },
                            dataType: "json",
                            beforeSend: function(){
                                 $('.blockMeT').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                            },
                            complete: function(){
                                $('.blockMeT').unblock();
                            }
                        }) .done(function(msg){

                                     tab_liste =  JSON.parse(msg['examens_dossier']);
                           if (tab_liste[0] != null) {
                              for(i=0;i < tab_liste.length;i++){
                              
                                     
                                   
                                 for (var j=0;j<tab_exam.length;j++){
                                  if(tab_liste[i].code_examen == tab_exam[j].id){
                                    
                                    var lexam = tab_exam[j].libelle_examen;
                                    break;
                                  }
                                 }
                                 

                                 
                                 lexam23 = " "
                                  var data = [
                                         "<a class='edit-modalMAC' style='cursor:pointer' data-info='" + tab_liste[i].code_examen + "," + $(".did_dossier1").text() + "," + tab_liste[i].quantite +  "," +  lexam23 + "," + tab_liste[i].prix_unitaire + "," + tab_liste[i].prix_total + "," + tab_liste[i].reduction + "," + tab_liste[i].prix_net + "," + tab_liste[i].delai + "'>"+ tab_liste[i].code_examen + "</a>",
                                          tab_liste[i].quantite,
                                         lexam,
                                         tab_liste[i].prix_unitaire,
                                         tab_liste[i].prix_total,
                                         tab_liste[i].reduction,
                                         tab_liste[i].prix_net,
                                         tab_liste[i].delai
                                                    ];
                                                    var rowIndex = $('#tabMAC').dataTable().fnAddData(data);
                                                    var row = $('#tabMAC').dataTable().fnGetNodes(rowIndex);
                                                    $(row).attr( 'id','MACrow' + tab_liste[i].code_examen);
                                                    var tr = $("#tabMAC tr#MACrow"+ tab_liste[i].code_examen);
                                                    tr.css("cursor","pointer");
                                                    tr.find('td:eq(0)').addClass('text-left');
                                                    tr.find('td:eq(1)').addClass('text-left');
                                                    tr.find('td:eq(2)').addClass('text-left');
                                                    tr.find('td:eq(3)').addClass('text-left');
                                                    tr.find('td:eq(4)').addClass('text-left');
                                                    tr.find('td:eq(5)').addClass('text-left');
                                                    tr.find('td:eq(6)').addClass('text-left');
                                                     tr.find('td:eq(7)').addClass('text-left');
                                
                                               
                              }
                          
                            var valId = $('#tabMAC tr').not(':first').map(function(){
                                  
                                var str = $(this).attr('id');
                                var res = str.substring(6);
                                  return parseInt(res);
                              }).get();
                             for(i=0;i < valId.length;i++){
                                  $('#tabMC').dataTable().fnDeleteRow($('#tabMC').dataTable().$("#MCrow"+ valId[i])[0] );
                                 //$('#tabMC').DataTable().row($("#MCrow"+ valId[i])).remove().draw();
                             }
                          }

                });  
             
        });

  $('#btnPrintFro').click(function(){
            
            window.open("{{ route('dashboard_patient_frottis_impression') }}");
    });
  $('#btnBPrint').click(function(){
            
            window.open("{{ route('dashboard_patient_biopsie_impression') }}");
    });

  $('#valMMC').click(function(){
      if($("#tabMAC").dataTable().fnSettings().aoData.length===0) {
        
          var values = [ parseInt($('.did_dossier1').text())];
        
      } else {
            var values = $('#tabMAC tr a').map(function(i,e){
              return $(this).data('info').split(',');
            }).get();

          
           
      }
      
     
       $(this).attr("disabled","disabled");
       $.ajax({
            type: 'post',
            dataType:'json',
            data: {'values': values },
            url: "{{route('dashboard_examen_dossier')}}"
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                            
                              
                              $("#EDD").modal('hide');
                              $("#tabMC").DataTable().search( '' ).columns().search( '' ).draw();
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                             
                              
                              $("#EDD").modal('hide');
                              $("#tabMC").DataTable().search( '' ).columns().search( '' ).draw();
                             //$("#EDD input[type=search]").val("");
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              
                       }
                    
          
    
   });
});
         
        
         $('#ValDel').click(function(){
            var idm = parseInt($('.did_exam_del').text());
            
            for( var i = 0; i<tab_exam.length; i++){
              if(idm == tab_exam[i].id){
                var libelM = tab_exam[i].libelle_examen;
                
                for(j=0; j< tab_GE.length;j++){
                  if(tab_exam[i].id_groupe_examen == tab_GE[j].id){
                    var libelT = tab_GE[j].libelle_groupe_examen;
                    break;
                  }
                }
                break;
              }
            }
            
            var data = [
                   libelM,
                   libelT
                         ];
                  var rowIndex = $('#tabMC').dataTable().fnAddData(data);
                  var row = $('#tabMC').dataTable().fnGetNodes(rowIndex);
                  $(row).attr( 'id','MCrow' + $('.did_exam_del').text());
                  var tr = $("#tabMC tr#MCrow"+ $('.did_exam_del').text());
                  tr.find('td:eq(0)').addClass('text-left');
                  tr.find('td:eq(1)').addClass('text-left');
                       
             $('#tabMAC').DataTable().row($("#MACrow"+ $('.did_exam_del').text())).remove().draw();
             var somme = $('#tabMAC tr').not(':first').map(function(){
                    
                    return parseInt($(this).find('td:eq(7)').text());
                }).get();
                var resul =0;
                for(var i=0; i< somme.length;i++){
                  resul = resul + somme[i]; 
                }
                $('#prix_total').val(resul);
            $("#MatDel").modal("hide");
                 
        });
 $('#modRF').on('shown.bs.modal',function(){
      $("#sv").focus();
 });
 $('#editDossier').on('hidden.bs.modal',function(){
          $('.actionBtnD').removeAttr("disabled");
     });
 $('#modRF').on('hidden.bs.modal',function(){
      $("#mode").find("option").remove();
      $("#sv").removeAttr("disabled");
      $("#btnValFact").removeAttr("disabled");
      $('#tab_dossier').dataTable().fnClearTable();
      $.ajax({
                            
                            url: "{{route('dashboard_dossier')}}",
                            data: {
                               
                                'id_patient': $('.did_patient').text()
                            },
                            dataType: "json",
                            beforeSend: function(){
                                 $('.blockMe').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                            },
                            complete: function(){
                                $('.blockMe').unblock();
                            }
                        })
                        .done(function(msg){

                       tab_dossier =  JSON.parse(msg['dossiers']);
                   for(var i=0; i < tab_dossier.length ; i++){
                       
                    
                         var nomA ="";
                         var nomU ="";
                         for(j=0;j<tab_users.length;j++){
                          if(tab_dossier[i].id_agent ==  tab_users[j].id){
                            var nomU = tab_users[j].name;
                            break;
                          }
                        }
                        for(j=0;j<tab_agent.length;j++){
                          if(tab_dossier[i].id_agent_editeur ==  tab_agent[j].id){
                            var nomA = tab_agent[j].nom_agent;
                            break;
                          }
                        }


                        var str = tab_dossier[i].date_dossier.split(' ');
                        var date = str[0];
                        var heure = str[1];
                         var nf ="";
                         if(tab_dossier[i].numero_facture != null ){
                              nf = pad(tab_dossier[i].numero_facture,6);
                         }
                      var data = [
                          "<input type='checkbox' data-info='" + tab_dossier[i].etat + "' class='checkitemD' value='" + tab_dossier[i].id + "' />",
                          "<a class='edit-modalD' style='cursor:pointer' data-info='" + tab_dossier[i].id + "," + tab_dossier[i].id_patient +"," + tab_dossier[i].id_agent_editeur + "," + tab_dossier[i].nom_prescripteur + "," + tab_dossier[i].id_agent + "," + tab_dossier[i].date_dossier + "," + tab_dossier[i].reduction +"," + tab_dossier[i].urgence +"," + tab_dossier[i].enceinte +"," + tab_dossier[i].numero_facture +"," + tab_dossier[i].renseignement +"," + tab_dossier[i].unite +"'><span class='glyphicon glyphicon-edit'></span> " + pad(tab_dossier[i].id,6) + "</a>",
                          date,
                          heure,
                          tab_dossier[i].nom_prescripteur,
                          nomU,
                          nf,
                          nomA,
                          tab_dossier[i].etat
                          ];
                        var rowIndex = $('#tab_dossier').dataTable().fnAddData(data);
                            var row = $('#tab_dossier').dataTable().fnGetNodes(rowIndex);
                            $(row).attr( 'id','item' + tab_dossier[i].id); 
                            var tr = $("#tab_dossier tr#item"+tab_dossier[i].id);
                            tr.data('info',tab_dossier[i].pourcentage);
                            tr.find('td:eq(0)').addClass('text-center');
                            tr.find('td:eq(1)').addClass('text-left');
                            tr.find('td:eq(2)').addClass('text-left');
                            tr.find('td:eq(3)').addClass('text-left');
                            tr.find('td:eq(4)').addClass('text-left');
                            tr.find('td:eq(5)').addClass('text-left');
                            tr.find('td:eq(6)').addClass('text-left');
                            tr.find('td:eq(7)').addClass('text-left');
                            tr.find('td:eq(8)').addClass('text-left');
                  }
              });
 });
 $('#LED').on('hidden.bs.modal',function(){
          $('#tab_LED').dataTable().fnClearTable();
      $('#tab_tubeDo').dataTable().fnClearTable();
 });
 $('#EDD').on('hidden.bs.modal', function () {
      $("#valMMC").removeAttr("disabled");
      $(".head input").val("");
       $('#tab_dossier').dataTable().fnClearTable();
      $('#tabMC').dataTable().fnClearTable();
      $('#tabMAC').dataTable().fnClearTable();
      chargement_all();
 });

 
       function chargement_all(){

                $.ajax({
                            
                            url: "{{route('dashboard_dossier')}}",
                            data: {
                               
                                'id_patient': $('.did_patient').text()
                            },
                            dataType: "json",
                            beforeSend: function(){
                                 $('.blockMe').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                            },
                            complete: function(){
                                $('.blockMe').unblock();
                            }
                        })
                        .done(function(msg){

                       tab_dossier =  JSON.parse(msg['dossiers']);
                       tab_H =  JSON.parse(msg['historiques']);
                   for(var i=0; i < tab_dossier.length ; i++){
                       
                    
                        
                       var nomA ="";
                       var nomU ="";
                         for(j=0;j<tab_users.length;j++){
                          if(tab_dossier[i].id_agent ==  tab_users[j].id){
                            var nomU = tab_users[j].name;
                            break;
                          }
                        }
                        for(j=0;j<tab_agent.length;j++){
                          if(tab_dossier[i].id_agent_editeur ==  tab_agent[j].id){
                            var nomA = tab_agent[j].nom_agent;
                            break;
                          }
                        }


                        var str = tab_dossier[i].date_dossier.split(' ');
                        var date = str[0];
                        var heure = str[1];
                         var nf ="";
                         if(tab_dossier[i].numero_facture != null ){
                              nf = pad(tab_dossier[i].numero_facture,6);
                         }
                      var data = [
                          "<input type='checkbox' data-info='" + tab_dossier[i].etat + "' class='checkitemD' value='" + tab_dossier[i].id + "' />",
                          "<a class='edit-modalD' style='cursor:pointer' data-info='" + tab_dossier[i].id + "," + tab_dossier[i].id_patient +"," + tab_dossier[i].id_agent_editeur + "," + tab_dossier[i].nom_prescripteur + "," + tab_dossier[i].id_agent + "," + tab_dossier[i].date_dossier + "," + tab_dossier[i].reduction +"," + tab_dossier[i].urgence +"," + tab_dossier[i].enceinte +"," + tab_dossier[i].numero_facture +"," + tab_dossier[i].renseignement +"," + tab_dossier[i].unite +"'><span class='glyphicon glyphicon-edit'></span> " + pad(tab_dossier[i].id,6) + "</a>",
                          date,
                          heure,
                          tab_dossier[i].nom_prescripteur,
                          nomU,
                          nf,
                          nomA,
                          tab_dossier[i].etat
                          ];
                        var rowIndex = $('#tab_dossier').dataTable().fnAddData(data);
                            var row = $('#tab_dossier').dataTable().fnGetNodes(rowIndex);
                            $(row).attr( 'id','item' + tab_dossier[i].id); 

                            var tr = $("#tab_dossier tr#item"+tab_dossier[i].id);
                            tr.css("cursor","pointer");
                            tr.data('info',tab_dossier[i].pourcentage);
                            tr.find('td:eq(0)').addClass('text-center');
                            tr.find('td:eq(1)').addClass('text-left');
                            tr.find('td:eq(2)').addClass('text-left');
                            tr.find('td:eq(3)').addClass('text-left');
                            tr.find('td:eq(4)').addClass('text-left');
                            tr.find('td:eq(5)').addClass('text-left');
                            tr.find('td:eq(6)').addClass('text-left');
                            tr.find('td:eq(7)').addClass('text-left');
                             tr.find('td:eq(8)').addClass('text-left');
                  }
                  
                    
                  });

       }
      $('#infosPatient').on('shown.bs.modal', function () {
             //$('#infosPatient div.dataTables_filter input').focus();
            chargement_all();
      }); 
          
        var countE = 0;
         $('#checkallD').change(function(){
          $('.checkitemD').prop("checked",$(this).prop("checked"))
           $('.checkitemD').each(function(){
            if($(this).prop("checked")){
           
              countE++;
            }
           });

          
         });
         
         $('.checkitemD').change(function(){
           $('.checkitemD').each(function(){
            if($(this).prop("checked")){
           
              countE++;
            }
           });

        
        });
          $('#form_dossier #prise').on('change', function() {
            
             for(var i=0; i< tab_part.length;i++){
                if(tab_part[i].id == $( "#prise option:selected" ).val()){
                   $("#form_dossier #reduction").val(tab_part[i].reduction);
                   if(tab_part[i].reduction == 0){
                    $("#form_dossier #reduction").attr("disabled",false);
                   }else{
                    $("#form_dossier #reduction").attr("disabled",true);
                   }
                   break;
                }

             }
         });
           $('#prescripteur_choix').on('change', function() {
             $("#form_dossier #prescripteur").val($( "#prescripteur_choix option:selected" ).val());    
            // $("#prescripteur_choix option[value="+ $(this).val() +"]").remove();
        });
        $('#renseignement_choix').on('change', function() {
             $("#form_dossier #renseignement").val($( "#renseignement_choix option:selected" ).text());
             $("#form_dossier #RC").val($( "#renseignement_choix option:selected" ).val());
             
        }); 
       
         $(document).on('click', '.edit-modalMAC', function() {
              var details = $(this).data('info').split(',');
              
              $(".did_row").text($(this).parent().parent().attr('id'));   
              $("#id_examenQ").val(parseInt(details[0]));
               $("#AddQ").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
         });
        $(document).on('click', '.edit-modalD', function() {
            $('#footer_action_buttonD').text(" Update");
            $('#footer_action_buttonD').addClass('glyphicon-check');
            $('#footer_action_buttonD').removeClass('glyphicon-trash');
            $('#footer_action_buttonD').removeClass('glyphicon-plus');
            $('.actionBtnD').addClass('btn-success');
            $('.actionBtnD').removeClass('btn-danger');
            $('.actionBtnD').removeClass('btn-primary');
            $('.actionBtnD').removeClass('delete');
            $('.actionBtnD').removeClass('ajout');
            $('.actionBtnD').addClass('edit');
            $('.modal-titleD').text('Modifier les informations du dossier');
            $('.deleteContentD').hide();
            $('.form-horizontal').show();
 
            var details = $(this).data('info').split(',');
     
           $('#form_dossier #id_dossier').val(details[0]);
           $('#form_dossier #id_pat').val($('.did_patient').text()); 
           
        //  " + tab_dossier[i].id + "," + tab_dossier[i].id_patient +"," + tab_dossier[i].id_agent_editeur + "," + tab_dossier[i].nom_prescripteur + "," + tab_dossier[i].id_agent + "," + tab_dossier[i].date_dossier + "," + tab_dossier[i].reduction +"," + tab_dossier[i].urgence +"
          str = details[5].split(" ");
          date= str[0]
          $('#form_dossier #date_dossier').val(date); 
         
        
       
         $('#form_dossier #reduction').val( parseInt(details[6]));
          $('#form_dossier #numero_facture').val(details[9]);
         $("#form_dossier #agent_choix").find("option").remove();
            $("#form_dossier #prescripteur_choix").find("option").remove();
             $("#form_dossier #unite").find("option").remove();
            $("#form_dossier #renseignement_choix").find("option").remove(); 

             $('#unite').append($('<option>',
                 {
                    value: '',
                    text : "--- Choisissez l'unité de soins ---",
                    selected:true
                }));
                
             for(var i=0;i < tab_unite.length;i++){
                  
                    $('#form_dossier #unite').append($('<option>',
                    {
                        value: tab_unite[i].id,
                        text : tab_unite[i].libelle_unite
                    }));
              }
              
             $('#prescripteur_choix').append($('<option>',
                 {
                    value: '',
                    text : "--- Choisissez le prescripteur ---",
                    selected:true
                }));
                $('#form_dossier #prescripteur').val(details[3]);
             for(var i=0;i < tab_medecin.length;i++){
                  
                    $('#form_dossier #prescripteur_choix').append($('<option>',
                    {
                        value: tab_medecin[i].nom_prescripteur,
                        text : tab_medecin[i].nom_prescripteur
                    }));
              }
              $('#renseignement_choix').append($('<option>',
                 {
                    value: '',
                    text : "--- Choisissez le renseignement ---",
                    selected:true
                }));
                
              for(var i=0;i < tabRC.length;i++){
                  if( tabRC[i].id == details[10]){
                       $('#form_dossier #renseignement').val( tabRC[i].libelle );
                       $('#form_dossier #RC').val( tabRC[i].id);
                      $('#form_dossier #renseignement_choix').append($('<option>',
                      {
                          value: tabRC[i].id,
                          text : tabRC[i].libelle,
                          selected:true
                      }));
                  }else{
                      $('#form_dossier #renseignement_choix').append($('<option>',
                    {
                        value: tabRC[i].id,
                        text : tabRC[i].libelle
                    }));
                  }
                  
                    
              }
              
               
              //$("#prescripteur_choix option[value='"+ details[3] +"]").remove();
              
             $('#form_dossier #dateA').show();
            //$('#form_dossier #dateA').append("<label for='date_dossier' id='ldate' class='control-label col-sm-3 text-left'>Date dossier : </label><div class='col-sm-9'><input class='form-control' type='date' id='date_dossier' name='date_dossier'></div>");
            $('#form_dossier #date_dossier').val(date);
            $('#form_dossier #agent_choix').append($('<option>',
            {
                        value: '',
                        text : "--- Agent éditeur ---"
            })); 
            
            for(var i=0;i < tab_agent.length;i++){
                  if(tab_agent[i].id == details[2]){
                     
                      $('#form_dossier #agent_choix').append($('<option>',
                     {
                        value: tab_agent[i].id,
                        text : tab_agent[i].nom_agent,
                        selected: true
                    }));
                  }else{
                     $('#form_dossier #agent_choix').append($('<option>',
                     {
                         value: tab_agent[i].id,
                        text : tab_agent[i].nom_agent,
                    }));
                  }
                  
            }

            
     
        
        if (details[7] == '0'){
              $('#form_dossier #NU').prop("checked",true);
        }else{
              $('#form_dossier #EU').prop("checked",true);
        }
        if (details[8] == '0'){
              $('#form_dossier #EN').prop("checked",true);
        }else{
              $('#form_dossier #EO').prop("checked",true);
        }
       
        
         $('#form_dossier #unite').val(details[11]);
            $("#editDossier").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
        
      
         $(document).on('click', '#addD', function() {
          /*
           $("#EDD").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
            });*/
            $(".errorP").addClass("hidden");
            $('#form_dossier #date_dossier').remove();
            $('#form_dossier #ldate').remove();
            $('#form_dossier #dateA').hide();
            $('#footer_action_buttonD').text(" Ajout");
            $('#footer_action_buttonD').addClass('glyphicon-plus');
            $('#footer_action_buttonD').removeClass('glyphicon-trash');
            $('#footer_action_buttonD').removeClass('glyphicon-check');
            $('.actionBtnD').addClass('btn-primary');
            $('.actionBtnD').removeClass('btn-danger');
            $('.actionBtnD').removeClass('btn-success');
            $('.actionBtnD').removeClass('delete');
            $('.actionBtnD').removeClass('edit');
            $('.actionBtnD').addClass('ajout');
            $('.modal-titleD').text('Ajouter un nouveau dossier');
            $('.deleteContentD').hide();
            $('.form-horizontal').show();
            $("#form_dossier #id_pat").val($('.did_patient').text());
            $("#form_dossier #reduction").val(0); 
            $("#form_dossier #prescripteur_choix").find("option").remove();
            $("#form_dossier #renseignement_choix").find("option").remove();
            $("#form_dossier #agent_choix").find("option").remove();
            $("#form_dossier #renseignement").find("option").remove();
            $("#form_dossier #unite").find("option").remove();
            $('#prescripteur_choix').append($('<option>',
                 {
                    value: '',
                    text : "--- Choisissez le prescripteur ---",
                    selected:true
                }));
                
             for(var i=0;i < tab_medecin.length;i++){
                  
                    $('#form_dossier #prescripteur_choix').append($('<option>',
                    {
                        value: tab_medecin[i].nom_prescripteur,
                        text : tab_medecin[i].nom_prescripteur
                    }));
              }
               $('#unite').append($('<option>',
                 {
                    value: '',
                    text : "--- Choisissez l'unité de soins ---",
                    selected:true
                }));
                
             for(var i=0;i < tab_unite.length;i++){
                  
                    $('#form_dossier #unite').append($('<option>',
                    {
                        value: tab_unite[i].id,
                        text : tab_unite[i].libelle_unite
                    }));
              }
              $('#renseignement_choix').append($('<option>',
                 {
                    value: '',
                    text : "--- Choisissez le renseignement ---",
                    selected:true
                }));
              for(var i=0;i < tabRC.length;i++){
                  
                    $('#form_dossier #renseignement_choix').append($('<option>',
                    {
                        value: tabRC[i].id,
                        text : tabRC[i].libelle
                    }));
              }
              $('#agent_choix').append($('<option>',
                 {
                    value: '',
                    text : "--- Agent éditeur ---",
                    selected:true
                }));
              for(var i=0;i < tab_agent.length;i++){
                  
                    $('#form_dossier #agent_choix').append($('<option>',
                    {
                        value: tab_agent[i].id,
                        text : tab_agent[i].nom_agent
                    }));
              }
            $("#editDossier").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });

            $('.mdCD').click(function(){
           $("#editDossier :input:not('[name=reduction],[type=checkbox],[type=radio]')").val('');
           $("#reduction").val(0);
           $("input[name=enceinte]").removeAttr("checked");
           $(".validation-error").html(""); 
              $("input").css("border","");
            $("#editDossier").modal("hide");
            });
           $('.mdCLED').click(function(){
           $("#LED :input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
            $("#LED").modal("hide");
            });
       
       $(document).on('click', '.invalide-modalD', function() {
          var cpt = 0;
            $('.checkitemD').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });
       
           if(cpt > 0){
              if(cpt == 1){
                  
                    
                      var etat = $('.checkitemD:checked').data('info');
                      
                      if( etat != "En Reception" ){
                          var id = $('.checkitemD:checked').val();
                          $('.didI').text(id);
                          window.open("{{ route('dashboard_dossier_etiquette_print') }}?id_dossier=" + id);
                      }else{

                        $("#AlerPre .infos").text("Vous ne pouvez imprimer les étiquettes d'un dossier En Reception !!!");
                        $("#AlerPre").modal({
                                  keyboard: false,
                                  show : true,
                                  backdrop: "static",
                          });
                      }
                  
                }else{
                    $("#AlerPre .infos").text("Vous ne pouvez qu'imprimer les étiquettes d'un seul dossier à la fois !!!");
                    $("#AlerPre").modal({
                              keyboard: false,
                              show : true,
                              backdrop: "static",
                      });
                }
            }else{

                    $("#AlerPre .infos").text("Vous devez cocher au moins un dossier !!!");
                  $("#AlerPre").modal({
                              keyboard: false,
                              show : true,
                              backdrop: "static",
                      });
                }
          });
              
       $(document).on('click', '.delete-modalD', function() {
               var cpt = 0;
            $('.checkitemD').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });

           if(cpt > 0){
                  var id = $('.checkitemD:checked').map(function(){
                    return  $(this).val()
                }).get().join();
                
                  $('#footer_action_buttonD').text(" delete");
                  $('#footer_action_buttonD').removeClass('glyphicon-check');
                  $('#footer_action_buttonD').removeClass('glyphicon-plus');
                  $('#footer_action_buttonD').addClass('glyphicon-trash');
                  $('.actionBtnD').removeClass('btn-success');
                  $('.actionBtnD').removeClass('btn-primary');
                  $('.actionBtnD').addClass('btn-danger');
                  $('.actionBtnD').removeClass('edit');
                  $('.actionBtnD').removeClass('ajout');
                  $('.actionBtnD').addClass('delete');
                  $('.modal-titleD').text('Supression');
                  $('.deleteContentD').show();
                  $('.form-horizontal').hide();
                  $('.didD').text(id);
                  $("#editDossier").modal({
                              keyboard: false,
                              show : true,
                              backdrop: "static",
                      });
                }else{
                  $("#AlerPre .infos").text("Vous devez cocher au moins un dossier !!!");
                  $("#AlerPre").modal({
                              keyboard: false,
                              show : true,
                              backdrop: "static",
                      });
                }
          });
      
  function sendAdd(){
          $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_dossier')}}",
            data: $('#form_dossier').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $("#editDossier :input:not('[name=reduction],[type=checkbox],[type=radio]')").val('');
                             $("#reduction").val(0);
                              
                              $("#editDossier").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $("#editDossier :input:not('[name=reduction],[type=checkbox],[type=radio]')").val('');
                           $("#reduction").val(0);
                              
                              $("#editDossier").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                              
                 
                          var nomU="";
                          var nomA = "";
                         for(j=0;j<tab_users.length;j++){
                          if(nv.id_agent ==  tab_users[j].id){
                            var nomU = tab_users[j].name;
                            break;
                          }
                        }
                        for(j=0;j<tab_agent.length;j++){
                          if(nv.id_agent_editeur ==  tab_agent[j].id){
                            var nomA = tab_agent[j].nom_agent;
                            break;
                          }
                        }


                        var str = nv.date_dossier.split(' ');
                        var date = str[0];
                        var heure = str[1];
                         var nf ="";
                         if(nv.numero_facture != null ){
                              nf = pad(nv.numero_facture,6);
                         }
                      var data = [
                          "<input type='checkbox' data-info='" + nv.etat + "' class='checkitemD' value='" + nv.id + "' />",
                          "<a class='edit-modalD' style='cursor:pointer' data-info='" + nv.id + "," + nv.id_patient +"," + nv.id_agent_editeur + "," + nv.nom_prescripteur + "," + nv.id_agent + "," + nv.date_dossier + "," + nv.reduction +"," + nv.urgence +"," + nv.enceinte +"," + nv.numero_facture +"," + nv.renseignement +"," + nv.unite +"'><span class='glyphicon glyphicon-edit'></span> " + pad(nv.id,6) + "</a>",
                          date,
                          heure,
                          nv.nom_prescripteur,
                          nomU,
                          nf,
                          nomA,
                          nv.etat
                          ];
                        var rowIndex = $('#tab_dossier').dataTable().fnAddData(data);
                            var row = $('#tab_dossier').dataTable().fnGetNodes(rowIndex);
                            $(row).attr( 'id','item' + nv.id); 
                            var tr = $("#tab_dossier tr#item"+nv.id);
                            tr.data('info',nv.pourcentage);
                            tr.find('td:eq(0)').addClass('text-center');
                            tr.find('td:eq(1)').addClass('text-left');
                            tr.find('td:eq(2)').addClass('text-left');
                            tr.find('td:eq(3)').addClass('text-left');
                            tr.find('td:eq(4)').addClass('text-left');
                            tr.find('td:eq(5)').addClass('text-left');
                            tr.find('td:eq(6)').addClass('text-left');
                            tr.find('td:eq(7)').addClass('text-left');  
                            tr.find('td:eq(8)').addClass('text-left');  
                            var my_array = $('#tab_dossier').dataTable().fnGetNodes( );
                           var last_element = my_array[my_array.length - 1];
                          
                          $(last_element).insertBefore($('#tab_dossier tbody tr:first-child'));
                }

                        
            });
  }
                  
  $('#footerD').on('click', '.ajout', function() {
              if(  $('input[name=urgence]:checked').attr('id') == 'NU' ){
                
                if( checkEmpty($("#numero_facture")) && checkEmpty($("#agent_choix")) ){
                    if(validate2()){
                      if( $("input[name=enceinte]").is(':checked') ){ 
                        $(".errorP").addClass("hidden");
                        $(this).attr("disabled","disabled");
                        sendAdd();
                      }else{
                            $(".errorP").removeClass("hidden");
                      }
                    }
                }
              }else{
                    if(validate2()){
                      if( $("input[name=enceinte]").is(':checked') ){ 
                        $(".errorP").addClass("hidden");
                        $(this).attr("disabled","disabled");
                        sendAdd();
                       }else{
                          $(".errorP").removeClass("hidden");
                      }
                  }
                
                 
              }

           
        
        
        
 });
    
    function sendMod(){
           $.ajax({
                          type: 'post',
                          url: "{{route('dashboard_dossier')}}",
                          data: $('#form_dossier').serialize(),
                          })
                    .done(function(msg){
                                      if(typeof msg['erreur'] !== 'undefined'){
                                            $("#editDossier :input:not('[name=reduction],[type=checkbox],[type=radio]')").val('');
                                            $("#reduction").val(0);
                                            
                                            $("#editDossier").modal('hide');
                                          
                                            
                                            var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                                             
                                      }else if(typeof msg['success'] !== 'undefined'){
                                             $("#editDossier :input:not('[name=reduction],[type=checkbox],[type=radio]')").val('');
                                         $("#reduction").val(0);
                                            
                                            $("#editDossier").modal('hide');
                                               $(".ajs-message.ajs-success").css("background-color", "gold");
                                            $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                                            $(".ajs-message.ajs-success").css("font-weight", "bold");
                                            alertify.set('notifier','position', 'top-right');
                                            alertify.success(msg['success']);
                                           
                                      }
                                          
                                          nv = JSON.parse(msg['nouveau']);
                                          var nomU="";
                          var nomA = "";
                                         for(j=0;j<tab_users.length;j++){
                                        if(nv.id_agent ==  tab_users[j].id){
                                          var nomU = tab_users[j].name;
                                          break;
                                        }
                                      }
                                      for(j=0;j<tab_agent.length;j++){
                                        if(nv.id_agent_editeur ==  tab_agent[j].id){
                                          var nomA = tab_agent[j].nom_agent;
                                          break;
                                        }
                                      }

                
                                      var str = nv.date_dossier.split(' ');
                                      var date = str[0];
                                      var heure = str[1];
                                      var nf ="";
                                       if(nv.numero_facture != null ){
                                            nf = pad(nv.numero_facture,6);
                                       }
                                      var tr = $("#tab_dossier tr#item"+nv.id);

                                      tr.data('info',nv.pourcentage);
                                      tr.find('td:eq(1)').html( "<a class='edit-modalD' style='cursor:pointer' data-info='" + nv.id + "," + nv.id_patient +"," + nv.id_agent_editeur + "," + nv.nom_prescripteur + "," + nv.id_agent + "," + nv.date_dossier + "," + nv.reduction +"," + nv.urgence +"," + nv.enceinte +"," + nv.numero_facture +"," + nv.renseignement +"," + nv.unite +"'><span class='glyphicon glyphicon-edit'></span> " + pad(nv.id,6) + "</a>");
                                      tr.find('td:eq(2)').html(""+ date);
                                      tr.find('td:eq(3)').html(""+ heure); 
                                      tr.find('td:eq(4)').html(""+ nv.nom_prescripteur);
                                      tr.find('td:eq(5)').html(""+ nomU);
                                      tr.find('td:eq(6)').html(""+ nf);
                                      tr.find('td:eq(7)').html(""+ nomA);
                                      tr.find('td:eq(8)').html(""+ nv.etat);
                                    // $('#tab_dossier').DataTable().rows( $("#tab_dossier tr#item"+nv.id) ).invalidate().draw();
                                      
                          });
    }
     $('#footerD').on('click', '.edit', function() {
         if(  $('input[name=urgence]:checked').attr('id') == 'NU' ){
                
                if( checkEmpty($("#numero_facture")) && checkEmpty($("#agent_choix")) ){
                    if(validate2()){
                    $(this).attr("disabled","disabled");
                    sendMod();
                  }
                }
              }else{
                  if( checkEmpty($("#unite")) ){
                    if(validate2()){
                      $(this).attr("disabled","disabled");
                      sendMod();
                  }
                }
                 
              }
       });
     
     $('.invalidate').click(function() {
          $.ajax({
              type: 'post',
              url: "{{route('dashboard_dossier_invalidate')}}",
              data: {
                  'id_dossier': $('.didI').text()
              }
          })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             $("#invaMod :input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#invaMod").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                             $("#invaMod :input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#invaMod").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['invalides']);
                         
                         for (var i=0; i< nv.length; i++){
                            var tr = $("#tab_dossier tr#item"+nv[i]);
                            tr.find('td:eq(6)').html("Expiré");
                           //$('#tab_dossier').DataTable().rows( tr ).invalidate().draw();
                          //$('#tab_dossier').dataTable().fndeleteRow($('#tab_dossier').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                       
                        
            });
      });

     $('#footerD').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: "{{route('dashboard_dossier_delete')}}",
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id_dossier': $('.didD').text()
              }
          })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             $("#editDossier :input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#editDossier").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                             $("#editDossier :input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#editDossier").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['supprimes']);
                         
                         for (var i=0; i< nv.length; i++){
                          $('#tab_dossier').dataTable().fnDeleteRow($('#tab_dossier').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                       
                        
            });
      });

    
  });
  </script>