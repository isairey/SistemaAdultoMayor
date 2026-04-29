<?php echo doctype('html5'); ?>

<html class="no-js" lang="es">

<head>
    <?php echo meta('Content-type', 'text/html; charset=utf-8', 'equiv'); ?>
    <?php echo meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0')); ?>

    <title>SIDERAM</title>

    <script src="<?php echo base_url('theme/fondamix/js/jquery.js') ?>"></script>

    <!-- Custom styles for this template -->
    <?php echo link_tag('theme/fondamix/css/foundation.css'); ?>
    <?php echo link_tag('theme/fondamix/css/palette.css'); ?>
    <?php echo link_tag('theme/fondamix/sass/css/dashboard.css'); ?>
    <?php echo link_tag('theme/fondamix/css/mystyle.css'); ?>
    <?php echo link_tag('theme/fondamix/css/style.css'); ?>
    <?php echo link_tag('theme/fondamix/css/dripicon.css'); ?>
    <?php echo link_tag('theme/fondamix/css/typicons.css'); ?>
    <?php echo link_tag('theme/fondamix/css/font-awesome.css'); ?>
    <?php echo link_tag('theme/fondamix/css/themify-icons.css'); ?>
    <?php echo link_tag('theme/fondamix/css/Montserrat-Hairline.css'); ?>
    <?php echo link_tag('theme/fondamix/sass/css/theme.css'); ?>
    <?php echo link_tag('theme/fondamix/css/line-awesome.css'); ?>

    <?php echo link_tag('public/fontawesome-free-5.0.12/web-fonts-with-css/css/fontawesome-all.min.css'); ?>

    <!-- tooltips -->
    <?php echo link_tag('theme/fondamix/js/tip/tooltipster.css') ?>
    <script type="text/javascript" src="<?php echo base_url('theme/fondamix/js/tip/jquery.tooltipster.js') ?>"></script>

    <!-- dataTables -->
    <?php echo link_tag('public/plugins/DataTables/datatables.css') ?>
    <script type="text/javascript" charset="utf8" src="<?php echo base_url('public/plugins/DataTables/datatables.js') ?>"></script>

    <!-- pickadate -->
    <?php echo link_tag('public/plugins/pickadate/lib/themes/default.css') ?>
    <?php echo link_tag('public/plugins/pickadate/lib/themes/default.date.css') ?>
    <script src="<?php echo base_url('public/plugins/pickadate/lib/picker.js') ?>"></script>
    <script src="<?php echo base_url('public/plugins/pickadate/lib/picker.date.js') ?>"></script>




      <!--mapa kardex-->
      <link rel="stylesheet" href="<?php echo base_url('assets/leaflet/leaflet.css') ?>"/>
      <script src="<?php echo base_url('assets/leaflet/leaflet.js') ?>"></script>



      <?php echo link_tag('public/plugins/jquery-ui/jquery-ui.css') ?>
      <script src="<?php echo base_url('public/plugins/jquery-ui/jquery-ui.js') ?>"></script>
      <script src="<?php echo base_url('public/plugins/monthpicker/jquery.mtz.monthpicker.js') ?>"></script>

      <!-- Moment -->
      <script src="<?php echo base_url('public/plugins/moment/moment.js') ?>" type="text/javascript"></script>

      <!-- Jquery Uploader File -->
      <?php echo link_tag('public/plugins/filestyle/src/jquery-filestyle.css') ?>
      <script src="<?php echo base_url('public/plugins/filestyle/src/jquery-filestyle.js') ?>"></script>


      <!-- pace loader -->
      <script src="<?php echo base_url('theme/fondamix/js/pace/pace.js') ?>"></script>
      <?php echo link_tag('theme/fondamix/js/pace/themes/orange/pace-theme-flash.css'); ?>
      <?php echo link_tag('theme/fondamix/js/slicknav/slicknav.css'); ?>
      <script src="<?php echo base_url('theme/fondamix/js/vendor/modernizr.js') ?>"></script>

    <!-- Minimal Upload Preview -->
    <?php echo link_tag('public/plugins/minimal/dist/loadimg.css') ?>
     <script src="<?php echo base_url('public/plugins/minimal/dist/loadimg.js') ?>"></script>

     <!-- Highcharts -->
     <script src="<?php echo base_url('public/plugins/estadisticos/highcharts.js') ?>" type="text/javascript"></script>
     <script src="<?php echo base_url('public/plugins/estadisticos/exporting.js') ?>" type="text/javascript"></script>


     <!-- mapa -->

   <link rel="stylesheet" href="<?php echo base_url('public/mapa/ol.css') ?>" type="text/css">
   <link href="<?php echo base_url('public/mapa/estilomapa.css') ?>" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="<?php echo base_url('public/mapa/popup.css') ?>"/>
   <script src="<?php echo base_url('public/mapa/ol.js') ?>" type="text/javascript"></script>
   <script src="<?php echo base_url('public/mapa/jquery-3.2.1.min.js') ?>"></script>
   <script>
   var jq321 = jQuery.noConflict();
   </script>
   <link rel="stylesheet" href="<?php echo base_url('public/mapa/ol3-contextmenu.min.css') ?>">
   <script src="<?php echo base_url('public/mapa/ol3-contextmenu.js') ?>"></script>
   <link rel="stylesheet" href="<?php echo base_url('public/mapa/popup.css') ?>"/>
   <script src="<?php echo base_url('public/mapa/olPrimusFiltros.js') ?>"></script>

</head>
