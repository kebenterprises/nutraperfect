<?php
function slider_script($sliderrandomid,$columns){
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(window).load(function() {
	
		$('#slider_<?php echo $sliderrandomid ?>').iosSlider({
			snapToChildren: true,
			desktopClickDrag: true,
			 horizontalSlideLockThreshold:2,
        	slideStartVelocityThreshold:2,
        	verticalSlideLockThreshold: 2,
			navPrevSelector: '.prev_<?php echo $sliderrandomid ?>',
			navNextSelector: '.next_<?php echo $sliderrandomid ?>',
			onSliderLoaded: slideLoad,
			onSliderResize: slideLoad,
			onSlideChange: slideChange,
		});

		function slideLoad(args) {
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
    	 	 var slider_count = $('#slider_<?php echo $sliderrandomid ?>').find('li').length;
    	 	 var slider_count = slider_count - <?php echo $columns; ?>;
    	 	 if(args.currentSlideNumber > slider_count){
			 	 $('.next_<?php echo $sliderrandomid ?>').addClass('disabled');
			 } else {
			 	 $('.next_<?php echo $sliderrandomid ?>').removeClass('disabled');
			 }
			 if(args.currentSlideNumber == '1'){
			 	 $('.prev_<?php echo $sliderrandomid ?>').addClass('disabled');
			 } else {
			 	 $('.prev_<?php echo $sliderrandomid ?>').removeClass('disabled');
			 }
    	 }

    	 	});
	  
	});
	</script>

<?php }

// [ux_bestseller_products]
function ux_best_sellers($atts, $content = null) {
	global $woocommerce;
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'title' => '',
		'products'  => '8',
		'columns' => '4'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	?>
    
		<?php slider_script($sliderrandomid,$columns)?>

		<?php if($title){?> 
		<div class="row">
			<div class="large-12 columns">
				<h3 class="section-title"><span><?php echo $title ?></span></h3>
			</div>
		</div><!-- end .title -->
		<?php } ?>

		<div class="row column-slider">
            <div id="slider_<?php echo $sliderrandomid ?>" class="iosSlider" style="overflow:hidden;height:100px;min-height:100px;">
                <ul class="slider large-block-grid-<?php echo $columns; ?> small-block-grid-2">
						<?php
                    $query_args = array(
				    		'posts_per_page' => $products,
				    		'post_status' 	 => 'publish',
				    		'post_type' 	 => 'product',
				    		'meta_key' 		 => 'total_sales',
				    		'orderby' 		 => 'meta_value_num',
				    		'no_found_rows'  => 1,
				    	);

				    	$query_args['meta_query'] = $woocommerce->query->get_meta_query();

				    	if ( isset( $instance['hide_free'] ) && 1 == $instance['hide_free'] ) {
				    		$query_args['meta_query'][] = array(
							    'key'     => '_price',
							    'value'   => 0,
							    'compare' => '>',
							    'type'    => 'DECIMAL',
							);
				    	}

						$r = new WP_Query($query_args);
                    
                    if ( $r->have_posts() ) : ?>
                        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                        <?php endwhile; // end of the loop. ?>
                    <?php
                    
                    endif; 
                    wp_reset_query();
                    ?>
                </ul>   <!-- .slider -->  

            <div class="sliderControlls">
		        <div class="sliderNav small hide-for-small">
		       		 <a href="javascript:void(0)" class="nextSlide disabled prev_<?php echo $sliderrandomid ?>"><span class="icon-angle-left"></span></a>
		       		 <a href="javascript:void(0)" class="prevSlide next_<?php echo $sliderrandomid ?>"><span class="icon-angle-right"></span></a>
		        </div>
       		</div><!-- .sliderControlls -->
			
       		</div> <!-- .iOsslider -->
    </div><!-- .row .column-slider -->

    
    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}



// [ux_featured_products]
function ux_featured_products($atts, $content = null) {
	global $woocommerce;
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'products'  => '8',
		'columns' => '4'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	?>
    
 		<?php slider_script($sliderrandomid,$columns)?>

		<?php if($title){?> 
		<div class="row">
			<div class="large-12 columns">
				<h3 class="section-title"><span><?php echo $title ?></span></h3>
			</div>
		</div><!-- end .title -->
		<?php } ?>

		<div class="row column-slider">
            <div id="slider_<?php echo $sliderrandomid ?>" class="iosSlider" style="overflow:hidden;height:100px;min-height:100px;">
                <ul class="slider large-block-grid-<?php echo $columns; ?> small-block-grid-2">
					<?php
                	$query_args = array('posts_per_page' => $products, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );
					$query_args['meta_query'] = $woocommerce->query->get_meta_query();
					$query_args['meta_query'][] = array(
						'key' => '_featured',
						'value' => 'yes'
					);

					$r = new WP_Query($query_args);
                    
                    
                    if ( $r->have_posts() ) : ?>
                                
                        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                    
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    wp_reset_query();
                    
                    ?>
                </ul>   <!-- .slider -->  
                  <div class="sliderControlls">
			        <div class="sliderNav small hide-for-small">
			       		 <a href="javascript:void(0)" class="nextSlide disabled prev_<?php echo $sliderrandomid ?>"><span class="icon-angle-left"></span></a>
			       		 <a href="javascript:void(0)" class="prevSlide next_<?php echo $sliderrandomid ?>"><span class="icon-angle-right"></span></a>
			        </div>
       			</div><!-- .sliderControlls -->
       		 </div> <!-- .iOsslider -->
       		</div><!-- .row .column-slider -->

    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}



// [ux_sale_products]
function ux_sale_products($atts, $content = null) {
	global $woocommerce;
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'products'  => '8',
        'orderby' => 'date',
        'order' => 'ASC',
        'columns' => '4'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	?>
    
	   <?php slider_script($sliderrandomid,$columns)?>

		<?php if($title){?> 
		<div class="row">
			<div class="large-12 columns">
				<h3 class="section-title"><span><?php echo $title ?></span></h3>
			</div>
		</div><!-- end .title -->
		<?php } ?>

		<div class="row column-slider">
            <div id="slider_<?php echo $sliderrandomid ?>" class="iosSlider" style="overflow:hidden;height:100px;min-height:100px;">
                <ul class="slider large-block-grid-<?php echo $columns; ?> small-block-grid-2">
				 <?php
                   	$product_ids_on_sale = woocommerce_get_product_ids_on_sale();
					$product_ids_on_sale[] = 0;

					$meta_query = $woocommerce->query->get_meta_query();

			    	$query_args = array(
			    		'posts_per_page' 	=> $products,
			    		'no_found_rows' => 1,
			    		'post_status' 	=> 'publish',
			    		'post_type' 	=> 'product',
			    		'orderby' 		=> $orderby,
			    		'order' 		=> $order,
			    		'meta_query' 	=> $meta_query,
			    		'post__in'		=> $product_ids_on_sale
			    	);

					$r = new WP_Query($query_args);
                    
                    if ( $r->have_posts() ) : ?>
                                
                        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                    
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    wp_reset_query();
                    
                    ?>
                </ul>   <!-- .slider -->  
                  <div class="sliderControlls">
		        <div class="sliderNav small hide-for-small">
		       		 <a href="javascript:void(0)" class="nextSlide disabled prev_<?php echo $sliderrandomid ?>"><span class="icon-angle-left"></span></a>
		       		 <a href="javascript:void(0)" class="prevSlide next_<?php echo $sliderrandomid ?>"><span class="icon-angle-right"></span></a>
		        </div>
       		</div><!-- .sliderControlls -->
       		 </div> <!-- .iOsslider -->
    </div><!-- .row .column-slider -->

    
    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


// [ux_latest_products]
function ux_latest_products($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'products'  => '8',
        'orderby' => 'date',
        'order' => 'desc',
        'columns' => '4'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	?>
    
 	<?php slider_script($sliderrandomid,$columns)?>

		<?php if($title){?> 
		<div class="row">
			<div class="large-12 columns">
				<h3 class="section-title"><span><?php echo $title ?></span></h3>
			</div>
		</div><!-- end .title -->
		<?php } ?>

		<div class="row column-slider">
            <div id="slider_<?php echo $sliderrandomid ?>" class="iosSlider" style="overflow:hidden;height:100px;min-height:100px;">
                <ul class="slider large-block-grid-<?php echo $columns; ?> small-block-grid-2 ux-latest-products">
				  <?php
            
                    $args = array(
                        'post_type' => 'product',
						'post_status' => 'publish',
						'ignore_sticky_posts'   => 1,
						'posts_per_page' => $products,
						'orderby' 		=> $orderby,
			    		'order' 		=> $order
                    );
                    
                    $products = new WP_Query( $args );
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    wp_reset_query();
                    
                    ?>
                </ul>   <!-- .slider -->  
                  <div class="sliderControlls">
				        <div class="sliderNav small hide-for-small">
				       		 <a href="javascript:void(0)" class="nextSlide disabled prev_<?php echo $sliderrandomid ?>"><span class="icon-angle-left"></span></a>
				       		 <a href="javascript:void(0)" class="prevSlide next_<?php echo $sliderrandomid ?>"><span class="icon-angle-right"></span></a>
				        </div>
       			   </div><!-- .sliderControlls -->
       		 </div> <!-- .iOsslider -->
    </div><!-- .row .column-slider -->

    
    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


// [ux_product_categories]
function ux_product_categories($atts, $content = null) {
	$sliderrandomid = rand();
	extract( shortcode_atts( array (
			'number'     => null,
			'title' => '',
			'orderby'    => 'name',
			'order'      => 'ASC',
			'columns' 	 => '4',
			'hide_empty' => 1,
			'parent'     => ''
			), $atts ) );
		if ( isset( $atts[ 'ids' ] ) ) {
			$ids = explode( ',', $atts[ 'ids' ] );
		  	$ids = array_map( 'trim', $ids );
		} else {
			$ids = array();
		}

		$hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

		// get terms and workaround WP bug with parents/pad counts
	  	$args = array(
	  		'orderby'    => $orderby,
	  		'order'      => $order,
	  		'hide_empty' => $hide_empty,
			'include'    => $ids,
			'pad_counts' => true,
			'child_of'   => $parent
		);

	  	$product_categories = get_terms( 'product_cat', $args );

	  	if ( $parent !== "" )
	  		$product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );

	  	if ( $number )
	  		$product_categories = array_slice( $product_categories, 0, $number );

	  	$woocommerce_loop['columns'] = $columns;


	ob_start();

	// Reset loop/columns globals when starting a new loop
		$woocommerce_loop['loop'] = $woocommerce_loop['column'] = '';

	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	?>
    
 	<?php slider_script($sliderrandomid,$columns)?>

		<?php if($title){?> 
		<div class="row">
			<div class="large-12 columns">
				<h3 class="section-title"><span><?php echo $title ?></span></h3>
			</div>
		</div><!-- end .title -->
		<?php } ?>

		<div class="row column-slider category-slider">
            <div id="slider_<?php echo $sliderrandomid ?>" class="iosSlider" style="overflow:hidden;height:100px;min-height:100px;">
                <ul class="slider large-block-grid-<?php echo $columns; ?> small-block-grid-2 ux-latest-products">
				  <?php
                   if ( $product_categories ) {
						foreach ( $product_categories as $category ) {
							woocommerce_get_template( 'content-product_cat.php', array(
								'category' => $category
							) );
						}
					}
					woocommerce_reset_loop();    
                    ?>
                </ul>   <!-- .slider -->  
                  <div class="sliderControlls">
				        <div class="sliderNav small hide-for-small">
				       		 <a href="javascript:void(0)" class="nextSlide disabled prev_<?php echo $sliderrandomid ?>"><span class="icon-angle-left"></span></a>
				       		 <a href="javascript:void(0)" class="prevSlide next_<?php echo $sliderrandomid ?>"><span class="icon-angle-right"></span></a>
				        </div>
       			   </div><!-- .sliderControlls -->
       		 </div> <!-- .iOsslider -->
    </div><!-- .row .column-slider -->

    
    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}



// [ux_custom_products]
function ux_custom_products($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'products'  => '8',
		'cat' => '',
        'orderby' => 'date',
        'order' => 'desc',
        'columns' => '4'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	?>
    
 	<?php slider_script($sliderrandomid,$columns)?>

		<?php if($title){?> 
		<div class="row">
			<div class="large-12 columns">
				<h3 class="section-title"><span><?php echo $title ?></span></h3>
			</div>
		</div><!-- end .title -->
		<?php } ?>

		<div class="row column-slider">
            <div id="slider_<?php echo $sliderrandomid ?>" class="iosSlider" style="overflow:hidden;height:100px;min-height:100px;">
                <ul class="slider large-block-grid-<?php echo $columns; ?> small-block-grid-2 ux-latest-products">
				  <?php
            
                    $args = array(
                    	'product_cat' => $cat,
                    	'post_type' => 'product',
						'post_status' => 'publish',
						'ignore_sticky_posts'   => 1,
						'posts_per_page' => $products,
						'orderby' 		=> $orderby,
			    		'order' 		=> $order
                    );
                    
                    $products = new WP_Query( $args );
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    wp_reset_query();
                    
                    ?>
                </ul>   <!-- .slider -->  
                  <div class="sliderControlls">
				        <div class="sliderNav small hide-for-small">
				       		 <a href="javascript:void(0)" class="nextSlide disabled prev_<?php echo $sliderrandomid ?>"><span class="icon-angle-left"></span></a>
				       		 <a href="javascript:void(0)" class="prevSlide next_<?php echo $sliderrandomid ?>"><span class="icon-angle-right"></span></a>
				        </div>
       			   </div><!-- .sliderControlls -->
       		 </div> <!-- .iOsslider -->
    </div><!-- .row .column-slider -->

    
    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


add_shortcode("ux_product_categories", "ux_product_categories");
add_shortcode("ux_bestseller_products", "ux_best_sellers");
add_shortcode("ux_featured_products", "ux_featured_products");
add_shortcode("ux_sale_products", "ux_sale_products");
add_shortcode("ux_latest_products", "ux_latest_products");
add_shortcode("ux_custom_products", "ux_custom_products");



