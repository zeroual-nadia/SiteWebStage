
<br><br><br>
<?php
include "db_config.php";
include "head.php";

if (isset($_POST['email']) && isset($_POST['mdp'])) {
	
	$email =  $_POST['email'];
	$mdp =  $_POST['mdp'];
	
	 try{
       	    $bdd_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd=new PDO($dsn,$username,$password);
		// Récupérer les informations de la soutenance de l'étudiant
		    $req = $bdd->prepare("SELECT * FROM gestionnaires g WHERE g.email = ?");
		    $req->execute(array($email));
		    $row=$req->fetch(PDO::FETCH_OBJ);
		
		// Crypter le mdp saisi dans le form et vérifier qu'il correspond au mdp en base
		   if ($row != null and password_verify($mdp, $row->token) ) {
			// Session démarrée
			    $_SESSION['email'] = $email;
			    $_SESSION['mdp'] = $mdp;
			    $_SESSION['gid'] = $row->gid;
			    //on redirige vers acceuil admin
			header ('location: accueil-admin.php');
			exit();
		
	       }else{
			      ?>
			    <script >
			  	    alert("ERREUR: Email ou mot de passe incorrect")
			   </script>
		
		       <?php
	       }
						
       } catch (Exeption $e) { 
            die('Erreur de connexion à la base : '.$e->getMessage());
        }
	
}

?>