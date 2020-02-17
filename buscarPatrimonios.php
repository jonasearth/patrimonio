<?php
require_once "session.php";
require_once "config.php";

if ($_SESSION['acesso'] < 10) {
	header("location: index.php");
}
$localizacao = mysqli_real_escape_string($GLOBALS['conn'], $_POST['localizacao']);
$seach = mysqli_real_escape_string($GLOBALS['conn'], $_POST['seach']);
$descricao = mysqli_real_escape_string($GLOBALS['conn'], $_POST['descricao']);

$query = "SELECT * FROM patrimonios WHERE n_patr LIKE '%$seach%' ";

	$query .= "AND localizacao LIKE '%$localizacao%'";

	$query .= "AND descricao LIKE '%$descricao%'";


$run = mysqli_query($GLOBALS['conn'], $query);
if (mysqli_num_rows($run) > 0) {
	while($row = mysqli_fetch_assoc($run)){ 
	?>
		<div id="card<?php echo $row['id']; ?>" class="card">

            <div class="card-header">
                <input id="patrs" type="checkbox" style="width: auto;float: left;z-index: 900000;margin-top: 20px;" class="form-control despp" value="<?php echo $row['id']; ?>">    
                <a class="card-link collapsed" style="margin-left: 18px;" data-toggle="collapse" href="#<?php echo $row['id']; ?>" onclick="" aria-expanded="false">Patrimonio de número: <?php echo $row['n_patr']; ?></a>
            </div>
            <div id="<?php echo $row['id']; ?>" class="collapse" data-parent="#<?php echo $row['id']; ?>" style="">
                <div class="card-body">
                    
                   Numero do Patrimonio: <?php echo $row['n_patr']; ?> <br>
                   Unidade do Patrimonio: <?php echo $row['localizacao']; ?> <br>
                   Descrição do Patrimonio: <?php echo $row['descricao']; ?> <br>
                   Modelo: <?php echo $row['modelo']; ?> <br>
                  <!-- Estado do equipamento: <?php echo $GLOBALS['patrimonio']->getEstById($row['estado_equip']); ?> <br> -->
                   <?php if ($row['estado_equip'] == 3) {
                   		echo "Local da manutenção: ".$row['man_loc']. "<br>";
                   }  ?>
                   Estado: <?php echo $row['estado']; ?><br>
                    Observações: <?php echo $row['obs']; ?><br>
                   <br><br>
                   <button onclick="deletePatr('<?php echo $row['id']; ?>')" class="btn btn-danger btn-sm">Deletar</button>
                   <button onclick="attPatr('<?php echo $row['id']; ?>')" class="btn btn-primary btn-sm">Alterar</button>
                    
                </div>

            </div>
        </div>

	<?php 
	}
}else{
	
	echo "Nenhum resultado para a busca!";

}