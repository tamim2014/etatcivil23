<?php
 echo '
 	    <div id="menudroite">
                <a href="accueil.php"> 
				    <div class="kangalaheMenu">  
					   <input type="button" class="btnHover writeBtn" value="Accueil" />
					</div>     
				</a>
				
				<div class="kangalaheMenu">			  
				    <!-- <input type="submit" onclick="actenumero();" id="enregistrer"  name="Enregistrer" value="Enregistrer"/> -->					
				    <!-- Ne pas rediriger vers l\'accueil: Afficher pour verifier d\'abord  -->
					<input type="submit" class="btnWrite" id="enregistrer" name="Enregistrer" value="Enregistrer"/> 					
		        </div>
				
				<div class="kangalaheMenu">
				    <a href="#" ><input type="button" class="btnWrite" value="Rectifier" align="center" /></a>
                </div>
			
				<div class="kangalaheMenu">  
				   <a href="ecritureBD.php"><input type="button" class="btnWrite" name="enregistrer_" value="Nouveau document" onclick="alert(\'Enregistrement effectué.\');" /></a>
		        </div>
        </div>
';
?>
	 
        
		
     