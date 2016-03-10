<script>
jQuery(document).ready(function($){
 $('#lafecha').datepicker({
regional:'es',
minDate: '01/01/2000',
maxDate: '+1y',
showOn: 'both',
buttonText: 'Cambiar',
autoSize: true,
changeYear: true,
changeMonth: true,
onSelect: function(dateText, inst) {
var f = dateText.split('/');
f[1]=(f[1]*1)+1;
if (f[1]==13){f[1]="01"; f[2]=(f[2]*1)+1}
var periodo = "15/"+f[1]+"/"+f[2];
$('#cuota1').datepicker( "setDate" , periodo );
var fechaus=dateText.split('/');
$('#suscripcion_fecha').val(fechaus[2]+"-"+fechaus[1]+"-"+fechaus[0]);
var periodo = f[2]+"-"+f[1]+"-15";
$('#suscripcion_dia_pago').val(periodo);
}
});
 $('#cuota1').datepicker({
regional:'es',
minDate: '01/01/2000',
maxDate: '+1y',
showOn: 'both',
buttonText: 'Cambiar',
autoSize: true,
changeYear: true,
changeMonth: true
});

var p = $('#suscripcion_dia_pago').val().split('-');
$('#cuota1').val('15/'+p[1]+'/'+p[0]);

});

}


</script>

<h1 align="center">Nueva Suscripción</h1>
<br>
<?php include_partial('form', array('form' => $form)) ?>
