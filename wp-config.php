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
define( 'DB_NAME', 'zu_nutrifit' );

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
define( 'AUTH_KEY',         '%/@aOr2NJRLu@%I}1QV&ZA(maSy=9+t@8FHqchyN/b3X(+P6xDBav)8y:g&-?}R&' );
define( 'SECURE_AUTH_KEY',  ')(^5LvSH<4*Sa$[TL0SZj$C5tM)`A8=[+sX#g3cauirw-sD/vv+j1~e$p.7P]t-g' );
define( 'LOGGED_IN_KEY',    'J}mXlYbhpqvTCpC0wcn&<0v#ZfS{R/x<E7/0sVd*PaE`xI[n131a@<55~9V`CdOb' );
define( 'NONCE_KEY',        '=WKK#yWR_u>Sf(;!f{ZWJ|l8 @!%U8zS]6w. }Aa1CwXEI)T11E;h7G&nX0o!0-R' );
define( 'AUTH_SALT',        'AyBUMOYqllc3B6fSyT03|^i5<8CKV=@!VdjfA1]|2#]3!A];(YlAdpJIsxCz;pvg' );
define( 'SECURE_AUTH_SALT', '9#L8V1/(VEj?HKaZ)$K6M1cxD)&NTF?=1M5q=ugJ|4 ~(CuP4>Wk yQ|2HRylT>`' );
define( 'LOGGED_IN_SALT',   'Q9VqVRX,Tc?Z<pZ[g/(8]Q/?`Jc2y[,m6!yytX>X~*,u+t]7jRpMP3hsVfHdl?kP' );
define( 'NONCE_SALT',       '2Kay-dsn^|4n?HSAN5TO{{2mkA;L8K%D{k7|LF!&t0HMF:t)-!Uyx)u!mvEDjW7x' );

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
