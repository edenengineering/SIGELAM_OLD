@extends("dashboard")

@section('add_style')
 .align-right{text-align:right;max-width:80px} 
 .align-left{text-align:left;max-width:80px} 
 .align-center{text-align:center;max-width:80px}
 table,th,td{
        border: 1px solid black!important;
        font-weigth:bold!important;
 } 
 table tbody td.no-border-left {
        border-left: solid 1px #FFF!important;
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
               <legend> <h4 class="text-left" style="color:rgb(51,122,183); font-weight: bold;">RESULTATS POSITIFS DE QUELQUES EXAMENS</h4></legend>
  
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
                         <option value="18">GE</option>
                         <option value="17">TDR</option>
                         <option value="3">BW (SYPHILIS) </option>
                         <option value="501">CRACHAT</option>
                         <option value="21">GONOCOCCIE</option>
                         <option value="11">CHLAMYDIALE</option>
                         <option value="2">ELECTROPHORESE</option>
                         <option value="35">PCR</option>
                       </select>
                     </div>
                     <div class="col-sm-1">
                          <button  id="btnOk" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> OK</button>   
                    </div>
                 
                  </div>
            </div>
     </div>
    <div class="row table-responsive" >
         <table id="tabSP" style="width:100%;" class="table table-bordered table-responsive blockMe">
            <caption></caption>
           
          <thead style="margin-top:50px;   -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
          
            <tr  >
              <th class="no-border1" rowspan="1" ></th>
              <th colspan="2" >Nbre Total des personnes testées</th>
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
              <th class="text-center" colspan="2" >50-54</th>
              <th class="text-center" colspan="2" >55-59</th>
              <th class="text-center" colspan="2" >60-64</th>
              <th class="text-center" colspan="2" >65 et +</th>
              <th class="text-center" colspan="2" >Total</th>
              <th class="text-center" colspan="" ></th>
            </tr>
            <tr id="Texam">
             <th class="no-border-left" style="color:rgb(51,122,183);" ></th>
             <th class="text-center" style="width:50px">M</th>
              <th class="text-center" style="width:50px">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center" colspan="">Total G</th>
            </tr>
           
            
          </thead>
             <tr id="autre">
              <td class="" >Autres Pers</td>
              <td class="text-center" style="width:50px"></td>
              <td class="text-center" style="width:50px"></td>
               <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
               <td class="" colspan="" ></td>
            </tr>
             <tr id="enceinte">
              <td class="" >Fem Enceintes</td>
               <td class="text-center" style="width:50px"></td>
              <td class="text-center" style="width:50px"></td>
               <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
               <td class="" colspan="" ></td>
            </tr>
            <tfoot>
             <tr >
              <th class="no-border1" rowspan="1" ></th>
              <th colspan="2" >Nbre Total des personnes testées</th>
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
              <th class="text-center" colspan="2" >50-54</th>
              <th class="text-center" colspan="2" >55-59</th>
              <th class="text-center" colspan="2" >60-64</th>
              <th class="text-center" colspan="2" >65 et +</th>
              <th class="text-center" colspan="2" >Total</th>
              <th class="text-center" colspan="" >Total G</th>
            </tr>
          </tfoot>
        </table>  
        <table id="tabSP1" style="width:100%;" class="table table-bordered table-responsive blockMe">
            <caption></caption>
           
          <thead style="margin-top:50px;   -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
          
            <tr  >
              <th class="no-border1" rowspan="1" ></th>
              <th colspan="2" >Nbre Total des personnes testées</th>
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
              <th class="text-center" colspan="2" >50-54</th>
              <th class="text-center" colspan="2" >55-59</th>
              <th class="text-center" colspan="2" >60-64</th>
              <th class="text-center" colspan="2" >65 et +</th>
              <th class="text-center" colspan="2" >Total</th>
              <th class="text-center" colspan="" ></th>
            </tr>
            <tr id="Texam1">
             <th class="no-border-left" style="color:rgb(51,122,183);" ></th>
             <th class="text-center" style="width:50px">M</th>
              <th class="text-center" style="width:50px">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center">M</th>
              <th class="text-center">F</th>
              <th class="text-center" colspan="">Total G</th>
            </tr>
           
            
          </thead>
             <tr id="AS">
              <td class="" >AS</td>
              <td class="text-center" style="width:50px"></td>
              <td class="text-center" style="width:50px"></td>
               <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
               <td class="" colspan="" ></td>
            </tr>
             <tr id="SS">
              <td class="" >SS</td>
               <td class="text-center" style="width:50px"></td>
              <td class="text-center" style="width:50px"></td>
               <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
               <td class="" colspan="" ></td>
            </tr>
            <tr id="FAS">
              <td class="" > Fem Enc(AS)</td>
              <td class="text-center" style="width:50px"></td>
              <td class="text-center" style="width:50px"></td>
               <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
               <td class="" colspan="" ></td>
            </tr>
             <tr id="FSS">
              <td class="" >F Enc(SS)</td>
               <td class="text-center" style="width:50px"></td>
              <td class="text-center" style="width:50px"></td>
               <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
              <td class="text-center"  ></td>
               <td class="" colspan="" ></td>
            </tr>
            <tfoot>
             <tr >
              <th class="no-border1" rowspan="1" ></th>
              <th colspan="2" >Nbre Total des personnes testées</th>
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
              <th class="text-center" colspan="2" >50-54</th>
              <th class="text-center" colspan="2" >55-59</th>
              <th class="text-center" colspan="2" >60-64</th>
              <th class="text-center" colspan="2" >65 et +</th>
              <th class="text-center" colspan="2" >Total</th>
              <th class="text-center" colspan="" >Total G</th>
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
      return 'RESULTATS POSITIFS ' + $("#examen option:selected").text() + ' du ' + $("#du").val() + ' au ' + $("#au").val();
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
            var tableD1 = $('#tabSP1').DataTable({
                 responsive: true,
                 "searching": false,
                 "lengthChange": false,
                 "bSort" : false,
                dom: 'Blfrtip',
                buttons: [
                        {
                           extend : 'excel',
                          filename: 'RESULTATS POSITIFS DE QUELQUES EXAMENS',
                          title : 'RESULTATS POSITIFS DE QUELQUES EXAMENS',
                          text : 'Export vers Excel',
                          footer : true,
                          className: 'btnExcel',
                          
                        },
                         {
                          extend : 'print',
                          filename: 'RESULTATS POSITIFS DE QUELQUES EXAMENS',
                          title : 'RESULTATS POSITIFS DE QUELQUES EXAMENS',
                          text : 'Imprimer',
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
                        url: "{{ route("dashboard_get_liste_examens_positifs") }}",
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
                            var autres = JSON.parse(msg['autres']);
                  if($("#examen").val() != 2){
                          $("#tabSP_wrapper").removeClass("hidden");
                              $("#tabSP1_wrapper").removeClass("hidden");
                              $("#tabSP1_wrapper").addClass("hidden");
                           
                           var tr = $("#tabSP tr#Texam");
                            tr.find('th:eq(0)').html(""+ $("#examen option:selected").text());
                            $('#tabSP').DataTable().rows( $("#tabSP tr#Texam") ).invalidate().draw();
                           var tr = $("#tabSP tr#autre");
                           var SN2 = 0;
                           var SP2 = 0;
                            for(var i= 0; i < autres.length; i++ ){
                                   tr.find('td:eq('+ (i+1) +')').html(""+ autres[i]);
                                   if(i>1){
                                    if(i%2 == 0){
                                          SN2 = SN2 + parseInt(autres[i]);
                                    }else{
                                          SP2 = SP2 + parseInt(autres[i]);
                                    }       
                                  }               
                           }
                           tr.find('td:eq(35)').html(""+ SN2);
                           tr.find('td:eq(36)').html(""+ SP2);
                             tr.find('td:eq(37)').html(""+ (SP2 + SN2));
                            $('#tabSP').DataTable().rows( $("#tabSP tr#autre") ).invalidate().draw();

                           var tr = $("#tabSP tr#enceinte");
                           var cp = 2;
                           var SN = 0;
                           var SP = 0;
                            for(var i= 0; i < enceintes.length; i++ ){
                                   
                                        tr.find('td:eq('+ (i+cp) +')').html(""+ enceintes[i]);
                                    if(i>1){
                                          SP = SP + parseInt(enceintes[i]);
                                    }
                                        cp++;
                                    
                                                         
                           }
                           tr.find('td:eq(36)').html(""+ SP);
                            tr.find('td:eq(37)').html(""+ SP);
                            $('#tabSP').DataTable().rows( $("#tabSP tr#enceinte") ).invalidate().draw();
                          
                          
                  }else{
                            var AS = JSON.parse(msg['AS']);
                            var SS = JSON.parse(msg['SS']);
                            var FAS = JSON.parse(msg['FAS']);
                            var FSS = JSON.parse(msg['FSS']);
                              $("#tabSP1_wrapper").removeClass("hidden");
                              $("#tabSP_wrapper").removeClass("hidden");
                              $("#tabSP_wrapper").addClass("hidden");
                              var tr = $("#tabSP1 tr#Texam1");
                            tr.find('th:eq(0)').html(""+ $("#examen option:selected").text());
                            $('#tabSP1').DataTable().rows( $("#tabSP1 tr#Texam1") ).invalidate().draw();
                           var tr = $("#tabSP1 tr#AS");
                           var SN2 = 0;
                           var SP2 = 0;
                            for(var i= 0; i < AS.length; i++ ){
                                   tr.find('td:eq('+ (i+1) +')').html(""+ AS[i]);
                                 if(i>1){
                                    if(i%2 == 0){
                                          SN2 = SN2 + parseInt(AS[i]);
                                    }else{
                                          SP2 = SP2 + parseInt(AS[i]);
                                    }  
                                  }                    
                           }
                           tr.find('td:eq(35)').html(""+ SN2);
                           tr.find('td:eq(36)').html(""+ SP2);
                             tr.find('td:eq(37)').html(""+ (SP2 + SN2));
                            $('#tabSP1').DataTable().rows( $("#tabSP1 tr#AS") ).invalidate().draw();
                            var tr = $("#tabSP1 tr#SS");
                           var SN = 0;
                           var SP = 0;
                            for(var i= 0; i < SS.length; i++ ){
                                   tr.find('td:eq('+ (i+1) +')').html(""+ SS[i]);
                                 if(i>1){
                                    if(i%2 == 0){
                                          SN = SN + parseInt(SS[i]);
                                    }else{
                                          SP = SP + parseInt(SS[i]);
                                    }  
                                  }                    
                           }
                           tr.find('td:eq(35)').html(""+ SN);
                           tr.find('td:eq(36)').html(""+ SP);
                             tr.find('td:eq(37)').html(""+ (SP + SN));
                            $('#tabSP1').DataTable().rows( $("#tabSP1 tr#SS") ).invalidate().draw();
                            var tr = $("#tabSP1 tr#FAS");
                           var SN1 = 0;
                           var SP1 = 0;
                           var cp = 2;
                            for(var i= 0; i < FAS.length; i++ ){
                                   tr.find('td:eq('+ (i+cp) +')').html(""+ FAS[i]);
                                 if(i>1){
                                    
                                          SP1 = SP1 + parseInt(FAS[i]);
                                     
                                }   
                                cp++;                  
                           }
                           tr.find('td:eq(36)').html(""+ SP1);
                             tr.find('td:eq(37)').html(""+ SP1);
                            $('#tabSP1').DataTable().rows( $("#tabSP1 tr#FAS") ).invalidate().draw();
                          var tr = $("#tabSP1 tr#FSS");
                           var SN3 = 0;
                           var SP3 = 0;
                           cp = 2;
                            for(var i= 0; i < FSS.length; i++ ){
                                   tr.find('td:eq('+ (i+cp) +')').html(""+ FSS[i]);
                                 if(i>1){
                                    
                                          SP3 = SP3 + parseInt(FSS[i]);
                                    
                                  } 
                                  cp++;                     
                           }
                           tr.find('td:eq(36)').html(""+ SP3);
                             tr.find('td:eq(37)').html(""+ (SP3 + SN3));
                            $('#tabSP1').DataTable().rows( $("#tabSP1 tr#FSS") ).invalidate().draw();

                }

                    });
      }
    })
@endsection