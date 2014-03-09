<?php
/*
Template name: Left sidebar - No title
*/
get_header(); ?>

<div class="page-header">
<?php if( has_excerpt() ) the_excerpt();?>
</div>

<div  class="page-wrapper page-left-sidebar">
<div class="row">

<div id="content" class="large-9 right columns" role="main">
	<div class="page-inner">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'flatsome' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->
					</article><!-- #post-## -->
			<?php endwhile; // end of the loop. ?>
	</div><!-- .page-inner -->
</div><!-- end #content large-9 left -->

<div class="large-3 columns left">
<?php get_sidebar(); ?>
</div><!-- end sidebar -->

</div><!-- end row -->
</div><!-- end page-right-sidebar container -->


<?php get_footer(); ?>
