@extends("dashboard")
@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>  
 <script type="text/javascript">
 function validate() {
    
    var valid = true;
    valid = checkEmpty($("#libelle_tube"));
    valid = valid && checkEmpty($("#nombre_max"));
    valid = valid && checkEmpty($("#couleur"));
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
          <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addH"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
    </div>
     
                    <table id="tableHopital" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
                    <caption id="cap">
                        <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES TUBES </h4>
                    </caption> 
                 
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr  style ="heigth:10px;">
                        
                        <th class="text-left">Nom du Tube </th>
                        <th class="text-left">Nombre Max </th>
                        <th class="text-left">Couleur </th>
                      </tr>
                    </thead>
                    @foreach($tubes as $item)
                      <tr id="item{{$item->id}}">
                        
                        <td class="text-left"><a class="edit-modalH" style="cursor:pointer"
                            data-info="{{$item->id}},{{$item->libelle_tube}},{{$item->nombre_max}},{{$item->couleur}}">
                            <span class="glyphicon glyphicon-edit"></span> {{$item->libelle_tube}}
                          </a>
                        </td>
                        <td class="text-left"> {{$item->nombre_max}} </td>
                        <td class="text-left"><input style="width:100px" type="color" value="{{$item->couleur}}"></td>
                      </tr>
                    @endforeach
                  </table>
</div>
<div id="add_hopital" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
          <button type="button"  class="close mdcH" data-dismiss="modal">&times;</button>
          <h2  class="modal-titleH" ></h2>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" id="form-hopital">
    
              <div class="row">
                <div class="form-group ">
                  <label for="libelle_tube" class="control-label col-sm-4">Nom du Tube (*):<br /><span class="nom_tube-validation validation-error"></span></label>
                  <div class="col-sm-7">
                    <input  class="form-control" name="nom_tube" id="libelle_tube" type="text" required />  
                  </div>
                  
                </div>  
              </div>
              <div class="row">
                <div class="form-group ">
                  <label for="nombre_max" class="control-label col-sm-4">Nombre Max (*):<br /><span class="nombre_max-validation validation-error"></span></label>
                  <div class="col-sm-7">
                    <input  class="form-control" value="10" name="nombre_max" id="nombre_max" type="number" min="0" required />  
                  </div>
                  
                </div>  
              </div>
              <div class="row">
                <div class="form-group ">
                  <label for="couleur" class="control-label col-sm-4">Couleur du Tube (*):<br /><span class="couleur-validation validation-error"></span></label>
                  
                  <div class="col-sm-7">
                    <select id="couleur" name="couleur" class="form-control">
                    <option value="#0000ff">BLEU</option>
                    <option value="#ff0000">ROUGE</option>
                    <option value="#008000">VERT</option>
                    <option value="#ffffff">BLANC</option>
                    <option value="#000000">NOIR</option>
                    <option value="#4b0082">VIOLET</option>
                  </select>
                  </div>
                  
                </div>  
              </div>
             <input type="hidden" id="id_tube" name="id_tube" value="">
          </form>
        </div>
       <div class="modal-footer" id="footerH">
            <button type="button" class="btn actionBtnH">
              <span id="footer_action_buttonH" class='glyphicon'> </span>
            </button>
          <button type="button" class="btn btn-warning mdcH">
            <span class='glyphicon glyphicon-remove'></span> Close
          </button> 
       </div>
    </div>

   </div>
</div>
@endsection
@section('another')
    var tab_hopital = $('#tableHopital').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                 "columnDefs": [
                { className: "align-left","targets": [0,1,2]}
              ]
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
     $('div.dataTables_filter input').focus();
     
     $('form input').on('keypress', function(e) {
          return e.which !== 13;
      });
                  

         
        $(document).on('click', '.edit-modalH', function() {
            $('#footer_action_buttonH').text(" Update");
            $('#footer_action_buttonH').addClass('glyphicon-check');
            
            $('#footer_action_buttonH').removeClass('glyphicon-plus');
            $('.actionBtnH').addClass('btn-success');
            
            $('.actionBtnH').removeClass('btn-primary');
            
            $('.actionBtnH').removeClass('ajout');
            $('.actionBtnH').addClass('edit');
            $('.modal-titleH').text('Modifier les informations du Tube ');
            
            
            var details = $(this).data('info').split(',');
            $('#form-hopital #id_tube').val(details[0]);
    
            $('#form-hopital #libelle_tube').val(details[1]);  
              $('#form-hopital #nombre_max').val(details[2]);
              
              $('#form-hopital #couleur').val(details[3]);
            $("#add_hopital").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
        
      
         $(document).on('click', '#addH', function() {
            $('#footer_action_buttonH').text(" Ajout");
            $('#footer_action_buttonH').addClass('glyphicon-plus');
            
            $('#footer_action_buttonH').removeClass('glyphicon-check');
            $('.actionBtnH').addClass('btn-primary');
            
            $('.actionBtnH').removeClass('btn-success');
            
            $('.actionBtnH').removeClass('edit');
            $('.actionBtnH').addClass('ajout');
            $('.modal-titleH').text('Ajouter un nouveau Tube ');
            $("#nombre_max").val(10);
            
            $("#add_hopital").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
         
            $('.mdcH').click(function(){
           $(":input:not('[name=_token],[type=color],[type=radio]')").val('');
            $("#add_hopital").modal("hide");
            });
          
      
      $('#add_hopital').on('hidden.bs.modal', function () {
                $(".actionBtnH").removeAttr("disabled");
       });
    
  $('#footerH').on('click', '.ajout', function() {
   if(validate()){
    $(this).attr("disabled","disabled");
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_tube')}}",
            data: $('#form-hopital').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=color],[type=radio]')").val('');
                              
                              $("#add_hopital").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=color],[type=radio]')").val('');
                              
                              $("#add_hopital").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                              
                              var data = [
                               "<a class=\'edit-modalH\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle_tube + "," + nv.nombre_max + "," + nv.couleur + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_tube + "</a>",
                               nv.nombre_max,
                               "<input style=\'width:100px\' type=\'color\' value=\'" + nv.couleur + "\'>"  
                              ];
                              
                              var rowIndex = $('#tableHopital').dataTable().fnAddData(data);
                              var row = $('#tableHopital').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tableHopital tr#item"+nv.id);
                              tr.find('td:eq(0)').addClass('text-left');
                              tr.find('td:eq(1)').addClass('text-left');
                              tr.find('td:eq(2)').addClass('text-left');
                              
                              var my_array = $('#tableHopital').dataTable().fnGetNodes( );
                               var last_element = my_array[my_array.length - 1];
                              $(last_element).insertBefore($('#tableHopital tbody tr:first-child'));
                       }

                        
            });
            }
       });
    
     $('#footerH').on('click', '.edit', function() {
     if(validate()){
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_tube')}}",
            data: $('#form-hopital').serialize(),
            })
     
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=color],[type=radio]')").val('');
                              $("#add_hopital").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=color],[type=radio]')").val('');
                              
                              $("#add_hopital").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            nv = JSON.parse(msg['nouveau']);
                           
                            var tr = $("#tableHopital tr#item"+nv.id);
            
                        tr.find('td:eq(0)').html( "<a class=\'edit-modalH\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle_tube + "," + nv.nomre_max + "," + nv.couleur + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_tube + "</a>");
                         tr.find('td:eq(1)').html("" + nv.nombre_max);
                         tr.find('td:eq(2)').html("<input style=\'width:100px\' type=\'color\' value=\'" + nv.couleur + "\'>");
                        //$('#tableHopital').DataTable().rows( tr ).invalidate().draw();
                        
            });
            }
       });
    
 
@endsection