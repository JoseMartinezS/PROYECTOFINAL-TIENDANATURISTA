<?php
require ("../config.inc.php");
require('../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


$consulta ="select * from venta";

$statement = $conexion->query($consulta);
$datos = $statement->fetchAll(PDO::FETCH_ASSOC);

$excel = new Spreadsheet();
$hojaActiva =  $excel->getActiveSheet();
$hojaActiva->setTitle("Libroventa");

$hojaActiva->setCellValue('A1', 'Cantidad');
$hojaActiva->setCellValue('B1', 'Fecha');
$hojaActiva->setCellValue('C1', 'Metodo de Pago');
$hojaActiva->setCellValue('D1', 'Descuento');
$Fila = 2;

foreach ($datos as $row) {
    $hojaActiva->getColumnDimension('A')->setWidth(20);
    $hojaActiva->setCellValue('A'.$Fila, $row['cantidad']);
    $hojaActiva->getColumnDimension('B')->setWidth(20);
    $hojaActiva->setCellValue('B'.$Fila, $row['fecha']);
    $hojaActiva->getColumnDimension('C')->setWidth(20);
    $hojaActiva->setCellValue('C'.$Fila, $row['tipoPago']);
    $hojaActiva->getColumnDimension('D')->setWidth(20);
    $hojaActiva->setCellValue('D'.$Fila, $row['descuento']);
    $hojaActiva->getColumnDimension('E')->setWidth(20);
    $Fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Libroventa.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;
?>