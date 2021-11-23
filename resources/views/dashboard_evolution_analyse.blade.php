@extends("dashboard")
@section('add_style')
 .align-right{text-align:right;max-width:80px} 
 .align-left{text-align:left;max-width:80px} 
 .align-center{text-align:center;max-width:80px} 
 .btnExcel{
  color: #ffffff!important; 
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25)!important; 
  background-color: #006dcc!important; 
  height:50px!important;
  width: 160px!important; 
  font-size: 1.2em!important; 
  margin-bottom: 30px!important; 
  *background-color: #0044cc!important; 
  background-image: -moz-linear-gradient(top, #0088cc, #0044cc)!important; 
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0044cc))!important; 
  background-image: -webkit-linear-gradient(top, #0088cc, #0044cc)!important; 
  background-image: -o-linear-gradient(top, #0088cc, #0044cc)!important; 
  background-image: linear-gradient(to bottom, #0088cc, #0044cc)!important; 
  background-repeat: repeat-x!important; 
  border-color: #0044cc #0044cc #002a80!important; 
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25)!important; 
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0088cc', endColorstr='#ff0044cc', GradientType=0)!important; 
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)!important; 
}
@endsection
@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
        function validate() {
    
    var valid = true;
    valid = checkEmpty($("#annee_debut"));
    valid = valid && checkEmpty($("#annee_fin"));
    return valid; 
  }
  
  function checkEmpty(obj) {
    var name = $(obj).attr("name");
    $("."+name+"-validation").html(""); 
    $(obj).css("border","");
    if($(obj).val() == "") {
      $(obj).css("border","#FF0000 1px solid");
      $("."+name+"-validation").css("color","#FF0000");
      $("."+name+"-validation").html("Obligatoire");
      return false;
    }
    
    return true;  
  }
</script>
<div class="tab-content">
   <div class="row" style="margin-bottom:15px; margin-top:15px;">
           
             
      <div class="form-group">
           <label class="col-sm-1 control-label" >Année Debut <br> <span class="annee_debut-validation validation-error"> </label>
          <div class="col-sm-2">
              <input class="form-control" type="number" name="annee_debut" min="0" id="annee_debut">
          </div>
          <label class="col-sm-1 control-label" >Année Fin  <br> <span class="annee_fin-validation validation-error"></label>
          <div class="col-sm-2">
              <input min="0" class="form-control" type="number" name="annee_fin" id="annee_fin">
          </div>
         
          <div class="col-sm-1">
                <button style="margin-right:5px" id="btnOk" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> OK</button>   
          </div>
          <div class="col-sm-1">
                <button style="margin-right:5px" id="btnPrintA"  class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Imprimer</button>   
          </div>
      </div>
      
            
    </div>

  <table id="tabEA" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMe">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">EVOLUTION DES ANALYSES</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              <th class="text-left">Année</th>
              <th class="text-left">Examen</th>
             
              <th class="text-center">Quantité</th>
               <th class="text-center">Montant</th>
             

            </tr>
          </thead>
         
         
            
        </table>  

     
</div>
<div id="AlerPre1" class="modal fade" role="dialog">
 <div class="modal-dialog" >
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" data-diss class="close mdcA1">&times;</button>
    <h3 class="modal-titleT"><i class="glyphicon glyphicon-info-sign"></i> Information</h3>
  </div>
  <div class="modal-body">
    <h3 class="infos">Il n'y a aucune donnée à imprimer  !!</h3>
  </div>
  <div class="modal-footer" >
    <button type="button" class="btn btn-warning mdcA1">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
@endsection

@section("anotherLoad")

  $("#annee_debut").focus()
@endsection

@section('another')
 var tableD = $('#tabEA').DataTable({
                 "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 10,
                "order": [[ 1, "asc" ]],
               "serverSide": true,
               "ajax" : {
                  "url" : "{{ route('dashboard_get_evolution_analyses') }}",
                  "dataType" : "json",
                  "type" : "POST",
                   "data": function ( d ) {
                    return $.extend( {}, d, {
                      "annee_debut": $("#annee_debut").val(),
                      "annee_fin": $("#annee_fin").val()
                    } );
                    },
                     beforeSend: function(){
            
                         $('.blockMe').block({ 
                            message: '<h3>Chargement.....</h3>', 
                            css: { border: '3px solid #a00' } 
                        }); 
                    },
                    complete: function(){
                        $('.blockMe').unblock();
                    }
               },
               "columns" : [
                    {"data" : "annee"},
                    {"data" : "examen"},
                    {"data" : "quantite"},
                    {"data" : "montant"}
               ],
                dom: 'Blfrtip',
                buttons: [
                        {
                          extend : 'excel',
                          text : 'Export Vers Excel',
                          className: 'btnExcel'
                        }
                           
                      ],
                 "columnDefs": [
                { className: "align-left","targets": [0,1]},
                { className: "align-center","targets": [2,3]}
              ]
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    
    $("#btnOk").click(function(){
      if(validate()){
              tableD.draw();
      }
    })
     $('.mdcA1').click(function(){
           
            $("#AlerPre1").modal("hide");
            });
      $('#btnPrintA').click(function(){
          if( ($("#tabEA").dataTable().fnSettings().aoData.length!==0) ){
            window.open("{{ route('dashboard_evolution_analyse_impression') }}?annee_debut="+ $("#annee_debut").val() +"&annee_fin="+$("#annee_fin").val());
          }else{
              $("#AlerPre1").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
            }
    });
@endsection