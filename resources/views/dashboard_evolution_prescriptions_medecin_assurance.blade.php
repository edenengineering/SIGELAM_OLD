@extends("dashboard")

@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
        
</script>
<div class="tab-content">
   <div class="row" style="margin-bottom:15px; margin-top:15px;">
           
             
      <div class="form-group">
          <label class="col-sm-1 control-label" >Année</label>
          <div class="col-sm-2">
              <input class="form-control" type="number" id="annee">
          </div>
         
          <div class="col-sm-1">
                <button style="margin-right:5px" id="" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> OK</button>   
          </div>
          <!-- <div class="col-sm-1">
                <button style="margin-right:5px" id="btnPrint" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Imprimer</button>   
          </div> -->
      </div>
      
            
    </div>
  <table id="tabEPM" style="width:100%; heigth:60%" class="table table-striped table-responsive">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">EVOLUTION PRESCRIPTIONS MEDECINS ASSURANCE</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
                 
              <th class="text-left">Nom(s) et prénom(s)</th>
              <th class="text-left">Mois</th>
              <th class="text-left">Quantité</th>
              <th class="text-left">Montant</th>
              <th class="text-left">Assurance</th>
              <th class="text-left">Prospecteur</th>
              
              
            </tr>
          </thead>
          
            
    </table>  
  
     
</div>

@endsection

@section('another')
$('#tabEPM').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 10
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    
     $('#btnPrint').click(function(){
            
            window.open("{{ route('dashboard_evolution_prescriptions_medecin_assurance_impression') }}");
    });
@endsection