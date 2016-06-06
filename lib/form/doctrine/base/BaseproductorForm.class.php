<?php

/**
 * productor form base class.
 *
 * @method productor getObject() Returns the current form's model object
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseproductorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'localidad_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('localidad'), 'add_empty' => false)),
      'codigo'       => new sfWidgetFormInputText(),
      'zona'         => new sfWidgetFormInputText(),
      'apellido'     => new sfWidgetFormInputText(),
      'nombre'       => new sfWidgetFormInputText(),
      'domicilio'    => new sfWidgetFormInputText(),
      'tel'          => new sfWidgetFormInputText(),
      'celular'      => new sfWidgetFormInputText(),
      'usuario_id'   => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'localidad_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('localidad'))),
      'codigo'       => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'zona'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'apellido'     => new sfValidatorString(array('max_length' => 50)),
      'nombre'       => new sfValidatorString(array('max_length' => 50)),
      'domicilio'    => new sfValidatorString(array('max_length' => 100)),
      'tel'          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'celular'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'usuario_id'   => new sfValidatorInteger(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'productor', 'column' => array('codigo')))
    );

    $this->widgetSchema->setNameFormat('productor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'productor';
  }

}
