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
$user = wp_get_current_user();
$user_meta = get_user_meta( get_current_user_id() );
$user_memberships = get_user_meta( get_current_user_id(), 'membership_level' );
// echo '<pre>';
//     echo print_r(  $user_memberships );
// echo '</pre>';
?>
<style>
    .trainer-video ul li  {
        float : right;
    }
</style>

<nav class="woocommerce-MyAccount-navigation trainer-video">
	<ul>
        <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard">
            <a href="<?php echo get_the_permalink() . 'all-videos'; ?>">All Videos</a>
        </li>
        <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--my-customer">
            <a href="<?php echo get_the_permalink() . 'videos' ?>">Add New Video</a>
        </li>
    </ul>
</nav>

<h2>Add New Training Video</h2>

<form action="" id="add_new_training_video" enctype="multipart/form-data">
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="">Video Title</label>
        <input type="text" placeholder="Enter your video title" name="video_title" class="woocommerce-Input woocommerce-Input--text input-text">
    </p>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="">Video Category</label>
        <select name="video_category" id="">
            <option value="">--Choose Category</option>
            <?php
            $video_categories = get_categories( array( 'taxonomy' => 'video_category', 'post_type' => 'training_video', 'hide_empty' => false ) );
            foreach( $video_categories as $category ) {
                $category_id = $category->term_id;
                $category_name = $category->name;
                echo "<option value='$category_id'>$category_name</option>";
            }
            ?>
        </select>
    </p>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="">Upload file</label>
        <input type="file" placeholder="Enter your video title" name="video_file" id="video_file" class="woocommerce-Input woocommerce-Input--text input-text">
    </p>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="">Enter description</label>
        <textarea cols="30" rows="10" name="video_description" class="woocommerce-Input woocommerce-Input--text input-text"></textarea>
    </p>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="">Choose membership label</label>
        <select name="video_level" id="">
            <option value="">--Choose Memership Level</option>
            <?php
            foreach( $user_memberships[0] as $key => $level ) {
                $product = wc_get_product( $level );
                $membership_id = $product->get_id();
                $membership_level = $product->get_name();
                echo "<option value='$membership_id'>$membership_level</option>";
            }
            ?>
        </select>
    </p>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <input type="submit" name="submit" value="Add a new video" class="woocommerce-Button button" id="video_btn">
        <input type="hidden" name="action" value="add_trainer_video_action">
        <?php wp_nonce_field( 'add_trainer_video_action', 'add_trainer_video_action_nonce' ); ?>
    </p>
    <div class="ajax_response"></div>
</form>