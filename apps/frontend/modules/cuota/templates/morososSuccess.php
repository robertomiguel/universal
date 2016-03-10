<script>
jQuery(document).ready(function($)
{
if(!$.cookie('orden-morosos')){$.cookie('orden-morosos', '0,0');}
var orden = $.cookie('orden-morosos').split(",");
if (orden==""){orden[0]=1;orden[1]=0;}
$("#ordenar").tablesorter( {sortList: [[orden[0],orden[1]]]} );
$('#ordenar').tableScroll({height:500});
});
</script>
<h1 align="center">Lista de Morosos</h1>
<div class="menuTemplate" align="center" <?php echo $oculto ?>>
<form action="<?php url_for('cuota/consultas') ?>"  method="get">
	Período:
	<select name="mes" style="width:100px" onChange="consulta('periodo');">
<?php
$meses = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio',
               'Agosto','Setiembre','Octubre','Noviembre','Diciembre');

$hoy = date('m');
if ($anioSel < date('Y')) {$hoy=12;}
for ($i = 1; $i <= $hoy; $i++) {
  if ($mesSel==$i){echo "<option value='$i' selected='selected'>$meses[$i]</option>";} else {
  echo "<option value='$i'>$meses[$i]</option>";}
}?>
	</select>
	<select name="anio" style="width:80px" onChange="liquidacion();">
<?php
$hoy = date('Y');
for ($i = 2000; $i <= $hoy; $i++)
{
$c++;
$anios[$c] =$i;
}

for ($i = count($anios); $i > 0; $i--) {
  if ($anioSel==$anios[$i]) {
  echo "<option value='$anios[$i]' selected='selected'>$anios[$i]</option>";}
  else {echo "<option value='$anios[$i]'>$anios[$i]</option>";}
}?>
	</select>
<input	type="input" name="listado" id="listado" hidden value="<?php echo $listado ?>">
	<input type="submit" value="" id="lupa" hidden />

</form>
</div>
<div class="menuTemplate">
<a class="btn" href="morosos"><input type="radio" name="opcion" value="todos" <?php echo $todos ?>>&nbsp;Todos</a>&nbsp;
<a class="btn" href="javascript:consulta('periodo');"><input type="radio" name="opcion" value="periodo"<?php echo $periodo ?>>&nbsp;Por Período</a>
&nbsp;<a class="btn" title="Imprimir listado" href="printmorosos/listado/<?php echo $listado ?>/mes/<?php echo $mesSel ?>/anio/<?php echo $anioSel ?>"><img src="/images/imprimir.gif"> Imprimir</a>
</div>
<p class="menuTemplate" align="center">Cuotas vencidas sin pagar</p>
<table id="ordenar">
  <thead>
    <tr>
      <th onclick="setordenmorosos(this)">Suscriptor / Tel / Productor</th>
      <th onclick="setordenmorosos(this)">Solicitud</th>
      <th onclick="setordenmorosos(this)">Cuota</th>
      <th onclick="setordenmorosos(this)">Importe</th>
      <th onclick="setordenmorosos(this)">F. Emisión</th>
<?php
if ($listado=="todos") {
echo "<th onclick='setordenmorosos(this)'>Período</th>";
}
?>

      <th onclick="setordenmorosos(this)"></th>
    </tr>
  </thead>
  <tbody align="center">
    <?php foreach ($respuesta as $cuota): ?>
    <tr>
      <td align="left"><a href="<?php echo url_for('suscriptor/show?id='.$cuota->getSuscriptorId()) ?>"><?php echo $cuota->getNombre() ?></a><br><?php echo $cuota->getTelefono() ?><br><?php echo $cuota->getProductor() ?></td>
      <td title="Plan: <?php echo $cuota->getPlan() ?>"><a href="<?php echo url_for('/cuota?id='.$cuota->getSuscripcionId()) ?>"><?php echo $cuota->getNro() ?></a></td>
      <td><?php echo $cuota->getNroCuota() ?></td>
      <td align="right"><?php echo Formatos::moneda($cuota->getImporte())?></td>
      <td><?php echo Formatos::fecha($cuota->getFemision()) ?></td>
<?php
if ($listado=='todos') {
 echo "<td align='left'>".Formatos::periodo($cuota->getFvencimiento())."</td>";
}
?>
<?php
$ncuota = $cuota->getNroCuota();
$id = $cuota->getId();
?><td>
      <a class="btn2" href="javascript:pagada('<?php echo $cuota->getId() ?>');">Marcar Pagada</a></td>
    </tr>
    <?php
$total = $total + $cuota->getImporte();
$totalcuotas = $totalcuotas + 1;
endforeach;?>
  </tbody>
</table>

<table>
  <tr>
    <td><hr /></td>
  </tr>
  <tr>
   <th align="center">Total: <?php echo Formatos::moneda($total) ?> en <?php echo $totalcuotas ?> cuotas</th>
  </tr>
</table>

<script>
function pagada(cid){
    var x = confirm("¿Cuota Pagada?");
if(x){
  $.get("/cuota/marcarpagada", { cid: cid},
  function(data){
  alert('Cuota Pagada');
  window.location.href = window.location.href;
  });
}
}
</script>
