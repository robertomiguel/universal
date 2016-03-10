<?php

/**
 * productor actions.
 *
 * @package    universal
 * @subpackage productor
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productorActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
//    $this->productors = Doctrine_Core::getTable('productor')
//      ->createQuery('a')
//      ->execute();
     $this->respuesta =  Doctrine::getTable('productor')->getResultado($request->getParameter('codigo'));
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->productor = Doctrine_Core::getTable('productor')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->productor);
    //$this->totalsuscripciones =  Doctrine::getTable('suscripcion')->getProductor($request->getParameter('id'));
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new productorForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new productorForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($productor = Doctrine_Core::getTable('productor')->find(array($request->getParameter('id'))), sprintf('Object productor does not exist (%s).', $request->getParameter('id')));
    $this->form = new productorForm($productor);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($productor = Doctrine_Core::getTable('productor')->find(array($request->getParameter('id'))), sprintf('Object productor does not exist (%s).', $request->getParameter('id')));
    $this->form = new productorForm($productor);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($productor = Doctrine_Core::getTable('productor')->find(array($request->getParameter('id'))), sprintf('Object productor does not exist (%s).', $request->getParameter('id')));
    $productor->delete();

    $this->redirect('productor/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $productor = $form->save();

 //     $this->redirect('productor/show?id='.$productor->getId());
     $this->redirect('productor/index');
    }
  }

 public function executeCiudad(sfWebRequest $request)
    {} 

//------------ autocompletado
public function executeBuscarProductor(sfWebRequest $request)
{
    $this->getResponse()->setContentType('application/json');
 
    $productor = Doctrine::getTable('productor')
                    ->retrieveForSelect(
                            $request->getParameter('q'),
                            $request->getParameter('limit')
    );
 
  return $this->renderText(json_encode($productor));
}

}
