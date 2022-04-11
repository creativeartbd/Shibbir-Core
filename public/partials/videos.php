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
<style>
    .trainer-video ul li  {
        float : right;
    }
</style>

<nav class="woocommerce-MyAccount-navigation trainer-video">
	<ul>
        <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--dashboard">
            <a href="">All Videos</a>
        </li>
        <li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--my-customer">
            <a href="">Add New Video</a>
        </li>
    </ul>
</nav>

<h2>Add New Training Video</h2>

<form action="">
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="">Video Title</label>
        <input type="text" placeholder="Enter your video title" name="video_title" class="woocommerce-Input woocommerce-Input--text input-text">
    </p>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="">Upload file</label>
        <input type="file" placeholder="Enter your video title" name="video_file" class="woocommerce-Input woocommerce-Input--text input-text">
    </p>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="">Enter description</label>
        <textarea name="" id="" cols="30" rows="10" name="video_description" class="woocommerce-Input woocommerce-Input--text input-text"></textarea>
    </p>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="">Choose membership label</label>
        <select name="video_level" id="">
            <option value="">Level 1</option>
            <option value="">Level 2</option>
            <option value="">Level 3</option>
            <option value="">Level 4</option>
        </select>
    </p>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <input type="submit" name="submit" value="Add a new video" class="woocommerce-Button button">
    </p>
</form>