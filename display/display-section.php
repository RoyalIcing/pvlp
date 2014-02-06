<?php
/*

Copyright 2014 Patrick Smith

*/


define ('PULP_PAGE_ID_META_KEY', 'pulp-page-id');


function pulpDisplayPageContent($pageID)
{
	$foundPosts = get_posts(array(
		'post_type' => 'page',
		'meta_key' => PULP_PAGE_ID_META_KEY,
		'meta_value' => $pageID
	));
	
	
	if (empty($foundPosts)):
		glazyElement('p', 'no post found for '.$pageID);
		return false;
	endif;
	
	$post = $foundPosts[0];
	$GLOBALS['post'] = $post;
	setup_postdata($post);
	
	glazyBegin('section');
	
	$sectionElementID = "section-$pageID";
	glazyAttribute('id', $sectionElementID);
	
	//glazyElement('h2.pageTitle', get_the_title(), GLAZE_TYPE_PREGLAZED);
	
	the_content();
	
	glazyClose();
	
	wp_reset_postdata();
}


function pulpDisplayPage()
{
	get_header();
	
	
	
	get_footer();
}