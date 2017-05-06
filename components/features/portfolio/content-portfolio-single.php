<?php
/**
 * @package CentralDesignStudios
 */

// Access global variable directly to adjust the content width for portfolio single page
if ( isset( $GLOBALS['content_width'] ) ) {
	$GLOBALS['content_width'] = 1100;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php echo get_the_term_list( $post->ID, 'project-categories', '<span class="portfolio-entry-meta">', esc_html_x(', ', 'Used between list items, there is a space after the comma.', 'centraldesign' ), '</span>' ); ?>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'   => '<div class="page-links clear">',
				'after'    => '</div>',
				'pagelink' => '<span class="page-link">%</span>',
			) );
		?>
	</div>


	<?php
	$gallery = get_post_meta( $post->ID, 'mro_project_gallery', 1 );

	if ( $gallery ) { 

		$post_thumbnail_id = get_post_thumbnail_id();
		$gallery = array($post_thumbnail_id => '') + $gallery;

		?>

	   	<div class="portfolio">
	    	<div class="portfolio-sizer"></div>

	    	<?php

			// Loop through them and output an image

			foreach ( (array) $gallery as $attachment_id => $attachment_url ) {

				/*
			    Get portfolio item
			    */
				$item_type = mro_portfolio_item_type( $attachment_id );
				$portfolio_class = mro_portfolio_item_class($item_type);
				$srcset = mro_portfolio_item_get_srcset( $attachment_id, $item_type );

				?>

			    <div class="all <?php echo $portfolio_class; ?>">
			    	<a class="content" href="#">
			    		<div class="thumbnail"><?php echo $srcset; ?></div>
			    	</a>
			    </div><!-- .portfolio-item -->

			<?php } ?>

	   	</div><!-- #portfolio -->


	<?php } else {
		echo 'no gallery';
	}

	?>

	<footer class="entry-meta">


		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( esc_html__( 'Leave a comment', 'centraldesign' ), esc_html__( '1 Comment', 'centraldesign' ), esc_html__( '% Comments', 'centraldesign' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( esc_html__( 'Edit', 'centraldesign' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
</article><!-- #post-## -->