<?php

namespace Urban\Frontend;
use Urban\Config;

class Init extends Config {

	public function __construct() {
		parent::__construct();
		$this->register_scripts();
		$this->enable_html5();
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

	private function register_scripts() : void {
		add_action( 'wp_enqueue_scripts', function () {
			wp_enqueue_style( 'index', $this->general_style, null, $this->filemtime_style );
			wp_enqueue_style( 'version', $this->version_css, null, $this->filemtime_style );
			wp_enqueue_script( 'index', $this->shared_js_path, null, $this->filemtime_style, true );
			wp_localize_script( 'index', 'jsVars',
				[ 'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'version' => self::$chosen_theme
				]
			);
		} );
	}
}
