<?php

$puesto = $_POST["puesto"];
$sueldo = $_POST["sueldo"];
$nombre = $_POST["nombre"];
$apellidop = $_POST["apellidop"];
$apellidom = $_POST["apellidom"];
$telefono = $_POST["telefono"];

require_once('../config.inc.php');


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO empleado (puesto, sueldo, nombre, apellidop, apellidom, telefono)
VALUES ('".$puesto."', '".$sueldo."', '".$nombre."', '".$apellidop."', '".$apellidom."', '".$telefono."')";

if ($conn->query($sql) === TRUE)
{
  $conn->close();
  header("location:TablaEmpleado.php");

} else 
{
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


//Ctrl+D Selecciona las siguientes palabras

//Shift+Alt Selecion de los caracteres

?>