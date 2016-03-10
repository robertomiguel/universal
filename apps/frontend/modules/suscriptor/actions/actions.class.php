<?php

/**
 * suscriptor actions.
 *
 * @package    universal
 * @subpackage suscriptor
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class suscriptorActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
//    $this->suscriptors = Doctrine_Core::getTable('suscriptor')
//      ->createQuery('a')
//      ->execute();
    $this->totalinactivos =  Doctrine::getTable('suscriptor')->getInactivos();
    $this->totales =  Doctrine::getTable('suscriptor')->getTotales();
    $this->activos = $this->totales - $this->totalinactivos;
  if ($request->getParameter('ver')=="inactivos") {
    $this->respuesta =  Doctrine::getTable('suscriptor')->verActivos(0);return;}
  if ($request->getParameter('ver')=="activos") {
    $this->respuesta =  Doctrine::getTable('suscriptor')->verActivos(1);return;}

    $this->respuesta =  Doctrine::getTable('suscriptor')->getResultado($request->getParameter('buscar'));
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->suscriptor = Doctrine_Core::getTable('suscriptor')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->suscriptor);
    $this->totalsuscripciones = Doctrine::getTable('suscripcion')->getSuscriptor($request->getParameter('id'));
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new suscriptorForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new suscriptorForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($suscriptor = Doctrine_Core::getTable('suscriptor')->find(array($request->getParameter('id'))), sprintf('Object suscriptor does not exist (%s).', $request->getParameter('id')));
    $this->form = new suscriptorForm($suscriptor);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($suscriptor = Doctrine_Core::getTable('suscriptor')->find(array($request->getParameter('id'))), sprintf('Object suscriptor does not exist (%s).', $request->getParameter('id')));
    $this->form = new suscriptorForm($suscriptor);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($suscriptor = Doctrine_Core::getTable('suscriptor')->find(array($request->getParameter('id'))), sprintf('Object suscriptor does not exist (%s).', $request->getParameter('id')));
    $suscriptor->delete();

    $this->redirect('suscriptor/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $suscriptor = $form->save();

//      $this->redirect('suscriptor/show?id='.$suscriptor->getId());
      $this->redirect('suscriptor/index');
    }
  }

//------------ autocompletado
public function executeBuscarSuscriptor(sfWebRequest $request)
{
    $this->getResponse()->setContentType('application/json');
 
    $suscriptor = Doctrine::getTable('suscriptor')
                    ->retrieveForSelect(
                            $request->getParameter('q'),
                            $request->getParameter('limit')
    );
 
  return $this->renderText(json_encode($suscriptor));
}
}
