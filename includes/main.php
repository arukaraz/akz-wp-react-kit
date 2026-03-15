<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName -- Legacy naming convention

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The core plugin class.
 *
 * @since      1.0.0
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/includes
 */
class Akz_Wp_React_Kit {

	protected Akz_Wp_React_Kit_Loader $loader;

	public function __construct() {
		$this->load_dependencies();
		$this->set_locale();
		$this->define_include_hooks();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	private function load_dependencies(): void {
		require_once AKZ_WP_REACT_KIT_PATH . 'includes/api/index.php';
		require_once AKZ_WP_REACT_KIT_PATH . 'includes/functions.php';
		require_once AKZ_WP_REACT_KIT_PATH . 'includes/class-loader.php';
		require_once AKZ_WP_REACT_KIT_PATH . 'includes/class-i18n.php';
		require_once AKZ_WP_REACT_KIT_PATH . 'includes/class-include.php';
		require_once AKZ_WP_REACT_KIT_PATH . 'admin/class-admin.php';
		require_once AKZ_WP_REACT_KIT_PATH . 'public/class-public.php';

		$this->loader = new Akz_Wp_React_Kit_Loader();
	}

	private function set_locale(): void {
		$plugin_i18n = new Akz_Wp_React_Kit_I18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	private function define_include_hooks(): void {
		$plugin_include = akz_wp_react_kit_include();
	}

	private function define_admin_hooks(): void {
		$plugin_admin = akz_wp_react_kit_admin();

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_admin_menu' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_resources', 20 );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_settings' );
	}

	private function define_public_hooks(): void {
		$plugin_public = akz_wp_react_kit_public();
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_public_resources' );
	}

	public function run(): void {
		$this->loader->run();
	}

	public function get_loader(): Akz_Wp_React_Kit_Loader {
		return $this->loader;
	}
}
