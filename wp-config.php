<?php

/*
	SUPERCHARGED WP-CONFIG.PHP

	All useful wordpress globals in a wp-config.php, ready for a new project. Set your variables and just remove what you don't need.

	author: Alexandre Plennevaux _ alexandre@pixeline.be
	
	read the doc: http://codex.wordpress.org/Editing_wp-config.php


*/


/*
	MEMORY ALLOCATED TO WORDPRESS _ useful if your site shows many 500 errors and when allowing heavy file uploads. default : 32M
*/
define('WP_MEMORY_LIMIT', '256M');
setlocale(LC_ALL, 'fr_FR');



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
	define('SAVEQUERIES', true);

	$customer['dbname']= 'DATABASE NAME';
	$customer['dbuser']='DATABASE USER';
	$customer['pass']='DB PASSWORD';
	$customer['dbhost']='localhost';

	$customer['db_prefix']  = 'cstmr_';  // default wp_ again. Don't make it too easy for hackers to know you're using wordpress.
	$wp_home = 'http://dev.example.com';
	$wp_siteurl = 'http://dev.example.com';

	/*
		On some webhosting configurations, Wordpress automatic updates fail. Try the FTP method should work.
	*/

	define('FS_METHOD', 'ftpext');
	define('FTP_USER', 'YOUR FTP LOGIN');
	define('FTP_PASS', 'YOUR FTP PASSWORD');
	define('FTP_HOST', 'YOUR FTP HOST (without http:// or ftp://)');
	define('FTP_SSL', false);
	break;

case 'live':

	// PRODUCTION SERVER. OPTIMIZE FOR SPEED.
	define('WP_CACHE', true);
	define('WP_DEBUG', false);
	define('WP_POST_REVISIONS', 2);
	define('SAVEQUERIES', false);

	$customer['dbname']= 'DATABASE NAME';
	$customer['dbuser']='DATABASE USER';
	$customer['pass']='DB PASSWORD';
	$customer['dbhost'] ='localhost';
	$customer['db_prefix']  = 'cstmr_';

	$wp_home = 'http://www.example.com';
	$wp_siteurl = 'http://www.example.com';
	/*
		On some webhosting configurations, Wordpress automatic updates fail. Try the FTP method should work.
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
define('WP_HOME', $wp_home);
define('WP_SITEURL', $wp_siteurl);

/*
		The domain set in the cookies for WordPress can be specified for those with unusual domain setups. One reason is if subdomains are used to serve static content. To prevent WordPress cookies from being sent with each request to static content on your subdomain you can set the cookie domain to your non-static domain only.
	*/
define('COOKIE_DOMAIN', 'example.com');

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
define( 'WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/blog/wp-content' );
define( 'WP_CONTENT_URL', 'http://example/blog/wp-content');
/*
	Moving plugins folder
*/
define( 'WP_PLUGIN_DIR', $_SERVER['DOCUMENT_ROOT'] . '/blog/wp-content/plugins' );
define( 'WP_PLUGIN_URL', 'http://example/blog/wp-content/plugins');
// For compatibility with old plugins.
define( 'PLUGINDIR',  WP_PLUGIN_DIR );

/*
	Moving uploads folder
*/
define( 'UPLOADS', '/blog/wp-content/uploads' );


/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
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

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = $customer['db_prefix'];

/**
 WORDPRESS USERS' LANGUAGE _ Default is 'en_EN'
 */

define('WPLANG', 'fr_FR');


/*
		AUTOSAVE INTERVAL
	*/
define('AUTOSAVE_INTERVAL', 160 );

// Faster administration area by disabling Javascript Concatenation
define( 'CONCATENATE_SCRIPTS', false );


/*
	ERROR LOGGING _
 */

if (WP_DEBUG) {

	// Log file is in wp-content/debug.log
	error_reporting(E_ALL | E_WARNING |  E_ERROR);
	define('WP_DEBUG_LOG', true);
	define('WP_DEBUG_DISPLAY', true);
	@ini_set('display_errors',1);
}


/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');