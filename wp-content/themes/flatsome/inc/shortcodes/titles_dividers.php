<?php
// [title]
function title_shortcode( $atts, $content = null ){
  extract( shortcode_atts( array(
    'text' => '',
    'style' => '',
    'link' => '',
    'link_text' => ''
  ), $atts ) );

  $link_output = '';
  $style_output ='';
  if($style) $style_output = 'title_'.$style;
  if($link) $link_output = '<a href="'.$link.'">'.$link_text.'</a>';

return '<div class="row"><div class="large-12 columns"><h3 class="section-title '.$style_output.'"><span>'.$atts['text'].'</span> '.$link_output.'</h3></div></div><!-- end section_title -->';

}
add_shortcode('title', 'title_shortcode');


// [divider]
function divider_shortcode( $atts, $content = null ){
  extract( shortcode_atts( array(
    'width' => 'medium',
  ), $atts ) );

return '<div class="row"><div class="large-12 columns"><div class="tx-div '.$width.'"></div></div></div><!-- end divider -->';

}
add_shortcode('divider', 'divider_shortcode');

