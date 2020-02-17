<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="estilo.css">
    <title>THE GOOD BOYS REGISTRO</title>  
</head>
<body>
   <h1>E ai guys</h1>     E ai guys
    <div>
    <form id="form" action ="registro.php" method="post"><br>
        <ul >
            NOME COMPLETO: <input type=text name="nome"><br>
   	        USUÁRIO: <input type=text name="usuario"><br>
   	        SENHA: <input type="password" name="senha"><br>
   	        IDADE: <input type="text" name="idade"><br>
   	        CAMISA: <input type="text" name="camisa"><br>
   	        POSIÇÃO: <select name="cbxPOS" >
        </ul>

        <option value="1">ATA</option>
        <option value="2">MEI</option>
        <option value="3">LAT/D</option>
        <option value="4">LAT/E</option>
        <option value="5">ZAG</option>
        <option value="6">GOL</option>

    </select>
   	<br><input type="submit" value="Cadastrar-se" name="cadastro">
    </form>
</div>
</body>
</html>
<?php
	include_once("config.php");
	if(isset($_nome)){
		if(isset($_POST["cbxPOS"])){
        $pos = $_POST["cbxPOS"];
        switch($mes){
            case 1:
                echo "ATACANTE";
                break;
            case 2:
                echo "MEIO-CAMPO";
                break;
            case 3:
                echo "LATERAL ESQUERDO";
                break;
            case 4:
                echo "LATERAL DIREITO";
                break;
            case 5:
                echo "ZAGUEIRO";
                break;
            case 6:
                echo "GOLEIRO";
                break;
        }
    }
		$nome = $_POST['nome'];
		$usuario = $_POST['usuario'];
		$senha = $_POST['senha'];
		$idade = $_POST['idade'];
		$camisa = $_POST['camisa'];
		$cadastro = $_POST['cadastro'];
		$acesso = 10;

		$insert_jogadores = "INSERT INTO jogadores(nome, usuario, senha, idade, camisa, acesso) VALUES ('$nome', '$usuario', '$senha', '$idade', '$camisa', '$acesso')"; 	
		$jogadores_conn =  mysqli_query($conn, $insert_jogadores);

		if (isset($cadastro)){
			header("Location: login.php");
		}
	}
?>
