<h3 class="centrar">Información del Proveedor</h3>
<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $proveedor->getId() ?></td>
    </tr>
    <tr>
      <th>Razón social:</th>
      <td><?php echo $proveedor->getRazonSocial() ?></td>
    </tr>
    <tr>
      <th>Nro cuit:</th>
      <td><?php echo $proveedor->getNroCuit() ?></td>
    </tr>
    <tr>
      <th>Cond iva:</th>
      <td><?php echo $proveedor->getCondIva() ?></td>
    </tr>
    <tr>
      <th>IIBB:</th>
      <td><?php echo $proveedor->getIibb() ?></td>
    </tr>
    <tr>
      <th>Domicilio:</th>
      <td><?php echo $proveedor->getDomicilio() ?></td>
    </tr>
    <tr>
      <th>Inicio actividad:</th>
      <td><?php echo Formatos::fecha($proveedor->getInicioActividad()) ?></td>
    </tr>
    <tr>
      <th>Alta:</th>
      <td><?php echo Formatos::fecha($proveedor->getCreatedAt()) ?></td>
    </tr>
    <tr>
      <th>Modificado:</th>
      <td><?php echo Formatos::fecha($proveedor->getUpdatedAt()) ?></td>
    </tr>
    <tr>
      <th>Usuario Modifica:</th>
      <td><?php echo Formatos::usuarioNombre($proveedor->getUsuarioId()); ?>
      </td>
    </tr>

  </tbody>
</table>

<hr />

<a href="<?php echo url_for('proveedor/edit?id='.$proveedor->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('proveedor/index') ?>">List</a>
