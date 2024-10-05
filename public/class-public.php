<?php // phpcs:ignore Class file names should be based on the class name with "class-" prepended.
// Exit if accessed directly.
if (! defined('ABSPATH')) {
	exit;
}
/**
 * The public-facing functionality of the plugin.
 *
 
 * @since      1.0.0
 *
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/public
 * @author     @arukaraz 
 */
class Akz_Wp_React_Kit_Public
{

	/**
	 * Gets an instance of this object.
	 * Prevents duplicate instances which avoid artifacts and improves performance.
	 *
	 * @static
	 * @access public
	 * @return object
	 * @since 1.0.0
	 */
	public static function get_instance()
	{
		// Store the instance locally to avoid private static replication.
		static $instance = null;

		// Only run these methods if they haven't been ran previously.
		if (null === $instance) {
			$instance = new self();
		}

		// Always return the instance.
		return $instance;
	}

	/**
	 * Register the JavaScript and stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_public_resources()
	{
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Akz_Wp_React_Kit_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Akz_Wp_React_Kit_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$version = AKZ_WP_REACT_KIT_VERSION;

		wp_enqueue_style(AKZ_WP_REACT_KIT_PLUGIN_NAME, AKZ_WP_REACT_KIT_URL . 'build/public/public.css', array(), $version);

		/*Scripts dependency files*/
		$deps_file = AKZ_WP_REACT_KIT_PATH . 'build/public/public.asset.php';

		/*Fallback dependency array*/
		$dependency = array();

		/*Set dependency and version*/
		if (file_exists($deps_file)) {
			$deps_file  = require $deps_file;
			$dependency = $deps_file['dependencies'];
			$version    = $deps_file['version'];
		}

		wp_enqueue_script(AKZ_WP_REACT_KIT_PLUGIN_NAME, AKZ_WP_REACT_KIT_URL . 'build/public/public.js', $dependency, $version, true);
		wp_set_script_translations(AKZ_WP_REACT_KIT_PLUGIN_NAME, AKZ_WP_REACT_KIT_PLUGIN_NAME);

		$localize = apply_filters(
			'akz_wp_react_kit_public_localize',
			array(
				'AKZ_WP_REACT_KIT_URL' => AKZ_WP_REACT_KIT_URL,
				'site_url'                        => esc_url(home_url()),
				'rest_url'                        => get_rest_url(),
				'nonce'                           => wp_create_nonce('wp_rest'),
			)
		);

		wp_add_inline_script(
			AKZ_WP_REACT_KIT_PLUGIN_NAME,
			sprintf(
				"var AkzWpReactKitLocalize = JSON.parse( decodeURIComponent( '%s' ) );",
				rawurlencode(
					wp_json_encode(
						$localize
					)
				),
			),
			'before'
		);
	}
}

if (! function_exists('akz_wp_react_kit_public')) {
	/**
	 * Return instance of  Akz_Wp_React_Kit_Public class
	 *
	 * @since 1.0.0
	 *
	 * @return Akz_Wp_React_Kit_Public
	 */
	function akz_wp_react_kit_public()
	{ //phpcs:ignore
		return Akz_Wp_React_Kit_Public::get_instance();
	}
}
