<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce, $woocommerce_loop, $flatsome_opt;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = $woocommerce->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => 9,
	'orderby'             => 'rand',
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

?>


<?php

if ( $products->have_posts() ) : ?>

		<h6><?php if($flatsome_opt['shop_aside_title']) {echo $flatsome_opt['shop_aside_title'];} else { _e('Complete the look','flatsome'); }; ?></h6>
		<div class="tx-div small"></div>
		<ul class="large-block-grid-2 up-sell">
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				<?php woocommerce_get_template_part( 'content', 'product-small' ); ?>
			<?php endwhile; // end of the loop. ?>
		</ul>
<?php endif;

wp_reset_postdata();
