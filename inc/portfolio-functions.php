<?php
/**
 * Custom functions for project portfolio
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CentralDesignStudios
 */

function mro_portfolio_item_type( $attachment_id ) {

    global $post;

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
	} else {
		if ( is_singular( 'project' ) ) {
			if ( $attachment_id == get_post_thumbnail_id( $post->ID )) {
				$item_type .= '2x';
			}
		} else {
			$mro_grid_2x = get_post_meta( $post->ID, 'mro_project_gridsize_2x', true );
			if ( $mro_grid_2x == 'on' ) {
				$item_type .= '2x';
			}
		}
	}
	return $item_type;
}

function mro_portfolio_item_class( $item_type ) {

	global $post;

	$class = 'portfolio-item';


	if ( $item_type == 'landscape' ) {
		$class .= ' portfolio-item--width2';
	} elseif ( $item_type == 'portrait' ) {
		$class .= ' portfolio-item--height2';
	} elseif ( $item_type == 'square2x' ) {
		$class .= ' portfolio-item--width2 portfolio-item--height2';
	}

	return $class;
}

function mro_portfolio_item_get_srcset( $attachment_id, $item_type ) {

	if ( $item_type == 'square' || $item_type == 'square2x' ) {
		$sizes = array(
			// array( 400, 400, true ),
			array( 620, 620, true ),
			array( 800, 800, true ),
			array( 1024, 1024, true ),
		);
	} elseif ( $item_type == 'landscape' ) {
		$sizes = array(
			// array( 400, 200, true ),
			// array( 620, 310, true ),
			// array( 900, 450, true ),
			array( 1024, 512, true ),
			// array( 1200, 600, true ),
		);
	} elseif ( $item_type == 'portrait' ) {
		$sizes = array(
			array( 512, 1024, true ),
		);
	}

	$srcset = ipq_get_theme_image(
		$attachment_id,
		$sizes,
	    array(
	        'class' => 'portfolio-image'
	    )
	);

	return $srcset;

}

function mro_categories_to_class() {
	global $post;
	$posttags = get_the_terms($post->id, 'project-categories');

	if ($posttags) {
		$tag_names = array();
		foreach ($posttags as $tag) {
			$tag_names[] = $tag->slug;
		}
		// var_dump($tag_names);
		$tag_classes = implode(' ',$tag_names);
		return $tag_classes;
	} else {
		return false;
	}
}


function mro_list_project_categories() {
	global $post;
	$posttags = get_the_terms($post->id, 'project-categories');
	if ($posttags) { ?>
		<ul class="project-categories">
			<?php
			foreach($posttags as $tag) {
		    	echo '<li>' .$tag->name. '</li>';
		  	} ?>
		</ul>
	<?php }
}


function mro_caldera_modal($caldera_id = 'CF59162a9ed3ba6') {
	echo do_shortcode( '[caldera_form_modal id="'.$caldera_id.'" type="button" width="600"]Tell me more about this project[/caldera_form_modal]' );
}