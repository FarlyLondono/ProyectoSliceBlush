<?php
require('../fpdf181/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{

    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Reporte De pedidos',1,0,'C');
    // Salto de línea
    $this->Ln(20);


    $this->Cell(30, 10, 'idPedido', 1, 0, 'C', 0);
    $this->Cell(38, 10, 'EstadoPedido', 1, 0, 'C', 0);
    $this->Cell(38, 10, 'Cliente', 1, 0, 'C', 0);
    $this->Cell(52, 10, 'Fecha', 1, 0, 'C', 0);
    $this->Cell(38, 10, 'TotalPedido', 1, 1, 'C', 0);



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
//$consulta = "SELECT * FROM pedido";
$consulta = "SELECT f.IdEstadoPedido,f.IdCliente,f.idPedido,f.fechaRegistro,e.IdEstadoPedido,e.NombreEstadoPedido,r.idCliente,r.Nombre,
        sum(p.precio) as TotalPedido 
        FROM pedido AS f INNER JOIN estadopedido AS e ON f.IdEstadoPedido=e.IdEstadoPedido
        INNER JOIN clientes AS r ON f.idCliente=r.idCliente INNER JOIN detallepedidos AS p ON f.idPedido=p.idPedido
        GROUP BY p.idPedido ORDER BY f.fechaRegistro DESC";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->aliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',15);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(30, 10, $row['idPedido'], 1, 0, 'C', 0);
    $pdf->Cell(38, 10, $row['NombreEstadoPedido'], 1, 0, 'C', 0);
    $pdf->Cell(38, 10, $row['Nombre'], 1, 0, 'C', 0);
    $pdf->Cell(52, 10, $row['fechaRegistro'], 1, 0, 'C', 0);
    $pdf->Cell(38, 10, $row['TotalPedido'], 1, 1, 'C', 0);

}


$pdf->Output();

?>
