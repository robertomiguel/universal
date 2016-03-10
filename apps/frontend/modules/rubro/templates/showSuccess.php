<table>
  <tbody>
    <tr>
      <th style="width:200px">Rubro:</th>
      <td><?php echo $rubro->getId() ?></td>
    </tr>
    <tr>
      <th>Denominación:</th>
      <td><?php echo $rubro->getNombre() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="javascript:history.back()"><img src="/images/volver.gif"> Volver</a>
-&nbsp;
<a href="<?php echo url_for('rubro/edit?id='.$rubro->getId()) ?>"><img src="/images/editar.png"> Editar</a>

