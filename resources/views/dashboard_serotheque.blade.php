@extends("dashboard")

@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>    
 <script type="text/javascript">
  var tab_do = {!! $serotheques->toJson() !!};
  var tab_pat = {!! $pathologies->toJson() !!};
  var tab_nature = {!! $natures->toJson() !!};
  var tabQ = {!! $quartiers->toJson() !!};
  function validate() {
    
    var valid = true;
    valid = checkEmpty($("#caractere_id"));
    valid = valid && checkEmpty($("#date_naissance"));
    valid = valid && checkEmpty($("#preleve"));
    valid = valid && checkEmpty($("#NE"));
    valid = valid && checkEmpty($("#quartier"));
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
            <button class="btn btn-success col-sm-2 col-sm-offset-1"  id="addC"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
            <button id="delC" style="margin-left:10px"  class="delete-modalC btn btn-danger col-sm-2">
            <span class="glyphicon glyphicon-trash"></span> Supprimer
            </button>
            <button class="btn btn-primary col-sm-2 " style="margin-left:10px" disabled="disabled" id="btnPrint"><i class="glyphicon glyphicon-print" ></i> Imprimer</button>
    </div>
     <div id="table-wrapper">
                    <table id="tableCP" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
                    <caption id="cap">
                        <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES ECHANTILLONS</h4>
                    </caption> 
                 
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr  style ="heigth:10px;">
                        <th style="text-align:center;width:45px"><input type="checkbox" id="checkallC" /></th>
                        <th class="text-left">Carac ID</th>
                        <th class="text-left">Nature</th>
                        <th class="text-left">Pathologie liée</th>
                        <th class="text-left">Genre</th>
                        <th class="text-left">Date Naiss</th>
                        <th class="text-left">Preleve</th>
                        <th class="text-left">Quartier</th>
                        
                      </tr>

                    </thead>
                    
                  </table>
                  </div>
          <div id="add_centre"  class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg" style="width:90%">

                   
                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdcC" data-dismiss="modal">&times;</button>
                        <h2 id="titre" class="modal-titleC" ></h2>
                      </div>
                      <div class="modal-body">
                        <form id="form-serotheque" class="form-horizontal" role="form">
                           <div class="row" style="margin-bottom:10px;">
                              <div class="form-group ">
                                <label for="caractere_id" class="control-label col-sm-3 text-right">Caractere d'ID (*):&nbsp;<br /><span class="caractere_id-validation validation-error"></span></label>
                                <div class="col-sm-3">
                                  <input  class="form-control" name="caractere_id" id="caractere_id" type="text" min="0" required />  
                                </div>
                                 <label for="genre" class="control-label col-sm-2 text-right">Genre :&nbsp;<br /><span class="genre-validation validation-error"></span></label>
                                  <div class="col-sm-3">
                                      <select class="form-control" name="genre" id="genre">
                                         <option value="Homme">Homme</option>
                                         <option value="Femme">Femme</option>
                                         <option value="Femme Enceinte">Femme Enceinte</option>
                                       </select>
                                  </div>
                                
                              </div> 

                           </div>
                           <div class="row" style="margin-bottom:10px;">
                              <div class="form-group">
                                   <label for="age" class="control-label col-sm-3 text-right">Date naissance (*):&nbsp;<br /><span class="date_naissance-validation validation-error"></span></label>
                                <div class="col-sm-3 ">
                                  <input  class="form-control" name="date_naissance" id="date_naissance" type="date" required /> 
                                </div>
                                <label for="numero_enregistrement" class="control-label col-sm-2 text-right">Prélevé le (*):&nbsp;<br /><span class="preleve_le-validation validation-error"></span></label>
                                <div class="col-sm-3">
                                    <input  class="form-control" name="preleve_le" id="preleve"  type="date" required />
                                </div>
                              </div>
                           </div>
                           <div class="row" style="margin-bottom:10px;">
                              <div class="form-group">
                                 <label for="NE" class="control-label col-sm-3 text-right">Nature de l'échantillon (*):&nbsp;<br /><span class="id_nature-validation validation-error"></span></label>
                                  <div class="col-sm-3">
                                      <select class="form-control" name="id_nature" id="NE">
                                        
                                      </select>
                                  </div>
                                  <label for="PL" class="control-label col-sm-2 text-right">Pathologie liée :&nbsp;<br /><span class="id_pathologie-validation validation-error"></span></label>
                                  <div class="col-sm-3">
                                      <select class="form-control" name="id_pathologie" id="PL">
                                        
                                      </select>
                                  </div>
                              </div> 
                           </div>
                             <div class="row" style="margin-bottom:10px;">
                              <div class="form-group">
                                 <label for="quartier" class="control-label col-sm-3 text-right">Quartier :&nbsp;<br /><span class="quartier-validation validation-error"></span></label>
                                  <div class="col-sm-8">
                                      <select class="form-control" name="id_quartier" id="quartier">
                                        
                                      </select>
                                      
                                  </div>
                              </div> 
                           </div>
                          
                           
                             
                          <input type="hidden" id="id_serotheque" name="id_serotheque" value="">
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
</div>
<div id="AlerPre" class="modal fade" role="dialog">
 <div class="modal-dialog" >
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcA">&times;</button>
    <h3 class="modal-titleT"><i class="glyphicon glyphicon-info-sign"></i> Information</h3>
  </div>
  <div class="modal-body">
    <h3>Vous devez cocher au moins un item !!</h3>
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
@section('anotherLoad')
  
               function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 
                   for(var j = 0; j < tab_do.length ; j++){
                            
                            var nat= "";
                              var pat ="";
                              var quat ="";
                              for(var i=0; i < tab_nature.length; i++){
                                  if(tab_nature[i].id == tab_do[j].id_nature){
                                      nat = tab_nature[i].libelle_nature;
                                  }
                              }


                              for(var i=0; i < tab_pat.length; i++){
                                  if(tab_pat[i].id == tab_do[j].id_pathologie){
                                      pat = tab_pat[i].libelle_pathologie;
                                  }
                              }
                               for(var i=0; i < tabQ.length; i++){
                                  if(tabQ[i].id == tab_do[j].id_quartier){
                                      quat = tabQ[i].libelle_quartier;
                                  }
                              }

                              var data = [
                               "<input type=\'checkbox\' class=\'checkitemC\' value=\'" + tab_do[j].id + "\'/>",
                               "<a class=\'edit-modalC\' style=\'cursor:pointer\' data-info=\'" + tab_do[j].id + "," + tab_do[j].genre + "," + tab_do[j].preleve_le + "," + tab_do[j].date_naissance + "," + tab_do[j].caractere_id + "," + tab_do[j].id_nature + "," + tab_do[j].id_pathologie + "," + tab_do[j].id_quartier + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ tab_do[j].caractere_id + "</a>",
                               
                                nat,
                                pat,
                                tab_do[j].genre,
                                tab_do[j].date_naissance,
                                tab_do[j].preleve_le,
                                quat
                              ];
                              var rowIndex = $('#tableCP').dataTable().fnAddData(data);
                              var row = $('#tableCP').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + tab_do[j].id);
                              var tr = $("#tableCP tr#item"+tab_do[j].id);
                              tr.find('td:eq(0)').addClass('text-center');
                              tr.find('td:eq(1)').addClass('text-left');
                              tr.find('td:eq(2)').addClass('text-left');
                              tr.find('td:eq(3)').addClass('text-left');
                              tr.find('td:eq(4)').addClass('text-left');
                               tr.find('td:eq(5)').addClass('text-left');
                               tr.find('td:eq(6)').addClass('text-left');
                               tr.find('td:eq(7)').addClass('text-left');
                               tr.find('td:eq(8)').addClass('text-left');
                    }
                       if(($("#tableCP").dataTable().fnSettings().aoData.length!==0)){
                                      $("#btnPrint").removeAttr("disabled");
                                }else{
                                      $("#btnPrint").attr("disabled","disabled");
                                } 
                 
@endsection

@section('another')


               function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 
    var tab_centre = $('#tableCP').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                 "columnDefs": [
                { className: "align-left","targets": [1,2,3,4,5,6,7]}
              ]
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    $('div.dataTables_filter input').focus();
     var countC = 0;

                  

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
            $('.modal-titleC').text('Modifier les informations du Biotheque');
            $('.deleteContentC').hide();
            $('.form-horizontal').show();
            var details = $(this).data('info').split(',');
             $("#NE").find("option").remove();
            $("#PL").find("option").remove();
             $("#quartier").find("option").remove();
            $('#NE').append($('<option>',
                 {
                    value: '',
                    text : "--Choisissez la nature de l'echantillon--",
                    selected:true
                }));
                
             for(var i=0;i < tab_nature.length;i++){
                  
                    $('#NE').append($('<option>',
                    {
                        value: tab_nature[i].id,
                        text : tab_nature[i].libelle_nature
                    }));
              }
                $("#form-serotheque #NE").val(details[5]);
              $('#PL').append($('<option>',
                 {
                    value: '',
                    text : "--- Choisissez la pathologie liée ---",
                    selected:true
                }));
                
             for(var i=0;i < tab_pat.length;i++){
                  
                    $('#PL').append($('<option>',
                    {
                        value: tab_pat[i].id,
                        text : tab_pat[i].libelle_pathologie
                    }));
              }
              $("#form-serotheque #PL").val(details[6]);
               $('#quartier').append($('<option>',
                 {
                    value: '',
                    text : "--- Choisissez le quartier ---",
                    selected:true
                }));
                
             for(var i=0;i < tabQ.length;i++){
                  
                    $('#quartier').append($('<option>',
                    {
                        value: tabQ[i].id,
                        text : tabQ[i].libelle_quartier
                    }));
              }
              $("#form-serotheque #quartier").val(details[7]);
            $("#form-serotheque #id_serotheque").val(details[0]);
            $("#form-serotheque #numero_enregistrement").val(details[1]);
            $("#form-serotheque #caractere_id").val(details[4]);
            $("#form-serotheque #date_naissance").val(details[3]);
            
            $("#form-serotheque #genre").val(details[1]);
             $("#form-serotheque #preleve").val(details[2]);
        $("#add_centre").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
        
        $("#btnPrint").click(function(){
              window.open("{{ route('dashboard_print_serotheque') }}");
        })
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
            $('.modal-titleC').text('Ajouter un nouvel échantillon');
            $('.deleteContentC').hide();
            $('.form-horizontal').show();
            $("#NE").find("option").remove();
            $("#PL").find("option").remove();
             $("#quartier").find("option").remove();
            $('#NE').append($('<option>',
                 {
                    value: '',
                    text : "--Choisissez la nature de l'echantillon--",
                    selected:true
                }));
                
             for(var i=0;i < tab_nature.length;i++){
                  
                    $('#NE').append($('<option>',
                    {
                        value: tab_nature[i].id,
                        text : tab_nature[i].libelle_nature
                    }));
              }

              $('#PL').append($('<option>',
                 {
                    value: '',
                    text : "--- Choisissez la pathologie liée ---",
                    selected:true
                }));
                
             for(var i=0;i < tab_pat.length;i++){
                  
                    $('#PL').append($('<option>',
                    {
                        value: tab_pat[i].id,
                        text : tab_pat[i].libelle_pathologie
                    }));
              }

              $('#quartier').append($('<option>',
                 {
                    value: '',
                    text : "--- Choisissez le quartier ---",
                    selected:true
                }));
                
             for(var i=0;i < tabQ.length;i++){
                  
                    $('#quartier').append($('<option>',
                    {
                        value: tabQ[i].id,
                        text : tabQ[i].libelle_quartier
                    }));
              }

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
       $(this).attr("disabled","disabled")
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_serotheque')}}",
            data: $('#form-serotheque').serialize()
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
                              var nat= "";
                              var pat ="";
                              var quat ="";
                              for(var i=0; i < tab_nature.length; i++){
                                  if(tab_nature[i].id == nv.id_nature){
                                      nat = tab_nature[i].libelle_nature;
                                  }
                              }


                              for(var i=0; i < tab_pat.length; i++){
                                  if(tab_pat[i].id == nv.id_pathologie){
                                      pat = tab_pat[i].libelle_pathologie;
                                  }
                              }
                               for(var i=0; i < tabQ.length; i++){
                                  if(tabQ[i].id == nv.id_quartier){
                                      quat = tabQ[i].libelle_quartier;
                                  }
                              }
                              var data = [
                               "<input type=\'checkbox\' class=\'checkitemC\' value=\'" + nv.id + "\'/>",
                               "<a class=\'edit-modalC\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.genre + "," + nv.preleve_le + "," + nv.date_naissance + "," + nv.caractere_id + "," + nv.id_nature + "," + nv.id_pathologie + "," + nv.id_quartier + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.caractere_id + "</a>",
                               
                                
                                nat,
                                pat,
                                nv.genre,
                                nv.date_naissance,
                                nv.preleve_le,
                                quat
                              ];
                              var rowIndex = $('#tableCP').dataTable().fnAddData(data);
                              var row = $('#tableCP').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tableCP tr#item"+nv.id);
                              tr.find('td:eq(0)').addClass('text-center');
                              tr.find('td:eq(1)').addClass('text-left');
                              tr.find('td:eq(2)').addClass('text-left');
                              tr.find('td:eq(3)').addClass('text-left');
                              tr.find('td:eq(4)').addClass('text-left');
                               tr.find('td:eq(5)').addClass('text-left');
                               tr.find('td:eq(6)').addClass('text-left');
                               tr.find('td:eq(7)').addClass('text-left');
                               tr.find('td:eq(8)').addClass('text-left');
                              
                       }

                        
            });
            }
       });
    
     $('#footerC').on('click', '.edit', function() {
       if(validate()){
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_serotheque')}}",
            data: $('#form-serotheque').serialize()
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
                            var nat= "";
                              var pat ="";
                              var quat ="";
                              for(var i=0; i < tab_nature.length; i++){
                                  if(tab_nature[i].id == nv.id_nature){
                                      nat = tab_nature[i].libelle_nature;
                                  }
                              }


                              for(var i=0; i < tab_pat.length; i++){
                                  if(tab_pat[i].id == nv.id_pathologie){
                                      pat = tab_pat[i].libelle_pathologie;
                                  }
                              }
                               for(var i=0; i < tabQ.length; i++){
                                  if(tabQ[i].id == nv.id_quartier){
                                      quat = tabQ[i].libelle_quartier;
                                  }
                              }
                            var tr = $("#tableCP tr#item"+nv.id);
            
                        tr.find('td:eq(1)').html("<a class=\'edit-modalC\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.genre + "," + nv.preleve_le + "," + nv.date_naissance + "," + nv.caractere_id + "," + nv.id_nature + "," + nv.id_pathologie + "," + nv.id_quartier + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.caractere_id + "</a>");
                        
                        tr.find('td:eq(2)').html(""+ nat);
                        tr.find('td:eq(3)').html(""+ pat);
                        tr.find('td:eq(4)').html(""+ nv.genre);
                        tr.find('td:eq(5)').html(""+ nv.date_naissance);
                        tr.find('td:eq(6)').html(""+ nv.preleve_le);
                        tr.find('td:eq(7)').html(""+ quat);
            });
            }
       });
    
     $('#footerC').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: "{{route('dashboard_serotheque_delete')}}",
              data: {
                  
                  'id_serotheque': $('.didC').text()
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
                          $('#tableCP').dataTable().fnDeleteRow($('#tableCP').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                       
                          if(($("#tableCP").dataTable().fnSettings().aoData.length!==0)){
                                      $("#btnPrint").removeAttr("disabled");
                                }else{
                                      $("#btnPrint").attr("disabled","disabled");
                                } 
                        
            });
      });
@endsection