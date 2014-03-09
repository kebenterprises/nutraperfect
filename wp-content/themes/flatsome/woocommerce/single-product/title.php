<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
	<?php 
	/** Output the WooCommerce Breadcrum  */
    $defaults = array(
        'delimiter'  => '<span>/</span>',
        'wrap_before'  => '<h4 class="breadcrumb">',
        'wrap_after' => '</h4>',
        'before'   => '',
        'after'   => '',
        'home'    => true
    );
    $args = wp_parse_args(  $defaults  );
    woocommerce_get_template( 'global/breadcrumb-single-product.php', $args );
    ?>

<h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
<div class="tx-div small"></div>