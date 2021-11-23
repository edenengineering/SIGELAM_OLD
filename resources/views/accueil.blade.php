
@extends("default")

@section('style_sidebar')
  <style type="text/css">
  #div1{
      background-image: url("{{ URL::asset('Slider/bannierelabo5.jpg') }}");
    background-repeat: no-repeat;
    background-size: cover;
  }

  </style>
  

@endsection
@section('en-tete')
     <div id="div1" >
          <div class="row" style=" height:140px; padding-bottom:0 ">
            

              <div class="col-sm-2 text-right" style="width:150px; padding-left:30px; padding-top:5px">
                   <img src="{{ URL::asset('Slider/LOGO_GELAM.png') }}" style="height:150px;" class="img-responsive" alt="Logo Gelam">
              </div>
              <div class="col-sm-10 text-left" >
                   <h2 class="text-center">SYSTEME INFORMATISÉ DE</h2>
                  <h1><strong>G</strong>ESTION DES <strong>L</strong>ABORATOIRES D'<STRONG>A</STRONG>NALYSES <STRONG>M</STRONG>EDICALES</h1>
                  
                
              </div>

            
          </div>
      </div>
@endsection
@section('menu')
<div id="navbar" style="">    
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="background-color:white;border-color: white;">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="bar">MENU</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
             
                </div>
	 		<div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav" style="float: right; padding-right:10px;">
                        <li id="btnApropos" ><a onmouseover="this.style.background='rgb(103,184,120)';this.style.color='white';" onmouseout="this.style.background='white';this.style.color='rgb(103,184,120)';" style="background-color: white; color:rgb(103,184,120)" href="#">A PROPOS</a></li>
                        <li  ><a onmouseover="this.style.background='rgb(103,184,120)';this.style.color='white';" id="btnAide" onmouseout="this.style.background='white';this.style.color='rgb(103,184,120)';" style="background-color: white; color:rgb(103,184,120)" href="{{ URL::asset('monguidegelam.pdf') }}" target="_blank" >AIDE</a></li>
                        <li  ><a onmouseover="this.style.background='rgb(103,184,120)';this.style.color='white';" onmouseout="this.style.background='white';this.style.color='rgb(103,184,120)';" style="background-color: white; color:rgb(103,184,120)" href="#">CONTACT</a></li>
                        <li  onmouseover="this.style.background='white'"><button type="button" @yield("dis") class="btn btn-success nonhove"  data-backdrop="static" data-keyboard="false" style="margin-top:8px; margin-left :2px;" data-toggle="modal" data-target="#myModal">SE CONNECTER</button></li> 
                        
                        
                     </ul>
        	</div>
        	</nav>
   </div>
   
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    
      <div class="modal-header">
      	
        <button type="button"  id="clear" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title" style="color: rgb(103,184,120);">Se Connecter</h2>
      </div>
      <div class="modal-body">
      <form class="form" action="  {{route('login') }}" id="login-form1" method="post">
         {{ csrf_field() }}
        <div class="form-group "><label for="user" class="required">Utilisateur&nbsp;<span class='required-star'></span></label><input  autocomplete="off" class="form-control" name="pseudo" id="userM" type="text" onkeypress="return show(event)"  /></div>
		    <div class="form-group "><label for="mp" class="required">Mot de passe&nbsp;<span class='required-star'></span></label><input autocomplete="off"  class="form-control" name="password" id="mpM" type="password" onkeypress="return show(event)" required/></div>
       </form>	
      </div>
      <div class="modal-footer">
      	  	
         <button class="btn  btn-success" type="submit" form="login-form" onclick="$('#login-form1').submit();" name="">Se connecter</button>
		 <a class="btn btn-sm" href="#" style="color:rgb(103,184,120)" onmouseover="this.style.background='rgb(103,184,120)';this.style.color='white';" onmouseout="this.style.background='white';this.style.color='rgb(103,184,120)';"><i class="fa fa-question-sign"></i> Mot de passe oublié?</a>
      </div>
      <script type="text/javascript">
          function show (e) {
            if (e.which == 13) {
              $("#login-form1").submit();
              return false;    
            }
          }

      </script>
    </div>

  	</div>
	</div>

	
@endsection
@section('Slider')
	
        <div id="youth-concept-touch-slider" style="height:600px;" class="carousel bs-slider slide  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#youth-concept-touch-slider" data-slide-to="0" class="active"></li>
                <li data-target="#youth-concept-touch-slider" data-slide-to="1"></li>
                <li data-target="#youth-concept-touch-slider" data-slide-to="2"></li>
                 <li data-target="#youth-concept-touch-slider" data-slide-to="3"></li>
                
                
            </ol>

            <!-- Wrapper For Slides -->
            <div class="carousel-inner" role="listbox">

                <!-- First Slide -->
                <div class="item active">

                    <!-- Slide Background -->
                    <img src="Slider/Images/hematologie1.jpg" alt="Youth-Concept Touch Slider"  class="slide-image"/>
                    <div class="bs-slider-overlay"></div>
                    
                    <div class="container">
                    
                        <div class="row">
                            <!-- Slide Text Layer -->
                            <div class="slide-text slide_style_center">
                                <h1>HEMATOLOGIE</h1>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Slide -->

                <!-- Second Slide -->
                <div class="item">

                    <!-- Slide Background -->
                    <img src="Slider/Images/serologi3.jpg" alt="Youth-Concept Touch Slider"  class="slide-image"/>
                    <div class="bs-slider-overlay"></div>
                    <!-- Slide Text Layer -->
                    <div class="slide-text slide_style_center">
                        <h1>SEROLOGIE</h1>
                       
                        
                    </div>
                </div>
                <!-- End of Slide -->

                <!-- Third Slide -->
                <div class="item">

                    <!-- Slide Background -->
                    <img src="Slider/Images/serologie1.jpg" alt="Youth-Concept Touch Slider"  class="slide-image"/>
                    <div class="bs-slider-overlay"></div>
                    <!-- Slide Text Layer -->
                    <div class="slide-text slide_style_center">
                        <h1>BIOCHIMIE</h1>
                        
                        
                    </div>
                </div>

                 <!-- fourth Slide -->
                <div class="item">

                    <!-- Slide Background -->
                    <img src="Slider/Images/serologie4.jpg" alt="Youth-Concept Touch Slider"  class="slide-image"/>
                    <div class="bs-slider-overlay"></div>
                    <!-- Slide Text Layer -->
                    <div class="slide-text slide_style_center">
                        <h1>BACTERIOLOGIE</h1>
                       
                        
                    </div>
                </div>
                
               
                <!-- End of Slide -->


            </div><!-- End of Wrapper For Slides -->

            <!-- Left Control -->
            <a class="left carousel-control" href="#youth-concept-touch-slider" role="button" data-slide="prev">
                <span class="fa fa-angle-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <!-- Right Control -->
            <a class="right carousel-control" href="#youth-concept-touch-slider" role="button" data-slide="next">
                <span class="fa fa-angle-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>

<div id="modal" class="modal fade" role="dialog">
  <div class="modal-dialog" >

    <div class="modal-content">
      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
        <button type="button" class="close mdCCR" data-dismiss="modal">&times;</button>
        <h2  class="modal-title" >Choix Type Resultat</h2>
      </div>
      <div class="modal-body">
           <table id="tableTR" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
              <caption id="cap">
                  <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES ANTIBIOTIQUES</h4>
              </caption>  
              
              <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                <tr  style ="heigth:10px;">
                  <th class="text-center">Libelle Type Resultat</th>
                </tr>
              </thead>
              
          </table> 
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-warning mdCCR">
          <span class='glyphicon glyphicon-remove'></span> Close
        </button> 
      </div>
    </div>

  </div>
</div>
     
@endsection

@section('sc')

	 <script type="text/javascript">
	 	document.addEventListener("DOMContentLoaded", function() {
                    
                    var windowHeight = window.innerHeight;
                    var totHeight = $("#div1").height() + $("navbar").height() + $("#youth-concept-touch-slider").height() + $("footer").height(); 
					
				//document.getElementById("youth-concept-touch-slider").style.marginTop = (windowHeight - totHeight)/4 + "px";
				//	document.getElementById("youth-concept-touch-slider").style.marginBottom = (windowHeight - totHeight)/3+ "px";
        
          @yield("load");
        });
        $(document).ready(function() {
           
	         $("#clear").click(function() {
	            $("#userM").val('');
	            $("#mpM").val('');
	            });
          
            $('#myModal').on('shown.bs.modal', function () {
                $('#userM').focus();
            });
            @yield("AS")
        });
        
    </script>
@endsection