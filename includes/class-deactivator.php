<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName -- Legacy naming convention

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fired during plugin deactivation.
 *
 * @since      1.0.0
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/includes
 */
class Akz_Wp_React_Kit_Deactivator {

	/**
	 * @since    1.0.0
	 */
	public static function deactivate(): void {
		if ( akz_wp_react_kit_get_options( 'deleteAll' ) ) {
			delete_option( AKZ_WP_REACT_KIT_OPTION_NAME );
		}
	}
}
