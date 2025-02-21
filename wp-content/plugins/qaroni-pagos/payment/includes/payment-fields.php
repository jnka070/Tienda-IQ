<div class="qaroni-pagos-form--container">
	<div id="div_cliente">
		<input type="text" id="qaroni-pagos_cchname" class="qaroni-pagos-form--input qaroni-pagos-form--name" name="card_holder_name" tabindex="1" title="<?php _e(__('Nombre y Apellido del Tarjetahabiente', 'qaroni-pagos')); ?>" placeholder="<?php _e(__('Nombre y Apellido del Tarjetahabiente', 'qaroni-pagos')); ?>" autocomplete="off" maxlength="25" pattern="[A-Za-zñ ]*" oninput="this.value = this.value.replace(/[^A-Za-zñ ]/g, '');">
		<select id="qaroni-pagos_chid" class="qaroni-pagos-form--select qaroni-pagos-form--tipe" name="qaroni-pagos_chid" tabindex="2" title="<?php _e(__('Tipo de Identificación del Tarjetahabiente', 'qaroni-pagos')); ?>">
			<option value="V" selected>V</option>
			<option value="E">E</option>
			<option value="J">J</option>
			<option value="G">G</option>
		</select>
		<input type="text" id="qaroni-pagos_cchnameid" class="qaroni-pagos-form--input qaroni-pagos-form--cchnameid" name="user_dni" tabindex="3" placeholder="<?php _e(__('Identificación del Tarjetahabiente', 'qaroni-pagos')); ?>" autocomplete="off" minlength="6" maxlength="8" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
	</div>
	<div id="div_tarjetas">
		<input type="text" id="qaroni-pagos_ccnum" class="qaroni-pagos-form--input qaroni-pagos-form--tdc-number" name="valid_card_number" tabindex="4" placeholder="<?php _e(__('Número de tarjeta', 'qaroni-pagos')); ?>" autocomplete="off" maxlength="16" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');" title="<?php _e(__('Número de tarjeta', 'qaroni-pagos')); ?>">
		<input type="password" id="qaroni-pagos_cvv" class="qaroni-pagos-form--input qaroni-pagos-form--ccv" name="cvc_code" tabindex="5" placeholder="<?php _e(__('Cód de seguridad', 'qaroni-pagos')); ?>" autocomplete="off" maxlength="3" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');" title="<?php _e(__('Cód de seguridad', 'qaroni-pagos')); ?>">
		<div class=" tdc-logos">
			<img src="<?php echo plugins_url('qaroni-pagos/public/img/qaroni-pagos-visa-mastercard.png'); ?>" class="qaroni-pagos-img" alt="Número de Tarjeta" style="margin-top: 10px;">
		</div>
	</div>
	<div id="div_venc">
		<p class="qaroni-pagos-form--txt-help"><?php _e(__('Fecha de vencimiento', 'qaroni-pagos')); ?></p>
		<select id="exp_month" class="qaroni-pagos-form--select qaroni-pagos-form--exp-month" name="exp_month" tabindex="6">
			<option value="-1"><?php _e(__('Mes', 'qaroni-pagos')); ?></option>
			<?php
			$months = [
				'01',
				'02',
				'03',
				'04',
				'05',
				'06',
				'07',
				'08',
				'09',
				'10',
				'11',
				'12',
			];
			$mesActual = date('m');
			foreach ($months as $mes) {
				$selected = ($mes == $mesActual) ? 'selected' : '';
				echo '<option value="' . $mes . '" ' . $selected . '>' . $mes . '</option>';
			}
			?>
		</select>
		<select id="exp_year" class="qaroni-pagos-form--select qaroni-pagos-form--exp-year" name="exp_year" tabindex="7">
			<option value="-1" selected><?php _e(__('AÑO', 'qaroni-pagos')); ?></option>
			<?php
			/**
			 * for ($y = date('Y'); $y <= date('Y') + 10; $y++)
			 * Utilizar la funcion date limita el uso de tarjetas
			 * emitidas en el año en curso del sistema operativo,
			 * con un rango de 10 años se asegura el uso de tarjetas vijentes.
			 */
			$x = date('Y');
			for ($y = 2022; $y <= 2022 + 10; $y++) {
				$selected = ($y == $x) ? 'selected' : '';
				echo '<option value="' . $y . '" ' . $selected . '>' . $y . '</option>';
			}
			?>
		</select>
	</div>
	<div class="qaroni-pagos-copy qaroni-pagos-text-center">
		<p class="qaroni-pagos-form--txt-help">
			<?php _e(__('Está transacción sera procesada de forma segura gracias a la plataforma de', 'qaroni-pagos')); ?>
		</p>
		<img src="<?php echo plugins_url('qaroni-pagos/public/img/qaroni-pagos.png'); ?>" class="qaroni-pagos-img" alt="Instapago Banesco">
	</div>
</div>
