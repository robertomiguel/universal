<?php

/**
 * fac_estado form base class.
 *
 * @method fac_estado getObject() Returns the current form's model object
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basefac_estadoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'     => new sfWidgetFormInputHidden(),
      'nombre' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nombre' => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('fac_estado[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'fac_estado';
  }

}
