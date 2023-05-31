<?php

$cantidad = $_POST["cantidad"];
$fecha = $_POST["fecha"];
$metodoPago = $_POST["metodoPago"];
$total = $_POST["total"];
$representante = $_POST["representante"];
$empleado = $_POST["empleado"];

require_once('../config.inc.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO compra (cantidad, fecha, metodoPago, total, idRepresentante, idEmpleado)
VALUES ('$cantidad', '$fecha', '$metodoPago', '$total', '$representante', '$empleado')";

if ($conn->query($sql) === TRUE) {
  $conn->close();
  header("location:TablaCompra.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
