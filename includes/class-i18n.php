<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName -- Legacy naming convention

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Internationalization functionality.
 *
 * @since      1.0.0
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/includes
 */
class Akz_Wp_React_Kit_I18n {

	/**
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain(): void {
		load_plugin_textdomain(
			'akz-wp-react-kit',
			false,
			dirname( plugin_basename( __FILE__ ), 2 ) . '/languages/'
		);
	}
}
