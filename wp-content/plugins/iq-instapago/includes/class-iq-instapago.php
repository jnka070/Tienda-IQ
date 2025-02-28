<?php

class IQ_Instapago {
    
    /**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      IQ_Instapago_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('IQ_INSTAPAGO_VERSION')) {
			$this->version = IQ_INSTAPAGO_VERSION;
		} else {
			$this->version = '1.0.1';
		}
		$this->plugin_name = 'iq-instapago';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - IQ_Instapago_Loader. Orchestrates the hooks of the plugin.
	 * - IQ_Instapago_i18n. Defines internationalization functionality.
	 * - IQ_Instapago_Admin. Defines all hooks for the admin area.
	 * - IQ_Instapago_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-iq-instapago-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-iq-instapago-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-iq-instapago-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-iq-instapago-public.php';

		$this->loader = new IQ_Instapago_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the IQ_Instapago_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new IQ_Instapago_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new IQ_Instapago_Admin($this->get_plugin_name(), $this->get_version());


		$this->loader->add_action(
            'before_woocommerce_init',
            $plugin_admin,
            'instapago_gateway_cart_checkout_blocks_compatibility'
        );

        $this->loader->add_action(
            'woocommerce_blocks_loaded',
            $plugin_admin,
            'instapago_gateway_block_support'
        );

	
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
		$this->loader->add_action('plugins_loaded', $plugin_admin, 'init_iq_instapago_bank_class');

		// woocommerce hooks
		$this->loader->add_filter('woocommerce_payment_gateways', $plugin_admin, 'add_iq_instapago_class', 11);
		$this->loader->add_filter('plugin_action_links_iq_instapago/iq_instapago.php', $plugin_admin, 'iq_instapago_action_links');

		// admin notices
		// $this->loader->add_action('admin_notices', $plugin_admin, 'custom_admin_notices');
		// $this->loader->add_action('admin_notices', $plugin_admin, 'iq_instapago_settings_notice');
		// admin settings page
		// $this->loader->add_action('admin_menu', $plugin_admin, 'add_iq_instapago_settings_page');
		$this->loader->add_action('admin_init', $plugin_admin, 'iq_instapago_settings_fields');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{
		$plugin_public = new IQ_Instapago_Public($this->get_plugin_name(), $this->get_version());

		$plugin_public->enqueue_styles();
		$plugin_public->enqueue_scripts();

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since    1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since    1.0.0
	 * @return    IQ_Instapago_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since    1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}