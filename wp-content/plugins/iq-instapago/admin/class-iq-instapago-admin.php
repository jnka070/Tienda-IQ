<?php

use Automattic\WooCommerce\Utilities\FeaturesUtil;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    IQ-Instapago
 * @subpackage IQ-Instapago/admin
 * @author     IQ <contact@iqtsystems.com>
 */

 
class IQ_Instapago_Admin
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
         * defined in IQ_Instapago_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The IQ_Instapago_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/iq-instapago-admin.css', array(), $this->version, 'all');
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
         * defined in IQ_Instapago_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The IQ_Instapago_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/iq-instapago-admin.js', array('jquery'), $this->version, false);
    }
    /**
     * Undocumented function
     *
     * @param array $links
     * @return void
     */

    public function iq_instapago_action_links($links)
    {
        $plugin_links = [
            '<a href="' . admin_url('admin.php?page=wc-settings&tab=checkout&section=iq-instapago') . '">' . __('Settings', 'iq-instapago') . '</a>',
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
     * @return string[] $methods all WC gateways + WC_Gateway_IQ_Instapago_Commerce
     */
    public function add_iq_instapago_class($methods)
    {
        $methods[] = 'WC_Gateway_IQ_Instapago_Commerce';

        return $methods;
    }

    public function init_iq_instapago_bank_class()
    {

        require_once plugin_dir_path(dirname(__FILE__)) . 'payment/WC_Gateway_IQ_Instapago_Commerce.php';

        return new WC_Gateway_IQ_Instapago_Commerce();
    }

    public function custom_admin_notices()
    {
        if (!get_option('iq_instapago_keyid') || !get_option('iq_instapago_public_keyid')) {
            echo '<div class="notice notice-error">
			<p>Los parámetros "keyId" y "publicKeyId" son requeridos para poder iniciar a usar iq-instapago.</p>
			</div>';
        }
    }

    public function add_iq_instapago_settings_page()
    {
        add_menu_page(
            __('Insta Web Settings', 'iq-instapago'), // Título de la página
            __('Insta Web', 'iq-instapago'), // Texto del menú
            'manage_options', // Capacidad necesaria para acceder a la página
            'iq-instapago-settings', // Slug de la página
            [$this, 'show_iq_instapago_settings_page'], // Función para mostrar la página
            plugins_url('iq-instapago/admin/img/icon-20x20.png'), // Icono
        );
    }

    public function show_iq_instapago_settings_page()
    {

        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/iq-instapago-settings.php';
    }

    public function iq_instapago_settings_notice()
    {

        if (
            isset($_GET['page'])
            && 'iq-instapago-settings' == $_GET['page']
            && isset($_GET['settings-updated'])
            && true == $_GET['settings-updated']
        ) {
            echo '
			<div class="notice notice-success is-dismissible">
				<p>
					<strong>iq-instapago settings saved.</strong>
				</p>
			</div>
			';
        }
    }
    public function iq_instapago_settings_fields()
    {
        // I created variables to make the things clearer
        $page_slug = 'iq-instapago-settings';
        $option_group = 'iq_instapago_settings';
        //
        add_settings_section(
            'iq_instapago_apikeys', // section ID
            '', // title (optional)
            '', // callback function to display the section (optional)
            $page_slug
        );

        register_setting(
            $option_group,
            'iq_instapago_keyid',
        );

        register_setting(
            $option_group,
            'iq_instapago_public_keyid',
        );

        add_settings_field(
            'iq_instapago_keyid',
            'Key ID: ',
            [$this, 'input_text'], // function to print the field
            $page_slug,
            'iq_instapago_apikeys',
            [
                'label_for' => 'iq_instapago_keyid',
                'class' => 'hello', // for <tr> element
                'name' => 'iq_instapago_keyid', // pass any custom parameters
                'type' => 'text', // text, textarea, select, checkbox, radio
                'value' => get_option('iq_instapago_keyid')
            ]
        );

        add_settings_field(
            'iq_instapago_public_keyid',
            'Public Key ID: ',
            [$this, 'input_text'], // function to print the field
            $page_slug,
            'iq_instapago_apikeys',
            [
                'label_for' => 'iq_instapago_public_keyid',
                'class' => 'hello', // for <tr> element
                'name' => 'iq_instapago_public_keyid', // pass any custom parameters
                'type' => 'text', // text, textarea, select, checkbox, radio
                'value' => get_option('iq_instapago_public_keyid')
            ]
        );
    }

    // custom callback function to print field HTML
    public function input_text($args)
    {
        // print("<pre>" . print_r($options, true) . "</pre>");
        echo '<input type="' . $args['type'] . '" id="' . $args['name'] . '" class="' . $args['name'] . '" name="' . $args['name'] . '" value="' . $args['value'] . '" />';
    }

    public function instapago_gateway_cart_checkout_blocks_compatibility(): void {

        $path =  WP_PLUGIN_DIR.'/iq-instapago';
        if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
            FeaturesUtil::declare_compatibility(
                'cart_checkout_blocks',
                $path,
                true // true (compatible, default) or false (not compatible)
            );

            FeaturesUtil::declare_compatibility(
                'custom_order_tables',
                $path,
                true
            );
        }

    }

    public function instapago_gateway_block_support(): void {

        // here we're including our "gateway block support class"
        require_once WP_PLUGIN_DIR.'/iq-instapago/support/class-wc-instapago-gateway-blocks-support.php';

        // registering the PHP class we have just included
        add_action(
            'woocommerce_blocks_payment_method_type_registration',
            function ( Automattic\WooCommerce\Blocks\Payments\PaymentMethodRegistry $payment_method_registry ) {
                $payment_method_registry->register( new WC_IQ_Instapago_Gateway_Blocks_Support );
            }
        );

    }
}
