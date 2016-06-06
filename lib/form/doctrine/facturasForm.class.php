<?php

/**
 * facturas form.
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class facturasForm extends BasefacturasForm
{
  public function configure()
  {
  	$this->widgetSchema['usuario_id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['updated_at'] = new sfWidgetFormInputHidden();
  	$this->setDefault('created_at', date("Y-m-d G:i"));
	$this->setDefault('updated_at', date("Y-m-d G:i"));

	//$this->widgetSchema['estado']  = new sfWidgetFormChoice(array('choices' => array('Pendiente', 'Pagado', 'Anulado')));

	//$this->widgetSchema['tipo_factura'] = new sfWidgetFormChoice(array('choices' => array('A', 'B', 'C', 'X')));

	$years = range(date('Y'), 1900);
	$this->widgetSchema['pago'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
	'years'=>array_combine($years, $years)));

	$years = range(date('Y') + 1, 1900);
	$this->widgetSchema['vencimiento'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
	'years'=>array_combine($years, $years)));

	//----------------- autocompletado proveedor
  	$this->widgetSchema['prov_id']->setOption(
	    'renderer_class',
	    'sfWidgetFormDoctrineJQueryAutocompleter'
	);
	 
	$this->widgetSchema['prov_id']->setOption(
	   'renderer_options', 
	    array (
		  		'model' => 'proveedor',
		  		'url'   => '/proveedor/buscarProveedor',
		)
	);
  }
}
