<?php
require ("../conn.php");
$consulta="SELECT * FROM representante WHERE estatus = 1";
$resultado = $conn->query($consulta);

$grupos = array();

while ($row = $resultado->fetch_assoc()) {
    $grupo = array(
        'nombre' => $row['apellidoPaterno'],
        'apellidoMaterno' => $row['relefono'],
    );

    $grupos[] = $grupo;
}

$conn->close();

$json = json_encode($grupos);

header('Content-type: application/json');
header('Content-Disposition: attachment; filename="representante.json"');
header('Content-Length: ' . strlen($json));

echo $json;
exit();
?>