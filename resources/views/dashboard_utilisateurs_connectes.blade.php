@extends("dashboard")

@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>    
<script type="text/javascript">

       var tabC = {!! $connectes !!};
</script> 
    
<div class="tab-content">
  

          <table id="tableUC" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
          <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES UTILISATEURS CONNECTÉS</h4>
          </caption>  
          
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th class="text-left">Matricule</th>
              <th class="text-left">Nom</th>
              <th class="text-left">Nom Hôte</th>
              <th class="text-left">Heure Connexion</th>
              
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

                  
                               $('#tableUC').DataTable({
                              "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                              "iDisplayLength": 5,
                 "columnDefs": [
                { className: "align-left","targets": [0,1,2,3]}
              ]
                          });
                  $(".dataTables_length select").addClass("form-control");
                  $(".dataTables_filter input").addClass("form-control");
                  for(var i = 0; i < tabC.length ; i++){
                            
                            
                            var data = [
                            pad(tabC[i].matricule,6), 
                            tabC[i].nom_user,
                            tabC[i].ip_address,
                            tabC[i].heure_connexion
                                
                                ];
                              var rowIndex = $('#tableUC').dataTable().fnAddData(data);
                                  var row = $('#tableUC').dataTable().fnGetNodes(rowIndex);
                                  $(row).attr( 'id','item' + tabC[i].id); 
                                  var tr = $("#tableUC tr#item"+tabC[i].id);
                                 
                                  tr.find('td:eq(0)').addClass('text-left');
                                  tr.find('td:eq(1)').addClass('text-left');
                                  tr.find('td:eq(2)').addClass('text-left');
                                  tr.find('td:eq(3)').addClass('text-left');
                                  tr.find('td:eq(4)').addClass('text-left');
                                  
                                      
                    }
                 
@endsection
@section('another')
     
  
    $('.mdcA').click(function(){
           
            $("#modUC").modal("hide");
            });
      
  
    
@endsection