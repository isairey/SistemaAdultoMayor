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
	                <span class="palette-White-Text text" ><?php echo lang('lista.gestiones') ?></span>
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
	                                <th><?php echo lang('gestion') ?></th>
	                                <th><?php echo lang('estado') ?></th>
	                                <th><?php echo lang('opciones') ?></th>
	                            </tr>
	                        </thead>
	                        <tbody>
								<?php $numero = 1; ?>

								<?php foreach ($gestiones as $gestion): ?>
									<tr>
										<td><?php echo $numero ?></td>
										<td><?php echo $gestion->gestion?></td>
										<td><?php echo ($gestion->estado=='AC') ? 'ACTIVO' : 'INACTIVO'  ?></td>
										<td>
		                   <div class="small button-group">
												  <button data-open="editgestion" content="<?php echo $gestion->id_gestion ?>" title="<?php echo lang('actualizar') ?>" class="button palette-Brown-500 bg editar tooltipster-top" >
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
                  <a data-open="newgestion" class="button palette-Brown-500 bg"><i class="fontello-user-add"></i><?php echo lang('registrar.gestion') ?></a>
					</div>
				</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<!-- Modal Agregar Usuario  -->

<div class="reveal" id="newgestion" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('administrador/registrargestion') ?>">
    	<h3 class="center"><?php echo lang('registrar.gestion') ?></h3>
		<div class="row">

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('nombre.gestion') ?>
					 <input type="text" required pattern="[0-9]{4}" name="gestion[gestion]">
					 <span class="form-error"><?php echo lang('numeric') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('estado') ?>
					<?php echo form_dropdown(array('name'=>'gestion[estado]'), $estados) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>

			<div class="large-12 columns center">
				<button type="submit" name="new_gestion" value="1" class="button palette-Brown-500 bg">
						<i class="fontello-ok"></i><?php echo lang('registrar') ?>
				</button>
			</div>
		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar Usuario -->

<!-- Modal Editar Rol  -->

<div class="reveal" id="editgestion" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('administrador/editargestion') ?>">
    	<h3 class="center"><?php echo lang('editar.gestion') ?></h3>
		<div class="row">


			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('nombre.gestion') ?>
					 <input type="text" required pattern="[0-9]{4}" name="gestion[gestion]" id="gestion_gestion">
					 <span class="form-error"><?php echo lang('numeric') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('estado') ?>
					<?php echo form_dropdown(array('name'=>'gestion[estado]', 'id'=>'gestion_estado'), $estados) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>

			<div class="large-12 columns center">
				<button type="submit" name="edit_gestion" value="1" class="button palette-Brown-500 bg">
						<i class="fontello-edit"></i><?php echo lang('editar.gestion') ?>
				</button>
			</div>

				<input type="hidden" name="id_gestion" value="" id="gestion_id_gestion" />
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar Usuario -->

<script type="text/javascript" charset="utf-8">
	$('.editar').click(function() {

		var id = $(this).attr('content');

			$.getJSON('<?php echo site_url('servicio/getGestion');?>', { id: id })

			.done(function(data) {
				$("#gestion_gestion").val(data.gestion);
				$("#gestion_estado").val(data.estado);
				$("#gestion_id_gestion").val(data.id_gestion);
			});
	});
</script>

<?php $this->load->view('seccion/pie'); ?>
