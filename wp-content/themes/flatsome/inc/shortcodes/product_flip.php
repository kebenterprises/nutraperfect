<?php
// [ux_product_flip]
function ux_product_flip($atts, $content = null) {

  /* register script */
  wp_register_script( 'flatsome-flip', get_template_directory_uri() .'/js/jquery.mobile.flip.js', array( 'jquery' ), '20120202', true );
  wp_enqueue_script('flatsome-flip');

	global $woocommerce;
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'products'  => '8',
    'height' => '600',
    'cat' => '',

	), $atts));
	ob_start();

   $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'product_cat' => $cat,
            'products' => $products
        );
	?>
<div class="container">
  <div class="row">
    <div class="large-12 columns">
      <div id="flipRoot" class="flipContainer">
            <?php if($content) { ?>
            <div class="row-collapse flip-slide">
              <div class="large-12 columns">
                 <?php echo do_shortcode($content); ?>
              </div><!-- large-6 -->
             </div><!-- row -->
             <?php } ?>

               <?php
                  $products = new WP_Query( $args );
                  if ( $products->have_posts() ) : ?>
                      <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                       <div class="row-collapse">
                          <?php woocommerce_get_template_part( 'content', 'product-flipbook' ); ?>
                        </div>
                      <?php endwhile; // end of the loop. ?>
                  <?php
                  endif; 
                  wp_reset_query();
              ?>
      </div>
    </div>
  </div>
</div>
	<script type="text/javascript">

	jQuery(document).ready(function($) {
			 $("#flipRoot").flip({
        height: '<?php echo $height."px"; ?>',
        showPager: true,
        loop: false
      });
	});

	</script>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("ux_product_flip", "ux_product_flip");