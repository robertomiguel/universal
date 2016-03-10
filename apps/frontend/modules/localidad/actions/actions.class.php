<?php

/**
 * localidad actions.
 *
 * @package    universal
 * @subpackage localidad
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class localidadActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
         $this->buscar = $request->getParameter('buscar');
//    $this->localidads = Doctrine_Core::getTable('localidad')->createQuery('a')->execute();
	 $this->pager = new sfDoctrinePager('TableName', '50');
//	 $this->pager->setQuery(Doctrine::getTable('localidad')->createQuery('a'));
	 $this->pager->setQuery(Doctrine_Query::create()
       ->select("provincia_id, nombre, cp" )
       ->from("localidad")
       ->where('cp =?', $this->buscar)
       ->orWhere('nombre LIKE ?', "%".$this->buscar."%"));
	 $this->pager->setPage($request->getParameter('page', 1));
	 $this->pager->init();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->localidad = Doctrine_Core::getTable('localidad')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->localidad);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new localidadForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new localidadForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($localidad = Doctrine_Core::getTable('localidad')->find(array($request->getParameter('id'))), sprintf('Object localidad does not exist (%s).', $request->getParameter('id')));
    $this->form = new localidadForm($localidad);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($localidad = Doctrine_Core::getTable('localidad')->find(array($request->getParameter('id'))), sprintf('Object localidad does not exist (%s).', $request->getParameter('id')));
    $this->form = new localidadForm($localidad);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($localidad = Doctrine_Core::getTable('localidad')->find(array($request->getParameter('id'))), sprintf('Object localidad does not exist (%s).', $request->getParameter('id')));
    $localidad->delete();

    $this->redirect('localidad/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $localidad = $form->save();

      $this->redirect('localidad/show?id='.$localidad->getId());
    }
  }
//------------ autocompletado
public function executeBuscarLocalidad(sfWebRequest $request)
{
    $this->getResponse()->setContentType('application/json');
 
    $localidad = Doctrine::getTable('localidad')
                    ->retrieveForSelect(
                            $request->getParameter('q'),
                            $request->getParameter('limit')
    );
 
  return $this->renderText(json_encode($localidad));
}
}
