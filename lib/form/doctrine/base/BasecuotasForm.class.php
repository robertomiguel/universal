<?php

/**
 * cuotas form base class.
 *
 * @method cuotas getObject() Returns the current form's model object
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasecuotasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'suscripcion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('suscripcion'), 'add_empty' => false)),
      'importe'        => new sfWidgetFormInputText(),
      'femision'       => new sfWidgetFormDate(),
      'fvencimiento'   => new sfWidgetFormDate(),
      'fpago'          => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'suscripcion_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('suscripcion'))),
      'importe'        => new sfValidatorNumber(array('required' => false)),
      'femision'       => new sfValidatorDate(array('required' => false)),
      'fvencimiento'   => new sfValidatorDate(array('required' => false)),
      'fpago'          => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cuotas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'cuotas';
  }

}
