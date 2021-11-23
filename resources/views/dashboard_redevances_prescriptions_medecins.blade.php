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
          <div class="col-sm-1">
              <input class="form-control" type="number" id="pourcentage">
          </div>
          <div class="col-sm-1" style="margin-right:5px">
                <button id="" class="btn btn-success"><i class="glyphicon glyphicon-refresh"></i> Calculer</button>   
          </div>
        
          <div class="col-sm-1 col-sm-offset-1">
                <button style="margin-right:5px" id="btnPrint" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Imprimer</button>   
          </div>
      </div>
      
            
    </div>
  <table id="tabRPM" style="width:100%; heigth:60%" class="table table-striped table-responsive">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">REDEVANCES PRESCRIPTIONS</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              <th style="text-align:center;width:45px"><input type="checkbox" id="checkallRPM" /></th>
              <th class="text-left">Nom(s) et Prénom(s)</th>
              <th class="text-left">Rédevances</th>
             
            </tr>
          </thead>
        </table>  
        <div class="row">
           <div class="form-group">
              <label class="control-label text-right col-sm-2" style="color:red; font-size:1.5em">TOTAL</label>
              
              <div class="col-sm-3">
                 <input class="form-control" type="number" disabled="disabled">
              </div>
                <div class="col-sm-1" style="margin-right:10px">
                  <button  id="" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Supprimer</button>   
                </div>
           </div>
        </div>
     
</div>

@endsection

@section('another')
$('#tabRPM').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    
     $('#btnPrint').click(function(){
            
            window.open("");
    });
@endsection