@extends("default")

@section('style_sidebar')
  <style type="text/css">
@font-face {
font-family: BrushScriptStd;
src: url('{{ URL::asset('fonts/BrushScriptStd.otf') }}');
}
</style>

@endsection


@section('Slider')
  
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
  var result = {!! json_encode($result) !!};
       
    
</script>
  <div class="container-fluid">
  <div class="container" style="margin:40px;">
      <div id="div1" >
          <div class="row" style=" height:150px; padding-bottom:0; border-bottom: 2px solid black">
            

              <div class="col-sm-2" style="font-family:BrushScriptStd;text-align:center;line-height: 0;">
                        <h6>
                          <p> <span style="font-size:50px">CASS</span><br>Reussir Ensemble</p>
                        </h6>
                </div>
              <div class="col-sm-7 text-left" style="padding-top:0  ">
                   <h2 class="text-center" style="text-decoration:underline">CAHIER DE PAILLASSE</h2>
                  <h4 class="text-center">Du {{$date_debut}} Au {{$date_fin}}</h4>
                
              </div>
              <div class="col-sm-2"style="width:150px; padding-left:30px; padding-top:5px">
                   <img src="{{ URL::asset('Slider/LBD.jpg') }}" style="height:100px;" class="img-responsive" alt="Logo Gelam">
              </div>
            
          </div>
          <div class="row">
            <div class="col-sm-2 col-sm-offset-8">
                <p class="text-right">Le, {{$date_jour}}</p>
            </div>
              
          </div>
      </div>
      <div id="zone">  
      
      
      </div>
      <div class="row" style="margin-top:100px; position: fixed;
    bottom: 0;
    width: 100%;">
            <div class="col-sm-6">
                <p class="text-left">Cahier de paillasse Du {{$date_debut}} AU {{$date_fin}}</p>
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
     document.addEventListener("DOMContentLoaded", function() {


                  function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 
                  function ispresent(elt,arr){
                      var trouve = true;
                      for(var i = 0; i < arr.length;i++){
                        if(arr[i] == elt){
                          trouve = false;
                        }
                      }
                      return trouve;
                  }
                  $("#zone").append("<h3>"+ result[0].libelle_type_examen  +" - " + result[0].libelle_groupe_examen + "</h3>");
                  
                  var te = [];
                  for(var i=0; i < result.length; i++){
                     if(ispresent(result[i].libelle_examen, te)){
                          var te_c = result[i].libelle_examen;
                           $("#zone").append("<h4>"+ result[i].libelle_examen +"</h4>"+
                                         "<div class='table-responsive'> " +
                                         "<table class='table table-bordered' style='font-size:1.1em'> " +
                                            "<thead> " +
                                             " <tr> " +
                                               " <th>N°</th> " +
                                                "<th>Nom(s) et Prénom(s)</th> " +
                                                "<th>Résultats</th> " +
                                             " </tr> " +
                                            "</thead> " +
                                            "<tbody id='item"+ result[i].id_examen + "'>" +
                                            "</tbody>");
                            var c=1;
                          for(var j=0; j < result.length;j++){
                            if(result[j].libelle_examen == te_c){
                                str = result[j].date_dossier.split(" ");
                                $("#item"+ result[i].id_examen).append("<tr> " +
                                  "    <td>"+ c + "</td> " +
                                   "   <td>"+  result[j].nom_patient + "<br />Dossier N° " + pad(result[j].id_dossier,6) + "<br />Du " + str[0] + "</td> " +
                                    "  <td></td> " +
                                    "</tr>");
                                        c++;
                              }
                          }
                         te.push(result[i].libelle_examen);
                    }
                    
                   }
    });
        
    </script>
@endsection