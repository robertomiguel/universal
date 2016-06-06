<?php

/**
 * facturas actions.
 *
 * @package    universal
 * @subpackage facturas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class facturasActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->facturass = Doctrine_Core::getTable('facturas')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->facturas = Doctrine_Core::getTable('facturas')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->facturas);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new facturasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new facturasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($facturas = Doctrine_Core::getTable('facturas')->find(array($request->getParameter('id'))), sprintf('Object facturas does not exist (%s).', $request->getParameter('id')));
    $this->form = new facturasForm($facturas);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($facturas = Doctrine_Core::getTable('facturas')->find(array($request->getParameter('id'))), sprintf('Object facturas does not exist (%s).', $request->getParameter('id')));
    $this->form = new facturasForm($facturas);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($facturas = Doctrine_Core::getTable('facturas')->find(array($request->getParameter('id'))), sprintf('Object facturas does not exist (%s).', $request->getParameter('id')));
    $facturas->delete();

    $this->redirect('facturas/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $facturas = $form->save();
      $facturas->setUsuarioId( $this->getUser()->getGuardUser()->getId() );
      $facturas->save();

      $this->redirect('facturas/index');
      $this->redirect('facturas/edit?id='.$facturas->getId());
    }
  }
}
