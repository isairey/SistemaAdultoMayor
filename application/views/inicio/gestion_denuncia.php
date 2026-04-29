<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>

<div class="row">
	<div class="large-12 columns">
		<?php $this->load->view('seccion/mensaje') ?>
	</div>
</div>

<div class="row">
  <div class="large-8 columns large-centered" >
		<div class="box no-shadow ">
	        <div class="box-header panel palette-Brown-500 bg">
	            <!-- tools box -->
	            <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
	                <span class="palette-White-Text text" ><?php echo lang('gestion.denuncia'); ?></span>
	            </h3>
	        </div>

	        <!-- /.box-header -->
	        <div class="box-body">
  					<div class="row">
  						<div class="large-4 large-centered">
  							<label>
  								<form method="post" data-abide accept-charset="utf-8" data-live-validate="true" action="<?php echo site_url('perfil/actualizar_gestion') ?>">
  									<div class="large-12 columns center">
  										<?php echo lang('gestion.denuncia') ?>
  										<?php echo form_dropdown(array('name'=>'gestion'), $gestiones) ?>
  										<span class="form-error"><?php echo lang('requerido') ?></span>
  									</div>
  									<div class="large-12 columns center">
  										<button type="submit" name="change_gestion" class="button palette-  bg">
  												<i class="fontello-ok"></i><?php echo lang('cambiar') ?>
  										</button>
  									</div>
  								</form>
  							</label>
  						</div>
  					</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<?php $this->load->view('seccion/pie'); ?>
