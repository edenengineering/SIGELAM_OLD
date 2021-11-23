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
    valid = checkEmpty($("#nom_agent"));
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
          <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addC"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
       
    </div>
                    <table id="tableAgent" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
                    <caption id="cap">
                        <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES AGENTS EDITEURS</h4>
                    </caption> 
                 
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr  style ="heigth:10px;">
                        <th class="text-left">Nom de l'agent</th>
                        <th class="text-left">Etat</th>
                      </tr>
                    </thead>
                    @foreach($agent_editeurs as $item)
                      <tr id="item{{$item->id}}" style="cursor:pointer">
                        <td class="text-left"><a class="edit-modalC" style="cursor:pointer"
                            data-info="{{$item->id}},{{$item->nom_agent}}">
                            <span class="glyphicon glyphicon-edit"></span> {{$item->nom_agent}}
                          </a>
                        </td>
                         @if($item->statut == 1)
                              <td>ACTIF</td>
                            @else
                               <td>DESACTIVE</td>
                            @endif
                      </tr>
                    @endforeach
                  </table>
</div>
 <div id="add_centre" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                   
                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdcC" data-dismiss="modal">&times;</button>
                        <h2 id="titre" class="modal-titleC" ></h2>
                      </div>
                      <div class="modal-body">
                        <form id="form-centre_prescripteur" class="form-horizontal" role="form">
                  
                        <div class="row">
                          <div class="form-group ">
                            <label for="nom_hopital" class="control-label col-sm-3">Nom de l'agent (*): <br /><span class="nom_agent-validation validation-error"></span></label>
                            <div class="col-sm-8">
                              <input  class="form-control" name="nom_agent" id="nom_agent" type="text" required />  
                            </div>
                            
                          </div>  
                        </div>
                        
                       <input type="hidden" id="id_agent_editeur" name="id_agent_editeur" value="">
                        </form>
                        <div class="deleteContentC">
                              <h3 class="text-center">Voulez-vous vraiment supprimer les items sélectionnés ? <span
                                class="hidden didC"></span></h3>
                        </div>
                      </div>
                      <div class="modal-footer" id="footerC">
                        <button type="button" class="btn actionBtnC" >
                        <span id="footer_action_buttonC" class='glyphicon'> </span>
                      </button>
                      <button type="button" class="btn btn-warning mdcC">
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
    <h3 class="modal-titleT"><i class="glyphicon glyphicon-info-sign"></i> Information</h3>
  </div>
  <div class="modal-body">
    <h3>Vous devez cocher au moins un agent !!</h3>
  </div>
  <div class="modal-footer" >
    <button type="button" class="btn btn-warning mdcA">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
<div id="modActi" class="modal fade" role="dialog">
 <div class="modal-dialog" >
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcAc">&times;</button>
    <h3 class="modal-titleA"></h3>
  </div>
  <div class="modal-body">
    <h3>Voulez-vous vraiment <span class="operation"></span> cet agent editeur ? <span class="did_userA hidden"></span></h3>
  </div>
  <div class="modal-footer" >
    <button type="button" id="btnAct" class="btn btn-warning">
      <span class='glyphicon glyphicon-remove'></span> Oui
    </button>
    <button type="button" class="btn btn-warning mdcAc">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
@endsection
@section('another')
    var tab_centre = $('#tableAgent').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                 "columnDefs": [
                { className: "align-left","targets": [0,1]}
              ]
            });
    //$(".dataTables_length label").addClass("form-control");
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
 
     $('div.dataTables_filter input').focus();
  
     var countC = 0;

      $('form input').on('keypress', function(e) {
          return e.which !== 13;
      });
                  

         $('#checkallC').change(function(){
          $('.checkitemC').prop("checked",$(this).prop("checked"))
           $('.checkitemC').each(function(){
            if($(this).prop("checked")){
           
              countC++;
            }
           });

          
         });
         
         $('.checkitemC').change(function(){
           $('.checkitemC').each(function(){
            if($(this).prop("checked")){
           
              countC++;
            }
           });
        });

         $('#tableAgent').on('dblclick', 'tr', function(event){

         if(this.cells[0].innerHTML != "Nom de l'agent"){
         
            var str = $(this).attr('id');
            
            var res = str.substring(4);
            $('.did_userA').text(res);
            if(this.cells[1].innerHTML == "ACTIF"){
                  $(".modal-titleA").text("Désactivation");
                  $(".operation").text("désactiver");
            }else{
                $(".modal-titleA").text("Activation");
                  $(".operation").text("activer");
            }
            $("#modActi").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
            });
            
        }
     });

        $(document).on('click', '.edit-modalC', function() {
            $('#footer_action_buttonC').text(" Update");
            $('#footer_action_buttonC').addClass('glyphicon-check');
            $('#footer_action_buttonC').removeClass('glyphicon-trash');
            $('#footer_action_buttonC').removeClass('glyphicon-plus');
            $('.actionBtnC').addClass('btn-success');
            $('.actionBtnC').removeClass('btn-danger');
            $('.actionBtnC').removeClass('btn-primary');
            $('.actionBtnC').removeClass('delete');
            $('.actionBtnC').removeClass('ajout');
            $('.actionBtnC').addClass('edit');
            
            $('.deleteContentC').hide();
            $('.form-horizontal').show();
            var details = $(this).data('info').split(',');
            $('.modal-titleC').text("Modifier les informations de l'agent " + details[1] );
        
        $('#form-centre_prescripteur #id_agent_editeur').val(details[0]);
        
        $('#form-centre_prescripteur #nom_agent').val(details[1]);
        
        
        $("#add_centre").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
        
      
         $(document).on('click', '#addC', function() {
            $('#footer_action_buttonC').text(" Ajout");
            $('#footer_action_buttonC').addClass('glyphicon-plus');
            $('#footer_action_buttonC').removeClass('glyphicon-trash');
            $('#footer_action_buttonC').removeClass('glyphicon-check');
            $('.actionBtnC').addClass('btn-primary');
            $('.actionBtnC').removeClass('btn-danger');
            $('.actionBtnC').removeClass('btn-success');
            $('.actionBtnC').removeClass('delete');
            $('.actionBtnC').removeClass('edit');
            $('.actionBtnC').addClass('ajout');
            $('.modal-titleC').text('Ajouter un nouvel agent');
            $('.deleteContentC').hide();
            $('.form-horizontal').show();
           
            $("#add_centre").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
         
            $('.mdcC').click(function(){
             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
              
              
              $("#add_centre").modal("hide");

            });

            $('.mdcA').click(function(){
              $("#AlerPre").modal("hide");

            });
             $('.mdcAc').click(function(){
              $("#modActi").modal("hide");
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
            $('#footer_action_buttonC').text(" Delete");
            $('#footer_action_buttonC').removeClass('glyphicon-check');
            $('#footer_action_buttonC').removeClass('glyphicon-plus');
            $('#footer_action_buttonC').addClass('glyphicon-trash');
            $('.actionBtnC').removeClass('btn-success');
            $('.actionBtnC').removeClass('btn-primary');
            $('.actionBtnC').addClass('btn-danger');
            $('.actionBtnC').removeClass('edit');
            $('.actionBtnC').removeClass('ajout');
            $('.actionBtnC').addClass('delete');
            $('.modal-titleC').text('Supression');
            $('.deleteContentC').show();
            $('.form-horizontal').hide();
            $('.didC').text(id);
            $("#add_centre").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
          }else{
              $("#AlerPre").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
          }
        });
        
     $('#add_centre').on('hidden.bs.modal', function () {
                $(".actionBtnC").removeAttr("disabled");
       });
  $('#footerC').on('click', '.ajout', function() {
      
        if(validate()){
         $(this).attr("disabled","disabled");
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_agent_editeur')}}",
            data:  {
                  
                  'nom_agent': $('#nom_agent').val()
              }
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_centre").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_centre").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                            
                               var etat="";
                            if(nv.statut == 1){
                               var etat = "ACTIF";
                            }else{
                              var etat= "DESACTIVE"
                            }
                              var data = [
                               "<a class=\'edit-modalC\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.nom_agent + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.nom_agent + "</a>",
                                etat
                              ];
                              var rowIndex = $('#tableAgent').dataTable().fnAddData(data);
                              var row = $('#tableAgent').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tableAgent tr#item"+nv.id);
                              tr.css("cursor","pointer");
                              tr.find('td:eq(0)').addClass('text-left');
                              tr.find('td:eq(1)').addClass('text-left');
                              var my_array = $('#tableAgent').dataTable().fnGetNodes( );
                               var last_element = my_array[my_array.length - 1];
                              
                              $(last_element).insertBefore($('#tableAgent tbody tr:first-child'));
                              
                       }

                        
            });
            }
       });
    
     $('#footerC').on('click', '.edit', function() {
        
       if(validate()){
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_agent_editeur')}}",
            data: { 
                'nom_agent': $('#nom_agent').val(),
                'id_agent_editeur': $('#id_agent_editeur').val()
                  }
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_centre").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_centre").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            nv = JSON.parse(msg['nouveau']);

                            var etat="";
                            if(nv.statut == 1){
                               var etat = "ACTIF";
                            }else{
                              var etat= "DESACTIVE"
                            }
                            var tr = $("#tableAgent tr#item"+nv.id);
                          
                        tr.find('td:eq(0)').html( "<a class=\'edit-modalC\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.nom_agent + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.nom_agent + "</a>");
                         tr.find('td:eq(1)').html("" + etat);
                       // $('#tableAgent').DataTable().rows( tr ).invalidate().draw();

                       // var oSettings =  $('#tableAgent').dataTable().fnSettings();

                       // var page = Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength);

                         //$('#tableAgent').dataTable().fnPageChange(page);
                        
            });
            }
       });
    $("#btnAct").click(function(){
             $.ajax({
              type: 'post',
              url: "{{route('dashboard_agent_editeur_delete')}}",
              data: {
                  'id_agent_editeur': $('.did_userA').text()
              }
          })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modActi").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modActi").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['agent']);
                        
                          var tr = $("#tableAgent tr#item"+nv.id);
                          if(nv.statut == 1 ){
                            tr.find('td:eq(1)').html("ACTIF");
                          }else{
                            tr.find('td:eq(1)').html("DESACTIVE");
                          }
                          
                         
                       
                        
            });

        });
     $('#footerC').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: "{{route('dashboard_agent_editeur_delete')}}",
              data: {
                  'id_agent_editeur': $('.didC').text()
              }
          })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_centre").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_centre").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['supprimes']);
                         for (var i=0; i< nv.length; i++){
                          $('#tableAgent').dataTable().fnDeleteRow($('#tableAgent').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                       
                        
            });

      });
@endsection