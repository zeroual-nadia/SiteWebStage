 <?php

// On démarre la session en début de chaque page
session_start();
include "db_config.php";

?>

<!DOCTYPE HTML>
<html>

  <head>
  <head>
                <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Accueil tuteur</title>


    <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->  

    <style type="text/css">
    legend {
  width: 200;
  margin-left: 100px;
}
      .btn-lg {
        padding: 2px;
        margin : auto;
      }
 .inline-form input {
            display: inline-block;
            width: 100px;
        }
   .navbar-brand {
            padding: 0px;
          }
.navbar-brand>img {
  height: 140%;
  width: 100%;
}
body{
	 background-color: silver;
}
    </style>
  </head>
  <body>
    <div class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      
       <a class="navbar-brand" rel="home" href="#" title="Buy Sell Rent Everyting">
        <img style="max-width:100px; margin-top: -7px;"
             src="photo/logo.png">
    </a>
    </div>
    <ul class="nav navbar-nav">  
      <li> <a href="informations">Informations</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li> <a href="Logout">Logout</a></li>
    </ul>
  </div>
  
</div>


<?php

//verifier que les champs ne sont pas vide
if (isset($_SESSION['login']) && isset($_SESSION['mdp'])) {
	
	try{
       	    $bdd_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd=new PDO($dsn,$username,$password);

		?>
		<br>
		<br> <br> <br> <br>

			
			<?php
			  echo '<label >  Tuteur pédagogique de </label>';
			$req = $bdd->prepare("SELECT * FROM users  WHERE login=?");
			$req->execute(array($_SESSION['login']));
            $row=$req->fetch(PDO::FETCH_OBJ);
            $uid=$row->uid;
            $reqs = $bdd->prepare("SELECT * FROM  stages  WHERE tuteurP=?");
			$reqs->execute(array($uid));
			?>
			<table class="display table" style="width:100%">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Email</th>
						<th>Tel</th>
					</tr>
				</thead>
				<tbody>
					<?php
            while($rows=$reqs->fetch(PDO::FETCH_OBJ)){
               $eid=$rows->eid;
                $reqe = $bdd->prepare("SELECT * FROM etudiants WHERE eid=?");
			    $reqe->execute(array($eid));
                $rowe=$reqe->fetch(PDO::FETCH_OBJ);
             ?>
             <tr>
                <td><?php echo $rowe->nom ?></td>
							<td><?php echo $rowe->prenom ?></td>
							<td><?php echo $rowe->email ?></td>
							<td><?php echo $rowe->tel ?></td>
						</tr>
					<?php 
			} ?>

				</tbody>

			</table>
			
			<br>
			<?php
			echo '<label >  Tuteur principale de </label>';
			?>
			<table class="display table" style="width:100%">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Email</th>
						<th>Tel</th>
						<th>date</th>
						<th>salle</th>
						<th>note</th>
						<th>commentaire</th>

					</tr>
				</thead>
				<tbody>

			<?php
            $reqt = $bdd->prepare("SELECT * FROM  soutenances WHERE tuteur1=?");
			$reqt->execute(array($uid));
			$rowt=$reqt->fetch(PDO::FETCH_OBJ);
			if($rowt!=NULL){
				$sid=$rowt->sid;
			$date=$rowt->date;
			$salle=$rowt->salle;
			$reqs2 = $bdd->prepare("SELECT * FROM  stages  WHERE sid=?");
			$reqs2->execute(array($sid));
			$rows2=$reqs2->fetch(PDO::FETCH_OBJ);
			$eid2=$rows2->eid;
			$reqe2 = $bdd->prepare("SELECT * FROM etudiants WHERE eid=?");
			$reqe2->execute(array($eid2));
            $rowe2=$reqe2->fetch(PDO::FETCH_OBJ);
            $reqn = $bdd->prepare("SELECT * FROM notes WHERE sid=?");
			$reqn->execute(array($sid));
            $rown=$reqn->fetch(PDO::FETCH_OBJ);

			?>
			<tr>
                <td><?php echo $rowe2->nom ?></td>
				<td><?php echo $rowe2->prenom ?></td>
				<td><?php echo $rowe2->email ?></td>
				<td><?php echo $rowe2->tel ?></td>
				<td><?php echo $date?></td>
				<td><?php echo $salle ?></td>
				<td><?php echo $rown->note ?></td>
				<td><?php echo $rown->commentaire ?></td>
				<td>
					<a href="<?php echo "modifier-note1.php?sid=" . $sid ?>" title="Modifier">
						Modifier la note/commentaire
					</a>
					</td>
						</tr>
						 <?php		
			}
			?>
				</tbody>
			</table>	
			<br>
         	<?php

			  echo '<label >Tuteur secondaire de </label>';
			  ?>
              <table class="display table" style="width:100%">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Email</th>
						<th>Tel</th>
						<th>date</th>
						<th>salle</th>
						<th>note</th>
						<th>commentaire</th>

					</tr>
				</thead>
				<tbody>

               <?php
            $reqt2= $bdd->prepare("SELECT * FROM  soutenances WHERE tuteur2=?");
			$reqt2->execute(array($uid));
			$rowt2=$reqt2->fetch(PDO::FETCH_OBJ);
			if($rowt2!=NULL){
				$sid2=$rowt2->sid;
			$date=$rowt2->date;
			$salle=$rowt2->salle;
			$reqs3 = $bdd->prepare("SELECT * FROM  stages  WHERE sid=?");
			$reqs3->execute(array($sid2));
			$rows3=$reqs3->fetch(PDO::FETCH_OBJ);
			$eid3=$rows3->eid;
			$reqe3 = $bdd->prepare("SELECT * FROM etudiants WHERE eid=?");
			$reqe3->execute(array($eid3));
            $rowe3=$reqe3->fetch(PDO::FETCH_OBJ);
            $reqn2 = $bdd->prepare("SELECT * FROM notes WHERE sid=?");
			$reqn2->execute(array($sid2));
            $rown2=$reqn2->fetch(PDO::FETCH_OBJ);

			?>
			<tr>
                <td><?php echo $rowe3->nom ?></td>
				<td><?php echo $rowe3->prenom ?></td>
				<td><?php echo $rowe3->email ?></td>
				<td><?php echo $rowe3->tel ?></td>
				<td><?php echo $date?></td>
				<td><?php echo $salle ?></td>
				<td><?php echo $rown2->note ?></td>
				<td><?php echo $rown2->commentaire ?></td>
			</tr>
		</tbody>
	</table>
	<?php	
			}	
	} catch (Exeption $e) { 
		        die('Erreur de connexion à la base : '.$e->getMessage());
	}
	
}

?>