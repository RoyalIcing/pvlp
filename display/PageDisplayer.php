<?php
/*

Copyright 2014 Patrick Smith

*/



class PvlpPageDisplayer
{
	function __construct()
	{
		$this->makeCurrentPageDisplayer();
		
		add_action('init', array($this, 'wpInit'));
		add_action('get_header', array($this, 'enqueueScripts'));
	}
	
	public function makeCurrentPageDisplayer()
	{
		global $PvlpPageDisplayer_current;
		
		$PvlpPageDisplayer_current = $this;
	}
	
	public static function getCurrentPageDisplayer()
	{
		global $PvlpPageDisplayer_current;
		return $PvlpPageDisplayer_current;
	}
	
	
	public function wpInit()
	{
		$this->registerScripts();
	}
	
	public function registerScripts()
	{
	}
	
	public function enqueueScripts()
	{
	}
	
	public function enableModernizrLoading()
	{
		if (!is_admin()):
			add_action('wp_print_scripts', array($this, 'modernizrLoadJS'));
		endif;
	}

	// See: http://forrst.com/posts/Integrating_MODERNIZR_LOAD_JS_with_Wordpress-ROa
	public function modernizrLoadJS()
	{
		global $wp_scripts;
	
		$in_queue = $wp_scripts->queue;
		$wp_scripts->all_deps($in_queue);
		$scriptsList = $wp_scripts->to_do;
		if (!empty($in_queue)):
			$scripts = array();
			foreach ($scriptsList as $scriptID):
				$ver = $wp_scripts->registered[$scriptID]->ver ? $wp_scripts->registered[$scriptID]->ver : $wp_scripts->default_version;
				if (isset($wp_scripts->args[$scriptID])) {
					$ver .= '&amp;' . $wp_scripts->args[$scriptID];
				}
				$src = $wp_scripts->registered[$scriptID]->src;
				$src = ( (preg_match('/^((http|https)\:)?\/\//', $src)) ? '' : site_url('') ) . $src;
				
				if ($wp_scripts->registered[$scriptID]->ver != null) {
					$src = add_query_arg('ver', $ver, $src);
				}
				$src = esc_url(apply_filters('script_loader_src', $src, $scriptID)); 
				
				//$scripts[] = '{"' . $scriptID . '":"' . $src . '"}';
				$scripts[] = '"'.$src.'"';
			endforeach;
	
			$themeBase = get_bloginfo('template_url');
			/*echo '<script type="text/javascript" src="'. $themeBase.'/js/head.load.min.js"></script>'."\n";
			echo '<script type="text/javascript">head.js('. implode(",\n", $scripts). ');</script>'."\n";*/
?>
<script type="text/javascript"<?php glazyAttribute('src', PVLP_BASE_JS_URL. 'modernizr.custom.140223.js'); ?>></script>
<script type="text/javascript">
Modernizr.load({
	load:[<?= implode(",\n", $scripts); ?>],
	complete: function() {
		if (window.pvlpCompletedLoading) pvlpCompletedLoading();
	}
});
</script>
<?php
		endif;
	
		$wp_scripts->queue = array();
		$wp_scripts->to_do = array();
	}
	
	
	public function displayPageHeader()
	{
		get_header();
	}
	
	public function displayMainMenuContents()
	{
		require_once(PVLP_CODE_PATH_DISPLAY_MENU);
		pvlpDisplayMenuNavigation('main', 'mainMenu');
	}
	
	public function displayPageFooter()
	{
		get_footer();
	}
	
	public function displayFooterLegals()
	{
		$this->displayCopyright();
	}
	
	public function displayCopyright()
	{
		if (defined('PVLP_COPYRIGHT_MESSAGE')):
			glazyElement('h6.copyright', PVLP_COPYRIGHT_MESSAGE);
		endif;
	}
	
	public function displayFooterMenuContents()
	{
	}
	
	public function sectionElementID($pageID)
	{
		return "section-$pageID";
	}
	
	public function setUpDefaultOptionsForDisplaySection($options)
	{
		return array_merge(array(
			'addContentElement' => true,
			'wider' => false
		), (array)$options);
	}
	
	public function beginDisplayingSectionWithID($sectionID, $options = null)
	{
		$options = $this->setUpDefaultOptionsForDisplaySection($options);
		
		
		glazyBegin('section');
		glazyAttribute('id', $this->sectionElementID($sectionID));
		
		if (!empty($options['addContentElement'])):
			glazyBegin('div');
			
			$classes = array('content');
			if (!empty($options['wider'])):
				$classes[] = 'contentWider';
			endif;
			glazyAttribute('class', $classes);
		endif;
		
		// WordPress's shortcode runs first and displays later, so make sure glazy is ready.
		glazyEnsureOpeningTagForLatestElementIsDisplayed();
	}
	
	public function finishDisplayingSectionWithID($sectionID, $options = null)
	{
		$options = $this->setUpDefaultOptionsForDisplaySection($options);
		
		if (!empty($options['addContentElement'])):
			glazyFinish();
		endif;
		
		glazyFinish();
	}
	
	public function displaySectionForPageWithID($pageID)
	{
		$foundPosts = get_posts(array(
			'post_type' => 'page',
			'meta_key' => PVLP_PAGE_ID_META_KEY,
			'meta_value' => $pageID
		));
		
		
		if (empty($foundPosts)):
			//glazyElement('p', 'No page found for '.$pageID);
			return false;
		endif;
		
		$post = $foundPosts[0];
		$GLOBALS['post'] = $post;
		setup_postdata($post);
		
		
		$this->beginDisplayingSectionWithID($pageID);
		
		the_content();
		
		$this->finishDisplayingSectionWithID($pageID);
		
		wp_reset_postdata();
	}
}