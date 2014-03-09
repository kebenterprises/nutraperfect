<?php
// [testimonial]
function shortcode_testimonial($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"image" => '',
		"pos" => '',
		"name" => '',
		"company" => '',
		"stars" => '',
	), $params));
	$content = preg_replace('#<br\s*/?>#', "", $content);

	$star_row = '';
	if ($stars == '1'){$star_row = '<div class="star-rating"><span style="width:25%"><strong class="rating"></strong></span></div>';}
	else if ($stars == '2'){$star_row = '<div class="star-rating"><span style="width:35%"><strong class="rating"></strong></span></div>';}
	else if ($stars == '3'){$star_row = '<div class="star-rating"><span style="width:55%"><strong class="rating"></strong></span></div>';}
	else if ($stars == '4'){$star_row = '<div class="star-rating"><span style="width:75%"><strong class="rating"></strong></span></div>';}
	else if ($stars == '5'){$star_row = '<div class="star-rating"><span style="width:100%"><strong class="rating"></strong></span></div>';}


	$testimonial='


	<div class="testemonial">
		<div class="testimonial_inner">
			<div class="testimonial_image">
			<img src="'.$image.'" alt="'.$name.'" class="circle" />
			</div><!-- .testemonial_image -->
			<div class="testimonial_text">
				'.$star_row.'
				<span class="test_content">'.$content.'</span>
				<div class="tx-div small"></div>
				<span class="test_name">'.$name.'</span>
				<span class="test_company">'.$company.'</span>
			</div>
		</div><!-- .testemonial_inner -->
	</div><!-- row -->
	';

	return $testimonial;
}

add_shortcode('testimonial','shortcode_testimonial');