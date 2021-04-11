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
  <title>Accueil Admin</title>


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
      <li> <a href="gestion-stage">Gestion-Stages</a></li>
      <li> <a href="gestion-tuteur">Gestion-Tuteurs</a></li>
      <li> <a href="liste-soutenance">Liste-soutenances</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li> <a href="Logout">Logout</a></li>
    </ul>
  </div>
  
</div>
<br> <br> <br>
<?php
try{
    $bdd_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd=new PDO($dsn,$username,$password);
    $role='user';
    // Récupérer les informations de tout les etudiants
    $req= $bdd->prepare("SELECT * FROM users WHERE role=? "); 
    $req->execute(array($role));
  ?>
    <table id="liste" class="display table" style="width:100%">
      <thead>
      <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Actif</th>  
      <th>Tuteur principale de <br>(nb étudiants)</th>  
      <th>Tuteur secondaire pour <br>les soutenances de <br>(nb étudiants)</th>  
      </tr>
      </thead>
        <tbody>
      <?php
      while ($row=$req->fetch(PDO::FETCH_OBJ)) {
        $nom= $row->nom;
        $prenom=$row->prenom;
        $actif=$row->actif;
        $uid=$row->uid;
        $reqs= $bdd->prepare("SELECT COUNT(*) FROM stages WHERE tuteurP=?"); 
        $reqs->execute(array($uid));
        $nbetudiant= $reqs->fetchColumn();
        $reqt= $bdd->prepare("SELECT COUNT(*) FROM soutenances WHERE tuteur2=?"); 
        $reqt->execute(array($uid));
        $nb= $reqt->fetchColumn();

        ?>
       <tr>
        <td><?php echo $row->nom ?></td>
        <td><?php echo $row->prenom ?></td>
        <?php
        if($actif==1){
           ?>
           <td><?php echo 'oui' ?></td>
           <?php
        }else{
          ?>
           <td><?php echo 'non' ?></td>
           <?php
        }
        ?>
         <td><?php echo $nbetudiant ?></td>
         <td><?php echo $nb ?></td>
         <td>
                <a href="<?php echo "activ-desactiv.php?uid=" . $uid ?>" title="Activer">
                   Activation/Désactivation
                </a>
              </td>
               <td>
                <a href="<?php echo "affectation.php?uid=" . $uid ?>" title="Affect">
                   Affectation
                </a>
              </td>
        <?php
      }
      ?>
    </tr>
  </tbody>
</table>
<?php
} catch (Exeption $e) { 
            die('Erreur de connexion à la base : '.$e->getMessage());
  }
  ?>
  <form class="col-sm-2" action="ajout-user" style="margin-left: 300px" method="post">
  <div class="form-group">
    <button type="submit" class="btn btn-primary"style="margin-left:100px;">Ajout user<span class="glyphicon glyphicon-hand-right"></span> </button>
  </div>
</form>
