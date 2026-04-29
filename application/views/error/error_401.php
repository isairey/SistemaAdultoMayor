<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>

 <div class="row">
    <div class="large-12 columns">
        <section class="page-error">
            <div class="error-page">
                <div class="error-content">
                    <h2 class=":">4<i class="ti-face-sad"></i>1</h2>
                    <h3><small><?php echo lang('pagina.noencontrada') ?></small></h3>
                    <div class="container-loading">
                        <div class="ball"></div>
                        <div class="ball"></div>
                        <div class="ball"></div>
                        <div class="ball"></div>
                        <div class="ball"></div>
                        <div class="ball"></div>
                        <div class="ball"></div>
                    </div>
                    <p> El contenido existe pero su cuenta no tiene permiso de acceso. Puedes regresar a la <a class="error-link" href="<?php echo site_url() ?>"> Página Principal </a></p>
                </div>
                <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
        </section>
    </div>
</div>


<?php $this->load->view('seccion/pie'); ?>

<?php die(); ?>