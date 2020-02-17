<?php
require_once "session.php";
require_once "config.php";

if ($_SESSION['acesso'] < 10) {
	header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
	 
	 <style type="text/css">

    	@media print{

		    @page{
		        size: landscape;
		    }
		}
    </style>
</head>
<body>

    
    
   
<?php
echo "<h2>PATRIMONIOS:</h2>";
?>

<table id="customers">
    <thead>
      <tr>
        <th>Numero do Patrimonio</th>
        <th>Unidade do Patrimonio</th>
        <th>Descrição do Patrimonio</th>
        <th>Modelo</th>
        <th>Estado do equipamento</th>
        <th>Local da manutenção</th>
        <th>Estado</th>
        <th>Observações</th>
      </tr>
    </thead>
    <tbody>
<?php

$i = 0;
while (isset($_POST['values'][$i])) {
	$query  = "SELECT * FROM patrimonios WHERE id = '".$_POST['values'][$i]."'";
	$run = mysqli_query($GLOBALS['conn'], $query);
	if (mysqli_num_rows($run) > 0) {
		
	$row = mysqli_fetch_assoc($run);


?>
	<tr>

		<td style="padding: 3px 5px 3px 10px;"><?php echo $row['n_patr']; ?></td>
        <td style="padding: 3px 5px 3px 10px;"><?php echo $row['localizacao']; ?></td>
        <td style="padding: 3px 5px 3px 10px;"><?php echo $row['descricao']; ?></td>
        <td style="padding: 3px 5px 3px 10px;"><?php echo $row['modelo']; ?></td>
       <!-- <td style="padding: 3px 5px 3px 10px;"><?php echo $GLOBALS['patrimonio']->getEstById($row['estado_equip']); ?></td>-->
        <td style="padding: 3px 5px 3px 10px;"><?php 
        		if ($row['estado_equip'] == 3) {
	   				echo $row['man_loc'];
	   			} ?></td>
        <td style="padding: 3px 5px 3px 10px;"><?php echo $row['estado']; ?></td>  
        <td style="padding: 3px 5px 3px 10px;"><?php echo $row['obs']; ?></td>
    </tr>

	   <?php
	}else{
		echo " Nenhum patrimônio selecionado!";
	}
	$i++;
} 
?>
</tbody>
  </table>
</body></html>