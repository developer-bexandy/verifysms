<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://bexandyrodriguez.com.ve
 * @since      1.0.0
 *
 * @package    Verifysms
 * @subpackage Verifysms/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Verifysms
 * @subpackage Verifysms/admin
 * @author     Bexandy Rodriguez <developer@bexandyrodriguez.com.ve>
 */

require_once( plugin_dir_path( __FILE__ ) .'/../vendor/autoload.php');

use Authy\AuthyApi;

class Verifysms_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Verifysms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Verifysms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/verifysms-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Verifysms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Verifysms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/verifysms-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard
	 *
	 * @since    1.0.0
	 **/
	
	public function add_verifysms_admin_setting() {

		/**
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 **/
		add_options_page( 'VERIFY SMS PAGE', 'VERIFY SMS', 'manage_options', $this->plugin_name, array($this, 'display_verifysms_settings_page') );
	}

	/**
	 * Render the settings page for this plugin.( The html file )
	 *
	 * @since    1.0.0
	 * 
	 **/
	public function display_verifysms_settings_page() {

		include_once( 'partials/verifysms-admin-display.php' );
	}

	/**
	 * Registers and Defines the necessary fields we need.
	 *
	 **/
	public function verifysms_admin_settings_save() {

		register_setting( $this->plugin_name, $this->plugin_name, array($this, 'plugin_options_validate') );

		add_settings_section('verifysms_main', 'Main Settings', array($this, 'verifysms_section_text'), 'verifysms-settings-page');

		add_settings_field('prod_api_key', 'PRODUCTION API KEY', array($this, 'verifysms_setting_key'), 'verifysms-settings-page', 'verifysms_main');

	}

	/**
	 * Displays the settings sub header
	 *
	 **/
	public function verifysms_section_text() {
		echo '<h3>Edit Twilio Verify API details</h3>';
	}

	/**
	 * Renders the sid input field
	 *
	 **/
	public function verifysms_setting_key() {
		$options = get_option($this->plugin_name);
		echo "<input id='plugin_text_string' name='$this->plugin_name[prod_api_key]' size='40' type='text' value='{$options['prod_api_key']}' />";
	}

	/**
	 * Sanitises all input fields.
	 *
	 **/
	public function plugin_options_validate($input) {
		$newinput['prod_api_key'] = trim($input['prod_api_key']);

		return $newinput;
	}

	/**
	 * Register the verify sms page for the admin area.
	 *
	 * @since    1.0.0
	 **/
	public function register_verifysms_page() {
		// Create our settings page as a submenu page.
		add_submenu_page(
			'tools.php',										//parent slug
			__( 'VERIFY SMS PAGE', $this->plugin_name ), // page title
			__( 'VERIFY SMS', $this->plugin_name ),         	// menu title
			'manage_options',                                	// capability
			$this->plugin_name,                       	// menu_slug
			array( $this, 'display_verifysms_page' )       	// callable function
		);
	}

	/**
	 * Display the verify sms page - The page we are going to be sending message from.
	 *
	 * @since    1.0.0
	 **/
	public function display_verifysms_page() {
		include_once( 'partials/verifysms-admin-page.php' );
	}

	/**
	 * Designs for displaying Notices
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var $message - String - The message we are displaying
	 * @var $status   - Boolean - its either true or false
	 **/
	public function admin_notice($message, $status = true) {
		$class =  ($status) ? 'notice notice-success' : 'notice notice-error';
		$message = __( $message, 'sample-text-domain' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}

	/**
	 * Displays Error Notices
	 *
	 * @since    1.0.0
	 * @access   private
	 **/
	public function DisplayError($message = "Aww!, there was an error.") {
		add_action( 'admin_notices', function() use($message) {
			self::admin_notice($message, false);
		} );
	}

	/**
	 * Displays Success Notices
	 *
	 * @since    1.0.0
	 * @since    1.0.0
	 **/
	public function DisplaySuccess($message = "Request Verification Sended !!") { 
		add_action( 'admin_notices', function() use($message) {
			self::admin_notice($message, true);
		} );
	}

	/**
	 * Create the function that will process the send SMS form
	 *
	 **/
	public function send_request_verification() {
		if( !isset($_POST['request_verification']) ){ return; }

		$country_code = (isset($_POST['country_code']) ) ? $_POST['country_code'] : '';
		$phone_number = (isset($_POST['phone_number']) )  ? $_POST['phone_number']  : '';
		$via = (isset($_POST['via']) ) ? $_POST['via'] : '';

		//gets our api details from the database.
		$api_details = get_option('verifysms'); #verifysms is what we use to identify our option, it can be anything

		if(is_array($api_details) AND count($api_details) != 0) {
			$PRODUCTION_API_KEY = $api_details['prod_api_key'];
		}

		try {
			/*
			$authy_api = new AuthyApi($PRODUCTION_API_KEY);
			$response = $authy_api->phoneVerificationStart($phone_number, $country_code, $via);
			if ($response->ok()) {
                self::DisplaySuccess($response->message());
            } else {
                self::DisplayError($response->errors()->message);
            }			
            */
            self::DisplaySuccess("Mensaje Enviado");
		} catch (Exception $e) {
			self::DisplayError( $e->getMessage() );
		}
	}

	public function verify_token() {
		if( !isset($_POST['verify_token']) ){ return; }

		$country_code = (isset($_POST['country_code']) ) ? $_POST['country_code'] : '';
		$phone_number = (isset($_POST['phone_number']) )  ? $_POST['phone_number']  : '';
		$via = (isset($_POST['via']) ) ? $_POST['via'] : '';
		$country_code = (isset($_POST['token']) ) ? $_POST['token'] : '';

		//gets our api details from the database.
		$api_details = get_option('verifysms'); #verifysms is what we use to identify our option, it can be anything

		if(is_array($api_details) AND count($api_details) != 0) {
			$PRODUCTION_API_KEY = $api_details['prod_api_key'];
		}

		try {
			/*
			$authy_api = new AuthyApi($PRODUCTION_API_KEY);
			$response = $authy_api->phoneVerificationStart($phone_number, $country_code, $via);
			if ($response->ok()) {
                self::DisplaySuccess($response->message());
            } else {
                self::DisplayError($response->errors()->message);
            }	
            */	
            self::DisplayError("token verificado");	
		} catch (Exception $e) {
			self::DisplayError( $e->getMessage() );
		}
	}

}
