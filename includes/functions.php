<?php

/**
 * Reusable functions.
 *
 * @package Akz_Wp_React_Kit
 * @since 1.0.0
 */

// Exit if accessed directly.
if (! defined('ABSPATH')) {
	exit;
}


if (! function_exists('akz_wp_react_kit_default_options')) :
	/**
	 * Get the Plugin Default Options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default Options
	 *
	 */
	function akz_wp_react_kit_default_options()
	{
		$default_theme_options = array(
			'deleteAll' => false,
		);

		return apply_filters('akz_wp_react_kit_default_options', $default_theme_options);
	}
endif;

if (! function_exists('akz_wp_react_kit_get_options')) :

	/**
	 * Get the Plugin Saved Options.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key optional option key.
	 *
	 * @return mixed All Options Array Or Options Value
	 *
	 */
	function akz_wp_react_kit_get_options($key = '')
	{
		$options = get_option(AKZ_WP_REACT_KIT_OPTION_NAME);

		$default_options = akz_wp_react_kit_default_options();

		if (! empty($key)) {
			if (isset($options[$key])) {
				return $options[$key];
			}
			return isset($default_options[$key]) ? $default_options[$key] : false;
		} else {
			if (! is_array($options)) {
				$options = array();
			}

			return array_merge($default_options, $options);
		}
	}
endif;

if (! function_exists('akz_wp_react_kit_update_options')) :
	/**
	 * Update the Plugin Options.
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $key_or_data array of options or single option key.
	 * @param string       $val value of option key.
	 *
	 * @return mixed All Options Array Or Options Value
	 *
	 */
	function akz_wp_react_kit_update_options($key_or_data, $val = '')
	{
		if (is_string($key_or_data)) {
			$options                 = akz_wp_react_kit_get_options();
			$options[$key_or_data] = $val;
		} else {
			$options = $key_or_data;
		}
		update_option(AKZ_WP_REACT_KIT_OPTION_NAME, $options);
	}
endif;

if (! function_exists('akz_wp_react_kit_file_system')) {
	/**
	 *
	 * WordPress file system wrapper
	 *
	 * @since 1.0.0
	 *
	 * @return string|WP_Error directory path or WP_Error object if no permission
	 *
	 */
	function akz_wp_react_kit_file_system()
	{
		global $wp_filesystem;
		if (! $wp_filesystem) {
			require_once ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'file.php';
		}

		WP_Filesystem();
		return $wp_filesystem;
	}
}

if (! function_exists('akz_wp_react_kit_get_white_label')) :
	/**
	 * Get white label options for this plugin.
	 *
	 * @since 1.0.0
	 * @param string $key optional option key.
	 * @return mixed All Options Array Or Options Value
	 */
	function akz_wp_react_kit_get_white_label($key = '')
	{
		$plugin_name = apply_filters(
			'akz_wp_react_kit_white_label_plugin_name',
			esc_html__('WP React Plugin Boilerplate', 'akz-wp-react-kit')
		);

		$options = apply_filters(
			'akz_wp_react_kit_white_label',
			array(
				'admin_menu_page' => array(
					'page_title' => esc_html__('Akz Wp React Kit', 'akz-wp-react-kit'),
					'menu_title' => esc_html__('Akz Wp React Kit', 'akz-wp-react-kit'),
					'menu_slug'  => AKZ_WP_REACT_KIT_PLUGIN_NAME,
					'icon_url'   => AKZ_WP_REACT_KIT_URL . 'assets/img/logo-20-20.png',
					'position'   => null,
				)
			),
		);
		if (! empty($key)) {
			return $options[$key];
		} else {
			return $options;
		}
	}
endif;
