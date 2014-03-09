<?php
/**
 * Main class
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Ajax Search
 * @version 1.0.0
 */

if ( !defined( 'YITH_WCAS' ) ) { exit; } // Exit if accessed directly

if( !class_exists( 'YITH_WCAS' ) ) {
    /**
     * WooCommerce Magnifier
     *
     * @since 1.0.0
     */
    class YITH_WCAS {
        /**
         * Plugin version
         *
         * @var string
         * @since 1.0.0
         */
        public $version = '1.0.0';
        
        /**
         * Plugin object
         *
         * @var string
         * @since 1.0.0
         */
        public $obj = null;

		/**
		 * Constructor
		 * 
		 * @return mixed|YITH_WCAS_Admin|YITH_WCAS_Frontend
		 * @since 1.0.0
		 */
		public function __construct() {
			
			// actions
			add_action( 'init', array( $this, 'init' ) );
            add_action( 'widgets_init', array( $this, 'registerWidgets' ) );
            add_action( 'wp_ajax_yith_ajax_search_products', array( $this, 'ajax_search_products') );
            add_action( 'wp_ajax_nopriv_yith_ajax_search_products', array( $this, 'ajax_search_products') );

            //register shortcode
            add_shortcode( 'yith_woocommerce_ajax_search', array( $this, 'add_woo_ajax_search_shortcode') );
			
			if( is_admin() ) {
				$this->obj = new YITH_WCAS_Admin( $this->version );
			} else {
				$this->obj = new YITH_WCAS_Frontend( $this->version );
			}
			
			return $this->obj;
		}     
		
		
		/**
		 * Init method:
		 *  - default options
		 * 
		 * @access public
		 * @since 1.0.0
		 */
		public function init() {}

        /**
         * Load template for [yith_woocommerce_ajax_search] shortcode
         *
         * @access public
         * @param $args array
         * @return void
         * @since 1.0.0
         */
        public function add_woo_ajax_search_shortcode( $args = array() ) {
            $args = shortcode_atts( array(), $args );

            woocommerce_get_template( 'yith-woocommerce-ajax-search.php', $args, '', YITH_WCAS_DIR . 'templates/' );
        }

        /**
         * Load and register widgets
         *
         * @access public
         * @since 1.0.0
         */
        public function registerWidgets() {
            register_widget( 'YITH_WCAS_Ajax_Search_Widget' );
        }


        /**
         * Perform jax search products
         */
        public function ajax_search_products() {
            global $woocommerce;

            $search_keyword = esc_attr($_REQUEST['query']);
            $ordering_args = $woocommerce->query->get_catalog_ordering_args( 'title', 'asc' );
            $products = array();

            $args = array(
                's'                     => apply_filters('yith_wcas_ajax_search_products_search_query', $search_keyword),
                'post_type'				=> 'product',
                'post_status' 			=> 'publish',
                'ignore_sticky_posts'	=> 1,
                'orderby' 				=> $ordering_args['orderby'],
                'order' 				=> $ordering_args['order'],
                'posts_per_page' 		=> apply_filters('yith_wcas_ajax_search_products_posts_per_page', get_option('yith_wcas_posts_per_page')),
                'meta_query' 			=> array(
                    array(
                        'key' 			=> '_visibility',
                        'value' 		=> array('catalog', 'visible'),
                        'compare' 		=> 'IN'
                    )
                )
            );
            $products_query = new WP_Query( $args );

            if ( $products_query->have_posts() ) {
                while ( $products_query->have_posts() ) {
                    $products_query->the_post();

                    $products[] = array(
                        'id' => get_the_ID(),
                        'value' => get_the_title(),
                        'url' => get_permalink()
                    );
                }
            } else {
                $products[] = array(
                    'id' => -1,
                    'value' => __('No results', 'yit'),
                    'url' => ''
                );
            }
            wp_reset_postdata();


            $products = array(
                'suggestions' => $products
            );


            echo json_encode( $products );
            die();
        }
	}
}