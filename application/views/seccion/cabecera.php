<?php $funcion = $this->router->fetch_method(); ?>
<?php $control = $this->router->fetch_class(); ?>
<?php $usuario = $this->session->userdata('servidor'); ?>


<?php $point = '<span class="text palette-Brown-500 fontello-record" style="float: right"></span>'; ?>

<div class="wrap-fluid" id="paper-bg">
   <nav class="top-bar palette-Grey-700 bg" data-topbar role="navigation" id="example-menu">
      <div class="top-bar-right medium-10">
           <ul class = "menu dropdown icon-top text-white" data-dropdown-menu>
               <?php if(mostrar('MENU ADMINISTRADOR')): ?>
               <li class="dropdown tool  <?php echo ($control==='administrador') ? 'active' : '' ; ?>">
                   <a href="#">
                       <i class="fa fontello-vcard"></i><?php echo lang('administrador') ?>
                   </a>
                   <ul class="menu submenu is-dropdown-submenu first-sub vertical bg-white">
                       <?php if(mostrar('USUARIOS')):  ?>
                       <li>
                           <?php $active = ($funcion==='usuarios' AND $control==='administrador')? $point : '' ;?>
                           <?php echo anchor('gestion-usuarios','<i class="fa fontello-user"></i>'.lang('usuarios').$active, array('class'=> 'text-gray')); ?>
                       </li>
                       <?php endif; ?>
                       <?php if(mostrar('FUNCIONES')): ?>
                       <li>
                           <?php $active = ($funcion==='funciones' AND $control==='administrador')? $point : '' ;?>
                           <?php echo anchor('gestion-funciones','<i class="fa fontello-cog"></i>'.lang('funciones').$active, array('class'=> 'text-gray')); ?>
                       </li>
                       <?php endif; ?>

                       <?php if(mostrar('ROLES')): ?>
                       <li>
                           <?php $active = ($funcion==='roles' AND $control==='administrador')? $point : '' ;?>
                           <?php echo anchor('gestion-roles','<i class="fa fontello-key"></i>'.lang('roles').$active, array('class'=> 'text-gray')); ?>
                       </li>
                       <?php endif; ?>
                       <?php if(mostrar('GESTIONES')): ?>
                       <li>
                           <?php $active = ($funcion==='gestiones' AND $control==='administrador')? $point : '' ;?>
                           <?php echo anchor('gestion-gestiones','<i class="fa fontello-key"></i>'.lang('gestiones').$active, array('class'=> 'text-gray')); ?>
                       </li>
                       <?php endif; ?>

                       <?php if(mostrar('TIPOLOGIAS')): ?>
                       <li>
                           <?php $active = ($funcion==='tipologias' AND $control==='administrador')? $point : '' ;?>
                           <?php echo anchor('gestion-categorias','<i class="fa fontello-key"></i>'.lang('tipologias').$active, array('class'=> 'text-gray')); ?>
                       </li>
                       <?php endif; ?>
                       <?php if(mostrar('CENTROS')): ?>
                       <li>
                           <?php $active = ($funcion==='centros' AND $control==='administrador')? $point : '' ;?>
                           <?php echo anchor('gestion-centros','<i class="fa fontello-key"></i>'.lang('centros').$active, array('class'=> 'text-gray')); ?>
                       </li>
                       <?php endif; ?>

                   </ul>
               </li>
               <?php endif; ?>
               <!--  END ADMINISTRADOR  -->
              <!-- MENU DENUNCIAS   -->


               <?php if(mostrar('MENU DENUNCIAS')): ?>
               <li class="dropdown tool  <?php echo ($control==='denuncia') ? 'active' : '' ; ?>">
                   <a href="#">
                       <i class="fa fontello-vcard"></i><?php echo lang('denuncias') ?>
                   </a>

                   <ul class="menu submenu is-dropdown-submenu first-sub vertical bg-white">
                       <?php if(mostrar('DENUNCIAS')):  ?>
                       <li>
                           <?php $active = ($funcion==='denuncia' AND $control==='denuncias')? $point : '' ;?>
                           <?php echo anchor('denuncia','<i class="la la-tasks"></i>'.lang('denuncia').$active, array('class'=> 'text-gray')); ?>
                       </li>
                       <?php endif; ?>

                       <?php if(mostrar('DENUNCIAS ARCHIVADAS')): ?>
                       <li>
                           <?php $active = ($funcion==='denunciaarchivada' AND $control==='denuncias')? $point : '' ;?>
                           <?php echo anchor('denuncia-archivada','<i class="la la-tasks"></i>'.lang('archivada').$active, array('class'=> 'text-gray')); ?>
                       </li>
                       <?php endif; ?>

                       <?php if(mostrar('DENUNCIAS CERRADAS')): ?>
                       <li>
                           <?php $active = ($funcion==='denunciacerrada' AND $control==='denuncias')? $point : '' ;?>
                           <?php echo anchor('denuncia-cerrada','<i class="la la-tasks"></i>'.lang('cerrada.den').$active, array('class'=> 'text-gray')); ?>
                       </li>
                       <?php endif; ?>
                   </ul>
               </li>
               <?php endif; ?>
               <!--  END MENU DENUNCIAS -->
               <!--  MENU KARDEX  -->
                   <?php if(mostrar('MENU KARDEX')): ?>
                     <li class="dropdown tool  <?php echo ($control==='kardex') ? 'active' : '' ; ?>">
                         <a href="#">
                             <i class="fontello-contacts"></i><?php echo lang('kardex') ?>
                         </a>
                         <ul class="menu submenu is-dropdown-submenu first-sub vertical bg-white">
                            <?php if(mostrar('VICTIMAS')): ?>
                            <li>
                                <?php $active = ($funcion==='detallekardex' AND $control==='kardex')? $point : '' ;?>
                                <?php echo anchor('kardex','<i class="fontello-contacts"></i>'.lang('kardex.victimas').$active, array('class'=> 'text-gray')); ?>
                            </li>
                            <?php endif; ?>
                         </ul>
                     </li>
                   <?php endif; ?>
               <!--  END MENU KARDEX  -->

               <!--  MENU HISTORIAL  -->
                   <?php if(mostrar('MENU HISTORIAL')): ?>
                      <li class="dropdown tool  <?php echo ($control==='historial') ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url("historial-index") ?>">
                               <i class="fa fontello-doc-text"></i><?php echo lang('historial') ?>
                           </a>
                      </li>
                   <?php endif;?>
               <!--  END MENU HISTORIAL  -->


               <!--  MENU ESTADISTICAS -->
                   <?php if(mostrar('MENU ESTADISTICAS')): ?>
                     <li class="dropdown tool  <?php echo ($control==='estadisticas') ? 'active' : '' ; ?>">
                         <a href="#">
                             <i class="fontello-chart-pie"></i><?php echo lang('estadisticas') ?>
                         </a>
                         <ul class="menu submenu is-dropdown-submenu first-sub vertical bg-white">
                            <?php if(mostrar('VICTIMAS POR GENERO')): ?>
                            <li>
                                <?php $active = ($funcion==='cantidad_victimas_VM' AND $control==='stat')? $point : '' ;?>
                                <?php echo anchor('cantidad-victimas-por-genero','<i class="fontello-chart-pie-outline"></i>'.lang('victimas.sexo').$active, array('class'=> 'text-gray')); ?>
                            </li>
                            <?php endif; ?>

                            <?php if(mostrar('DENUNCIADOS POR PARENTESCO')): ?>
                            <li>
                                <?php $active = ($funcion==='cantidad_denunciados_parentescos' AND $control==='stat')? $point : '' ;?>
                                <?php echo anchor('cantidad-denunciados-por-parentesco','<i class="fontello-chart-pie-outline"></i>'.lang('denunciados.parentesco').$active, array('class'=> 'text-gray')); ?>
                            </li>
                            <?php endif; ?>
                            <?php if(mostrar('DENUNCIAS EN INSTANCIAS')): ?>
                            <li>
                                <?php $active = ($funcion==='cantidad_denuncia_instancia' AND $control==='stat')? $point : '' ;?>
                                <?php echo anchor('cantidad-denuncias-en-instancias','<i class="fontello-chart-pie-outline"></i>'.lang('denuncia.instancias').$active, array('class'=> 'text-gray')); ?>
                            </li>
                            <?php endif; ?>
                            <?php if(mostrar('DENUNCIAS EN SITUACIÓN DE ACOGIDA')): ?>
                            <li>
                                <?php $active = ($funcion==='cantidad_denuncia_acogida' AND $control==='stat')? $point : '' ;?>
                                <?php echo anchor('cantidad-denuncias-acogidas','<i class="fontello-chart-pie-outline"></i>'.lang('denuncia.acogidas').$active, array('class'=> 'text-gray')); ?>
                            </li>
                            <?php endif; ?>
                            <?php if(mostrar('DENUNCIAS POR PROCEDENCIA')): ?>
                            <li>
                                <?php $active = ($funcion==='cantidad_procedencia_denuncia' AND $control==='stat')? $point : '' ;?>
                                <?php echo anchor('cantidad-denuncias-procedencias','<i class="fontello-chart-pie-outline"></i>'.lang('denuncia.procedencia').$active, array('class'=> 'text-gray')); ?>
                            </li>
                            <?php endif; ?>
                            <?php if(mostrar('DENUNCIAS POR TIPOLOGÍAS')): ?>
                            <li>
                                <?php $active = ($funcion==='cantidad_denuncia_tipologia' AND $control==='stat')? $point : '' ;?>
                                <?php echo anchor('cantidad-denuncias-tipologias','<i class="fontello-chart-pie-outline"></i>'.lang('denuncia.tipologias').$active, array('class'=> 'text-gray')); ?>
                            </li>
                            <?php endif; ?>
                            <?php if(mostrar('DENUNCIAS POR TIPO DE INFORME TÉCNICO')): ?>
                            <li>
                                <?php $active = ($funcion==='cantidad_denuncias_area' AND $control==='stat')? $point : '' ;?>
                                <?php echo anchor('cantidad-denuncias-areas','<i class="fontello-chart-pie-outline"></i>'.lang('denuncia.area').$active, array('class'=> 'text-gray')); ?>
                            </li>
                            <?php endif; ?>
                            <?php if(mostrar('DENUNCIAS POR INTERVENCIONES PSICOLÓGICAS')): ?>
                            <li>
                                <?php $active = ($funcion==='cantidad_denuncias_intervenciones' AND $control==='stat')? $point : '' ;?>
                                <?php echo anchor('cantidad-denuncias-intervenciones','<i class="fontello-chart-pie-outline"></i>'.lang('denuncia.intervencion').$active, array('class'=> 'text-gray')); ?>
                            </li>
                            <?php endif; ?>
                            <?php if(mostrar('ADULTOS EN GRUPOS DE TERAPIA')): ?>
                            <li>
                                <?php $active = ($funcion==='cantidad_denuncias_terapia' AND $control==='stat')? $point : '' ;?>
                                <?php echo anchor('cantidad-denuncias-terapias','<i class="fontello-chart-pie-outline"></i>'.lang('denuncia.terapia').$active, array('class'=> 'text-gray')); ?>
                            </li>
                            <?php endif; ?>
                            <?php if(mostrar('DENUNCIAS POR INTERVENCIONES SOCIALES')): ?>
                            <li>
                                <?php $active = ($funcion==='cantidad_denuncias_intervencion_social' AND $control==='stat')? $point : '' ;?>
                                <?php echo anchor('cantidad-denuncias-intervenciones-sociales','<i class="fontello-chart-pie-outline"></i>'.lang('denuncia.intervencion.social').$active, array('class'=> 'text-gray')); ?>
                            </li>
                            <?php endif; ?>
                            <?php if(mostrar('DENUNCIAS ARCHIVADAS Y CERRADAS')): ?>
                            <li>
                                <?php $active = ($funcion==='cantidad_denuncias_arch_cerr' AND $control==='stat')? $point : '' ;?>
                                <?php echo anchor('cantidad-denuncias-archivadas-cerradas','<i class="fontello-chart-pie-outline"></i>'.lang('denuncia.arch.cerr').$active, array('class'=> 'text-gray')); ?>
                            </li>
                            <?php endif; ?>
                         </ul>
                     </li>
                   <?php endif; ?>
               <!--  END MENU KARDEX  -->
              <!-- MENU PERFIL  -->
               <?php if(mostrar('MENU PERFIL')): ?>
               <li class="dropdown tool <?php echo ($control==='perfil') ? 'active' : '' ; ?>">
                   <a href="#">
                       <i class="fa fontello-cog"></i><?php echo lang('perfil') ?>
                   </a>
                   <ul class="menu submenu is-dropdown-submenu first-sub vertical bg-white">
                      <li>
                          <?php echo anchor('inicio','<i class="la la-home"></i>'.lang('inicio'), array('class'=> 'text-gray')); ?>
                      </li>
                      <?php if(mostrar('GESTION DENUNCIA')):  ?>
                      <li>
                          <?php $active = ($funcion==='gestion_denuncia' AND $control==='perfil')? $point : '' ;?>
                          <?php echo anchor('gestion-denuncias','<i class="la la-calendar"></i>'.lang('gestion.denuncia'), array('class'=> 'text-gray')); ?>
                      </li>
                      <?php endif; ?>
                       <?php if(mostrar('CAMBIAR CONTRASENIA')):  ?>
                       <li>
                           <?php $active = ($funcion==='contrasenias' AND $control==='perfil')? $point : '' ;?>
                           <?php echo anchor('cambiar-contrasenia','<i class="la la-at"></i>'.lang('cambiar.contrasenia'), array('class'=> 'text-gray')); ?>
                       </li>
                       <?php endif; ?>

                       <?php if(mostrar('CERRAR SESION')):?>
                       <li>
                           <?php echo anchor('cerrar-sesion','<i class="la la-sign-out"></i>'.lang('cerrar.sesion'), array('class'=> 'text-gray')); ?>
                       </li>
                       <?php endif; ?>
                   </ul>
               </li>
               <?php endif; ?>
               <!-- END MENU PERFIL  -->
           </ul>
           <!-- Right Nav Section -->
      </div>
   </nav>
   <!-- end of Top Nav -->
               <!-- breadcrumbs -->

<div class="large-12">
   <ul class="breadcrumbs">
        <?php echo $this->breadcrumbs->show(); ?>
   </ul>
</div>
