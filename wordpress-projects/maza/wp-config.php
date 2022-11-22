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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'maza' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '33w-IdPPw+1Xixp@Ti=M#lbrK#{4 yyV_:V$a3d7l;BE)}W]8Iyx0.2QE=EK=A/;' );
define( 'SECURE_AUTH_KEY',  'hwT%68C6DTX6Wi#+-[c =l,F{c(i!1[aatkkfbb<0bND70Ao/p,JV5$`NF]Q?r&%' );
define( 'LOGGED_IN_KEY',    'Nu(`~q/cp{Z;{29[y> Zj0BEF!?jD.1d4 0v]-^4+Y-Y<?k$~op@g$iLv{|PDx:D' );
define( 'NONCE_KEY',        'rv{7tk:3y$#c4_v,zsZ+ole/1..flrR8+W7@p5BhMtRG%8_D %pXl|J!^<SafU1p' );
define( 'AUTH_SALT',        '<~nH8QHN(eCEr7b30:$ih&|;A-acKu<svIHB|/r&?XxV44OhmYXoLO+$s1g%Hp7B' );
define( 'SECURE_AUTH_SALT', '?-L]K$.}#P/xMcc.ydJiX!6:R<u/Yue!b)<Zd/Y*_z>%z%.drh&R:sl{MCny$<wo' );
define( 'LOGGED_IN_SALT',   'v*23)IlJ:(hVM6N}~qo*GnMG@vm;yct^ e7W E]H=m9G&AFqRM;@I`oeI&xk]d3X' );
define( 'NONCE_SALT',       'V~(rFe>vsuj)SrZU7pBA$GuJ|>0A|N!gq G_.@(<%s%KYnI2?Rs#?T(})svt&OiY' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
