<?php

/**
 * suscripcion filter form base class.
 *
 * @package    universal
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesuscripcionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha_alta'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_vence'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_baja'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'nro'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'suscriptor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('suscriptor'), 'add_empty' => true)),
      'productor_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('productor'), 'add_empty' => true)),
      'codigo'        => new sfWidgetFormFilterInput(),
      'diacobro'      => new sfWidgetFormFilterInput(),
      'plan'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'valor_cuota'   => new sfWidgetFormFilterInput(),
      'cant_cuotas'   => new sfWidgetFormFilterInput(),
      'sorteo'        => new sfWidgetFormFilterInput(),
      'obs'           => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'fecha_alta'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_vence'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_baja'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nro'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'suscriptor_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('suscriptor'), 'column' => 'id')),
      'productor_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('productor'), 'column' => 'id')),
      'codigo'        => new sfValidatorPass(array('required' => false)),
      'diacobro'      => new sfValidatorPass(array('required' => false)),
      'plan'          => new sfValidatorPass(array('required' => false)),
      'valor_cuota'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cant_cuotas'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sorteo'        => new sfValidatorPass(array('required' => false)),
      'obs'           => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('suscripcion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'suscripcion';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'fecha_alta'    => 'Date',
      'fecha_vence'   => 'Date',
      'fecha_baja'    => 'Date',
      'nro'           => 'Number',
      'suscriptor_id' => 'ForeignKey',
      'productor_id'  => 'ForeignKey',
      'codigo'        => 'Text',
      'diacobro'      => 'Text',
      'plan'          => 'Text',
      'valor_cuota'   => 'Number',
      'cant_cuotas'   => 'Number',
      'sorteo'        => 'Text',
      'obs'           => 'Text',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
