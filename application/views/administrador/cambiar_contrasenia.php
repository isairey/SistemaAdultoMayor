<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>
<body>
<div class="row">
	<div class="large-12 columns">
		<?php $this->load->view('seccion/mensaje') ?>
	</div>
</div>

<!-- preloader -->
<!--<div id="preloader">
    <div id="status">&nbsp;</div>
</div>-->
<!-- End of preloader -->
<!-- right sidebar wrapper -->
<div class="inner-wrap">
    <div class="wrap-fluid">
        <br />
        <br />
        <!-- Container Begin -->
        <div class="large-4 small-centered columns">
            <div class="center palette-Grey-700 bg">
                <img alt="" class="large-6" src="<?php echo base_url('public/media/logo-dark.png') ?>" />
            </div>
            <div class="box bg-white">
                <!-- Profile -->
                <!-- End of Profile -->
                <!-- /.box-header -->
                <div class="box-body " style="display: block;">
                    <div class="row">
                        <div class="large-12 columns">
                            <div class="row">
                                <div class="large-12 columns">
                                    <?php $this->load->view('seccion/mensaje') ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="edumix-signup-panel">
                                    <form method="post" data-abide accept-charset="utf-8" action="<?php echo current_url() ?>">
                                        <div class="log-in-form">
                                            <div class="form-group center">
                                                <?php echo form_label(lang('cambiar.contrasenia')); ?>
                                            </div>
                                            <label><?php echo lang('usuario') ?>
                                                <input type="text" name="login" id="login" value="<?php echo $this->session->servidor->usuario ?>" readonly  />

																								<span class="form-error"><?php echo lang('alpha') ?></span>
                                            </label>
                                            <label><?php echo lang('contrasenia.anterior') ?>
                                                <input type="password" name="passold" id="passold" />
                                            </label>

                                            <label><?php echo lang('contrasenia.nueva') ?>
                                                <input type="password" name="passnew"  id="passnew"  />
                                            </label>

                                            <label><?php echo lang('contrasenia.conf') ?>
                                                <input type="password" name="passconf"  id="passconf"  data-equalto="passnew"/>
                                                <span class="form-error"><?php echo lang('contrasenia.no_igual') ?></span>
                                            </label>

                                            <?php
                                            $roles = $this->main->getListSelect('rol','id_rol, nombre',array('nombre'=>'ASC'), array('estado'=>'AC'));
                                            $data['dropdown_roles'] = $this->main->dropdown($roles);
                                            ?>
                                            <input type="hidden" name="rol" value="<?php echo $this->session->servidor->rol ?>" />
                                            <input type="hidden" name="id_rol" value="<?php echo $this->session->servidor->id_rol ?>">
                                            <p class="margin-bottom-20">
                                                <button  type="submit" name="send_login" class="large-12 button palette-Brown-500 bg hvr-pulse-grow">
                                                    <i class="fontello-key"></i>
                                                    <?php echo lang('cambiar.contrasenia') ?>
                                                </button>
                                                <!--<a href="<?php //echo site_url('Welcome/prueba'); ?>" class="large-12 button palette-Teal-700 bg hvr-pulse-grow"> <i class="fontello-cancel"></i><?php //echo lang('cancelar') ?></a>-->
                                                <a href="<?php echo site_url('inicio'); ?>" class="large-12 button palette-Brown-500 bg hvr-pulse-grow"> <i class="fontello-cancel"></i><?php echo lang('cancelar') ?></a>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end .timeline -->
            </div>
            <!-- box -->
        </div>
    </div>
    <!-- End of Container Begin -->
</div>
<!-- end paper bg -->
<div id="gradient"></div>

<?php $this->load->view('seccion/pie'); ?>
