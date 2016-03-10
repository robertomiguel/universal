<script>
jQuery(document).ready(function($)
{
if(!$.cookie('orden-consultas')){$.cookie('orden-consultas', '0,0');}
var orden = $.cookie('orden-consultas').split(",");
if (orden==""){orden[0]=1;orden[1]=0;}
$("#ordenar").tablesorter( {sortList: [[orden[0],orden[1]]]} );
$('#ordenar').tableScroll({height:500});
});
</script>
<h1 align="center">Consultas por Período</h1>
<div class="menuTemplate" align="center">
<form action="<?php url_for('cuota/consultas') ?>"  method="get">
	Período:
	<select name="mes" style="width:100px" onChange="liquidacion();">
<?php
$meses = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio',
               'Agosto','Setiembre','Octubre','Noviembre','Diciembre');
for ($i = 1; $i < 13; $i++) {
  if ($mesSel==$i){echo "<option value='$i' selected='selected'>$meses[$i]</option>";} else {
  echo "<option value='$i'>$meses[$i]</option>";}
}?>
	</select>
	<select name="anio" style="width:80px" onChange="liquidacion();">
<?php
$anios = array('','2020','2019','2018','2017','2016','2015','2014','2013','2012','2011',
               '2010','2009','2008','2007','2006','2005','2004','2003','2002','2001','2000');
for ($i = 21; $i > 0; $i--) {
  if ($anioSel==$anios[$i]) {
  echo "<option value='$anios[$i]' selected='selected'>$anios[$i]</option>";}
  else {echo "<option value='$anios[$i]'>$anios[$i]</option>";}
}?>
	</select>
<input	type="input" name="listado" id="listado" hidden value="<?php echo $lista ?>">
	<input type="submit" value="" id="lupa" hidden />

</form>
</div>
<div class="menuTemplate">
<a class="btn" href="javascript:consulta('completo')"><img src="/images/ver.png"> Completo</a>&nbsp;-&nbsp;
<a class="btn"  href="javascript:consulta('pagadas')"><img src="/images/guita.png"> Pagadas</a>&nbsp;-&nbsp;
<a class="btn"  href="javascript:consulta('sinpagar')"><img src="/images/reloj.png"> Sin Pagar</a>
</div>
<div class="menuTemplate" align="center">
<a class="btn2" href="printconsultas/listado/<?php echo $listado ?>/mes/<?php echo $mesSel ?>/anio/<?php echo $anioSel ?>"><img src="/images/imprimir.gif"> Imprimir Listado de Cuotas <?php echo $listado .' del mes '.$mesSel.' del '.$anioSel ?></a>

</div>
<table id="ordenar">
  <thead>
    <tr>
      <th onclick="setordenconsultas(this)">Suscriptor / Tel / Productor</th>
      <th onclick="setordenconsultas(this)">Plan</th>
      <th onclick="setordenconsultas(this)">Solicitud</th>
      <th onclick="setordenconsultas(this)">Cuota</th>
      <th onclick="setordenconsultas(this)">Importe</th>
      <th onclick="setordenconsultas(this)">Día Cobro</th>
      <th onclick="setordenconsultas(this)">Estado</th>
      <th onclick="setordenconsultas(this)"></th>
    </tr>
  </thead>
  <tbody align="center">
    <?php foreach ($respuesta as $cuota): ?>
    <tr>
      <td align="left">
        <a href="<?php echo url_for('suscriptor/show?id='.$cuota->getSuscriptorId()) ?>">
          <?php echo $cuota->getNombre() ?></a><br>
          <?php echo Formatos::textoCool($cuota->getLocalidad()) ?><br>
          <?php echo $cuota->getTelefono() ?><br>
          <?php echo $cuota->getProductor() ?>
      </td>
      <td><?php echo $cuota->getPlan() ?></td>
      <td><?php echo $cuota->getNro() ?></td>
      <td><?php echo $cuota->getNroCuota() ?></td>
      <td><?php echo Formatos::moneda($cuota->getImporte()) ?></a></td>
      <?php 
      if ($cuota->getDiacobro())
        {echo "<td><a href='javascript:editarcobro(".$cuota->getSuscripcionId().")'>".$cuota->getDiacobro()."</a></td>";}
      else
        {echo "<td><a href='javascript:editarcobro(".$cuota->getSuscripcionId().")'>agregar</a></td>";}
      ?>

      <td>
        <?php
        if ($cuota->getFpago()){
        echo '<b>PAGADO</b>';
        } else
        {echo '<span style="color:red">SIN PAGAR</span>';}
        ?></td>

<?php
$ncuota = $cuota->getNroCuota();
$id = $cuota->getId();
?>
<td>
      <a class="btn2" href="/imprimir/recibo?id=<?php echo $cuota->getId() ?>">Imprimir Recibo</a>
      <a class="btn2" href="/imprimir/sobre?id=<?php echo $cuota->getSuscriptorId(); ?>">Imprimir Sobre</a><br><br>
      <a class="btn2" href="<?php echo url_for('cuota/edit?id='.$cuota->getId()) ?>">Editar Cuota</a>
      <a class="btn2" href="<?php echo url_for('cuota/index?id=') . $cuota->getSuscripcionId() ?>">Ver Cuotas</a>
      <?php 
      if($cuota->getFpago()) {
      echo '<a class="btn2" href="javascript:sinpagar('.$cuota->getId().')">Sin Pagar</a>';
      } else {
        echo '<a class="btn2" href="javascript:pagada('.$cuota->getId().')">Pagada</a>';
      }
  
       ?>
  </td>
    </tr>
<?php
$total = $total + $cuota->getImporte();
endforeach;
?>
  </tbody>
</table>
<table>
 <tr>
   <td><hr /></td>
 </tr>
 <tr>
   <th align="center">Total: <?php echo Formatos::moneda($total);?> en <?php echo count($respuesta);?> cuotas</th>
 </tr>
</table>
<script>
function sinpagar(cid){
    var x = confirm("¿Marcar como NO PAGADA?");
if(x){
  $.get("/cuota/sinpagar2", { cid: cid},
  function(data){
  alert('Cuota marcada como SIN PAGAR');
  window.location.href = window.location.href;
  });
}
}
function pagada(cid){
    var x = confirm("¿Cuota Pagada?");
if(x){
  $.get("/cuota/marcarpagada", {cid: cid},
  function(data){
  alert('Cuota Pagada');
  window.location.href = window.location.href;
  });
}
}
function editarcobro(sid){
var x = prompt('Día de cobro:');
if (x) {
$.post("/suscripcion/editarcobro",
{sid:sid, dia:x},
function(data){
alert (data);
window.location.href = window.location.href;
});
} else {alert ('cancelado');}

}
</script>
