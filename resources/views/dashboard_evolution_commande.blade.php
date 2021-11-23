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
          <div class="col-sm-1">
                <button style="margin-right:5px" id="btnPrint" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Imprimer</button>   
          </div>
      </div>
      
            
    </div>
<div class="table-responsive">
  <table id="tabEC" style="width:100%; heigth:60%" class="table table-striped ">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">EVOLUTION DES COMMANDES</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              <th class="text-left">Code</th>
              <th class="text-left">Fournisseur</th>
              <th class="text-left">Janvier</th>
              <th class="text-left">Fevrier</th>
              <th class="text-left">Mars</th>
              <th class="text-left">Avril</th>
              <th class="text-left">Mai</th>
              <th class="text-left">Juin</th>
              <th class="text-left">Juillet</th>
              <th class="text-left">Août</th>
              <th class="text-left">Septembre</th>
              <th class="text-left">Octobre</th>
              <th class="text-left">Novembre</th>
               <th class="text-left">Decembre</th>
              <th class="text-left">Total</th>
             
            </tr>
          </thead>
          <tbody>
            <tr id="456">
              <td>sdsd</td>
              <td>sdsd</td>
              <td>sdsd</td>
              <td>sdsd</td>
              <td>sdsd</td>
              <td>sdsd</td>
              <td>sdsd</td>
              <td>sdsd</td>
              <td>sdsd</td>
              <td>sdsd</td>
              <td>sdsd</td>
              <td>sdsd</td>
              <td>sdsd</td>
              <td>sdsd</td>
              <td>sdsd</td>
            </tr>
          </tbody>
          <tfoot>
              <th class="text-center" colspan="2" style="color:red;font-size:1.5em">TOTAL</th>
              <th><input type="number" class="form-control" id="Tjanvier"> </th>
              <th><input type="number" class="form-control" id="Tfevrier"> </th>
              <th><input type="number" class="form-control" id="Tmars"> </th>
              <th><input type="number" class="form-control" id="Tavril"> </th>
              <th><input type="number" class="form-control" id="Tmai"> </th>
              <th><input type="number" class="form-control" id="Tjuin"> </th>
              <th><input type="number" class="form-control" id="Tjuillet"> </th>
              <th><input type="number" class="form-control" id="Taout"> </th>
              <th><input type="number" class="form-control" id="Tseptembre"> </th>
              <th><input type="number" class="form-control" id="Toctobre"> </th>
              <th><input type="number" class="form-control" id="Tnovembre"> </th>
              <th><input type="number" class="form-control" id="Tdecembre"> </th>
              <th><input type="number" class="form-control" id="Ttotal"> </th>
          </tfoot>
            
        </table>  
  </div>
     
</div>

@endsection

@section('another')
$('#tabEC').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 10
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    
     $('#tabEC').on('dblclick', 'tr', function(event){
         if(this.cells[0].innerHTML != "Code"){
         
            var str = $(this).attr('id');
          
            var res = str.substring(4);

            $(".dnom_four").text(this.cells[1].innerHTML)
            window.open("{{ route('dashboard_evolution_commande_impression') }}");
            
        }
     });
@endsection