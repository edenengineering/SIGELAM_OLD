 <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>  
 <script src="{{ URL::asset('js/dataTables.min.js') }}" ></script>
 <script src="{{ URL::asset('js/jquery.json.js') }}"></script>
 <script type="text/javascript">     
 var tab_materiel = {!! $materiels->toJson() !!};
 var tab_TM = {!! $type_materiels->toJson() !!};
</script>
 <div id="infosfour" class="modal fade" role="dialog" style="width: 100%; overflow-y:none">
 <div class="modal-dialog  modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
        <button type="button"  class="close clear1" data-dismiss="modal">&times;</button>
        <h2 id="titre" class="modal-title" >Informations sur les Commandes <span
							class="hidden did_fournisseur"></span></h2>
      </div>
      <div class="modal-body">
        	
					
						<legend>Commandes de <span class="did_nomF" ></span></legend>
					    <table id="tabCommande"  style="margin-top:30px;" class="table table-striped table-responsive blockMe">
		                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		                      <tr  style ="heigth:10px;">
		                        <th style="text-align:center;width:45px"><input type="checkbox" id="checkallC" /></th>
		                        <th class="text-left">Reference</th>
		                        <th class="text-center">Date Commande</th>
		                        <th class="text-center">Date de Livraison</th>
		                        <th class="text-center">Montant</th>
		                        <th class="text-center">Etat</th>
		                      </tr>
		                      
		                    </thead>
		                   
		                  </table>
		                  <div class="form-group row">
		                  		<button style="margin-left:5px; margin-right:30px" class="btn btn-success col-sm-2 "><i class="glyphicon glyphicon-print"></i>Imprimer</button>
		                  		
		                  		<button style="margin-right:5px" id="addC" class="btn btn-primary col-sm-2 col-sm-offset-4"><i class="glyphicon glyphicon-plus-sign"></i>Ajouter</button>
		                  		<button style="margin-right:5px" id="delC" class="delete-modalC btn btn-danger col-sm-2"><i class="glyphicon glyphicon-trash"></i>Supprimer</button>
		                  </div>		
      </div>
      <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-primary clear1" ><i class="glyphicon glyphicon"></i>Fermer</button>
      </div>
    </div>
	</div>
</div>
<div id="addComm" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
  	<div class="modal-content">
  		<div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
            <button type="button"  data-dismiss="modal" class="close mdcC" >&times;</button>
            <h2 id="titre" class="modal-titleC" >Modifier une commande</h2>
        </div>
        <div class="modal-body">
        	<form class="form-horizontal" id="form-addComm">
      
              {{ csrf_field() }} 
              <div class="row" style="margin-top: 30px; margin-bottom:5px;margin-right:5px; ">
              	<div class="form-group" >
              		<label class="control-label col-sm-2 text-left">Etat : </label>
                    
                    	<div class="col-sm-2">
                    		<label class="control-label" ><input type="radio" value="1" id="NL" checked="checked" name="etat"> Non livrée</label>
                    	</div>
                        <div class="col-sm-2">
                        	<label class="control-label" ><input type="radio" value="0" id="LI" name="etat"> Livrée</label>
                        </div>
                  </div>
                </div>

              <input type="hidden" id="id_four" name="code_fournisseur">
              <input type="hidden" id="id_commande" name="id_commande" value="">
            </form>
            <div class="deleteContentC">
            <h3 class="text-center">Voulez-vous vraiment supprimer les items sélectionnés ? <span
              class="hidden didC"></span></h3>
      		</div>
        </div>
         <div class="modal-footer" id="footerC">
          <button type="button" class="btn actionBtnC" >
	          <span id="footer_action_buttonC" class='glyphicon'></span>
	        </button>
	        <button type="button" class="btn btn-warning mdcC" data-dismiss="modal">
	          <span class='glyphicon glyphicon-remove'></span> Close
	        </button> 
        </div>
  	</div>
  </div>
  </div>
  <div id="modMatCmd" class="modal fade" role="dialog">
	 <div class="modal-dialog modal-lg" style="width:100%">
	  <div class="modal-content">
	  	<div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
			<button type="button" class="close mdcMC" >&times;</button>
			<h3 class="modal-titleMC"><span class="hidden did_com"></span> Liste de Materiels Commandés</h3>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-6"  style="background-color:rgb(238, 247, 240)">
					<h3>Liste du Materiel</h3>
					<table id="tabMC"  class="table table-striped table-responsive table-borderless">
                    
		                     
		                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		                      <tr  style ="heigth:10px;">
		                        <th class="text-left">Libellé Materiel</th>
		                        <th class="text-left">Type du Materiel</th>
		                      </tr>
		                      
		                    </thead>
		                    @foreach($materiels as $mat)
		                    <tr id="MCrow{{$mat->id}}">
		                    	
		                    	
		                    		<td class="text-left">{{$mat->libelle_materiel}}</td>
		                       
		                    	@foreach($type_materiels as $typ)
		                    	@if($mat->id_type_materiel == $typ->id)
		                    	<td class="text-left">{{ $typ->libelle_type_materiel }}</td>
		                    	@endif
		                    	@endforeach
		                    </tr>
		                    @endforeach
		                   
                  </table>
				</div>
				<div class="col-sm-6">
					<h3>Liste à commander</h3>

					<div class="row" style="margin-bottom:35px;">
						<div class="form-group">
							<label class="control-label col-sm-2" for="reference">Réference</label>
							<div class="col-sm-3">
								<input class="form-control" style="color:red" type="text" id="reference" disabled="disabled">	
							</div>
							<label class="control-label col-sm-3" for="reference">Total Commande</label>
							<div class="col-sm-3">
								<input class="form-control" style="color:red" type="text" id="commandeT" disabled="disabled">	
							</div>
						</div>
					</div>
			  
				<div class="table-responsive">
					<table id="tabMAC"  class="table table-striped  table-borderless blockMe">
                    
		                     
		                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		                      <tr  style ="heigth:10px;">
		                        <th class="text-left">Libellé Materiel</th>
		                        
		                        <th class="text-right">Quantité</th>
		                        <th class="text-right">Qté Livrée</th>
								<th class="text-right">Prix Unitaire</th>
								<th class="text-right">Total</th>			                        
		                      </tr>
		                      
		                    </thead>
		                   
                  </table>
                  </div>
				
			</div>
			
		</div>
		</div>
		<div class="modal-footer" id="footerI">
			<button type="button" id="valMMC" class="btn btn-success">
				<span class='glyphicon glyphicon-ok-sign'></span> Valider
			</button>
			<button type="button" class="btn btn-warning mdcMC">
				<span class='glyphicon glyphicon-remove'></span> Close
			</button>
		</div>
	  
	 </div>
	</div>
</div>
<div id="ModCmd" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
  	<div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
		<button type="button" class="close mdcCM">&times;</button>
		<h3 class="modal-title">Modification de la commande de : <span class="did_libel_mat"></span>
		<span class="hidden nomM"></span> <span class="hidden did_mat_cmde"></span></h3>
	</div>
	<div class="modal-body">
		
			{{ csrf_field() }}
			
			<div class="row" style="margin-bottom:10px">
				<div class="form-group">
					<label class="control-label col-sm-2" for="quantite">Commandé</label>
					<div class="col-sm-3">
						<input type="number" min="0" id="quantite" class="form-control" required>
					</div>
					<label class="control-label col-sm-2" for="livre">Livré</label>
					<div class="col-sm-3">
						<input type="number" min="0" id="livre" class="form-control" required>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-sm-2" for="prix">P.U :</label>
					<div class="col-sm-3">
						<input type="number" min="0" id="prix" class="form-control" required>
					</div>
			    </div>
			</div>
		   <div style="color:red" class="text-right"><span class="erCo"></span></div>
	</div>
	<div class="modal-footer">
		
		<button type="button" class="btn btn-success" id="ValCmd">
			<span class='glyphicon glyphicon-ok-sign'></span> Valider
		</button>
		<button type="button" class="btn btn-warning mdcCM">
			<span class='glyphicon glyphicon-remove'></span> Close
		</button>
	</div>
  </div>
 </div>
</div>
<div id="MatDel" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
  	<div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
		<button type="button" class="close mdcMD">&times;</button>
		<h3 class="modal-title">Confirmation</h3>
	</div>
	<div class="modal-body">
		
			{{ csrf_field() }}
			
			<h4>Voulez-vous supprimer ce matériel de la liste ? <span class="hidden did_mat_del"></span></h4>
		   
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-success" id="ValDel">
			<span class='glyphicon glyphicon-ok-sign'></span> Valider
		</button>
		<button type="button" class="btn btn-warning mdcMD">
			<span class='glyphicon glyphicon-remove'></span> Close
		</button>
	</div>
  </div>
 </div>
</div>

		<script type="text/javascript">
			 $(document).ready(function(){


			 	function  clickable() {
              
              if($(this).hasClass('success')){

                $(this).removeClass('success'); 
              } else {
                $(this).addClass('success').siblings().removeClass('success');
              }
            }

			  $("#tabCommande").on('click', '.clickable', clickable);
			 
           
		  $('#tabCommande').on('dblclick', 'tr', function(event) {

		         if( this.cells[1].innerHTML != "Reference"){
		         	 var str = $(this).attr('id');
            
		            var res = str.substring(4);
		            
		            $('.did_com').text(res);
		            
		              $('#reference').val( $(this).find('a').text());
		          	$("#modMatCmd").css("width",$(window).width());
		            $("#modMatCmd").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                	});
		          }

		    });
		  $('#tabMC').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
            });
		   $('#tabMAC').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 15,
                "searching": false,
                 "lengthChange": false 
            });

		   $('#tabMC').on('dblclick', 'tr', function(event) {
		            if(this.cells[0].innerHTML != "Libellé Materiel"){
		            $(".nomM").text("MC");
		            $(".did_libel_mat").text(this.cells[0].innerHTML);
		            var str = $(this).attr('id');
		            var res = str.substring(5);
		            $(".did_mat_cmde").text(res);
		             $.ajax({
                            
                            url: "{{route('dashboard_commande_materiel_prix')}}",
                            data: {
                               
                                'id_materiel': res,
                                'id_commande': $('.did_com').text()
                            },
                            dataType: "json"
                        })
                        .done(function(msg){
                        	var prix =  JSON.parse(msg['prix']);
                       		$("#ModCmd #quantite").val(0);
				    		$("#ModCmd #livre").val(0);
				    		$("#ModCmd #prix").val(prix);
                        });
		            
		            $("#ModCmd").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                	});
		          }

		    });
		    $('#tabMAC').on('dblclick', 'tr', function(event) {
		           if(this.cells[0].innerHTML != "Libellé Materiel"){
		           	  	var str = $(this).attr('id');
		            	var res = str.substring(6);
		            	
		           		$('.did_mat_del').text(res);
		           		 $("#MatDel").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                		});

		           }

		    });
		      $('#tabCommande').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
            });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
  	     $('#infosfour').on('hidden.bs.modal',function(){
  	     	 
  	     		$('#tabCommande').dataTable().fnClearTable();
  	     });
  	      $('#modMatCmd').on('hidden.bs.modal',function(){
  	     	 
  	     		$('#tabMAC').dataTable().fnClearTable();
  	     });
   $('#infosfour').on('shown.bs.modal', function () {
                
                $.ajax({
                            
                            url: "{{route('dashboard_commande')}}",
                            data: {
                               
                                'id_fournisseur': $('.did_fournisseur').text()
                            },
                            dataType: "json",
                             beforeSend: function(){
                                 $('.blockMe').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00', 'border-radius': '25px'} 
                                }); 
                            },
                            complete: function(){
                                $('.blockMe').unblock();
                            }
                        })
                        .done(function(msg){

                       tab_commande =  JSON.parse(msg['commandes']);
                      
        for(i=0;i < tab_commande.length;i++){
	    	if(tab_commande[i].code_fournisseur == parseInt($('.did_fournisseur').text())){	
	          var vari 
	          if( tab_commande[i].date_livraison == '1999-01-01'){
	          		vari =' ';
	          }else{
	          	vari =  tab_commande[i].date_livraison;
	          }
	          if( tab_commande[i].etat == '1'){
	          		var stat = "Non livrée";
	          }else{
	          		var stat = "Livrée";
	          }
	          var data = [
	                  "<input type='checkbox' class='checkitemC' value='" + tab_commande[i].id + "' />",
	                   "<a class=\'edit-modalC\' style=\'cursor:pointer\' data-info=\'" + tab_commande[i].id + "," + tab_commande[i].code_fournisseur + "," + tab_commande[i].reference_commande + "," + tab_commande[i].date_commande + "," + tab_commande[i].montant + "," + tab_commande[i].date_livraison + "," + tab_commande[i].etat + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ tab_commande[i].reference_commande + "</a>",
	                  tab_commande[i].date_commande,
	                  vari,
	                  tab_commande[i].montant,
	                  stat
	                  ];
	          var rowIndex = $('#tabCommande').dataTable().fnAddData(data);
	          var row = $('#tabCommande').dataTable().fnGetNodes(rowIndex);
	          $(row).attr( 'id','item' + tab_commande[i].id); 
	          var tr = $("#tabCommande tr#item"+tab_commande[i].id);
	          tr.find('td:eq(0)').addClass('text-center');
	          tr.find('td:eq(1)').addClass('text-left');
	          tr.find('td:eq(2)').addClass('text-center');
	          tr.find('td:eq(3)').addClass('text-center');
	          tr.find('td:eq(4)').addClass('text-center');
	          tr.find('td:eq(5)').addClass('text-center');
	          }
                         
        }

                });  
        });
 		$('#modMatCmd').on('shown.bs.modal', function () {
               
                $.ajax({
                            
                            url: "{{route('dashboard_commande_materiel')}}",
                            data: {
                               
                                'id_commande': $('.did_com').text()
                            },
                            dataType: "json",
                             beforeSend: function(){
                                 $('.blockMe').block({ 
                                    message: '<h3>Chargement.....</h3>', 
                                    css: { border: '3px solid #a00', 'border-radius': '25px'} 
                                }); 
                            },
                            complete: function(){
                                $('.blockMe').unblock();
                            }
                        })
                        .done(function(msg){

                       tab_liste =  JSON.parse(msg['commande_materiels']);
                       if (tab_liste[0] != null) {
				        for(i=0;i < tab_liste.length;i++){
					    	
					          	 
					        	 var tot = tab_liste[i].prix * tab_liste[i].quantite_commande;
						    	 for (j=0;j<tab_materiel.length;j++){
						    	 	if(tab_liste[i].code_materiel == tab_materiel[j].id){
						    	 		var lMat = tab_materiel[j].libelle_materiel;
						    	 	}
						    	 }
						    		var data = [
						    				   "<a class=\'edit-modalMAC\' style=\'cursor:pointer\' data-info=\'" + tab_liste[i].code_materiel + "," + tab_liste[i].code_commande + "," + tab_liste[i].quantite_commande + "," + tab_liste[i].quantite_livre + "," + tab_liste[i].prix + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ lMat + "</a>",
						    			
				                               tab_liste[i].quantite_commande,
									    	   tab_liste[i].quantite_livre,
									    	   tab_liste[i].prix,
									    	   tot
				                              ];
				                              var rowIndex = $('#tabMAC').dataTable().fnAddData(data);
				                              var row = $('#tabMAC').dataTable().fnGetNodes(rowIndex);
				                              $(row).attr( 'id','MACrow' + tab_liste[i].code_materiel);
				                              var tr = $("#tabMAC tr#MACrow"+ tab_liste[i].code_materiel);
				                              tr.find('td:eq(0)').addClass('text-left');
				                              tr.find('td:eq(1)').addClass('text-right');
				                              tr.find('td:eq(2)').addClass('text-right');
				                              tr.find('td:eq(3)').addClass('text-right');
				                              tr.find('td:eq(4)').addClass('text-right');
				                              
					        
				                         
				        }
				         var somme = $('#tabMAC tr').not(':first').map(function(){
  	     			  		
  	     			  		return parseInt($(this).find('td:eq(4)').text());
		  	     		}).get();
		  	     		var resul =0;
		  	     		for(var i=0; i< somme.length;i++){
		  	     			resul = resul + somme[i]; 
		  	     		}
		  	     		$('#commandeT').val(resul);
		  	     		var valId = $('#tabMAC tr').not(':first').map(function(){
  	     			  		
					        var str = $(this).attr('id');
					        
					        var res = str.substring(6);
  	     			  		return parseInt(res);
		  	     		}).get();
			    		 for(i=0;i< valId.length;i++){
			    		 		 $('#tabMC').DataTable().row($("#MCrow"+ valId[i])).remove().draw();
			    		 }
				      }else{
				        	
				        		
				        }

                });  
        });
		    $('#ValDel').click(function(){
		    		var idm = parseInt($('.did_mat_del').text());
		    		
		    		for( var i = 0; i<tab_materiel.length; i++){
		    			if(idm == tab_materiel[i].id){
		    				var libelM = tab_materiel[i].libelle_materiel;
		    				for(j=0; j< tab_TM.length;j++){
		    					if(tab_materiel[i].id_type_materiel == tab_TM[j].id){
		    						var libelT = tab_TM[j].libelle_type_materiel;
		    						break;
		    					}
		    				}
		    				break;
		    			}
		    		}
		    		
		    		var data = [
		    				   libelM,
		    				   libelT
                              ];
                  var rowIndex = $('#tabMC').dataTable().fnAddData(data);
                  var row = $('#tabMC').dataTable().fnGetNodes(rowIndex);
                  $(row).attr( 'id','MCrow' + $('.did_mat_del').text());
                  var tr = $("#tabMC tr#MCrow"+ $('.did_mat_del').text());
                  tr.find('td:eq(0)').addClass('text-left');
                  tr.find('td:eq(1)').addClass('text-left');
                            
                    //$('#tabMC').dataTable().fnDraw();  
                       
		    		 $('#tabMAC').DataTable().row($("#MACrow"+ $('.did_mat_del').text())).remove().draw();
		    		var somme = $('#tabMAC tr').not(':first').map(function(){
  	     			  		
  	     			  		return parseInt($(this).find('td:eq(4)').text());
		  	     		}).get();
		  	     		var resul =0;
		  	     		for(var i=0; i< somme.length;i++){
		  	     			resul = resul + somme[i]; 
		  	     		}
		  	     		$('#commandeT').val(resul);
	            	$("#MatDel").modal("hide");
	            	 
		    }); 
		    $("#tabMAC").on('click','a',function(){
		    	 $(".nomM").text("MAC");
		    	  var details = $(this).data('info').split(',');
		            $(".did_libel_mat").text($(this).text());
		            $(".did_mat_cmde").text(details[0]);
		            $("#ModCmd #quantite").val(details[2]);
		    		$("#ModCmd #livre").val(details[3]);
		    		$("#ModCmd #prix").val(details[4]);

		            $("#ModCmd").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
		    });

		    $("#ValCmd").click(function(){
		    	if($(".nomM").text() == "MC"){
		    		if($("#ModCmd #quantite").val() != 0){

		    		$('.erCo').text('');
		    		var tot = parseInt($("#ModCmd #prix").val()) * parseInt($("#ModCmd #quantite").val());
		    		var data = [
		    				   "<a class=\'edit-modalMAC\' style=\'cursor:pointer\' data-info=\'" + $("#ModCmd .did_mat_cmde").text() + "," + $(".did_com").text() + "," + $("#ModCmd #quantite").val() + "," + $("#ModCmd #livre").val() + "," + $("#ModCmd #prix").val() + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ $("#ModCmd .did_libel_mat").text() + "</a>",
		    			
                               $("#ModCmd #quantite").val(),
					    	   $("#ModCmd #livre").val(),
					    	   $("#ModCmd #prix").val(),
					    	   tot
                              ];
                              var rowIndex = $('#tabMAC').dataTable().fnAddData(data);
                              var row = $('#tabMAC').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','MACrow' + $('.did_mat_cmde').text());
                              var tr = $("#tabMAC tr#MACrow"+ $('.did_mat_cmde').text());
                              tr.find('td:eq(0)').addClass('text-left');
                              tr.find('td:eq(1)').addClass('text-right');
                              tr.find('td:eq(2)').addClass('text-right');
                              tr.find('td:eq(3)').addClass('text-right');
                              tr.find('td:eq(4)').addClass('text-right');
                              
                               $('#tabMC').DataTable().row($("#MCrow"+ $('.did_mat_cmde').text())).remove().draw();
                             // $('#tabMC').dataTable().fnDeleteRow( $('#tabMC').dataTable().$("#MCrow"+ $('.did_mat_cmde').text()[0]));
                              
	            			  $("#ModCmd").modal("hide");
	               }else{
	               			$('.erCo').text('La quantite commandée doit être supérieure à 0');
	               }

		    	}else{
		    			var tot = parseInt($("#ModCmd #prix").val()) * parseInt($("#ModCmd #quantite").val());
		    			var tr = $("#tabMAC tr#MACrow"+ $('.did_mat_cmde').text());
						tr.find('td:eq(1)').text("" + $("#ModCmd #quantite").val());
						
						tr.find('td:eq(2)').html("" + $("#ModCmd #livre").val());
				
						tr.find('td:eq(3)').html("" + $("#ModCmd #prix").val());
				
						tr.find('td:eq(4)').html("" + tot);
					
						$('#tabMAC').dataTable().fnDraw();
				
						
	            		$("#ModCmd").modal("hide");
	            }
		    });
		  $('.clear1').click(function(){
		  		$('#infosfour').modal('hide');
		  });
		   
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
        

       
     
        $(document).on('click', '.edit-modalC', function() {
            $('#footer_action_buttonC').text(" Valider");
            $('#footer_action_buttonC').addClass('glyphicon-check');
            $('#footer_action_buttonC').removeClass('glyphicon-trash');
            $('#footer_action_buttonC').removeClass('glyphicon-plus');
            $('.actionBtnC').addClass('btn-success');
            $('.actionBtnC').removeClass('btn-danger');
            $('.actionBtnC').removeClass('btn-primary');
            $('.actionBtnC').removeClass('delete');
            $('.actionBtnC').removeClass('ajout');
            $('.actionBtnC').addClass('edit');
            $('.modal-titleC').text('Modifier les informations de la Commande');
            $('.deleteContentC').hide();
            $('.form-horizontal').show();
            var details = $(this).data('info').split(',');
            $('#form-addComm #id_commande').val(details[0]);
            if (details[6]== '1'){
		              $('#form-addComm #NL').prop("checked",true);
	        }else{
	              $('#form-addComm #LI').prop("checked",true);
	        }
                  
            $("#addComm").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
        });
        
      
         
            $('.mdcC').click(function(){
	           $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
	            $("#addComm").modal("hide");
            });
            $('.mdcMC').click(function(){
	           $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
	            $("#modMatCmd").modal("hide");
            });
            $('.mdcCM').click(function(){
	           $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
	            $("#ModCmd").modal("hide");
            });
             $('.mdcMD').click(function(){
	           $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
	            $("#MatDel").modal("hide");
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
            $("#addComm").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
           }
        });
       $('#ModCmd').on('hidden.bs.modal',function(){
  	     	 
  	     		var somme = $('#tabMAC tr').not(':first').map(function(){
  	     			  return parseInt($(this).find('td:eq(4)').text());
  	     		}).get();
  	     		var resul =0;
  	     		for(var i=0; i< somme.length;i++){
  	     			resul = resul + somme[i]; 
  	     		}
  	     		$('#commandeT').val(resul);
  	     });
   $('#valMMC').click(function(){
   	
   		var values = $('#tabMAC tr a').map(function(i,e){
   			return $(this).data('info').split(',');
   		}).get();
   	
   	
			 $.ajax({
            type: 'post',
            dataType:'json',
            data: {'values': values,
            		'montant': $('#commandeT').val()},
            url: "{{route('dashboard_commande_materiel')}}"
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                            
                              
                              $("#modMatCmd").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                             
                              
                              $("#modMatCmd").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              
                       }
					   
					var tr = $("#tabCommande tr#item"+$('.did_com').text());
					tr.find('td:eq(4)').html(""+ $('#commandeT').val());
                     //$('#tabCommande').DataTable().rows( tr ).invalidate().draw();	    		
   	
   });
});
  $('#addC').click(function(){
  			 $.ajax({
            type: 'post',
            dataType:'json',
            data: {'id_fournisseur': $('.did_fournisseur').text() },
            url: "{{route('dashboard_commande')}}"
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#addComm").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#addComm").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              nv = JSON.parse(msg['nouveau']);
                              var dateli;
                              if(nv.date_livraison == '1999-01-01'){

                              	 dateli = ' ';
                              }else{
                              	dateli = nv.date_livraison;
                              }
                             
                              if(nv.etat == '1'){
                              	var stat = 'Non livrée';
                              }else{
                              	var stat = 'Livrée';
                              }
                              var data = [
                               "<input type=\'checkbox\' class=\'checkitemC\' value=\'" + nv.id + "\'/>",
                               "<a class=\'edit-modalC\' style=\'cursor:pointer\' data-info=\'" + nv.id + "," + nv.code_fournisseur + "," + nv.reference_commande + "," + nv.date_commande + "," + nv.montant + "," + nv.date_livraison + "," + nv.etat + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ nv.reference_commande + "</a>",
                                nv.date_commande,
                                dateli,                                
                                nv.montant,
                                stat
                              ];
                              var rowIndex = $('#tabCommande').dataTable().fnAddData(data);
                              var row = $('#tabCommande').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + nv.id);
                              var tr = $("#tabCommande tr#item"+nv.id);
                              tr.find('td:eq(0)').addClass('text-center');
                              tr.find('td:eq(1)').addClass('text-left');
                              tr.find('td:eq(2)').addClass('text-center');
                              tr.find('td:eq(3)').addClass('text-center');
                              tr.find('td:eq(4)').addClass('text-center');
                              tr.find('td:eq(5)').addClass('text-center');
                              
                       }

                        
            });
  });
  
    
     $('#footerC').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: "{{route('dashboard_commande')}}",
            data: $('#form-addComm').serialize(),
            })
      .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                              $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#addComm").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                               $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#addComm").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                            nv = JSON.parse(msg['nouveau']);
                           
                        var tr = $("#tabCommande tr#item"+nv.id);          
                        if(nv.etat == '1'){
                        	var stat = 'Non livrée';
                        }else{
                        	var stat = 'Livrée';
                        }
                        tr.find('td:eq(5)').html(""+ stat);
                        $('#tabCommande').dataTable().fnDraw();
                        //$('#tabCommande').DataTable().rows( tr ).invalidate().draw();
                        
            });
       });
    
     $('#footerC').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: "{{route('dashboard_commande_delete')}}",
              data: {
                 
                  'id_commande': $('.didC').text()
              }
          })
         .done(function(msg){
                        if(typeof msg['erreur'] !== 'undefined'){
                             
                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#addComm").modal('hide');
                            
                              
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){

                             $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
                              
                              $("#addComm").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                             
                        }
                         nv = JSON.parse(msg['supprimes']);
                         
                         for (var i=0; i< nv.length; i++){
                          $('#tabCommande').dataTable().fnDeleteRow( $('#tabCommande').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                       
                        
            });
      });
 


		});
		</script>
</div>