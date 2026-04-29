<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view('seccion/cabeza'); ?>
<?php $this->load->view('seccion/cabecera'); ?>

<div class="row">
	<div class="large-12 columns">
		<?php $this->load->view('seccion/mensaje') ?>
	</div>
</div>
<div class="row">
	<div class="large-11 large-centered columns">
		<div class="box no-shadow ">
	        <div class="box-header panel palette-Purple-700 bg">
	            <!-- tools box -->
	            <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
	                <span class="palette-White-Text text" ><?php echo lang('lista.personas') ?></span>
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
	                                <th><?php echo lang('fecha.nacimiento') ?></th>
	                                <th><?php echo lang('edad') ?></th>
	                                <th><?php echo lang('genero') ?></th>
	                                <th><?php echo lang('opciones') ?></th>
	                            </tr>
	                        </thead>
	                        <tbody>
								<?php $numero = 1; ?>
								<?php foreach ($discapacitados as $discapacitado): ?>
									<tr>
										<td><?php echo $numero ?></td>
										<td><?php echo $discapacitado->paterno.' '.$discapacitado->materno.' '.$discapacitado->nombres ?></td>
										<td><?php echo $discapacitado->dni ?></td>
										<td><?php echo fecha($discapacitado->fecha_nacimiento) ?></td>
										<td><?php echo edad($discapacitado->fecha_nacimiento) ?></td>
										<td><?php echo $discapacitado->genero ?></td>
										<td>
											<div class="button-group small">
												<button data-open="editkardex" class="button palette-Purple-700 bg tooltipster-top kardex"  title="<?php echo lang('registro.persona') ?>" content="<?php echo $discapacitado->id_kardex  ?>" >
													<i class="la la-user la-2x"></i>
												</button>

												<button data-open="discapacidad" class="button palette-Purple-700 bg tooltipster-top datos" title="<?php echo lang('datos.discapacidad') ?>" content="<?php echo $discapacitado->id_kardex  ?>" >
													<i class="la la-wheelchair la-2x"></i>
												</button>

												<button data-open="salud" class="button palette-Purple-700 bg tooltipster-top salud" title="<?php echo lang('datos.salud') ?>" content="<?php echo $discapacitado->id_kardex  ?>" >
													<i class="la la-medkit la-2x"></i>
												</button>

												<button data-open="educacion" class="button palette-Purple-700 bg tooltipster-top educacion"  title="<?php echo lang('educacion') ?>"  content="<?php echo $discapacitado->id_kardex  ?>" >
													<i class="la la-mortar-board la-2x"></i>
												</button>

												<button data-open="vivienda" class="button palette-Purple-700 bg tooltipster-top vivienda"  title="<?php echo lang('vivienda.servicios.basicos') ?>"  content="<?php echo $discapacitado->id_kardex  ?>" >
													<i class="la la-home la-2x"></i>
												</button>

												<button data-open="vive" class="button palette-Purple-700 bg tooltipster-top vive"  title="<?php echo lang('convivencia.documentos') ?>" content="<?php echo $discapacitado->id_kardex  ?>" >
													<i class="la la-users la-2x"></i>
												</button>

												<button data-open="help" class="button palette-Purple-700 bg tooltipster-top help"  title="<?php echo lang('servicios.departamento') ?>" content="<?php echo $discapacitado->id_kardex  ?>" >
													<i class="la la-life-ring la-2x"></i>
												</button>

												<a href="<?php echo site_url('kardex-discapacitado/'.$discapacitado->id_kardex) ?>" class="button palette-Red-700 bg tooltipster-top" title="<?php echo lang('kardex.individual') ?>">
													<i class="la la-print la-2x"></i>
												</a>
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
                  <a data-open="newkardex" class="button palette-Purple-700 bg"><i class="fontello-user-add"></i><?php echo lang('registrar.persona') ?></a>
					</div>
				</div>
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>

<!-- Modal Agregar Usuario  -->
<div class="small reveal" id="newkardex" data-reveal="">
	<form method="post" data-abide no-validate data-live-validate="true" accept-charset="utf-8" enctype="multipart/form-data" action="<?php echo site_url('kardex/registrar') ?>">
    	<h3 class="center"><?php echo lang('registro.persona') ?></h3>

		<div class="row">
			<div class="large-6 columns">
				<div class="row">
					<div class="large-6 columns">
		 				<label>
		                		<?php echo lang('nombres') ?>
		                 	<input type="text" required name="persona[nombres]" pattern="^[a-zA-ZñÑ\s]+$" maxlength="20">
		                 	<span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
		             	</label>
		 			</div>
					<div class="large-6 columns">
						 <label>
								 <?php echo lang('paterno') ?>
							 <input type="text" name="persona[paterno]" pattern="^[a-zA-ZñÑ\s]+$" maxlength="20">
							 <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
						 </label>
					 </div>
				</div>

				<div class="row">
					<div class="large-5 columns">
  						 <label>
  								 <?php echo lang('materno') ?>
  							 <input type="text" name="persona[materno]" pattern="^[a-zA-ZñÑ\s]+$" maxlength="20">
  							 <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
  						 </label>
  					</div>
					<div class="large-4 columns">
		     			<label>
		                		<?php echo lang('dni') ?>
		                 	<input type="text" required name="persona[dni]" pattern="^[a-zA-Z\d\-]+$" maxlength="12">
		                 	<span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
		             	</label>
		     		</div>
		     		<div class="large-3 columns">
		 				<label>
		                		<?php echo lang('expedido') ?>
		                 	<?php echo form_dropdown(array('name'=>'persona[id_expedido]'), $expedido) ?>
		                 	<span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
		             	</label>
		     		</div>
				</div>

				<div class="row">
		    		<div class="large-7 columns">
		    			<label>
		               		<?php echo lang('genero') ?>
		                	<?php echo form_dropdown(array('name'=>'persona[genero]'), $genero) ?>
		                	<span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
		            	</label>
		    		</div>
		    		<div class="large-5 columns">
						<label>
		               		<?php echo lang('estado.civil') ?>
		                	<?php echo form_dropdown(array('name'=>'persona[estado_civil]'), $civil) ?>
		                	<span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
		            	</label>
		    		</div>
		    	</div>

				<div class="row">
		    		<div class="large-7 columns">
		    			<label>
		               		<?php echo lang('fecha.nacimiento') ?>
		               	</label>
		                	<input type="text" required name="persona_fecha_nacimiento" class="select-fechas">
		                	<span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>

		    		</div>

					<div class="large-5 columns">
						<label>
								<?php echo lang('telefono') ?>
								<input type="text" name="persona[telefono]">
								<span class="form-error"><?php echo lang('numerico') ?></span>
						 </label>
					</div>
		    	</div>

				<div class="row">
					<div class="large-7 columns">
						<label>
							   <?php echo lang('email') ?>
							   <input type="email" name="persona[email]">
							   <span class="form-error"><?php echo lang('formato.email') ?></span>
						</label>

					</div>

					<div class="large-5 columns">
						<label>
							   <?php echo lang('celular') ?>
							   <input type="text" name="persona[celular]">
							   <span class="form-error"><?php echo lang('numerico') ?></span>
						 </label>
					</div>
				</div>

				<div class="row">
		    		<div class="large-12 columns">
		    			<label>
	               	<?php echo lang('direccion.domicilio') ?>
	               	</label>
	                	<input type="text" required name="persona[direccion]" pattern="^[a-zA-Z#º\d\s]+$">
	                	<span class="form-error"><?php echo lang('alfabetico') ?></span>
		    		</div>
		    	</div>

				<div class="row">
		    		<div class="large-12 columns">
		    			<label>
	               	<?php echo lang('lugar.nacimiento') ?>
	               	</label>
	                	<input type="text" required name="persona[lugar_nacimiento]" pattern="^[a-zA-ZñÑ\d\s]+$">
	                	<span class="form-error"><?php echo lang('alfabetico') ?></span>
		    		</div>
		    	</div>

			</div>

			<div class="large-6 columns">
				<div class="center">
					<label id="upload">
						 <input type="file" name="foto">
					</label>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns center">
					<button type="submit" name="new_gestion" value="1" class="button palette-Purple-700 bg">
							<i class="fontello-ok"></i><?php echo lang('registrar') ?>
					</button>
				</div>
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Modal Agregar Kardex  -->


<!-- Modal Editar Kardex  -->

<div class="small reveal" id="editkardex" data-reveal="">
	<form method="post" data-abide no-validate data-live-validate="true" accept-charset="utf-8" action="<?php echo site_url('kardex/editar') ?>">
    	<h3 class="center"><?php echo lang('registro.persona') ?></h3>

		<div class="row">
		  <div class="large-6 columns">
			  <div class="row">
					 <div class="large-12 columns">
					  <label>
								  <?php echo lang('nombres') ?>
								  <input type="text" required name="persona[nombres]" id="persona_nombres" pattern="^[a-zA-ZñÑ\s]+$" maxlength="20">
								  <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
						  </label>
				  </div>
			  </div>

			  <div class="row">
					 <div class="large-6 columns">
						  <label>
								  <?php echo lang('paterno') ?>
								  <input type="text" name="persona[paterno]" id="persona_paterno" pattern="^[a-zA-ZñÑ\s]+$" maxlength="20">
								  <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
						  </label>
						 </div>

				  <div class="large-6 columns">
						  <label>
								  <?php echo lang('materno') ?>
								  <input type="text" name="persona[materno]" id="persona_materno" pattern="^[a-zA-ZñÑ\s]+$" maxlength="20">
								  <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
						  </label>
					 </div>
			   </div>

				  <div class="row">
					  <div class="large-7 columns">
						  <label>
								  <?php echo lang('dni') ?>
								  <input type="text" required name="persona[dni]" id="persona_dni" pattern="^[a-zA-Z\d\-]+$" maxlength="12">
								  <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
						  </label>
					  </div>
					  <div class="large-5 columns">
					  <label>
								  <?php echo lang('expedido') ?>
								  <?php echo form_dropdown(array('name'=>'persona[id_expedido]', 'id'=>'persona_expedido'), $expedido) ?>
								  <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
						  </label>
					  </div>
				  </div>

				  <div class="row">
					  <div class="large-7 columns">
						  <label>
								  <?php echo lang('genero') ?>
								  <?php echo form_dropdown(array('name'=>'persona[genero]', 'id'=>'persona_genero'), $genero) ?>
								  <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
						  </label>
					  </div>
					  <div class="large-5 columns">
					  <label>
								  <?php echo lang('estado.civil') ?>
								  <?php echo form_dropdown(array('name'=>'persona[estado_civil]', 'id'=>'persona_estado_civil'), $civil) ?>
								  <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
						  </label>
					  </div>
				  </div>

				  <div class="row">
					  <div class="large-7 columns">
						  <label>
								  <?php echo lang('fecha.nacimiento') ?>
							  </label>
								  <input type="text" required name="persona_fecha_nacimiento" id="persona_fecha_nacimiento" class="select-fechas">
								  <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>

					  </div>

					  <div class="large-5 columns">
						  <label>
								  <?php echo lang('telefono') ?>
								  <input type="text" name="persona[telefono]" id="persona_telefono">
								  <span class="form-error"><?php echo lang('numerico') ?></span>
							</label>
					  </div>
				  </div>

				  <div class="row">
					  <div class="large-7 columns">
						  <label>
								  <?php echo lang('email') ?>
								  <input type="email" name="persona[email]" id="persona_email">
								  <span class="form-error"><?php echo lang('formato.email') ?></span>
						  </label>

					  </div>

					  <div class="large-5 columns">
						  <label>
								  <?php echo lang('celular') ?>
								  <input type="text" name="persona[celular]" id="persona_celular">
								  <span class="form-error"><?php echo lang('numerico') ?></span>
							</label>
					  </div>
				  </div>

				  <div class="row">
  		    		<div class="large-12 columns">
  		    			<label>
  	               	<?php echo lang('direccion.domicilio') ?>
  	               	</label>
  	                	<input type="text" id="persona_direccion" name="persona[direccion]" pattern="^[a-zA-Z#º\d\s]+$">
  	                	<span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
  		    		</div>
  		    	</div>
		  </div>
		  <div class="large-6 columns center">
		  		<img src="" alt="" id="fotodisc" class="large-10">
		  </div>
		</div>

		<input type="hidden" required name="persona_id_kardex" id="persona_id_kardex" >

		<div class="row">
			<div class="large-12 columns center">
					<button type="submit" name="new_gestion" value="1" class="button palette-Purple-700 bg">
							<i class="fontello-ok"></i><?php echo lang('editar') ?>
					</button>
				</div>
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Modal Editar Kardex  -->

<!-- Modal Editar Datos de la Discapacidad  -->

<div class="small reveal" id="discapacidad" data-reveal="">
	<form method="post" data-abide no-validate data-live-validate="true" accept-charset="utf-8" action="<?php echo site_url('kardex/datos') ?>">
    	<h3 class="center"><?php echo lang('datos.discapacidad') ?></h3>

		<div class="row">
			<div class="large-6 columns">
				<div class="row">
			        <div class="large-6 columns">
						<label>
		               		<?php echo lang('tipo.discapacidad') ?>
		                	<?php echo form_dropdown(array('name'=>'discapacidad[id_discapacidad]', 'required'=>'required','id'=>'discapacidad_id_discapacidad'), $discapacidades) ?>
		                	<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
		            	</label>
		    		</div>

		    		<div class="large-6 columns">
		            	<label>
		               		<?php echo lang('grado.discapacidad') ?>
		                	<?php echo form_dropdown(array('name'=>'discapacidad[grado_discapacidad]', 'required'=>'required' ,'id'=>'grado_discapacidad'), $grados) ?>
		                	<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
		            	</label>
		            </div>
				</div>

				<div class="row">
			        <div class="large-6 columns">
		            	<label>
		               		<?php echo lang('porcentaje.discapacidad') ?>
		                	<input type="text" required name="discapacidad[porcentaje_discapacidad]" id="porcentaje_discapacidad" pattern="^[\d]+$" maxlength="3">
		                	<span class="form-error"><?php echo lang('numerico') ?></span>
		            	</label>
			        </div>

			        <div class="large-6 columns">
		            	<label>
		               		<?php echo lang('causa.discapacidad') ?>
		                	<?php echo form_dropdown(array('name'=>'discapacidad[causa_discapacidad]','required'=>'required', 'id'=>'causa_discapacidad'), $causas) ?>
		                	<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
		            	</label>
		            </div>
			    </div>

				 <div class="row">
					 <div class="large-12 columns">
 					 <label>
 							 <?php echo lang('organizacion.discapacidad') ?>
 							 <input type="text" name="discapacidad[organizacion]" id="organizacion_discapacidad" pattern="^[A-Za-Z\s\d]+$" maxlength="30">
 							 <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
 						 </label>
 				 </div>
				 </div>
			</div>
			<div class="large-6 columns">
				<div class="row">
			        <div class="large-6 columns">
						<label>
		               	<?php echo lang('profesion') ?>
								<input type="text" name="discapacidad[profesion]" id="profesion_discapacidad" pattern="^[A-Za-Z\s]+$" maxlength="30">
		                	<span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
		            	</label>
		    		</div>

		    		<div class="large-6 columns">
		            	<label>
								<?php echo lang('ocupacion.actual') ?>
								<input type="text" name="discapacidad[ocupacion]" id="ocupacion_discapacidad" pattern="^[A-Za-Z\s]+$" maxlength="30">
								<span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
		            	</label>
		            </div>
				</div>

				<div class="row">
			        <div class="large-6 columns">
						<label>
		               	<?php echo lang('institucion.empresa') ?>
								<input type="text" name="discapacidad[institucion_empresa]" id="institucion_empresa_discapacidad" pattern="^[A-Za-Z\s]+$" maxlength="30">
		                	<span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
		            	</label>
		    		</div>

		    		<div class="large-6 columns">
		            	<label>
								<?php echo lang('su.trabajo') ?>
								 <?php echo form_dropdown(array('name'=>'discapacidad[su_trabajo]', 'id'=>'su_trabajo_discapacidad'), $sutrabajo) ?>
								<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
		            	</label>
		            </div>
				</div>
				<div class="row">
			        <div class="large-12 columns">
						<label>
		               	<?php echo lang('lugar.trabajo') ?>
								<input type="text" name="discapacidad[lugar_trabajo]" id="lugar_trabajo_discapacidad" pattern="^[A-Za-Z\s]+$" maxlength="40">
		                	<span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
		            	</label>
		    		</div>
				</div>
			</div>
		</div>




		<input type="hidden" required name="kardex_id_kardex" id="datos_id_kardex" >

		<div class="row">
			<div class="large-12 columns center">
				<button type="submit" name="update_datos" value="1" class="button palette-Purple-700 bg">
						<i class="fontello-ok"></i><?php echo lang('guardar') ?>
				</button>
			</div>
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Modal Fin Discapacidad -->

<!-- Modal Editar Salud  -->

<div class="tiny reveal" id="salud" data-reveal="">
	<form method="post" data-abide no-validate data-live-validate="true" accept-charset="utf-8" action="<?php echo site_url('kardex/salud') ?>">
    	<h3 class="center"><?php echo lang('datos.salud') ?></h3>
		<div class="row">
	        <div class="large-12 columns">
				<label>
               		<?php echo lang('servicio.salud') ?>
                	<?php echo form_dropdown(array('name'=>'salud[salud_servicio]', 'required'=>'required','id'=>'salud_servicio'), $servicios_salud) ?>
                	<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
            	</label>
    		</div>
		</div>

		<div class="row">
	        <div class="large-12 columns">
            	<label>
               		<?php echo lang('tipo.centro.medico') ?>
                	<?php echo form_dropdown(array('name'=>'salud[tipo_centro_medico]','required'=>'required', 'id'=>'tipo_centro_medico'), $tipos_centros) ?>
                	<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
            	</label>
	        </div>
	    </div>

	    <div class="row">
	    	<div class="large-12 columns">
            	<label>
               		<?php echo lang('nombre.centro') ?>
                	<input type="text" required name="salud[nombre_centro]" id="salud_nombre_centro" pattern="^[A-Za-zÑñº\d\s]+$" maxlength="30">
                	<span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
            	</label>
	        </div>
	    </div>

	    <div class="row">
	    	<div class="large-12 columns">
            	<label>
               		<?php echo lang('medicamentos.discapacidad') ?>
                	<input type="text" required name="salud[medicamentos]" id="salud_medicamentos" pattern="^[A-Za-zÑñ\d\s]+$" maxlength="60">
                	<span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
            	</label>
	        </div>
	    </div>

	     <div class="row">
	    	<div class="large-12 columns">
            	<label>
               		<?php echo lang('adquiere.medicamentos') ?>
                	<input type="text" required name="salud[adquiere_medicamentos]" id="salud_adquiere_medicamentos" pattern="^[A-Za-zÑñ\d\s]+$" maxlength="60">
                	<span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
            	</label>
	        </div>
	    </div>

	    <div class="row">
	        <div class="large-12 columns">
            	<label>
               		<?php echo lang('ayudas.tecnicas') ?>
                	<?php echo form_dropdown(array('name'=>'salud[recibe_ayudas_tecnicas]','required'=>'required', 'id'=>'salud_recibe_ayuda_tecnica'), $opcion_base) ?>
                	<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
            	</label>
	        </div>
	    </div>

	    <div class="row">
	    	<div class="large-12 columns">
            	<label>
               	<?php echo lang('nombre.ayuda.tecnica') ?>
                	<input type="text" name="salud[ayudas_tecnicas]" id="salud_ayudas_tecnicas" pattern="^[A-Za-zÑñ\d\s]+$" maxlength="60">
                	<span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
            	</label>
	        </div>
	    </div>

	     <div class="row">
		    	<div class="large-12 columns">
	            	<label>
	               	<?php echo lang('ayuda.permanente') ?>
	                	<?php echo form_dropdown(array('name'=>'salud[ayuda_permanente]','required'=>'required', 'id'=>'salud_ayuda_permanente'), $opcion_base) ?>
	                	<span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
	            	</label>
	        </div>
	    </div>

		<input type="hidden" required name="salud_id_kardex" id="salud_id_kardex" >

		<div class="row">
			<div class="large-12 columns center">
				<button type="submit" name="update_datos" value="1" class="button palette-Purple-700 bg">
						<i class="fontello-ok"></i><?php echo lang('guardar') ?>
				</button>
			</div>
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Modal Fin Salud -->

<!-- Modal Editar Educacion -->

<div class="tiny reveal" id="educacion" data-reveal="">
	<form method="post" data-abide no-validate data-live-validate="true" accept-charset="utf-8" action="<?php echo site_url('kardex/educacion') ?>">
    	<h3 class="center"><?php echo lang('educacion') ?></h3>
		<div class="row">
	        <div class="large-12 columns">
				<label>
            	<?php echo lang('grado.instruccion') ?>
             	<?php echo form_dropdown(array('name'=>'educacion[grado_instruccion]', 'required'=>'required','id'=>'grado_instruccion'), $educacion) ?>
             	<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
         	</label>
    		</div>
		</div>

		<div class="row">
	        <div class="large-12 columns">
            	<label>
               	<?php echo lang('asiste.educacion.esp') ?>
                	<?php echo form_dropdown(array('name'=>'educacion[asiste_educacion_especial]','required'=>'required', 'id'=>'asiste_educacion_especial'), $opcion_base) ?>
                	<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
            	</label>
	        </div>
	    </div>

	    <div class="row">
	    	<div class="large-12 columns">
            	<label>
               		<?php echo lang('nombre.centro.especial') ?>
                	<input type="text" name="educacion[nombre_centro_especial]" id="nombre_centro_especial" pattern="^[A-Za-zÑñº\d\s]+$" maxlength="60">
                	<span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
            	</label>
	        </div>
	    </div>

		 <div class="row">
				<div class="large-12 columns">
					 <label>
						 <?php echo lang('asiste.educacion.reg') ?>
						 <?php echo form_dropdown(array('name'=>'educacion[asiste_educacion_regular]','required'=>'required', 'id'=>'asiste_educacion_regular'), $opcion_base) ?>
						 <span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
					 </label>
				</div>
		  </div>

		  <div class="row">
			  <div class="large-12 columns">
					  <label>
							  <?php echo lang('nombre.centro.regular') ?>
							  <input type="text" name="educacion[nombre_centro_regular]" id="nombre_centro_regular" pattern="^[A-Za-zÑñº\d\s]+$" maxlength="60">
							  <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
					  </label>
				 </div>
			 </div>

		<input type="hidden" required name="educacion_id_kardex" id="educacion_id_kardex" >

		<div class="row">
			<div class="large-12 columns center">
				<button type="submit" name="update_datos" value="1" class="button palette-Purple-700 bg">
						<i class="fontello-ok"></i><?php echo lang('guardar') ?>
				</button>
			</div>
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>


<!-- Modal Editar Vivienda -->

<div class="tiny reveal" id="vivienda" data-reveal="">
	<form method="post" data-abide no-validate data-live-validate="true" accept-charset="utf-8" action="<?php echo site_url('kardex/vivienda') ?>">
    	<h3 class="center"><?php echo lang('vivienda.servicios.basicos') ?></h3>
		<div class="row">
	        <div class="large-12 columns">
				<label>
            	<?php echo lang('tipo.vivienda') ?>
             	<?php echo form_dropdown(array('name'=>'vivienda[tipo_vivienda]', 'required'=>'required','id'=>'tipo_vivienda'), $viviendas) ?>
             	<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
         	</label>
    		</div>
		</div>

		<div class="row">
	        <div class="large-12 columns">
            	<label>
               	<?php echo lang('propiedad.vivienda') ?>
                	<?php echo form_dropdown(array('name'=>'vivienda[propiedad]','required'=>'required', 'id'=>'propiedad'), $propiedad) ?>
                	<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
            	</label>
	        </div>
	    </div>

	    <div class="row">
	    	<div class="large-12 columns">
            	<label>
               	<?php echo lang('acceso.servicios.basicos') ?>
            	</label>
					<table>
					  <thead>
					    <tr>
					      <th><?php echo lang('numero') ?></th>
					      <th><?php echo lang('servicio') ?></th>
					      <th><?php echo lang('cuenta.servicio') ?></th>
					    </tr>
					  </thead>
					  <tbody id="detalle_servicio">

					  </tbody>
					</table>
	        </div>
	    </div>

		<input type="hidden" required name="vivienda_id_kardex" id="vivienda_id_kardex" >

		<div class="row">
			<div class="large-12 columns center">
				<button type="submit" name="update_vivienda" value="1" class="button palette-Purple-700 bg">
						<i class="fontello-ok"></i><?php echo lang('guardar') ?>
				</button>
			</div>
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>


<div class="small reveal" id="vive" data-reveal="">
	<form method="post" data-abide no-validate data-live-validate="true" accept-charset="utf-8" action="<?php echo site_url('kardex/vive') ?>">
    	<h3 class="center"><?php echo lang('convivencia.documentos') ?></h3>

		<div class="row">
			<div class="large-6 columns">
				<div class="row">
			        <div class="large-12 columns">
						<label>
		            	<?php echo lang('persona.referencia') ?>
		             	 <input type="text" name="vive[persona_referencia]" id="persona_referencia" pattern="^[A-Za-zÑñ\s]+$" maxlength="60">
		             	<span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
		         	</label>
		    		</div>
				</div>

				<div class="row">
			        <div class="large-6 columns">
		            	<label>
		               	<?php echo lang('parentesco') ?>
		                	<?php echo form_dropdown(array('name'=>'vive[parentesco]','required'=>'required', 'id'=>'parentesco'), $parentesco) ?>
		                	<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
		            	</label>
			        </div>
					  <div class="large-6 columns">
							<label>
			            	<?php echo lang('telefono') ?>
			             	 <input type="text" name="vive[telefono_referencia]" id="telefono_referencia" pattern="^[\d]+$" maxlength="10">
			             	<span class="form-error"><?php echo lang('numerico') ?></span>
			         	</label>
		    		 </div>
			    </div>

				 <div class="row">
	   	    	<div class="large-12 columns">
	               	<label>
	                  	<?php echo lang('tiene.documentos') ?>
	               	</label>
	   					<table>
	   					  <thead>
	   					    <tr>
									 <th><?php echo lang('numero') ?></th>
									 <th><?php echo lang('documento') ?></th>
									 <th><?php echo lang('tiene.documento') ?></th>

	   					    </tr>
	   					  </thead>
	   					  <tbody id="detalle_documento">

	   					  </tbody>
	   					</table>
	   	        </div>
	   	    </div>
			</div>

			<div class="large-6 columns">
				<div class="row">
		  	    	<div class="large-12 columns">
		              	<label>
		                 	<?php echo lang('personas.vive') ?>
		              	</label>
		  					<table>
			  					  <thead>
			  					    <tr>
										 <th><?php echo lang('numero') ?></th>
    	   					       <th><?php echo lang('familiar') ?></th>
    	   					       <th><?php echo lang('vive.con') ?></th>
			  					    </tr>
			  					  </thead>
			  					  <tbody id="detalle_vive">

			  					  </tbody>
		  					</table>
		  	        </div>
	  	    	</div>
			</div>
		</div>



		<input type="hidden" required name="vive_id_kardex" id="vive_id_kardex" >

		<div class="row">
			<div class="large-12 columns center">
				<button type="submit" name="update_vivienda" value="1" class="button palette-Purple-700 bg">
						<i class="fontello-ok"></i><?php echo lang('guardar') ?>
				</button>
			</div>
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<div class="tiny reveal" id="help" data-reveal="">
	<form method="post" data-abide no-validate data-live-validate="true" accept-charset="utf-8" action="<?php echo site_url('kardex/help') ?>">
    	<h3 class="center"><?php echo lang('servicios.departamento') ?></h3>
		<div class="row">
	        <div class="large-6 columns">
				<label>
            	<?php echo lang('atencion.legal') ?>
             	<?php echo form_dropdown(array('name'=>'help[atencion_legal]', 'id'=>'atencion_legal'), $opcion_base) ?>
             	<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
         	</label>
    		</div>

			<div class="large-6 columns">
				 <label>
					 <?php echo lang('atencion.social') ?>
					 <?php echo form_dropdown(array('name'=>'help[atencion_social]', 'id'=>'atencion_social'), $opcion_base) ?>
					 <span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
				 </label>
			</div>
		</div>

		<div class="row">
	        <div class="large-6 columns">
				<label>
            	<?php echo lang('atencion.psicologica') ?>
             	<?php echo form_dropdown(array('name'=>'help[atencion_psicologica]', 'id'=>'atencion_psicologica'), $opcion_base) ?>
             	<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
         	</label>
    		</div>

			<div class="large-6 columns">
				 <label>
					 <?php echo lang('ilsb') ?>
					 <?php echo form_dropdown(array('name'=>'help[ilsb]', 'id'=>'ilsb'), $opcion_base) ?>
					 <span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
				 </label>
			</div>
		</div>

		<div class="row">
			 <div class="large-6 columns">
			  <label>
				  <?php echo lang('calificacion') ?>
				  <?php echo form_dropdown(array('name'=>'help[calificacion]', 'id'=>'calificacion'), $opcion_base) ?>
				  <span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
			  </label>
		  </div>

		  <div class="large-6 columns">
			   <label>
					<?php echo lang('bus.escolar') ?>
					<?php echo form_dropdown(array('name'=>'help[bus_escolar]', 'id'=>'bus_escolar'), $opcion_base) ?>
					<span class="form-error"><?php echo lang('seleccione.opcion') ?></span>
			   </label>
		  </div>
	  </div>

		  <div class="row">
			  <div class="large-12 columns">
					  <label>
							  <?php echo lang('actividades.departamento') ?>
							  <input type="text" name="help[actividades_departamento]" id="actividades_departamento" pattern="^[A-Za-zÑñ,\d\s]+$" maxlength="90">
							  <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
					  </label>
				 </div>
			 </div>

		<input type="hidden" required name="help_id_kardex" id="help_id_kardex" >

		<div class="row">
			<div class="large-12 columns center">
				<button type="submit" name="update_datos" value="1" class="button palette-Purple-700 bg">
						<i class="fontello-ok"></i><?php echo lang('guardar') ?>
				</button>
			</div>
		</div>

		<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
	</form>
</div>

<!-- Fin Modal Fin Educacion -->

<script type="text/javascript">
	$('#upload').loadImg({
		"fileExt"   : ["png","jpg"],
		"fileSize_min"  : 0,
		"fileSize_max"  : 3, // 1 mb
		"text": "Cargar foto ..."
	});
</script>


<script type="text/javascript" charset="utf-8">


	$('.kardex').click(function(){
		var id_kardex = $(this).attr('content');

		$.ajax({
			url: '<?php echo site_url('servicio/getKardex') ?>',
			type: 'POST',
			dataType: 'json',
			data: {id: id_kardex}
		})
		.done(function(data) {
				$('#persona_nombres').val(data.nombres);
				$('#persona_paterno').val(data.paterno);
				$('#persona_materno').val(data.materno);
				$('#persona_dni').val(data.dni);
				$('#persona_expedido').val(data.id_expedido);
				$('#persona_genero').val(data.genero);
				$('#persona_estado_civil').val(data.estado_civil);
				$('#persona_id_kardex').val(data.id_kardex);
				$('#persona_direccion').val(data.direccion);
				$('#persona_telefono').val(data.telefono);
				$('#persona_celular').val(data.celular);
				$('#persona_email').val(data.email);

				if(data.foto)
					$("#fotodisc").attr("src", './public/fotos/'+data.foto);
				else
					$("#fotodisc").attr("src", './public/fotos/default.png');

				moment.locale('es');
				var fec_nac = moment(data.fecha_nacimiento, 'YYYY-MM-DD').format('LL');
				$('#persona_fecha_nacimiento').val(fec_nac);
				$('input[name="persona_fecha_nacimiento_submit"]').val(data.fecha_nacimiento);

		})
		.fail(function() {
			console.log("error");
		});
	});

	$('.discapacidad').click(function(){
		var id_kardex = $(this).attr('content');

		$.ajax({
			url: '<?php echo site_url('servicio/getKardex') ?>',
			type: 'POST',
			dataType: 'json',
			data: {id: id_kardex}
		})
		.done(function(data) {
				$('#persona_nombres').val(data.nombres);
				$('#persona_paterno').val(data.paterno);
				$('#persona_materno').val(data.materno);
				$('#persona_dni').val(data.dni);
				$('#persona_expedido').val(data.id_expedido);
				$('#persona_genero').val(data.genero);
				$('#persona_id_kardex').val(data.id_kardex);

				moment.locale('es');
				var fec_nac = moment(data.fecha_nacimiento, 'YYYY-MM-DD').format('LL');
				$('#persona_fecha_nacimiento').val(fec_nac);
				$('input[name="persona_fecha_nacimiento_submit"]').val(data.fecha_nacimiento);

		})
		.fail(function() {
			console.log("error");
		});
	});

	$('.datos').click(function(){
		var id_kardex = $(this).attr('content');

		$.ajax({
			url: '<?php echo site_url('servicio/getKardex') ?>',
			type: 'POST',
			dataType: 'json',
			data: {id: id_kardex}
		})
		.done(function(data) {
				$('#discapacidad_id_discapacidad').val(data.id_discapacidad);
				$('#grado_discapacidad').val(data.grado_discapacidad);
				$('#porcentaje_discapacidad').val(data.porcentaje_discapacidad);
				$('#causa_discapacidad').val(data.causa_discapacidad);
				$('#profesion_discapacidad').val(data.profesion);
				$('#ocupacion_discapacidad').val(data.ocupacion);
				$('#institucion_empresa_discapacidad').val(data.institucion_empresa);
				$('#su_trabajo_discapacidad').val(data.su_trabajo);
				$('#lugar_trabajo_discapacidad').val(data.lugar_trabajo);
				$('#organizacion_discapacidad').val(data.organizacion);



				$('#datos_id_kardex').val(data.id_kardex);
		})
		.fail(function() {
			console.log("error");
		});
	});

	$('.salud').click(function(){
		var id_kardex = $(this).attr('content');

		$.ajax({
			url: '<?php echo site_url('servicio/getKardex') ?>',
			type: 'POST',
			dataType: 'json',
			data: {id: id_kardex}
		})
		.done(function(data) {
				$('#salud_servicio').val(data.salud_servicio);
				$('#tipo_centro_medico').val(data.tipo_centro_medico);
				$('#salud_nombre_centro').val(data.nombre_centro);
				$('#salud_medicamentos').val(data.medicamentos);
				$('#salud_adquiere_medicamentos').val(data.adquiere_medicamentos);
				$('#salud_recibe_ayuda_tecnica').val(data.recibe_ayudas_tecnicas);
				$('#salud_ayudas_tecnicas').val(data.ayudas_tecnicas);
				$('#salud_ayuda_permanente').val(data.ayuda_permanente);

				$('#salud_id_kardex').val(data.id_kardex);
		})
		.fail(function() {
			console.log("error");
		});
	});

	$('.educacion').click(function(){
		var id_kardex = $(this).attr('content');

		$.ajax({
			url: '<?php echo site_url('servicio/getKardex') ?>',
			type: 'POST',
			dataType: 'json',
			data: {id: id_kardex}
		})
		.done(function(data) {
				$('#asiste_educacion_especial').val(data.asiste_educacion_especial);
				$('#asiste_educacion_regular').val(data.asiste_educacion_regular);
				$('#grado_instruccion').val(data.grado_instruccion);
				$('#nombre_centro_especial').val(data.nombre_centro_especial);
				$('#nombre_centro_regular').val(data.nombre_centro_regular);
				$('#educacion_id_kardex').val(data.id_kardex);
		})
		.fail(function() {
			console.log("error");
		});
	});

	$('.vivienda').click(function(){
		var id_kardex = $(this).attr('content');

		$.ajax({
			url: '<?php echo site_url('servicio/getVivienda') ?>',
			type: 'POST',
			dataType: 'json',
			data: {id: id_kardex}
		})
		.done(function(data) {
				$('#tipo_vivienda').val(data.kardex.tipo_vivienda);
				$('#propiedad').val(data.kardex.propiedad);
				$('#vivienda_id_kardex').val(data.kardex.id_kardex);

				$('#detalle_servicio').empty();

				$.ajax({
					url: '<?php echo site_url('servicio/getServiciosBasicos') ?>',
					type: 'POST',
					dataType: 'html',
					data: {id: id_kardex}
				})
				.done(function(data) {
						$('#detalle_servicio').append(data);
				})
				.fail(function() {
					console.log("error");
				});
		})
		.fail(function() {
			console.log("error");
		});
	});

	$('.vive').click(function(){
		var id_kardex = $(this).attr('content');

		$.ajax({
			url: '<?php echo site_url('servicio/getVive') ?>',
			type: 'POST',
			dataType: 'json',
			data: {id: id_kardex}
		})
		.done(function(data) {
				$('#persona_referencia').val(data.kardex.persona_referencia);
				$('#parentesco').val(data.kardex.parentesco);
				$('#telefono_referencia').val(data.kardex.telefono_referencia);

				$('#vive_id_kardex').val(data.kardex.id_kardex);

				$('#detalle_vive').empty();
				$('#detalle_documento').empty();

				$.ajax({
					url: '<?php echo site_url('servicio/getViveCon') ?>',
					type: 'POST',
					dataType: 'html',
					data: {id: id_kardex}
				})
				.done(function(data) {
						$('#detalle_vive').append(data);
				})
				.fail(function() {
					console.log("error");
				});

				$.ajax({
					url: '<?php echo site_url('servicio/getTieneDocumento') ?>',
					type: 'POST',
					dataType: 'html',
					data: {id: id_kardex}
				})
				.done(function(data) {
						$('#detalle_documento').append(data);
				})
				.fail(function() {
					console.log("error");
				});
		})
		.fail(function() {
			console.log("error");
		});
	});

	$('.help').click(function(){
		var id_kardex = $(this).attr('content');

		$.ajax({
			url: '<?php echo site_url('servicio/getKardex') ?>',
			type: 'POST',
			dataType: 'json',
			data: {id: id_kardex}
		})
		.done(function(data) {
				$('#atencion_legal').val(data.atencion_legal);
				$('#atencion_social').val(data.atencion_social);
				$('#atencion_psicologica').val(data.atencion_psicologica);
				$('#ilsb').val(data.ilsb);
				$('#bus_escolar').val(data.bus_escolar);
				$('#calificacion').val(data.calificacion);
				$('#actividades_departamento').val(data.actividades_departamento);
				$('#help_id_kardex').val(data.id_kardex);

		})
		.fail(function() {
			console.log("error");
		});
	});

</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('.select-fechas').pickadate({
			 monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			 weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
			 firstDay: 0,
			 selectYears: 120,
			 selectMonths: true,
			 max: true,
			 formatSubmit: 'yyyy-mm-dd',
			 format: 'd mmmm !de yyyy',
			 closeOnSelect: true,
			 today: '',
			 today: 'Hoy',
			 labelMonthNext: 'Mes Siguiente',
			 labelMonthPrev: 'Mes Anterior',
			 labelMonthSelect: 'Seleccione un Mes',
			 labelYearSelect: 'Seleccione un Año',
			 clear: 'Limpiar',
			 close: 'Cerrar'
		});
	});
</script>

<?php $this->load->view('seccion/pie'); ?>
