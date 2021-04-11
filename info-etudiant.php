<?php
include "db_config.php";
include "head.php"
?>
 <style type="text/css">
 	body{
 		background-color: silver;
 	}
 </style>
 <?php
     //on verrifie que l'email est bien rentrer
if (isset($_SESSION['token']) && !empty($_POST['token'])) {
    	//verifier que les token sont identique
    if ($_SESSION['token'] == $_POST['token']) {
    	// Récupérer la variable email du formulaire 
           $refetudiant = $_POST['email']; 
       try{
       	    $bdd_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd=new PDO($dsn,$username,$password);
            //Compter le nb d'etudiants avec le email soit 1 soit 0
		    $req = $bdd->prepare("SELECT COUNT(*) FROM etudiants WHERE email LIKE ?"); 
		    $req->execute(array($refetudiant));		
		    $nb= $req->fetchColumn();
		    //Si y'a pas de dossier etudiants ref avec le email
		    if ($nb== 0) {
		    	?>
		    	<script>
		    		alert("Aucun dossier étudiant référencé par l'email Veuillez modifier votre recherche");
		    	</script>
		        <?php
		    } else {
			//l'etudiant existe donc on récupérer les informations
			    $req = $bdd->prepare("SELECT * FROM etudiants WHERE email LIKE ?"); 
			    $req->execute(array($refetudiant));
			
			   $row=$req->fetch(PDO::FETCH_OBJ);
			   echo '<div class="col-md-6 col-md-offset-3">';
		      ?>
	</br>
</br>
</br>
</br>
<?php			
//nom prenom email tel 
			echo '<div class="row form-group">';
			echo '<label > Nom </label>';
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $row->nom .'" >';
			echo '</div>';
							
			echo '<div class="row form-group">';
			echo '<label > Prénom </label>';
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $row->prenom .'">';
			echo '</div>';

			echo '<div class="row form-group">';
			echo '<label > Email </label>';
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $row->email .'">';
			echo '</div>';

			echo '<div class="row form-group">';
			echo '<label > Téléphone </label>';
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $row->tel .'">';
			echo '</div>';	
			//Informations du stage de l'étudiant
			$req = $bdd->prepare("SELECT * FROM etudiants e, stages s WHERE e.eid = s.eid and e.email LIKE ?"); 
			$req->execute(array($refetudiant));
			
			$row=$req->fetch(PDO::FETCH_OBJ);

			echo '<div class="row form-group">';
			echo '<label > Titre </label>';
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $row->titre .'">';
			echo '</div>';
							
			echo '<div class="row form-group">';
			echo '<label > Description </label>';
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $row->description .'">';
			echo '</div>';

			echo '<div class="row form-group">';
			echo '<label > Entreprise </label>';
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $row->entreprise.'">';
			echo '</div>';

			echo '<div class="row form-group">';
			echo '<label > Tuteur entreprise </label>';
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $row->tuteurE .'">';
			echo '</div>';	

			echo '<div class="row form-group">';
			echo '<label > Email tuteur entreprise </label>';
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $row->emailTE .'">';
			echo '</div>';
			$req = $bdd->prepare("SELECT * FROM users u WHERE u.uid = ?"); 
			$req->execute(array($row->tuteurP));
			
			$rowu=$req->fetch(PDO::FETCH_OBJ);
			
			echo '<div class="row form-group">';
			echo '<label > Tuteur pédagogique </label>';
			if ($rowu == null) $nom = ""; else $nom =$rowu->prenom . ' ' .$rowu->nom;
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $nom .'">';
			echo '</div>';

			echo '<div class="row form-group">';
			echo '<label > Date de début </label>';
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $row->dateDebut .'">';
			echo '</div>';

			echo '<div class="row form-group">';
			echo '<label > Date de fin </label>';
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $row->dateFin.'">';
			echo '</div>';
			
			// Récupérer les informations de la soutenance de l'étudiant
			$req = $bdd->prepare("SELECT * FROM soutenances s WHERE s.sid = ?"); 
			$req->execute(array($row->sid));
			
			$rows=$req->fetch(PDO::FETCH_OBJ);
			
			
			// info tuteur 1 
			$req = $bdd->prepare("SELECT * FROM users u WHERE u.uid = ?"); 
			//on passe null si l'etudiant n'a pas de soutenance 
			$req->execute(array($rows ? $rows->tuteur1 : null)); 
			$rowt1=$req->fetch(PDO::FETCH_OBJ);
			
			//info tuteur 2 
			$req = $bdd->prepare("SELECT * FROM users u WHERE u.uid = ?"); 
			//null si pas de soutenance 
			$req->execute(array($rows ? $rows->tuteur2 : null)); 
			
			$rowt2=$req->fetch(PDO::FETCH_OBJ);
			
			echo '<div class="row form-group">';
			echo '<label > Tuteur 1 </label>';
			if ($rowt1 == null) $nom = ""; else $nom = $rowt1->prenom . ' ' .$rowt1->nom;
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $nom .'">';
			echo '</div>';
			
			echo '<div class="row form-group">';
			echo '<label > Tuteur 2 </label>';
			if ($rowt2 == null) $nom = ""; else $nom = $rowt2->prenom. ' ' .$rowt2->nom;
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $nom .'">';
			echo '</div>';
			
			echo '<div class="row form-group">';
			echo '<label > Date </label>';
			if ($rows == null) $date = ""; else $date = $rows->date;
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $date .'">';
			echo '</div>';
			
			echo '<div class="row form-group">';
			echo '<label > Salle </label>';
			if ($rows == null) $salle = ""; else $salle = $rows->salle;
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $salle .'">';
			echo '</div>';
			
	        //la  note et le commentaire de la soutenance
			$req = $bdd->prepare("SELECT * FROM notes n WHERE n.sid = ?"); 
			$req->execute(array($rows ? $rows->sid : null));
			
			$rown=$req->fetch(PDO::FETCH_OBJ);
			
			echo '<div class="row form-group">';
			echo '<label > Note </label>';
			if ($rown == null) $note = ""; else $note = $rown->note;
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $note .'">';
			echo '</div>';
			
			echo '<div class="row form-group">';
			echo '<label > Commentaire </label>';
			if ($rown == null) $commentaire = ""; else $commentaire = $rown->commentaire;
			echo '<input type="text" class="form-control well" disabled = "disabled" value = "' . $commentaire .'">';
			echo '</div>';							
	       }
	    }catch(PDOException $e){
	       //on cas d'erreur on affiche un message et on arrete tout
           die('erreur de connexion : '. $e->getMessage());
        }
    }
}

?>