<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>

<div class="row">
	<div class="large-12 columns">
		<?php $this->load->view('seccion/mensaje') ?>
	</div>
</div>

<div class="row">
	<div class="large-12 columns">
		<div class="box no-shadow ">
	        <div class="box-header panel palette-Orange-700 bg">
	            <!-- tools box -->
	            <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
	                <span class="palette-White-Text text" ><?php echo lang('lista.postulante') ?></span>
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
	                                <th><?php echo lang('n') ?></th>
	                                <th><?php echo lang('nombre.completo') ?></th>
	                                <th><?php echo lang('dni') ?></th>
	                                <th><?php echo lang('fecha.nacimiento') ?></th>
	                                <th><?php echo lang('nacionalidad') ?></th>
	                                <th><?php echo lang('genero') ?></th>
	                                <th><?php echo lang('ultimo.acesso') ?></th>
	                                <th><?php echo lang('opciones') ?></th>

	                            </tr>
	                        </thead>
	                        <tbody>
								<?php $numero = 1; ?>

								<?php foreach ($usuarios as $usuario): ?>
									<tr>
										<td><?php echo $numero ?></td>
										<td><?php echo $usuario->nombre_completo ?></td>
										<td><?php echo $usuario->dni ?></td>
										<td><?php echo $usuario->nombre_rol ?></td>
										<td><?php echo $usuario->nombre_usuario ?></td>
										<td><?php echo ($usuario->estado === 'AC') ? 'ACTIVO' : 'INACTIVO' ; ?></td>
										<td><?php echo $usuario->ultimo_ingreso ?></td>
										<td>
		                            <div class="small button-group">
												<button data-open="editusuario" content="<?php echo $usuario->id_usuario ?>" title="<?php echo lang('actualizar') ?>" class="button palette-Orange-700 bg editar tooltipster-top" >
													<i class="fontello-pencil"></i>
                                    </button>
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
                  <a data-open="newusuario" class="button palette-Orange-700 bg"><i class="fontello-user-add"></i><?php echo lang('registrar.usuario') ?></a>
					</div>
				</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<!-- Modal Agregar Usuario  -->

<div class="reveal" id="newusuario" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('administrador/registrarusuario') ?>">
    	<h3 class="center"><?php echo lang('registrar.usuario') ?></h3>
		<div class="row">

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('nombre.completo') ?>
					 <input type="text" required pattern="[a-zA-Z\s]+" name="usuario[nombre_completo]">
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

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('rol') ?>
					<?php echo form_dropdown(array('name'=>'usuario[id_rol]','required'=>'required'), $roles) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('usuario') ?>
					 <input type="text" required pattern="[a-zA-Z]+" name="usuario[nombre_usuario]">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('contrasenia') ?>
					 <input type="text" required pattern="[a-zA-Z0-9/*#.]+" name="contrasenia">
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
				<button type="submit" name="new_user" value="1" class="button palette-Orange-700 bg">
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
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('administrador/editarusuario') ?>">
    	<h3 class="center"><?php echo lang('editar.usuario') ?></h3>
		<div class="row">
				<div class="large-12 medium-12 small-12 columns">
					<label>
						 <?php echo lang('nombre.completo') ?>
						 <input type="text" required pattern="[a-zA-Z\s]+" name="usuario[nombre_completo]" id="usuario_nombre_completo">
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

				<div class="large-12 medium-12 small-12 columns">
					<label>
						<?php echo lang('rol') ?>
						<?php echo form_dropdown(array('name'=>'usuario[id_rol]','required'=>'required', 'id'=>'usuario_id_rol'), $roles) ?>
						<span class="form-error"><?php echo lang('requerido') ?></span>
					</label>
				</div>

				<div class="large-12 medium-12 small-12 columns">
					<label>
						<?php echo lang('usuario') ?>
						 <input type="text" readonly="TRUE" id="usuario_nombre_usuario">
						 <span class="form-error"><?php echo lang('alfabetico') ?></span>
					</label>
				</div>

				<div class="large-12 medium-12 small-12 columns">
					<label>
						<?php echo lang('estado') ?>
						<?php echo form_dropdown(array('name'=>'usuario[estado]', 'id'=>'usuario_estado'), $estados) ?>
					</label>
				</div>

				<div class="large-12 columns center">
					<button type="submit" name="edit_user" class="button palette-Orange-700 bg">
							<i class="fontello-ok"></i><?php echo lang('actualizar') ?>
					</button>
				</div>

				<input type="hidden" name="id_usuario" value="" id="usuario_id_usuario" />
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar Usuario -->

<script type="text/javascript" charset="utf-8">
	$('.editar').click(function() {

		var id = $(this).attr('content');

			$.getJSON('<?php echo site_url('servicio/getUsuario');?>', { id: id })

			.done(function(data) {
				$("#usuario_nombre_completo").val(data.nombre_completo);
				$("#usuario_dni").val(data.dni);
				$("#usuario_id_rol").val(data.id_rol);
				$("#usuario_nombre_usuario").val(data.nombre_usuario);
				$("#usuario_estado").val(data.usuario_estado);
				$("#usuario_id_usuario").val(data.id_usuario);
			});
	});
</script>

<?php $this->load->view('seccion/pie'); ?>
