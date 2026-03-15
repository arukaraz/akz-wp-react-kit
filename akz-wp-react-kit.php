<?php

declare(strict_types=1);

/**
 * @link              https://github.com/arukaraz/akz-wp-react-kit
 * @since             1.0.0
 * @package           Akz_Wp_React_Kit
 *
 * @wordpress-plugin
 * Plugin Name:       AKZ WP React Kit
 * Description:       A starter template to build React-powered WordPress plugins.
 * Version:           1.0.0
 * Author:            @arukaraz
 * Author URI:        https://github.com/arukaraz
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       akz-wp-react-kit
 * Requires at least: 6.4
 * Requires PHP:      8.0
 * Update URI:        false
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'AKZ_WP_REACT_KIT_PATH', plugin_dir_path( __FILE__ ) );
define( 'AKZ_WP_REACT_KIT_URL', plugin_dir_url( __FILE__ ) );
define( 'AKZ_WP_REACT_KIT_VERSION', '1.0.0' );
define( 'AKZ_WP_REACT_KIT_PLUGIN_NAME', 'akz-wp-react-kit' );
define( 'AKZ_WP_REACT_KIT_OPTION_NAME', 'akz-wp-react-kit' );

function akz_wp_react_kit_activate(): void {
	require_once AKZ_WP_REACT_KIT_PATH . 'includes/class-activator.php';
	Akz_Wp_React_Kit_Activator::activate();
}

function akz_wp_react_kit_deactivate(): void {
	require_once AKZ_WP_REACT_KIT_PATH . 'includes/class-deactivator.php';
	Akz_Wp_React_Kit_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'akz_wp_react_kit_activate' );
register_deactivation_hook( __FILE__, 'akz_wp_react_kit_deactivate' );

require AKZ_WP_REACT_KIT_PATH . 'includes/main.php';

function akz_wp_react_kit_run(): void {
	$plugin = new Akz_Wp_React_Kit();
	$plugin->run();
}
akz_wp_react_kit_run();
