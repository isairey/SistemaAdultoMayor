<?php echo doctype('html5'); ?>


<html class="no-js" lang="en">

   <head>
       <?php echo meta('Content-type', 'text/html; charset=utf-8', 'equiv'); ?>
       <?php echo meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0')); ?>

       <title>SIDERAM GAMC</title>
       <!-- Custom styles for this template -->
       <?php echo link_tag('theme/fondamix/css/mystyle.css') ?>
       <?php echo link_tag('theme/fondamix/css/foundation.css') ?>
       <?php echo link_tag('theme/fondamix/css/mystyle.css') ?>


       <!-- Custom styles for this template -->
       <?php echo link_tag('theme/fondamix/css/palette.css') ?>
       <?php echo link_tag('theme/fondamix/sass/css/dashboard.css') ?>
       <?php echo link_tag('theme/fondamix/css/style.css') ?>

       <!-- Fonts Css -->
       <?php echo link_tag('theme/fondamix/css/dripicon.css') ?>
       <?php echo link_tag('theme/fondamix/css/typicons.css') ?>
       <?php echo link_tag('theme/fondamix/css/font-awesome.css') ?>
       <?php echo link_tag('theme/fondamix/css/themify-icons.css') ?>
       <?php echo link_tag('theme/fondamix/css/Montserrat-Hairline.css') ?>
       <?php echo link_tag('theme/fondamix/sass/css/theme.css') ?>

       <?php echo link_tag('theme/fondamix/css/login.css') ?>


       <!-- pace loader -->
       <script src="<?php echo  base_url('theme/fondamix/js/pace/pace.js') ?>" ></script>
       <?php echo link_tag('theme/fondamix/js/pace/themes/orange/pace-theme-flash.css') ?>
       <?php echo link_tag('theme/fondamix/js/slicknav/slicknav.css') ?>
       <script src="<?php echo base_url('theme/fondamix/js/vendor/modernizr.js')?>"></script>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   </head>

   <body>
       <!-- preloader -->
       <div id="preloader">
           <div id="status">&nbsp;</div>
       </div>
       <!-- End of preloader -->
       <!-- right sidebar wrapper -->
       <div class="inner-wrap">
           <div class="wrap-fluid">
               <br />
               <br />
               <!-- Container Begin -->
               <div class="large-4 small-centered columns">
                   <div class="center margin-10">
                       <img alt="" class="large-6" src="<?php echo base_url('public/imagenes/logo-dark.png') ?>" />
                   </div>
                   <div class="box bg-white">
                       <!-- Profile -->
                       <!-- End of Profile -->
                       <!-- /.box-header -->
                       <div class="box-body " style="display: block;">
                           <div class="row">
                               <div class="large-12 columns">
                                   <div class="row">
                                       <div class="edumix-signup-panel">
                                           <form method="post" data-abide accept-charset="utf-8" action="<?php echo site_url() ?>">
                                               <div class="log-in-form">

                                                   <div class="large-12 center margin-bottom-20" >
                                                       <img src="<?php echo base_url('public/imagenes/logo.jpg') ?>" class="large-10 small-10 medium-10" >
                                                   </div>

                                                   <label><?php echo lang('usuario') ?>
                                                       <input type="text" name="login" required />
                                                   </label>

                                                   <label><?php echo lang('contrasenia') ?>
                                                       <input type="password" name="pass" required />
                                                   </label>

                                                   <p class="margin-bottom-20">
                                                       <button  type="submit" name="send_login" class="large-12 small-12 medium-12 button palette-Brown-500 bg hvr-pulse-grow">
                                                           <i class="fontello-key"></i>
                                                           <?php echo lang('iniciar.sesion') ?>
                                                       </button>
                                                   </p>
                                               </div>
                                           </form>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <!-- end .timeline -->
                   </div>
                   <!-- box -->
               </div>
           </div>
           <!-- End of Container Begin -->
       </div>
       <!-- end paper bg -->
       <div id="gradient"></div>
       <!-- end of inner-wrap -->
       <!-- main javascript library -->
       <script type='text/javascript' src="<?php echo base_url('theme/fondamix/js/jquery.js')?>"></script>
       <script type='text/javascript' src="<?php echo base_url('theme/fondamix/js/preloader-script.js')?>"></script>

       <!-- foundation javascript -->
       <script type='text/javascript' src="<?php echo base_url('theme/fondamix/js/foundation.min.js')?>"></script>

       <!-- main edumix javascript -->
       <script type='text/javascript' src="<?php echo base_url('theme/fondamix/js/slimscroll/jquery.slimscroll.js')?>"></script>
       <script type='text/javascript' src="<?php echo base_url('theme/fondamix/js/slicknav/jquery.slicknav.js')?>"></script>
       <script type='text/javascript' src="<?php echo base_url('theme/fondamix/js/sliding-menu.js')?>"></script>
       <script type='text/javascript' src="<?php echo base_url('theme/fondamix/js/scriptbreaker-multiple-accordion-1.js')?>"></script>
       <script type="text/javascript" src="<?php echo base_url('theme/fondamix/js/circle-progress/jquery.circliful.js')?>"></script>
       <!-- additional javascript -->

       <script>
           $(document).foundation();
       </script>
   </body>

</html>
