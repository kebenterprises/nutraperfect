<?php
function flatsome_custom_css() {
global $flatsome_opt;
?>

<!-- Custom CSS Codes -->
<style type="text/css">
	/* Set FONTS */

	<?php if(!isset($flatsome_opt['disable_fonts']) || !$flatsome_opt['disable_fonts']) {?> 
	body{background-color:<?php echo $flatsome_opt['body_bg'] ?>; background-image:url("<?php echo $flatsome_opt['body_bg_image'] ?>"); }
	body,p,#top-bar,.cart-inner .nav-dropdown,.nav-dropdown{font-family: <?php echo $flatsome_opt['type_texts'] ?>,helvetica,arial,sans-serif!important;}
	.header-nav{font-family: <?php echo $flatsome_opt['type_nav'] ?>,helvetica,arial,sans-serif!important;}
	h1,h2,h3,h4,h5,h6{font-family: <?php echo $flatsome_opt['type_headings'] ?>,helvetica,arial,sans-serif!important;}
	.alt-font{font-family: <?php echo $flatsome_opt['type_alt'] ?>,Georgia,serif!important;}
	<?php }?>

	/* CUSTOM LAYOUT */
	<?php if($flatsome_opt['body_layout'] == 'boxed'){?> 
		  body{background-color:<?php echo $flatsome_opt['body_bg'] ?>; background-image:url("<?php echo $flatsome_opt['body_bg_image'] ?>"); }
	<?php }?>

	<?php if($flatsome_opt['header_height']){ ?> 
			#masthead{ height:<?php echo $flatsome_opt['header_height']; ?>px; }
			#logo a img{ max-height:<?php $height = $flatsome_opt['header_height'];  $height = str_replace("px","", $height);  $height = ($height)-50; $height = $height.'px'; echo $height;?>}
	<?php } ?>

	<?php if($flatsome_opt['logo_width']){ ?> 
			#logo {width: <?php echo $flatsome_opt['logo_width'] ?>px}
	<?php } ?>

	<?php if($flatsome_opt['header_height_sticky']){ ?> 
			#masthead.stuck.move_down{height:<?php  echo $flatsome_opt['header_height_sticky']; ?>px; }
			#masthead.stuck.move_down #logo a img{ max-height:<?php $height = $flatsome_opt['header_height_sticky'];  $height = str_replace("px","", $height);  $height = ($height)-30; $height = $height.'px'; echo $height;?> }
	<?php } ?>


	/* CUSTOM COLORS */
	<?php if($flatsome_opt['header_bg'] || $flatsome_opt['header_bg_img']){?> 
			#masthead{background-color: <?php echo $flatsome_opt['header_bg']; ?>; <?php if($flatsome_opt['header_bg_img']) { ?>background-image: url('<?php echo $flatsome_opt['header_bg_img'] ?>'); background-repeat:<?php echo $flatsome_opt['header_bg_img_pos'] ?> <?php } ?>;}
			.dark-header .header-nav li.mini-cart .cart-icon strong{background-color: <?php echo $flatsome_opt['header_bg']; ?>}
	<?php }?>

	<?php if($flatsome_opt['content_bg']){?> 
			.sliderNav.small a,#main-content,h3.section-title.title_center span{background-color: <?php echo $flatsome_opt['content_bg']; ?>!important}
	<?php }?>

	<?php if($flatsome_opt['nav_position_bg']){?> 
			.wide-nav {background-color:<?php echo $flatsome_opt['nav_position_bg']; ?>}
	<?php }?>

	<?php if($flatsome_opt['topbar_bg']){ ?> 
			#top-bar{background-color:<?php echo $flatsome_opt['topbar_bg'] ?> }
	<?php } else { ?> 
			#top-bar{background-color:<?php echo $flatsome_opt['color_primary'] ?> }
	<?php } ?>

	<?php if($flatsome_opt['topbar_bg']){ ?>
			.header-nav li.mini-cart .cart-icon strong{background-color: <?php echo $flatsome_opt['header_bg'] ?>}
			.header-nav li.mini-cart.active .cart-icon strong{background-color: <?php echo $flatsome_opt['color_primary'] ?> }
	<?php } ?>


	<?php if($flatsome_opt['color_primary']){?> 
		/* PRIMARY COLOR */
		/* -- color -- */
		.add-to-cart-grid .cart-icon strong,.tagcloud a,.navigation-paging a, .navigation-image a ,ul.page-numbers a, ul.page-numbers li > span,#masthead .mobile-menu a,.alt-button, #logo a, li.mini-cart .cart-icon strong,.widget_product_tag_cloud a, .widget_tag_cloud a,.post-date,#masthead .mobile-menu a.mobile-menu a,.checkout-group h3,.order-review h3 {color: <?php echo $flatsome_opt['color_primary'] ?>;}
		/* -- background -- */
		ul.page-numbers li > span,.label-new.menu-item a:after,.add-to-cart-grid .cart-icon strong:hover,.text-box-primary, .navigation-paging a:hover, .navigation-image a:hover ,.next-prev-nav .prod-dropdown > a:hover,ul.page-numbers a:hover,.widget_product_tag_cloud a:hover,.widget_tag_cloud a:hover,.custom-cart-count,.iosSlider .sliderNav a:hover span,a.button.alt-button:hover,.loading i, li.mini-cart.active .cart-icon strong,.product-image .quick-view, .product-image .product-bg, #submit, button, #submit, button, .button, input[type="submit"],li.mini-cart.active .cart-icon strong,.post-item:hover .post-date,.blog_shortcode_item:hover .post-date,.product-category:hover .header-title,.column-slider .sliderNav a:hover,.ux_banner {background-color: <?php echo $flatsome_opt['color_primary'] ?>}
		/* -- borders -- */
		ul.page-numbers li > span,.add-to-cart-grid .cart-icon strong, .add-to-cart-grid .cart-icon-handle,.add-to-cart-grid.loading .cart-icon strong,.navigation-paging a, .navigation-image a ,ul.page-numbers a ,ul.page-numbers a:hover,.post.sticky,.widget_product_tag_cloud a, .widget_tag_cloud a,.next-prev-nav .prod-dropdown > a:hover,.iosSlider .sliderNav a:hover span,.column-slider .sliderNav a:hover,.woocommerce .order-review, .woocommerce-checkout form.login,.button, button, li.mini-cart .cart-icon strong,li.mini-cart .cart-icon .cart-icon-handle,.post-date{border-color: <?php echo $flatsome_opt['color_primary'] ?>;}
		/* -- alt buttons-- */
		a.primary.alt-button:hover,a.button.alt-button:hover{background-color:<?php echo $flatsome_opt['color_primary'] ?>!important};
	<?php }?>

	<?php if($flatsome_opt['color_secondary']){?> 
		/* SECONDARY COLOR */
		/* -- color -- */
		.star-rating:before, .woocommerce-page .star-rating:before, .star-rating span:before{color: <?php echo $flatsome_opt['color_secondary'] ?>}
		a.secondary.alt-button,li.menu-sale a{color: <?php echo $flatsome_opt['color_secondary'] ?>!important}
		/* -- background -- */
		.label-sale.menu-item a:after,.mini-cart:hover .custom-cart-count,.callout .inner,.button.secondary,.button.checkout,#submit.secondary, button.secondary, .button.secondary, input[type="submit"].secondary{background-color: <?php echo $flatsome_opt['color_secondary'] ?>}
		/* -- borders -- */
		a.button.secondary,.button.secondary{border-color:<?php echo $flatsome_opt['color_secondary'] ?>;}
		/* -- alt buttons-- */
		a.secondary.alt-button:hover{color:#FFF!important;background-color:<?php echo $flatsome_opt['color_secondary'] ?>!important}
		ul.page-numbers li > span{color: #FFF;}
	<?php }?>

	<?php if($flatsome_opt['color_success']){?> 
		/* Success COLOR */
		/* -- color -- */
		.woocommerce-message{color: <?php echo $flatsome_opt['color_success'] ?>!important}
		.woocommerce-message:before,.woocommerce-message:after{color: #FFF!important; background-color:<?php echo $flatsome_opt['color_success'] ?>!important }
		.label-popular.menu-item a:after,.add-to-cart-grid.loading .cart-icon strong,.add-to-cart-grid.added .cart-icon strong{background-color: <?php echo $flatsome_opt['color_success'] ?>;border-color: <?php echo $flatsome_opt['color_success'] ?>;}
		.add-to-cart-grid.loading .cart-icon .cart-icon-handle,.add-to-cart-grid.added .cart-icon .cart-icon-handle{border-color: <?php echo $flatsome_opt['color_success'] ?>}
	<?php }?>

	<?php if($flatsome_opt['color_checkout']){?> 
		/* Checkout button colors */
		form.cart .button,.cart-inner .button.secondary,.checkout-button,input#place_order{background-color: <?php echo $flatsome_opt['color_checkout'] ?>!important}
	<?php }?>

	<?php if($flatsome_opt['color_sale']){?> 
		/* Sale bubble color */
		.callout .inner{background-color: <?php echo $flatsome_opt['color_sale'] ?>!important}
	<?php }?>

	<?php if($flatsome_opt['color_review']){?> 
		/* review star colors */
		.star-rating span:before,.star-rating:before, .woocommerce-page .star-rating:before {color: <?php echo $flatsome_opt['color_review'] ?>!important}
	<?php }?>


	<?php if($flatsome_opt['color_links']){?> 
		/* LINK COLOR */
		a,.icons-row a.icon{color: <?php echo $flatsome_opt['color_links'] ?>}
		.cart_list_product_title{color: <?php echo $flatsome_opt['color_links'] ?>!important}
		.icons-row a.icon{border-color: <?php echo $flatsome_opt['color_links'] ?>;}
		.icons-row a.icon:hover{background-color:<?php echo $flatsome_opt['color_links'] ?>;border-color:<?php echo $flatsome_opt['color_links'] ?>;}
   <?php }?>


   	<?php if(is_admin_bar_showing()){ ?> 
    	/* Fixes if admin bar is showing */
    	.tipr_container_bottom{display: none;position: absolute;margin-top: 13px;z-index: 1000;}
   		.tipr_container_top{display: none;position: absolute;margin-top:-70px;z-index: 1000;}
	<?php } ?>

	<?php if($flatsome_opt['button_radius'] != "0px") {?>
			.button{-webkit-border-radius:<?php echo $flatsome_opt['button_radius']; ?>!important; -moz-border-radius: <?php echo $flatsome_opt['button_radius']; ?>!important; border-radius: <?php echo $flatsome_opt['button_radius']; ?>!important;}
	<?php } ?>

	/* DIV OPTIONS */
	<?php if($flatsome_opt['disable_product_scrollbar']) {?>
			.product-gallery .scrollbarBlock2{display: none!important}
	<?php } ?>

	/* MENU LABELS */
	.label-new.menu-item a:after{content:"<?php _e('New','flatsome'); ?>";}
	.label-hot.menu-item a:after{content:"<?php _e('Hot','flatsome'); ?>";}
	.label-sale.menu-item a:after{content:"<?php _e('Sale','flatsome'); ?>";}
	.label-popular.menu-item a:after{content:"<?php _e('Popular','flatsome'); ?>";}

	/* CUSTOM CSS */
	<?php echo $flatsome_opt['html_custom_css']; ?>
</style>

<?php 
}
add_action( 'wp_head', 'flatsome_custom_css', 100 );
?>