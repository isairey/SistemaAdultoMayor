<?php

class BaseDatos
 {
    var $servidor;
    var $usuario ;
    var $password;
    var $db;
    function __construct($serv,$usu,$pass,$bd)
    {
          $this->servidor=$serv;
          $this->usuario=$usu;
          $this->password=$pass;
	        $this->db=pg_connect("host=$serv dbname=$bd user=$usu password=$pass");
          if (!$this->db)
          {
            die('No es posible conectarse a la base de datos');
          }
    }

   function __destruct()
   {
   }
   function EntregaConexion()
   {
	   return $this->db;
   }

   function DevuelveMarcadoresDenuncia($consulta)
   {
        $resQuery= pg_query($this->db,$consulta);
       $lista = pg_fetch_all($resQuery);
       return $lista;
    }

/*
   function DevuelvePosicionesTecnicos($consulta)
   {

         $res= pg_query($this->db,$consulta);
         $json = array();
         $limit=pg_numrows($res);
         for($rownum=0;$rownum<$limit;$rownum++)
         {
              $row=pg_fetch_array($res, $rownum);
              $bus  = array(

                              'coord_e'=> $row['coord_e'],
                              'coord_s'=> $row['coord_s'],
                              'nombre_completo'=> $row['nombre_completo'],
                              'hora_registro'=> $row['hora_registro'],
                            );
          array_push($json, $bus);

         }
         return $jsonstring = json_encode($json);
    }
    */


 }
?>
