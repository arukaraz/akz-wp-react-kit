<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName -- Legacy naming convention

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Base REST API controller.
 *
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/includes/api
 */
if ( ! class_exists( 'Akz_Wp_React_Kit_Api' ) ) {

	class Akz_Wp_React_Kit_Api extends WP_REST_Controller {

		/**
		 * @var string
		 */
		public $namespace = 'akz-wp-react-kit/';

		/**
		 * @var string
		 */
		public $version = 'v1';

		/**
		 * @var array<string, bool>
		 */
		protected $allow_batch = array( 'v1' => true );

		/**
		 * @var string
		 */
		public string $type = '';

		public function __construct() {}

		public function run(): void {
			add_action( 'rest_api_init', array( $this, 'register_routes' ) );
		}

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
	}
}
