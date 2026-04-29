<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']        = 'inicio';

/* ADMINISTRADOR */
$route['gestion-usuarios']          = 'administrador/usuarios';
$route['gestion-servidores']        = 'administrador/servidores';
$route['gestion-funciones']         = 'administrador/funciones';
$route['gestion-roles']             = 'administrador/roles';
$route['gestion-gestiones']         = 'administrador/gestiones';
$route['gestion-categorias']        = 'administrador/categorias';
$route['gestion-centros']           = 'administrador/centros';
$route['comprobantes']			        = 'administrador/comprobantes';

/* ESTADISTICAS */
$route['victimas-sexo']                     = 'pdfs/index';
$route['cantidad-victimas-por-genero']      =  'stat/cantidad_victimas_VM';
$route['cantidad-denunciados-por-parentesco'] =  'stat/cantidad_denunciados_parentescos';
$route['cantidad-denuncias-en-instancias']  =  'stat/cantidad_denuncia_instancia';
$route['cantidad-denuncias-acogidas']       =  'stat/cantidad_denuncia_acogida';
$route['cantidad-denuncias-procedencias']   =  'stat/cantidad_procedencia_denuncia';
$route['cantidad-denuncias-tipologias']     =  'stat/cantidad_denuncia_tipologia';
$route['cantidad-denuncias-areas']          =  'stat/cantidad_denuncias_area';
$route['cantidad-denuncias-intervenciones'] = 'stat/cantidad_denuncias_intervenciones';
$route['cantidad-denuncias-terapias']       = 'stat/cantidad_denuncias_terapia';
$route['cantidad-denuncias-intervenciones-sociales'] = 'stat/cantidad_denuncias_intervencion_social';
$route['cantidad-denuncias-archivadas-cerradas']      =  'stat/cantidad_denuncias_arch_cerr';



/* PERFIL */
$route['cerrar-sesion']             = 'perfil/cerrar';
$route['cambiar-contrasenia']       = 'perfil/contrasenias';
$route['gestion-denuncias']		      = 'perfil/gestion_denuncia';
  /* PARTICIPANTES  */
$route['denuncia']                  = 'denuncias/denuncia';
$route['denuncia-archivada']        = 'denuncias/denunciaarchivada';
$route['denuncia-cerrada']          = 'denuncias/denunciacerrada';
$route['gestion-denunciante']        = 'denuncias/denunciante';
/* COBROS */
$route['cobros-beneficiario']	      =	'cobros/index';
$route['reporte-de-cobros']         = 'cobros/reporte';
$route['reporte-de-pagos']          = 'cobros/pagos';
$route['reporte-pendientes']        = 'cobros/pendientes';

/*  HISTORIAL  */
$route['historial-index']           = 'historial/index';
/* KARDEX */
//$route['kardex']				             ='kardex/index';
$route['kardex']				            ='kardex/detallekardex';
$route['kardex-discapacitado/(:num)']='kardex/reporte/$1';

$route['404_override']              = '';
$route['translate_uri_dashes']      =  FALSE;


/* GESTION */
$route['gestion']                   = 'gestion/index';
$route['informe-gestion/(:num)']    = 'gestion/reporte/$1';

/* MONTO */
$route['monto']                     =  'monto/index';
$route['mapa']                      =  'map/index';

/*BENEFICIARIO*/
$route['beneficiarios']             =  'beneficiario/index';

/* INICIO */
$route['inicio']                    = 'inicio/index';

/*  ver kardex*/
$route['ver-kardex/(:num)']         = 'kardex/ver_kardex/$1';
