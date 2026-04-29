<h4 class="center"><?php echo lang('cobros.beneficiario') ?></h4>

<table>
	<caption><h3><?php echo lang('cobros.beneficiario').': ' ?></h3></caption>
	<thead>
		<tr>
			<th class="center"><?php echo lang('nombre.completo') ?></th>
			<th class="center"><?php echo lang('dni') ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="center"><?php echo $beneficiario->nombre ?></td>
			<td class="center"><?php echo $beneficiario->dni ?></td>
		</tr>
	</tbody>
</table>
<br>
<table>
	<caption><h3><?php echo lang('detalle.cobros').' Año: '.$this->session->userdata('gestion'); ?><h3></caption>
	<thead>
		<tr>
			<th class="center"><?php echo lang('numero') ?></th>
			<th class="center"><?php echo lang('gestion') ?></th>
			<th class="center"><?php echo lang('monto') ?></th>

			<th class="center"><?php echo lang('cobrador') ?></th>
			<th class="center"><?php echo lang('nombre.cobrador') ?></th>
			<th class="center"><?php echo lang('dni') ?></th>
			<th class="center"><?php echo lang('numero.comprobante') ?></th>
			<th class="center"><?php echo lang('fecha.cobro') ?></th>
			<th class="center"><?php echo lang('comprobante') ?></th>


		</tr>
	</thead>
	<tbody>

		<?php $numero = 1; $monto_beneficiado = 0; $monto_cobrado = 0; ?>

		<?php foreach ($pagos as $pago): ?>
			<tr>
				<td class="center"><?php echo $numero; ?></td>
				<td class="center"><?php echo $pago->nombre_gestion; ?></td>
				<td class="center"><?php echo $pago->monto; ?></td>
				<td class="center"><?php echo $pago->cobrador; ?></td>
				<td class="center"><?php echo $pago->nombre_cobrador; ?></td>
				<td class="center"><?php echo $pago->dni_cobrador; ?></td>
				<td class="center"><?php echo $pago->nro_comprobante ?></td>



					<?php if ($pago->estado==='AC'): ?>
						<td class="center">
                        	<a dni="<?php echo $beneficiario->dni ?>" beneficiario="<?php echo $beneficiario->nombre ?>" gestion="<?php echo $pago->nombre_gestion; ?>" content="<?php echo $pago->id_pago ?>" class="button palette-Purple-700 bg tooltipster-top cobrar" data-open="newpago" >
                           		<i class="fontello-money"></i>
                        	</a>
                        </td>
					<?php else: ?>

						<?php $fecha = explode(' ', $pago->fecha_cobro); ?>
						<td class="center"><?php  echo fecha($fecha[0]); ?></td>
						<?php $monto_cobrado += $pago->monto; ?>
					<?php endif; ?>

					<?php if ($pago->estado==='DC'): ?>
						<td class="center">
                    		<a href="<?php echo site_url('cobros/comprobante/'.$pago->id_pago) ?>" class="button palette-Purple-700 bg tooltipster-top cobrar">
                       			<i class="fontello-print"></i>
                    		</a>

						<?php if($fecha[0] == date('Y-m-d')): ?>
							<a href="<?php echo site_url('cobros/anular/'.$pago->id_pago) ?>" onclick="return confirm('Esta seguro de anular el comprobante Nº <?php echo $pago->nro_comprobante ?>?')" class="button palette-Red-700 bg tooltipster-top anular">
								<i class="fontello-cancel"></i>
							</a>
						<?php endif; ?>
                    	</td>
                    <?php endif; ?>

			</tr>
			<?php $numero += 1; ?>
			<?php $monto_beneficiado += $pago->monto; ?>
		<?php endforeach; ?>
	</tbody>
</table>
<br>
<table>
	<caption><h3><?php echo lang('contabilidad')  ?></h3></caption>
	<thead>
		<tr>
			<th class="center"><?php echo lang('total.beneficiado') ?></th>
			<th class="center"><?php echo lang('total.cobrado') ?></th>
			<th class="center"><?php echo lang('total.pendiente') ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="center"><?php echo $monto_beneficiado ?></td>
			<td class="center"><?php echo $monto_cobrado ?></td>
			<td class="center"><?php echo $monto_beneficiado - $monto_cobrado ?></td>
		</tr>
	</tbody>
</table>

<div class="reveal" id="newpago" data-reveal="">
	<h3 class="center"><?php echo lang('registrar.comprobante') ?></h3>
	<div class="row">

		<div class="large-12 medium-12 small-12 columns">
			<label>
				 <?php echo lang('cobrador') ?>
				 <?php echo form_dropdown(array('id'=>'cobrador'), $cobradores) ?>
				 <span class="form-error"><?php echo lang('alerta.numerico') ?></span>
			</label>
		</div>

		<div class="large-12 medium-12 small-12 columns">
			<label>
				 <?php echo lang('nombre.cobrador') ?>
				 <input type="text" id="nombre_cobrador" required >
				 <span class="form-error"><?php echo lang('alfabetico.espacio') ?></span>
			</label>
		</div>

		<div class="large-12 medium-12 small-12 columns">
			<label>
				 <?php echo lang('dni') ?>
				 <input type="text" id="dni" required>
				 <span class="form-error"><?php echo lang('alfanumerico.guion') ?></span>
			</label>
		</div>

		<input type="hidden" id="beneficiario" value="">
		<input type="hidden" id="gestion" value="">
		<input type="hidden" id="id_pago" value="">

		<div class="large-12 columns center">
			<button class="button palette-Purple-700 bg" id="update" onclick="eventClickUpdate(this)">
					<i class="fontello-ok"></i><?php echo lang('registrar') ?>
			</button>
		</div>
	</div>
	<button class="close-button" data-close="" aria-label="Close reveal" type="button"> <span aria-hidden="true">&times;</span> </button>
</div>

<script>
        $(document).foundation();
    </script>

<script type="text/javascript" charset="utf-8">

	function eventClickUpdate(e)
	{
		if(confirm('¿Estas seguro de realizar el pago del Bono de Discapacidad a '+$('#beneficiario').val()+' por la gestión: '+$('#gestion').val()+'?') )
		{
			var id_pago = $(e).closest('#newpago').find('#id_pago').val();
			var nombre_cobrador = $(e).closest('#newpago').find("#nombre_cobrador").val();
			var dni_cobrador = $(e).closest('#newpago').find("#dni").val();
			var cobrador = $(e).closest('#newpago').find("#cobrador").val();

			var xhr = $.ajax({
				url: '<?php echo site_url('servicio/updatePago') ?>',
				type: 'POST',
				dataType: 'html',
				data: {id: id_pago, nombre: nombre_cobrador, dni: dni_cobrador, cobrador: cobrador}
			})
			.done(function(data) {
				$('button.close-button').trigger('click');
				$('#contenido').empty();
				$('#contenido').html(data);

				$('#beneficiario').val('');
				$('#gestion').val('');
				$('#id_pago').val('');
				$('#cobrador').val('BENEFICIARIO');


			})
			.fail(function() {
				console.log("error");
			})
		}
	}


	$('.cobrar').click(function(){
		var beneficiario = $(this).attr('beneficiario');
		var dni = $(this).attr('dni');
		var gestion = $(this).attr('gestion');
		var id_pago = $(this).attr('content');

		$('#cobrador').val('BENEFICIARIO');
		$('#nombre_cobrador').val(beneficiario);
		$('#dni').val(dni);

		$('#beneficiario').val(beneficiario);
		$('#gestion').val(gestion);
		$('#id_pago').val(id_pago);
	});

	$('#cobrador').change(function(){
		$("#nombre_cobrador").val('');
		$("#dni").val('');
	});



</script>
