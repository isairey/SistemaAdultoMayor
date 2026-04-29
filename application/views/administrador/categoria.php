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
	                <span class="palette-White-Text text" ><?php echo lang('lista.tipologias') ?></span>
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
	                                <th><?php echo lang('categoria') ?></th>
	                                <th><?php echo lang('estado') ?></th>
	                                <th><?php echo lang('opciones') ?></th>
	                            </tr>
	                        </thead>
	                        <tbody>
								<?php $numero = 1; ?>

								<?php foreach ($categorias as $categoria): ?>
									<tr>
										<td><?php echo $numero ?></td>
										<td><?php echo $categoria->nombre ?></td>
										<td><?php echo ($categoria->estado=='AC') ? 'ACTIVO' : 'INACTIVO'  ?></td>
										<td>
		                            <div class="small button-group">
												<button data-open="editcategoria" content="<?php echo $categoria->id_categoria ?>" title="<?php echo lang('actualizar') ?>" class="button palette-Brown-500 bg editar tooltipster-top" >
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
                  <a data-open="newcategoria" class="button palette-Brown-500 bg"><i class="fontello-user-add"></i><?php echo lang('registrar.tipologia') ?></a>
					</div>
				</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<!-- Modal Agregar Usuario  -->

<div class="reveal" id="newcategoria" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('administrador/registrarcategoria') ?>">
    	<h3 class="center"><?php echo lang('registrar.tipologia') ?></h3>
		<div class="row">

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('nombre.tipologia') ?>
					 <input type="text" required pattern="[a-zA-ZñÑ\s]+" name="categoria[nombre]">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('estado') ?>
					<?php echo form_dropdown(array('name'=>'categoria[estado]'), $estados) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>

			<div class="large-12 columns center">
				<button type="submit" name="new_categoria" value="1" class="button palette-Brown-500 bg">
						<i class="fontello-ok"></i><?php echo lang('registrar') ?>
				</button>
			</div>
		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar Usuario -->

<!-- Modal Editar Usuario  -->

<div class="reveal" id="editcategoria" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('administrador/editarcategoria') ?>">
    	<h3 class="center"><?php echo lang('editar.tipologia') ?></h3>
		<div class="row">


			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('nombre.tipologia') ?>
					 <input type="text" required pattern="[a-zA-ZñÑ\sáéíóúÁÉÍÓÚ]+" name="categoria[nombre]" id="categoria_nombre">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('estado') ?>
					<?php echo form_dropdown(array('name'=>'categoria[estado]', 'id'=>'categoria_estado'), $estados) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>

			<div class="large-12 columns center">
				<button type="submit" name="edit_categoria" value="1" class="button palette-Brown-500 bg">
						<i class="fontello-edit"></i><?php echo lang('editar.categoria') ?>
				</button>
			</div>

				<input type="hidden" name="id_categoria" value="" id="categoria_id_categoria" />
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar categoria -->
<script type="text/javascript" charset="utf-8">
	$('.editar').click(function() {

		var id = $(this).attr('content');

			$.getJSON('<?php echo site_url('servicio/getCategoria');?>', { id: id })

			.done(function(data) {
				$("#categoria_nombre").val(data.nombre);
				$("#categoria_estado").val(data.estado);
				$("#categoria_id_categoria").val(data.id_categoria);
			});
	});
</script>


<?php $this->load->view('seccion/pie'); ?>
