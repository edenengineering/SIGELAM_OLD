@extends("dashboard")
@section('add_style')
 .align-right{text-align:right;max-width:80px} 
 .align-left{text-align:left;max-width:80px} 
 .align-center{text-align:center;max-width:80px} 
@endsection
@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
        var tab_prelevement;
        var tab_tube; 
    
</script>
<div class="tab-content">
          <div class="row" style="margin-bottom:15px; margin-top:15px;">
            <fieldset class="col-sm-11">
              <legend>Periode de Reference</legend>
              <div class="form-group">
                  <label class="control-label col-sm-1" for="nom_patient">DU</label>
                  <div class="col-sm-3">
                   <input type="date"  id="du" class="form-control">
                  </div>
                  <label class="control-label col-sm-1" for="nom_patient">AU</label>
                  <div class="col-sm-3">
                   <input type="date"  id="au" class="form-control">
                  </div>
                  <div class="col-sm-1">
                  <button id="btnSeach" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> OK</button></div>
                  <div class="col-sm-2">
                  <button id="btnPrintA" disabled="disabled" class="btn btn-primary "><i class="glyphicon glyphicon-print"></i> Imprimer Tout</button></div>
              </div>
            </fieldset>
            
          </div>
          <table id="tabCP" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMe">
          <!-- <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;"></h4>
          </caption>   -->
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th class="text-left">Groupe d'Examens</th>
            </tr>
          </thead>
          
        </table>
     
        </div>
@endsection
@section('activeCP')
active
@endsection
@section('anotherLoad')
  
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
                   $.ajax({
                            url: "{{route('dashboard_date')}}",
                            dataType: "json",
                            complete: function(){
                                $.ajax({
                                url: "{{route('dashboard_get_cahier_paillasse')}}",
                                dataType: "json",
                                data: {
                                   
                                    'date_debut' : $("#du").val(),
                                    'date_fin' : $("#au").val()
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
                            })
                            .done(function(msg){
                                
                                var tab = JSON.parse(msg['dossiers1']);
                               for(i=0;i < tab.length;i++){
                                 var data = [
                                        tab[i].libelle_groupe_examen
                                        ];
                                var rowIndex = $('#tabCP').dataTable().fnAddData(data);
                                var row = $('#tabCP').dataTable().fnGetNodes(rowIndex);
                                $(row).attr( 'id','item' + tab[i].id_groupe_examen); 
                                var tr = $("#tabCP tr#item"+tab[i].id_groupe_examen);
                                tr.css("cursor","pointer");
                                tr.find('td:eq(0)').addClass('text-left');
                                               
                              }
                               if($("#tabCP").dataTable().fnSettings().aoData.length===0) {
                                    $("#btnPrintA").attr("disabled","disabled");

                              }else{
                                    $("#btnPrintA").removeAttr("disabled");
                              }
                                
                              });     
                  
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
       $('#tabCP').DataTable({
       
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    $('div.dataTables_filter input').focus();
    $('#tabCP').on('dblclick', 'tr', function(event){
         if(this.cells[0].innerHTML != "Groupe d'Examens"){
         
            var str = $(this).attr('id');
          
            var res = str.substring(4);
            window.open("{{ route('dashboard_cahier_paillasse_impression') }}?id="+res+"&date_debut="+$("#du").val()+"&date_fin="+$("#au").val());
            
        }
     });
     $("#btnSeach").click(function(){
            if( ($("#du").val() != "") && ($("#au").val() != "")  ){
                $('#tabCP').dataTable().fnClearTable();
                    $.ajax({
                                  
                            url: "{{ route('dashboard_get_cahier_paillasse') }}",
                            data: {
                                'date_debut' : $("#du").val(),
                                'date_fin' : $("#au").val()
                            },
                            dataType: "json",
                             beforeSend: function(){
                                 $('.blockMe').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                            },
                            complete: function(){
                                $('.blockMe').unblock();
                            }
                        })
                        .done(function(msg){
                                
                                var tab = JSON.parse(msg['dossiers1']); 
                                for(i=0;i < tab.length;i++){
                                var data = [
                                        tab[i].libelle_groupe_examen
                                        ];
                                var rowIndex = $('#tabCP').dataTable().fnAddData(data);
                                var row = $('#tabCP').dataTable().fnGetNodes(rowIndex);
                                $(row).attr( 'id','item' + tab[i].id_groupe_examen); 
                                var tr = $("#tabCP tr#item"+tab[i].id_groupe_examen);
                                tr.css("cursor","pointer");
                                tr.find('td:eq(0)').addClass('text-left');
                                               
                              }
                                 if($("#tabCP").dataTable().fnSettings().aoData.length===0) {
                                    $("#btnPrintA").attr("disabled","disabled");
                                    
                              }else{
                                    $("#btnPrintA").removeAttr("disabled");
                              }
                            });  
            }
          });

          $("#btnPrintA").click(function(){
              window.open("{{ route('dashboard_cahier_paillasse_impression_all') }}?date_debut="+$("#du").val()+"&date_fin="+$("#au").val());
          });
@endsection