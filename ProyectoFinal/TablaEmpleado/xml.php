<?php
require ("../conn.php");
$consulta="Select * from empleado WHERE estatus = 1";
$resultado = $conn->query($consulta);

$xml = new XMLWriter();
$xml->openURI('empleado.xml');
$xml->startDocument('1.0', 'UTF-8');
$xml->setIndent(true);

$xml->startElement('tabla');

while ($row = $resultado->fetch_assoc()) {
    $xml->startElement('empleado');
    $xml->writeElement('puesto', $row['puesto']);
    $xml->writeElement('sueldo', $row['sueldo']);
    $xml->writeElement('nombre', $row['nombre']);
    $xml->writeElement('apellidoPaterno', $row['apellidoPaterno']);
    $xml->writeElement('apellidoMaterno', $row['nombre']);;
    $xml->writeElement('telefono', $row['idEmpleado']);
    $xml->endElement(); 
}
$xml->endElement();
$xml->endDocument();
$xml->flush();

$conn->close();

header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename="empleado.xml"');
header('Content-Length: ' . filesize('empleado.xml'));

readfile('consulta.xml');
exit();
?>