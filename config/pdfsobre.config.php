<?php
$pdf->SetXY(20,60);$pdf->Cell(0,0, $nombre, '', 0, '', false);
$pdf->SetXY(20,70);$pdf->Cell(0,0, $direccion, '', 0, '', false);
$pdf->SetXY(20,80);$pdf->Cell(0,0, $localidad, '', 0, '', false);
$pdf->SetXY(20,90);$pdf->Cell(0,0, $provincia, '', 0, '', false);
?>