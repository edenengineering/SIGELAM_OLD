@extends("dashboard")
@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>  
<div class="tab-content">
    <div class="row" style="margin-bottom:15px; margin-top:15px;">
          <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addH"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
    </div>
     
                    <table id="tableHopital" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
                    <caption id="cap">
                        <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES HÔPITAUX</h4>
                    </caption> 
                 
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr  style ="heigth:10px;">
                        
                        <th class="text-center">Nom de l'hôpital</th>
                        
                      </tr>
                    </thead>
                    @foreach($hopitals as $item)
                      <tr id="item{{$item->id}}">
                        
                        <td class="text-left"><a class="edit-modalH" style="cursor:pointer"
                            data-info="{{$item->id}},{{$item->nom_hopital}}">
                            <span class="glyphicon glyphicon-edit"></span> {{$item->nom_hopital}}
                          </a>
                        </td>
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
    
            {{ csrf_field() }} 
              <div class="row">
                <div class="form-group ">
                  <label for="nom_hopital" class="control-label col-sm-3">Nom de l'hôpital : </label>
                  <div class="col-sm-8">
                    <input  class="form-control" name="nom_hopital" id="nom_hopital" type="text" required />  
                  </div>
                  
                </div>  
              </div>
              
             <input type="hidden" id="id_hopital" name="id_hopital" value="">
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
                "iDisplayLength": 5
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
  
     
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
            $('.modal-titleH').text('Modifier les informations de l\' hôpital');
            
            
            var details = $(this).data('info').split(',');
            $('#form-hopital #id_hopital').val(details[0]);
    
            $('#form-hopital #nom_hopital').val(details[1]);    
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
            $('.modal-titleH').text('Ajouter un nouvel Hôpital');
            
            
            $("#add_hopital").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
         
            $('.mdcH').click(function(){
           $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
            $("#add_hopital").modal("hide");
            });
          
      
        
    
  $('#footerH').on('click', '.ajout', function() {
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_hopital')}}",
            data: $('#form-hopital').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_hopital").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_hopital").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                              
                              var data = [
                               "<a class=\'edit-modalH\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.nom_hopital + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.nom_hopital + "</a>"
                              ];
                              
                              var rowIndex = $('#tableHopital').dataTable().fnAddData(data);
                              var row = $('#tableHopital').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tableHopital tr#item"+nv.id);
                              tr.find('td:eq(0)').addClass('text-left');
                              
                       }

                        
            });
       });
    
     $('#footerH').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_hopital')}}",
            data: $('#form-hopital').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_hopital").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_hopital").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            nv = JSON.parse(msg['nouveau']);
                           
                            var tr = $("#tableHopital tr#item"+nv.id);
            
                        tr.find('td:eq(0)').html( "<a class=\'edit-modalH\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.nom_hopital + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.nom_hopital + "</a>");
                        $('#tableHopital').DataTable().rows( tr ).invalidate().draw();
                        
            });
       });
    
 
@endsection