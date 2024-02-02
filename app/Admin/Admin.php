<?php

namespace Urban\Admin;

class Admin {
	public function __construct() {
		$this->auto_load_field();
		$this->enable_html5();
		$this->login_page_style();
		$this->navigation_setup();
	}

	public static function caramba() : string {
		return "Caramba Admin";
	}

	private function auto_load_field() : void {
		add_filter('acf/load_field/name=select_version_field', function( $field ) {
			$field['choices'][VERSION_STYLE] = VERSION_STYLE;
			$field['value'] = VERSION_STYLE;
			$field['default_value'] = VERSION_STYLE;
			$field['readonly'] = true;
			return $field;
		});
	}

	private function enable_html5(): void {
		add_action( 'after_setup_theme', function () {
			add_theme_support( 'html5', [
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			] );
		} );
	}

	private function login_page_style(): void {
		if ( is_login() ) {
			add_action('login_enqueue_scripts', fn($x) => wp_enqueue_style('urban', get_theme_file_uri('/style.css')));
		}
	}

	public static function register_blocks( string $name ): void {
		add_action( 'init', function () use ( $name ) {
			register_block_type( get_template_directory() . "/blocks/$name" );
		});
	}

	private function navigation_setup() : void {
		add_action( 'after_setup_theme', function () {
			register_nav_menus(
				array(
					'menu-1' => esc_html__( 'Primary', 'urban_starter' ),
				)
			);
		} );
	}
};
