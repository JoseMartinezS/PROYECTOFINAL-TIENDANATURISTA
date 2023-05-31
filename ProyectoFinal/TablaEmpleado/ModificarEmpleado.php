<?php
$idEmpleado = $_POST["idEmpleado"];
$puesto = $_POST["puesto"];
$sueldo = $_POST["sueldo"];
$nombre = $_POST["nombre"];
$apellidop = $_POST["apellidop"];
$apellidom = $_POST["apellidom"];
$telefono = $_POST["telefono"];

require_once('../config.inc.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE empleado SET puesto='".$puesto."', sueldo='".$sueldo."', nombre='".$nombre."', apellidop='".$apellidop."', apellidom='".$apellidom."', telefono='".$telefono."' 
WHERE idEmpleado='".$idEmpleado."'";

if ($conn->query($sql) === TRUE) {
    $conn->close();
    header("location:TablaEmpleado.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>