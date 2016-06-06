<?php

/**
 * proveedorTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class proveedorTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object proveedorTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('proveedor');
    }

	//--- autocompletado
	public function retrieveForSelect($q, $limit)
  	{
		$qq = Doctrine_Query::create()
	       ->select("id, concat(nro_cuit,' - ', razon_social) as todo" )
	       ->from("proveedor")
	       ->where('nro_cuit =?', $q)
	       ->orWhere('nro_cuit LIKE ?', "%$q%")
	       ->orWhere('razon_social LIKE ?', "%$q%");
	       //->limit($limit);
		 
	    return $qq->execute()->toKeyValueArray('id','todo');
	}

}