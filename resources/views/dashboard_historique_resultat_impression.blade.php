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
                   <h2 class="text-center" style="text-decoration:underline">LABORATOIRE BIO-DIAGNOSTICA</h2>
                  <h4 class="text-center" style="font-weight:bold">Enr. Sous Le N° 0060/ADD/MSP/DRSPC/SSDD </h4>
                  <h4 class="text-center" style="font-style:italic">PARASITOLOGIE - HEMATOLOGIE - BIOCHIMIE - BACTERIOLOGIE - IMMUNOLOGIE - CYTOLOGIE - MARQUEURS TUMORAUX - HORMONOLOGIE</h4>
                  <h5 class="text-center">BP 11954 Yaoundé-Cameroun Téléphone : (+237) 222 232 524 / 242 068 005 Fax: +(+237) 222 232 524</h5>
                  <h5 class="text-center"> Email: biodiagnostica2010@yahoo.com</h5>
                  <h5 class="text-center" style="font-weight:bold;color:red">Carrefour de l'Intendance; Immeuble Commissariat Erri - Immigration (1er Etage) </h5>
              </div>
              <div class="col-sm-2 text-left" style="width:150px; padding-left:30px; padding-top:5px">
                   <img src="{{ URL::asset('Slider/LBD.jpg') }}" style="height:100px;" class="img-responsive" alt="Logo Gelam">
              </div>
            
          </div>
          <div class="row">
            <div class="col-sm-3 ">
                <h5>Examen(s) demandé(s) par :</h5>

            </div>
            <div class="col-sm-6 col-sm-offset-3" style="border: 2px solid black">
                <p class="dnm_patient" style="font-weight:bold;font-size:1.5em">6546</p>
                <div class="col-sm-6">
                  <p>Âge : <span class="dage"></span> an(s)</p>
                  <p>Enregistré(e) le: <span class="ddate_dossier">24/05/2017</span></p>
                  <p>Edité le <span class="ddate_edition">30/05/2017</span></p>
                </div>
                <div class="col-sm-6">
                  <p>Sexe : <span class="dsexe">M</span></p>
                  <p>Prélevé(e) le: <span class="ddate_preleve">24/06/2017</span></p>
                  <p>Téléphone: <span class="dtelephone"></span></p>
                </div>
                <p style="font-weight:bold;font-size:1.5em">Dossier N° <span class="dnm_patient" ></span></p>
            </div>
          </div>
      
    <div class="container" style="height:600px;margin-top:50px">
      
    
      <div class="table-responsive">
          <table class="table table-condensed" style="font-size:1.2em">
            <thead>
              <tr>
                <th colspan="2"></th>
                <th>Résultats</th>
                <th>Norme</th>
                <th>Unités</th>
                <th>Historique</th>
              </tr>
              <tr>
                <th colspan="6" class="dnom_examen text-center">EXAMEN SEROLOGIQUE</th>
              </tr>
              <tr>
                <th colspan="2" class="text-left">DIVERS</th>
              </tr>
              <tr>
                <th colspan="2" class="text-left">SEROLOGEIGE TOTALES</th>
              </tr>
              <tr>
                <th colspan="2">Technique (ECLIA) OBAS </th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>Testosterone</td>
                  <td></td>
                  <td>4,3</td>
                  <td></td>
                  <td>ng/ml</td>
                  <td></td>
                </tr>
            </tbody>

          </table>

      </div>
      <div  class="row">
          <h4>INTERPRETATION</h4>
          <p></p>
          <p></p>
          <p></p>
      </div>
  </div>
      <div class="row" style="margin-top:100px; position: ;bottom: 0;width: 100%;">
        <div class="row" style="border-bottom: 2px solid green">
           <h6 class="text-center">Conformément aux texte en vigueur, votre echantillons pourra être éliminé et/ou transféré à des fins scientifiques ou des contrôles de qualité, hors génétique humaine, de manière anonyme et respectant le secret medical, sauf opposition formulée auprès de notre secretariat médical</h6>
        </div> 
        <div class="row">
            <div class="col-sm-4">
              
            </div>
            <div class="col-sm-4" style="margin-top:20px">
                <div class="row">
                    <h4 class="text-center" style="text-decoration:underline">Le Directeur Technique</h4>
                </div>
                <div class="row text-center">
                    <img src="" alt="signature">
                </div>
                <div class="row">
                    <p class="text-center" style="font-weight:bold">Dr Faustin NOMBIKAKA</p>
                    <p class="text-center">Medecin-biologiste</p>
                </div>
            </div>
            <div class="col-sm-4 text-right">
                <div style="margin-top:50px"  class="row">
                  1
                </div>
                <div style="margin-top:35px" class="row">
                  <p><span class="did_patient">616639</span> Dossier N°<span class="did_dossier">04530</span></p>
                </div>
            </div>
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