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
          <label class="col-sm-1 control-label" >Pourcentage</label>
          <div class="col-sm-2">
              <input class="form-control" type="number" id="pourcentage">
          </div>
          <div class="col-sm-1" style="margin-right:5px">
                <button id="btnCalculer" class="btn btn-success"><i class="glyphicon glyphicon-refresh"></i> Calculer</button>   
          </div>
        
      </div>
      
            
    </div>
  <table id="tabMed" style="width:100%; heigth:60%" class="table table-striped table-responsive">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES MEDECINS</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              <th style="text-align:center;width:45px"><input type="checkbox" id="checkallM" /></th>
              <th class="text-left">Nom(s) et Prénom(s)</th>
              
             
            </tr>
          </thead>
        </table>  
       
     
</div>
<div id="modalRPA" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="width:80%" >

    <div class="modal-content">
      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
        <button type="button" class="close mdCRPA" data-dismiss="modal">&times;</button>
        <h2  class="modal-title" >Redevances Prescription des Assurés</h2>
      </div>
      <div class="modal-body">
           <table id="tableTR" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
              <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                <tr  style ="heigth:10px;">
                  <th class="text-left">Prescripteur</th>
                  <th class="text-left">Dossier N°</th>
                  <th class="text-left">Date</th>
                  <th class="text-left">Patient</th>
                  <th class="text-left">Prise en charge</th>
                  <th class="text-left">Total</th>
                  <th class="text-left">Redevance</th>
                </tr>
              </thead>
              <tfoot>
                <th class="text-center" colspan="5" style="color:red;font-size:1.5em">TOTAL</th>
                <th><input type="number" class="form-control" id="Ttotal"> </th>
                <th><input type="number" class="form-control" id="Tredevance"> </th>
              </tfoot>
          </table> 
          <div class="row">
              
              <div class="col-sm-1 col-sm-offset-1">
                    <button style="margin-right:5px" id="btnPrint" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Imprimer</button>   
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-warning mdCRPA">
          <span class='glyphicon glyphicon-remove'></span> Close
        </button> 
      </div>
    </div>

  </div>
</div>
@endsection

@section('another')
$('#tabMed').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 10
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    
     $('#btnPrint').click(function(){
            
            window.open("{{ route('dashboard_redevances_prescriptions_assures_impression') }}");
    });

    $('.mdCRPA').click(function(){
    
              $("#modalRPA").modal("hide");
    });
  $("#btnCalculer").click(function(){
      $("#modalRPA").modal({
                  keyboard: false,
                  show : true,
                  backdrop: "static",
      });
  });
@endsection