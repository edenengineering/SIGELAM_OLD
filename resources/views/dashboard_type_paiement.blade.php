@extends("dashboard")

@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>    
 <script type="text/javascript">
  
   
</script>
<div class="tab-content">
    
   <div class="row" style="margin-bottom:15px; margin-top:15px;">
              <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addM"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
              <button id="delM" style="margin-left:10px"  class="delete-modalM btn btn-danger col-sm-2">
              <span class="glyphicon glyphicon-trash"></span> Delete
              </button>
    </div>
     
                    <table id="tableTP" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
                    <caption id="cap">
                        <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES TYPES PAIEMENTS</h4>
                    </caption> 
                 
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr style ="heigth:10px;">
                        <th style="text-align:center;width:45px"><input type="checkbox" id="checkallM" /></th>
                        <th class="text-left">Libelle</th>
                        
                      </tr>
                    </thead>
                     @foreach($type_paiements as $item)
                      <tr id="item{{$item->id}}">
                        <td class="text-center"><input type="checkbox" class="checkitemM" value="{{$item->id}}" /></td>
                        <td class="text-left"><a class="edit-modalM" style="cursor:pointer"
                            data-info="{{$item->id}},{{$item->libelle_paiement}}">
                            <span class="glyphicon glyphicon-edit"></span> {{$item->libelle_paiement}}
                          </a>
                        </td>
                      </tr>
                      @endforeach
                  </table>
                      
          <div id="add_TP" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-md">

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdCM" data-dismiss="modal">&times;</button>
                        <h2  class="modal-titleM" ></h2>
                      </div>
                      <div class="modal-body">
                        <form  id="form-medecin" class="form-horizontal" role="form" >
                  
                      
                            <div class="row" style="margin-top: 30px; margin-bottom:5px;">
                                
                                    <div class="form-group">
                                     <label for="nom" class="control-label text-left col-sm-4">Libelle Type Paiement: </label>
                                      <div class=" col-sm-6">
                                        
                                        <input type="text"  name="libelle_paiement" class="form-control" id="libelle_paiement" required>
                                      </div>
                                    </div> 
                                
                            </div>
                                
                            <input type="hidden" id="id_type_paiement" name="id_type_paiement" value="">
                          </form>
                        <div class="deleteContentM">
                              <h3 class="text-center">Voulez-vous vraiment supprimer les items sélectionnés ? <span
                                class="hidden didM"></span></h3>
                        </div>
                      </div>
                      <div class="modal-footer" id="footerM">
                        <button type="button" class="btn actionBtnM" >
                        <span id="footer_action_buttonM" class='glyphicon'> </span>
                      </button>
                      <button type="button" class="btn btn-warning mdCM">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>

                  </div>
            </div>
          
</div>
@endsection
@section('another')
    var tab_medecin = $('#tableTP').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
   
  
     var countM = 0;

                  

         $('#checkallM').change(function(){
          
          $('.checkitemM').prop("checked",$(this).prop("checked"));
           $('.checkitemM').each(function(){
            if($(this).prop("checked")){
           
              countM++;
            }
           });
         });
         
         $('.checkitemM').change(function(){
           $('.checkitemM').each(function(){
            if($(this).prop("checked")){
           
              countM++;
            }
           });

         
        });
        $(document).on('click', '.edit-modalM', function() {
            $('#footer_action_buttonM').text(" Update");
            $('#footer_action_buttonM').addClass('glyphicon-check');
            $('#footer_action_buttonM').removeClass('glyphicon-trash');
            $('#footer_action_buttonM').removeClass('glyphicon-plus');
            $('.actionBtnM').addClass('btn-success');
            $('.actionBtnM').removeClass('btn-danger');
            $('.actionBtnM').removeClass('btn-primary');
            $('.actionBtnM').removeClass('delete');
            $('.actionBtnM').removeClass('ajout');
            $('.actionBtnM').addClass('edit');
            $('.modal-titleM').text('Modifier les informations du Type Paiement');
            $('.deleteContentM').hide();
            $('.form-horizontal').show();
            var details = $(this).data('info').split(',');

            
            $('#form-medecin #id_type_paiement').val(details[0]);
            $('#form-medecin #libelle_paiement').val(details[1]);  
            $("#add_TP").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
        
      
         $(document).on('click', '#addM', function() {
            $('#footer_action_buttonM').text(" Ajout");
            $('#footer_action_buttonM').addClass('glyphicon-plus');
            $('#footer_action_buttonM').removeClass('glyphicon-trash');
            $('#footer_action_buttonM').removeClass('glyphicon-check');
            $('.actionBtnM').addClass('btn-primary');
            $('.actionBtnM').removeClass('btn-danger');
            $('.actionBtnM').removeClass('btn-success');
            $('.actionBtnM').removeClass('delete');
            $('.actionBtnM').removeClass('edit');
            $('.actionBtnM').addClass('ajout');
            $('.modal-titleM').text('Ajouter un nouveau Type Paiment');
            $('.deleteContentM').hide();
            $('.form-horizontal').show();
            $("#add_TP").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
         
            $('.mdCM').click(function(){
           $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
            $("#add_TP").modal("hide");
            });
          
        $(document).on('click', '.delete-modalM', function() {
         var cpt = 0;
            $('.checkitemM').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });
           if(cpt > 0){
            var id = $('.checkitemM:checked').map(function(){
              return  $(this).val()
          }).get().join();
            $('#footer_action_buttonM').text(" Delete");
            $('#footer_action_buttonM').removeClass('glyphicon-check');
            $('#footer_action_buttonM').removeClass('glyphicon-plus');
            $('#footer_action_buttonM').addClass('glyphicon-trash');
            $('.actionBtnM').removeClass('btn-success');
            $('.actionBtnM').removeClass('btn-primary');
            $('.actionBtnM').addClass('btn-danger');
            $('.actionBtnM').removeClass('edit');
            $('.actionBtnM').removeClass('ajout');
            $('.actionBtnM').addClass('delete');
            $('.modal-titleM').text('Supression');
            $('.deleteContentM').show();
            $('.form-horizontal').hide();
            $('.didM').text(id);
            $("#add_TP").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
              }
        });
        
    
  $('#footerM').on('click', '.ajout', function() {
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_type_paiement')}}",
            data: $('#form-medecin').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_TP").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_TP").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                              var data = [
                               "<input type=\'checkbox\' class=\'checkitemM\' value=\'" + nv.id + "\'/>",
                               "<a class=\'edit-modalM\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle_paiement + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_paiement + "</a>"
                              ];
                              var rowIndex = $('#tableTP').dataTable().fnAddData(data);
                              var row = $('#tableTP').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tableTP tr#item"+nv.id);
                              tr.find('td:eq(0)').addClass('text-center');
                              tr.find('td:eq(1)').addClass('text-left');
                          
                       }

                        
            });
       });
    
     $('#footerM').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_type_paiement')}}",
            data: $('#form-medecin').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_TP").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_TP").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            nv = JSON.parse(msg['nouveau']);
                            
                            var tr = $("#tableTP tr#item"+nv.id);
            
                        tr.find('td:eq(1)').html("<a class=\'edit-modalM\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle_paiement + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_paiement + "</a>");
                        
                        $('#tableTP').DataTable().rows( tr ).invalidate().draw();
                        
            });
       });
    
     $('#footerM').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: "{{route('dashboard_type_paiement_delete')}}",
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id_type_paiement': $('.didM').text()
              }
          })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_TP").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_TP").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['supprimes']);
                         
                         for (var i=0; i< nv.length; i++){
                          $('#tableTP').dataTable().fnDeleteRow($('#tableTP').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                       
                        
            });
      });
@endsection