<?php

$cantidad = $_POST["cantidad"];
$fecha = $_POST["fecha"];
$tipoPago = $_POST["tipoPago"];
$descuento = $_POST["descuento"];

require_once('../config.inc.php');


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO venta (cantidad, fecha, tipoPago, descuento)
VALUES ('".$cantidad."', '".$fecha."', '".$tipoPago."', '".$descuento."')";

if ($conn->query($sql) === TRUE)
{
  $conn->close();
  header("location:TablaVenta.php");

} else 
{
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


//Ctrl+D Selecciona las siguientes palabras

//Shift+Alt Selecion de los caracteres

?>