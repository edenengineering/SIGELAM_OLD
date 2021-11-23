
<div id="editExamen" class="modal fade" role="dialog" style="width: 100%">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
        <button type="button" class="close mdCE" data-dismiss="modal">&times;</button>
        <h2 id="titre" class="modal-titleE" ></h2>
      </div>
      <div class="modal-body">
        	<form class="form-horizontal" id="form_examen" role="form" >
        		
        		
        		
        		
        		
        		<div class="form-group">
				    <label class="control-label col-sm-2" for="type_examen">Groupe Examen :</label>
				    <div class="col-sm-10">
				      <select id="id_groupe_examen" name="id_groupe_examen" class="form-control" >
                           @foreach($groupe_examens as $item)
	                      <option value="{{$item->id}}">{{$item->libelle_groupe_examen}}</option>
	                      @endforeach                
                       </select>
				    </div>
			 	</div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="libelle">Libellé (*): <br /><span class="libelle_examen-validation validation-error"></span></label>
			    <div class="col-sm-6"> 
			      <input type="text" class="form-control" id="libelle_examen" name="libelle_examen" >
			    </div>
			    <label class="control-label col-sm-2" for="abr">Abréviation (*): <br /><span class="abreviation-validation validation-error"></span></label>
			    <div class="col-sm-2"> 
			      <input type="text" class="form-control" id="abr" name="abreviation" >
			    </div>
			  </div>
        	   <div class="form-group">
				    <label class="control-label col-sm-2" for="delai">Delai (jours) (*): <br /><span class="delai-validation validation-error"></span></label>
				    <div class="col-sm-10">
				      <input min ="0" type="number" class="form-control" name="delai" id="delai" placeholder="">
				    </div>
			 	</div>
			 	<div class="form-group">
				    <label class="control-label col-sm-2" for="prix">Prix (*): <br /><span class="prix-validation validation-error"></span></label>
				    <div class="col-sm-10">
				      <input min ="0" type="number" class="form-control" name="prix" id="prix" placeholder="">
				    </div>
			 	</div>	
			 	<div class="form-group">
				    <label class="control-label col-sm-2" for="code">Code tube examen:</label>
				    <div class="col-sm-4"> 
				      <select id="code" name="code" class="form-control" >
                                 @foreach($tubes as $item)
			                      <option value="{{$item->id}}">{{$item->libelle_tube}}</option>
			                     @endforeach              
                       </select>
				    </div>
			    </div>
			  
			    <input type="hidden" id="id_examen" name="id_examen" value="">
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
