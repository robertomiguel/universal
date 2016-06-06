<?php

/**
 * suscriptor form.
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class suscriptorForm extends BasesuscriptorForm
{
  public function configure()
  {
    $this->widgetSchema['usuario_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['created_at'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['updated_at'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['activo'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['obs'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['sf_guard_user_id'] = new sfWidgetFormInputHidden();

    $years = range(date('Y'), 1900);
    $this->widgetSchema['nacimiento'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
    'years'=>array_combine($years, $years)));

    $this->setDefault('created_at', date("Y-m-d G:i"));
    $this->setDefault('updated_at', date("Y-m-d G:i"));


    //---------- leer valor pasado por GET
    //$this->setDefault('localidad_id', sfContext::getInstance()->getRequest()->getParameter('id'));

    //$this->widgetSchema['tipodni'] = new sfWidgetFormSelect(array('choices' => array('DNI'=>'DNI',
    //'LC'=>'LC','LE'=>'LE')));

    /*
    //buscar el codigo mas alto y le suma 1
    $ultimoid = Doctrine_Query::create()
           ->select("MAX(codigo) as ultimaid" )
           ->from("suscriptor")->execute();
    $uid = $ultimoid[0]["ultimaid"] + 1;

    $this->setDefault('codigo', "$uid");
    $this->setDefault('fingreso', date('Y-m-d'));
    $years = range(date('Y'), 2000);
    $this->widgetSchema['fingreso'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
    'years'=>array_combine($years, $years)));
    */

    $this->widgetSchema->setLabels(array(
    //	'codigo' => 'Cód. Suscriptor',
            //'tipodni'  => 'Tipo Doc.',
            'tel'  => 'Teléfono fijo',
           'conyuge'  => 'Cónyuge'));

    //unSet($this['fegreso']);
    //----------------- autocompletado
      $this->widgetSchema['localidad_id']->setOption(
         'renderer_class',
         'sfWidgetFormDoctrineJQueryAutocompleter'
      );
     
      $this->widgetSchema['localidad_id']->setOption(
        'renderer_options', 
        array(
    	  'model' => 'localidad',
    	  'url'   => '/localidad/buscarLocalidad',
    	)
      );
    /*
    //----------------- ordenar
    $this->widgetSchema->setPositions(array('id','codigo','apellido','nombre', 'tipodni','dni','localidad_id',
                              'domicilio','tel','celular','conyuge','fingreso','fegreso','activo'));
    */
  }
}
