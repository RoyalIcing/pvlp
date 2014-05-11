<?php
/*

Copyright 2014 Patrick Smith

*/



add_action('init', 'pvlpInit');


function pvlpInit()
{
	do_action('pvlpRegisterContentTypes');
	
	do_action('pvlpRegisterNavMenus');
	
	do_action('pvlpRegisterThumbnailSizes');
}
