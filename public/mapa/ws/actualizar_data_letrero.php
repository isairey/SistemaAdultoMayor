<?php
	require('ClaseBaseDatos.php');
	$mibd= new BaseDatos('localhost','urenia','urenia2017freedom17','recaudaciones');

       
        $id = $_GET['id'];
	    $comuna = $_GET['comuna'];
	    $posicion_x = $_GET['posicion_x'];
	    $posicion_y = $_GET['posicion_y'];
       
       /* 
        $id=8;
        $comuna="''";
        $posicion_x="''";
        $posicion_y="''";
*/

       
	$json_string=$mibd->ActualizarDatoLetrero($id, $comuna, $posicion_x, $posicion_y);// devuelve todos los marcadores de una capa
	echo ($json_string);
?>