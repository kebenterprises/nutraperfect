<?php
/**
 * UX Featured Item Post Type
 *
 * @package   UXFeatured ItemPostType
 * @author    UX Themes
 * @license   GPL-2.0+
 * @link      http://www.uxthemes.com/
 *
 * @wordpress-plugin
 * Plugin Name: UX Featured Item Post Type
 * Plugin URI:  http://www.uxthemes.com/
 * Description: Enables a featured item post type and taxonomies.
 * Version:     1.0
 * Author:      UX Themes
 * Author URI:  http://www.uxthemes.com/
 * Text Domain: featured_itemposttype
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! class_exists( 'Featured_Item_Post_Type' ) ) :

class Featured_Item_Post_Type {

	public function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_textdomain' ) );

		// Run when the plugin is activated
		register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );

		// Add the featured_item post type and taxonomies
		add_action( 'init', array( $this, 'featured_item_init' ) );

		// Thumbnail support for featured_item posts
		add_theme_support( 'post-thumbnails', array( 'featured_item' ) );

		// Add thumbnails to column view
		add_filter( 'manage_edit-featured_item_columns', array( $this, 'add_thumbnail_column'), 10, 1 );
		add_action( 'manage_posts_custom_column', array( $this, 'display_thumbnail' ), 10, 1 );

		// Allow filtering of posts by taxonomy in the admin view
		add_action( 'restrict_manage_posts', array( $this, 'add_taxonomy_filters' ) );

		// Show featured_item post counts in the dashboard
		add_action( 'right_now_content_table_end', array( $this, 'add_featured_item_counts' ) );

		// Give the featured_item menu item a unique icon
		add_action( 'admin_head', array( $this, 'featured_item_icon' ) );

		// Add taxonomy terms as body classes
		add_filter( 'body_class', array( $this, 'add_body_classes' ) );
	}

	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_textdomain() {

		$domain = 'featured_itemposttype';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Flushes rewrite rules on plugin activation to ensure featured_item posts don't 404.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
	 *
	 * @uses Featured Item_Post_Type::featured_item_init()
	 */
	public function plugin_activation() {
		$this->load_textdomain();
		$this->featured_item_init();
		flush_rewrite_rules();
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Featured Item_Post_Type::register_post_type()
	 * @uses Featured Item_Post_Type::register_taxonomy_tag()
	 * @uses Featured Item_Post_Type::register_taxonomy_category()
	 */
	public function featured_item_init() {
		$this->register_post_type();
		$this->register_taxonomy_category();
		$this->register_taxonomy_tag();
	}

	/**
	 * Get an array of all taxonomies this plugin handles.
	 *
	 * @return array Taxonomy slugs.
	 */
	protected function get_taxonomies() {
		return array( 'featured_item_category', 'featured_item_tag' );
	}

	/**
	 * Enable the Featured Item custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Featured Items', 'featured_itemposttype' ),
			'singular_name'      => __( 'Featured Item', 'featured_itemposttype' ),
			'add_new'            => __( 'Add New Item', 'featured_itemposttype' ),
			'add_new_item'       => __( 'Add New Featured Item', 'featured_itemposttype' ),
			'edit_item'          => __( 'Edit Featured Item Item', 'featured_itemposttype' ),
			'new_item'           => __( 'Add New Featured Item', 'featured_itemposttype' ),
			'view_item'          => __( 'View Item', 'featured_itemposttype' ),
			'search_items'       => __( 'Search Featured Item', 'featured_itemposttype' ),
			'not_found'          => __( 'No featured item items found', 'featured_itemposttype' ),
			'not_found_in_trash' => __( 'No featured item items found in trash', 'featured_itemposttype' ),
		);

		$args = array(
			'labels'          => $labels,
			'public'          => true,
			'supports'        => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'comments',
				'author',
				'custom-fields',
				'revisions',
			),
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'featured', ), // Permalinks format
			'menu_position'   => 5,
			'has_archive'     => true,
		);

		$args = apply_filters( 'featured_itemposttype_args', $args );

		register_post_type( 'featured_item', $args );
	}

	/**
	 * Register a taxonomy for Featured Item Tags.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_tag() {
		$labels = array(
			'name'                       => __( 'Featured Item Tags', 'featured_itemposttype' ),
			'singular_name'              => __( 'Featured Item Tag', 'featured_itemposttype' ),
			'menu_name'                  => __( 'Featured Item Tags', 'featured_itemposttype' ),
			'edit_item'                  => __( 'Edit Featured Item Tag', 'featured_itemposttype' ),
			'update_item'                => __( 'Update Featured Item Tag', 'featured_itemposttype' ),
			'add_new_item'               => __( 'Add New Featured Item Tag', 'featured_itemposttype' ),
			'new_item_name'              => __( 'New Featured Item Tag Name', 'featured_itemposttype' ),
			'parent_item'                => __( 'Parent Featured Item Tag', 'featured_itemposttype' ),
			'parent_item_colon'          => __( 'Parent Featured Item Tag:', 'featured_itemposttype' ),
			'all_items'                  => __( 'All Featured Item Tags', 'featured_itemposttype' ),
			'search_items'               => __( 'Search Featured Item Tags', 'featured_itemposttype' ),
			'popular_items'              => __( 'Popular Featured Item Tags', 'featured_itemposttype' ),
			'separate_items_with_commas' => __( 'Separate featured_item tags with commas', 'featured_itemposttype' ),
			'add_or_remove_items'        => __( 'Add or remove featured_item tags', 'featured_itemposttype' ),
			'choose_from_most_used'      => __( 'Choose from the most used featured_item tags', 'featured_itemposttype' ),
			'not_found'                  => __( 'No featured_item tags found.', 'featured_itemposttype' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'featured_item_tag' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'featured_itemposttype_tag_args', $args );

		register_taxonomy( 'featured_item_tag', array( 'featured_item' ), $args );

	}

	/**
	 * Register a taxonomy for Featured Item Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Featured Item Categories', 'featured_itemposttype' ),
			'singular_name'              => __( 'Featured Item Category', 'featured_itemposttype' ),
			'menu_name'                  => __( 'Featured Item Categories', 'featured_itemposttype' ),
			'edit_item'                  => __( 'Edit Featured Item Category', 'featured_itemposttype' ),
			'update_item'                => __( 'Update Featured Item Category', 'featured_itemposttype' ),
			'add_new_item'               => __( 'Add New Featured Item Category', 'featured_itemposttype' ),
			'new_item_name'              => __( 'New Featured Item Category Name', 'featured_itemposttype' ),
			'parent_item'                => __( 'Parent Featured Item Category', 'featured_itemposttype' ),
			'parent_item_colon'          => __( 'Parent Featured Item Category:', 'featured_itemposttype' ),
			'all_items'                  => __( 'All Featured Item Categories', 'featured_itemposttype' ),
			'search_items'               => __( 'Search Featured Item Categories', 'featured_itemposttype' ),
			'popular_items'              => __( 'Popular Featured Item Categories', 'featured_itemposttype' ),
			'separate_items_with_commas' => __( 'Separate featured_item categories with commas', 'featured_itemposttype' ),
			'add_or_remove_items'        => __( 'Add or remove featured_item categories', 'featured_itemposttype' ),
			'choose_from_most_used'      => __( 'Choose from the most used featured_item categories', 'featured_itemposttype' ),
			'not_found'                  => __( 'No featured_item categories found.', 'featured_itemposttype' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'featured_item_category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'featured_itemposttype_category_args', $args );

		register_taxonomy( 'featured_item_category', array( 'featured_item' ), $args );
	}

	/**
	 * Add taxonomy terms as body classes.
	 *
	 * If the taxonomy doesn't exist (has been unregistered), then get_the_terms() returns WP_Error, which is checked
	 * for before adding classes.
	 *
	 * @param array $classes Existing body classes.
	 *
	 * @return array Amended body classes.
	 */
	public function add_body_classes( $classes ) {
		$taxonomies = $this->get_taxonomies();

		foreach( $taxonomies as $taxonomy ) {
			$terms = get_the_terms( get_the_ID(), $taxonomy );
			if ( $terms && ! is_wp_error( $terms ) ) {
				foreach( $terms as $term ) {
					$classes[] = sanitize_html_class( str_replace( '_', '-', $taxonomy ) . '-' . $term->slug );
				}
			}
		}

		return $classes;
	}

	/**
	 * Add columns to Featured Item list screen.
	 *
	 * @link http://wptheming.com/2010/07/column-edit-pages/
	 *
	 * @param array $columns Existing columns.
	 *
	 * @return array Amended columns.
	 */
	public function add_thumbnail_column( $columns ) {
		$column_thumbnail = array( 'thumbnail' => __( 'Thumbnail', 'featured_itemposttype' ) );
		return array_slice( $columns, 0, 2, true ) + $column_thumbnail + array_slice( $columns, 1, null, true );
	}

	/**
	 * Custom column callback
	 *
	 * @global stdClass $post Post object.
	 *
	 * @param string $column Column ID.
	 */
	public function display_thumbnail( $column ) {
		global $post;
		switch ( $column ) {
			case 'thumbnail':
				echo get_the_post_thumbnail( $post->ID, array(35, 35) );
				break;
		}
	}

	/**
	 * Add taxonomy filters to the featured_item admin page.
	 *
	 * Code artfully lifted from http://pippinsplugins.com/
	 *
	 * @global string $typenow
	 */
	public function add_taxonomy_filters() {
		global $typenow;

		// An array of all the taxonomies you want to display. Use the taxonomy name or slug
		$taxonomies = $this->get_taxonomies();

		// Must set this to the post type you want the filter(s) displayed on
		if ( 'featured_item' != $typenow ) {
			return;
		}

		foreach ( $taxonomies as $tax_slug ) {
			$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
			$tax_obj          = get_taxonomy( $tax_slug );
			$tax_name         = $tax_obj->labels->name;
			$terms            = get_terms( $tax_slug );
			if ( 0 == count( $terms ) ) {
				return;
			}
			echo '<select name="' . esc_attr( $tax_slug ) . '" id="' . esc_attr( $tax_slug ) . '" class="postform">';
			echo '<option>' . esc_html( $tax_name ) .'</option>';
			foreach ( $terms as $term ) {
				printf(
					'<option value="%s"%s />%s</option>',
					esc_attr( $term->slug ),
					selected( $current_tax_slug, $term->slug ),
					esc_html( $term->name . '(' . $term->count . ')' )
				);
			}
			echo '</select>';
		}
	}

	/**
	 * Add Featured Item count to "Right Now" dashboard widget.
	 *
	 * @return null Return early if featured_item post type does not exist.
	 */
	public function add_featured_item_counts() {
		if ( ! post_type_exists( 'featured_item' ) ) {
			return;
		}

		$num_posts = wp_count_posts( 'featured_item' );

		// Published items
		$href = 'edit.php?post_type=featured_item';
		$num  = number_format_i18n( $num_posts->publish );
		$num  = $this->link_if_can_edit_posts( $num, $href );
		$text = _n( 'Featured Item Item', 'Featured Item Items', intval( $num_posts->publish ) );
		$text = $this->link_if_can_edit_posts( $text, $href );
		$this->display_dashboard_count( $num, $text );

		if ( 0 == $num_posts->pending ) {
			return;
		}

		// Pending items
		$href = 'edit.php?post_status=pending&amp;post_type=featured_item';
		$num  = number_format_i18n( $num_posts->pending );
		$num  = $this->link_if_can_edit_posts( $num, $href );
		$text = _n( 'Featured Item Item Pending', 'Featured Item Items Pending', intval( $num_posts->pending ) );
		$text = $this->link_if_can_edit_posts( $text, $href );
		$this->display_dashboard_count( $num, $text );
	}

	/**
	 * Wrap a dashboard number or text value in a link, if the current user can edit posts.
	 *
	 * @param  string $value Value to potentially wrap in a link.
	 * @param  string $href  Link target.
	 *
	 * @return string        Value wrapped in a link if current user can edit posts, or original value otherwise.
	 */
	protected function link_if_can_edit_posts( $value, $href ) {
		if ( current_user_can( 'edit_posts' ) ) {
			return '<a href="' . esc_url( $href ) . '">' . $value . '</a>';
		}
		return $value;
	}

	/**
	 * Display a number and text with table row and cell markup for the dashboard counters.
	 *
	 * @param  string $number Number to display. May be wrapped in a link.
	 * @param  string $label  Text to display. May be wrapped in a link.
	 */
	protected function display_dashboard_count( $number, $label ) {
		?>
		<tr>
			<td class="first b b-featured_item"><?php echo $number; ?></td>
			<td class="t featured_item"><?php echo $label; ?></td>
		</tr>
		<?php
	}

	/**
	 * Display the custom post type icon in the dashboard.
	 */
	public function featured_item_icon() {
		$plugin_dir_url = plugin_dir_url( __FILE__ );
		?>
		<style>
			#menu-posts-featured_item .wp-menu-image {
				background: url(<?php echo $plugin_dir_url; ?>images/featured_item-icon.png) no-repeat 6px 6px !important;
			}
			#menu-posts-featured_item:hover .wp-menu-image, #menu-posts-featured_item.wp-has-current-submenu .wp-menu-image {
				background-position: 6px -16px !important;
			}
			#icon-edit.icon32-posts-featured_item {
				background: url(<?php echo $plugin_dir_url; ?>images/featured_item-32x32.png) no-repeat;
			}
		</style>
		<?php
	}

}

new Featured_Item_Post_Type;

endif;
