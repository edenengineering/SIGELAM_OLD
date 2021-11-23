<script src="{{ URL::asset('js/jquery.min.js') }}" ></script>  
     <script src="{{ URL::asset('js/dataTables.min.js') }}" ></script>
 <script type="text/javascript">     
 	 var tab_exam_part = {!! $examen_partenaires->toJson() !!};
</script>
<div id="infosAssureur" class="modal fade" role="dialog">
 <div class="modal-dialog  modal-lg" style="width: 80%">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
        <button type="button" id="clear1" class="close" data-dismiss="modal">&times;</button>
        <h2 id="titre" class="modal-title" >Informations sur le Partenaire <span class="dnom_part"></span> <span
							class="hidden did_partenaire"></span></h2>
      </div>
      <div class="modal-body">
        	<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#Examen">Examen</a></li>
			  <li><a data-toggle="tab"   href="#facture">Facture </a></li>
			  <li><a data-toggle="tab"   href="#factureD">Facture detaillées </a></li>
			</ul>

			<div class="tab-content">
			 <!-- Tab Examen -->
			 <div id="Examen" class="tab-pane fade in active">
			 	
				<table id="tabAssExam" style="width:100%; heigth:60%; margin-top:30px;" class="table table-striped table-responsive blockMe">
                    
		                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		                      <tr  style ="heigth:10px;">
		                        <th class="text-left">Libellé</th>
		                        <th class="text-left">Quantité</th>                        
		                        <th class="text-left">Prix B</th>
		                        <th class="text-left">Delai</th>
		                        <th class="text-left">Status</th>
		                       
		                      </tr>
		                      
		                    </thead>
		                   
                </table>
			 </div>
			
			 <div id="facture" class="tab-pane fade">
			 	
			 		
			 		<legend>Facture</legend>
			 		<table id="tabFacture" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMe">
                    
		                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		                      <tr  style ="heigth:10px;">
		                       <th style="text-align:center;width:45px"><input type="checkbox" id="checkallFA" /></th>
		                        <th>Du</th>
		                        <th>Au</th>
		                        <th>Réference</th>
		                        <th>Estimé</th>
		                        <th>Net Perçu</th>
		                        <th>Etat</th>
		                        <th>Reste</th>
		                        
		                      </tr>
		                      
		                    </thead>
		                    
		                    
                	</table>
                	<div class="form-group row">
                  		
                  		<button style="margin-left:5px" class="btn btn-success col-sm-2"><i class="glyphicon glyphicon-print"></i>Imprimer</button>
                  		<button style="margin-right:5px" id="addFact" class="btn btn-primary col-sm-2 col-sm-offset-2"><i class="glyphicon glyphicon-plus-sign"></i>Ajouter</button>

		                <button style="margin-right:5px" id="delF" class="btn btn-danger col-sm-2 delete-modalM"><i class="glyphicon glyphicon-trash"></i>Supprimer</button>
                  		
		                  		
		        	</div>
			 </div>
			<!--  <div id="historiqueP" style="margin-bottom:30px;" class="tab-pane fade">
			 	
			 		<legend>Historique des Paiements</legend>
			 		<table id="tabHP" style="width:100%; heigth:60%" class="table table-striped table-responsive">
                    
		                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		                      <tr  style ="heigth:10px;">
		                       
		                        <th>Ref. Facture</th>
		                        <th>N° Dossier</th>
		                        <th>Noms et Prénoms</th>
		                        <th>Versé</th>
		                        <th>Reste</th>
		                        <th>Date regl.</th>
		                        
		                      </tr>
		                      
		                    </thead>
		                    <tbody>
		                    	<tr>
		                    	
		                    	 <td>fdsf</td>
		                    	 <td>sdf</td>
		                    	 <td>fdsf</td>
		                    	 <td>sdf</td>
		                    	 <td>sdf</td>
		                    	 <td>fds</td>
		                    	</tr>
		                    </tbody>
		                    
                	</table>
                	<div class="form-group row">
                  		
                  		<button style="margin-left:5px" class="btn btn-success col-sm-2"><i class="glyphicon glyphicon-print"></i>Imprimer</button>
                  		 		
		        	</div>
			 </div> -->
			 <div id="factureD" class="tab-pane fade">
			 		<div class="row" style="margin-top:30px;">
			 			<fieldset>
			 				<legend>Période des factures</legend>
			 				<div class="row">
			 					<div class="form-group">
				 					<label for="duF" class="control-label col-sm-1 col-sm-offset-1">DU</label>
				 					<div class="col-sm-2">
				 						<input type="date" id="duF" name="du" class="form-control">	
				 					</div>
				 					<label for="auF" class="row control-label col-sm-1">AU</label>
				 					<div class="col-sm-2">
				 						<input type="date" id="auF" name="au" class="form-control">	
				 					</div>
				 					<div class="col-sm-2">
				 						<button id="btnOkFD" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> OK</button>	
				 					</div>
			 					</div>
			 					
			 				</div>
			 				
			 			</fieldset>	
			 		</div>
			 		<table id="tabFD" style="width:100%; heigth:60%; margin-top:30px;" class="table table-striped table-responsive blockMe">
                    
		                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		                      <tr  style ="heigth:10px;">
		                        <th>N° Dossier</th>
		                        <th>Date</th>
		                        <th>Patient</th>
		                        <th>Code examen</th>
		                        <th>Libelle examen</th>
		                        <th>Qté</th>
		                        <th>Total</th>
		                        <th>Reduc.</th>
		                        <th>B</th>
		                        <th>Ticket M.</th>
		                        <th>Montant R</th>
		                        
		                      </tr>
		                      
		                    </thead>
                </table>
			 	<div class="form-group row">
		                  		<button style="margin-left:5px" class="btn btn-success col-sm-2"><i class="glyphicon glyphicon-print"></i>Imprimer</button>
		                  		<button style="margin-right:5px" class="btn btn-primary col-sm-2 col-sm-offset-4"><i class="glyphicon glyphicon-edit"></i>Modifier</button>
		                  		
		                  		
		        </div>
			 		
			 </div>
			</div>
		</div>	
		<div class="modal-footer">
			<button class="btn btn-success" data-dismiss="modal"><i class="fa fa-"></i>Fermer</button>
		</div>	
	</div> 
   </div>
 </div>
  <div id="modExam" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                  	<div class="modal-content">
                  		<div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
	                        <button type="button"   class="close mdCEX" >&times;</button>
	                        <h2 id="titre" class="modal-titleEX" >Modifier le statut d'un Examen</h2>
	                    </div>
	                    <div class="modal-body">
	                    	<form  id="form-modExam" class="form-horizontal">
	                  
	                        
	                          
	                          
	                          <div class="row" >
	                          	 <div class="form-group">
	                          	 		<label class="control-label col-sm-3 text-left">Pris en charge : </label>
                                    
                                    	<div class="col-sm-3">
                                    		<label class="control-label" ><input type="radio" id="PEC" value="PEC" checked="checked" name="prise_en_charge">Oui</label>
                                    	</div>
                                        <div class="col-sm-3">
                                        	<label class="control-label" ><input type="radio" id="NPC" value="NPC" name="prise_en_charge">Non</label>
                                        </div>
                                    
	                          	 </div>
	                          </div>
	                          <input type="hidden" id="id_examen_partenaire" name="id_examen_partenaire">
	                        </form>
	                    </div>
	                    <div class="modal-footer" id="footerEX">
						<button type="button" class="btn btn-success actionBtnEX  edit" >
							<span id="footer_action_buttonEX" class='glyphicon glyphicon-check'> Update</span>
						</button>
						<button type="button" class="btn btn-warning mdCEX" >
							<span class='glyphicon glyphicon-remove'></span> Close
						</button>
				    </div>
                  	</div>
                  </div>
	          </div>
	          <div id="modFacture" class="modal fade" role="dialog" style="overflow-y: scroll;">
                  <div class="modal-dialog modal-lg">
                  	<div class="modal-content">
                  		<div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
	                        <button type="button"  class="close mdcMF" >&times;</button>
	                        <h2 id="titre" class="modal-title" > <span class="hidden did_facture"></span> Modifier une Facture</h2>
	                    </div>
	                    <div class="modal-body">
	                    	
	                    	 
	                    		<div class="row" style="margin:15px;margin-bottom:30px;margin-top:30px">
						 			<fieldset >
						 				<legend>Période</legend>
						 				
					 					<div class="form-group">
						 					<label for="du" class="col-sm-1 control-label">DU</label>
						 					<div class="col-sm-3">
						 						<input type="date" id="du" name="du" class="form-control">	
						 					</div>
						 					<label for="au" class="col-sm-1 control-label">AU</label>
						 					<div class="col-sm-3">
						 						<input type="date" id="au" name="au" class="form-control">	
						 					</div>
					 						<div class="col-sm-1 divBtnOK" style="margin-right:5px">
					            			    <button id="btnOk" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> OK</button>   
					          				</div>	

					 					</div>
						 				
						 			</fieldset>	
						 			
						 		</div>
						 		<table id="tabModFact" style="width:100%; heigth:60%; margin-top:30px;" class="table table-striped table-responsive blockMeMF">
			                    
					                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
					                      <tr  style ="heigth:10px;">
					                      	<th style="text-align:center;width:45px"><input type="checkbox" id="CHKMF_all" /></th>
					                        <th>Code</th>
					                        <th>Date</th>
					                        <th>Noms et Prénoms</th>
					                        <th>Total</th>
					                        <th>Percu</th>
					                        <th>Statut</th>
					                      </tr>
					                      
					                    </thead>
					                    
				                </table>
				                <div class="row" style="margin-bottom:5px;">
				                	<div class="form-group">
				                		<label for="est" class="col-sm-2 control-label text-left">Estimé</label>
					 					<div class="col-sm-3">
					 						<input type="text" min="0" disabled id="est" style="color:red;font-size:1.4em" name="estime" class="form-control">	
					 					</div>
					 					<label for="ref" class="col-sm-2 control-label text-left">Réference</label>
					 					<div class="col-sm-3">
					 						<input type="text" id="ref" disabled name="reference" style="color:red;font-size:1.2em" class="form-control">	
					 					</div>
				                	</div>
				                </div>
				                
						 		<div class="row" style="margin-bottom:5px;">
						 			<div class="form-group">
						 						<label for="percu" class="col-sm-2 control-label text-left">Net Percu</label>
							 					<div class="col-sm-3">
							 						<input type="text" disabled id="percu" style="color:red;font-size:1.4em" name="dateR" class="form-control">	
							 					</div>
							 					<label for="reste" class="col-sm-2 control-label text-left">Reste</label>
							 					<div class="col-sm-3">
							 						<input type="text" disabled id="reste" style="color:red;font-size:1.4em" name="reste" class="form-control">	
							 					</div>
							 					
						 			</div>	
						 		</div>
						 		
						 		<div style="margin-bottom:5px;" class="row">
						 			<div class="form-group">

							 					<label for="MR" class="col-sm-2 control-label text-left">Mode de règlement</label>
							 					<div class="col-sm-3">
							 						<select id="MR" name="modeR" class="form-control" >
                                          
			                                          <option value="1" selected>ESPECES</option>
			                                          <option value="2">CHEQUE</option>
			                                          <option value="4">CARTE BANCAIRE</option>
			                                          <option value="3">VIREMENT</option>
			                                          
			                                        </select>
							 					</div>
							 					<label for="numC" class="col-sm-2 control-label text-left">N° chèque</label>
							 					<div class="col-sm-3">
							 						<input type="text" id="numC" name="numero" class="form-control">	
							 					</div>
							 					
						 			</div>	
						 		</div>
						 		
						 		
							 	<div class="form-group row">
				                  		<label for="banque" class="col-sm-2 control-label text-left">Banque</label>
							 					<div class="col-sm-3">
							 						<input type="text" id="banque" name="banque" class="form-control">	
							 					</div>
							 					<label for="SV" class="col-sm-2 control-label text-left">Somme Versée</label>
							 					<div class="col-sm-3">
							 						<input type="number" style="color:blue; font-size:1.4em" disabled id="SV" name="dateR" class="form-control">	
							 					</div>
					 					<button  id="btnValFact" style="margin-right:5px;width:100px" class="btn btn-success col-sm-1 "><i class="glyphicon glyphicon-ok-sign"></i> Valider</button>		
						        </div>
						        <div class="row">
						        		 <label style="font-size:1.5em" class="error_somme hidden label label-danger col-sm-offset-2"></label>
						        </div>
					    <legend>Historique des Paiements</legend>
			 			<table id="tabHP" style="width:100%; heigth:60%" class="table table-striped table-responsive blockMeMF">
                    
		                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		                      <tr  style ="heigth:10px;">
		                       
		                        <th>N° Dossiers</th>
		                        <th>Agent</th>
		                        <th>Versé</th>
		                        <th>Date regl.</th>
		                        <th>Heure regl.</th>
		                        
		                      </tr>
		                      
		                    </thead>
                	</table>
	                    </div>
	                    <div class="modal-footer">
	                        <button class="btn btn-success mdcMF" ><i class="fa fa-"></i>Fermer</button>
	                    </div>
                  	</div>
                  </div>
	            </div>
	            <div id="modConPaye" class="modal fade" role="dialog">
					 <div class="modal-dialog">
					  <div class="modal-content">
					    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
					    <button type="button" class="close mdCPA">&times;</button>
					    <h3 class="modal-title"><span class="hidden did_factureC"></span><span class="hidden did_dossier_fact"></span> Confirmation</h3>
					  </div>
					  <div class="modal-body">
					    
					      
					      <h4>Voulez-vous vraiment valider ce paiement ? </h4>
					       
					  </div>
					  <div class="modal-footer">
					    <button type="button" id="btnConPaye" class="btn btn-success">
					      <span class='glyphicon glyphicon-ok-sign'></span> OUI
					    </button>
					    <button type="button" class="btn btn-warning mdCPA">
					      <span class='glyphicon glyphicon-remove'></span> Close
					    </button>
					  </div>
					  </div>
					 </div>
					</div>
				<div id="modConSup" class="modal fade" role="dialog">
					 <div class="modal-dialog">
					  <div class="modal-content">
					    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
					    <button type="button" class="close mdCPS">&times;</button>
					    <h3 class="modal-title"><span class="hidden did_factureS"></span> Confirmation</h3>
					  </div>
					  <div class="modal-body">
					      
					      <h4>Voulez-vous vraiment supprimer le(s) facture(s) sélectionnée(s)  ? </h4>
					       
					  </div>
					  <div class="modal-footer">
					    <button type="button" id="btnConSup" class="btn btn-success">
					      <span class='glyphicon glyphicon-ok-sign'></span> OUI
					    </button>
					    <button type="button" class="btn btn-warning mdCPS">
					      <span class='glyphicon glyphicon-remove'></span> Close
					    </button>
					  </div>
					  </div>
					 </div>
					</div>
   <script type="text/javascript">
	 	$(document).ready(function(){
	 		function formatMoney(num , localize,fixedDecimalLength){
                            num=num+"";
                     var str=num;
                            var reg=new RegExp(/(\D*)(\d*(?:[\.|,]\d*)*)(\D*)/g)
                            if(reg.test(num)){ 
                         var pref=RegExp.$1;
                         var suf=RegExp.$3;
                         var part=RegExp.$2;
                               if(fixedDecimalLength/1)part=(part/1).toFixed(fixedDecimalLength/1);
                        if(localize)part=(part/1).toLocaleString();
                  str= pref +part.match(/(\d{1,3}(?:[\.|,]\d*)?)(?=(\d{3}(?:[\.|,]\d*)?)*$)/g ).join(' ')+suf ;
                       };
                    return str;
                  }
	 		$('#tabAssExam').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
            });
            $('#tabModFact').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                "searching": false,
        		"lengthChange": false
            });
            $('#tabFacture').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                "searching": false,
        		"lengthChange": false
            });
            $('#tabHP').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5,
                "searching": false,
        		"lengthChange": false
            });
             $('#tabFD').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
            });
       	$(".dataTables_length select").addClass("form-control");
    	$(".dataTables_filter input").addClass("form-control");
		 	$('#addFact').click(function(){
		 		$("#modFacture #du").removeAttr("disabled")
			    $("#modFacture #au").removeAttr("disabled")
		 		$.ajax({
                            url: "{{route('dashboard_date')}}",
                            dataType: "json"
                        })
		 				.done(function(msg){
                        		var date = JSON.parse(msg['date']);
                        		$("#modFacture #du").val(date);
                        		$("#modFacture #au").val(date);
                   });
		 				$(".divBtnOK").removeClass("hidden");
		 		       $("#modFacture").modal({
		                    keyboard: false,
		                    show : true,
		                    backdrop: "static",
		            });
		 	});
		 $('#infosAssureur').on('hidden.bs.modal',function(){
  	     	 	$('#tabAssExam').dataTable().fnClearTable();
  	     	 	$('#tabFacture').dataTable().fnClearTable();
  	     	 	$('#tabFD').dataTable().fnClearTable();
  	     		/*$('#Examen').addClass('active')
  	     		$('#factureD').removeClass('active')
  	     		$('#facture').removeClass('active')*/
  	     		
  	     		 
  	   	});
		 function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    }
		 	$("#btnOk").click(function(){
		 		if( ($("#du").val() != "") && ($("#au").val() != "")  ){

		 			$.ajax({
                            
                            type : "post",
                            url: "{{route('dashboard_assureur_facture')}}",
                            data: {
                               	'date_debut' : $("#du").val(),
                               	'date_fin' : $("#au").val(),
                                'id_partenaire': $('.did_partenaire').text()
                            },
                            dataType: "json",
                             beforeSend: function(){
                                 $('.blockMeMF').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                            },
                            complete: function(){
                                $('.blockMeMF').unblock();
                            }
                        })
                        .done(function(msg){
                    /*  if(typeof msg['erreur'] !== 'undefined'){
                      			
                      			$("#modFacture").modal('hide');
                            
                               var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                      }else{
*/

                      	
                       tab =  JSON.parse(msg['dossiers']);
                       facture =  JSON.parse(msg['facture']);
	                   	 $(".did_facture").text(facture.id);
	                   	 $("#est").val( formatMoney(facture.total));
                     	$("#ref").val( facture.ref_facture);
                     	$("#reste").val( formatMoney(facture.reste_a_payer));
                     	$("#percu").val(formatMoney(facture.percu));
                    for(i=0;i < tab.length;i++){
                		str =  tab[i].date.split(" ")
                		if(tab[i].total == tab[i].percu){
                			aff = " ";
                		}else{
                			aff = "<input type='checkbox' class='CHKMF_item' value='" + tab[i].code + "' />";
                		}

                      var data = [
                              aff,
                              pad(tab[i].code,6),
                              str[0],
                              tab[i].nom,
                              tab[i].total,
                              tab[i].percu,
                              tab[i].statut
                              ];
                      var rowIndex = $('#tabModFact').dataTable().fnAddData(data);
                      var row = $('#tabModFact').dataTable().fnGetNodes(rowIndex);
                      $(row).attr( 'id','item' + tab[i].code); 
                      var tr = $("#tabModFact tr#item"+tab[i].code);
                      tr.attr( 'data-info',tab[i].total); 
                      tr.find('td:eq(0)').addClass('text-center');
                      tr.find('td:eq(1)').addClass('text-left');
                      tr.find('td:eq(2)').addClass('text-left');
                      tr.find('td:eq(3)').addClass('text-left');
                      tr.find('td:eq(4)').addClass('text-left');
                      tr.find('td:eq(5)').addClass('text-left');
                      tr.find('td:eq(6)').addClass('text-left');
                                     
                    }
               // }
                });

		 		}

		 	});
			$("#btnOkFD").click(function(){
		 		if( ($("#duF").val() != "") && ($("#auF").val() != "")  ){
		 			$('#tabFD').dataTable().fnClearTable();
		 			$.ajax({
                            
                            url: "{{ route('dashboard_get_facture_detaillee_partenaire') }}",
                            data: {
                               	'date_debut' : $("#duF").val(),
                               	'date_fin' : $("#auF").val(),
                                'id_partenaire': $('.did_partenaire').text()
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
                       tabD =  JSON.parse(msg['dossiers']);
                       
                    for(i=0;i < tabD.length;i++){

                      var data = [
                              pad(tabD[i].code,6),
                              tabD[i].date,
                              tabD[i].nom,
                              pad(tabD[i].code_examen,6),
                              tabD[i].libelle,
                              tabD[i].quantite,
                              tabD[i].total,
                              tabD[i].reduction,
                              tabD[i].N,
                              tabD[i].ticket_m,
                              tabD[i].montant_r
                              ];
                      var rowIndex = $('#tabFD').dataTable().fnAddData(data);
                      var row = $('#tabFD').dataTable().fnGetNodes(rowIndex);
                      $(row).attr( 'id','item' + tabD[i].code); 
                      var tr = $("#tabFD tr#item"+tabD[i].code); 
                      tr.find('td:eq(0)').addClass('text-left');
                      tr.find('td:eq(1)').addClass('text-left');
                      tr.find('td:eq(2)').addClass('text-left');
                      tr.find('td:eq(3)').addClass('text-left');
                      tr.find('td:eq(4)').addClass('text-left');
                      tr.find('td:eq(5)').addClass('text-left');
                      tr.find('td:eq(6)').addClass('text-left');
                      tr.find('td:eq(7)').addClass('text-left');
                      tr.find('td:eq(8)').addClass('text-left');
                      tr.find('td:eq(9)').addClass('text-left');
                      tr.find('td:eq(10)').addClass('text-left');
                                     
                    }
               
                });

		 		}

		 	});
		 	var cpt =0;
		 	$('#modFacture').on('hidden.bs.modal', function () {  
		 		$('#tabModFact').dataTable().fnClearTable();
		 		$('#tabHP').dataTable().fnClearTable();
		 		$('#tabFacture').dataTable().fnClearTable();
		 		$.ajax({
                            
                            url: "{{route('dashboard_get_facture_partenaire2')}}",
                            data: {
                               
                                'id_partenaire': $('.did_partenaire').text()
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

                       
                       tab_factures = JSON.parse(msg['factures']);
                     
                    for(i=0;i < tab_factures.length;i++){
                      var data = [
                              "<input type='checkbox' class='checkitemFA' value='" + tab_factures[i].id + "' />",
                              tab_factures[i].date_debut,
                              tab_factures[i].date_fin,
                              tab_factures[i].ref_facture,
                              tab_factures[i].total,
                              tab_factures[i].percu,
                              tab_factures[i].statut,
                              tab_factures[i].reste_a_payer,
                              tab_part_trait[i].prise_en_charge
                              ];
                      var rowIndex = $('#tabFacture').dataTable().fnAddData(data);
                      var row = $('#tabFacture').dataTable().fnGetNodes(rowIndex);
                      $(row).attr( 'id','item' + tab_factures[i].id); 
                      var tr = $("#tabFacture tr#item"+ tab_factures[i].id);
                      tr.find('td:eq(0)').addClass('text-center');
                      tr.find('td:eq(1)').addClass('text-left');
                      tr.find('td:eq(2)').addClass('text-left');
                      tr.find('td:eq(3)').addClass('text-left');
                      tr.find('td:eq(4)').addClass('text-left');
                      tr.find('td:eq(5)').addClass('text-left');
                      tr.find('td:eq(6)').addClass('text-left');
                      tr.find('td:eq(7)').addClass('text-left');
                      tr.find('td:eq(8)').addClass('text-left');
                      
                                     
                    }

                });     

		 	});
		 	var countE = 0;
         $('#checkallFA').change(function(){
          $('.checkitemFA').prop("checked",$(this).prop("checked"))
         });
		 
		 $('#CHKMF_all').change(function(){

	          $('.CHKMF_item').prop("checked",$(this).prop("checked"))
	          if($(this).prop("checked")){
	          		 var soe=0;
	          		$('tbody input[type=checkbox]').each(function(){
			            if($(this).prop("checked")){
			               soe += parseInt($(this).closest("tr").attr('data-info'));
			            }
		           });
	          	  $("#SV").val(soe);
	          }else{
	          		$("#SV").val(0);
	          }
         });
		 


          
          $('#tabModFact').on('change','tbody tr input',function(){
          	  var soe=0;
          	   $("#SV").val(0);
	           $('tbody input[type=checkbox]').each(function(){
		            if($(this).prop("checked")){
		               soe += parseInt($(this).closest("tr").attr('data-info'));
		            }
	           });          
	           $("#SV").val(soe);
           });
         	$("#btnValFact").click( function() {
         		   			
		          if( (($("#MR option:selected").text() == "CHEQUE") || ($("#MR option:selected").text() == "CARTE BANCAIRE") || ($("#MR option:selected").text() == "VIREMENT")) ){
			              if( ($("#numC").val() != "") && ($("#banque").val() != "") ){
			              	  $('.error_somme').addClass('hidden'); 
			              	  
			              	  var cpt = 0;
				            $('.CHKMF_item').each(function(){
				            if($(this).prop("checked")){
				              	cpt++;
				            }
				           });
				       
				           if(cpt > 0){
				           			 var id = $('.CHKMF_item:checked').map(function(){
							                return  $(this).val()
							          }).get().join();
				           			 $(".did_dossier_fact").text(id); 
				           			 $("#modConPaye").modal({
					                    keyboard: false,
					                    show : true,
					                    backdrop: "static",
					                 });
				           }
			              	  
			              	   
			              }else{
			              		$('.error_somme').text("Veuillez remplir les champs manquants (N° chèque et banque) ") 
			               		$('.error_somme').removeClass('hidden');  

			              }
			                
			               
			              
			          }else{
			              	

			                 $('.error_somme').addClass('hidden');  
			                 
			              	   var cpt = 0;
				            $('.CHKMF_item').each(function(){
				            if($(this).prop("checked")){
				              	cpt++;
				            }
				           });
				       
				           if(cpt > 0){
				           			 var id = $('.CHKMF_item:checked').map(function(){
							                return  $(this).val()
							          }).get().join();
				           			 $(".did_dossier_fact").text(id); 
				           			 $("#modConPaye").modal({
					                    keyboard: false,
					                    show : true,
					                    backdrop: "static",
					                 });
				           }
			          }
		         

       		});
         	$("#btnConPaye").click(function(){
         			 $.ajax({
                            
                            url: "{{route('dashboard_paiement_facture_partenaire')}}",
                            type: 'post',
                            data: {
                                'id_facture': $(".did_facture").text(),
                                 'id_dossier' : $(".did_dossier_fact").text(),
                                 'type_paiement' : $("#MR"). val(),
                                 'somme_verse' : $("#SV").val(),
                                 'numero_cheque' : $("#numC").val(),
                                 'nom_banque' : $("#banque").val()
                            },
                            dataType: "json",
                            beforeSend: function(){
                                 $('.blockMeMF').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00' } 
                                }); 
                            },
                            complete: function(){
                                $('.blockMeMF').unblock();
                            }
                        })
                        .done(function(msg){
                            
                             if(typeof msg['erreur'] !== 'undefined'){
                              
                              
                              $("#modConPaye").modal('hide');
                            
                              $("#CHKMF_all").removeAttr("checked");
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
	                        }else if(typeof msg['success'] !== 'undefined'){
	                               $('#tabHP').dataTable().fnClearTable();
	                              $('#tabModFact').dataTable().fnClearTable();
	                              $("#modConPaye").modal('hide');
	                              $("#CHKMF_all").removeAttr("checked");
	                              $(".did_dossier_fact").text("")
	                              $("#numC").val("");
							 	  	$("#banque").val("");
							 	  	$("#SV").val("");
	                                 $(".ajs-message.ajs-success").css("background-color", "gold");
	                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
	                              $(".ajs-message.ajs-success").css("font-weight", "bold");
	                              alertify.set('notifier','position', 'top-right');
	                              alertify.success(msg['success']);
	                              tab =  JSON.parse(msg['dossiers']);
			                       facture =  JSON.parse(msg['facture']);
			                       paiement =  JSON.parse(msg['paiements']);
			                        alert(facture.total);
			                     	$("#est").val( formatMoney(facture.total));
			                     	$("#ref").val( facture.ref_facture);
			                     	$("#reste").val( formatMoney(facture.reste_a_payer));
			                     	$("#percu").val(formatMoney(facture.percu));
			                    for(i=0;i < tab.length;i++){
			                		str =  tab[i].date.split(" ")
			                		if(tab[i].total == tab[i].percu){
			                			aff = " ";
			                		}else{
			                			aff = "<input type='checkbox' class='CHKMF_item' value='" + tab[i].code + "' />";
			                		}
			                      var data = [
			                              aff,
			                              pad(tab[i].code,6),
			                              str[0],
			                              tab[i].nom,
			                              tab[i].total,
			                              tab[i].percu,
			                              tab[i].statut
			                              ];
			                      var rowIndex = $('#tabModFact').dataTable().fnAddData(data);
			                      var row = $('#tabModFact').dataTable().fnGetNodes(rowIndex);
			                      $(row).attr( 'id','item' + tab[i].code); 
			                      var tr = $("#tabModFact tr#item"+tab[i].code);
			                      tr.attr('data-info', tab[i].total);
			                      tr.find('td:eq(0)').addClass('text-center');
			                      tr.find('td:eq(1)').addClass('text-left');
			                      tr.find('td:eq(2)').addClass('text-left');
			                      tr.find('td:eq(3)').addClass('text-left');
			                      tr.find('td:eq(4)').addClass('text-left');
			                      tr.find('td:eq(5)').addClass('text-left');
			                      tr.find('td:eq(6)').addClass('text-left');
	                        }
	                        var affi = "";
	                        
	                        for(i=0;i < paiement.length;i++){
	                        	affi="";
		                		str =  paiement[i].dossiers.split(",")
		                		for ( j=0; j < str.length; j++){
		                			affi +=  pad(str[j],6);
		                			if(j != str.length - 1){
		                				affi += ",";	
		                			}
		                			
		                		}
		                		for(j=0;j < tab_users.length; j++){
		                			if(paiement[i].user_id = tab_users[j].id){
		                				agent = tab_users[j].name
		                			}
		                		}
		                      var data = [
		                      		  affi,
		                              agent,
		                              paiement[i].percu,
		                              paiement[i].date_paiement_partenaire,
		                              paiement[i].heure_paiement_partenaire
		                              ];
		                      var rowIndex = $('#tabHP').dataTable().fnAddData(data);
		                      var row = $('#tabHP').dataTable().fnGetNodes(rowIndex);
		                      $(row).attr( 'id','item' + paiement[i].id); 
		                      var tr = $("#tabHP tr#item"+paiement[i].id);
		                      tr.attr('data-info', tab[i].total);
		                      tr.find('td:eq(0)').addClass('text-left');
		                      tr.find('td:eq(1)').addClass('text-left');
		                      tr.find('td:eq(2)').addClass('text-left');
		                      tr.find('td:eq(3)').addClass('text-left');
		                      tr.find('td:eq(4)').addClass('text-left');
		                                     
		                    }
	                    }
                    });

         	});
		 	  $('#infosAssureur').on('shown.bs.modal', function () {	
                //alert(cpt++);

                $.ajax({
                            
                            url: "{{route('dashboard_examen_partenaire')}}",
                            data: {
                               
                                'id_partenaire': $('.did_partenaire').text()
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

                       tab_part_trait =  JSON.parse(msg['examen_partenaire']);
                       tab_factures = JSON.parse(msg['factures']);
                     
                    for(i=0;i < tab_part_trait.length;i++){
                
                      var data = [
                               "<a class=\'edit-modalEX\' style=\'cursor:pointer\' data-info=\'" + tab_part_trait[i].id_examen_partenaire + "," + tab_part_trait[i].prise_en_charge + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ tab_part_trait[i].libelle_examen + "</a>",
                              tab_part_trait[i].quantite,
                              tab_part_trait[i].nombre_indexe,
                              tab_part_trait[i].delai,
                              tab_part_trait[i].prise_en_charge
                              ];
                      var rowIndex = $('#tabAssExam').dataTable().fnAddData(data);
                      var row = $('#tabAssExam').dataTable().fnGetNodes(rowIndex);
                      $(row).attr( 'id','item' + tab_part_trait[i].id_examen_partenaire); 
                      var tr = $("#tabAssExam tr#item"+tab_part_trait[i].id_examen_partenaire);
                      tr.find('td:eq(0)').addClass('text-left');
                      tr.find('td:eq(1)').addClass('text-left');
                      tr.find('td:eq(2)').addClass('text-left');
                      tr.find('td:eq(3)').addClass('text-left');
                      tr.find('td:eq(4)').addClass('text-left');
                      
                                     
                    }
                    for(i=0;i < tab_factures.length;i++){
                      var data = [
                              "<input type='checkbox' class='checkitemFA' value='" + tab_factures[i].id + "' />",
                              tab_factures[i].date_debut,
                              tab_factures[i].date_fin,
                              tab_factures[i].ref_facture,
                              tab_factures[i].total,
                              tab_factures[i].percu,
                              tab_factures[i].statut,
                              tab_factures[i].reste_a_payer,
                              tab_part_trait[i].prise_en_charge
                              ];
                      var rowIndex = $('#tabFacture').dataTable().fnAddData(data);
                      var row = $('#tabFacture').dataTable().fnGetNodes(rowIndex);
                      $(row).attr( 'id','item' + tab_factures[i].id); 
                      var tr = $("#tabFacture tr#item"+ tab_factures[i].id);
                      tr.find('td:eq(0)').addClass('text-center');
                      tr.find('td:eq(1)').addClass('text-left');
                      tr.find('td:eq(2)').addClass('text-left');
                      tr.find('td:eq(3)').addClass('text-left');
                      tr.find('td:eq(4)').addClass('text-left');
                      tr.find('td:eq(5)').addClass('text-left');
                      tr.find('td:eq(6)').addClass('text-left');
                      tr.find('td:eq(7)').addClass('text-left');
                      tr.find('td:eq(8)').addClass('text-left');
                      
                                     
                    }

                });    
                $.ajax({
                            url: "{{route('dashboard_date')}}",
                            dataType: "json"
                        })
		 				.done(function(msg){
                        		var date = JSON.parse(msg['date']);
                        		$("#duF").val(date);
                        		$("#auF").val(date);
                   }); 
        });
		 	$('#tabFacture').on('dblclick', 'tr', function(event) {
	              
	            	$(".divBtnOK").addClass("hidden");
	            	var str = $(this).attr('id');
			        var res = str.substring(4);
			        $('.did_facture').text(res);
			        $("#modFacture #du").attr("disabled",true)
			        $("#modFacture #au").attr("disabled",true)
			        $("#modFacture #du").val(this.cells[1].innerHTML);
			        $("#modFacture #au").val(this.cells[2].innerHTML);
			        $.ajax({
                            url: "{{route('dashboard_get_facture_partenaire')}}",
                            data: {
                               	'id_facture_partenaire' : res
                            },
                            dataType: "json",
                            beforeSend: function(){
                                 $('.blockMeMF').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00',
                                    	   'margin-left' : '250px' } 
                                }); 
                            },
                            complete: function(){
                                $('.blockMeMF').unblock();
                            }
                        })
                        .done(function(msg){

                       tab =  JSON.parse(msg['dossiers']);
                       facture =  JSON.parse(msg['facture']);
                       paiement = JSON.parse(msg['paiements']);
                     	$("#est").val( formatMoney(facture.total));
                     	$("#ref").val( facture.ref_facture);
                     	$("#reste").val( formatMoney(facture.reste_a_payer));
                     	$("#percu").val(formatMoney(facture.percu));
                    for(i=0;i < tab.length;i++){
                		str =  tab[i].date.split(" ")
                		if(tab[i].total == tab[i].percu){
                			aff = " ";
                		}else{
                			aff = "<input type='checkbox' class='CHKMF_item' value='" + tab[i].code + "' />";
                		}
                      var data = [
                              aff,
                              pad(tab[i].code,6),
                              str[0],
                              tab[i].nom,
                              tab[i].total,
                              tab[i].percu,
                              tab[i].statut
                              ];
                      var rowIndex = $('#tabModFact').dataTable().fnAddData(data);
                      var row = $('#tabModFact').dataTable().fnGetNodes(rowIndex);
                      $(row).attr( 'id','item' + tab[i].code); 
                      var tr = $("#tabModFact tr#item"+tab[i].code);
                      tr.attr('data-info', tab[i].total);
                      tr.find('td:eq(0)').addClass('text-center');
                      tr.find('td:eq(1)').addClass('text-left');
                      tr.find('td:eq(2)').addClass('text-left');
                      tr.find('td:eq(3)').addClass('text-left');
                      tr.find('td:eq(4)').addClass('text-left');
                      tr.find('td:eq(5)').addClass('text-left');
                      tr.find('td:eq(6)').addClass('text-left');
                      
                                     
                    }
                    var affi ="";
                    for(i=0;i < paiement.length;i++){
                    	affi="";
                		str =  paiement[i].dossiers.split(",")
                		for ( j=0; j < str.length; j++){
                			affi +=  pad(str[j],6);
                			if(j != str.length - 1){
                				affi += ",";	
                			}
                			
                		}
                		for(j=0;j < tab_users.length; j++){
                			if(paiement[i].user_id = tab_users[j].id){
                				agent = tab_users[j].name
                			}
                		}
                      var data = [
                      		  affi,
                              agent,
                              paiement[i].percu,
                              paiement[i].date_paiement_partenaire,
                              paiement[i].heure_paiement_partenaire
                              ];
                      var rowIndex = $('#tabHP').dataTable().fnAddData(data);
                      var row = $('#tabHP').dataTable().fnGetNodes(rowIndex);
                      $(row).attr( 'id','item' + paiement[i].id); 
                      var tr = $("#tabHP tr#item"+paiement[i].id);
                      tr.attr('data-info', tab[i].total);
                      tr.find('td:eq(0)').addClass('text-left');
                      tr.find('td:eq(1)').addClass('text-left');
                      tr.find('td:eq(2)').addClass('text-left');
                      tr.find('td:eq(3)').addClass('text-left');
                      tr.find('td:eq(4)').addClass('text-left');
                                     
                    }

                });

		             $("#modFacture").modal({
		                    keyboard: false,
		                    show : true,
		                    backdrop: "static",
		            });
		             
	         	});
	 			var countEX = 0; 

	 	   $(document).on('click', '.edit-modalEX', function() {
		        
		        var details = $(this).data('info').split(',');
		        
		        
		        $('#form-modExam #id_examen_partenaire').val(details[0]);
			    if (details[1]== 'NPC'){
		              $('#form-modExam #NPC').prop("checked",true);
		        }else{
		              $('#form-modExam #PEC').prop("checked",true);
		        }
		        $("#modExam").modal({
		                    keyboard: false,
		                    show : true,
		                    backdrop: "static",
		            });
		    });
	 	   
	 	     $('.mdCEX').click(function(){
		 	  	$(":input:not('[name=_token],[type=checkbox]')").val('');
		   		$("#modExam").modal("hide");
		   	  });
	 	     $('.mdCPA').click(function(){
		   		$("#modConPaye").modal("hide");
		   	  });
	 	     $('.mdCPS').click(function(){
		   		$("#modConSup").modal("hide");
		   	  });
	 	     $('.mdcMF').click(function(){
		 	  	$("#numC").val("");
		 	  	$("#banque").val("");
		 	  	$("#SV").val("");
		   		$("#modFacture").modal("hide");
		   	  });
		 	 $('form input').on('keypress', function(e) {
          			return e.which !== 13;
      			});
	 $(document).on('click', '.delete-modalM', function() {
               var cpt = 0;
            $('.checkitemFA').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });

           if(cpt > 0){
                  var id = $('.checkitemFA:checked').map(function(){
                    return  $(this).val()
                }).get().join();
                  $('.did_factureS').text(id);
                  $("#modConSup").modal({
                              keyboard: false,
                              show : true,
                              backdrop: "static",
                      });
                }
       });
	 $('#btnConSup').click(function() {
          $.ajax({
              type: 'post',
              url: "{{ route('dashboard_delete_facture_partenaire') }}",
              data: {
                  'id_facture_partenaire': $('.did_factureS').text()
              }
          })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             
                              
                              $("#modConSup").modal('hide');
                            
                              $("#checkallFA").removeAttr("checked");
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                              $("#modConSup").modal('hide');
                              $("#checkallFA").removeAttr("checked");
                              $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['supprimes']);
                         
                         for (var i=0; i< nv.length; i++){
                         	$('#tabFacture').dataTable().fnDeleteRow($('#tabFacture').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                       
                        
            });
      });
      $('#footerEX').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_examen_partenaire')}}",
            data: $('#form-modExam').serialize(),
            })
			.done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modExam").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#modExam").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                        nv = JSON.parse(msg['nouveau']);
                         
                        var tr = $("#tabAssExam tr#item"+nv.id);
                        
						tr.find('td:eq(4)').html('' + nv.prise_en_charge);
						
						$('#tabAssExam').DataTable().rows( tr ).draw();

						
                        
            });
       });

		});

    </script>
</div>