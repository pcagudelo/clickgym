<?php 
session_start();
$_SESSION["usuario"]=$_POST['nombre'];
header("location:../gimnasio.php");               
?>