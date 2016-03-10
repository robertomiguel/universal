<style>
.lista {font-size:16px;width:80%}
.lista th {background-color:#dbdbdb}
</style>
Período

<form action="listadomes"  method="get">
<select class="form-control" name="mes">
  <option value="todos" selected="selected" >*Todos</option>
  <option value="01">01 Enero</option>
  <option value="02">02 Febrero</option>
  <option value="03">03 Marzo</option>
  <option value="04">04 Abril</option>
  <option value="05">05 Mayo</option>
  <option value="06">06 Junio</option>
  <option value="07">07 Julio</option>
  <option value="08">08 Agosto</option>
  <option value="09">09 Setiembre</option>
  <option value="10">10 Octubre</option>
  <option value="11">11 Noviembre</option>
  <option value="12">12 Diciembre</option>
</select>
<select class="form-control" name="anio">
  <option value="todos" selected="selected" >*Todos</option>
  <option value="2014">2014</option>
  <option value="2015">2015</option>
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
  <option value="2019">2019</option>
  <option value="2020">2020</option>
</select>


  <input type="submit" value="buscar">
</form>

<table class="lista">

<?php foreach ($productores as $vendedor):
    $nombre = $vendedor->getApellido()." ".$vendedor->getNombre(); ?>
    
    <tr>
      <th align='center' colspan='5'><?php echo $nombre ?></th>
    </tr>

    <?PHP $suscripciones = Doctrine_Query::create()
      ->from('suscripcion')
      ->where('productor_id =?',$vendedor->getId())
      ->andwhere('fecha_baja is null')->orderby('fecha_alta')
      ->execute(); ?>

      <?PHP $total=0; foreach ($suscripciones as $suscripcion):
        $nro = $suscripcion->getNro();
        $fecha = Formatos::fecha($suscripcion->getFechaAlta());
        $suscriptor = $suscripcion->getSuscriptor();
        $plan = $suscripcion->getPlan();
        $obs = $suscripcion->getObs();
        $vcuota = $suscripcion->getValor_cuota();
$fvcuota = Formatos::moneda($vcuota);?>

<tr>
<td align="left"><?PHP echo $fecha ?></td>
<td align="center"><?PHP echo $nro ?></td>
<td align="left"><a href="<?php echo url_for('suscriptor/show?id='.$suscripcion->getSuscriptorId()) ?>"><?PHP echo $suscriptor ?></a></td>
<td align="left"><b><?PHP echo $plan ?></b><br>
  <textarea id="obs<?php echo $suscripcion->getId() ?>" style="font-size:12px" rows="3" maxlength="255"><?php echo $obs ?></textarea>
  <a class="btn2" href="javascript:grabarObs(<?php echo $suscripcion->getId() ?>)">Grabar</a>
</td>
<td align="right"><?PHP echo $fvcuota ?></td>
<td align="center"><a class="btn2" href="<?php echo url_for('cuota/index?id=') . $suscripcion->getId() ?>">Ver Cuotas</a>
<a class="btn2" href="<?php echo url_for('suscripcion/edit?id='.$suscripcion->getId()) ?>">Editar</a>
<a class="btn2" href="javascript:bajar(<?php echo $suscripcion->getId(); ?>)">Cancelar</a>
</td>
</tr>
<?php
$total = $total + $vcuota;
      endforeach; ?>
      <tr>
        <td align="right" colspan="5"><?php echo "Total: ".Formatos::moneda($total)?></td>
      </tr>
      
    <?php endforeach; ?>

</table>

<script>
function grabarObs(id) {
  var texto = $("#obs"+id).val();
 $.post("/suscripcion/grabarobs",
  {
    id:id,
    texto:texto
  },
  function(data){
    alert(data);
  });
}
function bajar(id){
  var x = confirm("¿Cancelar suscripción?");
if(x){
$.post("/suscripcion/bajar",
  {
    id:id
  },
  function(data){
    alert(data);
    window.location.href = window.location.href;
  });
}
}
</script>