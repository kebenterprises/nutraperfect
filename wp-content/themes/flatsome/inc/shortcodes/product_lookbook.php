<?php 
// [product_lookbook]
function product_lookbook($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'products'  => '8',
        'cat' => ''
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
	jQuery(document).ready(function($) {
		$('#slider_<?php echo $sliderrandomid ?>').iosSlider({
			snapToChildren: true,
			desktopClickDrag: true,
			infiniteSlider: true,
			navPrevSelector: '.prev_<?php echo $sliderrandomid ?>',
			navNextSelector: '.next_<?php echo $sliderrandomid ?>',
			onSliderLoaded: slideLoad,
			onSliderResize: slideLoad,
		});

		function slideLoad(args) {
			setTimeout(function() {
				 var slider_height = $(args.sliderContainerObject).find('img:first').height();
		         $(args.sliderContainerObject).css('min-height',slider_height);
			  }, 0);
    	 }
	    
	});
	</script> 
	
            <div id="slider_<?php echo $sliderrandomid ?>" class="iosSlider lookbook-slider" style="height:500px;overflow:hidden;">
                <ul class="slider large-block-grid-3 small-block-grid-1">
				  <?php
                    $args = array(
                        'post_type' => 'product',
						'post_status' => 'publish',
						'product_cat' => $cat,
						'posts_per_page' => $products
                    );
                    
                    $products = new WP_Query( $args );
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <?php woocommerce_get_template_part( 'content', 'product-lookbook' ); ?>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    wp_reset_query();
                    
                    ?>
                </ul>   <!-- .slider -->  
                 
                <div class="sliderControlls dark">
			        <div class="sliderNav hide-for-small">
			        <a href="javascript:void(0)" class="nextSlide prev_<?php echo $sliderrandomid ?>"><span class="icon-angle-left"></span></a>
			        <a href="javascript:void(0)" class="prevSlide next_<?php echo $sliderrandomid ?>"><span class="icon-angle-right"></span></a>
			        </div>
       		    </div><!-- .sliderControlls -->
       		 </div> <!-- .iOsslider -->

    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


add_shortcode("product_lookbook", "product_lookbook");
