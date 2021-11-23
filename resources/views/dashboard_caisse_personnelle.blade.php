@extends("dashboard")

@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
        
</script>
<div class="tab-content">
   <div class="row" style="margin-bottom:15px; margin-top:15px;">
           
             
      <div class="form-group">
          <label class="col-sm-1 control-label" >DU</label>
          <div class="col-sm-2">
              <input class="form-control" type="date" id="du">
          </div>
          <label class="col-sm-1 control-label" >AU</label>
          <div class="col-sm-2">
              <input class="form-control" type="date" id="au">
          </div>
          <div class="col-sm-1">
                <button style="margin-right:5px" id="btnOK" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> OK</button>   
          </div>
          <div class="col-sm-1">
                <button style="margin-right:5px" id="btnPrint" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Imprimer</button>   
          </div>
      </div>
      
            
    </div>
    <legend>Caisse</legend>
    <table id="tabCP" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMeMF">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">CAISSE PERSONNELLE</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              <th class="text-left">Agent</th>
              <th class="text-left">Dossier</th>
              <th class="text-left">Patient</th>
              <th class="text-left">Total</th>
              <th class="text-left">Red(%)</th>
              <th class="text-left">Cash</th>
              <th class="text-left">Reste</th>
              <th class="text-left">Règlement</th>
              <th class="text-left">N° Chèque/CB</th>
              <th class="text-left">Banque</th>
            </tr>
          </thead>  
        </table>  
        <div class="row">
            <div class="form-group">
                <label class="col-sm-3 col-sm-offset-1 control-label" style="color:red;font-size:1.5em">CAISSE (F CFA)</label>
                <div class="col-sm-2 col-sm-offset-1">
                    <input  style="color:blue;font-size:1.4em" disabled id="Ttotal" class="form-control" type="text">  
                </div>
                <div class="col-sm-2">
                    <input style="color:blue;font-size:1.4em" disabled id="Tcash" class="form-control" type="text">
                </div>
                
            </div>
        </div>
     
</div>

@endsection

@section('activeCPE')
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
                            dataType: "json",
                            complete: function(){
                                $.ajax({
                                url: "{{route('dashboard_get_caisse_personnelle')}}",
                                dataType: "json",
                                data: {
                                   
                                    'date_debut' : $("#du").val(),
                                    'date_fin' : $("#au").val()
                                },
                                beforeSend: function(){
                                 $('.blockMeMF').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                                },
                                complete: function(){
                                    $('.blockMeMF').unblock();
                                }
                            })
                            .done(function(msg){
                                var tab = JSON.parse(msg['result']);
                                $("#Ttotal").val( formatMoney(JSON.parse(msg['total2'])) );
                                $("#Tcash").val( formatMoney(JSON.parse(msg['total1'])) );
                                for(i=0;i < tab.length;i++){
                                var data = [
                                        tab[i].agent,
                                        pad(tab[i].dossier,6),
                                        tab[i].patient,
                                        tab[i].total,
                                        tab[i].reduction,
                                        tab[i].cash,
                                        tab[i].reste,
                                        tab[i].reglement,
                                        tab[i].NCheque,
                                        tab[i].NBanque,
                                        ];
                                var rowIndex = $('#tabCP').dataTable().fnAddData(data);
                                var row = $('#tabCP').dataTable().fnGetNodes(rowIndex);
                                $(row).attr( 'id','item' + tab[i].numero); 
                                var tr = $("#tabCP tr#item"+tab[i].numero);
                                tr.find('td:eq(0)').addClass('text-left');
                                tr.find('td:eq(1)').addClass('text-left');
                                tr.find('td:eq(2)').addClass('text-left');
                                tr.find('td:eq(3)').addClass('text-left');
                                tr.find('td:eq(4)').addClass('text-left');
                                tr.find('td:eq(5)').addClass('text-left');
                                tr.find('td:eq(6)').addClass('text-left');
                                tr.find('td:eq(7)').addClass('text-left');
                                tr.find('td:eq(8)').addClass('text-left');
                                tr.find('td:eq(9)').addClass('text-left');
                                               
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
                "aLengthMenu": [[2, 4, 5, -1], [2, 4, 5, "All"]],
                "iDisplayLength": 4
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    
     $('#btnPrint').click(function(){
            
            window.open("{{ route('dashboard_evolution_ca_quotidien_impression') }}");
    });
    $("#btnOk").click(function(){
              $('#tabCP').dataTable().fnClearTable();
             $.ajax({
                                url: "{{route('dashboard_get_caisse_personnelle')}}",
                                dataType: "json",
                                data: {
                                   
                                    'date_debut' : $("#du").val(),
                                    'date_fin' : $("#au").val()
                                },
                                beforeSend: function(){
                                 $('.blockMeMF').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                                },
                                complete: function(){
                                    $('.blockMeMF').unblock();
                                }
                            })
                            .done(function(msg){
                                var tab = JSON.parse(msg['result']);
                                $("#Ttotal").val( formatMoney(JSON.parse(msg['total2'])) );
                                $("#Tcash").val( formatMoney(JSON.parse(msg['total1'])) );
                                for(i=0;i < tab.length;i++){
                                var data = [
                                        tab[i].agent,
                                        pad(tab[i].dossier,6),
                                        tab[i].patient,
                                        tab[i].total,
                                        tab[i].reduction,
                                        tab[i].cash,
                                        tab[i].reste,
                                        tab[i].reglement,
                                        tab[i].NCheque,
                                        tab[i].NBanque,
                                        ];
                                var rowIndex = $('#tabCP').dataTable().fnAddData(data);
                                var row = $('#tabCP').dataTable().fnGetNodes(rowIndex);
                                $(row).attr( 'id','item' + tab[i].numero); 
                                var tr = $("#tabCP tr#item"+tab[i].numero);
                                tr.find('td:eq(0)').addClass('text-left');
                                tr.find('td:eq(1)').addClass('text-left');
                                tr.find('td:eq(2)').addClass('text-left');
                                tr.find('td:eq(3)').addClass('text-left');
                                tr.find('td:eq(4)').addClass('text-left');
                                tr.find('td:eq(5)').addClass('text-left');
                                tr.find('td:eq(6)').addClass('text-left');
                                tr.find('td:eq(7)').addClass('text-left');
                                tr.find('td:eq(8)').addClass('text-left');
                                tr.find('td:eq(9)').addClass('text-left');
                                               
                              }
                                
                            });    

    });
@endsection