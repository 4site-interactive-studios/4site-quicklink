<?php

/**
 * Settings page for the plugin
 *
 * @link       https://www.4sitestudios.com
 * @since      1.0.0
 *
 * @package    Foursite_Quicklink
 * @subpackage Foursite_Quicklink/includes
 */

/**
 * Settings for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Foursite_Quicklink
 * @subpackage Foursite_Quicklink/includes
 * @author     4Site Studios <hosting@4sitestudios.com>
 */

class Foursite_Quicklink_Settings {
	private $foursite_quicklink_settings_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'foursite_quicklink_settings_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'foursite_quicklink_settings_page_init' ) );
	}

	public function foursite_quicklink_settings_add_plugin_page() {
		add_options_page(
			'4Site Quicklink Settings', // page_title
			'4Site Quicklink', // menu_title
			'manage_options', // capability
			'4site-quicklink-settings', // menu_slug
			array( $this, 'foursite_quicklink_settings_create_admin_page' ) // function
		);
	}

	public function foursite_quicklink_settings_create_admin_page() {
		$this->foursite_quicklink_settings_options = get_option( 'foursite_quicklink_settings_option_name' ); ?>

<div class="wrap">
    <h2>4Site Quicklink Settings</h2>
    <p></p>

    <form method="post" action="options.php">
        <?php
					settings_fields( 'foursite_quicklink_settings_option_group' );
					do_settings_sections( '4site-quicklink-settings-admin' );
					submit_button();
				?>
    </form>
</div>
<?php }

	public function foursite_quicklink_settings_page_init() {
		register_setting(
			'foursite_quicklink_settings_option_group', // option_group
			'foursite_quicklink_settings_option_name', // option_name
			array( $this, 'foursite_quicklink_settings_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'foursite_quicklink_settings_setting_section', // id
			'Settings', // title
			array( $this, 'foursite_quicklink_settings_section_info' ), // callback
			'4site-quicklink-settings-admin' // page
		);

		add_settings_field(
			'element', // id
			'Element', // title
			array( $this, 'element_callback' ), // callback
			'4site-quicklink-settings-admin', // page
			'foursite_quicklink_settings_setting_section' // section
		);

		add_settings_field(
			'delay', // id
			'Delay', // title
			array( $this, 'delay_callback' ), // callback
			'4site-quicklink-settings-admin', // page
			'foursite_quicklink_settings_setting_section' // section
		);

		add_settings_field(
			'limit', // id
			'Limit', // title
			array( $this, 'limit_callback' ), // callback
			'4site-quicklink-settings-admin', // page
			'foursite_quicklink_settings_setting_section' // section
		);

		add_settings_field(
			'throttle', // id
			'Throttle', // title
			array( $this, 'throttle_callback' ), // callback
			'4site-quicklink-settings-admin', // page
			'foursite_quicklink_settings_setting_section' // section
		);

		add_settings_field(
			'timeout', // id
			'Timeout', // title
			array( $this, 'timeout_callback' ), // callback
			'4site-quicklink-settings-admin', // page
			'foursite_quicklink_settings_setting_section' // section
		);

		add_settings_field(
			'priority', // id
			'Priority', // title
			array( $this, 'priority_callback' ), // callback
			'4site-quicklink-settings-admin', // page
			'foursite_quicklink_settings_setting_section' // section
		);

		add_settings_field(
			'origins', // id
			'Origins', // title
			array( $this, 'origins_callback' ), // callback
			'4site-quicklink-settings-admin', // page
			'foursite_quicklink_settings_setting_section' // section
		);

		add_settings_field(
			'ignores', // id
			'Ignores', // title
			array( $this, 'ignores_callback' ), // callback
			'4site-quicklink-settings-admin', // page
			'foursite_quicklink_settings_setting_section' // section
		);
	}

	public function foursite_quicklink_settings_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['element'] ) ) {
			$sanitary_values['element'] = sanitize_text_field( $input['element'] );
		}

		if ( isset( $input['delay'] ) ) {
			$sanitary_values['delay'] = sanitize_text_field( $input['delay'] );
		}

		if ( isset( $input['limit'] ) ) {
			$sanitary_values['limit'] = sanitize_text_field( $input['limit'] );
		}

		if ( isset( $input['throttle'] ) ) {
			$sanitary_values['throttle'] = sanitize_text_field( $input['throttle'] );
		}

		if ( isset( $input['timeout'] ) ) {
			$sanitary_values['timeout'] = sanitize_text_field( $input['timeout'] );
		}

		if ( isset( $input['priority'] ) ) {
			$sanitary_values['priority'] = $input['priority'];
		}

		if ( isset( $input['origins'] ) ) {
			$sanitary_values['origins'] = esc_textarea( $input['origins'] );
		}

		if ( isset( $input['ignores'] ) ) {
			$sanitary_values['ignores'] = esc_textarea( $input['ignores'] );
		}

		return $sanitary_values;
	}

	public function foursite_quicklink_settings_section_info() {
		
	}

	public function element_callback() {
		printf(
			'<input class="regular-text" type="text" name="foursite_quicklink_settings_option_name[element]" id="element" value="%s">',
			isset( $this->foursite_quicklink_settings_options['element'] ) ? esc_attr( $this->foursite_quicklink_settings_options['element']) : 'document.body'
		);
	}

	public function delay_callback() {
		printf(
			'<input class="regular-text" type="text" name="foursite_quicklink_settings_option_name[delay]" id="delay" value="%s">',
			isset( $this->foursite_quicklink_settings_options['delay'] ) ? esc_attr( $this->foursite_quicklink_settings_options['delay']) : '0'
		);
	}

	public function limit_callback() {
		printf(
			'<input class="regular-text" type="text" name="foursite_quicklink_settings_option_name[limit]" id="limit" value="%s">',
			isset( $this->foursite_quicklink_settings_options['limit'] ) ? esc_attr( $this->foursite_quicklink_settings_options['limit']) : 'Infinity'
		);
	}

	public function throttle_callback() {
		printf(
			'<input class="regular-text" type="text" name="foursite_quicklink_settings_option_name[throttle]" id="throttle" value="%s">',
			isset( $this->foursite_quicklink_settings_options['throttle'] ) ? esc_attr( $this->foursite_quicklink_settings_options['throttle']) : 'Infinity'
		);
	}

	public function timeout_callback() {
		printf(
			'<input class="regular-text" type="text" name="foursite_quicklink_settings_option_name[timeout]" id="timeout" value="%s">',
			isset( $this->foursite_quicklink_settings_options['timeout'] ) ? esc_attr( $this->foursite_quicklink_settings_options['timeout']) : '2000'
		);
	}

	public function priority_callback() {
		printf(
			'<input type="checkbox" name="foursite_quicklink_settings_option_name[priority]" id="priority" value="priority" %s> <label for="priority">Whether or not the URLs within the ELEMENT container should be treated as high priority. When true, quicklink will attempt to use the fetch() API if supported (rather than link[rel=prefetch]).</label>',
			( isset( $this->foursite_quicklink_settings_options['priority'] ) && $this->foursite_quicklink_settings_options['priority'] === 'priority' ) ? 'checked' : ''
		);
	}

	public function origins_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="foursite_quicklink_settings_option_name[origins]" id="origins">%s</textarea>',
			isset( $this->foursite_quicklink_settings_options['origins'] ) ? esc_attr( $this->foursite_quicklink_settings_options['origins']) : ''
		);
	}

	public function ignores_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="foursite_quicklink_settings_option_name[ignores]" id="ignores">%s</textarea>',
			isset( $this->foursite_quicklink_settings_options['ignores'] ) ? esc_attr( $this->foursite_quicklink_settings_options['ignores']) : ''
		);
	}

}
if ( is_admin() )
	$foursite_quicklink_settings = new Foursite_Quicklink_Settings();

/* 
 * Retrieve this value with:
 * $foursite_quicklink_settings_options = get_option( 'foursite_quicklink_settings_option_name' ); // Array of All Options
 * $element = $foursite_quicklink_settings_options['element']; // Element
 * $delay = $foursite_quicklink_settings_options['delay']; // Delay
 * $limit = $foursite_quicklink_settings_options['limit']; // Limit
 * $throttle = $foursite_quicklink_settings_options['throttle']; // Throttle
 * $timeout = $foursite_quicklink_settings_options['timeout']; // Timeout
 * $priority = $foursite_quicklink_settings_options['priority']; // Priority
 * $origins = $foursite_quicklink_settings_options['origins']; // Origins
 * $ignores = $foursite_quicklink_settings_options['ignores']; // Ignores
 */