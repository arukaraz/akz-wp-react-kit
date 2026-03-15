<?php

declare(strict_types=1);

/**
 * Fired when the plugin is uninstalled.
 *
 * @since      1.0.0
 * @package    Akz_Wp_React_Kit
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'akz-wp-react-kit' );
