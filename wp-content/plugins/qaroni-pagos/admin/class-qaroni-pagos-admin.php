<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Qaroni-Pagos
 * @subpackage Qaroni-Pagos/admin
 * @author     Qaroni <contact@qaroni.com>
 */
class Qaroni_Pagos_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        error_log('Plugin Name: ' . $this->plugin_name);
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Qaroni_Pagos_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Qaroni_Pagos_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/qaroni-pagos-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Qaroni_Pagos_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Qaroni_Pagos_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/qaroni-pagos-admin.js', array('jquery'), $this->version, false);
    }
    /**
     * Undocumented function
     *
     * @param array $links
     * @return void
     */

    public function qaroni_pagos_action_links($links)
    {
        $plugin_links = [
            '<a href="' . admin_url('admin.php?page=wc-settings&tab=checkout&section=qaroni-pagos') . '">' . __('Settings', 'qaroni-pagos') . '</a>',
        ];

        // Merge our new link with the default ones
        return array_merge($plugin_links, $links);
    }

    /**
     * Add the gateway to WC Available Gateways.
     *
     * @since 1.0.0
     *
     * @param array $methods all available WC gateways
     *
     * @return string[] $methods all WC gateways + WC_Gateway_Qaroni_Pagos_Commerce
     */
    public function add_qaroni_pagos_class($methods)
    {
        $methods[] = 'WC_Gateway_Qaroni_Pagos_Commerce';

        return $methods;
    }

    public function init_qaroni_pagos_bank_class()
    {

        require_once plugin_dir_path(dirname(__FILE__)) . 'payment/WC_Gateway_Qaroni_Pagos_Commerce.php';

        return new WC_Gateway_Qaroni_Pagos_Commerce();
    }

    public function custom_admin_notices()
    {
        if (!get_option('qaroni_pagos_keyid') || !get_option('qaroni_pagos_public_keyid')) {
            echo '<div class="notice notice-error">
			<p>Los parámetros "keyId" y "publicKeyId" son requeridos para poder iniciar a usar qaroni-pagos.</p>
			</div>';
        }
    }

    public function add_qaroni_pagos_settings_page()
    {
        add_menu_page(
            __('qaroni-pagos Settings', 'qaroni-pagos'), // Título de la página
            __('qaroni-pagos ', 'qaroni-pagos'), // Texto del menú
            'manage_options', // Capacidad necesaria para acceder a la página
            'qaroni-pagos-settings', // Slug de la página
            [$this, 'show_qaroni_pagos_settings_page'], // Función para mostrar la página
            plugins_url('qaroni-pagos/admin/img/icon-20x20.png'), // Icono
        );
    }

    public function show_qaroni_pagos_settings_page()
    {

        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/qaroni-pagos-settings.php';
    }

    public function qaroni_pagos_settings_notice()
    {

        if (
            isset($_GET['page'])
            && 'qaroni-pagos-settings' == $_GET['page']
            && isset($_GET['settings-updated'])
            && true == $_GET['settings-updated']
        ) {
            echo '
			<div class="notice notice-success is-dismissible">
				<p>
					<strong>qaroni-pagos settings saved.</strong>
				</p>
			</div>
			';
        }
    }
    public function qaroni_pagos_settings_fields()
    {
        // I created variables to make the things clearer
        $page_slug = 'qaroni-pagos-settings';
        $option_group = 'qaroni_pagos_settings';
        //
        add_settings_section(
            'qaroni_pagos_apikeys', // section ID
            '', // title (optional)
            '', // callback function to display the section (optional)
            $page_slug
        );

        register_setting(
            $option_group,
            'qaroni_pagos_keyid',
        );

        register_setting(
            $option_group,
            'qaroni_pagos_public_keyid',
        );

        add_settings_field(
            'qaroni_pagos_keyid',
            'Key ID: ',
            [$this, 'input_text'], // function to print the field
            $page_slug,
            'qaroni_pagos_apikeys',
            [
                'label_for' => 'qaroni_pagos_keyid',
                'class' => 'hello', // for <tr> element
                'name' => 'qaroni_pagos_keyid', // pass any custom parameters
                'type' => 'text', // text, textarea, select, checkbox, radio
                'value' => get_option('qaroni_pagos_keyid')
            ]
        );

        add_settings_field(
            'qaroni_pagos_public_keyid',
            'Public Key ID: ',
            [$this, 'input_text'], // function to print the field
            $page_slug,
            'qaroni_pagos_apikeys',
            [
                'label_for' => 'qaroni_pagos_public_keyid',
                'class' => 'hello', // for <tr> element
                'name' => 'qaroni_pagos_public_keyid', // pass any custom parameters
                'type' => 'text', // text, textarea, select, checkbox, radio
                'value' => get_option('qaroni_pagos_public_keyid')
            ]
        );
    }

    // custom callback function to print field HTML
    public function input_text($args)
    {
        // print("<pre>" . print_r($options, true) . "</pre>");
        echo '<input type="' . $args['type'] . '" id="' . $args['name'] . '" class="' . $args['name'] . '" name="' . $args['name'] . '" value="' . $args['value'] . '" />';
    }
}
