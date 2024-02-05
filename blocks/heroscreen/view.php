<?php

use Timber\Timber;
use Urban\Frontend\Helpers;
use Urban\Config;

//$img_id = $heroscreen_group['img'];

$buttons = get_field('buttons');



function get_style_str( ?array $styles_array ) :string|null {
	return $styles_array ? "--button-bg:{$styles_array['bg']};--button-bg-hover:{$styles_array['hover_bg']}" : null;
}

$buttons_arr = array_map(function ( $button ) {
	$is_custom_color = $button['colors']['is_custom'];
	if ($is_custom_color) {
		$style_str = get_style_str($button['colors']['settings']);
		$button['colors']['style'] = $style_str;
	}
	return $button;
}, $buttons);

var_dump($buttons_arr);

$data = [
	'text' => get_field('text'),

	'badge' => get_field('badge'),

	'is_show_badge' => get_field('is_show_badge'),
	'buttons' => $buttons_arr
//	'img' => Helpers::get_img($img_id)
];


Timber::render("./versions/". Config::get_chosen_theme() .".twig", $data);
