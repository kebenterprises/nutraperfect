<?php
/**
 * The template for displaying lookbook product style content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop, $flatsome_opt;

?>
	


<li class="featured-product">
<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
<a href="<?php the_permalink(); ?>">
      <div class="product-image">
         <div class="front-image">
          <?php echo get_the_post_thumbnail( $post->ID,  apply_filters( 'single_product_small_thumbnail_size', 'shop_single' )) ?>
        </div>
        <div class="quick-view" data-prod="<?php echo $post->ID; ?>">+ <?php _e('Quick View','flatsome'); ?></div><!-- .quick-view -->
      </div><!-- end product-image -->


      <?php woocommerce_get_template( 'loop/sale-flash.php' ); ?>

</a>        
<?php if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
     <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
<?php } ?>
</li><!-- end product -->


