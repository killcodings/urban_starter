<?php

namespace Urban\Admin;

class Init {

	public function __construct() {
		$this->register_scripts();
	}

	private function register_scripts() : void {
		add_action( 'wp_enqueue_scripts', function () {
			wp_enqueue_style( 'urban_starter-style', get_stylesheet_uri(), array(), _S_VERSION );
			wp_style_add_data( 'urban_starter-style', 'rtl', 'replace' );

			wp_enqueue_script( 'urban_starter-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		} );
	}
}
