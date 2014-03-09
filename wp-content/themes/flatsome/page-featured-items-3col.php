<?php
/*
Template name: Featured Items - 3 columns
*/
get_header(); ?>

<div class="page-header">
<?php if( has_excerpt() ) the_excerpt();?>
</div>

<div  class="page-wrapper page-featured-item">
<div class="row">

<div id="content" class="large-12 columns" role="main">
	<header class="entry-header ">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
	<div class="item-intro">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; // end of the loop. ?>		
	</div>

	<ul class="large-block-grid-3 small-block-grid-2">
	<?php
				$temp = $wp_query;
				$wp_query= null;
				$post_counter = 0;
				$wp_query = new WP_Query(array(
					'post_type' => 'featured_item',
					'posts_per_page' => 6,
					'orderby'=> 'menu_order',
					'paged'=>$paged
				));
				while ($wp_query->have_posts()) : $wp_query->the_post();
					$post_counter++;
				?>

					<li class="featured-item text-center">
						<a href="<?php echo get_permalink(get_the_ID()); ?>">
                            <div class="featured_item_image"><?php the_post_thumbnail('large'); ?></div>
                            <h3><?php the_title(); ?></h3>
                             <div class="featured_item_cats">
                            <?php  echo strip_tags ( get_the_term_list( get_the_ID(), 'featured_item_category', "",", " ) );?>
                            </div>
                            <div class="tx-div small"></div>
                        </a>
                    </li>
				
				<?php endwhile; // end of the loop. ?>

</ul>
<!-- PAGINATION -->
<div class="large-12 columns">
	<div class="pagination-centered">
  	<?php
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
			'format' 		=> '',
			'current' 		=> max( 1, get_query_var('paged') ),
			'total' 		=> $wp_query->max_num_pages,
			'prev_text' 	=> '<span class="icon-angle-left"></span>',
			'next_text' 	=> '<span class="icon-angle-right"></span>',
			'type'			=> 'list',
			'end_size'		=> 3,
			'mid_size'		=> 3
		) ) );
	?>

</div><!--  end pagination container -->
</div><!-- end large-12 -->
<!-- end PAGINATION -->

<?php $wp_query = null; $wp_query = $temp;?>


</div><!-- end #content large-12  -->

</div><!-- end row -->
</div><!-- end portfolio container -->


<?php get_footer(); ?>
