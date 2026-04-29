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

                          <div class="large-6 columns">
                             <div  class="">
                               <div class="box-header panel palette-Brown-500 bg">
                                   <!-- tools box -->
                                   <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
                                       <span class="palette-White-Text text" ><?php echo lang('denuncia.archivada') .$anio?></span>
                                   </h3>
                               </div>
                               <!-- Table -->
                     	            <div class="row">

                     	                <div class="large-12 columns">
                     	                    <table class="stack dinamico" id="denuncias_archivadas">
                     	                        <thead>
                     														<tr>
                     																<th style="text-align:center;"><?php echo lang('numero') ?></th>
                     																<th style="text-align:center;"><?php echo lang('denuncia.archivada') ?></th>
                     																<th style="text-align:center;"><?php echo lang('cantidad') ?></th>
                                                    <th style="text-align:center;"><?php echo lang('porcentaje') ?></th>

                     														</tr>
                     												  </thead>
                     	                        <tbody>
                     															<?php $numero = 1;$total_archivada=0; ?>

                     															<?php foreach ($tabla_denuncia_archivada as $denuncia):
                                                       foreach ($total_denuncias as $total):
                                                        $porcentaje = round(($denuncia->y * 100)/$total->total,2);
                                                        $total_archivada=$total_archivada+$denuncia->y;
                                                      ?>
                       																<tr>
                       																	<td style="text-align:center;"><?php echo $numero ?></td>
                       																	<td style="text-align:center;"><?php echo $denuncia->name ?></td>
                       																	<td style="text-align:center;"><?php echo $denuncia->y ?></td>
                                                        <td style="text-align:center;"><?php echo $porcentaje. "%" ?></td>
                       															 </tr>


                     																<?php $numero++; ?>
                     															<?php endforeach?>
                                                <?php endforeach?>

                                                  <?php foreach ($total_denuncias as $total):
                                                  $name1="TOTAL DE DENUNCIAS ARCHIVADAS";
                                                  $porcentaje_arch = round(($total_archivada * 100)/$total->total,2);

                                                 ?>

                                                 <tr>
                                                   <thead>
                                                     <td style="text-align:center;"><?php echo $name1 ?></td>
                                                     <td style="text-align:center;"><?php echo (" ");  ?></td>
                                                     <td style="text-align:center;"><?php echo $total_archivada ?></td>
                                                     <td style="text-align:center;"><?php echo $porcentaje_arch." %" ?></td>
                                                   </thead>
                                                </tr>
                                                <?php endforeach?>



                     	                        </tbody>
                     	                    </table>
                                          <br><br>

                     	                </div>
                     	            </div>
                     	            <!-- end Table -->

                              </div>

                         </div>

                         <div class="large-6 columns">
                            <div  class="">
                              <div class="box-header panel palette-Brown-500 bg">
                                  <!-- tools box -->
                                  <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
                                      <span class="palette-White-Text text" ><?php echo lang('denuncia.cerrada') .$anio?></span>
                                  </h3>
                              </div>
                              <!-- Table -->
                                 <div class="row">

                                     <div class="large-12 columns">
                                         <table class="stack dinamico" id="denuncias_area">
                                             <thead>
                                               <tr>
                                                   <th style="text-align:center;"><?php echo lang('numero') ?></th>
                                                   <th style="text-align:center;"><?php echo lang('denuncia.cerrada') ?></th>
                                                   <th style="text-align:center;"><?php echo lang('cantidad') ?></th>
                                                   <th style="text-align:center;"><?php echo lang('porcentaje') ?></th>

                                               </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $numero = 1; $total_cerrada=0;?>

                                                 <?php foreach ($tabla_denuncia_cerrada as $denuncia):
                                                   foreach ($total_denuncias as $total):
                                                     $porcentaje = round(($denuncia->y * 100)/$total->total,2);
                                                     $total_cerrada=$total_cerrada+$denuncia->y;
                                                    ?>
                                                     <tr>
                                                       <td style="text-align:center;"><?php echo $numero ?></td>
                                                       <td style="text-align:center;"><?php echo $denuncia->name ?></td>
                                                       <td style="text-align:center;"><?php echo $denuncia->y ?></td>
                                                       <td style="text-align:center;"><?php echo $porcentaje. "%" ?></td>
                                                    </tr>

                                                   <?php $numero++; ?>
                                                   <?php endforeach ?>
                                                 <?php endforeach ?>


                                                 <?php foreach ($total_denuncias as $total):
                                                 $name1="TOTAL DE DENUNCIAS CERRADAS";
                                                 $porcentaje_cerr = round(($total_cerrada * 100)/$total->total,2);
                                                ?>

                                                <tr>
                                                  <thead>
                                                    <td style="text-align:center;"><?php echo $name1 ?></td>
                                                    <td style="text-align:center;"><?php echo (" ");  ?></td>
                                                    <td style="text-align:center;"><?php echo $total_cerrada?></td>
                                                    <td style="text-align:center;"><?php echo $porcentaje_cerr." %" ?></td>
                                                  </thead>
                                               </tr>
                                               <?php endforeach?>
                                             </tbody>
                                         </table>
                                         <br><br>

                                     </div>
                                 </div>
                                 <!-- end Table -->

                             </div>

                        </div>



                        </div>
                        <!-- end Table -->

                        <div class="large-2 columns large-centered">
                            <form method="post" data-abide accept-charset="utf-8" action="<?php echo current_url() ?>" />
                              <button type="submit" name="print_denun_arch_cerr" value="1" class="button palette-Brown-500 bg">
                                  <i class="fontello-ok"></i><?php echo lang('crear.pdf') ?>
                              </button>
                           </form>
                       </div>


              </div>
        	</div>
        </div>


<?php $this->load->view('seccion/pie'); ?>
