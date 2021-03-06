<?php

/**
 * Baseconsulta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $nombre
 * @property string $telefono
 * @property string $email
 * @property integer $plan_id
 * @property string $consulta
 * 
 * @method string   getNombre()   Returns the current record's "nombre" value
 * @method string   getTelefono() Returns the current record's "telefono" value
 * @method string   getEmail()    Returns the current record's "email" value
 * @method integer  getPlanId()   Returns the current record's "plan_id" value
 * @method string   getConsulta() Returns the current record's "consulta" value
 * @method consulta setNombre()   Sets the current record's "nombre" value
 * @method consulta setTelefono() Sets the current record's "telefono" value
 * @method consulta setEmail()    Sets the current record's "email" value
 * @method consulta setPlanId()   Sets the current record's "plan_id" value
 * @method consulta setConsulta() Sets the current record's "consulta" value
 * 
 * @package    universal
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Baseconsulta extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('consulta');
        $this->hasColumn('nombre', 'string', 100, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('telefono', 'string', 30, array(
             'type' => 'string',
             'length' => 30,
             ));
        $this->hasColumn('email', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('plan_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('consulta', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}