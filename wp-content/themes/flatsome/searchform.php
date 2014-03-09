<?php
/**
 * The template for displaying search forms in flatsome
 *
 * @package flatsome
 */
?>


<div class="row collapse search-wrapper">
<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	  <div class="large-10 small-10 columns">
	   		<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'flatsome' ); ?>" />
	  </div><!-- input -->
	  <div class="large-2 small-2 columns">
	    <button class="button secondary postfix"><i class="icon-search"></i></button>
	  </div><!-- button -->
</form>
</div><!-- row -->

