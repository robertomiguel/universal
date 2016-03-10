<?php
//$cuotas = Doctrine::getTable('cuota')->verCuotas($rid);

$id = $sf_params->get('id');
$suscripcion = Doctrine::getTable('suscripcion')->find("$id");
$vnominal = Doctrine::getTable('cuota')->getVnominal($id);
//$suscripcion->getValorCuota() * $suscripcion->getCantCuotas();
//2011-11-22
$fechasol = substr($suscripcion->getFechaAlta(),8,2).'/'.substr($suscripcion->getFechaAlta(),5,2).'/'.substr($suscripcion->getFechaAlta(),0,4);
// 10/10/2009
$mes = substr($fechasol,3,2)*1;
$anio = substr($fechasol,6,4)*1;
$mes++;
if ($mes==13){$mes=1;$anio++;}
$mes = str_pad($mes, 2, "0", STR_PAD_LEFT);
$cuota1 = "15/".$mes."/".$anio;

?>
<style>
#desde, #hasta,#desde2, #hasta2,#desde3, #hasta3 {width:50px}
#nuevovalor {width:100px}
</style>
<script>
jQuery(document).ready(function($)
{
if(!$.cookie('orden-cuotas')){$.cookie('orden-cuotas', '0,0');}
var orden = $.cookie('orden-cuotas').split(",");
if (orden==""){orden[0]=1;orden[1]=0;}
$("#ordenar").tablesorter( {sortList: [[orden[0],orden[1]]]} );
$('#ordenar').tableScroll({height:500});
});

$dialogcambiar = $('<div></div>')
  .html("<center>Todos los importes del rango de cuotas seleccionado,<br>se actualizan con el valor indicado.\
<br><br>Cuota desde <input type='text' id='desde' value='1'> Hasta: <input type='text' id='hasta' value='84'>\
<br>Valor Cuota <input type='text' id='nuevovalor' value=''></center>")
  .dialog({
	autoOpen: false,
	title: "Cambiar Importes",
	modal: true,
	width: 560,
	buttons: [
    {
        text: "Cancelar",
        click: function() { $(this).dialog("close"); }
    },
    {
        text: "Cambiar",
        click: function() {
	$.get("/cuota/nuevovalor", { id: <?php echo $rid ?>, valor: $('#nuevovalor').val(), desde: $('#desde').val(), hasta: $('#hasta').val()},
	function(data){
	window.location.href = window.location.href;
	});
}}]
});

$dialogliquidar = $('<div></div>')
  .html("<center>Liquidar cuotas<br>\
<br>Cuota desde <input type='text' id='desde2' value='1'> Hasta: <input type='text' id='hasta2' value='84'><br>\
<br>Fecha de emisión - fecha de pago<br>\
<input type='text' id='femision' value='<?php echo date("01/m/Y") ?>'>&nbsp;-&nbsp;\
<input type='text' id='fpago' value='<?php echo date("d/m/Y") ?>'>\
<br><br>Marcar como pagada <input type='checkbox' id='pagada' ><br>\
Marcar como impresa <input type='checkbox' id='impresa' value='1' checked><br>\
<a href='javascript:imprimircuotas()'>> <img src='/images/imprimir.gif'> Click aquí para imprimir/descargar <</a></center>")
  .dialog({
	autoOpen: false,
	title: "Liquidar cuotas",
	modal: true,
	width: 560,
	buttons: [
    {
        text: "Sin Emitir",
        click: function() {
	$.get("/cuota/sinemitir", { idbol: <?php echo $rid ?>, desde: $('#desde2').val(), hasta: $('#hasta2').val()},
	function(data){
	window.location.href = window.location.href;
//alert(data);
	});
    }
    },
    {
        text: "Sin pagar",
        click: function() {
	$.get("/cuota/sinpagarrango", { idbol: <?php echo $rid ?>, desde: $('#desde2').val(), hasta: $('#hasta2').val()},
	function(data){
	window.location.href = window.location.href;
//alert(data);
	});
    }
    },
    {
        text: "Cancelar",
        click: function() { $(this).dialog("close"); }
    },
    {
        text: "Confirmar",
        click: function() {
if (!$id('pagada').checked){$('#fpago').attr('value','0');}
	$.get("/cuota/liquidarcuotas", { id: <?php echo $rid ?>, desde: $('#desde2').val(), hasta: $('#hasta2').val(), femision: $('#femision').val(), fpago: $('#fpago').val(), impresa: $('$impresa:checked').val()},
	function(data){
	window.location.href = window.location.href;
	});
}}]
});

$dialogperiodos = $('<div></div>')
  .html("<center>Cambia la fecha de los períodos<br>\
<br>Desde cuota <input type='text' id='desde3' value='1'> Hasta: <input type='text' id='hasta3' value='84'><br>\
<br>Fecha Solicitud (cuota 0) <?php echo $fechasol ?>\
<br><br>Período desde** <input type='text' id='cuota1' value='<?php echo $cuota1 ?>'>\
<br><br>**Fecha de vencimiento de la primera cuota del rango seleccionado (cuota desde).</center>")
  .dialog({
	autoOpen: false,
	title: "Cambiar Períodos",
	modal: true,
	width: 560,
	buttons: [
    {
        text: "Cancelar",
        click: function() { $(this).dialog("close"); }
    },
    {
        text: "Cambiar",
        click: function() {
	$.get("/cuota/cambiarperiodos", { id: <?php echo $rid ?>, cuota1: $('#cuota1').val(), desde: $('#desde3').val(), hasta: $('#hasta3').val()},
	function(data){
	window.location.href = window.location.href;
//alert(data);
	});
}}]
});

$dialogpagada = $('<div></div>')
  .html("<center>Marcar como pagada cuota <span id='ncuota'></span><br>\
<br><br>Fecha de Pago <input type='text' id='fpagada' value='<?php echo date('d/m/Y') ?>'>\
<br></center>")
  .dialog({
	autoOpen: false,
	title: "Cuota Pagada",
	modal: true,
	width: 560,
	buttons: [
    {
        text: "Sin Emitir",
        click: function() {
	$.get("/cuota/sinemitiruna", { idbol: <?php echo $rid ?>, ncuota: ncuota},
	function(data){
	window.location.href = window.location.href;
//alert(data);
	});
    }
    },
    {
        text: "Sin pagar",
        click: function() {
	$.get("/cuota/sinpagar", { idbol: <?php echo $rid ?>, ncuota: ncuota},
	function(data){
	window.location.href = window.location.href;
//alert(data);
	});
    }
    },
    {
        text: "Cancelar",
        click: function() { $(this).dialog("close"); }
    },
    {
        text: "Pagada",
        click: function() {
	$.get("/cuota/pagada", { idbol: <?php echo $rid ?>, fecha: $('#fpagada').val(), ncuota: ncuota},
	function(data){
	window.location.href = window.location.href;
//alert(data);
	});

}}]
});

//$dialogliquidar.dialog('open');
 $('#femision').datepicker({
regional:'es',
minDate: '01/01/2000',
maxDate: '01/01/2020',
showOn: 'both',
buttonText: 'Cambiar',
autoSize: true,
changeYear: true,
changeMonth: true
});
 $('#fpago').datepicker({
regional:'es',
minDate: '01/01/2000',
maxDate: '01/01/2020',
showOn: 'both',
buttonText: 'Cambiar',
autoSize: true,
changeYear: true,
changeMonth: true
});
 $('#cuota1').datepicker({
regional:'es',
minDate: '<?php echo $fechasol ?>',
maxDate: '01/01/2020',
showOn: 'both',
buttonText: 'Seleccionar',
autoSize: true,
changeYear: true,
changeMonth: true
});
 $('#fpagada').datepicker({
regional:'es',
minDate: '01/01/2000',
maxDate: <?php echo date('d/m/Y') ?>,
showOn: 'button',
buttonText: 'Seleccionar',
autoSize: true,
changeYear: true,
changeMonth: true
});

//}

function abrirliquidar(){
$dialogliquidar.dialog('open');
}

function abrircambiar(){
$dialogcambiar.dialog('open');
}

function imprimircertificado(){
  window.location.href = "/imprimir/certificado/id/1";
}

function imprimircuotas(){
var femision = $('#femision').val().replace(/\//g, '-');
  window.location.href = "/imprimir/liquidarcuotas/id/<?php echo $rid ?>/desde/"+$('#desde2').val()+"/hasta/"+$('#hasta2').val()+"/femision/"+femision;
}

function abrirperiodos(){
$dialogperiodos.dialog('open');
}

function marcarpagada(c){
ncuota=c;
$dialogpagada.dialog('open');
$('#ncuota').html(c);
}
</script>

<?php
$url= url_for('suscripcion/show?id='.$id);
$suscriptor = $suscripcion->getSuscriptor();
$localidad = $suscriptor->getLocalidad();
?>
<h1 align="center">Resumen de Cuotas</h1>
<div class="menuTemplate">
 <table class="detalleCliente">
  <tr>
    <td style="width:12%">Suscriptor:</td>
    <td style="width:auto">
     <?php echo $suscriptor->getApellido()." ".$suscriptor->getNombre();?></td>
    <td style="width:12%">Solicitud:</td>
    <td style="width:15%">
      <a href="suscripcion/edit/id/<?php echo $suscripcion->getId();?>">
        <?php echo $suscripcion->getNro();?>
      </a>
    </td>
  </tr>
  <tr>
    <td>Dirección:</td>
      <td><?php echo $suscriptor->getDomicilio();?></td>
    <td>Sorteo:</td>
      <td><?php echo $suscripcion->getSorteo();?></td>
  </tr>
  <tr>
    <td>Localidad:</td><td>CP <?php echo $localidad->getCp();?>&nbsp;-&nbsp;
     <?php echo ucwords(strtolower($localidad->getNombre()));?>&nbsp;-&nbsp;
     <?php echo ucwords(strtolower($localidad->getProvincia()));?></td>
    <td>Plan:</td><td><?php echo $suscripcion->getCodigo();?></td>
  </tr>
  <tr>
    <td>Teléfono:</td>
      <td><?php echo $suscriptor->getTel();?>
        / <?php echo $suscriptor->getCelular();?>
      </td>
    <td>V. Nominal:</td>
    <td><?php echo Formatos::moneda($vnominal); ?></td>
  </tr>
</table>
<center><b><?php echo strtoupper($suscripcion->getPlan());?></b></center>

 <div style="padding:5px" align="center">
&nbsp;<a class="btn" title="Imprimir Certificado" href="cuota/certi/id/<?php echo $id; ?>"><img src="/images/imprimir.gif"> Certificado</a>
&nbsp;<a class="btn" title="Cargar una nueva cuota" href="<?php echo url_for('cuota/new?id='.$id) ?>"><img src="/images/agregar.png"> Agregar Cuota</a>
&nbsp;<a class="btn" title="Cambia el importe de varias cuotas juntas" href="javascript:abrircambiar()"><img src="/images/guita.png"> Cambiar Importes</a>
&nbsp;<a class="btn" title="Liquida cuotas en grupo" href="javascript:abrirliquidar()"><img src="/images/guita.png"> Liquidar Cuotas</a>
&nbsp;<a class="btn" title="Regenera períodos" href="javascript:abrirperiodos()"><img src="/images/editar.png"> Regenera Períodos</a>
<br>
 </div>
<div id="menuTemplate" align="center">
&nbsp;<a class="btn" title="Todas las cuotas cargadas" href="<?php echo url_for('cuota/index?id=') . $id; ?>"><img src="/images/ver.png"> Totales (<?php echo $totalcuotas;?>)</a>&nbsp;
   <a class="btn" title="Todas las cuotas pagadas" href="<?php echo url_for('cuota/index?ver=pagadas&id=') . $id; ?>"><img src="/images/guita.png"> Pagadas (<?php echo $pagadas;?>)</a>&nbsp;
   <a class="btn" title="Cuotas sin fecha de pago" href="<?php echo url_for('cuota/index?ver=impagas&id=') . $id; ?>"><img src="/images/no.png"> Impagas (<?php echo $impagadas;?>)</a>&nbsp;
   <a class="btn" title="Cuotas Vencidas sin pagar" href="<?php echo url_for('cuota/index?ver=vencidas&id=') . $id; ?>"><img src="/images/m6.gif"> Vencidas (<?php echo $vencidas;?>)</a>
&nbsp;<a class="btn" title="Imprimir sobre para: <?php echo $nombre; ?>" href="javascript:imprimir('sobre',<?php echo $suscriptor->getId(); ?>);"><img src='/images/sobre.png'> Sobre</a>
 </div>
</div>
<div class="menuTemplate" align="center">
<a title="Imprimir listado <?php echo $listado ?>" href="cuota/printresumen/id/<?php echo $id.'/ver/'.$listado; ?>"><img src="/images/imprimir.gif"> Imprimir Listado de Cuotas <?php echo $listado ?></a>
</div>
<table id="ordenar">
  <thead>
    <tr>
      <th onclick="setordencuotas(this)">Cuota</th>
      <th onclick="setordencuotas(this)">Importe</th>
      <th onclick="setordencuotas(this)">F. Emisión</th>
      <th onclick="setordencuotas(this)">Período</th>
      <th onclick="setordencuotas(this)">F. Pago</th>
      <th onclick="setordencuotas(this)"></th>
    </tr>
  </thead>
  <tbody align="center">
    <?php foreach ($respuesta as $cuota): ?>
    <tr>
	<td><?php echo $cuota->getNroCuota() ?></td>
	<td><?php echo Formatos::moneda($cuota->getImporte()) ?></td>
	<td><?php echo Formatos::fecha($cuota->getFemision()) ?></td>
	<td align="left"><?php echo Formatos::periodo($cuota->getFvencimiento()) ?></td>
	<td><?php echo Formatos::fecha($cuota->getFpago()) ?></td>
<?php
$ncuota = $cuota->getNroCuota();
$id = $cuota->getId();
?>
<td>
   <a class="btn2" href="javascript:imprimir('recibo',<?php echo $cuota->getNroCuota()?>)">Imprimir</a>
   <a class="btn2" href="<?php echo url_for('cuota/edit?id='.$cuota->getId()) ?>">Editar</a>
   <a class="btn2" href="javascript:marcarpagada(<?php echo $cuota->getNroCuota()?>)">Pagado</td>
</tr>
    <?php 
$total = $total + $cuota->getImporte();
endforeach;?>
  </tbody>
</table>

<table>
    <tr>
<td><hr/></td>
    </tr>
    <tr>
      <th align="center">Total:<?php echo Formatos::moneda($total) ?></th>
    </tr>
</table>



