<link rel="stylesheet" href="<?= base_url(); ?>/assets/leaflet/leaflet.css" />
<script src="<?= base_url(); ?>/assets/leaflet/leaflet.js"></script>


<style>
  #map { height: 800px; }
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>
<?php $this->load->library('leaflet'); ?>
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
	                <span class="palette-White-Text text" ><?php echo lang('detalle.kardexs')?></span>
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
																<th><?php echo lang('nombre.completo') ?></th>
																<th><?php echo lang('dni') ?></th>
																<th><?php echo lang('domicilio') ?></th>
																<th><?php echo lang('fecha.nacimiento') ?></th>
                                <th><?php echo lang('genero') ?></th>
																<th><?php echo lang('opciones') ?></th>

														</tr>
												  </thead>
	                        <tbody>
															<?php $numero = 1; ?>

															<?php foreach ($kardexs as $kardex): ?>
																<tr>
																	<td><?php echo $numero ?></td>
																	<td><?php echo $kardex->nombre_completo?></td>
																	<td><?php echo $kardex->dni?></td>
																	<td><?php echo $kardex->domicilio?></td>
                                  <td><?php echo fecha($kardex->fecha_nacimiento )?></td>
																	<td><?php echo $kardex->sexo ?></td>
																	<td>
										                <div class="small button-group">
																			 <?php if(empty($kardex->foto)) {?>
																					<button data-open="fotografiaAdulto" content="<?php echo $kardex->id_kardex ?>" title="<?php echo lang('fotografia') ?>" class="button palette-Brown-500 bg fotoAdulto tooltipster-top" >
																					<i class="la la-camera-retro la-2x"></i>
																				<?php }?>
																				</button>
																				<button data-open="editarkardex" content="<?php echo $kardex->id_kardex ?>" title="<?php echo lang('detalle.kardex') ?>" class="button palette-Brown-500 bg editar_kar tooltipster-top" >
																					<i class="la la-user la-2x"></i>
								                        </button>
                                        <button data-open="detallekardex" content="<?php echo $kardex->id_kardex ?>" title="<?php echo lang('detalle.adulto') ?>" class="button palette-Brown-500 bg detalle_kar tooltipster-top" >
																					<i class="la la-plus la-2x"></i>
								                        </button>
																				<button data-open="detallevivienda" content="<?php echo $kardex->id_kardex ?>" title="<?php echo lang('detalle.vivienda') ?>" class="button palette-Brown-500 bg vivienda_kar tooltipster-top" >
																					<i class="la la-home la-2x"></i>
								                        </button>
																				<button data-open="detalleservicio" content="<?php echo $kardex->id_kardex ?>" title="<?php echo lang('detalle.servicios') ?>" class="button palette-Brown-500 bg servicios_kar tooltipster-top" >
																					<i class="la la-medkit la-2x"></i>
								                        </button>
																				<a href="<?php echo site_url('ver-kardex/'.$kardex->id_kardex) ?>" class="button palette-Brown-500 bg tooltipster-top" title="<?php echo lang('ver.kardex') ?>">
																					<i class="fontello-doc-text la-2x"></i>
																				</a>

																				<button data-open="vermapa" content="<?php echo $kardex->id_kardex ?>" title="<?php echo lang('ver.mapa') ?>" class="button palette-Brown-500 bg ver_mapa tooltipster-top" >
																					<i class="ti-location-pin la-2x"></i>
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
	            <div class="row">
									<div class="large-12 columns">
				            <a data-open="newkardex" class="button palette-Brown-500 bg"><i class="fontello-user-add"></i><?php echo lang('registrar.kardex') ?></a>
									</div>
						</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>
<!--  insertar nuevo Adulto en kardex  ->
<!-- Modal Agregar Usuario  -->

<div class="large reveal" id="newkardex" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('kardex/registrar') ?>">
    	<h3 class="center"><?php echo lang('registrar.kardex') ?></h3>
		<div class="row">

			<h3 class="center"><?php echo lang('detalle.kardex') ?></h3>

			<div class="large-2 medium-2 small-6 columns">
				 <label>
					 <?php echo lang('dni') ?>
						<input type="text" required pattern="[0-9]+[-a-zA-Z]{0,4}" name="kardex[dni]" id="kardex_ci">
						<span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
				 </label>
			 </div>
			 <div class="large-2 medium-4 small-6 columns">
				 <label>
					 <?php echo lang('expedido') ?>
					 <?php echo form_dropdown(array('name'=>'kardex[expedido]','required'=>'required','id'=>'kardex_expedid'), $expedidos) ?>
					 <span class="form-error"><?php echo lang('requerido') ?></span>
				 </label>
			 </div>
       <div class="large-4 medium-5 small-6 columns">
 				<label>
 					<?php echo lang('nombre.completo') ?>
 					 <input type="text" required pattern="[a-zA-ZñÑ\s]+" name="kardex[nombre_completo]" id="kardex_nombr">
 					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
 				</label>
 			</div>
			<div class="large-4 medium-5 small-6 columns">
				<label>
					<?php echo lang('domicilio') ?>
					 <input type="text" required pattern="^[a-zA-Z#º\d\s]+$" name="kardex[domicilio]" id="kardex_direccio" >
					 <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
				</label>
		</div>
		 <div class="large-2 medium-4 small-2 columns">
			 <label>
				 <?php echo lang('fecha.nacimiento') ?>
					<input type="text" id="kardex_fecha_nacimient" name="kardex[fecha_nacimiento]" class="datepicker">
					<span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
			 </label>
		 </div>
		 <div class="large-2 medium-2 small-2 columns">
			 <label>
				 <?php echo lang('genero') ?>
				 <?php echo form_dropdown(array('name'=>'kardex[sexo]','required'=>'required','id'=>'kardex_gener'), $sexos) ?>
				 <span class="form-error"><?php echo lang('requerido') ?></span>
			 </label>
		 </div>
		 <div class="large-2 medium-2 small-2 columns">
				<label>
					<?php echo lang('distrito') ?>
					 <input type="text" required pattern="^[a-zA-Z#º\d\s]+$" name="kardex[distrito]" id="kardex_distrit" >
					 <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
				</label>
		</div>
		<div class="large-4 medium-4 small-4 columns">
			 <label>
				 <?php echo lang('subalcaldia') ?>
				 <?php echo form_dropdown(array('name'=>'kardex[subalcaldia]','required'=>'required','id'=>'subalcaldia'), $subalcaldia) ?>
				 <span class="form-error"><?php echo lang('requerido') ?></span>
			 </label>
		 </div>

		 <div class="row">
			 <div class="large-12 medium-12 small-12 columns">
		 		<h3 class="center"><?php echo lang('detalle.adulto') ?></h3>
       </div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<?php echo lang('estado.civil') ?>
						<?php echo form_dropdown(array('name'=>'kardex[estado_civil]','required'=>'required'), $estados) ?>
						<span class="form-error"><?php echo lang('requerido') ?></span>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<?php echo lang('telefono') ?>
						 <input type="text" required pattern="[0-9]{7}"  name="kardex[telefono]">
						 <span class="form-error"><?php echo lang('numerico') ?></span>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<?php echo lang('celular') ?>
						 <input type="text" pattern="[0-9]{8}"  name="kardex[celular]">
						 <span class="form-error"><?php echo lang('numerico') ?></span>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<?php echo lang('instruccion') ?>
						 <input type="text" pattern="[a-zA-ZñÑ\s]+" name="kardex[instruccion]" rows="4">
						 <span class="form-error"><?php echo lang('alfabetico') ?></span>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<?php echo lang('nro.hijos') ?>
						 <input type="text" pattern="[0-9]+" name="kardex[nro_hijos]" rows="4">
						 <span class="form-error"><?php echo lang('alfabetico') ?></span>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<?php echo lang('nro.nietos') ?>
						 <input type="text" pattern="[0-9]+" name="kardex[nro_nietos]" rows="4">
						 <span class="form-error"><?php echo lang('alfabetico') ?></span>
					</label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label class="text-center"><strong><?php echo lang('trabaja') ?></strong></label>
				</div>
				<div class="large-9 medium-9 small-9 columns">
					<label class="text-center"><strong><?php echo lang('idioma') ?></strong></label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="radio" name="kardex[ocupacion]" value="SI TRABAJA"> <?php echo lang('si') ?>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="radio" name="kardex[ocupacion]" value="NO TRABAJA" ><?php echo lang('no') ?>
					</label>
				</div>

				<div class="large-2 medium-2 small-2 columns">
					<label >
						<input type="checkbox" name="kardexidioma[]" value="CASTELLANO"> <?php echo lang('castellano') ?>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="checkbox" name="kardexidioma[]" value="QUECHUA"><?php echo lang('quechua') ?>
					</label>
				</div>

				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="checkbox" name="kardexidioma[]" value="AYMARA"><?php echo lang('aymara') ?>

					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="checkbox" name="kardexidioma[]" value="OTRO"><?php echo lang('otro') ?>
					</label>
				</div>
 		</div>
		<h3 class="center"><?php echo lang('detalle.vivienda') ?></h3>
		<div class="row">
			<div class="large-12 medium-12 small-12 columns">
				<label class="text-center"><strong><?php echo lang('kardex.casa') ?></strong></label>
			</div>
			<div class="large-3 medium-3 small-3 columns">
				<label >
					<input type="radio" name="kardex[vivienda]" value="PROPIA"> <?php echo lang('propia') ?>
				</label>
			</div>
			<div class="large-3 medium-3 small-3 columns">
				<label >
					<input type="radio" name="kardex[vivienda]" value="CEDIDA"> <?php echo lang('cedida') ?>
				</label>
			</div>
			<div class="large-3 medium-3 small-3 columns">
				<label >
					<input type="radio" name="kardex[vivienda]" value="HERENCIA"> <?php echo lang('herencia') ?>
				</label>
			</div>
			<div class="large-3 medium-3 small-3 columns">
				<label>
					<input type="radio" name="kardex[vivienda]" value="ALQUILADA"><?php echo lang('alquilada') ?>
				</label>
			</div>
			<div class="large-3 medium-3 small-3 columns">
				<label >
					<input type="radio" name="kardex[vivienda]" value="PRESTADA"> <?php echo lang('prestada') ?>
				</label>
			</div>
			<div class="large-3 medium-3 small-3 columns">
				<label>
					<input type="radio" name="kardex[vivienda]" value="ANTICRETICO" ><?php echo lang('anticretico') ?>
				</label>
			</div>
			<div class="large-3 medium-3 small-3 columns">
				<label>
					<input type="radio" name="kardex[vivienda]" value="ALOJADO/A"><?php echo lang('alojado') ?>
				</label>
			</div>
			<div class="large-3 medium-3 small-3 columns">
				<label>
					<input type="radio" name="kardex[vivienda]" value="C/HIJOS" ><?php echo lang('chijos') ?>
				</label>
			</div>
			<div class="large-3 medium-3 small-3 columns">
				<label>
					<input type="radio" name="kardex[vivienda]" value="SITUACION DE CALLE" ><?php echo lang('situacion.calle') ?>
				</label>
			</div>
			<div class="large-12 medium-12 small-12 columns">
				<label class="text-center"><strong><?php echo lang('familiar.referencia') ?></strong></label>
			</div>
			<div class="large-3 medium-6 small-6 columns ">
				<label>
					<?php echo lang('vive.con') ?>
					<?php echo form_dropdown(array('name'=>'kardex[vive_con]','required'=>'required'), $parentescos) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>
			<div class="large-6 medium-8 small-8 columns">
				<label>
					<?php echo lang('nombre.completo') ?>
					 <input type="text" required pattern="[a-zA-ZñÑ\s]+"  name="kardex[nombre_referencia]">
					 <span class="form-error"><?php echo lang('numerico') ?></span>
				</label>
			</div>
			<div class="large-3 medium-6 small-6 columns">
				<label>
					<?php echo lang('telefono') ?>
					 <input type="text" required pattern="[0-9]{8}+[-0-9]{8}"  name="kardex[telefono_referencia]">
					 <span class="form-error"><?php echo lang('numerico') ?></span>
				</label>
			</div>
		</div>

		<h3 class="center"><?php echo lang('detalle.beneficios') ?></h3>
		<div class="row">
			<div class="large-5 medium-6 small-4 columns">
				<label class="text-center"><strong><?php echo lang('kardex.beneficio') ?></strong></label>
			</div>
			<div class="large-7 medium-6 small-4 columns">
				<label class="text-center"><strong><?php echo lang('kardex.salud') ?></strong></label>
			</div>
			<div class="large-2 medium-2 small-2 columns">
				<label >
					<input type="radio" name="kardex[beneficio]" value="RENTISTA"> <?php echo lang('rentista') ?>
				</label>
			</div>
			<div class="large-2 medium-2 small-2 columns">
				<label >
					<input type="radio" name="kardex[beneficio]" value="JUBILADO"> <?php echo lang('jubilado') ?>
				</label>
			</div>
			<div class="large-2 medium-2 small-2 columns">
				<label >
					<input type="radio" name="kardex[beneficio]" value="RENTA DIGNIDAD" > <?php echo lang('renta.dig') ?>
				</label>
			</div>
			<div class="large-2 medium-2 small-2 columns">
				<label >
					<input type="radio" name="kardex[beneficio]" value="OTROS" > <?php echo lang('otros') ?>
				</label>
			</div>

			<div class="large-2 medium-2 small-2 columns">
				<label >
					<input type="radio" name="kardex[salud]" value="SUS" > <?php echo lang('sus') ?>
				</label>
			</div>
			<div class="large-2 medium-2 small-2 columns">
				<label >
					<input type="radio" name="kardex[salud]" value="CAJA NACIONAL DE SALUD" > <?php echo lang('caja') ?>
				</label>
			</div>
			<div class="large-2 medium-2 small-2 columns">
				<label >
					<input type="radio" name="kardex[salud]" value="CAJA PETROLERA" > <?php echo lang('caja.petrolera') ?>
				</label>
			</div>
		</div>

		<div class="row">
			<h3 class="center"><?php echo lang('servicio.beneficios') ?></h3>

			<div class="large-2 medium-2 small-2 columns">
				<label >
					<input type="radio" name="kardex[servicio]" value="SERVICIO DE FISIOTERAPIA" > <?php echo lang('servicio.fisioterapia') ?>
				</label>
			</div>
			<div class="large-2 medium-2 small-2 columns">
				<label >
					<input type="radio" name="kardex[servicio]" value="SERVICIO DE BAILE" > <?php echo lang('servicio.baile') ?>
				</label>
			</div>
			<div class="large-4 medium-4 small-4 columns">
				<label >
					<input type="radio" name="kardex[servicio]" value="SERVICIO DE TERAPIA PREVENTIVA Y OCUPACIONAL" > <?php echo lang('servicio.terapia') ?>
				</label>
			</div>
			<div class="large-2 medium-2 small-2 columns">
				<label >
					<input type="radio" name="kardex[servicio]" value="EQUIPO MULTIDISCIPLINARIO" > <?php echo lang('servicio.equipo') ?>
				</label>
			</div>
			<div class="large-2 medium-2 small-2 columns">
				<label >
					<input type="radio" name="kardex[servicio]" value="OTRO" > <?php echo lang('servicio.otro') ?>
				</label>
			</div>

		</div>
			<div class="large-12 columns center">
				<button type="submit" name="new_kardex" value="1" class="button palette-Brown-500 bg">
						<i class="fontello-ok"></i><?php echo lang('registrar') ?>
				</button>
			</div>
		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar denuncia -->

<!-- Modal Editar denuncia  -->

<div class="large reveal" id="editarkardex" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('kardex/editkardex') ?>">
    	<h3 class="center"><?php echo lang('detalle.kardex') ?></h3>
			<div class="row">
			  <div class="large-8 columns">
					<div class="row">
		        <div class="large-12 medium-12 small-12 columns">
		  				<label>
		  					<?php echo lang('nombre.completo') ?>
		  					 <input type="text" required pattern="[a-zA-ZñÑ\s]+" name="kardex[nombre_completo]" id="kardex_nombre_completo">
		  					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
		  				</label>
		  			</div>
					</div>
					<div class="row">
  		    		<div class="large-12 columns">
								<label>
									<?php echo lang('domicilio') ?>
									 <input type="text" required pattern="^[a-zA-Z#º\d\s]+$" name="kardex[domicilio]" id="kardex_domicilio">
									 <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
								</label>
						</div>
					</div>
					<div class="row">
					 	 <div class="large-3 medium-5 small-6 columns">
			  				<label>
			  					<?php echo lang('dni') ?>
			  					 <input type="text" required pattern="[0-9]+[-a-zA-Z]{0,4}" name="kardex[dni]" id="kardex_dni">
			  					 <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
			  				</label>
		  				</div>
							<div class="large-3 medium-4 small-6 columns">
								<label>
									<?php echo lang('expedido') ?>
									<?php echo form_dropdown(array('name'=>'kardex[expedido]','required'=>'required','id'=>'kardex_expedido'), $expedidos) ?>
									<span class="form-error"><?php echo lang('requerido') ?></span>
								</label>
							</div>
							<div class="large-3 medium-4 small-6 columns">
			  				<label>
			  					<?php echo lang('fecha.nacimiento') ?>
			  					 <input type="text" name="kardex[fecha_nacimiento]" id="kardex_fecha_nacimiento" class="datepicker">
			  					 <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
			  				</label>

			  			</div>
							<div class="large-3 medium-3 small-3 columns">
								<label>
									<?php echo lang('genero') ?>
									<?php echo form_dropdown(array('name'=>'kardex[sexo]','required'=>'required','id'=>'kardex_sexo'), $sexos) ?>
									<span class="form-error"><?php echo lang('requerido') ?></span>
								</label>
							</div>	
					</div>
					<div class="row">
					<div class="large-4 medium-4 small-6 columns">
								<label>
									<?php echo lang('distrito') ?>
									 <input type="text" required pattern="^[a-zA-Z#º\d\s]+$" name="kardex[distrito]" id="kardex_distrito">
									 <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
								</label>
						</div>
						<div class="large-6 medium-5 small-5 columns">
								<label>
									<?php echo lang('subalcaldia') ?>
									<?php echo form_dropdown(array('name'=>'kardex[subalcaldia]','required'=>'required','id'=>'kardex_subalcaldia'), $subalcaldia) ?>
									<span class="form-error"><?php echo lang('requerido') ?></span>
								</label>
							</div>
					</div>
						<div class="large-12 columns center">
							<button type="submit" name="edit" class="button palette-Brown-500 bg">
									<i class="fontello-ok"></i><?php echo lang('actualizar') ?>
							</button>
					  </div>
				</div>
				<div class="large-4 columns center">
					<img src="" alt="" id="foto" class="large-10">
			 </div>
		</div>


    <input type="hidden" name="id_kardex" value="" id="kardex_id_kardex"/>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span></button>
	</form>
</div>

<!-- Fin Editar denuncia -->

<!-- Modal Editar informe tecnico legal de denuncia  -->

<div class="reveal" id="detallekardex" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('kardex/insertardetalle') ?>">
    	<h3 class="center"><?php echo lang('detalle.adulto') ?></h3>
			<div class="row">
				<div class="large-6 medium-6 small-6 columns">
					<label>
						<?php echo lang('estado.civil') ?>
						<?php echo form_dropdown(array('name'=>'kardex[estado_civil]','required'=>'required','id'=>'kardex_estado_civil'), $estados) ?>
						<span class="form-error"><?php echo lang('requerido') ?></span>
					</label>
				</div>

				<div class="large-6 medium-6 small-6 columns">
  				<label>
  					<?php echo lang('instruccion') ?>
  					 <input type="text" pattern="[a-zA-ZñÑ\s]+" name="kardex[instruccion]" id="kardex_instruccion" rows="4">
  					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
  				</label>
  			</div>

				<div class="large-2 medium-2 small-2 columns">
					<label class="text-center"><strong><?php echo lang('trabaja') ?></strong></label>
				</div>

				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="radio" name="kardex[ocupacion]" value="SI TRABAJA" id="kardex_si_trab"> <?php echo lang('si') ?>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="radio" name="kardex[ocupacion]" value="NO TRABAJA" id="kardex_no_trab"><?php echo lang('no') ?>
					</label>
				</div>

				<div class="large-12 medium-12 small-12 columns">
					<label class="text-center"><strong><?php echo lang('idioma') ?></strong></label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label >
						<input type="checkbox" name="kardexidioma[]" value="CASTELLANO" id="kardex_castellano"> <?php echo lang('castellano') ?>
					</label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label>
						<input type="checkbox" name="kardexidioma[]" value="QUECHUA" id="kardex_quechua"><?php echo lang('quechua') ?>
					</label>
				</div>

				<div class="large-3 medium-3 small-3 columns">
					<label>
						<input type="checkbox" name="kardexidioma[]" value="AYMARA" id="kardex_aymara"><?php echo lang('aymara') ?>

					</label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label>
						<input type="checkbox" name="kardexidioma[]" value="OTRO" id="kardex_otro"><?php echo lang('otro') ?>
					</label>
				</div>

				<div class="large-6 medium-6 small-6 columns">
  				<label>
  					<?php echo lang('nro.hijos') ?>
  					 <input type="text" pattern="[0-9]+" name="kardex[nro_hijos]" id="kardex_nro_hijos" rows="4">
  					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
  				</label>
  			</div>
				<div class="large-6 medium-6 small-6 columns">
  				<label>
  					<?php echo lang('nro.nietos') ?>
  					 <input type="text" pattern="[0-9]+" name="kardex[nro_nietos]" id="kardex_nro_nietos" rows="4">
  					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
  				</label>
  			</div>
				<div class="large-6 medium-6 small-6 columns">
					<label>
						<?php echo lang('telefono') ?>
						 <input type="text" required pattern="[0-9]{7}"  name="kardex[telefono]" id="kardex_telefono">
						 <span class="form-error"><?php echo lang('numerico') ?></span>
					</label>
				</div>
				<div class="large-6 medium-6 small-6 columns">
					<label>
						<?php echo lang('celular') ?>
						 <input type="text" pattern="[0-9]{8}"  name="kardex[celular]" id="kardex_celular">
						 <span class="form-error"><?php echo lang('numerico') ?></span>
					</label>
				</div>

				<div class="large-12 columns center">
					<button type="submit" name="edit_detalle" class="button palette-Brown-500 bg">
							<i class="fontello-ok"></i><?php echo lang('actualizar') ?>
					</button>
				</div>
		  </div>
		 <input type="hidden" name="id_kardex" value="" id="id_kardex" />
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Editar informe tecnico legal de denuncia -->

<!-- Modal Editar informe tecnico psicologico de denuncia  -->

<div class="reveal" id="detallevivienda" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('kardex/editar_vivienda') ?>">
    	<h3 class="center"><?php echo lang('detalle.vivienda') ?></h3>
			<div class="row">
				<div class="large-12 medium-12 small-12 columns">
					<label class="text-center"><strong><?php echo lang('kardex.casa') ?></strong></label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label >
						<input type="radio" name="kardex[vivienda]" value="PROPIA" id="kardex_propia"> <?php echo lang('propia') ?>
					</label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label >
						<input type="radio" name="kardex[vivienda]" value="CEDIDA" id="kardex_cedida"> <?php echo lang('cedida') ?>
					</label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label >
						<input type="radio" name="kardex[vivienda]" value="HERENCIA" id="kardex_herencia"> <?php echo lang('herencia') ?>
					</label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label>
						<input type="radio" name="kardex[vivienda]" value="ALQUILADA" id="kardex_alquiler"><?php echo lang('alquilada') ?>
					</label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label >
						<input type="radio" name="kardex[vivienda]" value="PRESTADA" id="kardex_prestada"> <?php echo lang('prestada') ?>
					</label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label>
						<input type="radio" name="kardex[vivienda]" value="ANTICRETICO" id="kardex_anticretico"><?php echo lang('anticretico') ?>
					</label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label>
						<input type="radio" name="kardex[vivienda]" value="ALOJADO/A" id="kardex_alojado"><?php echo lang('alojado') ?>
					</label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label>
						<input type="radio" name="kardex[vivienda]" value="C/HIJOS" id="kardex_chijos"><?php echo lang('chijos') ?>
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label>
						<input type="radio" name="kardex[vivienda]" value="SITUACION DE CALLE" id="kardex_scalle"><?php echo lang('situacion.calle') ?>
					</label>
				</div>
				<div class="large-12 medium-12 small-12 columns">
					<label class="text-center"><strong><?php echo lang('familiar.referencia') ?></strong></label>
				</div>
				<div class="large-6 medium-6 small-6 columns large-centered ">
					<label>
						<?php echo lang('vive.con') ?>
						<?php echo form_dropdown(array('name'=>'kardex[vive_con]','required'=>'required','id'=>'kardex_vive'), $parentescos) ?>
						<span class="form-error"><?php echo lang('requerido') ?></span>
					</label>
				</div>
				<div class="large-8 medium-8 small-8 columns large-centered">
					<label>
						<?php echo lang('nombre.completo') ?>
						 <input type="text" required pattern="[a-zA-ZñÑ\s]+"  name="kardex[nombre_referencia]" id="kardex_nombre_referencia">
						 <span class="form-error"><?php echo lang('numerico') ?></span>
					</label>
				</div>
				<div class="large-6 medium-6 small-6 columns large-centered">
					<label>
						<?php echo lang('telefono') ?>
						 <input type="text" required pattern="[0-9]{8}+[-0-9]{8}"  name="kardex[telefono_referencia]" id="kardex_telefono_referencia">
						 <span class="form-error"><?php echo lang('numerico') ?></span>
					</label>
				</div>


				<div class="large-12 columns center">
					<button type="submit" name="edit_detalle" class="button palette-Brown-500 bg">
							<i class="fontello-ok"></i><?php echo lang('actualizar') ?>
					</button>
				</div>

		</div>
		<input type="hidden" name="id_kardex" value="" id="id">

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Editar informe tecnico psicologico de denuncia -->

<!-- Modal Editar informe tecnico social de denuncia  -->

<div class="reveal" id="detalleservicio" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('kardex/editar_servicio') ?>">
    	<h3 class="center"><?php echo lang('detalle.beneficios') ?></h3>
			<div class="row">
				<div class="large-12 medium-12 small-12 columns">
					<label class="text-center"><strong><?php echo lang('kardex.beneficio') ?></strong></label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label >
						<input type="radio" name="kardex[beneficio]" value="RENTISTA" id="kardex_rentista"> <?php echo lang('rentista') ?>
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label >
						<input type="radio" name="kardex[beneficio]" value="JUBILADO" id="kardex_jubilado"> <?php echo lang('jubilado') ?>
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label >
						<input type="radio" name="kardex[beneficio]" value="RENTA DIGNIDAD" id="kardex_renta_dig"> <?php echo lang('renta.dig') ?>
					</label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label >
						<input type="radio" name="kardex[beneficio]" value="OTROS" id="kardex_otros"> <?php echo lang('otros') ?>
					</label>
				</div>
				<div class="large-12 medium-12 small-12 columns">
					<label class="text-center"><strong><?php echo lang('kardex.salud') ?></strong></label>
				</div>
				<div class="row">
				<div class="large-4 medium-4 small-4 columns">
					<label >
						<input type="radio" name="kardex[salud]" value="SUS" id="kardex_sus"> <?php echo lang('sus') ?>
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label >
						<input type="radio" name="kardex[salud]" value="CAJA NACIONAL DE SALUD" id="kardex_caja"> <?php echo lang('caja') ?>
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label >
						<input type="radio" name="kardex[salud]" value="CAJA PETROLERA" id="kardex_caja_petro"> <?php echo lang('caja.petrolera') ?>
					</label>
				</div>
				</div>
				<h3 class="center"><?php echo lang('servicio.beneficios') ?></h3>
				<div class="large-2 medium-2 small-2 columns">
				<label >
					<input type="radio" name="kardex[servicio]" value="SERVICIO DE FISIOTERAPIA" id="kardex_sfisio"> <?php echo lang('servicio.fisioterapia') ?>
				</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label >
						<input type="radio" name="kardex[servicio]" value="SERVICIO DE BAILE" id="kardex_sbaile" > <?php echo lang('servicio.baile') ?>
					</label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label >
						<input type="radio" name="kardex[servicio]" value="SERVICIO DE TERAPIA PREVENTIVA Y OCUPACIONAL" id="kardex_sterapia" > <?php echo lang('servicio.terapia') ?>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label >
						<input type="radio" name="kardex[servicio]" value="EQUIPO MULTIDISCIPLINARIO" id="kardex_smulti" > <?php echo lang('servicio.equipo') ?>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label >
						<input type="radio" name="kardex[servicio]" value="OTRO" id="kardex_otro" > <?php echo lang('servicio.otro') ?>
					</label>
				</div>

				<div class="large-12 columns center">
					<button type="submit" name="edit_kardexbeneficio" class="button palette-Brown-500 bg">
							<i class="fontello-ok"></i><?php echo lang('actualizar') ?>
					</button>
				</div>

				<input type="hidden" name="id_kardex" value="" id="id_kar" />


		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- subir fotografia -->
<div class="tiny reveal" id="fotografiaAdulto" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" enctype="multipart/form-data" action="<?php echo site_url('Kardex/subirfoto') ?>">
    <h3 class="center"><?php echo lang('cargar.foto') ?></h3>
		 <div class="row">
			 <div class="large-12 columns">
 				<div class="center">
 					<label id="upload_kardex" class="center">
 						 <input type="file" name="foto_persona">
 					</label>
 				</div>
 			</div>
		 </div>
		 <?php echo br(14); ?>
		<input type="hidden" name="id_kardex" value="" id="id_kardex_foto"/>
		<div class="row">
			<div class="large-12 columns center">
				<button type="submit" name="update_foto" value="1" class="button palette-Orange-700 bg">
						<i class="fontello-ok"></i><?php echo lang('guardar') ?>
				</button>
			</div>
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- INSERTAR MAPA   -->
<div class="large reveal" id="vermapa" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('kardex/registrar_ubi') ?>">
    	<h3 class="center"><?php echo lang('registrar.ubicacion') ?></h3>
			<div class="row">
			    <div class="large-12 medium-12 small-12 columns">
			        <div class="box no-shadow ">
			            <div class="box-header panel palette-Grey-800 bg">
			                <h3 class="box-title palette-White"><i class="fontello-map"></i>
			                    <span><?php echo lang('mapa') ?></span>
			                </h3>
			            </div>
			             <div class="box-body">
			                <div class="row">
			                    <div id="map">
			                    </div>
													<input type="hidden" name="latitud" value="" id="latitude"/>
													<input type="hidden" name="longitud" value="" id="longitude"/>
													<input type="hidden" name="id_kardex" value="" id="id_kard"/>
			                </div>
											<div class="row">
												<div class="large-12 columns center">
													<button type="submit" name="update_foto" value="1" class="button palette-Orange-700 bg">
															<i class="fontello-ok"></i><?php echo lang('guardar') ?>
													</button>
												</div>
											</div>
			             </div>
			         </div>
			    </div>
			</div>
			<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>

		</form>
</div>

<!-- FIN DE INSERTAR MAPA  -->


<script type="text/javascript">

	$('#upload_kardex').loadImg({
		"fileExt"   : ["png","jpg"],
		"fileSize_min"  : 0,
		"fileSize_max"  : 3, // 1 mb
		"text": "Cargar foto ..."
	});
</script>
<!-- Fin subir fotografia -->


<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
  $('#kardex_ci').change(function(){

  	var kardex_ci = $(this).val();
  	var dataString = 'denunciante_dni='+kardex_ci;

  	$.ajax({
  		type: "POST",
  		url: "<?php echo site_url('denuncias/buscar_persona'); ?>",
  		dataType: "json",
  		data: dataString,
  		success: function(response) {
  					$('#kardex_nombr').val(response.data.nombre_completo);
  				    $('#kardex_direccio').val(response.data.direccion);
  					$('#kardex_fecha_nacimient').val(response.data.fecha_nacimiento);
  					$('#kardex_expedid').val(response.data.expedido_denunciante);
  					$('#kardex_gener').val(response.data.genero);
  					//$('#denuncia_id_victima').val(response.data.id_denunciante);

  		 },
  			error: function(response) {
  				console.log(response);
  			}
  		});
  });

  $('.fotoAdulto').click(function() {
  	var id = $(this).attr('content');

		$.getJSON('<?php echo site_url('servicio/getKardex');?>', { id: id })

		.done(function(data) {
			$("#id_kardex_foto").val(data.id_kardex);

		});

	});

	$('.editar_kar').click(function() {

		var id = $(this).attr('content');

			$.getJSON('<?php echo site_url('servicio/getKardex');?>', { id: id })

			.done(function(data) {

				$("#kardex_nombre_completo").val(data.nombre_completo);
				$("#kardex_dni").val(data.dni);
				$("#kardex_expedido").val(data.expedido);
				$("#kardex_domicilio").val(data.domicilio);
				$("#kardex_fecha_nacimiento").val(data.fecha_nacimiento);
				$("#kardex_sexo").val(data.sexo);
				$("#kardex_distrito").val(data.distrito);
				$("#kardex_subalcaldia").val(data.subalcaldia);


				var foto = data.foto;
				var ruta= 'public/fotos/adultos/'+foto;
				$('#foto').attr("src", ruta);

				$("#kardex_id_kardex").val(data.id_kardex);
			});
	});
	//después de obtener el nombre de la imagen puedes armar la ruta


	$('.detalle_kar').click(function() {

		var id = $(this).attr('content');

			$.getJSON('<?php echo site_url('servicio/getKardex');?>', { id: id })

			.done(function(data) {
				$("#kardex_telefono").val(data.telefono);
			  $("#kardex_celular").val(data.celular);
				$("#kardex_estado_civil").val(data.estado_civil);
        $("#kardex_instruccion").val(data.instruccion);
				$("#kardex_lugar_trabajo").val(data.lugar_trabajo);

				$("#kardex_vivienda").val(data.vivienda);
				$("#kardex_nro_hijos").val(data.nro_hijos);
				$("#kardex_nro_nietos").val(data.nro_nietos);

				$("#id_kardex").val(data.id_kardex);

				var kardex_idioma = data.idioma;

				switch (kardex_idioma)
				{

				 case 'CASTELLANO':  $("#kardex_castellano").prop( "checked", true );  break;
				 case 'QUECHUA':  $("#kardex_quechua").prop( "checked", true ); break;
				 case 'AYMARA': $("#kardex_aymara").prop( "checked", true ); break;
				 case 'OTRO': $("#kardex_otro").prop( "checked", true );  break;
				 case 'CASTELLANO, QUECHUA': $("#kardex_castellano,#kardex_quechua").prop( "checked", true );  break;
				 case 'CASTELLANO, AYMARA': $("#kardex_castellano,#kardex_aymara").prop( "checked", true );  break;
				 case 'CASTELLANO, OTRO': $("#kardex_castellano,#kardex_otro").prop( "checked", true );  break;
				 case 'QUECHUA, AYMARA': $("#kardex_quechua,#kardex_aymara").prop( "checked", true );  break;
				 case 'QUECHUA, OTRO': $("#kardex_quechua,#kardex_otro").prop( "checked", true );  break;
				 case 'AYMARA, OTRO': $("#kardex_aymara,#kardex_otro").prop( "checked", true );  break;
				}
				var kardex_ocupacion = data.ocupacion;

				switch (kardex_ocupacion)
				{
				 case 'SI TRABAJA':  $("#kardex_si_trab").prop( "checked", true );  break;
				 case 'NO TRABAJA':  $("#kardex_no_trab").prop( "checked", true ); break;
				}
			});
	});

$('.vivienda_kar').click(function() {

	var id = $(this).attr('content');

		$.getJSON('<?php echo site_url('servicio/getKardex');?>', { id: id })

		.done(function(data) {
			$("#kardex_vive").val(data.vive_con);
			$("#kardex_nombre_referencia").val(data.nombre_referencia);
			$("#kardex_telefono_referencia").val(data.telefono_referencia);

			$("#id").val(data.id_kardex);

			var kardex_vivienda = data.vivienda;
			switch (kardex_vivienda)
			{
			 case 'PROPIA':  $("#kardex_propia").prop("checked", true );  break;
			 case 'CEDIDA':  $("#kardex_cedida").prop("checked", true );  break;
			 case 'HERENCIA':  $("#kardex_herencia").prop("checked", true );  break;
			 case 'ALQUILER':  $("#kardex_alquiler").prop( "checked", true ); break;
			 case 'PRESTADA':  $("#kardex_prestada").prop( "checked", true ); break;
			 case 'ANTICRETICO': $("#kardex_anticretico").prop( "checked", true ); break;
			 case 'ALOJADO/A': $("#kardex_alojado").prop( "checked", true );  break;
			 case 'C/HIJOS': $("#kardex_chijos").prop( "checked", true );  break;
			 case 'SITUACION DE CALLE': $("#kardex_scalle").prop( "checked", true );  break;

			}
		});
});
$('.servicios_kar').click(function() {

	var id = $(this).attr('content');

		$.getJSON('<?php echo site_url('servicio/getKardex');?>', { id: id })

		.done(function(data) {

			$("#id_kar").val(data.id_kardex);

			var kardex_salud = data.salud;
			switch (kardex_salud)
			{
			 case 'SUS':  $("#kardex_sus").prop("checked", true );  break;
			 case 'CAJA NACIONAL DE SALUD':  $("#kardex_caja").prop("checked", true );  break;
			 case 'CAJA PETROLERA':  $("#kardex_caja_petro").prop("checked", true );  break;


			}

			var kardex_beneficio = data.beneficio;
			switch (kardex_beneficio)
			{
			 case 'RENTISTA':  $("#kardex_rentista").prop("checked", true );  break;
			 case 'JUBILADO':  $("#kardex_jubilado").prop("checked", true );  break;
			 case 'RENTA DIGNIDAD':  $("#kardex_renta_dig").prop("checked", true );  break;
			 case 'OTROS':  $("#kardex_otros").prop("checked", true );  break;
			}

			var kardex_servicio = data.servicio;
			switch (kardex_servicio)
			{
			 case 'SERVICIO DE FISIOTERAPIA':  $("#kardex_sfisio").prop("checked", true );  break;
			 case 'SERVICIO DE BAILE':  $("#kardex_sbaile").prop("checked", true );  break;
			 case 'SERVICIO DE TERAPIA PREVENTIVA Y OCUPACIONAL':  $("#kardex_sterapia").prop("checked", true );  break;
			 case 'EQUIPO MULTIDISCIPLINARIO':  $("#kardex_smulti").prop("checked", true );  break;
			 case 'OTRO':  $("#kardex_otros").prop("checked", true );  break;
			}
		});
});

$('.ver_mapa').click(function() {

	var id = $(this).attr('content');

		$.getJSON('<?php echo site_url('servicio/getKardex');?>', { id: id })

		.done(function(data) {

			$("#id_kard").val(data.id_kardex);
			$("#latitude").val(data.latitud);
			$("#longitude").val(data.longitud);

			var latitud = data.latitud;
		  var longitud = data.longitud;
			//console.log(latitud);

			if(latitud == null && longitud == null){
				var latitud = -17.393834;
			  var longitud = -66.156964;
			}

		 //var map = L.map('map').setView([-17.393834, -66.156964], 17);
		   var map = L.map('map').setView([latitud,longitud], 17);

		  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		  }).addTo(map);


		  //var marker =L.marker([-17.393834, -66.156964]);
		  var marker =L.marker([latitud,longitud],
		  {draggable: true}).addTo(map);
		  marker.on('dragend', function(event){
		    var position = marker.getLatLng();
		    marker.setLatLng(position, {
		    draggable: 'true'
		    }).bindPopup(position).update();
		    $("#latitude").val(position.lat);
		    $("#longitude").val(position.lng).keyup();
		   });

				var popup = "Centro de la Ciudad de Cochabamba";
				marker.bindPopup(popup);
				marker.addTo(map);
				var popup = L.popup();

				/*function onMapClick(e) {
						popup
								.setLatLng(e.latlng)
								.setContent("Mi domicilio es: " + e.latlng.toString())
								.openOn(map);
				}

				map.on('click', onMapClick);*/


		});
  });
});
</script>
<script>
   $(document).ready(function () {
        $('.datepicker').pickadate({
            monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
            today: 'Hoy',
            clear: 'Limpiar',
            close: 'Cerrar',
            firstDay: 0,

            labelMonthNext: 'Mes Siguiente',
            labelMonthPrev: 'Mes Anterior',
            labelMonthSelect: 'Seleccione un Mes',
            labelYearSelect: 'Seleccione un Año',
            //format: 'd mmmm !de yyyy',
            format: 'yyyy-mm-dd',
            formatSubmit: 'yyyy-mm-dd',
            selectYears: 90,
            selectMonths: true,
            max: true,
            closeOnSelect: true,
            containerHidden: '#hidden-input-outlet'
        });

       $('.tooltipster-top').tooltipster({
           position: "top"
       });

       $('.dinamico').DataTable({

         "order": [[0, "asc"]],

         responsive: true,

         "language":{
                        "lengthMenu": "Mostrar _MENU_",
                        "zeroRecords": "No se encontró nada",
                        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                        "search": "Buscar",
                        "previous": "Anterior",
                        "oPaginate": { "sNext":"Siguiente", "sLast": "Último", "sPrevious": "Anterior", "sFirst":"Primero" },
                        "oAria":
                                {
                                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                }
                    }
      });
   });
</script>

<?php $this->load->view('seccion/pie'); ?>
<script type="text/javascript">
	 var nuevoalias = jQuery.noConflict();
	 nuevoalias(document).ready(function() {

	var method  = '<?php echo $this->router->fetch_method(); ?>';
	var control  = '<?php echo $this->router->fetch_class(); ?>';


	 });
</script>
