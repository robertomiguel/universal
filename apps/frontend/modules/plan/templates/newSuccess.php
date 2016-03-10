<h1 align="center">Nuevo Plan</h1>
<input type="hidden" id="volver1" value="<?php echo $anterior ?>">
<br>
<!-- Porcentaje %<input type="text" id="por100" value="20" style="width:50px" onKeyUp="calcular100();">
Valor Vehículo <input type="text" id="precioreal" value="0" onKeyUp="calcular100();" style="width:100px">
= <input type="text" id="esigual" value="0" style="width:100px" readonly>-->
<?php include_partial('form', array('form' => $form)) ?>
