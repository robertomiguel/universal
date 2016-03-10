<h1 align="center">Lista de Localidades</h1>
<p class="menuTemplate">
&nbsp;<img src="/images/agregar.png"><a class="btn2" href="<?php echo url_for('localidad/new') ?>">Agregar Localidad</a>
</p>
<div align="center">
<form action="<?php url_for('localidad/index') ?>"  method="get">

   <input id="buscar" name="buscar" placeholder="CP o Nombre..."  value="<?php echo $sf_params->get('buscar')?>">
   <input class="btn2" type="submit" value="Buscar"/>

</form>
</div>

<table>
  <thead>
    <tr>
      <th>Provincia</th>
      <th>Localidad</th>
      <th>CP</th>
    </tr>
  </thead>
  <tbody>

	<?php foreach ($pager->getResults() as $lista): ?>
 <tr>
  <td><?php echo $lista->getProvincia() ?></td>
  <td><?php echo $lista->getNombre() ?></td>
  <td><?php echo $lista->getCp() ?></td>
  <td><a class="btn2" href="<?php echo url_for('localidad/edit?id='.$lista->getId()) ?>">Editar</a></td>
 </tr>
	<?php endforeach; ?>
  </tbody>
</table>	 
	<div>
	<?php echo link_to('Primero', 'localidad/index?page='.$pager->getFirstPage()."&buscar=$buscar") ?>

 
	<?php if ($pager->haveToPaginate()): ?>
	<?php $links = $pager->getLinks(); foreach ($links as $page): ?>

	<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'localidad/index?page='.$page."&buscar=$buscar") ?>

	<?php endforeach ?>
	<?php endif ?>
	<?php echo link_to('Último', 'localidad/index?page='.$pager->getLastPage()."&buscar=$buscar") ?>
	</div>
