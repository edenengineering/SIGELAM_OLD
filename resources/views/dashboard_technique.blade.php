@extends("dashboard")

@section('d_content')

<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>

 <script type="text/javascript">
       var tabGE = {!! $dossiers !!};


</script>
<div class="tab-content">
    
   
      <table id="tabCP" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMe">
          <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES PAILLASSES EN TECHNIQUE</h4>
          </caption>
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th class="text-left">Paillasses</th>
            </tr>
          </thead>
          
        </table>
                   
                      
         

            <div id="ModTech" class="modal fade" role="dialog" style="overflow-y: scroll;">
             <div class="modal-dialog  modal-lg">
              <div class="modal-content">
                <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                <button type="button" class="close mdcTech">&times;</button>
                <h3 class="modal-title">Liste des Patients <span class="dnom_patient"></span><span class="hidden did_GE"></span></h3>
              </div>
              <div class="modal-body">
                <div class="row" style="margin-bottom:15px; margin-top:15px;">
                    <fieldset class="col-sm-6">
                      <legend style="font-size:20px">Resultats</legend>
                      <div class="form-group">
                          <div class="col-sm-4">
                           <label class="control-label" > <input type="radio" id="EU" value="1" checked="checked" name="recherche"> En Urgence</label>
                          </div>
                          <div class="col-sm-4">
                            <label class="control-label" ><input type="radio" id="NU" value="0" name="recherche"> En Attente</label>
                          </div>
                      </div>
                    </fieldset>
                   
                </div>
                  <table id="tableTech" style="width:100%;  heigth:60%" class="table table-striped table-responsive blockMeT">
                    <!-- <caption id="cap">
                        <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES MEDECINS</h4>
                    </caption> --> 
                   
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr style ="heigth:10px;">
                        
                        <th class="text-left">N° Dossier</th>
                        <th class="text-left">Patients</th>
                        <th class="text-left">Date dossier</th>
                        <th class="text-left">Date Retrait</th>
                        
                      </tr>
                    </thead>
                    
                  </table>
              </div>
              <div class="modal-footer" >
               
                <button type="button" class="btn btn-warning mdcTech">
                  <span class='glyphicon glyphicon-remove'></span> Close
                </button>
              </div>
              </div>
             </div>
            </div>
          
</div>
@include('infos_technique')
@endsection
@section('activeTech')
active
@endsection

@section('anotherLoad')
  
               function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 

              
                                
                             for(i=0;i < tabGE.length;i++){
                                 var data = [
                                        tabGE[i].libelle_groupe_examen
                                        ];
                                var rowIndex = $('#tabCP').dataTable().fnAddData(data);
                                var row = $('#tabCP').dataTable().fnGetNodes(rowIndex);
                                $(row).attr( 'id','item' + tabGE[i].id_groupe_examen); 
                                var tr = $("#tabCP tr#item"+tabGE[i].id_groupe_examen);
                                tr.css("cursor","pointer");
                                tr.find('td:eq(0)').addClass('text-left');
                                               
                              }
                         
                  
                 
@endsection


@section('another')

    var tabCP = $('#tabCP').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
            });
    $('#tableTech').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
            });
    /*var tableD = $('#tableTech').DataTable({
 
               "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
               "serverSide": true,
               "ajax" : {
                  "url" : "{{ route('dashboard_technique_attente') }}",
                  "dataType" : "json",
                  "type" : "POST",
                   "data": function ( d ) {
                    return $.extend( {}, d, {
                      "urgence": $('input[name=recherche]:checked').val(),
                      'id_groupe_examen' : $(".did_GE").text()
                    } );
                    },
                     beforeSend: function(){
            
                         $('.blockMeT').block({ 
                            message: '<h3>Chargement.....</h3>', 
                            css: { border: '3px solid #a00' } 
                        }); 
                    },
                    complete: function(){
                        $('.blockMeT').unblock();
                    }
               },
               "columns" : [
                    {"data" : "id_dossier"},
                    {"data" : "nom_patient"},
                    {"data" : "date_dossier"},
                    {"data" : "date_retrait"}
               ],
                 "columnDefs": [
                { className: "align-left","targets": [0,1,2,3]}
              ]
            });*/
    $('div.dataTables_filter input').focus();
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
   function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 
   
   $('#tabCP').on('dblclick', 'tr', function(event) {
            
          
            var str = $(this).attr('id');
            
            var res = str.substring(4);
            
            $('.did_GE').text(res);
            $('.did_GE2').text(res);
            if(this.cells[0].innerHTML != "Paillasses"){
               

                $("#ModTech").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static"
                });
            }

     }); 
      $('#ModTech').on('shown.bs.modal', function () {
          $('div.dataTables_filter input').focus();
           $('div.dataTables_filter input').val('');
           $('#tableTech').dataTable().fnFilterClear();
          //tableD.draw();
          $.ajax({
            
            dataType:'json',
            url: "{{route('dashboard_technique_urgence')}}",
            data: {'id_groupe_examen' : $(".did_GE").text() },
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
                            
                           tab_tech = JSON.parse(msg['dossiers']);
                          for(var i = 0; i < tab_tech.length ; i++){
                            
                            
                            var data = [                            
                              pad(tab_tech[i].id_dossier,6),
                               tab_tech[i].nom_patient,
                               tab_tech[i].date_dossier,
                               tab_tech[i].date_retrait
                                ];
                              var rowIndex = $('#tableTech').dataTable().fnAddData(data);
                                  var row = $('#tableTech').dataTable().fnGetNodes(rowIndex);
                                  $(row).attr( 'id','item' + tab_tech[i].id_dossier); 
                                  var tr = $("#tableTech tr#item"+tab_tech[i].id_dossier);
                                  tr.find('td:eq(0)').addClass('text-left');
                                  tr.find('td:eq(1)').addClass('text-left');
                                  tr.find('td:eq(2)').addClass('text-left');
                                  tr.find('td:eq(3)').addClass('text-left');
                                      
                    }
                              
                  });
      });


      $('#ModTech').on('hidden.bs.modal',function(){
            $('div.dataTables_filter input').focus();
            $("#EU").prop("checked","checked");
             
            $('#tableTech').dataTable().fnClearTable();
            $('#tabCP').dataTable().fnClearTable();
             $.ajax({
            
            dataType:'json',
            url: "{{route('dashboard_technique')}}",
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
                            
                           tabGE = JSON.parse(msg['dossiers']);
                        for(i=0;i < tabGE.length;i++){
                                 var data = [
                                        tabGE[i].libelle_groupe_examen
                                        ];
                                var rowIndex = $('#tabCP').dataTable().fnAddData(data);
                                var row = $('#tabCP').dataTable().fnGetNodes(rowIndex);
                                $(row).attr( 'id','item' + tabGE[i].id_groupe_examen); 
                                var tr = $("#tabCP tr#item"+tabGE[i].id_groupe_examen);
                                tr.css("cursor","pointer");
                                tr.find('td:eq(0)').addClass('text-left');
                                               
                              }
                              
                  });
            
      });
   $('#tableTech').on('dblclick', 'tr', function(event) {
            
          
            var str = $(this).attr('id');
            
            var res = str.substring(4);
            
            $('.did_dossier').text(res);
            $('.did_endroit').text("technique");
           $('.did_nomP').text( this.cells[1].innerHTML);
            if(this.cells[1].innerHTML != "Patients"){
                
                $("#infosTechnique").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static"
                });
            }

     });
     var countM = 0;
         $('#checkallT').change(function(){
          $('.checkitemT').prop("checked",$(this).prop("checked"));
           $('.checkitemT').each(function(){
            if($(this).prop("checked")){
           
              countM++;
            }
           });

          
         });
      $('input[name="recherche"]').bind('click', function(){
          $('div.dataTables_filter input').focus();
           $('div.dataTables_filter input').val('');
           $('#tableTech').dataTable().fnFilterClear();
         // tableD.draw();
          $.ajax({
                dataType:'json',
                url: "{{route('dashboard_technique_attente')}}",
                data: {'id_groupe_examen' : $(".did_GE").text() },
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
              $('#tableTech').dataTable().fnClearTable();
              tab_tech = JSON.parse(msg['dossiers']);
            if(  $('input[name=recherche]:checked').attr('id') == 'EU' ){
            
              for(var i = 0; i < tab_tech.length ; i++){
                        
                      if(tab_tech[i].urgence == 1){  
                            var data = [                            
                              pad(tab_tech[i].id_dossier,6),
                               tab_tech[i].nom_patient,
                               tab_tech[i].date_dossier,
                               tab_tech[i].date_retrait
                                ];
                              var rowIndex = $('#tableTech').dataTable().fnAddData(data);
                                  var row = $('#tableTech').dataTable().fnGetNodes(rowIndex);
                                  $(row).attr( 'id','item' + tab_tech[i].id_dossier); 
                                  var tr = $("#tableTech tr#item"+tab_tech[i].id_dossier);
                                  tr.find('td:eq(0)').addClass('text-left');
                                  tr.find('td:eq(1)').addClass('text-left');
                                  tr.find('td:eq(2)').addClass('text-left');
                                  tr.find('td:eq(3)').addClass('text-left');
                      }
                }
            
         }else{
              
                  
                  for(var i = 0; i < tab_tech.length ; i++){
                            
                      if(tab_tech[i].urgence == 0){  
                            var data = [                             
                              pad(tab_tech[i].id_dossier,6),
                               tab_tech[i].nom_patient,
                               tab_tech[i].date_dossier,
                               tab_tech[i].date_retrait
                                ];
                              var rowIndex = $('#tableTech').dataTable().fnAddData(data);
                                  var row = $('#tableTech').dataTable().fnGetNodes(rowIndex);
                                  $(row).attr( 'id','item' + tab_tech[i].id_dossier); 
                                  var tr = $("#tableTech tr#item"+tab_tech[i].id_dossier);
                                  tr.find('td:eq(0)').addClass('text-left');
                                  tr.find('td:eq(1)').addClass('text-left');
                                  tr.find('td:eq(2)').addClass('text-left');
                                  tr.find('td:eq(3)').addClass('text-left');
                      }
                }
              
         }
                          
              });
           
         
      });
         
          $('.mdCT').click(function(){
            
            $("#modalInv").modal("hide");
            });
          $('.mdcTech').click(function(){
            
            $("#ModTech").modal("hide");
            });
          
        $("#btnInv").click(function() {
        var cpt = 0;
            $('.checkitemT').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });
       
           if(cpt > 0){
              var id = $('.checkitemT:checked').map(function(){
                return  $(this).val()
            }).get().join();
            
              $('.didT').text(id);
              $("#modalInv").modal({
                          keyboard: false,
                          show : true,
                          backdrop: "static",
                  });
          }
        });
     $('#footerT').on('click', '.invalidate', function() {
          $.ajax({
              type: 'post',
              url: "{{route('dashboard_technique_invalider')}}",
              data: {
                  
                  'id_dossier': $('.didT').text()
              }
          })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                              $("#checkallT").removeAttr('checked');
                              
                              $("#modalInv").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                            
                               $("#checkallT").removeAttr('checked');
                              $("#modalInv").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['supprimes']);
                         
                         for (var i=0; i< nv.length; i++){
                          $('#tableTech').dataTable().fnDeleteRow(  $('#tableTech').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                       
                        
            });
      });
@endsection