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
define( 'DB_NAME', 'fac' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '6f$Z&Y9`i.e!*r<VKq[_(1gYrLU5M}vU>Px.SUGM38)#S*~<K1lYenT(xwLgR&Jj' );
define( 'SECURE_AUTH_KEY',  'r>g~wo=U)&w^XWifqJBeO;K|*oD.oLGrV`d`zKnsh + LPuXQEUW=mQ^[51O@/@^' );
define( 'LOGGED_IN_KEY',    ')gwQJI,Jd8WPK/0mCe#;ctB=gTY{^D(<dB8kOd8``B`^$,fI4o0o*6pDZ6n=j%#%' );
define( 'NONCE_KEY',        '+L=[CDgCO$29P^puGyM<L=o[Es,RGc5T?9|A9Tk}8XlI<@tg$=I8OD~*Z1C%7NHw' );
define( 'AUTH_SALT',        'bNW2Yv:U+{5by9Ly$3(nP}Tz_h})6?-Fiq>uO+iOw@([nHG#+^aw]Edg=4dtG)S&' );
define( 'SECURE_AUTH_SALT', '$C/y6bnb;M/?TX%5nY]F&%w8}/_BZs R!cDQA{fRa?km@vY77g!nU#@RCSnKl>)5' );
define( 'LOGGED_IN_SALT',   'vayT=WX ll;d;n68Hud cZ5w^rZ}u[1xz#uOEG[m,[J3kmL;IEhf/Aa&Aau`hO A' );
define( 'NONCE_SALT',       'X|;pW&Rd]~Br_YcO&FI{.?G9u,9?hS9._`W|U0F8;|VEAI=]SvgF%)<j,,Kt?6|h' );

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
$table_prefix = 'fac_';

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
