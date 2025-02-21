<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://qaroni.com/
 * @since      1.0.0
 *
 * @package    Qaroni-Pagos
 * @subpackage Qaroni-Pagos/admin/partials
 * @author     Qaroni <contact@qaroni.com>
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<div class="wrap">
	<h2><?php echo get_admin_page_title() ?></h2>
	<br>
	<hr>
	<form method="post" action="options.php">
		<?php
		settings_fields('qaroni_pagos_settings');
		do_settings_sections('qaroni-pagos-settings');
		submit_button();
		?>
	</form>
</div>
