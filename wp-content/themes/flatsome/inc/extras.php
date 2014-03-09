<?php

/* CONTENT */

/* - Extra body classes */
/* - Filter for next/previous image links 
/* - Custom metabox for Product Categories
/* - Extra editor styles

/**
 * Adds custom classes to the array of body classes.
 */
function flatsome_body_classes( $classes ) {
	global $flatsome_opt;
	// add antialias to all texts 
	$classes[] = 'antialiased';

	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// adds dark header class
	if($flatsome_opt['header_color'] == 'dark'){
		$classes[] = 'dark-header';
	}

	// add stikcy header class
	if($flatsome_opt['header_sticky']){
		$classes[] = 'sticky_header';
	}	

	if($flatsome_opt['breadcrumb_size']){
		$classes[] = $flatsome_opt['breadcrumb_size'];
	}	
	
	// add logo-center class
	if($flatsome_opt['logo_position'] == 'center'){
		$classes[] = 'logo-center';
	}

	if($flatsome_opt['catalog_mode_prices']){
		$classes[] = 'no-prices';
	}

	// add boxed layout class if selected
	if($flatsome_opt['body_layout'] == 'boxed'){
		$classes[] = 'boxed';

			// add background settings
			if($flatsome_opt['body_bg_image']){
				$classes[] = $flatsome_opt['body_bg_type'];
			}

	}


	return $classes;
}
add_filter( 'body_class', 'flatsome_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function flatsome_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'flatsome_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function flatsome_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'flatsome' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'flatsome_wp_title', 10, 2 );




/* ADD CUSTOM META BOX TO CATEGORY PAGES */
if(function_exists('get_term_meta')){
function pippin_taxonomy_edit_meta_field($term) {
	// put the term ID into a variable
	$t_id = $term->term_id;
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_term_meta($t_id,'cat_meta');
	if(!$term_meta){$term_meta = add_term_meta($t_id, 'cat_meta', '');}
	 ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[cat_header]"><?php _e( 'Top Content', 'pippin' ); ?></label></th>
		<td>				
				<?php 

				$content = esc_attr( $term_meta[0]['cat_header'] ) ? esc_attr( $term_meta[0]['cat_header'] ) : ''; 
				echo '<textarea id="term_meta[cat_header]" name="term_meta[cat_header]">'.$content.'</textarea>'; ?>
			<p class="description"><?php _e( 'Enter a value for this field. Shortcodes are allowed. This will be displayed at top of the category.','pippin' ); ?></p>
		</td>
	</tr>
<?php
}
add_action( 'product_cat_edit_form_fields', 'pippin_taxonomy_edit_meta_field', 10, 2 );


/* SAVE CUSTOM META*/
function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_term_meta($t_id,'cat_meta');
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_term_meta($term_id, 'cat_meta', $term_meta);

	}
}  
add_action( 'edited_product_cat', 'save_taxonomy_custom_meta', 10, 2 );  
}





/* EXTRA EDITOR STYLES (add extra styles to the content editor box) */
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}


add_filter( 'tiny_mce_before_init', 'my_mce_before_init' );
function my_mce_before_init( $settings ) {

    $style_formats = array(

    	  array(
          'title' => 'Paragraph - Lead',
          'selector' => 'p',
          'classes' => 'lead',
  
        ),

    	  array(
          'title' => 'Paragraph - Lead, Centered',
          'selector' => 'p',
          'classes' => 'lead text-center',
  
        ),

         array(
          'title' => 'Uppercase',
          'selector' => '*',
          'classes' => 'uppercase',
  
        ),

        array(
          'title' => 'Alternative Font',
          'selector' => '*',
          'classes' => 'alt-font',
  
        ),

        array(
          'title' => 'Title - Large',
          'selector' => '*',
          'classes' => 'h-large',
  
        ),

         array(
          'title' => 'Title - X-Large',
          'selector' => '*',
          'classes' => 'h-xlarge',
  
        ),

        array(
          'title' => 'Backgroud - Black',
          'selector' => '*',
          'classes' => 'text-box-dark',
  
        ),

        array(
          'title' => 'Background - White',
          'selector' => '*',
          'classes' => 'text-box-light',
  
        ),

         array(
          'title' => 'Background - Primary Color',
          'selector' => '*',
          'classes' => 'text-box-primary',
  
        ),


        array(
          'title' => 'Text shadow',
          'selector' => '*',
          'classes' => 'drop-shadow',
  
        ),


          array(
          'title' => 'Animate -Fade In',
          'selector' => '*',
          'classes' => 'animated fadeIn',
  
        ),

        array(
          'title' => 'Animate - Fade In Left',
          'selector' => '*',
          'classes' => 'animated fadeInLeft',
  
        ),
        array(
          'title' => 'Animate - Fade In Right',
          'selector' => '*',
          'classes' => 'animated fadeInRight',
  
        ),

    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}

function add_my_editor_style() {
  add_editor_style();
}
add_action( 'admin_init', 'add_my_editor_style' );








     

