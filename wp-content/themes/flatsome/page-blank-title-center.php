<?php
/*
Template name: Default Template (Center title)
*/
get_header(); ?>

<div class="page-header">
<?php if( has_excerpt() ) the_excerpt();?>
</div>


<div  class="page-wrapper page-title-center">
<div class="row">

	
<div id="content" class="large-12 left type-page  columns" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
					<header class="entry-header text-center">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<div class="tx-div medium"></div>
					</header>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

		<?php endwhile; // end of the loop. ?>

</div><!-- end #content large-9 left -->

</div><!-- end row -->
</div><!-- end page-right-sidebar container -->


<?php get_footer(); ?>