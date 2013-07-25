<?php

/*
	SUPERCHARGED WP-CONFIG.PHP

	All useful wordpress globals in a wp-config.php, ready for a new project. Set your variables and just remove what you don't need.

	author: Alexandre Plennevaux _ alexandre@pixeline.be _ http://pixeline.be

	read the doc: http://codex.wordpress.org/Editing_wp-config.php


*/


/*
	MEMORY ALLOCATED TO WORDPRESS _ useful if your site shows many 500 errors and when allowing heavy file uploads. default : 32M
*/
define('WP_MEMORY_LIMIT', '256M');

// Increase memory in the admin area specifically
define('WP_MAX_MEMORY_LIMIT', '256M');


/*
	SWITCH BETWEEN YOUR DEV AND YOUR PRODUCTION SERVER _ damn useful.
*/
define('CURRENT_SERVER','live');

switch(CURRENT_SERVER){

case 'dev':

	// DEVELOPMENT SERVER. OPTIMIZE FOR DEBUGGING

	define('WP_CACHE', false);
	define('WP_DEBUG', true);
	define('WP_POST_REVISIONS', false );
	define('AUTOSAVE_INTERVAL', 150); // in seconds
	define('EMPTY_TRASH_DAYS', 7); // in days (use 0 to disable trash)
	/*
		The SAVEQUERIES definition saves the database queries to an array and that array can be displayed to help analyze those queries. The information saves each query, what function called it, and how long that query took to execute. See http://codex.wordpress.org/Editing_wp-config.php on how to use it.
	*/
	define('SAVEQUERIES', false);

	$customer['dbname']= 'DATABASE_NAME';
	$customer['dbuser']='DATABASE_USER';
	$customer['pass']='DB_PASSWORD';
	$customer['dbhost']='localhost';

	$customer['db_prefix']  = 'cstmr_';  // default wp_ again. Don't make it too easy for hackers to know you're using wordpress.
	$customer['cookie_domain'] = 'customer.dev';
	$customer['wp_home'] = 'http://'.$customer['cookie_domain'];
	$customer['wp_siteurl'] = 'http://'.$customer['cookie_domain'];

	break;

case 'live':

	// PRODUCTION SERVER. OPTIMIZE FOR SPEED.
	define('WP_CACHE', true);
	define('WP_DEBUG', false);

	// authors will be able to go back up to X earlier versions of their posts if they need to.
	define('WP_POST_REVISIONS', 2);
	define('AUTOSAVE_INTERVAL', 150); // in seconds
	define('EMPTY_TRASH_DAYS', 7); // in days (use 0 to disable trash)

	$customer['dbname']= 'DATABASE_NAME';
	$customer['dbuser']='DATABASE_USER';
	$customer['pass']='DB_PASSWORD';
	$customer['dbhost'] ='localhost';
	$customer['db_prefix']  = 'cstmr_';

	$customer['cookie_domain'] = 'customer.com';
	$customer['wp_home'] = 'http://'.$customer['cookie_domain'];
	$customer['wp_siteurl'] = 'http://'.$customer['cookie_domain'];

	/*
		On some webhosting configurations, Wordpress automatic updates fail. Try the FTP method should work.
		If still a no-go, see: http://codex.wordpress.org/Editing_wp-config.php#Override_of_default_file_permissions for alternative methods.
	*/

	define('FS_METHOD', 'ftpext');
	define('FTP_USER', 'YOUR FTP LOGIN');
	define('FTP_PASS', 'YOUR FTP PASSWORD');
	define('FTP_HOST', 'YOUR FTP HOST (without http:// or ftp://)');
	define('FTP_SSL', false);
	break;
}

/*
	WORDPRESS DATABASE CONNECTION PARAMETERS _
*/
define('DB_NAME', $customer['dbname']);
define('DB_USER', $customer['dbuser']);
define('DB_PASSWORD', $customer['pass']);
define('DB_HOST', $customer['dbhost']);

/*
	WORDPRESS HOME URLS _ (no need to make these changeable via WP-ADMIN.)
*/
define('WP_HOME', $customer['wp_home']);
define('WP_SITEURL', $customer['wp_siteurl']);

/*
		The domain set in the cookies for WordPress can be specified for those with unusual domain setups. One reason is if subdomains are used to serve static content. To prevent WordPress cookies from being sent with each request to static content on your subdomain you can set the cookie domain to your non-static domain only.
	*/
define('COOKIE_DOMAIN', $customer['cookie_domain']);

/*
	WORDPRESS CHARACTER SET _
*/
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');


/*
	WORDPRESS INTERNAL FOLDER STRUCTURE _ useful to make it less obvious to prying eyes that your site is using wordpress.
*/

/*
	Moving wp-content folder
*/
define( 'WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/wp-content' );
define( 'WP_CONTENT_URL', WP_SITEURL.'/wp-content');
/*
	Moving plugins folder
*/
define( 'WP_PLUGIN_DIR', $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins' );
define( 'WP_PLUGIN_URL', WP_SITEURL.'/wp-content/plugins');
// For compatibility with old plugins.
define( 'PLUGINDIR',  WP_PLUGIN_DIR );

/*
	Moving uploads folder
*/
define( 'UPLOADS', '/blog/wp-content/uploads' );


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'put something here');
define('SECURE_AUTH_KEY',  'put something here');
define('LOGGED_IN_KEY',    'put something here');
define('NONCE_KEY',        'put something here');
define('AUTH_SALT',        'put something here');
define('SECURE_AUTH_SALT', 'put something here');
define('LOGGED_IN_SALT',   'put something here');
define('NONCE_SALT',       'put something here');
/**#@-*/

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = $customer['db_prefix'];

/**
 WORDPRESS USERS' LANGUAGE _ Default is 'en_EN'
 */

define('WPLANG', 'fr_FR');

// Useful to localize the global php environment, not just wordpress functions.
setlocale(LC_ALL, 'fr_FR');


// Faster administration area by disabling Javascript Concatenation
define( 'CONCATENATE_SCRIPTS', false );


/*
	ERROR LOGGING _
 */

if (WP_DEBUG) {
	error_reporting(E_ALL | E_WARNING |  E_ERROR);
	// display errors
	@ini_set('log_errors','Off');
	@ini_set('display_errors','On');
	define('WP_DEBUG_LOG', false);
	define('WP_DEBUG_DISPLAY', true);
}else{
	error_reporting(E_WARNING | E_ERROR);
	// log errors in a file (wp-content/debug.log), don't show them to end-users.
	@ini_set('log_errors','On');
	@ini_set('display_errors','Off');
	define('WP_DEBUG_LOG', true);
	define('WP_DEBUG_DISPLAY', false);
}

/*  -------------------------- STOP EDITING PAST THIS POINT  --------------------- */


/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');