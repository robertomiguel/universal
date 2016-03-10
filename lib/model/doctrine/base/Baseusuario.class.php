<?php

/**
 * Baseusuario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $nombre
 * @property integer $sf_guard_user_id
 * @property sfGuardUser $User
 * 
 * @method string      getNombre()           Returns the current record's "nombre" value
 * @method integer     getSfGuardUserId()    Returns the current record's "sf_guard_user_id" value
 * @method sfGuardUser getUser()             Returns the current record's "User" value
 * @method usuario     setNombre()           Sets the current record's "nombre" value
 * @method usuario     setSfGuardUserId()    Sets the current record's "sf_guard_user_id" value
 * @method usuario     setUser()             Sets the current record's "User" value
 * 
 * @package    universal
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Baseusuario extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('usuario');
        $this->hasColumn('nombre', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('sf_guard_user_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'sf_guard_user_id',
             'foreign' => 'id'));
    }
}