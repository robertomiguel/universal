<?php

/**
 * suscripcion actions.
 *
 * @package    universal
 * @subpackage suscripcion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class suscripcionActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
//    $this->suscripcions = Doctrine_Core::getTable('suscripcion')
//      ->createQuery('a')->where('fecha_baja is null')
//      ->execute();
$this->bajas = Doctrine::getTable('suscripcion')->totalBajas();
    if ($request->getParameter('sid')<>NULL) {
      $this->respuesta =  Doctrine::getTable('suscripcion')->verSuscriptor($request->getParameter('sid'));return;}

    if ($request->getParameter('pid')<>NULL) {
      $this->respuesta =  Doctrine::getTable('suscripcion')->verProductor($request->getParameter('pid'));return;}

    if ($request->getParameter('plid')<>NULL) {
      $this->respuesta =  Doctrine::getTable('suscripcion')->verPlan($request->getParameter('plid'));return;}
    if ($request->getParameter('buscar')<>NULL) {
      $this->respuesta =  Doctrine::getTable('suscripcion')->getResultado($request->getParameter('buscar'));return;}

    $this->respuesta = Doctrine_Core::getTable('suscripcion')
      ->createQuery('a')->where('fecha_baja is null')->orderBy('productor_id')
      ->execute();
    
  }

public function executeEditarcobro(sfWebRequest $request){
  $id = $request->getParameter('sid');
  $dia = $request->getParameter('dia');
   $suscrip = Doctrine_Core::getTable('suscripcion')->find($id);
   $suscrip->setDiacobro($dia);
   $suscrip->save();
  echo "Guardado $id - ".$suscrip->getDiacobro();
  return sfView::NONE;
}

public function executeGrabarobs(sfWebRequest $request){
  $id = $request->getParameter('id');
  $texto = $request->getParameter('texto');
   $suscrip = Doctrine_Core::getTable('suscripcion')->find($id);
   $suscrip->setObs($texto);
   $suscrip->save();
  echo "Guardado $id - ".$suscrip->getObs();
  return sfView::NONE;
}
public function executeListado(sfWebRequest $request){
  $this->productores = Doctrine_Core::getTable('productor')
      ->createQuery('a')
      ->execute();
}
public function executeListadomes(sfWebRequest $request){
  $this->mes = $request->getParameter('mes');
  $this->anio = $request->getParameter('anio');
  if ($request->getParameter('mes')=="todos"){
    $this->redirect('suscripcion/listado');
  }
  $this->productores = Doctrine_Core::getTable('productor')
      ->createQuery('a')
      ->execute();
}
//----------------------- ACTIVAR SUSCRIPCION
  public function executeActivar(sfWebRequest $request) {
  $suscrip = Doctrine_Core::getTable('suscripcion')->find($request->getParameter('id'));
  $suscrip->setFechaBaja(NULL);
  $suscrip->save();
  echo 'Suscripción Activada';
  return sfView::NONE;
}
//---------------------- DAR DE BAJA SUSCRIPCION
  public function executeBajar(sfWebRequest $request) {
  $suscrip = Doctrine_Core::getTable('suscripcion')->find($request->getParameter('id'));
  $suscrip->setFechaBaja(date('Y-m-d'));
  $suscrip->save();
  echo 'Suscripción Cancelada';
  return sfView::NONE;
}

  public function executeVerbajas(sfWebRequest $request)
  {
    $this->respuesta = Doctrine_Core::getTable('suscripcion')
      ->createQuery('a')->where('not fecha_baja is null')
      ->execute();
}
  public function executeShow(sfWebRequest $request)
  {
    $this->suscripcion = Doctrine_Core::getTable('suscripcion')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->suscripcion);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new suscripcionForm();
    //$this->idplan = $request->getParameter('planid');
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new suscripcionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($suscripcion = Doctrine_Core::getTable('suscripcion')->find(array($request->getParameter('id'))), sprintf('Object suscripcion does not exist (%s).', $request->getParameter('id')));
//   $this->form = new suscripcionForm($suscripcion);
   $this->form = new suscripcioneditarForm($suscripcion);
   $this->cid = $suscripcion->getId();
//$this->form = new suscripcionForm($suscripcion, array('url' => $this->getController()->genUrl('productor/ajax')));
 

  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($suscripcion = Doctrine_Core::getTable('suscripcion')->find(array($request->getParameter('id'))), sprintf('Object suscripcion does not exist (%s).', $request->getParameter('id')));
    $this->form = new suscripcioneditarForm($suscripcion);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($suscripcion = Doctrine_Core::getTable('suscripcion')->find(array($request->getParameter('id'))), sprintf('Object suscripcion does not exist (%s).', $request->getParameter('id')));
    $suscripcion->delete();

    $this->redirect('suscripcion/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $suscripcion = $form->save();
      $id = $suscripcion->getId();

//     $this->redirect('suscripcion/show?id='.$suscripcion->getId());
//   cuota?id=5
   if ($request->getParameter('id')<>null) {
$this->redirect('suscripcion/index');

} //editado
    else {  //nuevo
//$cuotas = $suscripcion->getPlan()->getCantCuotas() + 1;
//$importe = $suscripcion->getPlan()->getValorCuota();
$cuotas = $suscripcion->getCantCuotas() + 1;
$importe = $suscripcion->getValorCuota();
$fecha =  explode('-',$suscripcion->getFechaVence());

for ($i=1;$i<$cuotas;$i++){
//echo str_pad($input, 10, "-=", STR_PAD_LEFT);
$mes = str_pad($fecha[1], 2, "0", STR_PAD_LEFT);
 $a = new cuota();
 $a->setSuscripcionId($id);
 $a->setNroCuota($i);
 $a->setimporte($importe);
 $a->setFvencimiento($fecha[0].$mes."15"); //"20110101" Y-m-d
 $a->save();
 $fecha[1]++;
  if ($fecha[1]=="13") {
   $fecha[1]=1;
   $fecha[0]++;
  }
}
//          $this->redirect('suscripcion/index');
     $this->redirect('cuota/index?id='.$id);
             }
         }
  }
}
