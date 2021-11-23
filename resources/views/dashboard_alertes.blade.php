@extends("dashboard")
@section('add_style')
 .align-right{text-align:right;max-width:80px} 
 .align-left{text-align:left;max-width:80px} 
 .align-center{text-align:center;max-width:80px} 
@endsection
@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script> 
<script type="text/javascript">
</script>    
 
<div class="tab-content">
          <table id="tableAlert" style="width:100%;  heigth:60%" class="table table-striped table-responsive blockMe">
          <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES DOSSIERS EN RETARD DE TRAITEMENT</h4>
          </caption>  
          
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th class="text-left">N° Dossier</th>
              <th class="text-left">Patient</th>
              <th class="text-left">Examen</th>
              <th class="text-left">Date dossier</th>
              <th class="text-left">Date Retrait</th>
            </tr>
          </thead>
          
        </table>     
</div>
@endsection
@section('activeHA')
active
@endsection
@section('anotherLoad')
  
               function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 
                  
                 
@endsection
@section('another')
   $('#tableAlert').DataTable({
                 "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                "order": [[ 1, "desc" ]],
                 "serverSide": true,
                 "ajax" : {
                    "url" : "{{ route('dashboard_get_liste_alertes') }}",
                    "dataType" : "json",
                    "type" : "POST",
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
                      {"data" : "id_dossier"},
                      {"data" : "nom_patient"},
                      {"data" : "examen"},
                      {"data" : "date_dossier"},
                      {"data" : "date_retrait"}
                 ]
            });
         $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
     $('div.dataTables_filter input').focus();
@endsection