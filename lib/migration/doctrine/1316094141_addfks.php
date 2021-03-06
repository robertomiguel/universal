<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addfks extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('cuota', 'cuota_suscripcion_id_suscripcion_id', array(
             'name' => 'cuota_suscripcion_id_suscripcion_id',
             'local' => 'suscripcion_id',
             'foreign' => 'id',
             'foreignTable' => 'suscripcion',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('cuotas', 'cuotas_suscripcion_id_suscripcion_id', array(
             'name' => 'cuotas_suscripcion_id_suscripcion_id',
             'local' => 'suscripcion_id',
             'foreign' => 'id',
             'foreignTable' => 'suscripcion',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('localidad', 'localidad_provincia_id_provincia_id', array(
             'name' => 'localidad_provincia_id_provincia_id',
             'local' => 'provincia_id',
             'foreign' => 'id',
             'foreignTable' => 'provincia',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('plan', 'plan_rubro_id_rubro_id', array(
             'name' => 'plan_rubro_id_rubro_id',
             'local' => 'rubro_id',
             'foreign' => 'id',
             'foreignTable' => 'rubro',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('productor', 'productor_localidad_id_localidad_id', array(
             'name' => 'productor_localidad_id_localidad_id',
             'local' => 'localidad_id',
             'foreign' => 'id',
             'foreignTable' => 'localidad',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('suscripcion', 'suscripcion_plan_id_plan_id', array(
             'name' => 'suscripcion_plan_id_plan_id',
             'local' => 'plan_id',
             'foreign' => 'id',
             'foreignTable' => 'plan',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('suscripcion', 'suscripcion_suscriptor_id_suscriptor_id', array(
             'name' => 'suscripcion_suscriptor_id_suscriptor_id',
             'local' => 'suscriptor_id',
             'foreign' => 'id',
             'foreignTable' => 'suscriptor',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('suscripcion', 'suscripcion_productor_id_productor_id', array(
             'name' => 'suscripcion_productor_id_productor_id',
             'local' => 'productor_id',
             'foreign' => 'id',
             'foreignTable' => 'productor',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('suscriptor', 'suscriptor_localidad_id_localidad_id', array(
             'name' => 'suscriptor_localidad_id_localidad_id',
             'local' => 'localidad_id',
             'foreign' => 'id',
             'foreignTable' => 'localidad',
             'onUpdate' => NULL,
             'onDelete' => 'CASCADE',
             ));
    }

    public function down()
    {
        $this->dropForeignKey('cuota', 'cuota_suscripcion_id_suscripcion_id');
        $this->dropForeignKey('cuotas', 'cuotas_suscripcion_id_suscripcion_id');
        $this->dropForeignKey('localidad', 'localidad_provincia_id_provincia_id');
        $this->dropForeignKey('plan', 'plan_rubro_id_rubro_id');
        $this->dropForeignKey('productor', 'productor_localidad_id_localidad_id');
        $this->dropForeignKey('suscripcion', 'suscripcion_plan_id_plan_id');
        $this->dropForeignKey('suscripcion', 'suscripcion_suscriptor_id_suscriptor_id');
        $this->dropForeignKey('suscripcion', 'suscripcion_productor_id_productor_id');
        $this->dropForeignKey('suscriptor', 'suscriptor_localidad_id_localidad_id');
    }
}