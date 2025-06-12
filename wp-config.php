<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'city_store' );

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
define( 'AUTH_KEY',         'kM9?v/]n9SV}&MYSdPjNrP(;Fy%:fN2d7h,q<[X;+ep*%v3MAc/8@7~u[RL5<QPF' );
define( 'SECURE_AUTH_KEY',  'h=}BF^EAXXJ=.kqB<j,mu<3=Z_D_p<, ?V{~B)t&48?V-9nX4+w8yxuOx49]sK}K' );
define( 'LOGGED_IN_KEY',    ':W%=|98AKgV(Pk~&;IdgpB)Y5UFg4SNR2bM+@3z@a[+2(cAIT]WNi~.F8}%Zyr#g' );
define( 'NONCE_KEY',        ';/4L)g(!.%nVIu3_?Z,QOoWOi#-gzKNKtY^k>3WJ8x}p&7h%w<#~0|=zO|@K?wJt' );
define( 'AUTH_SALT',        'ihA)D=4X*FBcD{qVQ|i*<r7F5%TwP$0xlU4hiYHvTVnN|+u?;.Dm5$h6(h?1e-[$' );
define( 'SECURE_AUTH_SALT', 'K*BFb8=#7C%>GT,^_w>B}kXj90ny<<pmw.GqQD9t]kb3aw-O4YTck}+zea`1{@,k' );
define( 'LOGGED_IN_SALT',   'o<b2=q8-yDUV%k|CRh]kuGQnv#<#ZtzA S{kMS22z&4Ryx&QBb?xSnx0?Avx4+I`' );
define( 'NONCE_SALT',       '9Po156GLx5+%oi@B 4hSLS#Zn8Y,:/2ywrhL`sw4|9e.V.^iI5#ZJ/g|bvH]G )#' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
