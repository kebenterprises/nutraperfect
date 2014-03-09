<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package flatsome
 */

get_header(); ?>

<div  class="page-wrapper">
<div class="row">

	
<div id="content" class="large-12 left columns" role="main">
		<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'flatsome' ); ?></h1>
				</header><!-- .entry-header -->
				<div class="entry-content">


		<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'flatsome' ); ?></p>

					<?php get_search_form(); ?>

								</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->


</div><!-- end #content large-9 left -->

</div><!-- end row -->
</div><!-- end page-right-sidebar container -->


<?php get_footer(); ?>


	
