<?php

declare(strict_types=1);

/**
 * @package Akz_Wp_React_Kit
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'akz_wp_react_kit_default_options' ) ) :
	/**
	 * @since 1.0.0
	 * @return array<string, mixed>
	 */
	function akz_wp_react_kit_default_options(): array {
		$default_options = array(
			'sample_setting' => 'changeme',
		);

		return apply_filters( 'akz_wp_react_kit_default_options', $default_options );
	}
endif;

if ( ! function_exists( 'akz_wp_react_kit_get_options' ) ) :
	/**
	 * @since 1.0.0
	 * @param string $key
	 * @return mixed
	 */
	function akz_wp_react_kit_get_options( string $key = '' ): mixed {
		$options = get_option( AKZ_WP_REACT_KIT_OPTION_NAME );

		$default_options = akz_wp_react_kit_default_options();

		if ( ! empty( $key ) ) {
			if ( isset( $options[ $key ] ) ) {
				return $options[ $key ];
			}
			return isset( $default_options[ $key ] ) ? $default_options[ $key ] : false;
		} else {
			if ( ! is_array( $options ) ) {
				$options = array();
			}

			return array_merge( $default_options, $options );
		}
	}
endif;

if ( ! function_exists( 'akz_wp_react_kit_update_options' ) ) :
	/**
	 * @since 1.0.0
	 * @param string|array<string, mixed> $key_or_data
	 * @param mixed $val
	 */
	function akz_wp_react_kit_update_options( string|array $key_or_data, mixed $val = '' ): void {
		if ( is_string( $key_or_data ) ) {
			$options                   = akz_wp_react_kit_get_options();
			$options[ $key_or_data ] = $val;
		} else {
			$options = $key_or_data;
		}
		update_option( AKZ_WP_REACT_KIT_OPTION_NAME, $options );
	}
endif;

if ( ! function_exists( 'akz_wp_react_kit_file_system' ) ) {
	/**
	 * @since 1.0.0
	 * @return \WP_Filesystem_Base|null
	 */
	function akz_wp_react_kit_file_system(): ?\WP_Filesystem_Base {
		global $wp_filesystem;
		if ( ! $wp_filesystem ) {
			require_once ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'file.php';
		}

		WP_Filesystem();
		return $wp_filesystem;
	}
}

if ( ! function_exists( 'akz_wp_react_kit_get_white_label' ) ) :
	/**
	 * @since 1.0.0
	 * @param string $key
	 * @return mixed
	 */
	function akz_wp_react_kit_get_white_label( string $key = '' ): mixed {
		$options = apply_filters(
			'akz_wp_react_kit_white_label',
			array(
				'admin_menu_page' => array(
					'page_title' => esc_html__( 'Akz Wp React Kit', 'akz-wp-react-kit' ),
					'menu_title' => esc_html__( 'Akz Wp React Kit', 'akz-wp-react-kit' ),
					'menu_slug'  => AKZ_WP_REACT_KIT_PLUGIN_NAME,
					'icon_url'   => AKZ_WP_REACT_KIT_URL . 'assets/img/logo-20-20.png',
					'position'   => null,
				),
			),
		);
		if ( ! empty( $key ) ) {
			return $options[ $key ];
		}

		return $options;
	}
endif;
