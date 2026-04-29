<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>

<div class="row">
	<div class="large-12 columns">
		<?php $this->load->view('seccion/mensaje') ?>
	</div>
</div>

<div class="row">
	<div class="large-8 columns large-centered" >
		<div class="box no-shadow ">
	        <div class="box-header panel palette-Brown-500 bg">
	            <!-- tools box -->
	            <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
	                <span class="palette-White-Text text" ><?php echo lang('lista.usuarios') ?></span>
	            </h3>
	        </div>


	        <!-- /.box-header -->
	        <div class="box-body">
	        <!-- Table -->
	            <div class="row">
	                <div class="large-12 columns">
	                    <table class="stack dinamico">
	                        <thead>
	                            <tr>
	                                <th><?php echo lang('numero') ?></th>
	                                <th><?php echo lang('nombre.completo') ?></th>
	                                <th><?php echo lang('dni') ?></th>
	                                <th><?php echo lang('rol') ?></th>
																	<th><?php echo lang('centro') ?></th>
	                                <th><?php echo lang('nombre.usuario') ?></th>
	                                <th><?php echo lang('estado') ?></th>
	                                <th><?php echo lang('opciones') ?></th>

	                            </tr>
	                        </thead>
	                        <tbody>
															<?php $numero = 1; ?>

															<?php foreach ($usuarios as $usuario): ?>
																<tr>
																	<td><?php echo $numero ?></td>
																	<td><?php echo $usuario->nombres.' '.$usuario->paterno.' '.$usuario->materno ?></td>
																	<td><?php echo $usuario->dni ?></td>
																	<td><?php echo $usuario->nombre ?></td>
																	<td><?php echo $usuario->id_centro ?></td>
																	<td><?php echo $usuario->usuario ?></td>
																	<td><?php echo ($usuario->estado === 'AC') ? 'ACTIVO' : 'INACTIVO' ; ?></td>
																	<td>
									                  <div class="small button-group">
																			<button data-open="editusuario" content="<?php echo $usuario->id_usuario ?>" title="<?php echo lang('actualizar') ?>" class="button palette-Brown-500 bg editar tooltipster-top" >
																					<i class="fontello-pencil"></i>
							                        </button>
																			<?php if($usuario->estado === 'AC'): ?>
																				<button data-open="asignarfuncion" content="<?php echo $usuario->id_usuario ?>" title="<?php echo lang('asignar.permisos') ?>" class="button palette-Brown-500 bg funciones tooltipster-top" >
																						<i class="fontello-key"></i>
								                        </button>
																			<?php endif; ?>
																		</div>
								                  </td>
																</tr>
																<?php $numero++; ?>
															<?php endforeach ?>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	            <!-- end Table -->
	            <div class="row">
								<div class="large-12 columns">
			                  <a data-open="newusuario" class="button palette-Brown-500 bg"><i class="fontello-user-add"></i><?php echo lang('registrar.usuario') ?></a>
								</div>
							</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<!-- Modal Agregar Usuario  -->

<div class="reveal" id="newusuario" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('admin/usuario/registrar') ?>">
    	<h3 class="center"><?php echo lang('registrar.usuario') ?></h3>
		<div class="row">

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('nombres') ?>
					 <input type="text" required pattern="[a-zA-ZñÑ\s]+" name="usuario[nombres]">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('primer.apellido') ?>
					 <input type="text" required pattern="[a-zA-ZñÑ\s]+" name="usuario[paterno]">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('segundo.apellido') ?>
					 <input type="text" pattern="[a-zA-ZñÑ\s]+" name="usuario[materno]">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('dni') ?>
					 <input type="text" required pattern="[0-9]+[a-zA-Z-]{0,2}" name="usuario[dni]">
					 <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
				</label>
			</div>

			<div class="large-6 medium-6 small-6 columns">
				<label>
					<?php echo lang('rol') ?>
					<?php echo form_dropdown(array('name'=>'usuario[id_rol]','required'=>'required'), $roles) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>

			<div class="large-6 medium-6 small-6 columns">
				<label>
					<?php echo lang('centro') ?>
					<?php echo form_dropdown(array('name'=>'usuario[id_centro]','required'=>'required'), $centros) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('usuario') ?>
					 <input type="text" required pattern="[a-zA-Z]+" name="usuario[usuario]">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('contrasenia') ?>
					 <input type="password" required pattern="[a-zA-Z0-9/*#.]+" name="contrasenia">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('estado') ?>
					<?php echo form_dropdown(array('name'=>'usuario[estado]'), $estados) ?>
				</label>
			</div>

			<div class="large-12 columns center">
				<button type="submit" name="new_user" value="1" class="button palette-Brown-500 bg">
						<i class="fontello-ok"></i><?php echo lang('registrar') ?>
				</button>
			</div>
		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar Usuario -->

<!-- Modal Editar Usuario  -->

<div class="reveal" id="editusuario" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('admin/usuario/editar') ?>">
    	<h3 class="center"><?php echo lang('editar.usuario') ?></h3>
		<div class="row">
				<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('nombres') ?>
					 <input type="text" required pattern="[a-zA-ZñÑ\s]+" name="usuario[nombres]" id="usuario_nombres">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('primer.apellido') ?>
					 <input type="text" required pattern="[a-zA-ZñÑ\s]+" name="usuario[paterno]" id="usuario_paterno">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('segundo.apellido') ?>
					 <input type="text" pattern="[a-zA-ZñÑ\s]+" name="usuario[materno]" id="usuario_materno">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

				<div class="large-12 medium-12 small-12 columns">
					<label>
						<?php echo lang('dni') ?>
						 <input type="text" required pattern="[0-9]+[a-zA-Z-]{0,2}" name="usuario[dni]" id="usuario_dni">
						 <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
					</label>
				</div>

				<div class="large-6 medium-6 small-6 columns">
					<label>
						<?php echo lang('rol') ?>
						<?php echo form_dropdown(array('name'=>'usuario[id_rol]','required'=>'required', 'id'=>'usuario_id_rol'), $roles) ?>
						<span class="form-error"><?php echo lang('requerido') ?></span>
					</label>
				</div>
				<div class="large-6 medium-6 small-6 columns">
					<label>
						<?php echo lang('centro') ?>
						<?php echo form_dropdown(array('name'=>'usuario[id_centro]','required'=>'required', 'id'=>'usuario_id_centro'), $centros) ?>
						<span class="form-error"><?php echo lang('requerido') ?></span>
					</label>
				</div>

				<div class="large-12 medium-12 small-12 columns">
					<label>
						<?php echo lang('usuario') ?>
						 <input type="text" readonly="TRUE" id="usuario_usuario">
						 <span class="form-error"><?php echo lang('alfabetico') ?></span>
					</label>
				</div>

				<div class="large-12 medium-12 small-12 columns">
					<label>
						<?php echo lang('estado') ?>
						<?php echo form_dropdown(array('name'=>'usuario[estado]', 'id'=>'estado'), $estados) ?>
					</label>
				</div>

				<div class="large-12 columns center">
					<button type="submit" name="edit_user" class="button palette-Brown-500 bg">
							<i class="fontello-ok"></i><?php echo lang('actualizar') ?>
					</button>
				</div>

				<input type="hidden" name="id_usuario" value="" id="usuario_id_usuario" />
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar Usuario -->

<!-- Modal Editar Usuario  -->

<div class="reveal" id="asignarfuncion" data-reveal="">

 	<h3 class="center"><?php echo lang('asignar.funcion') ?></h3>

	<div class="row">
			<div class="large-12 columns" id="contenido">

			</div>
	</div>


	<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
</div>

<!-- Fin Agregar Usuario -->

<script type="text/javascript" charset="utf-8">
	$('.editar').click(function() {

		var id = $(this).attr('content');

			$.getJSON('<?php echo site_url('servicio/getUsuario');?>', { id: id })

			.done(function(data) {
				$("#usuario_nombres").val(data.nombres);
				$("#usuario_paterno").val(data.paterno);
				$("#usuario_materno").val(data.materno);
				$("#usuario_dni").val(data.dni);
				$("#usuario_id_rol").val(data.id_rol);
				$("#usuario_id_centro").val(data.id_centro);
				$("#usuario_usuario").val(data.usuario);
				$("#usuario_estado").val(data.usuario_estado);
				$("#usuario_id_usuario").val(data.id_usuario);
			});
	});

	$('.funciones').click(function() {

		var id_usuario = $(this).attr('content');

		$.ajax({
			url: '<?php echo site_url('servicio/getFunciones') ?>',
			type: 'POST',
			dataType: 'html',
			data: {id: id_usuario}
		})
		.done(function(data) {
			$('#contenido').html(data);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});

	function updatePermiso(id_permiso, estado) {

	   $.ajax({
			 url: '<?php echo site_url('servicio/updatePermiso') ?>',
			 type: 'POST',
			 dataType: 'html',
			 data: {id: id_permiso, estado: estado}
	   })
	   .done(function(data) {
			 $('#contenido').html(data);
	   })
	   .fail(function() {
			 console.log("error");
	   })
	   .always(function() {
			 console.log("complete");
	   });
	};


</script>
<script>

     $('.tooltipster-top').tooltipster({
         position: "top"
     });

     $('.dinamico').DataTable({

       "order": [[0, "asc"]],

       responsive: true,

       "language":{
                      "lengthMenu": "Mostrar _MENU_",
                      "zeroRecords": "No se encontró nada",
                      "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                      "infoEmpty": "No hay registros disponibles",
                      "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                      "search": "Buscar",
                      "previous": "Anterior",
                      "oPaginate": { "sNext":"Siguiente", "sLast": "Último", "sPrevious": "Anterior", "sFirst":"Primero" },
                      "oAria":
                              {
                                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                              }
                  }
    });
</script>



<?php $this->load->view('seccion/pie'); ?>
