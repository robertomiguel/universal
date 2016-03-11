<h1 align="center">Detalle del Suscriptor</h1>

<table>
  <tbody>
    
    <tr>
      <th>Apellido:</th>
      <td><?php echo $suscriptor->getApellido() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $suscriptor->getNombre() ?></td>
    </tr>
    <tr>
      <th>Documento:</th>
      <td><?php echo Formatos::dni($suscriptor->getDni()) ?></td>
    </tr>
    <tr>
      <th style="width:200px">Cód. Postal:</th><td><?php echo $suscriptor->getLocalidad()->getCp(); ?></td>
    </tr>
    <tr>
      <th>Provincia:</th><td><?php echo $suscriptor->getLocalidad()->getProvincia()->getNombre(); ?></td>
    </tr>
    <tr>
      <th>Localidad:</th><td><?php echo $suscriptor->getLocalidad()->getNombre() ?></td>
    </tr>
    <tr>
      <th>Domicilio:</th>
      <td><?php echo $suscriptor->getDomicilio() ?></td>
    </tr>
    <tr>
      <th>Teléfono fijo:</th>
      <td><?php echo $suscriptor->getTel() ?></td>
    </tr>
    <tr>
      <th>Celular:</th>
      <td><?php echo $suscriptor->getCelular() ?></td>
    </tr>
    <tr>
      <th>Cónyuge:</th>
      <td><?php echo $suscriptor->getConyuge() ?></td>
    </tr>
    <tr>
    
    <tr>
      <th>Activo:</th>
      <td><?php echo Formatos::siono($suscriptor->getActivo()) ?></td>
    </tr>
        <tr>
      <td colspan="2"><hr></td>
    </tr>
    <tr>
      <th>Usuario Web</th>
      <td><?php echo $suscriptor->getUsrNombre() ?></td>
    </tr>
    <tr>
      <th>Clave</th>
      <td><?php echo $suscriptor->getUsrClave() ?></td>
    </tr>
    <tr>
      <th>Estado Web</th>
      <td><?php if ($suscriptor->getUsrEstado()==1){
                  echo 'Activo';
        } else {echo 'sin acceso';} ?></td>
    </tr>

  </tbody>
</table>

<hr />
<a class="btn2" href="javascript:history.back()"><img src="/images/volver.gif"> Volver</a>
&nbsp;<a class="btn2" href="<?php echo url_for('suscripcion/index?sid='.$suscriptor->getId()) ?>"><img src="/images/m1.png">  Suscripciones (<?php echo $totalsuscripciones; ?>)</a>
&nbsp;<a class="btn2" href="<?php echo url_for('suscriptor/edit?id='.$suscriptor->getId()) ?>"><img src="/images/editar.png"> Editar</a>
&nbsp;<a class="btn2" href="<?php echo url_for('imprimir/datoscliente?id='.$suscriptor->getId()) ?>"><img src="/images/imprimir.gif"> Imprimir</a>
