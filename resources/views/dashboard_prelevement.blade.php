@extends("dashboard")

@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>     
 <script type="text/javascript">
        
         var tab_GE = {!! $groupe_examens->toJson()  !!};
</script>
<div class="tab-content">
              <legend>
                        <h4 class="text-left" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES TUBES A PRELEVER</h4>
                     </legend>
                    <div class="row text-right" >
                       <button style="font-weight:bold; margin-right:8px; font-size:20px;  height:70px; padding-bottom:5px" id="btnCB" class="btn btn-primary ">Prélèvement Manuel </button>
                    </div>
                    <div class="row" style="margin-bottom:30px">
                        
                    </div>
                    <div class="row" style="margin-bottom:30px">
                        <div class="col-md-2">
                           <input  class="form-control" type="text" id="nomp" >
                        </div>
                        <div class="col-md-2">
                           <input  class="form-control" type="text" id="id_dossier" >
                        </div>
                        <div class="col-md-2">
                           <input  class="form-control" type="text" id="date_dossier" >
                        </div>
                         <div class="col-md-2">
                           <input  class="form-control" type="text" id="id_tube" >
                        </div>
                        <div class="col-md-2">
                           <input  class="form-control" type="text" id="libelle" >
                        </div>
                       
                        <div class="col-md-2">
                           <input  class="form-control" type="color" id="couleur" value="" >
                        </div>
                    </div>
                    <div class="row">
                    
                     <table id="tabCB" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMeB">
                     
                     
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr  style ="heigth:10px;">
                        <th class="text-left">Nom patient</th>
                        <th class="text-left">Numero dossier</th>
                        <th class="text-left">Date dossier</th>
                        <th class="text-left">Code Tube</th>
                        <th class="text-left">Libelle Tube</th>
                        <th class="text-center">Couleur Tube</th>
                      
                      </tr>
                    </thead>

                </table>
              </div>
        </div>

<div id="modCB" class="modal fade" role="dialog" >
 <div class="modal-dialog md-lg" style="width:80%" >
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcIP">&times;</button>
    <h3 class="modal-title">LISTE DES PRELEVEMENTS  <span class="dnom_grpe"></span></h3>
  </div>
  <div class="modal-body">
     
                    <table id="tabPre" style="width:100%; margin-top:30px; heigth:60%" class="table table-striped table-responsive blockMe">  

                     <!-- rgb(150,150,150)-->
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr  style ="heigth:10px;">
                        <th class="text-left">N° Dossier</th>
                        <th class="text-left">Patient</th>
                        <th class="text-left">Date</th>
                      </tr>
                    </thead>

                  </table>
      
  </div>
  <div class="modal-footer" >
    <button type="button" class="btn btn-warning mdcIP">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>


<div id="ModTu" class="modal fade" role="dialog">
 <div class="modal-dialog" >
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcTu">&times;</button>
    <h3 class="modal-title">Tubes du Patient <span class="dnom_patient"></span><span class="hidden did_dossier"></span></h3>
  </div>
  <div class="modal-body">
     <table id="tabTube" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMeT">
          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
            <tr  style ="heigth:10px;">
              <th style="text-align:left;width:45px"><input type="checkbox" id="checkallTu" /></th>
              <th class="text-left">Nom du tube</th>
              <th class="text-left">Couleur</th>
              <th class="text-left">Groupe Examen</th>
              <th class="text-left">Code barre</th>
            </tr>
          </thead>
         
      </table>
  </div>
  <div class="modal-footer" >
    <button type="button" id="btnValP" class="btn btn-success">
          <span class='glyphicon glyphicon-ok-sign'></span> Valider
  </button>
    <button type="button" class="btn btn-warning mdcTu">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
<div id="ModPre" class="modal fade" role="dialog">
 <div class="modal-dialog" >
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcP">&times;</button>
    <h3 class="modal-titleT">Confirmation</h3>
  </div>
  <div class="modal-body">
    <h3>Voulez vous valider les prélèvements des tubes sélectionnés ?<span class="hidden did_tube"></span></h3>
  </div>
  <div class="modal-footer" >
  <button type="button" id="conValP" class="btn btn-success">
          <span class='glyphicon glyphicon-ok-sign'></span> Valider
  </button>
    <button type="button" class="btn btn-warning mdcP">
      <span class='glyphicon glyphicon-remove'></span> Close
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
    <h3>Vous devez cocher au moins un tube !!</h3>
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
@section('activePre')
active
@endsection

@section('anotherLoad')
  

                  $("#id_tube").focus();
       
                 
@endsection
@section('another')

        
          var tableD =  $('#tabCB').DataTable({

               /* "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,*/
                 "searching": false,
                 "lengthChange": false,
               "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                "order": [[ 0, "asc" ]],
               "serverSide": true,
               "ajax" : {
                  "url" : "{{ route('dashboard_get_liste_prelevement') }}",
                  "dataType" : "json",
                  "type" : "POST",
                   beforeSend: function(){
              
                   $('.blockMeB').block({ 
                      message: '<h3>Chargement.....</h3>', 
                      css: { border: '3px solid #a00' } 
                  }); 
              },
              complete: function(){
                  $('.blockMeB').unblock();
              }
               },
               "columns" : [
                    {"data" : "nom_patient"},
                    {"data" : "numero_dossier"},
                    {"data" : "date_dossier"},
                    {"data" : "id_tube"},
                    {"data" : "libelle_tube"},
                    {"data" : "couleur"}
               ],
                "columnDefs": [
                
                { className: "align-center","targets": [1,5]}
              ]
            });
                  
                  $(".dataTables_length select").addClass("form-control");
                  $(".dataTables_filter input").addClass("form-control");
                  
                  $("#id_tube").focus();

       function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    }
          $('#tabTube').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": -1
            });

            
     var tableP = $('#tabPre').DataTable({
                    
                    
               "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                "order": [[ 0, "asc" ]],
               "serverSide": true,
               "ajax" : {
                  "url" : "{{ route('dashboard_get_liste_prelevement_manuel') }}",
                  "dataType" : "json",
                  "type" : "POST",
                   beforeSend: function(){
              
                   $('.blockMe').block({ 
                      message: '<h3>Chargement.....</h3>', 
                      css: { border: '3px solid #a00' } 
                  }); 
              },
              complete: function(){
                  $('.blockMe').unblock();
              }
               },
               "columns" : [
                    {"data" : "id"},
                    {"data" : "nom"},
                    {"data" : "date"}
               ]

                    
                  }); 
             
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    $('#tabPre').on('dblclick', 'tr', function(event){

         if(this.cells[0].innerHTML != "N° Dossier"){
         
            
            var res = parseInt( this.cells[0].innerHTML );
            $('.did_dossier').text(res);
            $('.dnom_patient').text( this.cells[1].innerHTML );
            $("#ModTu").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
            });
            
        }
     });

    var countE = 0;
         $('#checkallTu').change(function(){
          $('.checkitemTu').prop("checked",$(this).prop("checked"))
           $('.checkitemTu').each(function(){
            if($(this).prop("checked")){
           
              countE++;
            }
           });

          
         });
         
        
      $('#ModTu').on('hidden.bs.modal',function(){
            $('div.dataTables_filter input').focus();
            $('#tabTube').dataTable().fnClearTable();
            
            
      });
      
    
         $('#modCB').on('shown.bs.modal',function(){
            
             $('div.dataTables_filter input').focus();
            
      });
      $('#modCB').on('hidden.bs.modal',function(){
            
          tableP.draw();
            $("#id_tube").focus();
            
      });
      

      $("#btnCB").click(function(){
            
                  $("#modCB").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
                      });           

      });

      var BarcodeScanerEvents = function() {
     this.initialize.apply(this, arguments);
};

function isCapsLock(e){
    e = (e) ? e : window.event;

    var charCode = false;
    if (e.which) {
        charCode = e.which;
    } else if (e.keyCode) {
        charCode = e.keyCode;
    }

    var shifton = false;
    if (e.shiftKey) {
        shifton = e.shiftKey;
    } else if (e.modifiers) {
        shifton = !!(e.modifiers & 4);
    }

    if (charCode >= 97 && charCode <= 122 && shifton) {
        return true;
    }

    if (charCode >= 65 && charCode <= 90 && !shifton) {
        return true;
    }

    return false;
}



function transform(strin){
    cara = [0,1,2,3,4,5,6,7,8,9];
    var tr = false;
    for(var i=0; i < cara.length; i++){
      if(strin.indexOf(cara[i]) >= 0 ){
            tr = true;
            break;
      }
    }
    if(!tr){
        /*strin = strin.replace(/&/g,"1");
        strin = strin.replace(/é/g,"2");
        strin = strin.replace(/"/g,"3");
        strin = strin.replace(/'/g,"4");
        strin = strin.replace(/\(/g,"5");
        strin = strin.replace(/-/g,"6");
        strin = strin.replace(/è/g,"7");
        strin = strin.replace(/_/g,"8");
        strin = strin.replace(/ç/g,"9");
        
        strin = strin.replace(/à/g,"0");*/
        
        strin = strin.replace(/!/g,"1");
        strin = strin.replace(/"/g,"2");
        strin = strin.replace(/£/g,"3");
        strin = strin.replace(/$/g,"4");
        strin = strin.replace(/%/g,"5");
        strin = strin.replace(/^/g,"6");
        strin = strin.replace(/&/g,"7");
        strin = strin.replace(/\*/g,"8");
        strin = strin.replace(/\(/g,"9");
        strin = strin.replace(/\)/g,"0");
    }

  return strin; 
}
$("#id_tube").on("input",function(){
   
    
});

$('#id_tube').keypress(function (e) {
//alert(transform($("#id_tube").val()))

          if (e.which == 13) {
           $("#id_tube").val(transform( $("#id_tube").val() ));
           
               $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_prelevement_valider')}}",
            data: { 'id_tube': $("#id_tube").val() }
            })
             .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                 
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               alertify.set('notifier','position', 'top-right');
                                 $("#id_tube").val("");
                        }else if(typeof msg['success'] !== 'undefined'){
                              
                              $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              
                         
                         
                              tableD.draw();
                               tableP.draw();
                           $("input").val("");
                        
                          

                  
                       }
                       
              });
              
            return false;    
          }
        });

BarcodeScanerEvents.prototype = {
    initialize: function() {
       $(document).on({
          keyup: $.proxy(this._keyup, this)
       });
    },
    _timeoutHandler: 0,
    _inputString: '',
    _keyup: function (e) {
        if (this._timeoutHandler) {
            clearTimeout(this._timeoutHandler);
            this._inputString += String.fromCharCode(e.which);
        } 

        this._timeoutHandler = setTimeout($.proxy(function () {
            if (this._inputString.length <= 3) {
                this._inputString = '';
                return;
            }

            $(document).trigger('onbarcodescaned', this._inputString);

            this._inputString = '';

        }, this), 20);
    }
};

      
     
     $('#ModTu').on('shown.bs.modal', function () {
          $('div.dataTables_filter input').focus();
          $.ajax({
            
            dataType:'json',
            url: "{{route('dashboard_prelevement_dossier')}}",
            data: {'id_dossier' : $(".did_dossier").text() },
            beforeSend: function(){
                 $('.blockMeT').block({ 
                    message: '<h3>Chargement.....</h3>', 
                    css: { border: '3px solid #a00' } 
                }); 
            },
            complete: function(){
                $('.blockMeT').unblock();
            }
            })
            .done(function(msg){
                            
                           tab_tube = JSON.parse(msg['tubes']);
                          for(var i = 0; i < tab_tube.length ; i++){
                            
                            for(j=0; j< tab_GE.length;j++){
                              if(tab_tube[i].id_groupe_examen == tab_GE[j].id){
                                var libelT = tab_GE[j].libelle_groupe_examen;
                                break;
                              }
                            }
                            var data = [
                              "<input type='checkbox' class='checkitemTu' value='" + tab_tube[i].id + "'/>",
                                tab_tube[i].libelle_tube,
                                "<input style='width:50px' type='color' value='" + tab_tube[i].couleur + "'/>",
                                libelT,
                                "<img src=\'data:image/png;base64," + tab_tube[i].code_barre + "\'>"
                                ];
                              var rowIndex = $('#tabTube').dataTable().fnAddData(data);
                                  var row = $('#tabTube').dataTable().fnGetNodes(rowIndex);
                                  $(row).attr( 'id','item' + tab_tube[i].id); 
                                  var tr = $("#tabTube tr#item"+tab_tube[i].id);
                                  
                                  tr.find('td:eq(0)').addClass('text-left');
                                  tr.find('td:eq(1)').addClass('text-left');
                                  tr.find('td:eq(2)').addClass('text-left');
                                  tr.find('td:eq(3)').addClass('text-left');
                                  tr.find('td:eq(4)').addClass('text-left');
                                  
                                 
                                 
                        }
                              
                  });
      });

     $("#btnValP").click(function(){
      var cpt = 0;
            $('.checkitemTu').each(function(){
              if($(this).prop("checked")){
             
                cpt++;
              }
           });
           if(cpt > 0){
            var id = $('.checkitemTu:checked').map(function(){
              return  $(this).val()
             }).get().join();
            
             $('.did_tube').text(id);
            
             $("#ModPre").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
             });
          }else{
                 $("#AlerPre").modal({
                    keyboard: false,
                    show : true,
                    backdrop: "static",
             });
          }

            
     });
     $("#conValP").click(function(){
          $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_prelevement_valider')}}",
            data: { 'id_tube': $('.did_tube').text() }
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                              
                              $("#ModPre").modal('hide');
                              $("#checkallTu").removeAttr('checked');
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                              $("#ModPre").modal('hide');
                              $("#checkallTu").removeAttr('checked');
                              $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                          
                             
                       }
                       nv = JSON.parse(msg['supprimes']);
                         
                         for (var i=0; i< nv.length; i++){
                            $('#tabTube').dataTable().fnDeleteRow($('#tabTube').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                     tableP.draw();

                     tableD.draw();
                        
        });
        
     });
     
     $('.mdcP').click(function(){
           
            $("#ModPre").modal("hide");
            });

           $('.mdcIP').click(function(){
           
            $("#modCB").modal("hide");
            });

        $('.mdcA').click(function(){
           
            $("#AlerPre").modal("hide");
            });
       $('.mdcIP').click(function(){
           
            $("#infoPre").modal("hide");
        });
  $('.mdcTu').click(function(){
           
            $("#ModTu").modal("hide");
            });
@endsection