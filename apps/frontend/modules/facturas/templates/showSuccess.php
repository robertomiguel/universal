<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $facturas->getId() ?></td>
    </tr>
    <tr>
      <th>Prov:</th>
      <td><?php echo $facturas->getProveedor() ?></td>
    </tr>
    <tr>
      <th>Nro:</th>
      <td><?php echo $facturas->getNro() ?></td>
    </tr>
    <tr>
      <th>Fecha Pago:</th>
      <td><?php echo $facturas->getPago() ?></td>
    </tr>
    <tr>
      <th>Fecha Vencimiento:</th>
      <td><?php echo $facturas->getVencimiento() ?></td>
    </tr>
    <tr>
      <th>Importe:</th>
      <td><?php echo $facturas->getImporte() ?></td>
    </tr>
    <tr>
      <th>Tipo factura:</th>
      <td><?php echo $facturas->getFacTipo() ?></td>
    </tr>
    <tr>
      <th>Estado:</th>
      <td><?php echo $facturas->getFacEstado() ?></td>
    </tr>
    <tr>
      <th>Usuario Modifica:</th>
      <td><?php echo Formatos::usuarioNombre($facturas->getUsuarioId()); ?>
      </td>
    </tr>
    <tr>
      <th>Ingreso:</th>
      <td><?php echo $facturas->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Modificado:</th>
      <td><?php echo $facturas->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('facturas/edit?id='.$facturas->getId()) ?>" class="btn">Editar</a>
&nbsp;
<a href="<?php echo url_for('facturas/index') ?>" class="btn">Lista</a>
