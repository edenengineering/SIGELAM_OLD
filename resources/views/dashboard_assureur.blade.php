@extends("dashboard")

@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>    
 <script type="text/javascript">
     var tab_TP = {!! $type_partenaires->toJson() !!};
    var tab_exam = {!! $examens->toJson() !!};
   var tab_users = {!! $users->toJson() !!};
    
</script>
<div class="tab-content">
    <div class="row" style="margin-bottom:15px;margin-top:15px">
      <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addE"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
      <button id="delE" style="margin-left:10px"  class="delete-modalE btn btn-danger col-sm-2">
      <span class="glyphicon glyphicon-trash"></span> Delete
      </button>
    </div>
     
                    <table id="tableAssureur" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
                    <caption id="cap">
                        <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES ASSUREURS</h4>
                    </caption> 
                 
                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                      <tr style ="heigth:10px;">
                        <th style="text-align:center;width:45px"><input type="checkbox" id="checkallE " /></th>
                        
                        <th class="text-left">Nom Assureur</th>
                        <th class="text-left">Nom Type Partenaire</th>
                        <th class="text-center">Telephone</th>
                        <th class="text-center">Fax</th>
                        <th class="text-left">Adresse</th>
                        <th class="text-left">Mail</th>
                        <th class="text-left">Site web</th>
                      </tr>
                    </thead>
                    @foreach($partenaires as $item)
                      <tr id="item{{$item->id}}">
                        <td class="text-center"><input type="checkbox" class="checkitemE" value="{{$item->id}}" /></td>
                        <td class="text-left"><a class="edit-modalE" style="cursor:pointer"
                            data-info="{{$item->id}},{{$item->id_type_partenaire}},{{$item->libelle_partenaire}},{{$item->adresse}},{{$item->telephone}},{{$item->fax}},{{$item->email}},{{$item->site_web}},{{$item->b_public}},{{$item->b_prive}},{{$item->b_proforma}},{{$item->reduction}}">
                            <span class="glyphicon glyphicon-edit"></span> {{$item->libelle_partenaire}}
                          </a>
                        </td>
                        <td>
                          @foreach($type_partenaires as $t)
                                @if($t->id == $item->id_type_partenaire)
                                    {{$t->libelle_type_partenaire}}
                                @endif
                          @endforeach
                        </td>
                        <td class="text-center">{{$item->telephone}}</td>
                        <td class="text-left">{{$item->fax}}</td>
                        <td class="text-left">{{$item->adresse}}</td>
                        <td class="text-left">{{$item->email}}</td>
                        <td class="text-left">{{$item->site_web}}</td>
                      </tr> 

                   @endforeach
                  </table>
              <div id="add_assureur" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg" style="width:70%">

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button"  class="close mdCE" data-dismiss="modal" >&times;</button>
                        <h2 id="titre" class="modal-titleE" >Ajouter un Assureur</h2>
                      </div>
                      <div class="modal-body">
                        <form  id="form-assureur" class="form-horizontal">
                  
                          {{ csrf_field() }} 
                           <div class="row" style="margin-top: 30px; margin-bottom:5px;">
                                <div class="form-group">
                                        <label for="libelle_partenaire" class="control-label col-sm-2 text-left">Raison Sociale :</label>
                                        <div class="col-sm-7 " style=" padding:0" >
                                          <input type="text" id="libelle_partenaire" name="libelle_partenaire" class="form-control" required>
                                        </div>
                                </div>
                               
                             
                           </div>
                          <div class="row"  style="margin-bottom:5px;">

                                <div class="form-group">
                                        <label for="id_type_partenaire" class="control-label col-sm-2 text-left">Type partenaire :</label>
                                        <div class="col-sm-7 " style=" padding:0" >
                                          <select id="id_type_partenaire" name="id_type_partenaire" class="form-control" >
                                             @foreach($type_partenaires as $p)
                                             <option value="{{$p->id}}">{{$p->libelle_type_partenaire}}</option>
                                             @endforeach
                                          </select>
                                        </div>
                                </div>
                            </div>
                            <div class="row"  style="margin-bottom:5px;">

                                <div class="form-group">
                                        <label for="adresse" class="control-label col-sm-2 text-left">Adresse :</label>
                                        <div class="col-sm-7 " style=" padding:0" >
                                          <input type="text" id="adresse" name="adresse" class="form-control" required>
                                        </div>
                                </div>
                            </div>
                           <div class="row"  style="margin-bottom:5px;">
                                <div class="form-group">
                                        <label for="tel" class="control-label col-sm-2 text-left">Téléphone :</label>
                                        <div class="col-sm-7" style=" padding:0">
                                          <input type="text" id="tel" name="telephone" class="form-control" required>
                                        </div>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom:5px;"> 
                                    <div class="form-group">
                                      <label for="fax"  class="control-label col-sm-2 text-left">Fax : </label>
                                      <div class="col-sm-7" style=" padding:0">
                                      <input type="text" id="fax" name="fax" class="form-control" required>
                                      </div>
                                    
                                   </div>
                            </div>
                            <div class="row" style="margin-bottom:5px;"> 
                                    <div class="form-group">
                                      <label for="email"  class="control-label col-sm-2 text-left">Email : </label>
                                      <div class="col-sm-7" style=" padding:0">
                                      <input type="email" id="email" name="email" class="form-control" required>
                                      </div>
                                    
                                   </div>
                            </div>
                             <div class="row" style="margin-bottom:10px;"> 
                                     <div class="form-group">
                                      <label for="site"  class="control-label col-sm-2 text-left">Site web : </label>
                                      <div class="col-sm-7" style=" padding:0">
                                      <input type="text" id="site" name="site_web" class="form-control" required>
                                      </div>  
                                   </div>
                            </div>
                             <div class="row" style="margin-bottom:10px;">
                                    <div class="form-group">
                                      
                                        <label for="b_public" class="control-label col-sm-2 text-left">Prix B Public :</label>
                                        <div class="col-sm-3" style=" padding:0">
                                          <input type="number" min="0" id="b_public" name="b_public" class="form-control" required>
                                        </div>
                                      
                                    
                                          <label for="b_proforma" class="control-label col-sm-2 text-left">Prix B Proforma :</label>
                                        <div class="col-sm-2" >
                                          <input type="number" min="0" id="b_proforma" name="b_proforma" class="form-control" required>
                                        </div>
                                      
                                    </div>
                             </div>
                             <div class="row">
                                <div class="form-group"> 
                                    <label for="b_prive" class="control-label col-sm-2 text-left">Prix B Prive : </label>
                                        <div class="col-sm-3" style=" padding:0" >
                                          <input type="number" min="0" id="b_prive" name="b_prive" class="form-control" required>
                                        </div>
                                    <label for="reduction" class="control-label col-sm-2 text-left">Reduction(%) :</label>
                                        <div class="col-sm-2" >
                                          <input type="number" min="0" max="100" id="reduction" name="reduction" class="form-control" required>
                                        </div>
                                </div>
                             </div>
                           
                            <input type="hidden" id="id_partenaire" name="id_partenaire" value="">
                        </form>
                        <div class="deleteContentE">
                              <h3 class="text-center">Voulez-vous vraiment supprimer les items sélectionnés ? <span
                                class="hidden didE"></span></h3>
                        </div>
                      </div>
                      <div class="modal-footer" id="footerE">
                        <button type="button" class="btn actionBtnE" >
                        <span id="footer_action_buttonE" class='glyphicon'> </span>
                      </button>
                      <button type="button" class="btn btn-warning mdCE">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>

                  </div>
            </div>
</div>
@include('infos_assureur')   
@endsection
@section('another')
     
     $("#tableAssureur").on('click', '.clickable', function(event) {
              
              if($(this).hasClass('success')){

                $(this).removeClass('success'); 
              } else {
                $(this).addClass('success').siblings().removeClass('success');
              }
            });
     var tab_part_trait = []
        $('#tableAssureur').on('dblclick', 'tr', function(event) {
             if(this.cells[1].innerHTML != "Nom Assureur"){
             $('#tabAssExam').dataTable().fnClearTable();
            $('#tabFacture').dataTable().fnClearTable();
            
            var table = document.getElementById('tableAssureur');
            var str = $(this).attr('id');
            
            var res = str.substring(4);
          
            $('.did_partenaire').text(res);
            $(".dnom_part").text($(this).find("a").text())
               $("#infosAssureur").modal({
                                  keyboard: false,
                                  show : true,
                                  backdrop: "static"
                });
            }

     });
     
     
      
     var tab_assur = $('#tableAssureur').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                "processing": true
      });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
    var countE = 0;
         $('#checkallE').change(function(){
          $('.checkitemE').prop("checked",$(this).prop("checked"))
           $('.checkitemE').each(function(){
            if($(this).prop("checked")){
           
              countE++;
            }
           });

           
         });
         
         $('.checkitemE').change(function(){
           $('.checkitemE').each(function(){
            if($(this).prop("checked")){
           
              countE++;
            }
           });

          
        });
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
            $('.modal-titleE').text('Modifier les informations de l\'assureur');
            $('.deleteContentE').hide();
            $('.form-horizontal').show();
            var details = $(this).data('info').split(',');

            $('#form-assureur #id_partenaire').val(details[0]);
        
        $('#form-assureur #libelle_partenaire').val(details[2]);
        $('#form-assureur #id_type_partenaire').val(details[1]);
        
        $('#form-assureur #adresse').val(details[3]);
        $('#form-assureur #tel').val(details[4]);
        $('#form-assureur #fax').val(details[5]);
        $('#form-assureur #email').val(details[6]);
        $('#form-assureur #site').val(details[7]);
        $('#form-assureur #b_public').val(details[8]);
        $('#form-assureur #b_prive').val(details[9]); 
        $('#form-assureur #b_proforma').val(details[10]);
        
        $('#form-assureur #reduction').val(details[11]);
            $("#add_assureur").modal({
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
            $('.modal-titleE').text('Ajouter un nouvel Assureur');
            $('.deleteContentE').hide();
            $('.form-horizontal').show();
            $("#add_assureur").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
        
            $('.mdCE').click(function(){
           $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
            $("#add_assureur").modal("hide");
            });
          
        $(document).on('click', '.delete-modalE', function() {
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
            $("#add_assureur").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
          }
        });
        
  $('#footerE').on('click', '.ajout', function() {
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_assureur')}}",
            data: $('#form-assureur').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_assureur").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_assureur").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                              for (var i=0; i < tab_TP.length ; i++){
                                if (tab_TP[i].id == nv.id_type_partenaire){
                                  var part = tab_TP[i].libelle_type_partenaire;
                                }
                              }
                                
                              var data = [
                               "<input type=\'checkbox\' class=\'checkitemE\' value=\'" + nv.id + "\'/>",
                               "<a class=\'edit-modalE\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.id_type_partenaire + "," + nv.libelle_partenaire + "," + nv.adresse + "," + nv.telephone + "," + nv.fax + "," + nv.email + "," + nv.site_web + "," + nv.b_public + "," + nv.b_prive + "," + nv.b_proforma + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_partenaire + "</a>",
                                part,
                                nv.telephone,
                                nv.fax,
                                nv.adresse,
                                nv.email,
                                nv.site_web
                              ];
                              var rowIndex = $('#tableAssureur').dataTable().fnAddData(data);
                              var row = $('#tableAssureur').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tableAssureur tr#item"+nv.id);
                              tr.find('td:eq(0)').addClass('text-center');
                              tr.find('td:eq(1)').addClass('text-left');
                              tr.find('td:eq(2)').addClass('text-left');
                              tr.find('td:eq(3)').addClass('text-center');
                              tr.find('td:eq(4)').addClass('text-left');
                              tr.find('td:eq(5)').addClass('text-left');
                              tr.find('td:eq(6)').addClass('text-left');
                              tr.find('td:eq(7)').addClass('text-left');
                       }

                        
            });
       });
    
     $('#footerE').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_assureur')}}",
            data: $('#form-assureur').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_assureur").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_assureur").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            
                            nv = JSON.parse(msg['nouveau']);
                            
                           for (var i=0; i < tab_TP.length ; i++){
                                if (tab_TP[i].id == nv.id_type_partenaire){
                                  var part = tab_TP[i].libelle_type_partenaire;
                                }
                              }
                            var tr = $("#tableAssureur tr#item"+nv.id);
            
                        tr.find('td:eq(1)').html( "<a class=\'edit-modalE\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.id_type_partenaire + "," + nv.libelle_partenaire + "," + nv.adresse + "," + nv.telephone + "," + nv.fax + "," + nv.email + "," + nv.site_web + "," + nv.b_public + "," + nv.b_prive + "," + nv.b_proforma + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_partenaire + "</a>");
                        tr.find('td:eq(2)').html(""+ part);
                        tr.find('td:eq(3)').html(""+ nv.telephone);
                        tr.find('td:eq(4)').html(""+ nv.fax);
                        tr.find('td:eq(5)').html(""+ nv.adresse);
                        tr.find('td:eq(6)').html(""+ nv.email);
                        tr.find('td:eq(7)').html(""+ nv.site_web);
                        $('#tableAssureur').DataTable().rows( tr ).invalidate().draw();
                        
            });
       });
    
     $('#footerE').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: "{{route('dashboard_assureur_delete')}}",
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id_partenaire': $('.didE').text()
              }
          })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_assureur").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#add_assureur").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['supprimes']);
                         
                         for (var i=0; i< nv.length; i++){
                          $('#tableAssureur').dataTable().fnDeleteRow( $('#tableAssureur').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                       
                        
            });
      });
  
@endsection