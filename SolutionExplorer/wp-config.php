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
define( 'DB_NAME', 'solutionexplorerdb' );

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
define( 'AUTH_KEY',         'Uppp+.2)A(!!/@_sN]3$9YbiE~0-AAK7MhKGu@8pT_Ft~P-qT?GA;4I,^]GfOW8-' );
define( 'SECURE_AUTH_KEY',  '=~`_|>EF6K%]w-xmZY:EDW Sh~wG1=zQ2#|v#J~][XRc#|6<acVEdT@0*Z~N?U;8' );
define( 'LOGGED_IN_KEY',    '_C|KU-C)$|4$k0EoTTlHK-JC1nUTk?g3,?@A;j(0wBt_H_NTygDeAFKA5sRh,I.#' );
define( 'NONCE_KEY',        'hWdufV TA ltJgln%!}[H}:NCM&fAcbkF+(y4X%}X[,R~:(5E{&+K9M}V}AU__&f' );
define( 'AUTH_SALT',        'MEqpc<<*vANvG<7g!>&o:|fd}>nJ:D694yO,]6Fi2?MaOIrx5seDO-S=-t`.2u/I' );
define( 'SECURE_AUTH_SALT', '9)xpNm!A::!|OcKx4z8z3Kf[narlT|neh4:h4?,buOa||GUXDE.5R4.t4]5Q!B;8' );
define( 'LOGGED_IN_SALT',   '?DPAHbFa|ek/4Vr%CSM-zN+#HTEXXP.50Gx1D4lUZU>KI?,*}E@cRW;;Y}l166*l' );
define( 'NONCE_SALT',       'e]eR@D,F@i,{/aHJV/gHI2L*}0$$A,_P>]8DgZz>u9/>A9Qeq)cz+Ys&sqKWa?kA' );

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
