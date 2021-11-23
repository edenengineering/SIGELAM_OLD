
@extends("dashboard")
@section('add_style')
.spinner{
    width: 80px;
    height: 80px;
    
    border: 2px solid #f3f3f3;
    border-top:3px solid #f25a41;
    border-radius: 100%;
    
    position: absolute;
    top:0;
    bottom:0;
    left:0;
    right: 0;
    margin: auto;
    
    animation: spin 1s 5 linear;
}

@keyframes spin {
    from{
        transform: rotate(0deg);
    }to{
        transform: rotate(360deg);
    }
}

@endsection
@section('d_content')
<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>        


<!--<div class="spinner"></div> -->
<div class="tab-content">
 
 
     <div class="row" style="margin-bottom:15px; margin-top:15px;">
          <button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addF"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
          <button id="delF" style="margin-left:10px"  class="delete-modalF btn btn-danger col-sm-2">
          <span class="glyphicon glyphicon-trash"></span> Delete
          </button>
    </div>
                    
                    <table id="tabfour" style="width:100%; heigth:60%" class="table table-striped table-responsive">
                      <caption id="cap">
                          <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES FOURNISSEURS</h4>
                      </caption>  
                       <!-- rgb(150,150,150)-->
                      <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
                        <tr  style ="heigth:10px;">
                          <th style="text-align:center;width:45px"><input type="checkbox" id="checkallF" /></th>
                          <th>Raison Sociale</th>
                          <th>Commercial</th>
                          <th>Téléphone</th>
                          <th>Adresse</th>
                          <th>Mail</th>
                          <th>Site web</th>
                        </tr>
                        
                      </thead>
                       @foreach($fournisseurs as $item)
                      <tr id="item{{$item->id}}">
                        <td class="text-center"><input type="checkbox" class="checkitemF" value="{{$item->id}}" /></td>
                        <td class="text-left"><a class="edit-modalF" style="cursor:pointer"
                            data-info="{{$item->id}},{{$item->raison_sociale}},{{$item->adresse}},{{$item->telephone}},{{$item->site_web}},{{$item->fax}},{{$item->email}},{{$item->commercial}}">
                            <span class="glyphicon glyphicon-edit"></span> {{$item->raison_sociale}}
                          </a>
                        </td>
                        <td class="text-left">{{$item->commercial}}</td>
                        <td class="text-left">{{$item->telephone}}</td>
                        <td class="text-left">{{$item->adresse}}</td>
                        <td class="text-left">{{$item->email}}</td>
                        <td class="text-left">{{$item->site_web}}</td>
                      </tr>
                      @endforeach
                  </table>
    
</div>
<div id="addFour" class="modal fade" role="dialog" style="width: 80%">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
        <button type="button" id="" class="close mdcF" data-dismiss="modal">&times;</button>
        <h2 id="titre" class="modal-titleF" ></h2>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" id="form-four" role="form" >
            
           {{ csrf_field() }}
            
            
        <div class="form-group">
            <label class="control-label col-sm-2 text-left" for="raison">Raison Sociale :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="raison" name="raison_sociale">
            </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2 text-left" for="commercial">Commercial :</label>
          <div class="col-sm-8"> 
            <input type="text" class="form-control" id="commercial" name="commercial" >
          </div>
          
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2 text-left" for="tel">Téléphone :</label>
            <div class="col-sm-8">
              <input  type="text" class="form-control" name="telephone" id="tel" placeholder="">
            </div>
         </div>
        <div class="form-group">
            <label class="control-label col-sm-2 text-left" for="adr">Adresse</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="adresse" id="adr" placeholder="">
            </div>
         </div>
        <div class="form-group">
            <label class="control-label col-sm-2 text-left" for="fax">Fax :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="fax" id="fax" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2 text-left" for="mail">Mail :</label>
            <div class="col-sm-8">
              <input  type="email" class="form-control" name="email" id="mail" placeholder="">
            </div>
        </div>  
        <div class="form-group">
            <label class="control-label col-sm-2 text-left" for="site">Site Web :</label>
            <div class="col-sm-8"> 
                <input  type="text" class="form-control" name="site_web" id="site" placeholder="">
            </div>
           
        </div>
          <input type="hidden" id="id_fournisseur" name="id_fournisseur" value="">
      </form>
      <div class="deleteContentF">
            <h3 class="text-center">Voulez-vous vraiment supprimer les items sélectionnés ? <span
              class="hidden didF"></span></h3>
      </div>
      </div>
     <div class="modal-footer" id="footerF">
          <button type="button" class="btn actionBtnF" >
          <span id="footer_action_buttonF" class='glyphicon'> </span>
        </button>
        <button type="button" class="btn btn-warning mdcF">
          <span class='glyphicon glyphicon-remove'></span> Close
        </button> 
     </div>
    </div>

  </div>
</div>
<script type="text/javascript">
    
</script>
@include('infos_fournisseur')
@endsection

@section('another')
    
    $("#tabfour").on('click', '.clickable', function(event) {
              
              if($(this).hasClass('success')){

                $(this).removeClass('success'); 
              } else {
                $(this).addClass('success').siblings().removeClass('success');
              }
            });
  $('#tabfour').on('dblclick', 'tr', function(event) {
      if(this.cells[1].innerHTML != "Raison Sociale"){           
            
            var str = $(this).attr('id');
            
            var res = str.substring(4);
            
            $('.did_fournisseur').text(res);
            $('.did_nomF').text( $(this).find('a').text());
                $("#infosfour").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static"
                });
            }
  });
  $('#tabfour').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
  
     var countF = 0;

                  

         $('#checkallF').change(function(){
          $('.checkitemF').prop("checked",$(this).prop("checked"))
           $('.checkitemF').each(function(){
            if($(this).prop("checked")){
           
              countF++;
            }
           });

           if(countF > 0){
            $('#delF').removeAttr('disabled');
            countF = 0;
           }else{
            $('#delF').attr('disabled','disabled');
            countF = 0;
           }
         });
         
         $('.checkitemF').change(function(){
           $('.checkitemF').each(function(){
            if($(this).prop("checked")){
           
              countF++;
            }
           });

           if(countF > 0){
            $('#delF').removeAttr('disabled');
            countF = 0;
           }else{
            $('#delF').attr('disabled','disabled');
            countF = 0;
           }
        });
        $(document).on('click', '.edit-modalF', function() {
            $('#footer_action_buttonF').text(" Update");
            $('#footer_action_buttonF').addClass('glyphicon-check');
            $('#footer_action_buttonF').removeClass('glyphicon-trash');
            $('#footer_action_buttonF').removeClass('glyphicon-plus');
            $('.actionBtnF').addClass('btn-success');
            $('.actionBtnF').removeClass('btn-danger');
            $('.actionBtnF').removeClass('btn-primary');
            $('.actionBtnF').removeClass('delete');
            $('.actionBtnF').removeClass('ajout');
            $('.actionBtnF').addClass('edit');
            $('.modal-titleF').text('Modifier les informations du Fournisseur');
            $('.deleteContentF').hide();
            $('.form-horizontal').show();
            var details = $(this).data('info').split(',');
            $('#form-four #id_fournisseur').val(details[0]);
    
            $('#form-four #raison').val(details[1]);
            $('#form-four #adr').val(details[2]);
            $('#form-four #tel').val(details[3]);
            $('#form-four #site').val(details[4]);
            $('#form-four #fax').val(details[5]);
            $('#form-four #mail').val(details[6]);
            $('#form-four #commercial').val(details[7]);        
            $("#addFour").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
        
      
         $(document).on('click', '#addF', function() {
            $('#footer_action_buttonF').text(" Ajout");
            $('#footer_action_buttonF').addClass('glyphicon-plus');
            $('#footer_action_buttonF').removeClass('glyphicon-trash');
            $('#footer_action_buttonF').removeClass('glyphicon-check');
            $('.actionBtnF').addClass('btn-primary');
            $('.actionBtnF').removeClass('btn-danger');
            $('.actionBtnF').removeClass('btn-success');
            $('.actionBtnF').removeClass('delete');
            $('.actionBtnF').removeClass('edit');
            $('.actionBtnF').addClass('ajout');
            $('.modal-titleF').text('Ajouter un nouveau Fournisseur');
            $('.deleteContentF').hide();
            $('.form-horizontal').show();
            $("#addFour").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
         
            $('.mdcF').click(function(){
           $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
            $("#addFour").modal("hide");
            });
          
        $(document).on('click', '.delete-modalF', function() {
           var cpt = 0;
            $('.checkitemF').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });

           if(cpt > 0){
                  var id = $('.checkitemF:checked').map(function(){
                    return  $(this).val()
                }).get().join();
                  $('#footer_action_buttonF').text(" Delete");
                  $('#footer_action_buttonF').removeClass('glyphicon-check');
                  $('#footer_action_buttonF').removeClass('glyphicon-plus');
                  $('#footer_action_buttonF').addClass('glyphicon-trash');
                  $('.actionBtnF').removeClass('btn-success');
                  $('.actionBtnF').removeClass('btn-primary');
                  $('.actionBtnF').addClass('btn-danger');
                  $('.actionBtnF').removeClass('edit');
                  $('.actionBtnF').removeClass('ajout');
                  $('.actionBtnF').addClass('delete');
                  $('.modal-titleF').text('Supression');
                  $('.deleteContentF').show();
                  $('.form-horizontal').hide();
                  $('.didF').text(id);
                  $("#addFour").modal({
                              keyboard: false,
                              show : true,
                              backdrop: "static",
                      });
              }
        });
        
    
  $('#footerF').on('click', '.ajout', function() {
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_fournisseur')}}",
            data: $('#form-four').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#addFour").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#addFour").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                              
                              
                              var data = [
                               "<input type=\'checkbox\' class=\'checkitemF\' value=\'" + nv.id + "\'/>",
                               "<a class=\'edit-modalF\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.raison_sociale + "," + nv.adresse + "," + nv.telephone + "," + nv.site_web + "," + nv.fax + "," + nv.email + "," + nv.commercial + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.raison_sociale + "</a>",
                                nv.commercial,
                                nv.telephone,
                                nv.adresse,
                                nv.email,
                                nv.site_web
                                
                              ];
                              var rowIndex = $('#tabfour').dataTable().fnAddData(data);
                              var row = $('#tabfour').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tabfour tr#item"+nv.id);
                              tr.find('td:eq(0)').addClass('text-center');
                              tr.find('td:eq(1)').addClass('text-left');
                              tr.find('td:eq(2)').addClass('text-left');
                              tr.find('td:eq(3)').addClass('text-left');
                              tr.find('td:eq(4)').addClass('text-left');
                              tr.find('td:eq(5)').addClass('text-left');
                              tr.find('td:eq(6)').addClass('text-left');
                              
                       }

                        
            });
       });
    
     $('#footerF').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_fournisseur')}}",
            data: $('#form-four').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#addFour").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#addFour").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            nv = JSON.parse(msg['nouveau']);
                           
                            var tr = $("#tabfour tr#item"+nv.id);
            
                        tr.find('td:eq(1)').html( "<a class=\'edit-modalF\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.raison_sociale + "," + nv.adresse + "," + nv.telephone + "," + nv.site_web + "," + nv.fax + "," + nv.email + "," + nv.commercial + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.raison_sociale + "</a>");
                        tr.find('td:eq(2)').html(""+ nv.telephone);
                        tr.find('td:eq(3)').html(""+ nv.adresse);
                        tr.find('td:eq(4)').html(""+ nv.email);
                        tr.find('td:eq(5)').html(""+ nv.site_web);
                        $('#tabfour').DataTable().rows( tr ).invalidate().draw();
                        
            });
       });
    
     $('#footerF').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: "{{route('dashboard_fournisseur_delete')}}",
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id_fournisseur': $('.didF').text()
              }
          })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#addFour").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#addFour").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }

                         nv = JSON.parse(msg['supprimes']);
                        
                         for (var i=0; i< nv.length; i++){
                          $('#tabfour').dataTable().fnDeleteRow( $('#tabfour').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                       
                        
            });
      });
    
@endsection