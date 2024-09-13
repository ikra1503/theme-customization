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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'admin_bluespace' );

/** Database username */
define( 'DB_USER', 'admin_bluespace' );

/** Database password */
define( 'DB_PASSWORD', 'B5$L(9cUp^KE' );

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
define( 'AUTH_KEY',         'Q]Hts<+d3<qE P0@xMxwu17/A0hl0UXZ{B=%iyU!imTb7r?JnTGM&.P31wG@7Y+s' );
define( 'SECURE_AUTH_KEY',  '%O6|D){;fm$EXfO)&,9-I.^zpZ*nW^@Kpd1WJ7_.XiPE3o?B^MNMEQ@g<RG_/O/J' );
define( 'LOGGED_IN_KEY',    'yuFr0}t3pK9Chr>p!109oWF?KISgqi#`D5) 7$tQ)jLZdtrQzUz$#Nn3f6WzhwST' );
define( 'NONCE_KEY',        '>~s8}6&7i#H2NK&{y)aU?)%ciTQF%_({-l>7vO& dou*{VEG99/$ Nszm_5v{ pW' );
define( 'AUTH_SALT',        'S clK[&a1!0osOnse3M RiqVA@>Y-7C/Mjo<.RX3^{mtp:H[FJ3|t suAh[2;[v*' );
define( 'SECURE_AUTH_SALT', 'd::YP;&F_@j8>&2nu`b0G=Ap.=}h,# hz:aEE?pugzP-:fM*hr2gyZ<$ya{RDaV;' );
define( 'LOGGED_IN_SALT',   '#ijOx7cAZ2gY3LvsRR7;XXPs$NBAc@GLqQ$.._1N_@6t&]jP=4Pa!]DbilWgZ@HA' );
define( 'NONCE_SALT',       'ryzzVtIhQH;&5N4+z_n07EYi)8gXXUt&T$&vZ]R#cZ@Mr5sq!NwuLP2z+7}{A-+w' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
