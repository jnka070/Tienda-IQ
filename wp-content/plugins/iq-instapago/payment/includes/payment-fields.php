<div class="iq-instapago-form--container">
	<div id="div_cliente">
		<input type="text" id="iq-instapago_cchname" class="iq-instapago-form--input iq-instapago-form--name" name="card_holder_name" tabindex="1" title="<?php _e(__('Nombre y Apellido', 'iq-instapago')); ?>" placeholder="<?php _e(__('Nombre y Apellido', 'iq-instapago')); ?>" autocomplete="off" maxlength="25" pattern="[A-Za-zñ ]*" oninput="this.value = this.value.replace(/[^A-Za-zñ ]/g, '');">
		<select id="iq-instapago_chid" class="iq-instapago-form--select iq-instapago-form--tipe" name="iq-instapago_chid" tabindex="2" title="<?php _e(__('Tipo de Identificación', 'iq-instapago')); ?>">
			<option value="V" selected>V</option>
			<option value="E">E</option>
			<option value="J">J</option>
			<option value="G">G</option>
		</select>
		<input type="text" id="iq-instapago_cchnameid" class="iq-instapago-form--input iq-instapago-form--cchnameid" name="user_dni" tabindex="3" placeholder="<?php _e(__('Número de Identificación', 'iq-instapago')); ?>" autocomplete="off" minlength="6" maxlength="8" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
	</div>
	<div id="div_tarjetas">
		<input type="text" id="iq-instapago_ccnum" class="iq-instapago-form--input iq-instapago-form--tdc-number" name="valid_card_number" tabindex="4" placeholder="<?php _e(__('Número de tarjeta', 'iq-instapago')); ?>" autocomplete="off" maxlength="16" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');" title="<?php _e(__('Número de tarjeta', 'iq-instapago')); ?>">
		<input type="password" id="iq-instapago_cvv" class="iq-instapago-form--input iq-instapago-form--ccv" name="cvc_code" tabindex="5" placeholder="<?php _e(__('Cód de seguridad', 'iq-instapago')); ?>" autocomplete="off" maxlength="3" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');" title="<?php _e(__('Cód de seguridad', 'iq-instapago')); ?>">
	</div>
	<p class="iq-instapago-form--txt-help"><?php _e(__('Fecha de vencimiento', 'iq-instapago')); ?></p>
	<div id="div_venc">
		<select id="exp_month" class="iq-instapago-form--select iq-instapago-form--exp-month" name="exp_month" tabindex="6">
			<option value="-1"><?php _e(__('Mes', 'iq-instapago')); ?></option>
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
		<select id="exp_year" class="iq-instapago-form--select iq-instapago-form--exp-year" name="exp_year" tabindex="7">
			<option value="-1" selected><?php _e(__('AÑO', 'iq-instapago')); ?></option>
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
	<div class="iq-instapago-visa-mastercard">
		<img src="<?php echo plugins_url('iq-instapago/public/img/iq-instapago-visa-mastercard.png'); ?>" class="iq-visa-mastercard" alt="Número de Tarjeta">
	</div>
	<!-- <div class="tdc-logos">
	</div> -->
	<div class="iq-instapago-copy iq-instapago-text-center">
		<div class="iq-instapago-text-img">
			<div class="iq-instapago-text">
				<p class="iq-instapago-form--txt-help">
					<?php _e(__('Esta transacción será procesada por Insta Web de Instapago', 'iq-instapago')); ?>
				</p>
			</div>
			<div class="iq-instapago-img-container">
				<img src="<?php echo plugins_url('iq-instapago/public/img/instapagoisotipodegrade-01.png'); ?>" class="iq-instapago-img" alt="Instapago">
			</div>
		</div>
		<p><?php _e(__('Powered By')); ?>
			<a href="https://iqtsystems.com/" target="_blank"><?php _e(__('IQ Technology Systems')) ?></a>
		</p>
	</div>
</div>