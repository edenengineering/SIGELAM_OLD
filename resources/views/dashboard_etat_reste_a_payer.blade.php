@extends("dashboard")

@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
        
</script>
<div class="tab-content">
   <div class="row" style="margin-bottom:15px; margin-top:15px;">
          
      <div class="form-group">
          <label class="col-sm-1 control-label" >Exercice</label>
          <div class="col-sm-2">
              <input class="form-control" type="number" min="1960" id="exercice">
          </div>
          <label class="col-sm-1 control-label" >Mois </label>
          <div class="col-sm-2">
              <select id="mois" class="form-control">
                <option value="janvier">Janvier</option>
                <option value="fevrier">Fevrier</option>
                <option value="mars">Mars</option>
                <option value="avril">Avril</option>
                <option value="mai">Mai</option>
                <option value="juin">Juin</option>
                <option value="juillet">Juiller</option>
                <option value="aout">Août</option>
                <option value="septembre">Septembre</option>
                <option value="octobre">Octobre</option>
                <option value="novembre">Novembre</option>
                <option value="decembre">Decembre</option>
              </select>
          </div>
          <div class="col-sm-1">
                <button style="margin-right:5px" id="" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> OK</button>   
            </div>
      </div>
              
            
            
           
    </div>
  <table id="tabRP" style="width:100%; heigth:60%" class="table table-striped table-responsive">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE RESTE A PAYER</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              <th class="text-left">N° Dossier</th>
              <th class="text-left">Date</th>
              <th class="text-left">Retrait</th>
              <th class="text-left">Patient</th>
              <th class="text-left">Sexe</th>
              <th class="text-left">Téléphone</th>
              <th class="text-left">Total</th>
              <th class="text-left">Avance</th>
              <th class="text-left">Reste</th>
              <th class="text-left">Prescripteur</th>
            </tr>
          </thead>
          <tr id="15">
              <td>1233 </td>
              <td>DOUMBE</td>
              <td>14/12/2015</td>
              <td>KANKAN</td>
              <td>14/12/2015</td>
              <td>KANKAN</td>
              <td>1233 </td>
              <td>DOUMBE</td>
              <td>14/12/2015</td>
              <td>KANKAN</td>
             
            </tr>
            
        </table>  
  
     
</div>

@endsection
@section('another')
$('#tabRP').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 10
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
   

@endsection