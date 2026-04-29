
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
    	        <div class="box-header panel palette-Grey-800 bg">
    	            <!-- tools box -->

    	            <h3 class="box-title palette-White"><i class="fontello-chart-pie"></i>
    	                <span><?php echo lang('estadisticas') ?></span>
    	            </h3>
    	        </div>

    	        <!-- /.box-header -->
    	        <div class="box-body">
    	        <!-- Table -->
    	            <div class="row">

                          <div class="large-6 columns large-centered">
                             <div  class="">
                               <div class="box-header panel palette-Brown-500 bg">
                                   <!-- tools box -->
                                   <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
                                       <span class="palette-White-Text text" ><?php echo lang('denuncia.acogidas') .$anio?></span>
                                   </h3>
                               </div>
                               <!-- Table -->
                     	            <div class="row">

                     	                <div class="large-12 columns">
                     	                    <table class="stack dinamico" id="denuncia_acogidas">
                     	                        <thead>
                     														<tr>

                     																<th style="text-align:center;"><?php echo lang('detalle') ?></th>
                     																<th style="text-align:center;"><?php echo lang('cantidad') ?></th>


                     														</tr>
                     												  </thead>
                     	                        <tbody>
                     															<?php foreach ($tabla_denuncia_acogidas as $acogida):
                                                      $name="Cantidad de adultos en Situación de Acogida";
                                                      $porcentaje2 = 5;
                                                     ?>
                     																<tr>
                     																	<td style="text-align:center;"><?php echo $name ?></td>
                     																	<td style="text-align:center;"><?php echo $acogida->y ?></td>
                     															 </tr>


                     															<?php endforeach ?>

                     															<?php foreach ($tabla_denuncia_sin_acogidas as $denuncia_sin):
                                                      $name2="Cantidad de adultos sin Centro de Acogida";
                                                      //$porcentaje2 = round(($denuncia_sin->sin  * 100)/$denuncia->total,2);
                                                     ?>

                     																<tr>

                     																	<td style="text-align:center;"><?php echo $name2 ?></td>
                     																	<td style="text-align:center;"> <?php echo $denuncia_sin->sin ?></td>

                     															 </tr>
                                                   <?php endforeach ?>
                                                   <?php foreach ($tabla_denuncia as $denuncia):
                                                       $name1="TOTAL DE DENUNCIAS";

                                                      ?>

                      																<tr>

                      																	<td style="text-align:center;"><?php echo $name1 ?></td>
                      																	<td style="text-align:center;"><?php echo $denuncia->total ?></td>

                      															 </tr>


                     															<?php endforeach ?>
                     	                        </tbody>
                     	                    </table>

                                          <br><br>
                                          <div class="large-2 columns large-centered">
                                              <form method="post" data-abide accept-charset="utf-8" action="<?php echo current_url() ?>" />
                                                <button type="submit" name="print_denun_acogida" value="1" class="button palette-Brown-500 bg">
                                        						<i class="fontello-ok"></i><?php echo lang('crear.pdf') ?>
                                        				</button>
                                             </form>
                                         </div>

                     	                </div>
                     	            </div>
                     	            <!-- end Table -->

                              </div>

                           </div>

                        </div>
                        <!-- end Table -->


              </div>
        	</div>
        </div>


<?php $this->load->view('seccion/pie'); ?>
