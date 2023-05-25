<?php 
$host = "127.0.0.1:3307";
$user = "root";
$password = "";
$db = "PECI_Lab";

$conexion = new mysqli($host, $user, $password, $db);

if($conexion->connect_errno){
  echo "Falló la conexión a la base de datos " . $conexion->connect_error;
}
?>