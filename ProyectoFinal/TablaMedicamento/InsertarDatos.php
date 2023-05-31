<?php

$existencia = $_POST["existencia"];
$salida = $_POST["salida"];
$fechaCaducidad = $_POST["fechaCaducidad"];
$laboratorio = $_POST["laboratorio"];
$cantidad = $_POST["cantidad"];


require_once('../config.inc.php');


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO medicamento (existencia, salida, fechaCaducidad, laboratorio, idVenta)
VALUES ('".$existencia."', '".$salida."', '".$fechaCaducidad."', '".$laboratorio."', '".$cantidad."')";

if ($conn->query($sql) === TRUE)
{
  $conn->close();
  header("location:TablaMedicamento.php");

} else 
{
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


//Ctrl+D Selecciona las siguientes palabras

//Shift+Alt Selecion de los caracteres

?>