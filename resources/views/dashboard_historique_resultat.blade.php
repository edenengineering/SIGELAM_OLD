@extends("dashboard")

@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
</script>
<div class="tab-content">
  <div class="row">
      <div class="col-sm-10">
          <table id="tabIR" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMe">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">HISTORIQUE DES RESULTATS <span class="did_dossier hidden"></span></h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th class="text-left">Date</th>
              <th class="text-left">N° Dossier</th>
              <th class="text-left">Noms Patient</th>
              <th class="text-left">Sexe</th>
              <th class="text-left">Contact</th>
              <th class="text-left">Prescripteur</th>
            </tr>

          </thead>
         
        </table>    
      </div>
      <div class="col-sm-2" style="padding-top:135px">
         <div class="row" style="margin-bottom:20px">
            <button id="btnApercu" style="width:150px;"  class="btn btn-success btn-lg">
              <span class="glyphicon glyphicon-print"> Imprimer</span>
            </button>
         </div>
         <div class="row" style="margin-bottom:20px">
            <button id="btnMod" style="width:150px;"  class="btn btn-primary btn-lg">
              <span class="glyphicon glyphicon-edit"> Modifier</span>
            </button>
         </div>
         
      </div>
  </div>
  
     
</div>
  
<div id="modConMo" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg" >

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdcMod" data-dismiss="modal">&times;</button>
                        <h2  class="modal-title" >Confirmation</h2>
                      </div>
                      <div class="modal-body">
                        <div class="deleteContentM">
                              <h3 class="text-center">Voulez-vous vraiment modifier le dossier sélectionné ? </h3>
                        </div>
                      </div>
                      <div class="modal-footer" id="footer">
                        <button type="button" id="btnValMod" class="btn btn-success" >
                        <span class='glyphicon glyphicon-check'></span> Oui
                      </button>
                      <button type="button" class="btn btn-warning mdcMod">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>
                  </div>
  </div> 

  <div id="modConAr" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg" >

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdcAr" data-dismiss="modal">&times;</button>
                        <h2  class="modal-title" >Liste des dossiers à archiver</h2>
                      </div>
                      <div class="modal-body">
                          <table id="tabAr" style="width:100%; heigth:60%" class="table table-striped table-responsive">
                            <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                              <tr  style ="heigth:10px;">
                                <th class="text-left">N° Dossier</th>
                                <th class="text-left">Noms Patient</th>
                                <th class="text-left">Contact</th>
                                <th class="text-left">Prescripteur</th>
                              </tr>

                            </thead>
                           
                          </table>
                      </div>
                      <div class="modal-footer" id="footer">
                        
                      <button type="button" class="btn btn-warning mdcAr">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>
                  </div>
  </div> 
<div id="ModExam" class="modal fade" role="dialog">
 <div class="modal-dialog modal-md" style="width:70%">
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcEX">&times;</button>
    <h3 class="modal-title"><span class="did_dossier1"></span>  Liste des examens du dossier</h3>
  </div>
  <div class="modal-body">
     <table id="tabExam" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMeE">
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th class="text-left">Examen</th>
              <th class="text-left">Groupe</th>
            </tr>
          </thead>
      </table>
     
  </div>
  <div class="modal-footer" >
    
    <button type="button" class="btn btn-warning mdcEX">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
<div id="modIE" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg" >

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdcIE" data-dismiss="modal">&times;</button>
                        <h2  class="modal-title" ><span class="hidden d_Ex"></span>Informations sur l'examen <span class="dnom_examen"></span></h2>
                      </div>
                      <div class="modal-body">
                          <table id="tabIE" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMeV">
                            <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                              <tr  style ="heigth:10px;">
                                <th class="text-left">Nom de l'agent</th>
                                <th class="text-left">Action</th>
                                <th class="text-left">Effectuée Le</th>
                              </tr>

                            </thead>
                           
                          </table>
                      </div>
                      
                      <div class="modal-footer" id="footer">
                        
                      <button type="button" class="btn btn-warning mdcIE" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>
                  </div>
  </div>
  <div id="AlerPre1" class="modal fade" role="dialog">
 <div class="modal-dialog" >
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" data-diss class="close mdcA1">&times;</button>
    <h3 class="modal-titleT"><i class="glyphicon glyphicon-info-sign"></i> Information</h3>
  </div>
  <div class="modal-body">
    <h3 class="infos">Vous devez selectionner une ligne  !!</h3>
  </div>
  <div class="modal-footer" >
    <button type="button" class="btn btn-warning mdcA1">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
@endsection
@section('activeHR')
active
@endsection

@section('anotherLoad')
              

               function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 
                  
                    
                 
@endsection

@section('another')
 function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 
   
   var tableD =  $('#tabIR').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                 "order": [[ 0, "desc" ]],
             "serverSide": true,
             "ajax" : {
                "url" : "{{ route('dashboard_get_liste_dossiers_archives') }}",
                "dataType" : "json",
                "type" : "POST",
                 beforeSend: function(){
            
                 $('.blockMe').block({ 
                    message: '<h3>Chargement.....</h3>', 
                    css: { border: '3px solid #a00' } 
                }); 
            },
            complete: function(){
                $('.blockMe').unblock();
            }
             },
             "columns" : [
                  {"data" : "date"},
                  {"data" : "id_dossier"},
                  {"data" : "nom_patient"},
                  {"data" : "sexe"},
                  {"data" : "contact"},
                  {"data" : "prescripteur"}
             ]
           });
    $('#tabAr').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
           });

   $('#tabExam').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
           });
 $('#tabIE').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                "bSort" : false,
                 "columnDefs": [
                { className: "align-left","targets": [0,1,2]}
              ]
           });
       $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
  $('div.dataTables_filter input').focus();
    $('#tabIR').on('click', 'tr', function(event) {
       
        if( this.cells[0].innerHTML != "Date"){
            
           
                  

                  $(".did_dossier").text(parseInt(this.cells[1].innerHTML));
                  $('#tabIR > tbody  > tr').each(function() {
                           if($(this).hasClass('success')){

                          $(this).removeClass('success'); 
                      
                      }
                  });
             $(this).addClass('success');
             }
        });
       $('#tabIR').on('dblclick', 'tr', function(event) {

             if(this.cells[0].innerHTML != "Date"){
         
            var str = $(this).attr('id');
            
            var res = str.substring(4);
            $('.did_dossier').text(res);
            $("#ModExam").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
            });
            
        }

       });
  function selection(){
            var result= false;
           $('#tabIR > tbody  > tr').each(function() {
                           if($(this).hasClass('success')){

                         result = true;
                      
                      }
            });
        return result;
  }
        $('#ModExam').on('shown.bs.modal', function () {

             $.ajax({
                                url: "{{route('dashboard_historique_resultat_examens')}}",
                                data: {
                                    'id_dossier' : $(".did_dossier").text()
                                },
                                dataType: "json",
                                beforeSend: function(){
                                 $('.blockMeE').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                                },
                                complete: function(){
                                    $('.blockMeE').unblock();
                                }
                            })
                            .done(function(msg){
                                $('#tabExam').dataTable().fnClearTable();
                                var tab = JSON.parse(msg['examens']);
                                
                                for(i=0;i < tab.length;i++){
                                
                                var data = [
                                        tab[i].libelle_examen,
                                        tab[i].groupe_examen
                                        
                                        ];
                                var rowIndex = $('#tabExam').dataTable().fnAddData(data);
                                var row = $('#tabExam').dataTable().fnGetNodes(rowIndex);
                                $(row).attr( 'id','item' + tab[i].id_examen); 
                                var tr = $("#tabExam tr#item"+tab[i].id_examen);
                                tr.css("cursor","pointer");
                                tr.find('td:eq(0)').addClass('text-left');
                                tr.find('td:eq(1)').addClass('text-left');
                                
                                               
                              }
                            
                                
                            });     

        });

         $('#tabExam').on('dblclick', 'tr', function(event) {

             if(this.cells[0].innerHTML != "Examen"){
         
            var str = $(this).attr('id');
            
            var res = str.substring(4);
            $('.d_Ex').text(res);
            $('.dnom_examen').text( this.cells[0].innerHTML );
            $("#modIE").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
            });
            
        }

       });
        $('#modIE').on('shown.bs.modal', function () {

             $.ajax({
                            
                            url: "{{route('dashboard_historique_valider_resultat')}}",
                            data: {
                              'id_examen' : $(".d_Ex").text(),
                              'id_dossier' : $(".did_dossier").text()
                            },
                            dataType: "json",
                            beforeSend: function(){
                                 $('.blockMeV').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                            },
                            complete: function(){
                                $('.blockMeV').unblock();
                            }
                        })
                        .done(function(msg){
                              $('#tabIE').dataTable().fnClearTable();
                              tabV =  JSON.parse(msg['infos']);
                            
                            for(var i = 0; i < tabV.length ; i++){
                            
                             
                            var data = [                
                               tabV[i].agent,
                               tabV[i].action,
                               tabV[i].date
                                ];
                              var rowIndex = $('#tabIE').dataTable().fnAddData(data);
                                  var row = $('#tabIE').dataTable().fnGetNodes(rowIndex);
                                  $(row).attr( 'id','item' + i); 
                                  var tr = $("#tabIE tr#item"+ i);
                                  
                                  tr.css("cursor","pointer");
                                  tr.find('td:eq(0)').addClass('text-left');
                                  tr.find('td:eq(1)').addClass('text-left');
                                      
                         } 
                        }); 

        });
      $('.mdcEX').click(function(){
           
            $("#ModExam").modal("hide");
            });

         $('.mdcA1').click(function(){
           
            $("#AlerPre1").modal("hide");
            });
         $('.mdcIE').click(function(){
           
            $("#modIE").modal("hide");
            });
      $("#btnArchi").click(function(){
           $.ajax({
              url: "{{ route('dashboard_imprimer_resultat_dossier_a_archiver') }}",
                            data: {
                                'id_dossier' : $(".did_dossier").text()
                            },
                            dataType: "json"
                        })
                        .done(function(msg){
                          
                                tab_do = JSON.parse(msg['dossiers']);
                            for(var i = 0; i < tab_do.length ; i++){
                            

                            var data = [                       
                              pad(tab_do[i].id,6),
                               tab_do[i].nom_patient,
                               tab_do[i].telephone,
                               tab_do[i].nom_prescripteur
                                ];
                              var rowIndex = $('#tabAr').dataTable().fnAddData(data);
                                  var row = $('#tabAr').dataTable().fnGetNodes(rowIndex);
                                  $(row).attr( 'id','item' + tab_do[i].id); 
                                  var tr = $("#tabAr tr#item"+tab_do[i].id);
                                  if(i == 0){
                                      $(".did_dossier").text(tab_do[i].id);
                                  }
                                  tr.css("cursor","pointer");
                                  tr.find('td:eq(0)').addClass('text-left');
                                  tr.find('td:eq(1)').addClass('text-left');
                                  tr.find('td:eq(2)').addClass('text-left');
                                  tr.find('td:eq(3)').addClass('text-left');
                                      
                    }
                                $("#modConAr").modal({
                                      keyboard: false,
                                      show : true,
                                      backdrop: "static",
                                });
                        
                      });
           
      });

      $("#btnMod").click(function(){
            if( ($("#tabIR").dataTable().fnSettings().aoData.length!==0) ){
            if(selection()){
                $("#modConMo").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
            }else{
              $("#AlerPre1").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
            }
            
          }
      }); 
      $("#btnApercu").click(function(){
         if( ($("#tabIR").dataTable().fnSettings().aoData.length!==0) ){
        if(selection()){
          window.open("{{ route('dashboard_imprimer_resultat_dossier') }}?id_dossier=" + $(".did_dossier").text());
        }else{
              $("#AlerPre1").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
          } 
      }

      });

      $('.mdcMod').click(function(){
             
              $("#modConMo").modal("hide");
             });
           $('.mdcAr').click(function(){
             
              $("#modConAr").modal("hide");
             });

       $("#btnValMod").click(function(){
           $.ajax({
                                  
                            url: "{{ route('dashboard_imprimer_resultat_dossier_modifier') }}",
                            type: 'post',
                            data: {
                                'id_dossier' : $(".did_dossier").text()
                            },
                            dataType: "json"
                        })
                        .done(function(msg){
                           if(typeof msg['erreur'] !== 'undefined'){
                              
                              $("#modConMo").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                                $("#modConMo").modal('hide');

                              $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              tableD.draw();
                        }
                      });

      });

      

@endsection