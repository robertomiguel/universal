<h1 align="center">Detalle de la Suscripción</h1>
<table>
  <tbody>
    <tr>
      <th>Nro. Solicitud:</th>
      <td><?php echo $suscripcion->getNro() ?></td>
    </tr>
    <tr>
      <th style="width:200px">Plan:</th>
      <td><?php echo $suscripcion->getPlan() ?></td>
    </tr>
    <tr>
      <th style="width:200px">Cuota:</th>
      <td><?php echo Formatos::moneda($suscripcion->getValorCuota()) ?></td>
    </tr>
    <tr>
      <th style="width:200px">Cant Cuotas</th>
      <td><?php echo $suscripcion->getCantCuotas() ?></td>
    </tr>
    <tr>
      <th>Suscriptor:</th>
      <td><a href="<?php echo url_for('suscriptor/show?id='. $suscripcion->getSuscriptorId()) ?>"><?php echo $suscripcion->getSuscriptor() ?></a></td>
    </tr>
    <tr>
      <th>Productor:</th>
      <td><a href="<?php echo url_for('productor/show?id='. $suscripcion->getProductorId()) ?>"><?php echo $suscripcion->getProductor() ?></a></td>
    </tr>
    <tr>
      <th>Fecha Alta:</th>
      <td><?php echo Formatos::fecha($suscripcion->getFechaAlta()) ?></td>
    </tr>
    <tr>
      <th>Fecha Baja:</th>
      <td><?php echo Formatos::fecha($suscripcion->getFechaBaja()) ?></td>
    </tr>
    <tr>
      <th>Sorteo:</th>
      <td><?php echo $suscripcion->getSorteo() ?></td>
    </tr>
    <tr>
      <th>Usuario Modifica:</th>
      <td><?php echo Formatos::usuarioNombre($suscripcion->getUsuarioId()); ?>
      </td>
    </tr>
    <tr>
      <th>Observaciones:</th>
      <td><textarea readonly><?php echo $suscripcion->getObs() ?></textarea></td>
    </tr>
  </tbody>
</table>

<hr />

<a class="btn2" href="javascript:history.back()"><img src="/images/volver.gif"> Volver</a>
<a class="btn2" href="<?php echo url_for('suscripcion/edit?id='.$suscripcion->getId()) ?>"><img src="/images/editar.png"> Editar</a>

