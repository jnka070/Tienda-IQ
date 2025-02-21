<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Qaroni Pagos
 * Plugin URI:        https://qaroni.com
 * Description:       Plugin de pagos para Qaroni
 * Version:           1.0.0
 * Author:            Qaroni
 * Author URI:        https://qaroni.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       qaroni-pagos
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'QARONI_PAGOS_VERSION', '1.0.0' );

function activate_qaroni_pagos() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-qaroni-pagos-activator.php';
    Qaroni_Pagos_Activator::activate();
}

function deactivate_qaroni_pagos() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-qaroni-pagos-deactivator.php';
    Qaroni_Pagos_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_qaroni_pagos' );
register_deactivation_hook( __FILE__, 'deactivate_qaroni_pagos' );

require plugin_dir_path( __FILE__ ) . 'includes/class-qaroni-pagos.php';

function run_qaroni_pagos() {
    $plugin = new Qaroni_Pagos();
    $plugin->run();
}

run_qaroni_pagos();