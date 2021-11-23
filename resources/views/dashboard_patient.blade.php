@extends("dashboard")

@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
        var tab_pat = [];
        var tab_users = {!! $users->toJson()  !!};   
        var tab_pro = {!! $professions->toJson()  !!};
</script>
<div class="tab-content">

                    <div class="row" style="margin-bottom:15px;margin-top:15px">
                      <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addP"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
                     <!-- <button id="delE" style="margin-left:10px" class="delete-modalE btn btn-danger col-sm-2">
                      <span class="glyphicon glyphicon-trash"></span> Delete
                      </button>-->
                    </div>

                    
                    <table id="tableId" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMeP">
                    <caption id="cap">
                        <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES PATIENTS <span class="hidden ddate"></span> </h4>
                    </caption>  
                     <!-- rgb(150,150,150)-->
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr  style ="heigth:10px;">
                        <th class="text-left">Noms et Prenoms</th>
                        <th class="text-left">Matricule</th>
                        <th class="text-left">Né(e) Le</th>
                        <th class="text-left">Sexe</th>
                        <th class="text-left">Téléphone</th>
                        <th class="text-left">Enregistré le</th>
                        <th class="text-left">Agent</th>
                      </tr>
                    </thead>
                   
                  </table>
               
        </div>
          @include('edit_patient')
          
          @include('infos_patient')
@endsection
@section('active')
active
@endsection
@section('anotherLoad')
  
               function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 

              
                        $.ajax({
                            url: "{{route('dashboard_date')}}",
                            dataType: "json"
                        })
                        .done(function(msg){
                            var date = JSON.parse(msg['date']);
                            $(".ddate").text(date);
                        });

                         
                  
                 
@endsection
@section('another')
   function validate1() {
    
    var valid = true;
    valid = checkEmpty($("#name"));
    valid = valid && checkEmpty($("#date_naiss"));
     valid = valid && checkDat($("#date_naiss"));
    valid = valid && checkEmpty($("#tel"));
    valid = valid && checkEmpty($("#adresse"));
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

  function checkDat(obj) {
    var name = $(obj).attr("name");
    $("."+name+"-validation").html(""); 
    $(obj).css("border","");
    var str = $(obj).val().split("-");
    var res = $(".ddate").text().split("-");
    
    if( (parseInt(str[0]) < 1920 ) ||  ( parseInt(str[0]) > 2050 )   ) {
      $(obj).css("border","#FF0000 1px solid");
      $("."+name+"-validation").css("color","#FF0000");
      $("."+name+"-validation").html("Date Invalide");
      return false;
      
    }
    if( (parseInt(str[0]) == parseInt(res[0]) ) && (parseInt(str[1]) >= parseInt(res[1])) && (parseInt(str[2]) >= parseInt(res[2]) ) ){
      $(obj).css("border","#FF0000 1px solid");
      $("."+name+"-validation").css("color","#FF0000");
      $("."+name+"-validation").html("Date Invalide");
      return false;
      }
    return true;  
 }
  
  function checkTel(obj) {
    var result = true;
    
    var name = $(obj).attr("name");
    $("."+name+"-validation").html(""); 
    $(obj).css("border","");
    
    result = checkEmpty(obj);
    
    if(!result) {
      $(obj).css("border","#FF0000 1px solid");
      $("."+name+"-validation").css("color","#FF0000");
      $("."+name+"-validation").html("Required");
      return false;
    }
    
    var tel_regex = /^[6][5|7|9][0-9]{7}/;
    result = tel_regex.test($(obj).val());
    
    if(!result) {
      $(obj).css("border","#FF0000 1px solid");
      $("."+name+"-validation").css("color","#FF0000");
      $("."+name+"-validation").html("Numéro Invalide");
      return false;
    }
    
    return result;  
  }
      /* $('#tableId').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
               "order": [[ 5, "desc" ]]
            });*/
      var tableD = $('#tableId').DataTable({
               "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
              "iDisplayLength": 5,
              "order": [[ 5, "desc" ]],
             "serverSide": true,
             "ajax" : {
                "url" : "{{ route('dashboard_get_liste_patient') }}",
                "dataType" : "json",
                "type" : "POST",
                 beforeSend: function(){
            
                 $('.blockMeP').block({ 
                    message: '<h3>Chargement.....</h3>', 
                    css: { border: '3px solid #a00' } 
                }); 
            },
            complete: function(){
                $('.blockMeP').unblock();
            }
             },
             "columns" : [
                  {"data" : "nom_patient"},
                  {"data" : "matricule"},
                  {"data" : "date_naissance"},
                  {"data" : "sexe"},
                  {"data" : "telephone"},
                  {"data" : "created_at"},
                  {"data" : "name"}
             ]
        });
             $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    var cpt = 0;
   
     $('#tableId').on('dblclick', 'tr', function(event) {
         if(this.cells[0].innerHTML != "Noms et Prenoms"){
            
            var gg =  $(this).find('a').data('info').split(',');
           
            var res = gg[0];

             $('.did_sexe').text(this.cells[3].innerHTML);             
            $('.did_patient').text(res);
            $('.did_nomP').text(gg[2]);
            $("#infosPatient").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
            });
            
        }
     });
      $('#infosPatient').on('hidden.bs.modal',function(){
             cpt = 0;
            $('#tab_dossier').dataTable().fnClearTable();
            $('#tab_HR').dataTable().fnClearTable();
            
         });
     $('#editPatient').on('hidden.bs.modal',function(){
           
          $('.actionBtnP').removeAttr("disabled");
     });
     
     $(document).on('click', '.edit-modalP', function() {
       
            $('#footer_action_buttonP').text(" Update");
            $('#footer_action_buttonP').addClass('glyphicon-check');
            $('#footer_action_buttonP').removeClass('glyphicon-trash');
            $('#footer_action_buttonP').removeClass('glyphicon-plus');
            $('.actionBtnP').addClass('btn-success');
            $('.actionBtnP').removeClass('btn-danger');
            $('.actionBtnP').removeClass('btn-primary');
            $('.actionBtnP').removeClass('delete');
            $('.actionBtnP').removeClass('ajout');
            $('.actionBtnP').addClass('edit');
            $('.modal-titleP').text("Modifier les informations du Patient ");
            $('.deleteContentP').hide();
            $('.form-horizontal').show();
            var details = $(this).data('info').split(',');

             $("#form_patient #profession").find("option").remove();

             $('#profession').append($('<option>',
                 {
                    value: '',
                    text : "--- Choisissez la profession ---",
                    selected:true
                }));
                
             for(var i=0;i < tab_pro.length;i++){
                  
                    $('#form_patient #profession').append($('<option>',
                    {
                        value: tab_pro[i].id,
                        text : tab_pro[i].libelle_profession
                    }));
              }

            $('#form_patient #id_patient').val(details[0]);
        
        $('#form_patient #mat').val(details[1]);
        $('#form_patient #name').val(details[2]);
        
        $('#form_patient #date_naiss').val(details[3]);
        $('#form_patient #adresse').val(details[4]);
        $('#form_patient #tel').val(details[5]);
        $('#form_patient #fax').val(details[6]);
        $('#form_patient #cni').val(details[7]);
        $('#form_patient #email').val(details[8]);
        if (details[9]== 'Feminin'){
              $('#form_patient #SF').prop("checked",true);
        }else{
              $('#form_patient #SM').prop("checked",true);
        }
        $('#form_patient #profession').val(details[10]);
       
            $("#editPatient").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
        $(document).on('click', '#addP', function() {
            $('#footer_action_buttonP').text(" Ajout");
            $('#footer_action_buttonP').addClass('glyphicon-plus');
            $('#footer_action_buttonP').removeClass('glyphicon-trash');
            $('#footer_action_buttonP').removeClass('glyphicon-check');
            $('.actionBtnP').addClass('btn-primary');
            $('.actionBtnP').removeClass('btn-danger');
            $('.actionBtnP').removeClass('btn-success');
            $('.actionBtnP').removeClass('delete');
            $('.actionBtnP').removeClass('edit');
            $('.actionBtnP').addClass('ajout');
            $('.modal-titleP').text('Ajouter un nouveau Patient');
            $('.deleteContentP').hide();
            $('.form-horizontal').show();
             $("#form_patient #profession").find("option").remove();

             $('#profession').append($('<option>',
                 {
                    value: '',
                    text : "--- Choisissez la profession ---",
                    selected:true
                }));
                
             for(var i=0;i < tab_pro.length;i++){
                  
                    $('#form_patient #profession').append($('<option>',
                    {
                        value: tab_pro[i].id,
                        text : tab_pro[i].libelle_profession
                    }));
              }
            $("#editPatient").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
         
            $('.mdCP').click(function(){
            $("#editPatient :input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
            $("input[name=sexe]").removeAttr("checked");
            $(".validation-error").html(""); 
              $("input").css("border","");
            $("#editPatient").modal("hide");
            });
          
     
    
  $('#footerP').on('click', '.ajout', function() {
 
    if(validate1()){
      if( $("input[name=sexe]").is(':checked') ){ 
        $(".errorP").addClass("hidden");
        $(this).attr("disabled","disabled");
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_patient')}}",
            data: $('#form_patient').serialize()

            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              $("input[name=sexe]").removeAttr("checked");
                              $("#editPatient").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                               $("input[name=sexe]").removeAttr("checked");
                             $("#editPatient").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              tableD.search( '' ).columns().search( '' ).draw();
                           
                       }

                        
            });
          }else{
              $(".errorP").removeClass("hidden");
          }
        }
       });
    
     $('#footerP').on('click', '.edit', function() {
     if(validate1()){
      if( $("input[name=sexe]").is(':checked') ){ 
        $(".errorP").addClass("hidden");
         $(this).attr("disabled","disabled");
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_patient')}}",
            data: $('#form_patient').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              $("input[name=sexe]").removeAttr("checked");
                              $("#editPatient").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              $("input[name=sexe]").removeAttr("checked");
                              $("#editPatient").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             tableD.search( '' ).columns().search( '' ).draw();
                        }
                            
                           
                        
            });
            }else{
                 $(".errorP").removeClass("hidden");
            }
          }
       });
@endsection