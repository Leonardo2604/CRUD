<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Profile</title>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>e-mail</th>
				<th>show</th>
				<th>update</th>
				<th>delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$connection = new mysqli('localhost','root','','clientes');
				if($connection){
					$results = $connection->query("SELECT * FROM `user`");
					while($result = $results->fetch_assoc()){
						echo '<tr>';
						echo '	<td>'.$result['id'].'</td><!-- puxar id da tabela -->';
						echo '	<td>'.$result['name'].'</td><!-- puxar name da tabela -->';
						echo '	<td>'.$result['email'].'</td><!-- puxar email da tabela -->';
						echo '	<td><a href="db.php?action=show&id='.$result['id'].'">show</a></td><!-- ver name da tabela -->';
						echo '	<td><a href="register.php?id='.$result['id'].'">update</a></td><!-- atualiza name da tabela -->';
						echo '	<td><a href="'.$_SERVER["PHP_SELF"].'?id='.$result['id'].'&delete=true">delete</a></td><!-- deleta name da tabela -->';
						echo '</tr>';
					}
					$connection->close();
				}
			?>
		</tbody>
	</table>
	<?php if (isset($_GET['delete']) && isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['id'])){ ?>
			<div class="container_delete">
				<p>you have sure?</p>
				<a href="db.php?action=delete&id=<?=$_GET["id"]?>">yes</a>
				<a href="index.php">no</a>
			</div>
	<?php } ?>
	<a href="register.php">Register new user</a>

</body>
</html>