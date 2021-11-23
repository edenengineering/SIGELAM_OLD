@extends("dashboard")

@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>    
 <script type="text/javascript">
     var tab_part = {!! $partenaires->toJson()  !!};
    
     var tab_centre_part = {!! $centre_partenaires->toJson() !!};
</script>
<div class="tab-content">
    <div class="row" style="margin-bottom:15px; margin-top:15px;">
            <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addC"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
            <button id="delC" style="margin-left:10px"  class="delete-modalC btn btn-danger col-sm-2">
            <span class="glyphicon glyphicon-trash"></span> Delete
            </button>
    </div>
     <div id="table-wrapper">
                    <table id="tableCP" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
                    <caption id="cap">
                        <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES CENTRES PRESCRIPTEURS</h4>
                    </caption> 
                 
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr  style ="heigth:10px;">
                        <th style="text-align:center;width:45px"><input type="checkbox" id="checkallC" /></th>
                        <th class="text-left">Nom du Centre</th>
                        
                        <th class="text-left">Taux de Redevance</th>
                        
                      </tr>
                    </thead>
                     @foreach($centre_prescripteurs as $item)
                      <tr id="item{{$item->id}}">
                        <td class="text-center"><input type="checkbox" class="checkitemC" value="{{$item->id}}" /></td>
                        <td class="text-left"><a class="edit-modalC" style="cursor:pointer"
                            data-info="{{$item->id}},{{$item->libelle_centre}},{{$item->taux_redevance}}">
                            <span class="glyphicon glyphicon-edit"></span> {{$item->libelle_centre}}
                          </a>
                        </td>
                        <td class="text-left">{{$item->taux_redevance}}</td>
                      </tr>
                      @endforeach
                  </table>
                  </div>
          <div id="add_centre" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">

                   
                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdcC" data-dismiss="modal">&times;</button>
                        <h2 id="titre" class="modal-titleC" ></h2>
                      </div>
                      <div class="modal-body">
                        <form id="form-centre_prescripteur" class="form-horizontal" role="form">
                  
                          {{ csrf_field() }} 
                           <div class="row" style="margin-bottom:10px;">
                              <div class="form-group ">
                                <label for="libelle_centre" class="control-label col-sm-2 text-right">Nom du centre :&nbsp;</label>
                                <div class="col-sm-4">
                                   <select id="libelle_centre" name="libelle_centre_prescripteur" class="form-control">
                                        @foreach ($hopitals as $u) 
                                          <option value="{{$u->nom_hopital}}">{{$u->nom_hopital}}</option>
                                        @endforeach
                                  </select>
                                </div>
                                <label for="TR" class="control-label col-sm-3 text-right">Taux de redevance :&nbsp;</label>
                                <div class="col-sm-2">
                                  <input  class="form-control" name="taux_redevance" id="TR" value="0" type="number" required />  
                                </div>
                              </div> 
                           </div>
                           <div class="row" style="margin-bottom:10px;">
                              <div class="form-group ">
                              <div class="col-sm-9 col-sm-offset-2">
                                <select id="code_assureur_choix" class="form-control">
                                     
                                </select>
                              </div>
                              </div> 
                           </div>  
                           <div class="row" style="margin-bottom:10px;">
                              <div class="form-group ">
                              <label for="code_assureur" class="control-label col-sm-2 text-right">Assureur :&nbsp;</label>
                              <div class="col-sm-9">
                                <select id="code_assureur" name="code_assureur" class="form-control" multiple="multiple">
                                      
                                </select>
                              </div>
                             
                              </div> 
                           </div>
                           
                             
                          <input type="hidden" id="id_centre_prescripteur" name="id_centre_prescripteur" value="">
                        </form>
                        <div class="deleteContentC">
                              <h3 class="text-center">Voulez-vous vraiment supprimer les items sélectionnés ? <span
                                class="hidden didC"></span></h3>
                        </div>
                      </div>
                      <div class="modal-footer" id="footerC">
                        <button type="button" class="btn actionBtnC" >
                        <span id="footer_action_buttonC" class='glyphicon'> </span>
                      </button>
                      <button type="button" class="btn btn-warning mdcC">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>

                  </div>
                </div>    
</div>
@endsection
@section('another')
    var tab_centre = $('#tableCP').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
            });
    //$(".dataTables_length label").addClass("form-control");
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    //$(".dataTables_filter label").html("Recherche");
  
     var countC = 0;

                  

         $('#checkallC').change(function(){
          $('.checkitemC').prop("checked",$(this).prop("checked"))
           $('.checkitemC').each(function(){
            if($(this).prop("checked")){
           
              countC++;
            }
           });

          
         });
         
         $('.checkitemC').change(function(){
           $('.checkitemC').each(function(){
            if($(this).prop("checked")){
           
              countC++;
            }
           });
        });
        $('#code_assureur_choix').on('change', function() {
             
             $('#code_assureur').append($('<option>',
                {
                    value: $( "#code_assureur_choix option:selected" ).val(),
                    text : $( "#code_assureur_choix option:selected" ).text()
                }));
            $("#code_assureur_choix option[value="+ $(this).val() +"]").remove();
        });

        $('#code_assureur').on('change', function() {
            $('#code_assureur_choix').append($('<option>',
                 {
                    value: $( "#code_assureur option:selected" ).val(),
                    text : $( "#code_assureur option:selected" ).text()
                }));
            $("#code_assureur option[value="+ $(this).val() +"]").remove();
        });
        $(document).on('click', '.edit-modalC', function() {
            $('#footer_action_buttonC').text(" Update");
            $('#footer_action_buttonC').addClass('glyphicon-check');
            $('#footer_action_buttonC').removeClass('glyphicon-trash');
            $('#footer_action_buttonC').removeClass('glyphicon-plus');
            $('.actionBtnC').addClass('btn-success');
            $('.actionBtnC').removeClass('btn-danger');
            $('.actionBtnC').removeClass('btn-primary');
            $('.actionBtnC').removeClass('delete');
            $('.actionBtnC').removeClass('ajout');
            $('.actionBtnC').addClass('edit');
            $('.modal-titleC').text('Modifier les informations du Centre Prescripteur');
            $('.deleteContentC').hide();
            $('.form-horizontal').show();
            var details = $(this).data('info').split(',');

        $("#code_assureur").find("option").remove();
        $("#code_assureur_choix").find("option").remove();
        $('#form-centre_prescripteur #id_centre_prescripteur').val(details[0]);
        
        $('#form-centre_prescripteur #libelle_centre').val(details[1]);
        
         $('#code_assureur_choix').append($('<option>',
                 {
                    value: '',
                    text : "--- Choisissez l'assurreur ---",
                    selected:true
                }));  
              var del =[];
          for(var i=0;i < tab_centre_part.length;i++){
              if(tab_centre_part[i].id_centre_prescripteur == details[0]){
                  for(j=0;j < tab_part.length; j++){
                    if(tab_part[j].id == tab_centre_part[i].id_partenaire){
                       del.push(tab_part[j].id);
                       $('#code_assureur').append($('<option>',
                       {
                          value: tab_part[j].id,
                          text : tab_part[j].libelle_partenaire
                      }));
                    }
                  }
              }
              
        }
           for(var i=0;i < tab_part.length;i++){
                   $('#code_assureur_choix').append($('<option>',
                   {
                      value: tab_part[i].id,
                      text : tab_part[i].libelle_partenaire
                  }));
                  
            }
          for(i=0;i < del.length ; i++){
              $("#code_assureur_choix option[value="+ del[i] +"]").remove();
          }
        $('#form-centre_prescripteur #TR').val(details[2]);
        $("#add_centre").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
        
      
         $(document).on('click', '#addC', function() {
            $('#footer_action_buttonC').text(" Ajout");
            $('#footer_action_buttonC').addClass('glyphicon-plus');
            $('#footer_action_buttonC').removeClass('glyphicon-trash');
            $('#footer_action_buttonC').removeClass('glyphicon-check');
            $('.actionBtnC').addClass('btn-primary');
            $('.actionBtnC').removeClass('btn-danger');
            $('.actionBtnC').removeClass('btn-success');
            $('.actionBtnC').removeClass('delete');
            $('.actionBtnC').removeClass('edit');
            $('.actionBtnC').addClass('ajout');
            $('.modal-titleC').text('Ajouter un nouveau Centre prescripteur');
            $('.deleteContentC').hide();
            $('.form-horizontal').show();
            $("#code_assureur").find("option").remove();
            $("#code_assureur_choix").find("option").remove();
             $('#code_assureur_choix').append($('<option>',
               {
                  value: '',
                  text : "--- Choisissez l'assurreur ---",
                  selected : 'selected'
              }));  
              for(var i=0;i < tab_part.length;i++){
                   $('#code_assureur_choix').append($('<option>',
                   {
                      value: tab_part[i].id,
                      text : tab_part[i].libelle_partenaire
                  }));
                  
            }
            $("#TR").val(0);
            $("#add_centre").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
         
            $('.mdcC').click(function(){
             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
              //$(":select:not('[name=libelle_centre_prescripteur]')").find('option').remove();
              $("#code_assureur").find("option").remove();
              $("#code_assureur_choix").find("option").remove();
              $("#add_centre").modal("hide");

            });
          
        $(document).on('click', '.delete-modalC', function() {
         var cpt = 0;
            $('.checkitemC').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });
           if(cpt > 0){
            var id = $('.checkitemC:checked').map(function(){
              return  $(this).val()
          }).get().join();
            $('#footer_action_buttonC').text(" Delete");
            $('#footer_action_buttonC').removeClass('glyphicon-check');
            $('#footer_action_buttonC').removeClass('glyphicon-plus');
            $('#footer_action_buttonC').addClass('glyphicon-trash');
            $('.actionBtnC').removeClass('btn-success');
            $('.actionBtnC').removeClass('btn-primary');
            $('.actionBtnC').addClass('btn-danger');
            $('.actionBtnC').removeClass('edit');
            $('.actionBtnC').removeClass('ajout');
            $('.actionBtnC').addClass('delete');
            $('.modal-titleC').text('Supression');
            $('.deleteContentC').show();
            $('.form-horizontal').hide();
            $('.didC').text(id);
            $("#add_centre").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
          }
        });
        
    
  $('#footerC').on('click', '.ajout', function() {
        var tabId = []
        $("#code_assureur option").each(function()
        {
            tabId.push($(this).val())
        });
        
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_centre_prescripteur')}}",
            data:  {
                  '_token': $('input[name=_token]').val(),
                  'libelle_centre_prescripteur': $('#libelle_centre').val(),
                  'taux_redevance': $('input[name=taux_redevance]').val(),
                  'code_assureur': tabId
              }
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_centre").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_centre").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                              tab_centre_part = JSON.parse(msg['centre_partenaires']);
                           
                              var data = [
                               "<input type=\'checkbox\' class=\'checkitemC\' value=\'" + nv.id + "\'/>",
                               "<a class=\'edit-modalC\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle_centre + "," + nv.taux_redevance + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_centre + "</a>",
                                nv.taux_redevance
                              ];
                              var rowIndex = $('#tableCP').dataTable().fnAddData(data);
                              var row = $('#tableCP').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tableCP tr#item"+nv.id);
                              tr.find('td:eq(0)').addClass('text-center');
                              tr.find('td:eq(1)').addClass('text-left');
                              tr.find('td:eq(2)').addClass('text-left');
                              
                              
                       }

                        
            });
       });
    
     $('#footerC').on('click', '.edit', function() {
        var tabId2 = []
        $("#code_assureur option").each(function()
        {
            tabId2.push($(this).val())
        });
        alert(tabId2);
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_centre_prescripteur')}}",
            data: { '_token': $('input[name=_token]').val(),
                  'libelle_centre_prescripteur': $('#libelle_centre').val(),
                  'taux_redevance': $('input[name=taux_redevance]').val(),
                  'id_centre_prescripteur': $('input[name=id_centre_prescripteur]').val(),
                  'code_assureur': tabId2
                  }
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_centre").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_centre").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            nv = JSON.parse(msg['nouveau']);
                            tab_centre_part = JSON.parse(msg['centre_partenaires']);
                            var tr = $("#tableCP tr#item"+nv.id);
            
                        tr.find('td:eq(1)').html( "<a class=\'edit-modalC\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle_centre + "," + nv.taux_redevance + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_centre + "</a>");
                        
                        tr.find('td:eq(2)').html(""+ nv.taux_redevance);
                        $('#tableCP').DataTable().rows( tr ).invalidate().draw();
                        
            });
       });
    
     $('#footerC').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: "{{route('dashboard_centre_prescripteur_delete')}}",
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id_centre_prescripteur': $('.didC').text()
              }
          })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_centre").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_centre").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['supprimes']);
                         tab_centre_part = JSON.parse(msg['centre_partenaires']);
                         for (var i=0; i< nv.length; i++){
                          $('#tableCP').dataTable().fnDeleteRow($('#tableCP').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                       
                        
            });
      });
@endsection