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
        $this->Cell(70,10,'Reporte de ventas',0,0,'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(25,10,'Cantidad',1,0,'C',0);
        $this->Cell(25,10,'Fecha',1,0,'C',0);
        $this->Cell(25,10,'Metodo de Pago',1,0,'C',0);
        $this->Cell(25,10,'Descuento',1,1,'C',0);
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
$consulta = "SELECT * from venta";
$datos = $conn->query($consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);

while ($row = $datos->fetch_assoc()) {
    $pdf->Cell(25,10,$row['cantidad'],1,0,'C',0);
    $pdf->Cell(25,10,$row['fecha'],1,0,'C',0);
    $pdf->Cell(25,10,$row['tipoPago'],1,0,'C',0);
    $pdf->Cell(25,10,$row['descuento'],1,1,'C',0);
} 

$pdf->Output('ventas.pdf', 'I');
?>