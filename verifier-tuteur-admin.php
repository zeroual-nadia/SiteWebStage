<?php
include "db_config.php";
include "head.php";

if (isset($_POST['login']) && isset($_POST['mdp'])) {
	
	$login =  $_POST['login'];
	$mdp =  $_POST['mdp'];
	
	 try{
       	    $bdd_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd=new PDO($dsn,$username,$password);
		// Récupérer les informations de la soutenance de l'étudiant
		    $req = $bdd->prepare("SELECT * FROM users u WHERE u.login = ?");
		    $req->execute(array($login));
		    $row=$req->fetch(PDO::FETCH_OBJ);
		
		// Crypter le mdp saisi et vérifier qu'il correspond au mdp en base
		   if ($row != null and password_verify($mdp, $row->mdp) ) {
			// Session démarrée
			    $_SESSION['login'] = $login;
			    $_SESSION['mdp'] = $mdp;
			    $_SESSION['role'] = $row->role;
			    $_SESSION['uid'] = $row->uid;
			    if($row->actif==0){
				    ?>
			      <script >
			  	      alert("ERREUR: Vous Etes désactiver");
			      </script>
		
		            <?php
			    }else{
				    if ($row->role == "user") {
				     // on redirige vers l'accueil des tuteurs
				        header ('location: accueil-tuteur.php');
				        exit();
			        } elseif ($row->role == "admin") {
				        // on redirige vers l'accueil admin
				         header ('location: accueil-admin.php');
				        exit();
			        }
			    }
			
			
		    } else { 
			      ?>
			    <script >
			  	    alert("ERREUR: Email ou mot de passe incorrect")
			   </script>
		
		       <?php
		      //header ('location: login_form.php');
		    }
		
				
       } catch (Exeption $e) { 
            die('Erreur de connexion à la base : '.$e->getMessage());
        }
	
}

?>