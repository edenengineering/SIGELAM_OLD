 <script src="{{ URL::asset('js/jquery.min.js') }}" ></script>  
     <script src="{{ URL::asset('js/dataTables.min.js') }}" ></script>
     <script src="{{ URL::asset('js/jquery.json.js') }}"></script>
     
 <script type="text/javascript">     
 var tab_exam = {!! $examens->toJson()  !!};
 var tab_users = {!! $users->toJson()  !!};
 var tab_rendus;

  var tabRC = {!! $intitules->toJson()  !!};
 var tab_conclusion = {!! $conclusions->toJson()  !!};
 var tab_bio = {!! $antibiotiques->toJson()  !!};
 var tab_GE  = {!! $groupe_examens->toJson()  !!};
 var tab_TR  = {!! $type_resultats->toJson() !!};
 var tab_fongi = {!! $antifongiques->toJson()  !!};
</script>
<div id="infosTechnique" class="modal fade" role="dialog" style="overflow-y: scroll;">
	 <div class="modal-dialog modal-lg" style="width:100%;height:100%">
	  <div class="modal-content">
	  	<div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
			<button type="button" class="close mdcMC" >&times;</button>
			<h3 class="modal-titleMC"><span class="did_nomP"></span> <span class="hidden didSpy">1</span> <span class="hidden did_GE2"></span><span class="hidden did_dossier"></span><span class="hidden did_endroit"></span></h3>
		</div>
		<div class="modal-body">
			<legend>Informations Concernant le patient <span class="did_examC hidden"></span>  <span class="did_examen_dossier hidden"></span></legend>
			<div class="row" style="margin-bottom:35px;">
				<div class="row" style="margin-bottom:5px">
				<div class="form-group" >
					<label class="control-label col-sm-1" for="numero_dossier">N° Dossier</label>
					<div class="col-sm-2">
						<input class="form-control" style="style-decoration:bold;color:red;" type="text" id="numero_dossier" disabled="disabled">	
					</div>
					<label class="control-label col-sm-1" for="nom_patient">Nom patient</label>
					<div class="col-sm-2">
						<input  style="color:red;" class="form-control" type="text" id="nom_patient" disabled="disabled">	
					</div>
					<label class="control-label col-sm-1" for="age">Âge</label>
					<div class="col-sm-2" >
						<input class="form-control" style="color:red;"  type="text" id="age" disabled="disabled">	
					</div>
						<label class="control-label col-sm-1">Sexe</label>
						<div class="col-sm-1">
							<label class="control-label" > <input type="radio" name="sexe" value="Feminin" id="SF" checked="checked"> F</label>
						</div>
						<div class="col-sm-1">
							<label class="control-label" > <input type="radio" name="sexe" value="Masculin" id="SM"> M</label>
						</div>
				</div>
				
				</div>
				<div class="row" style="margin-bottom:5px">
				<div class="form-group">
					<label class="control-label col-sm-1" for="tel">Téléphone</label>
					<div class="col-sm-2">
						<input class="form-control" style="color:red;" type="text" id="tel" disabled="disabled">	
					</div>
					<label class="control-label col-sm-1" for="preleve">Prélevé le</label>
					<div class="col-sm-2">
						<input class="form-control" style="color:red;" type="date" id="preleve" disabled="disabled">	
					</div>
					<label class="control-label col-sm-1" for="retrait">Retrait</label>
					<div class="col-sm-2">
						<input class="form-control" style="color:red;" type="date" id="retrait" disabled="disabled">	
					</div>
				    <label class="control-label col-sm-1" >Urgence</label>
						<div class="col-sm-1" >
							<label class="control-label" > <input type="radio" id="UN" name="urgence" value="Non" checked="checked"> Non</label>
						</div>
						<div class="col-sm-1">
							<label class="control-label" > <input type="radio" id="UO" name="urgence" value="Oui" > Oui</label>
						</div>
					
				</div>
				</div>

				<div class="row" style="margin-bottom:10px">
					<div class="form-group">
						<label class="control-label col-sm-1" for="date_dossier">Date</label>
						<div class="col-sm-2">
							<input class="form-control" style="color:red;" type="date" id="date_dossier" disabled="disabled">	
						</div>
						<label class="control-label col-sm-1" for="presc">Prescripteur</label>
						<div class="col-sm-2">
							<input class="form-control" style="color:red;" type="text" id="presc" disabled="disabled">	
						</div>
						<label class="control-label col-sm-1" for="presc">Agent</label>
						<div class="col-sm-2">
							<input class="form-control" style="color:red;" type="text" id="agent" disabled="disabled">	
						</div>
						<label class="control-label col-sm-1">Historique</label>
						<div class="col-sm-1">
							<label class="control-label" > <input type="radio" name="historique" value="Non" id="HN" checked="checked"> Non</label>
						</div>
						<div class="col-sm-1">
							<label class="control-label" > <input type="radio" name="historique" value="Oui" id="HO" > Oui</label>
						</div>
					</div>
				</div>
				<div class="row">
					
				</div>
				<div class="row" style="margin-bottom:10px">
					<div class="form-group">
						<label class="control-label col-sm-1" for="date_dossier">clinique</label>
						<div class="col-sm-5">
							<input class="form-control" style="color:red;" type="text" id="renseignement" disabled="disabled">	
						</div>
						
						
					</div>
					<div class="form-group btnok hidden">
					    <label class="control-label col-sm-1 col-sm-offset" for="date_historique">Date :</label>
						<div class="col-sm-2 col-sm-offset" >
							<select id="date_historique" class="form-control">
								
							</select>
						</div>
						 <div class="col-sm-2" style="margin-right:5px">
            			    <button id="btnValHist" class="btn btn-success" style="width:100%"><i class="glyphicon glyphicon-ok-sign"></i> OK</button>   
          				</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4"  style="background-color:rgb(238, 247, 240)">
					<legend>Examen(s)</legend>
					<div class="table-responsive">
					<table id="tabEx"  class="table table-striped table-borderless blockMe">
                    
		                     
		                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		                      <tr  style ="heigth:10px;">
		                        <th class="text-left">Examen</th>
		                        <th class="text-left">Groupe Examen</th>
		                      </tr>
		                      
		                    </thead>
		                   
		                   
                  </table>
                  </div>
				</div>
			<div class="col-sm-6" style="background-color:#ffffb3">
				<legend>Résultats examen <span class="dvaleurR hidden"></span></legend>			  
				<div class="table-responsive">
					<table id="tabRendu"  class="table table-striped table-borderless blockMe blockMe1">
                    
		                    <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		                      <tr  style ="heigth:10px;">
		                      	<th style="text-align:center;width:45px"><input type="checkbox" id="checkallTR" /></th>
		                        <th class="text-left">Libellé</th>
		                        
		                        <th class="text-left">Resultat</th>
		                        <th class="text-left">Max</th>
								<th class="text-left">Min</th>
								<th class="text-left">Unité</th>			                        
								<th class="text-left">Historique</th>			                        
		                      </tr>
		                      
		                    </thead>
		                  
		                   
                  </table>
                  </div>
                  <div class="row">
                  	 <button type="button" id="btnValTR" class="col-sm-2 col-sm-offset-1 btn btn-success">
						<span class='glyphicon glyphicon-ok-sign'></span> Valider
					</button>
					
					<button type="button" id="btnSupp" class="col-sm-2 col-sm-offset-1 btn btn-danger">
						<span class='glyphicon glyphicon-trash'></span> Supprimer
					</button>

                  </div>
				
			</div>
			<div class="col-sm-2" style="">
				<div class="row" style="margin-bottom:5px;">
					<button type="button" style="width:200px;" id="btnConclu" class="btn btn-warning btn-lg">Conclusion</button>
				</div>
				<div class="row" style="margin-bottom:5px;">
					<button type="button"  style="width:200px;" id="btnAntibio" class="btn btn-warning btn-lg">Antibiogramme</button>
				</div>
				<div class="row">
					<button type="button"  style="width:200px;" id="btnAntifon" class="btn btn-warning btn-lg">Antifongigramme</button>
				</div>
			</div>
		</div>
		</div>
		<div class="modal-footer" id="footerI">
			<button type="button" class="btn btn-success mdcMC">
				<span class='glyphicon glyphicon-remove'></span> Fermer
			</button>
		</div>
	  
	 </div>
	</div>
</div>
<div id="ModConclusion" class="modal fade" role="dialog">
 <div class="modal-dialog" style="width:60%">
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcCO">&times;</button>
    <h3 class="modal-titleCon"></h3>
  </div>
  <div class="modal-body">
    <div class="row">
    	<div class="col-sm-8 blockMeC">
    		<legend>Conclusion <span class="did_examenA hidden"></span></legend>
    		<textarea class="form-control" cols="60" rows="10" id="areaCon"></textarea>
    	</div>
    	<div class="col-sm-4">
    	
    	<div class="row">
    		 <button type="button" id="btnSearchCon" style="margin-bottom:10px;width:180px" class="btn btn-primary btn-md">
		      <span class='glyphicon glyphicon-search'></span> Recherche Conclusion
		    </button>
    	</div>
    	<div class="row">
    		 <button type="button" id="btnValCon" style="margin-bottom:10px; width:180px" class="btn btn-success btn-md">
		      <span class='glyphicon glyphicon-ok-sign'></span> Valider
		    </button>
    	</div>
		    
    	</div>


    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-warning mdcCO">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
<div id="ModSearchConclusion" class="modal fade" role="dialog">
 <div class="modal-dialog" style="width:60%">
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcSCO">&times;</button>
    <h3 class="modal-title"> Selection d'un type conclusion</h3>
  </div>
  <div class="modal-body">
    <div class="">
    	<table id="tabCon" class="table table-striped table-responsive table-borderless">
    	<thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
          <tr  style ="heigth:10px;">
            <th class="text-left">Libelle Type Conclusion</th>
            
          </tr>
        </thead>
	         @foreach($conclusions as $item)
	          <tr id="item" class="clickable" data-info="{{$item->libelle}}" >
	            <td>{{ $item->libelle }}</td>

	          </tr>
	         @endforeach
            
        </table>

    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-warning mdcSCO">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
<div id="ModBio" class="modal fade" role="dialog">
 <div class="modal-dialog" style="width:70%">
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcBio">&times;</button>
    <h3 class="modal-titleBio"></h3>
    <p><span class="did_examenA hidden"></span></p>
  </div>
  <div class="modal-body">
    <div class="row">
    	<div class="col-sm-8">
    	<table id="tabBio" class="table table-striped table-responsive table-borderless blockMeA">
	    	<thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
	          <tr  style ="heigth:10px;">
	            <th class="text-center"><input type="checkbox" id="CHKBio_all"></th>
	            <th class="text-left">Antibiotique</th>
	            <th class="text-left">Sensibilité</th>
	          </tr>
	        </thead>
	        
            
        </table>
        </div>
        <div class="col-sm-4">
        	
	    	<div class="row">
	    		 <button type="button" id="btnAddBio" style="margin-bottom:10px;width:180px" class="btn btn-primary btn-md">
			      <span class='glyphicon glyphicon-plus'></span> Ajouter
			    </button>
	    	</div>
	    	<div class="row">
    		 <button type="button" id="btnValBio" style="margin-bottom:10px; width:180px" class="btn btn-success btn-md">
		      <span class='glyphicon glyphicon-ok-sign'></span> Valider
		    </button>
	    	</div>
	    	<div class="row">
	    		 <button type="button" id="btnDelBio" style="width:180px" class="btn btn-danger btn-md">
			      <span class='glyphicon glyphicon-remove'></span> Supprimer
			    </button>
	    	</div>
        </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-warning mdcBio">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
<div id="ModSearchBio" class="modal fade" role="dialog">
 <div class="modal-dialog" style="width:60%">
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcSBio">&times;</button>
    <h3 class="modal-titleSBio"></h3>
  </div>
  <div class="modal-body">
     <form class="form-horizontal" role="form">
    	 <div class="form-group" style="margin-bottom:10px;">
			<label class="control-label col-sm-3 text-left">Antibiotique : </label>
			<div class="col-sm-9">
				<select class="form-control" id="biotique">
        		
      			</select>
			</div>
	    </div>
    	 <div class="form-group" style="margin-bottom:10px;">
			<label class="control-label col-sm-3 text-left">Sensibilité : </label>
			<div class="col-sm-9">
				<select class="form-control" id="sensibilite">
        			<option value="SENSIBLE">SENSIBLE</option>
        			<option value="INTERMEDIAIRE">INTERMEDIAIRE</option>
        			<option value="RESISTANT">RESISTANT</option>
      			</select>
			</div>
	    </div>	  
	   </form>
	     <div class="deleteContentB">
			<h3 class="text-center">Voulez-vous vraiment supprimer les items sélectionnés ? <span
				class="hidden didB"></span></h3>
		  </div> 
  </div>
  <div class="modal-footer" id="footerB">
	<button type="button" class="btn actionBtnB" >
		<span id="footer_action_buttonB" class='glyphicon'> </span>
	</button>
    <button type="button" class="btn btn-warning mdcSBio">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>

<div id="ModFongi" class="modal fade" role="dialog">
 <div class="modal-dialog" style="width:70%">
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcFongi">&times;</button>
    <h3 class="modal-titleFongi"></h3>
    <p><span class="did_examenA hidden"></span></p>
  </div>
  <div class="modal-body">
    <div class="row">
    	<div class="col-sm-8">
    	<table id="tabFongi" class="table table-striped table-responsive table-borderless blockMeF">
	    	<thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
	          <tr  style ="heigth:10px;">
	            <th class="text-center"><input type="checkbox" id="CHKFongi_all"></th>
	            <th class="text-left">Antifongique</th>
	            <th class="text-left">Sensibilité</th>
	          </tr>
	        </thead>
	        
            
        </table>
        </div>
        <div class="col-sm-4">
        	
	    	<div class="row">
	    		 <button type="button" id="btnAddFongi" style="margin-bottom:10px;width:180px" class="btn btn-primary btn-md">
			      <span class='glyphicon glyphicon-plus'></span> Ajouter
			    </button>
	    	</div>

	    	<div class="row">
    		 <button type="button" id="btnValFongi" style="margin-bottom:10px; width:180px" class="btn btn-success btn-md">
		      <span class='glyphicon glyphicon-ok-sign'></span> Valider
		    </button>
	    	</div>
	    	<div class="row">
	    		 <button type="button" id="btnDelFongi" style="width:180px" class="btn btn-danger btn-md">
			      <span class='glyphicon glyphicon-remove'></span> Supprimer
			    </button>
	    	</div>
        </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-warning mdcFongi">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
<div id="ModsearchFongi" class="modal fade" role="dialog">
 <div class="modal-dialog" style="width:60%">
  <div class="modal-content">
   <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcSFongi">&times;</button>
    <h3 class="modal-titleSFongi"></h3>
  </div>
  <div class="modal-body">
     <form class="form-horizontal formF" role="form">
    	 <div class="form-group" style="margin-bottom:10px;">
			<label for="fongique" class="control-label col-sm-3 text-left">Antifongique : </label>
			<div class="col-sm-9">
				<select class="form-control" id="fongique">
        				
      			</select>
			</div>
	    </div>
    	 <div class="form-group" style="margin-bottom:10px;">
			<label for="sensibiliteF" class="control-label col-sm-3 text-left">Sensibilité : </label>
			<div class="col-sm-9">
				<select class="form-control" id="sensibiliteF">
        			<option value="SENSIBLE">SENSIBLE</option>
        			<option value="INTERMEDIAIRE">INTERMEDIAIRE</option>
        			<option value="RESISTANT">RESISTANT</option>
      			</select>
			</div>
	    </div>	  
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
    <button type="button" class="btn btn-warning mdcSFongi">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>

<div id="ModTech2" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg" style="width:80%">
  <div class="modal-content">
    <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
    <button type="button" class="close mdcT">&times;</button>
    <h3 class="modal-titleT">Modification Rendu </h3>
    <p><span class="did_renduC hidden"></span><span class="did_type hidden"></span></p>
  </div>
  <div class="modal-body">
     <form class="form-horizontal formT" role="form">
    	 <div class="form-group" style="margin-bottom:10px;">
			<label class="control-label col-sm-2 text-left">Resultat (*): <br /><span class="resultT-validation validation-error"></span></label>
			<div class="col-sm-3" id="Bres">
				<input type="text" class="form-control" name="resultT" id="resultT">
			</div>
			<div class="col-sm-3" id="Bres1">
				<select class="form-control" name="resultT1" id="resultT1">
                         
                 </select>
			</div>
			<div class="col-sm-2 ">
				<button type="button" id="seachTR" class="btn btn-primary" >
                      <span class='glyphicon glyphicon-search'></span> Rechercher
                 </button>
			</div>
	    </div>
	    
    	 <div class="form-group" style="margin-bottom:10px;">
			<label for="maximumT" class="control-label col-sm-2 text-left">Maximum (*): <br /><span class="maximumT-validation validation-error"></span></label>
			<div class="col-sm-3">
				<input type="number"  min="0" class="form-control" name="maximumT" id="maximumT">
			</div>
			<label for="minimumT" class="control-label col-sm-2 text-left">Minimum (*): <br /><span class="minimumT-validation validation-error"></span></label>
			<div class="col-sm-3">
				<input type="number"  min="0" class="form-control" name="minimumT" id="minimumT">
			</div>
	    </div>	
	    <div class="form-group" style="margin-bottom:10px;">
			<label style="color:red;font-size:1.4em" class="erreur hidden control-label col-sm-10 text-left"></label>
			
	    </div>	  
	   </form>
  </div>
  <div class="modal-footer" >
	<button type="button" id="btnValT" class="btn btn-success">
		      <span class='glyphicon glyphicon-ok-sign'></span> Valider
	</button>
    <button type="button" class="btn btn-warning mdcT">
      <span class='glyphicon glyphicon-remove'></span> Close
    </button>
  </div>
  </div>
 </div>
</div>
<div id="modalSupp" class="modal fade" role="dialog">
                  <div class="modal-dialog" >

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdCTR" data-dismiss="modal">&times;</button>
                        <h2  class="modal-titleT" >Suppression</h2>
                      </div>
                      <div class="modal-body">
                        <div class="deleteContentM">
                              <h3 class="text-center">Voulez-vous vraiment Supprimer les rendus sélectionnés ? <span
                                class="hidden didTR"></span></h3>
                        </div>
                      </div>
                      <div class="modal-footer" id="footerTR">
                        <button type="button" class="btn btn-primary supprimer" >
                        <span class='glyphicon glyphicon-check'></span> Oui
                      </button>
                      <button type="button" class="btn btn-warning mdCTR">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>

                  </div>
            </div>
         <div id="MVerif" class="modal fade" role="dialog">
                  <div class="modal-dialog" >

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdV" data-dismiss="modal">&times;</button>
                        <h2  class="modal-title" >Information</h2>
                      </div>
                      <div class="modal-body">
                        <div class="deleteContentM">
                              <h3 class="text-center">Vous ne pouvez pas valider sans ajouter des données </h3>
                        </div>
                      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-warning mdV">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>

                  </div>
            </div>
            <div id="MVerif2" class="modal fade" role="dialog">
                  <div class="modal-dialog" >

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdV2" data-dismiss="modal">&times;</button>
                        <h2  class="modal-title" >Information</h2>
                      </div>
                      <div class="modal-body">
                        <div class="deleteContentM">
                              <h3 class="text-center">Vous devez cocher au moins un rendu </h3>
                        </div>
                      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-warning mdV2">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>

                  </div>
            </div>

             <div id="modSpy" class="modal fade" role="dialog">
                  <div class="modal-dialog" >

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        
                        <h2  class="modal-title" >Information</h2>
                      </div>
                      <div class="modal-body">
                        <div class="deleteContent">
                              <h3 class="text-center">Certains résultats enregistrés ne sont pas validés voulez-vous les valider ?</h3>
                        </div>
                      </div>
                      <div class="modal-footer">
                      <button type="button" id="ValSpy" class="btn btn-success">
                        <span class='glyphicon glyphicon-ok-sign'></span> Oui
                      </button>
                      <button type="button" class="btn btn-warning mdS">
                        <span class='glyphicon glyphicon-remove'></span> Non
                      </button> 
                      </div>
                    </div>

                  </div>
            </div>

<div id="modValResult" class="modal fade" role="dialog">
                  <div class="modal-dialog" >

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdcVR" data-dismiss="modal">&times;</button>
                        <h2  class="modal-title" >Confirmation</h2>
                      </div>
                      <div class="modal-body">
                        <div class="deleteContentM">
                              <h3 class="text-center">Voulez-vous vraiment valider les résultats ? </h3>
                        </div>
                      </div>
                      <div class="modal-footer" id="footer">
                        <button type="button" id="btnValResult" class="btn btn-success" >
                        <span class='glyphicon glyphicon-check'></span> Oui
                      </button>
                      <button type="button" class="btn btn-warning mdcVR">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>

                  </div>
            </div>
<div id="modValBio" class="modal fade" role="dialog">
                  <div class="modal-dialog" >

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdcVB" data-dismiss="modal">&times;</button>
                        <h2  class="modal-title" >Confirmation</h2>
                      </div>
                      <div class="modal-body">
                        <div class="deleteContentM">
                              <h3 class="text-center">Voulez-vous vraiment valider les antibiogrammes ? </h3>
                        </div>
                      </div>
                      <div class="modal-footer" id="footer">
                        <button type="button" id="btnValBioT" class="btn btn-success" >
                        <span class='glyphicon glyphicon-check'></span> Oui
                      </button>
                      <button type="button" class="btn btn-warning mdcVB">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>

                  </div>
            </div>
 <div id="modValCon" class="modal fade" role="dialog">
                  <div class="modal-dialog" >

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdcVC" data-dismiss="modal">&times;</button>
                        <h2  class="modal-title" >Confirmation</h2>
                      </div>
                      <div class="modal-body">
                        <div class="deleteContentM">
                              <h3 class="text-center">Voulez-vous vraiment valider les conclusions ? </h3>
                        </div>
                      </div>
                      <div class="modal-footer" id="footer">
                        <button type="button" id="btnValConT" class="btn btn-success" >
                        <span class='glyphicon glyphicon-check'></span> Oui
                      </button>
                      <button type="button" class="btn btn-warning mdcVC">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>

                  </div>
            </div>
<div id="modValFon" class="modal fade" role="dialog">
                  <div class="modal-dialog" >

                    <div class="modal-content">
                      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
                        <button type="button" class="close mdcVF" data-dismiss="modal">&times;</button>
                        <h2  class="modal-title" >Confirmation</h2>
                      </div>
                      <div class="modal-body">
                        <div class="deleteContentM">
                              <h3 class="text-center">Voulez-vous vraiment valider les antifongigrammes ? </h3>
                        </div>
                      </div>
                      <div class="modal-footer" id="footer">
                        <button type="button" id="btnValFongiT" class="btn btn-success" >
                        <span class='glyphicon glyphicon-check'></span> Oui
                      </button>
                      <button type="button" class="btn btn-warning mdcVF">
                        <span class='glyphicon glyphicon-remove'></span> Close
                      </button> 
                      </div>
                    </div>

                  </div>
            </div>
<div id="modalCR" class="modal fade" role="dialog">
  <div class="modal-dialog" >

    <div class="modal-content">
      <div class="modal-header" style="background-color:rgb(103,184,120); color:white;">
        <button type="button" class="close mdCCR" data-dismiss="modal">&times;</button>
        <h2  class="modal-title" >Choix Type Resultat</h2>
      </div>
      <div class="modal-body">
        	 <table id="tableTR" style="width:100%;  heigth:60%" class="table table-striped table-responsive">
		          <caption id="cap">
		              <h4 class="text-center" style="color:rgb(51,122,183); font-weight: bold;">LISTE DES TYPES RESULTATS</h4>
		          </caption>  
		          
		          <thead style="background-color: LightSlateGray; color:white;  -webkit-box-shadow: 0px -4px 3px rgba(50, 50, 50, 0.75);-moz-box-shadow:    0px -4px 3px rgba(50, 50, 50, 0.75);box-shadow:0px -4px 3px rgba(50, 50, 50, 0.75);">
		            <tr  style ="heigth:10px;">
		              <th class="text-center">Libelle Type Resultat</th>
		            </tr>
		          </thead>
		           @foreach($type_resultats as $item)
		              <tr id="item{{$item->id}}" style="cursor:pointer"
                    data-info="{{$item->libelle_type_resultat}}">
		                
		                <td>{{$item->libelle_type_resultat}}</td>
		              </tr>
		          @endforeach
        	</table> 
      </div>
      <div class="modal-footer">
      	  <button type="button" class="btn btn-warning mdCCR">
	        <span class='glyphicon glyphicon-remove'></span> Close
	      </button> 
      </div>
    </div>

  </div>
</div>
		<script type="text/javascript">
		function validate() {
    
    var valid = true;
    
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


			 	function  clickable() {
              
              if($(this).hasClass('success')){

                $(this).removeClass('success'); 
              } else {
                $(this).addClass('success').siblings().removeClass('success');
              }
            }

			  $("#tabCon").on('click', '.clickable', clickable);
			
          $('#btnConclu').click(function(){
          			
          			$("#ModConclusion").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                	});
          });

          $('#seachTR').click(function(){
          			
          			$("#modalCR").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                	});
          });
          $('#btnSearchCon').click(function(){
          		$("#ModSearchConclusion").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                	});	
          }); 
          $('#btnAntibio').click(function(){
          		
          		$("#ModBio").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                	});	
          });
          
           $('#btnAntifon').click(function(){
          		
          		$("#ModFongi").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                	});	
          });

          $('.mdCTR').click(function(){
            
            $("#modalSupp").modal("hide");

          });
          $('.mdV').click(function(){
            
            $("#MVerif").modal("hide");

          });

          $('.mdV2').click(function(){
            
            $("#MVerif2").modal("hide");

          });

          $('.mdS').click(function(){
            
            $("#modSpy").modal("hide");
            $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
            $("#infosTechnique").modal("hide");

          });

          $('.mdcVC').click(function(){
            
            $("#modValCon").modal("hide");

          });
          $('.mdcVR').click(function(){
            
            $("#modValResult").modal("hide");

          });

          $("#btnPO").click(function(){
          		$("#resultT").val("POSITIF");
          })

          $("#btnNE").click(function(){
          		$("#resultT").val("NEGATIF");
          })
        $("#btnSupp").click(function() {
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
	              
	              $('.didTR').text(id);
	              $("#modalSupp").modal({
	                          keyboard: false,
	                          show : true,
	                          backdrop: "static",
	                  });
	          }else{

	          		$("#MVerif2").modal({
	                          keyboard: false,
	                          show : true,
	                          backdrop: "static",
	                  });
	          }
        });
          
        $('input[name="historique"]').bind('click', function(){
       
        	$("#date_historique").find("option").remove();
        	if(  $('input[name=historique]:checked').attr('id') == 'HO' ){
        		$("#date_historique").find("option").remove();
        		$(".btnok").removeClass("hidden");
               	 $.ajax({
				                dataType:'json',
				                url: "{{route('dashboard_technique_historique')}}",
				                data : { 'id_examen_dossier': $(".did_examen_dossier").text() }
				            })
				           .done(function(msg){
				           		date =  JSON.parse(msg['resultats']);

				           		for(var i=0;i < date.length;i++){	
				           			
										$('#date_historique').append($('<option>',
						                   {
						                      value: date[i].created_at,
						                      text : date[i].created_at
						                  }));
				           			}
									 
				           

				           });
                 
                

        	}else{
        		$(".btnok").addClass("hidden");
        		$("#date_historique").find("option").remove();
        	}

       });

        $("#btnValHist").click(function(){
        	if( $("#date_historique").val() != "" ){

        			$.ajax({
				                dataType:'json',
				                data: { 
				                		'id_examen_dossier': $(".did_examen_dossier").text(),
				                		'date' : $("#date_historique").val() },
				                url: "{{route('dashboard_technique_historique_date')}}",
				                beforeSend: function(){
				                   $('.blockMe1').block({ 
				                      message: '<h3>Chargement.....</h3>', 
				                      css: { border: '3px solid #a00' } 
				                  }); 
				              },
				              complete: function(){
				                  $('.blockMe1').unblock();
				              } 
				               
				            })
				           .done(function(msg){

				               tab =  JSON.parse(msg['resultats']);
				               
		                       for(var i=0; i < tab.length ; i++){
								          var tr = $("#tabRendu tr#item"+tab[i].id_element);
								          tr.find('td:eq(6)').html("" + tab[i].valeur);
									
								}
				           	});

        	}


        });

		  $('#tabCon').on('dblclick', 'tr', function(event) {

		         if( this.cells[0].innerHTML != "Libelle Type Conclusion"){
		         	 var details = $(this).data('info');
		         	 
		         	 $("#areaCon").val($("#areaCon").val() +  details + "\n");
		         	  $("#ModSearchConclusion").modal("hide");
		         	  $("#tabCon").DataTable().search( '' ).columns().search( '' ).draw();  
		          }

		    });

		 
		  $('#resultT1').click(function(){
		  		$('#resultT').val($("#resultT1 option:selected").text());

		  });
		  var countM = 0;
         
         $('#checkallT').change(function(){
          $('.checkitemTR').prop("checked",$(this).prop("checked"));
           $('.checkitemTR').each(function(){
            if($(this).prop("checked")){
           
              countM++;
            }
           });

          
         });

		 	$('#tabEx').on('dblclick', 'tr', function(event) {
				 
		 		if( this.cells[0].innerHTML != "Examen"){

				    $("#HN").prop("checked",true);
				    $(".btnok").addClass("hidden");
				   
				    var str = $(this).attr('id');
		            	

		            	var res = str.substring(4);
		              $('#tabEx > tbody  > tr').each(function() {
		                       if($(this).hasClass('warning')){

				              	  $(this).removeClass('warning'); 
				              
				              }
			            });
				     $(this).addClass('warning');
		             $(".did_examen_dossier").text($(this).data('info'));
		             $(".did_examenA").text(res);
			         $(".modal-titleCon").text("Conclusion de " + this.cells[0].innerHTML);
			         $(".modal-titleBio").text("Antibiogramme de " + this.cells[0].innerHTML);
			         $(".modal-titleFongi").text("Antifongigramme de " + this.cells[0].innerHTML);
				        $.ajax({
		                dataType:'json',
		                data: { 'id_examen' : res,
		                		'id_examen_dossier' : $(this).data('info') },
		                url: "{{route('dashboard_technique_valider')}}",
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
		              $('#tabRendu').dataTable().fnClearTable();
		              tab_rendus = JSON.parse(msg['rendus']);

		               tab_rendus =  JSON.parse(msg['rendus']);
                       for(var i=0; i < tab_rendus.length ; i++){
							
								if (tab_rendus[i].libelle_rendu == null) {
		 							tab_rendus[i].libelle_rendu = "";
		 						}
								var data = [
										"<input type='checkbox' class='checkitemTR' value='" + tab_rendus[i].id + "' />",
										"<a class=\'edit-modal\' style=\'cursor:pointer\' data-info=\'" + tab_rendus[i].id + "," + tab_rendus[i].libelle_rendu + "," + tab_rendus[i].code_examen + "," + tab_rendus[i].max + "," + tab_rendus[i].min + "," + tab_rendus[i].unite + "," + tab_rendus[i].ordre + "," + tab_rendus[i].type + "," + tab_rendus[i].valeur + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ tab_rendus[i].libelle_rendu + "</a>",
										tab_rendus[i].valeur,
										tab_rendus[i].max,
										tab_rendus[i].min,
										tab_rendus[i].unite,
										""
										];
							    var rowIndex = $('#tabRendu').dataTable().fnAddData(data);
						          var row = $('#tabRendu').dataTable().fnGetNodes(rowIndex);
						          $(row).attr( 'id','item' + tab_rendus[i].id); 
						          
						         
						          var tr = $("#tabRendu tr#item"+tab_rendus[i].id);
						           tr.attr("data-info",tab_rendus[i].max + "," + tab_rendus[i].min);
						          tr.find('td:eq(0)').addClass('text-center');
						          tr.find('td:eq(1)').addClass('text-left');
						          tr.find('td:eq(2)').addClass('text-left');
						          tr.find('td:eq(3)').addClass('text-left');
						          tr.find('td:eq(4)').addClass('text-left');
						          tr.find('td:eq(5)').addClass('text-left');
						          tr.find('td:eq(6)').addClass('text-left');
							
						}

		           });
 				}
		    });

 		   

 		   $('#tableTR').on('dblclick', 'tr', function(event) {

		         if( this.cells[0].innerHTML != "Libelle Type Conclusion"){
		         	
		         	var nom = $(this).data("info");
		         	$("#resultT").val(nom);
		         	$("#modalCR").modal("hide");
		         	$("#tableTR").DataTable().search( '' ).columns().search( '' ).draw();  
		         	$("#resultT").focus();
		          }

		    });

		  $('#tabRendu').on('dblclick', 'tr', function(event) {
		  		
		         if( this.cells[1].innerHTML != "Libellé"){

				         	  var str = $(this).attr('id');
				            
				            var res = str.substring(4);
				            $(".did_renduC").text(res);
				            var ta = $(this).find("a").data("info").split(",");
 						     $(".did_type").text(ta[7]);
				         	 $('.modal-titleT').text($(this).find("a").text());
				         	 $("#resultT").val(this.cells[2].innerHTML);
				         	
				         	  var tab = $(this).data('info').split(',');
				         	 if( tab[0] != "" && tab[1] != ""){
				         	 	
					         	 $("#maximumT").val( parseFloat(tab[0]) );
					         	 $("#minimumT").val(parseFloat(tab[1]) );
				         	 }else{
				         	 	$("#maximumT").val("");
					         	 $("#minimumT").val("");
				         	 }
				         	 $.ajax({
				                dataType:'json',
				                data: { 'id_rendu' : res },
				                url: "{{route('dashboard_get_liste_resultats_rendus')}}",
					            beforeSend: function(){
									                   $('.blockMe1').block({ 
									                      message: '<h3>Chargement.....</h3>', 
									                      css: { border: '3px solid #a00' } 
									                  }); 
					              },
					              complete: function(){
					                  $('.blockMe1').unblock();
					              } 
				               
				            })
				           .done(function(msg){
				             
				              nv = JSON.parse(msg['type_resultats']);
				               $("#resultT1").find("option").remove();
		                    for(var i=0;i < nv.length;i++){
			                
									if(nv[i].libelle_type_resultat == ta[8]){
											$('#resultT1').append($('<option>',
					                   {


					                      value: nv[i].libelle_type_resultat,
					                      text : nv[i].libelle_type_resultat,
					                      selected:true	
					                   }));	
									}else{
											$('#resultT1').append($('<option>',
					                   {


					                      value: nv[i].libelle_type_resultat,
					                      text : nv[i].libelle_type_resultat	
					                  }));
									}		
									
						     	 
		                    }

				           });
				         	if (typeof ta[7] !== 'undefined') {
		 							
					         	 if(ta[7] == 0){
					         	 		$('#Bres').removeClass("hidden");
					         	 		$("#Bres input").removeAttr("disabled");
					         	 		$('#Bres1').removeClass("hidden");
					         	 		$('#Bres1').addClass("hidden");
					         	 }else if(ta[7] == 1){
					         	 		 $('#Bres1').removeClass("hidden");
					         	 		 $('#Bres').removeClass("hidden");
					         	 		 $("#Bres input").removeAttr("disabled");
					         	 }else if(ta[7] == 2){
					         	 		 $('#Bres1').removeClass("hidden");
					         	 		 $('#Bres').removeClass("hidden");
				         	 		 $('#Bres').addClass("hidden");
				         	 	 }else if(ta[7] == 3){
				         	 		$('#Bres').removeClass("hidden");
				         	 		$("#Bres input").attr("disabled","disabled");
				         	 		$('#Bres1').removeClass("hidden");
				         	 		$('#Bres1').addClass("hidden");
				         	 }
				        	} 	 
				         	  $("#ModTech2").modal({
		                        keyboard: false,
		                        show : true,
		                        backdrop: "static",
		              		 });	 
		          }

		    });
		  $('#btnAddBio').click(function(){
		  	  $('#footer_action_buttonB').text(" Ajouter");
	            $('#footer_action_buttonB').removeClass('glyphicon-check');
	            $('#footer_action_buttonB').removeClass('glyphicon-trash');
	            $('#footer_action_buttonB').addClass('glyphicon-plus');
	            $('.actionBtnB').addClass('btn-success');
	            $('.actionBtnB').removeClass('btn-primary');
	            $('.actionBtnB').removeClass('btn-danger');
	            $('.actionBtnB').removeClass('delete');
	            $('.actionBtnB').removeClass('edit');
	            $('.actionBtnB').addClass('ajout');
	            $('.modal-titleSBio').text("Ajouter l'Antibiogramme");
	            $('.deleteContentB').hide();
				$('.form-horizontal').show();
	    
	            $("#ModSearchBio").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });	
		  });
		
		$('#btnDelBio').click(function(){
		  	var cpt = 0;
            $('.CHKBio_item').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });
           if(cpt > 0){
            var id = $('.CHKBio_item:checked').map(function(){
              return  $(this).val()
          }).get().join();
		  	  $('#footer_action_buttonB').text(" Supprimer");
	            $('#footer_action_buttonB').removeClass('glyphicon-check');
	            $('#footer_action_buttonB').addClass('glyphicon-trash');
	            $('#footer_action_buttonB').removeClass('glyphicon-plus');
	            $('.actionBtnB').removeClass('btn-success');
	            $('.actionBtnB').removeClass('btn-primary');
	            $('.actionBtnB').addClass('btn-danger');
	            $('.actionBtnB').addClass('delete');
	            $('.actionBtnB').removeClass('edit');
	            $('.actionBtnB').removeClass('ajout');
	            $('.modal-titleSBio').text("Suppresion de(s) Antibiogrammes");
	            $('.form-horizontal').hide();
	            $('.deleteContentB').show();
				$('.didB').text(id);
	    
	            $("#ModSearchBio").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });	
              }
		  });
		 /* $('#tabBio').on('dblclick','tr',function(event){64

		  		$('#footer_action_buttonB').text(" Modifier");
	            $('#footer_action_buttonB').addClass('glyphicon-check');
	            $('#footer_action_buttonB').removeClass('glyphicon-trash');
	            $('#footer_action_buttonB').removeClass('glyphicon-plus');
	            $('.actionBtnB').removeClass('btn-success');
	            $('.actionBtnB').removeClass('btn-danger');
	            $('.actionBtnB').addClass('btn-primary');
	            $('.actionBtnB').removeClass('delete');
	            $('.actionBtnB').removeClass('ajout');
	            $('.actionBtnB').addClass('edit');
	            $('.modal-titleSBio').text("Modifier l'Antibiogramme");
	            $('.deleteContentB').hide();
				$('.form-horizontal').show();
	            var details = $(this).data('info').split(',');
	            $('#biotique').val('details[0]');
	            $('#sensibilite').val('details[1]');
	            $("#ModSearchBio").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
 

		  });*/
 		   $('#btnAddFongi').click(function(){
		  	  $('#footer_action_buttonF').text(" Ajouter");
	            $('#footer_action_buttonF').removeClass('glyphicon-check');
	            $('#footer_action_buttonF').removeClass('glyphicon-trash');
	            $('#footer_action_buttonF').addClass('glyphicon-plus');
	            $('.actionBtnF').addClass('btn-success');
	            $('.actionBtnF').removeClass('btn-primary');
	            $('.actionBtnF').removeClass('btn-danger');
	            $('.actionBtnF').removeClass('delete');
	            $('.actionBtnF').removeClass('edit');
	            $('.actionBtnF').addClass('ajout');
	            $('.modal-titleSFongi').text("Ajouter l'Antifongigramme");
	            $('.deleteContentF').hide();
				$('.formF').show();
	    
	            $("#ModsearchFongi").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });	
		  });
		  $('#btnDelFongi').click(function(){
		  	var cpt = 0;
            $('.CHKFongi_item').each(function(){
            if($(this).prop("checked")){
           
              cpt++;
            }
           });
           if(cpt > 0){
            var id = $('.CHKFongi_item:checked').map(function(){
              return  $(this).val()
          }).get().join();
		  	  $('#footer_action_buttonF').text(" Supprimer");
	            $('#footer_action_buttonF').removeClass('glyphicon-check');
	            $('#footer_action_buttonF').addClass('glyphicon-trash');
	            $('#footer_action_buttonF').removeClass('glyphicon-plus');
	            $('.actionBtnF').removeClass('btn-success');
	            $('.actionBtnF').removeClass('btn-primary');
	            $('.actionBtnF').addClass('btn-danger');
	            $('.actionBtnF').addClass('delete');
	            $('.actionBtnF').removeClass('edit');
	            $('.actionBtnF').removeClass('ajout');
	            $('.modal-titleSFongi').text("Suppresion de(s) Antifongigramme");
	            $('.formF').hide();
	            $('.deleteContentF').show();
				$('.didF').text(id);
	    
	            $("#ModsearchFongi").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });	
              }
		  });
		  $('#tabFongi').on('dblclick','tr',function(event){
		  		$('#footer_action_buttonF').text(" Modifier");
	            $('#footer_action_buttonF').addClass('glyphicon-check');
	            $('#footer_action_buttonF').removeClass('glyphicon-trash');
	            $('#footer_action_buttonF').removeClass('glyphicon-plus');
	            $('.actionBtnF').removeClass('btn-success');
	            $('.actionBtnF').removeClass('btn-danger');
	            $('.actionBtnF').addClass('btn-primary');
	            $('.actionBtnF').removeClass('delete');
	            $('.actionBtnF').removeClass('ajout');
	            $('.actionBtnF').addClass('edit');
	            $('.modal-titleSFongi').text("Modifier l'Antifongigramme");
	            $('.deleteContentF').hide();
				$('.formF').show();
	            var details = $(this).data('info').split(',');
	            $('#fongique').val('details[0]');
	            $('#sensibiliteF').val('details[1]');
	            $("#ModsearchFongi").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                });
 

		  });
		  $('#tabCon').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 10
           });
		  $('#tabEx').DataTable({
                "aLengthMenu": [[2, 3, 5, -1], [2, 3, 5, "All"]],
                "iDisplayLength": -1,
                "aaSorting": []
           });
		   $('#tabBio').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
           });
           $('#tableTR').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 10
           });
           $('#tabFongi').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": 5
           });
		   $('#tabRendu').DataTable({
                "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                "iDisplayLength": -1,
                 "searching": false,
                 "lengthChange": false
           });
    $(".dataTables_length select").addClass("form-control");
    $(".dataTables_filter input").addClass("form-control");
  	  
    var countC = 0; 
         $('#CHKBio_all').change(function(){
          $('.CHKBio_item').prop("checked",$(this).prop("checked"))
           $('.CHKBio_item').each(function(){
            if($(this).prop("checked")){
           
              countC++;
            }
           });
         });

          $('#CHKFongi_all').change(function(){
          $('.CHKFongi_item').prop("checked",$(this).prop("checked"))
           $('.CHKFongi_item').each(function(){
            if($(this).prop("checked")){
           
              countC++;
            }
           });
         });
			 $('.mdcCO').click(function(){
	            $("textarea").val('');
	            $("#ModConclusion").modal("hide");
             });

             $('.mdCCR').click(function(){
	         
	            $("#modalCR").modal("hide");
	            $("#tableTR").DataTable().search( '' ).columns().search( '' ).draw();  
             });

             $('.mdcSCO').click(function(){
	           
	            $("#ModSearchConclusion").modal("hide");
	            $("#tabCon").DataTable().search( '' ).columns().search( '' ).draw();  
             }); 
             $('.mdcBio').click(function(){
	           
	            $("#ModBio").modal("hide");
	            $("#tabBio").DataTable().search( '' ).columns().search( '' ).draw();
             });
             $('.mdcVB').click(function(){
	           
	            $("#modValBio").modal("hide");
             });
             $('.mdcVF').click(function(){
	           
	            $("#modValFon").modal("hide");
             });
             $('.mdcT').click(function(){
	           
	            $("#ModTech2").modal("hide");
	            $("#resultT").val("");
	             $(".erreur").addClass("hidden");
	             $(".erreur").text("");
             });
             $('.mdcSBio').click(function(){
	           
	            $("#ModSearchBio").modal("hide");
	              
             }); 
              $('.mdcFongi').click(function(){
	           
	            $("#ModFongi").modal("hide");
	            $("#tabFongi").DataTable().search( '' ).columns().search( '' ).draw();
             });
             $('.mdcSFongi').click(function(){
	           
	            $("#ModsearchFongi").modal("hide");
             });         
            
            $('.mdcMC').click(function(){
              	if( $(".didSpy").text() == "1" ){              
		            $(":input:not('[name=_token],[type=checkbox],[type=radio]')").val('');
		            $("#infosTechnique").modal("hide");
		        }else{
		        	$("#modSpy").modal({
                        keyboard: false,
                        show : true,
                        backdrop: "static",
                	});		
		        }
            });
           


  	  $('#infosTechnique').on('hidden.bs.modal',function(){
  	     	    $('div.dataTables_filter input').focus();
  	     		$('#tabEx').dataTable().fnClearTable();
  	     		 $('#tabRendu').dataTable().fnClearTable();
  	   });
  	     
  	    function pad (str, max) {
                      str = str.toString();
                      return str.length < max ? pad("0" + str, max) : str;
                    } 

     $('#ModConclusion').on('shown.bs.modal', function () {
     			$.ajax({
				                dataType:'json',
				                data: { 'id_examen_dossier' : $(".did_examen_dossier").text() },
				                url: "{{route('dashboard_technique_conclusion_examen')}}",
					            beforeSend: function(){
									                   $('.blockMeC').block({ 
									                      message: '<h3>Chargement.....</h3>', 
									                      css: { border: '3px solid #a00' } 
									                  }); 
					              },
					              complete: function(){
					                  $('.blockMeC').unblock();
					              } 
				               
				            })
				           .done(function(msg){
				             
				              nv = JSON.parse(msg['conclusion']);
				              if(nv.length != 0){
				              		$("#areaCon").val(nv[0].conclusion);	
				              }else{
				              		$("#areaCon").val("");	
				              }

				           });
     });

    $("#btnValCon").click(function(){
    	if($("#areaCon").val() == "") {
    			$("#MVerif").modal({
	                          keyboard: false,
	                          show : true,
	                          backdrop: "static",
	               });
    	}else{


 			 $("#modValCon").modal({
	                          keyboard: false,
	                          show : true,
	                          backdrop: "static",
	               });
 		}

 	})

    $('#btnValConT').click(function () {
     	 if($("#areaCon").val() == "") {
        
          
        
      } else {
      		
     	$.ajax({
     		type: 'post',
            dataType:'json',
            data: { 'id_examen_dossier' : $(".did_examen_dossier").text(),
            		'conclusion' : $("#areaCon").val() },
            url: "{{route('dashboard_technique_conclusion_examen')}}"
           
        })
       .done(function(msg){
         if(typeof msg['erreur'] !== 'undefined'){
                            
                              
                            
                              $("#modValCon").modal('hide');
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                             
                              
                              $("#modValCon").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              
                       }

       		});
 	   }
     });

 	$("#btnValTR").click(function(){

 			 $("#modValResult").modal({
	                          keyboard: false,
	                          show : true,
	                          backdrop: "static",
	               });

 	})

 	$("#ValSpy").click(function (){
 			if($("#tabRendu").dataTable().fnSettings().aoData.length===0) {

         } else {
      		var values=[]; 
            var i=0;
            $('#tabRendu > tbody  > tr > td').each(function() {
                      if( $(this).find("input").val() == undefined ){
                      	values[i] = $(this).text();	
                      }else{
                        values[i] =  $(this).find("input").val() ;
                       
                     }
                       i++;
            });
     	$.ajax({
     		type: 'post',
            dataType:'json',
            data: { 'id_examen_dossier' : $(".did_examen_dossier").text(),
            		'values' : values },
            url: "{{route('dashboard_technique_valider')}}"
           
        })
       .done(function(msg){
         if(typeof msg['erreur'] !== 'undefined'){
                            
                              
                            
                              $("#modSpy").modal('hide');
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                             
                              $(".didSpy").text("1");
                              $("#modSpy").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              $("#infosTechnique").modal('hide');
                       }

       		});
 	   }
 	});
 	$('#btnValResult').click(function () {
     	 if($("#tabRendu").dataTable().fnSettings().aoData.length===0) {

         } else {
      		var values=[]; 
            var i=0;
            $('#tabRendu > tbody  > tr > td').each(function() {
                      if( $(this).find("input").val() == undefined ){
                      	values[i] = $(this).text();	
                      }else{
                        values[i] =  $(this).find("input").val() ;
                       
                     }
                       i++;
            });
     	$.ajax({
     		type: 'post',
            dataType:'json',
            data: { 'id_examen_dossier' : $(".did_examen_dossier").text(),
            		'values' : values },
            url: "{{route('dashboard_technique_valider')}}"
           
        })
       .done(function(msg){
         if(typeof msg['erreur'] !== 'undefined'){
                              $("#modValResult").modal('hide');
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                             
                              $(".didSpy").text("1");
                              $("#modValResult").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              
                       }

       		});
 	   }
     });
 $("#btnValFongi").click(function(){
		 if($("#tabFongi").dataTable().fnSettings().aoData.length===0) {

		 			$("#MVerif").modal({
	                          keyboard: false,
	                          show : true,
	                          backdrop: "static",
	               });
		 }else{
		 		$("#modValFon").modal({
	                          keyboard: false,
	                          show : true,
	                          backdrop: "static",
	               });
		 }

 			 

 	})
 $('#btnValFongiT').click(function () {
     	 if($("#tabFongi").dataTable().fnSettings().aoData.length===0) {
        
          
        
      } else {
      		var values=[]; 
            var i=0;
            $('#tabFongi > tbody  > tr > td').each(function() {
                      if( $(this).find("input").val() == undefined ){
                      	values[i] = $(this).text();	
                      }else{
                        values[i] =  $(this).find("input").val() ;
                       
                     }
                       i++;
            });
     	$.ajax({
     		type: 'post',
            dataType:'json',
            data: { 'id_examen_dossier' : $(".did_examen_dossier").text(),
            		'values' : values },
            url: "{{route('dashboard_technique_antifongigramme')}}"
           
        })
       .done(function(msg){
         if(typeof msg['erreur'] !== 'undefined'){
                            
                              
                            
                              $("#modValFon").modal('hide');
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                             
                              
                              $("#modValFon").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              
                       }

       		});
 	   }
     }); 

 	 $('#ModBio').on('hidden.bs.modal',function(){
      	$('#tabBio').dataTable().fnClearTable();
     });

     $('#ModFongi').on('hidden.bs.modal',function(){
      	$('#tabFongi').dataTable().fnClearTable();
     });

     $('#ModConclusion').on('hidden.bs.modal',function(){
      	$('#areaCon').val("");
     });

     $('#ModFongi').on('shown.bs.modal',function(){
      	
     });

      $('#ModFongi').on('shown.bs.modal',function(){
      		$.ajax({
            dataType:'json',
            data: { 'id_examen_dossier' : $(".did_examen_dossier").text() },
            url: "{{route('dashboard_technique_antifongigramme')}}",
            beforeSend: function(){
				                   $('.blockMeF').block({ 
				                      message: '<h3>Chargement.....</h3>', 
				                      css: { border: '3px solid #a00' } 
				                  }); 
              },
              complete: function(){
                  $('.blockMeF').unblock();
              } 
           
        })
       .done(function(msg){
              
                      var tabB = JSON.parse(msg['antifongigrammes']); 
                      for(var i=0; i < tabB.length ; i++){
									
										for(j=0; j< tab_fongi.length; j++){
											if(tabB[i].id_antifongique == tab_fongi[j].id){
												anti = tab_fongi[j].libelle_antifongique;
											}
										}
										var data = [
												"<input type='checkbox' class='CHKFongi_item' value='" + tabB[i].id_antifongique + "' />",
												anti,
												tabB[i].etat
												];
									    var rowIndex = $('#tabFongi').dataTable().fnAddData(data);
								          var row = $('#tabFongi').dataTable().fnGetNodes(rowIndex);
								          $(row).attr( 'id','item' + tabB[i].id_antifongique); 
								          var tr = $("#tabFongi tr#item"+tabB[i].id_antifongique);

								          tr.find('td:eq(0)').addClass('text-center');
								          tr.find('td:eq(1)').addClass('text-left');
								          tr.find('td:eq(2)').addClass('text-left');
								         
									
								}

       	});
     });

     $('#ModBio').on('shown.bs.modal',function(){
      		$.ajax({
            dataType:'json',
            data: { 'id_examen_dossier' : $(".did_examen_dossier").text() },
            url: "{{route('dashboard_technique_antibiogramme')}}",
            beforeSend: function(){
				                   $('.blockMeA').block({ 
				                      message: '<h3>Chargement.....</h3>', 
				                      css: { border: '3px solid #a00' } 
				                  }); 
              },
              complete: function(){
                  $('.blockMeA').unblock();
              } 
           
        })
       .done(function(msg){
              
                      var tabB = JSON.parse(msg['antibiogrammes']); 

                      for(var i=0; i < tabB.length ; i++){
									
										for(j=0; j< tab_bio.length; j++){
											if(tabB[i].id_antibiotique == tab_bio[j].id){
												anti = tab_bio[j].libelle_antibiotique;
											}
										}
										var data = [
												"<input type='checkbox' class='CHKBio_item' value='" + tabB[i].id + "' />",
												anti,
												tabB[i].etat
												];
									    var rowIndex = $('#tabBio').dataTable().fnAddData(data);
								          var row = $('#tabBio').dataTable().fnGetNodes(rowIndex);
								          $(row).attr( 'id','item' + tabB[i].id); 
								          var tr = $("#tabBio tr#item"+tabB[i].id);

								          tr.find('td:eq(0)').addClass('text-center');
								          tr.find('td:eq(1)').addClass('text-left');
								          tr.find('td:eq(2)').addClass('text-left');
								         
									
								}

       	});
     });
 	$("#btnValBio").click(function(){
 			if($("#tabBio").dataTable().fnSettings().aoData.length===0) {
 				 $("#MVerif").modal({
	                          keyboard: false,
	                          show : true,
	                          backdrop: "static",
	               });
 			}else{

 			 $("#modValBio").modal({
	                          keyboard: false,
	                          show : true,
	                          backdrop: "static",
	               });
 			}

 	})
    


    $('#btnValBioT').click(function () {
     	 if($("#tabBio").dataTable().fnSettings().aoData.length===0) {
        
          
        
      } else {
      		var values=[]; 
            var i=0;
            $('#tabBio > tbody  > tr > td').each(function() {
                      if( $(this).find("input").val() == undefined ){
                      	values[i] = $(this).text();	
                      }else{
                        values[i] =  $(this).find("input").val() ;
                       
                     }
                       i++;
            });
     	$.ajax({
     		type: 'post',
            dataType:'json',
            data: { 'id_examen_dossier' : $(".did_examen_dossier").text(),
            		'values' : values },
            url: "{{route('dashboard_technique_antibiogramme')}}"
           
        })
       .done(function(msg){
         if(typeof msg['erreur'] !== 'undefined'){
                            
                              
                            
                              $("#modValBio").modal('hide');
                              var notification = alertify.notify(msg['erreur'], 'error', 5, function(){  console.log('dismissed'); });
                               
                        }else if(typeof msg['success'] !== 'undefined'){
                             
                              
                              $("#modValBio").modal('hide');
                                 $(".ajs-message.ajs-success").css("background-color", "gold");
                              $(".ajs-message.ajs-success").css("color", "rgb(103,184,120)");
                              $(".ajs-message.ajs-success").css("font-weight", "bold");
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(msg['success']);
                              
                       }

       		});
 	   }
     }); 


       $('#ModFongi').on('shown.bs.modal', function () {
     			$.ajax({
				                dataType:'json',
				                data: { id_examen: $(".did_examenA").text() },
				                url: ""
				               
				            })
				           .done(function(msg){
				             
				              tab_anti = JSON.parse(msg['antifongique']);

		                       for(var i=0; i < tab_anti.length ; i++){
										
		                       			for(j=0; j< tab_fongi.length;j++){
		                       				if(tab_anti[i].id == tab_fongi[j].id){
		                       					var libel = tab_fongi[j].libelle_antifongique;
		                       				}
		                       			}
										var data = [

												libel,
												tab_anti[i].sensibilite
												];
									    var rowIndex = $('#tabFongi').dataTable().fnAddData(data);
								          var row = $('#tabFongi').dataTable().fnGetNodes(rowIndex);
								          $(row).attr( 'id','item' + tab_anti[i].id); 
								          var tr = $("#tabFongi tr#item"+tab_anti[i].id);
								          tr.find('td:eq(0)').addClass('text-left');
								          tr.find('td:eq(1)').addClass('text-left');
								         
									
								}

				           		});
     });


   $('#infosTechnique').on('shown.bs.modal', function () {
              
                $.ajax({
                            
                            url: "{{route('dashboard_technique_dossier')}}",
                            data: {
                               
                                'id_dossier': $('.did_dossier').text()
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

                                	$.ajax({
				                dataType:'json',
				                data: { 'id_examen' : $(".did_examC").text(),
				                		'id_examen_dossier': $(".did_examen_dossier").text() },
				                url: "{{route('dashboard_technique_valider')}}",
				                beforeSend: function(){
				                   $('.blockMe1').block({ 
				                      message: '<h3>Chargement.....</h3>', 
				                      css: { border: '3px solid #a00' } 
				                  }); 
				              },
				              complete: function(){
				                  $('.blockMe1').unblock();
				              } 
				               
				            })
				           .done(function(msg){
				              $('#tabRendu').dataTable().fnClearTable();
				              

				               tab_rendus =  JSON.parse(msg['rendus']);
		                       for(var i=0; i < tab_rendus.length ; i++){
									
										if (tab_rendus[i].libelle_rendu == null) {
											var libN = " ";
										}else{
											var libN = tab_rendus[i].libelle_rendu
										}
										var data = [
												"<input type='checkbox' class='checkitemTR' value='" + tab_rendus[i].id_element + "' />",
												"<a class=\'edit-modal\' style=\'cursor:pointer\' data-info=\'" + tab_rendus[i].id_element + "," + tab_rendus[i].libelle_rendu + "," + tab_rendus[i].code_examen + "," + tab_rendus[i].max + "," + tab_rendus[i].min + "," + tab_rendus[i].unite + "," + tab_rendus[i].ordre + "," + tab_rendus[i].type + "," + tab_rendus[i].valeur + "\'><span class=\'glyphicon glyphicon-edit\'></span> "+ libN + "</a>",
												tab_rendus[i].valeur,
												tab_rendus[i].max,
												tab_rendus[i].min,
												tab_rendus[i].unite,
												""
												];
									    var rowIndex = $('#tabRendu').dataTable().fnAddData(data);
								          var row = $('#tabRendu').dataTable().fnGetNodes(rowIndex);
								          $(row).attr( 'id','item' + tab_rendus[i].id_element); 
								          var tr = $("#tabRendu tr#item"+tab_rendus[i].id_element);
								           tr.attr("data-info",tab_rendus[i].max + "," + tab_rendus[i].min);
								          tr.find('td:eq(0)').addClass('text-center');
								          tr.find('td:eq(1)').addClass('text-left');
								          tr.find('td:eq(2)').addClass('text-left');
								          tr.find('td:eq(3)').addClass('text-left');
								          tr.find('td:eq(4)').addClass('text-left');
								          tr.find('td:eq(5)').addClass('text-left');
								          tr.find('td:eq(6)').addClass('text-left');
									
								}

								$("#tabEx").find('tr:eq(1)').addClass("warning");
				           		});
                            }
                        })
                        .done(function(msg){

                       nv =  JSON.parse(msg['patient']);
                       $("#numero_dossier").val( "" + pad(nv.numero_dossier,6));
                       $('#nom_patient').val("" + nv.nom_patient);
                       $("#age").val("" + nv.age);
                       for(var k=0; k < tabRC.length; k++){
                       	if(nv.renseignement == tabRC[k].id){
                       		 $("#renseignement").val(tabRC[k].libelle);
                       		 break;
                       	}
                       }

                        for(var k=0; k < tab_users.length; k++){
                       	if(nv.id_agent == tab_users[k].id){
                       		 $("#agent").val(tab_users[k].name);
                       		 break;
                       	}
                       }

                       if(nv.sexe =="Masculin"){
                       	 $("#SM").prop("checked","true");
                       }else{
                       	 $("#SF").prop("checked","true");
                       }
                       $("#tel").val("" + nv.telephone);
                       $("#assurance").val("" + nv.assurance);
                       var str = nv.date_prelevement.split(" ");
                       $("#preleve").val(str[0]);
                       if(nv.urgence == 1){
                       	
                       		$("#UO").prop("checked","true");
                       }else{
                       		$("#UN").prop("checked","true");
                       }
                       str = nv.date_dossier.split(" ");
                       $("#date_dossier").val(str[0]);
                       $("#presc").val("" + nv.prescripteur);
                       str = nv.date_retrait.split(" ");
                       $("#retrait").val(str[0]);
                      tab_examens =  JSON.parse(msg['examens_dossier']);
                    var  tab_exam2 = JSON.parse(msg['examens']);
                    var   tab_GE2 = JSON.parse(msg['groupe_examens']);
			         if( $(".did_endroit").text() == "technique" ){
			         	
			         	//alert("ok")
			       /*  	 for( var k = 0; k< tab_exam.length; k++){
			              if( (tab_examens[0].code_examen == tab_exam[k].id) && ( tab_exam[k].id_groupe_examen == parseInt($(".did_GE2").text()) ) ){
			                
			                var libelE = tab_exam[k].libelle_examen;
			                break;
			              }
			            }
			         $(".did_examen_dossier").text(tab_examens[0].id);
			         $(".did_examC").text(tab_examens[0].code_examen);
			         $(".did_examenA").text(tab_examens[0].code_examen);
			         $(".modal-titleCon").text("Conclusion de " + libelE);
			         $(".modal-titleBio").text("Antibiogramme de " + libelE);
			         $(".modal-titleFongi").text("Antifongigramme de " + libelE);*/
			         var deja =0;
			        // alert(tab_examens.length)
			         for(i=0;i < tab_examens.length;i++){
				    		
				        
				        for( var k = 0; k< tab_exam.length; k++){
			               
			              if((tab_examens[i].code_examen == tab_exam[k].id) && ( tab_exam[k].id_groupe_examen == parseInt($(".did_GE2").text()) ) ){
			              
			                var libelE = tab_exam[k].libelle_examen;
			                if( deja == 0){
			                	$(".did_examen_dossier").text(tab_examens[i].id);
						         $(".did_examC").text(tab_examens[i].code_examen);
						         $(".did_examenA").text(tab_examens[i].code_examen);
						         $(".modal-titleCon").text("Conclusion de " + libelE);
						         $(".modal-titleBio").text("Antibiogramme de " + libelE);
						         $(".modal-titleFongi").text("Antifongigramme de " + libelE);
						         deja = 1;
			                }

			                for(j=0; j< tab_GE.length;j++){
			                  if(tab_exam[k].id_groupe_examen == tab_GE[j].id){
			                    var libelT = tab_GE[j].libelle_groupe_examen;
			                    break;
			                  }
			                }
			               // alert(libelE + ' et ' + libelT);
			                var data = [
					                 
					                   libelE ,
					                    libelT
					                  ];
					          var rowIndex = $('#tabEx').dataTable().fnAddData(data);
					          var row = $('#tabEx').dataTable().fnGetNodes(rowIndex);
					          $(row).attr( 'id','item' + tab_examens[i].code_examen); 
					          $(row).attr('data-info', tab_examens[i].id);
					          var tr = $("#tabEx tr#item"+tab_examens[i].code_examen);
					          tr.find('td:eq(0)').addClass('text-left');
					          tr.find('td:eq(1)').addClass('text-left');
			                break;
			              }
			            }
                         
        				}
			         }else{
				         	  for( var k = 0; k< tab_exam2.length; k++){
				              if(tab_examens[0].code_examen == tab_exam2[k].id){
				               
				                var libelE = tab_exam2[k].libelle_examen;
				                break;
				              }
				            }
					         $(".did_examen_dossier").text(tab_examens[0].id);
					         $(".did_examC").text(tab_examens[0].code_examen);
					         $(".did_examenA").text(tab_examens[0].code_examen);
					         $(".modal-titleCon").text("Conclusion de " + libelE);
					         $(".modal-titleBio").text("Antibiogramme de " + libelE);
					         $(".modal-titleFongi").text("Antifongigramme de " + libelE);
					         for(i=0;i < tab_examens.length;i++){
					    		
							         
							        for( var k = 0; k< tab_exam2.length; k++){
						               
						              if(tab_examens[i].code_examen == tab_exam2[k].id){
							               
							                var libel = tab_exam2[k].libelle_examen;
							                
							                for(j=0; j< tab_GE2.length;j++){
							                  if(tab_exam2[k].id_groupe_examen == tab_GE2[j].id){
							                    var libelT = tab_GE2[j].libelle_groupe_examen;
							                    break;
							                  }
							                }
							                break;
						              }
						            }

								        
								          var data = [
								                 
								                   libel,
								                    libelT
								                  ];
								          var rowIndex = $('#tabEx').dataTable().fnAddData(data);
								          var row = $('#tabEx').dataTable().fnGetNodes(rowIndex);
								          $(row).attr( 'id','item' + tab_examens[i].code_examen); 
								          $(row).attr('data-info', tab_examens[i].id);
								          var tr = $("#tabEx tr#item"+tab_examens[i].code_examen);
								          tr.find('td:eq(0)').addClass('text-left');
								          tr.find('td:eq(1)').addClass('text-left');
				          
				          
	                         
	        					}
			         }
			         

       });  

 			 
 			 
    });

         $('#checkallTR').change(function(){
          $('.checkitemTR').prop("checked",$(this).prop("checked"))
           $('.checkitemTR').each(function(){
            if($(this).prop("checked")){
           
              countC++;
            }
           });

          
         });

 		$('#footerTR').on('click', '.supprimer', function() {
          

 		  var str = $(".didTR").text();
 		  nv = str.split(",");
 		  
                       
                       for (var i=0; i< nv.length; i++){
                          $('#tabRendu').dataTable().fnDeleteRow(  $('#tabRendu').dataTable().$("#item"+ nv[i])[0] );
                          
                         }
                      $("#checkallTR").removeAttr('checked');
                              
                       $("#modalSupp").modal('hide');	
         
      });
 		$('#ModSearchBio').on('shown.bs.modal', function () {
               	 $("#biotique").find("option").remove();
               	 var values=[]; 
            	var i=0;
               	 $('#tabBio > tbody  > tr > td > input').each(function() {
               	 		values[i] = $(this).val();
               	 		i++;
               	 })
               
                 
                for(var i=0;i < tab_bio.length;i++){
	                if(ispresent(tab_bio[i].id,values)){
							
							$('#biotique').append($('<option>',
			                   {
			                      value: tab_bio[i].id,
			                      text : tab_bio[i].libelle_antibiotique
			                  }));
					 }
                }
        });
		 
		function ispresent(elt,arr){
			var trouve = true;
			for(var i = 0; i < arr.length;i++){
				if(arr[i] == elt){
					trouve = false;
				}
			}
			return trouve;
		}
     
            
       
       $('#footerF').on('click', '.delete', function() {
         
         var str = $('.didF').text();
         nv = str.split(",");
      
         $("#CHKFongi_all").removeAttr("checked");
         for (var i=0; i< nv.length; i++){
          	$('#tabFongi').dataTable().fnDeleteRow( $('#tabFongi').dataTable().$("#item"+ nv[i])[0] );
          	for(var j=0; j < tab_fongi.length; j++){
          		if( tab_fongi[j].id == nv[i]){
          			$('#fongique').append($('<option>',
		            {
	                      value: tab_fongi[j].id,
	                      text : tab_fongi[j].libelle_antifongique
		            }));
          		}
          	}
         }
         $("#ModsearchFongi").modal('hide');
                       
      });

       $('#footerF').on('click', '.ajout', function() {
                

                var data = [
                               "<input type=\'checkbox\' class=\'CHKFongi_item\' value=\'" + $("#fongique option:selected").val() + "\'/>",
                                $("#fongique option:selected").text(),
                                $("#sensibiliteF").val()
                              ];
                              var rowIndex = $('#tabFongi').dataTable().fnAddData(data);
                              var row = $('#tabFongi').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + $("#fongique option:selected").val());
                              var tr = $("#tabFongi tr#item"+ $("#fongique option:selected").val());
                              tr.find('td:eq(0)').addClass('text-center');
                              tr.find('td:eq(1)').addClass('text-left');
                              tr.find('td:eq(2)').addClass('text-left');
                              $("#ModsearchFongi").modal('hide');
                              $("#fongique option[value="+ $("#fongique option:selected").val() +"]").remove();
                              
       });

       $('#ModsearchFongi').on('shown.bs.modal', function () {
                 $("#fongique").find("option").remove();
                 var values=[]; 
              var i=0;
                 $('#tabFongi > tbody  > tr > td > input').each(function() {
                    values[i] = $(this).val();
                    i++;
                 })
               
                 
                for(var i=0;i < tab_fongi.length;i++){
              if(ispresent(tab_fongi[i].id,values)){
              
              $('#fongique').append($('<option>',
                         {
                            value: tab_fongi[i].id,
                            text : tab_fongi[i].libelle_antifongique
                        }));
           }
                }
        });
    
     $('#footerB').on('click', '.ajout', function() {
       					

       					var data = [
                               "<input type=\'checkbox\' class=\'CHKBio_item\' value=\'" + $("#biotique option:selected").val() + "\'/>",
                                $("#biotique option:selected").text(),
                                $("#sensibilite").val()
                              ];
                              var rowIndex = $('#tabBio').dataTable().fnAddData(data);
                              var row = $('#tabBio').dataTable().fnGetNodes(rowIndex);
                              $(row).attr( 'id','item' + $("#biotique option:selected").val());
                              var tr = $("#tabBio tr#item"+ $("#biotique option:selected").val());
                              tr.find('td:eq(0)').addClass('text-center');
                              tr.find('td:eq(1)').addClass('text-left');
                              tr.find('td:eq(2)').addClass('text-left');
                              $("#ModSearchBio").modal('hide');
                              $("#biotique option[value="+ $("#biotique option:selected").val() +"]").remove();
                              
       });
 		$('#ModTech2').on('shown.bs.modal', function () {
 				$("#resultT").focus();
 				//$("#resultT").val($("#resultT1 option:selected" ).text());
 		});
 	   $('#ModTech2 input').keypress(function (e) {
          if (e.which == 13) {
          		 if( validate() ){
 	  			 if(  ( ($("#maximumT").val() == "") && ($("#minimumT").val() == "") ) || (  ( $("#maximumT").val() != "" ) &&  ( ($("#minimumT").val() != "" )) )  ){
 	  			  	if (($("#maximumT").val() != "")) {
 	  			  	 		if(  parseFloat($("#maximumT").val()) >= parseFloat( $("#minimumT").val()) ) {
 	  			  	 	
		 	  			  	 	 $(".didSpy").text("0");
			 	  			  	  $(".erreur").addClass("hidden");	
				 	  			  var tr = $("#tabRendu tr#item"+ $(".did_renduC").text());
				                  tr.find('td:eq(2)').html("" + $("#resultT").val());
				                  tr.find('td:eq(3)').html("" + $("#maximumT").val());
				                  tr.find('td:eq(4)').html("" + $("#minimumT").val());
				                   $('#tableCP').DataTable().rows( tr ).invalidate().draw();
				                  $("#ModTech2").modal('hide');
		 	  			  	 }else{
		 	  			  	 	
		 	  			  	 	$(".erreur").removeClass("hidden");
		 	  			 	   $(".erreur").text("Le maximum doit etre superieur au minimum");
		 	  			  	 }
 	  			  	 }else{
 	  			  	 		 $(".didSpy").text("0");
			 	  			  	  $(".erreur").addClass("hidden");	
				 	  			  var tr = $("#tabRendu tr#item"+ $(".did_renduC").text());
				                  tr.find('td:eq(2)').html("" + $("#resultT").val());
				                  tr.find('td:eq(3)').html("" + $("#maximumT").val());
				                  tr.find('td:eq(4)').html("" + $("#minimumT").val());
				                   $('#tableCP').DataTable().rows( tr ).invalidate().draw();
				                  $("#ModTech2").modal('hide');
 	  			  	 }
 	  			  	  
                  }else{
                  	 $(".erreur").removeClass("hidden");
 	  			    $(".erreur").text("Veuillez remplir les champs vides");
                  }
 	  		
 	  	     }
          }
      });
 	  $("#btnValT").click(function(){
         if( validate() ){
 	  			  
 	  			  if(  ( ($("#maximumT").val() == "") && ($("#minimumT").val() == "") ) || (  ( $("#maximumT").val() != "" ) &&  ( ($("#minimumT").val() != "" )) )  ){
 	  			  	 if (($("#maximumT").val() != "")) {
 	  			  	 		if(  parseFloat($("#maximumT").val()) >= parseFloat( $("#minimumT").val()) ) {
 	  			  	 	
		 	  			  	 	 $(".didSpy").text("0");
			 	  			  	  $(".erreur").addClass("hidden");	
				 	  			  var tr = $("#tabRendu tr#item"+ $(".did_renduC").text());
				 	  			  if( parseInt($(".did_type").text()) == 0 || parseInt($(".did_type").text()) == 1 || parseInt($(".did_type").text()) == 3){
				 	  			  		tr.find('td:eq(2)').html("" + $("#resultT").val());	
				 	  			  }else{
				 	  			  		tr.find('td:eq(2)').html("" + $("#resultT1 option:selected").text());
				 	  			  }
				                  
				                  tr.find('td:eq(3)').html("" + $("#maximumT").val());
				                  tr.find('td:eq(4)').html("" + $("#minimumT").val());
				                   $('#tableCP').DataTable().rows( tr ).invalidate().draw();
				                  $("#ModTech2").modal('hide');
		 	  			  	 }else{
		 	  			  	 	
		 	  			  	 	$(".erreur").removeClass("hidden");
		 	  			 	   $(".erreur").text("Le maximum doit etre superieur au minimum");
		 	  			  	 }
 	  			  	 }else{
 	  			  	 		 $(".didSpy").text("0");
			 	  			  	  $(".erreur").addClass("hidden");	
				 	  			  var tr = $("#tabRendu tr#item"+ $(".did_renduC").text());
				                   if( parseInt($(".did_type").text()) == 0 || parseInt($(".did_type").text()) == 1 || parseInt($(".did_type").text()) == 3){
				 	  			  		tr.find('td:eq(2)').html("" + $("#resultT").val());	
				 	  			  }else{
				 	  			  		tr.find('td:eq(2)').html("" + $("#resultT1 option:selected").text());
				 	  			  }
				                  tr.find('td:eq(3)').html("" + $("#maximumT").val());
				                  tr.find('td:eq(4)').html("" + $("#minimumT").val());
				                   $('#tableCP').DataTable().rows( tr ).invalidate().draw();
				                  $("#ModTech2").modal('hide');
 	  			  	 }
 	  			  	 
 	  			  	 	
 	  			  	  
                  }else{
                  	 $(".erreur").removeClass("hidden");
 	  			    $(".erreur").text("Veuillez remplir les champs vides");
                  }
 	  		
 	  	}
 	  });
/*
     $('#footerB').on('click', '.edit', function() {
       					
     			  var tr = $("#tabBio tr#item"+ $("#biotique option:selected").val());
                  tr.find('td:eq(1)').html("" + $("#biotique option:selected").text());
                  tr.find('td:eq(2)').html("" + $("#sensibilite").val());
                  $("#ModSearchBio").modal('hide');
       });*/
    
     $('#footerB').on('click', '.delete', function() {
         
         var str = $('.didB').text();
         nv = str.split(",");
      
         $("#CHKBio_all").removeAttr("checked");
         for (var i=0; i< nv.length; i++){
          	$('#tabBio').dataTable().fnDeleteRow( $('#tabBio').dataTable().$("#item"+ nv[i])[0] );
          	for(var j=0; j < tab_bio.length; j++){
          		if( tab_bio[j].id == nv[i]){
          			$('#biotique').append($('<option>',
		            {
	                      value: tab_bio[j].id,
	                      text : tab_bio[j].libelle_antibiotique
		            }));
          		}
          	}
         }
         $("#ModSearchBio").modal('hide');
                       
      });
 


   });
		</script>
</div>