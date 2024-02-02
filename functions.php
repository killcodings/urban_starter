<?php
require_once __DIR__ . '/vendor/autoload.php';
use Urban\Admin\Admin;

new Admin();
Admin::register_blocks('heroscreen');

add_action( 'acf/init', function () {
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page( [
			'page_title' => 'Настройки',
			'menu_title' => 'Настройки',
			'slug'       => 'advanced-options',
			'autoload'   => true,
			'icon_url'   => 'dashicons-hammer',
		] );

		acf_add_options_page( [
			'page_title'  => 'Настройки сайта',
			'menu_title'  => 'Настройки сайта',
			'parent_slug' => 'advanced-options',
			'slug'        => 'site-settings',
			'autoload'    => true,
			'icon_url'    => 'dashicons-hammer',
		] );

		acf_add_options_page( [
			'page_title'  => 'Настройки темы',
			'menu_title'  => 'Настройки темы',
			'parent_slug' => 'advanced-options',
			'slug'        => 'theme-settings',
			'autoload'    => true,
			'icon_url'    => 'dashicons-hammer',
		] );
	}
});


if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}
