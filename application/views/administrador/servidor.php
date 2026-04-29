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
	        <div class="box-header panel palette-Orange-700 bg">
	            <!-- tools box -->
	            <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
	                <span class="palette-White-Text text" ><?php echo lang('lista.servidores') ?></span>
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
	                                <th><?php echo lang('n') ?></th>
	                                <th><?php echo lang('nombre.completo') ?></th>
                                   <th><?php echo lang('dni') ?></th>
                                   <th><?php echo lang('tipo.contrato') ?></th>
                                   <th><?php echo lang('nro.item') ?></th>
	                                <th><?php echo lang('cargo') ?></th>
	                                <th><?php echo lang('unidad') ?></th>
	                            </tr>
	                        </thead>
	                        <tbody>
								<?php $numero = 1; ?>

								<?php foreach ($servidores as $servidor): ?>
									<tr>
										<td><?php echo $numero ?></td>
										<td><?php echo $servidor->nombre_completo ?></td>
										<td><?php echo $servidor->dni ?></td>
										<td><?php echo $servidor->tipo_contrato ?></td>
										<td><?php echo $servidor->nro_item ?></td>
										<td><?php echo $servidor->cargo ?></td>
										<td><?php echo $servidor->unidad ?></td>
									</tr>
									<?php $numero++; ?>
								<?php endforeach ?>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	            <!-- end Table -->
	            <div class="row">
						<div class="large-3 columns">
	                  <a class="button palette-Orange-700 bg" id="update"><i class="fontello-arrows-cw"></i><?php echo lang('actualizar.servidores') ?></a>
						</div>
						<div class="large-3 columns">
	                  <a class="button palette-Orange-700 bg" id="limpiar"><i class="fontello-trash"></i><?php echo lang('limpiar.servidores') ?></a>
						</div>
					</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
	$('#update').click(function()
   {
		var nombre_completo = '';

         $.post('http://192.168.104.118/transparencia/servicio/buscar-empleados.php',
            {
               nombre_completo: ''
            }
         )
         .done(function(data)
         {
            if(data.status == true)
            {
               $.each(data.data, function(index, value) {

                  $.post('servicio/updateServidor',
                    {
                       nombre_completo: value.nombre_completo,
                       nombres : value.nombre,
                       paterno : value.paterno,
                       materno : value.materno,
                       unidad  : value.unidad,
                       nro_item: value.nro_item,
                       tipo_contrato: value.tipo_contrato,
                       dni: value.numdocumento,
                       cargo: value.cargo
                    })
                    .done(function(result){
                       console.log(result);
                    });
               });
            }
         });
	 });

	 $('#limpiar').click(function()
	 {
		 $.ajax({
 			 url: "<?php echo site_url('servicio/limpiarFuncionarios') ?>",
 		});
	 });
</script>

<?php $this->load->view('seccion/pie'); ?>
