<?php

$nombre = $_POST["nombre"];
$apellidoPaterno = $_POST["apellidoPaterno"];
$apellidoMaterno = $_POST["apellidoMaterno"];
$telefono = $_POST["telefono"];
$cantidad = $_POST["cantidad"];
$representante = $_POST["representante"];

require_once('../config.inc.php');


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO proveedor (nombre, apellidoPaterno, apellidoMaterno, telefono, idCompra, idRepresentante)
VALUES ('".$nombre."', '".$apellidoPaterno."', '".$apellidoMaterno."', '".$telefono."' , '".$cantidad."' 
, '".$representante."')";

if ($conn->query($sql) === TRUE)
{
  $conn->close();
  header("location:TablaProveedor.php");

} else 
{
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


//Ctrl+D Selecciona las siguientes palabras

//Shift+Alt Selecion de los caracteres

?>