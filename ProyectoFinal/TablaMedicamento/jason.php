<?php
require ("../conn.php");
$consulta="SELECT * FROM medicamento WHERE estatus = 1";
$resultado = $conn->query($consulta);

$grupos = array();

while ($row = $resultado->fetch_assoc()) {
    $grupo = array(
        'existencia' => $row['salida'],
        'fechaCaducidad' => $row['laboratorio'],
    );

    $grupos[] = $grupo;
}

$conn->close();

$json = json_encode($grupos);

header('Content-type: application/json');
header('Content-Disposition: attachment; filename="medicamento.json"');
header('Content-Length: ' . strlen($json));

echo $json;
exit();
?>