<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>

<div class="row">
	<div class="large-12 columns">
		<?php $this->load->view('seccion/mensaje') ?>
	</div>
</div>
<div class="row">
	<div class="large-9 large-centered columns">
		<div class="box no-shadow ">
	        <div class="box-header panel palette-Purple-700 bg">
	            <!-- tools box -->
	            <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
	                <span class="palette-White-Text text" ><?php echo lang('gestion.index.lista.gestion') ?></span>
	            </h3>
	        </div>

	        <!-- /.box-header -->
	        <div class="box-body">
	        <!-- Table -->
	            <div class="row">
	                <div class="large-12  columns">
	                    <table class="stack dinamico">
	                        <thead>
	                            <tr>
	                                <th class="center"><?php echo lang('numero') ?></th>
	                                <th class="center"><?php echo lang('gestion') ?></th>
	                                <th class="center"><?php echo lang('beneficiarios') ?></th>
	                                <th class="center"><?php echo lang('nuevos.beneficiarios') ?></th>
	                                <th class="center"><?php echo lang('monto.desembolsar') ?></th>
	                                <th class="center"><?php echo lang('monto.pagado') ?></th>
	                                <th class="center"><?php echo lang('pendiente.pago') ?></th>
	                                <th class="center"><?php echo lang('subir.archivo') ?></th>
	                                <th class="center"><?php echo lang('descargar.archivo') ?></th>
	                                <th class="center"><?php echo lang('reporte') ?></th>

	                            </tr>
	                        </thead>
	                        <tbody>
					<?php $numero = 1; ?>
					<?php foreach ($gestiones as $gestion): ?>
						<tr>
							<td class="center"><?php echo $numero ?></td>
							<td class="center"><?php echo $gestion->mes.'-'.$gestion->anio ?></td>
							<td class="center"><?php echo $gestion->beneficiarios ?></td>
							<td class="center"><?php echo $gestion->nuevos_beneficiarios ?></td>
							<td class="center"><?php echo number_format($gestion->desembolso, 2, ',', '.').' Bs.' ?></td>
							<td class="center"><?php echo number_format($gestion->pagado, 2, ',', '.').' Bs.' ?></td>
							<td class="center"><?php echo number_format($gestion->desembolso - $gestion->pagado, 2, ',', '.').' Bs.' ?></td>

							<td class="center">
								<div class="button-group">
									<?php if($gestion->archivo === 'PENDIENTE'): ?>
										<a data-open="loadexcel" content="<?php echo $gestion->id_gestion ?>" title="<?php echo lang('subir.archivo') ?>" class="button palette-Purple-700 bg getgestion tooltipster-top" >
											<i class="la la-upload"></i>
										</a>
									<?php endif; ?>
								</div>
							</td>
							<td class="center">
								<div class="button-group">
									<?php if($gestion->archivo !== 'PENDIENTE'): ?>
											<a href="<?php echo base_url('public/archivos_excel/'.$gestion->archivo) ?>" title="<?php echo lang('descargar.archivo') ?>" class="button palette-Purple-700 bg tooltipster-top" >
												<i class="la la-download"></i>
											</a>
									<?php endif; ?>
								</div>
							</td>
							<td class="center">
								<div class="button-group">
									<?php if($gestion->archivo !== 'PENDIENTE'): ?>
										<a href="<?php echo site_url('informe-gestion/'.$gestion->id_gestion) ?>" title="<?php echo lang('reporte.gestion') ?>" class="button palette-Purple-700 bg tooltipster-top" >
											<i class="fontello-print"></i>
										</a>
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
                  <a data-open="newgestion" class="button palette-Purple-700 bg"><i class="fontello-calendar"></i><?php echo lang('gestion.index.nuevo') ?></a>
					</div>
				</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<!-- Modal Agregar Usuario  -->

<div class="small reveal" id="newgestion" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('gestion/registrar') ?>">
    	<h3 class="center"><?php echo lang('gestion.index.modal.title') ?></h3>
		<div class="row">
	        <div class="large-12 medium-12 small-12 columns">

					<label>
	               	<?php echo lang('gestion.index.modal.gestion') ?>
	                <input type="text" required name="gestion" class="pickamonth">
	                <span class="form-error"><?php echo lang('gestion.index.modal.guion') ?></span>
	            </label>
	        </div>
	        <div class="large-12 columns center">
				<button type="submit" name="new_gestion" value="1" class="button palette-Purple-700 bg">
						<i class="fontello-ok"></i><?php echo lang('gestion.index.modal.registrar') ?>
				</button>
			</div>
		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<div class="small reveal" id="loadexcel" data-reveal="">

	<div>
		<form id="upload-widget" method="post" class="dropzone" enctype="multipart/form-data" action="<?php echo site_url('gestion/cargar_beneficiarios') ?>">
	    	<h3 class="center"><?php echo lang('cargar.beneficiarios') ?></h3>
			<div class="row">

		        <div class="large-6 medium-6 large-centered columns">

					   <input type="file" required name="userfile" id="my-file">
		        </div>

		        <div class="large-6 large-centered columns">
					<button type="submit" name="new_gestion" value="1" class="button palette-Purple-700 bg">
							<i class="fontello-ok"></i><?php echo lang('cargar.archivo') ?>
					</button>
				</div>
			</div>
				<input type="hidden" name="id_gestion" id="gestion_id_gestion" value="">
			<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
		</form>
	</div>

</div>

<!-- Fin Agregar Usuario -->

<script type="text/javascript" charset="utf-8">
var year = <?php echo date('Y') ?>;

$('.pickamonth').monthpicker({
		pattern: 'mm-yyyy',
		selectedMonth: null,
		selectedMonthName: '',
		selectedYear: year,
		startYear: year - 2,
		finalYear: year,
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		id: "monthpicker_" + (Math.random() * Math.random()).toString().replace('.', ''),
		openOnFocus: true,
		disabledMonths: []
});

$('.getgestion').click(function() {
	var id = $(this).attr('content');
		$("#gestion_id_gestion").val(id);
});


$(":file").jfilestyle({
	inputSize: "350px",
	buttonBefore: true,
	theme: "purple",
	text: "Seleccionar Archivo",
	buttonBefore: true
});

</script>

<?php $this->load->view('seccion/pie'); ?>
