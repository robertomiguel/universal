<?php

/**
 * suscripcion form.
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class suscripcioneditarForm extends BasesuscripcionForm
{
  public function configure()
  {
/*
$this->widgetSchema['cant_cuotas'] = new sfWidgetFormInputHidden();
$this->widgetSchema['valor_nominal'] = new sfWidgetFormInputHidden();
$this->widgetSchema['valor_cuota'] = new sfWidgetFormInputHidden();
$this->widgetSchema['dia_pago'] = new sfWidgetFormInputHidden();
*/

$this->widgetSchema['obs'] = new sfWidgetFormTextarea();
$id = sfContext::getInstance()->getRequest()->getParameter('id');

$years = range(date('Y'), 2000);
$this->widgetSchema['fecha_alta'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
'years'=>array_combine($years, $years)));
$years = range(date('Y'), 2000);
$this->widgetSchema['fecha_vence'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
'years'=>array_combine($years, $years)));
$years = range(date('Y'), 2000);
$this->widgetSchema['fecha_baja'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
'years'=>array_combine($years, $years)));

/*
$this->widgetSchema->setLabels(array(
  'fecha_alta' => 'Fecha solicitud',
  'dia_baja' => 'Actualizar desde',
  'nro' => 'Nro. solicitud',
        'obs'  => 'Observaciones'));
//----------------- ordenar
$this->widgetSchema->setPositions(array('id','fecha','dia_pago','valor_cuota','nro','plan_id',
   'valor_nominal','cant_cuotas','suscriptor_id', 'productor_id',
   'sorteo','obs'));
*/
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
/*
//----------------- autocompletado plan
  $this->widgetSchema['plan_id']->setOption(
     'renderer_class',
     'sfWidgetFormDoctrineJQueryAutocompleter'
  );
 
  $this->widgetSchema['plan_id']->setOption(
    'renderer_options', 
    array(
	  'model' => 'plan',
	  'url'   => '/plan/buscarPlan',
	)
  );*/

  }
}
