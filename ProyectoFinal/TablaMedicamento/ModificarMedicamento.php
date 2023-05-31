<?php
$idMedicamento = $_POST["idMedicamento"];
$existencia = $_POST["existencia"];
$salida = $_POST["salida"];
$fechaCaducidad = $_POST["fechaCaducidad"];
$laboratorio = $_POST["laboratorio"];

require_once('../config.inc.php');

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE medicamento SET existencia='".$existencia."', salida='".$salida."', fechaCaducidad='".$fechaCaducidad."', laboratorio='".$laboratorio."' 
        WHERE idMedicamento='".$idMedicamento."'";

if ($conn->query($sql) === TRUE) {
    $conn->close();
    header("location: TablaMedicamento.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>