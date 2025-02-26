<?php

/**
 * 
 * @link              https://iqtsystems.com/
 * @since             1.0.0
 * @package           iq-instapago
 * @author     		  IQ <contact@iqtsystems.com>
 * 
 * @wordpress-plugin
 * Plugin Name:       Insta Web
 * Plugin URI:        https://iqtsystems.com/
 * Description:       Plugin de pagos para Instapago
 * Version:           1.0.0
 * Author:            IQ
 * Author URI:        https://iqtsystems.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       iq-instapago
 * Domain Path:       /languages
 * 
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'IQ_INSTAPAGO_VERSION', '1.0.0' );

function activate_iq_instapago() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-iq-instapago-activator.php';
    IQ_Instapago_Activator::activate();
}

function deactivate_iq_instapago() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-iq-instapago-deactivator.php';
    IQ_Instapago_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_iq_instapago' );
register_deactivation_hook( __FILE__, 'deactivate_iq_instapago' );

require plugin_dir_path( __FILE__ ) . 'includes/class-iq-instapago.php';

function run_iq_instapago() {
    $plugin = new IQ_Instapago();
    $plugin->run();
}

run_iq_instapago();