<?php
/**
 * Product Page Breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $wp_query, $flatsome_opt;

$prepend      = '';
$permalinks   = get_option( 'woocommerce_permalinks' );
$shop_page_id = woocommerce_get_page_id( 'shop' );
$shop_page    = get_post( $shop_page_id );
$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
$shop_page_title =  get_the_title( woocommerce_get_page_id( 'shop' ) );


// If permalinks contain the shop page in the URI prepend the breadcrumb with shop
if ( $shop_page_id && strstr( $permalinks['product_base'], '/' . $shop_page->post_name ) && get_option( 'page_on_front' ) !== $shop_page_id ) {
	$prepend = $before . '<a href="' . get_permalink( $shop_page ) . '">' . $shop_page->post_title . '</a>' . $after . $delimiter;
}

if ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && get_option( 'page_on_front' ) == woocommerce_get_page_id( 'shop' ) ) ) || is_paged() ) {

	echo $wrap_before;
	if ( get_post_type() == 'product' ) {
		   if(!isset($flatsome_opt['breadcrumb_home']) || $flatsome_opt['breadcrumb_home']){ 
				if ( ! empty( $home ) ) {
					echo $before . '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) . '">';
					_e('Home', 'flatsome');
					echo  '</a>' . $after . $delimiter;	} 
			}
			echo $prepend;

			if ( $terms = wp_get_post_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {

				$main_term = $terms[0];

				$ancestors = get_ancestors( $main_term->term_id, 'product_cat' );

				$ancestors = array_reverse( $ancestors );

				foreach ( $ancestors as $ancestor ) {
					$ancestor = get_term( $ancestor, 'product_cat' );

					echo $before . '<a href="' . get_term_link( $ancestor->slug, 'product_cat' ) . '">' . $ancestor->name . '</a>' . $after . $delimiter;
				}

				echo $before . '<a href="' . get_term_link( $main_term->slug, 'product_cat' ) . '">' . $main_term->name . '</a>' . $after;
			}


		}

	echo $wrap_after;

}