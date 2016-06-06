<?php

/**
 * productor filter form base class.
 *
 * @package    universal
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseproductorFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'localidad_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('localidad'), 'add_empty' => true)),
      'codigo'       => new sfWidgetFormFilterInput(),
      'zona'         => new sfWidgetFormFilterInput(),
      'apellido'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'domicilio'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tel'          => new sfWidgetFormFilterInput(),
      'celular'      => new sfWidgetFormFilterInput(),
      'usuario_id'   => new sfWidgetFormFilterInput(),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'localidad_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('localidad'), 'column' => 'id')),
      'codigo'       => new sfValidatorPass(array('required' => false)),
      'zona'         => new sfValidatorPass(array('required' => false)),
      'apellido'     => new sfValidatorPass(array('required' => false)),
      'nombre'       => new sfValidatorPass(array('required' => false)),
      'domicilio'    => new sfValidatorPass(array('required' => false)),
      'tel'          => new sfValidatorPass(array('required' => false)),
      'celular'      => new sfValidatorPass(array('required' => false)),
      'usuario_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('productor_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'productor';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'localidad_id' => 'ForeignKey',
      'codigo'       => 'Text',
      'zona'         => 'Text',
      'apellido'     => 'Text',
      'nombre'       => 'Text',
      'domicilio'    => 'Text',
      'tel'          => 'Text',
      'celular'      => 'Text',
      'usuario_id'   => 'Number',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}
