<h1 align="center">Detalle del Plan</h1>
<table>
  <tbody>
    <tr>
      <th style="width:200px">Rubro:</th>
      <td><?php echo $plan->getRubro() ?></td>
    </tr>
    <tr>
      <th>Código:</th>
      <td><?php echo $plan->getCodigo() ?></td>
    </tr>
    <tr>
      <th>Descripción:</th>
      <td><?php echo $plan->getDescripcion() ?></td>
    </tr>
    <tr>
      <th>Valor nominal:</th>
      <td><?php echo Formatos::moneda($plan->getValorNominal()) ?></td>
    </tr>
    <tr>
      <th>Valor cuota:</th>
      <td><?php echo Formatos::moneda($plan->getValorCuota()) ?></td>
    </tr>
    <tr>
      <th>Cant. cuotas:</th>
      <td><?php echo $plan->getCantCuotas() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="javascript:history.back()"><img src="/images/volver.gif"> Volver</a>
-&nbsp;<a href="<?php echo url_for('suscripcion/index?plid='.$plan->getId()) ?>"><img src="/images/m1.png"> Suscripciones (<?php echo $totalsuscripciones; ?>)</a>
-&nbsp;
<a href="<?php echo url_for('plan/edit?id='.$plan->getId()) ?>"><img src="/images/editar.png"> Editar</a>

