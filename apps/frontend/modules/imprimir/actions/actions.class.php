<?php

/**
 * imprimir actions.
 *
 * @package    universal
 * @subpackage imprimir
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class imprimirActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
/*  public function executeIndex(sfWebRequest $request)
  {
//    $this->forward('default', 'module');
  }
*/
  public function executeListadomes(sfWebRequest $request)
  {
  $this->mes = $request->getParameter('mes');
  $this->anio = $request->getParameter('anio');
  
  }
  public function executeSuscripciones(sfWebRequest $request)
  {
  $mes = $request->getParameter('mes');
  $anio = $request->getParameter('anio');
    $productores = Doctrine_Core::getTable('productor')
      ->createQuery('a')
      ->execute();
    foreach ($productores as $vendedor) {
    $nombre = $vendedor->getApellido()." ".$vendedor->getNombre();
    $p2 = '<tr><th align="center" width="100%">'.$nombre.'</th></tr>';
    $mes2=$mes+1;
    $suscripciones = Doctrine_Query::create()
      ->from('suscripcion')
      ->where('productor_id =?',$vendedor->getId())
      ->andWhere('fecha_alta >?',"2014-$mes-00")
      ->andWhere('fecha_alta <?',"2014-$mes2-01")
      ->andwhere('fecha_baja is null')->orderby('fecha_alta')
      ->execute();
      foreach ($suscripciones as $suscripcion) {
        $nro = $suscripcion->getNro();
        $fecha = Formatos::fecha($suscripcion->getFechaAlta());
        $suscriptor = $suscripcion->getSuscriptor();
        $plan = $suscripcion->getPlan();
        $vcuota = $suscripcion->getValor_cuota();
$fvcuota = Formatos::moneda($vcuota);
$tabla = <<<ETIQUETA
<tr>
<td align="left" width="10%">$fecha</td>
<td align="center" width="5%">$nro</td>
<td align="left" width="35%">$suscriptor</td>
<td align="left" width="35%">$plan</td>
<td align="right" width="15%">$fvcuota</td>
</tr>
ETIQUETA;
$q=$q.$tabla;
$total = $total + $vcuota;
      }
      $listaSus = $listaSus.$p2.$q.'<tr><td align="right" colspan="5">Total: '.
      Formatos::moneda($total).'</td></tr>';
      $q='';$total=0;
    }
$estilo = <<<ETIQUETA
<style>
.lista {font-size:3mm;width:95%}
.lista td {border-bottom-style:dotted;
border-color:#c2c2c2}
.lista th {background-color:#dbdbdb}
</style>
ETIQUETA;
$tabla = $estilo.'Lista de Suscripciones Activas del mes '.$mes.'/2014<br>'.
'<table class="lista">'.$listaSus.'</table>';
//$this->getResponse()->setContent("sobres: ". count($sobres));
//   return sfView::NONE;    
$pdf = new TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('times','',10);
//--------- DERECHA, SUPERIOR 
$pdf->SetMargins(15, 30, 0);
$pdf->AddPage("P","LEGAL",true,false);
$pdf->writeHTML($tabla, true, false, true, false, '');

  //genero el archivo 
//$nombre = str_replace(" ","-",$apellido.'-'.$nombre);
  $pdf->Output('listado-'.$mes. '.pdf', 'D');
return; 


  }

    public function executeDatoscliente(sfWebRequest $request)
  {
    $suscriptor = Doctrine_Core::getTable('suscriptor')->find(array($request->getParameter('id')));
      $apellido = $suscriptor->getApellido();
      $nombre = $suscriptor->getNombre();
      $dni = Formatos::dni($suscriptor->getDni());
      $cp = $suscriptor->getLocalidad()->getCp();
      $provincia = $suscriptor->getLocalidad()->getProvincia()->getNombre();
      $localidad = $suscriptor->getLocalidad()->getNombre();
      $domicilio = $suscriptor->getDomicilio();
      $tel = $suscriptor->getTel();
      $celular = $suscriptor->getCelular();
      $conyuge = $suscriptor->getConyuge();
    $tabla = <<<ETIQUETA
<style>
.suscriptor td {border:hidden}
.suscriptor {font-size:3mm;
border-collapse:collapse;}

</style>
<table class="suscriptor" cellspacing="0">
 <tr>
  <td width="100%" align="center"><b>Datos del Suscriptor</b></td>
 </tr>
 <tr>
  
  <td width="20%">Apellido y Nombre:</td>
  <td width="55%">{$apellido}, {$nombre}</td>
 </tr>
 <tr>
  
  <td width="20%">DNI:</td>
  <td width="55%">{$dni}</td>
 </tr>
 <tr>
  
  <td width="20%">Localidad:</td>
  <td width="55%">{$localidad} - CP {$cp} - {$provincia}</td>
 </tr>
 <tr>
  
  <td width="20%">Domicilio:</td>
  <td width="55%">{$domicilio}</td>
 </tr>
 <tr>
  
  <td width="20%">Teléfono:</td>
  <td width="55%">{$tel}</td>
 </tr>
 <tr>
  
  <td width="20%">Celular:</td>
  <td width="55%">{$celular}</td>
 </tr>
 <tr>
  
  <td width="20%">Cónyuge:</td>
  <td width="55%">{$conyuge}</td>
 </tr>
</table>
ETIQUETA;
$pdf = new TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('times','',10);
//--------- DERECHA, SUPERIOR 
$pdf->SetMargins(20, 30, 0);
$pdf->AddPage("P","LEGAL",true,false);
  $pdf->writeHTML($tabla, true, false, true, false, '');

  //genero el archivo 
$nombre = str_replace(" ","-",$apellido.'-'.$nombre);
  $pdf->Output('datos-'.$nombre. '.pdf', 'D');
return; 
  }
  public function executeRecibos(sfWebRequest $request)
  {
$pdf = new TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('times','',10);
$pdf->SetMargins(0, 0, 0);


$mes= $request->getParameter('mes');
if($mes==''){$mes=date('m');}

$anio= $request->getParameter('anio');
if($anio==''){$anio=date('Y');}

$dia= $request->getParameter('dia');
if($dia==''){$dia=date('d');}

$pmes= $request->getParameter('pmes');
if($pmes==''){$mes=date('m');}

$panio= $request->getParameter('panio');
if($anio==''){$anio=date('Y');}

  $recibos =  Doctrine::getTable('cuota')->imprimirLiquidacion($mes,$anio);
/*$frecibo = array(
    'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 380),
);*/

$emision = $dia.'-'.$pmes.'-'.$panio;

foreach ($recibos as $recibo):

$recibo->setFemision($anio.'-'.$pmes.'-'.$dia);
$recibo->save();
//$emision = '03-11-2014';//Formatos::fecha($recibo->getFemision());
//if ($emision=="") {$emision=date("d-m-Y");}
/*if ($emision=="") {$emision=date("d-m-Y");
 Doctrine_Query::create()
   ->update('cuota')
   ->set('Femision', '?', date("Y-m-d"))
   ->where("id = ?", $recibo->getId())
   ->execute();
}*/
$nombre = $recibo->getSuscripcion()->getSuscriptor()->getApellido().' '.
          $recibo->getSuscripcion()->getSuscriptor()->getNombre();
$direccion = ucwords(strtolower(rtrim($recibo->getSuscripcion()->getSuscriptor()->getDomicilio())));
$telefono =  "Tel: " . $recibo->getSuscripcion()->getSuscriptor()->getTel();
$localidad = $recibo->getSuscripcion()->getSuscriptor()->getLocalidad()->getCp()." ".
             rtrim($recibo->getSuscripcion()->getSuscriptor()->getLocalidad()->getNombre())." - ".
             $recibo->getSuscripcion()->getSuscriptor()->getLocalidad()->getProvincia()->getNombre();
$planC = $recibo->getSuscripcion()->getCodigo();
$planD = ucwords(strtolower($recibo->getSuscripcion()->getPlan()));
$cuota = $recibo->getNroCuota();
$mes = Formatos::periodo($recibo->getFvencimiento());
$sorteo = $recibo->getSuscripcion()->getSorteo();
$solicitud = $recibo->getSuscripcion()->getNro();
$vcuota = Formatos::moneda($recibo->getImporte());
$diaacuerdo = Formatos::fecha($recibo->getSuscripcion()->getFechaAlta());
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
/*
Doctrine_Query::create()
 ->update('cuota')
 ->set('impresa', '?', true)
 ->where("id = ?", $recibo->getId())
 ->execute();
*/
$valor = str_replace(",","",number_format($recibo->getImporte(),2,'|',','));
$zcosto = substr($valor,0,-3);
$cent = substr($valor,-2);
$fecha = $emision;
$valorletra = strtolower(NumLet::convertir($zcosto))." con $cent/100";
$mespago = $cuotames;
$avisodebe = $vencidas;

include('../config/pdfrecibo.config.php');

endforeach;

$pdf->Output("recibos-periodo-$mes-$anio.pdf", 'D');
}
//============================= SOBRES EN CADENA =====================
  public function executeSobres(sfWebRequest $request){

      $mes = $request->getParameter('mes');
      $anio = $request->getParameter('anio');
      $sobres =  Doctrine::getTable('cuota')->verSobres($mes,$anio);


$pdf = new TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
//$pdf->SetFont('times','',12);
$pdf->SetFont('dejavuserif','',12);
$pdf->setFontSpacing(0.204);
$pdf->SetMargins(0, 0, 0);
$fsobre = array(
    'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 120, 'ury' => 235),
);
foreach ($sobres as $sobre):

$nombre = Formatos::textoCool($sobre->getNombre());
$direccion = Formatos::textoCool($sobre->getDomicilio());
$localidad = 'CP '.Formatos::textoCool($sobre->getLocalidad());
$provincia = Formatos::textoCool($sobre->getProvincia());

$pdf->AddPage("L",$fsobre,true,false);

include('../config/pdfsobre.config.php');

endforeach;
$pdf->Output("sobres-periodo-$mes-$anio.pdf", 'D');

//   $this->getResponse()->setContent("sobres: ". count($sobres));
//    return sfView::NONE;
}

//============================= SOBRE DE A UNO ======================
  public function executeSobre(sfWebRequest $request){
//      $mes = $request->getParameter('mes');
//      $anio = $request->getParameter('anio');
//      $recibos =  Doctrine::getTable('cuota')->verLiquidacion($mes,$anio);
 $sobre = Doctrine_Core::getTable('suscriptor')->find($request->getParameter('id'));
//if (count($recibos)==0){return 'no hay cuotas';}

//  $recibo = Doctrine_Core::getTable('cuota')->find($id);
$pdf = new TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
//$pdf->SetFont('times','',12);
$pdf->SetFont('dejavuserif','',12);

$pdf->setFontSpacing(0.204);
$pdf->SetMargins(0, 0, 0);

//foreach ($recibos as $recibo):
$fsobre = array(
    'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 120, 'ury' => 235),
);

$pdf->AddPage("L",$fsobre,true,false);

$nombre = $sobre->getApellido()." ".$sobre->getNombre();
$direccion = $sobre->getDomicilio();
$localidad = "(".$sobre->getLocalidad()->getCp().") ".
             $sobre->getLocalidad()->getNombre();
$provincia = $sobre->getLocalidad()->getProvincia()->getNombre();

$nombre = ucwords(strtolower($nombre));
$direccion = ucwords(strtolower($direccion));
$localidad = "CP ".ucwords(strtolower($localidad));
$provincia = ucwords(strtolower($provincia));

include('../config/pdfsobre.config.php');

$file = str_replace(' ','_',$nombre);

$pdf->Output("sobre-$file.pdf", 'D');

//   $this->getResponse()->setContent("sobres");
//    return sfView::NONE;
}
//======================== RECIBO DE A UNO ========================
  public function executeRecibo(sfWebRequest $request)
  {
$pdf = new TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('times','',10);
$pdf->SetMargins(0, 0, 0);
  $recibo = Doctrine_Core::getTable('cuota')->find($request->getParameter('id'));
/*$frecibo = array(
    'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 380),
);*/
$dia = $request->getParameter('dia');
if ($dia=='') {$dia=date('d'); }

$mes= $request->getParameter('mes');
if ($mes=='') { $mes=date('m'); }

$anio= $request->getParameter('anio');
if($anio=='') { $anio=date('Y'); }

$emision = $dia.'-'.$mes.'-'.$anio;//Formatos::fecha($recibo->getFemision());
$recibo->setFemision($anio.'-'.$mes.'-'.$dia);
$recibo->save();

$nombre = $recibo->getSuscripcion()->getSuscriptor()->getApellido().' '.
          $recibo->getSuscripcion()->getSuscriptor()->getNombre();
$direccion = ucwords(strtolower(rtrim($recibo->getSuscripcion()->getSuscriptor()->getDomicilio())));
$telefono =  "Tel: " . $recibo->getSuscripcion()->getSuscriptor()->getTel();
$localidad = $recibo->getSuscripcion()->getSuscriptor()->getLocalidad()->getCp()." ".
             rtrim($recibo->getSuscripcion()->getSuscriptor()->getLocalidad()->getNombre())." - ".
             $recibo->getSuscripcion()->getSuscriptor()->getLocalidad()->getProvincia()->getNombre();
$planC = $recibo->getSuscripcion()->getCodigo();
$planD = ucwords(strtolower($recibo->getSuscripcion()->getPlan()));
$cuota = $recibo->getNroCuota();
$mes = Formatos::periodo($recibo->getFvencimiento());
$sorteo = $recibo->getSuscripcion()->getSorteo();
$solicitud = $recibo->getSuscripcion()->getNro();
$vcuota = Formatos::moneda($recibo->getImporte());
$diaacuerdo = Formatos::fecha($recibo->getSuscripcion()->getFechaAlta());
$localidad = "CP ".ucwords(strtolower($localidad));
$nombre = ucwords(strtolower($nombre));

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

/*Doctrine_Query::create()
 ->update('cuota')
 ->set('impresa', '?', true)
 ->where("id = ?", $recibo->getId())
 ->execute();
*/
$valor = str_replace(",","",number_format($recibo->getImporte(),2,'|',','));
$zcosto = substr($valor,0,-3);
$cent = substr($valor,-2);
$fecha = $emision;
$valorletra = strtolower(NumLet::convertir($zcosto))." con $cent/100";
$mespago = $cuotames;
$avisodebe = $vencidas;

include('../config/pdfrecibo.config.php');

$nombre = $recibo->getSuscripcion()->getSuscriptor()->getApellido().', '.
          $recibo->getSuscripcion()->getSuscriptor()->getNombre();

$file = str_replace(' ','_',$nombre)."-cuota-$cuotames";
$pdf->Output("recibo-$file.pdf", 'D');
//return sfView::NONE;
}
//------------------------ Marcar Impresa / sin imrimir de a uno
public function executeImpresa(sfWebRequest $request)
  {
  $recibo = Doctrine_Core::getTable('cuota')->find($request->getParameter('id'));
  $recibo->setImpresa(true);
  $recibo->save();
  return sfView::NONE;
}
public function executeSinimprimir(sfWebRequest $request)
  {
  $recibo = Doctrine_Core::getTable('cuota')->find($request->getParameter('id'));
  $recibo->setImpresa(False);
  $recibo->save();
  return sfView::NONE;
}
//-------------------------- Borrar fecha emision
public function executeBorraremision(sfWebRequest $request)
  {
  $recibo = Doctrine_Core::getTable('cuota')->find($request->getParameter('id'));
  $recibo->setFemision(NULL);
  $recibo->save();
  return sfView::NONE;
}

//======================== Marcar todo como impresos
  public function executeImpresos(sfWebRequest $request)
  {
      $mes = $request->getParameter('mes');
      $anio = $request->getParameter('anio');
      $recibos =  Doctrine::getTable('cuota')->imprimirLiquidacion($mes,$anio);
 foreach ($recibos as $recibo):
if ($recibo->getFemision()=="") {
$recibo->setFemision(date('Y-m-d'));
}

  $recibo->setImpresa(true);
  $recibo->save();
 endforeach;
//   $this->getResponse()->setContent("sobres: ". count($sobres));
    return sfView::NONE;
 }

//========================= LIQUIDAR CUOTAS DE UNA SUSCRIPCION
  public function executeLiquidarcuotas(sfWebRequest $request)
  {
	$id=$request->getParameter('id');
	$desde=$request->getParameter('desde');
	$hasta=$request->getParameter('hasta');
	$femision=$request->getParameter('femision');
//	$fpago=$request->getParameter('fpago');
//	$impresa=$request->getParameter('impresa');

  $femision=substr($femision,6,4).'-'.substr($femision,3,2).'-'.substr($femision,0,2);
//echo "$id, $desde,$hasta, $femision";die();
  $recibos =  Doctrine_Query::create()
        ->from("cuota")
        ->where('suscripcion_id =?', $id)
        ->andWhere('fpago is null')
        ->andWhere('impresa = 0')
        ->andWhere("nro_cuota >= ?", $desde)
        ->andWhere("nro_cuota <= ?", $hasta)
        ->execute();
/* Doctrine_Query::create()
   ->update('cuota')
   ->set('femision', '?', "$femision")
   ->set('fpago', '?', "$fpago")
   ->set('impresa', '?', "$impresa")
   ->where("suscripcion_id = ?", $id)
   ->andWhere("nro_cuota >= ?", $desde)
   ->andWhere("nro_cuota <= ?", $hasta)
   ->execute();
*/
$pdf = new TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('times','',10);
$pdf->SetMargins(0, 0, 0);
/*$frecibo = array(
    'MediaBox' => array ('llx' => 0, 'lly' => 0, 'urx' => 215, 'ury' => 380),
);*/

foreach ($recibos as $recibo):

$em = Formatos::fecha($recibo->getFemision());
if ($em=="") {$emision=$femision;} else {$emision=$em;}

$nombre = $recibo->getSuscripcion()->getSuscriptor()->getApellido().' '.
          $recibo->getSuscripcion()->getSuscriptor()->getNombre();
$direccion = ucwords(strtolower(rtrim($recibo->getSuscripcion()->getSuscriptor()->getDomicilio())));
$telefono =  "Tel: " . $recibo->getSuscripcion()->getSuscriptor()->getTel();
$localidad = $recibo->getSuscripcion()->getSuscriptor()->getLocalidad()->getCp()." ".
             rtrim($recibo->getSuscripcion()->getSuscriptor()->getLocalidad()->getNombre())." - ".
             $recibo->getSuscripcion()->getSuscriptor()->getLocalidad()->getProvincia()->getNombre();
$planC = $recibo->getSuscripcion()->getCodigo();
$planD = ucwords(strtolower($recibo->getSuscripcion()->getPlan()));
$cuota = $recibo->getNroCuota();
$mes = Formatos::periodo($recibo->getFvencimiento());
$sorteo = $recibo->getSuscripcion()->getSorteo();
$solicitud = $recibo->getSuscripcion()->getNro();
$vcuota = Formatos::moneda($recibo->getImporte());
$diaacuerdo = Formatos::fecha($recibo->getSuscripcion()->getFechaAlta());
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
/*
Doctrine_Query::create()
 ->update('cuota')
 ->set('impresa', '?', true)
 ->where("id = ?", $recibo->getId())
 ->execute();
*/
$valor = str_replace(",","",number_format($recibo->getImporte(),2,'|',','));
$zcosto = substr($valor,0,-3);
$cent = substr($valor,-2);
$fecha = $emision;
$valorletra = strtolower(NumLet::convertir($zcosto))." con $cent/100";
$mespago = $cuotames;
$avisodebe = $vencidas;

include('../config/pdfrecibo.config.php');

endforeach;

$pdf->Output("recibos-$solicitud-desde-$desde-$hasta.pdf", 'D');
}
//---------------------- BACKUP
public function executeResguardo(sfWebRequest $request){
//$run = file_get_contents('/home/roberto/universal/resguardo/php-bajar-todo.txt');
//system($run);

$path = '/home/roberto/universal/resguardo/';
$enlace = $path.'hoy.zip';

header ("Content-Disposition: attachment; filename=universal-".date('d-m-Y').".zip "); 
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);

//$salida = shell_exec('/bin/sh /home/roberto/universal/resguardo/bajar-todo.sh');

    return sfView::NONE;

}

public function executeGenerarzip(sfWebRequest $request){
$run = file_get_contents('/home/roberto/universal/resguardo/php-bajar-todo.txt');
echo system($run);
return sfView::NONE;

}

}