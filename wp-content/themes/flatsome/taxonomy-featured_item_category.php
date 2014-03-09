<?php
get_header(); ?>

<div  class="page-wrapper page-featured-item">
<div class="row">

<div id="content" class="large-12 columns" role="main">
	<header class="entry-header">
		<h1 class="entry-title"><?php single_term_title(); ?></h1>
	</header>
	<ul class="large-block-grid-3 small-block-grid-2">
	<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$temp = $wp_query;
				$term =	$wp_query->queried_object;
				$wp_query= null;
				$wp_query = new WP_Query(array(
					'post_type' => 'featured_item',
					'orderby'=> 'menu_order',
					'tax_query' => array(
					array(
					'taxonomy' => 'featured_item_category',
						'field' => 'slug',
						'terms' => $term->name
					  )
					 ),
					'paged'=>$paged
				));
				while ($wp_query->have_posts()) : $wp_query->the_post();
					$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
				?>

					<li class="featured-item text-center">
						<a href="<?php echo get_permalink(get_the_ID()); ?>">
                        	 <div class="featured_item_image"><img src="<?php echo $featured_image[0]; ?>" alt="" /></div>
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
