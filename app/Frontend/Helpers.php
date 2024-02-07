<?php

namespace Urban\Frontend;

class Helpers {

	public static function get_img( int $id ): array {
		$src    = wp_get_attachment_image_src( $id, 'full' );
		$sizes  = wp_get_attachment_image_sizes( $id, 'full' );
		$srcset = wp_get_attachment_image_srcset( $id, 'full' );
		$alt    = get_post_meta( $id, '_wp_attachment_image_alt', true );

		return [
			'class'   => 'image',
			'loading' => 'lazy',
			'src'     => $src[0] ?: '',
			'width'   => $src[1] ?: '',
			'height'  => $src[2] ?: '',
			'srcset'  => $srcset ?: '',
			'sizes'   => $sizes ?: '',
			'alt'     => $alt ?: 'image'
		];
	}

	public static function get_custom_style_button_str( ?array $options ) :string|null {
		return $options ?
			"--button-bg:{$options['bg']};
			--button-bg-hover:{$options['hover_bg']};
			--button-text-color:{$options['text_color']};
			--button-color-hover:{$options['color_hover']};
			--button-border:{$options['border_color']};
			--button-border-hover:{$options['border_hover']};
			--button-border-style:{$options['border_radius']}px;
			"
			: null;
	}

	public static function caramba() {
		return "Caramba";
	}

	public static function ArrayFilterRecursive( array $array ): array {
		$array = array_filter( $array );
		foreach ( $array as &$value ) {
			if ( is_array( $value ) ) {
				$value
					= self::ArrayFilterRecursive( $value ); // call_user_func( __FUNCTION__, $value )
			}
		}

		return $array;
	}
}
