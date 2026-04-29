<?php $num = 1;  ?>
<?php foreach ($documentos as $documento): ?>
   <tr>
     <td><?php echo $num++ ?></td>
     <td><?php echo $documento->documento ?></td>
     <td class="center">
        <?php if($documento->estado === 'AC' ): ?>
           <a class="button palette-Green-700 bg tooltipster-top changedoc" valor="DC" kardex="<?php echo $documento->id_kardex ?>" content="<?php echo $documento->id_tiene_documento ?>" >
             <i class="fontello-ok"></i>
          </a>
       <?php else: ?>
          <a class="button palette-Red-700 bg tooltipster-top changedoc" valor="AC" kardex="<?php echo $documento->id_kardex ?>" content="<?php echo $documento->id_tiene_documento ?>" >
            <i class="fontello-cancel"></i>
         </a>
      <?php endif; ?>
     </td>
   </tr>
<?php endforeach; ?>

<script type="text/javascript">
   $('.changedoc').click(function() {
      var id_tiene_documento = $(this).attr('content');
      var new_estado = $(this).attr('valor');
      var kardex = $(this).attr('kardex');

      $.ajax({
         url: '<?php echo site_url('servicio/updateTieneDocumento') ?>',
         type: 'POST',
         dataType: 'html',
         data: {id: id_tiene_documento, estado: new_estado, id_kardex:kardex}
      })
      .done(function(data) {
         $('#detalle_documento').empty();
         $('#detalle_documento').append(data);
      })
      .fail(function() {
         console.log("error");
      });

   });
</script>
