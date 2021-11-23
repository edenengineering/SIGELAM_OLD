@extends("dashboard")

@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
 function validate() {
    
    var valid = true;
    valid = checkEmpty($("#libelle_groupe_examen"));
    valid = valid && checkEmpty($("#ordre_groupe"));
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
          <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addG"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
    </div>

          <table id="tableGE" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
          <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES GROUPES EXAMENS</h4>
          </caption>  
          
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th class="text-left">Nom du Groupe Examen</th>
              <th class="text-left">Ordre Groupe</th>
            </tr>
          </thead>
           @foreach($groupe_examens as $item)
              <tr id="item{{$item->id}}">
                
                <td class="text-left"><a class="edit-modalG" style="cursor:pointer"
                    data-info="{{$item->id}},{{$item->libelle_groupe_examen}},{{$item->ordre_groupe}}">
                    <span class="glyphicon glyphicon-edit"></span> {{$item->libelle_groupe_examen}}
                  </a>
                </td>
                <td class="text-left"> {{$item->ordre_groupe}} </td>
              </tr>
          @endforeach
        </table>      
      <div id="add_GE" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                <button type="button" class="close mdcG" data-dismiss="modal">&times;</button>
                <h2 id="titre" class="modal-titleG" >Ajouter un Groupe Examen</h2>
              </div>
              <div class="modal-body">
                <form  id="form-GE" class="form-horizontal" >
                  <div class="row">
                     <div class="form-group ">
                      <label for="libelle_groupe_examen" class="control-label text-left col-sm-3">Nom du groupe examen (*):<br /><span class="libelle_groupe_examen-validation validation-error"></span></label>
                      <div class="col-sm-8">
                        <input  class="form-control" name="libelle_groupe_examen" id="libelle_groupe_examen" type="text" />   
                      </div>
                      
                    </div>   
                  </div>
                  <div class="row">
                     <div class="form-group ">
                      <label for="ordre_groupe" class="control-label text-left col-sm-3">Ordre  (*):<br /><span class="ordre_groupe-validation validation-error"></span></label>
                      <div class="col-sm-8">
                        <input  class="form-control" name="ordre_groupe" id="ordre_groupe" min="0" type="number" />   
                      </div>
                      
                    </div>   
                  </div>
                    
                  
                  <input type="hidden" id="id_groupe_examen" name="id_groupe_examen" value="">
                </form>
              </div>
              <div class="modal-footer" id="footerG">
                  <button type="button" class="btn actionBtnG">
                    <span id="footer_action_buttonG" class='glyphicon'> </span>
                  </button>
                <button type="button" class="btn btn-warning mdcG">
                  <span class='glyphicon glyphicon-remove'></span> Close
                </button> 
             </div>
            </div>

          </div>
        </div>
           
</div>
@endsection
@section('another')
   $('#tableGE').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                 "columnDefs": [
                { className: "align-left","targets": [0,1]}
              ]
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
     $('div.dataTables_filter input').focus();
     
     $('form input').on('keypress', function(e) {
          return e.which !== 13;
      });
                  

         
        $(document).on('click', '.edit-modalG', function() {
            $('#footer_action_buttonG').text(" Update");
            $('#footer_action_buttonG').addClass('glyphicon-check');
            
            $('#footer_action_buttonG').removeClass('glyphicon-plus');
            $('.actionBtnG').addClass('btn-success');
            
            $('.actionBtnG').removeClass('btn-primary');
            
            $('.actionBtnG').removeClass('ajout');
            $('.actionBtnG').addClass('edit');
            $('.modal-titleG').text('Modifier les informations du Groupe Examen');
            
            
            var details = $(this).data('info').split(',');
            $('#form-GE #id_groupe_examen').val(details[0]);
    
            $('#form-GE #libelle_groupe_examen').val(details[1]); 
            $('#form-GE #ordre_groupe').val(details[2]);    
            $("#add_GE").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
              });
        });
        
      
         $(document).on('click', '#addG', function() {
            $('#footer_action_buttonG').text(" Ajout");
            $('#footer_action_buttonG').addClass('glyphicon-plus');
            
            $('#footer_action_buttonG').removeClass('glyphicon-check');
            $('.actionBtnG').addClass('btn-primary');
            
            $('.actionBtnG').removeClass('btn-success');
            
            $('.actionBtnG').removeClass('edit');
            $('.actionBtnG').addClass('ajout');
            $('.modal-titleG').text('Ajouter un nouveau Groupe Examen');
            
            
            $("#add_GE").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
         
            $('.mdcG').click(function(){
           $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
            $("#add_GE").modal("hide");
            });
          
      
  $('#add_GE').on('hidden.bs.modal', function () {
                $(".actionBtnG").removeAttr("disabled");
       });
    
  $('#footerG').on('click', '.ajout', function() {
      if(validate()){
       $(this).attr("disabled","disabled");
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_groupe_examen')}}",
            data: $('#form-GE').serialize(),
            })
   
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_GE").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_GE").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                              
                              var data = [
                               "<a class=\'edit-modalG\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle_groupe_examen + "," + nv.ordre_groupe + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_groupe_examen + "</a>",
                               nv.ordre_groupe
                              ];
                              
                              var rowIndex = $('#tableGE').dataTable().fnAddData(data);
                              var row = $('#tableGE').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tableGE tr#item"+nv.id);
                              tr.find('td:eq(0)').addClass('text-left');
                              

                              var my_array = $('#tableGE').dataTable().fnGetNodes( );
                              var last_element = my_array[my_array.length - 1];
                              $(last_element).insertBefore($('#tableGE tbody tr:first-child'));
                              tr.find('td:eq(1)').css("text-align","center");
                       }

                        
            });
               }
       });
    
     $('#footerG').on('click', '.edit', function() {
      if(validate()){
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_groupe_examen')}}",
            data: $('#form-GE').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_GE").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_GE").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            nv = JSON.parse(msg['nouveau']);
                           
                            var tr = $("#tableGE tr#item"+nv.id);
                        tr.find('td:eq(0)').html(  "<a class=\'edit-modalG\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle_groupe_examen + "," + nv.ordre_groupe + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_groupe_examen + "</a>");
                        tr.find('td:eq(1)').html("" + nv.ordre_groupe);

                        //$('#tableGE').DataTable().rows( tr ).invalidate().draw();
                        
            });
            }
       });
@endsection