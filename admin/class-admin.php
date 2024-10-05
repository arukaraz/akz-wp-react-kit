<?php // phpcs:ignore Class file names should be based on the class name with "class-" prepended.
// Exit if accessed directly.
if (! defined('ABSPATH')) {
	exit;
}

/**
 * The admin-specific functionality of the plugin.
 *
 
 * @since      1.0.0
 *
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/admin
 */
class Akz_Wp_React_Kit_Admin
{

	/**
	 * Menu info.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $menu_info    Admin menu information.
	 */
	private $menu_info;

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
	 * Add Admin Page Menu page.
	 *
	 * @access public
	 *
	 * @since    1.0.0
	 */
	public function add_admin_menu()
	{

		$white_label     = akz_wp_react_kit_include()->get_white_label();
		$this->menu_info = $white_label['admin_menu_page'];

		add_menu_page(
			$this->menu_info['page_title'],
			$this->menu_info['menu_title'],
			'manage_options',
			$this->menu_info['menu_slug'],
			array($this, 'add_setting_root_div'),
			'dashicons-admin-plugins',
			$this->menu_info['position'],
		);
	}

	/**
	 * Add Root Div For React.
	 *
	 * @access public
	 *
	 * @since    1.0.0
	 */
	public function add_setting_root_div()
	{
		echo '<div id="' . esc_attr(AKZ_WP_REACT_KIT_PLUGIN_NAME) . '"></div>';
	}

	/**
	 * Register the CSS/JavaScript Resources for the admin area.
	 *
	 * @access public
	 * Use Condition to Load it Only When it is Necessary
	 *
	 * @since    1.0.0
	 */
	public function enqueue_resources()
	{

		$screen              = get_current_screen();
		$admin_scripts_bases = array('toplevel_page_' . AKZ_WP_REACT_KIT_PLUGIN_NAME);
		if (! (isset($screen->base) && in_array($screen->base, $admin_scripts_bases, true))) {
			return;
		}

		/*Scripts dependency files*/
		$deps_file = AKZ_WP_REACT_KIT_PATH . 'build/admin/admin.asset.php';

		/*Fallback dependency array*/
		$dependency = array();
		$version    = AKZ_WP_REACT_KIT_VERSION;

		/*Set dependency and version*/
		if (file_exists($deps_file)) {
			$deps_file  = require $deps_file;
			$dependency = $deps_file['dependencies'];
			$version    = $deps_file['version'];
		}

		wp_enqueue_script(AKZ_WP_REACT_KIT_PLUGIN_NAME, AKZ_WP_REACT_KIT_URL . 'build/admin/admin.js', $dependency, $version, true);
		wp_enqueue_style(AKZ_WP_REACT_KIT_PLUGIN_NAME, AKZ_WP_REACT_KIT_URL . 'build/admin/admin.css', array('wp-components'), $version);

		/* Localize */
		$localize = apply_filters(
			'akz_wp_react_kit_admin_localize',
			array(
				'version'     => $version,
				'root_id'     => AKZ_WP_REACT_KIT_PLUGIN_NAME,
				'nonce'       => wp_create_nonce('wp_rest'),
				'plugin_page_name' => AKZ_WP_REACT_KIT_PLUGIN_NAME,
				'rest_url'    => get_rest_url(),
				'white_label' => akz_wp_react_kit_include()->get_white_label(),
			)
		);

		wp_set_script_translations(AKZ_WP_REACT_KIT_PLUGIN_NAME, AKZ_WP_REACT_KIT_PLUGIN_NAME);
		wp_localize_script(AKZ_WP_REACT_KIT_PLUGIN_NAME, 'AkzWpReactKitLocalize', $localize);
	}

	/**
	 * Get settings schema
	 * Schema: http://json-schema.org/draft-04/schema#
	 *
	 * Add your own settings fields here
	 *
	 * @access public
	 *
	 * @since 1.0.0
	 *
	 * @return array settings schema for this plugin.
	 */
	public function get_settings_schema()
	{
		$setting_properties = apply_filters(
			'akz_wp_react_kit_options_properties',
			array(
				'sample-setting'  => array(
					'type' => 'string',
				),
			),
		);

		return array(
			'type'       => 'object',
			'properties' => $setting_properties,
		);
	}

	/**
	 * Register settings.
	 * Common callback function of rest_api_init and admin_init
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_settings()
	{
		$defaults = akz_wp_react_kit_default_options();

		register_setting(
			'akz_wp_react_kit_settings_group',
			AKZ_WP_REACT_KIT_OPTION_NAME,
			array(
				'type'         => 'object',
				'default'      => $defaults,
				'show_in_rest' => array(
					'schema' => $this->get_settings_schema(),
				),
			)
		);
	}
}

if (! function_exists('akz_wp_react_kit_admin')) {
	/**
	 * Return instance of  Akz_Wp_React_Kit_Admin class
	 *
	 * @since 1.0.0
	 *
	 * @return Akz_Wp_React_Kit_Admin
	 */
	function akz_wp_react_kit_admin()
	{ //phpcs:ignore
		return Akz_Wp_React_Kit_Admin::get_instance();
	}
}
