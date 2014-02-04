<?php
/*

Copyright 2014 Patrick Smith

*/



/*** !Paths ***/

if (true):
	define ('PULP_BASE_PATH', trailingslashit( TEMPLATEPATH ));
else:
	define ('PULP_BASE_PATH', plugin_dir_path( dirname(__FILE__) )); // Inside 'code' folder so go up one folder.
endif;

define ('PULP_CODE_PATH', PULP_BASE_PATH. 'pulp-code/');


/*** !URLs ***/

if (true):
	define ('PULP_BASE_URL', trailingslashit( get_bloginfo('template_url') ));
else:
	define ('PULP_BASE_URL', plugin_dir_url( dirname(__FILE__) )); // Inside 'code' folder so go up one folder.
endif;


// Assets base URL
define ('TIDAL_BASE_ASSETS_URL', TIDAL_BASE_URL. (TIDAL_SITE_TESTING ? 'assets/dev/' : 'assets/prod/'));

// CSS URL
define ('TIDAL_BASE_CSS_URL', TIDAL_BASE_ASSETS_URL. 'css/');

// JS URL
define ('TIDAL_BASE_JS_URL', TIDAL_BASE_ASSETS_URL. 'js/');




require_once(PULP_CODE_PATH. 'base/defines.php');
require_once(PULP_CODE_PATH_GLAZE);
require_once(PULP_CODE_PATH_INFO);
require_once(PULP_CODE_PATH_CACHE);

require_once(PULP_CODE_PATH_INIT);
require_once(PULP_CODE_PATH_QUERY);
require_once(PULP_CODE_PATH_DISPLAY_SECTION);
