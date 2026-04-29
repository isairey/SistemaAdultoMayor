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
	                <span class="palette-White-Text text" ><?php echo lang('lista.denuncias.cerradas')?></span>
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
																<th><?php echo lang('fecha.cierre') ?></th>


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
                                  <td><?php echo $denuncia->fecha_denuncia ?></td>
																	<td><?php echo $denuncia->fecha_cierre ?></td>

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
<?php $this->load->view('seccion/pie'); ?>
