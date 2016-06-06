<?php

/**
 * proveedor form.
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class proveedorForm extends BaseproveedorForm
{
  public function configure()
  {
  	$this->widgetSchema['usuario_id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['updated_at'] = new sfWidgetFormInputHidden();
  	$this->setDefault('created_at', date("Y-m-d G:i"));
	$this->setDefault('updated_at', date("Y-m-d G:i"));
	$years = range(date('Y'), 1900);
	$this->widgetSchema['inicio_actividad'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
	'years'=>array_combine($years, $years)));

  }
}
