<?php $num = 1;  ?>
<?php foreach ($servicios as $servicio): ?>
   <tr>
     <td><?php echo $num++ ?></td>
     <td><?php echo $servicio->nombre_servicio ?></td>
     <td class="center">
        <?php if($servicio->estado === 'AC' ): ?>
           <a class="button palette-Green-700 bg tooltipster-top changeservicio" valor="DC" kardex="<?php echo $servicio->id_kardex ?>" content="<?php echo $servicio->id_servicios_disp  ?>" >
             <i class="fontello-ok"></i>
          </a>
       <?php else: ?>
          <a class="button palette-Red-700 bg tooltipster-top changeservicio" valor="AC" kardex="<?php echo $servicio->id_kardex ?>" content="<?php echo $servicio->id_servicios_disp  ?>" >
            <i class="fontello-cancel"></i>
         </a>
      <?php endif; ?>
     </td>
   </tr>
<?php endforeach; ?>

<script type="text/javascript">
   $('.changeservicio').click(function() {
      var id_servicio = $(this).attr('content');
      var new_estado = $(this).attr('valor');
      var kardex = $(this).attr('kardex');

      $.ajax({
         url: '<?php echo site_url('servicio/updateServiciosBasicos') ?>',
         type: 'POST',
         dataType: 'html',
         data: {id: id_servicio, estado: new_estado, id_kardex:kardex}
      })
      .done(function(data) {
         $('#detalle_servicio').empty();
         $('#detalle_servicio').append(data);
      })
      .fail(function() {
         console.log("error");
      });

   });
</script>
