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
          <label class="col-sm-1 control-label" >Mois</label>
          <div class="col-sm-2">
              <select id="mois" class="form-control">
                  <option>Janvier</option>
                  <option>Fevrier</option>
                  <option>Mars</option>
                  <option>Avril</option>
                  <option>Mai</option>
                  <option>Juin</option>
                  <option>Juillet</option>
                  <option>Août</option>
                  <option>Septembre</option>
                  <option>Octobre</option>
                  <option>Novembre</option>
                   <option>Decembre</option>
              </select>
          </div>
           <div class="col-sm-1 col-sm-offset-1">
                <button style="margin-right:5px" id="btnPrint" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Imprimer</button>   
          </div>
        
      </div>
      
            
    </div>
  <table id="tabFA" style="width:100%; heigth:60%" class="table table-striped table-responsive">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">ETAT FACTURE PARTENAIRES</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              
              <th class="text-left">Code</th>
              <th class="text-left">Assureur</th>
              <th class="text-left">Nbre Dossier</th>
              <th class="text-left">Total</th>
              <th class="text-left">Total Perçu</th>
              <th class="text-left">Total Reste</th>
            </tr>
          </thead>
          <tfoot>
              <th class="text-center" colspan="2" style="color:red;font-size:1.5em">TOTAL</th>
              <th><input type="number" class="form-control" id="Tnbre"> </th>
              <th><input type="number" class="form-control" id="Ttotal"> </th>
              <th><input type="number" class="form-control" id="TTP"> </th>
              <th><input type="number" class="form-control" id="TTR"> </th>
          </tfoot>
        </table>  
        
     
</div>

@endsection

@section('another')
  $('#tabFA').DataTable({
        "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
        "iDisplayLength": 5
    });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    
     $('#btnPrint').click(function(){
            
            window.open("{{ route('dashboard_facture_sous_traitant_impression') }}");
    });
@endsection