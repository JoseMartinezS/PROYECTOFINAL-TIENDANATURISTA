<?php
require ("../conn.php");
$consulta="SELECT * FROM empleado WHERE estatus = 1";
$resultado = $conn->query($consulta);

$grupos = array();

while ($row = $resultado->fetch_assoc()) {
    $grupo = array(
        'puesto' => $row['sueldo'],
        'nombre' => $row['apellidoPaterno'],
        'ApellidoMaterno' => $row['telefono'],
    );

    $grupos[] = $grupo;
}

$conn->close();

$json = json_encode($grupos);

header('Content-type: application/json');
header('Content-Disposition: attachment; filename="empleado.json"');
header('Content-Length: ' . strlen($json));

echo $json;
exit();
?>