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

		// echo '<pre>';
		// 	echo print_r( $user->roles );
		// 	print_r( $menu_links );
		// echo '</pre>';

		
		// remove follwoings page from the trainer account
		// if ( in_array( 'trainer', (array) $user->roles ) ) {
		if ( in_array( 'trainer', (array) $user->roles ) ) {
			unset( $menu_links['subscriptions'] );  
		}
		
		unset( $menu_links['orders'] ); 
		unset( $menu_links['downloads'] ); 
		unset( $menu_links['edit-address'] ); 
		unset( $menu_links['payment-methods'] ); 
			
		if ( in_array( 'subscriber', (array) $user->roles ) ) {
			unset( $menu_links['my-customer'] ); 
			unset( $menu_links['videos'] ); 
		}
		// }
		// we will hook "womanide-forum" later

		if ( in_array( 'trainer', (array) $user->roles ) ) {
			$new = array( 
				'my-customer' 		=>	'My Customer',
				'videos'			=>	'Videos',
				'membership-plan'	=>	'Membership Plan',
				'report'			=>	'Report',
				'forum'				=>	'Forum',
			);
	
			$menu_links = array_slice( $menu_links, 0, 1, true ) + $new + array_slice( $menu_links, 1, NULL, true );
		}
		
		
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
		$vars[] = 'all-videos';
		return $vars;
	}

	public function my_custom_endpoints() {
		add_rewrite_endpoint( 'my-customer', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'videos', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'membership-plan', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'report', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'forum', EP_ROOT | EP_PAGES );
		add_rewrite_endpoint( 'all-videos', EP_ROOT | EP_PAGES );
	}

	public function my_customer_endpoint() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/my-customer.php';
	}

	public function my_video_endpoint() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/videos.php';
	}

	public function my_all_videos_endpoint() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/all-videos.php';
	}

	public function my_membership_plan_endpoint() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-shibbircore-function.php';
		$function = new Shibbir_Core_Function();
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/membership-plan.php';
	}

	public function my_report_endpoint() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/report.php';
	}

	public function auto_apply_coupon() {
		// Auto apply coupon to all product
		$coupon_code = '10per'; 
		if ( WC()->cart->has_discount( $coupon_code ) ) return;
		WC()->cart->apply_coupon( $coupon_code );
		wc_print_notices();
	}

	public function show_admin_bar_callback() {
		if (!current_user_can('administrator') && !is_admin()) {
		    return true;
		}
	}

	public function shibbir_woo_locate_template( $template, $template_name, $template_path ) {
		$basename = basename( $template );
		if( $basename == 'dashboard.php' ) {
			$template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates/myaccount/dashboard.php';
		}
		return $template;
	}

	public function add_trainer_video_callback() {
		if ( ! isset( $_POST['add_trainer_video_action_nonce'] )  || ! wp_verify_nonce( $_POST['add_trainer_video_action_nonce'], 'add_trainer_video_action' ) ) {
			return false;
		}
		if( ! is_user_logged_in() ) {
			return false;
		}

		$video_title = sanitize_text_field( $_POST['video_title'] );
		$video_category = sanitize_text_field( $_POST['video_category'] );
		$video_description = sanitize_text_field( $_POST['video_description'] );
		$video_level = sanitize_text_field( $_POST['video_level'] );
		$video_file = $_FILES['video_file']['name'];
		$video_file_size = $_FILES['video_file']['size'];
		$video_file_tmp = $_FILES['video_file']['tmp_name'];
		$ext = pathinfo( $video_file, PATHINFO_EXTENSION );
		$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
		// Verify file size - 5MB maximum
		$maxsize = 5 * 1024 * 1024;

		$messages = [];
		$output = [];
		$output['success'] = false;

		$args = array(
			'category' => array( 'membership-level' ),
			'orderby'  => 'name',
		);
		
		// Get current user membership levels
		$user_memberships = get_user_meta( get_current_user_id(), 'membership_level' );

		if( isset( $video_title ) && isset( $video_category ) && isset( $video_description ) && isset( $video_level ) && isset( $video_file ) ) {
			if( empty( $video_title ) && empty( $video_category ) && empty( $video_description ) && empty( $video_level ) && empty( $video_file ) ) {
				$messages[] = 'All fields are required ss';
			} else {
				if( empty( $video_title ) ) {
					$messages[] = 'Video title is required';
				} elseif( strlen( $video_title ) > 200 || strlen( $video_title ) < 2 ) {
					$messages[] = 'Either video title length is too short or long';
				}

				if( empty( $video_category ) ) {
					$messages[] = 'Video category is required';
				} elseif( !is_numeric( $video_category ) ) {
					$messages[] = 'Invalid video category';
				}

				if( empty( $video_file ) ) {
					$messages[] = 'Upload a video file';
				} elseif( !array_key_exists( $ext, $allowed ) ) {
					$messages[] = 'Please upload a valid file format. We are allowing jpg, jpeg, gif and png file extension';
				} elseif ( $video_file_size > $maxsize ) {
					$messages[] = 'File size is larger than the allowed limit. Please upload ' . $maxsize . ' MB file';
				}

				if( empty( $video_description ) ) {
					$messages[] = 'Video description is required';
				} 

				if( empty( $video_level ) ) {
					$messages[] = 'Video level is required';
				}  elseif( !is_numeric( $video_level ) ) {
					$messages[] = 'Invalid membership level';
				} elseif( !in_array( $video_level, $user_memberships[0] ) ) {
					$messages[] = 'Your selected membership level is not found';
				}
			}

			if( !empty( $messages ) ) {
				foreach( $messages as $message ) {
					$output['message'][] = $message;
				}
			} else {
				$args = array(
					'post_title'    => $video_title,
					'post_content'  => $video_description,
					'post_status'   => 'publish',
					'post_author'   => get_current_user_id(),
					'post_category' => array( $video_category ),
					'post_type'		=> 'training_video'
				);
				 
				// Insert the post into the database.
				$post_id = wp_insert_post( $args );
				if( ! is_wp_error( $post_id ) ) {
					
					$filename = basename($video_file);
					$upload_file = wp_upload_bits($filename, null, file_get_contents($video_file_tmp));

					if (!$upload_file['error']) {
						$wp_filetype = wp_check_filetype($filename, null );
						$attachment = array(
							'post_mime_type' => $wp_filetype['type'],
							'post_parent' => $post_id,
							'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
							'post_content' => '',
							'post_status' => 'inherit'
						);
						$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $post_id );
						if (!is_wp_error($attachment_id)) {
							require_once(ABSPATH . "wp-admin" . '/includes/image.php');
							$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
							wp_update_attachment_metadata( $attachment_id,  $attachment_data );
							update_post_meta( $post_id, 'training_video', $attachment_id );
							update_post_meta( $post_id, 'membership_level', $video_level );

							$output['success'] = true;
							$output['message'] = 'Successfully added a new Video.';
						} else {
							$output['success'] = false;
							$output['message'] = 'OPPs! Somethign is wrong. Please contact administrator. Thank You.';
						}
					} else {
						$output['success'] = false;
						$output['message'] = 'OPPs! Somethign is wrong. Please contact administrator. Thank You.';
					}
				} else {
					$output['success'] = false;
					$output['message'] = 'OPPs! Somethign is wrong. Please contact administrator. Thank You.';
				}
			}
			echo json_encode( $output );
		}
		wp_die();
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

	public function disable_woocommerce_styles() {
		return '__return_empty_array';
	}

}
