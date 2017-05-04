<?php
/**
 * The template for displaying portfolio items
 *
 * @package CentralDesignStudios
 */
 ?>
<!-- Portfolio Filter Categories Loop -->

<ul id="filters">
    <?php
        $terms = get_terms('project-categories');
        $count = count($terms);
            echo '<li><a href="javascript:void(0)" title="" data-filter=".all" class="active">All</a></li>';
        if ( $count > 0 ){

            foreach ( $terms as $term ) {

                $termname = strtolower($term->name);
                $termname = str_replace(' ', '-', $termname);
                echo '<li><a href="javascript:void(0)" title="" data-filter=".'.$termname.'">'.$term->name.'</a></li>';
            }
        }
    ?>
</ul>


<!-- Portfolio Custom Post Loop -->
    <div class="portfolio">
    	<div class="portfolio-sizer"></div>
<?php



				// if ( get_query_var( 'paged' ) ) :
				// 	$paged = get_query_var( 'paged' );
				// elseif ( get_query_var( 'page' ) ) :
				// 	$paged = get_query_var( 'page' );
				// else :
				// 	$paged = 1;
				// endif;

				// $posts_per_page = 10;
				// $args = array(
				// 	'post_type'      => 'project',
				// 	'posts_per_page' => -1,
				// 	'paged'          => $paged,
				// );


				$args = array(
					'post_type'      => 'project',
					'posts_per_page' => -1,
				);
				$project_query = new WP_Query ( $args );

				if ( post_type_exists( 'project' ) && $project_query -> have_posts() ) :
			?>

				<!-- <div class="portfolio-wrapper"> -->

					<?php /* Start the Loop */ ?>
					<?php while ( $project_query -> have_posts() ) : $project_query -> the_post(); ?>


<?php
     /*
     Pull category for each unique post using the ID
     */
     $terms = get_the_terms( $post->ID, 'portfolio-categories' );
     if ( $terms && ! is_wp_error( $terms ) ) :

         $links = array();

         foreach ( $terms as $term ) {
             $links[] = $term->name;
         }

         $tax_links = join( " ", str_replace(' ', '-', $links));
         $tax = strtolower($tax_links);
     else :
	 $tax = '';
     endif;

     /*
     Image size
     */
	$post_thumbnail_id = get_post_thumbnail_id();
     $image_attributes = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
	if ( $image_attributes ) : 
	    $width = $image_attributes[1]; 
		$height = $image_attributes[2]; 
	endif; 

	$portfolio_class = 'portfolio-item';
	if ($width > $height) {
		$portfolio_class .= ' portfolio-item--width2';
	}

     /* Insert category name into portfolio-item class */
     echo '<div class="all '.$portfolio_class.' '. $tax .'">';
     echo '<a class="content" href="'. get_permalink() .'">';
     // echo '<a href="'. get_permalink() .'" title="'. the_title_attribute() .'">';
     echo '<div class="thumbnail">'. the_post_thumbnail() .'</div>';
     echo '</a>';
     // echo '<h2>'. the_title() .'</h2>';
     // echo '<div>'. the_excerpt() .'</div>';
     echo '</div>';
?>
						<?php //get_template_part( 'components/features/portfolio/content', 'portfolio' ); ?>

					<?php endwhile; ?>

				<!-- </div> -->
				<?php
					the_posts_navigation();
					wp_reset_postdata();
				?>

			<?php else : ?>

				<section class="no-results not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'centraldesign' ); ?></h1>
					</header>
					<div class="page-content">
						<?php if ( current_user_can( 'publish_posts' ) ) : ?>

							<p><?php printf( wp_kses( __( 'Ready to publish your first project? <a href="%1$s">Get started here</a>.', 'centraldesign' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php?post_type=jetpack-portfolio' ) ) ); ?></p>

						<?php else : ?>

							<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'centraldesign' ); ?></p>
							<?php get_search_form(); ?>

						<?php endif; ?>
					</div>
				</section>
			<?php endif; ?>
   </div><!-- #portfolio -->