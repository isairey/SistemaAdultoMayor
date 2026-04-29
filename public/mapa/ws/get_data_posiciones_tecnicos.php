<?php
	require('ClaseBaseDatos.php');
	$mibd= new BaseDatos('localhost','adminclerk','.Alpaccino.1985.','adultomayor');
	$consulta_busqueda = $_GET['consulta_busqueda'];
	$json_string=$mibd->DevuelvePosicionesTecnicos($consulta_busqueda);// devuelve todos los marcadores de una capa
	echo ($json_string);

?>
