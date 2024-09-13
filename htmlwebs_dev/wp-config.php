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
define( 'DB_NAME', 'admin_htmlweb' );

/** Database username */
define( 'DB_USER', 'admin_htmlweb' );

/** Database password */
define( 'DB_PASSWORD', '8Wj<=6H$X7Uy' );

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
define( 'AUTH_KEY',         'ZYl7=B&{+R,eBWeIbryN #P*IXb0w6Soe#jWR~2vji|7G?,q}w$b%<sDRDMuw~+p' );
define( 'SECURE_AUTH_KEY',  '>GpzgbciJU`Y>}O*=;kK#?|ZPkXBu#3VO;nY2)jy$Q#UiKVY^YRB@|]#B_)>_uU9' );
define( 'LOGGED_IN_KEY',    '5A=%7^8J%&-1@3m;8O3R9B2:8=}qk&D=OLu  Bv4S>nMp9)rw*]UYivx1n/Wiogj' );
define( 'NONCE_KEY',        '[$(#,uMB8 !0-v1Oo;&X`Mskn.Ba8$0Y8{RF4It|Me#8J1ML&{b[|yB0PgS2[OiC' );
define( 'AUTH_SALT',        '7{AvdW]eaezAfoJZ:pR*B-KA]8,on8NSTB#hSTF=~mr?Q8N.?6TYpnt?8o_6p(6R' );
define( 'SECURE_AUTH_SALT', '>x#<N?$P<A+:yKD|(w s{3g:|!N);$bTjtY=YZ~TOfZ+In-m#ja_8)Q.b!3j1n.v' );
define( 'LOGGED_IN_SALT',   'ne+~ZP|GzOBA>La`d=@wuw~jHnmsc!PIgH2fh.7J{+B<TA,8b^AZ6CgGm^X {wz@' );
define( 'NONCE_SALT',       'm$-jG>.ViS<~w:eD6`|>W+*l6i9hL{viHhZfc1HTFwW$JWNY^oLA&x; DQ(0)1c3' );

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
