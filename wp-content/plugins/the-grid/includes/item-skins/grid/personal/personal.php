<?php
/**
* @package   The_Grid
* @author    Themeone <themeone.master@gmail.com>
* @copyright 2015 Themeone
*
* Skin Name: Personal
* Skin Slug: personal
* Date: 04/20/17 - 06:02:55PM
*
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

// Init The Grid Elements instance
$tg_el = The_Grid_Elements();

// Prepare main data for futur conditions
$image  = $tg_el->get_attachment_url();
$format = $tg_el->get_item_format();

$output = null;

	// Media wrapper start
	$output .= $tg_el->get_media_wrapper_start();

	// Media content (image, gallery, audio, video)
	// $output .= $tg_el->get_media();

		// Media content holder start
		$output .= $tg_el->get_media_content_start();




		// Top wrapper start
		$output .= '<div class="tg-top-holder">';
			$output .= $tg_el->get_the_title(array('link' => false, 'action' => array('type' => 'link', 'link_target' => '_self', 'link_url' => 'post_url', 'custom_url' => '', 'meta_data_url' => '')), 'tg-element-1');
		$output .= '</div>';
		// Top wrapper end

		// Center wrapper start
		$output .= $tg_el->get_center_wrapper_start();
			$output .= $tg_el->get_the_excerpt(array('length' => '200', 'suffix' => '...'), 'tg-element-2');
		$output .= $tg_el->get_center_wrapper_end();
		// Center wrapper end

		// Media content holder end
		$output .= $tg_el->get_media_content_end();

	$output .= $tg_el->get_media_wrapper_end();
	// Media wrapper end


return $output;
