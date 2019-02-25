<!-- Menu de navegacao primario -->

	<nav <?php hybrid_attr( 'menu', 'primary' ); ?>>


		<a id="nav-toggle" href="#" title="<?php _e( 'Toggle navigation', 'epico' ); ?>"><span class="screen-reader-text"><?php _e( 'Toggle navigation', 'epico' ); ?></span><span class="nav-text"><?php _e( 'Menu', 'epico' ); ?></span></a>

		<div class="assistive-text skip-link">
			<a href="#content"><?php _e( 'Skip to content', 'epico' ); ?></a>
		</div>

		<?php $primarymenu = wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container'       => '',
				'menu_id'         => 'menu-primary-items',
				'menu_class'      => 'menu-items',
				'fallback_cb'     => 'epico_link_to_menu_editor',
				'items_wrap'      => '<ul id="%s" class="%s">%s</ul>',
				'echo'            => FALSE
			)
		);
		echo $primarymenu;
		?>

	</nav><!-- #menu-primary -->