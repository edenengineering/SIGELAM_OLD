@extends("dashboard")

@section('add_style')

@endsection

@section('d_content')
  <div class="container-fluid">
     <div class="row">
         <div class="col-12 m-auto">
             <legend>
                 <h4 class="text-left" style="color:rgb(51,122,183); font-weight: bold;">
                    <span id="search-title" class="h2 font-weight-bold">RAPPORT D'ACTIVITE LABORATOIRE</span>
                </h4>
            </legend>
         </div>
     </div>
     <div class="row m-auto">
       <div class="col-10 m-auto">
         <div class="form form-inline">
           <div class="form-group m-4">
             <label for="begin-date" class="form-label">Du</label>
             <input type="date" name="begin-date" id="begin-date" class="form-control">
           </div>
           <div class="form-group m-4">
             <label for="end-date" class="form-label">Au</label>
             <input type="date" name="end-date" id="end-date" class="form-control">
           </div>
           <div class="form-group">
             <button class="btn btn-success" id="search-btn">
               <span class="fa fa-check-circle"></span>
               Valider
             </button>
           </div>
           <div class="form-group">
             <div class="alert alert-danger form-check" id="check" hidden="hidden">
               Veuillez remplir tous les champs
             </div>
           </div>
          </div>
       </div>
       <hr>
       <div class="col-11 m-auto">
        <table class="table table-bordered" id="dataTbl">
          <thead class="thead-light">
            <th>Examen</th>
            <th>Quantit&eacute;</th>
          </thead>
          <tbody>

          </tbody>
        </table>
       </div>
     </div>
  </div>
@endsection

@section("anotherLoad")
  function getExportFileName(){
    return "RAPPORT D'ACTIVITE LABORATOIRE DU "+ 
    $("#begin-date").val() + " AU "+ $("#end-date").val();
  }

  $(document).ready(function () {
      $('.dataTables_length').addClass('form-inline');
      $('.dataTables_length select').addClass('form-control');
      $('.dataTables_filter').addClass('form-inline');
      $('.dataTables_filter input').addClass('form-control');
      $('.buttons-print').addClass('btnExcel');
      $('.buttons-excel').addClass('btnExcel');
  });

  let table= $('#dataTbl').dataTable({
    "columns" : [
        {"data" : "examen"},
        {"data" : "quantite"}
    ],
    'bPaginate': false,
    'searching': false,
    'ordering': false,
    dom: 'Blfrtip',
    buttons: [
      {
        extend : 'excel',
        filename: function () { return getExportFileName();},
        title : function () { return getExportFileName();},
        text : 'Export vers Excel',
        footer : true,
        className: 'btnExcel',
      },
        {
        extend : 'print',
        filename: function () { return getExportFileName();},
        title : function () { return getExportFileName();},
        text : 'Imprimer',
        orientation: 'portrait',
        footer : true,
        autoPrint: true,
        className: 'btnExcel'
        }
    ]
  });

  $('#search-btn').click(function (){
    if($('#begin-date').val()==''||$('#end-date').val()==''){
      $('#check').removeAttr('hidden');
      return false;
    }
    $('#check').attr('hidden','hidden');
    let search_data = {};
    search_data.start_date=$('#begin-date').val();
    search_data.end_date=$('#end-date').val();

    table.fnClearTable();
    $.ajax({
      "url" : "{{ route('dashboard_get_liste_rapport_activite') }}",
      "type" : "POST",
      "data": search_data,
      beforeSend: function(){
        $('#dataTbl').block({ 
          message: '<h3>Chargement.....</h3>', 
          css: { border: '3px solid #a00' } 
        }); 
      },
      complete: function(){
          $('#dataTbl').unblock();
      },
      success: function(data){
        let json_data = JSON.parse(data);
        $('#search-title').text(getExportFileName())
        if(json_data.length>0){
            table.fnAddData(json_data);
        }
      }
    });

    return false;
  });
@endsection