<?php

class TinyMCE_Buttons {
	function __construct() {
    	add_action( 'init', array(&$this,'init') );
    }
    function init() {
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;		
		if ( get_user_option('rich_editing') == 'true' ) {  
			add_filter( 'mce_external_plugins', array(&$this, 'add_plugin') );  
			add_filter( 'mce_buttons', array(&$this,'register_button') ); 
			}  
    }  
	function add_plugin($plugin_array) {  
	   $plugin_array['shortcodes'] = get_template_directory_uri() .'/inc/shortcodes/inserter/js/tinymce.js';
	   return $plugin_array; 
	}
	function register_button($buttons) {  
	   array_push($buttons, "shortcodes_button");
	   return $buttons; 
	} 	
}
$shortcode = new TinyMCE_Buttons;