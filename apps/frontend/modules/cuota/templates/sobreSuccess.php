<?php decorate_with(false);
$nombre = $sobre->getApellido()." ".$sobre->getNombre();
$direccion = $sobre->getDomicilio();
$localidad = "(".$sobre->getLocalidad()->getCp().") ".
             $sobre->getLocalidad()->getNombre();
$provincia = $sobre->getLocalidad()->getProvincia()->getNombre();
$localidad = "CP ".ucwords(strtolower($localidad));
$provincia = ucwords(strtolower($provincia));
?>
<div class="sobre">
<?php echo $nombre; ?><br><br>
<?php echo $direccion; ?><br><br>
<?php echo $localidad; ?><br><br>
<?php echo $provincia; ?>
</div>
