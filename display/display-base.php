<?php
/*

Copyright 2014 Patrick Smith

*/


// ~ASYNC IMAGES
function pulpDisplayAsyncImageSource($imageSource, $preload = false)
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
	glazyAttribute('src', $preload ? $imageURL : PULP_BASE_CORE_IMAGES_URL. 'empty.png');
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
function pulpDisplayTypekitScripts()
{
?>
<script type="text/javascript" src="//use.typekit.net/<?= PULP_TYPEKIT_KIT_ID ?>.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<?php
}
