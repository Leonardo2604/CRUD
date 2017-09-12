<?php
	function connect_db(){
		$server = "localhost";
		$user_db = "root";
		$password_db = "";
		$db = "clientes";
		$connection = new mysqli($server, $user_db, $password_db, $db);

		if (!$connection) {
			trigger_error(mysqli_connect_error());
		}else{
			return $connection;
		}
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_POST['id']) && is_numeric($_POST['id']) && !empty($_POST['id'])){
			if($_POST['id'] == -1){
				create();
			}else{
				update((int)$_POST['id']);
			}
		}
	}

	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_GET['action']) && !empty($_GET['action']) && !is_numeric($_GET['action'])){
			$action = $_GET['action'];

			switch ($action) {
				case 'show':
					if(isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['id'])){
						show((int)$_GET['id']);
					}
				break;
				
				case 'delete':
					if(isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['id'])){
						delete((int)$_GET['id']);
					}
				break;
			}
		}
	}

	function update($id){
		if(isset($_POST['name']) && !empty($_POST['name']) &&
		   isset($_POST['id']) && is_numeric($_POST['id']) && !empty($_POST['id']) && 
		   isset($_POST['email']) && !empty($_POST['email'])&&
		   isset($_POST['password']) && !empty($_POST['password']) &&
		   isset($_POST['confirm_password']) && !empty($_POST['confirm_password']) && $_POST['password'] == $_POST['confirm_password']
		   ){

			$connection = connect_db();
			$name = $_POST["name"];
			$email = $_POST['email'];
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$connection->query("UPDATE `user` SET `name` = '$name', `email` = '$email', `password` = '$password' WHERE id = $id");
			$connection->close();	
			show($id);
		}
	}

	function create (){
		if(isset($_POST['name']) && !empty($_POST['name']) &&
		   isset($_POST['id']) && is_numeric($_POST['id']) && !empty($_POST['id']) && 
		   isset($_POST['email']) && !empty($_POST['email'])&&
		   isset($_POST['password']) && !empty($_POST['password']) &&
		   isset($_POST['confirm_password']) && !empty($_POST['confirm_password']) && $_POST['password'] == $_POST['confirm_password']
		   ){

			$connection = connect_db();
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$connection->query("INSERT INTO user (`id`, `name`, `email`, `password`) VALUES (NULL, '$name', '$email', '$password')");
			$connection->close();
			header('Location:/CRUD/register.php');
		}
	}

	function show($id){
		$connection = connect_db();
		$result = $connection->query("SELECT * FROM `user` WHERE id= '$id'");
		$connection->close();
		$row = $result->fetch_assoc();
		header('Location:/CRUD/show.php?id='.$row['id'].'&name='.$row['name'].'&email='.$row['email'].'');
	}

	function delete($id){
		$connection = connect_db();	
		$connection->query("DELETE FROM `user` WHERE id = $id");
		$connection->close();
		header('Location:/CRUD/');
	}


?>