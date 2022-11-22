<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'aluradb' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'JTk=Wfti%MueN,P25`Zbd$T!PuC_`V~a$:hn8j[p%r@4rIX*O[ &F<+s.,Z<evBG' );
define( 'SECURE_AUTH_KEY',  'iR4Yi!lL8,MxEr@-~R3tM@Ur%<>^1d-3q2<Y/f9xlH)UP~*wot6M:5i4d@4zrEK)' );
define( 'LOGGED_IN_KEY',    'MXWQ)JV/AYt:b?GUR9%>@g=m`>a64S#`[/D!C<=-N!P#cU*!I/u9Hg(kab=cKn~E' );
define( 'NONCE_KEY',        'l;ji5zF]a9kX{9)jYwA#jT1OUI~l=RJfLE*4F6ix>2-}`^/if59*8,{6N#~p9MR@' );
define( 'AUTH_SALT',        '4B7YOG/96v]48W`Z|SY8e*hm?@&c!(qrSA(UcO+b8~/bCz`%vnR/AN.;rQZH*}a=' );
define( 'SECURE_AUTH_SALT', '6eBr41TLVZ*Y0E66*~<oeBcZ2{mJX/mfm=WQQTvSw/.)c`efZ!<rX2PNaVl+*X|i' );
define( 'LOGGED_IN_SALT',   'W?P3;UgK^w9;rV3ww+W }|75M7Rp>I2C6jHepI3OD2qI`4gKV+Y, XtO|r+mZOpK' );
define( 'NONCE_SALT',       'fCdYf8N*T:2:F;8H.:u?Dd#?oG]^i])K8M?`[deu&NO7yES4TF,ql&~]oCvm3C*K' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
