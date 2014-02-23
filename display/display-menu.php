<?php
/*

Copyright 2014 Patrick Smith

*/

function pulpShortenNameToProperNameSlug($name)
{
	$name = preg_replace('/[\/_ |+-]/', '-', $name);
	$name = preg_replace('/-+/', '-', $name);
	return $name;
}

function pulpDisplayMenuNavigation($menuName, $menuElementID = '', $tag = 'h2')
{
	global $wp_query;
	
	if (( $navMenuLocations = get_nav_menu_locations() ) && isset( $navMenuLocations[$menuName] )):
		if (!empty($wp_query->queried_object_id)):
			$queriedObjectID = (int)$wp_query->queried_object_id;
		endif;
		
		$actionID = "menu $menuName";
		
		$menusRevision = ilRevisionCounterForID('menus');
		$cacheKey = "menu-items-($menusRevision)-$menuName";
		$valueFromCache = ilCacheGet($cacheKey);
		if ($valueFromCache !== false):
			$menuItems = $valueFromCache;
		else:
			$menu = wp_get_nav_menu_object( $navMenuLocations[ $menuName ] );
			$menuItems = wp_get_nav_menu_items((int)$menu->term_id);
			ilCacheSet($cacheKey, $menuItems);
		endif;		
		
		$baseMenuItems = array();
		$mapMenuIDToSubmenus = array();
		
		foreach ( (array)$menuItems as $key => $menuItem ):
			if (empty($menuItem->menu_item_parent)):
				$baseMenuItems[] = $menuItem;
			else:
				if (empty($mapMenuIDToSubmenus[$menuItem->menu_item_parent]))
					$mapMenuIDToSubmenus[$menuItem->menu_item_parent] = array();
				$mapMenuIDToSubmenus[$menuItem->menu_item_parent][] = $menuItem;
			endif;
		endforeach;
		
		if (!isset($menuElementID)):
			$menuElementID = "menu-{$menuName}";
		endif;
?>
<ul<?php glazyAttribute('id', $menuElementID); ?> class="menu">
<?php
		foreach ( (array)$baseMenuItems as $key => $menuItem ):
			pulpDisplayMenuItem($menuItem, $mapMenuIDToSubmenus, $tag);
		endforeach;
?>
</ul>
<?php
	endif;
}

function pulpDisplayMenuItem($menuItem, $mapMenuIDToSubmenus, $tag)
{
	global $wp_query;
	
	if (!empty($wp_query->queried_object_id)):
		$queriedObjectID = (int)$wp_query->queried_object_id;
	endif;
	
	$title = $menuItem->title;
	$url = $menuItem->url;
	$classes = array('menuItem-'.pulpShortenNameToProperNameSlug($title));
	if (!empty($queriedObjectID)):
		$currentItem = (( $menuItem->object_id == $queriedObjectID) && (($wp_query->is_singular() && $menuItem->type == 'post_type') || ($wp_query->is_category() && $menuItem->object == 'category' )));
		$currentCategory = ($wp_query->is_single || $wp_query->is_page) && ($menuItem->object == 'category') && (in_category($menuItem->object_id, $queriedObjectID));
		
		if ($currentItem)
			$classes[] = 'current-item';
		
		if ($currentCategory)
			$classes[] = 'current-category';
	endif;
	
?>
<li<?= glazyAttribute('class', $class); ?>><<?= $tag ?>><a<?php glazyAttribute('href', $url); ?>><?= glazeText($title) ?></a></<?= $tag ?>><?php
	if (!empty($mapMenuIDToSubmenus[$menuItem->ID])):
?>

<ul class="menu submenu">
<?php
		foreach ($mapMenuIDToSubmenus[$menuItem->ID] as $submenu):
			pulpDisplayMenuItem($submenu, $mapMenuIDToSubmenus, $tag);
		endforeach;
?>
</ul>
<?php
	endif;
?></li>
<?php
}
