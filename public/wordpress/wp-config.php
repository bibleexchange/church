<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'church');

/** MySQL database username */
define('DB_USER', 'dc_admin');

/** MySQL database password */
define('DB_PASSWORD', '50FsCwaz2oVe');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'wleC+KB)r&@S0MTt{ehQai zbgkookgcE7hw8b,JtELC~#u{}9<p(XnJ]d^+!-i[');
define('SECURE_AUTH_KEY',  'Z9;z.,BHyjys*C7~v)_gg&aE/uCL!m_!3<O,#{=n52+18 ]rJyW@p?NrU.tcB;sX');
define('LOGGED_IN_KEY',    '[}+ A#CRq4S0;Fd9Rts/<mh|)c8ATCad`B[D6 V&8Z5204{UgnKVUQV-.LtPvxho');
define('NONCE_KEY',        'w(QLNKhfpc(] Y2+wY+}GBbu6drt9?GXFQ0gQs{35Pi}83UDb|%|b)y(Vz+L`,b*');
define('AUTH_SALT',        '/$k5+qxT}mP4|*.J(G]WWC?6%mwWjf%khMOly)k0l_Z$[p3&a4}{SYO*j:,d&!X6');
define('SECURE_AUTH_SALT', 'EH>4!GCe.Re5|Yw+ct*Zm1%#}v;s*>pMJUI,ApKbjH+bNBIBt58l+jjyoT Vf-6I');
define('LOGGED_IN_SALT',   ',Ej-bel?&${>}B2#5W7%G&59=VlU7-#9S_],f20&IJ[Ff2_-^~Gh9i}u->(R j l');
define('NONCE_SALT',       'pxGstgq+GX.aEn=ER-.EVkhWD)3[5|yA+uSS}mae}-$yK}8acR}7RZ+]1ERSxJz>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
