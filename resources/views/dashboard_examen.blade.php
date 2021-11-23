@extends("dashboard")

@section('add_style')
 .align-right{text-align:right;max-width:80px} 
 .align-left{text-align:left;max-width:80px} 
 .align-center{text-align:center;max-width:80px} 
@endsection
@section('d_content')
  <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>  
  <script type="text/javascript">
     var tab_examens = {!! $examens->toJson()  !!};
      var tab_GE = {!! $groupe_examens->toJson()  !!};
      var tab_tube = {!! $tubes->toJson()  !!};
</script>
<div class="tab-content">
                    <div class="row" style="margin-bottom:15px;margin-top:15px">
                      <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addE"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
                     <!-- <button id="delE" style="margin-left:10px" class="delete-modalE btn btn-danger col-sm-2">
                      <span class="glyphicon glyphicon-trash"></span> Delete
                      </button>-->
                    </div>
                    <table id="tabExamen" style="width:100%; heigth:60%" class="table table-striped table-responsive">
                      <caption id="cap">
                          <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES EXAMENS</h4>
                      </caption>  
                       
                      <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                        <tr  style ="heigth:10px;">
                         <!-- <th style="text-align:center;width:45px"><input type="checkbox" id="checkallE " /></th>-->
                          <th>Libellé</th>
                          <th>Groupe Examen</th>
                          <th>Tube Examen</th>
                          <th>Prix</th>
                          <th>Delai (Jrs)</th>
                        </tr>
                      </thead>
                       @foreach($examens as $item)
                      <tr id="item{{$item->id}}" style="cursor:pointer">
                        <!--<td class="text-center"><input type="checkbox" class="checkitemE" value="{{$item->id}}" /></td>-->
                        <td class="text-left"><a class="edit-modalE" style="cursor:pointer"
                            data-info="{{$item->id}},{{$item->libelle_examen}},{{$item->abreviation}},{{$item->delai}},{{$item->code_tube}},{{$item->id_groupe_examen}},{{$item->prix}}">
                            <span class="glyphicon glyphicon-edit"></span> {{$item->libelle_examen}}
                          </a>
                        </td>
                        <td class="text-left">
                            @foreach($groupe_examens as $t)
                               @if($item->id_groupe_examen == $t->id)
                                  {{$t->libelle_groupe_examen}}
                              @endif
                            @endforeach
                        </td>
                        <td class="text-left">
                          @foreach($tubes as $t)
                               @if($item->code_tube == $t->id)
                                {{$t->libelle_tube}}
                              @endif
                          @endforeach
                        </td>
                        <td class="text-left">
                           {{$item->prix}}
                        </td>
                        <td class="text-left">
                           {{$item->delai}}
                        </td>
                      </tr>
                      @endforeach
                  </table>
                      
                  @include('edit_examen')
                  @include('infos_examen')   
        </div>
@endsection

@section('another')
    var tab_exam = $('#tabExamen').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                 "columnDefs": [
                { className: "align-left","targets": [0,1,2,3,4]}
              ]
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
     $('div.dataTables_filter input').focus();
    $("#tabExamen").on('click', '.clickable', function(event) {
              
              if($(this).hasClass('success')){

                $(this).removeClass('success'); 
              } else {
                $(this).addClass('success').siblings().removeClass('success');
              }
            });
       $('form input').on('keypress', function(e) {
          return e.which !== 13;
      });
  $('#tabExamen').on('dblclick', 'tr', function(event) {
            
            
            var str = $(this).attr('id');
            
            var res = str.substring(4);
            
            $('.did_examen').text(res);
            $('.did_nomE').text( $(this).find('a').text());
            if(this.cells[0].innerHTML != "Libellé"){
                
                $("#infosExamen").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static"
                });
            }

     });
    /* var countE = 0;
         $('#checkallE').change(function(){
          $('.checkitemE').prop("checked",$(this).prop("checked"))
           $('.checkitemE').each(function(){
            if($(this).prop("checked")){
           
              countE++;
            }
           });

           if(countE > 0){
            $('#delE').removeAttr('disabled');
            countE = 0;
           }else{
            $('#delE').attr('disabled','disabled');
            countE = 0;
           }
         });
         
         $('.checkitemE').change(function(){
           $('.checkitemE').each(function(){
            if($(this).prop("checked")){
           
              countE++;
            }
           });

           if(countE > 0){
            $('#delE').removeAttr('disabled');
            countE = 0;
           }else{
            $('#delE').attr('disabled','disabled');
            countE = 0;
           }
        });*/
        $(document).on('click', '.edit-modalE', function() {
            $('#footer_action_buttonE').text(" Update");
            $('#footer_action_buttonE').addClass('glyphicon-check');
            $('#footer_action_buttonE').removeClass('glyphicon-trash');
            $('#footer_action_buttonE').removeClass('glyphicon-plus');
            $('.actionBtnE').addClass('btn-success');
            $('.actionBtnE').removeClass('btn-danger');
            $('.actionBtnE').removeClass('btn-primary');
            $('.actionBtnE').removeClass('delete');
            $('.actionBtnE').removeClass('ajout');
            $('.actionBtnE').addClass('edit');
            $('.modal-titleE').text('Modifier les informations de l\'examen');
            $('.deleteContentE').hide();
            $('.form-horizontal').show();
            var details = $(this).data('info').split(',');

           

            $('#form_examen #id_examen').val(details[0]);
        
        $('#form_examen #libelle_examen').val(details[1]);
        
        $('#form_examen #abr').val(details[2]);
        $('#form_examen #delai').val(details[3]);
        $('#form_examen #code').val(details[4]);
        $('#form_examen #id_groupe_examen').val(details[5]);
        $('#form_examen #prix').val(details[6]);
            $("#editExamen").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
        
      
         $(document).on('click', '#addE', function() {
            $('#footer_action_buttonE').text(" Ajout");
            $('#footer_action_buttonE').addClass('glyphicon-plus');
            $('#footer_action_buttonE').removeClass('glyphicon-trash');
            $('#footer_action_buttonE').removeClass('glyphicon-check');
            $('.actionBtnE').addClass('btn-primary');
            $('.actionBtnE').removeClass('btn-danger');
            $('.actionBtnE').removeClass('btn-success');
            $('.actionBtnE').removeClass('delete');
            $('.actionBtnE').removeClass('edit');
            $('.actionBtnE').addClass('ajout');
            $('.modal-titleE').text('Ajouter un nouvel Examen');
            $('.deleteContentE').hide();
            $('.form-horizontal').show();
            $("#editExamen").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
         
            $('.mdCE').click(function(){
              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
              $(".validation-error").html(""); 
              $("input").css("border","");
               $("#editExamen").modal("hide");
            });
          
     /*   $(document).on('click', '.delete-modalE', function() {
               var cpt = 0;
            $('.checkitemE').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });

           if(cpt > 0){
                  var id = $('.checkitemE:checked').map(function(){
                    return  $(this).val()
                }).get().join();
                
                  $('#footer_action_buttonE').text(" Delete");
                  $('#footer_action_buttonE').removeClass('glyphicon-check');
                  $('#footer_action_buttonE').removeClass('glyphicon-plus');
                  $('#footer_action_buttonE').addClass('glyphicon-trash');
                  $('.actionBtnE').removeClass('btn-success');
                  $('.actionBtnE').removeClass('btn-primary');
                  $('.actionBtnE').addClass('btn-danger');
                  $('.actionBtnE').removeClass('edit');
                  $('.actionBtnE').removeClass('ajout');
                  $('.actionBtnE').addClass('delete');
                  $('.modal-titleE').text('Supression');
                  $('.deleteContentE').show();
                  $('.form-horizontal').hide();
                  $('.didE').text(id);
                  $("#editExamen").modal({
                              keyboard: false,
                              show : true,
                              backdrop: "static",
                      });
                }
          });
        */
     $('#editExamen').on('hidden.bs.modal', function () {
                $(".actionBtnE").removeAttr("disabled");
       });
  $('#footerE').on('click', '.ajout', function() {

      if(validate()){
      $(this).attr("disabled","disabled");
      
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_examen')}}",
            data: $('#form_examen').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#editExamen").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#editExamen").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                              for (var i=0; i < tab_GE.length ; i++){
                                if (tab_GE[i].id == nv.id_groupe_examen){
                                  var exam = tab_GE[i].libelle_groupe_examen;
                                }
                              }
                              for (var i=0; i < tab_tube.length ; i++){
                                if (tab_tube[i].id == nv.code_tube){
                                  var exam1 = tab_tube[i].libelle_tube;
                                }
                              }
                              // "<input type=\'checkbox\' class=\'checkitemE\' value=\'" + nv.id + "\'/>",
                              var data = [
                              
                               "<a class=\'edit-modalE\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle_examen + "," + nv.abreviation + "," + nv.delai + "," + nv.code_tube + "," + nv.id_groupe_examen + "," + nv.prix + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_examen + "</a>",
                              
                                exam,
                                exam1,
                                nv.prix,
                                nv.delai
                              ];
                              var rowIndex = $('#tabExamen').dataTable().fnAddData(data);
                              var row = $('#tabExamen').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tabExamen tr#item"+nv.id);
                              tr.css("cursor","pointer");
                              //tr.find('td:eq(0)').addClass('text-center');
                              tr.find('td:eq(0)').addClass('text-left');
                              tr.find('td:eq(1)').addClass('text-center');
                              tr.find('td:eq(2)').addClass('text-left');
                              tr.find('td:eq(3)').addClass('text-left');
                              tr.find('td:eq(4)').addClass('text-left');
                              
                              var my_array = $('#tabExamen').dataTable().fnGetNodes( );
                               var last_element = my_array[my_array.length - 1];
                              $(last_element).insertBefore($('#tabExamen tbody tr:first-child'));
                       }

                        
            });
          }
       });
      
     $('#footerE').on('click', '.edit', function() {
     if(validate()){
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_examen')}}",
            data: $('#form_examen').serialize(),
            })
     
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#editExamen").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#editExamen").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            
                            nv = JSON.parse(msg['nouveau']);
                            
                             for (var i=0; i < tab_GE.length ; i++){
                                if (tab_GE[i].id == nv.id_groupe_examen){
                                  var exam = tab_GE[i].libelle_groupe_examen;
                                }
                              }
                              for (var i=0; i < tab_tube.length ; i++){
                                if (tab_tube[i].id == nv.code_tube){
                                  var exam1 = tab_tube[i].libelle_tube;
                                }
                              }
                            var tr = $("#tabExamen tr#item"+nv.id);
            
                        tr.find('td:eq(0)').html( "<a class=\'edit-modalE\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle_examen + "," + nv.abreviation + "," + nv.delai + "," + nv.code_tube + "," + nv.id_groupe_examen + "," + nv.prix + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_examen + "</a>");
                   
                        tr.find('td:eq(1)').html(""+ exam);
                        tr.find('td:eq(2)').html(""+ exam1);
                         tr.find('td:eq(3)').html(""+ nv.prix);
                          tr.find('td:eq(4)').html(""+ nv.delai);
                       // $('#tabExamen').DataTable().rows( tr ).invalidate().draw();
                        
            });
            }
       });
   /* 
     $('#footerE').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: "{{route('dashboard_examen_delete')}}",
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id_examen': $('.didE').text()
              }
          })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#editExamen").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#editExamen").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['supprimes']);
                         
                         for (var i=0; i< nv.length; i++){
                         $('#tabExamen').dataTable().fnDeleteRow($('#tabExamen').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                       
                        
            });
      });*/
  

@endsection