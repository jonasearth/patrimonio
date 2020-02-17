<?php
require_once "session.php";
require_once "config.php";

if ($_SESSION['acesso'] < 10) {
	header("location: index.php");
}
$login = mysqli_real_escape_string($GLOBALS['conn'], $_POST['login']);
$senha = mysqli_real_escape_string($GLOBALS['conn'], $_POST['senha']);
$senha2 = mysqli_real_escape_string($GLOBALS['conn'], $_POST['senha2']);
$nome = mysqli_real_escape_string($GLOBALS['conn'], $_POST['nome']);
$acctype = mysqli_real_escape_string($GLOBALS['conn'], $_POST['acctype']);
if (empty($login) or empty($senha) or empty($senha2) or empty($nome) or empty($acctype)) {
	$return['status'] = false;
	$return['msg'] = "Preencha todos os campos!";
}else{
	if ($acctype == "user") {
		$acctype = "0";
	}
	if ($senha != $senha2) {
		$return['status'] = false;
		$return['msg'] = "As senhas não conferem!";
	}else{
		if ($acctype == "nulo") {
			$return['status'] = false;
			$return['msg'] = "Escolha o tipo de conta!";
		}else{
			$query = "SELECT * FROM usuarios WHERE login = '$login'";
			$run = mysqli_query($GLOBALS['conn'], $query);
			if (mysqli_num_rows($run) > 0) {
			 	$return['status'] = false;
				$return['msg'] = "O usuario já existe!";
			}else{
				$query = "INSERT INTO `usuarios` (`login`, `senha`, `acesso`, `nome`) VALUES ('$login', '$senha', '$acctype', '$nome')";
				$run = mysqli_query($GLOBALS['conn'], $query);
				if ($run) {
					$return['status'] = true;
					$return['msg'] = "Usuário registrado com sucesso";
				}else{
					$return['status'] = false;
					$return['msg'] = "Falha ao registrar usuário!";
				}
			}
		}
	}
}

echo json_encode($return);
?>