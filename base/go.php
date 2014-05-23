<?php
/*

Pvlp
Copyright 2014 Patrick Smith

*/


/*** !Paths ***/

if (true):
	define ('PVLP_BASE_PATH', trailingslashit( TEMPLATEPATH ));
else:
	define ('PVLP_BASE_PATH', plugin_dir_path( dirname(__FILE__) )); // Inside 'code' folder, so go up one folder.
endif;

define ('PVLP_CODE_PATH', PVLP_BASE_PATH. 'pvlp/');


/*** !URLs ***/

if (true):
	define ('PVLP_BASE_URL', trailingslashit( get_bloginfo('template_url') ));
else:
	define ('PVLP_BASE_URL', plugin_dir_url( dirname(__FILE__) )); // Inside 'code' folder, so go up one folder.
endif;


// Assets base URL
define ('PVLP_BASE_ASSETS_URL', PVLP_BASE_URL. (PVLP_SITE_TESTING ? 'assets/dev/' : 'assets/prod/'));

// CSS URL
define ('PVLP_BASE_CSS_URL', PVLP_BASE_ASSETS_URL. 'css/');

// JS URL
define ('PVLP_BASE_JS_URL', PVLP_BASE_ASSETS_URL. 'js/');

// IMAGES URL
define ('PVLP_BASE_IMAGES_URL', PVLP_BASE_ASSETS_URL. 'images/');
define ('PVLP_BASE_CORE_IMAGES_URL', PVLP_BASE_IMAGES_URL. 'core/');



require_once(PVLP_CODE_PATH. 'base/defines.php');
require_once(PVLP_CODE_PATH_STIR);
require_once(PVLP_CODE_PATH_GLAZE);
require_once(PVLP_CODE_PATH_INFO);
require_once(PVLP_CODE_PATH_CACHE);

require_once(PVLP_CODE_PATH_INIT);
//require_once(PVLP_CODE_PATH_QUERY);
require_once(PVLP_CODE_PATH_DISPLAY_BASE);
require_once(PVLP_CODE_PATH_DISPLAY_SHORTCODE);
require_once(PVLP_CODE_PATH_CLASS_PAGE_DISPLAYER);
