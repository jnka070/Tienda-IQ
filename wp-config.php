<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Tienda-Qaroni' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ALsSWHc9C7JSgXx3C6N8RVBr1YMC3mPNrGNb9byGkYCSGWkxw0guef5tjgceao3b' );
define( 'SECURE_AUTH_KEY',  'V3ydB6sInpX9mNkhTIqdQ3yi0xzplcojGRl9j3ax0O0TJZdG77LVA2o6TX99RgwD' );
define( 'LOGGED_IN_KEY',    'RwdD55Mxrc6ErN5pi4RvWNS29ldGJpgoyJgomHgOW1Utl5Hhv2Pc66K6i21LEKZU' );
define( 'NONCE_KEY',        '6tWG9SFhYTKwsLUaK4h8lptrCmT0dq010Y1hXO7aKplcI35XlzJJNpjhTZsvBJVP' );
define( 'AUTH_SALT',        'OH0Rz34mn5GVMeuUqyxE61vzMA4TXHJdlY1qTX2sBw86KgsybI2S6xT9qSOTyi4O' );
define( 'SECURE_AUTH_SALT', '1nt71U6Cz8wgGYzZQa7I3ImxqQUku1jjJg5jKbQzu1Iw3WZW6B2058OjDft9NGYd' );
define( 'LOGGED_IN_SALT',   'yPkR61lounnmZ9ERujRmFVc6WIjHx1iZjvVqUVjAEI36Ush0jnqfAtop7SqVtreQ' );
define( 'NONCE_SALT',       'evIofhZwcgGH6bIh73qOvHJhroRlnQfa8ByzmjcnEZ7nM6ZahbVQp6FeQzcjYPjM' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

