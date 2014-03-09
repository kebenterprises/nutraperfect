<?php

// CONTENT
//  - Blog post navigation (flatsome_content_nav)
//  - Comments (flatsome_comments)
//  - Post meta top (flatsome_posted_on)
//  - Blog categories (flatsome_categorized_blog)
//  - Custom dropdown for main menu (FlatsomeNavDropdown)
//  - Add to cart dropdown (flatsome_add_to_cart_dropdown)
//  - Next / Prev navigation on product pages
//  - Blog - Add "Read more" links
//  - Product Quick View
//  - Catalog Mode (1.3)

global $flatsome_opt;

if ( ! function_exists( 'flatsome_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function flatsome_content_nav( $nav_id ) {
    global $wp_query, $post;

    // Don't print empty markup on single pages if there's nowhere to navigate.
    if ( is_single() ) {
        $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
        $next = get_adjacent_post( false, '', false );

        if ( ! $next && ! $previous )
            return;
    }

    // Don't print empty markup in archives if there's only one page.
    if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
        return;

    $nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';

    ?>
    <nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
    <?php if ( is_single() ) : // navigation links for single posts ?>

        <?php previous_post_link( '<div class="nav-previous left">%link</div>', '<span class="icon-angle-left">' . _x( '', 'Previous post link', 'flatsome' ) . '</span> %title' ); ?>
        <?php next_post_link( '<div class="nav-next right">%link</div>', '%title <span class="icon-angle-right">' . _x( '', 'Next post link', 'flatsome' ) . '</span>' ); ?>

    <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

        <?php if ( get_next_posts_link() ) : ?>
        <div class="nav-previous"><?php next_posts_link( __( '<span class="icon-angle-left"></span> Older posts', 'flatsome' ) ); ?></div>
        <?php endif; ?>

        <?php if ( get_previous_posts_link() ) : ?>
        <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="icon-angle-right"></span>', 'flatsome' ) ); ?></div>
        <?php endif; ?>

    <?php endif; ?>

    </nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
    <?php
}
endif; // flatsome_content_nav


if ( ! function_exists( 'flatsome_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function flatsome_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'flatsome' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'flatsome' ), '<span class="edit-link">', '<span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment-inner">

            <div class="row collapse">
                <div class="large-2 columns">
                    <div class="comment-author">
                    <?php echo get_avatar( $comment, 80 ); ?>
                </div>
                </div><!-- .large-3 -->

                <div class="large-10 columns">
                    <?php printf( __( '%s <span class="says">says:</span>', 'flatsome' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><?php _e( 'Your comment is awaiting moderation.', 'flatsome' ); ?></em>
                    <br />
                     <?php endif; ?>

                <div class="comment-content"><?php comment_text(); ?></div>


                 <div class="comment-meta commentmetadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
                    <?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'flatsome' ), get_comment_date(), get_comment_time() ); ?>
                    </time></a>
                    <?php edit_comment_link( __( 'Edit', 'flatsome' ), '<span class="edit-link">', '<span>' ); ?>
                    
                    <div class="reply right">
            <?php
                comment_reply_link( array_merge( $args,array(
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                ) ) );
            ?>
            </div><!-- .reply -->


                </div><!-- .comment-meta .commentmetadata -->

                </div><!-- .large-10 columns -->

            </div><!-- .row -->

		</article>
    <!-- #comment -->

	<?php
			break;
	endswitch;
}
endif; // ends check for flatsome_comment()

if ( ! function_exists( 'flatsome_posted_on' ) ) :


    
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function flatsome_posted_on() {
	printf( __( '<span class="meta-author">by <strong><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></strong>.</span> Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>', 'flatsome' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'flatsome' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;



/* CUSTOM NAV WALKER */
class FlatsomeNavDropdown extends Walker_Nav_Menu
{
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $display_depth = ($depth + 1); // because it counts the first submenu as 0
        if($display_depth == '1'){$class_names = 'nav-dropdown';}
        else {$class_names = 'nav-column-links';}
        $indent = str_repeat("\t", $depth);
             $output .= "\n$indent<div class=".$class_names."><ul>\n";
    }

    function end_lvl( &$output, $depth = 1, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }

    function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    // Most of this code is copied from original Walker_Nav_Menu
    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $class_names = $value = '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = ' class="' . esc_attr( $class_names ) . '"';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

    // Check if menu item is in main menu
    if ( $depth == 0 ) {
        // These lines adds your custom class and attribute
        $attributes .= ' class="nav-top-link"';
    }

    $description = '';
    if(strpos($class_names,'image-column') !== false){$description = '<img src="'.$item->description.'" alt=" "/>';}

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= $description;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  } 

}


add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item'; 
		}
	}
	
	return $items;    
}




/*  ADD TO CART DROPDOWN (gets inserted with ajax) */
add_filter('add_to_cart_fragments', 'flatsome_add_to_cart_dropdown'); 
function flatsome_add_to_cart_dropdown( $fragments ) {
	global $woocommerce;
    global $flatsome_opt;
	ob_start();
	?>
	<div class="cart-inner">
	<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="cart-link">
					<strong class="cart-name hide-for-small"><?php _e('Cart', 'flatsome'); ?></strong> 
					<span class="cart-price hide-for-small">/ <?php echo $woocommerce->cart->get_cart_total(); ?></span> 
                        
					<!-- cart icon -->
					<div class="cart-icon">
                        <?php if ($flatsome_opt['custom_cart_icon']){ ?> 
                        <div class="custom-cart-inner">
                        <div class="custom-cart-count"><?php echo $woocommerce->cart->cart_contents_count; ?></div>
                        <img class="custom-cart-icon" src="<?php echo $flatsome_opt['custom_cart_icon']?>"/> 
                        </div><!-- .custom-cart-inner -->
                        <?php } else { ?> 

                         <strong><?php echo $woocommerce->cart->cart_contents_count; ?></strong>
                         <span class="cart-icon-handle"></span>
                        <?php } ?>
					</div><!-- end cart icon -->

					</a>
							<div class="nav-dropdown">
                                <div class="nav-dropdown-inner">
                                <div class="cart_list">
                                <?php                                    
                                    if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
                                        $_product = $cart_item['data'];                                            
                                        if ($_product->exists() && $cart_item['quantity']>0) :  ?>  

                                      	<div class="row mini-cart-item collapse">
                                      		<div class="small-2 large-2 columns">
                                      			<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><span class="icon-close"></span></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce') ), $cart_item_key ); ?>
                                      		</div>
                                      		<div class="small-7 large-7 columns"><?php 
                                      			 $product_title = $_product->get_title();
                                                 echo '<a class="cart_list_product_title" href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $product_title, $_product) . '</a>';
                                                 echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).' /</div>';
                                                 echo '<div class="cart_list_product_quantity">'.__('Quantity', 'woocommerce').': '.$cart_item['quantity'].'</div>';

                                      		?></div>
                                      		<div class="small-3 large-3 columns">
                                      			<?php   echo '<a class="cart_list_product_img" href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_image().'</a>';                                                    ?>
                                      		</div>
                                      	</div><!-- end row -->

                                <?php                                        
                                    endif;                                        
                                    endforeach;
                                ?>

                                </div><!-- Cart list -->
                                            
                                    <div class="minicart_total_checkout">                                        
                                        <?php _e('Cart Subtotal', 'woocommerce'); ?><span><?php echo $woocommerce->cart->get_cart_total(); ?></span>                                   
                                    </div>
                                    
                                    <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button expand uppercase"><?php _e('View Cart', 'flatsome'); ?></a>   
                                    
                                    <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button secondary expand uppercase"><?php _e('Proceed to Checkout', 'flatsome'); ?></a>
                                    
                                    <?php                                        
                                    else: echo '<p class="empty">'.__('No products in the cart.','woocommerce').'</p>'; endif;                                    
                                ?>                                                                        
                            </div><!-- .nav-dropdown-inner -->
						</div><!-- .nav-dropdown -->
	</div><!-- .cart-inner -->

	<?php
	$fragments['.cart-inner'] = ob_get_clean();
	return $fragments;
}


 /* PRODUCT PAGE REVIEW STARS */
  function ProductShowReviews(){
            if ( comments_open() ) {
                global $wpdb;
                global $post;
            
                $count = $wpdb->get_var("
                    SELECT COUNT(meta_value) FROM $wpdb->commentmeta
                    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
                    WHERE meta_key = 'rating'
                    AND comment_post_ID = $post->ID
                    AND comment_approved = '1'
                    AND meta_value > 0
                ");
            
                $rating = $wpdb->get_var("
                    SELECT SUM(meta_value) FROM $wpdb->commentmeta
                    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
                    WHERE meta_key = 'rating'
                    AND comment_post_ID = $post->ID
                    AND comment_approved = '1'
                ");
            
                if ( $count > 0 ) {
            
                    $average = number_format($rating / $count, 2);
            
                    echo '<a href="#tab-reviews" class="scroll-to-reviews"><div class="star-rating tip-top" data-tip="'.$count.' review(s)"><span style="width:'.($average*16).'px"><span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" class="rating"><span itemprop="ratingValue">'.$average.'</span><span itemprop="reviewCount" class="hidden">'.$count.'</span></span> '.__('out of 5', 'woocommerce').'</span></div></a>';

                }
                
            }}

add_action('woocommerce_single_product_summary','ProductShowReviews', 15);
            




/* NAXT / PREV NAV ON PRODUCT PAGES */
function next_post_link_product($format='%link &raquo;', $link='%title', $in_same_cat = false, $excluded_categories = '') {
    adjacent_post_link_product($format, $link, $in_same_cat, $excluded_categories, false);
}

function previous_post_link_product($format='&laquo; %link', $link='%title', $in_same_cat = false, $excluded_categories = '') {
    adjacent_post_link_product($format, $link, $in_same_cat, $excluded_categories, true);
}

function adjacent_post_link_product( $format, $link, $in_same_cat = false, $excluded_categories = '', $previous = true ) {
    if ( $previous && is_attachment() )
        $post = get_post( get_post()->post_parent );
    else
        $post = get_adjacent_post_product( $in_same_cat, $excluded_categories, $previous );

    if ( ! $post ) {
        $output = '';
    } else {
        $title = $post->post_title;

        if ( empty( $post->post_title ) )
            $title = $previous ? __( 'Previous Post' ) : __( 'Next Post' );

        $title = apply_filters( 'the_title', $title, $post->ID );

        $feat_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID) );

        $image = 
        $date = mysql2date( get_option( 'date_format' ), $post->post_date );
        $rel = $previous ? 'prev' : 'next';

        $string = '<div class="prod-dropdown"><a href="' . get_permalink( $post ) . '" rel="'.$rel.'" class="';
        $inlink = str_replace( '%title', $title, $link );
        $inlink = $string . $inlink . '"></a><div class="nav-dropdown"><a href="' . get_permalink( $post ) . '">'.get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) ).'</a></div></div>';
        $output = str_replace( '%link', $inlink, $format );
    }

    $adjacent = $previous ? 'previous' : 'next';

    echo apply_filters( "{$adjacent}_post_link", $output, $format, $link, $post );
}

function get_adjacent_post_product( $in_same_cat = false, $excluded_categories = '', $previous = true ) {
    global $wpdb;

    if ( ! $post = get_post() )
        return null;

    $current_post_date = $post->post_date;
    $join = '';
    $posts_in_ex_cats_sql = '';
    if ( $in_same_cat || ! empty( $excluded_categories ) ) {
        $join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";

        if ( $in_same_cat ) {
            if ( ! is_object_in_taxonomy( $post->post_type, 'product_cat' ) )
                return '';
            $cat_array = wp_get_object_terms($post->ID, 'product_cat', array('fields' => 'ids'));
            if ( ! $cat_array || is_wp_error( $cat_array ) )
                return '';
            $join .= " AND tt.taxonomy = 'product_cat' AND tt.term_id IN (" . implode(',', $cat_array) . ")";
        }

        $posts_in_ex_cats_sql = "AND tt.taxonomy = 'product_cat'";
        if ( ! empty( $excluded_categories ) ) {
            if ( ! is_array( $excluded_categories ) ) {
                // back-compat, $excluded_categories used to be IDs separated by " and "
                if ( strpos( $excluded_categories, ' and ' ) !== false ) {
                    _deprecated_argument( __FUNCTION__, '3.3', sprintf( __( 'Use commas instead of %s to separate excluded categories.' ), "'and'" ) );
                    $excluded_categories = explode( ' and ', $excluded_categories );
                } else {
                    $excluded_categories = explode( ',', $excluded_categories );
                }
            }

            $excluded_categories = array_map( 'intval', $excluded_categories );

            if ( ! empty( $cat_array ) ) {
                $excluded_categories = array_diff($excluded_categories, $cat_array);
                $posts_in_ex_cats_sql = '';
            }

            if ( !empty($excluded_categories) ) {
                $posts_in_ex_cats_sql = " AND tt.taxonomy = 'product_cat' AND tt.term_id NOT IN (" . implode($excluded_categories, ',') . ')';
            }
        }
    }

    $adjacent = $previous ? 'previous' : 'next';
    $op = $previous ? '<' : '>';
    $order = $previous ? 'DESC' : 'ASC';

    $join  = apply_filters( "get_{$adjacent}_post_join", $join, $in_same_cat, $excluded_categories );
    $where = apply_filters( "get_{$adjacent}_post_where", $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type = %s AND p.post_status = 'publish' $posts_in_ex_cats_sql", $current_post_date, $post->post_type), $in_same_cat, $excluded_categories );
    $sort  = apply_filters( "get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1" );

    $query = "SELECT p.id FROM $wpdb->posts AS p $join $where $sort";
    $query_key = 'adjacent_post_' . md5($query);
    $result = wp_cache_get($query_key, 'counts');
    if ( false !== $result ) {
        if ( $result )
            $result = get_post( $result );
        return $result;
    }

    $result = $wpdb->get_var( $query );
    if ( null === $result )
        $result = '';

    wp_cache_set($query_key, $result, 'counts');

    if ( $result )
        $result = get_post( $result );

    return $result;
}



/* BLOG - Add class to read more on blogs */
function flatsome_add_morelink_class( $link, $text )
{
    return str_replace(
         'more-link'
        ,'more-link button small'
        ,$link
    );
}
add_action( 'the_content_more_link', 'flatsome_add_morelink_class', 10, 2 );



/* PRODUCT QUICK VIEW  */
add_action('wp_head', 'wpse83650_lazy_ajax', 0, 0);
function wpse83650_lazy_ajax()
{
    ?>
    <script type="text/javascript">
    /* <![CDATA[ */
    var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
    /* ]]> */
    </script>
    <?php
}
add_action('wp_ajax_jck_quickview', 'jck_quickview');
add_action('wp_ajax_nopriv_jck_quickview', 'jck_quickview');

/** The Quickview Ajax Output **/
function jck_quickview() {
    global $post, $product, $woocommerce;
    $prod_id =  $_POST["product"];
    $post = get_post($prod_id);
    $product = get_product($prod_id);
    ob_start();
?>

<?php woocommerce_get_template( 'content-single-product-lightbox.php'); ?>

<?php
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
    die();
}



/* PRODUCT QUICK VIEW HOOKS */
add_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_add_to_cart', 30 );


/* CATALOG MODE SETTINGS */
if(isset($_GET["catalog-mode"]) || $flatsome_opt['catalog_mode']){
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
    remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
    remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
    remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
    remove_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_add_to_cart', 30 );

        if(isset($_GET["catalog-mode"]) || $flatsome_opt['catalog_mode_prices']){
                remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
                remove_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_price', 10 );
        }

        function catalog_mode_product(){
            global $flatsome_opt;
            echo '<div class="catalog-product-text">';
            echo do_shortcode($flatsome_opt['catalog_mode_product']);
            echo '</div>';
        }
        add_action('woocommerce_single_product_summary', 'catalog_mode_product', 30);

        function catalog_mode_lightbox(){
            global $flatsome_opt;
            echo '<div class="catalog-product-text">';
            echo do_shortcode($flatsome_opt['catalog_mode_lightbox']);
            echo '</div>';
        }
        add_action( 'woocommerce_single_product_lightbox_summary', 'catalog_mode_lightbox', 30 );

}

/**
 * Edit $wp_query before it is being run.
 */
function flatsome_pre_get_posts_action( $query ) {
    global $flatsome_opt;
    $action = isset($_GET['action']) ? $_GET['action'] : '';
    // Stop if searching from admin
    if($action == 'woocommerce_json_search_products') {
        return;
    }
    // Include posts and pages in ajax search.
    if(defined('DOING_AJAX') && DOING_AJAX && !empty($query->query_vars['s']) && $flatsome_opt['search_result']) {
        $query->query_vars['post_type'] = array( $query->query_vars['post_type'], 'post', 'page' );
        $query->query_vars['meta_query'] = new WP_Meta_Query( array( 'relation' => 'OR', $query->query_vars['meta_query'] ) );
    }
}
add_action('pre_get_posts', 'flatsome_pre_get_posts_action');

/**
 * Edit $wp_query results.
 */
function flatsome_posts_results_filter( $posts, $query ) {
    global $flatsome_opt;
    // Exclude WooCommerce pages in ajax search.
    if (defined('DOING_AJAX') && DOING_AJAX && !empty($query->query_vars['s']) && $flatsome_opt['search_result']) {
        foreach ($posts as $key => $post) {
            foreach (array('myaccount', 'edit_address', 'change_password', 'lost_password', 'shop', 'cart', 'checkout', 'pay', 'view_order', 'thanks', 'terms') as $wc_page_type) {
                if( $post->ID == woocommerce_get_page_id($wc_page_type) ) unset($posts[$key]);
            }
        }
    }
    return $posts;
}
add_filter( 'posts_results', 'flatsome_posts_results_filter', 10, 2 );