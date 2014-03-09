<?php 
// [products_pinterest_style]
function products_pinterest_style($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'products'  => '999',
        'cat' => '',
        'columns' => '3'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	?>
    
  	<script>
	/* PACKERY GRID */
	jQuery(document).ready(function ($) {
	    var $container = $(".pinterest-style");
	    // initialize
	    $container.packery({
	      itemSelector: "li",
	      gutter: 0
	    });

	    imagesLoaded( document.querySelector('.pinterest-style'), function( instance, container ) {
  			$container.packery('layout');
		});
	 });
	</script>
	<div class="row collapse">
	<div class="large-12 columns">
                <ul class="pinterest-style large-block-grid-<?php echo $columns; ?>">
				  <?php
                    $args = array(
                        'post_type' => 'product',
						'post_status' => 'publish',
						'ignore_sticky_posts'   => 1,
						'product_cat' => $cat,
						'posts_per_page' => $products
                    );
                    
                    $products = new WP_Query( $args );
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                        <li class="featured-product">
                            <?php woocommerce_get_template_part( 'content', 'product-pinterest-style' ); ?>
               			 </li><!-- end product -->

                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    wp_reset_query();
                    
                    ?>
                </ul>   <!-- .slider -->  
     </div><!-- .large-12 -->
 </div><!-- .row -->
      

    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


add_shortcode("products_pinterest_style", "products_pinterest_style");
