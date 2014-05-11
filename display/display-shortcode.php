<?php
/*

Copyright 2014 Patrick Smith

*/



// Fix really annoying WordPress automatic paragraph formatting bug:
// http://wordpress.org/support/topic/shortcode-inline-with-text-always-wrapped-in-p-tags
remove_filter('the_content', 'wpautop');
add_filter('the_content', 'wpautop' , 99);
add_filter('the_content', 'shortcode_unautop', 100);



/* Register Shortcodes */
add_shortcode('buttons_aside', 'pvlpShortcodeButtonsAside');
add_shortcode('button', 'pvlpShortcodeButton');

add_shortcode('item', 'pvlpShortcodeItem');

add_shortcode('email_address_text', 'pvlpShortcodeEmailAddressText');
add_shortcode('email_button', 'pvlpShortcodeEmailButton');




function pvlpBeginDisplayingButtonsAside($options = null)
{
	return glazyBegin(array(
		'tagName' => 'aside',
		'class' => 'buttons'
	));
}


function pvlpShortcodeButtonsAside($shortcodeAttributes, $content = '')
{
	ob_start();
	
	$processedContent = do_shortcode(trim($content));
	glazyElement(array(
			'tagName' => 'aside',
			'class' => 'buttons'
		),
		$processedContent, GLAZE_TYPE_PREGLAZED);
	
	return ob_get_clean();
}


function pvlpShortcodeButton($shortcodeAttributes, $content = '')
{
	//glazyEnsureOpeningTagForLatestElementIsDisplayed();
	
	ob_start();
	
	$elementAttributes = array();
	
	if (isset($shortcodeAttributes['href'])):
		$href = $shortcodeAttributes['href'];
	elseif (isset($shortcodeAttributes['section'])):
		$href = pvlpGetInPageURLToSectionWithID($shortcodeAttributes['section']);
	else:
		$href = '';
	endif;
	
	$class = array('buttonLink');
	if (!empty($shortcodeAttributes['class'])) $class[] = $shortcodeAttributes['class'];
	
	glazyElement(array(
		'tagName' => 'a',
		'href' => $href,
		'class' => $class
	), $content);
	
	return ob_get_clean();
}


function pvlpShortcodeItem($shortcodeAttributes, $content = '')
{
	ob_start();
	
	$shortcodeAttributes = shortcode_atts(array(
		'class' => ''
	), $shortcodeAttributes, 'pvlp_item');
	
	$processedContent = do_shortcode(trim($content));
	glazyElement(array_filter(array(
			'tagName' => 'div',
			'class' => $shortcodeAttributes['class']
		)),
		$processedContent, GLAZE_TYPE_PREGLAZED);
	
	return ob_get_clean();
}


function pvlpShortcodeEmailAddressText($shortcodeAttributes, $content = '')
{
	ob_start();
	
	$shortcodeAttributes = shortcode_atts(array(
		'class' => ''
	), $shortcodeAttributes, 'pvlp_email_address_text');
	
	$processedContent = do_shortcode(trim($content));
	glazyElement(array_filter(array(
			'tagName' => 'p',
			'class' => $shortcodeAttributes['class']
		)),
		$content, GLAZE_TYPE_EMAIL_ADDRESS);
	
	return ob_get_clean();
}

function pvlpShortcodeEmailButton($shortcodeAttributes, $content = '')
{
	ob_start();
	
	$shortcodeAttributes = shortcode_atts(array(
		'email_address' => '',
		'class' => ''
	), $shortcodeAttributes, 'pvlp_email_button');
	
	$class = array('emailAddressButtonLink', 'buttonLink');
	if (!empty($shortcodeAttributes['class'])) $class[] = $shortcodeAttributes['class'];
	
	$processedContent = do_shortcode(trim($content));
	glazyElement(array_filter(array(
			'tagName' => 'a',
			'href' => array('value' => $shortcodeAttributes['email_address'], 'valueType' => GLAZE_TYPE_EMAIL_ADDRESS_MAILTO_URL),
			'class' => $class
		)),
		$content);
	
	return ob_get_clean();
}


//glazyBeginPiece();
//glazyFinishPieceReturningString();