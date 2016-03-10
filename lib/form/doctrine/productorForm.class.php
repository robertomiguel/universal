<?php

/**
 * productor form.
 *
 * @package    universal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productorForm extends BaseproductorForm
{
  public function configure()
  {
    $this->setDefault('created_at', date("Y-m-d G:i"));
$this->setDefault('updated_at', date("Y-m-d G:i"));
//buscar el codigo mas alto y le suma 1
$ultimoid = Doctrine_Query::create()
       ->select("MAX(codigo) as ultimaid" )
       ->from("productor")->execute();
$uid = $ultimoid[0]["ultimaid"] + 1;

$this->setDefault('codigo', "$uid");
/*
$this->setDefault('fingreso', date('Y-m-d'));

$years = range(date('Y'), 2000);
$this->widgetSchema['fingreso'] = new sfWidgetFormDate(array('format' => '%day%/%month%/%year%',
'years'=>array_combine($years, $years)));
*/
$this->widgetSchema->setLabels(array(
	'codigo' => 'Código',
        'tel'  => 'Teléfono fijo',
       ));

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
$this->widgetSchema->setPositions(array('id','codigo','apellido','nombre', 'localidad_id',
                          'domicilio','tel','celular','fingreso'));
*/
  }
}
