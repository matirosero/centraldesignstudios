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
	// var_dump($gallery);
	$img_size = 'full';
	?>

    <div class="portfolio">
    	<div class="portfolio-sizer"></div>

    	<?php
		$portfolio_class = 'portfolio-item';

		// Loop through them and output an image

		foreach ( (array) $gallery as $attachment_id => $attachment_url ) {
			echo '<div class="all '.$portfolio_class.'">';
			echo wp_get_attachment_image( $attachment_id, $img_size );
			echo '</div>';
		}
		?>

   </div><!-- #portfolio -->

	<footer class="entry-meta">


		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( esc_html__( 'Leave a comment', 'centraldesign' ), esc_html__( '1 Comment', 'centraldesign' ), esc_html__( '% Comments', 'centraldesign' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( esc_html__( 'Edit', 'centraldesign' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
</article><!-- #post-## -->