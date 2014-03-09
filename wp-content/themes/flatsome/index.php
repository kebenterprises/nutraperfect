<?php
/**
 * The main template file.
 *
 * @package flatsome
 */

get_header(); 

if(!isset($flatsome_opt['blog_layout'])){$flatsome_opt['blog_layout'] = '';}
?>

<?php // ADD BLOG HEADER IF SET
if(isset($flatsome_opt['blog_header'])){ echo do_shortcode($flatsome_opt['blog_header']);}
?>
<div class="page-wrapper page-<?php if($flatsome_opt['blog_layout']){ echo $flatsome_opt['blog_layout'];} else {echo 'right-sidebar';} ?>">
	<div class="row">

		<?php if($flatsome_opt['blog_layout'] == 'left-sidebar') {
		 	echo '<div id="content" class="large-9 right columns" role="main">';
		 } else if($flatsome_opt['blog_layout'] == 'right-sidebar'){
		 	echo '<div id="content" class="large-9 left columns" role="main">';
	 	 } else if($flatsome_opt['blog_layout'] == 'no-sidebar' && $flatsome_opt['blog_style'] == 'blog-pinterest'){
	 		echo '<div id="content" class="large-12 columns blog-pinterest-container" role="main">';
		 } else if($flatsome_opt['blog_layout'] == 'no-sidebar'){
		 	echo '<div id="content" class="large-10 columns large-offset-1" role="main">';
		 } else {
		 	echo '<div id="content" class="large-9 left columns" role="main">';
		 }
		?>

		<div class="page-inner">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>
		
		<div class="large-12 columns navigation-container">
			<?php flatsome_content_nav( 'nav-below' ); ?>
		</div>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>

	</div><!-- .page-inner -->
	</div><!-- #content -->


	<div class="large-3 columns left">
		<?php if($flatsome_opt['blog_layout'] == 'left-sidebar' || $flatsome_opt['blog_layout'] == 'right-sidebar'){
			get_sidebar();
		}?>
	</div><!-- end sidebar -->

</div><!-- end row -->	
</div><!-- end page-wrapper -->

<?php if($flatsome_opt['blog_style'] == 'blog-pinterest'){ ?>

  <script>
	jQuery(document).ready(function ($) {
	    imagesLoaded( document.querySelector('.page-inner'), function( instance, container ) {
	    	var $container = $(".page-inner");
		    // initialize
		    $container.packery({
		      itemSelector: ".columns",
		      gutter: 0,
		      stamp: "#nav-below"
		    });
  			$container.packery('layout');
		});
	 });
  </script> 
<?php } ?>


<?php get_footer(); ?>