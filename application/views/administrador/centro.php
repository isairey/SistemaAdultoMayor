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
	                <span class="palette-White-Text text" ><?php echo lang('lista.centros') ?></span>
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
	                                <th><?php echo lang('centro') ?></th>
                                  <th><?php echo lang('codigo') ?></th>
	                                <th><?php echo lang('estado') ?></th>
	                                <th><?php echo lang('opciones') ?></th>
	                            </tr>
	                        </thead>
	                        <tbody>
								<?php $numero = 1; ?>

								<?php foreach ($centros as $centro): ?>
									<tr>
										<td><?php echo $numero ?></td>
										<td><?php echo $centro->nombre_centro ?></td>
                    <td><?php echo $centro->codigo ?></td>
										<td><?php echo ($centro->estado=='AC') ? 'ACTIVO' : 'INACTIVO'  ?></td>
										<td>
  		                <div class="small button-group">
  												<button data-open="editcentro" content="<?php echo $centro->id_centro ?>" title="<?php echo lang('actualizar') ?>" class="button palette-Brown-500 bg editar tooltipster-top" >
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
                  <a data-open="newcentro" class="button palette-Brown-500 bg"><i class="fontello-user-add"></i><?php echo lang('registrar.centro') ?></a>
					</div>
				</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<!-- Modal Agregar centro  -->
<div class="reveal" id="newcentro" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('administrador/registrarcentro') ?>">
    	<h3 class="center"><?php echo lang('registrar.centro') ?></h3>
		<div class="row">

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('nombre.nuevo.centro') ?>
					 <input type="text" required pattern="[a-zA-Z\s]+" name="centro[nombre_centro]">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>
      <div class="large-12 medium-12 small-12 columns">
        <label>
          <?php echo lang('codigo') ?>
           <input type="text" required pattern="[a-zA-Z]{3}" name="centro[codigo]">
           <span class="form-error"><?php echo lang('alfabetico') ?></span>
        </label>
      </div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('estado') ?>
					<?php echo form_dropdown(array('name'=>'centro[estado]'), $estados) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>

			<div class="large-12 columns center">
				<button type="submit" name="new_centro" value="1" class="button palette-Brown-500 bg">
						<i class="fontello-ok"></i><?php echo lang('registrar') ?>
				</button>
			</div>
		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>
<!-- Fin Agregar Centro -->

<!-- Modal Editar Centro  -->

<div class="reveal" id="editcentro" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('administrador/editarcentro') ?>">
    	<h3 class="center"><?php echo lang('editar.centro') ?></h3>
		<div class="row">


			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('nombre.nuevo.centro') ?>
					 <input type="text" required pattern="[a-zA-Z\s]+" name="centro[nombre_centro]" id="centro_nombre">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>
      <div class="large-12 medium-12 small-12 columns">
        <label>
          <?php echo lang('codigo') ?>
           <input type="text" required pattern="[a-zA-Z]{3}" name="centro[codigo]" id="centro_codigo">
           <span class="form-error"><?php echo lang('alfabetico') ?></span>
        </label>
      </div>

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('estado') ?>
					<?php echo form_dropdown(array('name'=>'centro[estado]', 'id'=>'centro_estado'), $estados) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>

			<div class="large-12 columns center">
				<button type="submit" name="edit_centro" value="1" class="button palette-Brown-500 bg">
						<i class="fontello-edit"></i><?php echo lang('editar.centro') ?>
				</button>
			</div>

				<input type="hidden" name="id_centro" value="" id="centro_id_centro" />
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar centro -->
<script type="text/javascript" charset="utf-8">
	$('.editar').click(function() {

		var id = $(this).attr('content');

			$.getJSON('<?php echo site_url('servicio/getCentro');?>', { id: id })

			.done(function(data) {
				$("#centro_nombre").val(data.nombre_centro);
        $("#centro_codigo").val(data.codigo);
				$("#centro_estado").val(data.estado);
				$("#centro_id_centro").val(data.id_centro);
			});
	});
</script>


<?php $this->load->view('seccion/pie'); ?>
