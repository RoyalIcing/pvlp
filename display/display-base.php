<?php
/*

Copyright 2014 Patrick Smith

*/


// ~ASYNC IMAGES
function pvlpDisplayAsyncImageSource($imageSource, $preload = false)
{
	burntDisplayAsyncImage($imageSource[0], array(
		'width' => $imageSource[1],
		'height' => $imageSource[2]
	), $preload);
}

function burntDisplayAsyncImage($imageURL, $options, $preload = false)
{
	$classNames = array();
	if (!empty($options['class']))
		$classNames[] = $options['class'];
	
	if ($preload)
		$classNames[] = 'loaded';
	else
		$classNames[] = 'needsLoading';
	
	/*
	glazyElement(array(
		'tagName' =>'img',
		'src' => $preload ? $imageURL : TIDAL_BASE_CORE_IMAGES_URL. 'empty.png',
		'width:check' => &$options['width'],
		'height:check' => $options['height'],
		'alt:check' => $options['alt']
	));
	*/
	
?>
<img<?php
	glazyAttribute('src', $preload ? $imageURL : PVLP_BASE_CORE_IMAGES_URL. 'empty.png');
	glazyAttributeCheck('width', $options['width']);
	glazyAttributeCheck('height', $options['height']);
	glazyAttributeCheck('alt', $options['alt']);
	
	if (!$preload):
		glazyAttribute('data-original', $imageURL, GLAZE_TYPE_URL);
	endif;
	
	glazyAttribute('class', $classNames);
?>><?php
}


// !TYPEKIT
function pvlpDisplayTypekitScripts()
{
?>
<script type="text/javascript" src="//use.typekit.net/<?= PVLP_TYPEKIT_KIT_ID ?>.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<?php
}


// !GOOGLE ANALYTICS
function pvlpDisplayGoogleAnalyticsTracking()
{
?>
<script>
var _gaq = _gaq || [];
_gaq.push(['_setAccount', '<?= PVLP_GOOGLE_ANALYTICS_ACCOUNT_ID ?>']);
_gaq.push(['_trackPageview'], ['_trackPageLoadTime']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
<?php
	if (defined('TIDAL_GOOGLE_ANALYTICS_TRACK_DEMOGRAPHIC_INFORMATION') and TIDAL_GOOGLE_ANALYTICS_TRACK_DEMOGRAPHIC_INFORMATION):
?>
ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
<?php
	else:
?>
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
<?php
	endif;
?>
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
<?php
}
