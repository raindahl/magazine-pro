<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'cl54-a-wordp-f6a');

/** MySQL database username */
define('DB_USER', 'cl54-a-wordp-f6a');

/** MySQL database password */
define('DB_PASSWORD', '3!-Ew2Ksb');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'sPWbDQI87!Bb8qZkZxdfyfOTVbDZ5#+Lv2e/nUVDpo=UWMT0Z1fdt5Kxq/rUK7ZJ');
define('SECURE_AUTH_KEY',  'HEo8rsud=o-6fclDr5#CNE-AJCmUpnFiDpehEb!nvTt5h)kaJ^iyUShTnlCllG9G');
define('LOGGED_IN_KEY',    'u(E(+fq0gllQvpe^nEpMj-A0_We##-6cUWL+UJ77mPFuETKDeG^Y+dVow(__cjcV');
define('NONCE_KEY',        'p+y=8IgEEetmaT(AEo^2vn(Vd5!!nxFM5hyCIhSvG66K+8!5nIy-2r71cDpEaovc');
define('AUTH_SALT',        'cz-t2_g982r8eWf)^=+NJgJ)KwbrILc3F2tcUtqvs76iEKxGythXZOBiP2S!L9-A');
define('SECURE_AUTH_SALT', 'kO5hC#EU(iqC!^N9mtAL1YnuwdOkOIxy+smeTYFf_TbrQtcl+WDN7NeRc1^YWg4(');
define('LOGGED_IN_SALT',   'sr)pNs3ls+uVa_d0JfsMxsW^oadII=8^^jD6VCgAcUH=QHrGlJEuU!UEI8bf03Tr');
define('NONCE_SALT',       'oZZ0VkvN/mA-Zas)!efkVA(bIIg)R#gijGP29_WSo-vglPdjrxVD2auQKO5MZndt');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/**
 *  Change this to true to run multiple blogs on this installation.
 *  Then login as admin and go to Tools -> Network
 */
define('WP_ALLOW_MULTISITE', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/* Destination directory for file streaming */
define('WP_TEMP_DIR', ABSPATH . 'wp-content/');

