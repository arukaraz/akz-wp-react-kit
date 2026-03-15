<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName -- Legacy naming convention

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Common functionality shared between admin and public areas.
 *
 * @since      1.0.0
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/includes
 */
class Akz_Wp_React_Kit_Include {

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

	/**
	 * @param string $key
	 * @return array<string, mixed>|string|false
	 */
	public function get_settings( string $key = '' ): array|string|false {
		static $cache = null;
		if ( ! $cache ) {
			$cache = akz_wp_react_kit_get_options();
		}
		if ( ! empty( $key ) ) {
			return isset( $cache[ $key ] ) ? $cache[ $key ] : false;
		}

		return $cache;
	}

	/**
	 * @return array<string, mixed>
	 */
	public function get_white_label(): array {
		static $cache = null;
		if ( ! $cache ) {
			$cache = akz_wp_react_kit_get_white_label();
		}

		return $cache;
	}
}

if ( ! function_exists( 'akz_wp_react_kit_include' ) ) {
	/**
	 * @since 1.0.0
	 * @return Akz_Wp_React_Kit_Include
	 */
	function akz_wp_react_kit_include(): Akz_Wp_React_Kit_Include { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid -- Prefixed helper
		return Akz_Wp_React_Kit_Include::get_instance();
	}
}
