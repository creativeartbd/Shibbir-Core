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

$user_meta = get_user_meta( get_current_user_id() );

// echo '<pre>';
//     echo print_r( $user_meta );
// echo '</pre>';
?>
<table>
    <tr>
        <th>Sl</th>
        <th>Membership Name</th>
        <th>Membership Price</th>
        <th>Membership features</th>
    </tr>
    <?php 

    $args = array(
        'category' => array( 'membership-level' ),
        'orderby'  => 'name',
    );

    $products = wc_get_products( $args );
    $count = 1;
    
    foreach( $products as $key => $product ) {
        if( isset( $user_meta["membership_commission_{$key}_membership_level"][0] ) ) {
            $get_product = wc_get_product( $user_meta["membership_commission_{$key}_membership_level"][0] );
            $product_id 	= $get_product->get_id();
            $product_name 	= $get_product->get_name();
            $ex_level_features = get_post_meta( $product_id, 'choose_membership_features', true ); 
            echo '<tr>';
                echo "<td>".$count++."</td>";
                echo "<td>".$get_product->get_name()."</td>";
                echo "<td>".$get_product->get_price_html()."</td>";
                echo "<td>".implode(', ', $ex_level_features)."</td>";
            echo '</tr>';
        }	
    }
    ?>
</table>