<?php
/*

Copyright 2014 Patrick Smith

*/



add_action('init', 'pulpInit');


function pulpInit()
{
	do_action('pulpRegisterContentTypes');
	
	do_action('pulpRegisterNavMenus');
}
