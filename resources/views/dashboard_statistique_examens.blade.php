@extends("dashboard")

@section('add_style')
 .align-right{text-align:right;max-width:80px} 
 .align-left{text-align:left;max-width:80px} 
 .align-center{text-align:center;max-width:80px}
 table,th,td{
        border: 1px solid black!important;
 } 
table.dataTable thead th, table.dataTable thead td {
  padding-left: 10px;
  border-bottom: 1px solid #111;
}
table.dataTable tbody td {
  padding-left: 2px;
   width:100%;
    white-space:nowrap;
  border-bottom: 1px solid #111;
}
 table thead th.no-border {
        border-left: solid 1px #FFF!important;
        border-top: solid 1px #FFF!important;
 }
  table thead th.no-border1 {
        border-left: solid 1px #FFF!important;
        border-top: solid 1px #FFF!important;
         border-bottom: solid 1px #FFF!important;
 }
   table tfoot th.no-border1 {
        border-left: solid 1px #FFF!important;
        border-bottom: solid 1px #FFF!important;
 }
@endsection
@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
       function validate() {
    
    var valid = true;
    valid = valid && checkEmpty($("#du"));
    valid = valid && checkEmpty($("#au"));
    valid = valid && checkEmpty($("#examen"));
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
               <legend> <h4 class="text-left" style="color:rgb(51,122,183); font-weight: bold;">STATISTIQUE GENERALE DES EXAMENS</h4></legend>

    <div class="row" style="margin-bottom:15px; margin-top:15px;">
           
          
              <div class="col-sm-3">
                <div class="form-group">
                    <label class="col-sm-8 control-label" >DU <span class="du-validation validation-error"></span></label>
                    <div class="col-sm-12">
                        <input class="form-control" type="date" id="du" name="du">
                    </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                    <label class="col-sm-8 control-label" >AU <span class="au-validation validation-error"></span></label>
                    <div class="col-sm-12">
                        <input class="form-control" type="date" id="au" name="au">
                    </div>
                </div>
             </div> 
            <div class="col-sm-4">
              <div class="form-group"> 
                     <label for="examen" class="control-label col-sm-8 text-left" style="padding-left:30px">Examens : <span class="examen-validation validation-error"></span></label>
                     <div class="col-sm-11" style="padding-left:30px;">
                       <select class="form-control" name="examen" id="examen">
                         <option value="" class="text-center">--- Choix de l'examen ---</option>
                         <option value="17">TDR Paludisme</option>
                         <option value="18">Gouttes Epaisses</option>
                         <option value="6">Anticorps HCV (Hépatite "C") </option>
                         <option value="5">Antigène Hbs (Hépatite "B")</option>
                         <option value="500">VIH</option>
                       </select>
                     </div>
                     <div class="col-sm-1">
                          <button  id="btnOk" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> OK</button>   
                    </div>
                 
                  </div>
            </div>
    </div>
    <div class="row table-responsive"  >
         <table id="tabSP" style="width:100%;table-layout : fixed;" class=" table table-bordered table-responsive blockMe">
            <caption></caption>
           
          <thead style="margin-top:50px;   -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  >
              <th class="no-border1" rowspan="2" ></th>
              <th colspan="2" >0-11 ms</th>
              <th colspan="2" >12-24 ms</th>
              <th colspan="2" >25-59 ms</th>
              <th colspan="2" >5-9 ans</th>
              <th colspan="2" >10-14</th>
              <th colspan="2" >15-19</th>
              <th colspan="2" >20-24</th>
              <th colspan="2" >25-29</th>
              <th colspan="2" >30-34</th>
              <th colspan="2" >35-39</th>
              <th colspan="2" >40-44</th>
              <th colspan="2" >45-49</th>
              <th colspan="2" >50-64</th>
              <th colspan="2" >65 et +</th>
              <th colspan="2" >Total</th>
            </tr>
            <tr>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
            </tr>
            
          </thead>
           <tr id="enceinte">
              <td class='' style='font-weight:bold;' >F En</td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
            </tr>
            <tr id="femme">
              <td class='' style='font-weight:bold'>F</td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
            </tr>
            <tr id="homme">
            <td class='' style='font-weight:bold'>H</td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
            </tr>
            <tr id="total">
             <td class='' style='font-weight:bold'>T</td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
            </tr>
          <tfoot>
            <tr  >
              <th class="no-border1" rowspan="" ></th>
              <th colspan="2" >0-11 ms</th>
              <th colspan="2" >12-24 ms</th>
              <th colspan="2" >25-59 ms</th>
              <th colspan="2" >5-9 ans</th>
              <th colspan="2" >10-14</th>
              <th colspan="2" >15-19</th>
              <th colspan="2" >20-24</th>
              <th colspan="2" >25-29</th>
              <th colspan="2" >30-34</th>
              <th colspan="2" >35-39</th>
              <th colspan="2" >40-44</th>
              <th colspan="2" >45-49</th>
              <th colspan="2" >50-64</th>
              <th colspan="2" >65 et +</th>
              <th colspan="2" >Total</th>
            </tr>
          </tfoot>
        </table>  
        <table id="tabSP1" style="width:100%;" class=" table table-bordered table-responsive blockMe">
            <caption></caption>
           
          <thead style="margin-top:50px;   -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  >
              <th class="no-border1" rowspan='2' ></th>
              <th colspan='3' >0-11 ms</th>
              <th colspan='3' >12-24 ms</th>
              <th colspan='3' >25-59 ms</th>
              <th colspan='3' >5-9 ans</th>
              <th colspan='3' >10-14</th>
              <th colspan='3' >15-19</th>
              <th colspan='3' >20-24</th>
              <th colspan='3' >25-29</th>
              <th colspan='3' >30-34</th>
              <th colspan='3' >35-39</th>
              <th colspan='3' >40-44</th>
              <th colspan='3' >45-49</th>
              <th colspan='3' >50-64</th>
              <th colspan='3' >65 et +</th>
              <th colspan='3' >Total</th>
            </tr>
            <tr>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
              <th class="text-center">N</th>
              <th class="text-center">P</th>
<th class="text-center">I</th>
            </tr>
            
          </thead>
           <tr id="enceinte1">
              <td class='' style='font-weight:bold;' >F En</td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
            </tr>
            <tr id="femme1">
              <td class='' style='font-weight:bold'>F</td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
            </tr>
            <tr id="homme1">
            <td class='' style='font-weight:bold'>H</td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
            </tr>
            <tr id="total1">
             <td class='' style='font-weight:bold'>T</td>
             <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
            </tr>
          <tfoot>
            <tr  >
              <th class="no-border1" rowspan='' ></th>
              <th colspan='3' >0-11 ms</th>
              <th colspan='3' >12-24 ms</th>
              <th colspan='3' >25-59 ms</th>
              <th colspan='3' >5-9 ans</th>
              <th colspan='3' >10-14</th>
              <th colspan='3' >15-19</th>
              <th colspan='3' >20-24</th>
              <th colspan='3' >25-29</th>
              <th colspan='3' >30-34</th>
              <th colspan='3' >35-39</th>
              <th colspan='3' >40-44</th>
              <th colspan='3' >45-49</th>
              <th colspan='3' >50-64</th>
              <th colspan='3' >65 et +</th>
              <th colspan='3' >Total</th>
            </tr>
          </tfoot>
        </table>  
    </div>
  
</div>
@endsection


@section('anotherLoad')
  
                  function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 
                     $("#tabSP_wrapper").removeClass("hidden");
                              $("#tabSP1_wrapper").removeClass("hidden");
                              $("#tabSP1_wrapper").addClass("hidden");
                 

                   
@endsection
@section('another')
  function getExportFileName(){
  
 return 'STATISTIQUES EXAMENS ' + $("#examen option:selected").text();
}
 function getExportFileName1(){
  
 return 'STATISTIQUES EXAMEN '+ $("#examen option:selected").text();
}
    var tableD = $('#tabSP').DataTable({
                 responsive: true,
                 "searching": false,
                 "lengthChange": false,
                 "bSort" : false,
                dom: 'Blfrtip',
                buttons: [
                        {
                           extend : 'excel',
                          filename: function () { return getExportFileName1();},
                          title : function () { return getExportFileName1();},
                          text : 'Export vers Excel',
                          orientation: 'landscape',
                          pageSize: 'LEGAL',
                          footer : true,
                          className: 'btnExcel',
                          
                        },
                         {
                          extend : 'print',
                          filename: function () { return getExportFileName1();},
                          title : function () { return getExportFileName1();},
                          text : 'Imprimer',
                          orientation: 'landscape',
                          pageSize: 'LEGAL',
                          footer : true,
                          autoPrint: true,
                          className: 'btnExcel',
                          customize: function (win) { 
                            $(win.document.body).find('table').addClass('display').css('font-size', '11px');
                           
                            $(win.document.body).find('tr:nth-child(odd) td').each(function(index){
                                $(this).css('text-align','left');
                                 $(this).css('padding','0');
                            });
                            $(win.document.body).find('tr:nth-child(odd) th').each(function(index){
                                $(this).css('text-align','left');
                                 $(this).css('padding','1');
                            });
                            
                            $(win.document.body).find('h1').css('text-align','center');

                          }
                        },
                         
                           
                      ]
            });
       var tableD1 = $('#tabSP1').DataTable({
                 responsive: true,
                 "searching": false,
                 "lengthChange": false,
                 "bSort" : false,
                dom: 'Blfrtip',
                buttons: [
                        {
                           extend : 'excel',
                          filename: function () { return getExportFileName1();},
                          title : function () { return getExportFileName1();},
                          text : 'Export vers Excel',
                          orientation: 'landscape',
                          pageSize: 'LEGAL',
                          footer : true,
                          className: 'btnExcel',
                         
                        },
                         {
                          extend : 'print',
                          filename: function () { return getExportFileName1();},
                          title : function () { return getExportFileName1();},
                          text : 'Imprimer',
                          orientation: 'landscape',
                          pageSize: 'LEGAL',
                          footer : true,
                          autoPrint: true,
                          className: 'btnExcel',
                          customize: function (win) { 
                            $(win.document.body).find('table').addClass('display').css('font-size', '9px');
                           
                            $(win.document.body).find('tr:nth-child(odd) td').each(function(index){
                                $(this).css('text-align','left');
                                 $(this).css('padding','0');
                            });
                             $(win.document.body).find('tr:nth-child(odd) th').each(function(index){
                                $(this).css('text-align','left');
                                 $(this).css('padding','0');
                            });
                            $(win.document.body).find('h1').css('text-align','center');
                             var last = null;
                var current = null;
                var bod = [];
 
                var css = '@page { size: landscape; }',
                    head = win.document.head || win.document.getElementsByTagName('head')[0],
                    style = win.document.createElement('style');
 
                style.type = 'text/css';
                style.media = 'print';
 
                if (style.styleSheet)
                {
                  style.styleSheet.cssText = css;
                }
                else
                {
                  style.appendChild(win.document.createTextNode(css));
                }
 
                head.appendChild(style);
                          }
                        },
                         
                           
                      ]
              
            });
    $("#btnOk").click(function(){
      if(validate()){
         
          $.ajax({
                        dataType:'json',
                        type : "POST",
                        data: { 
                          'date_debut' : $("#du").val(),
                          'date_fin' : $("#au").val(),
                          'id_examen' : $("#examen").val()
                           },
                        url: "{{ route("dashboard_get_liste_generale_examens") }}",
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
                           var enceintes = JSON.parse(msg['enceintes']);
                            var hommes = JSON.parse(msg['hommes']);
                             var femmes = JSON.parse(msg['femmes']);
                  if($("#examen").val() != 500){
                          $("#tabSP_wrapper").removeClass("hidden");
                              $("#tabSP1_wrapper").removeClass("hidden");
                              $("#tabSP1_wrapper").addClass("hidden");
                           var tr = $("#tabSP tr#enceinte");
                           var SN = 0;
                           var SP = 0;
                            for(var i= 0; i < enceintes.length; i++ ){
                                   tr.find('td:eq('+ (i+1) +')').html(""+ enceintes[i]);
                                 
                                    if(i%2 == 0){
                                          SN = SN + parseInt(enceintes[i]);
                                    }else{
                                          SP = SP + parseInt(enceintes[i]);
                                    }                      
                           }
                           tr.find('td:eq(29)').html(""+ SN);
                           tr.find('td:eq(30)').html(""+ SP);
                            $('#tabSP').DataTable().rows( $("#tabSP tr#enceinte") ).invalidate().draw();
                            var tr = $("#tabSP tr#femme");
                           var SN1 = 0;
                           var SP1 = 0;
                            for(var i= 0; i < femmes.length; i++ ){
                                   tr.find('td:eq('+ (i+1) +')').html(""+ femmes[i]);
                                 
                                    if(i%2 == 0){
                                          SN1 = SN1 + parseInt(femmes[i]);
                                    }else{
                                          SP1 = SP1 + parseInt(femmes[i]);
                                    }                      
                           }
                           tr.find('td:eq(29)').html(""+ SN1);
                           tr.find('td:eq(30)').html(""+ SP1);
                            $('#tabSP').DataTable().rows( $("#tabSP tr#femme") ).invalidate().draw();
                             var tr = $("#tabSP tr#homme");
                           var SN2 = 0;
                           var SP2 = 0;
                            for(var i= 0; i < hommes.length; i++ ){
                                   tr.find('td:eq('+ (i+1) +')').html(""+ hommes[i]);
                                 
                                    if(i%2 == 0){
                                          SN2 = SN2 + parseInt(hommes[i]);
                                    }else{
                                          SP2 = SP2 + parseInt(hommes[i]);
                                    }                      
                           }
                           tr.find('td:eq(29)').html(""+ SN2);
                           tr.find('td:eq(30)').html(""+ SP2);
                            $('#tabSP').DataTable().rows( $("#tabSP tr#homme") ).invalidate().draw();
                            
                            var total = [];
                           for(var i = 0; i < enceintes.length; i++ ){
                                total.push( parseInt(enceintes[i]) + parseInt(femmes[i]) + parseInt(hommes[i]) );
                           }
                           var tr = $("#tabSP tr#total");
                           for(var i= 0; i < total.length; i++ ){
                                   tr.find('td:eq('+ (i+1) +')').html(""+ total[i]);
                                                      
                           }
                           tr.find('td:eq(29)').html(""+ (SN2 + SN1 + SN));
                           tr.find('td:eq(30)').html(""+ (SP2+ SP1 + SP));
                             $('#tabSP').DataTable().rows( $("#tabSP tr#total") ).invalidate().draw();
                          
                  }else{
                              $("#tabSP1_wrapper").removeClass("hidden");
                              $("#tabSP_wrapper").removeClass("hidden");
                              $("#tabSP_wrapper").addClass("hidden");
                               var tr = $("#tabSP1 tr#enceinte1");
                           var SN = 0;
                           var SP = 0;
                           var SI = 0;
                            for(var i= 0; i < enceintes.length; i++ ){
                                   tr.find('td:eq('+ (i+1) +')').html(""+ enceintes[i]);
                                   tr.find('td:eq('+ (i+1) +')').css("text-align","center");
                                    if(i%3 == 0){
                                          SN = SN + parseInt(enceintes[i]);
                                    }else if((i-1)%3 == 0){
                                          SP = SP + parseInt(enceintes[i]);
                                    }else if((i+1)%3 == 0){
                                          SI = SI + parseInt(enceintes[i]);
                                    }                      
                           }
                           tr.find('td:eq(43)').html(""+ SN);
                           tr.find('td:eq(44)').html(""+ SP);
                           tr.find('td:eq(45)').html(""+ SI);
                           $('#tabSP1').DataTable().rows( $("#tabSP1 tr#enceinte1") ).invalidate().draw();
                           var tr = $("#tabSP1 tr#femme1");
                           var SN1 = 0;
                           var SP1 = 0;
                           var SI1 = 0;
                           for(var i= 0; i < femmes.length; i++ ){

                                   tr.find('td:eq('+ (i+1) +')').html(""+ femmes[i]);
                                   tr.find('td:eq('+ (i+1) +')').css("text-align","center");
                                   if(i%3 == 0){
                                          SN1 = SN1 + parseInt(femmes[i]);
                                    }else if((i-1)%3 == 0){
                                          SP1 = SP1 + parseInt(femmes[i]);
                                    }else if((i+1)%3 == 0){
                                          SI1 = SI1 + parseInt(femmes[i]);
                                    }                      
                           }
                           tr.find('td:eq(43)').html(""+ SN1);
                           tr.find('td:eq(44)').html(""+ SP1);
                           tr.find('td:eq(45)').html(""+ SI1);
                            $('#tabSP1').DataTable().rows( $("#tabSP1 tr#femme1") ).invalidate().draw();
                             var tr = $("#tabSP1 tr#homme1");
                           var SN2 = 0;
                           var SP2 = 0;
                           var SI2 = 0;
                            for(var i= 0; i < hommes.length; i++ ){
                                   tr.find('td:eq('+ (i+1) +')').html(""+ hommes[i]);
                                   tr.find('td:eq('+ (i+1) +')').css("text-align","center");
                                    if(i%3 == 0){
                                          SN2 = SN2 + parseInt(hommes[i]);
                                    }else if((i-1)%3 == 0){
                                          SP2 = SP2 + parseInt(hommes[i]);
                                    }else if((i+1)%3 == 0){
                                          SI2 = SI2 + parseInt(hommes[i]);
                                    }                      
                           }
                           tr.find('td:eq(43)').html(""+ SN2);
                           tr.find('td:eq(44)').html(""+ SP2);
                           tr.find('td:eq(45)').html(""+ SI2);
                            $('#tabSP1').DataTable().rows( $("#tabSP1 tr#homme1") ).invalidate().draw();
                            
                            var total = [];
                           for(var i = 0; i < enceintes.length; i++ ){
                                total.push( parseInt(enceintes[i]) + parseInt(femmes[i]) + parseInt(hommes[i]) );
                           }
                           var tr = $("#tabSP1 tr#total1");
                           for(var i= 0; i < total.length; i++ ){
                                   tr.find('td:eq('+ (i+1) +')').html(""+ total[i]);
                                   tr.find('td:eq('+ (i+1) +')').css("text-align","center");
                           }
                           tr.find('td:eq(43)').html(""+ (SN2 + SN1 + SN));
                           tr.find('td:eq(44)').html(""+ (SP2+ SP1 + SP));
                           tr.find('td:eq(45)').html(""+ (SI2+ SI1 + SI));
                             $('#tabSP1').DataTable().rows( $("#tabSP1 tr#total1") ).invalidate().draw();
                          }

                    });
      }
    })

@endsection

<script type="text/javascript">
   
  

</script>