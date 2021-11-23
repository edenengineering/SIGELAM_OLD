@extends("dashboard")

@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">

          var tab_dossier  = {!! $dossiers  !!};
          var total  =  {!! $total !!};
          var tab_agent = {!! $agent_editeurs->toJson()  !!}; 
          var tab_exam = {!! $examens->toJson()  !!};
       function validate() {
    
    var valid = true;
    valid = checkEmpty($("#dateJ"));
    valid = valid && checkEmpty($("#numero_facture"));
    valid = valid && checkEmpty($("#agent"));
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
          <div class="col-sm-1">
                <button style="margin-right:5px" id="btnPrint" disabled="disabled" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Imprimer</button>   
          </div>
           <label class="col-sm-1 col-sm-offset-1 control-label" disabled="disabled" style="color:red;font-size:1.4em" >Total </label>
          <div class="col-sm-3">
              <input class="form-control" style="color:red;font-size:1.4em" disabled="disabled" type="text" name="total" min="0" id="total">
          </div>
      </div>
      
            
    </div>
  <table id="tabCAQ" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMe">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES DOSSIERS IMPAYES</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              <th class="text-left">N° Dossier</th>
              <th class="text-left">Noms du Patient</th>
              <th class="text-left">Unité de Soin</th>
              <th class="text-left">Date Dossier</th>
              <th class="text-left">Heure dossier</th>
              <th class="text-left">Editée par</th>
              <th class="text-left">Montant</th>
            </tr>
          </thead>
            
        </table>  
  
     
</div>

<div id="ModPaye" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg" >
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcP">&times;</button>
    <h3 class="modal-titleT">Payement <span class="hidden did_dossier"></span> </h3>
  </div>
  <div class="modal-body">
    <legend>Paiement</legend>
    <form class="form-horizontal" role="form">
      <div class="row" style="margin-bottom:15px">
          <div class="form-group">
            <label class="control-label col-sm-3">Montant à payer : </label>
            <div class="col-sm-3">
                <input class="form-control" disabled="disabled" type="text" id="MAP">
            </div>
              <label class="control-label col-sm-2">Date Facturation : <br /><span class="dateJ-validation validation-error"></span></label>
            <div class="col-sm-3">
                <input class="form-control"  id="dateJ" name="dateJ" type="date">
            </div>
          </div>
      </div>
      <div class="row" style="margin-bottom:15px">
          <div class="form-group">
            <label class="control-label col-sm-3">Numero Facture : <br /><span class="numero_facture-validation validation-error"></span></label>
            <div class="col-sm-3">
                <input class="form-control" type="text" name="numero_facture" id="numero_facture">
            </div>
            <label class="control-label col-sm-2">Facturé par : <br /><span class="agent-validation validation-error"></span></label>
            <div class="col-sm-3">
                <select class="form-control"  id="agent" name="agent">
                </select>
            </div>
          </div>
      </div>
      <div class="row" style="margin-bottom:15px">
          <div class="form-group">
            <label class="control-label col-sm-3">Unité de soin :</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="unite" id="unite" disabled="disabled">
            </div>
          </div>
      </div>
    </form>
    <legend>Liste des Examens à Payer</legend>
     <div class="table-responsive">
           <table id="tab_LED"  class="table table-striped  table-borderless blockMeI">       
                  <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                    <tr  style ="heigth:10px;">
                      <th class="text-left">Code</th>
                      <th class="text-left">Qté</th>
                      <th class="text-left">Libellé</th>
                      <th class="text-left">P.U</th>
                      <th class="text-left">P.T</th>
                      <th class="text-left">Red(%)</th>
                      <th class="text-left">Net</th>
                      <th class="text-left">Delai</th>     
                    </tr>
                  </thead>
          </table>
      </div>
  </div>
  <div class="modal-footer" >
  <button type="button" id="valP" class="btn btn-success">
          <span class='glyphicon glyphicon-ok-sign'></span> Payer
  </button>
    <button type="button" class="btn btn-warning mdcP">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
@endsection

@section('anotherLoad')
        $('#tabCAQ').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                 "columnDefs": [
                { className: "align-left","targets": [0,1,2,3,4,5,6]}
              ],
                dom: 'Blfrtip',
                buttons: [
                        {
                          extend : 'excel',
                          text : 'Export Vers Excel',
                          className: 'btnExcel',
                          title : "ETATS IMPAYES"
                        }
                           
                      ]
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
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
                   $("#total").val(formatMoney(total));

                        for(i=0;i < tab_dossier.length;i++){
                                 var data = [
                                        pad(tab_dossier[i].id_dossier,6),
                                        tab_dossier[i].patient,
                                         tab_dossier[i].unite,
                                        tab_dossier[i].date_dossier,
                                        tab_dossier[i].heure_dossier,
                                        tab_dossier[i].edite_par,
                                        tab_dossier[i].montant
                                        ];
                                var rowIndex = $('#tabCAQ').dataTable().fnAddData(data);
                                var row = $('#tabCAQ').dataTable().fnGetNodes(rowIndex);
                                $(row).attr( 'id','item' + tab_dossier[i].id_dossier); 
                                var tr = $("#tabCAQ tr#item"+tab_dossier[i].id_dossier);
                                tr.css("cursor","pointer");
                                tr.find('td:eq(0)').addClass('text-left');
                                tr.find('td:eq(1)').addClass('text-left');
                                tr.find('td:eq(2)').addClass('text-left');
                                tr.find('td:eq(3)').addClass('text-left');

                                tr.find('td:eq(4)').addClass('text-left');
                                tr.find('td:eq(5)').addClass('text-left');
                                               
                              }
                               if($("#tabCAQ").dataTable().fnSettings().aoData.length===0) {
                                    $("#btnPrint").attr("disabled","disabled");

                              }else{
                                    $("#btnPrint").removeAttr("disabled");
                              }
       /*  */
@endsection

@section('another')
  $('#tab_LED').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                "searching": false,
                 "lengthChange": false,
                 "columnDefs": [
                { className: "align-left","targets": [0,1,2]},
                { className: "align-center","targets": [3,4,5,6,7]}
              ]
            });
      function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    }
     $('#btnPrint').click(function(){
            
            window.open("{{ route('dashboard_imprimer_impayes') }}");
    });

    $('#tabCAQ').on('dblclick', 'tr', function(event) {

             if( this.cells[0].innerHTML != "N° Dossier"){
                  var str = $(this).attr('id');
                  var res = str.substring(4);
                  $(".did_dossier").text(res);
                  $("#MAP").val(formatMoney(this.cells[6].innerHTML));
                   $("#unite").val(this.cells[2].innerHTML)
                 $("#ModPaye").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
               });
              }

        });
        
      $('#ModPaye').on('shown.bs.modal', function () {
        $("#agent").find("option").remove();
         $('#agent').append($('<option>',
                 {
                    value: '',
                    text : "--- Agent éditeur ---",
                    selected:true
              }));
        for(var i=0;i < tab_agent.length;i++){
                      $('#agent').append($('<option>',
                     {
                        value: tab_agent[i].id,
                        text : tab_agent[i].nom_agent,
                        selected: true
                    }));    
            }
                 $.ajax({
                            url: "{{route('dashboard_date')}}",
                            dataType: "json"    
                        })
                        .done(function(msg){
                            var date = JSON.parse(msg['date']);
                            $("#dateJ").val(date);
                        });
             $.ajax({
                            
                            url: "{{route('dashboard_examen_dossier')}}",
                            data: {
                               
                                'id_dossier': $('.did_dossier').text()
                            },
                            dataType: "json",
                             beforeSend: function(){
                                 $('.blockMeI').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                            },
                            complete: function(){
                                $('.blockMeI').unblock();
                            }
                        })
                        .done(function(msg){

                       tab_liste =  JSON.parse(msg['examens_dossier']);
                           if (tab_liste[0] != null) {
                                for(i=0;i < tab_liste.length;i++){
                                     
                                   for (var j=0;j<tab_exam.length;j++){
                                    if(tab_liste[i].code_examen == tab_exam[j].id){
                                      var lMat = tab_exam[j].libelle_examen;
                                    }
                                   }

                                    var data = [
                                           tab_liste[i].code_examen,
                                            tab_liste[i].quantite,
                                           lMat,
                                           tab_liste[i].prix_unitaire,
                                           tab_liste[i].prix_total,
                                           tab_liste[i].reduction,
                                           tab_liste[i].prix_net,
                                           tab_liste[i].delai
                                                      ];
                                                      var rowIndex = $('#tab_LED').dataTable().fnAddData(data);
                                                      var row = $('#tab_LED').dataTable().fnGetNodes(rowIndex);
                                                      $(row).attr( 'id','item' + tab_liste[i].code_examen);
                                                      var tr = $("#tab_LED tr#item"+ tab_liste[i].code_examen);
                                                      tr.find('td:eq(0)').addClass('text-left');
                                                      tr.find('td:eq(1)').addClass('text-left');
                                                      tr.find('td:eq(2)').addClass('text-left');
                                                      tr.find('td:eq(3)').addClass('text-left');
                                                      tr.find('td:eq(4)').addClass('text-left');
                                                      tr.find('td:eq(5)').addClass('text-left');
                                                      tr.find('td:eq(6)').addClass('text-left');
                                                      tr.find('td:eq(7)').addClass('text-left');
                                }
                                 
                               
                              }
            });

     });

     $("#valP").click(function(){
        if(validate()){

                 $.ajax({
              type: 'post',
              url: " {{ route('dashboard_regler_impaye') }} ",
              data: {
                  'id_dossier' : $(".did_dossier").text(),
                  'numero_facture': $('#numero_facture').val(),
                  'id_editeur' :  $('#agent').val(),
                  'date' : $('#dateJ').val()
              }
          })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                                $("#ModPaye input").val('');
                              
                              $("#ModPaye").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                          $('#tabCAQ').dataTable().fnClearTable()
                           $("#ModPaye input").val('');
                              $("#ModPaye").modal('hide');
                               $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                               tab_dossier = JSON.parse(msg['dossiers']);
                              $("#total").val(formatMoney(JSON.parse(msg['total'])));
                               for(i=0;i < tab_dossier.length;i++){
                                 var data = [
                                        pad(tab_dossier[i].id_dossier,6),
                                        tab_dossier[i].patient,
                                        tab_dossier[i].date_dossier,
                                        tab_dossier[i].heure_dossier,
                                        tab_dossier[i].edite_par,
                                        tab_dossier[i].montant
                                        ];
                                var rowIndex = $('#tabCAQ').dataTable().fnAddData(data);
                                var row = $('#tabCAQ').dataTable().fnGetNodes(rowIndex);
                                $(row).attr( 'id','item' + tab_dossier[i].id_dossier); 
                                var tr = $("#tabCAQ tr#item"+tab_dossier[i].id_dossier);
                                tr.css("cursor","pointer");
                                tr.find('td:eq(0)').addClass('text-left');
                                tr.find('td:eq(1)').addClass('text-left');
                                tr.find('td:eq(2)').addClass('text-left');
                                tr.find('td:eq(3)').addClass('text-left');

                                tr.find('td:eq(4)').addClass('text-left');
                                tr.find('td:eq(5)').addClass('text-left');
                                               
                              }
                               if($("#tabCAQ").dataTable().fnSettings().aoData.length===0) {
                                    $("#btnPrint").attr("disabled","disabled");

                              }else{
                                    $("#btnPrint").removeAttr("disabled");
                              }
                             
                        }
                         
                       
                        
            });
        }
     })
          $('.mdcP').click(function(){
            $('#tab_LED').dataTable().fnClearTable();
            $("#ModPaye").modal("hide");
            });
@endsection