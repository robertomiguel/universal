<h1 align="center">Detalle de la Cuota</h1>
<table>
  <tbody>
    <tr>
      <th style="width:200px">Suscripción:</th>
      <td><?php echo $cuota->getSuscripcion() ?></td>
    </tr>
    <tr>
      <th>Importe:</th>
      <td><?php echo Formatos::moneda($cuota->getImporte()) ?></td>
    </tr>
    <tr>
      <th>Fecha Emisión:</th>
      <td><?php echo Formatos::fecha($cuota->getFemision()) ?></td>
    </tr>
    <tr>
      <th>F Vencimiento:</th>
      <td><?php echo Formatos::fecha($cuota->getFvencimiento()) ?></td>
    </tr>
    <tr>
      <th>Fecha Pago:</th>
      <td><?php echo Formatos::fecha($cuota->getFpago()) ?></td>
    </tr>
  </tbody>
</table>

<hr />
<a href="javascript:history.back()"><img src="/images/volver.gif"> Volver</a>
-&nbsp;
<a href="<?php echo url_for('cuota/edit?id='.$cuota->getId()) ?>"><img src="/images/editar.png"> Editar/Pagar</a>
-&nbsp;
<a href="<?php echo url_for('cuota/index?id='.$cuota->getSuscripcionId()) ?>"><img src="/images/ver.png"> Ver Cuotas</a>

