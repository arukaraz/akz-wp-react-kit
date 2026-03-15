<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName -- API loader file

declare(strict_types=1);

/**
 * @package Akz_Wp_React_Kit
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once trailingslashit( __DIR__ ) . 'class-api.php';
require_once trailingslashit( __DIR__ ) . 'class-api-settings.php';
