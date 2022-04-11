<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);

$user_meta = get_user_meta( get_current_user_id() );
// echo '<pre>';
// print_r( $user_meta );
// echo '</pre>';
$membership_level = $user_meta['membership_level'];
$membership_level = unserialize( $membership_level[0] )
?>

<h3>
	<?php
	printf(
		/* translators: 1: user display name 2: logout url */
		wp_kses( __( 'Welcome %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ), $allowed_html ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>', '' );
	?>
</h3>

<table class="table">
	<tr>
		<td><b>Membership Level</b><br/><small>Membership level that you are currently taking</small></td>
		<td>
		<?php
		foreach( $membership_level as $key => $level ) {
			$product = wc_get_product( $level );
			echo $product->get_name();
			echo '<br/>';
		}
		?></td>
	</tr>
	<tr>
		<td><b>Membership Type</b></td>
		<td><?php echo $user_meta['membership_type'][0]; ?></td>
	</tr>
	<tr>
		<td><b>Personalised Link</b></td>
		<td><?php echo $user_meta['peronalised_link'][0]; ?></td>
	</tr>
	<tr>
		<td><b>Hide for Online Coaching</b></td>
		<td><?php echo $user_meta['hide_for_online_coaching'][0] == 0 ? 'No' : 'Yes'; ?></td>
	</tr>
	<tr>
		<td><b>All Privilieges</b></td>
		<td><?php echo $user_meta['all_privilieges'][0] == 0 ? 'No' : 'Yes'; ?></td>
	</tr>
	<tr>
		<td><b>Show Trainer in Trainer Online Coaching</b></td>
		<td><?php echo $user_meta['show_trainer_in_trainer_online_coaching'][0]; ?></td>
	</tr>
	<tr>
		<td><b>Show Trainer in Trainer Online Coaching</b></td>
		<td><?php echo $user_meta['_enter_trainer_specialization'][0]; ?></td>
	</tr>
</table>



<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
