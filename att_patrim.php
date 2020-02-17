<?php
require_once "session.php";
require_once "config.php";

$descricao = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST['descricao']));
$modelo = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST['modelo']));
$localizacao = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST['localizacao']));
$n_patr = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST['n_patr']));
$estado_equip = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST['estado_equip']));
$man_loc = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST['man_loc']));
$clt = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST['clt']));
$idc = $_POST['idc'];
$npo = $_POST['npo'];
if ($descricao == "false") {
	$return['status'] = false;
	$return['msg'] = "Selecione uma descricao!";
}else{
	if ($estado_equip == "0") {
		$return['status'] = false;
		$return['msg'] = "Selecione o estado do equipamento!";
	}else{
		if ($estado_equip == 3 && empty($man_loc)) {
			$return['status'] = false;
			$return['msg'] = "Se o equipamento esta em manutenção você deve informar onde está sendo consertado!";
		}else{
			if (empty($descricao) or empty($modelo) or empty($localizacao) or empty($n_patr) or empty($estado_equip)) {
				$return['status'] = false;
				$return['msg'] = "Você deve preencher todos os campos!";
			}else{
				$query = "SELECT * FROM patrimonios WHERE n_patr = '$n_patr' AND id_cliente = '$idc'";
				$run = mysqli_query($GLOBALS['conn'], $query);
				if (mysqli_num_rows($run) > 0 && $n_patr != "1" && $n_patr != $npo) {
					$return['status'] = false;
					$return['msg'] = "Você já tem um patrimonio com esse numero!";	
				}else{
					$query = "UPDATE patrimonios SET `n_patr` = '$n_patr', `descricao` = '$descricao', `modelo` = '$modelo', `localizacao` = '$localizacao', `estado_equip` = '$estado_equip', `man_loc` = '$man_loc' WHERE id = '$clt'";
					$run = mysqli_query($GLOBALS['conn'], $query);
					if ($run) {
						$return['status'] = true;
						$return['msg'] = "Patrimonio atualizado com sucesso!";

					}else{
						$return['status'] = false;
						$return['msg'] = "Não foi possivel atualizar os valores";	
					}
				}
			}
		}
	}
}

echo json_encode($return);
?>