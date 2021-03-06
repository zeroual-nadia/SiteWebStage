<?php

include "db_config.php";
session_start();
?>
<!DOCTYPE HTML>
<html>

  <head>
  <head>
                <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


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
      <li> <a href="gestion-stage">Gestion-Stages</a></li>
      <li> <a href="gestion-tuteur">Gestion-Tuteurs</a></li>
      <li> <a href="liste-soutenance">Liste-soutenances</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li> <a href="Logout">Logout</a></li>
    </ul>
  </div>
  
</div>

<br>
    <br> <br> <br> <br> 

<?php
try{
    $bdd_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd=new PDO($dsn,$username,$password);
    $req= $bdd->prepare("SELECT * FROM stages "); 
    $req->execute();
    echo "Liste des etudiants sans soutenances";
    ?>
     <table id="liste" class="display table" style="width:100%">
      <thead>
      <tr>
      <th>Etudiant</th>
      <th>email</th>    
      </tr>
      </thead>
        <tbody>
          <?php
    while($row=$req->fetch(PDO::FETCH_OBJ)){
      $sid=$row->sid;
      $eid=$row->eid;
      $reqs= $bdd->prepare("SELECT * FROM soutenances WHERE sid=? "); 
      $reqs->execute(array($sid));
      $rows=$reqs->fetch(PDO::FETCH_OBJ);
      if($rows==NULL){
        $reqe= $bdd->prepare("SELECT * FROM etudiants WHERE eid=?"); 
        $reqe->execute(array($eid));
        while($rowe=$reqe->fetch(PDO::FETCH_OBJ)){
          ?>
         <tr>
        <td><?php echo $rowe->nom ." ".$rowe->prenom ?></td>
        <td><?php echo $rowe->email?></td>
        <td>
          <a href="<?php echo "?sid=" . $sid ?>" title="soutenance">
                  prevoir soutenance
           </a>
         </td>
         <?php
        }
      }      
      }
      ?>
      </tr>
        </tbody>
        </table>
<?php
} catch (Exeption $e) { 
            die('Erreur de connexion ?? la base : '.$e->getMessage());
  }
?>
