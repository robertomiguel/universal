<?php

/**
 * suscriptorTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class suscriptorTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object suscriptorTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('suscriptor');
    }

//--- autocompletado
public function retrieveForSelect($q, $limit)
  {

$qq = Doctrine_Query::create()
//       ->select("id, concat(codigo,' ',apellido,' ',nombre) as todo" )
       ->select("s.id as id, CONCAT_WS(' ',s.apellido,s.nombre) as todo" )
       ->from("suscriptor s")
       //->where('s.c =?', $q)
//       ->andWhere('activo = 1')
//       ->orWhere('nombre LIKE ?', "%$q%")
//       ->andWhere('activo = 1')
       ->where('s.apellido LIKE ?', "%$q%")
//       ->andWhere('activo = 1')
       ->limit($limit);
 
    return $qq->execute()->toKeyValueArray('id','todo');
}

//------------ búsqueda desde el suscriptor/index
public function getResultado($buscar){

$respuesta = Doctrine_Query::create()
       ->select("concat(apellido,' ',nombre) as nombrefull,tel,celular")
       ->from("suscriptor s")
	->leftJoin("s.localidad l")
       //->where('codigo =?', $buscar)
       ->where('nombre LIKE ?', "%$buscar%")
       ->orWhere('apellido LIKE ?', "%$buscar%")
       ->orWhere('tel LIKE ?', "%$buscar%")
       ->orWhere('celular LIKE ?', "%$buscar%")
       ->orWhere('l.nombre LIKE ?', "%$buscar%")
	->orderBy('apellido')
	->execute();

return $respuesta;
  }

//---------------- contar inactivos
public function getInactivos(){

$respuesta = Doctrine_Query::create()
       ->select("count(id) as inactivos")
       ->from("suscriptor")
       ->where(' activo =?', 0)->execute();

return $respuesta[0]['inactivos'];
  }

//---------------- contar Totales
public function getTotales(){
$respuesta = Doctrine_Query::create()
       ->select("count(id) as inactivos")
       ->from("suscriptor")->execute();
return $respuesta[0]['inactivos'];
  }

//---------------- Mostrar inactivos=0 o activos=1
public function verActivos($i){

$respuesta = Doctrine_Query::create()
       ->select("concat(apellido,' ',nombre) as nombrefull,tel,celular")
       ->from("suscriptor")
       ->where(' activo =?', $i)->execute();

return $respuesta;
  }

}
