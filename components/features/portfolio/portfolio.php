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
		$args = array(
			'post_type'      => 'project',
			'posts_per_page' => -1,
		);
		$project_query = new WP_Query ( $args );

		if ( post_type_exists( 'project' ) && $project_query -> have_posts() ) :

			/* Start the Loop */
			while ( $project_query -> have_posts() ) : $project_query -> the_post();

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
			    Get portfolio item
			    */
				$post_thumbnail_id = get_post_thumbnail_id();

				$item_type = mro_portfolio_item_type( $post_thumbnail_id );

				$portfolio_class = mro_portfolio_item_class($item_type);

				$srcset = mro_portfolio_item_get_srcset( $post_thumbnail_id, $item_type );

				?>

			    <div class="all <?php echo $portfolio_class.' '. $tax; ?>">
			    	<a class="content" href="<?php echo get_permalink(); ?>">
			    		<div class="thumbnail"><?php echo $srcset; ?></div>
			    		<div class="link-info">
			    			<!-- <div class="container"> -->
				    			<h3><?php the_title(); ?></h3>
				    			<ul class="project-categories">
					    			<?php
									$posttags = get_the_terms($post->id, 'project-categories');
									if ($posttags) {
										foreach($posttags as $tag) {
									    echo '<li>' .$tag->name. '</li>'; 
									  }
									}
									?>
								</ul>
				    			<span class="read-more">More about this project</span>
			    			<!-- </div> -->
			    		</div><!-- .link-info -->
			    	</a>

			    </div><!-- .portfolio-item -->

					<?php //get_template_part( 'components/features/portfolio/content', 'portfolio' ); ?>

			<?php endwhile; ?>

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