<?php
$title="Authentification";
include("head.php");

echo "<p class=\"error\">".($error??"")."</p>";
?>

    <div class='center'>
        <h2>Authentifiez-vous</h2>
    <form class="form-horizontal col-lg-6" method="post">

<div class="row">
    <div class="form-group">
      <label for="text" class="col-lg-2 control-label">Text : </label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="text">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group">
      <label for="textarea" class="col-lg-2 control-label">Textarea : </label>
      <div class="col-lg-10">
        <input type="textarea" class="form-control" id="textarea">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group">
    <label for="select" class="col-lg-2 control-label">Select: </label>
      <div class="col-lg-10">
        <select id="select" class="form-control" >
          <option>Option 1</option>
          <option>Option 2</option>
          <option>Option 3</option>
        </select>
      </div>
    </div>
  </div>
  <div class="form-group">
    <button class="pull-right btn btn-default">Envoyer</button>
  </div>
</form>

  
<?php

include("footer.php");
?>