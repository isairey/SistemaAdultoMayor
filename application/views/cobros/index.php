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
	        <div class="box-header panel palette-Purple-700 bg">
	            <!-- tools box -->
	            <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
	                <span class="palette-White-Text text" ><?php echo lang('beneficiario.index.lista') ?></span>
	            </h3>
	        </div>

	        <!-- /.box-header -->
	        <div class="box-body">
	        <!-- Table -->
	            <div class="row">
	                <div class="large-5 columns">
	                    <table class="stack dinamico">
	                        <thead>
	                            <tr>
	                                <th><?php echo lang('numero') ?></th>
	                                <th><?php echo lang('beneficiario.index.dni') ?></th>
	                                <th><?php echo lang('beneficiario.index.nombre') ?></th>
	                                <th><?php echo lang('opciones') ?></th>
	                            </tr>
	                        </thead>
	                        <tbody>
								<?php $numero = 1; ?>
								<?php foreach ($beneficiarios as $beneficiario): ?>
									<tr>
										<td><?php echo $numero ?></td>
										<td><?php echo $beneficiario->dni ?></td>
										<td><?php echo $beneficiario->nombre ?></td>
										<td>
											<div class="button-group">
												<button class="button palette-Purple-700 bg tooltipster-top pagos" content="<?php echo $beneficiario->id_beneficiario  ?>" >
													<?php echo lang('beneficiario.index.verpagos') ?>
												</button>
											</div>
										</td>
									</tr>
									<?php $numero++; ?>
								 <?php endforeach ?>
	                        </tbody>
	                    </table>
	                </div>
	                <div class="large-7 columns" id="contenido">

	                </div>
	            </div>
	            <!-- end Table -->
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
	$('.pagos').click(function(){

		var id_beneficiario = $(this).attr('content');

		$('#contenido').empty();

	 	$.ajax({
			url: '<?php echo site_url('servicio/getCobros') ?>',
			type: 'POST',
			dataType: 'html',
			data: {id: id_beneficiario}
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

</script>

<?php $this->load->view('seccion/pie'); ?>
