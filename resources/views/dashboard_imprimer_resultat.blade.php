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
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">IMPRESSION DES RESULTATS <span class="did_dossier hidden"></span></h4>
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
         @if((Auth::user()->profile != 2))
         <div class="row" style="margin-bottom:20px">
            <button id="btnMod" style="width:150px;" class="btn btn-primary btn-lg">
              <span class="glyphicon glyphicon-edit"> Modifier</span>
            </button>
         </div>
         @if((Auth::user()->profile != 5))
         <div class="row" style="margin-bottom:20px">
            <button id="btnArchi" style="width:150px;" class="btn btn-warning btn-lg">
              <span class="glyphicon glyphicon-list"> Archivage</span>
            </button>
         </div>
         @endif
         @endif
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
                                <th style="text-align:center;width:45px"><input type="checkbox" id="checkallTu" /></th>
                                <th class="text-left">N° Dossier</th>
                                <th class="text-left">Noms Patient</th>
                                <th class="text-left">Contact</th>
                                <th class="text-left">Prescripteur</th>
                              </tr>

                            </thead>
                           
                          </table>
                      </div>
                      <div class="row">
                          <button id="btnValA" class="btn btn-success col-md-2 col-md-offset-1 glyphicon glyphicon-ok-sign"> Valider</button>
                      </div>
                      <div class="modal-footer" id="footer">
                        
                      <button type="button" class="btn btn-warning mdcAr">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>
                  </div>
  </div> 

<div id="ModArc" class="modal fade" role="dialog">
 <div class="modal-dialog" >
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcP">&times;</button>
    <h3 class="modal-titleT">Confirmation</h3>
  </div>
  <div class="modal-body">
    <h3>Voulez vous vraiment archiver le(s) dossier(s) selectionné(s)  ?<span class="hidden did_doss"></span></h3>
  </div>
  <div class="modal-footer" >
  <button type="button" id="conValA" class="btn btn-success">
          <span class='glyphicon glyphicon-ok-sign'></span> Valider
  </button>
    <button type="button" class="btn btn-warning mdcP">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
<div id="ModTu" class="modal fade" role="dialog">
 <div class="modal-dialog modal-md" >
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcTu">&times;</button>
    <h3 class="modal-title">Examens du dossier <span class="hidden"></span></h3>
  </div>
  <div class="modal-body">

     <table id="tabTube" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMeT">
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th style="text-align:center;width:45px"> <input type="checkbox" id="checkallTuB" />  </th>
              <th class="text-left">Libelle Examen</th>
            </tr>
          </thead>
         
      </table>
  </div>
  <div class="modal-footer" >

    <button type="button" id="btnPrint" class="btn btn-primary">
          <span class='glyphicon glyphicon-print'></span> Imprimer
  </button>
    <button type="button" class="btn btn-warning mdcTu">
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
@section('activeIR')
active
@endsection

@section('anotherLoad')
  
               function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 
                /*   for(var i = 0; i < tab_do.length ; i++){
                            
                            var str = tab_do[i].date.split(" ");

                            var data = [       
                              str[0],                     
                              pad(tab_do[i].id_dossier,6),
                               tab_do[i].nom_patient,
                               tab_do[i].sexe,
                               tab_do[i].contact,
                               tab_do[i].prescripteur
                                ];
                              var rowIndex = $('#tabIR').dataTable().fnAddData(data);
                                  var row = $('#tabIR').dataTable().fnGetNodes(rowIndex);
                                  $(row).attr( 'id','item' + tab_do[i].id_dossier); 
                                  var tr = $("#tabIR tr#item"+tab_do[i].id_dossier);
                                  if(i == 0){
                                      $(".did_dossier").text(tab_do[i].id_dossier);
                                  }
                                  tr.css("cursor","pointer");
                                  tr.find('td:eq(0)').addClass('text-left');
                                  tr.find('td:eq(1)').addClass('text-left');
                                  tr.find('td:eq(2)').addClass('text-left');
                                  tr.find('td:eq(3)').addClass('text-left');
                                  tr.find('td:eq(4)').addClass('text-left');
                                  tr.find('td:eq(5)').addClass('text-left');
                                      
                    }*/
                    
                 
@endsection

@section('another')
 function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 
 var tableD = $('#tabIR').DataTable({
               "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
              "iDisplayLength": 10,
              "order": [[ 0, "desc" ]],
             "serverSide": true,
             "ajax" : {
                "url" : "{{ route('dashboard_get_liste_dossier_a_imprimer') }}",
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
                "iDisplayLength": 10,
                "bSort": false
           });

    $('#tabTube').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 10,
                "bSort": false
           });

   $('.mdcP').click(function(){
           
            $("#ModArc").modal("hide");
            });
        $('div.dataTables_filter input').focus();
       $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");

    $('#checkallTuB').change(function(){
       
          $('.checkitemTuB').prop("checked",$(this).prop("checked"));
      });

    $('#tabIR').on('click', 'tr', function(event) {
         
        if( this.cells[0].innerHTML != "Date"){
            
         
            var res = parseInt(this.cells[1].innerHTML);
                  
                  $(".did_dossier").text(res);
                  $('#tabIR > tbody  > tr').each(function() {
                           if($(this).hasClass('success')){

                          $(this).removeClass('success'); 
                      
                      }
                  });
             $(this).addClass('success');
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
  $('#tabIR').on('dblclick', 'tr', function(event){

         if(this.cells[0].innerHTML != "Date"){
            var res = parseInt(this.cells[1].innerHTML);
            $('.did_dossier').text(res);
            $("#ModTu").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
            });
            
        }
     });
     $('#ModTu').on('shown.bs.modal', function () {

             $.ajax({
                                url: "{{route('dashboard_historique_resultat_examens')}}",
                                data: {
                                    'id_dossier' : $(".did_dossier").text()
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
                            })
                            .done(function(msg){
                                $('#tabTube').dataTable().fnClearTable();
                                var tab = JSON.parse(msg['examens']);
                                
                                for(i=0;i < tab.length;i++){
                                
                                var data = [
                                      "<input type='checkbox' class='checkitemTuB' value='" + tab[i].id_examen + "'/>",
                                        tab[i].libelle_examen
                                        
                                        ];
                                var rowIndex = $('#tabTube').dataTable().fnAddData(data);
                                var row = $('#tabTube').dataTable().fnGetNodes(rowIndex);
                                $(row).attr( 'id','item' + tab[i].id_examen); 
                                var tr = $("#tabTube tr#item"+tab[i].id_examen);
                                tr.find('td:eq(0)').addClass('text-center');
                                tr.find('td:eq(1)').addClass('text-left');
                              }
                            
                                
                            });     

        });
     $('.mdcTu').click(function(){
             $("#checkallTuB").removeAttr('checked');
            $("#ModTu").modal("hide");
            });

  $("#btnValA").click(function(){
      var cpt = 0;
            $('.checkitemTu').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });
           if(cpt > 0){
            var id = $('.checkitemTu:checked').map(function(){
              return  $(this).val()
             }).get().join();
            
             $('.did_doss').text(id);
            
             $("#ModArc").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
             });
          }else{
                 $("#AlerPre").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
             });
          }

            
     });

     $("#btnPrint").click(function(){
      var cpt = 0;
            $('.checkitemTuB').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });
          if(cpt > 0){

              var id = $('.checkitemTuB:checked').map(function(){
                return  $(this).val()
              }).get().join();
              window.open("{{ route('dashboard_imprimer_resultat_dossier') }}?id_dossier=" + $(".did_dossier").text()+ "&id_examen="+id);
          }else{
                 $("#AlerPre .infos").text("Vous devez cocher au moins un examen !!")
                 $("#AlerPre").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
             });
          }

            
     });

      $("#btnArchi").click(function(){
       $('#tabAr').dataTable().fnClearTable();
           $.ajax({
              url: "{{ route('dashboard_imprimer_resultat_dossier_a_archiver') }}",
                            data: {
                                'id_dossier' : $(".did_dossier").text()
                            },
                            beforeSend: function(){
                                 $('.blockMe').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                                },
                                complete: function(){
                                    $('.blockMe').unblock();
                                },
                            dataType: "json"
                        })
                        .done(function(msg){
                          
                                tab_do = JSON.parse(msg['dossiers']);
                            for(var i = 0; i < tab_do.length ; i++){
                            

                            var data = [         
                              "<input type='checkbox' class='checkitemTu' value='" + tab_do[i].id + "'/>",              
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
                                  tr.find('td:eq(0)').addClass('text-center');
                                  tr.find('td:eq(1)').addClass('text-left');
                                  tr.find('td:eq(2)').addClass('text-left');
                                  tr.find('td:eq(3)').addClass('text-left');
                                  tr.find('td:eq(4)').addClass('text-left');
                                      
                    }
                                $("#modConAr").modal({
                                      keyboard: false,
                                      show : true,
                                      backdrop: "static",
                                });
                        
                      });
           
      });

$('.mdcA').click(function(){
           
            $("#AlerPre").modal("hide");
            });

        $('.mdcA1').click(function(){
           
            $("#AlerPre1").modal("hide");
            });

    var countE = 0;
         $('#checkallTu').change(function(){
          $('.checkitemTu').prop("checked",$(this).prop("checked"))
           $('.checkitemTu').each(function(){
            if($(this).prop("checked")){
           
              countE++;
            }
           });

          
         });
   $("#conValA").click(function(){
          $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{ route('dashboard_archiver_resultat_dossier') }}",
            data: { 'id_dossier': $('.did_doss').text() },
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
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                              
                              $("#ModArc").modal('hide');
                              $("#checkallTu").removeAttr('checked');
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                              
                              
                              $("#ModArc").modal('hide');
                              $("#checkallTu").removeAttr('checked');
                              $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                          
                             
                       }
                       nv = JSON.parse(msg['supprimes']);
                         
                         for (var i=0; i< nv.length; i++){
                            $('#tabAr').dataTable().fnDeleteRow($('#tabAr').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                    tab_do = JSON.parse(msg['dossiers']);
                         
                        tableD.search( '' ).columns().search( '' ).draw();
                   
                     
                        
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
                               //$('#tabIR').dataTable().fnDeleteRow(  $('#tabIR').dataTable().$("#item"+ $(".did_dossier").text())[0] );
                              tableD.draw();
                        }
                      });

      });

      $("#btnValArchi").click(function(){
           $.ajax({
                                  
                            url: "{{ route('dashboard_imprimer_resultat_dossier') }}",
                            data: {
                                'id_dossier' : $(".did_dossier").text()
                            },
                            dataType: "json"
                        })
                        .done(function(msg){
                           if(typeof msg['erreur'] !== 'undefined'){
                              
                              $("#modConAr").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                                $("#modConAr").modal('hide');

                              $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              tableD.search( '' ).columns().search( '' ).draw();
                        }

                      });

      });

@endsection