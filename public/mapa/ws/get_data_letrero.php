<?php
	require('ClaseBaseDatos.php');
	$mibd= new BaseDatos('localhost','urenia','urenia2017freedom17','recaudaciones');
	$id = $_GET['id'];
	$json_string=$mibd->DevuelveInfoLetrero($id);// devuelve todos los marcadores de una capa
	echo ($json_string);
?>