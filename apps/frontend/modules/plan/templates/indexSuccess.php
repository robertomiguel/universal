<script>
jQuery(document).ready(function($)
{
if(!$.cookie('orden-plan')){$.cookie('orden-plan', '0,0');}
var orden = $.cookie('orden-plan').split(",");
if (orden==""){orden[0]=1;orden[1]=0;}
$("#ordenar").tablesorter( {sortList: [[orden[0],orden[1]]]} );
$('#ordenar').tableScroll({height:500});
});
</script>
<h1 align="center">Lista de Planes</h1>
<div class="menuTemplate">
&nbsp; <a href="<?php echo url_for('plan/new?rubro='.$rubroSel) ?>"><img src="/images/agregar.png"> Agregar Plan</a>
</div>
<div align="center">
<form action="<?php url_for('plan/index') ?>"  method="get">
Rubro: <select name="rubro" onChange="liquidacion();">
<option value="0">Todos</option>
<?php foreach($rubros as $rubro):
if ($rubroSel==$rubro->getId()){$seleccion='selected';} else {$seleccion='';}
 ?>
<option <?php echo $seleccion ?> value="<?php echo $rubro->getId(); ?>"><?php echo $rubro->getNombre(); ?></option>
<?php endforeach; ?>
</select><br>
 <input id="buscar" name="buscar" placeholder="Código o Descripción..."  value="<?php echo $b=$sf_params->get('buscar') ?>">
 <input type="submit" value="" id="lupa">
</form>
</div>

<table id="ordenar">
  <thead>
    <tr>
<?php
if ($rubroSel=="" || $rubroSel=="0"){
  echo '<th width="140px">Rubro</th>';}
?>

      <th onclick="setordenplan(this)" width="30px">Cód</th>
      <th onclick="setordenplan(this)" width="auto">Descripción</th>
<!--      <th onclick="setordenplan(this)" width="110px">V. Nominal</th>
      <th onclick="setordenplan(this)" width="110px">V. Cuota</th>-->
      <th width="80px"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($respuesta as $plan): ?>
    <tr>
<?php
if ($rubroSel=="" || $rubroSel=="0"){
echo "<td>".$plan->getRubro()."</td>";}
?>
      <td><?php echo strtoupper($plan->getDescripcion()) ?></a></td>
<!--      <td align="right"><?php echo Formatos::moneda($plan->getValorNominal()) ?></td>
      <td align="right"><?php echo Formatos::moneda($plan->getValorCuota()) ?></td>
      <td><a title="Nuevo plan con esta descripción" href="<?php echo url_for('plan/new?id='.$plan->getId()) ?>"><img src="/images/copiar.png"></a>-->
      <td align="center"><?php echo $plan->getValorCuota() ?></td>
      <td><a title="Crear Suscripción con este plan" href="<?php echo url_for('suscripcion/new?id='.$plan->getId()) ?>"><img src="/images/m1.png"></a>
      <a title="Ver detalles de plan" href="<?php echo url_for('plan/show?id='.$plan->getId()) ?>"><img src="/images/ver.png"></a>
      <a title="Editar Plan" href="<?php echo url_for('plan/edit?id='.$plan->getId()) ?>"><img src="/images/editar.png"></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<hr/>
<center><b>Totales: <?php echo count($respuesta) ?></b></center>

