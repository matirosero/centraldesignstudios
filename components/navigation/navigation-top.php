<nav id="site-navigation" class="main-navigation" role="navigation">
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'centraldesign' ); ?></button>

	<?php if( !is_front_page() ) : ?>
		<div id="main-site-logo">
			<?php centraldesign_the_custom_logo(); ?>
		</div>
	<?php endif; ?>

	<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_id' => 'top-menu' ) ); ?>
</nav><!-- #site-navigation -->
