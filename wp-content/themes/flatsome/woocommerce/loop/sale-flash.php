<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<?php if ($product->is_on_sale()) : ?>

	 <div class="callout">
            <div class="inner">
              <div class="inner-text"><?php echo apply_filters('woocommerce_sale_flash',__( 'Sale!', 'woocommerce' ), $post, $product); ?></div>
            </div>
     </div><!-- end callout -->


<?php endif; ?>