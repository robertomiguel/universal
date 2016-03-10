<?php decorate_with(false) ?>
<html>
<head>
	<title>Roberto Miguel</title>
</head>
<style>
.marcas {width: 100px}
.panel {padding: 15px;width: 80%;margin-left: 10%; margin-right: 10%;text-align: center;position:fixed;bottom:50px}
.panel td {vertical-align: middle;}
.zoom img:hover {-moz-transform:scale(1.4); -webkit-transform:scale(1.4); -o-transform:scale(1.4);}
.pie {position:fixed;bottom:0;width:100%;background:white}
.pie p{text-align:center}
</style>
<body>
	<div class="fechaServer">
<?php
setlocale(LC_TIME, "es_ES");
echo utf8_encode(strftime(" %e de %B %Y"));
//$id = $this->getUser()->getGuardUser()->getEmpleador()->getId();
if ($sf_user->isAuthenticated())
 {
  echo "<br><br><a href='".url_for('@sf_guard_signout')."'>Desconectar</a><br><br>";
  echo "<a href='suscripcion'>Administración</a>";

} else {echo "<br><a href='".url_for('@sf_guard_signin')."'>Acceso</a>";}
?><br><br>
<a href="http://premiernoa.com.ar/soportenoa.exe">Soporte para Windows</a>
</div>
<center>
<img src="images/construccion.jpg">
</center>
</body>
</html>
