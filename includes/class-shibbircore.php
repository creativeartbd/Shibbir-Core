<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.shibbir.dev
 * @since      1.0.0
 *
 * @package    Shibbircore
 * @subpackage Shibbircore/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Shibbircore
 * @subpackage Shibbircore/includes
 * @author     Shibbir Ahmed <shibbir.me@gmail.com>
 */
class Shibbircore {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Shibbircore_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'SHIBBIRCORE_VERSION' ) ) {
			$this->version = SHIBBIRCORE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'shibbircore';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		add_role( 'trainer', 'Trainer', array( 
			'read' => true, 
			// 'edit_posts' => true,
			// 'delete_posts' => true,
			// 'edit_published_posts' => true,
			// 'publish_posts' => true,
			// 'edit_files' => true,
			// 'upload_files' => true, //last in array needs no comma!
			// 'level_1' => true
		) );

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Shibbircore_Loader. Orchestrates the hooks of the plugin.
	 * - Shibbircore_i18n. Defines internationalization functionality.
	 * - Shibbircore_Admin. Defines all hooks for the admin area.
	 * - Shibbircore_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-shibbircore-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-shibbircore-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-shibbircore-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-shibbircore-public.php';

		$this->loader = new Shibbircore_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Shibbircore_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Shibbircore_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Shibbircore_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'register_menu' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'remove_admin_menu_for_users' );
		$this->loader->add_action( 'init', $plugin_admin, 'register_shortocde' );
		$this->loader->add_action( 'elementor_pro/forms/new_record', $plugin_admin, 'shibbir_create_new_user', 10, 2 );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'create_customer_page');

		$this->loader->add_filter( 'use_block_editor_for_post', $plugin_admin, 'disable_gutenberg');
		$this->loader->add_filter( 'screen_options_show_screen', $plugin_admin, 'shibbir_remove_screen_options');
		
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Shibbircore_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'after_setup_theme', $plugin_public, 'remove_admin_bar');
		// WooCommece account end point
		$this->loader->add_action( 'woocommerce_account_my-customer_endpoint', $plugin_public, 'my_customer_endpoint');
		$this->loader->add_action( 'woocommerce_account_videos_endpoint', $plugin_public, 'my_video_endpoint');
		$this->loader->add_action( 'woocommerce_account_membership-plan_endpoint', $plugin_public, 'my_membership_plan_endpoint');
		$this->loader->add_action( 'woocommerce_account_report_endpoint', $plugin_public, 'my_report_endpoint');
		$this->loader->add_action( 'init', $plugin_public, 'my_custom_endpoints');
		$this->loader->add_action( 'woocommerce_locate_template', $plugin_public, 'shibbir_woo_locate_template', 10, 3);
		$this->loader->add_action( 'woocommerce_account_content', $plugin_public, 'shibbir_woocommerce_account_content', 99);
		// Apply auto copuon
		$this->loader->add_action( 'woocommerce_before_cart', $plugin_public, 'auto_apply_coupon');
		$this->loader->add_action( 'wp_ajax_update_level_feature_action', $plugin_public, 'update_level_feature');

		$this->loader->add_filter( 'woocommerce_account_menu_items', $plugin_public, 'remove_woo_menu_items');
		$this->loader->add_filter( 'after_switch_theme', $plugin_public, 'my_custom_flush_rewrite_rules');
		$this->loader->add_filter( 'query_vars', $plugin_public, 'my_custom_query_vars');
		$this->loader->add_filter( 'show_admin_bar', $plugin_public, 'show_admin_bar_callback');

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Shibbircore_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
