<?php

namespace Urban\Admin;

use Urban\Config;

class Admin {
	public function __construct() {
		$this->auto_load_field();
		$this->login_page_style();
		$this->navigation_setup();
		$this->admin_add_scripts();
	}

	public static function caramba(): string {
		return "Caramba Admin";
	}

	private function auto_load_field(): void {
		add_filter( 'acf/load_field/name=select_version_field', function ( $field ) {
			$field['choices'][ Config::get_chosen_theme() ] = Config::get_chosen_theme();
			$field['value']                                 = Config::get_chosen_theme();
			$field['default_value']                         = Config::get_chosen_theme();
			$field['readonly']                              = true;

			return $field;
		} );
	}

	private function login_page_style(): void {
		if ( is_login() ) {
			add_action( 'login_enqueue_scripts', fn( $x ) => wp_enqueue_style( 'urban', get_theme_file_uri( '/style.css' ) ) );
		}
	}

	public static function register_blocks( string $name ): void {
		add_action( 'init', function () use ( $name ) {
			register_block_type( get_template_directory() . "/blocks/$name" );
		} );
	}

	private function navigation_setup(): void {
		add_action( 'after_setup_theme', function () {
			register_nav_menus(
				array(
					'menu-1' => esc_html__( 'Primary', 'urban_starter' ),
				)
			);
		} );
	}

	private function admin_add_scripts(): void {
		add_action( 'admin_enqueue_scripts', function () {
			wp_enqueue_script( 'index', get_template_directory_uri() . '/dist/js/app.js' , '', '', ['in_footer' => true]);
			wp_localize_script( 'index', 'admin_object', [ 'version' => Config::get_chosen_theme() ] );
		} );
	}
}
