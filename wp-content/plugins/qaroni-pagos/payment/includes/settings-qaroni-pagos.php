<?php

/**
 * Configuración de Qaroni Pagos.
 *
 * @category Admin
 *
 * @author     Qaroni <contact@qaroni.com>
 * @copyright Copyright (C) Qaroni <contact@qaroni.com> and WooCommerce
 */
if (!defined('ABSPATH')) {
	exit;
}

/*
 * Settings for Qaroni Pagos Gateway.
 */
return [
	'enabled' => [
		'title'   => __('Enable/Disable', 'qaroni-pagos'),
		'type'    => 'checkbox',
		'label'   => __('Habilitar Qaroni Pagos', 'qaroni-pagos'),
		'default' => 'no',
	],
	'title' => [
		'title'       => __('Título', 'qaroni-pagos'),
		'type'        => 'text',
		'description' => __('Esto controla el título que el usuario ve durante la compra.', 'qaroni-pagos'),
		'default'     => __('Qaroni Pagos', 'qaroni-pagos'),
		'desc_tip'    => true,
	],
	'description' => [
		'title'       => __('Descripción', 'qaroni-pagos'),
		'type'        => 'text',
		'desc_tip'    => true,
		'description' => __('Esto controla la descripción que el usuario ve durante la compra.', 'qaroni-pagos'),
		'default'     => __('Puedes pagar con tu tarjeta de crédito.', 'qaroni-pagos'),
	],
	'api_details' => [
		'title'       => __('Credenciales de la API de Instapago', 'qaroni-pagos'),
		'type'        => 'title',
		'description' => sprintf(__('Ingrese su <strong>keyId</strong> y <strong>publicKeyId</strong>  puede obtenerlas haciendo clic %saquí%s.', 'qaroni-pagos'), '<a href="https://banesco.instapago.com/Account/API" target="_blank">', '</a>'),
	],
	'api_keyId' => [
		'title'       => __('keyId', 'qaroni-pagos'),
		'type'        => 'text',
		'description' => __('Se encuentra en su panel de usuario en qaroni-pagos.com', 'qaroni-pagos'),
		'default'     => '',
		'desc_tip'    => true,
		'placeholder' => __('Requerido', 'qaroni-pagos'),
	],
	'api_publicKeyId' => [
		'title'       => __('publicKeyId', 'qaroni-pagos'),
		'type'        => 'text',
		'description' => __('Se encuentra en su buzón de correo.', 'qaroni-pagos'),
		'default'     => '',
		'desc_tip'    => true,
		'placeholder' => __('Requerido', 'qaroni-pagos'),
	],
	'api_debug' => [
		'title'       => __('Modo de depuración', 'qaroni-pagos'),
		'type'        => 'title',
		'description' => sprintf(__('Desactivar cuando terminen las pruebas de integración', 'qaroni-pagos')),
	],
	'debug' => [
		'title'       => __('Debug Log', 'qaroni-pagos'),
		'type'        => 'checkbox',
		'label'       => __('Enable logging', 'qaroni-pagos'),
		'default'     => 'yes',
		'description' => sprintf(__('Save Qaroni Pagos events inside <code>%s</code>', 'qaroni-pagos'), wc_get_log_file_path('qaroni-pagos')),
	],
];
