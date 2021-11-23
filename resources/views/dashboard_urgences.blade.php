@extends("dashboard")

@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script> 
<script type="text/javascript">
  var tabU = {!! $tab_urgences !!};
</script>    
 
<div class="tab-content">
    <div class="row" style="margin-bottom:15px; margin-top:15px;">
           <button id="delC" style="margin-left:10px"  class="delete-modalC btn btn-danger col-sm-2">
            <span class="glyphicon glyphicon-minus"></span> Retirer l'urgence
          </button>
    </div>

          <table id="tableAlert" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
          <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES DOSSIERS URGENCES</h4>
          </caption>  
          
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th style="text-align:center;width:45px"><input type="checkbox" id="checkallC" /></th>
              <th class="text-left" style="width:100px">N° Dossier</th>
              <th class="text-left">Patient</th>
              <th class="text-left">Date dossier</th>
              <th class="text-left">Date Retrait</th>
            </tr>
          </thead>
          
        </table>     
</div>
<div id="modCon" class="modal fade" role="dialog">
                  <div class="modal-dialog md-lg" style="width:60%" >

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdc" data-dismiss="modal">&times;</button>
                        <h2  class="modal-title" >Confirmation</h2>
                      </div>
                      <div class="modal-body">
                        <div class="deleteContentM">
                              <h3 class="text-center">Voulez-vous vraiment lever l'urgence de ce(s) dossier(s) ? <span class="hidden did_dossier"></span></h3>
                        </div>
                      </div>
                      <div class="modal-footer" id="footer">
                        <button type="button" id="btnValCon" class="btn btn-success" >
                        <span class='glyphicon glyphicon-check'></span> Oui
                      </button>
                      <button type="button" class="btn btn-warning mdc">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>

                  </div>
            </div>
  <div id="AlerP" class="modal fade" role="dialog">
                  <div class="modal-dialog" >

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdA" data-dismiss="modal">&times;</button>
                        <h2  class="modal-title" ><span class='fa fa-info-circle'></span> Information</h2>
                      </div>
                      <div class="modal-body">
                        <div class="deleteContentM">
                              <h3 class="text-center">Vous devez cocher au moins un dossier !!</h3>
                        </div>
                      </div>
                      <div class="modal-footer" id="footer">
                        
                      <button type="button" class="btn btn-warning mdA">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>

                  </div>
            </div>
@endsection
@section('activeHU')
active
@endsection
@section('anotherLoad')
  
               function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 
                   for(var i = 0; i < tabU.length ; i++){
                            
                             
                            var data = [
                                "<input type=\'checkbox\' class=\'checkitemC\' value=\'" + tabU[i].id + "\'/>",
                                pad(tabU[i].id,6),
                                tabU[i].patient,
                                tabU[i].date_dossier,
                                tabU[i].date_retrait
                              ];
                              var rowIndex = $('#tableAlert').dataTable().fnAddData(data);
                                  var row = $('#tableAlert').dataTable().fnGetNodes(rowIndex);
                                  $(row).attr( 'id','item' + tabU[i].id); 
                                  var tr = $("#tableAlert tr#item"+tabU[i].id);
                                  
                                  tr.css("cursor","pointer");
                                  tr.find('td:eq(0)').addClass('text-center');
                                  tr.find('td:eq(1)').addClass('text-left');
                                  tr.find('td:eq(2)').addClass('text-left');
                                  tr.find('td:eq(3)').addClass('text-left');
                                      
                    }

                 
@endsection
@section('another')
   $('#tableAlert').DataTable({
                 "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                 "columnDefs": [
                { className: "align-left","targets": [1,2,3,4]},
                { className: "align-center","targets": [0]},
              ]
            });
         $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
     $('div.dataTables_filter input').focus();
    
     $('#checkallC').change(function(){
          $('.checkitemC').prop("checked",$(this).prop("checked"))
   
         });


      $(document).on('click', '.delete-modalC', function() {
         var cpt = 0;
            $('.checkitemC').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });
           if(cpt > 0){
            var id = $('.checkitemC:checked').map(function(){
              return  $(this).val()
          }).get().join();
            
            $('.did_dossier').text(id);
            $("#modCon").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
          }else{
                $("#AlerP").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
          }
        });

      $("#btnValCon").click(function(){
           $.ajax({
                        url: "{{route('dashboard_urgences_delete')}}",
                        dataType: "json",
                        type: "post",
                        data: {
                           
                            'id_dossier' : $(".did_dossier").text()
                        }
                    })
                    .done(function(msg){
                             if(typeof msg['erreur'] !== 'undefined'){

                               $("#modCon").modal("hide"); 
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               alertify.set('notifier','position', 'top-right');
                        }else if(typeof msg['success'] !== 'undefined'){
                             
                              $("#modCon").modal("hide"); 
                              $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              
                             nv = msg['dossier'];
                              for (var i=0; i< nv.length; i++){
                                $('#tableAlert').dataTable().fnDeleteRow($('#tableAlert').dataTable().$("#item"+ nv[i])[0] );
                             }
                             tabU = JSON.parse(msg['urgences']);
                             if(tabU.length == 0){
                                  $("#barreUrgence").hide();
                             }

                           }

                      }); 

      });

        $('.mdc').click(function(){
           
            $("#modCon").modal("hide");
         });
             $('.mdA').click(function(){
           
            $("#AlerP").modal("hide");
            });
@endsection