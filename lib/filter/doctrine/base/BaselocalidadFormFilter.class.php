<?php

/**
 * localidad filter form base class.
 *
 * @package    universal
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaselocalidadFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'provincia_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('provincia'), 'add_empty' => true)),
      'nombre'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cp'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'provincia_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('provincia'), 'column' => 'id')),
      'nombre'       => new sfValidatorPass(array('required' => false)),
      'cp'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('localidad_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'localidad';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'provincia_id' => 'ForeignKey',
      'nombre'       => 'Text',
      'cp'           => 'Text',
    );
  }
}
