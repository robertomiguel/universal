<h1 class="centrar">Lista de Proveedores</h1>

<div class="menuTemplate">
  <a href="<?php echo url_for('proveedor/new') ?>" class="btn"><img src="/images/agregar.png"> Nuevo Proveedor</a>
</div>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Razón social</th>
      <th>Nro CUIT</th>
      <th>Cond iva</th>
      <th>IIBB</th>
      <th>Domicilio</th>
      <th>Inicio actividad</th>
      <th>Alta</th>
      <th>Modificado</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($proveedors as $proveedor): ?>
    <tr>
      <td><?php echo $proveedor->getId() ?></td>
      <td><a href="<?php echo url_for('proveedor/show?id='.$proveedor->getId()) ?>"><?php echo $proveedor->getRazonSocial() ?></a></td>
      <td><?php echo $proveedor->getNroCuit() ?></td>
      <td><?php echo $proveedor->getCondIva() ?></td>
      <td><?php echo $proveedor->getIibb() ?></td>
      <td><?php echo $proveedor->getDomicilio() ?></td>
      <td align="center"><?php echo Formatos::fecha($proveedor->getInicioActividad()) ?></td>
      <td align="center"><?php echo Formatos::fecha($proveedor->getCreatedAt()) ?></td>
      <td align="center"><?php echo Formatos::fecha($proveedor->getUpdatedAt()) ?></td>
      <td>
        <a href="/proveedor/edit?id=<?php echo $proveedor->getId() ?>" class="btn">Editar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

