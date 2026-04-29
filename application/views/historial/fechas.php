<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>

<div class="row">
	<div class="large-12 columns">
		<?php $this->load->view('seccion/mensaje') ?>
	</div>
</div>


<div class="row" >
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('historial/generar_historial') ?>">

    <h3 class="center"><?php echo lang('seleccionar.fecha')?></h3>
		<div class="row">
      <div class="large-4 columns large-centered">
        <label>
          <?php echo lang('fecha.inicial') ?>
           <input type="text" name="historial[fecha_inicial]" id="fecha_inicial" class="datepicker" required>
           <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
        </label>
      </div>
      <div class="large-4 columns large-centered">
        <label>
          <?php echo lang('fecha.final') ?>
           <input type="text" name="historial[fecha_final]" id="fecha_final" class="datepicker" required>
           <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
        </label>
      </div>
			<div class="large-12 columns center">
				<button type="submit" name="fecha" value="1" class="button palette-Orange-600 bg">
						<i class="fontello-ok"></i><?php echo lang('solicitar.historial') ?>
				</button>
			</div>
		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>



<!-- FIN DE SELECCIONAR EL TIPO CONDUCTOR -->


<script>
   $(document).ready(function () {
        $('.datepicker').pickadate({
            monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
            today: 'Hoy',
            clear: 'Limpiar',
            close: 'Cerrar',
            firstDay: 0,

            labelMonthNext: 'Mes Siguiente',
            labelMonthPrev: 'Mes Anterior',
            labelMonthSelect: 'Seleccione un Mes',
            labelYearSelect: 'Seleccione un Año',
            //format: 'd mmmm !de yyyy',
            format: 'yyyy-mm-dd',
            formatSubmit: 'yyyy-mm-dd',
            selectYears: 90,
            selectMonths: true,
            max: true,
            closeOnSelect: true,
            containerHidden: '#hidden-input-outlet'
        });
   });
</script>

<?php $this->load->view('seccion/pie'); ?>
<script type="text/javascript">
	 var nuevoalias = jQuery.noConflict();
	 nuevoalias(document).ready(function() {
     var method  = '<?php echo $this->router->fetch_method(); ?>';
     var control  = '<?php echo $this->router->fetch_class(); ?>';

  	});
</script>
