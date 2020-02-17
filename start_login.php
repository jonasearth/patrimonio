<?php

$email = $_POST['email'];
$pass = $_POST['pass'];
if (empty($email) or empty($pass)) {
	header('location: login.php?err=2');
}else{
		$query = "SELECT * FROM usuarios WHERE login = '".$email."' and senha = '".$pass."' LIMIT 1";
		
		$run = mysqli_query($GLOBALS['conn'], $query);

		if (mysqli_num_rows($run) == 0) {
			header('location: login.php?err=1');
			
		}else{
			$row = mysqli_fetch_assoc($run);



			$_SESSION['id'] = $row['id'];
			$_SESSION['nome'] = $row['nome'];
			$_SESSION['acesso'] = $row['acesso'];
			$_SESSION['login'] = $row['login'];

			header('location: index.php');
	
		}
		
	
		
}