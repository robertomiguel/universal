<?php

/**
 * suscriptor form base class.
 *
 * @method suscriptor getObject() Returns the current form's model object
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesuscriptorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'localidad_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('localidad'), 'add_empty' => false)),
      'dni'                => new sfWidgetFormInputText(),
      'apellido'           => new sfWidgetFormInputText(),
      'nombre'             => new sfWidgetFormInputText(),
      'nacimiento'         => new sfWidgetFormDate(),
      'domicilio'          => new sfWidgetFormInputText(),
      'tel'                => new sfWidgetFormInputText(),
      'celular'            => new sfWidgetFormInputText(),
      'conyuge'            => new sfWidgetFormInputText(),
      'activo'             => new sfWidgetFormInputCheckbox(),
      'obs'                => new sfWidgetFormInputText(),
      'sf_guard_user_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'usr_nombre'         => new sfWidgetFormInputText(),
      'usr_clave'          => new sfWidgetFormInputText(),
      'usr_recordar_token' => new sfWidgetFormInputText(),
      'usr_estado'         => new sfWidgetFormInputText(),
      'usr_permiso'        => new sfWidgetFormInputText(),
      'usr_grupo'          => new sfWidgetFormInputText(),
      'usr_fecha_acceso'   => new sfWidgetFormDate(),
      'usr_ip'             => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'localidad_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('localidad'))),
      'dni'                => new sfValidatorString(array('max_length' => 8)),
      'apellido'           => new sfValidatorString(array('max_length' => 50)),
      'nombre'             => new sfValidatorString(array('max_length' => 50)),
      'nacimiento'         => new sfValidatorDate(array('required' => false)),
      'domicilio'          => new sfValidatorString(array('max_length' => 100)),
      'tel'                => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'celular'            => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'conyuge'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'activo'             => new sfValidatorBoolean(array('required' => false)),
      'obs'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'sf_guard_user_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'usr_nombre'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'usr_clave'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'usr_recordar_token' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'usr_estado'         => new sfValidatorInteger(array('required' => false)),
      'usr_permiso'        => new sfValidatorInteger(array('required' => false)),
      'usr_grupo'          => new sfValidatorInteger(array('required' => false)),
      'usr_fecha_acceso'   => new sfValidatorDate(array('required' => false)),
      'usr_ip'             => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'suscriptor', 'column' => array('dni'))),
        new sfValidatorDoctrineUnique(array('model' => 'suscriptor', 'column' => array('usr_nombre'))),
      ))
    );

    $this->widgetSchema->setNameFormat('suscriptor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'suscriptor';
  }

}
