<?php
/*

Copyright 2014 Patrick Smith

*/


add_shortcode('button', 'pulpShortcodeButton');



function pulpShortcodeButton($shortcodeAttributes, $content = '')
{
	ob_start();
	
	$elementAttributes = array();
	
	if (isset($shortcodeAttributes['href'])):
		$href = $shortcodeAttributes['href'];
	elseif (isset($shortcodeAttributes['section'])):
		$href = '#section-' .$shortcodeAttributes['section'];
	else:
		$href = '';
	endif;
	
	$class = array('buttonLink');
	if (isset($shortcodeAttributes['class'])) $class[] = $shortcodeAttributes['class'];
	
	glazyElement(array(
		'tagName' => 'a',
		'href' => $href,
		'class' => $class
	), $content);
	
	$html = ob_get_contents();
	ob_end_clean();
	
	return $html;
}


//glazyBeginPiece();
//glazyFinishPieceReturningString();