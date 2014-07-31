<?php
/*

Pvlp
Copyright 2014 Patrick Smith

*/

$pageDisplayer = PvlpPageDisplayer::getCurrentPageDisplayer();

stir('footer');
?>
</div>
<?php

stirring('footer', 'banner');

?>
<footer id="footer">
<div class="content">
<?php
	// Legals, Copyright
	$pageDisplayer->displayFooterLegals();

	// Footer Navigation
	$mainNavigation = glazyBegin('nav#footerNavigation');
	{
		$pageDisplayer->displayFooterMenuContents();
	}
	glazyFinish($mainNavigation);
	stirring('header', 'main navigation');
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
