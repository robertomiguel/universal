<?php

/**
 * cuota form base class.
 *
 * @method cuota getObject() Returns the current form's model object
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasecuotaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'suscripcion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('suscripcion'), 'add_empty' => false)),
      'nro_cuota'      => new sfWidgetFormInputText(),
      'importe'        => new sfWidgetFormInputText(),
      'femision'       => new sfWidgetFormDate(),
      'fvencimiento'   => new sfWidgetFormDate(),
      'fpago'          => new sfWidgetFormDate(),
      'impresa'        => new sfWidgetFormInputCheckbox(),
      'usuario_id'     => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'suscripcion_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('suscripcion'))),
      'nro_cuota'      => new sfValidatorInteger(),
      'importe'        => new sfValidatorNumber(array('required' => false)),
      'femision'       => new sfValidatorDate(array('required' => false)),
      'fvencimiento'   => new sfValidatorDate(array('required' => false)),
      'fpago'          => new sfValidatorDate(array('required' => false)),
      'impresa'        => new sfValidatorBoolean(array('required' => false)),
      'usuario_id'     => new sfValidatorInteger(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('cuota[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'cuota';
  }

}
