@extends("default")

@section('en-tete')
     
@endsection

@section('Slider')
	
      
  <div class="container-fluid">
  <div class="container" style="margin:40px;">
      
          <div class="row" style="padding-bottom:0; margin-bottom:20px; border-bottom: 2px solid green">
            

              <div class="col-sm-2 text-right" style="width:150px; padding-left:30px; padding-top:5px">
                   <img src="{{ URL::asset('Slider/LBD.jpg') }}" style="height:100px;" class="img-responsive" alt="Logo Gelam">
              </div>
              <div class="col-sm-8 text-left" style="padding-top:0  ">
                   <h2 class="text-center" style="text-decoration:underline">ETAT DE LA CAISSE</h2>
                  <h4 class="text-center" style="font-weight:bold">Du <span class="ddate_debut">28/10/2017</span> Au <span class="ddate_fin">31/10/2017</span></h4>
              </div>
              <div class="col-sm-2 text-left" style="width:150px; padding-left:30px; padding-top:5px">
                   <img src="{{ URL::asset('Slider/LBD.jpg') }}" style="height:100px;" class="img-responsive" alt="Logo Gelam">
              </div>
            
          </div>
          <div class="row">
            <p class="text-right">Yaoundé le, <span class="ddate_jour">26/10/2017</span></p>
          </div>
      
    <div class="container" style="height:600px;margin-top:50px">
      
      <h3 class="text-center" style="text-decoration:underline">RECAPITULATIF</h3>
      
      <div class="table">
          <table class="table table-striped" style="font-size:1.2em">
            <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              <th class="text-left"></th>
              <th class="text-left">Total</th>
              <th class="text-left">Cash</th>
              
              
          </thead>
          <tbody>
            <tr>
              <td>EN CAISSE</td>
              <td>0</td>
              <td>0</td>
              
            </tr>
            <tr>
              <TD>ASSURANCES ET AVOIRS</TD>
              <td></td>
              <td></td>
              
            </tr>
            <tr>
              <TD>CAISSE</TD>
              <td></td>
              <td></td>
              
            </tr>

          </tbody>
            
        </table>  

      

      </div>
      <div class="row">
          <h4>Arrête la présente caisse à la somme cash de : <span style="color:red;font-size:1.6em" class="dmontant_cash">0</span> <span style="color:red;font-size:1.6em">F CFA</span></h4>
      </div>
  </div>
      
  </div>
</div>     
@endsection

@section('style_footer')
  class="hidden"
@endsection
@section('sc')
	 <script type="text/javascript">
	 
        
    </script>
@endsection