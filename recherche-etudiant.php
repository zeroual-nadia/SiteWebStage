
 <?php include ("head.php");?>
 <style type="text/css">
 	body{
 		background-color: silver;
 	}
 </style>
<form class="col-sm-2" action="info-etudiant" method="post" style="margin-left: 300px;margin-top: 100px" >

<div class="form-group">
		<label > Email </label>
        <input type="email" class="form-control" placeholder ="Veuillez entrez votre email ... " required  name="email"style="width:350px;"/>
	</div>
	<?php

$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));

$_SESSION['token'] = $token;
	?>
	<input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />
<button type="submit" class="btn btn-primary" style="margin-left:100px;">Suivi<span class="glyphicon glyphicon-log-in"></span></button>
</form>