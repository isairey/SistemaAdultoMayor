<?php $num = 1;  ?>
<?php foreach ($viven as $vive): ?>
   <tr>
     <td><?php echo $num++ ?></td>
     <td><?php echo $vive->familiar ?></td>
     <td class="center">
        <?php if($vive->estado === 'AC' ): ?>
           <a class="button small palette-Green-700 bg tooltipster-top changestate" valor="DC" kardex="<?php echo $vive->id_kardex ?>" content="<?php echo $vive->id_vive_con ?>" >
             <i class="fontello-ok"></i>
          </a>
       <?php else: ?>
          <a class="button small palette-Red-700 bg tooltipster-top changestate" valor="AC" kardex="<?php echo $vive->id_kardex ?>" content="<?php echo $vive->id_vive_con ?>" >
            <i class="fontello-cancel"></i>
         </a>
      <?php endif; ?>
     </td>
   </tr>
<?php endforeach; ?>

<script type="text/javascript">
   $('.changestate').click(function() {
      var id_vive_con = $(this).attr('content');
      var new_estado = $(this).attr('valor');
      var kardex = $(this).attr('kardex');

      $.ajax({
         url: '<?php echo site_url('servicio/updateViveCon') ?>',
         type: 'POST',
         dataType: 'html',
         data: {id: id_vive_con, estado: new_estado, id_kardex:kardex}
      })
      .done(function(data) {
         $('#detalle_vive').empty();
         $('#detalle_vive').append(data);
      })
      .fail(function() {
         console.log("error");
      });

   });
</script>
