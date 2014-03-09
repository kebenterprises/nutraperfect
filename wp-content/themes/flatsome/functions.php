<?php
/**
 * Flatsome functions and definitions
 *
 * @package flatsome
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) $content_width = 1000; /* pixels */

/* INCLUDES */
add_theme_support( 'woocommerce' );

/* Add theme option panel */
require_once('admin/index.php'); // load theme option panel

global $flatsome_opt;
$flatsome_opt = $smof_data;

/** Load selected google fonts */
include_once( get_template_directory() . '/inc/google-fonts.php' );

/************ Plugin recommendations **********/
require_once ('inc/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'flatsome_register_required_plugins' );
function flatsome_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(


		array(
			'name'     				=> 'WooCommerce', // The plugin name
			'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/woocommerce.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'Ninja Forms', // The plugin name
			'slug'     				=> 'ninja-forms', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/ninja-forms.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.2.41', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'Regenerate Thumbnails', // The plugin name
			'slug'     				=> 'regenerate-thumbnails', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/regenerate-thumbnails.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.2.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		
		array(
			'name'     				=> 'Taxonomy Metadata', // The plugin name
			'slug'     				=> 'taxonomy-metadata', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/taxonomy-metadata.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '0.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Unlimited Sidebars Woosidebars', // The plugin name
			'slug'     				=> 'woosidebars', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/woosidebars.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.2.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Envato Toolkit', // The plugin name
			'slug'     				=> 'envato-wordpress-toolkit-master', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/envato-wordpress-toolkit-master.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'YITH WooCommerce Ajax Search', // The plugin name
			'slug'     				=> 'yith-woocommerce-ajax-search', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/yith-woocommerce-ajax-search.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
			array(
			'name'     				=> 'YITH WooCommerce Wishlist', // The plugin name
			'slug'     				=> 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/yith-woocommerce-wishlist.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
			array(
			'name'     				=> 'UX Featured Item Post Type', // The plugin name
			'slug'     				=> 'ux-featured-item', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/ux-featured-item.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
			array(
			'name'     				=> 'Nextend Facebook Connect', // The plugin name
			'slug'     				=> 'nextend-facebook-connect', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/nextend-facebook-connect.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.4.59', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)

	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'flatsome',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', '' ),
			'menu_title'                       			=> __( 'Install Plugins', 'flatsome' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'flatsome' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'flatsome' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'flatsome' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'flatsome' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'flatsome' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}


if ( ! function_exists( 'flatsome_setup' ) ) :
function flatsome_setup() {

	/* Custom CSS */
	require( get_template_directory() . '/inc/custom-css.php' );

	/* Custom template tags */
	require( get_template_directory() . '/inc/template-tags.php' );

	/*  Custom functions that act independently of the theme templates */
	require( get_template_directory() . '/inc/extras.php' );

	/* load theme languages */
	load_theme_textdomain( 'flatsome', get_template_directory() . '/languages' );

	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );

	/* Add support for post thumbnails */
	add_theme_support( 'post-thumbnails' );

	/*  Registrer menus. */
	register_nav_menus( array(
		'primary' => __( 'Main Menu', 'flatsome' ),
		'footer' => __( 'Footer Menu', 'flatsome' ),
		'top_bar_nav' => __( 'Top bar Menu', 'flatsome' ),
		'my_account' => __( 'My Account Menu', 'flatsome' ),
	) );

	/*  Enable support for Post Formats */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // flatsome_setup
add_action( 'after_setup_theme', 'flatsome_setup' );


/**
 * Register widgetized area and update sidebar with default widgets
 */
function flatsome_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'flatsome' ),
		'id'            => 'sidebar-main',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );


	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'flatsome' ),
		'id'            => 'shop-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title shop-sidebar">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Product Sidebar', 'flatsome' ),
		'id'            => 'product-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title shop-sidebar">',
		'after_title'   => '</h3>',
	) );


	 register_sidebar( array(
		'name'          => __( 'Footer 1 (4 column)', 'flatsome' ),
		'id'            => 'sidebar-footer-1',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );


	 register_sidebar( array(
		'name'          => __( 'Footer 2 (4 column)', 'flatsome' ),
		'id'            => 'sidebar-footer-2',
		'before_widget' => '<div id="%1$s" class="large-3 columns widget left %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3><div class="tx-div small"></div>',
	) );


}
add_action( 'widgets_init', 'flatsome_widgets_init' );



/* INCLUDE FLATSOME WIDGETS */
include_once('inc/widgets/recent-posts.php'); // Load Widget Recent Posts
include_once('inc/widgets/upsell-widget.php'); // Load Upsell widget



/**
 * Enqueue scripts and styles
 */
function flatsome_scripts() {
	
	global $flatsome_opt;

	/* styles */
	wp_enqueue_style( 'flatsome-icons', get_template_directory_uri() .'/css/fonts.css', array(), '1.8.5', 'all' );
	wp_enqueue_style( 'flatsome-animations', get_template_directory_uri() .'/css/animations.css', array(), '1.8.5', 'all' );

	/* main style */
	wp_enqueue_style( 'flatsome-style', get_stylesheet_uri(), array(), '1.8.5', 'all');	

	/* JS libaries */
	wp_enqueue_script( 'flatsome-modernizer', get_template_directory_uri() .'/js/modernizr.js', array( 'jquery' ), '20120202', true );
 	wp_enqueue_script( 'flatsome-plugins', get_template_directory_uri() .'/js/plugins.js', array( 'jquery' ), '20120202', true );
	wp_enqueue_script( 'flatsome-iosslider', get_template_directory_uri() .'/js/jquery.iosslider.min.js', array( 'jquery' ), '20120202', true );
	wp_enqueue_script( 'flatsome-magnific-popup', get_template_directory_uri() .'/js/jquery.magnific-popup.js', array( 'jquery' ), '20120202', true );
	wp_enqueue_script( 'flatsome-theme-js', get_template_directory_uri() .'/js/theme.js?v=1.8.5', array( 'jquery' ), '20120202', true );
	
	/* remove woocommerce add-to-cart variation.js. Its added in theme.js */
	wp_deregister_script('wc-add-to-cart-variation');

	/* Remove styles included plugins have added */
	wp_deregister_style('yith-wcwl-font-awesome');
	wp_deregister_style('yith-wcwl-font-awesome-ie7');
	wp_deregister_style('yith-wcwl-main');
	wp_deregister_style('nextend_fb_connect_stylesheet');	
	wp_deregister_style('yith_wcas_frontend');	

	if ( ! is_admin() ) {
	wp_deregister_style('woocommerce-layout');	
	wp_deregister_style('woocommerce-smallscreen');	
	wp_deregister_style('woocommerce-general');	
	}


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'flatsome_scripts' );




/* ADD WP ADMIN BAR LINK TO THEME OPTIONS */

// Admin Bar Customisation
function flatsome_admin_bar_render() {
 global $wp_admin_bar;

 // Add a new top level menu link
 // Here we add a customer support URL link
 $optionUrl = get_admin_url().'/themes.php?page=optionsframework';
 $wp_admin_bar->add_menu( array(
 'parent' => false,
 'id' => 'customer_support',
 'title' => __('Flatsome Theme Options'),
 'href' => $optionUrl
 ));
}
add_action( 'wp_before_admin_bar_render', 'flatsome_admin_bar_render' );


/* UNREGISTRER DEFAULT WOOCOMMERCE HOOKS */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_show_messages', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );



/* add shortcode to widgets */
add_filter('widget_text', 'do_shortcode');

/* add shortcode to excerpt */
add_filter('the_excerpt', 'do_shortcode');

/* add exerpt option to pages */
add_action('init', 'flatsome_post_type_support');
function flatsome_post_type_support() {
	add_post_type_support( 'page', 'excerpt' );
}

/* SHORTCODES */
include_once('inc/shortcodes/accordion.php');
include_once('inc/shortcodes/tabs.php');
include_once('inc/shortcodes/buttons.php');
include_once('inc/shortcodes/grid.php');
include_once('inc/shortcodes/slider.php');
include_once('inc/shortcodes/share_follow.php');
include_once('inc/shortcodes/titles_dividers.php');
include_once('inc/shortcodes/blog_posts.php');
include_once('inc/shortcodes/testimonials.php');
include_once('inc/shortcodes/banners.php');
include_once('inc/shortcodes/google_maps.php');
include_once('inc/shortcodes/product_sliders.php');
include_once('inc/shortcodes/product_lookbook.php');
include_once('inc/shortcodes/product_pinterest_style.php');
include_once('inc/shortcodes/featured_box.php');
include_once('inc/shortcodes/team_members.php');
include_once('inc/shortcodes/messages.php');
include_once('inc/shortcodes/search.php');
include_once('inc/shortcodes/lightbox.php');
include_once('inc/shortcodes/product_flip.php');

/* SHORTCODE INSERTER */
include_once('inc/shortcodes/inserter/tinymce.php');

/* CUSTOM POST TYPES */
include_once('inc/post-types/blocks.php');

/* ADD CUSTOM WP_EDITOR CSS */
add_filter('mce_css', 'my_editor_style');
function my_editor_style($url) {
  if ( !empty($url) )
    $url .= ',';
  // Change the path here if using sub-directory
  $url .= trailingslashit( get_stylesheet_directory_uri() ) . 'css/editor.css';
  return $url;
}


/* ADD IE 8/9 FIX TO HEADER */
function add_ieFix () {
	$ie_css = get_template_directory_uri() .'/css/ie8.css';
    echo '<!--[if lt IE 9]>';
    echo '<link rel="stylesheet" type="text/css" href="'.$ie_css.'">';
    echo '<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo "<script>var head = document.getElementsByTagName('head')[0],style = document.createElement('style');style.type = 'text/css';style.styleSheet.cssText = ':before,:after{content:none !important';head.appendChild(style);setTimeout(function(){head.removeChild(style);}, 0);</script>";
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ieFix');


// Change product pr page if set.
if(isset($flatsome_opt['products_pr_page'])){
	$products = $flatsome_opt['products_pr_page'];
	add_filter( 'loop_shop_per_page', create_function( '$cols', "return $products;" ), 20 );
}

// Set default product columns
add_filter('loop_shop_columns', 'wc_product_columns_frontend');
            function wc_product_columns_frontend() {
                global $woocommerce, $flatsome_opt;
                // Default Value also used for categories and sub_categories
                $columns = $flatsome_opt['category_row_count'];
                // Product List
                if ( is_product_category() ) :
                    $columns = $flatsome_opt['category_row_count'];
                endif;
                //Related Products
                if ( is_product() ) :
                    $columns = $flatsome_opt['category_row_count'];;
                endif;
                //Cross Sells
                if ( is_checkout() ) :
                    $columns = $flatsome_opt['category_row_count'];;
                endif;
		return $columns; 
}

/* Redirect to Homepage when customer log out */
add_filter('logout_url', 'new_logout_url', 10, 2);
function new_logout_url($logouturl, $redir)
{
	$redir = get_option('siteurl');
	return $logouturl . '&amp;redirect_to=' . urlencode($redir);
}

/* Facebook meta tags */
if($flatsome_opt['facebook_meta'] || !is_front_page()) {
function share_meta_head() {
	global $post;
  	if (has_post_thumbnail( $post->ID ) ): ?>
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
	<!-- Facebook Share Meta -->
	<meta property="og:title" content="<?php the_title(); ?>" />
	<meta property="og:image" content="<?php echo $image[0]; ?>" />
	<meta property="og:url" content="<?php the_permalink(); ?>" />
	<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt()); ?>" />
	<?php endif;
}
add_action('wp_head', 'share_meta_head');
}

/* Shorter exerpt */
function short_excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }

    function content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
}


/**
 * Load the Envato WordPress Toolkit Library check for updates
 * and direct the user to the Toolkit Plugin if there is one
 */
function envato_toolkit_admin_init() {
    
    // include the Toolkit Library
    include_once( get_template_directory() . '/inc/envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php' );
    // use credentials used in toolkit plugin so that we don't have to show our own forms anymore
    $credentials = get_option( 'envato-wordpress-toolkit' );
    if ( empty($credentials['user_name']) || empty($credentials['api_key']) ) {
        add_action( 'admin_notices', 'envato_toolkit_credentials_admin_notices' );
        return;
    }

}
add_action( 'admin_init', 'envato_toolkit_admin_init' );

/**
 * Display a notice in the admin to remind the user to enter their credentials
 */
function envato_toolkit_credentials_admin_notices() {
    $message = sprintf( __( "To enable theme update notifications, please enter your Envato Marketplace credentials in the %s", "default" ),
                        "<a href='" . admin_url() . "admin.php?page=envato-wordpress-toolkit'>Envato WordPress Toolkit Plugin</a>" );
    echo "<div id='message' class='updated below-h2'><p>{$message}</p></div>";
}


?>