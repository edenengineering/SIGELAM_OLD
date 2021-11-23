 <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>  
 <script src="{{ URL::asset('js/dataTables.min.js') }}" ></script>
 <script type="text/javascript">     
 	var tab_examens = {!! $examens->toJson()  !!};  
 	var tab_rendus = {!! $rendus->toJson()  !!};  
 	var tab_interpretation = {!! $rendus->toJson()  !!};
 	var tabTR = {!! $type_resultats->toJson()  !!};
 	var tabC = {!! $conclusions->toJson()  !!};
</script>
 <div id="infosExamen" class="modal fade" role="dialog" style="width: 100%; overflow-y:none">
 <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
        <button type="button" id="clear2" class="close" data-dismiss="modal">&times;</button>
        <h2 id="titre" class="modal-title" >Informations sur l'examen : <span class="did_nomE"></span> <span
							class="hidden did_examen"></span></h2>
 	  </div>
 	  <div class="modal-body">
 	  	<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#rendu">Rendu</a></li>
			  <li><a data-toggle="tab"   href="#interpretation">Interpretation </a></li>
			  <li><a data-toggle="tab"   href="#conclusion">Conclusion </a></li>
			 
		</ul>
		<div class="tab-content">
			<div id="rendu" style="padding-top:30px;" class="tab-pane fade in active"  >
				<div class="row" style="margin-bottom:15px;">
	            	<button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addR"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
	            	<button id="delR" style="margin-left:10px"  class="delete-modal btn btn-danger col-sm-2">
						<span class="glyphicon glyphicon-trash"></span> Supprimer
					</button>
	            </div>
				
			    <div class="table-responsive text-center">
			    	<table id="tabRendu"  class="table table-striped table-borderless blockMe">
                    
		                     
		                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		                      <tr  style ="heigth:10px;">
		                        <th style="text-align:center;width:45px"><input type="checkbox" id="checkall1" /></th>
		                        <th class="text-left">Libellé</th>
		                        
		                        <th class="text-left">Max</th>
		                        <th class="text-left">Min</th>
		                        <th class="text-left">Unité</th>
		                        <th class="text-left">Ordre</th>
		                        <th class="text-left">Type</th>
		                        
		                      </tr>
		                    </thead>
		                  
		                   
		            </table>
			    </div>
			</div>
			<div id="interpretation"  class="tab-pane fade" style="padding-top:30px;">
				<div class="row" style="margin-bottom:15px;">
	            	<button class="btn btn-primary col-sm-2 col-sm-offset-1" id="addI"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
	            	<button id="delI" style="margin-left:10px" class="delete-modal1 btn btn-danger col-sm-2">
										<span class="glyphicon glyphicon-trash"></span> Supprimer
					</button>
	            </div>
			    <div class="table-responsive text-center">
			    	<table id="tabInter"  class="table table-striped table-borderless blockMe">
                    
		                     
		                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		                      <tr  style ="heigth:10px;">
		                        <th style="text-align:center;width:45px"><input type="checkbox" id="checkall" /></th>
		                        <th class="text-left">Libellé</th>
		                      
		                        
		                      </tr>
		                      
		                    </thead>
		                    
		                   
                  </table>
			    </div>
			</div>
			<div id="conclusion"  class="tab-pane fade" style="padding-top:30px;">
				<div class="row" style="margin-bottom:15px;">
	            	<button class="btn btn-primary col-sm-2 col-sm-offset-1" id="addC"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
	            	<button id="delC" style="margin-left:10px" class="delete-modalC btn btn-danger col-sm-2">
										<span class="glyphicon glyphicon-trash"></span> Supprimer
					</button>
	            </div>
			    <div class="table-responsive text-center">
			    	<table id="tabCon"  class="table table-striped table-borderless blockMe">
                    
		                     
		                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		                      <tr  style ="heigth:10px;">
		                        <th style="text-align:center;width:45px"><input type="checkbox" id="checkallC" /></th>
		                        <th class="text-left">Rendu</th>
		                        <th class="text-left">Type Résultat</th>
		                        <th class="text-left">Conclusion</th>
		                      
		                        
		                      </tr>
		                      
		                    </thead>
		                    
		                   
                  </table>
			    </div>
			</div>
		</div>
 	  </div>
      <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-primary" ><i class="glyphicon glyphicon"></i>Fermer</button>
      </div>
    </div>
 </div>
</div> 
<div id="modal_rendu" class="modal fade" role="dialog">
	<div class="modal-dialog">   
		<div class="modal-content">
			<div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
					<button type="button" class="close" id="mdC">&times;</button>
					<h3 class="modal-titleR"></h3>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="form-rendu" role="form">
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="libelle_rendu">Libelle rendu</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" name="libelle_rendu" id="libelle_rendu" required>
							</div>
						</div>
						<input type="hidden" name="code_examen" id="code_examen">
						<div class="form-group">
							<label class="control-label col-sm-2" for="max">Max :</label>
							<div class="col-sm-10">
								<input type="number" min="0" name="max" class="form-control" id="max" required>
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="min">Min :</label>
							<div class="col-sm-10">
								<input type="number" min="0" name="min" class="form-control" id="min" required>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="ordre">Ordre :</label>
							<div class="col-sm-10">
								<input type="number" min="0" name="ordre" class="form-control" id="ordre" required>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="min">Unité :</label>
							<div class="col-sm-10">
								<input type="text" min="0" name="unite" class="form-control" id="unite" required>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="">Type</label>
							<div class="col-sm-10">
								<select class="form-control" name="type" id="typeR" >
									<option value="0">Type 0</option>	
									<option value="1">Type 1</option>
									<option value="2">Type 2</option>
									<option value="3">Type 3</option>
								</select>

							</div>
						</div>
						<input type="hidden" class="form-control" name="id_rendu" id="id_rendu">
				</form>
				<div class="deleteContent">
						<h3 class="text-center">Voulez-vous vraiment supprimer les items sélectionnés ? <span
							class="hidden did"></span></h3>
			    </div>
			</div>
			<div class="modal-footer" id="footerR">
				<button type="button" class="btn actionBtn" >
					<span id="footer_action_button" class='glyphicon'> </span>
				</button>
				<button type="button" class="btn btn-warning" id="mdC1">
					<span class='glyphicon glyphicon-remove'></span> Close
				</button>
		    </div>
		</div>
	</div>
</div>
<div id="modal_inter" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
  	<div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
		<button type="button" class="close" id="miC">&times;</button>
		<h3 class="modal-titleI"></h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal" id="form-inter" role="form">
			
			<input type="hidden" name="id_interpretation" class="form-control" id="id_inter">
			
			<div class="form-group">
				<label class="control-label col-sm-3" for="libelle_inter">Libelle interpretation</label>
				<div class="col-sm-9">
					<input type="name" name="libelle_interpretation" class="form-control" id="libelle_inter" required>
				</div>
			</div>
			
			<input type="hidden" name="code_examen" id="code_examen1">
		</form>
		<div class="deleteContent" id="dcontent">
		  <h3 class="text-center"> Voulez-vous vraiment supprimer les items sélectionnés <span class="hidden did1"></span> ?</h3>
		</div>
	</div>
	<div class="modal-footer" id="footerI">
		<button type="button" class="btn actionBtn1">
			<span id="footer_action_button1" class='glyphicon'> </span>
		</button>
		<button type="button" class="btn btn-warning" id="miC1">
			<span class='glyphicon glyphicon-remove'></span> Close
		</button>
	</div>
  </div>
 </div>
</div>
<div id="modal_conclu" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" style="width:60%;">   
		<div class="modal-content">
			<div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
					<button type="button" class="close mdcC">&times;</button>
					<h3 class="modal-titleC"></h3>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="form-conclusion" role="form">
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="libelle_rendu">Libelle rendu <br /><span class="id_rendu-validation validation-error"></span></label>
							<div class="col-sm-10">
								<select class="form-control" name="id_rendu" id="id_renduC">
									
								</select>	
							</div>
						</div>
						<input type="hidden" name="id_examen" id="code_examen3">
						<div class="form-group">
							<label class="control-label col-sm-2" for="max">Type Résultat <br /><span class="id_type_resultat-validation validation-error"></span></label>
							<div class="col-sm-10">
								<select class="form-control" name="id_type_resultat" id="id_type_resultatC">
									
								</select>
							</div>
						</div>
						
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="min">Conclusion <br /><span class="id_conclusion-validation validation-error"></span></label>
							<div class="col-sm-10">
								<select class="form-control" name="id_conclusion" id="id_conlusionC">
									
								</select>
							</div>
						</div>
						
				</form>
				<div class="deleteContent">
						<h3 class="text-center">Voulez-vous vraiment supprimer les items sélectionnés ? <span
							class="hidden didC"></span></h3>
			    </div>
			</div>
			<div class="modal-footer" id="footerC">
				<button type="button" class="btn actionBtnC" >
					<span id="footer_action_buttonC" class='glyphicon'> </span>
				</button>
				<button type="button" class="btn btn-warning mdcC" >
					<span class='glyphicon glyphicon-remove'></span> Close
				</button>
		    </div>
		</div>
	</div>
</div>
<div id="modATR" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">   
		<div class="modal-content">
			<div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
					<button type="button" class="close mdTR">&times;</button>
					<h3 class="modal-title"><span class="hidden did_rendu"></span>Liste Type résultat</h3>
			</div>
			<div class="modal-body">
				<div class="row" style="margin-bottom:15px;">
	            	<button class="btn btn-primary col-sm-2 col-sm-offset-1"  id="addTR"><i class="glyphicon glyphicon-plus" ></i> Ajouter</button>
	            	<button id="delTR" style="margin-left:10px"  class=" btn btn-danger col-sm-2">
						<span class="glyphicon glyphicon-trash"></span> Supprimer
					</button>
	            </div>
				
			    <div class=" text-center">
			    	<table id="tabTR"  class="table table-striped table-borderless blockMe">
                    
		                     
		                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		                      <tr  style ="heigth:10px;">
		                        <th style="text-align:center;width:45px"><input type="checkbox" id="checkallTR" /></th>
		                        <th class="text-left">Libellé Type Résultat</th>
		                        
		                      </tr>
		                    </thead>
		                  
		                   
		            </table>
			    </div>
				
				
			</div>
			<div class="modal-footer" >
				
				<button type="button" class="btn btn-warning mdTR" >
					<span class='glyphicon glyphicon-remove'></span> Close
				</button>
		    </div>
		</div>
	</div>
</div>
<div id="modalTR" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
  	<div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
		<button type="button" class="close" id="mdcTR">&times;</button>
		<h3 class="modal-titleTR"></h3>
	</div>
	<div class="modal-body">
		<p class="hidden did_rendu2"></p>
		<form class="form-horizontal" id="formTR" role="form">
						
						
						<input type="hidden" name="code_examen" id="code_examen">
						<div class="form-group">
							<label class="control-label col-sm-4" for="max">Type Résultat </label>
							<div class="col-sm-6">
								<select class="form-control" name="libelle_type_resultat" id="libelleTR" >
								  @foreach($type_resultats as $tr)
									<option value="{{ $tr->id }}">{{ $tr->libelle_type_resultat }}</option>	
								  @endforeach
								</select>
							</div>
						</div>
				</form>
		<div class="deleteContent" >
		  <h3 class="text-center"> Voulez-vous vraiment supprimer les items sélectionnés <span class="hidden didTR"></span> ?</h3>
		</div>
	</div>
	<div class="modal-footer" id="footerTR">
		<button type="button" class="btn actionBtnTR">
			<span id="footer_action_buttonTR" class='glyphicon'> </span>
		</button>
		<button type="button" class="btn btn-warning mdcTR" >
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
    <h3 class="infos">Vous devez cocher au moins un dossier !!</h3>
  </div>
  <div class="modal-footer" >
    <button type="button" class="btn btn-warning mdcA">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
 <script src="{{ URL::asset('js/jquery.min.js') }}" ></script> 
 <script src="{{ URL::asset('js/dataTables.min.js') }}" ></script>
		<script type="text/javascript">
 function validate() {
    
    var valid = true;
    valid = checkEmpty($("#libelle_examen"));
    valid = valid && checkEmpty($("#abr"));
    valid = valid && checkEmpty($("#delai"));
    valid = valid && checkEmpty($("#prix"));
    return valid; 
  }

  function validate1() {
    
    var valid = true;
   valid = valid && checkEmpty($("#id_renduC"));
    valid = valid && checkEmpty($("#id_type_resultatC"));
    valid = valid && checkEmpty($("#id_conlusionC"));
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
			 $(document).ready(function(){

			 	  var count = 0; count1=0;

                  

			 	 $('#checkall').change(function(){
			 	 	$('.checkitem').prop("checked",$(this).prop("checked"))
			 	 	 $('.checkitem').each(function(){
				 	 	if($(this).prop("checked")){
				 	 
				 	 		count++;
				 	 	}
				 	 });
			 	 });

			 	 $('#checkallC').change(function(){
			 	 	$('.checkitemC').prop("checked",$(this).prop("checked"))
			 	 	 
			 	 });
			 	 
			 	 $('.checkitem').change(function(){
				 	 $('.checkitem').each(function(){
				 	 	if($(this).prop("checked")){
				 	 
				 	 		count++;
				 	 	}
				 	 });
				});
			 	 $('.checkitem1').change(function(){
			 	 	
				 	 $('.checkitem1').each(function(){
				 	 	if($(this).prop("checked")){
				 	 
				 	 		count1++;
				 	 	}
				 	 });
				});
			 	  $('#checkall1').change(function(){
			 	 	$('.checkitem1').prop("checked",$(this).prop("checked"))
			 	 	 $('.checkitem1').each(function(){
				 	 	if($(this).prop("checked")){
				 	 
				 	 		count1++;
				 	 	}
				 	 });
			 	 });
			 	    $('#checkallTR').change(function(){
			 	 	$('.checkitemTR').prop("checked",$(this).prop("checked"))
			 	 	
			 	 });
			 	  $('#tabRendu').DataTable({
				        "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
				        "iDisplayLength": 5,
				         "columnDefs": [
						    { className: "align-left","targets": [1,2,3,4,5,6]}
						  ]
			    	});
			 	   $('#tabCon').DataTable({
				        "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
				        "iDisplayLength": 5,
				         "columnDefs": [
						    { className: "align-left","targets": [1,2,3]}
						  ]
			    	});
			 	  $('#tabTR').DataTable({
				        "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
				        "iDisplayLength": 5
			    	});
			 	  $('#tabInter').DataTable({
			        "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
			        "iDisplayLength": 5,
			         "columnDefs": [
						    { className: "align-left","targets": [1]}
						  ]
			    });

			  $('#tabRendu').on('dblclick', 'tr', function(event) {

		         if( this.cells[1].innerHTML != "Libellé"){
		         	
		         	var ta = $(this).find("a").data("info").split(",");
		            var str = $(this).attr('id');
		            	var res = str.substring(4);
		          	$(".did_rendu").text(res);
		          	$(".did_rendu2").text(res);
		          	$("#modATR").modal({
		                    keyboard: false,
		                    show : true,
		                    backdrop: "static",
		            });
		          }

		    });
			 $('#infosExamen').on('hidden.bs.modal',function(){
  	     	 
  	     		$('#tabRendu').dataTable().fnClearTable();
  	     		$('#tabInter').dataTable().fnClearTable();
  	     		$('#tabCon').dataTable().fnClearTable();
  	     });
			$('#infosExamen').on('shown.bs.modal', function () {
                
                $.ajax({
                            
                            url: "{{route('dashboard_rendu')}}",
                            data: {
                               
                                'id_examen': $('.did_examen').text()
                            },
                            dataType: "json",
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

                       tab_rendus =  JSON.parse(msg['rendus']);
                       for(var i=0; i < tab_rendus.length ; i++){
							//if(tab_rendus[i].code_examen == parseInt($('.did_examen').text())){
					   if (tab_rendus[i].libelle_rendu == null || tab_rendus[i].libelle_rendu == "null") {
 							var ge = "";
 							var gg = ge;
 						}else{
 							var ge = tab_rendus[i].libelle_rendu ;
 							var gg = ge.replace(/'/g, '')
 						}
					    if (tab_rendus[i].max == null) {
 							tab_rendus[i].max = "";
 						}
 						if (tab_rendus[i].min == null) {
 							tab_rendus[i].min = ""
 						}
 						if (tab_rendus[i].unite == null) {
 							tab_rendus[i].unite = ""
 						}
 						if (tab_rendus[i].ordre == null) {
 							tab_rendus[i].ordre = ""
 						}
								var data = [
										"<input type='checkbox' class='checkitem1' value='" + tab_rendus[i].id + "' />",
										"<a class='edit-modal' style='cursor:pointer' data-info='" + tab_rendus[i].id + "," + 	gg + "," + tab_rendus[i].code_examen + "," + tab_rendus[i].max + "," + tab_rendus[i].min + "," + tab_rendus[i].unite + "," + tab_rendus[i].ordre + "," + tab_rendus[i].type + "'><span class='glyphicon glyphicon-edit'></span> "+ gg + "</a>",
										tab_rendus[i].max,
										tab_rendus[i].min,
										tab_rendus[i].unite,
										tab_rendus[i].ordre,
										tab_rendus[i].type
										];
							    var rowIndex = $('#tabRendu').dataTable().fnAddData(data);
						          var row = $('#tabRendu').dataTable().fnGetNodes(rowIndex);
						          $(row).attr( 'id','item' + tab_rendus[i].id); 
						          var tr = $("#tabRendu tr#item"+tab_rendus[i].id);
						          tr.find('td:eq(0)').addClass('text-center');
						          tr.find('td:eq(1)').addClass('text-left');
						          tr.find('td:eq(2)').addClass('text-left');
						          tr.find('td:eq(3)').addClass('text-left');
						          tr.find('td:eq(4)').addClass('text-left');
						          tr.find('td:eq(5)').addClass('text-left');
						          tr.find('td:eq(6)').addClass('text-left');
							//}
						}

                });  
 				 $.ajax({
                            
                            url: "{{route('dashboard_interpretation')}}",
                            data: {
                               
                                'id_examen': $('.did_examen').text()
                            },
                            dataType: "json"
                        })
                        .done(function(msg){
                        tab_interpretation =  JSON.parse(msg['interpretations']);

						for(var i=0; i < tab_interpretation.length ; i++){
							//if(tab_interpretation[i].code_examen == parseInt($('.did_examen').text())){
								
								var data = [
										"<input type='checkbox' class='checkitem' value='" + tab_interpretation[i].id + "' />",
										"<a class='edit-modal1' style='cursor:pointer' data-info='" + tab_interpretation[i].id + "," + tab_interpretation[i].libelle_interpretation +"," + tab_interpretation[i].code_examen + "><span class='glyphicon glyphicon-edit'></span> " + tab_interpretation[i].libelle_interpretation + "</a>"
										
										];
							    var rowIndex = $('#tabInter').dataTable().fnAddData(data);
						          var row = $('#tabInter').dataTable().fnGetNodes(rowIndex);
						          $(row).attr( 'id','item' + tab_interpretation[i].id); 
						          var tr = $("#tabInter tr#item"+tab_interpretation[i].id);
						          tr.find('td:eq(0)').addClass('text-center');
						          tr.find('td:eq(1)').addClass('text-left');
							//}
						}
                 });
 				$.ajax({
                            
                            url: "{{route('dashboard_conclusion_auto')}}",
                            data: {
                               
                                'id_examen': $('.did_examen').text()
                            },
                            dataType: "json"
                        })
                        .done(function(msg){
                        tab =  JSON.parse(msg['conclusions_automatiques']);

                        
						for(var i=0; i < tab.length ; i++){
							for(var j=0; j < tab_rendus.length; j++){
	                        	if(tab_rendus[j].id == tab[i].id_rendu){
	                        		var ren = tab_rendus[j].libelle_rendu;
	                        		break;
	                        	}
	                        }
	                        	for(var j=0; j < tabTR.length; j++){
		                        	if(tabTR[j].id == tab[i].id_type_resultat){
		                        		var TR = tabTR[j].libelle_type_resultat;
		                        		break;
		                        	}
	                        	}
	                        for(var j=0; j < tabC.length; j++){
	                        	if(tabC[j].id == tab[i].id_conclusion){
	                        		var con = tabC[j].libelle;
	                        		break;
	                        	}
	                        }
								
								var data = [
										"<input type='checkbox' class='checkitemC' value='" + tab[i].id + "' />",
										ren,
										tab[i].libelle_type_resultat,
										con
										];
							    var rowIndex = $('#tabCon').dataTable().fnAddData(data);
						          var row = $('#tabCon').dataTable().fnGetNodes(rowIndex);
						          $(row).attr( 'id','item' + tab[i].id); 
						          var tr = $("#tabCon tr#item"+tab[i].id);
						          tr.find('td:eq(0)').addClass('text-center');
						          tr.find('td:eq(1)').addClass('text-left');
						          tr.find('td:eq(2)').addClass('text-left');
						          tr.find('td:eq(3)').addClass('text-left');
						
						
						}
                 });
       		 });
				
		 	  $(document).on('click', '.edit-modal', function() {
		        $('#footer_action_button').text(" Update");
		        $('#footer_action_button').addClass('glyphicon-check');
		        $('#footer_action_button').removeClass('glyphicon-trash');
		        $('#footer_action_button').removeClass('glyphicon-plus');
		        $('.actionBtn').addClass('btn-success');
		        $('.actionBtn').removeClass('btn-danger');
		        $('.actionBtn').removeClass('btn-primary');
		        $('.actionBtn').removeClass('delete');
		        $('.actionBtn').removeClass('ajout');
		        $('.actionBtn').addClass('edit');
		        $('.modal-titleR').text('Modifier les informations du rendu');
		        $('.deleteContent').hide();
		        $('.form-horizontal').show();
		        var details = $(this).data('info').split(',');
		        
		        for (var i=0; i < details.length; i++){
		        	if(details[i] == "null" || details[i] == null){
		        		details[i] = "";
		        	}
		        }
		        $('#form-rendu #id_rendu').val(details[0]);
		    
		    $('#form-rendu #libelle_rendu').val($(this).text());
		    $('#form-rendu #code_examen').val($('.did_examen').text());
		    $('#form-rendu #max').val(details[3]);
		    $('#form-rendu #min').val(details[4]);
		    $('#form-rendu #ordre').val(details[6]);
		    $('#form-rendu #unite').val(details[5]);
		    $('#form-rendu #typeR').val(details[7]);
		  	
		    
		        $("#modal_rendu").modal({
		                    keyboard: false,
		                    show : true,
		                    backdrop: "static",
		            });
		    });
		 	  
		 	
		     $(document).on('click', '#addR', function() {
		        $('#footer_action_button').text(" Ajout");
		        $('#footer_action_button').addClass('glyphicon-plus');
		        $('#footer_action_button').removeClass('glyphicon-trash');
		        $('#footer_action_button').removeClass('glyphicon-check');
		        $('.actionBtn').addClass('btn-primary');
		        $('.actionBtn').removeClass('btn-danger');
		        $('.actionBtn').removeClass('btn-success');
		        $('.actionBtn').removeClass('delete');
		        $('.actionBtn').removeClass('edit');
		        $('.actionBtn').addClass('ajout');
		        $('#form-rendu #code_examen').val($('.did_examen').text());
		        $('.modal-titleR').text('Ajouter un nouveau rendu');
		        $('.deleteContent').hide();
		        $('.form-horizontal').show();
		        $("#modal_rendu").modal({
		                    keyboard: false,
		                    show : true,
		                    backdrop: "static",
		            });
		    });
		     $("#id_renduC").change(function(){
		     		$.ajax({
				                dataType:'json',
				                data: { 'id_rendu' : $("#id_renduC").val() },
				                url: "{{route('dashboard_get_liste_resultats_rendus')}}"
				               
				            })
				           .done(function(msg){
				             
				              nv = JSON.parse(msg['type_resultats']);
				               $("#id_type_resultatC").find("option").remove();
				               $('#id_type_resultatC').append($('<option>',
				                 {
				                    value: '',
				                    text : "--- Choisissez le type résultat ---",
				                    selected:true
				                }));
			                    for(var i=0;i < nv.length;i++){
			                    	 var  gg = nv[i].libelle_type_resultat
		             	   			 gg = gg.replace(/'/g, '');
				                	$('#id_type_resultatC').append($('<option>',
					                   {
					                      value: nv[i].id,
					                      text : gg	
					                  }));		
								
							     	 
			                    }

				           });

		     });
 
		      $(document).on('click', '#addC', function() {
		      	
		      	 $.ajax({
                            
                            url: "{{route('dashboard_rendu')}}",
                            data: {
                               
                                'id_examen': $('.did_examen').text()
                            },
                            dataType: "json"
                        })
                        .done(function(msg){

                       tabR =  JSON.parse(msg['rendus']);
                       $('#id_renduC').append($('<option>',
		                 {
		                    value: '',
		                    text : "--- Choisissez le rendu ---",
		                    selected:true
		                }));
                      
		                
		             for(var i=0;i < tabR.length;i++){
		             	   var  gg = tabR[i].libelle_rendu
		             	    gg = gg.replace(/'/g, '');
		                  
		                    $('#form-conclusion #id_renduC').append($('<option>',
		                    {
		                        value: tabR[i].id,
		                        text : gg
		                    }));
		              }

                });
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
		        $('#form-conclusion #code_examen3').val($('.did_examen').text());
		        $('.modal-titleC').text('Ajouter une nouvelle conclusion automatique');
		        $('.deleteContent').hide();
		        $('.form-horizontal').show();
		        $("#form-conclusion #id_renduC").find("option").remove();
		        $("#form-conclusion #id_type_resultatC").find("option").remove();
		        $("#form-conclusion #id_conlusionC").find("option").remove();
		            
		             
		              $('#id_conlusionC').append($('<option>',
		                 {
		                    value: '',
		                    text : "--- Choisissez la conclusion ---",
		                    selected:true
		                }));
		                
		             for(var i=0;i < tabC.length;i++){
		                      var  gg = tabC[i].libelle;
		             	    gg = gg.replace(/'/g, '');
		                    $('#form-conclusion #id_conlusionC').append($('<option>',
		                    {
		                        value: tabC[i].id,
		                        text : gg
		                    }));
		              }
		        $("#modal_conclu").modal({
		                    keyboard: false,
		                    show : true,
		                    backdrop: "static",
		            });
		    });
		 	   $(document).on('click', '.edit-modal1', function() {
		       $('#footer_action_button1').text(" Update");
		        $('#footer_action_button1').addClass('glyphicon-check');
		        $('#footer_action_button1').removeClass('glyphicon-trash');
		        $('#footer_action_button1').removeClass('glyphicon-plus');
		        $('.actionBtn1').addClass('btn-success');
		        $('.actionBtn1').removeClass('btn-danger');
		        $('.actionBtn1').removeClass('btn-primary');
		        $('.actionBtn1').removeClass('delete');
		        $('.actionBtn1').removeClass('ajout');
		        $('.actionBtn1').addClass('edit');
		        $('.modal-titleI').text('Modifier les informations d\'une interpretation');
		        $('#dcontent').hide();
		        $('.form-horizontal').show();
		        var details = $(this).data('info').split(',');
		         $('#id_inter').val(details[0]);
			    $('#libelle_inter').val(details[1]);
			    $('#form-inter #code_examen1').val($('.did_examen').text());
		        $("#modal_inter").modal({
		                    keyboard: false,
		                    show : true,
		                    backdrop: "static",
		            });
		    });

 			
	  		 	  $('#mdC').click(function(){
		 	  	$(":input:not('[name=_token],[type=checkbox]')").val('');
		   		$("#modal_rendu").modal("hide");
		   	  });

	  		$('.mdcC').click(function(){
		   		$("#modal_conclu").modal("hide");
		   	  });

	  		  $('.mdTR').click(function(){
	  		  	$('#tabTR').dataTable().fnClearTable();
		   		$("#modATR").modal("hide");
		   	  });

		   	  $('.mdcTR').click(function(){
		   		$("#modalTR").modal("hide");
		   	  });
	  		 	  
		   	   $('#miC').click(function(){
		   	   	$(":input:not('[name=_token],[type=checkbox]')").val('');
		   		$("#modal_inter").modal("hide");
		   	  });

		   	    $('.mdcA').click(function(){
		   			$("#AlerPre").modal("hide");
		   	  	});
		   	   $('#mdC1').click(function(){
		 	  	$(":input:not('[name=_token],[type=checkbox]')").val('');
		   		$("#modal_rendu").modal("hide");
		   	  });
		   	   $('#miC1').click(function(){
		   	   	$(":input:not('[name=_token],[type=checkbox]')").val('');
		   		$("#modal_inter").modal("hide");
		   	  });
		   	    $(document).on('click', '#addI', function() {
		       $('#footer_action_button1').text(" Ajout");
		        $('#footer_action_button1').addClass('glyphicon-plus');
		        $('#footer_action_button1').removeClass('glyphicon-trash');
		        $('#footer_action_button1').removeClass('glyphicon-check');
		        $('.actionBtn1').addClass('btn-primary');
		        $('.actionBtn1').removeClass('btn-danger');
		        $('.actionBtn1').removeClass('btn-success');
		        $('.actionBtn1').removeClass('delete');
		        $('.actionBtn1').removeClass('edit');
		        $('.actionBtn1').addClass('ajout');
		        $('.modal-titleI').text('Ajouter une nouvelle Interpretation');
		        $('#form-inter #code_examen1').val($('.did_examen').text());
		        $('#dcontent').hide();
		        $('.form-horizontal').show();
		        $("#modal_inter").modal({
		                    keyboard: false,
		                    show : true,
		                    backdrop: "static",
		            });
		    });

		   	   $('#modATR').on('shown.bs.modal', function () {
		   	   		 $.ajax({
                            
                            url: "{{route('dashboard_get_liste_resultats_rendus')}}",
                            data: {
                               
                                'id_rendu': $('.did_rendu').text()
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

                       tabTR =  JSON.parse(msg['type_resultats']);
                       for(var i=0; i < tabTR.length ; i++){
							//if(tab_rendus[i].code_examen == parseInt($('.did_examen').text())){
								
								var data = [
										"<input type='checkbox' class='checkitemTR' value='" + tabTR[i].id + "' />",
										tabTR[i].libelle_type_resultat
										];
							    var rowIndex = $('#tabTR').dataTable().fnAddData(data);
						          var row = $('#tabTR').dataTable().fnGetNodes(rowIndex);
						          $(row).attr( 'id','item' + tabTR[i].id); 
						          var tr = $("#tabTR tr#item"+tabTR[i].id);
						          tr.find('td:eq(0)').addClass('text-center');
						          tr.find('td:eq(1)').addClass('text-left');
							//}
						}

                });  

		   	   })
		   	     $(document).on('click', '#addTR', function() {
		       $('#footer_action_buttonTR').text(" Ajout");
		        $('#footer_action_buttonTR').addClass('glyphicon-plus');
		        $('#footer_action_buttonTR').removeClass('glyphicon-trash');
		        $('#footer_action_buttonTR').removeClass('glyphicon-check');
		        $('.actionBtnTR').addClass('btn-primary');
		        $('.actionBtnTR').removeClass('btn-danger');
		        $('.actionBtnTR').removeClass('btn-success');
		        $('.actionBtnTR').removeClass('delete');
		        $('.actionBtnTR').removeClass('edit');
		        $('.actionBtnTR').addClass('ajout');
		        $('.modal-titleTR').text('Ajouter un nouveau Type résultat');
		        $('.deleteContent').hide();
		        $('#modalTR .form-horizontal').show();
		        $("#modalTR").modal({
		                    keyboard: false,
		                    show : true,
		                    backdrop: "static",
		            });
		    });
     
	    $(document).on('click', '#delTR', function() {
		    	var cpt = 0;
            $('.checkitemTR').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });
           if(cpt > 0){
		        var id = $('.checkitemTR:checked').map(function(){
		    			return  $(this).val()
		    	}).get().join();
		    	
		        $('#footer_action_buttonTR').text(" Delete");
		        $('#footer_action_buttonTR').removeClass('glyphicon-check');
		        $('#footer_action_buttonTR').removeClass('glyphicon-plus');
		        $('#footer_action_buttonTR').addClass('glyphicon-trash');
		        $('.actionBtnTR').removeClass('btn-success');
		        $('.actionBtnTR').removeClass('btn-primary');
		        $('.actionBtnTR').addClass('btn-danger');
		        $('.actionBtnTR').removeClass('edit');
		        $('.actionBtnTR').removeClass('ajout');
		        $('.actionBtnTR').addClass('delete');
		        $('.modal-titleTR').text('Supression');
		        $('.deleteContent').show();
		        $('.form-horizontal').hide();
		        $('.didTR').text(id);
		        $("#modalTR").modal({
		                    keyboard: false,
		                    show : true,
		                    backdrop: "static",
		            });
		       }else{
		       		$("#AlerPre .infos").text("Vous devez cocher au moins un type résultat !!!");
                  $("#AlerPre").modal({
                              keyboard: false,
                              show : true,
                              backdrop: "static",
                      });

		       }
		    });
      $(document).on('click', '.delete-modal', function() {
		    	var cpt = 0;
            $('.checkitem1').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });
           if(cpt > 0){
		        var id = $('.checkitem1:checked').map(function(){
		    			return  $(this).val()
		    	}).get().join();
		    	
		        $('#footer_action_button').text(" Delete");
		        $('#footer_action_button').removeClass('glyphicon-check');
		        $('#footer_action_button').removeClass('glyphicon-plus');
		        $('#footer_action_button').addClass('glyphicon-trash');
		        $('.actionBtn').removeClass('btn-success');
		        $('.actionBtn').removeClass('btn-primary');
		        $('.actionBtn').addClass('btn-danger');
		        $('.actionBtn').removeClass('edit');
		        $('.actionBtn').removeClass('ajout');
		        $('.actionBtn').addClass('delete');
		        $('.modal-titleR').text('Supression');
		        $('.deleteContent').show();
		        $('.form-horizontal').hide();
		        $('.did').text(id);
		        $("#modal_rendu").modal({
		                    keyboard: false,
		                    show : true,
		                    backdrop: "static",
		            });
		       }else{
		       		$("#AlerPre .infos").text("Vous devez cocher au moins un rendu !!!");
                  $("#AlerPre").modal({
                              keyboard: false,
                              show : true,
                              backdrop: "static",
                      });

		       }
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
		        $('.deleteContent').show();
		        $('.form-horizontal').hide();
		        $('.didC').text(id);
		        $("#modal_conclu").modal({
		                    keyboard: false,
		                    show : true,
		                    backdrop: "static",
		            });
		       }else{
		       		$("#AlerPre .infos").text("Vous devez cocher au moins un type conclusion !!!");
                  $("#AlerPre").modal({
                              keyboard: false,
                              show : true,
                              backdrop: "static",
                      });

		       }
		    });
      $('form input').on('keypress', function(e) {
          return e.which !== 13;
      });
		    $(document).on('click', '.delete-modal1', function() {
		    	  var cpt = 0;
            $('.checkitem').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });
           if(cpt > 0){
		    	var id = $('.checkitem:checked').map(function(){
		    			return  $(this).val()
		    	}).get().join();
		    	
				
		        $('#footer_action_button1').text(" Delete");
		        $('#footer_action_button1').removeClass('glyphicon-check');
		        $('#footer_action_button1').removeClass('glyphicon-plus');
		        $('#footer_action_button1').addClass('glyphicon-trash');
		        $('.actionBtn1').removeClass('btn-success');
		        $('.actionBtn1').removeClass('btn-primary');
		        $('.actionBtn1').addClass('btn-danger');
		        $('.actionBtn1').removeClass('edit');
		        $('.actionBtn1').removeClass('ajout');
		        $('.actionBtn1').addClass('delete');
		        $('.modal-titleI').text('Supression');
		        $('#dcontent').show();
		        $('#form-inter').hide();
		        $('.did1').text(id);
		        $("#modal_inter").modal({
		                    keyboard: false,
		                    show : true,
		                    backdrop: "static",
		            });
		       }else{
		       			$("#AlerPre .infos").text("Vous devez cocher au moins une interpretation !!!");
                  $("#AlerPre").modal({
                              keyboard: false,
                              show : true,
                              backdrop: "static",
                      });
		       }
		    });
 		var essai;
	
$('#footerR').on('click', '.ajout', function() {
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_rendu')}}",
            data: $('#form-rendu').serialize(),
            })
			.done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_rendu").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_rendu").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                             	for (var i=0; i < tab_examens.length ; i++){
                             		if (tab_examens[i].id == nv.code_examen){
                             			var exam = tab_examens[i].libelle_examen;
                             		}
                             	}
                             	if(nv.libelle_rendu == null || nv.libelle_rendu == "null"){
                             			var gg = "";
                             			var ge = gg;		
                             	}else{
                             		var gg = nv.libelle_rendu;
                             		var ge = gg.replace(/'/g, '')
                             	}
                              var data = [
										   "<input type=\'checkbox\' class=\'checkitem1\' value=\'" + nv.id + "\'/>",
										   "<a class=\'edit-modal\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + ge + "," + nv.code_examen + "," + nv.max + "," + nv.min + "," + nv.unite + "," + nv.ordre + "," + nv.type + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ ge + "</a>",
										    nv.max,
										    nv.min,
										    nv.unite,
										    nv.ordre,
										    nv.type
											];
							var rowIndex = $('#tabRendu').dataTable().fnAddData(data);
					        var row = $('#tabRendu').dataTable().fnGetNodes(rowIndex);
					        $(row).attr( 'id','item' + nv.id);
                            var tr = $("#tabRendu tr#item"+nv.id);
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
 	  $('#footerC').on('click', '.ajout', function() {
 	  	if(validate1()){
        $.ajax({
            type: 'post',
            dataType:'json',
            url: "{{route('dashboard_conclusion_auto')}}",
            data: $('#form-conclusion').serialize(),
            })
			.done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_conclu").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_conclu").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                             	

                              var data = [
										   "<input type=\'checkbox\' class=\'checkitemC\' value=\'" + nv.id + "\'/>",
										    JSON.parse(msg['libelle_rendu']),
										    JSON.parse(msg['libelle_resultat']),
										    JSON.parse(msg['libelle_conclusion']),
											];
							var rowIndex = $('#tabCon').dataTable().fnAddData(data);
					        var row = $('#tabCon').dataTable().fnGetNodes(rowIndex);
					        $(row).attr( 'id','item' + nv.id);
                            var tr = $("#tabCon tr#item"+nv.id);
                             tr.find('td:eq(0)').addClass('text-center');
                             tr.find('td:eq(1)').addClass('text-left'); 
                             tr.find('td:eq(2)').addClass('text-left');  
                             tr.find('td:eq(3)').addClass('text-left'); 
                             
                              
                             
                        		  
                        }

                        
            });
   }
       });
 		$('#footerI').on('click', '.ajout', function() {
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_interpretation')}}",
            data: $('#form-inter').serialize(),
            })
			.done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_inter").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_inter").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                          nv = JSON.parse(msg['nouveau']);
                             	for (var i=0; i < tab_examens.length ; i++){
                             		if (tab_examens[i].id == nv.code_examen){
                             			var exam = tab_examens[i].libelle_examen;
                             		}
                             	}
                              var data = [
										   "<input type=\'checkbox\' class=\'checkitem\' value=\'" + nv.id + "\'/>",
										   "<a class=\'edit-modal1\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle_interpretation + "," + nv.code_examen + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_interpretation + "</a>"
										 ];
							
							var rowIndex = $('#tabInter').dataTable().fnAddData(data);
					        var row = $('#tabInter').dataTable().fnGetNodes(rowIndex);
					        $(row).attr('id','item' + nv.id);
					        var tr = $("#tabInter tr#item"+nv.id);
                             tr.find('td:eq(0)').addClass('text-center');
                             tr.find('td:eq(1)').addClass('text-left');
                              
                        
            });
       });

 		$('#footerTR').on('click', '.ajout', function() {
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_rendu_resultat')}}",
            data: {
            		'id_type_resultat' : $("#libelleTR").val(),
            		'id_rendu' : $(".did_rendu2").text() 
            		},
            })
			.done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              
                              $("#modalTR").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                              $("#modalTR").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                          nv = JSON.parse(msg['nouveau']);
                          nv1 = JSON.parse(msg['libelle']);
                              var data = [
										   "<input type=\'checkbox\' class=\'checkitemTR\' value=\'" + nv.id + "\'/>",
										   nv1
										 ];
							
							var rowIndex = $('#tabTR').dataTable().fnAddData(data);
					        var row = $('#tabTR').dataTable().fnGetNodes(rowIndex);
					        $(row).attr('id','item' + nv.id);
					        var tr = $("#tabTR tr#item"+nv.id);
                             tr.find('td:eq(0)').addClass('text-center');
                             tr.find('td:eq(1)').addClass('text-left');
                              
                        
            });
       });
 		 $('#footerTR').on('click', '.delete', function() {
	        $.ajax({
	            type: 'post',
	            url: "{{route('dashboard_rendu_resultat_delete')}}",
	            data: {
	                'id_type_resultat': $('.didTR').text()
	            }
	        })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                              $("#modalTR").modal('hide');
                             $("#checkallTR").removeAttr("checked");
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                              $("#modalTR").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['supprimes']);
                         
                         for (var i=0; i< nv.length; i++){
                         	$('#tabTR').dataTable().fnDeleteRow( $('#tabTR').dataTable().$("#item"+ nv[i])[0] );
                         	
                         }
                       
                        
            });
  	  });
 	   $('#footerI').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_interpretation')}}",
            data: $('#form-inter').serialize(),
            })
			.done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_inter").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_inter").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            nv = JSON.parse(msg['nouveau']);
                        var tr = $("#tabInter tr#item"+nv.id);
 						
						tr.find('td:eq(1)').html( "<a class=\'edit-modal1\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.libelle_interpretation + "," + nv.code_examen + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.libelle_interpretation + "</a>");
						
						

						
                        
            });
       });
 	   $('#footerR').on('click', '.edit', function() {
 	   	
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_rendu')}}",
            data: $('#form-rendu').serialize(),
            })
			.done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_rendu").modal('hide');
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_rendu").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                        nv = JSON.parse(msg['nouveau']);
                        var tr = $("#tabRendu tr#item"+nv.id);

                        if (nv.libelle_rendu == null || nv.libelle_rendu == "null") {
 							var ge = "";
 						}else{
 							var ge = nv.libelle_rendu ;
 							var gg = ge.replace(/'/g, '')
 						}
						tr.find('td:eq(1)').html( "<a class='edit-modal' style='cursor:pointer' data-info='" + nv.id + "," + gg + "," + nv.code_examen + "," + nv.max + "," + nv.min + "," + nv.unite + "," + nv.ordre + "," + nv.type + "'><span class='glyphicon glyphicon-edit'></span> "+ ge + "</a>");
						if (nv.max == null) {
 							tr.find('td:eq(2)').html("");
 						}else{
 							tr.find('td:eq(2)').html( ""+ nv.max );
 						}
 						if (nv.min == null) {
 							tr.find('td:eq(3)').html( "" );
 						}else{
 							tr.find('td:eq(3)').html( ""+ nv.min );
 						}
 						if (nv.unite == null || nv.unite == "null" ) {
 							tr.find('td:eq(4)').html( "" );
 						}else{
 							tr.find('td:eq(4)').html( ""+ nv.unite );
 						}
 							if (nv.ordre == null) {
 							tr.find('td:eq(5)').html( "" );
 						}else{
 							tr.find('td:eq(5)').html( ""+ nv.ordre );
 						}
 						    tr.find('td:eq(6)').html( ""+ nv.type );
							
						
						
            });
       });
 	   $('#footerR').on('click', '.delete', function() {
	        $.ajax({
	            type: 'post',
	            url: "{{route('dashboard_rendu_delete')}}",
	            data: {
	                '_token': $('input[name=_token]').val(),
	                'id_rendu': $('.did').text()
	            }
	        })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_rendu").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_rendu").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['supprimes']);
                         
                         for (var i=0; i< nv.length; i++){
                         	$('#tabRendu').dataTable().fnDeleteRow( $('#tabRendu').dataTable().$("#item"+ nv[i])[0] );
                         	
                         }
                       
                        
            });
  	  });
  $('#footerC').on('click', '.delete', function() {
	        $.ajax({
	            type: 'post',
	            url: "{{route('dashboard_conclusion_auto_delete')}}",
	            data: {
	                'id_conclusion_auto': $('.didC').text()
	            }
	        })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_conclu").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_conclu").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['supprimes']);
                         
                         for (var i=0; i< nv.length; i++){
                         	$('#tabCon').dataTable().fnDeleteRow( $('#tabCon').dataTable().$("#item"+ nv[i])[0] );
                         	
                         }
                       
                        
            });
  	  });

    $('#footerI').on('click', '.delete', function() {
	        
	        $.ajax({
	            type: 'post',
	            url: "{{route('dashboard_interpretation_delete')}}",
	            data: {
	                '_token': $('input[name=_token]').val(),
	                'id_interpretation': $('.did1').text()
	            }
	        })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_inter").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modal_inter").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                        nv = JSON.parse(msg['supprimes']);
                         
                         for (var i=0; i< nv.length; i++){
                         	$('#tabInter').dataTable().fnDeleteRow( $('#tabInter').dataTable().$("#item"+ nv[i])[0] );
                         	
                         }
                        
            });
    });
    		 
  });
		</script>
</div>