<?php

/**
 * plan form.
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class planForm extends BaseplanForm
{
  public function configure()
  {

/*
$this->widgetSchema['valor_cuota'] = new sfWidgetFormInput(array(), array('onKeyUp'=>'valorNominal(this)'));
$this->widgetSchema['cant_cuotas'] = new sfWidgetFormInput(array(), array('onKeyUp'=>'valorCuota(this)'));
$this->widgetSchema['valor_nominal'] = new sfWidgetFormInput(array(), array('onKeyUp'=>'valorCuota2(this)'));
*/
unSet($this['valor_cuota']);
unSet($this['cant_cuotas']);
unSet($this['valor_nominal']);
$this->setDefault('cant_cuotas', '60');

$this->widgetSchema->setLabels(array(
	'codigo' => 'Código',
	'descripcion' => 'Descripción'
        ));
//----------------- autocompletado suscriptor
/*
 $this->widgetSchema['descripcion']   = new sfWidgetFormDoctrineJQueryAutocompleter(array(
	  'model' => 'plan',
	  'url'   => '/plan/buscarDescripcion',
          'label' => 'Descripción' ,
	  'config' => '{ width: 400,max: 10,highlight:false ,multiple: true,multipleSeparator: ",",scroll: true,scrollHeight: 300}'
	)); 
*/
$id = sfContext::getInstance()->getRequest()->getParameter('id');
$rubro = sfContext::getInstance()->getRequest()->getParameter('rubro');
if ($rubro<>"") {
$this->setDefault('rubro_id', "$rubro");
}
if ($id<>"") {
$rubro = Doctrine::getTable('plan')->find("$id")->getRubroId();
$codigo = Doctrine::getTable('plan')->find("$id")->getCodigo();
$descripcion = Doctrine::getTable('plan')->find("$id")->getDescripcion();
$this->setDefault('rubro_id', $rubro);
$this->setDefault('codigo', $codigo);
$this->setDefault('descripcion', $descripcion);}

  }
}
