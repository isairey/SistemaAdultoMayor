<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>

<div class="row">
	<div class="large-12 columns">
		<?php $this->load->view('seccion/mensaje') ?>
	</div>
</div>
<div class="row">
	<div class="large-8 large-centered columns">
		<div class="box no-shadow ">
	        <div class="box-header panel palette-Purple-700 bg">
	            <!-- tools box -->
	            <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
	                <span class="palette-White-Text text" ><?php echo lang('monto.index.lista') ?></span>
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
	                                <th><?php echo lang('monto.index.monto') ?></th>
	                                <th><?php echo lang('monto.index.estado') ?></th>
	                            </tr>
	                        </thead>
	                        <tbody>
					<?php $numero = 1; ?>
					<?php foreach ($montos as $monto): ?>
						<tr>
							<td><?php echo $numero ?></td>
							<td><?php echo $monto->monto ?></td>
							<td><?php echo $monto->estado ?></td>
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
                  		<a data-open="newmonto" class="button palette-Purple-700 bg"><i class="fontello-calendar"></i><?php echo lang('monto.index.nuevo') ?></a>
					</div>
				</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<!-- Modal Agregar Monto  -->

<div class="reveal" id="newmonto" data-reveal="">
	<form method="post" novalidate data-abide data-live-validate="true" accept-charset="utf-8" action="<?php echo site_url('Monto/registrar') ?>">
    	<h3 class="center"><?php echo lang('monto.index.modal.title') ?></h3>
		<div class="row">
	        <div class="large-12 medium-12 small-12 columns">
	            <label>
	               	<?php echo lang('monto.bs') ?>
	                <input type="number" required name="monto" pattern="\d+$" min="100" size="3">
	                <span class="form-error"><?php echo lang('mensaje.monto') ?></span>
	            </label>
	        </div>
	        <div class="large-12 columns center">
				<button type="submit" name="new_gestion" value="1" class="button palette-Purple-700 bg">
						<i class="fontello-ok"></i><?php echo lang('monto.index.modal.registrar') ?>
				</button>
			</div>
		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar Monto -->

<?php $this->load->view('seccion/pie'); ?>
