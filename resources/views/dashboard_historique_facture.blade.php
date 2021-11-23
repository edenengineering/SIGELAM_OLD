@extends("dashboard")

@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
        
</script>
<div class="tab-content">
   <div class="row" style="margin-bottom:15px; margin-top:15px;">
           
          
              <div class="col-sm-3">
                <div class="form-group">
                    <label class="col-sm-8 control-label" >DU</label>
                    <div class="col-sm-12">
                        <input class="form-control" type="date" id="du">
                    </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                    <label class="col-sm-8 control-label" >AU</label>
                    <div class="col-sm-12">
                        <input class="form-control" type="date" id="au">
                    </div>
                </div>
             </div> 
            <div class="col-sm-1">
                <button style="margin-top:25px; font-size:1.2em" id="btnOK" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> OK</button>   
            </div>
             <div class="col-sm-2">
              <button style="margin-top:25px; font-size:1.2em" id="btnPrint" class="btn btn-primary "><i class="glyphicon glyphicon-print"></i> Imprimer</button>
             </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label class="col-sm-8 control-label">Montant Total</label>
                <div class="col-sm-12">
                    <input class="form-control" style="color:red;font-size:1.4em" type="text" id="montant_total" disabled="disabled">
                </div>
              </div>
            </div>
    </div>
  <table id="tabHF" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMeMF">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">HISTORIQUE DES FACTURES</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              <th class="text-left">Date</th>
              <th class="text-left">Patient</th>
              <th class="text-center">N° Dossier</th>
              <th class="text-center">Total</th>
              <th class="text-center" style="width:50px">Reduction</th>
              <th class="text-center" >N° Facture</th>
              <th class="text-left">Facturé par</th>
              <th class="text-left">Prescripteur</th>
              <th class="text-left">Edité par</th>
              <th class="text-left">Etat</th>
            </tr>
          </thead>
            
        </table>  

     
</div>

@endsection

@section('activeHF')
active
@endsection
@section('anotherLoad')
  
                  function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 

                  function ispresent(elt,arr){
                      var trouve = false;
                      for(var i = 0; i < arr.length;i++){
                        if(arr[i] == elt){
                          trouve = true;
                        }
                      }
                      return trouve;
                  }
                  function formatMoney(num , localize,fixedDecimalLength){
                            num=num+"";
                     var str=num;
                            var reg=new RegExp(/(\D*)(\d*(?:[\.|,]\d*)*)(\D*)/g)
                            if(reg.test(num)){ 
                         var pref=RegExp.$1;
                         var suf=RegExp.$3;
                         var part=RegExp.$2;
                               if(fixedDecimalLength/1)part=(part/1).toFixed(fixedDecimalLength/1);
                        if(localize)part=(part/1).toLocaleString();
                  str= pref +part.match(/(\d{1,3}(?:[\.|,]\d*)?)(?=(\d{3}(?:[\.|,]\d*)?)*$)/g ).join(' ')+suf ;
                       };
                    return str;
                  }
                   $.ajax({
                            url: "{{route('dashboard_date')}}",
                            dataType: "json"
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
 function formatMoney(num , localize,fixedDecimalLength){
                            num=num+"";
                     var str=num;
                            var reg=new RegExp(/(\D*)(\d*(?:[\.|,]\d*)*)(\D*)/g)
                            if(reg.test(num)){ 
                         var pref=RegExp.$1;
                         var suf=RegExp.$3;
                         var part=RegExp.$2;
                               if(fixedDecimalLength/1)part=(part/1).toFixed(fixedDecimalLength/1);
                        if(localize)part=(part/1).toLocaleString();
                  str= pref +part.match(/(\d{1,3}(?:[\.|,]\d*)?)(?=(\d{3}(?:[\.|,]\d*)?)*$)/g ).join(' ')+suf ;
                       };
                    return str;
                  }


var tableD = $('#tabHF').DataTable({
 
               "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                "order": [[ 2, "asc" ]],
               "serverSide": true,
               "ajax" : {
                  "url" : "{{ route('dashboard_get_liste_historique_facture') }}",
                  "dataType" : "json",
                  "type" : "POST",
                   "data": function ( d ) {
                    return $.extend( {}, d, {
                      "date_debut": $("#du").val(),
                      "date_fin": $("#au").val()
                    } );
                    },
                     beforeSend: function(){
            
                         $('.blockMeMF').block({ 
                            message: '<h3>Chargement.....</h3>', 
                            css: { border: '3px solid #a00' } 
                        }); 
                    },
                    complete: function(){
                        $('.blockMeMF').unblock();
                         $("#montant_total").val(formatMoney(  $('#tabHF tr:last').find('a').data('info') ));
                    }
               },
               "columns" : [
                    {"data" : "date_dossier"},
                    {"data" : "nom_patient"},
                    {"data" : "id"},
                    {"data" : "total"},
                    {"data" : "reduction"},
                    {"data" : "numero_facture"},
                    {"data" : "facture_par"},
                    {"data" : "prescripteur"},
                    {"data" : "edite_par"},
                    {"data" : "etat"}
               ],
                 "columnDefs": [
                { className: "align-left","targets": [0,1,6,7,8,9]},
                { className: "align-center","targets": [2,3,4,5]}
              ]
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
     $('div.dataTables_filter input').focus();
    
     $("#btnPrint").click(function(){
        if( ($("#du").val() != "" &&  $("#au").val() != "") &&  ($("#tabHF").dataTable().fnSettings().aoData.length!==0) ){
          window.open("{{ route('dashboard_historique_facture_print') }}?date_debut="+$("#du").val()+"&date_fin="+$("#au").val());
        }
     });
     $('#du').change(function (e) {
        tableD.draw();
      });
      $('#au').change(function (e) {
        tableD.draw();
      });
     $("#btnOK").click(function(){
          tableD.draw(); 

     });
@endsection