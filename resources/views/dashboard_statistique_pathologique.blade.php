@extends("dashboard")

@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
        
</script>
<div class="tab-content">
   <div class="row" style="margin-bottom:15px; margin-top:15px;">
           
              <div class="col-sm-6">
              <div class="form-group">
                  <label class="col-sm-1 control-label" >DU</label>
                  <div class="col-sm-5">
                      <input class="form-control" type="date" id="du">
                  </div>
                  <label class="col-sm-1 control-label" >AU</label>
                  <div class="col-sm-5">
                      <input class="form-control" type="date" id="au">
                  </div>
              </div>
            </div>
            
    </div>
  <table id="tabSP" style="width:100%; heigth:60%" class="table table-striped table-responsive">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES PATHOLOGIES</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              <th class="text-left">Type Examen</th>
              <th class="text-left">Examen</th>
              
            </tr>
          </thead>
          <tr id="15">
              <td>biochimie </td>
              <td>urine</td>
             
          </tr>
            
        </table>  
  
     
</div>
<div id="modSP" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md" style="width:80%">

        <div class="modal-content">
          <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
            <button type="button" class="close mdCSP" data-dismiss="modal">&times;</button>
            <h2  class="modal-titleM">Statistiques</h2>
          </div>
          <div class="modal-body">
           <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Général</a></li>
            <li><a data-toggle="tab"   href="#homme">Hommes</a></li>
            <li><a data-toggle="tab"  href="#femme">Femmes</a></li>
            
            </ul>
            <div class="tab-content">
                <div id="general" class="tab-pane fade in active ">
                    <div class="container-fluid">
            
                      <legend style="padding-left:10px;">Général</legend>
                       <table id="tab_general" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMe">
                              
                              <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                                <tr  style ="heigth:10px;">
                                  <th>Tranche d'âge</th>
                                  <th>Total</th>
                                  <th>Négatif</th>
                                  <th>Positif</th>
                                  <th>Prévalence</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th style="width:150px"><label class="control-label"> Total</label></th>  
                                  <th><input type="number" class="form-control" id="TtotalG"> </th>
                                  <th><input type="number" class="form-control" id="TnegatifG"> </th>
                                  <th><input type="number" class="form-control" id="TpositifG"> </th>
                                  <th><input type="number" class="form-control" id="TprevalenceG"> </th>
                                </tr>
                                
                              </tfoot>
                        </table>
                            
                            <div class="row">
                                <button type="button" id="btnPrintG" class="btn btn-primary col-sm-2 col-sm-offset-1" style="width:100px; margin-right:15px;"><i class="glyphicon glyphicon-print"></i> Imprimer</button>
                                <button type="button" id="btnGraphG" class="btn btn-success  col-sm-2 " style="width:100px;margin-right:5px;"><i class="fa fa-area-chart"></i> Graphique</button>
                                
                            </div>
                           

                      </div>
                </div>
                <div id="homme" class="tab-pane fade">
                    <div class="container-fluid">
            
                      <legend style="padding-left:10px;">Hommes</legend>
                       <table id="tab_homme" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMe">
                              
                              <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                                <tr  style ="heigth:10px;">
                                  <th>Tranche d'âge</th>
                                  <th>Total</th>
                                  <th>Négatif</th>
                                  <th>Positif</th>
                                  <th>Prévalence</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th style="width:150px"><label class="control-label"> Total</label></th>  
                                  <th><input type="number" class="form-control" id="TtotalH"> </th>
                                  <th><input type="number" class="form-control" id="TnegatifH"> </th>
                                  <th><input type="number" class="form-control" id="TpositifH"> </th>
                                  <th><input type="number" class="form-control" id="TprevalenceH"> </th>
                                </tr>
                                
                              </tfoot>
                        </table>
                           
                            <div class="row">
                                <button type="button" id="btnPrintH" class="btn btn-primary col-sm-2 col-sm-offset-1" style="width:100px; margin-right:15px;"><i class="glyphicon glyphicon-print"></i> Imprimer</button>
                                <button type="button" id="btnGraphH" class="btn btn-success  col-sm-2 " style="width:100px;margin-right:5px;"><i class="fa fa-area-chart"></i> Graphique</button>
                                
                            </div>
                           

                      </div>
                </div>
                <div id="femme" class="tab-pane fade">
                    <div class="container-fluid">
            
                      <legend style="padding-left:10px;">Femmes</legend>
                       <table id="tab_femme" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMe">
                              
                              <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                                <tr  style ="heigth:10px;">
                                  <th>Tranche d'âge</th>
                                  <th>Total</th>
                                  <th>Négatif</th>
                                  <th>Positif</th>
                                  <th>Prévalence</th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th style="width:150px"><label class="control-label"> Total</label></th>  
                                  <th><input type="number" class="form-control" id="TtotalF"> </th>
                                  <th><input type="number" class="form-control" id="TnegatifF"> </th>
                                  <th><input type="number" class="form-control" id="TpositifF"> </th>
                                  <th><input type="number" class="form-control" id="TprevalenceF"> </th>
                                </tr>
                                
                              </tfoot>
                        </table>
                            
                            <div class="row">
                                <button type="button" id="btnPrintF" class="btn btn-primary col-sm-2 col-sm-offset-1" style="width:100px; margin-right:15px;"><i class="glyphicon glyphicon-print"></i> Imprimer</button>
                                <button type="button" id="btnGraphF" class="btn btn-success  col-sm-2 " style="width:100px;margin-right:5px;"><i class="fa fa-area-chart"></i> Graphique</button>
                                
                            </div>
                           

                      </div>
                </div>
            </div>
          </div>
          <div class="modal-footer" id="footerM">
            
            <button type="button" class="btn btn-warning mdCSP">
              <span class='glyphicon glyphicon-remove'></span> Close
            </button> 
          </div>
        </div>

      </div>
    </div>
@endsection

@section('another')
$('#tabSP').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 10
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
     $('#tabSP').on('dblclick', 'tr', function(event){
         if(this.cells[0].innerHTML != "Type Examen"){
         
            var str = $(this).attr('id');
          
            var res = str.substring(4);
             $("#modSP").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
             });
            
        }
     });
     $('.mdCSP').click(function(){
           
            $("#modSP").modal("hide");
    });
@endsection