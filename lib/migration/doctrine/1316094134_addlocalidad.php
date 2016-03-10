<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addlocalidad extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('localidad', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => 8,
              'autoincrement' => true,
              'primary' => true,
             ),
             'provincia_id' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'length' => 8,
             ),
             'nombre' => 
             array(
              'type' => 'string',
              'notnull' => true,
              'length' => 50,
             ),
             'cp' => 
             array(
              'type' => 'string',
              'notnull' => true,
              'length' => 4,
             ),
             ), array(
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             ));
    }

    public function down()
    {
        $this->dropTable('localidad');
    }
}