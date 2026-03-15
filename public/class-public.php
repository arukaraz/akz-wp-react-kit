<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName -- Legacy naming convention

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Public-facing functionality.
 *
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/public
 */
class Akz_Wp_React_Kit_Public {

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

	public function enqueue_public_resources(): void {
		$version = AKZ_WP_REACT_KIT_VERSION;

		wp_enqueue_style( AKZ_WP_REACT_KIT_PLUGIN_NAME, AKZ_WP_REACT_KIT_URL . 'build/public.css', array(), $version );

		$deps_file  = AKZ_WP_REACT_KIT_PATH . 'build/public.asset.php';
		$dependency = array();

		if ( file_exists( $deps_file ) ) {
			$deps_file  = require $deps_file;
			$dependency = $deps_file['dependencies'];
			$version    = $deps_file['version'];
		}

		wp_enqueue_script( AKZ_WP_REACT_KIT_PLUGIN_NAME, AKZ_WP_REACT_KIT_URL . 'build/public.js', $dependency, $version, true );
		wp_set_script_translations( AKZ_WP_REACT_KIT_PLUGIN_NAME, AKZ_WP_REACT_KIT_PLUGIN_NAME );

		$localize = apply_filters(
			'akz_wp_react_kit_public_localize',
			array(
				'AKZ_WP_REACT_KIT_URL' => AKZ_WP_REACT_KIT_URL,
				'site_url'             => esc_url( home_url() ),
				'rest_url'             => get_rest_url(),
				'nonce'                => wp_create_nonce( 'wp_rest' ),
			)
		);

		wp_add_inline_script(
			AKZ_WP_REACT_KIT_PLUGIN_NAME,
			sprintf(
				"var AkzWpReactKitLocalize = JSON.parse( decodeURIComponent( '%s' ) );",
				rawurlencode( (string) wp_json_encode( $localize ) )
			),
			'before'
		);
	}
}

if ( ! function_exists( 'akz_wp_react_kit_public' ) ) {
	/**
	 * @since 1.0.0
	 * @return Akz_Wp_React_Kit_Public
	 */
	function akz_wp_react_kit_public(): Akz_Wp_React_Kit_Public { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid -- Prefixed helper
		return Akz_Wp_React_Kit_Public::get_instance();
	}
}
