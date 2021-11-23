@extends("dashboard")

@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
        var tab_pro = {!! $profiles->toJson()  !!};
         var tab_user = {!! $users->toJson()  !!};
        function validate() {
    
    var valid = true;
    valid = checkEmpty($("#nomU"));
    valid = valid && checkEmpty($("#pseudo"));
    valid = valid && checkEmpty($("#MPU"));
    valid = valid && checkEmpty($("#CMPU"));

    valid = valid && checkEmpty($("#profil"));
    valid = valid && checkEmpty($("#telU"));
    valid = valid && checkEmpty($("#adresseU"));
    return valid; 
  }

       function validate1() {
    
    var valid = true;
    valid = checkEmpty($("#nomU"));
    valid = valid && checkEmpty($("#pseudo"));
    valid = valid && checkEmpty($("#profil"));
    valid = valid && checkEmpty($("#telU"));
    valid = valid && checkEmpty($("#adresseU"));
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

                    <div class="row" style="margin-bottom:15px;margin-top:15px">
                      <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addP"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
                     
                    </div>
                    
                    <table id="tableUser" style="width:100%; heigth:60%" class="table table-striped table-responsive">
                    <caption id="cap">
                        <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES UTILISATEURS</h4>
                    </caption>  
                     <!-- rgb(150,150,150)-->
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr  style ="heigth:10px;">
                        <th class="text-left">Noms et Prenoms</th>
                        <th class="text-left">Créé Le</th>
                        <th class="text-left">Sexe</th>
                        <th class="text-left">Téléphone</th>
                        <th class="text-left">Administrateur</th>
                        <th class="text-left">Profil</th>
                         <th class="text-left">Etat</th>
                      </tr>

                    </thead>
                    @foreach($users as $item)
                        <tr id="item{{$item->id}}" style="cursor:pointer">
                            <td class="text-left"><a class="edit-modalP" style="cursor:pointer"
                              data-info="{{$item->id}},{{$item->name}},{{$item->date_naissance}},{{$item->sexe}},{{$item->telephone}},{{$item->adresse}},{{$item->profile}},{{$item->cni}},{{$item->email}},{{$item->fax}},{{$item->pseudo}},{{$item->statut}}">
                              <span class="glyphicon glyphicon-edit"></span> {{$item->name}}
                              </a>
                            </td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->sexe}}</td>
                            <td>{{$item->telephone}}</td>
                            @foreach( $users as $item1)
                              @if($item->id_agent == $item1->id)
                               <td>{{$item1->name}}</td>
                              @endif
                            @endforeach
                            @foreach($profiles as $pro)
                              @if($item->profile == $pro->id)
                              <td>{{$pro->libelle_profile}}</td>
                              @endif
                            @endforeach
                            @if($item->statut == 1)
                              <td>ACTIF</td>
                            @else
                               <td>DESACTIVE</td>
                            @endif
                        </tr>
                    @endforeach
                  </table>
               
        </div>

<div id="editUser" class="modal fade" role="dialog" style="width: 100%">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
        <button type="button"  class="close mdCP" data-dismiss="modal">&times;</button>
        <h2  class="modal-titleP" ></h2>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" id="form_user" role="form" >
            
            
            
          
            
            <input type="hidden" name="id_user" id="id_user">
            <div class="form-group">
              <legend style="padding-left:10px;">Identité de l'utilisateur</legend>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group row" >
                    <label for="name" class="control-label text-left col-sm-5">Noms et Prenoms (*):<br /><span class="name-validation validation-error"></span> </label>
                    <div class="col-sm-7">
                      <div class="input-group">
                         <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" name="name" class="form-control" id="nomU" required>  
                      </div>
                      
                    </div>
                </div>
                <div class="form-group row">
                  <label for="pseudo" class="control-label text-left col-sm-5">Pseudo (*):<br /><span class="pseudo-validation validation-error"></span> </label>
                  <div class=" col-sm-5">
                    
                    <input type="text"  name="pseudo" class="form-control" id="pseudo">
                  </div>
                  <div class="col-sm-2">
                    <button class="btn btn-success" type="button" id="GP" disabled="disabled"><i class="glyphicon glyphicon-refresh"></i></button>
                  </div>
                </div>
                <div class="form-group row ps" >
                  <label for="MPU" class="control-label col-sm-5">Mot de passe (*):<br /><span class="pass-validation validation-error"></span> </label>
                  <div class="col-sm-7">
                    <input type="password"  name="pass" class="form-control" id="MPU">
                  </div>
                </div>
                <div class="form-group row cps">
                  <label for="CMPU" class="control-label col-sm-5">Confirmation (*):<br /><span class="conpass-validation validation-error"></span> </label>
                  <div class="col-sm-7">
                    <input type="password"  name="conpass" class="form-control" id="CMPU">
                  </div>
                </div>
              </div>
              <div class="col-sm-6">

                <div class="form-group row">
                  <label for="date_naissU" class="control-label text-left col-sm-5">Née le (*):<br /><span class="date_naissance-validation validation-error"></span> </label>
                  <div class=" col-sm-7">
                    
                    <input type="date"  name="date_naissance" class="form-control" id="date_naissU" required>
                  </div>
                </div>  
                <div class="form-group row">
                  <label for="" class="control-label col-sm-5">Sexe : </label>
                  <div class="col-sm-7 ">
                    <div class="row">
                      <div class="col-sm-5">
                        <label class="control-label" ><input type="radio" id="SMU" value="Masculin" checked="checked" name="sexe">Masculin</label>
                      </div>
                      <div class="col-sm-5 col-sm-offset-1">
                        <label  class="control-label" ><input type="radio"  id="SFU" value="Feminin" name="sexe">Feminin</label>
                      </div>
                    </div>
                    
          
                    
                  </div>
                </div>
                <div class="form-group row">
                  <label for="cni" class="control-label col-sm-5">CNI N° : </label>
                  <div class="col-sm-7">
                    <input type="text" name="cni" class="form-control" id="cniU">
                  </div>
                </div>
                 <div class="form-group row">
                  <label for="cni" class="control-label col-sm-5">Profil (*):<br /><span class="profile-validation validation-error"></span></label>
                  <div class="col-sm-7">
                    <select  class="form-control" name="profile" id="profil">
                       @foreach($profiles as $item)
                          <option value="{{ $item->id }}" >{{ $item->libelle_profile }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <legend style="padding-left:10px;"><span class="hidden did_user"></span>  Adresse de l'utilisateur</legend>
            </div>
            <div class="row">
              <div class="col-sm-6">
                
                <div class="form-group row">

                    <label for="telU" class="control-label col-sm-5">Telephone (*):<br /><span class="telephone-validation validation-error"></span></label>
                    <div class="input-group col-sm-7">
                         <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                        <!-- pattern="[\+][\(]\d{3}[\)]\d{3}[\-]\d{3}[\-]\d{3}"-->
                        <input type="text"  name="telephone"  class="form-control" id="telU">
                    </div>
                  
                </div>
                
                <div class="form-group row">
                  <label for="adresseU" class="control-label col-sm-5">Adresse (*):<br /><span class="adresse-validation validation-error"></span></label>
                  <div class="input-group col-sm-7" style=" padding:0">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input type="text" style="width:100%;" name="adresse" class="form-control" id="adresseU">
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group row">
                    <label for="fax" class="control-label col-sm-5">FAX : </label>
                    <div class="col-sm-7">
                      <input type="text"  name="fax" class="form-control" id="faxU">
                    </div>
                </div>
                <div class="form group row">
                  <label for="email" class="control-label col-sm-5">Email : </label>
                  <div class="input-group col-sm-7">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input type="email" name="email" class="form-control" id="emailU">
                  </div>
                </div>
              </div>
               <div class="form-group" style="margin-bottom:10px;">
                    <label style="color:red;font-size:1.4em" class="error hidden control-label col-sm-10 text-left">Les mots de passe ne correspondent pas</label>
                    
                </div>
             
            </div>
             
          </form>
          <div class="deleteContentP">
            <h3 class="text-center">Voulez-vous vraiment desactiver les utilisateurs sélectionnés ? <span
              class="hidden didP"></span></h3>
      </div>
          
      </div>
      <div class="modal-footer row" id="footerP">
        <div class="form-group hidden col-sm-2 col-sm-offset-1" id="HC">
              <button class="btn btn-primary " type="button"  id="btnHC">Historique Compte</button>
        </div>
        <button type="button" class="btn actionBtnP" >
        <span id="footer_action_buttonP" class='glyphicon'> </span>
      </button>
      <button type="button" class="btn btn-warning mdCP" style="margin-rigth:5px">
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
    <h3>Vous devez cocher au moins un utilisateur !!</h3>
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
    <h3>Voulez-vous vraiment <span class="operation"></span> cet utilisateur ? <span class="did_userA hidden"></span></h3>
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
<div id="modHC" class="modal fade" role="dialog" >
 <div class="modal-dialog md-lg" style="width:80%" >
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcHC">&times;</button>
    <h3 class="modal-title">HISTORIQUE DU COMPTE  </h3>
  </div>
  <div class="modal-body">
     
                    <table id="tabHC" style="width:100%; margin-top:30px; heigth:60%" class="table table-striped table-responsive blockMeHC">  

                     <!-- rgb(150,150,150)-->
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr  style ="heigth:10px;">
                        <th class="text-left">Nom de l'agent</th>
                        <th class="text-left">Date</th>
                        <th class="text-left">Action</th>
                      </tr>
                    </thead>

                  </table>
      
  </div>
  <div class="modal-footer" >
    <button type="button" class="btn btn-warning mdcHC">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
@endsection


@section('another')

       $('#tableUser').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                "aaSorting": [],
                 "columnDefs": [
                { className: "align-left","targets": [0,1,2,3,4,5,6]}
              ]
            });
       $('#tabHC').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                "aaSorting": []
            });
             $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
      $('div.dataTables_filter input').focus();
      $('#checkallC').change(function(){
          $('.checkitemC').prop("checked",$(this).prop("checked"))
           $('.checkitemC').each(function(){
            if($(this).prop("checked")){
           
              countC++;
            }
           });

          
         });
    
      $('#tableUser').on('dblclick', 'tr', function(event){

         if(this.cells[0].innerHTML != "Noms et Prenoms"){
           var gg =  $(this).find('a').data('info').split(',');
           
            var str = $(this).attr('id');
            
            var res = str.substring(4);
            $('.did_userA').text(res);
            if(this.cells[6].innerHTML == "ACTIF"){
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
     $(document).on('click', '.edit-modalP', function() {
            $("#HC").removeClass("hidden");
            $('#footer_action_buttonP').text(" Update");
            $('#footer_action_buttonP').addClass('glyphicon-check');
            $('#footer_action_buttonP').removeClass('glyphicon-trash');
            $('#footer_action_buttonP').removeClass('glyphicon-plus');
            $('.actionBtnP').addClass('btn-success');
            $('.actionBtnP').removeClass('btn-danger');
            $('.actionBtnP').removeClass('btn-primary');
            $('.actionBtnP').removeClass('desactiver');
            $('.actionBtnP').removeClass('ajout');
            $('.actionBtnP').addClass('edit');
           
            $('.deleteContentP').hide();
            $('.form-horizontal').show();
            var details = $(this).data('info').split(',');
//data-info="{{$item->id}},{{$item->name}},{{$item->date_naissance}},{{$item->sexe}},{{$item->telephone}},{{$item->adresse}},{{$item->profile}},{{$item->cni}},{{$item->email}},{{$item->fax}}">
             $('.modal-titleP').text("Modifier les informations de l'utilisateur " + details[1]);
             
            if(details[11] == 0){
                  $('.actionBtnP').addClass('hidden');
            }else{
                $('.actionBtnP').removeClass('hidden');
            }
            $('#form_user #id_user').val(details[0]);
            $(".did_user").text(details[0]);
        $('#form_user #nomU').val(details[1]);
       
        $('#form_user #date_naissU').val(details[2]);
        $('#form_user #adresseU').val(details[5]);
        $('#form_user #telU').val(details[4]);
        $('#form_user #profil').val(details[6]);
        $('#form_user #faxU').val(details[9]);
         $('#form_user #pseudo').val(details[10]);
        $('#form_user #cniU').val(details[7]);
        $('#form_user #emailU').val(details[8]);
        if (details[3]== 'Feminin'){
              $('#form_user #SFU').prop("checked",true);
        }else{
              $('#form_user #SMU').prop("checked",true);
        }
              $(".ps").addClass("hidden");
              $(".cps").addClass("hidden");
            $("#editUser").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
        $(document).on('click', '#addP', function() {
           $("#HC").addClass("hidden");
            $('#footer_action_buttonP').text(" Ajout");
            $('#footer_action_buttonP').addClass('glyphicon-plus');
            $('#footer_action_buttonP').removeClass('glyphicon-trash');
            $('#footer_action_buttonP').removeClass('glyphicon-check');
            $('.actionBtnP').addClass('btn-primary');
            $('.actionBtnP').removeClass('btn-danger');
            $('.actionBtnP').removeClass('btn-success');
            $('.actionBtnP').removeClass('desactiver');
            $('.actionBtnP').removeClass('edit');
            $('.actionBtnP').addClass('ajout');
            $('.modal-titleP').text('Ajouter un nouvel utilisateur');
            $('.deleteContentP').hide();
            $('.form-horizontal').show();

            $(".ps").removeClass("hidden");
              $(".cps").removeClass("hidden");
            $("#editUser").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
         
            $('.mdCP').click(function(){
            $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
            $("#editUser").modal("hide");
            });

            $('.mdcA').click(function(){
              $("#AlerPre").modal("hide");
            }); 
           $('.mdcAc').click(function(){
              $("#modActi").modal("hide");
            });

            $('.mdcHC').click(function(){
              $("#modHC").modal("hide");
            });
     $("#btnHC").click(function(){

             $("#modHC").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });

     });

     $("#nomU").on("input",function(){
          if( $("#nomU").val() != "" ){
                $("#GP").removeAttr("disabled");
          }else{
                $("#GP").attr("disabled",true);
          }
     })

     $("#GP").click(function(){
           $.ajax({
                        url: "{{ route('dashboard_generer_pseudo') }}",
                        data: {
                            'nom' : $("#nomU").val()
                        },
                        dataType: "json"
                    })
                    .done(function(msg){

                               var nv = msg['nouveau'];
                               $("#pseudo").val( nv );
                                $("#MPU").val( nv );
                                $("#CMPU").val( nv );

                        });

     });
     $('#modHC').on('shown.bs.modal', function () {
            $.ajax({
                                url: "{{route('dashboard_historique_utilisateur')}}",
                                data: {
                                    'id_user' : $(".did_user").text()
                                },
                                dataType: "json",
                                beforeSend: function(){
                                 $('.blockMeHC').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                                },
                                complete: function(){
                                    $('.blockMeHC').unblock();
                                }
                            })
                            .done(function(msg){
                                $('#tabHC').dataTable().fnClearTable();
                                var tab = JSON.parse(msg['historique']);
                                
                                for(i=0;i < tab.length;i++){
                                
                                var data = [
                                        tab[i].nom_agent,
                                        tab[i].date,
                                        tab[i].evenement,
                                        
                                        ];
                                var rowIndex = $('#tabHC').dataTable().fnAddData(data);
                                var row = $('#tabHC').dataTable().fnGetNodes(rowIndex);
                                $(row).attr( 'id','item' + tab[i].id); 
                                var tr = $("#tabHC tr#item"+tab[i].id);
                                tr.find('td:eq(0)').addClass('text-left');
                                tr.find('td:eq(1)').addClass('text-left');
                                tr.find('td:eq(2)').addClass('text-left');
                                
                                               
                              }
                            
                                
                            });     
     });
    

     $('#editUser').on('hidden.bs.modal', function () {
                $(".actionBtnP").removeAttr("disabled");
       });

  $('#footerP').on('click', '.ajout', function() {
  if(validate()){
   if( $("#MPU").val() == $("#CMPU").val() ){
      $(this).attr("disabled","disabled");
      $(".error").addClass("hidden");

        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_utilisateurs')}}",
            data: $('#form_user').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#editUser").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#editUser").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                           
                             var user = "";
                             var pro = "";
                              for(var i=0; i < tab_user.length;i++ ){
                                  if(nv.id_agent == tab_user[i].id){
                                      user = tab_user[i].name;
                                  }
                              }
                              for(var k=0; k < tab_pro.length;k++ ){
                                  if(nv.profile == tab_pro[k].id){
                                      pro = tab_pro[k].libelle_profile;
                                  }
                              }
                              var etat="";
                            
                             if(nv.statut == 1){
                               var etat = "ACTIF";
                            }else{
                              var etat= "DESACTIVE";
                            }
                              var data = [
                               "<a class=\'edit-modalP\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.name + "," + nv.date_naissance + "," + nv.sexe + "," + nv.telephone + "," + nv.adresse + "," + nv.profile + "," + nv.cni + "," + nv.email + "," + nv.fax + "," + nv.pseudo + "," + nv.statut + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.name + "</a>",
                                nv.created_at,
                                nv.sexe,
                                nv.telephone,
                                user,
                                pro,
                                etat
                              ];
                              var rowIndex = $('#tableUser').dataTable().fnAddData(data);
                              var row = $('#tableUser').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tableUser tr#item"+nv.id);
                              tr.css("cursor","pointer")
                              tr.find('td:eq(0)').addClass('text-left');
                              tr.find('td:eq(1)').addClass('text-left');
                              tr.find('td:eq(2)').addClass('text-left');
                              tr.find('td:eq(3)').addClass('text-left');
                              tr.find('td:eq(4)').addClass('text-left');
                              tr.find('td:eq(5)').addClass('text-left');
                              tr.find('td:eq(6)').addClass('text-left');

                               var my_array = $('#tableUser').dataTable().fnGetNodes( );
                               var last_element = my_array[my_array.length - 1];
                              
                              $(last_element).insertBefore($('#tableUser tbody tr:first-child'));
                       }

                        
            });
          }else{
              $(".error").removeClass("hidden");
              $("#MPU").val("");
              $("#CMPU").val("");
              $("#MPU").focus();
          }
        }
       });
    
     $('#footerP').on('click', '.edit', function() {
      if(validate1()){
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_utilisateurs')}}",
            data: $('#form_user').serialize(),
            })
      
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#editUser").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#editUser").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            
                            nv = JSON.parse(msg['nouveau']);
                              var user = "";
                              var pro="";
                              for(var i=0; i < tab_user.length;i++ ){
                                  if(nv.id_agent == tab_user[i].id){
                                      user = tab_user[i].name;
                                  }
                              }
                               for(var k=0; k < tab_pro.length;k++ ){
                                  if(nv.profile == tab_pro[k].id){
                                      pro = tab_pro[k].libelle_profile;
                                  }
                              }
                            var etat="";
                            if(nv.statut == 1){
                               var etat = "ACTIF";
                            }else{
                              var etat= "DESACTIVE"
                            }

                            var tr = $("#tableUser tr#item"+nv.id);
            
                        tr.find('td:eq(0)').html(  "<a class=\'edit-modalP\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.name + "," + nv.date_naissance + "," + nv.sexe + "," + nv.telephone + "," + nv.adresse + "," + nv.profile + "," + nv.cni + "," + nv.email + "," + nv.fax + "," + nv.pseudo + "," + nv.statut + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.name + "</a>");
                        tr.find('td:eq(1)').html(""+ nv.created_at);
                        tr.find('td:eq(2)').html(""+ nv.sexe);
                        tr.find('td:eq(3)').html(""+ nv.telephone);
                        tr.find('td:eq(4)').html(""+ user);
                        tr.find('td:eq(5)').html(""+ nv.lprofile);
                        tr.find('td:eq(6)').html(""+ etat);
                       // $('#tableUser').DataTable().rows( tr ).invalidate().draw();
                        
            });
            }
       });

        $("#btnAct").click(function(){
             $.ajax({
              type: 'post',
              url: "{{route('dashboard_utilisateurs_delete')}}",
              data: {
                  'id_user': $('.did_userA').text()
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
                         nv = JSON.parse(msg['user']);
                        
                          var tr = $("#tableUser tr#item"+nv.id);
                          tr.find('td:eq(0)').html(  "<a class=\'edit-modalP\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.name + "," + nv.date_naissance + "," + nv.sexe + "," + nv.telephone + "," + nv.adresse + "," + nv.profile + "," + nv.cni + "," + nv.email + "," + nv.fax + "," + nv.pseudo + "," + nv.statut + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.name + "</a>");
                          if(nv.statut == 1 ){
                            tr.find('td:eq(6)').html("ACTIF");
                          }else{
                            tr.find('td:eq(6)').html("DESACTIVE");
                          }
                          
                         
                       
                        
            });

        });
@endsection