<?php
require_once "session.php";
require_once "config.php";

if ($_SESSION['acesso'] < 10) {
	header("location: index.php");
}

$query = "SELECT * FROM patrimonios WHERE id = '".$_POST['id']."'";
$run = mysqli_query($GLOBALS['conn'], $query);
$row = mysqli_fetch_assoc($run);

$resposta['descricao'] = $row['descricao'];

$resposta['localizacao'] = $row['localizacao'];
$resposta['estado_equip'] = $row['estado_equip'];



?>
                                            <div class="col-md-12">

                                            <select  class="form-control col-md-6" style="padding: inherit; float: left;" id="localizacao1">
                                                    <option value="Sede" <?php if($row['localizacao'] == "Sede") echo "selected" ?>>Sede</option>
                                                    <option value="Texeira de Freitas"<?php if($row['localizacao'] == "Texeira de Freitas") echo "selected" ?>>Texeira de Freitas</option>
                                                    <option value="Porto Seguro"<?php if($row['localizacao'] == "Porto Seguro") echo "selected" ?>>Porto Seguro</option>
                                                    <option value="Eunapolis"<?php if($row['localizacao'] == "Eunapolis") echo "selected" ?>>Eunapolis</option>
                                                    <option value="Unidade HU"<?php if($row['localizacao'] == "Unidade HU") echo "selected" ?>>Unidade HU</option>
                                                    
                                            </select>

                                            <select class="form-control col-md-6" style="padding: inherit;float: left;" name="descricao1" id="descricao1">
                                                <?php 
                                                    $descricoes = $GLOBALS['patrimonio']->getDescriptions();
                                                    $i = 0;
                                                    while (isset($descricoes[$i])) { 
                                                ?>
                                                <option value="<?php echo $descricoes[$i]['id']; ?>" <?php if($row['descricao'] == $descricoes[$i]['id']) echo "selected" ?>><?php echo $descricoes[$i]['nome']; ?></option>


                                                <?php $i++;    }
                                                ?>
                                                
                                            </select>
                                            <input style="float: left;" type="text" value="<?php echo $row['modelo']; ?>" class="form-control col-md-6" name="modelo1" id="modelo1" placeholder="Modelo do equipamento">

                                            <input type="text" style="float: left;" value="<?php echo $row['n_patr']; ?>" class="form-control col-md-6" name="n_patr1" id="n_patr1" placeholder="Número do Patrimônio">

                                            <select onchange="checkestado()" class="form-control col-md-6" style="padding: inherit;float: left;" id="estado_equip1">
                                                <option value="1" <?php if($row['estado_equip'] == "1") echo "selected" ?>>Funcionando</option>
                                                <option value="2" <?php if($row['estado_equip'] == "2") echo "selected" ?>>Quebrado</option>
                                                <option value="3" <?php if($row['estado_equip'] == "3") echo "selected" ?>>Em Manutenção</option>
                                            </select>  

                                            
                                            
                                            <input type="text" class="form-control col-md-6" value="<?php echo $row['man_loc']; ?>" name="man_loc1" id="man_loc1" placeholder="Localização da Manutenção" style="<?php if($row['estado_equip'] != "3") echo "visibility: hidden;" ?>float: left;">

                                            <input type="hidden" id="idc" value="<?php echo $row['id_cliente']; ?>">
                                            <input type="hidden" id="clt" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" id="npo" value="<?php echo $row['n_patr']; ?>">
                                            
                                            <button style="margin-top: 40px" type="submit" onclick="attpatrimonio()" class="btn btn-primary btn-sm">Atualizar Patrimonio</button>
                                           
                                           
                                         </div>