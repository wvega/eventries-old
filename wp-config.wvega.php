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
define('DB_NAME', 'eventries');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '<ah}5Z]>%`]j_ ,5%K<4kHNc(^xa:lo_1Z` 4hk_L>shfy}SEHBo?;O%CMPgJf_p');
define('SECURE_AUTH_KEY',  '+iKVb2nxy|~I-[snSm6B=ay%4yV=4Ap`DnzyR($RMDZnx_Nv#M0n+|U49b8S,(R#');
define('LOGGED_IN_KEY',    'c|oM3&5*Xi-aIUK7yu_fFiqY2VD$bYN3fK6s#w`>)+`PK`^Mm-JQ5Nj@pdM|!/.i');
define('NONCE_KEY',        ';:v#(7F_=N{ZYu}-(8&9@g-L/|iZB^BA17y} w%_c+#.6A%4r)-WGA8)KUU1O%>c');
define('AUTH_SALT',        '-:p(avGF?8$$sC7d$r9SAd$Ouj=xf#S!qfMrW#9VkZWIp-LC=Lz-SsA:B/N_?<g5');
define('SECURE_AUTH_SALT', 'bDwo|M$4:H65Ss+,[V#b0V}O}-hS^4zD%-`4[n/0?LPGz F<:5Ppyh;a+`P}Aii/');
define('LOGGED_IN_SALT',   '=7,rtbKujH0spnX,WhOra2bE_j,*0zA9.oh=?O`Qt y5o%|pzuLMFAc4BpjU;yo~');
define('NONCE_SALT',       'Bq20n%W#9X(5R[fnr&,.XjgM7rb96qTkSf,fa`_G?Q7q++E@ 49_DYi&w-_LzuXj');

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
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
