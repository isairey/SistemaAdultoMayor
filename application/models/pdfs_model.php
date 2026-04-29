<?php
class Pdfs_model extends CI_Model
{
 function __construct()
 {
 parent::__construct();
 }
 //obtenemos las victimas para cargar en el select
 function getGestion()
 {
 $query = $this->db->get('gestion');
 if($query->num_rows()>0)
 {
 foreach ($query->result() as $fila)
 {
 $data[] = $fila;
 }
 return $data;
 }
 }
    //obetenemos el sexo de las victimas dependiendo de la gestion
    //obtenemos las localidades dependiendo de la victima escogida
    function getGestionSelecciona($gestion)
 {
        $query = $this->db->query('SELECT  v.sexo,v.id_victima,g.gestion,g.id_gestion
                                  from victima v inner join denuncia d
                                  on v.id_victima = d.id_victima
                                  inner join gestion g
                                  on g.id_gestion = d.id_gestion
                                  where g.id_gestion='.$gestion
                                  );
        $data["victimas"]=array();
     if($query->num_rows()>0)
     {
       foreach ($query->result() as $fila)
       {
         $data["victimas"][$fila->id]["v.id_victima"] = $fila->id;
         $data["victimas"][$fila->id]["v.sexo"] = $fila->sexo;
         $data["victimas"][$fila->id]["g.gestion"] = $fila->gestion;
         $data["victimas"][$fila->id]["g.id_gestion"] = $fila->id_gestion;

       }
       return $data["victimas"];
      }
 }
}
/*pdf_model.php
 * el modelo
 */
