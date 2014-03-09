<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $flatsome_opt;

get_header('shop'); ?>

<div class="row product-page">
<div class="large-12 columns">

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 */
		do_action('woocommerce_before_main_content');
	?>

		<?php while ( have_posts() ) : the_post(); ?>

		<?php 
		if($flatsome_opt['product_sidebar'] == "right_sidebar") {
			woocommerce_get_template_part( 'content', 'single-product-rightcol'); 
		} else if($flatsome_opt['product_sidebar'] == "left_sidebar") {
			woocommerce_get_template_part( 'content', 'single-product-leftcol'); 
		} else {
			woocommerce_get_template_part( 'content', 'single-product' ); 
		}
		?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>


</div><!-- end large-12 -->
</div><!-- end row product-page -->

<?php get_footer('shop'); ?>