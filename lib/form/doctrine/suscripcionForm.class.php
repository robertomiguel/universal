<?php

/**
 * suscripcion form.
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class suscripcionForm extends BasesuscripcionForm
{
  public function configure()
  {
$this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
$this->widgetSchema['updated_at'] = new sfWidgetFormInputHidden();
$this->setDefault('created_at', date("Y-m-d G:i"));
$this->setDefault('updated_at', date("Y-m-d G:i"));
$this->widgetSchema['codigo'] = new sfWidgetFormInputHidden();

$this->widgetSchema['usuario_id'] = new sfWidgetFormInputHidden();

//$this->widgetSchema['valor_cuota'] = new sfWidgetFormInput(array(), array('onKeyUp'=>'valorNominal(this)'));
//$this->widgetSchema['cant_cuotas'] = new sfWidgetFormInput(array(), array('onKeyUp'=>'valorCuota(this)'));
//$this->widgetSchema['valor_nominal'] = new sfWidgetFormInput(array(), array('onKeyUp'=>'valorCuota2(this)'));

//$this->widgetSchema['plan_id'] = new sfWidgetFormInput(array(), array('onClick'=>'abrirVentana("Plan")'));

//$this->widgetSchema['plan_id'] = new sfWidgetFormInputHidden();
//$this->widgetSchema['suscriptor_id'] = new sfWidgetFormInputHidden();
//$this->widgetSchema['productor_id'] = new sfWidgetFormInputHidden();

/*$years = range(date('Y')+1, '2000');
$this->widgetSchema['dia_pago'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
'years'=>array_combine($years, $years)));
$mes=date('m')+1;if ($mes==13){$mes=1;}
$this->setDefault('dia_pago', date("Y-$mes-15"));
*/

/*
$this->widgetSchema['fecha_vence'] = new sfWidgetFormInputHidden();
//$mes=date('m')+1;if ($mes==13){$mes=1;}
$mes=date('m')*1;$anio=date('Y');
$mes++;
if ($mes=='13'){$mes=1;$anio++;}
$this->setDefault('fecha_vence', date("$anio-$mes-15"));
*/

$this->widgetSchema['obs'] = new sfWidgetFormTextarea();

$id = sfContext::getInstance()->getRequest()->getParameter('id');


//$this->setDefault('fecha_vence', '15');
//unSet($this['fecha_vence']);
$this->setDefault('cant_cuotas', '84');
//$this->widgetSchema['fecha_alta'] = new sfWidgetFormInputHidden();
$this->setDefault('fecha_alta', date('Y-m-d'));
$m=date('m')+1;if ($m==13){$m=1;}

if(date('m')==12) {
$y=date('Y')+1;
$this->setDefault('fecha_vence', date("$y-$m-15"));
} else {
$this->setDefault('fecha_vence', date("Y-$m-15"));
}

  

//$years = range(date('Y'), 2000);
//$this->widgetSchema['fecha_alta'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
//'years'=>array_combine($years, $years)));

/*$this->widgetSchema['fecha_alta'] = new sfWidgetFormJQueryDate(array(
'date_widget' => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')),
'config' => "{minDate: '-10y', maxDate: '+1y', changeYear: true, showOn: 'both',buttonText: 'Cambiar'}",
  'culture' => 'es',));
*/
$years = range(date('Y'), 2000);
$this->widgetSchema['fecha_alta'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
'years'=>array_combine($years, $years)));
$years = range(date('Y')+1, 2000);
$this->widgetSchema['fecha_vence'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
'years'=>array_combine($years, $years)));
$years = range(date('Y'), 2000);
$this->widgetSchema['fecha_baja'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
'years'=>array_combine($years, $years)));

$this->widgetSchema->setLabels(array(
	'fecha_alta' => 'Fecha solicitud',
	'fecha_vence' => 'Fecha Cuota 1',
  'fecha_baja' => 'Fecha Baja',
  'diacobro' => 'Día de cobro',
  'cant_cuotas' => 'Cuotas',
  'valor_cuota' => 'Valor Cuota',
	'nro' => 'Nro. solicitud',
        'obs'  => 'Observaciones'));

//----------------- ordenar
//$this->widgetSchema->setPositions(array('id','fecha','dia_pago','nro','plan_id',
//  'valor_cuota','valor_nominal','cant_cuotas','suscriptor_id', 'productor_id',
//  'sorteo','obs'));

//----------------- autocompletado productor
  $this->widgetSchema['productor_id']->setOption(
     'renderer_class',
     'sfWidgetFormDoctrineJQueryAutocompleter'
  );
 
  $this->widgetSchema['productor_id']->setOption(
    'renderer_options', 
    array(
	  'model' => 'productor',
	  'url'   => '/productor/buscarProductor',
	)
  );

//----------------- autocompletado suscriptor
  $this->widgetSchema['suscriptor_id']->setOption(
     'renderer_class',
     'sfWidgetFormDoctrineJQueryAutocompleter'
  );
 
  $this->widgetSchema['suscriptor_id']->setOption(
    'renderer_options', 
    array(
	  'model' => 'suscriptor',
	  'url'   => '/suscriptor/buscarSuscriptor',
	  'type'   => 'post',
	)
  );

//----------------- autocompletado plan
 /*
  $this->widgetSchema['plan']->setOption(
     'renderer_class',
     'sfWidgetFormDoctrineJQueryAutocompleter'
  );
 
  $this->widgetSchema['plan']->setOption(
    'renderer_options', 
    array(
	  'model' => 'plan',
	  'url'   => '/plan/buscarPlan',
	)
  );

if ($id<>"") {$this->setDefault('plan', $id);}

  */
  }
}
