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
define( 'DB_NAME', 'bd_wp_test' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'lA1cNa#T.M1y6 LcAB+w%C[3;J`by.8xynZW>X<~pfx~y[BbGAsZ?K1x|]hTMM1:' );
define( 'SECURE_AUTH_KEY',  'QSU^K)d}bie&@9nxG$xHZkYZ?ok%@KNYYs65kD|@y[`o)F+mAfdha3#5!VDd;v1b' );
define( 'LOGGED_IN_KEY',    '~M8uK:u+]-ke[R?>Hm+E(l[+M)p.:n`aXZdoD++s 27 TDZo?)OA^2l:m^3VXd*]' );
define( 'NONCE_KEY',        ':}hKQ}RN;qv#X$m0,aBA 6>=ZrNfPpVz$U1RAd`c`<7oTH QlDr>Q>9I)LVPiNNW' );
define( 'AUTH_SALT',        '+7y$HT4^@d9ek*Jn4iMliIpcOtWNpfv*~>wRK9-p`nze[U9jg_J+H}yS3-EMzh;R' );
define( 'SECURE_AUTH_SALT', ',k}*3SWl0Q_%F2N{3:+p^(69>,HhpK F+.}{n3W[gIZoWt$]iia f6{Y8CA}zG-|' );
define( 'LOGGED_IN_SALT',   'u{cX#`FQ>jk<pIk8bwCL6<nA1;aZ^2cDC-lbfGve2be /IAJRu~n,n<Fi$k20t^Z' );
define( 'NONCE_SALT',       'q0 Iw{HZb<4%UBw/i!U{it7)u0(Nf4@/V_lfq|P>T4ajXF&--T%6g3r=:ezNG/>F' );

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
