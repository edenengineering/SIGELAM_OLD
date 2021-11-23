@extends("dashboard")

@section('d_content')
 <div class="container-fluid">
     <div class="row">
         <div class="col-12 m-auto">
             <legend>
                 <h4 class="text-left" style="color:rgb(51,122,183); font-weight: bold;">
                    <span id="search-title" class="h2 font-weight-bold">RESULTATS POSITIFS DE QUELQUES EXAMENS</span>
                </h4>
            </legend>
         </div>
     </div>
     <div class="row">
         <form action="#" class="form form-inline" onsubmit="return false;">
             <div class="form-group m-5">
                 <label for="begin-date" class="form-label">Du</label>
                 <input type="date" name="begin-date" id="begin-date" class="form-control">
             </div>
             <div class="form-group m-5">
                 <label for="end-date" class="form-label">Au</label>
                 <input type="date" name="end-date" id="end-date" class="form-control">
             </div>
             <div class="form-group m-5">
                 <label for="examens" class="form-label">Examen</label>
                 <select name="examen" id="examen" class="form-control">
                    <option value="" class="text-center">--- Choix de l'examen ---</option>
                    @foreach($examens as $examen)
                        <option value="{{ $examen->id }}">{{$examen->libelle_examen}}</option>
                    @endforeach
                 </select>
             </div>
             <div class="form-group m-5">
                <button class="btn btn-success" id="valider">
                    <span class="fa fa-check-circle"></span>
                    Valider
                </button>
             </div>
             <div class="form-group m-5">
                <span class="text-danger form-check alert alert-danger" id="warning" hidden="hidden">
                     Veillez remplir tous les champs
                </span>
             </div>
         </form>
     </div>
     <div class="m-3">&nbsp;</div>
     <div class="row">
         <div class="col-12 m-auto">
             <div id="table-area">
                 <table class="table table-bordered border-0" id="stat-table">
                     <thead class="bg-dark">
                         <th>Tranche d'age</th>
                         <th>Femmes enceintes</th>
                         <th>Autres Femmes</th>
                         <th>Hommes</th>
                         <th>Total</th>
                     </thead>
                 </table>
                 <tbody>

                 </tbody>
             </div>
         </div>
     </div>
 </div>
@endsection

@section('anotherLoad')
    function getExportFileName(){
        return 'RESULTATS POSITIFS ' + 
                $("#examen option:selected").text() + 
                ' DU ' + $("#begin-date").val() + ' AU ' + $("#end-date").val();
    }


    let table = $('#stat-table').dataTable({
        "columns": [
            {data: 'categorie'},
            {data: 'enceinte'},
            {data: 'autre'},
            {data: 'masculin'},
            {data: 'total'}
        ],
        "bPaginate": false,
        "ordering": false,
        dom: 'Bfrtip',
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
                footer : true,
                autoPrint: true,
                className: 'btnExcel'
            }
        ]
    });
    $(document).ready(function () {
        $('.dataTables_length').addClass('form-inline');
        $('.dataTables_length select').addClass('form-control');
        $('.dataTables_filter').addClass('form-inline');
        $('.dataTables_filter input').addClass('form-control');
        $('.buttons-print').addClass('btnExcel');
        $('.buttons-excel').addClass('btnExcel');
    });


    $('#valider').click(function () {
        let search = {};
        search.start = $('#begin-date').val();
        search.end = $('#end-date').val();
        search.examen = $('#examen').val();
        if (search.start!=''&&search.end!=''&&search.examen!='') {
            $('#warning').attr('hidden','hidden');
            $.ajax({
                url: "{{ route('dashboard_get_liste_examens_positifs') }}",
                method: "GET",
                data: search,
                beforeSend: function (){
                    table.block({
                        message: "<b>Chargement....</b>",
                        css: { border: '3px solid #a00' }
                    });
                },
                complete: function(){
                    table.unblock();
                },
                success: function (data){
                    table.fnClearTable();
                    let json_data = JSON.parse(data);
                    $('#search-title').text(getExportFileName())
                    if(json_data.length>0){
                        table.fnAddData(json_data);
                    }
                }
            });
        }else{
            $('#warning').removeAttr('hidden');
        }
    });
@endsection