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
	        <div class="box-header panel palette-Purple-700 bg">
	            <!-- tools box -->
	            <h3 class="box-title"><i class="ti-view-list palette-White-Icons text"></i>
	                <span class="palette-White-Text text" ><?php echo lang('estadisticas') ?></span>
	            </h3>
	        </div>

	        <!-- /.box-header -->
	        <div class="box-body">
	        <!-- Table -->
           <div class="row">
               <div class="large-6 columns">
                  <div class="">
                        <div class="large-12 small-12 column" style="overflow: hidden; background-color: white !important;">
                             <div id="pagos_gestion" style="width: 100%; height: 500px; margin: 0 auto"></div>
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
                                 text: 'PAGOS POR GESTION MUNICIPAL '+<?php echo $anio ?>,
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
                                 data: <?php echo json_encode($pagos_gestion);?>
                             }];

                             var json = {};
                             json.chart = chart;
                             json.title = titles;
                             json.tooltip = tooltip;
                             json.series = series;
                             json.plotOptions = plotOptions;
                             $('#pagos_gestion').highcharts(json);
                        });
                     </script>
           <!-- end Table -->
      </div>

        <div class="large-6 columns">
           <div class="">
               <div class="large-12 small-12 column" style="overflow: hidden; background-color: white !important;">
                     <div id="pagos_estado" style="width: 100%; height: 500px; margin: 0 auto"></div>
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
                             contextButtonTitle: "Menú contextual del gráfico",
                        }
                       });
                     var chart = {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                     };
                     var titles = {
                        text: 'COBROS POR GESTIÓN MUNICIPAL '+<?php echo $anio ?>,
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
                        data: <?php echo json_encode($pagos_estado);?>
                     }];

                     var json = {};
                     json.chart = chart;
                     json.title = titles;
                     json.tooltip = tooltip;
                     json.series = series;
                     json.plotOptions = plotOptions;
                     $('#pagos_estado').highcharts(json);
                 });
            </script>
        </div>

      <!-- /.box-body -->
  </div>
	            <!-- end Table -->
	        </div>
	        <!-- /.box-body -->
	    </div>
	</div>
</div>



<?php $this->load->view('seccion/pie'); ?>
