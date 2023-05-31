<?php
require ("../conn.php");
$consulta="Select * from medicamento WHERE estatus = 1";
$resultado = $conn->query($consulta);

$xml = new XMLWriter();
$xml->openURI('medicamento.xml');
$xml->startDocument('1.0', 'UTF-8');
$xml->setIndent(true);

$xml->startElement('tabla');

while ($row = $resultado->fetch_assoc()) {
    $xml->startElement('medicamento');
    $xml->writeElement('existencia', $row['existencia']);
    $xml->writeElement('salida', $row['salida']);
    $xml->writeElement('fechaCaducidad', $row['fechaCaducidad']);
    $xml->writeElement('laboratorio', $row['laboratorio']);
    $xml->endElement(); 
}
$xml->endElement();
$xml->endDocument();
$xml->flush();

$conn->close();

header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename="medicamento.xml"');
header('Content-Length: ' . filesize('medicamento.xml'));

readfile('medicamento.xml');
exit();
?>