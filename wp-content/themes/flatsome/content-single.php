<?php
/**
 * @package flatsome
 */

global $flatsome_opt;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header text-center">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="tx-div small"></div>
		<div class="entry-meta">
			<?php flatsome_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
    <div class="entry-image">
            <?php the_post_thumbnail(); ?>
            <div class="post-date large">
	                <span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span>
	                <span class="post-date-month"><?php echo get_the_time('M', get_the_ID()); ?></span>
            </div>
    </div>
    <?php } ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'flatsome' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->


	<?php if(isset($flatsome_opt['blog_share']) && $flatsome_opt['blog_share']) {
		// SHARE ICONS
		echo '<div class="blog-share text-center">';
		echo '<div class="tx-div medium"></div>';
		echo do_shortcode('[share]');
		echo '</div>';
	} ?>

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'flatsome' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'flatsome' ) );

		
			// But this blog has loads of categories so we should probably display them here
			if ( '' != $tag_list ) {
				$meta_text = __( 'This entry was posted in %1$s and tagged %2$s.', 'flatsome' );
			} else {
				$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'flatsome' );
			}


			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>


	</footer><!-- .entry-meta -->




		<?php  if(isset($flatsome_opt['blog_author_box']) && $flatsome_opt['blog_author_box']) { ?>
			<div class="author-box">
				<div class="row">
					<div class="large-2 small-3 columns">
						<?php 

						$user = get_the_author_meta('ID');
						echo get_avatar($user,90); 

						?>
					
					</div>
					<div class="large-10 small-9 columns">
					<h4 class="author-name">by <?php echo get_the_author_meta('display_name');?></h4>
					
					<?php if(get_the_author_meta('yim')){?>
					<p class="author-title"><?php echo get_the_author_meta('yim'); ?></p>
					<?php }?>

					<p class="author-desc"><?php echo get_the_author_meta('user_description');?></p>

					<?php if(get_the_author_meta('aim')){?>
					<p class="author-twitter"><a href="http://twitter.com/<?php echo get_the_author_meta('aim');?>"><?php echo get_the_author_meta('aim');?></a></p>
					<?php }?>
					</div>
				</div>
			</div>
		<?php } ?>
		
		<?php flatsome_content_nav( 'nav-below' ); ?>

		
</article><!-- #post-## -->
