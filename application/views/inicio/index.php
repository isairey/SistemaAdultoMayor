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
            <!--<div class="box-header panel palette-Teal-700 bg">
                <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
                    <span class="palette-White-Text text" ><?php //echo lang('lista.roles') ?></span>
                </h3>
            </div>-->

            <!-- /.box-header -->

              <div class="large-8 medium-8 small-8 columns">
                <h3 class="text-center"> El Departamento de Adulto Mayor, comprometido por una vejez digna, activa, plena y participativa, alienta la
                   participación protagónica e integración social de los Adultos/as Mayores en las políticas Municipales, buscando el reconocimiento de sus derechos y beneficios, tratando de eliminar toda forma de negligencia, abuso, violencia y discriminación,
                  para mejorar la calidad de vida de los Adultos/as Mayores en el Municipio de Cochabamba</h3>
                  <div class="box-body">
                    <h2><strong>“Por un Municipio con Responsabilidad Familiar, que respete y valores a nuestros Adultos y Adultas Mayores”</strong></h2>
                  </div>
              </div>
              <div class="large-4 medium-4 small-4 columns">
                  <center><img src="<?php echo base_url('public/imagenes/adultomayor.jpg') ?>" width="500" heigth="450" id="foto"></center>

              </div>

                <!-- end Table -->
                <!--<div class="row">
                    <div class="large-12 columns">
                        <a data-open="newrol" class="button palette-Teal-700 bg"><i class="fontello-user-add"></i><?php echo lang('registrar.rol') ?></a>
                    </div>
                </div>-->

        </div>
    </div>
</div>
<!-- Modal Agregar Usuario  -->
<div class="reveal" id="newrol" data-reveal="">
    <form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('administrador/registrarRol') ?>" novalidate>
        <h3 class="center"><?php echo lang('registrar.rol') ?></h3>
        <div class="row">

            <div class="large-12 medium-12 small-12 columns">
                <label>
                    <?php echo lang('nombre.rol') ?>
                    <input type="text" required pattern="[a-zA-Z\s]+" name="rol[nombre_rol]">
                    <span class="form-error"><?php echo lang('alfabetico') ?></span>
                </label>
            </div>
            <!--<div class="large-12 medium-12 small-12 columns">
				<label>
					<?php //echo lang('estado') ?>
					<?php //echo form_dropdown(array('name'=>'rol[estado]'), $estados) ?>
				</label>
			</div>-->

            <div class="large-12 columns center">
                <button type="submit" name="new_user" value="1" class="button palette-Teal-700 bg">
                    <i class="fontello-ok"></i><?php echo lang('registrar') ?>
                </button>
            </div>
        </div>
        <button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
    </form>
</div>

<!-- Fin Agregar Usuario -->

<!-- Modal Editar Usuario  -->

<div class="reveal" id="editrol" data-reveal="">
    <form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('administrador/editarRol') ?>">
        <h3 class="center"><?php echo lang('editar.rol') ?></h3>
        <div class="row">
            <div class="large-12 medium-12 small-12 columns">
                <label>
                    <?php echo lang('nombre.rol') ?>
                    <input type="text" required pattern="[a-zA-Z\s]+" name="rol[nombre_rol]" id="rol_nombre_rol">
                    <span class="form-error"><?php echo lang('alfabetico') ?></span>
                </label>
            </div>
            <div class="large-12 medium-12 small-12 columns">
                <label>
                    <?php echo lang('estado') ?>
                    <?php echo form_dropdown(array('name'=>'rol[estado]', 'id'=>'rol_estado'), $estados) ?>
                </label>
            </div>

            <div class="large-12 columns center">
                <button type="submit" name="edit_user" class="button palette-Teal-700 bg">
                    <i class="fontello-ok"></i><?php echo lang('actualizar') ?>
                </button>
            </div>

            <input type="hidden" name="id_rol" value="" id="rol_id_rol" />
        </div>

        <button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
    </form>
</div>

<!-- Fin Agregar Usuario -->

<script type="text/javascript" charset="utf-8">
    $('.editar').click(function() {

        var id_rol = $(this).attr('content');
        $.getJSON('<?php echo site_url('servicio/getRol');?>', { id_rol: id_rol })

            .done(function(data) {
                $("#rol_nombre_rol").val(data.nombre_rol);
                $("#rol_estado").val(data.estado);
                $("#rol_id_rol").val(data.id_rol);
            });
    });
</script>

<?php $this->load->view('seccion/pie'); ?>
