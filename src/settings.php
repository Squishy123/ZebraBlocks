<?php
/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class ZebraSettings {
	private $zebra_settings_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'zebra_settings_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'zebra_settings_page_init' ) );
    }

	public function zebra_settings_add_plugin_page() {
		add_menu_page(
			'Zebra Settings', // page_title
			'Zebra', // menu_title
			'manage_options', // capability
			'zebra-settings', // menu_slug
			array( $this, 'zebra_settings_create_admin_page' ), // function
			'dashicons-admin-generic', // icon_url
			3 // position
		);
	}

	public function zebra_settings_create_admin_page() {
		$this->zebra_settings_options = get_option( 'zebra_settings_option_name' ); ?>

		<div class="wrap">
			<h2>Zebra Settings</h2>
			<p>Zebra API Settings</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'zebra_settings_option_group' );
					do_settings_sections( 'zebra-settings-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function zebra_settings_page_init() {
		register_setting(
			'zebra_settings_option_group', // option_group
			'zebra_settings_option_name', // option_name
			array( $this, 'zebra_settings_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'zebra_settings_setting_section', // id
			'Settings', // title
			array( $this, 'zebra_settings_section_info' ), // callback
			'zebra-settings-admin' // page
		);

		add_settings_field(
			'zebra_stripe_key', // id
			'zebra_stripe_key', // title
			array( $this, 'zebra_stripe_key_callback' ), // callback
			'zebra-settings-admin', // page
			'zebra_settings_setting_section' // section
		);

		add_settings_field(
			'use_test_mode', // id
			'use test mode?', // title
			array( $this, 'use_test_mode_callback' ), // callback
			'zebra-settings-admin', // page
			'zebra_settings_setting_section' // section
		);

		add_settings_field(
			'zebra_stripe_key_dev', // id
			'zebra_stripe_key_dev', // title
			array( $this, 'zebra_stripe_key_dev_callback' ), // callback
			'zebra-settings-admin', // page
			'zebra_settings_setting_section' // section
		);

		add_settings_field(
			'zebra_host', // id
			'zebra_host', // title
			array( $this, 'zebra_host_callback' ), // callback
			'zebra-settings-admin', // page
			'zebra_settings_setting_section' // section
		);
	}

	public function zebra_settings_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['zebra_stripe_key'] ) ) {
			$sanitary_values['zebra_stripe_key'] = sanitize_text_field( $input['zebra_stripe_key'] );
		}

		if ( isset( $input['use_test_mode'] ) ) {
			$sanitary_values['use_test_mode'] = $input['use_test_mode'];
		}

		if ( isset( $input['zebra_stripe_key_dev'] ) ) {
			$sanitary_values['zebra_stripe_key_dev'] = sanitize_text_field( $input['zebra_stripe_key_dev'] );
		}

		if ( isset( $input['zebra_host'] ) ) {
			$sanitary_values['zebra_host'] = sanitize_text_field( $input['zebra_host'] );
		}

		return $sanitary_values;
	}

	public function zebra_settings_section_info() {
		
	}

	public function zebra_stripe_key_callback() {
		printf(
			'<input class="regular-text" type="text" name="zebra_settings_option_name[zebra_stripe_key]" id="zebra_stripe_key" value="%s">',
			isset( $this->zebra_settings_options['zebra_stripe_key'] ) ? esc_attr( $this->zebra_settings_options['zebra_stripe_key']) : ''
		);
	}

	public function use_test_mode_callback() {
		printf(
			'<input type="checkbox" name="zebra_settings_option_name[use_test_mode]" id="use_test_mode" value="use_test_mode" %s> <label for="use_test_mode">Use stripe test mode?</label>',
			( isset( $this->zebra_settings_options['use_test_mode'] ) && $this->zebra_settings_options['use_test_mode'] === 'use_test_mode' ) ? 'checked' : ''
		);
	}

	public function zebra_stripe_key_dev_callback() {
		printf(
			'<input class="regular-text" type="text" name="zebra_settings_option_name[zebra_stripe_key_dev]" id="zebra_stripe_key_dev" value="%s">',
			isset( $this->zebra_settings_options['zebra_stripe_key_dev'] ) ? esc_attr( $this->zebra_settings_options['zebra_stripe_key_dev']) : ''
		);
	}

	public function zebra_host_callback() {
		printf(
			'<input class="regular-text" type="text" name="zebra_settings_option_name[zebra_host]" id="zebra_host" value="%s">',
			isset( $this->zebra_settings_options['zebra_host'] ) ? esc_attr( $this->zebra_settings_options['zebra_host']) : ''
		);
	}

}
if ( is_admin() )
	$zebra_settings = new ZebraSettings();