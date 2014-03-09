<?php 
// [featured_box]
function featured_box($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'img'  => '',
        'pos' => '',
	), $atts));
	ob_start();
	?>

	<div class="featured-box <?php if($pos) echo 'pos-'.$pos; ?>">
	<div class="box-inner">
	<img class="featured-img" src="<?php echo $img; ?>">
    <h4><span><?php echo $title; ?></span></h4>
    <p><?php echo $content; ?></p>
	</div>
	</div>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


add_shortcode("featured_box", "featured_box");
