<?php
	$id = -1; // very much important!!

	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title><?=($id == -1)?"Registe":"Update"?></title>
</head>
<body>
	<h1><?=($id == -1)?"New user":"Update user"?></h1>
	<form name="register_user" action="db.php?action=create_update_form" method="post" enctype="multipart/form-data">
		<label>name:</label>
		<input type="text" name="name" pattern="[a-zA-Z\s]+$" required="required"/><br/>
		<label>e-mail:</label>
		<input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="required"/><br/>
		<label>password:</label>
		<input type="password" name="password" required="required" /><br/>
		<label>confirm password:</label>
		<input type="password" name="confirm_password" required="required" /><br/>
		<input type="hidden" name="id" value="<?=$id?>"/>
		<button type="submit" name="btn_register"><?=($id == -1)?"Cadatrar":"Salvar"?></button>
	</form>
	<a href="index.php">Table users</a>
</body>
</html>