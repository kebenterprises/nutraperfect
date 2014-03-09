<?php
// [tabgroup]
function tabgroup( $params, $content = null ) {
	$GLOBALS['tabs'] = array();
	$GLOBALS['tab_count'] = 0;
	$i = 1;
	$randomid = rand();

	extract(shortcode_atts(array(
		'title' => ''
	), $params));

	$content = do_shortcode($content);

	if( is_array( $GLOBALS['tabs'] ) ){
		
		foreach( $GLOBALS['tabs'] as $key => $tab ){
			$active = $key == 0 ? ' active' : ''; // Set first tab active by default.
			$tabs[] = '<li class="tab'.$active.'"><a href="#panel'.$randomid.$i.'">'.$tab['title'].'</a></li>';
			$panes[] = '<div class="panel'.$active.'" id="panel'.$randomid.$i.'"><p>'.do_shortcode($tab['content']).'</p></div>';
			$i++;
		}
		$return = '
		<div class="tabbed-content shortcode_tabgroup">
			<h3>'.$title.'</h3>
			<ul class="tabs">'.implode( "\n", $tabs ).'</ul><div class="panels">'.implode( "\n", $panes ).'</div><div class="clr"></div></div>';
	}
	return $return;
}

// [tabgroup_vertical]
function tabgroup_vertical( $params, $content = null ) {
	$GLOBALS['tabs'] = array();
	$GLOBALS['tab_count'] = 0;
	$i = 1;
	$randomid = rand();

	extract(shortcode_atts(array(
		'title' => 'Title'
	), $params));

	$content = do_shortcode($content);

	if( is_array( $GLOBALS['tabs'] ) ){
	
		foreach( $GLOBALS['tabs'] as $key => $tab ){
			$current = $key == 0 ? ' current-menu-item' : ''; // Set first menu item active by default.
			$active = $key == 0 ? ' active' : ''; // Set first tab active by default.
			$tabs[] = '<li class="tab'.$current.'"><a href="#panel'.$randomid.$i.'">'.$tab['title'].'</a></li>';
			$panes[] = '<div class="tabs-inner'.$active.'" id="panel'.$randomid.$i.'"><p>'.do_shortcode($tab['content']).'</p></div>';
			$i++;
		}
		$return = '
			<div class="row collapse vertical-tabs shortcode_tabgroup_vertical">
			<h3>'.$title.'</h3>
			<div class="large-3 columns"><ul class="tabs-nav">'.implode( "\n", $tabs ).'</ul></div><div class="large-9 columns">'.implode( "\n", $panes ).'</div></div>';
	}
	return $return;
}


function tab( $params, $content = null) {
	extract(shortcode_atts(array(
			'title' => ''
	), $params));
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );
	$GLOBALS['tab_count']++;
}


add_shortcode('tabgroup', 'tabgroup');
add_shortcode('tabgroup_vertical', 'tabgroup_vertical');
add_shortcode( 'tab', 'tab' );

?>