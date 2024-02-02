<?php
require_once __DIR__ . '/vendor/autoload.php';

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

function register_blocks() {
	register_block_type( get_template_directory() . '/blocks/heroscreen' );
}
add_action( 'init', 'register_blocks' );


/*
<img fetchpriority="high"
     decoding="async"
     width="1000"
     height="1000"
     src="wp-content/uploads/2023/12/main-header.webp" class="attachment-full size-full"
     alt="Parimatch India offers a huge selection of sporting events and online casino with thousands of slots."
     loading="eager"
     srcset="./wp-content/uploads/2023/12/main-header.webp 1000w,
     ./wp-content/uploads/2023/12/main-header-300x300.webp 300w,
     ./wp-content/uploads/2023/12/main-header-150x150.webp 150w,
     ./wp-content/uploads/2023/12/main-header-768x768.webp 768w,
     ./wp-content/uploads/2023/12/main-header-700x700.webp 700w,
     ./wp-content/uploads/2023/12/main-header-450x450.webp 450w"
     sizes="(max-width: 1000px) 100vw, 1000px"
>*/


if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

function urban_starter_setup() {
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'urban_starter' ),
		)
	);
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action( 'after_setup_theme', 'urban_starter_setup' );

function urban_starter_scripts() {
	wp_enqueue_style( 'urban_starter-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'urban_starter-style', 'rtl', 'replace' );

	wp_enqueue_script( 'urban_starter-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'urban_starter_scripts' );

if ( is_login() ) {
	add_action('login_enqueue_scripts', fn($x) => wp_enqueue_style('urban', get_theme_file_uri('/style.css')));
}

$select_version = get_field('select_version', 'options') ?? 'v1';
define( 'VERSION_STYLE',  $select_version);
