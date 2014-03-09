<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $flatsome_opt;

$related = $product->get_related();

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> 12,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );

$products = new WP_Query( $args );


if ( $products->have_posts() ) : ?>

	<div class="related products">

		<h2><?php _e( 'Related Products', 'woocommerce' ); ?></h2>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(window).load(function() {
	
		$('#slider_related').iosSlider({
			snapToChildren: true,
			desktopClickDrag: true,
			navPrevSelector: '.prev_related',
			navNextSelector: '.next_related',
			onSliderLoaded: slideLoad,
			onSliderResize: slideLoad,
			onSlideChange: slideChange,
		});

		function slideLoad(args) {
			var slider_count = $('#slider_related').find('li').length;
    	 	if(slider_count == '4'){ $('#slider_related .sliderControlls').remove();}
			setTimeout(function() {
			 var t=0;
			 var t_elem;
			 $(args.sliderContainerObject).find('li').each(function () {
			 $this = $(this);
			    if ( $this.outerHeight() > t ) {
			        t_elem=this;
			        t=$this.outerHeight();
				}
				});
				$(args.sliderContainerObject).css('min-height',t);
				$(args.sliderContainerObject).css('height','auto');
			  }, 10);
    	 }


    	 function slideChange(args,slider_count) {
    	 	 var slider_count = $('#slider_related').find('li').length;
    	 	 if(slider_count == '4'){ $('#slider_related .sliderControlls').remove();}
    	 	 var slider_count = slider_count - 4;
    	 	 if(args.currentSlideNumber > slider_count){
			 	 $('.next_related').addClass('disabled');
			 } else {
			 	 $('.next_related').removeClass('disabled');
			 }
			 if(args.currentSlideNumber == '1'){
			 	 $('.prev_related').addClass('disabled');
			 } else {
			 	 $('.prev_related').removeClass('disabled');
			 }
    	 }

    	 	});
	  
	});
	</script>


		<div class="row column-slider">
            <div id="slider_related" class="iosSlider" style="overflow:hidden;height:330px;min-height:330px;">
                <ul class="slider large-block-grid-4 small-block-grid-2">

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<?php woocommerce_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>

                </ul>   <!-- .slider -->  

            <div class="sliderControlls">
		        <div class="sliderNav small hide-for-small">
		       		 <a href="javascript:void(0)" class="nextSlide disabled prev_related"><span class="icon-angle-left"></span></a>
		       		 <a href="javascript:void(0)" class="prevSlide next_related"><span class="icon-angle-right"></span></a>
		        </div>
       		</div><!-- .sliderControlls -->
			
       		</div> <!-- .iOsslider -->
    </div><!-- .row .column-slider -->


	

	</div>

<?php endif;

wp_reset_postdata();
