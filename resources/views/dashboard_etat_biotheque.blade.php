@extends("dashboard")

@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
    function validate() {
    
    var valid = true;
    valid = checkEmpty($("#du"));
    valid = valid && checkEmpty($("#au"));
    valid = valid && checkEmpty($("#au"));
    valid = valid && checkEmpty($("#analyse"));
    valid = valid && checkEmpty($("#element"));
    valid = valid && checkEmpty($("#TR"));
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
               <legend> <h4 class="text-left" style="color:rgb(51,122,183); font-weight: bold;">ETAT DES BIOTHEQUES</h4></legend>

   <div class="row" style="margin-bottom:15px; padding-top:10px;margin-top:15px; height: 150px;border-radius:10px;background-color:rgb(238, 247, 240);">
            <div class="col-sm-5">
              <div class="row" style="">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-sm-9 control-label" >DU <span class="du-validation validation-error"></label>
                    <div class="col-sm-12">
                        <input class="form-control" type="date" name="du" id="du">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                  <label class="col-sm-9 control-label" >AU <span class="au-validation validation-error"></label>
                  <div class="col-sm-12">
                      <input class="form-control" type="date" name="au" id="au">
                  </div>
                </div>
                </div>
                
              </div>
              <div class="row">
                
                  <div class="form-group"> 
                     <label for="genre" class="control-label col-sm-3 text-left" style="padding-left:30px">Genre : <span class="genre-validation validation-error"></span></label>
                     <div class="col-sm-12" style="padding-left:30px;width:440px">
                       <select class="form-control" name="genre" id="genre">
                         <option value="tous">Tous</option>
                         <option value="hommes">Hommes</option>
                         <option value="femmes">Femmes</option>
                         <option value="enceintes">Femmes enceintes</option>
                       </select>
                     </div>

                 
                  </div>
              </div>
              
            </div>
            <div class="col-sm-3">
              <div class="row">
                <div class="form-group">
                  <label for="analyse" class="control-label col-sm-5 text-left">Analyse : <span class="analyse-validation validation-error"></span></label>
                  <div class="col-sm-12">
                      <select class="form-control" name="analyse" id="analyse" >
                        
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                 <div class="form-group">
                   <label for="element" class="control-label col-sm-5 text-left">Elements : <br /><span class="element-validation validation-error"></span></label>
                  <div class="col-sm-12">
                      <select class="form-control" name="element" id="element" >
                        
                      </select>
                  </div>
                 </div>
              </div>

            </div>
            <div class="col-sm-3">
              <div class="row">
                 <div class="form-group">
                   <label for="TR" class="control-label col-sm-8 text-left">Type resultats : <br /><span class="TR-validation validation-error"></span></label>
                  <div class="col-sm-12">
                      <select class="selectpicker" multiple data-selected-text-format="count" name="TR" id="TR" >

                      </select>
                  </div>
                 </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <label  class="control-label col-sm-8 text-left"><br /></span></label>
                  <div class="col-sm-12">
                    <button id="btnOK" class="btn btn-primary glyphicon glyphicon-refresh" style="width:100%"> OK</button>
                  </div>
                </div>
              </div>
            </div>
            
    </div>
    <div class="row" >
      <div class="col-sm-10" id="divT">
         <table id="tabSP" style="width:100%; heigth:60%; " class="table table-striped table-responsive">
            <caption></caption>
           
          <thead style="margin-top:50px;background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              
              <th class="text-left" style="width:200px">Tranche d'age</th>
              <th class="text-left">Total</th>
              <th class="text-center"></th>
              <th class="text-center"></th>
              <th class="text-center"></th>
            </tr>
          </thead>
            
        </table>  
      </div>
      <div class="col-sm-2" style="padding-top:10px">
          <div class="row" style="margin-bottom:20px">
            <button id="btnPrint" style="width:150px;" class="btn btn-primary btn-lg">
              <span class="glyphicon glyphicon-print"> Imprimer</span>
            </button>
         </div>
         <div class="row" style="margin-bottom:20px">
            <button id="btnExp" style="width:150px;" class="btn btn-success btn-lg">
              <span class="glyphicon glyphicon-export"> Exporter</span>
            </button>
         </div>
      </div>
    </div>
  
    
     
</div>
@endsection


@section('anotherLoad')
  
                  function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 

                 
                   $.ajax({
                            url: "{{route('dashboard_date')}}",
                            dataType: "json",
                            complete: function(){
                                
                                $.ajax({
                                  url: "{{route('dashboard_bilan_get_analyse')}}",
                                  dataType: "json",
                                  type: "get",
                                  data: { 'date_debut': $("#du").val(),
                                            'date_fin': $("#au").val(),
                                            'genre': $("#genre").val()
                                          }
                                  
                                  })
                                  .done(function(msg){
                                      var elmts = JSON.parse(msg['examens']);

                                      $("#form_dossier #analyse").find("option").remove();
                                      $("#form_dossier #element").find("option").remove(); 
                                       
                                       $('#analyse').append($('<option>',
                                           {
                                              value: '',
                                              text : "--- Choisissez l'examen ---",
                                              selected:true
                                          }));
                                      for(var i=0; i< elmts.length; i++){
                                             $('#analyse').append($('<option>',
                                           {
                                              value: elmts[i].id,
                                              text : elmts[i].examen
                                          }));
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
var table =  $('#tabSP').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                 "searching": false,
                 "lengthChange": false,
                  dom: 'Bfrtip',
                    buttons: [
                         'excel'
                    ]
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    $(".dt-button buttons-print").addClass("btn btn-primary");
    $(".dt-button buttons-excel").addClass("btn btn-success");
     
    function analyse(){
        $.ajax({
                            url: "{{route('dashboard_bilan_get_analyse')}}",
                            dataType: "json",
                            type: "get",
                            data: { 
                                      'date_debut': $("#du").val(),
                                      'date_fin': $("#au").val(),
                                      'genre': $("#genre").val()
                                    }
                            
              })
              .done(function(msg){
                  var elmts = JSON.parse(msg['examens']);

                  $("#analyse").find("option").remove();
                  $("#element").find("option").remove(); 
                  $("#TR").find("option").remove(); 
                   
                   $('#analyse').append($('<option>',
                       {
                          value: '',
                          text : "--- Choisissez l'examen ---",
                          selected:true
                      }));
                  for(var i=0; i< elmts.length; i++){
                         $('#analyse').append($('<option>',
                       {
                          value: elmts[i].id,
                          text : elmts[i].examen
                      }));
                  }
              });
    }

       function element(){
        $.ajax({
                            url: "{{route('dashboard_bilan_get_rendus')}}",
                            dataType: "json",
                            type: "get",
                            data: { 
                                      'date_debut': $("#du").val(),
                                      'date_fin': $("#au").val(),
                                      'genre': $("#genre").val(),
                                      'examen' : $("#analyse").val()
                              }
                            
              })
              .done(function(msg){
                  var elmts = JSON.parse(msg['rendus']);
                 
                  $("#element").find("option").remove(); 
                   $("#TR").find("option").remove(); 
                  
                   $('#element').append($('<option>',
                       {
                          value: '',
                          text : "--- Choisissez le rendu ---",
                          selected:true
                      }));
                  for(var i=0; i< elmts.length; i++){
                         $('#element').append($('<option>',
                       {
                          value: elmts[i].id,
                          text : elmts[i].libelle_rendu
                      }));
                  }
              });
    }

     function resultat(){
        $.ajax({
                            url: "{{route('dashboard_bilan_get_type_resultats')}}",
                            dataType: "json",
                            type: "get",
                            data: { 
                                      'date_debut': $("#du").val(),
                                      'date_fin': $("#au").val(),
                                      'genre': $("#genre").val(),
                                      'examen' : $("#analyse").val(),
                                      'rendu' : $("#element").val()
                              }
                            
              })
              .done(function(msg){
                  var elmts = JSON.parse(msg['resultats']);

                   $("#TR").find("option").remove(); 
                   
                  
                  for(var i=0; i < elmts.length; i++){
                  
                         $('#TR').append($('<option>',
                         {
                            value: elmts[i].id,
                            text : elmts[i].libelle_type_resultat
                          }));
                          $("#TR").selectpicker('refresh');
                  }
              });
    }

    
    $("#du").change(function(){
        if($("#au").val() != ""){
                analyse();
        }
    });
      
    $("#au").change(function(){
        if($("#du").val() != ""){
                analyse();
        }
    });

    $("#genre").change(function(){
        if(($("#au").val() != "") && ($("#du").val() != "")) {
                analyse();
        }
    });

        $("#analyse").change(function(){

            if($("#analyse").val() != "") {
                    element();
            }else{
                $("#element").find("option").remove(); 
            }
    });

      $("#element").change(function(){
            if($("#element").val() != "") {
                    resultat();
            }else{
                $("#TR").find("option").remove(); 
                $("#TR").selectpicker('refresh');
            }
    });

    $("#TR").change(function(){
          
          for(var i=2; i < 5; i++ ){
              var head_item = table.columns(i).header();
              $(head_item).html('');
          }
          var i=2;
          $("#TR option:selected").each(function () {
           var $this = $(this);
           if ($this.length) {
              var head_item = table.columns(i).header();
              $(head_item).html( $this.text());
                           
           }
           i++;
          });

        /* var tab = [];
        var i=2;
        tab[0] = "Tranche d'age"
        tab[1] = "Total"
          $("#TR option:selected").each(function () {
           var $this = $(this);
           if ($this.length) {
            tab[i] = $this.text();
             
           }
           i++;
          });
          
           var ble = $("#tabSP");
           
           $("#tabSP thead").remove();
           var tr = $("<tr></tr>");
           
           for(var i = 0; i < tab.length; i++){
                $("<th></th>").html("" + tab[i]).appendTo(tr);
           }
           var head = $("<thead></thead>");
           
           $(tr).appendTo(head);
           
           $(head).appendTo(ble);
           $(ble).appendTo($('#divT'));
           $("#tabSP thead").css("margin-top","50px");
           $("#tabSP thead").css("background-color","LightSlateGray");
           $("#tabSP thead").css("color","white");
           $("#tabSP thead").css("-webkit-box-shadow","0px -4px 3px rgba(50, 50, 50, 0.75)");
           $("#tabSP thead").css("-moz-box-shadow","0px -4px 3px rgba(50, 50, 50, 0.75)");
           $("#tabSP thead").css("box-shadow","0px -4px 3px rgba(50, 50, 50, 0.75)");
         table =  $('#tabSP').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                 "searching": false,
                 "lengthChange": false,
                  dom: 'Bfrtip',
                    buttons: [
                         'excel','print'
                    ]
            });*/ 

    });

     $("#btnOK").click(function(){
        if(validate()){
            tab = [];
            i = 0;
            $("#TR option:selected").each(function () {
             var $this = $(this);
             if ($this.length) {
              tab[i] = $this.text();
               
             }
             i++;
            });
             $.ajax({
                            url: "{{route('dashboard_bilan_valider_type_resultats')}}",
                            dataType: "json",
                            type: "get",
                            data: { 
                                      'date_debut': $("#du").val(),
                                      'date_fin': $("#au").val(),
                                      'genre': $("#genre").val(),
                                      'examen' : $("#analyse").val(),
                                      'rendu' : $("#element").val(),
                                      'resultats' : tab,
                              }
                            
              })
              .done(function(msg){
                  var elmts = JSON.parse(msg['results']);

                   
              });
        }

     });
     $('.mdCSP').click(function(){
           
            $("#modSP").modal("hide");
    });
@endsection