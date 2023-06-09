<?php
require ("../conn.php");
$consulta="Select * from venta WHERE estatus = 1";
$resultado = $conn->query($consulta);

$xml = new XMLWriter();
$xml->openURI('venta.xml');
$xml->startDocument('1.0', 'UTF-8');
$xml->setIndent(true);

$xml->startElement('tabla');

while ($row = $resultado->fetch_assoc()) {
    $xml->startElement('venta');
    $xml->writeElement('cantidad', $row['cantidad']);
    $xml->writeElement('fecha', $row['fecha']);
    $xml->writeElement('tipoPago', $row['tipoPago']);
    $xml->writeElement('descuento', $row['descuento']);
    $xml->endElement(); 
}
$xml->endElement();
$xml->endDocument();
$xml->flush();

$conn->close();

header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename="venta.xml"');
header('Content-Length: ' . filesize('venta.xml'));

readfile('venta.xml');
exit();
?>