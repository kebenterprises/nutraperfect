<?php 
// [accordion]
function accordion($atts, $content=null, $code) {
	extract(shortcode_atts(array(
		'open' => '0',
		'title' => ''
	), $atts));

	if (!preg_match_all("/(.?)\[(accordion-item)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion-item\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} 
	else {
		$output = '';
		if($title) $title = '<h3 class="accordion_title">'.$title.'</h3>';
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
						
			$output .= '<div class="accordion-title"><a href="#">' . $matches[3][$i]['title'] . '</a></div><div class="accordion-inner">' . do_shortcode(trim($matches[5][$i])) .'</div>';
		}
		return $title.'<div class="accordion" rel="'.$open.'">' . $output . '</div>';
		
	}
}
add_shortcode('accordion', 'accordion');
?>