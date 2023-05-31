<?php
require ("../config.inc.php");
require('../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


$consulta ="SELECT medicamento.*, venta.cantidad AS cantidad_venta
FROM medicamento
JOIN venta ON medicamento.idVenta = venta.idVenta";

$statement = $conexion->query($consulta);
$datos = $statement->fetchAll(PDO::FETCH_ASSOC);

$excel = new Spreadsheet();
$hojaActiva =  $excel->getActiveSheet();
$hojaActiva->setTitle("Libromedicamento");

$hojaActiva->setCellValue('A1', 'Existencia');
$hojaActiva->setCellValue('B1', 'Salida');
$hojaActiva->setCellValue('C1', 'Fecha de Caducidad');
$hojaActiva->setCellValue('D1', 'Laboratorio');
$hojaActiva->setCellValue('E1', 'Cantidad de Venta');
$Fila = 2;

foreach ($datos as $row) {
    $hojaActiva->getColumnDimension('A')->setWidth(20);
    $hojaActiva->setCellValue('A'.$Fila, $row['existencia']);
    $hojaActiva->getColumnDimension('B')->setWidth(20);
    $hojaActiva->setCellValue('B'.$Fila, $row['salida']);
    $hojaActiva->getColumnDimension('C')->setWidth(20);
    $hojaActiva->setCellValue('C'.$Fila, $row['fechaCaducidad']);
    $hojaActiva->getColumnDimension('D')->setWidth(20);
    $hojaActiva->setCellValue('D'.$Fila, $row['laboratorio']);
    $hojaActiva->getColumnDimension('E')->setWidth(20);
    $hojaActiva->setCellValue('E'.$Fila, $row['cantidad_venta']);
    $hojaActiva->getColumnDimension('F')->setWidth(20);
    $Fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Libromedicamento.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;
?>