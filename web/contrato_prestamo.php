<?php 

	$fecha1 = '28/08/2016';

	$prestatario_nombre 	= 'Montenegro Ariel';
	$prestatario_doc		= '21.810.528';
	$prestatario_domicilio 	= 'Montevideo 6430';
	$prestatario_localidad 	= 'Rosario';
	$prestatario_provincia 	= 'Santa Fe';

	$monto_total 		= '$ 48.600';
	$monto_total_letras = 'cuarenta y ocho mil seiscientos pesos';
	$prestamo_dia 		= '29';
	$prestamo_mes 		= 'agosto';
	$prestamo_anio 		= '2016';

	$cant_cuotas = '18';
	$importe_cuota = '$ 2.700';
	$interes = "62";
	$fecha_cuota1 = "01/09/2016";

	$acuerdo_dia = '29';
	$acuerdo_mes = 'agosto';
	$acuerdo_anio = '2016';
?>
<!DOCTYPE html>
<head>
        <meta charset="UTF-8" />
<style>

	div {
		width: 19cm; 
		
		padding: 0.5cm;
	}

	.firmas {
		width: 100%;
		border-spacing: 20px;
		text-align: center;
	}
	.membrete {
		height: 2cm;
	}
</style>
</head>
<body>
<div class="membrete"></div>
<div align="center">
	CONTRATO DE PRESTAMO DE DINERO
</div>

<div align="right">
	FECHA <?php echo $fecha1 ?>
</div>

<div align="justify">
	Conste por el presente contrato de Préstamo de Dinero que celebramos de una parte el/la Sr/Sra 
	<strong><?php echo $prestatario_nombre ?></strong>, identificado/a con DNI. Nro  
	<strong><?php echo $prestatario_doc ?></strong>, 
	domiciliado en 
	<strong><?php echo $prestatario_domicilio ?></strong> de la ciudad de 
	<strong><?php echo $prestatario_localidad ?></strong>, provincia de 
	<strong><?php echo $prestatario_provincia ?></strong>, a quien en adelante se le denominará, <strong>EL PRESTATARIO</strong> y de la otra parte <strong>PREMIER NOA SRL</strong> CUIT. Nro.30-71444729-3, con sede en Lima 1422 de la ciudad de Rosario, provincia de Santa Fe, a quien en adelante se le denominará <strong>LA EMPRESA</strong>, ambas partes llegan a los acuerdos siguientes:
</div>	

<div align="justify">
PRIMERO. <br>
<strong>LA EMPRESA</strong> cede en calidad de PRESTAMO al <strong>PRESTATARIO</strong> la suma de 
<strong><?php echo $monto_total ?> (<?php echo $monto_total_letras ?>)</strong> a el/la Sr/Sra 
<strong><?php echo $prestatario_nombre ?></strong> el día 
<?php echo $prestamo_dia ?> de <?php echo $prestamo_mes ?> del año <?php echo $prestamo_anio ?>.
</div>

<div align="justify">
SEGUNDO.<br>
<strong>EL PRESTATARIO</strong> acepta dicho dinero en calidad de préstamo y asegura haber recibido el total 
del dinero a la firma del presente documento, por lo que se compromete a devolver dicha suma de dinero en 
<strong><?php echo $cant_cuotas ?> cuotas mensuales de <?php echo $importe_cuota ?></strong>, que deberá abonar del 1ero al 15 de cada mes, a partir de la fecha <?php echo $fecha_cuota1 ?>, asimismo ambas partes acuerdan que dicho préstamo generará el interés del <?php echo $interes ?>%
</div>

<div align="justify">
TERCERO. <br>
 En caso de incumplimiento de parte del <strong>PRESTATARIO</strong>, <strong>LA EMPRESA</strong> queda facultada a recurrir a las autoridades pertinentes y hacer valer sus derechos, por lo que el presente documento es suficiente medio probatorio y vale como RECIBO.
</div>

<div align="justify">	
CUARTO. <br>
 Ambas partes señalan y aseguran que en la celebración del mismo no ha mediado error de nulidad o anulabilidad que pudiera invalidar el contenido del mismo, por lo que proceden a firmar en la ciudad de Rosario, <?php echo $acuerdo_dia ?> de 
 <?php echo $acuerdo_mes ?> del <?php echo $acuerdo_anio ?>.
</div>
<br><br>
<br><br>
<br>
<div align="center">
	<table align="center" class="firmas">
		<tr>
			<td>
				<strong>..............................................................</strong><br>
				FIRMA PRESTATARIO
			</td>
			<td>
				<strong>..............................................................</strong><br>
				ACLARACION
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<br>
				<strong>..............................................................</strong><br>
				FIRMA GERENTE PREMIER NOA
			</td>
		</tr>
	</table>
</div>

</body>
</html>
