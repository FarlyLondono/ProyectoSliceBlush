<?php
require('../fpdf181/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{

    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Reporte De Compras',1,0,'C');
    // Salto de línea
    $this->Ln(20);


    $this->Cell(90, 10, 'proveedor', 1, 0, 'C', 0);
    $this->Cell(55, 10, 'numerofactura', 1, 0, 'C', 0);
    $this->Cell(55, 10, 'fechacompra', 1, 1, 'C', 0);


}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Pagina ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'cn.php';
$consulta = "SELECT * FROM compras";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->aliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(90, 10, $row['proveedor'], 1, 0, 'C', 0);
    $pdf->Cell(55, 10, $row['numerofactura'], 1, 0, 'C', 0);
    $pdf->Cell(55, 10, $row['fechacompra'], 1, 1, 'C', 0);
}


$pdf->Output();

?>