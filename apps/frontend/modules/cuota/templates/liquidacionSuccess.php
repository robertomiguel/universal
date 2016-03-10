<script>
jQuery(document).ready(function($)
{
if(!$.cookie('orden-liquidacion')){$.cookie('orden-liquidacion', '0,0');}
var orden = $.cookie('orden-liquidacion').split(",");
if (orden==""){orden[0]=1;orden[1]=0;}
$("#ordenar").tablesorter( {sortList: [[orden[0],orden[1]]]} );
$('#ordenar').tableScroll({height:500});
});

function imprimirtodo(mes,anio) {
$.Zebra_Dialog('<strong>Confirmar Impresión del período completo</strong>', {
    'custom_class':  'dialogo',
    'type':     'question',
    'title':    'Imprimir Todo',
    'buttons':  ['Cancelar', 'Imprimir'],
    'onClose':  function(caption) {
       if (caption=='Imprimir'){
//window.location.href ="/imprimir/recibos/mes/" + mes + "/anio/" + anio;
var $dialog = $('<div></div>')
  .html("<center>Esperar a que finalize la descarga y/o impresión<br>Luego pulse un botón<br><br><a href='"+"/imprimir/recibos/mes/" + mes + "/anio/" + anio+"'>> <img src='/images/imprimir.gif'> Click aquí para Descargar/Imprimir <</a><br><br>\
<span style='font-size:14px'><b><u>Marcar todos como impresos</u></b><br>\
Este botón marca TODAS las cuotas del período<br>\
seleccionado como <b>impresas</b>,<br>\
y setea las fechas de emisión vacías con la fecha actual.<br>\
<b><u>No marcar como impresos</u></b><br>\
Este botón cierra la ventana imrimir<br>\
<b>SIN MARCAR</b> las cuotas como impresas.\
</span></center>")
  .dialog({
	autoOpen: false,
	title: "Impresión de recibos: "+$('#mes option:selected').html()+" "+anio,
	modal: true,
	width: 560,
//	buttons: { "Continuar": function() { window.location.href = window.location.href; } }
	buttons: [
    {
        text: "No marcar como impresos",
        click: function() { $(this).dialog("close"); }
    },
    {
        text: "Marcar todos como impresos",
        click: function() {
$.get("/imprimir/impresos", { mes: mes, anio: anio},
  function(data){
      window.location.href = window.location.href;
  });

}
    }
] 

	});
$dialog.dialog('open');
       }
    }
});
}
</script>

<h1 align="center">Liquidación de cuotas</h1>
<div class="menuTemplate" align="center">
	<form action="<?php url_for('cuota/liquidacion') ?>"  method="get">
	Período:
	<select name="mes" id="mes" style="width:100px" onChange="liquidacion();">
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
	<input type="submit" value="" id="lupa" hidden />
	</form>
</div>

<div align="center" class="menuTemplate">
<?php
$sinimprimir=0;
 echo "<a class='btn2' href='/imprimir/sobres/mes/$mesSel/anio/$anioSel'><img src='/images/sobre.png'> Generar Sobres (<span id='aimprimir1'></span>)</a>";
?>
<br>(aquí no se listan cuotas pagadas)<br>
<?php
?>
<p>
Fecha de Emisión: 
<input type='text' id='pdia' maxlength='2' style='width:20px' value="<?php echo date('d') ?>">
-<input type='text' id='pmes' maxlength='2' style='width:20px' value="<?php echo date('m') ?>">
-<input type='text' id='panio' maxlength='4' style='width:40px' value="<?php echo date('Y') ?>">
<a class="btn2" href="javascript:printtodo()"><img src='/images/imprimir.gif'> Imprimir todo (<span id='aimprimir2'></span>)</a>
</p>
</div>
<table id="ordenar">
  <thead>
    <tr>
      <th onclick="setordenliquidacion(this)">N</th>
      <th onclick="setordenliquidacion(this)">Suscriptor</th>
      <th onclick="setordenliquidacion(this)">Plan</th>
      <th onclick="setordenliquidacion(this)">Solicitud</th>
      <th onclick="setordenliquidacion(this)">Cuota</th>
      <th onclick="setordenliquidacion(this)">Importe</th>
      <th onclick="setordenliquidacion(this)">F. Emision</th>
      <th onclick="setordenliquidacion(this)">Estado</th>
      <th onclick="setordenliquidacion(this)">Acciones</th>
    </tr>
  </thead>
  <tbody align="center">
<?php foreach ($respuesta as $cuota): ?>
    <tr>
     <td><?php echo ++$i ?></td>
      <td align="left"><a href="<?php echo url_for('suscriptor/show?id='.$cuota->getSuscriptorId()) ?>"><?php echo $cuota->getNombre() ?></a></td>
      <td><?php echo $cuota->getPlan() ?></td>
      <td><a href="<?php echo url_for('cuota/index?id=') . $cuota->getSuscripcionId() ?>"><?php echo $cuota->getNro() ?></a></td>
      <td><?php echo $cuota->getNroCuota() ?></td>
      <td><?php echo Formatos::moneda($cuota->getImporte()) ?></a></td>
      <td><a href="javascript:borraremision(<?php echo $cuota->getId(); ?>)"><?php echo Formatos::fecha($cuota->getFemision()) ?></td>
<td>
<?php
$ncuota = $cuota->getNroCuota();
$id = $cuota->getId();
$impresa = $cuota->getImpresa();
if ($impresa) {
echo "<a href='javascript:sinimprimir($id)'><b>Impresa</b>";
} else {
echo "<a href='javascript:impresa($id)'>Sin Imprimir</a>";++$sinimprimir;
}
?></td>
     <td><a class="btn2" href='javascript:print(<?php echo $cuota->getId(); ?>)'>Imprimir</a>

     <a class="btn2" href="javascript:imprimir('sobre',<?php echo $cuota->getSuscriptorId(); ?>);">Sobre</a>
     
      <a class="btn2" href="<?php echo url_for('cuota/edit?id='.$cuota->getId()) ?>">Editar Cuota</a></td>
    </tr>
<?php endforeach;?>
  </tbody>
</table>
<table>
 <tr>
   <td><hr /></td>
 </tr>
 <tr>
   <th align="center">Total de cuotas: <?php echo count($respuesta)." Sin Imprimir: $sinimprimir";?></th>
 </tr>
</table>
<script>
$('#aimprimir1').html("<?php echo $sinimprimir ?>");
$('#aimprimir2').html("<?php echo $sinimprimir ?>");

function impresa(id){
    var x = confirm("¿Marcar cuota como IMPRESA?");
if(x){
  $.get("/imprimir/impresa", { id:id},
  function(data){
  //alert('Cuota IMPRESA');
  window.location.href = window.location.href;
  });
}
}

function sinimprimir(id){
    var x = confirm("¿Marcar cuota como SIN IMPRIMIR?");
if(x){
  $.get("/imprimir/sinimprimir", { id:id},
  function(data){
  //alert('Cuota SIN IMPRIMIR');
  window.location.href = window.location.href;
  });
}
}

function borraremision(id){
    var x = confirm("¿BORRAR LA FECHA DE EMISION?");
if(x){
  $.get("/imprimir/borraremision", { id:id},
  function(data){
  //alert('Cuota SIN IMPRIMIR');
  window.location.href = window.location.href;
  });
}
}

function print (id){
var dia = $('#pdia').val();
var mes = $('#pmes').val();
var anio = $('#panio').val();
  window.location.href = '/imprimir/recibo?id='+id+'&mes='+mes+'&anio='+anio+'&dia='+dia;
}

function printtodo (){
var pdia = $('#pdia').val();
var pmes = $('#pmes').val();
var panio = $('#panio').val();
var mes = '<?php echo $mesSel ?>';
var anio = '<?php echo $anioSel ?>';
window.location.href = '/imprimir/recibos?dia='+pdia+'&mes='+mes+'&anio='+anio+'&pmes='+pmes+'&panio='+panio;
}
</script>
