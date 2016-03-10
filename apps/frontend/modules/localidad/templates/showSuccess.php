<h1 align="center">Detalle de Localidad</h1>
<table>
  <tbody>
    <tr>
      <th>Provincia:</th>
      <td><?php echo $localidad->getProvincia() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $localidad->getNombre() ?></td>
    </tr>
    <tr>
      <th>CP:</th>
      <td><?php echo $localidad->getCp() ?></td>
    </tr>
  </tbody>
</table>

<hr />
<a class="btn2" href="javascript:history.back()"><img src="/images/volver.gif"> Volver</a>
<a class="btn2" href="<?php echo url_for('localidad/edit?id='.$localidad->getId()) ?>"><img src="/images/editar.png"> Editar</a>

