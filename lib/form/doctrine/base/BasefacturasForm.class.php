<?php

/**
 * facturas form base class.
 *
 * @method facturas getObject() Returns the current form's model object
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasefacturasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'prov_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('proveedor'), 'add_empty' => false)),
      'nro'         => new sfWidgetFormInputText(),
      'pago'        => new sfWidgetFormDate(),
      'vencimiento' => new sfWidgetFormDate(),
      'importe'     => new sfWidgetFormInputText(),
      'tipo_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('fac_tipo'), 'add_empty' => false)),
      'estado_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('fac_estado'), 'add_empty' => false)),
      'obs'         => new sfWidgetFormInputText(),
      'usuario_id'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'prov_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('proveedor'))),
      'nro'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pago'        => new sfValidatorDate(array('required' => false)),
      'vencimiento' => new sfValidatorDate(array('required' => false)),
      'importe'     => new sfValidatorNumber(array('required' => false)),
      'tipo_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('fac_tipo'))),
      'estado_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('fac_estado'))),
      'obs'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'usuario_id'  => new sfValidatorInteger(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('facturas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'facturas';
  }

}
