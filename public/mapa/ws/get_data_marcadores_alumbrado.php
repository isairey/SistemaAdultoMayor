<?php
	require('ClaseBaseDatos.php');
	$mibd= new BaseDatos('localhost','adminclerk','.Alpaccino.1985.','observador');
	$consulta_busqueda = $_GET['consulta_busqueda'];
	$json_string=$mibd->DevuelveMarcadoresAlumbrado($consulta_busqueda);// devuelve todos los marcadores de una capa
	echo ($json_string);

?>
