<script>
jQuery(document).ready(function($)
{
if(!$.cookie('orden-suscriptor')){$.cookie('orden-suscriptor', '1,0');}
var orden = $.cookie('orden-suscriptor').split(",");
if (orden==""){orden[0]=1;orden[1]=0;}
$("#ordenar").tablesorter( {sortList: [[orden[0],orden[1]]]} );
$('#ordenar').tableScroll({height:500});
});
</script>
<h1 align="center">Lista de Clientes</h1>
<div class="menuTemplate">
&nbsp;<a class="btn" title="Agrega un nuevo suscriptor" href="<?php echo url_for('suscriptor/new') ?>"><img src="/images/agregar.png"> Agregar Cliente</a>
-&nbsp;<a class="btn" title="Ver los <?php echo $totales ?> suscriptores cargados" href="<?php echo url_for('suscriptor/index') ?>"><img src="/images/ver.png"> Totales (<?php echo $totales ?>)</a>
-&nbsp;<a class="btn" title="Ver los <?php echo $activos ?> suscriptores activos" href="<?php echo url_for('suscriptor/index?ver=activos') ?>"><img src="/images/si.gif"> Activos (<?php echo $activos ?>)</a>
-&nbsp;<a class="btn" title="Ver los <?php echo $totalinactivos ?> suscriptores inactivos" href="<?php echo url_for('suscriptor/index?ver=inactivos') ?>"><img src="/images/no.png"> inactivos (<?php echo $totalinactivos ?>)</a>
</div>
<div align="center">
<form action="<?php url_for('suscriptor/index') ?>"  method="get">

   <input id="buscar" name="buscar" placeholder="Nombre, Ciudad, Tel"  value="<?php echo $sf_params->get('buscar')?>">
   <input class="btn2" type="submit" value="Buscar" />

</form>
</div>
<table id="ordenar">
  <thead>
    <tr>
      <th onclick="setordensuscriptor(this)">Nombre</th>
      <th onclick="setordensuscriptor(this)">Tel. fijo</th>
      <th onclick="setordensuscriptor(this)">Celular</th>
      <th onclick="setordensuscriptor(this)">Localidad</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>

<?php foreach($respuesta as $campo): ?>
<tr>
    <td><a href="<?php echo url_for('suscriptor/show?id='.$campo->getId()) ?>" ><?php echo $campo->getNombrefull() ?></a></td>
    <td><?php echo $campo->getTel() ?></td>
    <td><?php echo $campo->getCelular(); ?></td>
    <td><?php echo $campo->getLocalidad(); ?></td>
    <td align="center"><a class="btn2" href="<?php echo url_for('suscripcion/index?sid='.$campo->getId()) ?>">Ver Suscripciones</a>
    <a class="btn2" href="<?php echo url_for('suscriptor/edit?id='.$campo->getId()) ?>">Editar</a></td>
</tr>

<?php endforeach;
  if (count($respuesta)==0 && $sf_params->get('buscar')<>"") {echo "'".$sf_params->get('buscar') ."' no existe!";}
?>

  </tbody>
</table>
