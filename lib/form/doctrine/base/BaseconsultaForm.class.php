<?php

/**
 * consulta form base class.
 *
 * @method consulta getObject() Returns the current form's model object
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseconsultaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'nombre'     => new sfWidgetFormInputText(),
      'telefono'   => new sfWidgetFormInputText(),
      'email'      => new sfWidgetFormInputText(),
      'plan_id'    => new sfWidgetFormInputText(),
      'consulta'   => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre'     => new sfValidatorString(array('max_length' => 100)),
      'telefono'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'email'      => new sfValidatorString(array('max_length' => 50)),
      'plan_id'    => new sfValidatorInteger(),
      'consulta'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('consulta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'consulta';
  }

}
