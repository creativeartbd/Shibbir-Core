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

	
$author_obj = get_user_by('id', 1);

// GET USER ORDERS (COMPLETED + PROCESSING)
$customer_orders = get_posts( array(
    'numberposts' => -1,
    'meta_key'    => '_customer_user',
    'meta_value'  => 10,
    'post_type'   => wc_get_order_types(),
    'post_status' => array_keys( wc_get_is_paid_statuses() ),
) );

// LOOP THROUGH ORDERS AND GET PRODUCT IDS
if ( ! $customer_orders ) return;
$product_ids = array();
foreach ( $customer_orders as $customer_order ) {
    $order = wc_get_order( $customer_order->ID );
    $items = $order->get_items();
    foreach ( $items as $item ) {
        $product_id = $item->get_product_id();
        $product_ids[] = $product_id;
    }
}
$product_ids = array_unique( $product_ids );
$product_ids_str = implode( ",", $product_ids );

echo '<pre>';
print_r( $product_ids_str );
echo '</pre>';

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<table>
    <tr>
        <th>Sl</th>
        <th>Customer Name</th>
        <th>Customer Level</th>
    </tr>
    <tr>
        <td>2</td>
        <td>Shibbir Ahmed</td>
        <td>Level 1 Membership</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Alex Ahmed</td>
        <td>Level 2 Membership</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Sehrish</td>
        <td>Level 3 Membership</td>
    </tr>
    <tr>
        <td>5</td>
        <td>Rashed Ahmed</td>
        <td>Level 1 Membership</td>
    </tr>
</table>