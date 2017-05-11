<nav id="site-navigation" class="main-navigation" role="navigation">
<?php
// Get menu object
// $my_menu = wp_get_nav_menu_object( 'Top' );
$menu_name = 'main-menu';
$locations = get_nav_menu_locations();
$menu_id = $locations[ $menu_name ] ;
$top_menu = wp_get_nav_menu_object($menu_id);

if ( $top_menu->count > 3 ) : ?>
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'centraldesign' ); ?></button>
<?php endif; ?>

<?php if( !is_front_page() ) : ?>
	<div id="main-site-logo">
		<?php centraldesign_the_custom_logo(); ?>
	</div>
<?php endif; ?>

<?php
if ( $top_menu->count > 3 ) : 
	wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_id' => 'top-menu', 'menu_class' => 'responsive-menu' ) );
else:
	wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_id' => 'top-menu' ) );
endif;
?>


</nav><!-- #site-navigation -->
