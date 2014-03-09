<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

global $flatsome_opt, $woocommerce_loop;
?>
<div class="row"><div class="large-12 columns">

<?php if(!empty($woocommerce_loop)){ ?>
	<ul class="products small-block-grid-2 large-block-grid-<?php echo $woocommerce_loop["columns"]; ?>">
<?php } else if (isset( $flatsome_opt['category_row_count'])) { ?>
	<ul class="products small-block-grid-2 large-block-grid-<?php echo $flatsome_opt['category_row_count']; ?>">
<?php } else { ?>
	<ul class="products small-block-grid-2 large-block-grid-4">
<?php } ?>
