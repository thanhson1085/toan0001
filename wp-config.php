<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'toan0001');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'buithu');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '!B[^@{:~YIggr^y_4$bLqaK`ssi TK|IC%`GV:l!}b/?-qw>*?/-svu|y}8=c-jS');
define('SECURE_AUTH_KEY',  '$p ?TqwAj_0btody.Di_0Hk^Y!<iU%=ouU=J<2:k>A0-<I7+zm;]SeLKy|]#G-%f');
define('LOGGED_IN_KEY',    '!bdsM,<JS[Vi`qLd1* ?`6%FH:1U50f?s-PCzT6I)^@rE+=Zz6-VGmP!$F--,5jx');
define('NONCE_KEY',        '`1^LVbOj5+Vp[(hU4,Of;[zmDcI)1#1-%2#(PKMQF#])BM>X0#o3w|k..8hTF8$g');
define('AUTH_SALT',        '@~d[l%;xxhYms%W$JnogB?IJ6kqg>uA+Bg56-:3u&^-,VA[(*}|qZ8`1}>ka$kSY');
define('SECURE_AUTH_SALT', ')P<]j|VboPSLgBq9fA]!C}*^^9zr[vLui%EhGap0z.2+v+>}d+ShHEiY,d;_vr}-');
define('LOGGED_IN_SALT',   '&i?z=[$AI1a-3]/Vx(S;LL~Ozerb|b(gQdQtm`u;![+G=!okVq-Znr$12w3CP:V&');
define('NONCE_SALT',       '%vp=  I)lh{<m9EVo?8$vcfp|aw_~<(<N}a1pG}(ZW2Q]M%Smv.k6}FZy#rrx!.m');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

