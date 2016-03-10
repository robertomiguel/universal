function menu(e){
location.href=e.id;
}

function $id(id){return document.getElementById(id);}
/*
function valorNominal(e) {
 var vcuota = e.value * 1;
 var nominal = $id("plan_valor_nominal");
 var cuotas = $id("plan_cant_cuotas");
 var total = vcuota * cuotas.value
 nominal.value = total.toFixed(2);
}

function valorCuota(e) {
 var cuotas = e.value * 1;
 var vcuota = $id("plan_valor_cuota");
 var nominal = $id("plan_valor_nominal").value;
 var total = nominal / cuotas
 vcuota.value = total.toFixed(2);
}

function valorCuota2(e) {
 var nominal = e.value * 1;
 var vcuota = $id("plan_valor_cuota");
 var cuotas = $id("plan_cant_cuotas").value;
 var total = nominal / cuotas;
 vcuota.value = total.toFixed(2);
}
*/
function liquidacion() {
$('#lupa').click();
}
function consulta(c) {
$id('listado').value=c;
$('#lupa').click();
}

function imprimir(t,cid) {
//var cid = cid*1;
switch (t) {
    case "recibo":
var $dialog = $('<div></div>')
  .html("<center>Esperar a que finalize la descarga y/o impresión<br>Luego pulse el botón <b>Continuar</b><br><br><a href='"+"/imprimir/recibo/id/" + cid +"'>> <img src='/images/imprimir.gif'> Click aquí para Descargar/Imprimir <</a><br><br>Al presionar Descargar/Imprimir se marcar esta cuota como Impresa y si no existe fecha de emisión se crea con fecha actual</center>")
  .dialog({
	autoOpen: false,
	title: "Impresión de recibo",
	modal: true,
	width: 460,
	buttons: { "Continuar": function() { window.location.href = window.location.href; } }
	});
$dialog.dialog('open');

       break;
    case "sobre":
var $dialog = $('<div></div>')
  .html("<center>Esperar a que finalize la descarga y/o impresión<br>Luego pulse el botón <b>Continuar</b><br><br><a href='"+"/imprimir/sobre/id/" + cid +"'>> <img src='/images/imprimir.gif'> Click aquí para Descargar/Imprimir Sobre<</a><br>")
  .dialog({
	autoOpen: false,
	title: "Impresión de Sobre",
	modal: true,
	width: 460,
	buttons: { "Continuar": function() { $(this).dialog("close"); } }
	});
$dialog.dialog('open');

    break;
    default:
return;
} 
}

function calcular100(){
  var p = $id('por100').value;
  var costo = $id('precioreal').value;
  var porcentaje = (costo * p)/100;
  $id("esigual").value =  porcentaje.toFixed(2);
  $id("plan_valor_nominal").value = porcentaje*1 + costo*1;
 var nominal = $id("plan_valor_nominal").value * 1;
 var vcuota = $id("plan_valor_cuota");
 var cuotas = $id("plan_cant_cuotas").value;
 var total = nominal / cuotas;
 vcuota.value = total.toFixed(2);

}

function grabarcuota(){
if(typeof(volver1) != "undefined"){
$id('volver').value = $id('volver1').value;}
$('#grabar33').click();
}

function setordensuscriptor(e) {
var index =$(e).index();
var sortUp=$(e).is('.headerSortUp');
var sortDown=$(e).is('.headerSortDown');
if (sortUp || sortDown){v=1;} else {v=0;}
$.cookie('orden-suscriptor',  index+','+v);
}

function setordensuscripcion(e) {
var index =$(e).index();
var sortUp=$(e).is('.headerSortUp');
var sortDown=$(e).is('.headerSortDown');
if (sortUp || sortDown){v=1;} else {v=0;}
$.cookie('orden-suscripcion',  index+','+v);
}

function setordenplan(e) {
var index =$(e).index();
var sortUp=$(e).is('.headerSortUp');
var sortDown=$(e).is('.headerSortDown');
if (sortUp || sortDown){v=1;} else {v=0;}
$.cookie('orden-plan',  index+','+v);
}

function setordenproductor(e) {
var index =$(e).index();
var sortUp=$(e).is('.headerSortUp');
var sortDown=$(e).is('.headerSortDown');
if (sortUp || sortDown){v=1;} else {v=0;}
$.cookie('orden-productor',  index+','+v);
}

function setordenrubro(e) {
var index =$(e).index();
var sortUp=$(e).is('.headerSortUp');
var sortDown=$(e).is('.headerSortDown');
if (sortUp || sortDown){v=1;} else {v=0;}
$.cookie('orden-rubro',  index+','+v);
}

function setordenmorosos(e) {
var index =$(e).index();
var sortUp=$(e).is('.headerSortUp');
var sortDown=$(e).is('.headerSortDown');
if (sortUp || sortDown){v=1;} else {v=0;}
$.cookie('orden-morosos',  index+','+v);
}

function setordenconsultas(e) {
var index =$(e).index();
var sortUp=$(e).is('.headerSortUp');
var sortDown=$(e).is('.headerSortDown');
if (sortUp || sortDown){v=1;} else {v=0;}
$.cookie('orden-consultas',  index+','+v);
}

function setordenliquidacion(e) {
var index =$(e).index();
var sortUp=$(e).is('.headerSortUp');
var sortDown=$(e).is('.headerSortDown');
if (sortUp || sortDown){v=1;} else {v=0;}
$.cookie('orden-liquidacion',  index+','+v);
}

function setordencuotas(e) {
var index =$(e).index();
var sortUp=$(e).is('.headerSortUp');
var sortDown=$(e).is('.headerSortDown');
if (sortUp || sortDown){v=1;} else {v=0;}
$.cookie('orden-cuotas',  index+','+v);
}

