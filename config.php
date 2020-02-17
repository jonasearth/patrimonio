<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "patrimonio";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$GLOBALS['conn'] = $conn;
mysqli_query($GLOBALS['conn'], "SET NAMES 'utf8'");
mysqli_query($GLOBALS['conn'], 'SET character_set_connection=utf8');
mysqli_query($GLOBALS['conn'], 'SET character_set_client=utf8');
mysqli_query($GLOBALS['conn'], 'SET character_set_results=utf8');

require_once "Patrimonio.class.php";
$GLOBALS['patrimonio'] = new Patrimonio();
?>
