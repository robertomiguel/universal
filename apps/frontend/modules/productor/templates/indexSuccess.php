<script>
jQuery(document).ready(function($)
{
if(!$.cookie('orden-productor')){$.cookie('orden-productor', '0,0');}
var orden = $.cookie('orden-productor').split(",");
if (orden==""){orden[0]=1;orden[1]=0;}
$("#ordenar").tablesorter( {sortList: [[orden[0],orden[1]]]} );
$('#ordenar').tableScroll({height:500});
});
</script>
<h1 align="center">Lista de Productores</h1>
<div class="menuTemplate">
&nbsp; <a class="btn" href="<?php echo url_for('productor/new') ?>"><img src="/images/agregar.png"> Agregar Vendedor</a>
</div>
<div align="center">
<form action="<?php url_for('productor/index') ?>"  method="get">
  <input id="buscar" name="codigo" placeholder="Código o Nombre..." value="<?php echo $sf_params->get('codigo')?>">
  <input class="btn2" type="submit" value="Buscar" /></td>
</form>
</div>

<table id="ordenar">
  <thead>
    <tr>
      <th onclick="setordenproductor(this)">Código / Zona</th>
      <th onclick="setordenproductor(this)">Nombre</th>
      <th onclick="setordenproductor(this)">Tel. 1</th>
      <th onclick="setordenproductor(this)">Tel. 2</th>
      <th onclick="setordenproductor(this)">Total Suscrip. Activas</th>
      <th onclick="setordenproductor(this)">Editar</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($respuesta as $campo): ?>
<tr>
    <td align='center'><?php echo $campo->getCodigo() ?> - <?php echo $campo->getZona() ?></td>
    <td><a href="<?php echo url_for('productor/show?id='.$campo->getId()) ?>" ><?php echo $campo->getNombrefull() ?></a></td>
    <td><?php echo $campo['tel'] ?></td>
    <td><?php echo $campo->getCelular(); ?></td>
    <td align="center">
    <a class="btn2"  href="<?php echo url_for('suscripcion/index?pid='.$campo->getId()) ?>">
      Ver: 
      <?PHP 
      $total = Doctrine::getTable('suscripcion')->totalSuscripciones($campo->getId());
      echo Formatos::moneda($total[0]->getTotal());
      echo ' = ';
      echo $total[0]->getCantidad();
      ?>
      
    </a>
    </td>
    <td align="center"><a class="btn2" href="<?php echo url_for('productor/edit?id='.$campo->getId()) ?>">Editar</a></td>
</tr>

    <?php endforeach;
if (count($respuesta)==0 && $sf_params->get('codigo')<>"") {echo "'".$sf_params->get('codigo') ."' no existe!";}
 ?>
  </tbody>
</table>


