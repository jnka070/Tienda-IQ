<?php

/**
 * Configuración de Insta Web.
 *
 * @category Admin
 *
 * @author     IQ <contact@iqtsystems.com>
 * @copyright Copyright (C) IQ <contact@iqtsystems.com> and WooCommerce
 */
if (!defined('ABSPATH')) {
	exit;
}

/*
 * Settings for Insta Web Gateway.
 */
return [
	'enabled' => [
		'title'   => __('Enable/Disable', 'iq-instapago'),
		'type'    => 'checkbox',
		'label'   => __('Habilitar Insta Web', 'iq-instapago'),
		'default' => 'no',
	],
	'title' => [
		'title'       => __('Título', 'iq-instapago'),
		'type'        => 'text',
		'description' => __('Esto controla el título que el usuario ve durante la compra.', 'iq-instapago'),
		'default'     => __('Insta Web', 'iq-instapago'),
		'desc_tip'    => true,
	],
	'description' => [
		'title'       => __('Descripción', 'iq-instapago'),
		'type'        => 'text',
		'desc_tip'    => true,
		'description' => __('Esto controla la descripción que el usuario ve durante la compra.', 'iq-instapago'),
		'default'     => __('Puedes pagar con tu tarjeta de crédito.', 'iq-instapago'),
	],
	'api_details' => [
		'title'       => __('Credenciales de la API de Instapago', 'iq-instapago'),
		'type'        => 'title',
		'description' => sprintf(__('Ingrese su <strong>keyId</strong> y <strong>publicKeyId</strong>  puede obtenerlas haciendo clic %saquí%s.', 'iq-instapago'), '<a href="https://banesco.instapago.com/Account/API" target="_blank">', '</a>'),
	],
	'api_keyId' => [
		'title'       => __('keyId', 'iq-instapago'),
		'type'        => 'text',
		'description' => __('Se encuentra en su panel de usuario en iq-instapago.com', 'iq-instapago'),
		'default'     => '',
		'desc_tip'    => true,
		'placeholder' => __('Requerido', 'iq-instapago'),
	],
	'api_publicKeyId' => [
		'title'       => __('publicKeyId', 'iq-instapago'),
		'type'        => 'text',
		'description' => __('Se encuentra en su buzón de correo.', 'iq-instapago'),
		'default'     => '',
		'desc_tip'    => true,
		'placeholder' => __('Requerido', 'iq-instapago'),
	],
	'api_debug' => [
		'title'       => __('Modo de depuración', 'iq-instapago'),
		'type'        => 'title',
		'description' => sprintf(__('Desactivar cuando terminen las pruebas de integración', 'iq-instapago')),
	],
	'debug' => [
		'title'       => __('Debug Log', 'iq-instapago'),
		'type'        => 'checkbox',
		'label'       => __('Enable logging', 'iq-instapago'),
		'default'     => 'yes',
		'description' => sprintf(__('Save Insta Web events inside <code>%s</code>', 'iq-instapago'), wc_get_log_file_path('iq-instapago')),
	],
];
