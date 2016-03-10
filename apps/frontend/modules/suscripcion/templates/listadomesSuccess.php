<style>
.lista {font-size:5mm;width:80%}
.lista th {background-color:#dbdbdb}
</style>
Período

<form action="listadomes"  method="get">
<select class="form-control" name="mes">
  <option value="todos">*Todos</option>
  <option id="mes01" value="01">01 Enero</option>
  <option id="mes02" value="02">02 Febrero</option>
  <option id="mes03" value="03">03 Marzo</option>
  <option id="mes04" value="04">04 Abril</option>
  <option id="mes05" value="05">05 Mayo</option>
  <option id="mes06" value="06">06 Junio</option>
  <option id="mes07" value="07">07 Julio</option>
  <option id="mes08" value="08">08 Agosto</option>
  <option id="mes09" value="09">09 Setiembre</option>
  <option id="mes10" value="10">10 Octubre</option>
  <option id="mes11" value="11">11 Noviembre</option>
  <option id="mes12" value="12">12 Diciembre</option>
</select>
<select class="form-control" name="anio">
  <option value="todos" selected="selected" >*Todos</option>
  <option id+"anio01" value="2014">2014</option>
  <option id+"anio02" value="2015">2015</option>
  <option id+"anio03" value="2016">2016</option>
  <option id+"anio04" value="2017">2017</option>
  <option id+"anio05" value="2018">2018</option>
  <option id+"anio06" value="2019">2019</option>
  <option id+"anio07" value="2020">2020</option>
</select>

  <input type="submit" value="buscar">
</form>
<script>
var mes = "mes" + '<?php echo $mes ?>';
  $("#"+mes).attr("selected","selected");
var anio = "anio" + '<?php echo $anio ?>';
  $("#"+anio).attr("selected","selected");
</script>
<a href="/imprimir/suscripciones/mes/<?php echo $mes ?>"> Imprimir</a>
<table class="lista">

<?php foreach ($productores as $vendedor):
    $nombre = $vendedor->getApellido()." ".$vendedor->getNombre(); ?>
    
    <tr>
      <th align='center' colspan='5'><?php echo $nombre ?></th>
    </tr>

    <?PHP $mes2=$mes+1; $suscripciones = Doctrine_Query::create()
      ->from('suscripcion')
      ->where('productor_id =?',$vendedor->getId())
      ->andWhere('fecha_alta >?',"2014-$mes-00")
      ->andWhere('fecha_alta <?',"2014-$mes2-01")
      ->andwhere('fecha_baja is null')->orderby('fecha_alta')
      ->execute(); ?>

      <?PHP $total=0; foreach ($suscripciones as $suscripcion):
        $nro = $suscripcion->getNro();
        $fecha = Formatos::fecha($suscripcion->getFechaAlta());
        $suscriptor = $suscripcion->getSuscriptor();
        $plan = $suscripcion->getPlan();
        $vcuota = $suscripcion->getValor_cuota();
$fvcuota = Formatos::moneda($vcuota);?>

<tr>
<td align="left"><?PHP echo $fecha ?></td>
<td align="center"><?PHP echo $nro ?></td>
<td align="left"><a href="<?php echo url_for('suscriptor/show?id='.$suscripcion->getSuscriptorId()) ?>"><?PHP echo $suscriptor ?></a></td>
<td align="left"><?PHP echo $plan ?></td>
<td align="right"><?PHP echo $fvcuota ?></td>
<td align="center"><a href="<?php echo url_for('cuota/index?id=') . $suscripcion->getId() ?>">Ver Cuotas</a> // 
<a href="<?php echo url_for('suscripcion/edit?id='.$suscripcion->getId()) ?>">Editar</a><br>
<a href="javascript:bajar(<?php echo $suscripcion->getId(); ?>)">Dar de Baja</a>
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
function bajar(id){
$.post("/suscripcion/bajar",
  {
    id:id
  },
  function(data){
    alert(data);
    window.location.href = window.location.href;
  });

}
</script>