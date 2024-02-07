<?php

use Timber\Timber;
use Urban\Frontend\Helpers;
use Urban\Config;

$buttons = get_field('buttons');
$payment_v2 = get_field('payment_v2')['images'];

$img_content = Helpers::get_img(get_field('img_v2'));
$img_content['class'] = 'v2';

array_walk( $payment_v2, static function ( &$payment_v2 ) {
	$payment_v2['image_current'] = Helpers::get_img( $payment_v2['image'] );
} );

$block_style = get_field('block_style');

$style_array = [
	'0' => $block_style['bage_bg'] ? "--bage-bg:{$block_style['bage_bg']}" : '',
	'1' => $block_style['bage_color'] ? "--bage-color:{$block_style['bage_color']}" : '',
	'2' => $block_style['cg-title'] ? "--cg-title:{$block_style['cg-title']}" : '',
	'3' => $block_style['text_align'] ? "--text-align:{$block_style['text_align']}" : '',
	'4' => $block_style['max_width'] ? "--max-width:{$block_style['max_width']}" : '',
	'5' => $block_style['heroscreen_picture_align_v2'] ? "--heroscreen-picture-align:{$block_style['heroscreen_picture_align_v2']}" : '',
	'6' => $block_style['heroscreeen_bonus_block_v2'] ? "--heroscreeen-bonus-block:{$block_style['heroscreeen_bonus_block_v2']}" : ''
];

$style_array = Helpers::ArrayFilterRecursive( $style_array );
$style_str = implode( ';', $style_array );

if ($style_str) {
	$style_str = "style='$style_str'";
}

$buttons_arr = $buttons ? array_map( function ( $button ) {
	$is_custom_color = $button['colors']['is_custom'];
	$new_btn = [
		'url' => $button['btn']['link']['url'],
		'title' => $button['btn']['link']['title'],
		'icon' => $button['btn']['icon']
	];

	if ( $is_custom_color ) {
		$style_str = Helpers::get_custom_style_button_str($button['colors']['settings']);
		$new_btn['style'] = $style_str;
	}

	if ( $button['btn']['img_v2'] ) {
		$new_btn['img'] = Helpers::get_img($button['btn']['img_v2']);
	}

	if ( Config::get_chosen_theme() === 'v2' ) {
		$new_btn['class'] = 'cg-heroscreen-v2__button';
	}

	return $new_btn;

}, $buttons) : null;


//echo "<pre>";
//var_dump($buttons_arr[0]);

$data = [
	'text' => get_field('text'),
	'badge' => get_field('badge'),
	'is_show_badge' => get_field('is_show_badge'),
	'buttons' => $buttons_arr,
	'img_content' => $img_content,
	'block_style' => $style_str,
	'payment_v2' => $payment_v2
];

Timber::render("./versions/". Config::get_chosen_theme() .".twig", $data);
