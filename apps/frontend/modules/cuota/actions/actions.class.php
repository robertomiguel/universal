<?php

/**
 * cuota actions.
 *
 * @package    universal
 * @subpackage cuota
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cuotaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
//    $this->cuotas = Doctrine_Core::getTable('cuota')
//      ->createQuery('a')
//      ->execute();
    $this->total=0;
    $this->rid = $request->getParameter('id');
    $this->totalcuotas =  Doctrine::getTable('cuota')->getTotalcuotas($request->getParameter('id'));
    $this->pagadas =  Doctrine::getTable('cuota')->getPagadas($request->getParameter('id'));
    $this->impagadas =  $this->totalcuotas - $this->pagadas;
    $this->vencidas =  Doctrine::getTable('cuota')->getVencidas($request->getParameter('id'));
  if ($request->getParameter('ver')=="impagas") {
    $this->listado = 'Sin Pagar';
    $this->respuesta =  Doctrine::getTable('cuota')->verImpagas($request->getParameter('id'));return;}
  if ($request->getParameter('ver')=="vencidas") {
    $this->listado = 'Vencidas';
    $this->respuesta =  Doctrine::getTable('cuota')->verVencidas($request->getParameter('id'));return;}
  if ($request->getParameter('ver')=="pagadas") {
    $this->listado = 'Pagadas';
    $this->respuesta =  Doctrine::getTable('cuota')->verPagadas($request->getParameter('id'));return;}

    $this->listado = 'Completo';
    $this->respuesta =  Doctrine::getTable('cuota')->verCuotas($request->getParameter('id'));
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->cuota = Doctrine_Core::getTable('cuota')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->cuota);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new cuotaForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new cuotaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($cuota = Doctrine_Core::getTable('cuota')->find(array($request->getParameter('id'))), sprintf('Object cuota does not exist (%s).', $request->getParameter('id')));
    $this->form = new cuotaForm($cuota);
    $this->anterior = $request->getReferer();
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($cuota = Doctrine_Core::getTable('cuota')->find(array($request->getParameter('id'))), sprintf('Object cuota does not exist (%s).', $request->getParameter('id')));
    $this->form = new cuotaForm($cuota);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($cuota = Doctrine_Core::getTable('cuota')->find(array($request->getParameter('id'))), sprintf('Object cuota does not exist (%s).', $request->getParameter('id')));
    $cuota->delete();

//    $this->redirect('cuota/index');
      $this->redirect('cuota/index?id='.$cuota->getSuscripcionId());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $cuota = $form->save();

//      $this->redirect('cuota/index?id='.$cuota->getId());
//      $this->redirect('cuota/index?id='.$cuota->getSuscripcionId());
if ($request->getParameter('volver')<>null){
$this->redirect($request->getParameter('volver'));}
else {$this->redirect('cuota/index?id='.$cuota->getSuscripcionId());}
//$this->redirect($request->ge11tReferer()); 
//      $this->redirect('cuota/index?id='.$request->getParameter('id'));
    }
  }
  public function executeMorosos(sfWebRequest $request)
 {
    $this->total = 0;
    $this->totalcuotas = 0;
    if ($request->getParameter("listado")=='periodo') {
       $this->todos = '';
       $this->periodo = 'checked';
       $this->listado='periodo';
       $this->mesSel = $request->getParameter("mes");
       $this->anioSel = $request->getParameter("anio");
       $this->respuesta =  Doctrine::getTable('cuota')->verMorososfecha($request->getParameter("mes"),$request->getParameter("anio"));
       return;
    }
    $this->todos = 'checked';
    $this->periodo = '';
    $this->listado='todos';
    $this->mesSel = date('m');
    $this->oculto = 'hidden';
    $this->anioSel = date('Y');
    $this->respuesta =  Doctrine::getTable('cuota')->verMorosos();

 }
  public function executeConsultas(sfWebRequest $request)
  {
    $listado = $request->getParameter("listado");
    $this->total=0;
    switch($listado){
      case 'pagadas':
       $this->listado = "Pagadas";
       $this->lista = "pagadas";
       $this->mesSel = $request->getParameter("mes");
       $this->anioSel = $request->getParameter("anio");
   $this->respuesta =  Doctrine::getTable('cuota')->verPeriodoPagadas($request->getParameter("mes"),$request->getParameter("anio"));
      break;
      case 'sinpagar':
       $this->listado = "Sin Pagar";
       $this->lista = "sinpagar";
       $this->mesSel = $request->getParameter("mes");
       $this->anioSel = $request->getParameter("anio");
    $this->respuesta =  Doctrine::getTable('cuota')->verPeriodoSinpagar($request->getParameter("mes"),$request->getParameter("anio"));
      break;
      case 'completo':
       $this->listado = "Completo";
       $this->lista = "completo";
       $this->mesSel = $request->getParameter("mes");
       $this->anioSel = $request->getParameter("anio");
    $this->respuesta =  Doctrine::getTable('cuota')->verPeriodoCompleto($request->getParameter("mes"),$request->getParameter("anio"));
      break;
      default:
       $this->listado = "Completo";
       $this->lista = "completo";
    $this->mesSel = date('m');
    $this->anioSel = date('Y');
    $this->respuesta =  Doctrine::getTable('cuota')->verPeriodoCompleto(date('m'),date('Y'));
      break;
    }
  }
  public function executeRecibo(sfWebRequest $request)
  {
    $this->recibo = Doctrine_Core::getTable('cuota')->find(array($request->getParameter('id')));
  }
  public function executeSobre(sfWebRequest $request)
  {
    $this->sobre = Doctrine_Core::getTable('suscriptor')->find(array($request->getParameter('id')));
  }
//========================== IMPRIMIR CERTIFICADO
  public function executeCerti(sfWebRequest $request)
  {
    $suscri = Doctrine_Core::getTable('suscripcion')->find(array($request->getParameter('id')));
$pdf = new TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('times','',10);
$pdf->SetMargins(0, 0, 0);
$pdf->AddPage("P","LEGAL",true,false);

$nombre = $suscri->getSuscriptor()->getApellido().' '.
          $suscri->getSuscriptor()->getNombre();
$nombre = ucwords(strtolower($nombre));
$cantCuotas = $suscri->getCantCuotas();
$direccion = ucwords(strtolower(rtrim($suscri->getSuscriptor()->getDomicilio())));
$diavence = '15 C/M';
$localidad = ucwords(strtolower($suscri->getSuscriptor()->getLocalidad()->getCp()." ".
             rtrim($suscri->getSuscriptor()->getLocalidad()->getNombre())." - ".
             $suscri->getSuscriptor()->getLocalidad()->getProvincia()->getNombre()));
$vcuota = Formatos::moneda($suscri->getValorCuota());
$planD = ucwords(strtolower($suscri->getPlan()));
$dni = Formatos::dni($suscri->getSuscriptor()->getDni());
$solicitud = $suscri->getNro();
$sorteo = $suscri->getSorteo();
$vnominal = Formatos::moneda(Doctrine::getTable('cuota')->getVnominal($suscri->getId()));
$telefono =  $suscri->getSuscriptor()->getTel();

include('../config/pdfcerti.config.php');


$file = str_replace(' ','_',$nombre);
$pdf->Output("certi-$nombre.pdf", 'D');
return;

}

//========================== IMPRIMIR CUOTAS SUSCRIPCION
  public function executePrintresumen(sfWebRequest $request)
  {
require_once('../config/tcpdf.config.php');

$suscripcion = Doctrine_Core::getTable('suscripcion')->find(array($request->getParameter('id')));

$a1=$suscripcion->getSuscriptor();
$a2=$suscripcion->getSuscriptor()->getDomicilio();
$a3 = Formatos::textoCool($suscripcion->getSuscriptor()->getLocalidad()->getCp()." ".
      $suscripcion->getSuscriptor()->getLocalidad()->getNombre()." - ".
      $suscripcion->getSuscriptor()->getLocalidad()->getProvincia()->getNombre());

$a4=$suscripcion->getSuscriptor()->getTel()." / ".$suscripcion->getSuscriptor()->getCelular();
$a5=$suscripcion->getNro();
$a6=$suscripcion->getSorteo();
$a9=$suscripcion->getCodigo()." - ".$suscripcion->getPlan();

$tabla = '
<style>
.lista {font-size:3mm;}
.lista td {text-align:center;border-bottom-style:dotted;
border-color:#c2c2c2}
.lista th {background-color:#dbdbdb}
</style>
  <table class="lista">
   <thead>
    <tr>
      <th align="center" width="20%">Cuota</th>
      <th align="center" width="20%">Importe</th>
      <th align="center" width="20%">F. Emisión</th>
      <th align="center" width="20%">Período</th>
      <th align="center" width="20%">F. Pago</th>
    </tr>
   </thead>
  <tbody>
';

switch ($request->getParameter('ver')){
  case 'Pagadas':
    $respuesta =  Doctrine::getTable('cuota')->verPagadas($request->getParameter('id'));
    $listado = 'PAGADAS';
  break;
  case 'Sin Pagar':
    $respuesta =  Doctrine::getTable('cuota')->verImpagas($request->getParameter('id'));
    $listado = 'SIN PAGAR';
  break;
  case 'Vencidas':
    $respuesta =  Doctrine::getTable('cuota')->verVencidas($request->getParameter('id'));
    $listado = 'VENCIDAS';
  break;
  default:
  $respuesta =  Doctrine::getTable('cuota')->verCuotas($request->getParameter('id'));
    $listado = 'COMPLETO';
  break;
}
$total = 0;
foreach ($respuesta as $cuota) {
$tabla = $tabla
. "<tr><td>" .  $cuota->getNroCuota()
. "</td><td>" . Formatos::moneda($cuota->getImporte())
. "</td><td>" . Formatos::fecha($cuota->getFemision())
. '</td><td align="left">' . Formatos::periodo($cuota->getFvencimiento())
. "</td><td>" . Formatos::fecha($cuota->getFpago())
. "</td></tr>";
$total = $total + $cuota->getImporte();
}
$tabla = $tabla . "</tbody></table>";
$a7 = Formatos::moneda($total);
$a8 = date("d-m-Y");
//<h2 align="center" style="font-size:4mm">Listado de cuotas Completo</h2>
$tabla1 = <<<ETIQUETA
<style>
.suscriptor td {border:hidden}
.suscriptor {font-size:3mm;
border-collapse:collapse;}

</style>
 <table class="suscriptor" cellspacing="0">
   <tr>
<td width="100%" align="center"><b>LISTADO DE CUOTAS {$listado}</b></td>
   </tr>
   <tr>
<td width="5%"></td><td width="10%">Suscriptor:</td><td width="55%">{$a1}</td><td width="10%" align="right">Solicitud:</td><td width="15%" align="right">{$a5}</td>
   </tr>
   <tr>
<td></td>     <td>Dirección:</td><td>{$a2}</td><td align="right">Sorteo:</td><td align="right">{$a6}</td>
   </tr>
   <tr>
<td></td>     <td>Localidad:</td><td>{$a3}</td><td align="right">Total:</td><td align="right">{$a7}</td>
   </tr>
   <tr>
<td></td>     <td>Teléfono:</td><td>{$a4}</td><td align="right">Impreso:</td><td align="right">{$a8}</td>
   </tr>
   <tr>
<td></td>     <td>Plan:</td><td>{$a9}</td>
   </tr>
</table>
ETIQUETA;
  $pdf->writeHTML($tabla1, true, false, true, false, '');

$pdf->writeHTML($tabla, true, false, true, false, '');

	//genero el archivo 
$nombre = str_replace(" ","-",$a1).'-'.date("d-m-Y");
  $pdf->Output('resumen-'.$nombre. '.pdf', 'D');
return;		
  }

  public function executeLiquidacion(sfWebRequest $request)
  {
   if ($request->getParameter("mes")<>null) {
     $this->mesSel = $request->getParameter("mes");
     $this->anioSel = $request->getParameter("anio");
     $this->respuesta =  Doctrine::getTable('cuota')->verLiquidacion($request->getParameter('mes'),$request->getParameter('anio'));
   return;}
      $this->mesSel = date('m');
      $this->anioSel = date('Y');
      $this->respuesta =  Doctrine::getTable('cuota')->verLiquidacion(date('m'),date('Y'));
  }
//====================== IMRIMIR MOROSOS
  public function executePrintmorosos(sfWebRequest $request)
  {
require_once('../config/tcpdf.config.php');

switch ($request->getParameter('listado')){
  case 'periodo':
    $respuesta =  Doctrine::getTable('cuota')->verMorososfecha($request->getParameter("mes"),$request->getParameter("anio"));
  break;
  case 'todos':
    $respuesta =  Doctrine::getTable('cuota')->verMorosos();
  break;
  default:
  return;
}

$fecha = date('d-m-Y');
$tabla = <<<ETIQUETA
<style>
.lista {font-size:3mm;border-bottom-style:dotted;border-color:#c2c2c2}
.lista td {border-bottom-style:dotted;border-color:#c2c2c2}
.lista th {background-color:#dbdbdb}
</style>
  <table class="lista">
   <thead>
    <tr>
      <th align="center" width="40%">Productor/Suscriptor/Tel/Plan</th>
      <th align="center" width="10%">Solicitud</th>
      <th align="center" width="10%">Cuota</th>
      <th align="center" width="15%">Importe</th>
      <th align="center" width="10%">F. Emisión</th>
      <th align="center" width="15%">Período</th>
    </tr>
   </thead>
  <tbody>
ETIQUETA;

$total = 0;
foreach ($respuesta as $cuota) {
$tabla = $tabla
. '<tr><td width="100%">' . $cuota->getProductor().'</td></tr>'
. '<tr><td width="40%">' .  $cuota->getNombre().'<br>'.$cuota->getTelefono().'<br>'.$cuota->getPlan().'<br>'
. '</td><td align="center" width="10%">' .  $cuota->getNro()
. '</td><td align="center" width="10%">' .  $cuota->getNroCuota()
. '</td><td width="15%">' . Formatos::moneda($cuota->getImporte())
. '</td><td width="10%">' . Formatos::fecha($cuota->getFemision())
. '</td><td width="15%" align="left">' . Formatos::periodo($cuota->getFvencimiento())
. '</td></tr>';
$total = $total + $cuota->getImporte();
}
$tabla = $tabla . "</tbody></table>";
$total = Formatos::moneda($total);
$tcoutas = count($respuesta);
$cabeza = <<<ETIQUETA
<p align="center">Lista de Morosos<br>Fecha de impresión: {$fecha}<br>
Total: {$total} en {$tcoutas} cuotas</p>
ETIQUETA;

$tabla = $cabeza.$tabla;
$pdf->writeHTML($tabla, true, false, true, false, '');
	//genero el archivo 
$nombre = 'morosos-'.date("d-m-Y");
  $pdf->Output('resumen-'.$nombre. '.pdf', 'D');
return;		
  }
//====================== IMRIMIR CONSULTAS
  public function executePrintconsultas(sfWebRequest $request)
  {
require_once('../config/tcpdf.config.php');
  $mes = $request->getParameter('mes');
  $anio = $request->getParameter('anio');
  $titulo = $request->getParameter("listado");

switch ($titulo){
      case 'Pagadas':
    $respuesta =  Doctrine::getTable('cuota')->verPeriodoPagadas($mes,$anio);
      break;
      case 'Sin Pagar':
    $respuesta =  Doctrine::getTable('cuota')->verPeriodoSinpagar($mes,$anio);
      break;
      default:
    $respuesta =  Doctrine::getTable('cuota')->verPeriodoCompleto($mes,$anio);
      break;
}
$fecha = date('d-m-Y');
$tabla = <<<ETIQUETA
<style>
.lista {font-size:4mm;border-bottom-style:dotted;border-color:#c2c2c2}
.lista td {border-bottom-style:dotted;border-color:#c2c2c2}
.lista th {background-color:#dbdbdb}
</style>
  <table class="lista">
   <thead>
    <tr>
      <th align="center" width="40%">Suscriptor/Tel/Plan/Productor</th>
      <th align="center" width="10%">Solicitud</th>
      <th align="center" width="10%">Cuota</th>
      <th align="center" width="15%">Importe/Cobro</th>
      <th align="center" width="10%">Estado</th>
    </tr>
   </thead>
  <tbody>
ETIQUETA;

$total = 0;
$linea = 0;
foreach ($respuesta as $cuota) {
$tabla = $tabla
. '<tr><td width="100%"><br><br>' . $cuota->getNombre().'</td></tr>'
. '<tr><td width="40%">' .  Formatos::textoCool($cuota->getLocalidad()).' - '.$cuota->getDireccion().'<br>'.
                            $cuota->getTelefono().'<br>'.$cuota->getPlan().'<br>'.$cuota->getProductor()
. '</td><td align="center" width="10%">' .  $cuota->getNro()
. '</td><td width="10%">' .  $cuota->getNroCuota()
. '</td><td width="15%">' . Formatos::moneda($cuota->getImporte()).'<br><br>'.$cuota->getDiacobro()
. '</td><td width="10%">' . Formatos::fecha($cuota->getFpago())
. '</td></tr>';
$total = $total + $cuota->getImporte();
$linea=$linea+1;
if ($linea==7){$tabla=$tabla."<tr><td><br><br><br></td></tr>";}
}
$tabla = $tabla . "</tbody></table>";
$total = Formatos::moneda($total);
$tcoutas = count($respuesta);
$cabeza = <<<ETIQUETA
<p align="center">Listado de Cuotas {$titulo} del mes {$mes} del {$anio}<br>Fecha de impresión: {$fecha}<br>
Total: {$total} en {$tcoutas} cuotas</p>
ETIQUETA;

$tabla = $cabeza.$tabla;
$pdf->writeHTML($tabla, true, false, true, false, '');
	//genero el archivo 
$nombre = "consulta-$titulo-".date("d-m-Y");
  $pdf->Output($nombre. '.pdf', 'D');
return;		
  }

  public function executeNuevovalor(sfWebRequest $request)
  {
	$id=$request->getParameter('id');
	$valor=$request->getParameter('valor');
	$desde=$request->getParameter('desde');
	$hasta=$request->getParameter('hasta');
if ($valor*1<=0){return sfView::NONE;}
 Doctrine_Query::create()
   ->update('cuota')
   ->set('importe', '?', "$valor")
   ->where("suscripcion_id = ?", $id)
   ->andWhere("nro_cuota >= ?", $desde)
   ->andWhere("nro_cuota <= ?", $hasta)
   ->execute();

 /*Doctrine_Query::create()
   ->update('suscripcion')
   ->set('valor_cuota', '?', "$valor")
   ->where("id = ?", $id)
   ->execute();*/
//     $this->getResponse()->setContent("$id,$valor,$desde,$hasta");
     return sfView::NONE;

  }

public function executeLiquidarcuotas(sfWebRequest $request)
  {
/*id: desde: hasta: femision: fpago:*/
	$id=$request->getParameter('id');
	$desde=$request->getParameter('desde');
	$hasta=$request->getParameter('hasta');
	$femision=$request->getParameter('femision');
	$fpago=$request->getParameter('fpago');
	$impresa=$request->getParameter('impresa');
if ($fpago<>"0"){
  $fpago="'".substr($fpago,6,4).'-'.substr($fpago,3,2).'-'.substr($fpago,0,2)."'";
  $impresa="1";}
  else {$fpago="NULL";}
  $femision=substr($femision,6,4).'-'.substr($femision,3,2).'-'.substr($femision,0,2);
/*
 Doctrine_Query::create()
   ->update('cuota')
   ->set('femision', '?', "$femision")
   ->where("suscripcion_id = ?", $id)
   ->andWhere('femision is null')
   ->andWhere("nro_cuota >= ?", $desde)
   ->andWhere("nro_cuota <= ?", $hasta)
   ->execute();
*/
for ($i=$desde;$i<=$hasta;$i++){
 Doctrine_Query::create()
   ->update('cuota')
   ->set('femision', '?', "$femision")
   ->where("suscripcion_id = ?", $id)
   ->andWhere('femision is null')
   ->andWhere("nro_cuota = ?", $i)
   ->execute();
//2000-11-22
$dia = substr($femision,8,2);
$mes = substr($femision,5,2)*1+1;
$anio = substr($femision,0,4)*1;
if ($mes==13) {$mes=1;$anio++;}
$mes = str_pad($mes, 2, "0", STR_PAD_LEFT);
$femision = $anio.'/'.$mes.'/'.$dia;
}

 Doctrine_Query::create()
   ->update('cuota')
   ->set("fpago","$fpago")
   ->set('impresa', '?', "$impresa")
   ->where("suscripcion_id = ?", $id)
   ->andWhere('fpago is null')
   ->andWhere("nro_cuota >= ?", $desde)
   ->andWhere("nro_cuota <= ?", $hasta)
   ->execute();

//    $this->getResponse()->setContent("$id, $desde,$hasta, $femision,$fpago, $impresa");
    return sfView::NONE;
  }

public function executeCambiarperiodos(sfWebRequest $request)
  {
/*id: desde: hasta: femision: fpago:*/
	$id=$request->getParameter('id');
	$desde=$request->getParameter('desde');
	$hasta=$request->getParameter('hasta');
	$cuota1=$request->getParameter('cuota1');

$mes = substr($cuota1,3,2);
$anio = substr($cuota1,6,4);
$periodo = $anio."-".$mes."-15";

for($c=$desde;$c<=$hasta;$c++){
 Doctrine_Query::create()
   ->update('cuota')
   ->set("fvencimiento","'$periodo'")
   ->where("suscripcion_id = ?", "$id")
   ->andWhere("nro_cuota = ?", "$c")
   ->andWhere('fpago is null')
   ->execute();

$mes = substr($periodo,5,2)*1;
$anio = substr($periodo,0,4)*1;
$mes++;
if ($mes==13){$mes=1;$anio++;}
$mes = str_pad($mes, 2, "0", STR_PAD_LEFT);
$periodo = $anio."-".$mes."-15";

}

//    $this->getResponse()->setContent("$id, $desde,$hasta, $cuota1");
    return sfView::NONE;
  }
  //------------------- MARCAR CUOTA PAGADA
  //date('Y-m-15')
public function executeMarcarpagada(sfWebRequest $request)
  {
  
   $cuota = Doctrine_Core::getTable('cuota')->find(array($request->getParameter('cid')));  
   $cuota->setFpago(date('Y-m-15'));
   $cuota->save();
  return sfView::NONE;
  }

public function executeSinpagar2(sfWebRequest $request)
  {
  
   $cuota = Doctrine_Core::getTable('cuota')->find(array($request->getParameter('cid')));  
   $cuota->setFpago(NULL);
   $cuota->save();
  return sfView::NONE;
  }

  public function executePagada(sfWebRequest $request)
  {
	$idbol =$request->getParameter('idbol');
	$fecha =$request->getParameter('fecha');
	$ncuota =$request->getParameter('ncuota');
$dia = substr($fecha,0,2);
$mes = substr($fecha,3,2);
$anio = substr($fecha,6,4);
$fecha = $anio."-".$mes."-".$dia;
 Doctrine_Query::create()
   ->update('cuota')
   ->set("fpago","'$fecha'")
   ->set("impresa","1")
   ->where("suscripcion_id = ?", "$idbol")
   ->andWhere("nro_cuota = ?", "$ncuota")
//   ->andWhere('fpago is null')
   ->execute();

 Doctrine_Query::create()
   ->update('cuota')
   ->set("femision","'$fecha'")
   ->set("impresa","1")
   ->where("suscripcion_id = ?", "$idbol")
   ->andWhere("nro_cuota = ?", "$ncuota")
   ->andWhere('femision is null')
   ->execute();

 
//   $this->getResponse()->setContent("$idbol, $fecha, $ncuota");
    return sfView::NONE;
  }

  public function executeSinpagar(sfWebRequest $request)
  {
	$idbol =$request->getParameter('idbol');
	$ncuota =$request->getParameter('ncuota');
 Doctrine_Query::create()
   ->update('cuota')
   ->set("fpago","null")
   ->set("impresa","0")
   ->where("suscripcion_id = ?", "$idbol")
   ->andWhere("nro_cuota = ?", "$ncuota")
//   ->andWhere('fpago is null')
   ->execute();

//   $this->getResponse()->setContent("$idbol, $ncuota");
    return sfView::NONE;
  }

  public function executeSinemitiruna(sfWebRequest $request)
  {
	$idbol =$request->getParameter('idbol');
	$ncuota =$request->getParameter('ncuota');
 Doctrine_Query::create()
   ->update('cuota')
   ->set("femision","null")
//   ->set("impresa","0")
   ->where("suscripcion_id = ?", "$idbol")
   ->andWhere("nro_cuota = ?", "$ncuota")
//   ->andWhere('fpago is null')
   ->execute();
//   $this->getResponse()->setContent("$idbol, $ncuota");
    return sfView::NONE;

  }

  public function executeSinpagarrango(sfWebRequest $request)
  {
	$idbol=$request->getParameter('idbol');
	$desde=$request->getParameter('desde');
	$hasta=$request->getParameter('hasta');
for($c=$desde;$c<=$hasta;$c++){
 Doctrine_Query::create()
   ->update('cuota')
   ->set("fpago","null")
   ->set("impresa","0")
   ->where("suscripcion_id = ?", "$idbol")
   ->andWhere("nro_cuota = ?", "$c")
   ->execute();
}

//   $this->getResponse()->setContent("$idbol, $desde, $hasta");
    return sfView::NONE;
  }

  public function executeSinemitir(sfWebRequest $request)
  {
	$idbol=$request->getParameter('idbol');
	$desde=$request->getParameter('desde');
	$hasta=$request->getParameter('hasta');
for($c=$desde;$c<=$hasta;$c++){
 Doctrine_Query::create()
   ->update('cuota')
   ->set("femision","null")
   ->set("impresa","0")
   ->where("suscripcion_id = ?", "$idbol")
   ->andWhere("nro_cuota = ?", "$c")
   ->andWhere("not femision is null")
   ->execute();
}

//   $this->getResponse()->setContent("$idbol, $desde, $hasta");
    return sfView::NONE;
  }

}
