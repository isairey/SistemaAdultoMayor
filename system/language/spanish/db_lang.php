<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['db_invalid_connection_str'] = 'No se puede determinar la configuración de la base de datos en función de la cadena de conexión enviada.';
$lang['db_unable_to_connect'] = 'No se puede conectar al servidor de base de datos con la configuración proporcionada.';
$lang['db_unable_to_select'] = 'No se puede seleccionar la base de datos especificada: %s';
$lang['db_unable_to_create'] = 'No se puede crear la base de datos especificada: %s';
$lang['db_invalid_query'] = 'La consulta que envió no es válida.';
$lang['db_must_set_table'] = 'Debe establecer la tabla de base de datos que se utilizará con la consulta.';
$lang['db_must_use_set'] = 'Debe utilizar el método "set" para actualizar una entrada.';
$lang['db_must_use_index'] = 'Debe especificar un índice para que coincida con el de las actualizaciones por lotes.';
$lang['db_batch_missing_index'] = 'Una o más filas enviadas para la actualización por lotes no tienen el índice especificado.';
$lang['db_must_use_where'] = 'Las actualizaciones no están permitidas a menos que contengan una cláusula "where".';
$lang['db_del_must_use_where'] = 'Las eliminaciones no están permitidas a menos que contengan una cláusula "where" o "like".';
$lang['db_field_param_missing'] = 'Para buscar campos se necesita el nombre de la tabla como parámetro.';
$lang['db_unsupported_function'] = 'Esta función no está disponible para la base de datos que está utilizando.';
$lang['db_transaction_failure'] = 'Error de transacción: Se ha realizado un rollback.';
$lang['db_unable_to_drop'] = 'No se puede eliminar la base de datos especificada.';
$lang['db_unsupported_feature'] = 'Función no admitida de la plataforma de base de datos que está utilizando.';
$lang['db_unsupported_compression'] = 'El formato de compresión de archivos elegido no es compatible con el servidor.';
$lang['db_filepath_error'] = 'No se pueden escribir datos en la ruta del archivo que has enviado.';
$lang['db_invalid_cache_path'] = 'La ruta de caché que envió no es válida ni puede escribirse.';
$lang['db_table_name_required'] = 'Se requiere un nombre de tabla para esa operación.';
$lang['db_column_name_required'] = 'Se requiere un nombre de columna para esa operación.';
$lang['db_column_definition_required'] = 'Se requiere una definición de columna para esa operación.';
$lang['db_unable_to_set_charset'] = 'No se puede establecer el conjunto de caracteres de conexión del cliente: %s';
$lang['db_error_heading'] = 'Ocurrió Un Error en la Base de Datos';
