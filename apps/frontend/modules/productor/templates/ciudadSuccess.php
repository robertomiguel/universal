<h1>Seleccionar Localidad</h1>
<table>
<tr>
<form action="<?php url_for('productor/ciudad') ?>"  method="post">
<td align="center"><input name="cp" placeholder="Código o Nombre Loc...">
<input type="submit" value="Buscar" /></td>
</form>
</tr>
</table>

<table>
<thead>
<th>Cód. Postal</th>
<th>Provincia</th>
<th>Localidad</th>
</thead>
<tbody>
<?php
$cp = $_POST['cp'];

if ($cp<>"") {
$q = Doctrine_Query::create()
       ->select('*')
       ->from("localidad")
       ->where('cp =?', $cp)
       ->orWhere('nombre LIKE ?', "%$cp%")
       ->orderBy('provincia_id');
$respuesta = $q->execute(); 


  foreach($respuesta as $campo) {
	$url= url_for('productor/new?id='.$campo['id']);
echo "<tr><td>". $campo['cp'] . "</td>" .
	"<td>". $campo['provincia'] . "</td>" .
	"<td><a href='$url' >". $campo['nombre'] . "</a></td></tr>";}
}

if (count($respuesta)==0 && $cp<>"") {echo "No existe: $cp";}

?>
</tbody>
</table>
