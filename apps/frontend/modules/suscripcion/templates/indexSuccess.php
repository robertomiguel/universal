<script>
jQuery(document).ready(function($)
{
if(!$.cookie('orden-suscripcion')){$.cookie('orden-suscripcion', '0,1');}
var orden = $.cookie('orden-suscripcion').split(",");
if (orden==""){orden[0]=1;orden[1]=0;}
$("#ordenar").tablesorter( {sortList: [[orden[0],orden[1]]] });
$('#ordenar').tableScroll({height:500});
});
</script>
<h1 align="center">Lista de Suscripciones</h1>
<div class="menuTemplate">
&nbsp;  <a class="btn" href="<?php echo url_for('suscripcion/new') ?>"><img src="/images/agregar.png"> Agregar Suscripción</a>
&nbsp;  <a class="btn" href="<?php echo url_for('suscripcion/verbajas') ?>"><img src="/images/no.png"> Bajas (<?php echo $bajas ?>)</a>
&nbsp; <a class="btn" href="<?php echo url_for('imprimir/suscripciones') ?>"><img src="/images/imprimir.gif"> Imprimir Activas</a>
</div>
<div align="center">
<form action="<?php url_for('suscripcion/index') ?>"  method="get">
   <input id="buscar" name="buscar" placeholder="Nro. Solicitud o Apellido..."  value="<?php echo $sf_params->get('buscar')?>">
   <input class="btn2" type="submit" value="Buscar" />
</form>
</div>
<table id="ordenar">
  <thead>
    <tr>
      <th onclick="setordensuscripcion(this)">Solicitud</th>
      <th onclick="setordensuscripcion(this)">Suscriptor / Productor</th>
      <th onclick="setordensuscripcion(this)">Localidad</th>
      <th onclick="setordensuscripcion(this)">Fecha Alta</th>
      <th>Resumen</th>
      <th>Editar</th>
      <th>Cancelar</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($respuesta as $suscripcion): ?>
    <tr>
      <td align="center"><a href="<?php echo url_for('suscripcion/show?id='.$suscripcion->getId()) ?>"><?php echo $suscripcion->getNro() ?></a></td>
      <td>
        <a href="<?php echo url_for('suscriptor/show?id='.$suscripcion->getSuscriptorId()) ?>">
          <?php echo $suscripcion->getSuscriptor() ?></a>
        <br><span style="color:red"><?php echo $suscripcion->getPlan() ?></span>
        <br><em><?php echo $suscripcion->getProductor() ?></em>
      </td>
      <td><?php echo $suscripcion->getSuscriptor()->getLocalidad() ?></td>
      <td align="center"><?php echo Formatos::fecha($suscripcion->getFechaAlta()) ?></td>
      <td align="center"><a class="btn2" href="<?php echo url_for('cuota/index?id=') . $suscripcion->getId() ?>">ver cuotas</a></td>
      <td><a class="btn2" href="<?php echo url_for('suscripcion/edit?id='.$suscripcion->getId()) ?>">editar plan</a></td>
      <td><a class="btn2" href="javascript:bajar(<?php echo $suscripcion->getId(); ?>)">Cancelar</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<hr/>
<center><b>Total: <?php echo count($respuesta);?></b></center>
<script>
function bajar(id){
var x = confirm("¿Cancelar suscripción?");
if(x){
$.post("/suscripcion/bajar",
  {
    id:id
  },
  function(data){
    alert(data);
    window.location.href = window.location.href;
  });  
}

}
</script>