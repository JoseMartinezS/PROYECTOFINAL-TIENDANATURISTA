<?php

$precio = $_POST["precio"];
$fecha = $_POST["fecha"];
$motivo = $_POST["motivo"];
$diagnostico = $_POST["diagnostico"];
$cantidad = $_POST["cantidad"];

require_once('../config.inc.php');


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO consulta (precio, fecha, motivo, diagnostico, idVenta)
VALUES ('".$precio."', '".$fecha."', '".$motivo."', '".$diagnostico."', '".$cantidad."')";

if ($conn->query($sql) === TRUE)
{
  $conn->close();
  header("location:TablaConsulta.php");

} else 
{
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


//Ctrl+D Selecciona las siguientes palabras

//Shift+Alt Selecion de los caracteres

?>