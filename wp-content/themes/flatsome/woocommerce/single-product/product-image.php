<?php

global $post, $product, $woocommerce, $flatsome_opt;
$attachment_ids = $product->get_gallery_attachment_ids();
?>
    
    <script type="text/javascript">


			(function($){
				$(window).load(function(){

				/* change slider on color change */	
				 $('[name*="color"]').change(function(){
					 $('.product-gallery-slider').iosSlider('goToSlide', '1');
				 });
			
				 $('.iosSlider.product-thumbnails').find('.thumb:last').css('margin','0');

			     $('.iosSlider.product-thumbnails').iosSlider({
			          desktopClickDrag: true,
			          snapToChildren: true,
			          navPrevSelector: $('.prev_thumb_slider'),
       				  navNextSelector: $('.next_thumb_slider'),
					  onSlideChange: thumbChange,
					  onSliderLoaded: thumbChange
			     });

			     function thumbChange(args,slider_count) {
		    	 	 var slider_count = $('.iosSlider.product-thumbnails').find('.thumb').length;
		    	 	 var slider_count = slider_count - 4;
		    	 	 if(args.currentSlideNumber > slider_count){
					 	 $('.next_thumb_slider').addClass('disabled');
					 } else {
					 	 $('.next_thumb_slider').removeClass('disabled');
					 }
					 if(args.currentSlideNumber == '1'){
					 	 $('.prev_thumb_slider').addClass('disabled');
					 } else {
					 	 $('.prev_thumb_slider').removeClass('disabled');
					 }
    			 }

				/* start product image slider script */
				$('.iosSlider.product-gallery-slider').iosSlider({
			        snapToChildren: true,
			        scrollbar: true,
			        scrollbarHide: false,
			        desktopClickDrag: true,
			        snapFrictionCoefficient: 0.7,
       				autoSlideTransTimer: 500,
			        scrollbarLocation: 'top',
			        scrollbarHeight: '3px',
			        scrollbarBorder: '',
			        scrollbarBackground: '#ddd',
			        scrollbarMargin: '0',
			        scrollbarOpacity: '0.75',
			        navPrevSelector: $('.prev_product_slider'),
       				navNextSelector: $('.next_product_slider'),
			        navSlideSelector: '.product-thumbnails .thumb',
			        onSlideChange: slideChange,
			        onSliderLoaded: resizeProductSlider,
			        onSliderResize: resizeProductSlider
			    });

      			  /* Fix slider on resize */
			     function resizeProductSlider(args){ 
			        setTimeout(function() {
				      var slide_height = $(args.currentSlideObject).outerHeight();
      				 $(args.sliderContainerObject).css('min-height',slide_height);
      				 $(args.sliderContainerObject).css('height','auto');
			        }, 50);
			     }

			     /* update thubnails */
			     function slideChange(args) {
			         var slide_height = $(args.currentSlideObject).outerHeight();
      				 $(args.sliderContainerObject).css('min-height',slide_height);
      				 $(args.sliderContainerObject).css('height','auto');
			         $('.product-thumbnails .thumb').removeClass('selected');
			         $('.product-thumbnails .thumb:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');
			         var slider_count = $('.iosSlider.product-thumbnails').find('.thumb').length;
			         if(slider_count > 4){
			         	$('.product-thumbnails').iosSlider('goToSlide', args.currentSlideNumber);
			         }
			    }
  				})
		})(jQuery);
		</script>

    <div class="product-image images">
    	<div class="iosSlider product-gallery-slider" style="min-height:<?php  $height = get_option('shop_single_image_size'); echo $height['height'].'px'; ?>">

			<div class="slider gallery-popup">

				<?php if ( has_post_thumbnail() ) : ?>
            	
				<?php
					//Get the Thumbnail URL
					$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
					$src_small = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),  apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ));
					$src_title = get_post(get_post_thumbnail_id())->post_title;
					
				?>
             
                <div class="slide">
                	<a href="<?php echo $src[0] ?>"  title="zoom">
                	<span itemprop="image"><img src="<?php echo $src_small[0]; ?>" alt="<?php echo $src_title; ?>" title="<?php echo $src_title; ?>"/></span>
                		<div class="zoom-button large icon-expand tip-top hide-for-small" data-tip="Zoom"></div>
                	</a>
                </div>
				
				<?php endif; ?>	
                
				<?php

					if ( $attachment_ids ) {
				
						$loop = 0;
						$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );						
						
						foreach ( $attachment_ids as $attachment_id ) {

							$classes = array( 'zoom' );
				
							if ( $loop == 0 || $loop % $columns == 0 )
								$classes[] = 'first';
				
							if ( ( $loop + 1 ) % $columns == 0 )
								$classes[] = 'last';
				
							$image_link = wp_get_attachment_url( $attachment_id );
				
							if ( ! $image_link )
								continue;
				
							$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
							$image_class = esc_attr( implode( ' ', $classes ) );
							$image_title = esc_attr( get_the_title( $attachment_id ) );
							
							printf( '<div class="slide"><a href="%s"><span>%s</span><div class="zoom-button large icon-expand tip-top hide-for-small" data-tip="Zoom"></div></a></div>', wp_get_attachment_url( $attachment_id ), wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ) );
							
							$loop++;
						}
						
						
				
					}
				?>
			
			</div>
         	
    		<div class="sliderControlls dark">
				        <div class="sliderNav small hide-for-small">
				       		 <a href="javascript:void(0)" class="nextSlide prev_product_slider"><span class="icon-angle-left"></span></a>
				       		 <a href="javascript:void(0)" class="prevSlide next_product_slider"><span class="icon-angle-right"></span></a>
				        </div>
       		</div><!-- .sliderControlls -->
		</div>
		<?php if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
                       <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
       <?php } ?>
	</div><!-- end product image -->
        		
		<?php 
		if ( $attachment_ids ) {
		?>
        
        <div class="iosSlider product-thumbnails" style="min-height:<?php  $height = get_option('shop_thumbnail_image_size'); echo ($height['height']+2).'px'; ?>!important">
			<div class ="slider">
                        <?php 	
                        $image = get_option('shop_thumbnail_image_size');
						$image_height = ($image['height']-10); ?>
                        <?php if ( has_post_thumbnail() ) : ?>
                        <div class="thumb selected" style="height:<?php echo $image_height; ?>px"><div class="thumb-inner"><?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) ) ?></div></div>
                        <?php endif; ?>
                        
                        <?php
                
                        $loop = 0;
                        $columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
						
						foreach ( $attachment_ids as $attachment_id ) {

							$classes = array( 'zoom' );
				
							if ( $loop == 0 || $loop % $columns == 0 )
								$classes[] = 'selected';
				
							$image_link = wp_get_attachment_url( $attachment_id );
				
							if ( ! $image_link )
								continue;
				
							$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
							$image_class = esc_attr( implode( ' ', $classes ) );
							$image_title = esc_attr( get_the_title( $attachment_id ) );
						
							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="thumb"  style="height:'.$image_height.'px"><div class="thumb-inner">%s</div></div>', $image ), $attachment_id, $post->ID, $image_class );
							
							$loop++;
						}
						
					
						?>
			</div>

        	 <div class="sliderControlls dark">
				  <div class="sliderNav  small hide-for-small">
		       		 <a href="javascript:void(0)" class="nextSlide prev_thumb_slider disabled"><span class="icon-angle-left"></span></a>
		       		 <a href="javascript:void(0)" class="prevSlide next_thumb_slider disabled"><span class="icon-angle-right"></span></a>
		        </div>
       		</div><!-- .sliderControlls -->
		</div>
        <?php } ?>
