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
	                <span class="palette-White-Text text" ><?php echo lang('lista.funciones') ?></span>
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
	                                <th><?php echo lang('funcion') ?></th>
	                                <th><?php echo lang('estado') ?></th>
	                                <th><?php echo lang('opciones') ?></th>
	                            </tr>
	                        </thead>
	                        <tbody>
								<?php $numero = 1; ?>

								<?php foreach ($funciones as $funcion): ?>
									<tr>
										<td><?php echo $numero ?></td>
										<td><?php echo $funcion->nombre ?></td>
										<td><?php echo ($funcion->estado=='AC') ? 'ACTIVO' : 'INACTIVO'  ?></td>
										<td>
		                            <div class="small button-group">
												<button data-open="editfuncion" content="<?php echo $funcion->id_funcion ?>" title="<?php echo lang('actualizar') ?>" class="button palette-Brown-500 bg editar tooltipster-top" >
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
                  <a data-open="newfuncion" class="button palette-Brown-500 bg"><i class="fontello-user-add"></i><?php echo lang('registrar.funcion') ?></a>
					</div>
				</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<!-- Modal Agregar Usuario  -->

<div class="reveal" id="newfuncion" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('administrador/registrarfuncion') ?>">
    	<h3 class="center"><?php echo lang('registrar.funcion') ?></h3>
		<div class="row">

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('nombre.funcion') ?>
					 <input type="text" required pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+" name="funcion[nombre]">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('estado') ?>
					<?php echo form_dropdown(array('name'=>'funcion[estado]'), $estados) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>

			<div class="large-12 columns center">
				<button type="submit" name="new_function" value="1" class="button palette-Brown-500 bg">
						<i class="fontello-ok"></i><?php echo lang('registrar') ?>
				</button>
			</div>
		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar Usuario -->

<!-- Modal Editar Usuario  -->

<div class="reveal" id="editfuncion" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('administrador/editarfuncion') ?>">
    	<h3 class="center"><?php echo lang('editar.funcion') ?></h3>
		<div class="row">


			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('nombre.funcion') ?>
					 <input type="text" required pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+" name="funcion[nombre]" id="funcion_nombre">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('estado') ?>
					<?php echo form_dropdown(array('name'=>'funcion[estado]', 'id'=>'funcion_estado'), $estados) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>

			<div class="large-12 columns center">
				<button type="submit" name="edit_function" value="1" class="button palette-Brown-500 bg">
						<i class="fontello-edit"></i><?php echo lang('editar.funcion') ?>
				</button>
			</div>

				<input type="hidden" name="id_funcion" value="" id="funcion_id_funcion" />
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar Usuario -->

<script type="text/javascript" charset="utf-8">
	$('.editar').click(function() {

		var id = $(this).attr('content');

			$.getJSON('<?php echo site_url('servicio/getFuncion');?>', { id: id })

			.done(function(data) {
				$("#funcion_nombre").val(data.nombre);
				$("#funcion_estado").val(data.estado);
				$("#funcion_id_funcion").val(data.id_funcion);
			});
	});
</script>

<?php $this->load->view('seccion/pie'); ?>
