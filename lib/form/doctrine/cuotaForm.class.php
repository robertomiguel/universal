<?php

/**
 * cuota form.
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cuotaForm extends BasecuotaForm
{
  public function configure()
  {
	//$this->widgetSchema['usuario_id']->setAttribute('readonly', 'readonly'); //
  	$this->widgetSchema['usuario_id'] = new sfWidgetFormInputHidden();
  	
	$this->widgetSchema['suscripcion_id'] = new sfWidgetFormInputHidden();
	$id = sfContext::getInstance()->getRequest()->getParameter('id');
	$this->setDefault('suscripcion_id', $id);

	$this->setDefault('nro_cuota', Doctrine::getTable('cuota')->getTotalcuotas($id)+1);

	//$this->setDefault('femision', date('Y-m-d'));
	$this->setDefault('fvencimiento', date('Y-m-15'));
	$years = range(date('Y'), 2000);
	$this->widgetSchema['femision'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
	'years'=>array_combine($years, $years)));

	//$this->setDefault('fvencimiento', date('Y-m-d'));
	$years = range(date('Y')+10, 2000);
	$this->widgetSchema['fvencimiento'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
	'years'=>array_combine($years, $years)));

	//$this->setDefault('fpago', date('Y-m-d'));
	$years = range(date('Y'), 2000);
	$this->widgetSchema['fpago'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
	'years'=>array_combine($years, $years)));


	$this->widgetSchema->setLabels(array(
		'suscripcion_id' => 'Nro. Suscrip.',
	          'femision' => 'Fecha Emisión',
	      'fvencimiento' => 'Fecha Vencimiento',
	             'fpago' => 'Fecha Pago'));
  }
}
