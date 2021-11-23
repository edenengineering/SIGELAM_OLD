@extends("accueil");

@section("scroll")
  
  overflow-y: none;

@endsection
@section('Slider')

<div class="container" id="cont">
 <div class="row" id="cont1" style=" justify-content: center;align-items: center;">
	<form class="form col-lg-4 col-sm-4 col-sm-offset-4 col-lg-offset-4" style="border: 2px solid silver; border-radius:5px; box-shadow: 0px 4px 8px 0 rgba(0,0,0,0.2) " action=" {{ route('login') }}" id="login-form" method="post">
		
		<div class="form-group">
			<legend><h2 class="modal-title" style="color: rgb(103,184,120);">Se Connecter</h2></legend>
		</div>
        <div class="form-group "><label for="user" class="required">Utilisateur :&nbsp;<span class='required-star'></span></label><input  autocomplete="off" class="form-control" name="pseudo" id="user" type="text" /></div>
		    <div class="form-group "><label for="mp" class="required">Mot de passe :&nbsp;<span class='required-star'></span></label><input autocomplete="off"  class="form-control" name="password" id="mp" type="password" /></div>
       	<div class="form-group text-center">
       		<button class="btn  btn-success" type="" name="">Se connecter</button>
       	</div>

		<?php if(isset($erreur)){ ?>
			<div class="alert alert-block alert-danger">

				<h4>Connexion impossible !</h4>
				<?php echo $erreur  ?>
			</div>

		<?php }
		else {
		      }?>

     </form>
  </div>
       <script src="{{ URL::asset('js/jquery.min.js') }}" ></script> 
      <script type="text/javascript">
          document.addEventListener("DOMContentLoaded", function() {
           		$('#user').focus();
               var windowHeight = window.innerHeight;
        var totHeight = $("#div1").height() + $("navbar").height() + $("footer").height(); 
              var divH = $("#cont1").height();
          document.getElementById("cont").style.paddingTop = (windowHeight - totHeight - divH - 20)/3 + "px";
             
        });
          $('.input').keypress(function (e) {
          if (e.which == 13) {
            $("#login-form").submit();
            return false;    
          }
        });
      </script>	
</div>
	 
@endsection

@section('style_footer')
 style=" position: fixed; margin-top:0;bottom: 0;width: 100%;" 
@endsection