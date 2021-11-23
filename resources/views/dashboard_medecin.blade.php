@extends("dashboard")

@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>    
 <script type="text/javascript">
     
      var tab_H = {!! $hopitals->toJson()  !!};
      
      function validate() {
    
    var valid = true;
    valid = checkEmpty($("#nom"));

    valid = valid && checkEmpty($("#grade"));
     valid = valid && checkEmpty($("#tel"));
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
              <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addM"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
              <button id="delM" style="margin-left:10px"  class="delete-modalM btn btn-danger col-sm-2">
              <span class="glyphicon glyphicon-trash"></span> Supprimer
              </button>
    </div>
     
                    <table id="tableMedecin" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
                    <caption id="cap">
                        <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES MEDECINS</h4>
                    </caption> 
                 
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr style ="heigth:10px;">
                        <th style="text-align:center;width:45px"><input type="checkbox" id="checkallM" /></th>
                        <th class="text-left">Noms et Prénoms</th>
                        <th class="text-left">Titre</th>
                        <th class="text-left">Telephone</th>
                        <th class="text-left">Email</th>
                      </tr>
                    </thead>
                     @foreach($medecin_prescripteurs as $item)
                      <tr id="item{{$item->id}}">
                        <td class="text-center"><input type="checkbox" class="checkitemM" value="{{$item->id}}" /></td>
                        <td class="text-left"><a class="edit-modalM" style="cursor:pointer"
                            data-info="{{$item->id}},{{$item->nom_prescripteur}},{{$item->id_hopital}},{{$item->titre}},{{$item->telephone}},{{$item->fax}},{{$item->sexe}},{{$item->email}},{{$item->matricule_agent}},{{$item->date_debut}},{{$item->date_fin}}">
                            <span class="glyphicon glyphicon-edit"></span> {{$item->nom_prescripteur}}
                          </a>
                        </td>
                        <td class="text-left">{{$item->titre}}</td>
                        <td class="text-left">{{$item->telephone}}</td>
                        <td class="text-left">
                            {{ $item->email }}
                        </td>
                        
                      </tr>
                      @endforeach
                  </table>
                      
          <div id="add_medecin" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg" style="width:80%">

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdCM" data-dismiss="modal">&times;</button>
                        <h2  class="modal-titleM" ></h2>
                      </div>
                      <div class="modal-body">
                        <form  id="form-medecin" class="form-horizontal" role="form" >
                            <div class="row" style="margin-top: 30px; margin-bottom:5px;">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                     <label for="nom" class="control-label text-left col-sm-5">Noms et prénoms (*):&nbsp;<br /><span class="nom_prescripteur-validation validation-error"></span></label>
                                      <div class=" col-sm-7">
                                        
                                        <input type="text"  name="nom_prescripteur" class="form-control" id="nom" required>
                                      </div>
                                    </div> 
                                </div>
                                
                                <div class="col-sm-5">
                                      <div class="form-group">
                                        <label for="grade"  class="control-label col-sm-3 text-left">Titre (*):&nbsp;<br /><span class="titre-validation validation-error"></span></label>
                                        <div class="col-sm-7" >
                                        <select id="grade" name="titre" class="form-control" >
                                          
                                          <option value="Pr">Pr</option>
                                          <option value="Dr">Dr</option>
                                          <option value="Inf">Inf</option>
                                          <option value="Mr">Mr</option>
                                          <option value="Mme">Mme</option>
                                        </select>
                                        </div>
                                      
                                      </div>  
                                </div>
                      
                                
                                
                            </div>
                            
                           
                            
                            <div class="row"  style="margin-bottom:5px;">
                                 
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label for="tel"  class="control-label col-sm-5 text-left">Telephone (*):&nbsp;<br /><span class="telephone-validation validation-error"></span></label>
                                        <div class="col-sm-7" >
                                        <input type="text" id="tel" name="telephone" class="form-control" required>
                                        </div>
                                      
                                      </div>  
                                    </div>
                            
                                    <div class="col-sm-5">
                                      <div class="form-group">
                                        <label for="fax"  class="control-label col-sm-3 text-left">Fax : </label>
                                        <div class="col-sm-7" >
                                        <input type="text" id="fax" name="fax" class="form-control" required>
                                        </div>
                                      
                                      </div>  
                                    </div>
                                    
                            
                            </div> 

                            <div class="row"  style="margin-bottom:5px;">
                                
                                   <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="" class="control-label col-sm-5 text-left">Sexe : </label>
                                      <div class="col-sm-7 ">
                                        <div class="row">
                                          <div class="col-sm-5">
                                            <label class="control-label" ><input type="radio" id="SM" value="masculin" checked="checked" name="sexe"> M</label>
                                          </div>
                                          <div class="col-sm-5 col-sm-offset-1">
                                            <label  class="control-label" ><input type="radio"  id="SF" value="feminin" name="sexe"> F</label>
                                          </div>
                                        </div>
                                        
                              
                                        
                                      </div>
                                    </div>
                                </div>
                             
                                    <div class="col-sm-5">
                                      <div class="form-group">
                                        <label for="email"  class="control-label col-sm-3 text-left">Email : </label>
                                        <div class="col-sm-7">
                                        <input type="email" id="email" name="email" class="form-control" required>
                                        </div>
                                        
                                      </div>  
                                    </div>
                                    
                            

                            </div>
                             
                           
                            <input type="hidden" id="id_medecin" name="id_medecin_prescripteur" value="">
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
<div id="AlerPre" class="modal fade" role="dialog">
 <div class="modal-dialog" >
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcA">&times;</button>
    <h3 class="modal-titleT"><i class="glyphicon glyphicon-info-sign"></i> Information</h3>
  </div>
  <div class="modal-body">
    <h3>Vous devez cocher au moins un medecin !!</h3>
  </div>
  <div class="modal-footer" >
    <button type="button" class="btn btn-warning mdcA">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
@endsection
@section('another')
    var tab_medecin = $('#tableMedecin').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                 "columnDefs": [
                { className: "align-left","targets": [1,2,3,4]},
                { className: "align-center","targets": [0]}
              ]
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
            $('.modal-titleM').text('Modifier les informations du Medecin');
            $('.deleteContentM').hide();
            $('.form-horizontal').show();
            var details = $(this).data('info').split(',');

            
            $('#form-medecin #id_medecin').val(details[0]);
        
        $('#form-medecin #nom').val(details[1]);
        $('#form-medecin #grade').val(details[3]);
        $('#form-medecin #tel').val(details[4]);
        $('#form-medecin #fax').val(details[5]);
        
        
        if (details[6]== 'masculin'){
              $('#form-medecin #SM').prop("checked",true);
        }else{
              $('#form-medecin #SF').prop("checked",true);
        }
        $('#form-medecin #email').val(details[7]);
            $("#add_medecin").modal({
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
            $('.modal-titleM').text('Ajouter un nouveau Medecin');
            $('.deleteContentM').hide();
            $('.form-horizontal').show();
            $("#add_medecin").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
         
            $('.mdCM').click(function(){
              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
            $("#add_medecin").modal("hide");
            });
            $('.mdcA').click(function(){
              $("#AlerPre").modal("hide");
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
            $("#add_medecin").modal({
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
        
     $('#add_medecin').on('hidden.bs.modal', function () {
                $(".actionBtnM").removeAttr("disabled");
       });
  $('#footerM').on('click', '.ajout', function() {
   if(validate()){
        $(this).attr("disabled","disabled");
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_medecin')}}",
            data: $('#form-medecin').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_medecin").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_medecin").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                             
                           
                              var data = [
                               "<input type=\'checkbox\' class=\'checkitemM\' value=\'" + nv.id + "\'/>",
                               "<a class=\'edit-modalM\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.nom_prescripteur + "," + nv.id_hopital + "," + nv.titre + "," + nv.telephone + "," + nv.fax + "," + nv.sexe + "," + nv.email + "," + nv.matricule_agent + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.nom_prescripteur + "</a>",
                                nv.titre,
                                nv.telephone,
                                nv.email
                              ];
                              var rowIndex = $('#tableMedecin').dataTable().fnAddData(data);
                              var row = $('#tableMedecin').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tableMedecin tr#item"+nv.id);
                              tr.find('td:eq(0)').addClass('text-center');
                              tr.find('td:eq(1)').addClass('text-left');
                              tr.find('td:eq(2)').addClass('text-left');
                              tr.find('td:eq(3)').addClass('text-left');
                              tr.find('td:eq(4)').addClass('text-left');
                              var my_array = $('#tableMedecin').dataTable().fnGetNodes( );
                               var last_element = my_array[my_array.length - 1];
                              
                              $(last_element).insertBefore($('#tableMedecin tbody tr:first-child'));
                       }

                        
            });
          }
       });
    
     $('#footerM').on('click', '.edit', function() {
      if(validate()){
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_medecin')}}",
            data: $('#form-medecin').serialize(),
            })
      
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_medecin").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_medecin").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            nv = JSON.parse(msg['nouveau']);
                           
                            var tr = $("#tableMedecin tr#item"+nv.id);
            
                        tr.find('td:eq(1)').html( "<a class=\'edit-modalM\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.nom_prescripteur + "," + nv.id_hopital + "," + nv.titre + "," + nv.telephone + "," + nv.fax + "," + nv.sexe + "," + nv.email + "," + nv.matricule_agent + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.nom_prescripteur + "</a>");
                        tr.find('td:eq(2)').html(""+ nv.titre);
                        tr.find('td:eq(3)').html(""+ nv.telephone);
                        tr.find('td:eq(4)').html(""+ nv.email);
                      //  $('#tableMedecin').DataTable().rows( tr ).invalidate().draw();
                        
            });
          }
       });
    
     $('#footerM').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: "{{route('dashboard_medecin_delete')}}",
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id_medecin_prescripteur': $('.didM').text()
              }
          })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_medecin").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_medecin").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['supprimes']);
                         
                         for (var i=0; i< nv.length; i++){
                          $('#tableMedecin').dataTable().fnDeleteRow($('#tableMedecin').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                       
                        
            });
      });
@endsection