<?php
require ("../config.inc.php");
require('../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


$consulta ="SELECT proveedor.*, compra.cantidad AS cantidad_compra, representante.nombre AS nombre_proveedor
FROM proveedor
JOIN compra ON proveedor.idCompra = compra.idCompra
JOIN representante ON proveedor.idRepresentante = representante.idRepresentante";

$statement = $conexion->query($consulta);
$datos = $statement->fetchAll(PDO::FETCH_ASSOC);

$excel = new Spreadsheet();
$hojaActiva =  $excel->getActiveSheet();
$hojaActiva->setTitle("Libroproveedor");

$hojaActiva->setCellValue('A1', 'Nombre');
$hojaActiva->setCellValue('B1', 'Apellido Paterno');
$hojaActiva->setCellValue('C1', 'Apellido Materno');
$hojaActiva->setCellValue('D1', 'Telefono');
$hojaActiva->setCellValue('E1', 'Cantidad de compra');
$hojaActiva->setCellValue('F1', 'Nombre del representante');
$Fila = 2;

foreach ($datos as $row) {
    $hojaActiva->getColumnDimension('A')->setWidth(20);
    $hojaActiva->setCellValue('A'.$Fila, $row['nombre']);
    $hojaActiva->getColumnDimension('B')->setWidth(20);
    $hojaActiva->setCellValue('B'.$Fila, $row['apellidoPaterno']);
    $hojaActiva->getColumnDimension('C')->setWidth(20);
    $hojaActiva->setCellValue('C'.$Fila, $row['apellidoMaterno']);
    $hojaActiva->getColumnDimension('D')->setWidth(20);
    $hojaActiva->setCellValue('D'.$Fila, $row['telefono']);
    $hojaActiva->getColumnDimension('E')->setWidth(20);
    $hojaActiva->setCellValue('E'.$Fila, $row['cantidad_compra']);
    $hojaActiva->getColumnDimension('F')->setWidth(20);
    $hojaActiva->setCellValue('F'.$Fila, $row['nombre_proveedor']);
    $hojaActiva->getColumnDimension('G')->setWidth(20);;
    $Fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Libroproveedor.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;
?>