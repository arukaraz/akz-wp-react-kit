<?php
/**
 * This file is utilized by WordPress to show plugin information in the admin panel,
 *  manages the inclusion of required dependencies, sets up activation and deactivation hooks,
 *  and defines the primary function to initialize the plugin
 
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

 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin path.
 * Current plugin url.
 * Current plugin version.
 * Current plugin name.
 * Current plugin option name.
 */
define( 'AKZ_WP_REACT_KIT_PATH', plugin_dir_path( __FILE__ ) );
define( 'AKZ_WP_REACT_KIT_URL', plugin_dir_url( __FILE__ ) );
define( 'AKZ_WP_REACT_KIT_VERSION', '1.0.0' );
define( 'AKZ_WP_REACT_KIT_PLUGIN_NAME', 'akz-wp-react-kit' );
define( 'AKZ_WP_REACT_KIT_OPTION_NAME', 'akz-wp-react-kit' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-activator.php
 */
function akz_wp_react_kit_activate() {
	require_once AKZ_WP_REACT_KIT_PATH . 'includes/class-activator.php';
	Akz_Wp_React_Kit_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-deactivator
 */
function akz_wp_react_kit_deactivate() {
	require_once AKZ_WP_REACT_KIT_PATH . 'includes/class-deactivator.php';
	Akz_Wp_React_Kit_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'akz_wp_react_kit_activate' );
register_deactivation_hook( __FILE__, 'akz_wp_react_kit_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require AKZ_WP_REACT_KIT_PATH . 'includes/main.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function akz_wp_react_kit_run() {

	$plugin = new Akz_Wp_React_Kit();
	$plugin->run();
}
akz_wp_react_kit_run();
