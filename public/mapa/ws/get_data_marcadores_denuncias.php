<?php
	//echo 'HOLA MUNDO';

	require('ClaseBaseDatos.php');
	$mibd= new BaseDatos('192.168.104.114','adminclerk','.Alpaccino.1985.','adultomayor');
	$consulta_busqueda = $_GET['consulta_busqueda'];
	$json_string=$mibd->DevuelveMarcadoresDenuncia($consulta_busqueda);// devuelve todos los marcadores de una capa
	echo json_encode($json_string);

?>
