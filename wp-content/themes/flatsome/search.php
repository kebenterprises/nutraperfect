<?php
/**
 * The template for displaying Search Results pages.
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
		 } else if($flatsome_opt['blog_layout'] == 'no-sidebar'){
		 	echo '<div id="content" class="large-10 columns large-offset-1" role="main">';
		 } else {
		 	echo '<div id="content" class="large-9 left columns" role="main">';
		 }
		?>

		<div class="page-inner">

		
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'flatsome' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php flatsome_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

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

<?php get_footer(); ?>