<?php

/**
 * facturas filter form base class.
 *
 * @package    universal
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasefacturasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'prov_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('proveedor'), 'add_empty' => true)),
      'nro'         => new sfWidgetFormFilterInput(),
      'pago'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'vencimiento' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'importe'     => new sfWidgetFormFilterInput(),
      'tipo_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('fac_tipo'), 'add_empty' => true)),
      'estado_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('fac_estado'), 'add_empty' => true)),
      'obs'         => new sfWidgetFormFilterInput(),
      'usuario_id'  => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'prov_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('proveedor'), 'column' => 'id')),
      'nro'         => new sfValidatorPass(array('required' => false)),
      'pago'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'vencimiento' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'importe'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'tipo_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('fac_tipo'), 'column' => 'id')),
      'estado_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('fac_estado'), 'column' => 'id')),
      'obs'         => new sfValidatorPass(array('required' => false)),
      'usuario_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('facturas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'facturas';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'prov_id'     => 'ForeignKey',
      'nro'         => 'Text',
      'pago'        => 'Date',
      'vencimiento' => 'Date',
      'importe'     => 'Number',
      'tipo_id'     => 'ForeignKey',
      'estado_id'   => 'ForeignKey',
      'obs'         => 'Text',
      'usuario_id'  => 'Number',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
