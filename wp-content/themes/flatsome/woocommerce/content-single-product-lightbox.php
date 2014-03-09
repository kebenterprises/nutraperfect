 <?php
	global $post, $product, $woocommerce;
	$attachment_ids = $product->get_gallery_attachment_ids();

?> 
           
<div class="row collapse">

<div class="large-7 columns">    
    <div class="product-image images">
    	<div class="iosSlider product-gallery-slider" style="height:<?php  $height = get_option('shop_single_image_size'); echo ($height['height']-60).'px!important'; ?>">

			<div class="slider" >

				<?php if ( has_post_thumbnail() ) : ?>
            	
				<?php
					//Get the Thumbnail URL
					$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
				?>
                
                <div class="slide" >
                	<span itemprop="image"><?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ) ?></span>
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
							
							printf( '<div class="slide"><span>%s</span></div>', wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ), wp_get_attachment_url( $attachment_id ) );
							
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
	
		</div><!-- .slider -->
	</div><!-- .product-image -->
 
</div><!-- large-6 -->

<div class="large-5 columns">
	<div class="product-lightbox-inner product-info">
	<h1 itemprop="name" class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	<div class="tx-div small"></div>
	<?php do_action( 'woocommerce_single_product_lightbox_summary' ); ?>
	</div>
</div>


