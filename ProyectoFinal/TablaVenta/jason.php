<?php
require ("../conn.php");
$consulta="SELECT * FROM venta WHERE estatus = 1";
$resultado = $conn->query($consulta);

$grupos = array();

while ($row = $resultado->fetch_assoc()) {
    $grupo = array(
        'cantidad' => $row['fecha'],
        'tipoPago' => $row['descuento'],
    );

    $grupos[] = $grupo;
}

$conn->close();

$json = json_encode($grupos);

header('Content-type: application/json');
header('Content-Disposition: attachment; filename="venta.json"');
header('Content-Length: ' . strlen($json));

echo $json;
exit();
?>