<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'renaissance' );

/** MySQL database username */
define( 'DB_USER', 'renaissance' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Lotus1864' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+]>ayp8yG g;-H~4!OYNN/AA+;qcUp2^^-Rm/Xgt&v XT>GS x>j3bP12w7qO7 #');
define('SECURE_AUTH_KEY',  'v9JzZ52&u2WpXs)R3lxs:{:#12;6<7Dg|>f=4i{VkO(_|Xb={5?KC@]DV&V$iWP:');
define('LOGGED_IN_KEY',    'y?!I-Q1m@@_9}uLHBm/.S-k;+9vB,6@w@-o6mw0;:`$cRRhb-_f,Y7}:cPKFi@Mu');
define('NONCE_KEY',        '(c9Vu#;|Z3D|ea&:j|]6%zjqgjqyK=rFMkX`lnH)fIbGPlTJYDgRGiIQ RO[@0.B');
define('AUTH_SALT',        'Op]vMu^;;?NQXw-qvht>e.8_QmD.?JL?O&a|vTxnV[9uob+D<wnBa 30K.n}=w]$');
define('SECURE_AUTH_SALT', '3#+}|-3GxMXpDJi U^|g#lJ^2,GP%|C@qd;kl2/Fc#CtL>pg<`AC5S14q;]6-)7P');
define('LOGGED_IN_SALT',   'Q}%U(}=<lh|^,d;ohi?(w_(V~N=dqzV[*Pi*n7-zVPu`qo!-za.4dbk;2ay9{m+{');
define('NONCE_SALT',       'F5+P.lb85xYBi<l-{y~ElVb-gdh8]Z45jm{B^5w+&,8l=ZV-6ICcC{Km3mmRBaRa');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
