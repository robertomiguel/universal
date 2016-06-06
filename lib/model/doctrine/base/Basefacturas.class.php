<?php

/**
 * Basefacturas
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $prov_id
 * @property string $nro
 * @property date $pago
 * @property date $vencimiento
 * @property decimal $importe
 * @property integer $tipo_id
 * @property integer $estado_id
 * @property string $obs
 * @property integer $usuario_id
 * @property proveedor $proveedor
 * @property fac_estado $fac_estado
 * @property fac_tipo $fac_tipo
 * 
 * @method integer    getProvId()      Returns the current record's "prov_id" value
 * @method string     getNro()         Returns the current record's "nro" value
 * @method date       getPago()        Returns the current record's "pago" value
 * @method date       getVencimiento() Returns the current record's "vencimiento" value
 * @method decimal    getImporte()     Returns the current record's "importe" value
 * @method integer    getTipoId()      Returns the current record's "tipo_id" value
 * @method integer    getEstadoId()    Returns the current record's "estado_id" value
 * @method string     getObs()         Returns the current record's "obs" value
 * @method integer    getUsuarioId()   Returns the current record's "usuario_id" value
 * @method proveedor  getProveedor()   Returns the current record's "proveedor" value
 * @method fac_estado getFacEstado()   Returns the current record's "fac_estado" value
 * @method fac_tipo   getFacTipo()     Returns the current record's "fac_tipo" value
 * @method facturas   setProvId()      Sets the current record's "prov_id" value
 * @method facturas   setNro()         Sets the current record's "nro" value
 * @method facturas   setPago()        Sets the current record's "pago" value
 * @method facturas   setVencimiento() Sets the current record's "vencimiento" value
 * @method facturas   setImporte()     Sets the current record's "importe" value
 * @method facturas   setTipoId()      Sets the current record's "tipo_id" value
 * @method facturas   setEstadoId()    Sets the current record's "estado_id" value
 * @method facturas   setObs()         Sets the current record's "obs" value
 * @method facturas   setUsuarioId()   Sets the current record's "usuario_id" value
 * @method facturas   setProveedor()   Sets the current record's "proveedor" value
 * @method facturas   setFacEstado()   Sets the current record's "fac_estado" value
 * @method facturas   setFacTipo()     Sets the current record's "fac_tipo" value
 * 
 * @package    universal
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Basefacturas extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('facturas');
        $this->hasColumn('prov_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('nro', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('pago', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('vencimiento', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('importe', 'decimal', 10, array(
             'type' => 'decimal',
             'scale' => 2,
             'default' => 0,
             'length' => 10,
             ));
        $this->hasColumn('tipo_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('estado_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('obs', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('usuario_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('proveedor', array(
             'local' => 'prov_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('fac_estado', array(
             'local' => 'estado_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('fac_tipo', array(
             'local' => 'tipo_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}