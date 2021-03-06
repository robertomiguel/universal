<?php

/**
 * localidadTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class localidadTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object localidadTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('localidad');
    }

//--- autocompletado
public function retrieveForSelect($q, $limit)
  {

$qq = Doctrine_Query::create()
       ->select("l.id, concat(l.cp,' ',l.nombre,' ', p.nombre) as todo" )
       ->from("localidad l")
       ->leftJoin("l.provincia p")
       ->where('l.cp =?', $q)
       ->orWhere('l.nombre LIKE ?', "%$q%")
       ->limit($limit)->execute();
 
    return $qq->toKeyValueArray('id','todo');

}

}
