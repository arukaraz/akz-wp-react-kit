<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName -- Legacy naming convention

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fired during plugin activation.
 *
 * @since      1.0.0
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/includes
 */
class Akz_Wp_React_Kit_Activator {

	/**
	 * @since    1.0.0
	 */
	public static function activate(): void {
		add_option( AKZ_WP_REACT_KIT_OPTION_NAME, akz_wp_react_kit_default_options() );
	}
}
