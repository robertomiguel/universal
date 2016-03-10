<?php

/**
 * plan actions.
 *
 * @package    universal
 * @subpackage plan
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class planActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
//    $this->plans = Doctrine_Core::getTable('plan')
//      ->createQuery('a')
//      ->execute();
    $this->respuesta =  Doctrine::getTable('plan')->getResultado($request->getParameter('buscar'),$request->getParameter('rubro'));
    $this->rubros = Doctrine_Core::getTable('Rubro')->createQuery('a')->execute();
    $this->rubroSel = $request->getParameter('rubro');
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->plan = Doctrine_Core::getTable('plan')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->plan);
    $this->totalsuscripciones =  Doctrine::getTable('suscripcion')->getPlan($request->getParameter('id'));
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new planForm();
    $this->anterior = $request->getReferer();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new planForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($plan = Doctrine_Core::getTable('plan')->find(array($request->getParameter('id'))), sprintf('Object plan does not exist (%s).', $request->getParameter('id')));
    $this->form = new planForm($plan);
    $this->anterior = $request->getReferer();
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($plan = Doctrine_Core::getTable('plan')->find(array($request->getParameter('id'))), sprintf('Object plan does not exist (%s).', $request->getParameter('id')));
    $this->form = new planForm($plan);

    $this->processForm($request, $this->form);
    $this->anterior = $request->getReferer();
    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($plan = Doctrine_Core::getTable('plan')->find(array($request->getParameter('id'))), sprintf('Object plan does not exist (%s).', $request->getParameter('id')));
    $plan->delete();

    $this->redirect('plan/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $plan = $form->save();
$this->redirect($request->getParameter('volver'));

 //     $this->redirect('plan/show?id='.$plan->getId());
     $this->redirect('plan/index');
    }
  }

//------------ autocompletado
public function executeBuscarPlan(sfWebRequest $request)
{
    $this->getResponse()->setContentType('application/json');
 
    $plan = Doctrine::getTable('plan')
                    ->retrieveForSelect(
                            $request->getParameter('q'),
                            $request->getParameter('limit')
    );
 
  return $this->renderText(json_encode($plan));
}
//------------ autocompletado
/*
public function executeBuscarDescripcion(sfWebRequest $request)
{
    $this->getResponse()->setContentType('application/json');
 
 $respuesta = Doctrine_Query::create()
       ->select("descripcion" )
       ->from("plan")
       ->where('descripcion LIKE ?', "%".$request->getParameter('q')."%")
       ->limit(10);
       $r = $respuesta->execute()->toKeyValueArray('descripcion','descripcion');
  return $this->renderText(json_encode($r));
}
*/
}
