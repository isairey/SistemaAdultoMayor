<table class="stack listafuncion">
   <thead>
        <tr>
            <th width="25%" ><?php echo lang('n') ?></th>
            <th><?php echo lang('funcion') ?></th>
            <th width="25%"><?php echo lang('habilitado') ?></th>

        </tr>
   </thead>
   <tbody>
         <?php $num = 0; ?>
         <?php foreach ($funciones as $funcion): ?>
            <tr>
               <td><?php echo $num += 1  ?></td>
               <td><?php echo $funcion->nombre ?></td>
               <td>
                  <?php if($funcion->estado === 'AC'): ?>
                     <div class="center">
                        <button onclick="updatePermiso(<?php echo $funcion->id_permiso ?>, 'DC' )" class="button palette-Green-700 bg tooltipster-top update" >
                           <i class="fontello-ok"></i>
                        </button>
                     </div>
                  <?php else: ?>
                     <div class="center">
                        <button onclick="updatePermiso(<?php echo $funcion->id_permiso ?>, 'AC' )" class="button palette-Red-700 bg tooltipster-top update" >
                           <i class="fontello-cancel"></i>
                        </button>
                     </div>
                  <?php endif; ?>
               </td>
            </tr>
         <?php endforeach; ?>
   </tbody>
</table>

<script type="text/javascript">
   $(document).ready(function($) {
      $('.listafuncion').DataTable({

        "order": [[0, "asc"]],

        responsive: true,

        "language":{
                       "lengthMenu": "Mostrar _MENU_",
                       "zeroRecords": "No se encontró nada",
                       "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                       "infoEmpty": "No hay registros disponibles",
                       "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                       "search": "Buscar",
                       "previous": "Anterior",
                       "oPaginate": { "sNext":"Siguiente", "sLast": "Último", "sPrevious": "Anterior", "sFirst":"Primero" },
                       "oAria":
                               {
                                   "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                   "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                               }
                   }
     });

     $('.update').click(function() {

     		var id_permiso = $(this).attr('content');
         var estado = $(this).attr('update');


     		$.ajax({
     			url: '<?php echo site_url('servicio/updatePermiso') ?>',
     			type: 'POST',
     			dataType: 'html',
     			data: {id: id_permiso, estado: estado}
     		})
     		.done(function(data) {
     			$('#contenido').html(data);
     		})
     		.fail(function() {
     			console.log("error");
     		})
     		.always(function() {
     			console.log("complete");
     		});
     });
   });
</script>
