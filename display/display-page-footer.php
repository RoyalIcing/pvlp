<?php
/*

Pulp
Copyright 2014 Patrick Smith

*/

$pageDisplayer = PulpPageDisplayer::getCurrentPageDisplayer();

stir('footer');
?>
</div>
<?php

stirring('footer', 'banner');

?>
<footer id="footer">
<div class="content">
<?php
if (defined('PULP_COPYRIGHT_MESSAGE')):
	glazyElement('h6.copyright', PULP_COPYRIGHT_MESSAGE);
endif;

if (false):
	require_once (PULP_CODE_PATH_DISPLAY_MENU);
	pulpDisplayMenuNavigation('legalsMenu', 'legalsMenu', 'h6');
	stirring('footer', 'legals menu');
endif;

if (true):
	$mainNavigation = glazyBegin('nav#footerNavigation');
	{
		$pageDisplayer->displayFooterMenuContents();
	}
	glazyClose($mainNavigation);
	stirring('header', 'main navigation');
endif;
?>
</div>
</footer>
<?php
wp_footer();
stirring('footer', 'wp_footer');
?>
</div>
<?php
	
stirring('whole', 'footer');
stirred('footer');

stirDisplayRecordedTimesForHTML();
?>
</body>
</html>
<?php
//ob_end_flush();
