<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.shibbir.dev
 * @since      1.0.0
 *
 * @package    Shibbircore
 * @subpackage Shibbircore/public/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<nav class="woocommerce-MyAccount-navigation trainer-video">
	<ul>
        <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard">
            <a href="<?php echo site_url('/my-account/all-videos'); ?>">All Videos</a>
        </li>
        <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--my-customer">
            <a href="<?php echo site_url('/my-account/videos'); ?>">Add New Video</a>
        </li>
    </ul>
</nav>

<h2>All Training Video</h2>
<?php

$user_meta = get_user_meta( get_current_user_id() );
$user_memberships = get_user_meta( get_current_user_id(), 'membership_level' );

// echo '<pre>';
//     echo print_r( $user_meta );
// echo '</pre>';
$args = array(
    'author'        =>  get_current_user_id(),
    'orderby'       =>  'post_date',
    'order'         =>  'ASC',
    'posts_per_page' => -1,
    'post_type'     =>  'training_video'
);

$posts = get_posts( $args );
if( $posts ) {
    echo "<div class='video-wrapper'>";
    foreach( $posts as $post ) {
        setup_postdata( $post );
        $video_title = $post->post_title;
        $training_meta = get_post_meta( $post->ID, 'training_video' );
        $membership_level = get_post_meta( $post->ID, 'membership_level' );
        $level_id = $membership_level[0];
        $get_product = wc_get_product( $level_id );
        $level_name = $get_product->get_name();
        $permalink = get_the_permalink( $post->ID );
        // echo '<pre>';
        //     print_r(  $training_meta );
        // echo '</pre>';
        if( $training_meta ) {
            $video_id = $training_meta[0];
            if( $video_id ) {
                $video_attachtment = wp_get_attachment_image_src( $video_id );
                $video_url = $video_attachtment[0];
            } else {
                $video_url = '';
            }
        } else {
            $video_url = '';
        }

        echo "<div class='video'>";
            echo "<h5><a href='$permalink'>$video_title</a></h5>";
            echo "<span class='level'>$level_name</span>";
            if( $video_url ) {
                echo "<img src='$video_url'>";
            }
            echo "<a href=''>Edit</a> | <a href=''>Video</a>";
        echo "</div>";
    }
    wp_reset_postdata();
    echo '</div>';
}
?>