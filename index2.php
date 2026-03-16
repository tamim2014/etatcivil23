<?php
/*
	try{$conn = new PDO('mysql:host=localhost;dbname=etatcivil;charset=utf8', 'root', ''); }
	catch(Exception $e){die('Erreur de connexion à la base de données: '.$e->getMessage());}
	
	$reponse = $conn->query('SELECT * FROM liste WHERE ID='.$id );
	$donnees = $reponse->fetch();
*/

session_start();
    $BD_serveur     = "localhost";
    $BD_utilisateur = "root";
    $BD_motDePasse  = "";
    $BD_base        = "etatcivil";

   /*
  	$db = mysqli_connect($BD_serveur,$BD_utilisateur,'',$BD_base)or die('Erreur de connection :'.mysqli_error());
	$db->set_charset("utf8");
  */

	// Connexion PDO
try {
    $bdd = new PDO(
        'mysql:host=localhost;dbname=etatcivil;charset=utf8',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    die('Erreur de connexion à la base de données: ' . $e->getMessage());
}
  
 // moteur de recherche 
  if(isset($_POST['acte_']))  $numero=$_POST['acte_'];
  if(isset($_POST['nom_']))   $nomm=$_POST['nom_'];

	// moteur de recherche 
	$message ="Pour trouver un document, entrer ci-haut, son num&eacute;ro, ou son nom";
	//if(isset($_POST['acte_']) && !ctype_digit($numero) ){$message = ' le numero est mal saisi'; }
	
    if(!empty($numero) && ctype_digit($numero) )
    {	 
	  /*
	  $sql="SELECT * FROM liste WHERE acte =".$numero; // PAS DE SLASH POUR UN ENTIER
	  $req=mysqli_query($db,$sql) or die('Erreur SQl !<br>'.$sql.'<br>'.mysqli_error($db));
	  $result = mysqli_fetch_row($req);
	  */
        $req = $bdd->prepare("SELECT * FROM liste WHERE acte = :numero");
        $req->execute([':numero' => $numero]);
        $result = $req->fetch(PDO::FETCH_ASSOC);

	    if ($result[0] == 0){
			$message = ' Veuillez saisir vos identifiants'; 
		}else{
		 // --- enregistrement en session de l'utilisateur
			$_SESSION["acte"] = $numero;
		 // --- redirection en fonction de l'utilisateur
			header("Location: lectureBD2.php?num=".$numero );
		}
	}
	//ctype_digit($nombre) verifie si c est un nombre entier
	if(!empty($numero) && !ctype_digit($_POST['acte_'])) {$message = 'le numero est mal saisi'; }

		  
    if(!empty($nomm) )
    {
	  /*
	  $sql2="SELECT * FROM `liste` WHERE `nom`='$nomm';";
	  $req2=mysqli_query($db,$sql2) or die('Erreur SQl !<br>'.$sql2.'<br>'.mysqli_error($db));
	  $result2 = mysqli_fetch_row($req2);
	  */

	$req2 = $bdd->prepare("SELECT * FROM liste WHERE nom = :nom");
    $req2->execute([':nom' => $nomm]);
    $result2 = $req2->fetch(PDO::FETCH_ASSOC);
	    if ($result2[0] == 0){$message = ' aucun resultat trouv&eacute;'; 
		}else{
		 // --- enregistrement en session de l'utilisateur
			$_SESSION["nom"]=$nomm;
		 // --- redirection en fonction de l'utilisateur
			header("Location: lectureBD2.php?nom=".$nomm);
		}
	}
	
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil </title>
	<link href="css/template.css"  rel="stylesheet" type="text/css" >
	<link href="css/accueil22.css" rel="stylesheet"   />
    <link href="css/slide.css"     rel="stylesheet"   />
	<link href="css/dropdown.css"  rel="stylesheet"    />

	<script src="js/jquery.js"></script>
</head>

<body >
    <header>
		<div class="en-tete">
			<div class="hollowTop"   >				   
			   <input type=image src="img/drapeau.png" align="left" class="flag" style="width:30%; height:100%; filter:brightness(80%);" />
			   <p class="text_header" style="padding-top:2%; padding-left:45%;">OFFICE    D'&Eacute;TAT CIVIL </p>			  
			</div> 
		</div>		
		<div class="menu topnav"  id="myTopnav"> 
				<?php include("inc/accueil/accueil_menucentral_login.php"); ?> 
		</div>
    </header>
    <div class="contenu" style="margin-bottom:0;">
	    <form action ="" method="POST" name="form1" >
			<!-- LE PANNEAU DE GAUCHE : Recher des document par numero ou nom -->
			<div class="colonne_laterale" style=" margin-bottom:0; padding-bottom:0; height:auto;">
				<aside style="padding:0; margin-bottom:0; background: #ECECEA ; " >
					<table class="tablegauche" style="margin-bottom:0; padding-bottom:0; height:24em; box-shadow: none; border:1px solid #c4c4c4; border-bottom:none; background: #ECECEA ;"  > 
					    <!-- <caption  style="caption-side:top; box-shadow: 0 0 65px #cdbe9f inset, 0 0 20px #beae8c inset, 0 0 5px #816f47;  ">  -->
						<caption  style="caption-side:top; box-shadow: 0 20px 65px #cdbe9f outset; border:1px solid #c4c4c4; border-top:none; background: #ECECEA; margin-bottom:1em;"> 
						    <font color="gray" style="line-height:2;">
								 <h3> UNION DES COMORES  </h3>
								 <h6> Unit&eacute;-Solidarit&eacute;-D&eacute;veloppement  </h6>
								 <h4> MINISTERE DE L'INTERIEUR  </h4>
							 </font>
							 <!-- <img src="img/armoirie.png" style="z-index:3; transform: translate(200%, 0);  "  /> -->
							  <img src="img/armoirie.png" style="z-index:3;  margin-left:40%; margin-right:40%; margin-bottom:1%; width:20%;  "  />
						      
							</caption>
						 <tr > <td >AUTHENTIFICATION</td></tr>
						 <tr><td> <font color="#cdbe9f"><b>Entrer votre</b></font> login<br/> <input  type="text"   id="login_"    name="pseudo_"  style="background:#ddd; "> </td></tr> 
						 <tr><td> <font color="#cdbe9f"><b>Votre</b></font> mot de passe    <br/> <input  type="text"  id="pswd_"     name=""motdepasse_" style="background:#ddd;"> </td></tr>
						 <tr><td style="padding-top:1em;">
							 <textarea class="t_area" name="myTextBox" cols="18" rows="4"> Veuillez saisir vos identifiants </textarea>
						 <br/><input id="valider_" type="submit" name="envoie" value="Valider"  style="background: #ECECEA ; color:#111; padding:.3em 3.3em; margin:1em auto; border-radius:4px; " />
						 </td></tr>
					</table>					 
				</aside>
			</div>
			<!-- LE PANNEAU DE DROITE : Recher des document par liste déroulante -->
			<div class="colonne_contenu" style="padding:0;">
				<aside>
					<table  class="tabledroite" >
			             <tr>
							<td class="listemenu"> 
								  <!-- mettre une video ici pour montrer comment utiliser l'application -->
							</td>
						</tr> 
		            </table>
				</aside>
			</div>
		</form>
    </div>     
    <div class="footer" style="margin-top:0; padding-top:0; ">
        Pied de Page
    </div>
</body>
</html>
<?php include("SERVEUR/authentification.php "); ?>




 

