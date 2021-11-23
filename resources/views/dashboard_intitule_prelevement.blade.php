@extends("dashboard")

@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
  <script type="text/javascript">
 function validate() {
    
    var valid = true;
    valid = checkEmpty($("#libelle"));
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
</script>
<div class="tab-content">
  <div class="row" style="margin-bottom:15px; margin-top:15px;">
          <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addTC"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
    </div>

          <table id="tableTC" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
          <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES RENSEIGNEMENTS CLINIQUES</h4>
          </caption>  
          
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th class="text-center">Libellé</th>
            </tr>
          </thead>
           @foreach($intitule_prelevements as $item)
              <tr id="item{{$item->id}}">
                
                <td class="text-left"><a class="edit-modalTC" style="cursor:pointer"
                    data-info="{{$item->id}},{{$item->libelle}}">
                    <span class="glyphicon glyphicon-edit"></span> {{$item->libelle}}
                  </a>
                </td>
              </tr>
          @endforeach
        </table>      
      <div id="add_TC" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                <button type="button" class="close mdcTC" data-dismiss="modal">&times;</button>
                <h2 id="titre" class="modal-titleT" >Ajouter un Renseignement </h2>
              </div>
              <div class="modal-body">
                <form  id="form-TC" class="form-horizontal" >
                  <div class="row">
                    <div class="form-group ">
                      <label for="libelle" class="control-label col-sm-3">Libellé (*):<br /><span class="nom_intitule_prelevement-validation validation-error"></span></label>
                      <div class="col-sm-7">
                        <input  class="form-control" name="nom_intitule_prelevement" id="libelle" type="text" />   
                      </div>
                    
                    </div>
                  </div>
                  
                  <input type="hidden" id="id_intitule" name="id_intitule_prelevement" value="">
                </form>
              </div>
              <div class="modal-footer" id="footerTC">
                  <button type="button" class="btn actionBtnTC">
                    <span id="footer_action_buttonTC" class='glyphicon'> </span>
                  </button>
                <button type="button" class="btn btn-warning mdcTC">
                  <span class='glyphicon glyphicon-remove'></span> Close
                </button> 
             </div>
            </div>

          </div>
        </div>
           
</div>
@endsection
@section('another')
  $('#tableTC').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                 "columnDefs": [
                { className: "align-left","targets": [0]}
              ]
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    $('div.dataTables_filter input').focus();
     
     $('form input').on('keypress', function(e) {
          return e.which !== 13;
      });
                  

         
        $(document).on('click', '.edit-modalTC', function() {
            $('#footer_action_buttonTC').text(" Update");
            $('#footer_action_buttonTC').addClass('glyphicon-check');
            
            $('#footer_action_buttonTC').removeClass('glyphicon-plus');
            $('.actionBtnTC').addClass('btn-success');
            
            $('.actionBtnTC').removeClass('btn-primary');
            
            $('.actionBtnTC').removeClass('ajout');
            $('.actionBtnTC').addClass('edit');
            $('.modal-titleT').text('Modifier les informations du renseignement ');
            
            
            var details = $(this).data('info').split(',');
            $('#form-TC #id_intitule').val(details[0]);
    
            $('#form-TC #libelle').val(details[1]);    
            $("#add_TC").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
              });
        });
        
      
         $(document).on('click', '#addTC', function() {
            $('#footer_action_buttonTC').text(" Ajout");
            $('#footer_action_buttonTC').addClass('glyphicon-plus');
            
            $('#footer_action_buttonTC').removeClass('glyphicon-check');
            $('.actionBtnTC').addClass('btn-primary');
            
            $('.actionBtnTC').removeClass('btn-success');
            
            $('.actionBtnTC').removeClass('edit');
            $('.actionBtnTC').addClass('ajout');
            $('.modal-titleT').text('Ajouter un nouveau renseignement');
            
            
            $("#add_TC").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
         
            $('.mdcTC').click(function(){
           $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
            $("#add_TC").modal("hide");
            });
          
      
        
   $('#add_TC').on('hidden.bs.modal', function () {
                $(".actionBtnTC").removeAttr("disabled");
       });
  $('#footerTC').on('click', '.ajout', function() {
    if(validate()){
    $(this).attr("disabled","disabled");
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_intitule_prelevement')}}",
            data: $('#form-TC').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_TC").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_TC").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                              
                              var data = [
                               "<a class=\'edit-modalTC\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle + "</a>"
                              ];
                              
                              var rowIndex = $('#tableTC').dataTable().fnAddData(data);
                              var row = $('#tableTC').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tableTC tr#item"+nv.id);
                              tr.find('td:eq(0)').addClass('text-left');
                             
                              var my_array = $('#tableTC').dataTable().fnGetNodes( );
                               var last_element = my_array[my_array.length - 1];
                              
                              $(last_element).insertBefore($('#tableTC tbody tr:first-child'));
                       }

                        
            });
            }
       });
    
     $('#footerTC').on('click', '.edit', function() {
     if(validate()){
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_intitule_prelevement')}}",
            data: $('#form-TC').serialize(),
            })
     
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_TC").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_TC").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            nv = JSON.parse(msg['nouveau']);
                           
                            var tr = $("#tableTC tr#item"+nv.id);
            
                        tr.find('td:eq(0)').html(  "<a class=\'edit-modalTC\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle + "</a>");
                       // $('#tableTC').DataTable().rows( tr ).invalidate().draw();
                        
            });
            }
       });
@endsection