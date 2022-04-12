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

function get_user_by_product_id( $product_id ) {
    global $wpdb;
    $statuses = array_map( 'esc_sql', wc_get_is_paid_statuses() );
    $customer_emails = $wpdb->get_col("
    SELECT DISTINCT pm.meta_value FROM {$wpdb->posts} AS p
    INNER JOIN {$wpdb->postmeta} AS pm ON p.ID = pm.post_id
    INNER JOIN {$wpdb->prefix}woocommerce_order_items AS i ON p.ID = i.order_id
    INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS im ON i.order_item_id = im.order_item_id
    WHERE p.post_status IN ( 'wc-" . implode( "','wc-", $statuses ) . "' )
    AND pm.meta_key IN ( '_billing_email' )
    AND im.meta_key IN ( '_product_id', '_variation_id' )
    AND im.meta_value = $product_id
    ");
    return $customer_emails;
}

$trainer_taking_levels = get_user_meta( get_current_user_id(), 'membership_level', true  ); // Basically product
$taking_levels = [];
foreach( $trainer_taking_levels as $key => $taking_level ) {
    $taking_levels[] = $taking_level;
}
?>

<table>
    <tr>
        <th>Sl</th>
        <th>Customer Email</th>
        <th>Your Membership Level</th>
    </tr>
    <?php 
    $counter = 1;
    foreach( $trainer_taking_levels as $key => $level ) {
        $product = wc_get_product( $level );
        $level_name = $product->get_title();

        $customer_email = get_user_by_product_id( $level );
        if(!empty($customer_email)) {
            $email = $customer_email[0];
        } else {
            $email = 'No user yet';
        }
        echo "<tr>";
            echo '<td>'.$counter++.'</td>';
            echo '<td>'.$email.'</td>';
            echo '<td>'.$level_name.'</td>';
        echo "</tr>";
    }
    ?>
</table>