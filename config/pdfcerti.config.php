<?php
//-------------------------- parte uno
// setXY(horizontal, vertical) en milimetros
$h=-1; //-
$v=-4; //+ //28 en papel a4 comun
// 1 - nombre
$pdf->SetXY($h+62,$v+103);$pdf->Cell(0,0, $nombre, '', 0, '', false);
// 2 - plan
$pdf->SetXY($h+145,$v+103);$pdf->Cell(0,0, $cantCuotas . ' Cuotas', '', 0, '', false);
// 3 - domicilio
$pdf->SetXY($h+45,$v+122);$pdf->Cell(0,0, $direccion, '', 0, '', false);
// 4 - vencimiento
$pdf->SetXY($h+157,$v+122);$pdf->Cell(0,0, $diavence, '', 0, '', false);
// 5 - Localidad
$pdf->SetXY($h+47,$v+140);$pdf->Cell(0,0, $localidad, '', 0, '', false);
// 6 - importe
$pdf->SetXY($h+148,$v+140);$pdf->Cell(0,0, $vcuota, '', 0, '', false);
// 7 - description
$pdf->SetXY($h+28,$v+165);$pdf->Cell(0,0, $planD, '', 0, '', false);
// 8 - dni
$pdf->SetXY($h+45,$v+175);$pdf->Cell(0,0, $dni, '', 0, '', false);
// 9 - nro solicitud
$pdf->SetXY($h+130,$v+158);$pdf->Cell(0,0, $solicitud, '', 0, '', false);
// 10 - sorteo
$pdf->SetXY($h+130,$v+165);$pdf->Cell(0,0, $sorteo, '', 0, '', false);

//-------------------------- parte dos
// 1 - nombre
$pdf->SetXY($h+40,$v+237);$pdf->Cell(0,0, $nombre, '', 0, '', false);
// 2 - domicilio
$pdf->SetXY($h+27,$v+247);$pdf->Cell(0,0, $direccion, '', 0, '', false);
// 3 - Localidad
$pdf->SetXY($h+28,$v+257);$pdf->Cell(0,0, $localidad, '', 0, '', false);
// 4 - description
$pdf->SetXY($h+31,$v+267);$pdf->Cell(0,0, $planD, '', 0, '', false);
// 5 - nro solicitud
$pdf->SetXY($h+160,$v+236);$pdf->Cell(0,0, $solicitud, '', 0, '', false);
// 6 - sorteo
$pdf->SetXY($h+160,$v+240);$pdf->Cell(0,0, $sorteo, '', 0, '', false);
// 7 - valor nominal
$pdf->SetXY($h+155,$v+248);$pdf->Cell(0,0, $vnominal, '', 0, '', false);
// 8 - DNI
$pdf->SetXY($h+108,$v+237);$pdf->Cell(0,0, $dni, '', 0, '', false);
// 9 - plan
$pdf->SetXY($h+110,$v+247);$pdf->Cell(0,0, $cantCuotas . ' Cuotas', '', 0, '', false);
// 10 - telefono
$pdf->SetXY($h+103,$v+257);$pdf->Cell(0,0, $telefono, '', 0, '', false);
// 11 - importe
$pdf->SetXY($h+110,$v+267);$pdf->Cell(0,0, $vcuota, '', 0, '', false);

