<?php
/*

Copyright 2014 Patrick Smith

*/

stir('footer');
?>
</div>
<?php

stirring('footer', 'banner');

?>
<div id="footer">
<?php
if (defined('PULP_COPYRIGHT_MESSAGE')):
	glazyElement('h6.copyright.class', PULP_COPYRIGHT_MESSAGE);
endif;

require_once (PULP_CODE_PATH_DISPLAY_MENU);
pulpDisplayMenuNavigation('legalsMenu', 'legalsMenu', 'h6');
stirring('footer', 'legals menu');
?>
</div>
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
