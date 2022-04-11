<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.shibbir.dev
 * @since      1.0.0
 *
 * @package    Shibbircore
 * @subpackage Shibbircore/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Shibbircore
 * @subpackage Shibbircore/public
 * @author     Shibbir Ahmed <shibbir.me@gmail.com>
 */
class Shibbircore_Public {

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
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/shibbircore-public.css', array(), $this->version, 'all' );

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
		 * defined in Shibbircore_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shibbircore_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/shibbircore-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'handle',
			array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			)
		);

	}

	public function remove_woo_menu_items( $menu_links ) {
		$user = wp_get_current_user();

		
		// remove follwoings page from the trainer account
		if ( in_array( 'trainer', (array) $user->roles ) ) {

			unset( $menu_links['subscriptions'] ); 
			unset( $menu_links['orders'] ); 
			unset( $menu_links['downloads'] ); 
			unset( $menu_links['edit-address'] ); 
			unset( $menu_links['payment-methods'] ); 
			
		}
		// we will hook "womanide-forum" later
		$new = array( 
			'my-customer' 		=>	'My Customer',
			'videos'			=>	'Vidoes',
			'membership-plan'	=>	'Membership Plan',
			'report'			=>	'Report',
			'forum'				=>	'Forum',
		);

		$menu_links = array_slice( $menu_links, 0, 1, true ) + $new + array_slice( $menu_links, 1, NULL, true );
		
		// echo '<pre>';
		// print_r( $menu_links );
		// echo '</pre>';

		// echo '<pre>';
		// print_r( $menu_links );
		// print_r( in_array( 'trainer', (array) $user->roles ) );
		// echo '</pre>';

		return $menu_links;
	}

	public function my_custom_flush_rewrite_rules() {
		flush_rewrite_rules();
	}

	public function my_custom_query_vars($vars) {
		$vars[] = 'my-customer';
		$vars[] = 'videos';
		$vars[] = 'Membership Plan';
		$vars[] = 'Report';
		$vars[] = 'Forum';
		return $vars;
	}

	public function my_custom_endpoints() {
		add_rewrite_endpoint( 'my-customer', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'videos', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'membership-plan', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'report', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'forum', EP_ROOT | EP_PAGES );
	}

	public function my_customer_endpoint() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/my-customer.php';
	}

	public function my_video_endpoint() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/videos.php';
	}

	public function my_membership_plan_endpoint() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-shibbircore-function.php';
		$function = new Shibbir_Core_Function();
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/membership-plan.php';
	}

	public function my_report_endpoint() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/report.php';
	}

	public function remove_admin_bar() {
		if (!current_user_can('administrator') && !is_admin()) {
		    show_admin_bar(true);
		}
	}

	public function auto_apply_coupon() {
		// Auto apply coupon to all product
		$coupon_code = 'flat50'; 
		if ( WC()->cart->has_discount( $coupon_code ) ) return;
		WC()->cart->apply_coupon( $coupon_code );
		wc_print_notices();
	}

	public function show_admin_bar_callback() {
		return false;
	}

	public function shibbir_woo_locate_template( $template, $template_name, $template_path ) {
		$basename = basename( $template );
		if( $basename == 'dashboard.php' ) {
			$template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/myaccount/dashboard.php';
		}
		return $template;
	}

	public function update_level_feature() {

		if ( ! isset( $_POST['update_level_feature_nonce'] )  || ! wp_verify_nonce( $_POST['update_level_feature_nonce'], 'update_level_feature_action' ) ) {
			return false;
		}
		if( ! is_user_logged_in() ) {
			return false;
		}

		$messages = [];
		$output = [];
		$output['success'] = false;

		$level_feature = $_POST['level_feature'];

		if( empty( $level_feature ) ) {
			$messages[] = 'Plese select level feature';
			$output['success'] = false;
		}
		
		if( !empty( $messages ) ) {
			foreach( $messages as $message ) {
				$output['message'][] = $message;
			}
		} else {
			$output['success'] = true;
			$output['message'] = 'Successfully Updated';



		}

		echo json_encode( $output );
		wp_die();
	}

	public function shibbir_woocommerce_account_content() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/user-account.php';
	}

}
