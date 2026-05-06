<?php
 echo '
 	    <div id="menudroite">
                <a href="accueil.php"> 
				    <div class="kangalaheMenu">  
					   <input type="button" class="btnHover writeBtn" value="Accueil" />
					</div>     
				</a>
				<p> &nbsp;</p>
				<div class="kangalaheMenu">			  
				    <!-- <input type="submit" onclick="actenumero();" id="enregistrer"  name="Enregistrer" value="Enregistrer"/> -->					
				    <!-- Ne pas rediriger vers l\'accueil: Afficher pour verifier d\'abord  -->
					<input type="submit" class="btnWrite" id="enregistrer" name="Enregistrer" value="Enregistrer"/> 					
		        </div>
				<p> &nbsp;</p>
				<div class="kangalaheMenu">
				    <a href="#" ><input type="button" class="btnWrite" value="Rectifier" align="center" /></a>
                </div>
				<p> &nbsp;</p>
				<div class="kangalaheMenu">  
				   <a href="ecritureBD.php"><input type="button" class="btnWrite" name="enregistrer_" value="Nouveau document" onclick="alert(\'Enregistrement effectué.\');" /></a>
		        </div>
        </div>
';
?>
	 
        
		
     