  @extends("dashboard")

@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
     
    
      function validate() {
    
    var valid = true;
    valid = valid &&  checkEmpty($("#du"));

    valid = valid && checkEmpty($("#au"));
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
  
          <div class="row" style="margin-top:15px;margin-bottom:20px">
              <div class="form-group"> 
                  <label class="control-label col-sm-1">Du :<br /><span class="du-validation validation-error"></span></label>
                  <div class="col-sm-3">
                    <input class="form-control" name="du" type="date" id="du">
                  </div>
                  <label class="control-label col-sm-1">Au :<br /><span class="au-validation validation-error"></span></label>
                  <div class="col-sm-3">
                    <input class="form-control" name="au" type="date" id="au">
                  </div>
                  <div class="col-sm-1">
                        <button style="margin-right:5px" id="btnS" class="btn btn-success"><i class="glyphicon glyphicon-search"></i> OK</button>   
                  </div>
                  <div class="col-sm-2">
                        <button style="margin-right:5px" id="btnPrint" disabled="disabled" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Imprimer</button>   
                  </div>
              </div>
          </div>
          <table id="tableUC" style="width:100%;  heigth:60%;background-color:black" class="table table-striped table-responsive blockMe">
          <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">HISTORIQUE DES CONNEXIONS</h4>
          </caption>  
          
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th class="text-left" style="width:50px">Matricule</th>
              <th class="text-left" style="width:100px">Nom</th>
              <th class="text-left" >Topic</th>
              <th class="text-left" style="width:100px">Nom Hôte</th>
              <th class="text-left" style="width:100px">Le </th>
              <th class="text-left" style="width:100px">A</th>
              
            </tr>
          </thead>
        </table>      
      
           
</div>
@endsection
@section('anotherLoad')
  
                  function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 

                     
                   $.ajax({
                            url: "{{route('dashboard_date')}}",
                            dataType: "json",
                            complete: function(){
                               
                            }
                        })
                        .done(function(msg){
                            var date = JSON.parse(msg['date']);
                            $("#du").val(date);
                            $("#au").val(date);
                        });

                   
@endsection
@section('another')
 function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 
      /*$('#tableUC').DataTable( {
                       "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                       "iDisplayLength": 5,
           "bSort" : false,
                 "columnDefs": [
                { className: "align-left","targets": [0,1,2,3,4,5]}
              ]
                              } );*/
     
    var tableD = $('#tableUC').DataTable({
 
               "aLengthMenu": [[5, 10, 15], [5, 10, 15]],
                "iDisplayLength": 5,
               "bSort" : false,
               "serverSide": true,
               "ajax" : {
                  "url" : "{{ route('dashboard_get_liste_historique_connexion') }}",
                  "dataType" : "json",
                  "type" : "POST",
                   "data": function ( d ) {
                    return $.extend( {}, d, {
                      "date_debut": $("#du").val(),
                      "date_fin": $("#au").val()
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
                    {"data" : "matricule"},
                    {"data" : "nom"},
                    {"data" : "topic"},
                    {"data" : "address_ip"},
                    {"data" : "date"},
                    {"data" : "heure"}
               ],
                 "columnDefs": [
                { className: "align-left","targets": [0,1,2,3,4,5]}
              ]
            });
      $('#tabAUC').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
  
    $('.mdcA').click(function(){
           
            $("#modUC").modal("hide");
            });
      $('#du').change(function (e) {
        tableD.draw();
      });
      $('#au').change(function (e) {
        tableD.draw();
      });
    $("#btnS").click(function(){
      if(validate()){
          tableD.draw();
     } 
    });
    $("#btnPrint").click(function(){

            window.open("{{ route('dashboard_print_historique_connexion') }}?date_debut="+$("#du").val()+"&date_fin="+$("#au").val()); 
    });
  
    
@endsection