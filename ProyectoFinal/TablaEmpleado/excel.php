<?php
require ("../config.inc.php");
require('../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


$consulta ="SELECT * FROM empleado";

$statement = $conexion->query($consulta);
$datos = $statement->fetchAll(PDO::FETCH_ASSOC);

$excel = new Spreadsheet();
$hojaActiva =  $excel->getActiveSheet();
$hojaActiva->setTitle("LibroEmpleado");

$hojaActiva->setCellValue('A1', 'Puesto');
$hojaActiva->setCellValue('B1', 'Sueldo');
$hojaActiva->setCellValue('C1', 'Nombre');
$hojaActiva->setCellValue('D1', 'Apellido Paterno');
$hojaActiva->setCellValue('E1', 'Apellido Materno');
$hojaActiva->setCellValue('F1', 'Telefono');
$Fila = 2;

foreach ($datos as $row) {
    $hojaActiva->getColumnDimension('A')->setWidth(20);
    $hojaActiva->setCellValue('A'.$Fila, $row['puesto']);
    $hojaActiva->getColumnDimension('B')->setWidth(20);
    $hojaActiva->setCellValue('B'.$Fila, $row['sueldo']);
    $hojaActiva->getColumnDimension('C')->setWidth(20);
    $hojaActiva->setCellValue('C'.$Fila, $row['nombre']);
    $hojaActiva->getColumnDimension('D')->setWidth(20);
    $hojaActiva->setCellValue('D'.$Fila, $row['apellidop']);
    $hojaActiva->getColumnDimension('E')->setWidth(20);
    $hojaActiva->setCellValue('E'.$Fila, $row['apellidom']);
    $hojaActiva->getColumnDimension('F')->setWidth(20);
    $hojaActiva->setCellValue('F'.$Fila, $row['telefono']);
    $hojaActiva->getColumnDimension('G')->setWidth(20);;
    $Fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="LibroEmpleado.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;
?>