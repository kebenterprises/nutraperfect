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

/* PRODUCT QUICK VIEW HOOKS */
add_action( 'woocommerce_single_product_flipbook_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_flipbook_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_flipbook_summary', 'woocommerce_template_single_meta', 40 );

?>

  <div class="row-collapse flip-slide">

              <div class="large-6 columns flip-page-one">
                  <div class="featured-product">
					<a href="<?php the_permalink(); ?>">
					      <div class="product-image">
					         <div class="front-image">
					          <?php echo get_the_post_thumbnail( $post->ID,  apply_filters( 'single_product_small_thumbnail_size', 'shop_single' )) ?>
					        </div>
					      </div><!-- end product-image -->
					      <?php woocommerce_get_template( 'loop/sale-flash.php' ); ?>
					</a>        
				</div><!-- end product -->
              </div><!-- large-6 -->
               <div class="large-6 columns flip-page-two">
              	<div class="product-info ">
              			<h1 itemprop="name" class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
              			<div class="tx-div medium"></div>
                 		<?php do_action( 'woocommerce_single_product_flipbook_summary' ); ?>
                 		<a href="<?php the_permalink(); ?>" class="button"><?php _e( 'Read More', 'woocommerce' ); ?></a>
            	 </div>
              </div><!-- large-6 -->
</div><!-- row -->