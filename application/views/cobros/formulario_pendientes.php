<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>

<div class="row">
	<div class="large-12 columns">
		<?php $this->load->view('seccion/mensaje') ?>
	</div>
</div>

<div class="row">
	<div class="large-4 large-centered columns">
		<div class="box no-shadow ">
	        <div class="box-header panel palette-Purple-700 bg">
	            <!-- tools box -->
	            <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
	                <span class="palette-White-Text text" ><?php echo lang('formulario.reporte.cobros') ?></span>
	            </h3>
	        </div>

	        <!-- /.box-header -->
	        <div class="box-body">
	        <!-- Table -->
	            <div class="row">
	                <div class="large-12 columns">
                      <form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('reporte-pendientes') ?>">
                          <h3 class="center"><?php echo lang('formulario.reporte.pendientes') ?></h3>
                       <div class="row">

                          <div class="large-12 medium-12 small-12 columns">
                             <label>
                                <?php echo lang('gestion') ?>
                                 <?php echo form_dropdown(array('name'=>'gestion'), $gestiones) ?>
                                 <span class="form-error"><?php echo lang('alfabetico') ?></span>
                             </label>
                          </div>

                          <div class="large-12 columns center">
                             <button type="submit" name="new_function" value="1" class="button palette-Purple-700 bg">
                                   <i class="fontello-ok"></i><?php echo lang('obtener.reporte') ?>
                             </button>
                          </div>
                       </div>
                    </form>
	                </div>
	            </div>
	            <!-- end Table -->
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.select-fecha').pickadate({
			 monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			 weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
			 disable: [1, 7],
			 firstDay: 0,
			 selectYears: 5,
			 selectMonths: true,
			 max: true,
			 formatSubmit: 'yyyy-mm-dd',
			 today: '',
			 clear: 'Limpiar Selección',
			 close: 'Cerrar',
		});
	});
</script>

<!-- Modal Agregar Usuario  -->

<?php $this->load->view('seccion/pie'); ?>
