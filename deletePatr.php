<?php
require_once "session.php";
require_once "config.php";

if ($_SESSION['acesso'] < 10) {
	header("location: index.php");
}

$query = "DELETE FROM patrimonios WHERE id = '".$_POST['id']."'";
mysqli_query($GLOBALS['conn'], $query);
;