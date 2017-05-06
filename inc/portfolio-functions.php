<?php
/**
 * Custom functions for project portfolio
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CentralDesignStudios
 */

function mro_portfolio_item_type( $attachment_id ) {

    $image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' );

	if ( $image_attributes ) :
	    $width = $image_attributes[1];
		$height = $image_attributes[2];
	endif;

	$item_type = 'square';

	$ratio = $height / $width;

	if ( $ratio <= 0.8  ) {
		$item_type = 'landscape';
	} elseif( $ratio >= 1.25 ) {
		$item_type = 'portrait';
	}

	return $item_type;
}

function mro_portfolio_item_class( $item_type ) {

	$class = 'portfolio-item';

	if ( $item_type == 'landscape' ) {
		$class .= ' portfolio-item--width2';
	} elseif ( $item_type == 'portrait' ) {
		$class .= ' portfolio-item--height2';
	}

	return $class;
}

function mro_portfolio_item_get_srcset( $attachment_id, $item_type ) {

	if ( $item_type == 'square' ) {
		$sizes = array();
	} elseif ( $item_type == 'landscape' ) {
		$sizes = array();
	} elseif ( $item_type == 'portrait' ) {
		$sizes = array();
	}

}
