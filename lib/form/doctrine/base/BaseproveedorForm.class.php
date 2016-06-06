<?php

/**
 * proveedor form base class.
 *
 * @method proveedor getObject() Returns the current form's model object
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseproveedorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'razon_social'     => new sfWidgetFormInputText(),
      'nro_cuit'         => new sfWidgetFormInputText(),
      'iva_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('cond_iva'), 'add_empty' => false)),
      'iibb'             => new sfWidgetFormInputText(),
      'domicilio'        => new sfWidgetFormInputText(),
      'inicio_actividad' => new sfWidgetFormDate(),
      'usuario_id'       => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'razon_social'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nro_cuit'         => new sfValidatorString(array('max_length' => 255)),
      'iva_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('cond_iva'))),
      'iibb'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'domicilio'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'inicio_actividad' => new sfValidatorDate(array('required' => false)),
      'usuario_id'       => new sfValidatorInteger(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'proveedor', 'column' => array('nro_cuit')))
    );

    $this->widgetSchema->setNameFormat('proveedor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'proveedor';
  }

}
