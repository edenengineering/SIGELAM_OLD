@extends("dashboard")

@section('d_content')
 <div class="container-fluid">
     <div class="row">
         <div class="col-12 m-auto">
             <legend>
                 <h4 class="text-left" style="color:rgb(51,122,183); font-weight: bold;">
                    <span id="search-title" class="h2 font-weight-bold">STATISTIQUE GENERALE DES EXAMENS</span>
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
             <div id="general-table">
                 <table class="table table-bordered" id="stat-table">
                     <thead class="thead-light">
                        <th>Tranche d'age</th>
                        <th>Femmes Enceintes N&eacute;gatives</th>
                        <th>Femmes Enceintes Positives</th>
                        <th>Autres Femmes N&eacute;gatives</th>
                        <th>Autres Femmes Positives</th>
                        <th>Hommes N&eacute;gatifs</th>
                        <th>Hommes Positifs</th>
                        <th>Total N&eacute;gatifs</th>
                        <th>Total Positifs</th>
                     </thead>
                 </table>
                 <tbody>

                 </tbody>
             </div>
             <div hidden="hidden" id="hiv-table">
                 <table class="table table-bordered table-justified" id="vih-table">
                    <thead class="thead-lignt">
                        <th class="text-center">Tranche d'age</th>
                        <th class="text-center">F. Enceintes <br>N</th>
                        <th class="text-center">F. Enceintes <br>P</th>
                        <th class="text-center">F. Enceintes <br>I</th>
                        <th class="text-center">Autres F. <br>N</th>
                        <th class="text-center">Autres F. <br>P</th>
                        <th class="text-center">Autres F. <br>I</th>
                        <th class="text-center">Hommes <br>N</th>
                        <th class="text-center">Hommes <br>P</th>
                        <th class="text-center">Hommes <br>I</th>
                        <th class="text-center">Total <br>N</th>
                        <th class="text-center">Total <br>P</th>
                        <th class="text-center">Total <br>I</th>
                    </thead>
                    <tbody>

                    </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>
@endsection

@section('anotherLoad')
    function getExportFileName(){
        return 'RESULTATS ' + 
                $("#examen option:selected").text() + 
                ' DU ' + $("#begin-date").val() + ' AU ' + $("#end-date").val();
    }

    let table = $('#stat-table').dataTable({
        "columns": [
            {data: "categorie"},
            {data: "fen"},
            {data: "fep"},
            {data: "afn"},
            {data: "afp"},
            {data: "masn"},
            {data: "masp"},
            {data: "totn"},
            {data: "totp"}
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

    let vih_table = $('#vih-table').dataTable({
        "columns": [
            {data: "categorie"},
            {data: "fen"},
            {data: "fep"},
            {data: "fei"},
            {data: "afn"},
            {data: "afp"},
            {data: "afi"},
            {data: "masn"},
            {data: "masp"},
            {data: "masi"},
            {data: "totn"},
            {data: "totp"},
            {data: "toti"}
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
                orientation: 'landscape',
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

    $('#examen').change(function (){
        let text = $('select[name=examen] option[value='+$(this).val()+']').text();
        if(text.indexOf('VIH')!=-1){
            $('#general-table').attr('hidden','hidden');
            $('#hiv-table').removeAttr('hidden');
        }else{
            $('#hiv-table').attr('hidden','hidden');
            $('#general-table').removeAttr('hidden');
        }
    });

    $('#valider').click(function () {
        let search = {};
        search.start = $('#begin-date').val();
        search.end = $('#end-date').val();
        search.examen = $('#examen').val();
        if (search.start!=''&&search.end!=''&&search.examen!='') {
            $('#warning').attr('hidden','hidden');
            $.ajax({
                url: "{{ route('dashboard_get_liste_generale_examens') }}",
                method: "POST",
                data: search,
                beforeSend: function (){
                    table.block({
                        message: "<b>Chargement....</b>",
                        css: { border: '3px solid #a00' }
                    });
                    vih_table.block({
                        message: "<b>Chargement....</b>",
                        css: { border: '3px solid #a00' }
                    });
                },
                complete: function(){
                    table.unblock();
                    vih_table.unblock();
                },
                success: function (data){
                    table.fnClearTable();
                    vih_table.fnClearTable();
                    let json_data = JSON.parse(data);
                    $('#search-title').text(getExportFileName())
                    if(json_data.length>0){
                        if($('select[name=examen] option[value='+$("#examen").val()+']').text().indexOf('VIH')!=-1){
                            vih_table.fnAddData(json_data);
                        }else{
                            table.fnAddData(json_data);
                        }
                    }
                }
            });
        }else{
            $('#warning').removeAttr('hidden');
        }
    });
@endsection