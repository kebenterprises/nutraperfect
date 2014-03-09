<?php

if(isset($flatsome_opt['type_headings']) && !$flatsome_opt['disable_fonts']){
$customfont = '';
$default = array(
					'arial',
					'verdana',
					'trebuchet',
					'georgia',
					'times',
					'tahoma',
					'helvetica'
				);

$googlefonts = array(
					$flatsome_opt['type_headings'],
					$flatsome_opt['type_texts'],
					$flatsome_opt['type_nav'],
					$flatsome_opt['type_alt']
);



$customfontset = '';

if(isset($flatsome_opt['type_subset'])){
$subsets= array('latin');
if($flatsome_opt['type_subset']['latin']){array_push($subsets, 'latin');}
if($flatsome_opt['type_subset']['cyrillic-ext']){array_push($subsets, 'cyrillic-ext');}
if($flatsome_opt['type_subset']['greek-ext']){array_push($subsets, 'greek-ext');}
if($flatsome_opt['type_subset']['greek']){array_push($subsets, 'greek');}
if($flatsome_opt['type_subset']['vietnamese']){array_push($subsets, 'vietnamese');}
if($flatsome_opt['type_subset']['cyrillic']){array_push($subsets, 'cyrillic');}
foreach($subsets as $fontset) {
	$customfontset = $fontset.','. $customfontset;
}	
$customfontset = '&subset='.substr_replace($customfontset ,"",-1);
}

			
foreach($googlefonts as $googlefont) {
	if(!in_array($googlefont, $default)) {
			$customfont = str_replace(' ', '+', $googlefont). ':300,300italic,400,400italic,700,700italic,900,900italic|' . $customfont;
	}
}	


if ($customfont != "") {	
	function google_fonts() {	
		global $customfont, $customfontset;		
		$protocol = is_ssl() ? 'https' : 'http';
			wp_enqueue_style( 'flatsome-googlefonts', "$protocol://fonts.googleapis.com/css?family=". substr_replace($customfont ,"",-1) . $customfontset);}
			add_action( 'wp_enqueue_scripts', 'google_fonts' );
	
}

}

?>
