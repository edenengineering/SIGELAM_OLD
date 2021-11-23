@extends("dashboard")

@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
        
</script>
<div class="tab-content">

   <div class="row" style="margin:40px">
            <button id="btnCaisse" style="width:300px;" class="btn btn-primary btn-lg">
              <span class="glyphicon glyphicon-list"> CAISSE GENERALE</span>
            </button>
    </div>
   
        
</div>
<div id="modalCaisse" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg" style="width:100%">

        <div class="modal-content">
          <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
            <button type="button" class="close mdCTC" data-dismiss="modal">&times;</button>
            <h2  class="modal-title" >Caisse Générale</h2>
          </div>
          <div class="modal-body">
                <div class="row" style="margin-bottom:15px; margin-top:15px;">
           
             
      <div class="form-group">
          <label class="col-sm-1 control-label" >DU</label>
          <div class="col-sm-2">
              <input class="form-control" type="date" id="du">
          </div>
          <label class="col-sm-1 control-label" >AU</label>
          <div class="col-sm-2">
              <input class="form-control" type="date" id="au">
          </div>
          <div class="col-sm-1">
                <button style="margin-right:5px" id="" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> OK</button>   
          </div>
          <div class="col-sm-1">
                <button style="margin-right:5px" id="btnPrint" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Imprimer</button>   
          </div>
      </div>
      
            
    </div>
    <legend>Caisse</legend>
    <table id="tabCP" style="width:100%; heigth:60%" class="table table-striped table-responsive">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">CAISSE GENERALE</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              <th class="text-left">Agent</th>
              <th class="text-left">Facture N°</th>
              <th class="text-left">Patient</th>
              <th class="text-left">Total</th>
              <th class="text-left">Red(%)</th>
              <th class="text-left">Cash</th>
              <th class="text-left">Reste</th>
              <th class="text-left">Règlement</th>
              <th class="text-left">N° Chèque/CB</th>
              <th class="text-left">Banque</th>
            </tr>
          </thead>
          
          <tfoot>
              <th class="text-center" style="color:red;font-size:1.5em">TOTAL</th>
              <th></th>
              <th></th>
              <th><input type="number" class="form-control" id="Ttotal"> </th>
              <th></th>
              <th><input type="number" class="form-control" id="Tcash"> </th>
              <th><input type="number" class="form-control" id="Treste"> </th>
              <th></th>
              <th></th>
              <th></th>
          </tfoot>
            
        </table>  
        
        <legend>Assurances et Avoirs</legend>
    <table id="tabAA" style="width:100%; heigth:60%" class="table table-striped table-responsive">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">ASSURANCES ET AVOIRS</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              <th class="text-left">Agent</th>
              <th class="text-left">Ref. Facture</th>
              <th class="text-left">Raison Sociale</th>
              <th class="text-left">Montant</th>
              <th class="text-left">Cash</th>
              <th class="text-left">Période</th>
              <th class="text-left">Estimation</th>
              <th class="text-left">Mode Paiement</th>
            </tr>
          </thead>
          
          <tfoot>
              <th class="text-center" colspan="3" style="color:red;font-size:1.5em">Total Assureurs et Avoir</th>
              <th><input type="number" class="form-control" id="Ttotal"> </th>
              <th><input type="number" class="form-control" id="Tcash"> </th>
              <th></th>
              <th></th>
              <th></th>
          </tfoot>
            
      </table>
      <div class="row" style="margin-bottom:50px">
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-1 control-label" style="color:red;font-size:1.5em">CAISSE (F CFA)</label>
                <div class="col-sm-2 col-sm-offset-1">
                    <input class="form-control" type="number">  
                </div>
                <div class="col-sm-2">
                    <input class="form-control" type="number">
                </div>
                
            </div>
        </div>
          </div>
          <div class="modal-footer" >
           
          <button type="button" class="btn btn-warning mdCTC">
            <span class='glyphicon glyphicon-remove'></span> Close
          </button> 
          </div>
        </div>

      </div>
</div>
@endsection

@section('activeCG')
active
@endsection

@section('another')
$('#tabCP').DataTable({
                "aLengthMenu": [[2, 4, 5, -1], [2, 4, 5, "All"]],
                "iDisplayLength": 4
            });
$('#tabAA').DataTable({
                "aLengthMenu": [[2, 4, 5, -1], [2, 4, 5, "All"]],
                "iDisplayLength": 4
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    
     $('.mdCTC').click(function(){
            
            $("#modalCaisse").modal("hide");

          });
     $('#btnPrint').click(function(){
            
            window.open("{{ route('dashboard_caisse_generale_impression') }}");
    });
    $("#btnCaisse").click(function(){
          $("#modalCaisse").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                  }); 
    });
@endsection