<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
global $flatsome_opt;

?>

<?php foreach ( $messages as $message ) : ?>
	<div class="row">
	<div class="large-12 columns">
		<div class="woocommerce-message message-success">
			<?php echo wp_kses_post( $message ); ?>
			<?php // Dropdown cart if product is added  // ?>
			<?php if($flatsome_opt['cart_dropdown_show']) { ?>  
			    <script>
			    jQuery('.woocommerce-message a').remove();
			    jQuery('.mini-cart').addClass('active');
			    </script>
			<?php } ?>
		</div>
	</div>
	</div>
<?php endforeach; ?>
