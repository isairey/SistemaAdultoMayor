<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>

<div class="row">
	<div class="large-12 columns">
		<?php $this->load->view('seccion/mensaje') ?>
	</div>
</div>


<div class="row">
	<div class="large-10 columns large-centered" >
		<div class="box no-shadow ">
	        <div class="box-header panel palette-Brown-500 bg">
	            <!-- tools box -->
	            <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
	                <span class="palette-White-Text text" ><?php echo lang('lista.denuncias.archivadas')?></span>
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
																<th><?php echo lang('codigo') ?></th>
																<th><?php echo lang('tipologia') ?></th>
																<th><?php echo lang('denunciante') ?></th>
																<th><?php echo lang('dni') ?></th>
																<th><?php echo lang('victima') ?></th>
																<th><?php echo lang('dni') ?></th>
																<th><?php echo lang('nombre.centro') ?></th>
																<th><?php echo lang('fecha.registro') ?></th>
																<th><?php echo lang('fecha.archivo') ?></th>
																<th><?php echo lang('opciones') ?></th>

														</tr>
												  </thead>
	                        <tbody>
															<?php $numero = 1; ?>

															<?php foreach ($denuncias as $denuncia): ?>
																<tr>
																	<td><?php echo $numero ?></td>
																	<td><?php echo $denuncia->codigo_denuncia?></td>
																	<td><?php echo $denuncia->tipologia?></td>
																	<td><?php echo $denuncia->denunciante?></td>
																	<td><?php echo $denuncia->dni_denunciante ?></td>
																	<td><?php echo $denuncia->victima?></td>
																	<td><?php echo $denuncia->dni ?></td>
																	<td><?php echo $denuncia->nombre_centro ?></td>
																	<td><?php echo $denuncia->fecha_denuncia?></td>
																	<td><?php echo $denuncia->fecha_archivo ?></td>

                                  <td>
										                <div class="small button-group">
																				<button data-open="habilitardenuncia" content="<?php echo $denuncia->id_denuncia ?>" title="<?php echo lang('habilitado') ?>" class="button palette-Brown-500 bg editar tooltipster-top" >
																					 <i class="fontello-lock-open"></i>
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

	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>



<!-- Modal desarchivar Denuncia  -->

<div class="reveal" id="habilitardenuncia" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('denuncias/habilitandodenuncia') ?>">
    	<h3 class="center"><?php echo lang('confirmacion.desarchivar') ?></h3>
		<div class="row">
			<input type="hidden" name="id_denuncia" value="" id="id_denuncia" />
			<div class="large-12 columns center">
				<button type="submit" name="editdenuncia"  class="button palette-Brown-500 bg">
						<i class="fontello-ok"></i><?php echo lang('desarchivar.denuncia') ?>
				</button>
			</div>

		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin  denuncia desarchivada-->



<script type="text/javascript" charset="utf-8">
$('.editar').click(function() {

	var id = $(this).attr('content');

		$.getJSON('<?php echo site_url('servicio/getDenuncia');?>', { id: id })

		.done(function(data) {


			$("#id_denuncia").val(data.id_denuncia);


		});
});
</script>


<?php $this->load->view('seccion/pie'); ?>
