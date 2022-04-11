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


// echo '<pre>';
// // print_r( get_field('select_this_membership_level_feature' )  );
// print_r(   );
// echo '</pre>';

$args = array(
    'category' => array( 'membership-level' ),
    'orderby'  => 'name',
);
$products = wc_get_products( $args );
?>

<?php 
$get_level_id = isset( $_GET['level_id'] ) ? (int) $_GET['level_id'] : '';
if( $get_level_id ) {
    $get_product = wc_get_product( $get_level_id );
    if( $get_product ) {
        $get_level_title = $get_product->get_name();
        $get_level_price = $get_product->get_price_html();
        $get_level_features = acf_get_field('select_this_membership_level_feature')['choices'];
        $ex_level_features = get_post_meta( $get_level_id, 'select_this_membership_level_feature', true );  
?>

<h2>Update Membership Level Features</h2>
<form action="" id="update_membership_feature">
    <table>
        <tr>
            <td><label for=""><b>Membership Label</b></label></td>
            <td><?php echo $get_level_title; ?></td>
        </tr>
        <tr>
            <td><label for=""><b>Membership Price</b></label></td>
            <td><?php echo $get_level_price; ?></td>
        </tr>
        <tr>
            <td><label for=""><b>Membership Features</b></label></td>
            <td>
                <?php
                foreach( $get_level_features as $key => $level_feature ) {
                    $checked = '';
                    if( in_array( $key, $ex_level_features ) ) {
                        $checked = 'checked';
                    }
                    echo "<input type='checkbox' name='level_feature[]' value='$key' $checked> $level_feature <br/>";
                } 
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="submit" value="Update" id="udpate_level_submit">
                <input type="hidden" name="level_id" value=<?php ?>>
            </td>
        </tr>
        <?php wp_nonce_field( 'update_level_feature_action', 'update_level_feature_nonce' ); ?>
    </table>
    <div class="ajax_response"></div>
</form>
<?php }  } ?>

<table>
    <tr>
        <th>Sl</th>
        <th>Membership Name</th>
        <th>Membership Price</th>
        <th>Membership features</th>
    </tr>
    <?php 
    $count = 1;
    global $wp;
    $currernt_page = home_url( $wp->request ) ;

    foreach( $products as $product ) {

        $level_features = get_post_meta( $product->get_id(), 'select_this_membership_level_feature', true );
        ?>
        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo $product->get_name(); ?></td>
            <td><?php echo $product->get_price_html(); ?></td>
            <td><?php echo implode( ', ', $level_features ); ?></td>
            <!-- <td><a href="<?php echo $currernt_page . '/?level_id='. $function->enc_dec($product->get_id(), 'e'); ?>">Edit Feature</a></td> -->
        </tr>
        <?php
    }
    ?>
</table>