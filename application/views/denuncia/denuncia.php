<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>

<div class="row">
	<div class="large-12 columns">
		<?php $this->load->view('seccion/mensaje') ?>
	</div>
</div>

<!-- MAPA-->

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
                    <div class="large-12 medium-12 small-12 columns">
                        <center>
                            <div id="map">
                                <div id="popup" class="ol-popup">
                                    <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                                    <div id="popup-content"></div>
                                </div>
                            </div>
                            <div id="wrapper">
                                <div id="location"></div>
                                <div id="scale"></div>
                            </div>
                        </center>
                    </div>
                </div>
             </div>
         </div>
    </div>
</div>

        <br>

<div class="row">
	<div class="large-10 columns large-centered" >
		<div class="box no-shadow ">
	        <div class="box-header panel palette-Brown-500 bg">
	            <!-- tools box -->
	            <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
	                <span class="palette-White-Text text" ><?php echo lang('lista.denuncias')?></span>
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
																	<td><?php echo fecha($denuncia->fecha_denuncia) ?></td>


																	<td>
										                <div class="small button-group">
																				<button data-open="editdenuncia" content="<?php echo $denuncia->id_denuncia ?>" title="<?php echo lang('actualizar') ?>" class="button palette-Brown-500 bg editar tooltipster-top" >
																					 <i class="fontello-pencil"></i>
								                        </button>

																				<?php if($parte_area == 'LEGAL' || $nombre_rol == "ADMINISTRADOR" || $nombre_rol =="REVISOR"){?>
																					<button data-open="informelegal" content="<?php echo $denuncia->id_denuncia ?>" title="<?php echo lang('informe.legal') ?>" class="button palette-Brown-500 bg editarinforme tooltipster-top" >
																						 <i class="la la-legal"></i>

									                        </button>

																			  <?php } ?>

																				<?php if($parte_area == 'PSICOLOGICO' || $nombre_rol == "ADMINISTRADOR" || $nombre_rol =="REVISOR"){?>
																					<button data-open="informepsicologico" content="<?php echo $denuncia->id_denuncia ?>" title="<?php echo lang('informe.spsicologico') ?>" class="button palette-Brown-500 bg editarpsicologico tooltipster-top" >
																						 <i class="fontello-doc-add"></i>
									                        </button>
																			  <?php } ?>

																				<?php if($parte_area == 'SOCIAL' || $nombre_rol == "ADMINISTRADOR" || $nombre_rol =="REVISOR" ){?>
																					<button data-open="informesocial" content="<?php echo $denuncia->id_denuncia ?>" title="<?php echo lang('informe.sociologo') ?>" class="button palette-Brown-500 bg editarsocial tooltipster-top" >
																						 <i class="la la-users"></i>
									                        </button>
																			  <?php } ?>
																				<button data-open="archivosdenuncia" content="<?php echo $denuncia->id_denuncia ?>" title="<?php echo lang('archivar.denuncia') ?>" class="button palette-Brown-500 bg editararchivo tooltipster-top" >
																					 <i class="fontello-archive"></i>
																				</button>
																				<button data-open="cerrardenuncia" content="<?php echo $denuncia->id_denuncia ?>" title="<?php echo lang('cerrar.denuncia') ?>" class="button palette-Brown-500 bg editarcerrar tooltipster-top" >
																					 <i class="fontello-lock-filled"></i>
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
				            <a data-open="newdenuncia" class="button palette-Brown-500 bg"><i class="fontello-user-add"></i><?php echo lang('registrar.denuncia') ?></a>
									</div>
						</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<!-- Modal Agregar Usuario  -->

<div class="reveal" id="newdenuncia" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('denuncias/registrar') ?>">
    	<h3 class="center"><?php echo lang('registrar.denuncia') ?></h3>
		<div class="row">
			<!--div class="large-12 medium-12 small-12 columns">
				<label>
					<?php echo lang('denuncia') ?>
					 <input type="text" required pattern="[a-zA-ZñÑ\s]+" name="denuncia[denuncia]">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div-->
			<div class="large-6 medium-6 small-6 columns">
				<label>
					<?php echo lang('tipologia.principal') ?>

					<?php echo form_dropdown(array('name'=>'denuncia[id_categoria]','required'=>'required'), $categorias) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>
			<div class="large-6 medium-6 small-6 columns">
				<label>
					<?php echo lang('tipologia.secundaria') ?>(opcional)

					<?php echo form_dropdown(array('name'=>'denuncia[id_categoria_secundaria]'), $categorias) ?>

				</label>
			</div>

			<div class="large-5 medium-5 small-5 columns">
				<label>
					<?php echo lang('otb') ?>
					 <input type="text" required pattern="[a-zA-ZñÑ\s]+" name="denuncia[otb]" id="denuncia_otb">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>

			<div class="large-5 medium-5 small-5 columns">
				<label>
					<?php echo lang('subalcaldia') ?>
					 <input type="text" required pattern="[a-zA-ZñÑ\s]+" name="denuncia[subalcaldia]" id="denuncia_subalcaldia">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>
			<div class="large-2 medium-2 small-2 columns">
				<label>
					<?php echo lang('distrito') ?>
					 <input type="text" required  name="denuncia[distrito]" id="denuncia_distrito">
					 <span class="form-error"><?php echo lang('alfanumerico') ?></span>
				</label>
			</div>
			<?php //if($nombre_rol == "ADMINISTRADOR" || $nombre_rol =="REVISOR" ){?>
				<!--div class="large-6 medium-6 small-6 columns">
					<label>
						<?php //echo lang('centro') ?>

						<?php// echo form_dropdown(array('name'=>'denuncia[id_centro]','required'=>'required'), $centros) ?>
						<span class="form-error"><?php //echo lang('centro') ?></span>
					</label>
				</div-->
			<?php //}?>

      <div class="large-12 medium-12 small-12 columns">
        <h4 class="center"><?php echo lang('datos.denunciante') ?></h4>
      </div>
			<div class="large-3 medium-8 small-6 columns">
				<label>
					<?php echo lang('dni') ?>
					 <input type="text" required pattern="[0-9-]+" name="denunciante[dni_denunciante]" id="denunciante_dni">
					 <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
				</label>
			</div>
			<div class="large-3 medium-4 small-6 columns">
				<label>
					<?php echo lang('expedido') ?>
					<?php echo form_dropdown(array('name'=>'denunciante[expedido_denunciante]','required'=>'required','id'=>'denunciante_expedido'), $expedidos) ?>
					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>
			<div class="large-6 medium-12 small-12 columns">
				<label>
					<?php echo lang('nombre.completo') ?>
					 <input type="text" required pattern="[a-zA-ZñÑ\s]+" name="denunciante[nombre_completo]" id="denunciante_nombre">
					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
				</label>
			</div>


			<div class="large-4 medium-4 small-6 columns">
				<label>
					<?php echo lang('genero') ?>
					<?php echo form_dropdown(array('name'=>'denunciante[genero]','id'=>'denunciante_genero'), $sexos) ?>

					<span class="form-error"><?php echo lang('requerido') ?></span>
				</label>
			</div>
      <div class="large-4 medium-4 small-6 columns">
				<label>
					<?php echo lang('telefono') ?>
					 <input type="text" required pattern="[0-9]{8}+[-0-9]{8}"  name="denunciante[telefono]" id="denunciante_telefono">
					 <span class="form-error"><?php echo lang('numerico') ?></span>
				</label>
			</div>
      <div class="large-4 medium-6 small-6 columns">
				<label>
					<?php echo lang('fecha.nacimiento') ?>
					 <input type="text" name="denunciante[fecha_nacimiento]" id="fecha_nacimiento" class="datepicker">
					 <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
				</label>
			</div>
      <div class="large-6 medium-12 small-12 columns">
				<label>
					<?php echo lang('domicilio') ?>
					 <input type="text" required pattern="^[a-zA-Z#º.\d\s]+$" name="denunciante[direccion]" id="denunciante_direccion">
					 <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
				</label>
			</div>

			<div class="large-6 medium-12 small-12 columns">
				<label>
					Descripcion de la denuncia
					<textarea required pattern="[a-zA-ZñÑ\s]+" name="denuncia[descripcion]" id="denunciate_denuncia" oninput="this.value = this.value.toUpperCase();"></textarea>
				</label>
			</div>



			<div class="large-12 medium-12 small-12 columns">
				<label><?php echo lang('procedencia.denunciante') ?></label>
			</div>
			<div class="large-3 medium-3 small-3 columns">
				<label >
					<input type="radio" name="denuncia[procedencia]" value="INSTITUCIONES"><?php echo lang('instituciones') ?>
				</label>
			</div>
			<div class="large-3 medium-3 small-3 columns">
				<label>
					<input type="radio" name="denuncia[procedencia]" value="ADULTO MAYOR"><?php echo lang('adulto') ?>
				</label>
			</div>
			<div class="large-3 medium-3 small-3 columns">
				<label >
					<input type="radio" name="denuncia[procedencia]" value="FAMILIAR"><?php echo lang('familiar') ?>
				</label>
			</div>
			<div class="large-3 medium-3 small-3 columns">
				<label >
					<input type="radio" name="denuncia[procedencia]" value="PERSONA AJENA"><?php echo lang('ajenos') ?>
				</label>
			</div>
      <input type="hidden" name="denuncia_coord_s" value="" id="registrar_coord_s" />
      <input type="hidden" name="denuncia_coord_e" value="" id="registrar_coord_e" />
			<div class="large-12 columns center">
				<button type="submit" name="new_denuncia" value="1" class="button palette-Brown-500 bg">
						<i class="fontello-ok"></i><?php echo lang('registrar') ?>
				</button>
			</div>
		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Agregar denuncia -->

<!-- Modal Editar denuncia  -->

<div class="large reveal" id="editdenuncia" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('denuncias/editar') ?>">

    	<h3 class="center"><?php echo lang('editar.denuncia') ?></h3>
			<div class="row">

				<div class="large-4 medium-4 small-6 columns">
					<label>
						<?php echo lang('tipologia.principal') ?>

						<?php echo form_dropdown(array('name'=>'denuncia[id_categoria]','required'=>'required','id'=>'denuncia_id_categoria'), $categorias)?>

						<span class="form-error"><?php echo lang('requerido') ?></span>
					</label>
				</div>
				<div class="large-4 medium-4 small-6 columns">
					<label>
						<?php echo lang('tipologia.secundaria') ?> (*opcional)
						<?php echo form_dropdown(array('name'=>'denuncia[id_categoria_secundaria]','id'=>'denuncia_id_categoria_secundaria'), $categorias)?>
					</label>
				</div>
				<div class="large-4 medium-3 small-6 columns">
  				<label>
  					<?php echo lang('codigo') ?>
  					 <input type="text" required pattern="[a-zA-Z]+" name="denuncia[codigo_denuncia]" id="denuncia_codigo" readonly>
  					 <span class="form-error"><?php echo lang('alpha.space') ?></span>
  				</label>
  			</div>
				<!--div class="large-4 medium-4 small-4 columns">
					<label>
						<?php //echo lang('subalcaldia') ?>
						<?php //echo form_dropdown(array('name'=>'denuncia[id_centro]','required'=>'required','id'=>'denuncia_id_centro'), $centros) ?>
						<span class="form-error"><?php //echo lang('requerido') ?></span>
					</label>
				</div-->
        <div class="large-4 medium-4 small-4 columns">
  				<label>
  					<?php echo lang('otb') ?>
  					 <input type="text" required pattern="[a-zA-ZñÑ\s]+" name="denuncia[otb]" id="denun_otb">
  					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
  				</label>
  			</div>

  			<div class="large-3 medium-3 small-3 columns">
  				<label>
  					<?php echo lang('subalcaldia') ?>
  					 <input type="text" required pattern="[a-zA-ZñÑ\s]+" name="denuncia[subalcaldia]" id="denun_subalcaldia" readonly>
  					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
  				</label>
  			</div>
				<div class="large-2 medium-2 small-2 columns">
  				<label>
  					<?php echo lang('distrito') ?>
  					 <input type="text" required name="denuncia[distrito]" id="denun_distrito">
  					 <span class="form-error"><?php echo lang('alfanumerico') ?></span>
  				</label>
  			</div>

        <div class="large-12 medium-12 small-12 columns">
          <h4 class="center"><?php echo lang('editar.denunciante') ?></h4>
        </div>
				<div class="large-2 medium-3 small-3 columns">
          <label>
  					<?php echo lang('dni') ?>
  					 <input type="text" required pattern="[0-9]+[-a-zA-Z]{0,4}" name="denunciante[dni_denunciante]" id="denunciante_editar_dni_denunciante" readonly>
  					 <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
  				</label>
  			</div>
				<div class="large-2 medium-4 small-4 columns">
					<label>
						<?php echo lang('expedido') ?>
						<?php echo form_dropdown(array('name'=>'denunciante[expedido_denunciante]','required'=>'required','id'=>'denunciante_editar_expedido'), $expedidos) ?>
						<span class="form-error"><?php echo lang('requerido') ?></span>
					</label>
				</div>
				<div class="large-2 medium-1 small-1 columns">
					<label>
						<?php echo lang('genero') ?>
						<?php echo form_dropdown(array('name'=>'denunciante[genero]','id'=>'denunciante_editar_genero'), $sexos) ?>

						<span class="form-error"><?php echo lang('requerido') ?></span>
					</label>
				</div>
				<div class="large-4 medium-6 small-6 columns">
  				<label>
  					<?php echo lang('nombre.completo') ?>
  					 <input type="text" pattern="[a-zA-ZñÑ\s]+" name="denuncia[denunciante]" id="denuncia_denunciante">
  					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
  				</label>
  			</div>
				<div class="large-2 medium-4 small-4 columns">
  				<label>
  					<?php echo lang('telefono') ?>
  					 <input type="text" required pattern="[0-9]{8}+[-0-9]{8}" name="denunciante[telefono]" id="denunciante_editar_telefono">
  					 <span class="form-error"><?php echo lang('numerico') ?></span>
  				</label>
  			</div>
				<div class="large-4 medium-4 small-4 columns">
  				<label>
  					<?php echo lang('domicilio') ?>
  					 <input type="text" required pattern="^[a-zA-Z#º\d\s]+$" name="denunciante[direccion]" id="denunciante_editar_direccion">
  					 <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
  				</label>
  			</div>
				<div class="large-8 medium-8 small-8 columns">
					<label><?php echo lang('procedencia.denunciante') ?></label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label >
						<input type="radio" name="denuncia[procedencia]" value="INSTITUCIONES" id="den_ins"> <?php echo lang('instituciones') ?>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="radio" name="denuncia[procedencia]" value="ADULTO MAYOR" id="den_am"><?php echo lang('adulto') ?>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label >
						<input type="radio" name="denuncia[procedencia]" value="FAMILIAR" id="den_fam"><?php echo lang('familiar') ?>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label >
						<input type="radio" name="denuncia[procedencia]" value="PERSONA AJENA" id="den_pa"><?php echo lang('ajenos') ?>
					</label>
				</div>

        <div class="large-12 medium-12 small-12 columns">
          <h4 class="center"><?php echo lang('editar.victima') ?></h4>
        </div>
				<div class="large-2 medium-2 small-2 columns">
          <label>
  					<?php echo lang('dni') ?>
  					 <input type="text"  pattern="[0-9]+[-a-zA-Z]{0,4}" name="victima[dni]" id="victima_editar_dni">
  					 <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
  				</label>
  			</div>
				<div class="large-4 medium-3 small-3 columns">
  				<label>
  					<?php echo lang('nombre.completo') ?>
  					 <input type="text" pattern="[a-zA-ZñÑ\s]+" name="denuncia[victima]" id="denuncia_victima">
  					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
  				</label>
  			</div>

				<div class="large-2 medium-4 small-4 columns">
					<label>
						<?php echo lang('expedido') ?>
						<?php echo form_dropdown(array('name'=>'victima[expedido]','required'=>'required','id'=>'victima_editar_expedido'), $expedidos) ?>
						<span class="form-error"><?php echo lang('requerido') ?></span>
					</label>
				</div>


        <div class="large-2 medium-2 small-2 columns">
  				<label>
  					<?php echo lang('fecha.nacimiento') ?>
  					 <input type="text" name="victima[fecha_nacimiento]" id="victima_fecha_nacimiento" class="datepicker">
  					 <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
  				</label>
  			</div>
				<div class="large-2 medium-1 small-1 columns">
					<label>
						<?php echo lang('genero') ?>
						<?php echo form_dropdown(array('name'=>'victima[sexo]','id'=>'victima_sexo'), $sexos) ?>

						<span class="form-error"><?php echo lang('requerido') ?></span>
					</label>
				</div>
				<div class="large-4 medium-4 small-6 columns">
					<label>
						<?php echo lang('domicilio') ?>
						<input type="text" pattern="^[a-zA-Z#º\d\s]+$" name="victima[domicilio]" id="victima_editar_domicilio">
						<span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
					</label>
				</div>
				<!--nuevos cambios-->
				<div class="large-4 medium-4 small-6 columns">
					<label>
						Ocupación u oficio
						<input type="text" pattern="^[a-zA-Z#º\d\s]+$" name="victima[ocupacion_victima]" id="victima_ocupacion">
					</label>
				</div>
			    <div class="large-4 medium-4 small-6 columns">
					<label>
						Grado de instruccion
						<input type="text" pattern="^[a-zA-Z#º\d\s]+$" name="victima[grado_victima]" id="victima_grado">
					</label>
				</div>
				<div class="large-4 medium-4 small-6 columns">
					<label>
						Edad
						<input type="text" pattern="^[a-zA-Z#º\d\s]+$" name="victima[edad_victima]" id="victima_edad">
					</label>
				</div>
				<div class="large-4 medium-4 small-6 columns">
					<label>
						Lugar de nacimiento
						<input type="text" pattern="^[a-zA-Z#º\d\s]+$" name="victima[lugar_nacimiento_victima]" id="victima_nacimiento">
					</label>
				</div>
				<div class="large-4 medium-4 small-6 columns">
					<label>
						Cantidad de hijos
						<input type="text" pattern="^[a-zA-Z#º\d\s]+$" name="victima[hijos_victima]" id="victima_hijos">
					</label>
				</div>
				<div class="large-4 medium-4 small-6 columns">
					<label>
						Con quien vive
						<input type="text" pattern="^[a-zA-Z#º\d\s]+$" name="victima[vive_victima]" id="victima_vive">
					</label>
				</div>
				<div class="large-4 medium-4 small-6 columns"> 
					<label>
						Estado Civil
						<input type="text" pattern="^[a-zA-Z#º\d\s]+$" name="victima[estado_civil_victima]" id="victima_civil">
					</label>
				</div>
				<div class="large-4 medium-4 small-6 columns">
					<label>
						Números de referencia
						<input type="text" pattern="^[a-zA-Z#º\d\s]+$" name="victima[numero_referencia_victima]" id="victima_referencia">
					</label>
				</div>
				<!--radio button Vivienda-->
				<div class="large-12 medium-12 small-12 columns">
					<label>Vivienda</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label >
						<input type="radio" name="victima[vivienda_victima]" value="ALQUILER" id="victima_alquiler"> Alquiler
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="radio" name="victima[vivienda_victima]" value="ANTICRETICO" id="victima_anticretico"> Anticretico
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="radio" name="victima[vivienda_victima]" value="CASA DE UN FAMILIAR" id="victima_familiar"> Casa de un familiar
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="radio" name="victima[vivienda_victima]" value="OTROS" id="victima_otros"> Otros
					</label>
					<input type="text" id="otros_vivienda" name="victima[vivienda_victima_otro]" placeholder="Escriba aquí..." style="display:none;">
				</div>
				<!--radio button idiomas que hablan-->
				<div class="large-12 medium-12 small-12 columns">
					<label>Idiomas que habla</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="radio" name="victima[idioma_victima]" value="CASTELLANO" id="victima_castellano"> Castellano
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="radio" name="victima[idioma_victima]" value="QUECHUA" id="victima_quechua"> Quechua
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
                    <label>
						<input type="radio" name="victima[idioma_victima]" value="AYMARA" id="victima_aymara"> Aymara
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
                 	<label>
						<input type="radio" name="victima[idioma_victima]" value="OTROS" id="victima_otros_idioma"> Otros
					</label>
					<input type="text" id="otros_idioma" name="victima[idioma_victima_otro]" placeholder="Escriba aquí..." style="display:none">
				</div>
				<div class="large-12 medium-12 small-12 columns">
					<label>Seguro Social</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
                    <label>
						<input type="radio" name="victima[seguro_victima]" value="SUS" id="victima_sus"> SUS
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="radio" name="victima[seguro_victima]" value="CAJA BANCARIA" id="victima_caja"> Caja Bancaria
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="radio" name="victima[seguro_victima]" value="CAJA PETROLERA" id="victima_petrolera"> Caja Petrolera
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="radio" name="victima[seguro_victima]" value="COSSMIL" id="victima_cossmil"> Cossmil
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="radio" name="victima[seguro_victima]" value="OTROS" id="victima_otros_seguro"> Otros
					</label>
					<input type="text" id="otros_seguro_salud" name="victima[seguro_victima_otro]" placeholder="Escriba aquí..." style="display:none">
				</div>
				<div class="large-12 medium-12 small-12 columns">
                    <label>Beneficio que percibe</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
                    <label>
						<input type="radio" name="victima[beneficio_victima]" value="RENTA DIGNIDAD" id="victima_renta"> Renta Dignidad
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
                   <label>
					   <input type="radio" name="victima[beneficio_victima]" value="JUBILACIÓN" id="victima_jubilacion"> Jubilación
				   </label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
                    <label>
						<input type="radio" name="victima[beneficio_victima]" value="RENTISTA" id="victima_rentista"> Rentista
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
                    <label>
						<input type="radio" name="victima[beneficio_victima]" value="OTROS" id="victima_otros_beneficios"> Otros
					</label>
					<input type="text" id="otros_benefecios" name="victima[beneficio_victima_otro]" placeholder="Escriba aquí..." style="display:none">
				</div>
				<script>
					$(document).ready(function() {
						// General function to handle the display of text inputs based on "otros" selection
						function handleOtrosSelection(radioButtonId, inputId) {
							// Show or hide the input field based on whether the "otros" option is selected
							$(radioButtonId).change(function() {
								if ($(this).is(':checked')) {
									$(inputId).show();  // Show the input field
								} else {
									$(inputId).hide();  // Hide the input field
									$(inputId).val('');  // Clear the input field
								}
							});

							// Hide the input field if any other radio button is selected
							$('input[name="' + $(radioButtonId).attr('name') + '"]:not(' + radioButtonId + ')').change(function() {
								$(inputId).hide();  // Hide the input field
								$(inputId).val('');  // Clear the input field
							});
						}

						// Apply the function for each "otros" option and its corresponding input
						handleOtrosSelection('#victima_otros', '#otros_vivienda');
						handleOtrosSelection('#victima_otros_idioma', '#otros_idioma');
						handleOtrosSelection('#victima_otros_seguro', '#otros_seguro_salud');
						handleOtrosSelection('#victima_otros_beneficios', '#otros_benefecios');
					});
				</script>

				<!--fin cambios-->
				<div class="large-12 medium-12 small-12 columns">
          <h4 class="center"><?php echo lang('editar.denunciado') ?></h4>
        </div>

        <div class="large-2 medium-3 small-6 columns">
          <label>
  					<?php echo lang('dni') ?>

  					 <input type="text"  pattern="[0-9]+[-a-zA-Z]{0,4}" name="denunciado[dni]" id="denunciado_dni">
  					 <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
  				</label>
  			</div>
				<div class="large-3 medium-5 small-6 columns">
  				<label>
  					<?php echo lang('nombre.completo') ?>
  					 <input type="text" pattern="[a-zA-ZñÑ\s]+" name="denunciado[nombre_completo]" id="denunciado_nombre_completo">
  					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
  				</label>
  			</div>

			    <div class="large-3 medium-5 small-6 columns">
					<label>
						Edad
						<input type="text" pattern="[0-9]+[-a-zA-Z]{0,4}" name="denunciado[edad]" id="denunciado_edad">
					</label>
				</div>

				<div class="large-3 medium-5 small-6 columns">
					<label>
						Domicilio
						<input type="text" pattern="[a-zA-ZñÑ\s]+" name="denunciado[domicilio]" id="denunciado_domicilio">
					</label>
				</div>
				
				<div class="large-3 medium-5 small-6 columns">
                    <label>
						Celular/teléfono
						<input type="text" pattern="[0-9]+[-a-zA-Z]{0,4}" name="denunciado[celular]" id="denunciado_celular">
					</label>
				</div>
				
				<div class="large-2 medium-4 small-6 columns">
					<label>
						<?php echo lang('expedido') ?>
						<?php echo form_dropdown(array('name'=>'denunciado[expedido_denunciado]','required'=>'required','id'=>'denunciado_editar_expedido'), $expedidos) ?>
						<span class="form-error"><?php echo lang('requerido') ?></span>
					</label>
				</div>
				<div class="large-2 medium-1 small-6 columns">
					<label>
						<?php echo lang('genero') ?>
						<?php echo form_dropdown(array('name'=>'denunciado[genero]','id'=>'denunciado_editar_genero'), $sexos) ?>

						<span class="form-error"><?php echo lang('requerido') ?></span>
					</label>
				</div>
				<div class="large-3 medium-4 small-4 columns">
					<label>
						<?php echo lang('parentesco') ?>
						<?php echo form_dropdown(array('name'=>'denuncia[id_parentesco]','required'=>'required','id'=>'denuncia_id_parentesco'), $parentescos) ?>
						<span class="form-error"><?php echo lang('requerido') ?></span>
					</label>
				</div>
				<div class="large-6 medium-6 small-6 columns">
					<label>
						<?php echo lang('datos.complementarios') ?> (*opcional)
						<textarea type="text" name="denuncia[datos_complementarios]" id="denuncia_datos_complementarios" maxlength="400"></textarea>

					</label>
				</div>
				<div class="large-6 medium-6 small-6 columns">
					<label>
						<?php echo lang('descripcion.denuncia') ?> (*opcional)
						<textarea type="text" name="denuncia[descripcion]" id="denuncia_descripcion" maxlength="400"></textarea>

					</label>
				</div>
				<div class="large-12 medium-12 small-12 columns">
					<label><?php echo lang('denuncia.derivada') ?></label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label >
						<input type="checkbox" name="denuncia_d[]" value="AREA PSICOLOGICA" id="den_psic"> <?php echo lang('area.psicologica') ?>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label>
						<input type="checkbox" name="denuncia_d[]" value="AREA SOCIAL" id="den_soci"><?php echo lang('area.social') ?>
					</label>
				</div>
				<div class="large-2 medium-2 small-2 columns">
					<label >
						<input type="checkbox" name="denuncia_d[]" value="NINGUNO" id="den_nin"><?php echo lang('ninguno') ?>
					</label>
				</div>

				<div class="large-12 columns center">
					<button type="submit" name="edit_user" class="button palette-Brown-500 bg">
							<i class="fontello-ok"></i><?php echo lang('actualizar') ?>
					</button>
				</div>

				<input type="hidden" name="id_denuncia" value="" id="denuncia_id_denuncia" />
        <input type="hidden" name="id_victima" value="" id="denuncia_id_victima" />
        <input type="hidden" name="id_denunciante" value="" id="denuncia_id_denunciante" />
				<input type="hidden" name="id_denunciado" value="" id="denunciado_id_denunciado" />

				<input type="hidden" name="denuncia_id_centro" value="" id="denuncia_id_centro" />



		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Editar denuncia -->

<!-- Modal Editar informe tecnico legal de denuncia  -->

<div class="reveal" id="informelegal" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('denuncias/editarinforme') ?>">
    	<h3 class="center"><?php echo lang('informe.denuncia.legal') ?></h3>
			<div class="row">
				<div class="large-12 medium-12 small-12 columns">
					<label>Acciones Inmediatas</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label>
						<input type="radio" name="informe[legal_acciones]" id="legal_asesoramieno" value="ASESORAMIENTO"> Asesoramiento
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label>
						<input type="radio" name="informe[legal_acciones]" id="legal_orientacion" value="ORIENTACIÓN"> Orientación
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label>
						<input type="radio" name="informe[legal_acciones]" id="legal_acompanamiento" value="ACOMPAÑAMIENTO"> Acompañamiento
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label>
						<input type="radio" name="informe[legal_acciones]" id="legal_citacion" value="CITACIÓN/NOTIFICACIÓN"> Citación/notificación
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label>
						<input type="radio" name="informe[legal_acciones]" id="legal_suscripcion" value="SUSCRIPCIÓN DE ACTAS"> Suscripción de actas
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label>
						<input type="radio" name="informe[legal_acciones]" id="legal_otro" value="OTRO" > Otro
					</label>
					<input type="text" id="otros_area_legal" name="informe[informe_legal_otro]" placeholder="Escriba aquí..." style="display:none;">
				</div>
				<script>
					$(document).ready(function() {
						function handleOtrosSelection(radioButtonId, inputId) {
							$(radioButtonId).change(function() {
								if ($(this).is(':checked')) {
									$(inputId).show();  
								} else {
									$(inputId).hide();  
									$(inputId).val(''); 
								}
							});
							$('input[name="' + $(radioButtonId).attr('name') + '"]:not(' + radioButtonId + ')').change(function() {
								$(inputId).hide();  
								$(inputId).val(''); 
							});
						}
						handleOtrosSelection('#legal_otro', '#otros_area_legal');
					});
				</script>
				<div class="large-6 medium-6 small-6 columns">
					<label>
						<?php echo lang('remitido') ?>
						<?php echo form_dropdown(array('name'=>'informe[instancias_jurisdicionales]','id'=>'informe_instancias'), $instancias)?>

					</label>
				</div>
				<div class="large-6 medium-6 small-6 columns">
					<label>
						<?php echo lang('especifique') ?>
						 <input type="text" required  name="informe[especifique]" id="informe_especifique">
						 <span class="form-error"><?php echo lang('alfabetico') ?></span>
					</label>
				</div>
				<div class="large-12 medium-12 small-12 columns">
					<label>
						Documentos Suscritos
						<textarea type="text" name="informe[documento_suscrito]" id="documento_suscrito" rows="4"></textarea>
					</label>
				</div>
				<div class="large-12 medium-12 small-12 columns">
					<label>
						Situación legal de caso
						<textarea type="text" name="informe[situacion_legal]" id="situacion_legal" rows="4"></textarea>
					</label>
				</div>
				<div class="large-12 medium-12 small-12 columns">
					<label>
						Ultima acción realizada
						<textarea type="text" name="informe[accion_realizada]" id="accion_realizada" rows="4"></textarea>
					</label>
				</div>
				<div class="large-12 medium-12 small-12 columns">
					<label>
						<?php echo lang('tipo.actas') ?>
						<textarea type="text" pattern="[a-zA-ZñÑ\s]+" name="informe[tipo_actas]" id="tipo_actas" rows="4"> </textarea>
						<span class="form-error"><?php echo lang('alfabetico') ?></span>
					</label>
				</div>
				<div class="large-12 medium-12 small-12 columns">
					<label>
						<?php echo lang('derivacion') ?>
						<textarea type="text"  pattern="[a-zA-ZñÑ\s]+" name="informe[derivacion]" id="derivacion" rows="4"> </textarea>
						<span class="form-error"><?php echo lang('alfabetico') ?></span>
					</label>
				</div>
				<div class="large-12 medium-12 small-12 columns">
					<label>
						<?php echo lang('situacion') ?>
						<textarea type="text"  pattern="[a-zA-ZñÑ\s]+" name="informe[situacion]" id="situacion" rows="4"> </textarea>
						<span class="form-error"><?php echo lang('alfanumerico') ?></span>
					</label>
				</div>
				<div class="large-8 medium-8 small-8 columns">
					<label>
						<?php echo lang('fecha.seguimiento') ?>
						<input type="text" name="informe[fecha]" id="informe_fecha" class="datepicker">
						<span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
					</label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label>
						<?php echo lang('numero.fojas') ?>
						 <input type="text" required  name="informe[numero_foja]" id="informe_foja">
						 <span class="form-error"><?php echo lang('numerico') ?></span>
					</label>
				</div>
				<div class="large-12 columns center">
					<button type="submit" name="edit_informe" class="button palette-Brown-500 bg">
						<i class="fontello-ok"></i><?php echo lang('actualizar') ?>
					</button>
				</div>
				<input type="hidden" name="id_denuncia" value="" id="informe_id_denuncia" />
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Editar informe tecnico legal de denuncia -->

<!-- Modal Editar informe tecnico psicologico de denuncia  -->

<div class="reveal" id="informepsicologico" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('denuncias/editarpsicologico') ?>">
    	<h3 class="center"><?php echo lang('informe.denuncia.psicologico') ?></h3>
			<div class="row">
				<div class="large-12 medium-12 small-12 columns">
  				<label>
  					<?php echo lang('descripcion.psicologica') ?>
  					 <textarea type="text" required pattern="[a-zA-ZñÑ\s]+" name="informepsicologico[valoracion]" id="valoracion" rows="4"> </textarea>
  					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
  				</label>
  			</div>
				<div class="large-12 medium-12 small-12 columns">
					<label><?php echo lang('intervencion.psicologica') ?></label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label >
						<input type="checkbox" name="psicologico_visita[]" value="NOTA INFORME" id="psic_nota"> <?php echo lang('nota.informe') ?>
					</label>
				</div>

				<div class="large-5 medium-5 small-5 columns">
					<label >
						<input type="checkbox" name="psicologico_visita[]" value="INFORME DE SEGUIMIENTO PSICOLÓGICO" id="psic_seg"><?php echo lang('informe.seguimiento') ?>
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label >
						<input type="checkbox" name="psicologico_visita[]" value="INFORME PSICOLÓGICO" id="psic_psic"><?php echo lang('informe.psicologico') ?>
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label>
						<input type="checkbox" name="psicologico_visita[]" value="INFORME DE CONTENCIÓN" id="psic_cont"><?php echo lang('informe.contencion') ?>
					</label>
				</div>
				
				<div class="large-4 medium-4 small-4 columns">
					<label>
						<input type="checkbox" name="psicologico_visita[]" value="VISITA DOMICILIARIA" id="psic_vista"> <?php echo lang('informe.visita') ?>
					</label>
				</div>
				
				<div class="large-4 medium-4 small-4 columns">
                    <label>
						<input type="checkbox" name="psicologico_visita[]" value="INFORME PSICOSOCIAL" id="psic_psicosocial"><?php echo lang('informe.psicosocial') ?>
					</label>  
				</div>

				<div class="large-6 medium-6 small-6 columns">
					<label>
						<input type="checkbox" name="psicologico_visita[]" value="INFORME PSICOLÓGICO PRELIMINAR" id="psic_preliminar"><?php echo lang('informe.preliminar') ?>
					</label>
				</div>
				
				<div class="large-12 medium-12 small-12 columns">
  				<label>
  					<?php echo lang('coordinacion') ?>
  					 <textarea type="text"  name="informepsicologico[coordinacion_interinstitucional]" id="coordinacion_interinstitucional" rows="4"> </textarea>
  					 <span class="form-error"><?php echo lang('alfanumerico') ?></span>
  				</label>
  			</div>



				<div class="large-12 medium-12 small-12 columns">
					<label><?php echo lang('terapia') ?></label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label >
						<input type="checkbox" name="psicologico_grupo_terapia[]" value="TERAPIA INDIVIDUAL" id="psic_ind"> <?php echo lang('terapia.individual') ?>
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label>
						<input type="checkbox" name="psicologico_grupo_terapia[]" value="TERAPIA FAMILIAR" id="psic_fam"><?php echo lang('terapia.familiar') ?>
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label >
						<input type="checkbox" name="psicologico_grupo_terapia[]" value="TERAPIA DE PAREJA" id="psic_par"><?php echo lang('terapia.pareja') ?>
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label >
						<input type="checkbox" name="psicologico_grupo_terapia[]" value="TERAPIA OCUPACIONAL" id="psic_ocup"><?php echo lang('terapia.ocupacional') ?>
					</label>
				</div>
				<div class="large-4 medium-4 small-4 columns">
					<label >
						<input type="checkbox" name="psicologico_grupo_terapia[]" value="NINGUNO" id="psic_nin"><?php echo lang('ninguno') ?>
					</label>
				</div>
				<div class="large-12 medium-12 small-12 columns">
  				<label>
  					<?php echo lang('situacion.social') ?>
  					 <textarea type="text" required name="informepsicologico[situacion]" id="situaciones" rows="4"> </textarea>
  					 <span class="form-error"><?php echo lang('alfanumerico') ?></span>
  				</label>
  			</div>

        <div class="large-8 medium-8 small-8 columns">
  				<label>
  					<?php echo lang('fecha.seguimiento') ?>
  					 <input type="text" name="informepsicologico[fecha]" id="informepsicologico_fecha" class="datepicker">
  					 <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
  				</label>
  			</div>
				<div class="large-3 medium-3 small-3 columns">
					<label>
						<?php echo lang('numero.fojas') ?>
						 <input type="text" required  name="informepsicologico[numero_foja]" id="informepsicologico_foja">
						 <span class="form-error"><?php echo lang('numerico') ?></span>
					</label>
				</div>


				<div class="large-12 columns center">
					<button type="submit" name="edit_informepsicologico" class="button palette-Brown-500 bg">
							<i class="fontello-ok"></i><?php echo lang('actualizar') ?>
					</button>
				</div>


				<input type="hidden" name="id_denuncia" value="" id="informepsicologico_id_denuncia" />


		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Editar informe tecnico psicologico de denuncia -->

<!-- Modal Editar informe tecnico social de denuncia  -->

<div class="reveal" id="informesocial" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('denuncias/editarsocial') ?>">
    	<h3 class="center"><?php echo lang('informe.denuncia.social') ?></h3>
			<div class="row">
				<div class="large-12 medium-12 small-12 columns">
  				<label>
  					<?php echo lang('descripcion.social') ?>
  					 <textarea type="text" pattern="[a-zA-ZñÑ\s]+" name="informesocial[descripcion]" id="descripcion" rows="4"> </textarea>
  					 <span class="form-error"><?php echo lang('alfabetico') ?></span>
  				</label>
  			</div>


				<div class="large-12 medium-12 small-12 columns">
					<label><?php echo lang('intervencion.social') ?></label>
				</div>
				<div class="large-3 medium-3 small-3 columns">
					<label >
						<input type="checkbox" name="social_visita[]" value="NOTA INFORME" id="soc_nota"> <?php echo lang('nota.informe') ?>
					</label>
				</div>


				<div class="large-4 medium-4 small-4 columns">
			        <label>
						<input type="checkbox" name="social_visita[]" value="VISITA DOMICILIARIA" id="soc_dom"> <?php echo lang('informe.seg.domiciliaria') ?>
					</label>
				</div>

				<div class="large-4 medium-4 small-4 columns">
					<label>
						<input type="checkbox" name="social_visita[]" value="INFORME PSICOSOCIAL" id="soc_psico"> <?php echo lang('informe.seg.psicosocial') ?>
					</label>
				</div>

				<div class="large-5 medium-5 small-5 columns">
                    <label>
						<input type="checkbox" name="social_visita[]" value="INFORME SOCIOECONÓMICO" id="soc_socio"> <?php echo lang('informe.seg.socioeconomico') ?>
					</label>
				</div>
				
				
				<div class="large-5 medium-5 small-5 columns">
					<label>
						<input type="checkbox" name="social_visita[]" value="INFORME SOCIAL" id="soc_inf"><?php echo lang('informe.social') ?>
					</label>
				</div>
				

				<div class="large-12 medium-12 small-12 columns">
  				<label>
  					<?php echo lang('coordinacion') ?>
  					 <textarea type="text"  name="informesocial[coordinacion_interinstitucional]" id="coordinacion" rows="4"> </textarea>
  					 <span class="form-error"><?php echo lang('alfanumerico') ?></span>
  				</label>
  			</div>
				<div class="large-12 medium-12 small-12 columns">
  				<label>
  					<?php echo lang('acogida') ?>
  					 <textarea type="text"  name="informesocial[acogida]" id="acogida" rows="4"> </textarea>
  					 <span class="form-error"><?php echo lang('alfanumerico') ?></span>
  				</label>
  			</div>
				<div class="large-12 medium-12 small-12 columns">
  				<label>
  					<?php echo lang('situacion.social') ?>
  					 <textarea type="text" required name="informesocial[situacion]" id="situaciones" rows="4"> </textarea>
  					 <span class="form-error"><?php echo lang('alfanumerico') ?></span>
  				</label>
  			</div>

        <div class="large-8 medium-8 small-8 columns">
  				<label>
  					<?php echo lang('fecha.seguimiento') ?>
  					 <input type="text" name="informesocial[fecha]" id="informesocial_fecha" class="datepicker">
  					 <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
  				</label>
  			</div>
				<div class="large-3 medium-3 small-3 columns">
					<label>
						<?php echo lang('numero.fojas') ?>
						 <input type="text" required  name="informesocial[numero_foja]" id="informesocial_foja">
						 <span class="form-error"><?php echo lang('numerico') ?></span>
					</label>
				</div>

				<div class="large-12 columns center">
					<button type="submit" name="edit_informesocial" class="button palette-Brown-500 bg">
							<i class="fontello-ok"></i><?php echo lang('actualizar') ?>
					</button>
				</div>


				<input type="hidden" name="id_denuncia" value="" id="informesocial_id_denuncia" />


		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Editar informe tecnico social de denuncia -->

<!-- Modal archivar Denuncia  -->

<div class="reveal" id="archivosdenuncia" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('denuncias/archivardenuncia') ?>">
    	<h3 class="center"><?php echo lang('confirmacion.archivar') ?></h3>
		<div class="row">
			<input type="hidden" name="id_denuncia" value="" id="id_denuncia" />
			<div class="large-12 columns center">
				<button type="submit" name="editdenuncia"  class="button palette-Brown-500 bg">
						<i class="fontello-ok"></i><?php echo lang('archivar.denuncia') ?>
				</button>
			</div>

		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin  denuncia archivada-->

<!-- Modal Cerrar Denuncia  -->

<div class="reveal" id="cerrardenuncia" data-reveal="">
	<form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url('denuncias/cierredenuncia') ?>">
    	<h3 class="center"><?php echo lang('confirmacion.cerrar') ?></h3>
		<div class="row">
			<input type="hidden" name="id_denuncia" value="" id="cerrar_id_denuncia" />
			<div class="large-12 columns center">
				<button type="submit" name="cierre"  class="button palette-Brown-500 bg">
						<i class="fontello-ok"></i><?php echo lang('cerrar.denuncia') ?>
				</button>
			</div>
		</div>
		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin  denuncia cerrada-->



<!-- Modal Editar Usuario  -->

<div class="reveal" id="asignarfuncion" data-reveal="">

 	<h3 class="center"><?php echo lang('asignar.funcion') ?></h3>

	<div class="row">
			<div class="large-12 columns" id="contenido">

			</div>
	</div>


	<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
</div>

<!-- Fin Agregar Usuario -->

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#denunciante_dni').change(function(){
	var denunciante_dni = $(this).val();
	var dataString = 'denunciante_dni='+denunciante_dni;

	$.ajax({
		type: "POST",
		url: "<?php echo site_url('denuncias/buscar_persona'); ?>",
		dataType: "json",
		data: dataString,
		success: function(response) {

					$('#denunciante_nombre').val(response.data.nombre_completo);
					$('#denunciante_telefono').val(response.data.telefono);
				  $('#denunciante_direccion').val(response.data.direccion);
					$('#fecha_nacimiento').val(response.data.fecha_nacimiento);
					$('#denunciante_expedido').val(response.data.expedido_denunciante);
					$('#denunciante_genero').val(response.data.genero);
					$('#denunciante_id').val(response.data.id_denunciante);

		 },
			error: function(response) {
				console.log(response);
			}
		});
});

$('#victima_editar_dni').change(function(){

	var victima_editar_dni = $(this).val();
	var dataString = 'denunciante_dni='+victima_editar_dni;

	$.ajax({
		type: "POST",
		url: "<?php echo site_url('denuncias/buscar_persona'); ?>",
		dataType: "json",
		data: dataString,
		success: function(response) {

					$('#denuncia_victima').val(response.data.nombre_completo);
				  $('#victima_editar_domicilio').val(response.data.direccion);
					$('#victima_fecha_nacimiento').val(response.data.fecha_nacimiento);
					$('#victima_editar_expedido').val(response.data.expedido_denunciante);
					$('#victima_sexo').val(response.data.genero);
					//$('#denuncia_id_victima').val(response.data.id_denunciante);


		 },
			error: function(response) {
				console.log(response);
			}
		});
});

$('#denunciado_dni').change(function(){

	var denunciado_dni = $(this).val();
	var dataString = 'denunciante_dni='+denunciado_dni;

	$.ajax({
		type: "POST",
		url: "<?php echo site_url('denuncias/buscar_persona'); ?>",
		dataType: "json",
		data: dataString,
		success: function(response) {
			
			$('#denunciado_nombre_completo').val(response.data.nombre_completo);
			$('#denunciado_editar_expedido').val(response.data.expedido_denunciante);
			$('#denunciado_editar_genero').val(response.data.genero);
			//$('#denuncia_id_denunciado').val(response.data.id_denunciante);

		 },
			error: function(response) {
				console.log(response);
			}
		});
});


	$('.editar').click(function() {
		var id = $(this).attr('content');
		$.getJSON('<?php echo site_url('servicio/getDenuncia');?>', { id: id })
		.done(function(data) {
			$("#denuncia_denunciante").val(data.denunciante);
			$("#denun_otb").val(data.otb_denuncia);
			$("#denun_subalcaldia").val(data.sa_denuncia);
			$("#denun_distrito").val(data.dis_denuncia);
			$("#denuncia_codigo").val(data.codigo_denuncia);
			$("#denuncia_id_categoria").val(data.id_categoria);
			$("#denuncia_id_categoria_secundaria").val(data.id_categoria_secundaria);
			$("#denuncia_id_centro").val(data.id_centro);
			$("#denuncia_denuncia").val(data.denuncia);
			$("#denuncia_descripcion").val(data.descripcion);
			$("#denuncia_id_parentesco").val(data.id_parentesco);
			$("#denuncia_datos_complementarios").val(data.datos_complementarios);
			$("#denunciante_editar_dni_denunciante").val(data.dni_denunciante);
			$("#denunciante_editar_expedido").val(data.expedido_denunciante);
			$("#denunciante_editar_direccion").val(data.direccion);
			$("#denunciante_editar_telefono").val(data.telefono);
			$("#denunciante_editar_genero").val(data.genero_denunciante);
			$("#denuncia_victima").val(data.victima);
			$("#victima_editar_dni").val(data.dni);
			$("#victima_editar_expedido").val(data.expedido);
			$("#victima_editar_domicilio").val(data.domicilio);
			$("#victima_ocupacion").val(data.ocupacion_victima);
			$("#victima_grado").val(data.grado_victima);
			$("#victima_edad").val(data.edad_victima);
			$("#victima_nacimiento").val(data.lugar_nacimiento_victima);
			$("#victima_hijos").val(data.hijos_victima);
			$("#victima_vive").val(data.vive_victima);
			$("#victima_civil").val(data.estado_civil_victima);
			$("#victima_referencia").val(data.numero_referencia_victima);
			$("#victima_sexo").val(data.sexo);
			$("#victima_fecha_nacimiento").val(data.fecha_nacimiento);
			$("#denunciado_nombre_completo").val(data.nombre_denunciado);
			$("#denunciado_dni").val(data.denunciado_dni);
			$("#denunciado_editar_expedido").val(data.expedido_denunciado);
			$("#denunciado_editar_genero").val(data.genero_denunciado);
			$("#denunciado_edad").val(data.edad_denunciado);
			$("#denunciado_domicilio").val(data.domicilio_denunciado);
			$("#denunciado_celular").val(data.celular_denunciado);
			$("#denuncia_id_denuncia").val(data.id_denuncia);
			$("#denuncia_id_denunciante").val(data.id_denunciante);
			$("#denuncia_id_victima").val(data.id_victima);
			$("#denunciado_id_denunciado").val(data.id_denunciado);
			$("#otros_vivienda").val(data.vivienda_victima_otro);
			$("#otros_idioma").val(data.idioma_victima_otro);
			$("#otros_seguro_salud").val(data.seguro_victima_otro);
			$("#otros_benefecios").val(data.beneficio_victima_otro	);
			var denuncia_procedencia = data.procedencia;
			switch (denuncia_procedencia)
			{
				case 'FAMILIAR':$("#den_fam").prop("checked", true);break;
				case 'ADULTO MAYOR':$("#den_am").prop("checked", true);break;
				case 'INSTITUCIONES':$("#den_ins").prop("checked", true);break;
				case 'PERSONA AJENA':$("#den_pa").prop("checked", true);break;
				case null:  // Only handle the null case once
					$("#den_fam, #den_am, #den_ins, #den_pa").prop("checked", false);
					break;
				default:
				// Optionally handle any other cases that might need to be set to unchecked
				break;
				/*case 'FAMILIAR':  $("#den_fam").prop( "checked", true );  break;
				case 'ADULTO MAYOR':  $("#den_am").prop( "checked", true ); break;
				case 'INSTITUCIONES': $("#den_ins").prop( "checked", true ); break;
				case 'PERSONA AJENA': $("#den_pa").prop( "checked", true );  break;
				case NULL : $("#den_fam").attr("checked", false); break;
				case NULL : $("#den_am").attr("checked", false); break;
				case NULL : $("#den_ins").attr("checked", false); break;
				case NULL: $("#den_pa").attr("checked", false); break;*/
			}
			var victima_vivienda = data.vivienda_victima;
			switch (victima_vivienda)
			{
				case 'ALQUILER':$("#victima_alquiler").prop("checked", true);$("#otros_vivienda").hide(); break;
				case 'ANTICRETICO':$("#victima_anticretico").prop("checked", true);$("#otros_vivienda").hide(); break;
				case 'CASA DE UN FAMILIAR':$("#victima_familiar").prop("checked", true);$("#otros_vivienda").hide();break;
				case 'OTROS':$("#victima_otros").prop("checked", true);$("#otros_vivienda").show();break;
				case null:  // Only handle the null case once
					$("#victima_alquiler,#victima_anticretico,#victima_familiar,#victima_otros").prop("checked", false);
					$("#otros_vivienda").hide();
					break;
				default:
				// Optionally handle any other cases that might need to be set to unchecked
				break;
			}
			var victima_idioma = data.idioma_victima;
			switch (victima_idioma)
			{
				case 'CASTELLANO':$("#victima_castellano").prop("checked", true);$("#otros_idioma").hide();break;
				case 'QUECHUA':$("#victima_quechua").prop("checked", true);$("#otros_idioma").hide();break;
				case 'AYMARA':$("#victima_aymara").prop("checked", true);$("#otros_idioma").hide();break;
				case 'OTROS':$("#victima_otros_idioma").prop("checked", true);$("#otros_idioma").show();break;
				case null:  // Only handle the null case once
					$("#victima_castellano,#victima_quechua,#victima_aymara,#victima_otros_idioma").prop("checked", false);
					$("#otros_idioma").hide();
					break;
				default:
				// Optionally handle any other cases that might need to be set to unchecked
				break;
			}
			var victima_seguro = data.seguro_victima;
			switch (victima_seguro)
			{
				case 'SUS':$("#victima_sus").prop("checked", true);$("#otros_seguro_salud").hide();break;
				case 'CAJA BANCARIA':$("#victima_caja").prop("checked", true);$("#otros_seguro_salud").hide();break;
				case 'CAJA PETROLERA':$("#victima_petrolera").prop("checked", true);$("#otros_seguro_salud").hide();break;
				case 'COSSMIL':$("#victima_cossmil").prop("checked", true);$("#otros_seguro_salud").hide();break;
				case 'OTROS':$("#victima_otros_seguro").prop("checked", true);$("#otros_seguro_salud").show();break;
				case null:  // Only handle the null case once
					$("#victima_sus,#victima_caja,#victima_petrolera,#victima_cossmil,#victima_otros_seguro").prop("checked", false);
					$("#otros_seguro_salud").hide();
					break;
				default:
				// Optionally handle any other cases that might need to be set to unchecked
				break;
			}
			var victima_beneficio = data.beneficio_victima;
			switch (victima_beneficio)
			{
				case 'RENTA DIGNIDAD':$("#victima_renta").prop("checked", true);$("#otros_benefecios").hide();break;
				case 'JUBILACIÓN':$("#victima_jubilacion").prop("checked", true);$("#otros_benefecios").hide();break;
				case 'RENTISTA':$("#victima_rentista").prop("checked", true);$("#otros_benefecios").hide();break;
				case 'OTROS':$("#victima_otros_beneficios").prop("checked", true);$("#otros_benefecios").show();break;
				case null:  // Only handle the null case once
					$("#victima_renta,#victima_jubilacion,#victima_rentista,#victima_otros_beneficios").prop("checked", false);
					$("#otros_benefecios").hide();
					break;
				default:
				// Optionally handle any other cases that might need to be set to unchecked
				break;
			}
			var denuncia_derivacion = data.derivacion;
			switch (denuncia_derivacion)
			{
				case 'AREA PSICOLOGICA':  $("#den_psic").prop( "checked", true );  break;
				case 'AREA SOCIAL':  $("#den_soci").prop( "checked", true ); break;
				case 'NINGUNO': $("#den_nin").prop( "checked", true ); break;
				case 'AREA PSICOLOGICA, AREA SOCIAL':  $("#den_psic,#den_soci").prop( "checked", true );  break;
			}
		});
	});

	$('.editarinforme').click(function() {
		var id = $(this).attr('content');
		$.getJSON('<?php echo site_url('servicio/getInforme');?>', { id: id })
		.done(function(data) {
			$("#informe_instancias").val(data.instancias_jurisdicionales);
			$("#informe_especifique").val(data.especifique);
			$("#tipo_actas").val(data.tipo_actas);
			$("#derivacion").val(data.derivacion);
			$("#situacion").val(data.situacion);
			$("#informe_fecha").val(data.fecha);
			$("#informe_foja").val(data.numero_foja);
			$("#informe_id_denuncia").val(data.id_denuncia);
			$("#otros_area_legal").val(data.informe_legal_otro);
			$("#documento_suscrito").val(data.documento_suscrito);
			$("#situacion_legal").val(data.situacion_legal);
			$("#accion_realizada").val(data.accion_realizada);
			var area_legal_radio = data.legal_acciones;
			switch (area_legal_radio)
			{
				case 'ASESORAMIENTO':$("#legal_asesoramieno").prop("checked", true);$("#otros_area_legal").hide();break;
				case 'ORIENTACIÓN':$("#legal_orientacion").prop("checked", true);$("#otros_area_legal").hide();break;
				case 'ACOMPAÑAMIENTO':$("#legal_acompanamiento").prop("checked", true);$("#otros_area_legal").hide();break;
				case 'CITACIÓN/NOTIFICACIÓN':$("#legal_citacion").prop("checked", true);$("#otros_area_legal").hide();break;
				case 'SUSCRIPCIÓN DE ACTAS':$("#legal_suscripcion").prop("checked", true);$("#otros_area_legal").hide();break;
				case 'OTRO':$("#legal_otro").prop("checked", true);$("#otros_area_legal").show();break;
				case null:  
					$("#legal_asesoramieno,#legal_orientacion,#legal_acompanamiento,#legal_citacion,#legal_suscripcion,#legal_otro").prop("checked", false);
					$("#otros_area_legal").hide();
					break;
				default:
				break;
			}
		});
	});

$('.editarpsicologico').click(function() {

	var id = $(this).attr('content');

		$.getJSON('<?php echo site_url('servicio/getPsicologico');?>', { id: id })

		.done(function(data) {
			$("#valoracion").val(data.valoracion);
			$("#visita").val(data.visita);
			$("#coordinacion_interinstitucional").val(data.coordinacion_interinstitucional);
			$("#grupo_terapia").val(data.grupo_terapia);
			$("#situaciones").val(data.situacion);
			$("#informepsicologico_fecha").val(data.fecha);
			$("#informepsicologico_foja").val(data.numero_foja);


			$("#informepsicologico_id_denuncia").val(data.id_denuncia);


			var informepsicologico_visita = data.visita;

			   
			/*switch (informepsicologico_visita)
			{

			 case 'NOTA INFORME':  $("#psic_nota").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO':  $("#psic_seg").prop( "checked", true );  break;
			 case 'INFORME PSICOLÓGICO':  $("#psic_psic").prop( "checked", true ); break;
			 case 'INFORME DE CONTENCIÓN': $("#psic_cont").prop( "checked", true ); break;
			 case 'ABORDAJE PSICOLÓGICO': $("#psic_abo").prop( "checked", true ); break;
			 case 'ABORDAJE PSICOSOCIAL': $("#psic_soc").prop( "checked", true ); break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO':  $("#psic_nota,#psic_seg").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME PSICOLÓGICO':  $("#psic_nota,#psic_psic").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE CONTENCIÓN':  $("#psic_nota,#psic_cont").prop( "checked", true );  break;
			 case 'NOTA INFORME, ABORDAJE PSICOLÓGICO':  $("#psic_nota,#psic_abo").prop( "checked", true );  break;
			 case 'NOTA INFORME, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_soc").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO':  $("#psic_seg,#psic_psic").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME DE CONTENCIÓN':  $("#psic_seg,#psic_cont").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, ABORDAJE PSICOLÓGICO':  $("#psic_seg,#psic_abo").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_seg,#psic_soc").prop( "checked", true );  break;
			 case 'INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN':  $("#psic_psic,#psic_cont").prop( "checked", true );  break;
			 case 'INFORME PSICOLÓGICO, ABORDAJE PSICOLÓGICO':  $("#psic_psic,#psic_abo").prop( "checked", true );  break;
			 case 'INFORME PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_psic,#psic_soc").prop( "checked", true );  break;
			 case 'INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO':  $("#psic_cont,#psic_abo").prop( "checked", true );  break;
			 case 'INFORME DE CONTENCIÓN, ABORDAJE PSICOSOCIAL':  $("#psic_cont,#psic_soc").prop( "checked", true );  break;
			 case 'ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_abo,#psic_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO':  $("#psic_nota,#psic_seg,#psic_psic").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME DE CONTENCIÓN':  $("#psic_nota,#psic_seg,#psic_cont").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, ABORDAJE PSICOLÓGICO':  $("#psic_nota,#psic_seg,#psic_abo").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_seg,#psic_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN':  $("#psic_nota,#psic_psic,#psic_cont").prop( "checked", true ); break;
			 case 'NOTA INFORME, INFORME PSICOLÓGICO, ABORDAJE PSICOLÓGICO':  $("#psic_nota,#psic_psic,#psic_abo").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_psic,#psic_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO':  $("#psic_nota,#psic_cont,#psic_abo").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE CONTENCIÓN, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_cont,#psic_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_abo,#psic_soc").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN':  $("#psic_seg,#psic_psic,#psic_cont").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO, ABORDAJE PSICOLÓGICO':  $("#psic_seg,#psic_psic,#psic_abo").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_seg,#psic_psic,#psic_soc").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO':  $("#psic_seg,#psic_cont,#psic_abo").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOSOCIAL':  $("#psic_seg,#psic_cont,#psic_soc").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_seg,#psic_abo,#psic_soc").prop( "checked", true );  break;
			 case 'INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO':  $("#psic_psic,#psic_cont,#psic_abo").prop( "checked", true );  break;
			 case 'INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOSOCIAL':  $("#psic_psic,#psic_cont,#psic_soc").prop( "checked", true );  break;
			 case 'INFORME PSICOLÓGICO, ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_psic,#psic_abo,#psic_soc").prop( "checked", true );  break;

			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN':  $("#psic_nota,#psic_seg,#psic_psic,#psic_cont").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO, ABORDAJE PSICOLÓGICO':  $("#psic_nota,#psic_seg,#psic_psic,#psic_abo").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_seg,#psic_psic,#psic_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO':  $("#psic_nota,#psic_seg,#psic_cont,#psic_abo").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_seg,#psic_cont,#psic_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_seg,#psic_abo,#psic_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME PSICOLÓGICO, ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_psic,#psic_abo,#psic_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO':  $("#psic_nota,#psic_psic,#psic_cont,#psic_abo").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_psic,#psic_cont,#psic_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_cont,#psic_abo,#psic_soc").prop("checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO':  $("#psic_seg,#psic_psic,#psic_cont,#psic_abo").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOSOCIAL':  $("#psic_seg,#psic_psic,#psic_cont,#psic_soc").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO, ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_seg,#psic_psic,#psic_abo,#psic_soc").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_seg,#psic_cont,#psic_abo,#psic_soc").prop( "checked", true );  break;
			 case 'INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_psic,#psic_cont,#psic_abo,#psic_soc").prop( "checked", true );  break;

			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO':  $("#psic_nota,#psic_seg,#psic_psic,#psic_cont,#psic_abo").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_seg,#psic_psic,#psic_cont,#psic_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO, ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_seg,#psic_psic,#psic_abo,#psic_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_seg,#psic_cont,#psic_abo,#psic_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_psic,#psic_cont,#psic_abo,#psic_soc").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_seg,#psic_psic,#psic_cont,#psic_abo,#psic_soc").prop( "checked", true );  break;

			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO PSICOLÓGICO, INFORME PSICOLÓGICO, INFORME DE CONTENCIÓN, ABORDAJE PSICOLÓGICO, ABORDAJE PSICOSOCIAL':  $("#psic_nota,#psic_seg,#psic_psic,#psic_cont,#psic_abo,#psic_soc").prop( "checked", true );  break;
			}*/
			$("input[type='checkbox']").prop("checked", false);
			switch (informepsicologico_visita) {
				case 'NOTA INFORME':  $("#psic_nota").prop( "checked", true );  break;
				case 'INFORME DE SEGUIMIENTO PSICOLÓGICO':  $("#psic_seg").prop( "checked", true );  break;
				case 'INFORME PSICOLÓGICO':  $("#psic_psic").prop( "checked", true ); break;
				case 'INFORME DE CONTENCIÓN': $("#psic_cont").prop( "checked", true ); break;
				case 'VISITA DOMICILIARIA': $("#psic_vista").prop( "checked", true ); break;
				case 'INFORME PSICOSOCIAL': $("#psic_psicosocial").prop( "checked", true ); break;
				case 'INFORME PSICOLÓGICO PRELIMINAR': $("#psic_preliminar").prop( "checked", true ); break;
				  
				default:
				// Las combinaciones de opciones
				let checkboxes = [];
				// Comprobamos si la cadena contiene ciertos términos y agregamos los checkboxes correspondientes
				if (informepsicologico_visita.includes('NOTA INFORME')) checkboxes.push("#psic_nota");
				if (informepsicologico_visita.includes('INFORME DE SEGUIMIENTO PSICOLÓGICO')) checkboxes.push("#psic_seg");
				if (informepsicologico_visita.includes('INFORME PSICOLÓGICO')) checkboxes.push("#psic_psic");
				if (informepsicologico_visita.includes('INFORME DE CONTENCIÓN')) checkboxes.push("#psic_cont");
				if (informepsicologico_visita.includes('VISITA DOMICILIARIA')) checkboxes.push("#psic_vista");
				if (informepsicologico_visita.includes('INFORME PSICOSOCIAL')) checkboxes.push("#psic_psicosocial");
				if (informepsicologico_visita.includes('INFORME PSICOLÓGICO PRELIMINAR')) checkboxes.push("#psic_preliminar");
				// Marcamos todos los checkboxes seleccionados
				$(checkboxes.join(",")).prop("checked", true);
				break;
			}

			var psicologico_grupo_terapia = data.grupo_terapia;


			switch (psicologico_grupo_terapia)
			{
				case 'TERAPIA INDIVIDUAL':  $("#psic_ind").prop( "checked", true );  break;
				case 'TERAPIA FAMILIAR':  $("#psic_fam").prop( "checked", true );  break;
				case 'TERAPIA DE PAREJA':  $("#psic_par").prop( "checked", true ); break;
				case 'TERAPIA OCUPACIONAL': $("#psic_ocup").prop( "checked", true ); break;
				case 'NINGUNO': $("#psic_nin").prop( "checked", true ); break;
				default:
				// Las combinaciones de opciones
				let checkboxes = [];
				// Comprobamos si la cadena contiene ciertos términos y agregamos los checkboxes correspondientes
				if (psicologico_grupo_terapia.includes('TERAPIA INDIVIDUAL')) checkboxes.push("#psic_ind");
				if (psicologico_grupo_terapia.includes('TERAPIA FAMILIAR')) checkboxes.push("#psic_fam");
				if (psicologico_grupo_terapia.includes('TERAPIA DE PAREJA')) checkboxes.push("#psic_par");
				if (psicologico_grupo_terapia.includes('TERAPIA OCUPACIONAL')) checkboxes.push("#psic_ocup");
				if (psicologico_grupo_terapia.includes('NINGUNO')) checkboxes.push("#psic_nin");
				// Marcamos todos los checkboxes seleccionados
				$(checkboxes.join(",")).prop("checked", true);
				break;	  
			}

		});
});
$('.editarsocial').click(function() {

	var id = $(this).attr('content');

		$.getJSON('<?php echo site_url('servicio/getSocial');?>', { id: id })

		.done(function(data) {
			$("#situaciones").val(data.situacion);
			$("#descripcion").val(data.descripcion);
			$("#coordinacion").val(data.coordinacion_interinstitucional);
			$("#acogida").val(data.acogida);
			$("#informesocial_fecha").val(data.fecha);
			$("#informesocial_foja").val(data.numero_foja);

			$("#informesocial_id_denuncia").val(data.id_denuncia);


			var informesocial_visita = data.visita;


			/*switch (informesocial_visita)
			{

			 case 'NOTA INFORME':  $("#soc_nota").prop( "checked", true );  break;
			 //case 'VISITA DOMICILIARIA': $("#soc_dom").prop( "checked",true);break;
			 case 'INFORME DE SEGUIMIENTO SOCIAL':  $("#soc_seg").prop( "checked", true );  break;
			 case 'INFORME SOCIAL':  $("#soc_inf").prop( "checked", true ); break;
			 case 'ABORDAJE SOCIAL': $("#soc_soc").prop( "checked", true ); break;
			 case 'ABORDAJE PSICOSOCIAL': $("#soc_psic").prop( "checked", true ); break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO SOCIAL':  $("#soc_nota,#soc_seg").prop( "checked", true );  break;

			 case 'NOTA INFORME, INFORME SOCIAL':  $("#soc_nota,#soc_inf").prop( "checked", true );  break;
			 case 'NOTA INFORME, ABORDAJE SOCIAL':  $("#soc_nota,#soc_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, ABORDAJE PSICOSOCIAL':  $("#soc_nota,#soc_psic").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO SOCIAL, INFORME SOCIAL':  $("#soc_seg,#soc_inf").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO SOCIAL, ABORDAJE SOCIAL':  $("#soc_seg,#soc_soc").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO SOCIAL, ABORDAJE PSICOSOCIAL':  $("#soc_seg,#soc_psic").prop( "checked", true );  break;
			 case 'INFORME SOCIAL, ABORDAJE SOCIAL':  $("#soc_inf,#soc_soc").prop( "checked", true );  break;
			 case 'INFORME SOCIAL, ABORDAJE PSICOSOCIAL':  $("#soc_inf,#soc_psic").prop( "checked", true );  break;
			 case 'ABORDAJE SOCIAL, ABORDAJE PSICOSOCIAL':  $("#soc_soc,#soc_psic").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO SOCIAL, INFORME SOCIAL':  $("#soc_nota,#soc_seg,#soc_inf").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO SOCIAL, ABORDAJE SOCIAL':  $("#soc_nota,#soc_seg,#soc_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO SOCIAL, ABORDAJE PSICOSOCIAL':  $("#soc_nota,#soc_seg,#soc_psic").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO SOCIAL, INFORME SOCIAL, ABORDAJE SOCIAL':  $("#soc_seg,#soc_inf,#soc_soc").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO SOCIAL, INFORME SOCIAL, ABORDAJE PSICOSOCIAL':  $("#soc_seg,#soc_inf,#soc_psic").prop( "checked", true );  break;
			 case 'INFORME SOCIAL, ABORDAJE SOCIAL, ABORDAJE PSICOSOCIAL':  $("#soc_inf,#soc_soc,#soc_psic").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME SOCIAL, ABORDAJE SOCIAL':  $("#soc_nota,#soc_inf,#soc_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME SOCIAL, ABORDAJE PSICOSOCIAL':  $("#soc_nota,#soc_inf,#soc_psic").prop( "checked", true );  break;
			 case 'NOTA INFORME, ABORDAJE SOCIAL, ABORDAJE PSICOSOCIAL':  $("#soc_nota,#soc_soc,#soc_psic").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO SOCIAL, ABORDAJE SOCIAL, ABORDAJE PSICOSOCIAL':  $("#soc_seg,#soc_soc,#soc_psic").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO SOCIAL, INFORME SOCIAL, ABORDAJE SOCIAL':  $("#soc_nota,#soc_seg,#soc_inf,#soc_soc").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO SOCIAL, INFORME SOCIAL, ABORDAJE PSICOSOCIAL':  $("#soc_nota,#soc_seg,#soc_inf,#soc_psic").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO SOCIAL, ABORDAJE SOCIAL, ABORDAJE PSICOSOCIAL':  $("#soc_nota,#soc_seg,#soc_soc,#soc_psic").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME SOCIAL, ABORDAJE SOCIAL, ABORDAJE PSICOSOCIAL':  $("#soc_nota,#soc_inf,#soc_soc,#soc_psic").prop( "checked", true );  break;
			 case 'INFORME DE SEGUIMIENTO SOCIAL, INFORME SOCIAL, ABORDAJE SOCIAL, ABORDAJE PSICOSOCIAL':  $("#soc_seg,#soc_inf,#soc_soc,#soc_psic").prop( "checked", true );  break;
			 case 'NOTA INFORME, INFORME DE SEGUIMIENTO SOCIAL, INFORME SOCIAL, ABORDAJE SOCIAL, ABORDAJE PSICOSOCIAL':  $("#soc_nota,#soc_seg,#soc_inf,#soc_soc,#soc_psic").prop( "checked", true );  break;
			}*/
			$("input[type='checkbox']").prop("checked", false);
			switch (informesocial_visita) {
				case 'NOTA INFORME':$("#soc_nota").prop("checked", true);break;
				case 'VISITA DOMICILIARIA':$("#soc_dom").prop("checked", true);break;
				case 'INFORME PSICOSOCIAL':$("#soc_psico").prop("checked", true);break;
				case 'INFORME SOCIOECONÓMICO':$("#soc_socio").prop("checked", true);break;
				case 'INFORME DE SEGUIMIENTO SOCIAL':$("#soc_seg").prop("checked", true);break;
				case 'INFORME SOCIAL':$("#soc_inf").prop("checked", true);break;
				case 'ABORDAJE SOCIAL':$("#soc_soc").prop("checked", true);break;
				case 'ABORDAJE PSICOSOCIAL':$("#soc_psic").prop("checked", true);break;
				default:
				// Las combinaciones de opciones
				let checkboxes = [];
				// Comprobamos si la cadena contiene ciertos términos y agregamos los checkboxes correspondientes
				if (informesocial_visita.includes('NOTA INFORME')) checkboxes.push("#soc_nota");
				if (informesocial_visita.includes('VISITA DOMICILIARIA')) checkboxes.push("#soc_dom");
				if (informesocial_visita.includes('INFORME PSICOSOCIAL')) checkboxes.push("#soc_psico");
				if (informesocial_visita.includes('INFORME SOCIOECONÓMICO')) checkboxes.push("#soc_socio");
				if (informesocial_visita.includes('INFORME DE SEGUIMIENTO SOCIAL')) checkboxes.push("#soc_seg");
				if (informesocial_visita.includes('INFORME SOCIAL')) checkboxes.push("#soc_inf");
				if (informesocial_visita.includes('ABORDAJE SOCIAL')) checkboxes.push("#soc_soc");
				if (informesocial_visita.includes('ABORDAJE PSICOSOCIAL')) checkboxes.push("#soc_psic");
				// Marcamos todos los checkboxes seleccionados
				$(checkboxes.join(",")).prop("checked", true);
				break;
			}


		});
});

$('.editararchivo').click(function() {

	var id = $(this).attr('content');

		$.getJSON('<?php echo site_url('servicio/getDenuncia');?>', { id: id })

		.done(function(data) {


			$("#id_denuncia").val(data.id_denuncia);


		});
});

$('.editarcerrar').click(function() {

	var id = $(this).attr('content');

		$.getJSON('<?php echo site_url('servicio/getDenuncia');?>', { id: id })

		.done(function(data) {


			$("#cerrar_id_denuncia").val(data.id_denuncia);


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

			 CrearMapa();
			 GraficaSoloMarcadores();
	 });
</script>

