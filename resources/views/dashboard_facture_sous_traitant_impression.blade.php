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
                   <h1 class="text-center" style="font-family:calibri; font-size:38px; color:rgb(0,109,0)">LABORATOIRE BIO-DIAGNOSTICA</h1>
                  <h4 class="text-center" style="font-weight:bold">Enr. Sous Le N° 0060/ADD/MSP/DRSPC/SSDD </h4>
                  <h4 class="text-center" style="font-style:italic">PARASITOLOGIE - HEMATOLOGIE - BIOCHIMIE - BACTERIOLOGIE - IMMUNOLOGIE - CYTOLOGIE - MARQUEURS TUMORAUX - HORMONOLOGIE</h4>
                  <h5 class="text-center">BP 11954 Yaoundé-Cameroun Téléphone : (+237) 222 232 524 / 242 068 005 Fax: +(+237) 222 232 524</h5>
                  <h5 class="text-center"> Email: biodiagnostica2010@yahoo.com</h5>
                  
              </div>
              <div class="col-sm-2 text-left" style="width:150px; padding-left:30px; padding-top:5px">
                   <img src="{{ URL::asset('Slider/LBD.jpg') }}" style="height:100px;" class="img-responsive" alt="Logo Gelam">
              </div>
            
          </div>
      
    <div class="container" style="height:600px;margin-top:50px">
      
      <h3 class="text-center" style="color:blue;text-decoration:underline;font-weight:bold">ETAT FACTURES PARTENAIRES</h3>
      <h3 class="text-center" style="color:red;text-decoration:underline;font-weight:bold" >Periode de <span class="dmois">Janvier</span> <span class="dannee">2017</span></h3>
      
      
      <div class="table">
          <table class="table table-condensed" style="font-size:1.2em">
            <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              
              <th class="text-left">Code</th>
              <th class="text-left">Raison sociale</th>
              <th class="text-left">Nbre</th>
              <th class="text-left">Total</th>
              <th class="text-left">Ticket M.</th>
              <th class="text-left">Montant R.</th>
            </tr>
          </thead>
          <tfoot>
              <th class="text-center" colspan="5" style="color:red;font-size:1.5em">TOTAL</th>
              <th><input type="number" class="form-control" id="Tmontant"> </th>
          </tfoot>
        </table>  

      

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