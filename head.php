<?php

// On démarre la session en début de chaque page
session_start();

?>

<!DOCTYPE HTML>
<html>

  <head>
  <head>
                <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>gestion de stages</title>


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
      <li class="active"><a href="principale.php"<span class="glyphicon glyphicon-home">Accueil</a></li>     
      <li> <a href="informations">Informations</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li> <a href="inscription-etudiants.php">Inscription-etudiant</a></li>
      <li> <a href="login_gestion_form.php">Gestionnaire</a></li>
      <li> <a href="login_form.php">Tuteur/Admin</a></li>
      <li> <a href="recherche-etudiant.php">Suivi-dossier</a></li>
    </ul>
  </div>
  
</div>
  </body>