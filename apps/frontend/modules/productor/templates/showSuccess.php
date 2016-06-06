<?php
$consulta = Doctrine::getTable('localidad')->find($productor->getLocalidadId());
?>
<h1 align="center">Detalle del Productor</h1>
<table>
</table>

<table>
  <tbody>
    <tr>
      <th style="width:200px">Código:</th>
      <td><?php echo $productor->getCodigo() ?></td>
    </tr>
    <tr>
      <th style="width:200px">Zona:</th>
      <td><?php echo $productor->getZona() ?></td>
    </tr>
    <tr>
      <th>Apellido:</th>
      <td><?php echo $productor->getApellido() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $productor->getNombre() ?></td>
    </tr>
    <tr>
      <th style="width:200px">Cód. Postal:</th><td><?php echo $consulta->getCp(); ?></td>
    </tr>
    <tr>
      <th>Provincia:</th><td><?php echo $consulta->getProvincia(); ?></td>
    </tr>
    <tr>
      <th>Localidad:</th><td><?php echo $consulta->getNombre() ?></td>
    </tr>
    <tr>
      <th>Domicilio:</th>
      <td><?php echo $productor->getDomicilio() ?></td>
    </tr>
    <tr>
      <th>Teléfono fijo:</th>
      <td><?php echo $productor->getTel() ?></td>
    </tr>
    <tr>
      <th>Celular:</th>
      <td><?php echo $productor->getCelular() ?></td>
    </tr>
    <tr>
      <th>Usuario Modifica:</th>
      <td><?php echo Formatos::usuarioNombre($productor->getUsuarioId()); ?>
      </td>
    </tr>
  </tbody>
</table>

<hr />
<a href="javascript:history.back()"><img src="/images/volver.gif"> Volver</a>
-&nbsp;<a href="<?php echo url_for('productor/edit?id='.$productor->getId()) ?>"><img src="/images/editar.png"> Editar</a>
