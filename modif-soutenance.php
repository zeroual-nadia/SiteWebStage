
<?php

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
    <ul class="nav navbar-nav navbar-right">
      <li> <a href="Logout">Logout</a></li>
    </ul>
  </div>
  
</div>

<br>
    <br> <br> <br> <br>
    <?php

if (isset($_GET['stid']) ) {
  @$stid=$_GET["stid"];
  session_start();
  $_SESSION['stid'] =$stid;
  ?>
  <form class="col-sm-2" action="modif-soutenance-fini.php" style="margin-left: 300px;margin-top: 100px" method="post">
  <div class="form-group">
    <label > Nouvelle salle : </label>
        <input type="text" class="form-control" placeholder ="la nouvelle salle... " required  name="salle"style="width:350px;"/>
  </div>
  <div class="form-group">
    <label > nouvelle date: </label>
     <input type="date" class="form-control"  placeholder ="nouvelle date ... " required  name="date"style="width:350px;"/>
  </div>

<div class="form-group">
    <button type="submit" class="btn btn-primary"style="margin-left:100px;">Modifier <span class="glyphicon glyphicon-hand-right"></span> </button>
  </div>
  
</form>
<?php
}
?>

