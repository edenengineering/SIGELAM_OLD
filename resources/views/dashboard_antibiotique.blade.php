@extends("dashboard")
@section('add_style')
 .align-right{text-align:right;max-width:80px} 
 .align-left{text-align:left;max-width:80px} 
 .align-center{text-align:center;max-width:80px} 
@endsection
@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script> 
<script type="text/javascript">
 function validate() {
    
    var valid = true;
    valid = checkEmpty($("#libelle_antibiotique"));
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
          <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addA"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
    </div>

          <table id="tableBio" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
          <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES ANTIBIOTIQUES</h4>
          </caption>  
          
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th class="text-center">Nom de l'Antibiotique</th>
            </tr>
          </thead>
           @foreach($antibiotiques as $item)
              <tr id="item{{$item->id}}">
                
                <td class="text-left"><a class="edit-modalA" style="cursor:pointer"
                    data-info="{{$item->id}},{{$item->libelle_antibiotique}}">
                    <span class="glyphicon glyphicon-edit"></span> {{$item->libelle_antibiotique}}
                  </a>
                </td>
              </tr>
          @endforeach
        </table>      
      <div id="add_antibiotique" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
				        <button type="button" class="close mdcA" data-dismiss="modal">&times;</button>
				        <h2 id="titre" class="modal-titleA" >Ajouter un Antibiotique</h2>
				      </div>
				      <div class="modal-body">
				        <form  id="form-antibiotique" class="form-horizontal" >
                  {{ csrf_field() }} 
				        	<div class="row">
                    <div class="form-group ">
                      <label for="libelle_antibiotique" class="control-label col-sm-4">Nom de l'antibiotique (*):&nbsp;<br /><span class="nom_antibiotique-validation validation-error"></span></label>
                      <div class="col-sm-7">
                        <input  class="form-control" name="nom_antibiotique" id="libelle_antibiotique" type="text" />
                      </div>
                    </div>
                    
                  </div>
                  
                  <input type="hidden" id="id_antibiotique" name="id_antibiotique" value="">
				        </form>
				      </div>
      				<div class="modal-footer" id="footerA">
                  <button type="button" class="btn actionBtnA">
                    <span id="footer_action_buttonA" class='glyphicon'> </span>
                  </button>
                <button type="button" class="btn btn-warning mdcA">
                  <span class='glyphicon glyphicon-remove'></span> Close
                </button> 
             </div>
				    </div>

				  </div>
				</div>
           
</div>
@endsection
@section('another')
     var tab_bio = $('#tableBio').DataTable({
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
                  

         
        $(document).on('click', '.edit-modalA', function() {
            $('#footer_action_buttonA').text(" Update");
            $('#footer_action_buttonA').addClass('glyphicon-check');
            
            $('#footer_action_buttonA').removeClass('glyphicon-plus');
            $('.actionBtnA').addClass('btn-success');
            
            $('.actionBtnA').removeClass('btn-primary');
            
            $('.actionBtnA').removeClass('ajout');
            $('.actionBtnA').addClass('edit');
            $('.modal-titleA').text('Modifier les informations de l\' antibiotique');
            
            
            var details = $(this).data('info').split(',');
            $('#form-antibiotique #id_antibiotique').val(details[0]);
    
            $('#form-antibiotique #libelle_antibiotique').val(details[1]);    
            $("#add_antibiotique").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
              });
        });
        
      
         $(document).on('click', '#addA', function() {
            $('#footer_action_buttonA').text(" Ajout");
            $('#footer_action_buttonA').addClass('glyphicon-plus');
            
            $('#footer_action_buttonA').removeClass('glyphicon-check');
            $('.actionBtnA').addClass('btn-primary');
            
            $('.actionBtnA').removeClass('btn-success');
            
            $('.actionBtnA').removeClass('edit');
            $('.actionBtnA').addClass('ajout');
            $('.modal-titleA').text('Ajouter un nouvel Antibiotique');
            
            
            $("#add_antibiotique").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
         
            $('.mdcA').click(function(){
           $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
            $("#add_antibiotique").modal("hide");
            });
          
      
   $('#add_antibiotique').on('hidden.bs.modal', function () {
                $(".actionBtnA").removeAttr("disabled");
       });
    
  $('#footerA').on('click', '.ajout', function() {
    if(validate()){
       $(this).attr("disabled","disabled");
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_antibiotique')}}",
            data: $('#form-antibiotique').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_antibiotique").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_antibiotique").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                              
                              var data = [
                               "<a class=\'edit-modalA\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle_antibiotique + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_antibiotique + "</a>"
                              ];
                              
                              var rowIndex = $('#tableBio').dataTable().fnAddData(data);
                              var row = $('#tableBio').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tableBio tr#item"+nv.id);
                              tr.find('td:eq(0)').addClass('text-left');

                              var my_array = $('#tableBio').dataTable().fnGetNodes( );
                               var last_element = my_array[my_array.length - 1];
                              $(last_element).insertBefore($('#tableBio tbody tr:first-child'));
                              
                       }

                        
            });
            }
       });
    
     $('#footerA').on('click', '.edit', function() {
      if(validate()){
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_antibiotique')}}",
            data: $('#form-antibiotique').serialize(),
            })
      
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_antibiotique").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_antibiotique").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            nv = JSON.parse(msg['nouveau']);
                           
                            var tr = $("#tableBio tr#item"+nv.id);
            
                        tr.find('td:eq(0)').html(  "<a class=\'edit-modalA\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle_antibiotique + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_antibiotique + "</a>");
                       // $('#tableBio').DataTable().rows( tr ).invalidate().draw();

            });
            }
       });
@endsection