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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_2223e_kms4a_linda' );

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
define( 'AUTH_KEY',         '(&O29L<YE $tVu)T,oa-&q:[,k=v<#MEu=%56dWgv:BY|_[/((9^Qba60&^B/krk' );
define( 'SECURE_AUTH_KEY',  '`qyl_G)&q5k#W8;M4A~K$[HFN_V1X6_Oosu`%&m0kjyv/5RUG-o}57vPwp}/mTc ' );
define( 'LOGGED_IN_KEY',    'kN*q1A9Jj!r/T/U y{QQf4PPPh4#m%%^<wzQ%C-|KniZ Z!ZC?;(m^ dSSb81y9h' );
define( 'NONCE_KEY',        '-i/(j;xc~@/kyMJ~7k</sh8j4J$T1^+B S:~/~1ys-t&t4h*3/B37 ~N$b1eWJQA' );
define( 'AUTH_SALT',        'p=c&I*<u-ZJ5pt3S1m)%b^Ac{qk#jn66H65:J-C1K )BL0K@cF7Km^jxf{:xW;h,' );
define( 'SECURE_AUTH_SALT', '+}FOOM0.~QX:Q[w@TY&(M6GL~DLfO.mm&`)84Olvf1MwtF6RV1#{:F[$?1tmrr,.' );
define( 'LOGGED_IN_SALT',   'v95[P^|5ATXs.R,aZI$0&BZXTcPta_- @@7/1lToC1r&xN4jQ|SusWgkOOZ&-;}Q' );
define( 'NONCE_SALT',       '`F[NA)>A:aIq0pPi/a=v/Ixx~_C[?r[vcC=&JgKUtUbg>9F^DKV55t(+4hj.3h9|' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'lin_';

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
