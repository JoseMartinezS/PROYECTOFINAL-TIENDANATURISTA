<?php
require('../PDF/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial','B',13);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(70,10,'Reporte de medicamento',0,0,'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(25,10,'Existencia',1,0,'C',0);
        $this->Cell(25,10,'Salida',1,0,'C',0);
        $this->Cell(25,10,'Fecha de Caducidad',1,0,'C',0);
        $this->Cell(25,10,'Laboratorio',1,0,'C',0);
        $this->Cell(25,10,'Cantidad de Venta',1,1,'C',0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
    }
}

require_once('../config.inc.php');

$conn = new mysqli($servername, $username, $password, $dbname);
$consulta = "SELECT medicamento.*, venta.cantidad AS cantidad_venta
FROM medicamento
JOIN venta ON medicamento.idVenta = venta.idVenta";
$datos = $conn->query($consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);

while ($row = $datos->fetch_assoc()) {
    $pdf->Cell(25,10,$row['existencia'],1,0,'C',0);
    $pdf->Cell(25,10,$row['salida'],1,0,'C',0);
    $pdf->Cell(25,10,$row['fechaCaducidad'],1,0,'C',0);
    $pdf->Cell(25,10,$row['laboratorio'],1,0,'C',0);
    $pdf->Cell(25,10,$row['cantidad_venta'],1,1,'C',0);
} 

$pdf->Output('medicamento.pdf', 'I');
?>