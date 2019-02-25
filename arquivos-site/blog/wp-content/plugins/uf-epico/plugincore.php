<?php
/**
 * @package   Uf_Epico
 * @author    Uberfácil <contato@uberfacil.com>
 * @license   GPL-2.0+
 * @link      http://uberfacil.com
 * @copyright 2014-2015 Uberfácil
 *
 * @wordpress-plugin
 * Plugin Name: Epico
 * Plugin URI:  http://www.uberfacil.com/temas/epico
 * Description: Includes advanced funcionality for the Epico theme and helps you to create you author platform on the Web with specialized widgets and shortcodes. Note: this plugin is compatible with the Epico theme only.
 * Version:     1.5.5
 * Author:      Uberfácil
 * Author URI:  http://uberfacil.com
 * Text Domain: uf-epico
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( plugin_dir_path( __FILE__ ) . 'class-uf-epico.php' );

require_once( plugin_dir_path( __FILE__ ) . '/includes/widget-epico_pop.php' );
require_once( plugin_dir_path( __FILE__ ) . '/includes/widget-epico-social.php' );
require_once( plugin_dir_path( __FILE__ ) . '/includes/widget-epico_notice.php' );
require_once( plugin_dir_path( __FILE__ ) . '/includes/widget-epico_pages.php' );
require_once( plugin_dir_path( __FILE__ ) . '/includes/widget-epico_capture_widget.php' );
require_once( plugin_dir_path( __FILE__ ) . '/includes/widget-epico_author.php' );
require_once( plugin_dir_path( __FILE__ ) . '/includes/widget-epico_image.php' );
require_once( plugin_dir_path( __FILE__ ) . '/includes/widget-epico_links.php' );

// Register hooks that are fired when the plugin is activated or deactivated.
// When the plugin is deleted, the uninstall.php file is loaded.
register_activation_hook( __FILE__, array( 'Uf_Epico', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Uf_Epico', 'deactivate' ) );

// Load instance
add_action( 'plugins_loaded', array( 'Uf_Epico', 'get_instance' ) );

// hook updater to init
add_action( 'init', 'epico_plugin_updater_init' );

// Add extra links in plugins row metadata
add_filter('plugin_row_meta', 'epico_add_plugin_page_links', 10, 2);


/**
 * Load and Activate Plugin Updater Class.
 * @since 1.0.0
 */
function epico_plugin_updater_init() {

	/* Load Plugin Updater */
	require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/epico-plugin-updater.php' );

	/* Updater Config */
	$config = array(
		'base'      => plugin_basename( __FILE__ ),
		'dashboard' => true,
		'username'  => true,
		'key'       => '',
		'repo_uri'  => 'http://minha.uberfacil.com/epico/',
		'repo_slug' => 'epico-plugin',
	);

	/* Load Updater Class */
	new Epico_Plugin_Updater( $config );
}

/**
 * Insert custom link in plugin description
 * @since 1.4.4
 */
function epico_add_plugin_page_links($links, $file){

	if ($file == 'uf-epico/plugincore.php'){

		$links[] = '<a href="https://twitter.com/uberfacil">'.__('Follow us on Twitter', 'uf-epico').'</a>';
	}
	return $links;
}
