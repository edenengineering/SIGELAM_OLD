@extends("dashboard")

@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
   var tab_do = {!! $serotheques->toJson() !!};
  var tab_pat = {!! $pathologies->toJson() !!};
  var tab_nature = {!! $natures->toJson() !!};
  var tabQ = {!! $quartiers->toJson() !!};
    function validate() {
    
   
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
               <legend> <h4 class="text-left" style="color:rgb(51,122,183); font-weight: bold;">ETATS BIOTHEQUES</h4></legend>

   <div class="row" id="formH" style="margin-bottom:15px; padding-top:10px;margin-top:15px; height: 150px;border-radius:10px;background-color:rgb(238, 247, 240);">
            <div class="col-sm-4">
                <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-sm-12 control-label" >Age Min <span class="age_min-validation validation-error"></label>
                    <div class="col-sm-12">
                        <input class="form-control" type="number" name="age_min" min="0" id="age_min">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                  <label class="col-sm-12 control-label" >Age Max <span class="age_max-validation validation-error"></label>
                  <div class="col-sm-12">
                      <input class="form-control" type="number" name="age_max" min="0" id="age_max">
                  </div>
                </div>
                </div>
                
              </div>
              <div class="row">
                 <div class="form-group">
                   <label for="element" class="control-label col-sm-10 text-left">Nature de l'echantillon : <br /><span class="element-validation validation-error"></span></label>
                  <div class="col-sm-12">
                      <select class="form-control" name="NE" id="NE" >
                        <option value="" class="text-center">---- Choix de la nature de l'echantillon ----</option>
                        @foreach( $natures as $item) 

                            <option value="{{ $item->id }}">{{ $item->libelle_nature }}</option>
                        @endforeach
                      </select>
                  </div>
                 </div>
              </div>
              
            </div>
            <div class="col-sm-3">
              <div class="row">
                <div class="form-group">
                  <label for="analyse" class="control-label col-sm-10 text-left">Pathologie Liée : <span class="analyse-validation validation-error"></span></label>
                  <div class="col-sm-12">
                      <select class="form-control" name="PL" id="PL" >
                        <option value="" class="text-center">---- Choix de la pathologie ----</option>
                        @foreach( $pathologies as $item) 

                            <option value="{{ $item->id }}">{{ $item->libelle_pathologie }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
              </div>
             <div class="row">
                
                  <div class="form-group"> 
                     <label for="genre" class="control-label col-sm-5 text-left" >Genre : <span class="genre-validation validation-error"></span></label>
                     <div class="col-sm-12" >
                       <select class="form-control" name="genre" id="genre">
                          <option value="" class="text-center">---- Choix du genre ----</option>
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
                  <label  class="control-label col-sm-8 text-left"><br /></span></label>
                  <div class="col-sm-12" style="padding-left:30px;">
                    <button id="btnLoad" class="btn btn-success glyphicon glyphicon-refresh " style="width:100%"> CHARGER TOUT</button>
                  </div>
              </div>
             </div>
              <div class="row">
               <div class="form-group">
                  <label  class="control-label col-sm-8 text-left"><br /></span></label>
                  <div class="col-sm-12" style="padding-left:30px;">
                    <button id="btnOK" class="btn btn-primary glyphicon glyphicon-refresh " style="width:100%"> OK</button>
                  </div>
              </div>
             </div>
            </div>
            
    </div>
    <div class="row" >
      <div class="col-sm-10" id="divT">
         <table id="tabEB" style="width:100%; heigth:60%; " class="table table-striped table-responsive blockMe">
            <caption></caption>
           
         <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr  style ="heigth:10px;">
                        <th class="text-left">Carac ID</th>
                        <th class="text-left">Nature</th>
                        <th class="text-left">Pathologie liée</th>
                        <th class="text-left">Genre</th>
                        <th class="text-left">Date Naiss</th>
                        <th class="text-left">Preleve</th>
                        <th class="text-left">Quartier</th>
                        
                      </tr>

                    </thead>
            
        </table>  
      </div>
      <div class="col-sm-2" style="padding-top:10px">
          <div class="row" style="margin-bottom:20px">
            <button id="btnPrint" style="width:150px;" disabled="disabled" class="btn btn-primary btn-lg">
              <span class="glyphicon glyphicon-print"> Imprimer</span>
            </button>
         </div>
      </div>
    </div>
  
    
     
</div>
<div id="AlerPre" class="modal fade" role="dialog">
 <div class="modal-dialog" >
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcA">&times;</button>
    <h3 class="modal-titleT"><i class="glyphicon glyphicon-info-sign"></i> Information</h3>
  </div>
  <div class="modal-body">
    <h3>Vous devez entrer au moins un critère !!</h3>
  </div>
  <div class="modal-footer" >
    <button type="button" class="btn btn-warning mdcA">
      <span class='glyphicon glyphicon-remove'></span> Close
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
                   for(var j = 0; j < tab_do.length ; j++){
                            
                            var nat= "";
                              var pat ="";
                              var quat ="";
                              for(var i=0; i < tab_nature.length; i++){
                                  if(tab_nature[i].id == tab_do[j].id_nature){
                                      nat = tab_nature[i].libelle_nature;
                                  }
                              }


                              for(var i=0; i < tab_pat.length; i++){
                                  if(tab_pat[i].id == tab_do[j].id_pathologie){
                                      pat = tab_pat[i].libelle_pathologie;
                                  }
                              }
                               for(var i=0; i < tabQ.length; i++){
                                  if(tabQ[i].id == tab_do[j].id_quartier){
                                      quat = tabQ[i].libelle_quartier;
                                  }
                              }

                              var data = [
                               "<a class=\'edit-modalC\' style=\'cursor:pointer\' data-info=\'" + tab_do[j].id + "," + tab_do[j].genre + "," + tab_do[j].preleve_le + "," + tab_do[j].date_naissance + "," + tab_do[j].caractere_id + "," + tab_do[j].id_nature + "," + tab_do[j].id_pathologie + "," + tab_do[j].id_quartier + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ tab_do[j].caractere_id + "</a>",
                               
                                nat,
                                pat,
                                tab_do[j].genre,
                                tab_do[j].date_naissance,
                                tab_do[j].preleve_le,
                                quat
                              ];
                              var rowIndex = $('#tabEB').dataTable().fnAddData(data);
                              var row = $('#tabEB').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + tab_do[j].id);
                              var tr = $("#tabEB tr#item"+tab_do[j].id);
                              tr.find('td:eq(0)').addClass('text-left');
                              tr.find('td:eq(1)').addClass('text-left');
                              tr.find('td:eq(2)').addClass('text-left');
                              tr.find('td:eq(3)').addClass('text-left');
                              tr.find('td:eq(4)').addClass('text-left');
                               tr.find('td:eq(5)').addClass('text-left');
                               tr.find('td:eq(6)').addClass('text-left');
                               tr.find('td:eq(7)').addClass('text-left');
                    }
                       if(($("#tabEB").dataTable().fnSettings().aoData.length!==0)){
                                      $("#btnPrint").removeAttr("disabled");
                                }else{
                                      $("#btnPrint").attr("disabled","disabled");
                                } 
                   
@endsection
@section('another')
var table =  $('#tabEB').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                 "searching": false,
                 "lengthChange": false,
                 "columnDefs": [
                { className: "align-left","targets": [0,1,2,3,4,5,6]}
              ],
                dom: 'Blfrtip',
                buttons: [
                        {
                          extend : 'excel',
                          text : 'Export Vers Excel',
                          className: 'btnExcel',
                          title : "ETATS BIOTHEQUES"
                        }
                           
                      ]
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    $(".dt-button buttons-print").addClass("btn btn-primary");
    $(".dt-button buttons-excel").addClass("btn btn-success");
    

        $('#btnLoad').click(function(){
              $('#tabEB').dataTable().fnClearTable();
              $("#formH .form-control").val("");
              for(var j = 0; j < tab_do.length ; j++){
                       
                       var nat= "";
                         var pat ="";
                         var quat ="";
                         for(var i=0; i < tab_nature.length; i++){

                             if(tab_nature[i].id == tab_do[j].id_nature){
                                 nat = tab_nature[i].libelle_nature;
                             }
                         }


                         for(var i=0; i < tab_pat.length; i++){
                             if(tab_pat[i].id == tab_do[j].id_pathologie){
                                 pat = tab_pat[i].libelle_pathologie;
                             }
                         }
                          for(var i=0; i < tabQ.length; i++){
                             if(tabQ[i].id == tab_do[j].id_quartier){
                                 quat = tabQ[i].libelle_quartier;
                             }
                         }

                         var data = [
                          "<a class=\'edit-modalC\' style=\'cursor:pointer\' data-info=\'" + tab_do[j].id + "," + tab_do[j].genre + "," + tab_do[j].preleve_le + "," + tab_do[j].date_naissance + "," + tab_do[j].caractere_id + "," + tab_do[j].id_nature + "," + tab_do[j].id_pathologie + "," + tab_do[j].id_quartier + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ tab_do[j].caractere_id + "</a>",
                          
                           nat,
                           pat,
                           tab_do[j].genre,
                           tab_do[j].date_naissance,
                           tab_do[j].preleve_le,
                           quat
                         ];
                         var rowIndex = $('#tabEB').dataTable().fnAddData(data);
                         var row = $('#tabEB').dataTable().fnGetNodes(rowIndex);
                         $(row).attr( 'id','item' + tab_do[j].id);
                         var tr = $("#tabEB tr#item"+tab_do[j].id);
                         tr.find('td:eq(0)').addClass('text-left');
                         tr.find('td:eq(1)').addClass('text-left');
                         tr.find('td:eq(2)').addClass('text-left');
                         tr.find('td:eq(3)').addClass('text-left');
                         tr.find('td:eq(4)').addClass('text-left');
                          tr.find('td:eq(5)').addClass('text-left');
                          tr.find('td:eq(6)').addClass('text-left');
                          tr.find('td:eq(7)').addClass('text-left');
               }
                  if(($("#tabEB").dataTable().fnSettings().aoData.length!==0)){
                                 $("#btnPrint").removeAttr("disabled");
                           }else{
                                 $("#btnPrint").attr("disabled","disabled");
                           } 

        });
      
      $("#btnPrint").click(function(){
                window.open("{{ route('dashboard_imprimer_etat_biotheque') }}?age_min="+ $("#age_min").val() +"&age_max="+$("#age_max").val()+"&id_pathologie="+$("#PL").val()+"&id_nature="+$("#NE").val()+"&genre="+$("#genre").val());
      })
     $("#btnOK").click(function(){
       var bon = false;
          $('#formH .form-control').each(function(){
              if($(this).val() != ""  ){
                bon = true;
              }
           });
        if(bon){
          $.ajax({
            type: 'get',
            dataType:'json',
            url: " {{ route('dashboard_rechercher_biotheque') }}",
            data: { 'age_min': $("#age_min").val(),
                    'age_max': $("#age_max").val(),
                    'id_pathologie': $("#PL").val(),
                    'id_nature': $("#NE").val(),
                    'genre': $("#genre").val()

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
                       
                         $('#tabEB').dataTable().fnClearTable();
                              
                            
                          //alert("ok")
                      var tab = JSON.parse(msg['serotheque']);
                       // alert( tab_do.length );
                          for(var j = 0; j < tab.length ; j++){
                                     
                                     var nat= "";
                                       var pat ="";
                                       var quat ="";
                                       for(var i=0; i < tab_nature.length; i++){
                                           if(tab_nature[i].id == tab[j].id_nature){
                                               nat = tab_nature[i].libelle_nature;
                                           }
                                       }


                                       for(var i=0; i < tab_pat.length; i++){
                                           if(tab_pat[i].id == tab[j].id_pathologie){
                                               pat = tab_pat[i].libelle_pathologie;
                                           }
                                       }
                                        for(var i=0; i < tabQ.length; i++){
                                           if(tabQ[i].id == tab[j].id_quartier){
                                               quat = tabQ[i].libelle_quartier;
                                           }
                                       }

                                       var data = [
                                        tab[j].caractere_id,
                                         nat,
                                         pat,
                                         tab[j].genre,
                                         tab[j].date_naissance,
                                         tab[j].preleve_le,
                                         quat
                                       ];
                                       var rowIndex = $('#tabEB').dataTable().fnAddData(data);
                                       var row = $('#tabEB').dataTable().fnGetNodes(rowIndex);
                                       $(row).attr( 'id','item' + tab[j].id);
                                       var tr = $("#tabEB tr#item"+tab[j].id);
                                       tr.find('td:eq(0)').addClass('text-left');
                                       tr.find('td:eq(1)').addClass('text-left');
                                       tr.find('td:eq(2)').addClass('text-left');
                                       tr.find('td:eq(3)').addClass('text-left');
                                       tr.find('td:eq(4)').addClass('text-left');
                                        tr.find('td:eq(5)').addClass('text-left');
                                        tr.find('td:eq(6)').addClass('text-left');
                                        tr.find('td:eq(7)').addClass('text-left');
                             }
                          if(($("#tabEB").dataTable().fnSettings().aoData.length!==0)){
                                         $("#btnPrint").removeAttr("disabled");
                                   }else{
                                         $("#btnPrint").attr("disabled","disabled");
                                   } 
                            
                });  
        }else{
             $("#AlerPre").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
             });

        }
        

     });
    $('.mdcA').click(function(){
           
            $("#AlerPre").modal("hide");
            });
@endsection