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
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'wordpress_blog');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'wordpress_blog');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'Br45Cl0ud.!bL0G');

/** Nome do host do MySQL */
define('DB_HOST', 'mariadb');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         'SUWjBvW#O- tLTjD []KJ;yAa;/J(|Cj2BhED:q~bh)H`KSq:)ADrslxa6=J_Jsr');
define('SECURE_AUTH_KEY',  'WCsM6|T^dJbbkk1AS}yCSS<UbbvvTyJ:Tk?V7xDS5<SJ,+ 5:3=z526>y`Cu `70');
define('LOGGED_IN_KEY',    'x>F`TE4vrW#oB14Fx{%&0W^y<ulSY.F=jo }U(~YlkJ=mvYwmCL(VmAcOXI)F*MA');
define('NONCE_KEY',        '@bRuHX?Nf!.yTXa2d:CJIs}8yZk!h`bcR*naw|US}}UwjIPOSMZ,kACy}*|PXWka');
define('AUTH_SALT',        '&E_XUdF-ucoMU0_b1`:OTg>Aep:j~D]L;J9s4d/%x A.*(5;@b/X^#j^*~PMHLi.');
define('SECURE_AUTH_SALT', '4#;eR|hadcudbv32xU=e[0b!:>w~j<V ^yIxNc2y1Ivo8$@o/PiMP&.%BP;O:w^Q');
define('LOGGED_IN_SALT',   's0#){%jgm|~V&y#JmqJ@V=x&Id:P2,OHdtd5d(o/Dtq4u.u,KWI?EDOC>=;(x1Hj');
define('NONCE_SALT',       'JCL{j@8O-Y 5+UsIRbFG_?PHEln~>-Ks5i@@2k``:;T:MuGe!Wx(>V5@y]gz:Mt,');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

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
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
