<?php

/**
 * Baseinformectb
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property date $fecha_informe
 * @property integer $suscripcion_id
 * 
 * @method date       getFechaInforme()   Returns the current record's "fecha_informe" value
 * @method integer    getSuscripcionId()  Returns the current record's "suscripcion_id" value
 * @method informectb setFechaInforme()   Sets the current record's "fecha_informe" value
 * @method informectb setSuscripcionId()  Sets the current record's "suscripcion_id" value
 * 
 * @package    universal
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Baseinformectb extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('informectb');
        $this->hasColumn('fecha_informe', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('suscripcion_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}