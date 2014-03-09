<?php
/**
 * @package flatsome
 */

global $flatsome_opt;
?>

<?php 
// BLOG NORMAL STYLE
if(!isset($flatsome_opt['blog_style']) || $flatsome_opt['blog_style'] == 'blog-normal'){ ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header text-center">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<div class="tx-div small"></div>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php flatsome_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
        <div class="entry-image">
        	<a href="<?php the_permalink();?>">
            <?php the_post_thumbnail(); ?>
        	</a>

            <div class="post-date large">
	                <span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span>
	                <span class="post-date-month"><?php echo get_the_time('M', get_the_ID()); ?></span>
            </div>
        </div>
    <?php } ?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'flatsome' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'flatsome' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'flatsome' ) );
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'flatsome' ), $categories_list ); ?>
			</span>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'flatsome' ) );
				if ( $tags_list ) :
			?>
			<span class="sep"> | </span>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'flatsome' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link right"><?php comments_popup_link( __( 'Leave a comment', 'flatsome' ), __( '<strong>1</strong> Comment', 'flatsome' ), __( '<strong>%</strong> Comments', 'flatsome' ) ); ?></span>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->


<?php } 
// BLOG LIST STYLE
else if($flatsome_opt['blog_style'] == 'blog-list') { ?>
<div class="blog-list-style">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
	<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
	<div class="large-4 columns">
        <div class="entry-image">
        	<a href="<?php the_permalink();?>">
            <?php the_post_thumbnail(); ?>
        	</a>
            <div class="post-date large">
	                <span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span>
	                <span class="post-date-month"><?php echo get_the_time('M', get_the_ID()); ?></span>
            </div>
        </div>
      </div>
    <?php } ?>

    <div class="large-8 columns">

	<div class="entry-content">
				<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'flatsome' ) );
			?>
			<span class="cat-links">
				<?php printf( __( '%1$s', 'flatsome' ), $categories_list ); ?>
			</span>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'flatsome' ) );
				if ( $tags_list ) :
			?>
			<span class="sep"> | </span>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'flatsome' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>
		<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		<?php the_excerpt(); ?>
				<div class="tx-div small"></div>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php flatsome_posted_on(); ?>  <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link right"><?php comments_popup_link( __( 'Leave a comment', 'flatsome' ), __( '<strong>1</strong> Comment', 'flatsome' ), __( '<strong>%</strong> Comments', 'flatsome' ) ); ?></span>
		<?php endif; ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</div><!-- .entry-content -->
	</div><!-- .large-8 -->
</div><!-- .row -->
	
</article><!-- #post-## -->
</div><!-- .blog-list-style -->
<?php } 


// BLOG PINTEREST STYLE
else if($flatsome_opt['blog_style'] == 'blog-pinterest') {

 ?>
<div class="large-4 columns blog-pinterest-style">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
        <div class="entry-image">
        	<a href="<?php the_permalink();?>">
            <?php the_post_thumbnail(); ?>
        	</a>
            <div class="post-date large">
	                <span class="post-date-day"><?php echo get_the_time('d', get_the_ID()); ?></span>
	                <span class="post-date-month"><?php echo get_the_time('M', get_the_ID()); ?></span>
            </div>
        </div>
    <?php } ?>


	<div class="entry-content">
				<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'flatsome' ) );
			?>
			<span class="cat-links">
				<?php printf( __( '%1$s', 'flatsome' ), $categories_list ); ?>
			</span>


		<?php endif; // End if 'post' == get_post_type() ?>
		<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		<div class="tx-div small"></div>
		<p><?php echo short_excerpt(24); ?></p>

		<?php if ( 'post' == get_post_type() ) : ?>
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'flatsome' ), __( '<strong>1</strong> Comment', 'flatsome' ), __( '<strong>%</strong> Comments', 'flatsome' ) ); ?></span>
		<?php endif; ?>
		<?php endif; ?>

					<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'flatsome' ) );
				if ( $tags_list ) :
			?>
			<span class="sep"> | </span>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'flatsome' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
	</div><!-- .entry-content -->
	
</article><!-- #post-## -->
</div>
<?php } ?>

