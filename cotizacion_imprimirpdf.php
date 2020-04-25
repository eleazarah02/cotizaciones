<?php
session_start();
$nombre_cliente;
if (!isset($_SESSION['nombre_cliente']) && !isset($_SESSION['descripcion_coche']) && !isset($_SESSION['fecha_actual'])) {
    header('Location: cotizacion_inicia.php');
} else {
    include 'inc/conexion.php';
    $sel = $con->prepare("SELECT cotizacion_detalle_temporal.cotizacion_detalle_temporal_id, refaccion.refaccion_nombre, (precio)+
(cotizacion_detalle_incremento_temporal) AS costo_pieza, cotizacion_detalle_temporal.cotizacion_detalle_numero_piezas_temporal,
cotizacion_detalle_temporal.cotizacion_detalle_mano_obra, (((precio)+
(cotizacion_detalle_incremento_temporal))*(cotizacion_detalle_numero_piezas_temporal))+(cotizacion_detalle_mano_obra) AS
costo_parcial
FROM (refaccion INNER JOIN refaccion_proveedor ON refaccion.refaccion_id = refaccion_proveedor.id_refaccion) INNER JOIN
cotizacion_detalle_temporal ON refaccion_proveedor.refaccion_proveedor_id =
cotizacion_detalle_temporal.refaccion_proveedor_id_temporal;
      ");
    $sel->execute();
    $res = $sel->get_result();
    $row = mysqli_num_rows($res);
}
$total = 0;

require('fpdf/fpdf.php');
/**
 * clase para PDF
 */
class PDF extends FPDF
{
	
	// Tabla simple
function BasicTable($header, $data)
{
    // Cabecera
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Datos
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

}



$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('img/logo-refacciones.png',150,8,60);
$pdf->SetFont('Arial','B',20);
$pdf->Cell(80);
$pdf->Cell(20,10,utf8_decode('Cotización'),0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(20,10,utf8_decode('Fecha de cotización: '.$_SESSION['fecha_actual']),0,1);
$pdf->Cell(20,10,utf8_decode('Nombre del cliente: '.$_SESSION['nombre_cliente']),0,1);
$pdf->Cell(20,10,utf8_decode('Descripción del coche: '.$_SESSION['descripcion_coche']),0,1);
$pdf->Ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(10,10,'No',1,0,'C');
$pdf->Cell(60,10,utf8_decode('Refacción'),1,0,'C');
$pdf->Cell(30,10,'Precio',1,0,'C');
$pdf->Cell(30,10,'No. de piezas',1,0,'C');
$pdf->Cell(30,10,'Mano de obra',1,0,'C');
$pdf->Cell(30,10,'Costo parcial',1,0,'C');
$pdf->Ln();
while ($f = $res->fetch_assoc()) {
$pdf->Cell(10,10,$f['cotizacion_detalle_temporal_id'],1,0,'C');
$pdf->Cell(60,10,$f['refaccion_nombre'],1,0,'C');
$pdf->Cell(30,10,$f['costo_pieza'],1,0,'C');
$pdf->Cell(30,10,$f['cotizacion_detalle_numero_piezas_temporal'],1,0,'C');
$pdf->Cell(30,10,number_format($f['cotizacion_detalle_mano_obra'],2),1,0,'C');
$pdf->Cell(30,10,number_format($f['costo_parcial'],2),1,0,'C');
$pdf->Ln();
 $total = $total + $f['costo_parcial'];
}
$pdf->SetFont('Arial','B',14);
$pdf->Cell(130);
$pdf->Cell(30,10,'Total: ',1,0,'C');
$pdf->Cell(30,10,number_format($total, 2),1,0,'C');
$pdf->Ln(40);
$pdf->SetFont('Arial','i',12);
$pdf->Cell(20,10,utf8_decode('La presente cotización no representa en forma alguna, reserva de inventario'),0,1);
$pdf->Cell(20,10,utf8_decode('Precios sujetos a cambio por el proveedor'),0,1);
$pdf->Output();
?>