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
define( 'DB_NAME', 'francoarmellini' );

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
define( 'AUTH_KEY',         'CHogw8ygJk]bq=Cl)W7~W4)/pk*Ts9mITj|2OOb1_xI5{&`T=f?UmzBdV]>3a4lh' );
define( 'SECURE_AUTH_KEY',  'TQ>tzJ>?4BN;`zaiwquX<a9oPH3ZKs(6BAL,%s#<*M;8ICOIH3>}jbHRzTVx9Vl/' );
define( 'LOGGED_IN_KEY',    '(q<1zc}MzJ4,<vt|6U^O@_?? Pz&=QRu{K_Y?Ua,_Q_g7x<J!R|nr?um&y5im1[;' );
define( 'NONCE_KEY',        'G,(##IF/)d*I^^cgj_)y7#p2k*MU6K/R{VPEW{x53}P#C{B9$:46Pbs[ytc?9Yf6' );
define( 'AUTH_SALT',        '!n)lD=+W% ~Brm_T@ssH>7Is2l[9#bdm{0Es~+)&2czmClRDk6!(C,0,]V1N.b|V' );
define( 'SECURE_AUTH_SALT', '5Df)f2$ ocZePcJ{o4NE%{+Eyk=M:.HlkbVuR#+0B-x%kqySZ81wYpNvzEA)I-7V' );
define( 'LOGGED_IN_SALT',   '%+2v=Snh<icNDPP(ePEtL%= UI$RgX->q|:KU;~|=oO-&dVDOSM8iti<<Im([UI4' );
define( 'NONCE_SALT',       '*m+mq}RSA%uz_*>D]B;nhi;x/jcaw#:qYXuft)pl0N^ONlq7Rx;m0QC/liL:a>*;' );

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
