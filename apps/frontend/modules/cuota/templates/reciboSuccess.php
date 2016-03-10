<?php decorate_with(false);
$emision = Formatos::fecha($recibo->getFemision());
if ($emision=="") {$emision=date("d-m-Y");
 Doctrine_Query::create()
   ->update('cuota')
   ->set('Femision', '?', date("Y-m-d"))
   ->where("id = ?", $recibo->getId())
   ->execute();
}
$nombre = $recibo->getSuscripcion()->getSuscriptor()->getCodigo()." - ".
          $recibo->getSuscripcion()->getSuscriptor()->getApellido()." ".
          $recibo->getSuscripcion()->getSuscriptor()->getNombre();
$direccion = ucwords(strtolower($recibo->getSuscripcion()->getSuscriptor()->getDomicilio()));
$telefono =  "Tel: " . $recibo->getSuscripcion()->getSuscriptor()->getTel()." - ".
             $recibo->getSuscripcion()->getSuscriptor()->getCelular();
$localidad = $recibo->getSuscripcion()->getSuscriptor()->getLocalidad()->getCp()." ".
             $recibo->getSuscripcion()->getSuscriptor()->getLocalidad()->getNombre()." - ".
             $recibo->getSuscripcion()->getSuscriptor()->getLocalidad()->getProvincia()->getNombre();
$planC = $recibo->getSuscripcion()->getPlan()->getCodigo();
$planD = ucwords(strtolower($recibo->getSuscripcion()->getPlan()->getDescripcion()));
$cuotames = $recibo->getNroCuota();
$sorteo = $recibo->getSuscripcion()->getSorteo();
$solicitud = $recibo->getSuscripcion()->getNro();
$vcuota = Formatos::moneda($recibo->getImporte());
$vence = Formatos::fecha($recibo->getSuscripcion()->getDiaPago());
$localidad = "CP ".ucwords(strtolower($localidad));
$nombre = ucwords(strtolower($nombre));

//$vencidas =  Doctrine::getTable('cuota')->verVencidas($id);

$respuesta = Doctrine_Query::create()
       ->select("nro_cuota")
       ->from("cuota")
       ->where('suscripcion_id =?', $recibo->getSuscripcionId())
       ->andWhere('fpago is null')
       ->andWhere('fvencimiento <?',date('Y-m-d'))
       ->execute();
$vencidas = "";
foreach ($respuesta as $cvencida) {
$vencidas = $vencidas . $cvencida->getNroCuota() . " ";
}

Doctrine_Query::create()
 ->update('cuota')
 ->set('impresa', '?', true)
 ->where("id = ?", $recibo->getId())
 ->execute();

$valor = str_replace(",","",number_format($recibo->getImporte(),2,'|',','));
$zcosto = substr($valor,0,-3);
$cent = substr($valor,-2);
//<div class="salto"></div>
?>

<div class="fecha1"><?php echo $emision; ?></div>
<div class="nombre1"><?php echo $nombre; ?></div>
<div class="direccion1"><?php echo $direccion; ?></div>
<div class="telefono1"><?php echo $telefono; ?></div>
<div class="localidad1"><?php echo $localidad; ?></div>
<div class="valorletra1"><?php echo strtolower(NumLet::convertir($zcosto))." con $cent"; ?>/100</div>
<div class="plan1"><?php echo "$planC - $planD"; ?></div>
<div class="cuotames1"><?php echo $cuotames; ?></div>
<div class="sorteo1"><?php echo $sorteo; ?></div>
<div class="solicitud1"><?php echo $solicitud; ?></div>
<div class="vcuota1"><?php echo $vcuota; ?></div>
<div class="diavence1"><?php echo $vence; ?></div>
<div class="avisodebe1"><?php echo $vencidas; ?></div>

<div class="fecha2"><?php echo $emision; ?></div>
<div class="nombre2"><?php echo $nombre; ?></div>
<div class="direccion2"><?php echo $direccion; ?></div>
<div class="telefono2"><?php echo $telefono; ?></div>
<div class="localidad2"><?php echo $localidad; ?></div>
<div class="plan2"><?php echo $planC; ?></div>
<div class="mespago"><?php echo $cuotames; ?></div>
<div class="sorteo2"><?php echo $sorteo; ?></div>
<div class="solicitud2"><?php echo $solicitud; ?></div>
<div class="vcuota2"><?php echo $vcuota; ?></div>

<div class="fecha3"><?php echo $emision; ?></div>
<div class="plan3"><?php echo $planC; ?></div>
<div class="mespago3"><?php echo $cuotames; ?></div>
<div class="sorteo3"><?php echo $sorteo; ?></div>
<div class="solicitud3"><?php echo $solicitud; ?></div>
<div class="vcuota3"><?php echo $vcuota; ?></div>

