<?php
/*
Plugin Name: Index Or Not
Description: Индексируй только выбранные страницы, остальные получают noindex,nofollow.
Version: 1.0.0
Author: 7on
*/

if (! defined('ABSPATH')) {
	exit;
}

function custom_control_robots_meta($robots)
{
	$temp_page  = array('home-page'); // замените на нужные ярлыки страниц
	if (is_page($temp_page)) {
		$robots['index'] = true;
		$robots['follow'] = true;
	} else {
		$robots['noindex'] = true;
		$robots['nofollow'] = true;
	}
	return $robots;
}

$saintsmedia_index_or_not = $is_enabled = get_theme_mod('saintsmedia_index_or_not', false);
if ($saintsmedia_index_or_not) {
	add_filter('wp_robots', 'custom_control_robots_meta');
}
