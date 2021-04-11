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
  <title>Listes soutenances</title>


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
    // Récupérer les informations de tout les etudiants
    $req= $bdd->prepare("SELECT * FROM soutenances ORDER BY date"); 
    $req->execute();
  ?>
    <table id="liste" class="display table" style="width:100%">
      <thead>
      <tr>
      <th>Etudiant</th>  
      <th>Tuteur1</th>  
      <th>date</th>
      <th>salle</th>     
      </tr>
      </thead>
        <tbody>
      <?php
      while ($row=$req->fetch(PDO::FETCH_OBJ)) {
        $date= $row->date;
        $salle=$row->salle;
        //on cherche le nom de l'etudiant
        $sid=$row->sid;
        $reqs= $bdd->prepare("SELECT * FROM stages s WHERE s.sid = ?");
        $reqs->execute(array($sid));
        $rows=$reqs->fetch(PDO::FETCH_OBJ);
        $eid=$rows->eid;
        $reqe= $bdd->prepare("SELECT * FROM etudiants e WHERE e.eid = ?");
        $reqe->execute(array($eid));
        $rowe=$reqe->fetch(PDO::FETCH_OBJ);
        $etudiant=$rowe->nom.' '.$rowe->prenom;
        //on cherche le tuteur1
        $tuteur1=$row->tuteur1;
        $reqt= $bdd->prepare("SELECT * FROM users u WHERE u.uid = ?");
        $reqt->execute(array($tuteur1));
        $rowt=$reqt->fetch(PDO::FETCH_OBJ);
        $tuteur1=$rowt->nom.' '.$rowt->prenom;
        ?>
       <tr>
        <td><?php echo $etudiant ?></td>
        <td><?php echo $tuteur1 ?></td>
        <td><?php echo $row->date?></td>
        <td><?php echo $row->salle?></td>
        <td>
          <a href="<?php echo "modif-soutenance.php?stid=" . $row->stid ?>" title="Modifier">
            Modifier
          </a>
        </td>
        <td>
          <a href="<?php echo "supprime-soutenance1.php?stid=" . $row->stid ?>" title="Sup">
            Suprimer
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
<form class="col-sm-2" action="ajout-soutenance" style="margin-left: 300px" method="post">
  <div class="form-group">
    <button type="submit" class="btn btn-primary"style="margin-left:100px;">Ajout soutenance<span class="glyphicon glyphicon-hand-right"></span> </button>
  </div>
</form>