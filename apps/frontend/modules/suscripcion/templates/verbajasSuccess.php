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
<div class="menuTemplate" align="center">
<b>B A J A S</b>
</div>
<table id="ordenar">
  <thead>
    <tr>
      <th onclick="setordensuscripcion(this)">Solicitud</th>
      <th onclick="setordensuscripcion(this)">Plan</th>
      <th onclick="setordensuscripcion(this)">Suscriptor</th>
      <th onclick="setordensuscripcion(this)">Localidad</th>
      <th onclick="setordensuscripcion(this)">Fecha Baja</th>
      <th onclick="setordensuscripcion(this)">Cuota</th>
      <th>Resumen</th>
      <th>Editar</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($respuesta as $suscripcion): ?>
    <tr>
      <td><?php echo $suscripcion->getNro() ?></td>
      <td><?php echo $suscripcion->getPlan() ?><br>
        <textarea id="obs<?php echo $suscripcion->getId() ?>" style="font-size:12px" rows="3" maxlength="255"><?php echo $suscripcion->getObs() ?></textarea>
  <a class="btn2" href="javascript:grabarObs(<?php echo $suscripcion->getId() ?>)">Grabar</a>


      </td>
      <td><a href="/suscriptor/show/id/<?php echo $suscripcion->getSuscriptorId() ?>">
        <?php echo $suscripcion->getSuscriptor() ?></a>
        <br><?php echo $suscripcion->getProductor() ?>
      </td>
      <td><?php echo $suscripcion->getSuscriptor()->getLocalidad() ?></td>
      <td><?php echo Formatos::fecha($suscripcion->getFechaBaja()) ?></td>
      <td><?php echo Formatos::moneda($suscripcion->getValorCuota()) ?></td>      
      <td align="center"><a class="btn2" href="<?php echo url_for('cuota/index?id=') . $suscripcion->getId() ?>">Ver Cuotas</a>
      <a class="btn2" href="<?php echo url_for('suscripcion/edit?id='.$suscripcion->getId()) ?>">Editar</a>
      <a class="btn2" href="javascript:activar(<?php echo $suscripcion->getId(); ?>)">Activar</a></td>
    </tr>
    <?php 
    $total = $total + $suscripcion->getValorCuota();
    endforeach; ?>
  </tbody>
</table>
<hr/>
<center><b>Totales: <?php echo count($respuesta) . " / Total: ".Formatos::moneda($total);?></b></center>

<script>
function grabarObs(id) {
  var texto = $("#obs"+id).val();
 $.post("/suscripcion/grabarobs",
  {
    id:id,
    texto:texto
  },
  function(data){
    alert(data);
  });

}
function activar(id){
  var x = confirm("¿Cancelar suscripción?");
if(x){
$.post("/suscripcion/activar",
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