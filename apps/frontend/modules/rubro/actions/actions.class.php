<?php

/**
 * rubro actions.
 *
 * @package    universal
 * @subpackage rubro
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class rubroActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->rubros = Doctrine_Core::getTable('Rubro')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->rubro = Doctrine_Core::getTable('Rubro')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->rubro);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new RubroForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new RubroForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($rubro = Doctrine_Core::getTable('Rubro')->find(array($request->getParameter('id'))), sprintf('Object rubro does not exist (%s).', $request->getParameter('id')));
    $this->form = new RubroForm($rubro);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($rubro = Doctrine_Core::getTable('Rubro')->find(array($request->getParameter('id'))), sprintf('Object rubro does not exist (%s).', $request->getParameter('id')));
    $this->form = new RubroForm($rubro);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($rubro = Doctrine_Core::getTable('Rubro')->find(array($request->getParameter('id'))), sprintf('Object rubro does not exist (%s).', $request->getParameter('id')));
    $rubro->delete();

    $this->redirect('rubro/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $rubro = $form->save();

//      $this->redirect('rubro/edit?id='.$rubro->getId());
     $this->redirect('rubro/index');
    }
  }
}
