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
    	                <div class="large-8 columns">
    	                   <div class="">
                               <div class="large-12 small-12 column" style="overflow: hidden; background-color: white !important;">
                                    <div id="social_visita" style="width: 100%; height: 500px; margin: 0 auto"></div>
                                </div>

                          </div>
                            <script language="JavaScript">
                                $(document).ready(function() {
                					Highcharts.setOptions({
                						lang: {
                						  downloadJPEG: "Descargar imagen JPEG",
                						  downloadPDF: "Descargar como documento PDF",
                						  downloadPNG: "Descargar imagen PNG",
                						  downloadSVG: "Descargar imagen vectorial SVG",
                							printChart: "Imprimir gráfico",
                							contextButtonTitle:	"Menú contextual del gráfico",
                						}
                					  });
                                    var chart = {
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false
                                    };
                                    var titles = {
                                        text: 'DENUNCIAS CON INTERVENCIÓN SOCIAL DE LA GESTIÓN '+<?php echo $anio ?>,
                          						style: {
                          							color: '#333',
                          							font: 'bold 16px "Lato",sans-serif'
                          						}
                                    };

                                    var tooltip = {
                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                    };
                                    var plotOptions = {
                                        pie: {
                                            allowPointSelect: false,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                                style: {
                                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || ''
                                                },
                                            },
                                            showInLegend: false,
                                        }
                                    };
                                    var series= [{
                                        type: 'pie',
                                        name: 'porcentaje ',
                                        data: <?php echo json_encode($social_visita);?>
                                    }];

                                    var json = {};
                                    json.chart = chart;
                                    json.title = titles;
                                    json.tooltip = tooltip;
                                    json.series = series;
                                    json.plotOptions = plotOptions;
                                    $('#social_visita').highcharts(json);
                                });
                            </script>
                          </div>
                          <div class="large-4 columns">
                             <div  class="">
                               <div class="box-header panel palette-Brown-500 bg">
                                   <!-- tools box -->
                                   <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
                                       <span class="palette-White-Text text" ><?php echo lang('denuncia.intervencion.social') .$anio?></span>
                                   </h3>
                               </div>
                               <!-- Table -->
                     	            <div class="row">

                     	                <div class="large-12 columns">
                     	                    <table class="stack dinamico" id="denuncias_social">
                     	                        <thead>
                     														<tr>
                     																<th style="text-align:center;"><?php echo lang('numero') ?></th>
                     																<th style="text-align:center;"><?php echo lang('denuncia.intervencion.social') ?></th>
                     																<th style="text-align:center;"><?php echo lang('cantidad') ?></th>
                                                    <th style="text-align:center;"><?php echo lang('porcentaje') ?></th>

                     														</tr>
                     												  </thead>
                     	                        <tbody>
                     															<?php $numero = 1; ?>

                     															<?php foreach ($tabla_social_visita as $denuncia):
                                                      $porcentaje = round(($denuncia->y * 100)/$total,2);
                                                    ?>
                     																<tr>
                     																	<td style="text-align:center;"><?php echo $numero ?></td>
                     																	<td style="text-align:center;"><?php echo $denuncia->name ?></td>
                     																	<td style="text-align:center;"><?php echo $denuncia->y ?></td>
                                                      <td style="text-align:center;"><?php echo $porcentaje. "%" ?></td>
                     															 </tr>
                     																<?php $numero++; ?>
                     															<?php endforeach ?>
                     	                        </tbody>
                     	                    </table>
                                          <br><br>
                                          <div class="large-2 columns large-centered">
                                              <form method="post" data-abide accept-charset="utf-8" action="<?php echo current_url() ?>" />
                                                <button type="submit" name="print_denun_visita" value="1" class="button palette-Brown-500 bg">
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
