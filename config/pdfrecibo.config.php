<?php
$pdf->AddPage("P","A4",true,false);
//-------------------------- parte uno
//$pdf->SetXY(135,35);$pdf->Cell(0,0, $telefono, '', 0, '', false);

$pdf->SetXY(162,25);$pdf->Cell(0,0, $fecha, '', 0, '', false);

$pdf->SetXY(42,49);$pdf->Cell(0,0, $nombre, '', 0, '', false);
$pdf->SetXY(42,54);$pdf->Cell(0,0, $direccion, '', 0, '', false);
$pdf->SetXY(42,59);$pdf->Cell(0,0, $localidad, '', 0, '', false);

$pdf->SetXY(50,70);$pdf->Cell(0,0, $valorletra, '', 0, '', false);

$pdf->SetXY(65,78);$pdf->Cell(0,0, $planD, '', 0, '', false);

$pdf->SetXY(33,89);$pdf->Cell(0,0, $cuota, '', 0, '', false);
$pdf->SetXY(55,89);$pdf->Cell(0,0, $mes, '', 0, '', false);
$pdf->SetXY(118,89);$pdf->Cell(0,0, $sorteo, '', 0, '', false);
$pdf->SetXY(168,89);$pdf->Cell(0,0, $solicitud, '', 0, '', false);

$pdf->SetXY(40,99);$pdf->Cell(0,0, $vcuota, '', 0, '', false);

$pdf->SetXY(40,109);$pdf->Cell(0,0, $diaacuerdo, '', 0, '', false);

$pdf->SetXY(33,125);$pdf->Cell(0,0, $avisodebe, '', 0, '', false);

//-------------------------- BANCO
$pdf->SetXY(123,117);$pdf->Cell(0,0, "", '', 0, '', false);
$pdf->SetXY(123,121);$pdf->Cell(0,0, "", '', 0, '', false);
$pdf->SetXY(123,125);$pdf->Cell(0,0, "", '', 0, '', false);

//-------------------------- parte dos
$pdf->SetXY(162,213);$pdf->Cell(0,0, $fecha, '', 0, '', false);

$pdf->SetXY(42,233);$pdf->Cell(0,0, $nombre, '', 0, '', false);
$pdf->SetXY(42,238);$pdf->Cell(0,0, $direccion, '', 0, '', false);
$pdf->SetXY(42,243);$pdf->Cell(0,0, $localidad, '', 0, '', false);

$pdf->SetXY(65,253);$pdf->Cell(0,0, $planD, '', 0, '', false);

$pdf->SetXY(80,262);$pdf->Cell(0,0, $cuota, '', 0, '', false);
$pdf->SetXY(125,262);$pdf->Cell(0,0, $mes, '', 0, '', false);

$pdf->SetXY(80,269);$pdf->Cell(0,0, $sorteo, '', 0, '', false);
$pdf->SetXY(130,269);$pdf->Cell(0,0, $solicitud, '', 0, '', false);
$pdf->SetXY(172,270);$pdf->Cell(0,0, $vcuota, '', 0, '', false);
/*
//$pdf->SetXY(135,110);$pdf->Cell(0,0, $telefono, '', 0, '', false);

*/

/*
Banco Macro S.A.
Cuenta NRO.: 3-332-0941200768-1
CBU: 2850332330094120076811

*/
/*/-------------------------- parte tres
$pdf->SetXY(162, 296);$pdf->Cell(0,0, $fecha, '', 0, '', false);
$pdf->SetXY(80,323);$pdf->Cell(0,0, $planC, '', 0, '', false);
$pdf->SetXY(140,323);$pdf->Cell(0,0, $mespago, '', 0, '', false);
$pdf->SetXY(80, 331);$pdf->Cell(0,0, $sorteo, '', 0, '', false);
$pdf->SetXY(130,331);$pdf->Cell(0,0, $solicitud, '', 0, '', false);
$pdf->SetXY(174,331);$pdf->Cell(0,0, $vcuota, '', 0, '', false);
*/
?>
