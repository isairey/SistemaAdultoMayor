<table>
	<caption><h3><?php echo lang('cobros.beneficiario').':' ?></h3></caption>
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
	<caption><h3><?php echo lang('detalle.cobros').' año: '.$this->session->userdata('gestion'); ?><h3></caption>
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
							<?php echo 'PENDIENTE' ?>
            			</td>
					<?php else: ?>
						<?php $fecha = explode(' ', $pago->fecha_cobro); ?>
						<td class="center"><?php  echo fecha($fecha[0]); ?></td>
						<?php $monto_cobrado += $pago->monto; ?>
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
