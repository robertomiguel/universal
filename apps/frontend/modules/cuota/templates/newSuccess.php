<h1 align="center">Nueva Cuota</h1>

<?php
$nrosuscrip = Doctrine::getTable('suscripcion')->find($sf_params->get('id'))->getNro();
$planid =  Doctrine::getTable('suscripcion')->find($sf_params->get('id'))->getPlanId();
$valorcuota =  Doctrine::getTable('plan')->find($planid)->getValorCuota();
$plan =  Doctrine::getTable('plan')->find($planid)->getCodigo();
$plan = $plan ." - " .  Doctrine::getTable('plan')->find($planid)->getDescripcion();

?>
<table>
<tr>
<th style="width:200px">Nro. Suscrip.:</th><td><?php echo $nrosuscrip; ?></td>
</tr>
<tr>
<th>Plan:</th><td><?php echo $plan; ?></td>
</tr>
<tr>
<th>Valor cuota:</th><td><?php echo Formatos::moneda($valorcuota); ?></td>
</tr>

</table>


<?php include_partial('form', array('form' => $form)) ?>
