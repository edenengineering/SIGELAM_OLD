@extends("dashboard")
@section('add_style')
 .align-right{text-align:right;max-width:80px} 
 .align-left{text-align:left;max-width:80px} 
 .align-center{text-align:center;max-width:80px} 
@endsection
@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
                function validate() {
    
    var valid = true;
    valid = checkEmpty($("#annee"));
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
          <label class="col-sm-1 control-label" >Année <br> <span class="annee-validation validation-error"></label>
          <div class="col-sm-2">
              <input class="form-control" min="0" type="number" name="annee" id="annee">
          </div>
         
          <div class="col-sm-1">
                <button style="margin-right:5px" id="btnOk" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> OK</button>   
          </div>
          <div class="col-sm-1">
                <button style="margin-right:5px" id="btnPrint" disabled="disabled" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Imprimer</button>   
          </div>

          <label class="col-sm-1 col-sm-offset-1 control-label" style="color:red;font-size:1.4em" >Total </label>
          <div class="col-sm-3">
              <input class="form-control" style="color:red;font-size:1.4em" disabled="disabled" type="text" name="total" min="0" id="total">
          </div>
      </div>
      
            
    </div>
  <table id="tabCAM" style="width:100%; heigth:60%" class="table table-striped table-responsive">
           <caption id="cap">
              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">CHIFFRE D'AFFAIRE MENSUEL</h4>
          </caption>   
           
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              <th class="text-left">Mois</th>
               <th class="text-left">Analyses</th>
              <th class="text-left">Nbre</th>
             
              <th class="text-left">Total CA</th>
              
            </tr>
          </thead>
          
            
        </table>  
  
     
</div>

@endsection

@section('another')
$('#tabCAM').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 10,
                 "columnDefs": [
                { className: "align-left","targets": [0,1]},
                { className: "align-center","targets": [2,3]}
              ],
                dom: 'Blfrtip',
                buttons: [
                        {
                          extend : 'excel',
                          text : 'Export Vers Excel',
                          className: 'btnExcel',
                          title : "EVOLUTION CHIFFRE D'AFFAIRE MENSUEL"
                        }
                           
                      ]
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    
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
      $("#btnOk").click(function(){
      if(validate()){
               $.ajax({
                        url: "{{route('dashboard_evolution_ca_mensuel_get')}}",
                        dataType: "json",
                        data: {
                           
                            'annee' : $("#annee").val()
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
                              $('#tabCAM').dataTable().fnClearTable();
                              $("#total").val("");
                              var tab = JSON.parse(msg['analyses']);
                              $("#total").val(formatMoney(JSON.parse(msg['total'])));
                               for(i=0;i < tab.length;i++){
                                 var data = [
                                        tab[i].mois,
                                        tab[i].analyse,
                                        tab[i].nombre,
                                        tab[i].montant
                                        ];
                                var rowIndex = $('#tabCAM').dataTable().fnAddData(data);
                                var row = $('#tabCAM').dataTable().fnGetNodes(rowIndex);
                                $(row).attr( 'id','item' + i); 
                                var tr = $("#tabCAM tr#item"+i);
                                tr.find('td:eq(0)').addClass('text-left');
                                tr.find('td:eq(1)').addClass('text-left');
                                tr.find('td:eq(2)').addClass('text-center');
                                tr.find('td:eq(3)').addClass('text-center');
                                               
                              }
                               if($("#tabCAM").dataTable().fnSettings().aoData.length===0) {
                                    $("#btnPrint").attr("disabled","disabled");

                              }else{
                                    $("#btnPrint").removeAttr("disabled");
                              }
                             

                              }); 
      }
    })

     $('#btnPrint').click(function(){
            
            window.open("{{ route('dashboard_evolution_ca_mensuel_impression') }}?annee="+$("#annee").val());
    });
@endsection