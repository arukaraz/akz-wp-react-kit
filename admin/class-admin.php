<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName -- Legacy naming convention

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Admin-specific functionality.
 *
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/admin
 */
class Akz_Wp_React_Kit_Admin {

	/**
	 * @var array<string, mixed> $menu_info
	 */
	private array $menu_info = array();

	/**
	 * @return static
	 */
	public static function get_instance(): static {
		static $instance = null;

		if ( null === $instance ) {
			$instance = new static();
		}

		return $instance;
	}

	public function add_admin_menu(): void {
		$white_label     = akz_wp_react_kit_include()->get_white_label();
		$this->menu_info = $white_label['admin_menu_page'];

		add_menu_page(
			$this->menu_info['page_title'],
			$this->menu_info['menu_title'],
			'manage_options',
			$this->menu_info['menu_slug'],
			array( $this, 'add_setting_root_div' ),
			'dashicons-admin-plugins',
			$this->menu_info['position'],
		);
	}

	public function add_setting_root_div(): void {
		echo '<div id="' . esc_attr( AKZ_WP_REACT_KIT_PLUGIN_NAME ) . '"></div>';
	}

	public function enqueue_resources(): void {
		$screen              = get_current_screen();
		$admin_scripts_bases = array( 'toplevel_page_' . AKZ_WP_REACT_KIT_PLUGIN_NAME );
		if ( ! ( isset( $screen->base ) && in_array( $screen->base, $admin_scripts_bases, true ) ) ) {
			return;
		}

		$deps_file  = AKZ_WP_REACT_KIT_PATH . 'build/admin.asset.php';
		$dependency = array();
		$version    = AKZ_WP_REACT_KIT_VERSION;

		if ( file_exists( $deps_file ) ) {
			$deps_file  = require $deps_file;
			$dependency = $deps_file['dependencies'];
			$version    = $deps_file['version'];
		}

		wp_enqueue_script( AKZ_WP_REACT_KIT_PLUGIN_NAME, AKZ_WP_REACT_KIT_URL . 'build/admin.js', $dependency, $version, true );
		wp_enqueue_style( AKZ_WP_REACT_KIT_PLUGIN_NAME, AKZ_WP_REACT_KIT_URL . 'build/admin.css', array( 'wp-components' ), $version );

		$localize = apply_filters(
			'akz_wp_react_kit_admin_localize',
			array(
				'version'          => $version,
				'root_id'          => AKZ_WP_REACT_KIT_PLUGIN_NAME,
				'nonce'            => wp_create_nonce( 'wp_rest' ),
				'plugin_page_name' => AKZ_WP_REACT_KIT_PLUGIN_NAME,
				'rest_url'         => get_rest_url(),
				'white_label'      => akz_wp_react_kit_include()->get_white_label(),
			)
		);

		wp_set_script_translations( AKZ_WP_REACT_KIT_PLUGIN_NAME, AKZ_WP_REACT_KIT_PLUGIN_NAME );
		wp_add_inline_script(
			AKZ_WP_REACT_KIT_PLUGIN_NAME,
			sprintf(
				"var AkzWpReactKitLocalize = JSON.parse( decodeURIComponent( '%s' ) );",
				rawurlencode( (string) wp_json_encode( $localize ) )
			),
			'before'
		);
	}

	/**
	 * @return array<string, mixed>
	 */
	public function get_settings_schema(): array {
		$setting_properties = apply_filters(
			'akz_wp_react_kit_options_properties',
			array(
				'sample-setting' => array(
					'type'    => 'string',
					'default' => '',
				),
				'deleteAll'      => array(
					'type'    => 'boolean',
					'default' => false,
				),
			),
		);

		return array(
			'type'       => 'object',
			'properties' => $setting_properties,
		);
	}

	public function register_settings(): void {
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

if ( ! function_exists( 'akz_wp_react_kit_admin' ) ) {
	/**
	 * @since 1.0.0
	 * @return Akz_Wp_React_Kit_Admin
	 */
	function akz_wp_react_kit_admin(): Akz_Wp_React_Kit_Admin { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid -- Prefixed helper
		return Akz_Wp_React_Kit_Admin::get_instance();
	}
}
