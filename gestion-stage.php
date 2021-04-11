
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
<br> <br> <br>
<?php  
   try{
      $bdd_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
       $bdd=new PDO($dsn,$username,$password);
    // Récupérer les informations de tout les etudiants
     $req= $bdd->prepare("SELECT * FROM etudiants "); 
     $req->execute();
  ?>
    <table id="liste" class="display table" style="width:100%">
      <thead>
      <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Email</th>
      <th>Tel</th>
       <th>Titre</th>
      <th>Tuteur 1 </th>
      <th>Tuteur 2 </th>
      <th>Date</th>
      <th>Salle</th>
      <th>TuteurE</th>
      <th>EmailTe</th>
      <th>TuteurP</th>
      <th>Note</th> 
      <th>Commentaire</th>      
      </tr>
      </thead>
        <tbody>
      <?php
      while ($row=$req->fetch(PDO::FETCH_OBJ)) {
        $Titre='';
        $tuteur1='';
        $tuteur2='';
        $date='';
        $salle='';
        $tuteure='';
        $emailte='';
        $tuteurp='';
        $note='';
        $cmt='';
        //info stage
        $reqst = $bdd->prepare("SELECT * FROM etudiants e, stages s WHERE e.eid = s.eid and e.eid = ?");
        $reqst->execute(array($row->eid));
        $rowst=$reqst->fetch(PDO::FETCH_OBJ);

        if ($rowst != null) {
          $tuteure=$rowst->tuteurE;
          $emailte=$rowst->emailTE;
          $Titre=$rowst->titre;
          $sid=$rowst->sid;
          $tuteurp=$rowst->tuteurP;

          //chercher tuteurP si !=NULL
          if ($tuteurp != null) {
            $reqtp = $bdd->prepare("SELECT * FROM users u WHERE u.uid = ?"); 
            $reqtp->execute(array($tuteurp));
            $rowtp=$reqtp->fetch(PDO::FETCH_OBJ);
            $tuteurp = $rowtp->prenom. '-' .$rowtp->nom;
          }
                   // Vérifier si une soutenance est déjà prévue pour le stage 
          $reqs = $bdd->prepare("SELECT * FROM stages t, soutenances s WHERE t.sid = s.sid and t.eid = ?");
          $reqs->execute(array($row->eid));
          $rows=$reqs->fetch(PDO::FETCH_OBJ);
          if ($rows != null) {
            $tuteur1=$rows->tuteur1;
            //chercher tuteur1 si !=NULL
            if ($tuteur1 != null) {
              $reqt1 = $bdd->prepare("SELECT * FROM users u WHERE u.uid = ?"); 
              $reqt1->execute(array($tuteur1));
              $rowt1=$reqt1->fetch(PDO::FETCH_OBJ);
              $tuteur1 =$rowt1->prenom . '-' .$rowt1->nom;
            }
            $tuteur2=$rows->tuteur2;
            //chercher tuteur2 si !=NULL 
            if ($tuteur2 != null) {
               $reqt2 = $bdd->prepare("SELECT * FROM users u WHERE u.uid = ?"); 
               $reqt2->execute(array($tuteur2));
              $rowt2=$reqt2->fetch(PDO::FETCH_OBJ);
              $tuteur2 = $rowt2->prenom . '-' .$rowt2->nom;
              }
            $date=$rows->date;
            $salle=$rows->salle;              
          }
                  // Vérifier si une note est déjà donnée au stage
          $reqn = $bdd->prepare("SELECT * FROM stages st, notes n WHERE st.sid = n.sid and st.sid = ?");
          $reqn->execute(array($rowst->sid));
          $rown=$reqn->fetch(PDO::FETCH_OBJ);
          if ($rown != null) {
              $note=$rown->note;
              $cmt=$rown->commentaire;
          } 
        }             
        ?>
        <tr>
        <td><?php echo $row->nom ?></td>
        <td><?php echo $row->prenom ?></td>
        <td><?php echo $row->email ?></td>
        <td><?php echo $row->tel ?></td>
        <td><?php echo $Titre ?></td>
        <td><?php echo $tuteur1 ?></td>
        <td><?php echo $tuteur2 ?></td>
        <td><?php echo $date ?></td>
        <td><?php echo $salle ?></td>
        <td><?php echo $tuteure ?></td>
        <td><?php echo $emailte ?></td>       
        <td><?php echo $tuteurp?></td>        
        <td><?php echo $note ?></td>
        <td><?php echo $cmt?></td>
        <td>
          <?php
           if ($rowst != null) {
            ?>
          <a href="<?php echo "sup-stage1.php?sid=" . $sid ?>" title="supprimer">
            supprimer
          </a>
          <?php
        }
         ?>
        </td>
        <tr>
      <?php
      }
      ?>
      </tbody>

      </table>
    
  <?php     
  } catch (Exeption $e) { 
            die('Erreur de connexion à la base : '.$e->getMessage());
  }
  

?>