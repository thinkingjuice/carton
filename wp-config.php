<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

 /** Add all of the composer stuff **/
 require_once('vendor/autoload.php');

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// TO DO: Make this a bit nicer.
if(strpos($_SERVER['SCRIPT_NAME'], 'wp-admin/install.php')){
	echo '<div class="ftc-intall">';
	echo '<h1>Thanks for using Juicebox!</h1><p>It is alot of fun, and is designed to give a developer a tested Wordpress stack that can be built upon as soon as this setup is run!<br><br>Enjoy, and any feedback, drop an email to <a href="mailto:hello@friendsthatcode.co.uk">hello@friendsthatcode.co.uk</a><br></p>';
	echo '<p>We have hidden the error Wordpress normally throws here, as you have not yet done the key step in your local dev setup.<br><br>Create a database & user that matches the details you gave in the setup earlier, make sure the permissions are correct, and <a href="">reload this page.</a><br><br>Note: If you forgot your creds, you can find them in your .env file.</p>';
	echo '</div>';
	echo '<style>#logo a {background-image:url("https://avatars3.githubusercontent.com/u/16834865?s=300&v=4")!important;height: 95px!important;width:200px!important;background-size:contain!important;}.ftc-intall h1, .ftc-intall p, .ftc-intallul{display:block!important;}#error-page h1, #error-page p, #error-page ul{display:none;}.wp-core-ui .ftc-intall {display: none;}</style>';
}

/**
 * DEFINE DB
 */
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASS']);
define('DB_HOST', $_ENV['DB_HOST']);
define('WP_SITEURL', $_ENV['WP_SITE'] . '/wp');
define('WP_HOME', $_ENV['WP_SITE']);
define('WP_ENV', $_ENV['WP_ENV']);
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('WP_DEFAULT_THEME', $_ENV['WP_THEMENAME']);

/**
 * SSL ADMIN
 */
if ($_ENV['FORCE_SSL_ADMIN'] === 'true') { //dotenv returns everything as a string
    define('FORCE_SSL_ADMIN', true);
}

/**
 * Disallow file editor in CMS
 */
define( 'DISALLOW_FILE_EDIT', true );

/**
 * Disallow theme and plugin editing
 */
define( 'DISALLOW_FILE_MODS', true );

/**
 * Disable all automatic updates
 */
define( 'AUTOMATIC_UPDATER_DISABLED', true );

/**
 * DEFINE EMAIL STUFF / MANDRILL
 */
define('MANDRILL_KEY', $_ENV['MANDRILL_KEY']);
define('FROM_EMAIL', $_ENV['FROM_EMAIL']);

/**
 * AWS STUFF
 */
 define('DBI_AWS_ACCESS_KEY_ID', $_ENV['AWS_ACCESS_KEY_ID']);
 define('DBI_AWS_SECRET_ACCESS_KEY', $_ENV['AWS_SECRET_ACCESS_KEY']);

/**
 * CONTENT Locations
 */
define( 'WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/wp-content' );
define( 'WP_CONTENT_URL', $_ENV['WP_SITE'] . '/wp-content' );



/**
 * UNIQUE SALTS
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Or for a .env version - https://roots.io/salts.html
 */
 define('AUTH_KEY',         $_ENV['AUTH_KEY']);
 define('SECURE_AUTH_KEY',  $_ENV['SECURE_AUTH_KEY']);
 define('LOGGED_IN_KEY',    $_ENV['LOGGED_IN_KEY']);
 define('NONCE_KEY',        $_ENV['NONCE_KEY']);
 define('AUTH_SALT',        $_ENV['AUTH_SALT']);
 define('SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT']);
 define('LOGGED_IN_SALT',   $_ENV['LOGGED_IN_SALT']);
 define('NONCE_SALT',       $_ENV['NONCE_SALT']);


/**
 * DATABSE
 * Prefix your database.
 */
$table_prefix  = 'wp_';


/**
 * ERROR REPORTING
 * Set to false for live deployment!
 */
define('WP_DEBUG', $_ENV['WP_DEBUG']);
define( 'WP_DEBUG_LOG', $_ENV['WP_DEBUG_LOG']);
define( 'WP_DEBUG_DISPLAY', $_ENV['WP_DEBUG_DISPLAY']);
if ($_ENV['ERROR_REPORTING'] == 'true') {
	error_reporting(E_ERROR);
}

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
