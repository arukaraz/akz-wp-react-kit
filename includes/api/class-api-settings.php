<?php // phpcs:ignore WordPress.Files.FileName.InvalidClassFileName -- Legacy naming convention

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Settings REST API endpoint.
 *
 * @package    Akz_Wp_React_Kit
 * @subpackage Akz_Wp_React_Kit/includes/api
 * @see Akz_Wp_React_Kit_Api
 */
if ( ! class_exists( 'Akz_Wp_React_Kit_Api_Settings' ) ) {

	class Akz_Wp_React_Kit_Api_Settings extends Akz_Wp_React_Kit_Api {

		public function run(): void {
			$this->type      = 'akz_wp_react_kit_api_settings';
			$this->rest_base = 'settings';

			add_action( 'rest_api_init', array( $this, 'register_routes' ) );
		}

		public function register_routes(): void {
			$namespace = $this->namespace . $this->version;

			register_rest_route(
				$namespace,
				'/' . $this->rest_base,
				array(
					array(
						'methods'             => WP_REST_Server::READABLE,
						'callback'            => array( $this, 'get_item' ),
						'args'                => array(),
						'permission_callback' => array( $this, 'get_item_permissions_check' ),
					),
					array(
						'methods'             => WP_REST_Server::EDITABLE,
						'callback'            => array( $this, 'update_item' ),
						'args'                => rest_get_endpoint_args_for_schema( $this->get_item_schema(), WP_REST_Server::EDITABLE ),
						'permission_callback' => array( $this, 'get_item_permissions_check' ),
					),
					'schema' => array( $this, 'get_public_item_schema' ),
				)
			);
		}

		/**
		 * @param \WP_REST_Request $request
		 * @return bool
		 */
		public function get_item_permissions_check( $request ): bool {
			return current_user_can( 'manage_options' );
		}

		/**
		 * @param \WP_REST_Request $request
		 * @return mixed
		 */
		public function get_item( $request ): mixed {
			$saved_options = akz_wp_react_kit_get_options();
			$schema        = $this->get_registered_schema();

			return $this->prepare_value( $saved_options, $schema );
		}

		/**
		 * @param mixed $value
		 * @param array<string, mixed> $schema
		 * @return mixed
		 */
		protected function prepare_value( mixed $value, array $schema ): mixed {
			return rest_sanitize_value_from_schema( $value, $schema );
		}

		/**
		 * @param \WP_REST_Request $request
		 * @return mixed|\WP_Error
		 */
		public function update_item( $request ): mixed {
			$schema = $this->get_registered_schema();
			$params = $request->get_params();

			if ( is_wp_error( rest_validate_value_from_schema( $params, $schema ) ) ) {
				return new \WP_Error(
					'rest_invalid_stored_value',
					sprintf(
						/* translators: %s: Property name. */
						__( 'The %s property has an invalid stored value, and cannot be updated to null.', 'akz-wp-react-kit' ),
						AKZ_WP_REACT_KIT_OPTION_NAME
					),
					array( 'status' => 500 )
				);
			}

			$sanitized_options = $this->prepare_value( $params, $schema );
			akz_wp_react_kit_update_options( $sanitized_options );

			return $this->get_item( $request );
		}

		/**
		 * @return array<string, mixed>
		 */
		protected function get_registered_schema(): array {
			static $cached_schema = null;

			if ( null !== $cached_schema ) {
				return $cached_schema;
			}

			$cached_schema = akz_wp_react_kit_admin()->get_settings_schema();

			return $cached_schema;
		}

		/**
		 * @return array<string, mixed>
		 */
		public function get_item_schema(): array {
			$schema = array(
				'$schema'    => 'http://json-schema.org/draft-04/schema#',
				'title'      => $this->type,
				'type'       => 'object',
				'properties' => $this->get_registered_schema()['properties'],
			);

			$schema = apply_filters( "rest_{$this->type}_item_schema", $schema );

			$this->schema = $schema;

			return $this->add_additional_fields_schema( $this->schema );
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

/**
 * @since 1.0.0
 * @return Akz_Wp_React_Kit_Api_Settings
 */
function akz_wp_react_kit_api_settings(): Akz_Wp_React_Kit_Api_Settings { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid -- Prefixed helper
	return Akz_Wp_React_Kit_Api_Settings::get_instance();
}
akz_wp_react_kit_api_settings()->run();
