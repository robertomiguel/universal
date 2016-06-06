<?php

/**
 * Basecondiva
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $nombre
 * @property Doctrine_Collection $condivaAlias
 * 
 * @method string              getNombre()       Returns the current record's "nombre" value
 * @method Doctrine_Collection getCondivaAlias() Returns the current record's "condivaAlias" collection
 * @method condiva             setNombre()       Sets the current record's "nombre" value
 * @method condiva             setCondivaAlias() Sets the current record's "condivaAlias" collection
 * 
 * @package    universal
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Basecondiva extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('condiva');
        $this->hasColumn('nombre', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('proveedor as condivaAlias', array(
             'local' => 'id',
             'foreign' => 'condiva_id'));
    }
}