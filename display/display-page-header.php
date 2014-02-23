<?php
/*

Pulp
Copyright 2014 Patrick Smith

*/

$pageDisplayer = PulpPageDisplayer::getCurrentPageDisplayer();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<?php
stirring('whole', 'into template');
stir('header');
?>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
<title><?php bloginfo('name'); ?> <?php wp_title(BURNT_ENDASH); ?></title>
<link rel="icon"<?php glazyAttribute('href', PULP_FAVICON_URL); ?> type="image/x-icon">
<meta name="viewport" content="width=device-width">
<link type="text/css" rel="stylesheet"<?php glazyAttribute('href', PULP_BASE_CSS_URL. PULP_ASSETS_ID. '/' .PULP_ASSETS_ID. '.css?ver=' .(PULP_SITE_VERSION . PULP_SITE_STYLESHEET_REVISION)); ?>>
<?php
if (defined('PULP_FACEBOOK_APP_ID')):
?>
<meta property="fb:app_id"<?php glazyAttribute('content', PULP_FACEBOOK_APP_ID); ?>>
<?php
endif;
if (defined('PULP_FACEBOOK_PAGE_ID')):
?>
<meta property="fb:page_id"<?php glazyAttribute('content', PULP_FACEBOOK_PAGE_ID); ?>>
<?php
endif;

//$canonicalURL = pulpGetCanonicalURL();
if (false && !empty($canonicalURL)):
?>
<link rel="canonical"<?php glazyAttribute('href', $canonicalURL); ?>>
<?php
endif;

if (defined('PULP_SITE_DESCRIPTION')):
	glazyElement(array(
		'tagName' => 'meta',
		'name' => 'description',
		'content' => PULP_SITE_DESCRIPTION
	));
endif;

stirring('header', 'start');

wp_head();
stirring('header', 'wp_head');

if (PULP_ENABLE_TYPEKIT):
	pulpDisplayTypekitScripts();
endif;

if (false):
?>
<link href="https://plus.google.com/117151366935336828053" rel="publisher">
<?php
endif;

if (PULP_SITE_IS_REAL):
	pulpDisplayGoogleAnalyticsTracking();
else:
	// _gaq variable is still created so added analytics info can be debugged.
?>
<script>
var _gaq = [];
</script>
<?php
endif;
?>
</head>
<body <?php
stirring('header', 'open graph tags');

body_class();

stirring('header', 'body start');

?>>
<div id="fb-root"></div>
<?php /* Copy body classes to <html> element (for styling skins) */ ?>
<script>
document.documentElement.className += " " + document.body.className;
</script>
<div id="page" class="pulp">
<header id="header">
<div class="content">
<h1><a href="<?= home_url('/'); ?>"><?= glazeText(PULP_SITE_TITLE) ?></a></h1>
<?php
if (true):
	$mainNavigation = glazyBegin('nav#mainNavigation');
	{
		$pageDisplayer->displayMainMenuContents();
	}
	glazyClose($mainNavigation);
	stirring('header', 'main navigation');
endif;

if (false):
?>
<div id="siteSearch">
<h3 id="mainSearchButton"><a href="#search">Search</a></h3>
<div id="searchForm">
<?php
get_search_form();
?>
</div>
</div>
<?php
endif;
?>
</div>
</header>
<div id="main"<?php
//$mainElementClasses = apply_filters('ilMainElementClasses', array());
//ilDisplayAttributeCheck('class', $mainElementClasses);
?>>
<?php

//ob_end_flush();

stirring('header', 'search');
stirred('header');
stirring('whole', 'header display');
