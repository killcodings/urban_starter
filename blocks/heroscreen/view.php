<?php

use Timber\Timber;


//$caramba = Urban\Frontend\Helpers;

//var_dump();

$heroscreen_group = get_field('heroscreen_group');
$img_id = $heroscreen_group['img'];

$data = [
	'title' => $heroscreen_group['heroscreen_title'],
	'description' => $heroscreen_group['heroscreen_description'],
	'bage' => $heroscreen_group['bage'],
	'settings' => $heroscreen_group['heroscreen_settings_group'],
	'img' => getImg($img_id)
];

Timber::render("./versions/". VERSION_STYLE .".twig", $data);
