<?php

/**
 * suscripcion form base class.
 *
 * @method suscripcion getObject() Returns the current form's model object
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesuscripcionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'fecha_alta'    => new sfWidgetFormDate(),
      'fecha_vence'   => new sfWidgetFormDate(),
      'fecha_baja'    => new sfWidgetFormDate(),
      'nro'           => new sfWidgetFormInputText(),
      'suscriptor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('suscriptor'), 'add_empty' => false)),
      'productor_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('productor'), 'add_empty' => false)),
      'codigo'        => new sfWidgetFormInputText(),
      'diacobro'      => new sfWidgetFormInputText(),
      'plan'          => new sfWidgetFormInputText(),
      'valor_cuota'   => new sfWidgetFormInputText(),
      'cant_cuotas'   => new sfWidgetFormInputText(),
      'sorteo'        => new sfWidgetFormInputText(),
      'obs'           => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fecha_alta'    => new sfValidatorDate(array('required' => false)),
      'fecha_vence'   => new sfValidatorDate(array('required' => false)),
      'fecha_baja'    => new sfValidatorDate(array('required' => false)),
      'nro'           => new sfValidatorInteger(),
      'suscriptor_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('suscriptor'))),
      'productor_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('productor'))),
      'codigo'        => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'diacobro'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'plan'          => new sfValidatorString(array('max_length' => 100)),
      'valor_cuota'   => new sfValidatorNumber(array('required' => false)),
      'cant_cuotas'   => new sfValidatorInteger(array('required' => false)),
      'sorteo'        => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'obs'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'suscripcion', 'column' => array('nro')))
    );

    $this->widgetSchema->setNameFormat('suscripcion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'suscripcion';
  }

}
