<?php

namespace Urban\Frontend;

class Helpers {

	 public static function get_img( int $id  ) : array {
		$src    = wp_get_attachment_image_src( $id, 'full' );
		$sizes  = wp_get_attachment_image_sizes( $id, 'full' );
		$srcset = wp_get_attachment_image_srcset( $id, 'full' );
		$alt    = get_post_meta( $id, '_wp_attachment_image_alt', true );
		return [
			'src'    => $src[0] ?: '',
			'width'  => $src[1] ?: '',
			'height' => $src[2] ?: '',
			'srcset' => $srcset ?: '',
			'sizes'  => $sizes ?: '',
			'alt'    => $alt ?: 'image'
		];
	}

	public static function Caramba() : string {
		 return "Caramba";
	}
};
