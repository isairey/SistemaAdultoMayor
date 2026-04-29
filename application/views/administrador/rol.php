<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>

<div class="row">
	<div class="large-12 columns">
		<?php $this->load->view('seccion/mensaje') ?>
	</div>
</div>

<div class="row">
	<div class="large-6 columns large-centered">
		<div class="box no-shadow ">
	        <div class="box-header panel palette-Brown-500 bg">
	            <!-- tools box -->
	            <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
	                <span class="palette-White-Text text" ><?php echo lang('lista.roles') ?></span>
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
	                                <th><?php echo lang('rol') ?></th>
	                                <th><?php echo lang('estado') ?></th>
	                                <th><?php echo lang('opciones') ?></th>
	                            </tr>
	                        </thead>
	                        <tbody>
								<?php $numero = 1; ?>

								<?php foreach ($roles as $rol): ?>
									<tr>
										<td><?php echo $numero ?></td>
										<td><?php echo $rol->nombre ?></td>
										<td><?php echo ($rol->estado=='AC') ? 'ACTIVO' : 'INACTIVO'  ?></td>
										<td>
		                            <div class="small button-group">
												<button data-open="editrol" content="<?php echo $rol->id_rol ?>" title="<?php echo lang('actualizar') ?>" class="button palette-Brown-500 bg editar tooltipster-top" >
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
                  <a data-open="newrol" class="button palette-Brown-500 bg"><i class="fontello-user-add"></i><?php echo lang('registrar.rol') ?></a>
					</div>
				</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<!-- Modal Agregar Usuario  -->

<div class="reveal" id="newrol" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('administrador/registrarrol') ?>">
    	<h3 class="center"><?php echo lang('registrar.rol') ?></h3>
		<div class="row">

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('nombre.rol') ?>
					 <input type="text" required pattern="[a-zA-Z\s]+" name="rol[nombre]">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('estado') ?>
					<?php echo form_dropdown(array('name'=>'rol[estado]'), $estados) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>

			<div class="large-12 columns center">
				<button type="submit" name="new_rol" value="1" class="button palette-Brown-500 bg">
						<i class="fontello-ok"></i><?php echo lang('registrar') ?>
				</button>
			</div>
		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar Usuario -->

<!-- Modal Editar Rol  -->

<div class="reveal" id="editrol" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('administrador/editarrol') ?>">
    	<h3 class="center"><?php echo lang('editar.rol') ?></h3>
		<div class="row">


			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('nombre.rol') ?>
					 <input type="text" required pattern="[a-zA-Z\s]+" name="rol[nombre]" id="rol_nombre">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('estado') ?>
					<?php echo form_dropdown(array('name'=>'rol[estado]', 'id'=>'rol_estado'), $estados) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>

			<div class="large-12 columns center">
				<button type="submit" name="edit_rol" value="1" class="button palette-Brown-500 bg">
						<i class="fontello-edit"></i><?php echo lang('editar.rol') ?>
				</button>
			</div>

				<input type="hidden" name="id_rol" value="" id="rol_id_rol" />
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar Usuario -->

<script type="text/javascript" charset="utf-8">
	$('.editar').click(function() {

		var id = $(this).attr('content');

			$.getJSON('<?php echo site_url('servicio/getRol');?>', { id: id })

			.done(function(data) {
				$("#rol_nombre").val(data.nombre);
				$("#rol_estado").val(data.estado);
				$("#rol_id_rol").val(data.id_rol);
			});
	});
</script>

<?php $this->load->view('seccion/pie'); ?>
