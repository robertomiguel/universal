<?php

/**
 * proveedor actions.
 *
 * @package    universal
 * @subpackage proveedor
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class proveedorActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->proveedors = Doctrine_Core::getTable('proveedor')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->proveedor = Doctrine_Core::getTable('proveedor')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->proveedor);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new proveedorForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new proveedorForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($proveedor = Doctrine_Core::getTable('proveedor')->find(array($request->getParameter('id'))), sprintf('Object proveedor does not exist (%s).', $request->getParameter('id')));
    $this->form = new proveedorForm($proveedor);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($proveedor = Doctrine_Core::getTable('proveedor')->find(array($request->getParameter('id'))), sprintf('Object proveedor does not exist (%s).', $request->getParameter('id')));
    $this->form = new proveedorForm($proveedor);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($proveedor = Doctrine_Core::getTable('proveedor')->find(array($request->getParameter('id'))), sprintf('Object proveedor does not exist (%s).', $request->getParameter('id')));
    $proveedor->delete();

    $this->redirect('proveedor/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $proveedor = $form->save();
      $proveedor->setUsuarioId( $this->getUser()->getGuardUser()->getId() );
      $proveedor->save();

      $this->redirect('proveedor/index');
      //$this->redirect('proveedor/edit?id='.$proveedor->getId());
    }
  }

  //------------ autocompletado
  public function executeBuscarProveedor(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');
   
    $proveedor = Doctrine::getTable('proveedor')->retrieveForSelect(
                              $request->getParameter('q'),
                              $request->getParameter('limit')
      );
   
    return $this->renderText(json_encode($proveedor));
  }
}
