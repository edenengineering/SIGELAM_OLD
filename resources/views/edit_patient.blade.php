
<div id="editPatient" class="modal fade" role="dialog" style="width: 100%">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
        <button type="button"  class="close mdCP" data-dismiss="modal">&times;</button>
        <h2  class="modal-titleP" ></h2>
      </div>
      <div class="modal-body">
        	<form class="form-horizontal" id="form_patient" role="form" >
        		
        		
        		
					
        		
        		<input type="hidden" name="id_patient" id="id_patient">
        		<div class="form-group">
        			<legend style="padding-left:10px;">Identité du patient</legend>
        		</div>
        		<div class="row">
        			<div class="col-sm-6">
		        		<div class="form-group row" >
		        				<label for="name" class="control-label text-left col-sm-5">Noms et Prenoms (*) : <br /><span class="nom_patient-validation validation-error"></span></label>
		        				<div class="col-sm-7">
		        					<div class="input-group">
		        						 <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		        						<input type="text" name="nom_patient" class="form-control" id="name" required>	
		        					</div>
		        					
		        				</div>
		        		</div>
		        		<div class="form-group row">
	        				<label for="date_naiss" class="control-label text-left col-sm-5">Née le (*): <br /><span class="date_naissance-validation validation-error"></span></label>
	        				<div class=" col-sm-7">
	        					
	        					<input type="date"  name="date_naissance" class="form-control" id="date_naiss" required>
	        				</div>
	        			</div>
	        			<div class="form-group row">
	        				<label for="mat" class="control-label col-sm-5">Matricule : <br /><span class="matricule-validation validation-error"></span></label>
	        				<div class="col-sm-7">
	        					<input type="text"  name="matricule" class="form-control" id="mat">
	        				</div>
	        			</div>
	        		</div>
	        		<div class="col-sm-6">
		        		<div class="form-group row">
	        				<label for="" class="control-label col-sm-5">Sexe : </label>
	        				<div class="col-sm-7 ">
	        					<div class="row">
	        						<div class="col-sm-5">
	        							<label class="control-label" ><input type="radio" id="SM" value="Masculin" name="sexe">Masculin</label>
	        						</div>
	        						<div class="col-sm-5 col-sm-offset-1">
	        							<label  class="control-label" ><input type="radio"  id="SF" value="Feminin" name="sexe">Feminin</label>
	        						</div>
	        					</div>
		        				
		      
		        				
	        				</div>
	        			</div>
	        			<div class="form-group row">
	        				<label for="cni" class="control-label col-sm-5">CNI N° : </label>
	        				<div class="col-sm-7">
	        					<input type="text" name="cni" class="form-control" id="cni">
	        				</div>
	        			</div>
	        			<div class="form-group row">
	        				<label for="societe" class="control-label col-sm-5">Profession : </label>
	        				<div class="col-sm-7">
	        					<select class="form-control" name="id_profession" id="profession" >
                    
                  				</select>
	        				</div>
	        			</div>
	        		</div>
        		</div>
        		<div class="form-group">
        			<legend style="padding-left:10px;">Adresse du patient</legend>
        		</div>
        		<div class="row">
        			<div class="col-sm-6">
	        			
	        			<div class="form-group row">

		        				<label for="tel" class="control-label col-sm-5">Telephone (*): <br /><span class="telephone-validation validation-error"></span></label>
		        				<div class="input-group col-sm-7">
		        						 <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
		        						<!-- pattern="[\+][\(]\d{3}[\)]\d{3}[\-]\d{3}[\-]\d{3}"-->
		        						<input type="text"  name="telephone"  class="form-control" id="tel"  required>
		        				</div>
		        			
		        		</div>
		        		
		        		<div class="form-group row">
	        				<label for="adresse" class="control-label col-sm-5">Adresse (*): <br /><span class="adresse-validation validation-error"></span></label>
	        				<div class="input-group col-sm-7" style=" padding:0">
	        					<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
	        					<input type="text" style="width:100%;" name="adresse" class="form-control" id="adresse">
	        				</div>
		        		</div>
	        		</div>
	        		<div class="col-sm-6">
	        			
		        		<div class="form-group row">
	        				<label for="email" class="control-label col-sm-5">Email : </label>
	        				<div class="input-group col-sm-7">
	        					<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
	        					<input type="email" name="email" class="form-control" id="email">
	        				</div>
	        			</div>

	        			<div class="form-group row">
		        				<label for="fax" class="control-label col-sm-5">FAX : </label>
		        				<div class="col-sm-7">
		        					<input type="text"  name="fax" class="form-control" id="fax">
		        				</div>
		        		</div>
	        		</div>
        		</div>
        		<div class="row">
        			<p class="hidden text-center errorP" style="color:red;font-size:1.3em;font-weight:bold">Veuillez choisir le sexe du patient !</p>	
        		</div>
        	</form>
        	<div class="deleteContentP">
						<h3 class="text-center">Voulez-vous vraiment supprimer les items sélectionnés ? <span
							class="hidden didP"></span></h3>
			</div>
        	
      </div>
      <div class="modal-footer" id="footerP">
  			<button type="button" class="btn actionBtnP" >
				<span id="footer_action_buttonP" class='glyphicon'> </span>
			</button>
			<button type="button" class="btn btn-warning mdCP">
				<span class='glyphicon glyphicon-remove'></span> Close
			</button>	
      </div>
    </div>

  </div>
</div>
