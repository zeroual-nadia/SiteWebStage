<?php
$title="Authentification";
include("head.php");
echo "<p class=\"error\">".($error??"")."</p>";
?>
<style type="text/css">
body{
  background-color: silver;
}
  .col-sm-2{
  margin-left: 300px;
  margin-top: 100px;
}

</style>
<form class="col-sm-2" action="verifier-tuteur-admin" method="post">
<legend>Se connecter</legend>
<div class="form-horizontal">
  <div class="form-group"
<label for="inputLogin">Login</label>
<input type="text" class="form-control" id="inputLogin" name="login" placeholder="Login..."style="width:350px;"/>
</div>
<div class="form-group">
<label for="inputMDP">Mot de passe</label>
<input type="password" class="form-control" id="inputMDP" name="mdp" placeholder="Motde passe..."style="width:350px;"/>
</div>
<button type="submit" class="btn btn-primary" style="margin-left:100px;">Connexion<span class="glyphicon glyphicon-log-in"></span></button>
</form>
<?php

include("footer.php");