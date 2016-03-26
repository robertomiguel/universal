<?php

/**
 * informectb form base class.
 *
 * @method informectb getObject() Returns the current form's model object
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseinformectbForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'fecha_informe'  => new sfWidgetFormDate(),
      'suscripcion_id' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha_informe'  => new sfValidatorDate(array('required' => false)),
      'suscripcion_id' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('informectb[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'informectb';
  }

}
