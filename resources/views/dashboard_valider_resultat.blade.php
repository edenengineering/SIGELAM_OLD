@extends("dashboard")

@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
   
         var tab_users = {!! $users->toJson()  !!};
</script>
<div class="tab-content">
          
          <table id="tabVR" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMe">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">VALIDATION DES RESULTATS</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th class="text-left"  style="width:100px" >N° Dossier</th>
              <th class="text-left">Patient</th>
              <th class="text-left" style="width:150px">Date</th>
              <th class="text-left" style="width:150px">Agent editeur</th>
            </tr>
          </thead>
        </table>
     

<div id="ModExam" class="modal fade" role="dialog">
 <div class="modal-dialog modal-md" style="width:70%">
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcEX">&times;</button>
    <h3 class="modal-title">Examen du Patient <span class="dnom_patient"></span><span class="hidden did_examen"></span><span class="hidden did_dossier1"></span></h3>
  </div>
  <div class="modal-body">
     <table id="tabExam" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMeC">
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
               <th style="text-align:center;width:45px"><input type="checkbox" id="checkallTu" /></th>
              <th class="text-left">Examen</th>
              <th class="text-left">Groupe</th>
              <th class="text-left">Modifié Le</th>
              <th class="text-left">Technicien</th>
            </tr>
          </thead>
      </table>
      <div class="row">
          <button class="col-sm-2 col-sm-offset-1 btn btn-success" id="btnValR"><span class='glyphicon glyphicon-ok-sign'></span> Valider </button>
          <button class="col-sm-2 col-sm-offset-6 btn btn-primary" id="btnVerif"><span class='glyphicon glyphicon-refresh'></span> Verifier</button>
      </div>
  </div>
  <div class="modal-footer" >
    
    <button type="button" class="btn btn-warning mdcEX">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
<div id="modVerif" class="modal fade" role="dialog">
                  <div class="modal-dialog" >

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdcVR" data-dismiss="modal">&times;</button>
                        <h2  class="modal-title" >Confirmation <span class="hidden dtype"></span></h2>
                      </div>
                      <div class="modal-body">
                        <div class="deleteContentM">
                              <h3 class="text-center">Voulez-vous vraiment valider le(s) résultat(s) ? <span class="hidden did_result"></span></h3>
                        </div>
                      </div>
                      <div class="modal-footer" id="footer">
                        <button type="button" id="btnValRt" class="btn btn-success" >
                        <span class='glyphicon glyphicon-check'></span> Oui
                      </button>
                      <button type="button" class="btn btn-warning mdcVR">
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
    <h3 class="modal-titleT"> Information</h3>
  </div>
  <div class="modal-body">
    <h3>Voulez devez cocher au moins un examen !!</h3>
  </div>
  <div class="modal-footer" >
    <button type="button" class="btn btn-warning mdcA">
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
                        <h2  class="modal-title" ><span class="hidden d_Ex"></span>Informations sur l'examen</h2>
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
@include('infos_technique')
@endsection
@section('activeVR')
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
      var tableD = $('#tabVR').DataTable({
                 "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
               "serverSide": true,
               "ajax" : {
                  "url" : "{{ route('dashboard_get_liste_validation') }}",
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
                    {"data" : "id_dossier"},
                    {"data" : "nom_patient"},
                    {"data" : "date_dossier"},
                    {"data" : "nom_user"}
               ]
       });
       $('#tabExam').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": -1
       });
        $('#tabIE').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": -1,
                "bSort" : false
       });
       
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    $('div.dataTables_filter input').focus();
    $('.mdcVR').click(function(){
            
            $("#modVerif").modal("hide");

          });

        $('#checkallTu').change(function(){
          $('.checkitemTu').prop("checked",$(this).prop("checked"));
         });
    $('#tabVR').on('dblclick', 'tr', function(event){
         if(this.cells[0].innerHTML != "N° Dossier"){
         
         
            
            var res = parseInt(this.cells[0].innerHTML);

            $('.dnom_patient').text( this.cells[1].innerHTML );
            $('.did_dossier1').text( parseInt(this.cells[0].innerHTML) );
            $.ajax({
                        dataType:'json',
                        data: { 'id_dossier' : res },
                        url: "{{route('dashboard_valider_resultat_show')}}",
                      beforeSend: function(){
                                     $('.blockMeC').block({ 
                                        message: '<h3>Chargement.....</h3>', 
                                        css: { border: '3px solid #a00' } 
                                    }); 
                        },
                        complete: function(){
                            $('.blockMeC').unblock();
                        } 
                       
                    })
                   .done(function(msg){
                     
                      tab_exam = JSON.parse(msg['examens']);
                      for( var i = 0; i<tab_exam.length; i++){
                      
                            
                            for(j=0; j< tab_GE.length;j++){
                              if(tab_exam[i].id_groupe_examen == tab_GE[j].id){
                                var libelT = tab_GE[j].libelle_groupe_examen;
                                break;
                              }
                            }
                            for(var k=0; k< tab_users.length;k++){
                              if(tab_exam[i].id_technicien == tab_users[k].id){
                                var tech = tab_users[k].name;
                                break;
                              }
                            }

                           var data = [
                             "<input type='checkbox' class='checkitemTu' value='" + tab_exam[i].id + "'/>",
                             "<a class='edit-modalV' style='cursor:pointer' data-info='" + tab_exam[i].id + "'><i class='glyphicon glyphicon-info-sign'></i> "+ tab_exam[i].libelle_examen + "</a>",
                             libelT,
                             tab_exam[i].date_technique,
                             tech
                                   ];
                            var rowIndex = $('#tabExam').dataTable().fnAddData(data);
                            var row = $('#tabExam').dataTable().fnGetNodes(rowIndex);
                            $(row).attr( 'id','item' +   tab_exam[i].id);
                            var tr = $("#tabExam tr#item"+ tab_exam[i].id);
                            tr.css("cursor","pointer");
                            tr.find('td:eq(0)').addClass('text-center');
                            tr.find('td:eq(1)').addClass('text-left');
                             tr.find('td:eq(2)').addClass('text-left');
                      }
                      
                     

                   });
            $("#ModExam").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
        });

          
            
        }
     });
       $('#ModExam').on('shown.bs.modal', function () {
              $('div.dataTables_filter input').focus();
       });
     $('#ModExam').on('hidden.bs.modal', function () {
		 $('div.dataTables_filter input').val('');
              $('div.dataTables_filter input').focus();
             $("#checkallTu").removeAttr("checked");
             tableD.draw();

     });

     $(document).on('click', '.edit-modalV', function() {

             var details = $(this).data('info');
             $(".d_Ex").text( details);
              $("#modIE").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
               });
              
     });
    $('#modIE').on('shown.bs.modal', function () {
           $.ajax({
                            
                            url: "{{route('dashboard_historique_valider_resultat')}}",
                            data: {
                              'id_examen' : $(".d_Ex").text(),
                              'id_dossier' : $(".did_dossier1").text()
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
    

      
     $('#tabExam').on('dblclick', 'tr', function(event){

          if(this.cells[1].innerHTML != "Examen"){
            var str = $(this).attr('id');
            var res = str.substring(4);
            $(".did_examen").text(res);
            $(".dtype").text("one");
              $("#modVerif").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static"
                });

          }
       

     });

     $("#btnValR").click(function(){
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
              
               $('.did_examen').text(id);
               if(cpt == 1){
                $(".dtype").text("one");
               }else{
                  $(".dtype").text("all");
               }
               
                $("#modVerif").modal({
                          keyboard: false,
                          show : true,
                          backdrop: "static"
                  });
            }else{
                $("#AlerPre").modal({
                          keyboard: false,
                          show : true,
                          backdrop: "static"
                  });
            }
     });

     $("#btnValRt").click(function(){
       $(this).attr("disabled","disabled")
       if(  $(".dtype").text() == "one" ){
      
           $.ajax({
            type: 'post',
                dataType:'json',
                data: { 'id_examen' :$(".did_examen").text(),
                    'id_dossier' : $(".did_dossier1").text() },
                url: "{{route('dashboard_resultats_valider_examen')}}"
               
            })
           .done(function(msg){
             if(typeof msg['erreur'] !== 'undefined'){
                            
                              
                            
                              $("#modVerif").modal('hide');
                              $("#ModExam").modal('hide');
                              $("#checkallTu").removeAttr("checked");
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                             
                              
                              $("#modVerif").modal('hide');
                              $("#ModExam").modal('hide');
                               $("#checkallTu").removeAttr("checked");
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              
                       }
                    $('#tabExam').dataTable().fnDeleteRow(  $('#tabExam').dataTable().$("#item"+ $(".did_examen").text())[0] );


          });
        }else  if(  $(".dtype").text() == "all" ){
              $.ajax({
            type: 'post',
                dataType:'json',
                data: { 'id_examen' :$(".did_examen").text(),
                    'id_dossier' : $(".did_dossier1").text() },
                url: "{{route('dashboard_resultats_valider_all')}}"
               
            })
           .done(function(msg){
             if(typeof msg['erreur'] !== 'undefined'){
                            
                              
                            
                              $("#modVerif").modal('hide');
                               $("#ModExam").modal('hide');
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                             
                              
                              $("#modVerif").modal('hide');
                               $("#ModExam").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              
                       }

                  $('#tabExam').dataTable().fnClearTable();

          });

        }

     });
     $('#modVerif').on('hidden.bs.modal',function(){
            $('div.dataTables_filter input').focus();
            $('#btnValRt').removeAttr('disabled');
         });
     $('#ModExam').on('hidden.bs.modal',function(){
            
            $('#tabExam').dataTable().fnClearTable();
         });
     $('#btnVerif').click(function() {
            
            $('.did_dossier').text(parseInt(  $('.did_dossier1').text() ));
            $('.did_endroit').text("valider");
            
                
                $("#infosTechnique").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static"
                });
            

     });
       $('.mdcEX').click(function(){
           
            $("#ModExam").modal("hide");
            });
        $('.mdcIE').click(function(){
           
            $("#ModIE").modal("hide");
            });
      $('.mdcA').click(function(){
           
            $("#AlerPre").modal("hide");
            });
@endsection