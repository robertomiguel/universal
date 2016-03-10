<script>
jQuery(document).ready(function($)
{
if(!$.cookie('orden-rubro')){$.cookie('orden-rubro', '0,0');}
var orden = $.cookie('orden-rubro').split(",");
if (orden==""){orden[0]=1;orden[1]=0;}
$("#ordenar").tablesorter( {sortList: [[orden[0],orden[1]]]} );
$('#ordenar').tableScroll({height:500});
});
</script>
<h1 align="center">Lista de Rubros</h1>
<div class="menuTemplate">
&nbsp; <a href="<?php echo url_for('rubro/new') ?>"><img src="/images/agregar.png"> Agregar Rubro</a>
</div>
<table id="ordenar">
  <thead>
    <tr>
      <th onclick="setordenrubro(this)" style="width:80px;">Rubro</th>
      <th onclick="setordenrubro(this)">Denominación</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rubros as $rubro): ?>
    <tr>
      <td align="center"><?php echo $rubro->getId() ?></td>
      <td><a href="<?php echo url_for('rubro/show?id='.$rubro->getId()) ?>"><?php echo $rubro->getNombre() ?></a></td>
      <td><a href="<?php echo url_for('rubro/edit?id='.$rubro->getId()) ?>"><img src="/images/editar.png"></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>


