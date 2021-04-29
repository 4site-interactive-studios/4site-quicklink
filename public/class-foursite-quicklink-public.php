<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.4sitestudios.com
 * @since      1.0.0
 *
 * @package    Foursite_Quicklink
 * @subpackage Foursite_Quicklink/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Foursite_Quicklink
 * @subpackage Foursite_Quicklink/public
 * @author     4Site Studios <hosting@4sitestudios.com>
 */
class Foursite_Quicklink_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Foursite_Quicklink_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Foursite_Quicklink_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'quicklink', 'https://unpkg.com/quicklink', false, $this->version, false );
		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/foursite-quicklink-public.js', array( 'quicklink' ), $this->version, false );

	}

	/**
	 * Register the Inline JavaScript.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_inline_scripts() {
		$foursite_quicklink_settings_options = get_option( 'foursite_quicklink_settings_option_name' ); // Array of All Options
		$element = empty($foursite_quicklink_settings_options['element']) ? 'document.body' : $foursite_quicklink_settings_options['element']; // Element
		$delay = empty($foursite_quicklink_settings_options['delay']) ? 0 : $foursite_quicklink_settings_options['delay']; // Delay
		$limit = empty($foursite_quicklink_settings_options['limit']) ? 'Infinity' : $foursite_quicklink_settings_options['limit']; // Limit
		$throttle = empty($foursite_quicklink_settings_options['throttle']) ? 'Infinity' : $foursite_quicklink_settings_options['throttle']; // Throttle
		$timeout = empty($foursite_quicklink_settings_options['timeout']) ? 2000 : $foursite_quicklink_settings_options['timeout']; // Timeout
		$priority = empty($foursite_quicklink_settings_options['priority']) ? 'false' : 'true'; // Priority
		$origins = empty($foursite_quicklink_settings_options['origins']) ? '' : $foursite_quicklink_settings_options['origins']; // Origins
		$ignores = empty($foursite_quicklink_settings_options['ignores']) ? '' : $foursite_quicklink_settings_options['ignores']; // Ignores
		$script = <<<END
		window.addEventListener('load', () => {
			quicklink.listen({
				el: {$element},
				limit: {$limit},
				delay: {$delay},
				throttle: {$throttle},
				timeout: {$timeout},
				priority: {$priority},
				origins: {$this->format_origins($origins)},
				ignores: [{$ignores}]
			});
		});
		console.log('4Site Quicklink is Running...');
		END;
		wp_add_inline_script('quicklink', $script );
	}
	public function format_origins($origins){
		if($origins === '') return '[]';
		$ret = '';
		foreach(preg_split("/((\r?\n)|(\r\n?))/", $origins) as $line){
			$ret .= "'".$line."',";
		} 
		return "[$ret]";

	}

}