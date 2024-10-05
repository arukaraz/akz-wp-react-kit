<?php // phpcs:ignore Class file names should be based on the class name with "class-" prepended.
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The parent class of all api class of this plugin.
 *
 
 * @since      1.0.0
 *
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/includes/api
 */

/**
 * The common variables and methods of api of the plugin.
 *
 * Define namespace, version and other common properties and methods.
 *
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/includes/api
 */
if ( ! class_exists( 'Akz_Wp_React_Kit_Api' ) ) {

	/**
	 * Akz_Wp_React_Kit_Api
	 *
	 * @package Akz_Wp_React_Kit
	 * @since 1.0.1
	 */
	class Akz_Wp_React_Kit_Api extends WP_REST_Controller {

		/**
		 * Rest route namespace.
		 *
		 * @var Akz_Wp_React_Kit_Api
		 */
		public $namespace = 'akz-wp-react-kit/';

		/**
		 * Rest route version.
		 *
		 * @var Akz_Wp_React_Kit_Api
		 */
		public $version = 'v1';

		/**
		 * Whether the controller supports batching.
		 *
		 * @since 1.0.0
		 * @var array
		 */
		protected $allow_batch = array( 'v1' => true );

		/**
		 * Table name.
		 *
		 * @var string
		 */
		public $type;

		/**
		 * Constructor
		 *
		 * @since    1.0.0
		 */
		public function __construct() {}

		/**
		 * Initialize the class
		 */
		public function run() {
			/*Custom Rest Routes*/
			add_action( 'rest_api_init', array( $this, 'register_routes' ) );
		}

		/**
		 * Gets an instance of this object.
		 * Prevents duplicate instances which avoid artifacts and improves performance.
		 *
		 * @static
		 * @access public
		 * @return object
		 * @since 1.0.1
		 */
		public static function get_instance() {
			// Store the instance locally to avoid private static replication.
			static $instance = null;

			// Only run these methods if they haven't been ran previously.
			if ( null === $instance ) {

				$instance = new self();
			}

			// Always return the instance.
			return $instance;
		}

		/**
		 * Throw error on object clone
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @access public
		 * @return void
		 * @since 1.0.0
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'akz-wp-react-kit' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @access public
		 * @return void
		 * @since 1.0.0
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'akz-wp-react-kit' ), '1.0.0' );
		}
	}
}
