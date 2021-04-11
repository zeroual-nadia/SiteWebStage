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
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li> <a href="Logout">Logout</a></li>
    </ul>
  </div>
  
</div>

<br>
    <br> <br> <br> <br> 

<form class="col-sm-2" action="enregistrer-user" style="margin-left: 300px;margin-top: 100px" method="post">
	
	<div class="form-horizontal">
		<label > Nom </label>
        <input type="text" class="form-control" placeholder ="nom ... " required  name="nom"style="width:350px;"/>
	</div>
	
	  <div class="form-group">
		<label > Prénom </label>
        <input type="text" class="form-control" placeholder =" prénom ... " required  name="prenom"style="width:350px;"/>
	</div>
	
	<label for="inputLogin">Login</label>
<input type="text" class="form-control" id="inputLogin" name="login" placeholder="Login..."style="width:350px;"/>
</div>
<div class="form-group">
<label for="inputMDP">Mot de passe</label>
<input type="password" class="form-control" id="inputMDP" name="mdp" placeholder="Motde passe..."style="width:350px;"/>
</div>
 <?php

$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));

$_SESSION['token'] = $token;
	?>
	
     <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />

<div class="form-group">
		<button type="submit" class="btn btn-primary"style="margin-left:100px;"> Ajout<span class="glyphicon glyphicon-hand-right"></span> </button>
	</div>
	
</form>