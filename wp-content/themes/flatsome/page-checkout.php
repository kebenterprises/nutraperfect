<?php
/*
Template name: Page Checkout
Use this for Cart, Checkout and thank you page.
*/
get_header(); ?>

<div  class="page-wrapper page-checkout">
<div class="row">
<div id="content" class="large-12 columns" role="main">


<?php while ( have_posts() ) : the_post(); ?>
	<div class="checkout-breadcrumb">
		<h1>
			<span class="title-cart"><?php _e('Shopping Cart', 'flatsome'); ?></span>   
			<span class="icon-angle-right divider"></span>    
			<span class="title-checkout"><?php _e('Checkout details', 'flatsome'); ?></span>  
			<span class="icon-angle-right divider"></span>  
			<span class="title-thankyou"><?php _e('Order Complete', 'flatsome'); ?></span>
		</h1>
	</div>
<?php the_content(); ?>
			
<?php endwhile; // end of the loop. ?>		



</div><!-- end #content large-12 -->
</div><!-- end row -->
</div><!-- end page-right-sidebar container -->



<?php get_footer(); ?>