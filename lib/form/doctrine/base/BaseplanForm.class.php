<?php

/**
 * plan form base class.
 *
 * @method plan getObject() Returns the current form's model object
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseplanForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'rubro_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('rubro'), 'add_empty' => false)),
      'visto'       => new sfWidgetFormInputText(),
      'descripcion' => new sfWidgetFormInputText(),
      'valor_cuota' => new sfWidgetFormInputText(),
      'foto'        => new sfWidgetFormInputText(),
      'info_url'    => new sfWidgetFormInputText(),
      'mostrar'     => new sfWidgetFormInputCheckbox(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'rubro_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('rubro'))),
      'visto'       => new sfValidatorInteger(array('required' => false)),
      'descripcion' => new sfValidatorString(array('max_length' => 100)),
      'valor_cuota' => new sfValidatorNumber(array('required' => false)),
      'foto'        => new sfValidatorString(array('max_length' => 250)),
      'info_url'    => new sfValidatorString(array('max_length' => 250)),
      'mostrar'     => new sfValidatorBoolean(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('plan[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'plan';
  }

}
