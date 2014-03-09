<?php
register_post_type('blocks', array(	'label' => 'Blocks','description' => 'Create blocks that can be used in posts, pages and widgets.','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'page','hierarchical' => true,'rewrite' => array('slug' => ''),'query_var' => true,'has_archive' => true,'exclude_from_search' => true,'supports' => array('title','editor','custom-fields','revisions','author',),'labels' => array (
  'name' => 'Blocks',
  'singular_name' => 'Block',
  'menu_name' => 'Blocks',
  'add_new' => 'Add block',
  'add_new_item' => 'Add New block',
  'edit' => 'Edit',
  'edit_item' => 'Edit block',
  'new_item' => 'New block',
  'view' => 'View block',
  'view_item' => 'View block',
  'search_items' => 'Search Blocks',
  'not_found' => 'No Blocks Found',
  'not_found_in_trash' => 'No Blocks Found in Trash',
  'parent' => 'Parent block',
),) );



add_filter( 'manage_edit-blocks_columns', 'my_edit_blocks_columns' ) ;

function my_edit_blocks_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Title' ),
		'shortcode' => __( 'Shortcode' ),
		'date' => __( 'Date' )
	);

	return $columns;
}



add_action( 'manage_blocks_posts_custom_column', 'my_manage_blocks_columns', 10, 2 );
function my_manage_blocks_columns( $column, $post_id ) {
	global $post;

	 $post_data = get_post($post_id, ARRAY_A);
	 $slug = $post_data['post_name'];

	switch( $column ) {
		case 'shortcode' :
			echo '<span style="background:#eee;font-weight:bold;"> [block id="'.$slug.'"] </span>';
		break;
	}
}


/* ADD SHORTCODE */

// [block id=""]
function block_shortcode($atts, $content = null) {	
	 extract( shortcode_atts( array(
    	'id' => ''
  	 ), $atts ) );

	// get content by slug
	global $wpdb;
	$post_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$id'");

	if($post_id){
		$html =	get_post_field('post_content', $post_id);

		// add edit link for admins
		if (current_user_can('edit_posts')) {
		   $edit_link = get_edit_post_link( $post_id ); 
	 	   $html = '<div class="ux_block"><a class="edit-link" href="'.$edit_link.'">Edit Block</a>'.$html.'</div>';
		}

		$html = do_shortcode( $html );

	} else{
		
		$html = '<p><mark>UX Block <b>"'.$id.'"</b> not found! Wrong ID?</mark></p>';	
	
	}

	return $html;
}
add_shortcode('block', 'block_shortcode');