<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.shibbir.dev
 * @since      1.0.0
 *
 * @package    Shibbircore
 * @subpackage Shibbircore/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Shibbircore
 * @subpackage Shibbircore/admin
 * @author     Shibbir Ahmed <shibbir.me@gmail.com>
 */
class Shibbircore_Admin {

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
		 * defined in Shibbircore_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shibbircore_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/shibbircore-admin.css', array(), $this->version, 'all' );

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
		 * defined in Shibbircore_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shibbircore_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/shibbircore-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function register_menu() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Shibbircore_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shibbircore_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		add_menu_page( __( 'Shibbir Core', 'shibbircore' ), __('Theme Core', 'shibbircore'), 'manage_options', 'shibbir-core-page', array( $this, 'register_menu_callback'));

	}

	public function register_menu_callback() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/theme-core.php';
	}

	public function register_shortocde() {
		add_shortcode( 'membership_level', array( $this, 'membership_level_callback') );
	}

	public function membership_level_callback( $atts ) {

		$a = shortcode_atts( array(
			'level' => 0
		), $atts );
		
		$level = isset( $atts['level'] ) ? $atts['level'] : '';
		
		$level_features = get_post_meta( $level, 'choose_membership_features');
		$data = '';
		$data .= "<ul>";
		foreach( $level_features[0] as $feature ) {
			$data .= "<li>$feature</li>";
		}
		$data .= "</ul>";
		return $data;
		
	}

	public function shibbir_create_new_user( $record, $ajax_handler ) {

		//make sure its our form
		$form_name = $record->get_form_settings( 'form_name' );

		// Replace MY_FORM_NAME with the name you gave your form
		if ( 'Create New User' !== $form_name ) {
			return;
		}

		$raw_fields = $record->get( 'fields' );
		$fields = [];
		foreach ( $raw_fields as $id => $field ) {
			$fields[ $id ] = $field['value'];
		}

		$fitness_goal 	= $fields['fitness_goal'];
		$age 			= $fields['age'];
		$workout 		= $fields['workout'];
		$workout_long 	= $fields['workout_long'];
		$workout_fav 	= $fields['workout_fav'];
		$fitness_extra 	= $fields['fitness_extra'];
		$supplements 	= $fields['supplements'];
		$email 			= $fields['email'];
		$password 		= $fields['password'];

		$user = wp_create_user( $email, $password, $email); 

		// echo '<pre>';
		// print_r( $user );
		// echo '</pre>';
		// die();

		if (is_wp_error($user)){ // if there was an error creating a new user
			$ajax_handler->add_error_message("Failed to create new user: ".$user->get_error_message()); //add the message
			$ajax_handler->is_success = false;
			return;
		}

		add_user_meta( $user, 'fitness_goal', $fitness_goal);
		add_user_meta( $user, 'age', $age);
		add_user_meta( $user, 'workout', $workout);
		add_user_meta( $user, 'workout_long', $workout_long);
		add_user_meta( $user, 'workout_fav', $workout_fav);
		add_user_meta( $user, 'fitness_extra', $fitness_extra);
		add_user_meta( $user, 'supplements', $supplements);

	}
	
	public function disable_gutenberg() {
		return false;
	}

	public function remove_admin_menu_for_users() { 

		if( ! current_user_can('manage_options') ) {
			remove_menu_page( 'edit.php' );
			remove_menu_page( 'tools.php' );
			remove_menu_page( 'edit-comments.php' );
			remove_menu_page( 'edit.php?post_type=dt_workouts' );
			remove_menu_page( 'edit.php?post_type=dt_headers' );
			remove_menu_page( 'edit.php?post_type=dt_footers' );
			remove_menu_page( 'edit.php?post_type=dt_mega_menus' );
			remove_menu_page( 'edit.php?post_type=dt_galleries' );
			remove_menu_page( 'vc-welcome' );
		}
	}

	public function shibbir_remove_screen_options() {
		if(!current_user_can('manage_options')) {
			return false;
		} else {
			return true; 
		}
	}

	public function create_customer_page() {
		add_menu_page(
			__( 'My Customer', '' ),
			'My Customer',
			'read',
			'my-customer',
			array( $this, 'create_customer_page_callback'),
		);
	}

	public function create_customer_page_callback() {
		echo do_shortcode( "[affiliate_area]" );
	}

	public function hide_admin_bar() {
		return false;
	}


}
