<?php include ("head.php");
include("db_config.php");?>
<style type="text/css">
	
body{
	background-color:silver;
}
</style>
<?php
//Vérifier que le jeton CSRF est là
if (isset($_SESSION['token']) && !empty($_POST['token'])) {
	//Vérifier que les tokens ce correspondent
    if ($_SESSION['token'] == $_POST['token']) {
		
		// Récupérer les variables du formulaires
		$nom = $_POST['nom']; 
		$prenom =  $_POST['prenom'];
		$email =  $_POST['email'];
		$tel =  $_POST['tel'];
		$titreS =  $_POST['titreS'];
		$descriptionS =  $_POST['descriptionS'];
		$entrepriseS=  $_POST['entrepriseS'];
		$dateDebut =  $_POST['dateDebut'];
		$dateFin =  $_POST['dateFin'];
		 try{
       	    $bdd_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd=new PDO($dsn,$username,$password);
			
		    //Insèrer les informations de l'etudiant dans la table etudiants
			$req = $bdd->prepare("INSERT INTO etudiants (nom, prenom, email, tel) VALUES (?, ?, ?, ? )");
			$iE = $req->execute(array($nom, $prenom, $email, $tel)); 
			
			//Récupérer le eid de l'étudiant inséré 
			$req = $bdd->prepare("SELECT eid FROM etudiants WHERE email LIKE ?"); 
			$selectQuery = $req->execute(array($email)); 
			
			$eid=$req->fetch(PDO::FETCH_OBJ)->eid;
					
			//Insèrer les information dans la table stages
			$req = $bdd->prepare("INSERT INTO stages (eid, titre, description, entreprise, tuteurE, emailTE, dateDebut, dateFin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
			//Mettre tuteurE et emailTE a null
			$is = $req->execute(array($eid, $titreS, $descriptionS, $entrepriseS, ' ', ' ', $dateDebut, $dateFin));
            echo '<div class="row">';
			echo '<div class="alert alert-success col-md-6 col-md-offset-3">';
			echo '</br> </br> </br> </br> </br>';
			echo ' Votre dossier étudiant à été créé avec succès. Pour suivre votre dossier utilisez le code suivant :<b>' . $email . '</b> <br><br>';
		} catch (Exeption $e) { 
			        die('Erreur de connexion à la base : '.$e->getMessage());
		}
	}
}