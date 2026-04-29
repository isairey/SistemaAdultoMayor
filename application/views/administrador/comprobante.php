<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>

<div class="row">
	<div class="large-12 columns">
		<?php $this->load->view('seccion/mensaje') ?>
	</div>
</div>

<div class="row">
	<div class="large-7 large-centered columns">
		<div class="box no-shadow ">
	        <div class="box-header panel palette-Purple-700 bg">
	            <!-- tools box -->
	            <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
	                <span class="palette-White-Text text" ><?php echo lang('lista.comprobantes') ?></span>
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
	                                <th><?php echo lang('gestion.municipal') ?></th>
	                                <th><?php echo lang('nro.comprobante') ?></th>
	                                <th><?php echo lang('estado') ?></th>
	                            </tr>
	                        </thead>
	                        <tbody>
								<?php $numero = 1; ?>

								<?php foreach ($comprobantes as $comprobante): ?>
									<tr>
										<td><?php echo $numero ?></td>
										<td><?php echo $comprobante->anio ?></td>
										<td><?php echo $comprobante->numero_actual ?></td>
										<td><?php echo ($comprobante->estado=='AC') ? 'ACTIVO' : 'INACTIVO'  ?></td>
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
                  		<a data-open="newgestion" class="button palette-Purple-700 bg"><i class="fontello-ticket"></i><?php echo lang('registrar.comprobante') ?></a>
					</div>
				</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<!-- Modal Agregar Usuario  -->

<div class="reveal" id="newgestion" data-reveal="">
	<form method="post" data-abide no-validate data-live-validate="true" accept-charset="utf-8" action="<?php echo site_url('administrador/registrargestion') ?>">
    	<h3 class="center"><?php echo lang('registrar.comprobante') ?></h3>
		<div class="row">

			<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('gestion.municipal') ?>
					 <input type="number" required size="4" pattern="^\d+$" min="2017" name="comprobante">
					 <span class="form-error"><?php echo lang('alerta.numerico') ?></span>
				</label>
			</div>

			<div class="large-12 columns center">
				<button type="submit" name="new_rol" value="1" class="button palette-Purple-700 bg">
						<i class="fontello-ok"></i><?php echo lang('registrar') ?>
				</button>
			</div>
		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar Usuario -->


<?php $this->load->view('seccion/pie'); ?>
