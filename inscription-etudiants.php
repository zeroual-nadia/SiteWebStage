 <?php include ("head.php");?>

<style type="text/css">
	
body{
	background-color:silver;
}
</style>



<form class="col-sm-2" action="enregistrer-etudiant" style="margin-left: 300px;margin-top: 100px" method="post">
	<legend>Informations personnel</legend>
	
	<div class="form-horizontal">
		<label > Nom </label>
        <input type="text" class="form-control" placeholder ="Votre nom ... " required  name="nom"style="width:350px;"/>
	</div>
	
	  <div class="form-group">
		<label > Prénom </label>
        <input type="text" class="form-control" placeholder ="Votre prénom ... " required  name="prenom"style="width:350px;"/>
	</div>
	
	<div class="form-group">
		<label > Email </label>
        <input type="email" class="form-control" placeholder ="Votre email ... " required  name="email"style="width:350px;"/>
	</div>
	
	<div class="form-group">
		<label > Téléphone </label>
        <input type="tel" class="form-control" placeholder ="Votre téléphone ... " required  name="tel"  pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"style="width:350px">
	</div>
	
	<legend>Informations-stage </legend>
	
	<div class="form-group">
		<label > Titre </label>
        <input type="text" class="form-control" placeholder ="Titre du stage ... " required  name="titreS"style="width:350px;"/>
	</div>
	
<div class="form-group">
		<label > Description </label>
        <textarea class="form-control" placeholder ="Description de votre stage ... " required  name="descriptionS" style="width:350px;"/></textarea>
	</div>
	
	<div class="form-group">
		<label > Entreprise </label>
        <input type="text" class="form-control" placeholder ="Votre entreprise d'accueil ... " required  name="entrepriseS"style="width:350px;"/>
	</div>
	
<div class="form-group">
		<label > Date de début </label>
        <input type="date" class="form-control"  required  name="dateDebut"style="width:350px;"/>
	</div>
	
<div class="form-group">
		<label > Date de fin </label>
        <input type="date" class="form-control"  required  name="dateFin"style="width:350px;"/>
	</div>
 <?php

$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));

$_SESSION['token'] = $token;
	?>
	
     <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />

<div class="form-group">
		<button type="submit" class="btn btn-primary"style="margin-left:100px;"> Inscription<span class="glyphicon glyphicon-hand-right"></span> </button>
	</div>
	
</form>

