<?php
$idConsulta = $_POST["idConsulta"];
$precio = $_POST["precio"];
$fecha = $_POST["fecha"];
$motivo = $_POST["motivo"];
$diagnostico = $_POST["diagnostico"];

require_once('../config.inc.php');

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE consulta SET precio='" . $precio . "', fecha='" . $fecha . "', motivo='" . $motivo . "', diagnostico='" . $diagnostico . "' WHERE idConsulta='" . $idConsulta . "'";

if ($conn->query($sql) === TRUE) {
    $conn->close();
    header("location: TablaConsulta.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
