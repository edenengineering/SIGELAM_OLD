@extends("dashboard")

@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
      var tab_TM = {!! $type_materiels->toJson()  !!};
      function validate() {
    
    var valid = true;
    valid = checkEmpty($("#libelle_materiel"));
    valid = valid && checkEmpty($("#id_type_materiel"));
    valid = valid && checkEmpty($("#stock"));
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
          <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addT"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
    </div>

          <table id="tableTE" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
          <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES MATERIELS</h4>
          </caption>  
          
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th class="text-left">Nom du Materiel</th>
              <th class="text-left">Nom Type Materiel</th>
              <th class="text-left">Stock</th>
            </tr>
          </thead>
           @foreach($materiels as $item)
              <tr id="item{{$item->id}}">
                
                <td class="text-left"><a class="edit-modalT" style="cursor:pointer"
                    data-info="{{$item->id}},{{$item->id_type_materiel}},{{$item->libelle_materiel}},{{$item->stock}}">
                    <span class="glyphicon glyphicon-edit"></span> {{$item->libelle_materiel}}
                  </a>
                </td>
                <td class="text-left">
                    @foreach($type_materiels as $g)
                      @if($item->id_type_materiel == $g->id)
                          {{ $g->libelle_type_materiel }}
                      @endif
                    @endforeach
                </td>
                <td class="text-left"> {{$item->stock}} </td>
              </tr>
          @endforeach
        </table>      
      <div id="add_TE" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                <button type="button" class="close mdcT" data-dismiss="modal">&times;</button>
                <h2 id="titre" class="modal-titleT" >Ajouter un Materiel</h2>
              </div>
              <div class="modal-body">
                <form  id="form-TE" class="form-horizontal" >
                  {{ csrf_field() }} 
                  <div class="row">
                     <div class="form-group ">
                      <label for="libelle_materiel" class="control-label text-left col-sm-3">Nom Materiel (*):<br /><span class="libelle_materiel-validation validation-error"></span></label>
                      <div class="col-sm-8">
                        <input  class="form-control" name="libelle_materiel" id="libelle_materiel" type="text" />   
                      </div>
                      
                    </div>   
                  </div>
                  <div class="row">
                     <div class="form-group ">
                      <label for="id_type_materiel" class="control-label text-left col-sm-3">Nom du Type Materiel :<br /><span class="id_type_materiel-validation validation-error"></span></label>
                      <div class="col-sm-8">
                        <select id="id_type_materiel" name="id_type_materiel" class="form-control" >
                           @foreach($type_materiels as $item)
                            <option value="{{$item->id}}">{{$item->libelle_type_materiel}}</option>
                            @endforeach                
                       </select>
                      </div>
                      
                    </div>   
                  </div>
                  
                  <div class="row">
                     <div class="form-group ">
                      <label for="stock" class="control-label text-left col-sm-3">Stock  (*):<br /><span class="stock-validation validation-error"></span></label>
                      <div class="col-sm-8">
                        <input  class="form-control" name="stock" id="stock" value="0" min="0" type="number" />   
                      </div>
                      
                    </div>   
                  </div>
                    
                  
                  <input type="hidden" id="id_materiel" name="id_materiel" value="">
                </form>
              </div>
              <div class="modal-footer" id="footerT">
                  <button type="button" class="btn actionBtnT">
                    <span id="footer_action_buttonT" class='glyphicon'> </span>
                  </button>
                <button type="button" class="btn btn-warning mdcT">
                  <span class='glyphicon glyphicon-remove'></span> Close
                </button> 
             </div>
            </div>

          </div>
        </div>
           
</div>
@endsection
@section('another')
   $('#tableTE').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
  
     
     $('form input').on('keypress', function(e) {
          return e.which !== 13;
      });
                  

         
        $(document).on('click', '.edit-modalT', function() {
            $('#footer_action_buttonT').text(" Update");
            $('#footer_action_buttonT').addClass('glyphicon-check');
            
            $('#footer_action_buttonT').removeClass('glyphicon-plus');
            $('.actionBtnT').addClass('btn-success');
            
            $('.actionBtnT').removeClass('btn-primary');
            
            $('.actionBtnT').removeClass('ajout');
            $('.actionBtnT').addClass('edit');
            $('.modal-titleT').text('Modifier les informations du Materiel');
            
            
            var details = $(this).data('info').split(',');
            $('#form-TE #id_materiel').val(details[0]);    
            $('#form-TE #id_type_materiel').val(details[1]);
            $('#form-TE #libelle_materiel').val(details[2]); 
            $('#form-TE #stock').val(details[3]);    
            $("#add_TE").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
              });
        });
        
      
         $(document).on('click', '#addT', function() {
            $('#footer_action_buttonT').text(" Ajout");
            $('#footer_action_buttonT').addClass('glyphicon-plus');
            
            $('#footer_action_buttonT').removeClass('glyphicon-check');
            $('.actionBtnT').addClass('btn-primary');
            
            $('.actionBtnT').removeClass('btn-success');
            
            $('.actionBtnT').removeClass('edit');
            $('.actionBtnT').addClass('ajout');
            $('.modal-titleT').text('Ajouter un nouveau Materiel');
            
            
            $("#add_TE").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
         
            $('.mdcT').click(function(){
           $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
            $("#stock").val(0);
            $("#add_TE").modal("hide");
            });
          
      
        
    
  $('#footerT').on('click', '.ajout', function() {
   if(validate()){
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_materiel')}}",
            data: $('#form-TE').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              $("#stock").val(0);
                              $("#add_TE").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                                $("#stock").val(0);
                              $("#add_TE").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                              for (i=0; i < tab_TM.length;i++){
                                  if(nv.id_type_materiel == tab_TM[i].id){
                                    var grpe = tab_TM[i].libelle_type_materiel;
                                  }
                              }
                              var data = [
                               "<a class=\'edit-modalT\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.id_type_materiel + "," + nv.libelle_materiel + "," + nv.stock + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_materiel + "</a>",
                               grpe,
                               nv.stock
                              ];
                              
                              var rowIndex = $('#tableTE').dataTable().fnAddData(data);
                              var row = $('#tableTE').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tableTE tr#item"+nv.id);
                              tr.find('td:eq(0)').addClass('text-left');
                              tr.find('td:eq(1)').addClass('text-left');
                              tr.find('td:eq(2)').addClass('text-center');
                              var my_array = $('#tableTE').dataTable().fnGetNodes( );
                              var last_element = my_array[my_array.length - 1];
                              $(last_element).insertBefore($('#tableTE tbody tr:first-child'));
                              
                       }

                        
            });
          }
       });
    
     $('#footerT').on('click', '.edit', function() {
      if(validate()){
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_materiel')}}",
            data: $('#form-TE').serialize(),
            })
      
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                               $("#stock").val(0);
                              $("#add_TE").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                               $("#stock").val(0);
                              $("#add_TE").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            nv = JSON.parse(msg['nouveau']);
                             for (i=0; i < tab_TM.length;i++){
                                  if(nv.id_type_materiel == tab_TM[i].id){
                                    var grpe = tab_TM[i].libelle_type_materiel;
                                  }
                              }
                            var tr = $("#tableTE tr#item"+nv.id);
            
                        tr.find('td:eq(0)').html(  "<a class=\'edit-modalT\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.id_type_materiel + "," + nv.libelle_materiel + "," + nv.stock + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_materiel + "</a>");
                        tr.find('td:eq(1)').html("" + grpe);
                        tr.find('td:eq(2)').html("" + nv.stock);
                       // $('#tableTE').DataTable().rows( tr ).invalidate().draw();
                        
            });
            }
       });
@endsection