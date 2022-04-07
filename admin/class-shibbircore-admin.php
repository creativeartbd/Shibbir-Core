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
		echo 'Hello';
	}

	public function register_shortocde() {
		add_shortcode( 'gym_registration', array( $this, 'gym_registration_callback') );
	}

	public function gym_registration_callback() {
		ob_start();
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/registration.php';
		return ob_get_clean();
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

		// echo '<pre>';
		// 	print_r($raw_fields);
		// 	print_r($fields);
		// 	//print_r( $record );
		// 	//print_r( $ajax_handler );
		// echo '</pre>';
	}

	public function remove_dashboard_widgets() {
		global $wp_meta_boxes;
		if (!current_user_can('manage_options')) {
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

			remove_meta_box( 'e-dashboard-overview', 'dashboard', 'normal');
		}
	}

	public function remove_admin_bar() {
		if (!current_user_can('administrator') && !is_admin()) {
		    show_admin_bar(false);
		}
	}
}
