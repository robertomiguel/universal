<h1 class="centrar">Lista de Facturas</h1>

<div class="menuTemplate">
  <a href="<?php echo url_for('facturas/new') ?>" class="btn"><img src="/images/agregar.png"> Nueva Factura</a>
</div>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Proveedor</th>
      <th>Fac. Nro</th>
      <th>Fecha Vencimiento</th>
      <th>Fecha Pago</th>
      <th>Importe</th>
      <th>Tipo factura</th>
      <th>Estado</th>
      <th>Alta</th>
      <th>Modificado</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($facturass as $facturas): ?>
    <tr>
      <td><?php echo $facturas->getId() ?></td>
      <td><?php echo $facturas->getProveedor() ?></td>
      <td><a href="<?php echo url_for('facturas/show?id='.$facturas->getId()) ?>"><?php echo $facturas->getNro() ?></a></td>
      <td align="center"><?php echo Formatos::fecha($facturas->getVencimiento()) ?></td>
      <td align="center"><?php echo Formatos::fecha($facturas->getPago()) ?></td>
      <td align="right"><?php echo Formatos::moneda($facturas->getImporte()) ?></td>
      <td align="center"><?php echo $facturas->getFacTipo() ?></td>
      <td align="center"><?php echo $facturas->getFacEstado() ?></td>
      <td align="center"><?php echo Formatos::fecha($facturas->getCreatedAt()) ?></td>
      <td align="center"><?php echo Formatos::fecha($facturas->getUpdatedAt()) ?></td>
      <td>
          <a href="<?php echo url_for('facturas/edit?id='.$facturas->getId()) ?>" class="btn">Editar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

