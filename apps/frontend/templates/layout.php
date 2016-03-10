<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>

<link rel="stylesheet" type="text/css" href="/css/global.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/lateral.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/imprimir.css" media="print" />
<link rel="stylesheet" type="text/css" href="/css/zebra_dialog.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/jquery.autocomplete.css" media="screen" />

<script src="/js/jquery.cookie.js"></script>
<script src="/js/jquery.ui.datepicker-es.js"></script>
<script src="/js/global.js"></script>
<script src="/js/envioajax.js"></script>
<script src="/js/validar.js"></script>
<script src="/js/jquery.tablesorter.min.js"></script>
<script src="/js/jquery.tablescroll.js"></script>
<script src="/js/zebra_dialog.js"></script>

  </head>
  <body>
 <div class="detalle">

<div class="cabeza">
<table>
  <tr>
    <td style="width:150"><center><h2 class="fechaServer"> <?php echo date('d / m / Y'); ?></h2></center></td>
  </tr>
</table>
</div>

<div class="lateral">
 <ul id="nav">
    <li><p>Menú</p>
        <ul>
          <li id="<?php echo url_for('suscripcion/index') ?>"  onclick="menu(this);">
          <img src="/images/m1.png"/> Suscripciones</li>
          <li id="<?php echo url_for('suscripcion/verbajas') ?>"  onclick="menu(this);">
          <img src="/images/m6.gif"/> Bajas</li>  
            <li id="<?php echo url_for('suscripcion/listado') ?>"  onclick="menu(this);">
            <img src="/images/m7.png"/> Notas</li>
       <!--   <li id="<?php echo url_for('plan/index') ?>"  onclick="menu(this);">
            <img src="/images/m2.gif"/> Planes</li>
          <li id="<?php echo url_for('rubro/index') ?>"  onclick="menu(this);">
            <img src="/images/m3.gif"/> Rubros</li> -->
          <li id="<?php echo url_for('productor/index') ?>"  onclick="menu(this);">
            <img src="/images/m4.png"/> Vendedores</li>
          <li id="<?php echo url_for('suscriptor/index') ?>"  onclick="menu(this);">
            <img src="/images/m5.gif"/> Clientes</li>
          <li id="<?php echo url_for('cuota/morosos') ?>"  onclick="menu(this);">
            <img src="/images/ok.gif"/> Marcar Pagos</li>
          <li id="<?php echo url_for('cuota/consultas') ?>"  onclick="menu(this);">
            <img src="/images/ver.png"/> Consultas x mes</li>
          <li id="<?php echo url_for('cuota/liquidacion') ?>"  onclick="menu(this);">
            <img src="/images/imprimir.gif"/> Liquidación</li>
          <li id="<?php echo url_for('localidad/index') ?>"  onclick="menu(this);">
            <img src="/images/city.png"/> Localidades</li>
<!--          <li id="<?php echo url_for('ayuda/index') ?>"  onclick="menu(this);">
            <img src="/images/ayuda.png"/> Ayuda</li> -->
        </ul>
    </li>
 </ul>
<!--<br>&nbsp;<img src="/images/logocolor.jpg" /> -->
<br><br>
<?php 
echo "<a class='btn' href='".url_for('@sf_guard_signout')."'>DESCONECTAR</a>";
 ?>
 <br><br>
 <a href="/imprimir/generarzip">[ GENERAR ZIP ]</a>
<br><br>
 <a href="/imprimir/resguardo">[ DESCARGAR DB ]</a>
</div>

<div class="fondo">

<div class="fondolista">
    <?php echo $sf_content ?>
</div>
<br><br>

</div>
 </div>
<div class="imprimir" id="imprimir"></div>
  </body>
</html>