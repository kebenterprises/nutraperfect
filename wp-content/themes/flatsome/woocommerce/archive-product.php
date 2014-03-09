<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $flatsome_opt;
get_header('shop'); ?>

<div class="cat-header">
<?php 
// GET CUSTOM HEADER CONTENT FOR CATEGORY
if(function_exists('get_term_meta')){
	$queried_object = get_queried_object();
	
	if (isset($queried_object->term_id)){

		$term_id = $queried_object->term_id;  
		$content = get_term_meta($term_id, 'cat_meta');

		if(isset($content[0]['cat_header'])){
			echo do_shortcode($content[0]['cat_header']);
		}
	}
}
?>
</div>

<?php if(isset($flatsome_opt['html_shop_page']) && is_shop()) {
	// Add Custom HTML for shop page header
	echo do_shortcode($flatsome_opt['html_shop_page']);
} ?>


<div class="row category-page">

<?php
	/**
	 * woocommerce_before_main_content hook
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 */
	do_action('woocommerce_before_main_content');
?>
<div class="large-12 columns">
	<div class="breadcrumb-row">
    <div class="left">
	<?php 
	/** Output the WooCommerce Breadcrumb  */
    $defaults = array(
        'delimiter'  => '<span>/</span>',
        'wrap_before'  => '<h3 class="breadcrumb">',
        'wrap_after' => '</h3>',
        'before'   => '',
        'after'   => '',
        'home'    => 'Home'
    );
    $args = wp_parse_args(  $defaults  );
    woocommerce_get_template( 'global/breadcrumb.php', $args );
    ?>
    </div><!-- .left -->

    <div class="right">
    <?php if ( have_posts() ) : do_action( 'woocommerce_before_shop_loop' ); ?><?php endif; ?>
    </div><!-- .right -->
</div><!-- .breadcrumb-row -->
</div><!-- .large-12 breadcrumb -->



<?php if($flatsome_opt['category_sidebar'] == 'right-sidebar') { ?>
       <div class="large-9 columns left">
<?php } else if ($flatsome_opt['category_sidebar'] == 'left-sidebar') { ?>
		<div class="large-9 columns right">
<?php } else { ?>
		<div class="large-12 columns">
<?php } ?>


    <?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'product' ); ?>
				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

  <?php if( $flatsome_opt['search_result'] && get_search_query() ) : ?>
    <?php
      /**
       * Include pages and posts in search
       */
      query_posts( array( 'post_type' => array( 'post', 'page' ), 's' => get_search_query() ) );

      if(have_posts()){ echo '<div class="row"><div class="large-12 columns"><hr/>'; }

      while ( have_posts() ) : the_post();
        $wc_page = false;
        if($post->post_type == 'page'){
          foreach (array('myaccount', 'edit_address', 'change_password', 'lost_password', 'shop', 'cart', 'checkout', 'pay', 'view_order', 'thanks', 'terms') as $wc_page_type) {
            if( $post->ID == woocommerce_get_page_id($wc_page_type) ) $wc_page = true;
          }
        }
        if( !$wc_page ) get_template_part( 'content', get_post_format() );
      endwhile;

      if(have_posts()){ echo '</div></div>'; }

      wp_reset_query();
    ?>
  <?php endif; ?>
                      
 </div><!-- .large-12 -->

<?php if($flatsome_opt['category_sidebar'] == 'right-sidebar') { ?>
<!-- Right Shop sidebar -->
        <div class="large-3 right columns">
            <?php dynamic_sidebar('shop-sidebar'); ?>
        </div>            
<?php } else if ($flatsome_opt['category_sidebar'] == 'left-sidebar') { ?>
<!-- Left Shop sidebar -->
		<div class="large-3 left columns">
            <?php dynamic_sidebar('shop-sidebar'); ?>
        </div>
<?php } ?>



</div><!-- end row -->

<?php get_footer('shop'); ?>