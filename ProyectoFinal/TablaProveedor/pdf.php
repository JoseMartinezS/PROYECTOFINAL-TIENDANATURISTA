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
        $this->Cell(70,10,'Reporte de proveedor',0,0,'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(25,10,'Nombre',1,0,'C',0);
        $this->Cell(40,10,'Apellido Paterno',1,0,'C',0);
        $this->Cell(40,10,'Apellido Materno',1,0,'C',0);
        $this->Cell(20,10,'Telefono',1,0,'C',0);
        $this->Cell(40,10,'Cantidad de Compra',1,0,'C',0);
        $this->Cell(25,10,'Representante',1,1,'C',0);
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
$consulta = "SELECT proveedor.*, compra.cantidad AS cantidad_compra, representante.nombre AS nombre_proveedor
FROM proveedor
JOIN compra ON proveedor.idCompra = compra.idCompra
JOIN representante ON proveedor.idRepresentante = representante.idRepresentante";
$datos = $conn->query($consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);

while ($row = $datos->fetch_assoc()) {
    $pdf->Cell(25,10,$row['nombre'],1,0,'C',0);
    $pdf->Cell(40,10,$row['apellidoPaterno'],1,0,'C',0);
    $pdf->Cell(40,10,$row['apellidoMaterno'],1,0,'C',0);
    $pdf->Cell(20,10,$row['telefono'],1,0,'C',0);
    $pdf->Cell(40,10,$row['cantidad_compra'],1,0,'C',0);
    $pdf->Cell(25,10,$row['nombre_proveedor'],1,1,'C',0);
} 

$pdf->Output('proveedor.pdf', 'I');
?>