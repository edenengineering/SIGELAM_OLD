@extends("dashboard")

@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
 function validate() {
    
    var valid = true;
    valid = checkEmpty($("#old_pass"));
    valid = valid && checkEmpty($("#new_pass"));
    valid = valid && checkEmpty($("#Cnew_pass"));
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

    <legend>Modification du mot de passe</legend>      
     <form  id="form-pass" class="form-horizontal" >
                 
                  <div class="row">
                      <div class="form-group">
                      <label for="libelle_antifongique" class="control-label col-sm-4">Ancien mot de passe (*):&nbsp;<br /><span class="old_pass-validation validation-error"></span></label>
                      <div class="col-sm-7">
                        <input  class="form-control " name="old_pass" id="old_pass" type="password" />  
                      </div>
                      
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group">
                      <label for="libelle_antifongique" class="control-label col-sm-4">Nouveau mot de passe (*):&nbsp;<br /><span class="new_pass-validation validation-error"></span></label>
                      <div class="col-sm-7">
                        <input  class="form-control " name="new_pass" id="new_pass" type="password" />  
                      </div>
                      
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group">
                      <label for="libelle_antifongique" class="control-label col-sm-4">Confirmation mot de passe (*):&nbsp;<br /><span class="Cnew_pass-validation validation-error"></span></label>
                      <div class="col-sm-7">
                        <input  class="form-control " name="Cnew_pass" id="Cnew_pass" type="password" />  
                      </div>
                      
                      </div>
                  </div>
                  <input type="hidden" name="id_user" id="id_user" value="{{Auth::user()->id}}">
                  <div class="form-group" style="margin-bottom:10px;">
                    <label style="color:red;font-size:1.4em" class="erreur hidden control-label col-sm-10 text-left"></label>
                    
                  </div>
                </form>
                  <div class="row" style="margin-bottom:15px; margin-top:15px;">
                     <button class="btn btn-primary col-sm-2 col-sm-offset-4"  id="modP"><i class="glyphicon glyphicon-edit" ></i> Modifier</button>
                  </div>
</div>
@endsection
@section('another')
  
  $("#modP").click(function(){
      if(validate()){
          if( $("#new_pass").val() == $("#Cnew_pass").val() ){
              $(".erreur").addClass("hidden");
              $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_edit_pass')}}",
            data: {
                'id_user': $("#id_user").val(),
                  'old_pass' : $("#old_pass").val(),
                  'nouveau_pass' : $("#new_pass").val()
            },
            })
            .done(function(msg){
                              if(typeof msg['erreur'] !== 'undefined'){
                                   $(":input:not('[name=id_user],[type=checkbox],[type=radio]')").val('');
                                    
                                
                                  
                                    
                                    var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                                     
                              }else if(typeof msg['success'] !== 'undefined'){
                                     $(":input:not('[name=id_user],[type=checkbox],[type=radio]')").val('');
                                    
                                  
                                       $(".ajs-message.ajs-success").css("background-color", "gold");
                                    $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                                    $(".ajs-message.ajs-success").css("font-weight", "bold");
                                    alertify.set('notifier','position', 'top-right');
                                    alertify.success(msg['success']);
                             }

                              
                  });
          }else{
              $(".erreur").removeClass("hidden");
              $(".erreur").text("Erreur sur la confirmation du mot de passe");
          }
      }
  });
@endsection