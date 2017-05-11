<?php
		// You can upload a custom header and it'll output in a smaller logo size.
		$header_image = get_header_image();

		if ( ! empty( $header_image ) ) { ?>
			<div id="header-image" class="custom-header">
				<div class="header-wrapper">
		<?php } ?>

		<div class="site-branding">
			<h1 class="site-title">
				
				<?php
				if ( has_custom_logo() ) {
					centraldesign_the_custom_logo();
				} else { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				<?php } ?>

			</h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div><!-- .site-branding -->

		<?php if ( ! empty( $header_image ) ) { ?>
				</div><!-- .header-wrapper -->
				<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
			</div><!-- #header-image .custom-header -->
		<?php } ?>
